<?php
declare(strict_types=1);

// Hardcoded local XAMPP credentials as requested
$host = 'localhost';
$db   = 'velora_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Rethrow as generic Exception as requested
    throw new Exception('Database connection failed: ' . $e->getMessage(), (int)$e->getCode());
}

return $pdo;
