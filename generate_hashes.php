<?php
// Generate proper password hashes for admin123 and user123
$admin_password = 'admin123';
$user_password = 'user123';

$admin_hash = password_hash($admin_password, PASSWORD_DEFAULT);
$user_hash = password_hash($user_password, PASSWORD_DEFAULT);

echo "Admin Password Hash: " . $admin_hash . "\n";
echo "User Password Hash: " . $user_hash . "\n";

// Verify the hashes
echo "\nVerification:\n";
echo "Admin123 verifies: " . (password_verify('admin123', $admin_hash) ? 'YES' : 'NO') . "\n";
echo "User123 verifies: " . (password_verify('user123', $user_hash) ? 'YES' : 'NO') . "\n";
?>
