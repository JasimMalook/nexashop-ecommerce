<!-- <?php
// Database configuration
$host = 'localhost';
$dbname = 'ecommerce_db';
$username = 'root';
$password = '';

// Create mysqli connection with proper error handling
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

// Set charset
$mysqli->set_charset("utf8mb4");

// Also keep PDO for existing code
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("PDO connection failed: " . $e->getMessage());
}

// Start session securely
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Helper functions
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

function redirect($url) {
    if (!headers_sent()) {
        header("Location: $url");
    } else {
        echo "<script>window.location.href='$url';</script>";
    }
    exit();
}

function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function generateSecureToken($length = 32) {
    return bin2hex(random_bytes($length));
}

// Function to create admin user if none exists
function ensureAdminExists($mysqli) {
    $check_admin = $mysqli->query("SELECT id FROM users WHERE role = 'admin' LIMIT 1");
    if ($check_admin->num_rows === 0) {
        // Create default admin
        $admin_email = 'admin@admin.com';
        $admin_password = 'admin123';
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
        
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
        $stmt->bind_param("sss", $admin_name, $admin_email, $hashed_password);
        $admin_name = 'Administrator';
        $stmt->execute();
        
        error_log("Default admin user created: admin@admin.com / admin123");
    }
}

// Ensure admin exists on every page load
ensureAdminExists($mysqli);
?> -->
