<?php
// Set page title
$page_title = "Shop - NexaShop";

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

// Get search query
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$sort = isset($_GET['sort']) ? sanitize($_GET['sort']) : 'name';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 12;
$offset = ($page - 1) * $limit;

// Build query
$where_conditions = [];
$params = [];

if (!empty($search)) {
    $where_conditions[] = "(p.name LIKE ? OR p.description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category_id > 0) {
    $where_conditions[] = "p.category_id = ?";
    $params[] = $category_id;
}

$where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// Sorting
$sort_column = match($sort) {
    'price_low' => 'p.price ASC',
    'price_high' => 'p.price DESC',
    'name' => 'p.name ASC',
    'newest' => 'p.created_at DESC',
    default => 'p.name ASC'
};

// Get products with generated images
try {
    $query = "SELECT p.*, c.name as category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id 
              $where_clause 
              ORDER BY $sort_column 
              LIMIT $limit OFFSET $offset";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Generate realistic images for each product
    foreach ($products as &$product) {
        $product['generated_image'] = generateProductImage($product['name'], $product['category_name'], $product['id']);
    }
    
    // Get total count for pagination
    $count_query = "SELECT COUNT(*) as total 
                   FROM products p 
                   LEFT JOIN categories c ON p.category_id = c.id 
                   $where_clause";
    $count_stmt = $pdo->prepare($count_query);
    $count_stmt->execute($params);
    $total_products = $count_stmt->fetchColumn();
    $total_pages = ceil($total_products / $limit);
    
} catch (PDOException $e) {
    $products = [];
    $total_products = 0;
    $total_pages = 1;
}

// Get categories for filter dropdown
try {
    $categories_stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
    $categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $categories = [];
}
?>

<div class="container my-5">
    <!-- Shop Header -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="fas fa-store me-2"></i>Shop</h2>
            <p class="text-muted">Discover our amazing products</p>
        </div>
        <div class="col-md-6">
            <!-- Search Form -->
            <form method="GET" class="d-flex">
                <input type="hidden" name="category" value="<?php echo $category_id; ?>">
                <input type="hidden" name="sort" value="<?php echo $sort; ?>">
                <input type="text" name="search" class="form-control me-2" 
                       placeholder="Search products..." 
                       value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4 rounded-soft">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-filter me-2"></i>Categories
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="shop.php?search=<?php echo urlencode($search); ?>&sort=<?php echo $sort; ?>" 
                           class="list-group-item list-group-item-action <?php echo $category_id == 0 ? 'active' : ''; ?>">
                            <i class="fas fa-th me-2"></i>All Categories
                        </a>
                        <?php foreach ($categories as $category): ?>
                            <a href="shop.php?category=<?php echo $category['id']; ?>&search=<?php echo urlencode($search); ?>&sort=<?php echo $sort; ?>" 
                               class="list-group-item list-group-item-action <?php echo $category_id == $category['id'] ? 'active' : ''; ?>">
                                <i class="fas fa-tag me-2"></i><?php echo htmlspecialchars($category['name']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Sort Options -->
            <div class="card shadow-sm rounded-soft">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-sort me-2"></i>Sort By
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="shop.php?search=<?php echo urlencode($search); ?>&category=<?php echo $category_id; ?>&sort=name" 
                           class="list-group-item list-group-item-action <?php echo $sort == 'name' ? 'active' : ''; ?>">
                            <i class="fas fa-sort-alpha-down me-2"></i>Name
                        </a>
                        <a href="shop.php?search=<?php echo urlencode($search); ?>&category=<?php echo $category_id; ?>&sort=price_low" 
                           class="list-group-item list-group-item-action <?php echo $sort == 'price_low' ? 'active' : ''; ?>">
                            <i class="fas fa-sort-amount-up me-2"></i>Price: Low to High
                        </a>
                        <a href="shop.php?search=<?php echo urlencode($search); ?>&category=<?php echo $category_id; ?>&sort=price_high" 
                           class="list-group-item list-group-item-action <?php echo $sort == 'price_high' ? 'active' : ''; ?>">>
                            <i class="fas fa-sort-amount-down me-2"></i>Price: High to Low
                        </a>
                        <a href="shop.php?search=<?php echo urlencode($search); ?>&category=<?php echo $category_id; ?>&sort=newest" 
                           class="list-group-item list-group-item-action <?php echo $sort == 'newest' ? 'active' : ''; ?>">
                            <i class="fas fa-clock me-2"></i>Newest First
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <!-- Results Info -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <span class="text-muted">
                        Showing <?php echo count($products); ?> of <?php echo $total_products; ?> products
                    </span>
                </div>
                <?php if (!empty($search)): ?>
                    <div>
                        <span class="badge bg-info">Search: "<?php echo htmlspecialchars($search); ?>"</span>
                        <a href="shop.php" class="btn btn-sm btn-outline-secondary ms-2">Clear</a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (empty($products)): ?>
                <!-- No Products Found -->
                <div class="text-center py-5">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No products found</h4>
                    <p class="text-muted">Try adjusting your search or filters</p>
                    <a href="shop.php" class="btn btn-primary">View All Products</a>
                </div>
            <?php else: ?>
                <!-- Products Grid -->
                <div class="row">
                    <?php foreach ($products as $product): 
                        // Ensure every product has a realistic image
                        ensureProductImage($product, $product['id']);
                    ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                <div class="product-image-container overflow-hidden">
                                    <img src="<?php echo htmlspecialchars($product['generated_image']); ?>" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                         class="card-img-top product-image"
                                         style="height: 200px; object-fit: cover; transition: transform 0.4s ease;">
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
                                    <p class="card-text mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 1.5;">
                                        <?php echo substr(htmlspecialchars($product['description']), 0, 80); ?>...
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

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo $category_id; ?>&sort=<?php echo $sort; ?>">
                                    Previous
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo $category_id; ?>&sort=<?php echo $sort; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&category=<?php echo $category_id; ?>&sort=<?php echo $sort; ?>">
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
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
.row > .col-lg-4 > .product-card {
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
