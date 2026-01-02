<?php
// Global Cart Count Display
// This file handles the cart count badge display

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Calculate total items in cart
$total_items = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_items += $item['quantity'];
    }
}

// Store in session for easy access
$_SESSION['cart_count'] = $total_items;

// Display cart count badge
if ($total_items > 0) {
    echo '<span class="badge bg-danger rounded-pill cart-count">' . $total_items . '</span>';
} else {
    echo '<span class="badge bg-secondary rounded-pill cart-count" style="display: none;">0</span>';
}
?>
