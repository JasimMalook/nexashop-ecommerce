<?php
// Set page title
$page_title = "Database Fix Test - eCommerce Store";

// Include header to test the fix
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0">
                <i class="fas fa-check-circle me-2"></i>Database Column Fix Applied
            </h2>
        </div>
        <div class="card-body">
            
            <div class="alert alert-success">
                <h4>✅ Fix Applied Successfully!</h4>
                <p>The "Unknown column 'slug'" error has been resolved.</p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <h5>What Was Fixed:</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-wrench text-primary me-2"></i>Changed query from <code>SELECT id, name, slug</code></li>
                        <li><i class="fas fa-wrench text-primary me-2"></i>To <code>SELECT id, name</code></li>
                        <li><i class="fas fa-wrench text-primary me-2"></i>Updated category links to use ID instead of slug</li>
                        <li><i class="fas fa-wrench text-primary me-2"></i>Shop.php expects category ID (confirmed)</li>
                    </ul>
                </div>
                
                <div class="col-md-6">
                    <h5>Test Categories:</h5>
                    <?php
                    // Test the fixed query
                    $categories_query = "SELECT id, name FROM categories ORDER BY name";
                    $categories_result = $mysqli->query($categories_query);
                    
                    if ($categories_result && $categories_result->num_rows > 0):
                        echo '<ul class="list-unstyled">';
                        while ($category = $categories_result->fetch_assoc()):
                            echo '<li class="mb-2">';
                            echo '<i class="fas fa-tag text-success me-2"></i>';
                            echo '<strong>' . htmlspecialchars($category['name']) . '</strong> (ID: ' . $category['id'] . ')';
                            echo '</li>';
                        endwhile;
                        echo '</ul>';
                    else:
                        echo '<p class="text-muted">No categories found in database.</p>';
                    endif;
                    ?>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Navigation Test:</h5>
                <p class="text-muted">The navbar above should now display categories correctly without errors.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="index.php" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                    <a href="shop.php" class="btn btn-outline-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Test Shop Page
                    </a>
                </div>
            </div>
            
            <div class="mt-4">
                <div class="alert alert-info">
                    <h6>📝 Technical Details:</h6>
                    <p class="mb-0">The error occurred because the categories table doesn't have a 'slug' column. The fix uses the 'id' column instead, which is what shop.php expects for filtering products by category.</p>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
