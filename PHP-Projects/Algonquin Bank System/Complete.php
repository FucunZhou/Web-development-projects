<?php
session_start();

// Check if the user has agreed to the disclaimer
if (!isset($_SESSION['agreed']) || $_SESSION['agreed'] !== true) {
    header('Location: Disclaimer.php');
    exit;
}

include 'header.php';

// Retrieve session data
$name = $_SESSION['name'] ?? 'Customer';  // Default to 'Customer' if no name is set
$contactMethod = $_SESSION['contact_method'] ?? '';
$contactTimes = $_SESSION['contact_times'] ?? [];
$phoneNumber = $_SESSION['phone_number'] ?? '';
$emailAddress = $_SESSION['email_address'] ?? '';

// Display the personalized thank you message
echo "<main>";
echo "<h1>Thank You, $name!</h1>";
echo "<p>We appreciate your interest in our services.</p>";

if ($contactMethod == 'phone') {
    $timeString = implode(', ', $contactTimes);  // Convert the array to a string
    echo "<p>We will contact you by phone at the following times: $timeString at $phoneNumber.</p>";
} else {
    echo "<p>We will contact you by email at $emailAddress.</p>";
}
echo "</main>";

// Clear the session data after showing the thank you message
session_unset();
session_destroy();

include 'footer.php';
