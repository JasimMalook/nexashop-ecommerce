<?php
// Simple test to verify the path fix
echo "<h1>Path Fix Test</h1>";

// Test the database connection
try {
    require_once __DIR__ . '/config/db.php';
    echo "<p style='color: green;'>✓ Database connection works!</p>";
    
    // Test if mysqli is available
    if (isset($mysqli) && $mysqli->ping()) {
        echo "<p style='color: green;'>✓ MySQLi connection works!</p>";
    } else {
        echo "<p style='color: red;'>✗ MySQLi connection failed!</p>";
    }
    
    // Test if PDO is available
    if (isset($pdo)) {
        echo "<p style='color: green;'>✓ PDO connection works!</p>";
    } else {
        echo "<p style='color: orange;'>⚠ PDO connection not available</p>";
    }
    
    // Test session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    echo "<p style='color: green;'>✓ Session works!</p>";
    
    // Test helper functions
    if (function_exists('isLoggedIn')) {
        echo "<p style='color: green;'>✓ Helper functions available!</p>";
    } else {
        echo "<p style='color: red;'>✗ Helper functions not available!</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h2>Next Steps:</h2>";
echo "<ol>";
echo "<li>Try accessing: <a href='index.php'>Home Page</a></li>";
echo "<li>Try accessing: <a href='shop.php'>Shop Page</a></li>";
echo "<li>Try accessing: <a href='dashboard.php'>Dashboard</a></li>";
echo "</ol>";
?>
