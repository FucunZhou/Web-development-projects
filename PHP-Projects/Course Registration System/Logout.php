<?php
require_once 'Header.php';

// Destroy the session
session_destroy();

// Redirect to the home page
header('Location: Index.php');
exit();