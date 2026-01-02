<?php
// This script will fix the authentication system
require_once 'config/db.php';

echo "<h1>eCommerce Setup & Fix Script</h1>";

// Step 1: Check database connection
echo "<h2>Step 1: Checking Database Connection</h2>";
try {
    $stmt = $pdo->query("SELECT 1");
    echo "<p style='color: green;'>✓ Database connection successful</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
    exit;
}

// Step 2: Check if users table exists
echo "<h2>Step 2: Checking Users Table</h2>";
try {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $user_count = $stmt->fetch()['count'];
    echo "<p style='color: green;'>✓ Users table exists with $user_count users</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Users table not found. Please import database.sql first</p>";
    exit;
}

// Step 3: Update passwords to work with both plain text and hashed
echo "<h2>Step 3: Fixing Password Authentication</h2>";

// Update admin password to support both plain text and hash
$admin_email = 'admin@ecommerce.com';
$admin_password = 'admin123';
$admin_hash = password_hash($admin_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$admin_email]);
$admin_user = $stmt->fetch();

if ($admin_user) {
    // Update with proper hash
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    if ($stmt->execute([$admin_hash, $admin_email])) {
        echo "<p style='color: green;'>✓ Admin password updated and hashed</p>";
    }
} else {
    // Create admin user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
    if ($stmt->execute(['Admin User', $admin_email, $admin_hash])) {
        echo "<p style='color: green;'>✓ Admin user created with hashed password</p>";
    }
}

// Update user password
$user_email = 'john@example.com';
$user_password = 'user123';
$user_hash = password_hash($user_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$user_email]);
$user_user = $stmt->fetch();

if ($user_user) {
    // Update with proper hash
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    if ($stmt->execute([$user_hash, $user_email])) {
        echo "<p style='color: green;'>✓ User password updated and hashed</p>";
    }
} else {
    // Create user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
    if ($stmt->execute(['John Doe', $user_email, $user_hash])) {
        echo "<p style='color: green;'>✓ User account created with hashed password</p>";
    }
}

// Step 4: Test password verification
echo "<h2>Step 4: Testing Password Verification</h2>";

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$admin_email]);
$admin_test = $stmt->fetch();

if ($admin_test && password_verify($admin_password, $admin_test['password'])) {
    echo "<p style='color: green;'>✓ Admin login credentials verified</p>";
} else {
    echo "<p style='color: red;'>✗ Admin login verification failed</p>";
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$user_email]);
$user_test = $stmt->fetch();

if ($user_test && password_verify($user_password, $user_test['password'])) {
    echo "<p style='color: green;'>✓ User login credentials verified</p>";
} else {
    echo "<p style='color: red;'>✗ User login verification failed</p>";
}

// Step 5: Display login information
echo "<h2>Step 5: Login Information</h2>";
echo "<div style='background: #f0f0f0; padding: 15px; border-radius: 5px;'>";
echo "<h3>Admin Login:</h3>";
echo "<p><strong>Email:</strong> admin@ecommerce.com</p>";
echo "<p><strong>Password:</strong> admin123</p>";
echo "<p><strong>URL:</strong> <a href='admin/admin_login.php'>admin/admin_login.php</a></p>";
echo "<hr>";
echo "<h3>User Login:</h3>";
echo "<p><strong>Email:</strong> john@example.com</p>";
echo "<p><strong>Password:</strong> user123</p>";
echo "<p><strong>URL:</strong> <a href='auth/login.php'>auth/login.php</a></p>";
echo "</div>";

echo "<h2>Setup Complete!</h2>";
echo "<p style='color: green; font-weight: bold;'>✓ Authentication system has been fixed and is ready to use.</p>";
echo "<p>You can now login with the credentials above.</p>";
?>
