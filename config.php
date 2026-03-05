<?php
 $host = 'localhost';
 $db   = 'rsoa_rsoa00142_7';     // Updated Database Name
 $user = 'rsoa_rsoa00142_7';     // Updated Database User
 $pass = '654321#';              // Updated Password
 $charset = 'utf8mb4';
 
 $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
 $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
 
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
 
    // Note: We don't need CREATE TABLE here anymore 
    // because you ran the SQL in Step 1 manually!
    // This just connects the site to the database.
 
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
