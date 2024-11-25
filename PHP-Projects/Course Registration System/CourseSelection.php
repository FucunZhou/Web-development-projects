<?php
require_once 'Header.php';
require_once 'Database.php';

$errors = [];
$userId = $_SESSION['student_id'] ?? null;

if (!$userId) {
    header("Location: Login.php");
    exit();
}

$db = Database::getConnection();
$selectedSemester = $_POST['semester'] ?? $_GET['semester'] ?? null;

// Fetch available semesters
$stmt = $db->prepare("SELECT SemesterCode, Year, Term FROM Semester");
$stmt->execute();
$semesters = $stmt->fetchAll();

// Fetch courses for selected semester
$courses = [];
if ($selectedSemester) {
    $stmt = $db->prepare("SELECT Course.CourseCode, Title, WeeklyHours 
                          FROM Course 
                          INNER JOIN CourseOffer ON Course.CourseCode = CourseOffer.CourseCode 
                          WHERE CourseOffer.SemesterCode = :semesterCode 
                          AND Course.CourseCode NOT IN 
                          (SELECT CourseCode FROM Registration WHERE StudentId = :studentId)");
    $stmt->execute(['semesterCode' => $selectedSemester, 'studentId' => $userId]);
    $courses = $stmt->fetchAll();
}

// Fetch total registered hours for the selected semester
$totalHours = 0;
if ($selectedSemester) {
    $stmt = $db->prepare("SELECT SUM(Course.WeeklyHours) AS TotalHours 
                          FROM Registration 
                          INNER JOIN Course ON Registration.CourseCode = Course.CourseCode 
                          WHERE Registration.StudentId = :studentId 
                          AND Registration.SemesterCode = :semesterCode");
    $stmt->execute(['studentId' => $userId, 'semesterCode' => $selectedSemester]);
    $totalHours = $stmt->fetchColumn();
}
$remainingHours = 16 - $totalHours;

// Handle course registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $selectedCourses = $_POST['courses'] ?? [];

    // 验证：检查是否选择了至少一门课程
    if (empty($selectedCourses)) {
        $errors[] = "You must select at least one course.";
    }

    // 验证：检查课程总时长是否超过16小时
    foreach ($selectedCourses as $courseCode) {
        $stmt = $db->prepare("SELECT WeeklyHours FROM Course WHERE CourseCode = :courseCode");
        $stmt->execute(['courseCode' => $courseCode]);
        $courseHours = $stmt->fetchColumn();

        if ($totalHours + $courseHours > 16) {
            $errors[] = "Your selection exceed max weekly hours.";
            break;
        }

        $stmt = $db->prepare("INSERT INTO Registration (StudentId, CourseCode, SemesterCode) 
                              VALUES (:studentId, :courseCode, :semesterCode)");
        $stmt->execute(['studentId' => $userId, 'courseCode' => $courseCode, 'semesterCode' => $selectedSemester]);
        $totalHours += $courseHours;
    }

    // 如果没有错误，则刷新页面
    if (empty($errors)) {
        header("Location: CourseSelection.php?semester=" . urlencode($selectedSemester));
        exit();
    }
}
?>

<main class="container min-vh-100 pb-5">
    <h2>Course Selection</h2>

    <p>Welcome <?= $userId ?>! (not you? change user <a href="Login.php">here</a>)</p>
    <p>You have registered <?= $totalHours ?> hours for the selected semester.</p>
    <p>You can register <?= $remainingHours ?> more hours of course(s) for the semester.</p>
    <p>Please note that the courses you have registered will not be displayed in the list.</p>
    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li style="list-style: none;"><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="POST" action="CourseSelection.php">
        <select name="semester" onchange="this.form.submit()">
            <option value="">Select Semester</option>
            <?php foreach ($semesters as $semester): ?>
                <option value="<?= $semester['SemesterCode'] ?>" <?= $semester['SemesterCode'] == $selectedSemester ? 'selected' : '' ?>>
                    <?= $semester['Year'] . ' ' . $semester['Term'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <?php if (!empty($courses)): ?>
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
                        <?php foreach ($courses as $course): ?>
                            <?php
                                // 检查是否已勾选
                                $isChecked = isset($_POST['courses']) && in_array($course['CourseCode'], $_POST['courses']);
                                ?>
                            <tr>
                                <td class="px-4"><?= $course['CourseCode'] ?></td>
                                <td class="px-4"><?= $course['Title'] ?></td>
                                <td class="px-4 text-center"><?= $course['WeeklyHours'] ?></td>
                                <td class="px-4 text-center">
                                <input type="checkbox" name="courses[]" value="<?= $course['CourseCode'] ?>" <?= $isChecked ? 'checked' : '' ?>>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-3 mt-4 mb-5">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
                <button type="reset" name="clear" class="btn btn-secondary">Clear</button>
            </div>
        <?php else: ?>
            <p>No courses available for this semester.</p>
        <?php endif; ?>
    </form>

    
</main>
<?php include 'Footer.php'; ?>
