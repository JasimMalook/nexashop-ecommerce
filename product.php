<?php
require_once 'config/db.php';

// Get product ID
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id === 0) {
    redirect('shop.php');
}

// Get product details
$stmt = $pdo->prepare("
    SELECT p.*, c.name as category_name 
    FROM products p 
    LEFT JOIN categories c ON p.category_id = c.id 
    WHERE p.id = ?
");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    redirect('shop.php');
}

// Get related products (same category)
$stmt = $pdo->prepare("
    SELECT * FROM products 
    WHERE category_id = ? AND id != ? 
    ORDER BY created_at DESC 
    LIMIT 4
");
$stmt->execute([$product['category_id'], $product_id]);
$related_products = $stmt->fetchAll();

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!isLoggedIn()) {
        $_SESSION['error_message'] = "Please login to add products to cart";
        redirect('auth/login.php');
    }
    
    $quantity = (int)$_POST['quantity'];
    if ($quantity > 0 && $quantity <= $product['stock']) {
        // Add to cart logic would go here
        $_SESSION['success_message'] = "Product added to cart!";
        redirect('cart.php');
    } else {
        $error_message = "Invalid quantity or insufficient stock";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - eCommerce Store</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-shopping-bag"></i> eCommerce Store
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auth/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="auth/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auth/register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <div class="d-flex align-items-center">
                    <a href="cart.php" class="btn btn-outline-primary position-relative me-3">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <section class="py-3 bg-white">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                    <li class="breadcrumb-item"><a href="shop.php?category=<?php echo $product['category_id']; ?>"><?php echo htmlspecialchars($product['category_name'] ?? 'No Category'); ?></a></li>
                    <li class="breadcrumb-item active"><?php echo htmlspecialchars($product['name']); ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/600x500" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <h1 class="mb-3"><?php echo htmlspecialchars($product['name']); ?></h1>
                    
                    <div class="mb-3">
                        <span class="badge bg-secondary"><?php echo htmlspecialchars($product['category_name'] ?? 'No Category'); ?></span>
                        <span class="badge bg-<?php echo $product['stock'] > 0 ? 'success' : 'danger'; ?> ms-2">
                            <?php echo $product['stock'] > 0 ? 'In Stock (' . $product['stock'] . ' available)' : 'Out of Stock'; ?>
                        </span>
                    </div>

                    <div class="price mb-4">
                        <h2 class="text-primary">$<?php echo number_format($product['price'], 2); ?></h2>
                    </div>

                    <div class="mb-4">
                        <h5>Description</h5>
                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    </div>

                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success">
                            <?php 
                            echo $_SESSION['success_message'];
                            unset($_SESSION['success_message']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="product.php?id=<?php echo $product_id; ?>">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" 
                                       value="1" min="1" max="<?php echo $product['stock']; ?>" <?php echo $product['stock'] == 0 ? 'disabled' : ''; ?>>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex">
                            <button type="submit" name="add_to_cart" class="btn btn-primary btn-lg" 
                                    <?php echo $product['stock'] == 0 ? 'disabled' : ''; ?>>
                                <i class="fas fa-shopping-cart"></i> 
                                <?php echo $product['stock'] == 0 ? 'Out of Stock' : 'Add to Cart'; ?>
                            </button>
                            <a href="shop.php" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>
                        </div>
                    </form>

                    <!-- Product Features -->
                    <div class="mt-5">
                        <h5>Product Features</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i> High Quality Materials</li>
                            <li><i class="fas fa-check text-success me-2"></i> Fast Shipping</li>
                            <li><i class="fas fa-check text-success me-2"></i> 30-Day Return Policy</li>
                            <li><i class="fas fa-check text-success me-2"></i> Customer Support</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <?php if (count($related_products) > 0): ?>
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Related Products</h2>
            <div class="row">
                <?php foreach ($related_products as $related_product): ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="https://via.placeholder.com/300x250" class="card-img-top" alt="<?php echo htmlspecialchars($related_product['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($related_product['name']); ?></h5>
                                <div class="price">$<?php echo number_format($related_product['price'], 2); ?></div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="badge bg-<?php echo $related_product['stock'] > 0 ? 'success' : 'danger'; ?>">
                                        <?php echo $related_product['stock'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
                                    </span>
                                    <a href="product.php?id=<?php echo $related_product['id']; ?>" class="btn btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>eCommerce Store</h5>
                    <p>Your trusted online shopping destination for quality products and great deals.</p>
                </div>
                <div class="col-md-2">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="auth/login.php">Login</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        <li><a href="shop.php?category=<?php echo $product['category_id']; ?>"><?php echo htmlspecialchars($product['category_name'] ?? 'No Category'); ?></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@ecommerce.com</p>
                    <p>Phone: +1 234 567 8900</p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-white">
            <div class="text-center">
                <p>&copy; 2024 eCommerce Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>
