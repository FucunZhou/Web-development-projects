<?php
require_once 'Header.php';
require_once 'Database.php';

$errors = [];
$studentId = $name = $phone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = trim($_POST['studentId'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validate Student ID
    if (empty($studentId)) {
        $errors['studentId'] = 'Student ID is required';
    } else {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT StudentId FROM Student WHERE StudentId = ?");
            $stmt->execute([$studentId]);
            if ($stmt->fetch()) {
                $errors['studentId'] = 'This Student ID already exists';
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $errors['db'] = 'A database error occurred';
        }
    }

    // Validate Name, Phone, Password
    if (empty($name)) $errors['name'] = 'Name is required';
    if (empty($phone)) $errors['phone'] = 'Phone number is required';
    elseif (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) $errors['phone'] = 'Invalid phone format';

    if (empty($password)) $errors['password'] = 'Password is required';
    elseif (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Password must be at least 6 characters with an uppercase letter and a number';
    }
    if ($password !== $confirmPassword) $errors['confirm_password'] = 'Passwords do not match';

    // Save to Database
    if (empty($errors)) {
        try {
            $db = Database::getConnection();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO Student (StudentId, Name, Phone, Password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$studentId, $name, $phone, $hashedPassword]);
            $_SESSION['student_id'] = $studentId;
            header('Location: CourseSelection.php');
            exit();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $errors['db'] = 'A database error occurred';
        }
    }
}
?>


<!-- HTML Form part -->
<main class="container">
    <h2>New User Registration</h2>
    <p>If you have registered, please <a href="./Login.php">log in</a>.</p>
    <p id="require-info">All fields are required!</p>

    <form method="POST" action="NewUser.php">
        <div class="form-group">
            <label for="studentId">Student ID:</label>
            <input type="text" id="studentId" name="studentId" value="<?php echo htmlspecialchars($studentId); ?>">
            <?php echo displayError($errors['studentId'] ?? null); ?>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <?php echo displayError($errors['name'] ?? null); ?>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
            <?php echo displayError($errors['phone'] ?? null); ?>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <?php echo displayError($errors['password'] ?? null); ?>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <?php echo displayError($errors['confirm_password'] ?? null); ?>
        </div>

        <div class="form-group">
            <label></label>
            <button type="submit" class="btn btn-primary me-5">Submit</button>
            <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
    </form>
</main>
<?php include 'Footer.php'; ?>
</body>
</html>