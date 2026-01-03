<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/db.php';

echo "<h1>Admin Access Test</h1>";

// Check current login status
echo "<h2>Current Status:</h2>";
if (isLoggedIn() && isAdmin()) {
    echo "<p style='color: green;'>✅ You are logged in as admin</p>";
    echo "<p><a href='products.php'>Go to Products Management</a></p>";
} else {
    echo "<p style='color: red;'>❌ You are NOT logged in as admin</p>";
    
    // Show session data for debugging
    echo "<h3>Session Data:</h3>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    
    // Show login form
    echo "<h3>Admin Login:</h3>";
    ?>
    <form method="POST" action="admin_login.php">
        <div style="margin: 10px 0;">
            <label>Email:</label><br>
            <input type="email" name="email" value="admin@admin.com" required style="padding: 5px; width: 200px;">
        </div>
        <div style="margin: 10px 0;">
            <label>Password:</label><br>
            <input type="password" name="password" value="admin123" required style="padding: 5px; width: 200px;">
        </div>
        <div style="margin: 10px 0;">
            <button type="submit" style="padding: 5px 15px; background: #007bff; color: white; border: none; cursor: pointer;">Login as Admin</button>
        </div>
    </form>
    <?php
}

// Check if admin user exists in database
echo "<h2>Database Check:</h2>";
$stmt = $pdo->prepare("SELECT id, name, email, role FROM users WHERE role = 'admin' LIMIT 1");
$stmt->execute();
$admin = $stmt->fetch();

if ($admin) {
    echo "<p style='color: green;'>✅ Admin user found in database:</p>";
    echo "<pre>";
    print_r($admin);
    echo "</pre>";
} else {
    echo "<p style='color: red;'>❌ No admin user found in database</p>";
    echo "<p>Creating default admin user...</p>";
    
    // Create default admin
    $admin_email = 'admin@admin.com';
    $admin_password = 'admin123';
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->execute(['Administrator', $admin_email, $hashed_password]);
    
    echo "<p style='color: green;'>✅ Default admin created: admin@admin.com / admin123</p>";
}

echo "<hr>";
echo "<p><a href='debug_admin.php'>Debug Admin Info</a></p>";
echo "<p><a href='admin_login.php'>Admin Login Page</a></p>";
echo "<p><a href='products.php'>Products Management</a></p>";
echo "<p><a href='../index.php'>Go to Main Site</a></p>";
?>
