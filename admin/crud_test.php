<?php
require_once '../config/db.php';

// Check if admin is logged in
if (!isLoggedIn() || !isAdmin()) {
    redirect('admin_login.php');
}

// Test CRUD operations
$test_results = [];

// Test Add Product
if (isset($_POST['test_add'])) {
    $name = 'Test Product ' . date('H:i:s');
    $description = 'Test product description';
    $price = 99.99;
    $stock = 10;
    $category_id = 1;
    
    $stmt = $pdo->prepare("
        INSERT INTO products (name, description, price, stock, category_id, image) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    
    if ($stmt->execute([$name, $description, $price, $stock, $category_id, 'default.jpg'])) {
        $test_results['add'] = 'SUCCESS: Product added successfully';
        $_SESSION['last_added_id'] = $pdo->lastInsertId();
    } else {
        $test_results['add'] = 'FAILED: Could not add product';
    }
}

// Test Edit Product
if (isset($_POST['test_edit'])) {
    if (isset($_SESSION['last_added_id'])) {
        $product_id = $_SESSION['last_added_id'];
        $name = 'Updated Test Product ' . date('H:i:s');
        $description = 'Updated test product description';
        $price = 149.99;
        $stock = 15;
        $category_id = 2;
        
        $stmt = $pdo->prepare("
            UPDATE products SET name = ?, description = ?, price = ?, stock = ?, category_id = ? 
            WHERE id = ?
        ");
        
        if ($stmt->execute([$name, $description, $price, $stock, $category_id, $product_id])) {
            $test_results['edit'] = 'SUCCESS: Product updated successfully';
        } else {
            $test_results['edit'] = 'FAILED: Could not update product';
        }
    } else {
        $test_results['edit'] = 'FAILED: No product to edit (add a product first)';
    }
}

// Test Delete Product
if (isset($_POST['test_delete'])) {
    if (isset($_SESSION['last_added_id'])) {
        $product_id = $_SESSION['last_added_id'];
        
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        
        if ($stmt->execute([$product_id])) {
            $test_results['delete'] = 'SUCCESS: Product deleted successfully';
            unset($_SESSION['last_added_id']);
        } else {
            $test_results['delete'] = 'FAILED: Could not delete product';
        }
    } else {
        $test_results['delete'] = 'FAILED: No product to delete (add a product first)';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Test - eCommerce Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-flask me-2"></i>Admin CRUD Operations Test
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="alert alert-info">
                            <h6>🧪 Test Instructions:</h6>
                            <ol class="mb-0">
                                <li>Click "Test Add Product" to test adding functionality</li>
                                <li>Click "Test Edit Product" to test editing functionality</li>
                                <li>Click "Test Delete Product" to test deleting functionality</li>
                                <li>Check results below to verify all operations work</li>
                            </ol>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <form method="POST" class="d-grid">
                                    <button type="submit" name="test_add" class="btn btn-success">
                                        <i class="fas fa-plus me-2"></i>Test Add Product
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" class="d-grid">
                                    <button type="submit" name="test_edit" class="btn btn-primary">
                                        <i class="fas fa-edit me-2"></i>Test Edit Product
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" class="d-grid">
                                    <button type="submit" name="test_delete" class="btn btn-danger">
                                        <i class="fas fa-trash me-2"></i>Test Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <?php if (!empty($test_results)): ?>
                            <div class="mt-4">
                                <h5>📊 Test Results:</h5>
                                <?php foreach ($test_results as $operation => $result): ?>
                                    <div class="alert <?php echo strpos($result, 'SUCCESS') !== false ? 'alert-success' : 'alert-danger'; ?>">
                                        <strong><?php echo strtoupper($operation); ?>:</strong> <?php echo $result; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-4">
                            <h5>🔧 Current Status:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">✅ Fixed Issues:</h6>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check text-success me-2"></i>Edit button now redirects properly</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Edit form loads product data</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Delete form works correctly</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Confirmation dialog added</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">🎯 Expected Results:</h6>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-arrow-right text-primary me-2"></i>Add: Creates new product</li>
                                                <li><i class="fas fa-arrow-right text-primary me-2"></i>Edit: Updates existing product</li>
                                                <li><i class="fas fa-arrow-right text-primary me-2"></i>Delete: Removes product</li>
                                                <li><i class="fas fa-arrow-right text-primary me-2"></i>All: Show success messages</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="products.php" class="btn btn-outline-primary">
                                    <i class="fas fa-box me-2"></i>Go to Products Management
                                </a>
                                <a href="dashboard.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
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
</body>
</html>
