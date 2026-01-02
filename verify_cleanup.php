<?php
// Verify Duplicate Content Cleanup
echo "<!DOCTYPE html>
<html>
<head>
    <title>Duplicate Content Cleanup Verification</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body { background: #f8f9fa; }
        .container { max-width: 1000px; margin-top: 50px; }
        .card { border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 15px; }
        .card-header { border-radius: 15px 15px 0 0 !important; }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        .warning { color: #ffc107; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='card'>
            <div class='card-header bg-success text-white'>
                <h3><i class='fas fa-broom me-2'></i>Duplicate Content Cleanup Verification</h3>
            </div>
            <div class='card-body'>";

$pages_to_check = [
    'index.php' => 'Home Page',
    'shop.php' => 'Shop Page', 
    'cart.php' => 'Cart Page',
    'checkout.php' => 'Checkout Page'
];

$all_clean = true;

echo "<h4><i class='fas fa-search me-2'></i>Scanning Pages for Duplicate Content</h4>";

foreach ($pages_to_check as $file => $name) {
    echo "<div class='card bg-light mb-3'>";
    echo "<div class='card-body'>";
    echo "<h6><i class='fas fa-file me-2'></i>" . htmlspecialchars($name) . " (" . htmlspecialchars($file) . ")</h6>";
    
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Check for multiple DOCTYPE declarations
        $doctype_count = substr_count($content, '<!DOCTYPE html');
        if ($doctype_count > 1) {
            echo "<p class='error'>✗ Multiple DOCTYPE declarations found: $doctype_count</p>";
            $all_clean = false;
        } else {
            echo "<p class='success'>✓ Single DOCTYPE declaration</p>";
        }
        
        // Check for multiple html tags
        $html_tag_count = substr_count($content, '<html');
        if ($html_tag_count > 1) {
            echo "<p class='error'>✗ Multiple <html> tags found: $html_tag_count</p>";
            $all_clean = false;
        } else {
            echo "<p class='success'>✓ Single <html> tag</p>";
        }
        
        // Check for multiple head tags
        $head_tag_count = substr_count($content, '<head');
        if ($head_tag_count > 1) {
            echo "<p class='error'>✗ Multiple <head> tags found: $head_tag_count</p>";
            $all_clean = false;
        } else {
            echo "<p class='success'>✓ Single <head> tag</p>";
        }
        
        // Check for multiple body tags
        $body_tag_count = substr_count($content, '<body');
        if ($body_tag_count > 1) {
            echo "<p class='error'>✗ Multiple <body> tags found: $body_tag_count</p>";
            $all_clean = false;
        } else {
            echo "<p class='success'>✓ Single <body> tag</p>";
        }
        
        // Check for multiple closing body/html tags
        $closing_html_count = substr_count($content, '</html>');
        if ($closing_html_count > 1) {
            echo "<p class='error'>✗ Multiple </html> tags found: $closing_html_count</p>";
            $all_clean = false;
        } else {
            echo "<p class='success'>✓ Single </html> tag</p>";
        }
        
        // Check if footer is included only once
        $footer_include_count = substr_count($content, "require_once 'includes/footer.php'");
        if ($footer_include_count > 1) {
            echo "<p class='error'>✗ Multiple footer includes found: $footer_include_count</p>";
            $all_clean = false;
        } elseif ($footer_include_count == 1) {
            echo "<p class='success'>✓ Single footer include</p>";
        } else {
            echo "<p class='warning'>⚠ No footer include found</p>";
        }
        
        // Check for content after footer include
        if (preg_match("/require_once 'includes\/footer\.php';\?\>\s*.*$/s", $content)) {
            echo "<p class='error'>✗ Content found after footer include</p>";
            $all_clean = false;
        } else {
            echo "<p class='success'>✓ No content after footer include</p>";
        }
        
        // Check file size (should be reasonable)
        $file_size = filesize($file);
        echo "<p class='text-muted'>File size: " . number_format($file_size) . " bytes</p>";
        
    } else {
        echo "<p class='error'>✗ File not found</p>";
        $all_clean = false;
    }
    
    echo "</div>";
    echo "</div>";
}

echo "<hr>";

if ($all_clean) {
    echo "<div class='alert alert-success'>";
    echo "<h5><i class='fas fa-check-circle me-2'></i>Cleanup Verification PASSED!</h5>";
    echo "<p class='mb-0'>All pages have been successfully cleaned of duplicate content.</p>";
    echo "</div>";
} else {
    echo "<div class='alert alert-warning'>";
    echo "<h5><i class='fas fa-exclamation-triangle me-2'></i>Cleanup Issues Found</h5>";
    echo "<p class='mb-0'>Some pages still have duplicate content that needs to be addressed.</p>";
    echo "</div>";
}

echo "<h4><i class='fas fa-info-circle me-2'></i>What Was Cleaned</h4>";
echo "<ul>";
echo "<li><strong>index.php:</strong> Removed duplicate navbar, hero section, and footer HTML</li>";
echo "<li><strong>shop.php:</strong> Removed complete duplicate HTML structure after footer</li>";
echo "<li><strong>cart.php:</strong> Removed duplicate navbar and cart content</li>";
echo "<li><strong>checkout.php:</strong> Recreated clean version with proper structure</li>";
echo "</ul>";

echo "<h4><i class='fas fa-check me-2'></i>Standardized Structure</h4>";
echo "<p>All pages now follow this structure:</p>";
echo "<pre><code>&lt;?php
// Set page title
\$page_title = 'Page Title';

// Include header
require_once 'includes/header.php';

// Page content here
?&gt;

&lt;!-- Main page content --&gt;

&lt;?php
// Include footer
require_once 'includes/footer.php';
?&gt;</code></pre>";

echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end mt-4'>";
echo "<a href='index.php' class='btn btn-primary'>";
echo "<i class='fas fa-home me-2'></i>Test Home Page";
echo "</a>";
echo "<a href='shop.php' class='btn btn-outline-primary'>";
echo "<i class='fas fa-shopping-bag me-2'></i>Test Shop Page";
echo "</a>";
echo "<a href='cart.php' class='btn btn-outline-primary'>";
echo "<i class='fas fa-shopping-cart me-2'></i>Test Cart Page";
echo "</a>";
echo "<a href='checkout.php' class='btn btn-outline-primary'>";
echo "<i class='fas fa-credit-card me-2'></i>Test Checkout";
echo "</a>";
echo "</div>";

echo "</div>
        </div>
    </div>
</body>
</html>";
?>
