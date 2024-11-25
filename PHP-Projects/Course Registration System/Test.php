<?php
// test_connection.php
try {
    $ini = parse_ini_file("Lab5.ini");
    
    if ($ini === false) {
        die("Error reading ini file");
    }
    
    echo "Successfully read ini file.<br>";
    echo "Testing database connection...<br>";
    
    $connection = new PDO(
        "mysql:host=" . $ini['host'] . 
        ";dbname=" . $ini['dbname'],
        $ini['username'],
        $ini['password']
    );
    
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Successfully connected to database!";
    
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}