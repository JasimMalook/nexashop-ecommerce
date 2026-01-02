<?php
// Authentication protection file
require_once 'config/db.php';

// Check if user is logged in
if (!isLoggedIn()) {
    // Store the requested URL for redirect after login
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login page
    redirect('auth/login.php');
}

// Optional: Check if session is still valid
if (isset($_SESSION['user_id'])) {
    // Verify user still exists in database
    $stmt = $mysqli->prepare("SELECT id, role FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        // User no longer exists, destroy session
        session_destroy();
        redirect('auth/login.php');
    }
}
?>
