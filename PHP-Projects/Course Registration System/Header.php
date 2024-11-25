<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['student_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: Login.php");
        exit();
    }
}

function displayError($error) {
    return isset($error) ? "<span class='error'>$error</span>" : "";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Registration System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            padding: 0 20px;
        }

        h2 {
            margin-bottom: 20px;
            margin-left: 180px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: inline-block;
            width: 150px;
            text-align: right;
            margin-right: 10px;
        }

        input {
            width: 250px;
        }

        .error {
            color: red;
            margin-left: 10px;
        }

        #require-info {
            color: red;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-md">
                <a class="navbar-brand" href="#">Course Registration System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="CourseSelection.php">Course Selection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="CourseRegistration.php">Course Registration</a>
                        </li>
                        <?php if (isLoggedIn()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="Logout.php">Log Out</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="Login.php">Log In</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-4">
    <!-- Main content goes here -->
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>