<?php
require_once 'Header.php';
require_once 'Database.php';
$userId = $_SESSION['student_id'] ?? null;
if (!$userId) {
    header("Location: Login.php");
    exit();
}
$db = Database::getConnection();
// Handle course deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $selectedCourses = $_POST['courses'] ?? [];
    foreach ($selectedCourses as $courseCode) {
        $stmt = $db->prepare("DELETE FROM Registration WHERE StudentId = :studentId AND CourseCode = :courseCode");
        $stmt->execute(['studentId' => $userId, 'courseCode' => $courseCode]);
    }
}
// Fetch current registrations
$stmt = $db->prepare("SELECT C.CourseCode, C.Title, C.WeeklyHours
    FROM Course C
    INNER JOIN Registration R ON C.CourseCode = R.CourseCode
    WHERE R.StudentId = :studentId");
$stmt->execute(['studentId' => $userId]);
$registrations = $stmt->fetchAll();
?>

<main class="container min-vh-100 pb-5">
    <h2 class="my-4">Current Registrations</h2>
    <form method="POST" action="CourseRegistration.php" id="registrationForm">
        <?php if (!empty($registrations)): ?>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="px-4">Course Code</th>
                            <th class="px-4">Title</th>
                            <th class="px-4">Weekly Hours</th>
                            <th class="px-4 text-center">Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registrations as $course): ?>
                            <tr>
                                <td class="px-4"><?= $course['CourseCode'] ?></td>
                                <td class="px-4"><?= $course['Title'] ?></td>
                                <td class="px-4 text-center"><?= $course['WeeklyHours'] ?></td>
                                <td class="px-4 text-center">
                                    <input type="checkbox" name="courses[]" value="<?= $course['CourseCode'] ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-3 mt-4 mb-5">
                <button type="submit" name="delete" class="btn btn-danger" id="deleteBtn">Delete Selected</button>
                <button type="reset" name="clear" class="btn btn-secondary">Clear</button>
            </div>
        <?php else: ?>
            <p>No courses registered.</p>
        <?php endif; ?>
    </form>
</main>

<!-- 添加确认删除的JavaScript代码 -->
<script>
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    // 检查是否有选中的课程
    const checkboxes = document.querySelectorAll('input[name="courses[]"]:checked');
    
    if (checkboxes.length === 0) {
        e.preventDefault();
        alert('Please select at least one course to delete.');
        return;
    }

    // 显示确认对话框
    if (!confirm('Are you sure you want to delete the selected course(s)? This action cannot be undone.')) {
        e.preventDefault();
    }
});
</script>

<?php include 'Footer.php'; ?>