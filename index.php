<?php
// Set page title
$page_title = "NexaShop - Modern eCommerce Store";

// Include header
require_once 'includes/header.php';

// Function to generate realistic product image URL based on product name and category
function generateProductImage($productName, $categoryName, $productId) {
    $productName = strtolower(trim($productName));
    $categoryName = strtolower(trim($categoryName ?? ''));
    
    // Define realistic product images based on categories
    $productImages = [
        'electronics' => [
            'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=400&fit=crop&auto=format'
        ],
        'books' => [
            'https://images.unsplash.com/photo-1544947950-fa07a98f23e4?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1481627834876-b7833e69f33d?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1532012197267-da84d127e2d1?w=400&h=400&fit=crop&auto=format'
        ],
        'clothing' => [
            'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1434389677669-e08b4cac3105e?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1445205170230-9531a0e4c4c?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1578632262392-c0b3afad1eb2?w=400&h=400&fit=crop&auto=format'
        ],
        'home & garden' => [
            'https://images.unsplash.com/photo-1586023492125-27b2c0458d97?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1560448214-e0f9f8d5a00?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1586034198212-8b2bf0f5b6c?w=400&h=400&fit=crop&auto=format',
            'https://images.unsplash.com/photo-1558628015-3e8b1f7a7b0?w=400&h=400&fit=crop&auto=format'
        ]
    ];
    
    // Select appropriate category
    $imageArray = [];
    if (strpos($categoryName, 'electronic') !== false || strpos($productName, 'phone') !== false || strpos($productName, 'laptop') !== false) {
        $imageArray = $productImages['electronics'];
    } elseif (strpos($categoryName, 'book') !== false || strpos($productName, 'book') !== false) {
        $imageArray = $productImages['books'];
    } elseif (strpos($categoryName, 'clothing') !== false || strpos($productName, 'shirt') !== false || strpos($productName, 'dress') !== false) {
        $imageArray = $productImages['clothing'];
    } else {
        $imageArray = $productImages['home & garden'];
    }
    
    // Use product ID to ensure consistent image for each product
    $imageIndex = $productId % count($imageArray);
    return $imageArray[$imageIndex];
}

// Function to ensure every product has an image
function ensureProductImage(&$product, $productId) {
    // If product already has a generated_image, use it
    if (isset($product['generated_image']) && !empty($product['generated_image'])) {
        return;
    }
    
    // If product has an existing image path, use it
    if (isset($product['image']) && !empty($product['image'])) {
        $product['generated_image'] = 'assets/images/products/' . $product['image'];
        return;
    }
    
    // Generate a fallback image based on product ID
    $fallbackImages = [
        'https://images.unsplash.com/photo-1592878460059-609c8576980?w=400&h=400&fit=crop&auto=format',
        'https://images.unsplash.com/photo-1558628015-3e8b1f7a7b0?w=400&h=400&fit=crop&auto=format',
        'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=400&fit=crop&auto=format',
        'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&h=400&fit=crop&auto=format',
        'https://images.unsplash.com/photo-1544947950-fa07a98f23e4?w=400&h=400&fit=crop&auto=format',
        'https://images.unsplash.com/photo-1586023492125-27b2c0458d97?w=400&h=400&fit=crop&auto=format'
    ];
    
    $fallbackIndex = $productId % count($fallbackImages);
    $product['generated_image'] = $fallbackImages[$fallbackIndex];
}

// Get featured products using PDO
try {
    $stmt = $pdo->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        ORDER BY p.created_at DESC 
        LIMIT 8
    ");
    $stmt->execute();
    $featured_products = [];
    
    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Ensure every product has a realistic image
        ensureProductImage($product, $product['id']);
        $featured_products[] = $product;
    }
} catch (PDOException $e) {
    // Fallback if database fails
    $featured_products = [];
}

// Get categories using mysqli
$categories_result = $mysqli->query("SELECT id, name FROM categories ORDER BY name");
$categories = [];

while ($category = $categories_result->fetch_assoc()) {
    $categories[] = $category;
}
?>

