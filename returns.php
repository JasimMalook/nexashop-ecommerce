<?php
// Set page title
$page_title = "Returns & Exchanges - eCommerce Store";

// Include header
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h2 class="mb-0">
                        <i class="fas fa-undo me-2"></i>Returns & Exchanges
                    </h2>
                </div>
                <div class="card-body">
                    <p class="lead">We want you to be completely satisfied with your purchase. Learn about our hassle-free return and exchange policy.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Return Policy -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-file-contract me-2"></i>Our Return Policy
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-check-circle me-2"></i>30-Day Return Window
                                </h6>
                                <p class="text-muted">Return any unused item within 30 days of delivery for a full refund.</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-check-circle me-2"></i>Original Condition Required
                                </h6>
                                <p class="text-muted">Items must be unworn, unwashed, and in original packaging with tags attached.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-check-circle me-2"></i>Free Return Shipping
                                </h6>
                                <p class="text-muted">We provide a prepaid return label for all qualifying returns.</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-check-circle me-2"></i>Quick Refunds
                                </h6>
                                <p class="text-muted">Refunds are processed within 5-7 business days after we receive your return.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- How to Return -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-list-ol me-2"></i>How to Return an Item
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Initiate Return</div>
                                        Log into your account and go to "Order History" to start the return process.
                                    </div>
                                    <span class="badge bg-primary rounded-pill">Step 1</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Select Items</div>
                                        Choose which items you want to return and the reason for return.
                                    </div>
                                    <span class="badge bg-primary rounded-pill">Step 2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Print Return Label</div>
                                        We'll email you a prepaid return shipping label to print.
                                    </div>
                                    <span class="badge bg-primary rounded-pill">Step 3</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Package & Ship</div>
                                        Pack items securely and attach the return label. Drop off at any shipping location.
                                    </div>
                                    <span class="badge bg-primary rounded-pill">Step 4</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Receive Refund</div>
                                        Once we receive and inspect your return, we'll process your refund.
                                    </div>
                                    <span class="badge bg-primary rounded-pill">Step 5</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Exchange Process -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-exchange-alt me-2"></i>Exchange Process
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Exchanges are easy!</strong> Follow the same return process, but select "Exchange" and choose your preferred size/color.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-success mb-3">Exchange Benefits</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>No restocking fees</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Free exchange shipping</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Priority processing</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Size/color flexibility</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-warning mb-3">Exchange Guidelines</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Same item, different size/color</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Price differences handled automatically</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Stock availability dependent</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>30-day exchange window</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Non-Returnable Items -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Non-Returnable Items
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-danger mb-3">Cannot Be Returned</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Final sale items</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Personalized items</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Intimate apparel</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Perishable goods</li>
                                <li class="mb-2"><i class="fas fa-times text-danger me-2"></i>Gift cards</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-warning mb-3">Special Conditions</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Custom orders (case by case)</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Damaged items (contact support)</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Wrong items (free replacement)</li>
                                <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Manufacturing defects (warranty)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Return -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-rocket me-2"></i>Quick Return
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Have your order number ready to start a quick return.</p>
                    <form>
                        <div class="mb-3">
                            <label for="orderNumber" class="form-label">Order Number</label>
                            <input type="text" class="form-control" id="orderNumber" placeholder="e.g., #12345">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="your@email.com">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Find Order
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Return Status -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-truck me-2"></i>Track Return
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Check the status of your return shipment.</p>
                    <form>
                        <div class="mb-3">
                            <label for="returnTracking" class="form-label">Return Tracking Number</label>
                            <input type="text" class="form-control" id="returnTracking" placeholder="Enter tracking number">
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="fas fa-search me-2"></i>Track Return
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Contact Support -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>Return Questions?
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Our customer service team is here to help with any return questions.</p>
                    <div class="d-grid gap-2">
                        <a href="contact.php" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Email Support
                        </a>
                        <a href="tel:1-555-123-4567" class="btn btn-outline-secondary">
                            <i class="fas fa-phone me-2"></i>Call Support
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Return Tips -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Return Tips
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Keep original packaging</strong> for easy returns
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Try items carefully</strong> to avoid damage
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Take photos</strong> if items arrive damaged
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Return promptly</strong> within 30 days
                        </li>
                        <li>
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Use provided label</strong> for free shipping
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
