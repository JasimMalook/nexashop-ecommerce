<?php
// Admin Verification Script
require_once '../config/db.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Admin Verification - eCommerce</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .container { max-width: 800px; margin-top: 50px; }
        .card { border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-radius: 15px; }
        .card-header { border-radius: 15px 15px 0 0 !important; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='card'>
            <div class='card-header bg-danger text-white'>
                <h3><i class='fas fa-user-shield me-2'></i>Admin Verification</h3>
            </div>
            <div class='card-body'>";

try {
    // Step 1: Check database connection
    echo "<h4><i class='fas fa-database me-2'></i>Database Connection</h4>";
    if ($mysqli->connect_error) {
        echo "<div class='alert alert-danger'>✗ Database connection failed: " . $mysqli->connect_error . "</div>";
        exit;
    }
    echo "<div class='alert alert-success'>✓ Database connection successful</div>";

    // Step 2: Check admin user
    echo "<h4><i class='fas fa-search me-2'></i>Admin User Check</h4>";
    
    $stmt = $mysqli->prepare("SELECT id, name, email, password, role, created_at FROM users WHERE email = ? AND role = 'admin'");
    $admin_email = 'admin@admin.com';
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        echo "<div class='alert alert-success'>✓ Admin user found</div>";
        
        echo "<div class='card bg-light mb-3'>";
        echo "<div class='card-body'>";
        echo "<h6>Admin Details:</h6>";
        echo "<ul class='mb-0'>";
        echo "<li><strong>ID:</strong> " . $admin['id'] . "</li>";
        echo "<li><strong>Name:</strong> " . htmlspecialchars($admin['name']) . "</li>";
        echo "<li><strong>Email:</strong> " . htmlspecialchars($admin['email']) . "</li>";
        echo "<li><strong>Role:</strong> " . htmlspecialchars($admin['role']) . "</li>";
        echo "<li><strong>Created:</strong> " . $admin['created_at'] . "</li>";
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        
        // Test password
        if (password_verify('admin123', $admin['password'])) {
            echo "<div class='alert alert-success'>✓ Password verification PASSED</div>";
        } else {
            echo "<div class='alert alert-warning'>⚠ Password verification FAILED - Fixing...</div>";
            
            // Update password
            $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
            $update_stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $new_hash, $admin_email);
            
            if ($update_stmt->execute()) {
                echo "<div class='alert alert-success'>✓ Admin password updated successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>✗ Failed to update admin password</div>";
            }
        }
        
    } else {
        echo "<div class='alert alert-warning'>⚠ Admin user not found - Creating...</div>";
        
        // Create admin user
        $name = 'Admin User';
        $email = 'admin@admin.com';
        $password = 'admin123';
        $role = 'admin';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hash, $role);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>✓ Admin user created successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>✗ Failed to create admin user: " . $stmt->error . "</div>";
        }
    }
    
    // Step 3: Test login simulation
    echo "<h4><i class='fas fa-key me-2'></i>Login Test</h4>";
    
    $stmt = $mysqli->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        if (password_verify('admin123', $admin['password'])) {
            echo "<div class='alert alert-success'>✓ Login simulation PASSED</div>";
        } else {
            echo "<div class='alert alert-danger'>✗ Login simulation FAILED</div>";
        }
    }
    
    // Step 4: Show all admin users
    echo "<h4><i class='fas fa-users me-2'></i>All Admin Users</h4>";
    
    $result = $mysqli->query("SELECT id, name, email, role, created_at FROM users WHERE role = 'admin'");
    
    if ($result->num_rows > 0) {
        while ($admin = $result->fetch_assoc()) {
            echo "<div class='card bg-light mb-2'>";
            echo "<div class='card-body py-2'>";
            echo "<div class='row align-items-center'>";
            echo "<div class='col-md-8'>";
            echo "<strong>" . htmlspecialchars($admin['name']) . "</strong><br>";
            echo "<small class='text-muted'>" . htmlspecialchars($admin['email']) . "</small>";
            echo "</div>";
            echo "<div class='col-md-4 text-end'>";
            echo "<span class='badge bg-danger'>" . htmlspecialchars($admin['role']) . "</span>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>No admin users found</div>";
    }
    
    echo "<hr>";
    echo "<div class='alert alert-info'>";
    echo "<h5><i class='fas fa-check-circle me-2'></i>Verification Complete!</h5>";
    echo "<p class='mb-2'>The admin system has been verified and fixed if needed.</p>";
    echo "<p class='mb-0'><strong>Login Credentials:</strong><br>";
    echo "Email: <code>admin@admin.com</code><br>";
    echo "Password: <code>admin123</code></p>";
    echo "</div>";
    
    echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";
    echo "<a href='admin_login_fixed.php' class='btn btn-danger'>";
    echo "<i class='fas fa-sign-in-alt me-2'></i>Try Admin Login";
    echo "</a>";
    echo "<a href='../index.php' class='btn btn-outline-secondary'>";
    echo "<i class='fas fa-home me-2'></i>Back to Website";
    echo "</a>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}

echo "</div>
        </div>
    </div>
</body>
</html>";
?>
