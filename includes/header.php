<?php
// Header Component with Cart Integration
require_once __DIR__ . '/../config/db.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Calculate cart count
$total_items = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_items += $item['quantity'];
    }
}

// Store in session for easy access
$_SESSION['cart_count'] = $total_items;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'NexaShop - Modern eCommerce Store'; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
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
        .cart-count {
            position: absolute;
            top: -8px;
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        /* User Avatar Styles */
        .user-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .avatar-circle:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        
        /* Dropdown menu improvements */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 8px;
            margin-top: 8px;
        }
        
        .dropdown-item {
            border-radius: 8px;
            padding: 10px 16px;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: #f8fafc;
            transform: translateX(2px);
        }
        
        /* Categories dropdown */
        #categoriesDropdown + .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }
        
        /* Clean Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: color 0.2s ease;
        }
        
        .navbar-brand:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            margin: 0 0.25rem;
        }
        
        .navbar-nav .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }
        
        .navbar-nav .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        /* Responsive improvements */
        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                margin: 0.25rem 0;
                padding: 0.75rem 1rem;
            }
            
            .navbar-nav .nav-item {
                margin-bottom: 0.5rem;
            }
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            font-size: 0.7rem;
            min-width: 18px;
            text-align: center;
        }
        .cart-icon-wrapper {
            position: relative;
        }
        
        /* Navbar alignment fixes */
        .navbar-nav.ms-auto {
            margin-left: auto !important;
        }
        
        .navbar-nav.d-flex {
            display: flex !important;
            align-items: center !important;
        }
        
        .navbar-nav .nav-item {
            display: flex !important;
            align-items: center !important;
        }
        
        .cart-icon-wrapper {
            display: flex !important;
            align-items: center !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; z-index: 1030 !important; display: block !important; visibility: visible !important; opacity: 1 !important;">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php" style="color: white !important; opacity: 1 !important; visibility: visible !important;">
                <img src="assets/images/nexashop-logo.svg" alt="NexaShop Logo" width="40" height="40" class="me-2" style="filter: brightness(0) invert(1);">
                NexaShop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="opacity: 1 !important; visibility: visible !important;">
                <span class="navbar-toggler-icon" style="opacity: 1 !important; visibility: visible !important;"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav" style="opacity: 1 !important; visibility: visible !important;">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                            <i class="fas fa-home me-1" style="color: inherit !important; opacity: 1 !important;"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>" href="shop.php" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                            <i class="fas fa-shopping-bag me-1" style="color: inherit !important; opacity: 1 !important;"></i>Shop
                        </a>
                    </li>
                    
                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                            <i class="fas fa-th-large me-1" style="color: inherit !important; opacity: 1 !important;"></i>Categories
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            // Get categories from database
                            $categories_query = "SELECT id, name FROM categories ORDER BY name";
                            $categories_result = $mysqli->query($categories_query);
                            if ($categories_result && $categories_result->num_rows > 0):
                                while ($category = $categories_result->fetch_assoc()):
                            ?>
                                <li><a class="dropdown-item" href="shop.php?category=<?php echo urlencode($category['id']); ?>">
                                    <i class="fas fa-tag me-2"></i><?php echo htmlspecialchars($category['name']); ?>
                                </a></li>
                            <?php
                                endwhile;
                            else:
                            ?>
                                <li><a class="dropdown-item disabled" href="#">No categories available</a></li>
                            <?php
                            endif;
                            ?>
                        </ul>
                    </li>
                    
                    <?php if (isLoggedIn() && isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/dashboard.php" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                                <i class="fas fa-cog me-1" style="color: inherit !important; opacity: 1 !important;"></i>Admin Panel
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <!-- More Dropdown (About & Contact) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-bs-toggle="dropdown" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                            <i class="fas fa-ellipsis-h me-1" style="color: inherit !important; opacity: 1 !important;"></i>More
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="about.php">
                                <i class="fas fa-info-circle me-2"></i>About Us
                            </a></li>
                            <li><a class="dropdown-item" href="contact.php">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a></li>
                            <?php if (isLoggedIn()): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="dashboard.php">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    
                    <?php if (isLoggedIn()): ?>
                        <!-- Cart Icon -->
                        <li class="nav-item me-3">
                            <a class="nav-link position-relative cart-icon-wrapper <?php echo basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : ''; ?>" href="cart.php" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                                <i class="fas fa-shopping-cart fa-lg" style="color: inherit !important; opacity: 1 !important;"></i>
                                <?php if ($total_items > 0): ?>
                                    <span class="badge rounded-pill cart-count" style="opacity: 1 !important; visibility: visible !important;"><?php echo $total_items; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        
                        <!-- User Menu with Avatar -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                                <?php
                                // Get user's first letter for avatar
                                $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
                                $first_letter = strtoupper(substr($user_name, 0, 1));
                                ?>
                                <div class="user-avatar me-2">
                                    <div class="avatar-circle">
                                        <?php echo $first_letter; ?>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-soft">
                                <li><a class="dropdown-item" href="dashboard.php">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard / My Account
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="auth/logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <!-- Login/Register Buttons -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>" href="auth/login.php" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                                <i class="fas fa-sign-in-alt me-1" style="color: inherit !important; opacity: 1 !important;"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>" href="auth/register.php" style="color: rgba(255, 255, 255, 0.9) !important; opacity: 1 !important; visibility: visible !important;">
                                <i class="fas fa-user-plus me-1" style="color: inherit !important; opacity: 1 !important;"></i>Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show m-0 shadow-soft" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php 
            echo htmlspecialchars($_SESSION['success_message']);
            unset($_SESSION['success_message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0 shadow-soft" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?php 
            echo htmlspecialchars($_SESSION['error_message']);
            unset($_SESSION['error_message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="flex-shrink-0">
