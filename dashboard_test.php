<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Text Visibility Test</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Premium CSS -->
    <link href="assets/css/premium-style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Text Visibility Fix CSS -->
    <link href="assets/css/text-fix.css" rel="stylesheet">
    
    <style>
        /* Dashboard specific text visibility fix */
        .card-header h5 { color: white !important; opacity: 1 !important; visibility: visible !important; }
        .card-title { color: #1f2937 !important; opacity: 1 !important; visibility: visible !important; }
        .btn i, .btn .fas, .btn .fa { opacity: 1 !important; visibility: visible !important; color: inherit !important; }
        .fa-user, .fa-shopping-bag, .fa-shopping-cart, .fa-sign-out-alt, .fa-dollar-sign { opacity: 1 !important; visibility: visible !important; }
        .text-muted { opacity: 0.8 !important; visibility: visible !important; color: #64748b !important; }
        .badge { opacity: 1 !important; visibility: visible !important; }
        .bg-primary .fa-user { color: white !important; opacity: 1 !important; }
        .text-primary .fa-shopping-bag, .text-success .fa-shopping-cart, .text-info .fa-dollar-sign { opacity: 1 !important; visibility: visible !important; }
    </style>
</head>
<body>
    <div class="container my-5 dashboard-page">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Dashboard Text Visibility Test</h2>
            </div>
            <div class="card-body">
                
                <!-- User Profile Section Test -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-user me-2"></i>My Profile
                                </h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                </div>
                                <h5>John Doe</h5>
                                <p class="text-muted">john@example.com</p>
                                <span class="badge bg-info">User</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Test -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h6 class="mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary">
                                        <i class="fas fa-shopping-cart me-2"></i>View Cart
                                        <span class="badge bg-primary ms-1">3</span>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards Test -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm border-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-shopping-bag fa-2x text-primary mb-2"></i>
                                <h3>5</h3>
                                <p class="text-muted mb-0">Total Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-success">
                            <div class="card-body text-center">
                                <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
                                <h3>3</h3>
                                <p class="text-muted mb-0">Cart Items</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm border-info">
                            <div class="card-body text-center">
                                <i class="fas fa-dollar-sign fa-2x text-info mb-2"></i>
                                <h3>$99.99</h3>
                                <p class="text-muted mb-0">Cart Total</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Welcome Section Test -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h4>Welcome back, John Doe! 👋</h4>
                                <p class="text-muted">Here's what's happening with your account today.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Test Results -->
                <div class="alert alert-info">
                    <h5>Test Results</h5>
                    <p>If all elements above are visible, the dashboard fix is working:</p>
                    <ul>
                        <li>✓ Profile card header with icon should be visible</li>
                        <li>✓ User name and email should be visible</li>
                        <li>✓ Quick action buttons with icons should be visible</li>
                        <li>✓ Statistics cards with icons should be visible</li>
                        <li>✓ Welcome message should be visible</li>
                        <li>✓ All badges should be visible</li>
                    </ul>
                    <div class="mt-3">
                        <a href="dashboard.php" class="btn btn-primary me-2">
                            <i class="fas fa-tachometer-alt me-2"></i>Test Live Dashboard
                        </a>
                        <a href="index.php" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i>Back to Home
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
