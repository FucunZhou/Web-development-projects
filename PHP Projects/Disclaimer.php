<?php
session_start();
include 'Header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['agree']) && $_POST['agree'] == 'yes') {
        $_SESSION['agreed'] = true;
        header('Location: CustomerInfo.php');
        exit;
    } else {
        $error = 'You must agree to the terms and conditions to proceed.';
    }
}
?>

<main>
    <h1>Terms and Conditions</h1>
    <p>Please read and agree to our terms and conditions:</p>
    <p>All terms and conditions.</p>

    <form method="post">
        <label>
            <input type="checkbox" name="agree" value="yes"> I have read and agree to the terms and conditions
        </label>
        <br>
        <input class="btn btn-primary mt-3" type="submit" value="Start">
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
</main>

<?php include 'Footer.php'; ?>