<?php
require_once 'config/db.php';

// Update admin password
$admin_password = 'admin123';
$admin_hash = password_hash($admin_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@ecommerce.com'");
$stmt->execute([$admin_hash]);

// Update user password
$user_password = 'user123';
$user_hash = password_hash($user_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'john@example.com'");
$stmt->execute([$user_hash]);

echo "Passwords have been updated with correct hashes!\n";
echo "Admin login: admin@ecommerce.com / admin123\n";
echo "User login: john@example.com / user123\n";
?>
