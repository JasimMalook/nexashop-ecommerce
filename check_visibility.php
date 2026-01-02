<?php
// Visibility Diagnostic Script
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Visibility Diagnostic</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
    <!-- Premium CSS -->
    <link href='assets/css/premium-style.css' rel='stylesheet'>
    <!-- Visibility Fix CSS -->
    <link href='assets/css/visibility-fix.css' rel='stylesheet'>
    
    <style>
        .diagnostic-section { margin: 2rem 0; padding: 1.5rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; }
        .status-ok { color: #10b981; font-weight: bold; }
        .status-error { color: #ef4444; font-weight: bold; }
        .debug-border { border: 2px solid red; background: #fffacd; }
        .icon-test { font-size: 1.5rem; margin: 0.5rem; }
    </style>
</head>
<body>
    <div class='container mt-4'>
        <div class='card'>
            <div class='card-header bg-primary text-white'>
                <h2 class='mb-0'><i class='fas fa-stethoscope me-2'></i>Visibility Diagnostic Tool</h2>
            </div>
            <div class='card-body'>
                
                <!-- CSS Loading Check -->
                <div class='diagnostic-section'>
                    <h4><i class='fas fa-code me-2'></i>CSS Files Loading Status</h4>
                    <div id='css-check'>
                        <p>Checking CSS files...</p>
                    </div>
                </div>

                <!-- Font Awesome Check -->
                <div class='diagnostic-section'>
                    <h4><i class='fas fa-font-awesome me-2'></i>Font Awesome Loading Status</h4>
                    <div class='icon-test'>
                        <i class='fas fa-home'></i> Home
                        <i class='fas fa-shopping-bag'></i> Shop
                        <i class='fas fa-shopping-cart'></i> Cart
                        <i class='fas fa-user'></i> User
                        <i class='fas fa-cog'></i> Settings
                    </div>
                    <p id='fa-status'>Checking Font Awesome...</p>
                </div>

                <!-- Headings Visibility Check -->
                <div class='diagnostic-section'>
                    <h4><i class='fas fa-heading me-2'></i>Headings Visibility Check</h4>
                    <h1>Heading 1 Test</h1>
                    <h2>Heading 2 Test</h2>
                    <h3>Heading 3 Test</h3>
                    <h4>Heading 4 Test</h4>
                    <h5>Heading 5 Test</h5>
                    <h6>Heading 6 Test</h6>
                    <h1 class='text-gradient'>Gradient Heading Test</h1>
                    <p id='heading-status'>Checking headings...</p>
                </div>

                <!-- Navbar Simulation -->
                <div class='diagnostic-section'>
                    <h4><i class='fas fa-bars me-2'></i>Navbar Elements Simulation</h4>
                    <nav class='navbar navbar-dark' style='background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); padding: 1rem; border-radius: 0.5rem;'>
                        <div class='d-flex justify-content-between align-items-center w-100'>
                            <div class='navbar-brand'>
                                <i class='fas fa-shopping-bag me-2'></i>
                                eCommerce
                            </div>
                            <div class='d-flex align-items-center'>
                                <a href='#' class='text-white me-3'>
                                    <i class='fas fa-home me-1'></i>Home
                                </a>
                                <a href='#' class='text-white me-3'>
                                    <i class='fas fa-shopping-bag me-1'></i>Shop
                                </a>
                                <div class='position-relative cart-icon-wrapper'>
                                    <i class='fas fa-shopping-cart fa-lg'></i>
                                    <span class='badge bg-warning rounded-pill cart-count'>3</span>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <p id='navbar-status'>Checking navbar...</p>
                </div>

                <!-- Computed Styles Check -->
                <div class='diagnostic-section'>
                    <h4><i class='fas fa-palette me-2'></i>Computed Styles Check</h4>
                    <div id='styles-check'>
                        <p>Checking computed styles...</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    <script>
        // Diagnostic JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            
            // Check CSS files
            const cssCheck = document.getElementById('css-check');
            let cssStatus = '<div class=\"status-ok\">✓ CSS Files Status:</div><ul>';
            
            // Check premium-style.css
            fetch('assets/css/premium-style.css')
                .then(response => {
                    if (response.ok) {
                        cssStatus += '<li class=\"status-ok\">✓ premium-style.css loaded successfully</li>';
                    } else {
                        cssStatus += '<li class=\"status-error\">✗ premium-style.css failed to load</li>';
                    }
                    return fetch('assets/css/visibility-fix.css');
                })
                .then(response => {
                    if (response.ok) {
                        cssStatus += '<li class=\"status-ok\">✓ visibility-fix.css loaded successfully</li>';
                    } else {
                        cssStatus += '<li class=\"status-error\">✗ visibility-fix.css failed to load</li>';
                    }
                    cssStatus += '</ul>';
                    cssCheck.innerHTML = cssStatus;
                })
                .catch(error => {
                    cssCheck.innerHTML = '<div class=\"status-error\">✗ Error checking CSS files: ' + error.message + '</div>';
                });
            
            // Check Font Awesome
            const faStatus = document.getElementById('fa-status');
            const faIcons = document.querySelectorAll('.icon-test i');
            let faVisible = true;
            
            faIcons.forEach(icon => {
                const styles = window.getComputedStyle(icon);
                if (styles.opacity === '0' || styles.visibility === 'hidden' || styles.display === 'none') {
                    faVisible = false;
                }
            });
            
            if (faVisible && faIcons.length > 0) {
                faStatus.innerHTML = '<div class=\"status-ok\">✓ Font Awesome icons are visible</div>';
            } else {
                faStatus.innerHTML = '<div class=\"status-error\">✗ Font Awesome icons are not visible</div>';
            }
            
            // Check headings
            const headingStatus = document.getElementById('heading-status');
            const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
            let headingsVisible = true;
            
            headings.forEach(heading => {
                const styles = window.getComputedStyle(heading);
                if (styles.opacity === '0' || styles.visibility === 'hidden' || styles.display === 'none') {
                    headingsVisible = false;
                }
                if (styles.color === 'transparent' || styles.color === 'rgba(0, 0, 0, 0)') {
                    headingsVisible = false;
                }
            });
            
            if (headingsVisible && headings.length > 0) {
                headingStatus.innerHTML = '<div class=\"status-ok\">✓ All headings are visible</div>';
            } else {
                headingStatus.innerHTML = '<div class=\"status-error\">✗ Some headings are not visible</div>';
            }
            
            // Check navbar elements
            const navbarStatus = document.getElementById('navbar-status');
            const navbarElements = document.querySelectorAll('.navbar i, .navbar .fas, .navbar .fa');
            let navbarVisible = true;
            
            navbarElements.forEach(element => {
                const styles = window.getComputedStyle(element);
                if (styles.opacity === '0' || styles.visibility === 'hidden' || styles.display === 'none') {
                    navbarVisible = false;
                }
            });
            
            if (navbarVisible && navbarElements.length > 0) {
                navbarStatus.innerHTML = '<div class=\"status-ok\">✓ Navbar elements are visible</div>';
            } else {
                navbarStatus.innerHTML = '<div class=\"status-error\">✗ Navbar elements are not visible</div>';
            }
            
            // Check computed styles
            const stylesCheck = document.getElementById('styles-check');
            let stylesHtml = '<div class=\"status-ok\">✓ Computed Styles Analysis:</div><ul>';
            
            // Check a sample heading
            const sampleHeading = document.querySelector('h1');
            if (sampleHeading) {
                const headingStyles = window.getComputedStyle(sampleHeading);
                stylesHtml += '<li><strong>Sample H1:</strong> opacity=' + headingStyles.opacity + ', color=' + headingStyles.color + ', visibility=' + headingStyles.visibility + '</li>';
            }
            
            // Check a sample icon
            const sampleIcon = document.querySelector('.icon-test i');
            if (sampleIcon) {
                const iconStyles = window.getComputedStyle(sampleIcon);
                stylesHtml += '<li><strong>Sample Icon:</strong> opacity=' + iconStyles.opacity + ', visibility=' + iconStyles.visibility + ', display=' + iconStyles.display + '</li>';
            }
            
            stylesHtml += '</ul>';
            stylesCheck.innerHTML = stylesHtml;
            
        });
    </script>
</body>
</html>";
?>
