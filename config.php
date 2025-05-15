<?php
$host = 'localhost';
$dbname = 'expense-tracker';
$username = 'root';
$password = 'Shlok2704#';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


global $conn;
?>