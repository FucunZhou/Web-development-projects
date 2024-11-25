<?php
require_once 'Header.php';
require_once 'Database.php';

$errors = [];
$studentId = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = trim($_POST['studentId'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($studentId)) $errors['studentId'] = 'Student ID is required';
    if (empty($password)) $errors['password'] = 'Password is required';

    if (empty($errors)) {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT StudentId, Password FROM Student WHERE StudentId = ?");
            $stmt->execute([$studentId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['Password'])) {
                $_SESSION['student_id'] = $user['StudentId'];
                header('Location: CourseSelection.php');
                exit();
            } else {
                $errors['login'] = 'Invalid Student ID or Password';
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $errors['db'] = 'A database error occurred';
        }
    }
}
?>
<main class="container">
    <h2>Login</h2>

    <p>You need to <a href="./NewUser.php">sign up</a> if you are a new user.</p>

    <?php if (isset($errors['login'])): ?>
        <div class="error"><?php echo $errors['login']; ?></div>
    <?php endif; ?>

    <form method="POST" action="Login.php">
        <div class="form-group">
            <label for="studentId">Student ID:</label>
            <input type="text" id="studentId" name="studentId" value="<?php echo htmlspecialchars($studentId); ?>">
            <?php echo displayError($errors['studentId'] ?? null); ?>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <?php echo displayError($errors['password'] ?? null); ?>
        </div>

        <div class="form-group">
            <label></label>
            <button type="submit" class="btn btn-primary me-5">Log In</button>
            <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
    </form>
</main>
<?php include 'Footer.php'; ?>
</body>
</html>