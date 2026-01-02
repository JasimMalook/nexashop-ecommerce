<?php
// Set page title
$page_title = "Shipping Information - eCommerce Store";

// Include header
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h2 class="mb-0">
                        <i class="fas fa-shipping-fast me-2"></i>Shipping Information
                    </h2>
                </div>
                <div class="card-body">
                    <p class="lead">We offer reliable and affordable shipping options to get your orders to you quickly and safely.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Shipping Options -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-truck me-2"></i>Shipping Options
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card border-primary h-100">
                                <div class="card-body text-center">
                                    <div class="text-primary mb-3">
                                        <i class="fas fa-shipping-fast fa-2x"></i>
                                    </div>
                                    <h5 class="card-title">Express Shipping</h5>
                                    <p class="text-muted">2-3 business days</p>
                                    <h4 class="text-primary">$15.99</h4>
                                    <ul class="list-unstyled text-start small mt-3">
                                        <li><i class="fas fa-check text-success me-2"></i>Fast delivery</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Tracking included</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Priority handling</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <div class="text-success mb-3">
                                        <i class="fas fa-box fa-2x"></i>
                                    </div>
                                    <h5 class="card-title">Standard Shipping</h5>
                                    <p class="text-muted">5-7 business days</p>
                                    <h4 class="text-success">$7.99</h4>
                                    <ul class="list-unstyled text-start small mt-3">
                                        <li><i class="fas fa-check text-success me-2"></i>Reliable delivery</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Tracking included</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Great value</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card border-info h-100">
                                <div class="card-body text-center">
                                    <div class="text-info mb-3">
                                        <i class="fas fa-globe fa-2x"></i>
                                    </div>
                                    <h5 class="card-title">International</h5>
                                    <p class="text-muted">10-15 business days</p>
                                    <h4 class="text-info">$24.99</h4>
                                    <ul class="list-unstyled text-start small mt-3">
                                        <li><i class="fas fa-check text-success me-2"></i>Worldwide delivery</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Customs handling</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Tracking included</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Processing Times -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-clock me-2"></i>Order Processing Times
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">In-Stock Items</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Processed within 1-2 business days</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Shipped from our warehouse</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Immediate tracking updates</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Custom/Pre-Order Items</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Processing time varies (3-7 days)</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Shipped when ready</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Estimated delivery provided</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Shipping Restrictions -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Shipping Restrictions
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-warning mb-3">Items We Cannot Ship</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-times-circle text-danger me-2"></i>Hazardous materials</li>
                                <li class="mb-2"><i class="fas fa-times-circle text-danger me-2"></i>Perishable goods</li>
                                <li class="mb-2"><i class="fas fa-times-circle text-danger me-2"></i>Oversized items (>100 lbs)</li>
                                <li class="mb-2"><i class="fas fa-times-circle text-danger me-2"></i>Restricted items by law</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-warning mb-3">International Restrictions</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-globe text-info me-2"></i>Some countries have restrictions</li>
                                <li class="mb-2"><i class="fas fa-globe text-info me-2"></i>Customs fees may apply</li>
                                <li class="mb-2"><i class="fas fa-globe text-info me-2"></i>Import duties customer responsibility</li>
                                <li class="mb-2"><i class="fas fa-globe text-info me-2"></i>Check local regulations</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Package Tracking -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-search me-2"></i>Track Your Package
                    </h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="tracking" class="form-label">Tracking Number</label>
                            <input type="text" class="form-control" id="tracking" placeholder="Enter tracking number">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Track Package
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Shipping Tips -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Shipping Tips
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Double-check address</strong> before placing order
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Provide phone number</strong> for delivery updates
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Track your package</strong> for real-time updates
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Consider insurance</strong> for valuable items
                        </li>
                        <li>
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Sign up for alerts</strong> to stay informed
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Contact Support -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-headset me-2"></i>Need Help?
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Have questions about shipping? Our support team is here to help.</p>
                    <div class="d-grid gap-2">
                        <a href="contact.php" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Contact Support
                        </a>
                        <a href="faq.php" class="btn btn-outline-secondary">
                            <i class="fas fa-question-circle me-2"></i>View FAQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
