<?php
// ===============================
// DATABASE CONFIG (EZYRO)
// ===============================

$host = 'sql109.ezyro.com';
$dbname = 'ezyro_40859421_nexashop_db';
$username = 'ezyro_40859421';
$password = 'shaolinSfd3$'; // <-- yahan apna vPanel password daalo

// -------------------------------
// MYSQLI CONNECTION
// -------------------------------
$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");

// -------------------------------
// PDO CONNECTION
// -------------------------------
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("PDO connection failed: " . $e->getMessage());
}

// -------------------------------
// SESSION
// -------------------------------
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// -------------------------------
// HELPER FUNCTIONS
// -------------------------------
function isLoggedIn() {
    return isset($_SESSION['user_id']);
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
    exit;
}

function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// -------------------------------
// ENSURE ADMIN EXISTS
// -------------------------------
function ensureAdminExists($mysqli) {
    $result = $mysqli->query("SELECT id FROM users WHERE role='admin' LIMIT 1");

    if ($result && $result->num_rows === 0) {
        $name = 'Administrator';
        $email = 'admin@admin.com';
        $password = password_hash('admin123', PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare(
            "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')"
        );
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
    }
}

ensureAdminExists($mysqli);
?>
