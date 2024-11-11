<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Deposit Calculator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            /* padding-top: 2rem; */
        }
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        header {
            margin-bottom: 2rem;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Algonquin Bank</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Disclaimer.php">Terms and Conditions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="CustomerInfo.php">Customer Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="DepositCalculator.php">Calculator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Complete.php">Complete</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-4">