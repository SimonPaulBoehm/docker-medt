<?php
// DB Connection Test 
define('DB_HOST', 'db');
define('DB_NAME', 'test_db');
define('DB_USER', 'devuser');
define('DB_PASS', 'devpass');
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Datenbankverbindung erfolgreich!";
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}
