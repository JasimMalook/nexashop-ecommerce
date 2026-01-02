<?php
require_once '../config/db.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login to update cart']);
    exit;
}

// Get POST data with validation
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : 'update'; // 'update', 'increase', 'decrease'

// Validate product ID
if ($product_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
    exit;
}

// Check if cart exists
if (!isset($_SESSION['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    exit;
}

// Check if product exists in cart
if (!isset($_SESSION['cart'][$product_id])) {
    echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
    exit;
}

// Get current product details from cart
$cart_item = $_SESSION['cart'][$product_id];
$current_quantity = $cart_item['quantity'];

// Handle different actions
switch ($action) {
    case 'increase':
        $new_quantity = $current_quantity + 1;
        break;
    case 'decrease':
        $new_quantity = $current_quantity - 1;
        break;
    case 'update':
    default:
        $new_quantity = $quantity;
        break;
}

// Validate new quantity
if ($new_quantity < 1) {
    // Remove item from cart if quantity is 0 or less
    unset($_SESSION['cart'][$product_id]);
    $message = 'Product removed from cart';
} else {
    // Check stock availability
    $stmt = $mysqli->prepare("SELECT stock FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
        exit;
    }
    
    $product = $result->fetch_assoc();
    
    if ($new_quantity > $product['stock']) {
        echo json_encode(['success' => false, 'message' => 'Only ' . $product['stock'] . ' items available in stock']);
        exit;
    }
    
    // Update quantity in cart
    $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
    $message = 'Cart updated successfully';
}

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

// Log cart activity
error_log("Cart updated by user ID " . $_SESSION['user_id'] . " - Product ID: $product_id, New Quantity: $new_quantity");

echo json_encode([
    'success' => true, 
    'message' => $message,
    'cart_count' => $cart_count,
    'cart_total' => number_format($cart_total, 2),
    'new_quantity' => isset($new_quantity) ? $new_quantity : 0,
    'item_total' => isset($new_quantity) && $new_quantity > 0 ? number_format($cart_item['price'] * $new_quantity, 2) : 0
]);
?>
