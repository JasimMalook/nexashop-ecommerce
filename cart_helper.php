<?php
// Cart Helper Functions
require_once __DIR__ . '/config/db.php';

/**
 * Initialize cart session if not exists
 */
function initCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
        $_SESSION['cart_count'] = 0;
        $_SESSION['cart_total'] = 0;
    }
}

/**
 * Get cart items count
 */
function getCartCount() {
    return $_SESSION['cart_count'] ?? 0;
}

/**
 * Get cart total amount
 */
function getCartTotal() {
    return $_SESSION['cart_total'] ?? 0;
}

/**
 * Check if cart is empty
 */
function isCartEmpty() {
    return empty($_SESSION['cart']);
}

/**
 * Recalculate cart totals
 */
function recalculateCartTotals() {
    $cart_count = 0;
    $cart_total = 0;
    
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $cart_count += $item['quantity'];
            $cart_total += $item['price'] * $item['quantity'];
        }
    }
    
    $_SESSION['cart_count'] = $cart_count;
    $_SESSION['cart_total'] = $cart_total;
    
    return [
        'count' => $cart_count,
        'total' => $cart_total
    ];
}

/**
 * Clear cart
 */
function clearCart() {
    unset($_SESSION['cart']);
    unset($_SESSION['cart_count']);
    unset($_SESSION['cart_total']);
}

/**
 * Get cart items for display
 */
function getCartItems() {
    $cart_items = [];
    
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $item) {
            $cart_items[] = [
                'id' => $product_id,
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'image' => $item['image'],
                'stock' => $item['stock'],
                'subtotal' => $item['price'] * $item['quantity']
            ];
        }
    }
    
    return $cart_items;
}

/**
 * Add product to cart
 */
function addToCart($product_id, $quantity = 1) {
    global $mysqli;
    
    $product_id = (int)$product_id;
    $quantity = (int)$quantity;
    
    if ($product_id <= 0 || $quantity <= 0) {
        return ['success' => false, 'message' => 'Invalid product ID or quantity'];
    }
    
    // Get product details
    $stmt = $mysqli->prepare("SELECT id, name, price, stock, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return ['success' => false, 'message' => 'Product not found'];
    }
    
    $product = $result->fetch_assoc();
    
    // Check stock
    if ($product['stock'] < $quantity) {
        return ['success' => false, 'message' => 'Insufficient stock'];
    }
    
    initCart();
    
    // Add to cart or update quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $current_quantity = $_SESSION['cart'][$product_id]['quantity'];
        $new_quantity = $current_quantity + $quantity;
        
        if ($new_quantity > $product['stock']) {
            return ['success' => false, 'message' => 'Cannot add more items. Stock limit reached'];
        }
        
        $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => (float)$product['price'],
            'quantity' => $quantity,
            'image' => $product['image'],
            'stock' => (int)$product['stock']
        ];
    }
    
    recalculateCartTotals();
    
    return ['success' => true, 'message' => 'Product added to cart'];
}

/**
 * Update cart item quantity
 */
function updateCartItem($product_id, $quantity) {
    global $mysqli;
    
    $product_id = (int)$product_id;
    $quantity = (int)$quantity;
    
    if ($product_id <= 0) {
        return ['success' => false, 'message' => 'Invalid product ID'];
    }
    
    if (!isset($_SESSION['cart'][$product_id])) {
        return ['success' => false, 'message' => 'Product not found in cart'];
    }
    
    if ($quantity < 1) {
        // Remove item
        unset($_SESSION['cart'][$product_id]);
        recalculateCartTotals();
        return ['success' => true, 'message' => 'Item removed from cart'];
    }
    
    // Check stock
    $stmt = $mysqli->prepare("SELECT stock FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return ['success' => false, 'message' => 'Product not found'];
    }
    
    $product = $result->fetch_assoc();
    
    if ($quantity > $product['stock']) {
        return ['success' => false, 'message' => 'Only ' . $product['stock'] . ' items available'];
    }
    
    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    recalculateCartTotals();
    
    return ['success' => true, 'message' => 'Cart updated'];
}

/**
 * Remove item from cart
 */
function removeFromCart($product_id) {
    $product_id = (int)$product_id;
    
    if ($product_id <= 0) {
        return ['success' => false, 'message' => 'Invalid product ID'];
    }
    
    if (!isset($_SESSION['cart'][$product_id])) {
        return ['success' => false, 'message' => 'Product not found in cart'];
    }
    
    unset($_SESSION['cart'][$product_id]);
    recalculateCartTotals();
    
    return ['success' => true, 'message' => 'Item removed from cart'];
}
?>
