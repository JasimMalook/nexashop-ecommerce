<?php
// Admin authentication protection file
require_once 'config/db.php';

// Check if user is logged in
if (!isLoggedIn()) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    redirect('admin/admin_login.php');
}

// Check if user is admin
if (!isAdmin()) {
    // User is logged in but not admin
    $_SESSION['error_message'] = "Access denied. Admin privileges required.";
    redirect('index.php');
}

// Optional: Verify admin status in database
if (isset($_SESSION['user_id'])) {
    $stmt = $mysqli->prepare("SELECT id, role FROM users WHERE id = ? AND role = 'admin'");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        // User is not admin anymore, destroy session
        session_destroy();
        redirect('admin/admin_login.php');
    }
}
?>
