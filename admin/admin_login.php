<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration
require_once '../config/db.php';

// Redirect if admin already logged in
if (isLoggedIn() && isAdmin()) {
    redirect('dashboard.php');
}

$errors = [];
$success = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize inputs
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validation
    if (empty($email)) {
        $errors[] = "Admin email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    // Authenticate admin if no validation errors
    if (empty($errors)) {
        // Get admin user by email using prepared statement
        $stmt = $mysqli->prepare("SELECT id, name, email, password, role, created_at FROM users WHERE email = ? AND role = 'admin'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $admin['password'])) {
                // Password is correct - start secure session
                session_regenerate_id(true); // Prevent session fixation
                
                // Store admin data in session
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['user_name'] = $admin['name'];
                $_SESSION['user_email'] = $admin['email'];
                $_SESSION['user_role'] = $admin['role'];
                $_SESSION['login_time'] = time();
                
                // Log successful admin login
                error_log("Admin logged in: $email from IP: " . $_SERVER['REMOTE_ADDR']);
                
                // Redirect to admin dashboard
                redirect('dashboard.php');
                
            } else {
                // Password is incorrect
                $errors[] = "Invalid admin credentials";
                error_log("Failed admin login attempt for email: $email from IP: " . $_SERVER['REMOTE_ADDR']);
            }
        } else {
            // Admin not found
            $errors[] = "Invalid admin credentials";
            error_log("Failed admin login attempt for unknown email: $email from IP: " . $_SERVER['REMOTE_ADDR']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - eCommerce Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            margin: 20px;
        }
        
        .login-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .login-header h3 {
            font-weight: 600;
            margin: 0;
            font-size: 1.8rem;
        }
        
        .login-header .subtitle {
            opacity: 0.9;
            margin-top: 5px;
        }
        
        .login-body {
            padding: 40px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #dc3545;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }
        
        .credentials-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            border-left: 4px solid #dc3545;
        }
        
        .shield-icon {
            font-size: 4rem;
            color: #dc3545;
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }
        
        @media (max-width: 768px) {
            .login-container {
                margin: 10px;
            }
            
            .login-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="login-container">
                    <div class="login-header">
                        <i class="fas fa-shield-alt shield-icon"></i>
                        <h3>Admin Panel</h3>
                        <div class="subtitle">Secure Administrator Access</div>
                    </div>
                    
                    <div class="login-body">
                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-danger">Administrator Login</h5>
                            <p class="text-muted">Enter your admin credentials to access the dashboard</p>
                        </div>
                        
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <?php echo $success; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Authentication Error:</strong><br>
                                <?php foreach ($errors as $error): ?>
                                    • <?php echo htmlspecialchars($error); ?><br>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="admin_login.php" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-user-shield me-2"></i>Admin Email
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo htmlspecialchars($email ?? ''); ?>" 
                                           placeholder="admin@admin.com" required>
                                </div>
                            </div>
                            

                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="fas fa-key me-2"></i>Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Enter your password" required>
                                </div>
                            </div>
                            

                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Admin Login
                                </button>
                            </div>
                            

                            <div class="text-center mt-3">
                                <a href="../index.php" class="text-muted text-decoration-none">
                                    <i class="fas fa-arrow-left me-1"></i>Back to Website
                                </a>
                            </div>
                        </form>
                        
                        <div class="credentials-box">
                            <h6 class="text-danger mb-3">
                                <i class="fas fa-info-circle me-2"></i>Default Admin Credentials
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Email:</strong><br>
                                    <code>admin@admin.com</code>
                                </div>
                                <div class="col-md-6">
                                    <strong>Password:</strong><br>
                                    <code>admin123</code>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <a href="verify_admin.php" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-tools me-2"></i>Verify Admin Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-focus email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
        
        // Clear form on successful submission
        document.querySelector('form').addEventListener('submit', function() {
            if (!document.querySelector('.alert-danger')) {
                this.reset();
            }
        });
        console.log('%c⚠️ SECURITY WARNING ⚠️', 'color: red; font-size: 20px; font-weight: bold;');
        console.log('%cThis is a private admin area. Unauthorized access is prohibited.', 'color: red; font-size: 12px;');
    });
    </script>
</body>
</html>
