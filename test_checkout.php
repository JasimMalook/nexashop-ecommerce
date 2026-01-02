<?php
// Test checkout page fix
echo "<h1>Checkout Page Test</h1>";

// Test database connection
try {
    require_once __DIR__ . '/config/db.php';
    echo "<p style='color: green;'>✓ Database connection works!</p>";
    
    // Test users table structure
    $result = $mysqli->query("DESCRIBE users");
    $columns = [];
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
    
    echo "<h3>Users Table Columns:</h3>";
    echo "<ul>";
    foreach ($columns as $column) {
        echo "<li style='color: blue;'>$column</li>";
    }
    echo "</ul>";
    
    // Test if required columns exist
    $required_columns = ['id', 'name', 'email', 'password', 'role', 'created_at'];
    $missing_columns = [];
    
    foreach ($required_columns as $col) {
        if (!in_array($col, $columns)) {
            $missing_columns[] = $col;
        }
    }
    
    if (empty($missing_columns)) {
        echo "<p style='color: green;'>✓ All required columns exist in users table!</p>";
    } else {
        echo "<p style='color: red;'>✗ Missing columns: " . implode(', ', $missing_columns) . "</p>";
    }
    
    // Test if user exists
    $stmt = $mysqli->prepare("SELECT id, name, email FROM users WHERE role = 'user' LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<p style='color: green;'>✓ Test user found: " . htmlspecialchars($user['name']) . " (" . htmlspecialchars($user['email']) . ")</p>";
    } else {
        echo "<p style='color: orange;'>⚠ No users found in database</p>";
    }
    
    // Test checkout page access
    echo "<h3>Test Checkout Page:</h3>";
    echo "<p><a href='checkout.php' target='_blank'>Open Checkout Page</a></p>";
    
    echo "<hr>";
    echo "<h2>What was fixed:</h2>";
    echo "<ul>";
    echo "<li>✓ Fixed database query to only use existing columns</li>";
    echo "<li>✓ Removed references to non-existent columns (phone, address, city, state, zip)</li>";
    echo "<li>✓ Form fields now work with empty values instead of trying to pre-fill from database</li>";
    echo "<li>✓ Checkout page should now load without database errors</li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}
?>
