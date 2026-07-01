<?php
// Temporary script: reset admin password to 'admin123' (bcrypt).
// Run once in browser: http://localhost/UTSWeb_IF4A_0055/admin_reset_password.php
// Then remove this file for security.
require_once __DIR__ . '/config/database.php';

try {
    $username = 'admin';
    $newHash = password_hash('admin123', PASSWORD_BCRYPT);
    $stmt = $pdo->prepare('UPDATE admins SET password_hash = :h WHERE username = :u');
    $stmt->execute([':h' => $newHash, ':u' => $username]);
    echo "Password for user 'admin' has been reset to 'admin123'.\n";
    echo "New hash: " . htmlspecialchars($newHash);
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}
