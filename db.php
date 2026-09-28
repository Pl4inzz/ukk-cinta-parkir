<?php
// Helper koneksi database cPanel Sakuci
$dbHost = 'localhost';
$dbPort = 3306;
$dbName = 'db_ukkcintaparkiran';
$dbUser = 'db_ukkcintaparkiran_86fbf';
$dbPass = 'f0afa42556c7345c012d7f32';

try {
    $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Koneksi database gagal: ' . $e->getMessage());
}
