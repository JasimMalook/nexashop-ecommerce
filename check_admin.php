<?php
// Check admin user in database
require_once 'config/db.php';

echo "<h1>Admin User Check</h1>";

try {
    // Check if admin user exists
    $stmt = $mysqli->prepare("SELECT id, name, email, role, created_at FROM users WHERE email = ? AND role = 'admin'");
    $admin_email = 'admin@admin.com';
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        echo "<p style='color: green;'>✓ Admin user found:</p>";
        echo "<ul>";
        echo "<li>ID: " . $admin['id'] . "</li>";
        echo "<li>Name: " . htmlspecialchars($admin['name']) . "</li>";
        echo "<li>Email: " . htmlspecialchars($admin['email']) . "</li>";
        echo "<li>Role: " . htmlspecialchars($admin['role']) . "</li>";
        echo "<li>Created: " . $admin['created_at'] . "</li>";
        echo "</ul>";
        
        // Get password hash (without showing it)
        $stmt = $mysqli->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param("s", $admin_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $password_data = $result->fetch_assoc();
        
        if ($password_data) {
            $hash = $password_data['password'];
            echo "<p>Password hash length: " . strlen($hash) . " characters</p>";
            
            // Test password verification
            if (password_verify('admin123', $hash)) {
                echo "<p style='color: green;'>✓ Password 'admin123' verifies correctly!</p>";
            } else {
                echo "<p style='color: red;'>✗ Password 'admin123' does NOT verify!</p>";
                
                // Try to create a new hash
                $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
                echo "<p>New hash for 'admin123': " . substr($new_hash, 0, 20) . "...</p>";
                
                // Update the password
                $update_stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
                $update_stmt->bind_param("ss", $new_hash, $admin_email);
                if ($update_stmt->execute()) {
                    echo "<p style='color: green;'>✓ Admin password updated successfully!</p>";
                } else {
                    echo "<p style='color: red;'>✗ Failed to update admin password</p>";
                }
            }
        }
        
    } else {
        echo "<p style='color: red;'>✗ Admin user not found!</p>";
        
        // Create admin user
        $name = 'Admin User';
        $email = 'admin@admin.com';
        $password = 'admin123';
        $role = 'admin';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        echo "<p>Creating admin user...</p>";
        
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hash, $role);
        
        if ($stmt->execute()) {
            echo "<p style='color: green;'>✓ Admin user created successfully!</p>";
            echo "<p>Login with: admin@admin.com / admin123</p>";
        } else {
            echo "<p style='color: red;'>✗ Failed to create admin user: " . $stmt->error . "</p>";
        }
    }
    
    // Check all admin users
    echo "<h3>All Admin Users:</h3>";
    $result = $mysqli->query("SELECT id, name, email, role, created_at FROM users WHERE role = 'admin'");
    
    if ($result->num_rows > 0) {
        while ($admin = $result->fetch_assoc()) {
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 5px 0;'>";
            echo "<strong>" . htmlspecialchars($admin['name']) . "</strong><br>";
            echo "Email: " . htmlspecialchars($admin['email']) . "<br>";
            echo "Role: " . htmlspecialchars($admin['role']) . "<br>";
            echo "Created: " . $admin['created_at'];
            echo "</div>";
        }
    } else {
        echo "<p style='color: orange;'>No admin users found in database</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>Test Admin Login:</h3>";
echo "<p><a href='admin/admin_login.php' target='_blank'>Go to Admin Login</a></p>";
echo "<p>Use credentials: admin@admin.com / admin123</p>";
?>
