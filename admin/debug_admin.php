<?php
require_once '../config/db.php';

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

echo "<h1>Admin Debug Information</h1>";

echo "<h2>Session Data:</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>Function Tests:</h2>";
echo "isLoggedIn(): " . (isLoggedIn() ? "true" : "false") . "<br>";
echo "isAdmin(): " . (isAdmin() ? "true" : "false") . "<br>";

echo "<h2>Database Check:</h2>";
// Check if admin user exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'admin' LIMIT 1");
$stmt->execute();
$admin = $stmt->fetch();

if ($admin) {
    echo "Admin user found:<br>";
    echo "<pre>";
    print_r($admin);
    echo "</pre>";
} else {
    echo "No admin user found in database.<br>";
}

echo "<h2>Login Form:</h2>";
?>
<form method="POST" action="admin_login.php">
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="admin@admin.com" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" value="admin123" required>
    </div>
    <div>
        <button type="submit">Login as Admin</button>
    </div>
</form>

<p><a href="admin_login.php">Go to Admin Login</a></p>
<p><a href="products.php">Try Products Page</a></p>
