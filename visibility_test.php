<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visibility Test - Headings & Icons</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Premium CSS -->
    <link href="assets/css/premium-style.css" rel="stylesheet">
    <!-- Visibility Fix CSS -->
    <link href="assets/css/visibility-fix.css" rel="stylesheet">
    
    <style>
        .test-section { margin: 2rem 0; padding: 2rem; border: 2px solid #e2e8f0; border-radius: 1rem; }
        .test-section h3 { color: #4f46e5; margin-bottom: 1rem; }
        .icon-test { font-size: 2rem; margin: 0.5rem; }
        .heading-test { margin: 1rem 0; }
        .navbar-test { background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); padding: 1rem; border-radius: 0.5rem; color: white; margin: 1rem 0; }
        .status-pass { color: #10b981; font-weight: bold; }
        .status-fail { color: #ef4444; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-gradient-primary text-white">
                <h2 class="mb-0"><i class="fas fa-eye me-2"></i>Visibility Test Results</h2>
            </div>
            <div class="card-body">
                
                <!-- Headings Test -->
                <div class="test-section">
                    <h3><i class="fas fa-heading me-2"></i>Headings Visibility Test</h3>
                    <div class="heading-test">
                        <h1>Heading 1 Test - Should be Visible</h1>
                        <h2>Heading 2 Test - Should be Visible</h2>
                        <h3>Heading 3 Test - Should be Visible</h3>
                        <h4>Heading 4 Test - Should be Visible</h4>
                        <h5>Heading 5 Test - Should be Visible</h5>
                        <h6>Heading 6 Test - Should be Visible</h6>
                    </div>
                    <div class="heading-test">
                        <h1 class="text-gradient">Gradient Heading 1 - Should be Visible</h1>
                        <h2 class="text-gradient">Gradient Heading 2 - Should be Visible</h2>
                        <h3 class="text-gradient">Gradient Heading 3 - Should be Visible</h3>
                    </div>
                    <p class="status-pass">✓ All headings should be visible above</p>
                </div>

                <!-- Icons Test -->
                <div class="test-section">
                    <h3><i class="fas fa-icons me-2"></i>Icons Visibility Test</h3>
                    <div class="icon-test">
                        <i class="fas fa-home"></i>
                        <i class="fas fa-shopping-bag"></i>
                        <i class="fas fa-shopping-cart"></i>
                        <i class="fas fa-user"></i>
                        <i class="fas fa-cog"></i>
                        <i class="fas fa-search"></i>
                        <i class="fas fa-heart"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="status-pass">✓ All icons should be visible above</p>
                </div>

                <!-- Navbar Test -->
                <div class="test-section">
                    <h3><i class="fas fa-bars me-2"></i>Navbar Elements Test</h3>
                    <div class="navbar-test">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="navbar-brand">
                                <i class="fas fa-shopping-bag me-2"></i>eCommerce
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="text-white me-3">
                                    <i class="fas fa-home me-1"></i>Home
                                </a>
                                <a href="#" class="text-white me-3">
                                    <i class="fas fa-shopping-bag me-1"></i>Shop
                                </a>
                                <div class="position-relative cart-icon-wrapper">
                                    <i class="fas fa-shopping-cart fa-lg"></i>
                                    <span class="badge bg-warning rounded-pill cart-count">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="status-pass">✓ Navbar elements should be visible above</p>
                </div>

                <!-- Button Icons Test -->
                <div class="test-section">
                    <h3><i class="fas fa-mouse-pointer me-2"></i>Button Icons Test</h3>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-primary">
                            <i class="fas fa-heart me-1"></i>Primary
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-check me-1"></i>Success
                        </button>
                        <button class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-shopping-cart me-1"></i>Cart
                        </button>
                    </div>
                    <p class="status-pass">✓ Button icons should be visible above</p>
                </div>

                <!-- Card Elements Test -->
                <div class="test-section">
                    <h3><i class="fas fa-credit-card me-2"></i>Card Elements Test</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-box me-2"></i>Product Card
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Product Title</h5>
                                    <p class="card-text">Product description with visible text.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="product-price">$99.99</div>
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-cart-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="status-pass">✓ Card elements should be visible above</p>
                </div>

                <!-- Alert Test -->
                <div class="test-section">
                    <h3><i class="fas fa-bell me-2"></i>Alert Icons Test</h3>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Success!</strong> Alert with icon should be visible.
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning!</strong> Alert with icon should be visible.
                    </div>
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Error!</strong> Alert with icon should be visible.
                    </div>
                    <p class="status-pass">✓ Alert icons should be visible above</p>
                </div>

                <!-- Summary -->
                <div class="alert alert-info">
                    <h4><i class="fas fa-info-circle me-2"></i>Test Summary</h4>
                    <p>If all elements above are visible, the visibility fix is working correctly.</p>
                    <ul>
                        <li>All headings (h1-h6) should be visible</li>
                        <li>All Font Awesome icons should be visible</li>
                        <li>Navbar elements should be visible</li>
                        <li>Button icons should be visible</li>
                        <li>Card elements should be visible</li>
                        <li>Alert icons should be visible</li>
                    </ul>
                    <div class="mt-3">
                        <a href="index.php" class="btn btn-primary me-2">
                            <i class="fas fa-home me-2"></i>Test Home Page
                        </a>
                        <a href="shop.php" class="btn btn-outline-primary me-2">
                            <i class="fas fa-shopping-bag me-2"></i>Test Shop Page
                        </a>
                        <a href="cart.php" class="btn btn-outline-success">
                            <i class="fas fa-shopping-cart me-2"></i>Test Cart Page
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
