<?php
require_once '../config/db.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login to add products to cart']);
    exit;
}

// Get POST data with validation
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Validate input
if ($product_id <= 0 || $quantity <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID or quantity']);
    exit;
}

// Check if product exists and get details
$stmt = $mysqli->prepare("SELECT id, name, price, stock, image FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

$product = $result->fetch_assoc();

// Check stock availability
if ($product['stock'] < $quantity) {
    echo json_encode(['success' => false, 'message' => 'Only ' . $product['stock'] . ' items available in stock']);
    exit;
}

// Initialize cart session if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart or update existing item
if (isset($_SESSION['cart'][$product_id])) {
    // Product exists in cart, update quantity
    $current_quantity = $_SESSION['cart'][$product_id]['quantity'];
    $new_quantity = $current_quantity + $quantity;
    
    // Check if new quantity exceeds stock
    if ($new_quantity > $product['stock']) {
        echo json_encode(['success' => false, 'message' => 'Cannot add more items. Only ' . $product['stock'] . ' available in stock']);
        exit;
    }
    
    // Update quantity
    $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
    
} else {
    // Add new product to cart with full details
    $_SESSION['cart'][$product_id] = [
        'name' => $product['name'],
        'price' => (float)$product['price'],
        'quantity' => $quantity,
        'image' => $product['image'],
        'stock' => (int)$product['stock']
    ];
}

// Calculate cart totals
$cart_count = 0;
$cart_total = 0;

foreach ($_SESSION['cart'] as $item) {
    $cart_count += $item['quantity'];
    $cart_total += $item['price'] * $item['quantity'];
}

// Store cart totals in session for easy access
$_SESSION['cart_count'] = $cart_count;
$_SESSION['cart_total'] = $cart_total;

// Log cart activity
error_log("Product ID $product_id added to cart by user ID " . $_SESSION['user_id'] . " - Quantity: $quantity");

echo json_encode([
    'success' => true, 
    'message' => 'Product added to cart successfully',
    'cart_count' => $cart_count,
    'cart_total' => number_format($cart_total, 2),
    'product_name' => $product['name']
]);
?>
