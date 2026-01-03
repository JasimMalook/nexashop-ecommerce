<?php
// Cart Helper Functions
// These functions provide cart functionality for dashboard and other pages

/**
 * Get the total number of items in cart
 * @return int Total cart item count
 */
function getCartCount() {
    $count = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
    }
    return $count;
}

/**
 * Get the total cart value
 * @return float Total cart amount
 */
function getCartTotal() {
    $total = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
    }
    return $total;
}

/**
 * Get cart items array
 * @return array Cart items
 */
function getCartItems() {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        return $_SESSION['cart'];
    }
    return [];
}

/**
 * Check if cart is empty
 * @return bool True if cart is empty
 */
function isCartEmpty() {
    return !isset($_SESSION['cart']) || empty($_SESSION['cart']);
}

/**
 * Get cart subtotal (without tax and shipping)
 * @return float Cart subtotal
 */
function getCartSubtotal() {
    return getCartTotal();
}

/**
 * Format currency amount
 * @param float $amount Amount to format
 * @return string Formatted amount
 */
function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}
?>
