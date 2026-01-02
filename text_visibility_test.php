<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Visibility Test</title>
    
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
        .test-section { margin: 2rem 0; padding: 1.5rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; }
        .status-success { color: #10b981; font-weight: bold; }
        .navbar-test { margin: 1rem 0; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Text Visibility Test</h2>
            </div>
            <div class="card-body">
                
                <!-- Navbar Test -->
                <div class="test-section">
                    <h3>Navbar Text Test</h3>
                    <nav class="navbar navbar-dark navbar-test">
                        <div class="container">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="navbar-brand">
                                    <i class="fas fa-shopping-bag me-2"></i>eCommerce
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="text-white me-3 nav-link">
                                        <i class="fas fa-home me-1"></i>Home
                                    </a>
                                    <a href="#" class="text-white me-3 nav-link">
                                        <i class="fas fa-shopping-bag me-1"></i>Shop
                                    </a>
                                    <div class="position-relative cart-icon-wrapper">
                                        <i class="fas fa-shopping-cart fa-lg"></i>
                                        <span class="badge bg-warning rounded-pill cart-count">3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <p class="status-success">✓ Navbar text should be visible above</p>
                </div>

                <!-- Headings Test -->
                <div class="test-section">
                    <h3>Headings Test</h3>
                    <h1>Heading 1 - Should be Visible</h1>
                    <h2>Heading 2 - Should be Visible</h2>
                    <h3>Heading 3 - Should be Visible</h3>
                    <h4>Heading 4 - Should be Visible</h4>
                    <h5>Heading 5 - Should be Visible</h5>
                    <h6>Heading 6 - Should be Visible</h6>
                    <p class="status-success">✓ All headings should be visible above</p>
                </div>

                <!-- Hero Section Test -->
                <div class="test-section">
                    <h3>Hero Section Test</h3>
                    <div class="hero-section text-white p-4 rounded" style="background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);">
                        <h1>Hero Heading - Should be White</h1>
                        <h2>Hero Subheading - Should be White</h2>
                        <p>Hero text should be visible</p>
                    </div>
                    <p class="status-success">✓ Hero text should be white and visible</p>
                </div>

                <!-- Card Test -->
                <div class="test-section">
                    <h3>Card Elements Test</h3>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Card Header - Should be Visible</h6>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Card Title - Should be Visible</h5>
                            <p class="card-text">Card text should be visible.</p>
                            <button class="btn btn-primary">
                                <i class="fas fa-heart me-1"></i>Button Text
                            </button>
                        </div>
                    </div>
                    <p class="status-success">✓ Card text should be visible above</p>
                </div>

                <!-- Dropdown Test -->
                <div class="test-section">
                    <h3>Dropdown Menu Test</h3>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>User Menu
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </div>
                    <p class="status-success">✓ Dropdown text should be visible</p>
                </div>

                <!-- Summary -->
                <div class="alert alert-info">
                    <h4>Test Summary</h4>
                    <p>If all text elements above are visible, the fix is working correctly.</p>
                    <ul>
                        <li>Navbar brand and menu text should be white</li>
                        <li>Cart icon and badge should be visible</li>
                        <li>All headings should be dark colored</li>
                        <li>Hero section text should be white</li>
                        <li>Card text should be visible</li>
                        <li>Dropdown menu text should be visible</li>
                    </ul>
                    <div class="mt-3">
                        <a href="index.php" class="btn btn-primary me-2">
                            <i class="fas fa-home me-2"></i>Test Live Site
                        </a>
                        <a href="shop.php" class="btn btn-outline-primary me-2">
                            <i class="fas fa-shopping-bag me-2"></i>Test Shop
                        </a>
                        <a href="cart.php" class="btn btn-outline-success">
                            <i class="fas fa-shopping-cart me-2"></i>Test Cart
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
