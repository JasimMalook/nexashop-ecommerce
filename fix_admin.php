<?php
// Admin User Fix Script
require_once 'config/db.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Admin Fix - eCommerce</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body { background: #f8f9fa; }
        .container { max-width: 600px; margin-top: 50px; }
        .card { border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class='container'>
        <div class='card'>
            <div class='card-header bg-danger text-white'>
                <h3><i class='fas fa-user-shield me-2'></i>Admin User Fix</h3>
            </div>
            <div class='card-body'>";

try {
    // Step 1: Check if admin user exists
    echo "<h4>Step 1: Check Admin User</h4>";
    
    $stmt = $mysqli->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? AND role = 'admin'");
    $admin_email = 'admin@admin.com';
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        echo "<p class='text-success'>✓ Admin user found: " . htmlspecialchars($admin['name']) . "</p>";
        
        // Test password
        if (password_verify('admin123', $admin['password'])) {
            echo "<p class='text-success'>✓ Admin password is correct</p>";
        } else {
            echo "<p class='text-warning'>⚠ Admin password is incorrect, fixing...</p>";
            
            // Update password
            $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
            $update_stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $new_hash, $admin_email);
            
            if ($update_stmt->execute()) {
                echo "<p class='text-success'>✓ Admin password updated successfully</p>";
            } else {
                echo "<p class='text-danger'>✗ Failed to update admin password</p>";
            }
        }
    } else {
        echo "<p class='text-warning'>⚠ Admin user not found, creating...</p>";
        
        // Create admin user
        $name = 'Admin User';
        $email = 'admin@admin.com';
        $password = 'admin123';
        $role = 'admin';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hash, $role);
        
        if ($stmt->execute()) {
            echo "<p class='text-success'>✓ Admin user created successfully</p>";
        } else {
            echo "<p class='text-danger'>✗ Failed to create admin user: " . $stmt->error . "</p>";
        }
    }
    
    // Step 2: Test admin login
    echo "<h4>Step 2: Test Admin Login</h4>";
    
    $stmt = $mysqli->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        if (password_verify('admin123', $admin['password'])) {
            echo "<p class='text-success'>✓ Admin login test PASSED</p>";
            echo "<p class='text-info'>Credentials: admin@admin.com / admin123</p>";
        } else {
            echo "<p class='text-danger'>✗ Admin login test FAILED</p>";
        }
    }
    
    // Step 3: Show all admin users
    echo "<h4>Step 3: All Admin Users</h4>";
    
    $result = $mysqli->query("SELECT id, name, email, role, created_at FROM users WHERE role = 'admin'");
    
    if ($result->num_rows > 0) {
        while ($admin = $result->fetch_assoc()) {
            echo "<div class='alert alert-info'>";
            echo "<strong>" . htmlspecialchars($admin['name']) . "</strong><br>";
            echo "Email: " . htmlspecialchars($admin['email']) . "<br>";
            echo "Role: " . htmlspecialchars($admin['role']) . "<br>";
            echo "Created: " . $admin['created_at'];
            echo "</div>";
        }
    } else {
        echo "<p class='text-warning'>No admin users found</p>";
    }
    
    echo "<hr>";
    echo "<div class='alert alert-success'>";
    echo "<h5><i class='fas fa-check-circle me-2'></i>Admin Fix Complete!</h5>";
    echo "<p>The admin user has been fixed. You can now login with:</p>";
    echo "<ul>";
    echo "<li><strong>Email:</strong> admin@admin.com</li>";
    echo "<li><strong>Password:</strong> admin123</li>";
    echo "</ul>";
    echo "<a href='admin/admin_login.php' class='btn btn-primary'>Go to Admin Login</a>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
}

echo "</div>
        </div>
    </div>
</body>
</html>";
?>
