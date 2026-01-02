<?php
require_once '../config/db.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login to remove items from cart']);
    exit;
}

// Handle clear cart action
if (isset($_POST['clear_cart'])) {
    // Clear entire cart
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    unset($_SESSION['cart_total']);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Cart cleared successfully',
        'cart_count' => 0,
        'cart_total' => 0,
        'cart_empty' => true
    ]);
    exit;
}

// Get POST data with validation
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

// Validate product ID
if ($product_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
    exit;
}

// Check if cart exists
if (!isset($_SESSION['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Cart is already empty']);
    exit;
}

// Check if product exists in cart
if (!isset($_SESSION['cart'][$product_id])) {
    echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
    exit;
}

// Get product details for logging
$product_name = $_SESSION['cart'][$product_id]['name'];

// Remove product from cart
unset($_SESSION['cart'][$product_id]);

// Recalculate cart totals
$cart_count = 0;
$cart_total = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
        $cart_total += $item['price'] * $item['quantity'];
    }
}

// Update session totals
$_SESSION['cart_count'] = $cart_count;
$_SESSION['cart_total'] = $cart_total;

// Clear cart if empty
if (empty($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    unset($_SESSION['cart_total']);
}

// Log cart activity
error_log("Product removed from cart by user ID " . $_SESSION['user_id'] . " - Product: $product_name (ID: $product_id)");

echo json_encode([
    'success' => true, 
    'message' => 'Item removed from cart successfully',
    'cart_count' => $cart_count,
    'cart_total' => number_format($cart_total, 2),
    'cart_empty' => empty($_SESSION['cart'])
]);
?>