<!-- Hero Section -->
<section class="hero-section text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-in-up">
                <h1 class="display-3 fw-bold mb-4">Welcome to eCommerce Store</h1>
                <p class="lead mb-5">Discover amazing products at unbeatable prices. Shop with confidence and enjoy a seamless shopping experience.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="shop.php" class="btn btn-light btn-lg shadow-soft">
                        <i class="fas fa-shopping-bag me-2"></i>Shop Now
                    </a>
                    <?php if (!isLoggedIn()): ?>
                        <a href="auth/register.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center fade-in-up" style="animation-delay: 0.2s;">
                    <div class="hero-illustration">
                        <i class="fas fa-shopping-cart fa-5x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 mb-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4 slide-in-left">
                <div class="feature-box p-4 rounded-soft shadow-soft">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-truck fa-3x text-primary"></i>
                    </div>
                    <h4>Free Shipping</h4>
                    <p class="text-muted">Free shipping on orders over $100</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 slide-in-left" style="animation-delay: 0.1s;">
                <div class="feature-box p-4 rounded-soft shadow-soft">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-3x text-success"></i>
                    </div>
                    <h4>Secure Payment</h4>
                    <p class="text-muted">100% secure payment process</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 slide-in-left" style="animation-delay: 0.2s;">
                <div class="feature-box p-4 rounded-soft shadow-soft">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-undo fa-3x text-warning"></i>
                    </div>
                    <h4>Easy Returns</h4>
                    <p class="text-muted">30-day return policy</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 mb-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Shop by Category</h2>
            <p class="text-muted">Browse our wide range of products</p>
        </div>
        <div class="row">
            <?php foreach (array_slice($categories, 0, 6) as $category): ?>
                <div class="col-md-4 col-lg-2 mb-4">
                    <a href="shop.php?category=<?php echo $category['id']; ?>" class="text-decoration-none">
                        <div class="card h-100 text-center category-card">
                            <div class="card-body">
                                <i class="fas fa-tag fa-2x text-primary mb-3"></i>
                                <h6 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="shop.php" class="btn btn-primary">
                <i class="fas fa-th me-2"></i>View All Categories
            </a>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5 mb-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Products</h2>
            <p class="text-muted">Check out our latest arrivals</p>
        </div>
        <div class="row">
            <?php foreach ($featured_products as $product): ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 product-card border-0 shadow-sm">
                        <div class="product-image-container overflow-hidden">
                            <img src="<?php echo htmlspecialchars($product['generated_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="card-img-top product-image"
                                 style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                            <?php if ($product['stock'] <= 5): ?>
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
                                    Only <?php echo $product['stock']; ?> left
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body d-flex flex-column p-3">
                            <h5 class="card-title fw-bold mb-2"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text text-muted small mb-3">
                                <?php echo htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?>
                            </p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="product-price h5 fw-bold text-primary mb-0">$<?php echo number_format($product['price'], 2); ?></div>
                                    <?php if (isLoggedIn()): ?>
                                        <button class="btn btn-primary btn-sm shadow-soft px-3 py-2" 
                                                onclick="addToCart(<?php echo $product['id']; ?>)"
                                                style="transition: all 0.2s ease;">
                                            <i class="fas fa-cart-plus me-1"></i>Add
                                        </button>
                                    <?php else: ?>
                                        <a href="auth/login.php" class="btn btn-outline-primary btn-sm px-3 py-2">
                                            <i class="fas fa-sign-in-alt me-1"></i> Login
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <a href="product.php?id=<?php echo $product['id']; ?>" 
                               class="btn btn-outline-secondary btn-sm w-100 text-decoration-none"
                               style="transition: all 0.2s ease;">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="shop.php" class="btn btn-outline-primary btn-lg shadow-soft">
                <i class="fas fa-shopping-bag me-2"></i>View All Products
            </a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5 bg-gradient-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h3 class="fw-bold mb-3">Subscribe to Our Newsletter</h3>
                <p class="mb-0 opacity-90">Get the latest updates on new products and special offers</p>
            </div>
            <div class="col-md-6">
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-light shadow-soft">
                        <i class="fas fa-paper-plane me-2"></i>Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
.feature-box {
    padding: 2rem;
}
.category-card {
    transition: transform 0.3s ease;
}
.category-card:hover {
    transform: translateY(-5px);
}

/* Professional Product Card Styling */
.product-card {
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: white;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    border-color: #d1d5db;
}

.product-image-container {
    position: relative;
    height: 200px;
    overflow: hidden;
    border-radius: 12px 12px 0 0;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover .product-image {
    transform: scale(1.08);
}

.product-card .card-body {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-card .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 0.5rem;
    color: #1a202c;
    transition: color 0.2s ease;
}

.product-card:hover .card-title {
    color: #0d6efd;
}

.product-card .card-text {
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 1rem;
    color: #6c757d;
}

.product-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 0;
}

.product-card .btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    border: none;
    border-radius: 8px;
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2);
}

.product-card .btn-primary:hover {
    background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.product-card .btn-outline-secondary {
    border: 1px solid #dee2e6;
    color: #6c757d;
    border-radius: 8px;
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
    text-decoration: none;
}

.product-card .btn-outline-secondary:hover {
    background-color: #f8f9fa;
    border-color: #adb5bd;
    color: #495057;
    transform: translateY(-1px);
}

.product-card .badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.35rem 0.65rem;
    border-radius: 6px;
}

/* Equal height for product cards */
.row > .col-md-6 > .product-card,
.row > .col-lg-3 > .product-card {
    height: 100%;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .product-card {
        margin-bottom: 1rem;
    }
    
    .product-card .card-body {
        padding: 1rem;
    }
    
    .product-price {
        font-size: 1.1rem;
    }
}
</style>

<?php
// Include footer
require_once 'includes/footer.php';
?>
