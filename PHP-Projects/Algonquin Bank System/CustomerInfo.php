<?php

session_start();

// Check if the user has agreed to the disclaimer
if (!isset($_SESSION['agreed']) || $_SESSION['agreed'] !== true) {
    header('Location: Disclaimer.php');
    exit;
}

include 'header.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (!isset($_POST['name']) || empty($_POST['name']) || !preg_match("/^[a-zA-Z\s-]+$/", $_POST['name'])) {
        $errors[] = "Please enter a valid name (only letters, spaces, and hyphens are allowed).";
    }

    // Validate postal code
    if (!isset($_POST['postal_code']) || !preg_match("/^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/", $_POST['postal_code'])) {
        $errors[] = "Please enter a valid Canadian postal code (e.g., A1A 1A1).";
    }

    // Validate phone number
    if (!isset($_POST['phone_number']) || !preg_match("/^(\d{3}[-\s]?){2}\d{4}$/", $_POST['phone_number'])) {
        $errors[] = "Please enter a valid 10-digit phone number.";
    }

    // Validate email address
    if (!isset($_POST['email_address']) || !filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validate contact method
    if (!isset($_POST['contact_method']) || !in_array($_POST['contact_method'], ['email', 'phone'])) {
        $errors[] = "Please select a valid contact method.";
    }

    // If there are no errors, proceed with storing data and redirecting
    if (empty($errors)) {
        // Store form data in session
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['postal_code'] = $_POST['postal_code'];
        $_SESSION['phone_number'] = $_POST['phone_number'];
        $_SESSION['email_address'] = $_POST['email_address'];
        $_SESSION['contact_method'] = $_POST['contact_method'];

        // Redirect based on preferred contact method
        if ($_SESSION['contact_method'] == 'phone') {
            header('Location: ContactTime.php');
            exit;
        } else {
            header('Location: DepositCalculator.php');
            exit;
        }
    }
}
?>

<h2 class="mb-4">Customer Information</h2>

<?php
// Display validation errors if any
if (!empty($errors)) {
    echo '<div class="alert alert-danger" role="alert">';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
}
?>

<form action="CustomerInfo.php" method="post" novalidate>
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required
            value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : (isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''); ?>">
    </div>

    <div class="mb-3">
        <label for="postal_code" class="form-label">Postal Code:</label>
        <input type="text" class="form-control" id="postal_code" name="postal_code" required
            value="<?php echo isset($_POST['postal_code']) ? htmlspecialchars($_POST['postal_code']) : (isset($_SESSION['postal_code']) ? htmlspecialchars($_SESSION['postal_code']) : ''); ?>">
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number:</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" required
            value="<?php echo isset($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : (isset($_SESSION['phone_number']) ? htmlspecialchars($_SESSION['phone_number']) : ''); ?>">
    </div>

    <div class="mb-3">
        <label for="email_address" class="form-label">Email Address:</label>
        <input type="email" class="form-control" id="email_address" name="email_address" required
            value="<?php echo isset($_POST['email_address']) ? htmlspecialchars($_POST['email_address']) : (isset($_SESSION['email_address']) ? htmlspecialchars($_SESSION['email_address']) : ''); ?>">
    </div>

    <div class="row mb-3">
        <label class="form-label">Preferred Contact Method:</label>
        <div class="d-flex">
            <div class="form-check me-5">
                <input class="form-check-input" type="radio" id="contact_email" name="contact_method" value="email" required
                    <?php echo (isset($_POST['contact_method']) && $_POST['contact_method'] == 'email') ? 'checked' : (isset($_SESSION['contact_method']) && $_SESSION['contact_method'] == 'email' ? 'checked' : ''); ?>>
                <label class="form-check-label" for="contact_email">Email</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="contact_phone" name="contact_method" value="phone"
                    <?php echo (isset($_POST['contact_method']) && $_POST['contact_method'] == 'phone') ? 'checked' : (isset($_SESSION['contact_method']) && $_SESSION['contact_method'] == 'phone' ? 'checked' : ''); ?>>
                <label class="form-check-label" for="contact_phone">Phone</label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mb-3">Next</button>
</form>

<?php include 'footer.php'; ?>