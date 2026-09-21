<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=bantay_bayanihan;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>