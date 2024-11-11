<?php
session_start();

if (!isset($_SESSION['contact_method']) || $_SESSION['contact_method'] != 'phone') {
    header('Location: CustomerInfo.php');
    exit;
}

include 'Header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['contact_times'])) {
        $_SESSION['contact_times'] = $_POST['contact_times'];  // Save selected times in the session
        header('Location: DepositCalculator.php');  // Redirect to DepositCalculator.php
        exit;
    } else {
        $error = 'Please select at least one contact time.';
        // Clear the session variable if no times were selected
        unset($_SESSION['contact_times']);
    }
}

$contact_times = [
    '9:00 AM - 10:00 AM',
    '10:00 AM - 11:00 AM',
    '11:00 AM - 12:00 PM',
    '12:00 PM - 1:00 PM',
    '1:00 PM - 2:00 PM',
    '2:00 PM - 3:00 PM',
    '3:00 PM - 4:00 PM',
    '4:00 PM - 5:00 PM',
    '5:00 PM - 6:00 PM'
];

?>

<main>
    <h1>Preferred Contact Time</h1>
    <form action="ContactTime.php" method="post">
        <?php foreach ($contact_times as $time): ?>
            <label>
                <input type="checkbox" name="contact_times[]" value="<?php echo htmlspecialchars($time); ?>"
                    <?php echo (isset($_SESSION['contact_times']) && is_array($_SESSION['contact_times']) && in_array($time, $_SESSION['contact_times'])) ? 'checked' : ''; ?>>
                <?php echo htmlspecialchars(ucfirst($time)); ?>
            </label><br>
        <?php endforeach; ?>

        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <input type="button" class="btn btn-secondary" value="&lt; Back" onclick="window.location.href='CustomerInfo.php'">
        <input type="submit" class="btn btn-primary" value="Next &gt;">
    </form>
</main>

<?php include 'Footer.php'; ?>