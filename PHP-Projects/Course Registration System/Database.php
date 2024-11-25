<?php
class Database {
    private static $connection = null;
    
    public static function getConnection() {
        if (self::$connection === null) {
            try {
                $ini = parse_ini_file("Lab5.ini");
                
                $connection = new PDO(
                    "mysql:host=" . $ini['host'] . 
                    ";dbname=" . $ini['dbname'],
                    $ini['username'],
                    $ini['password']
                );
                
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection = $connection;
            } catch (PDOException $e) {
                error_log("Connection Error: " . $e->getMessage());
                throw new Exception("Database Connection Error");
            }
        }
        return self::$connection;
    }
}