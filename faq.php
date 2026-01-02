<?php
// Set page title
$page_title = "Frequently Asked Questions - eCommerce Store";

// Include header
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h2 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>Frequently Asked Questions
                    </h2>
                </div>
                <div class="card-body">
                    <p class="lead">Find answers to common questions about our products, services, and policies.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Main FAQ Content -->
        <div class="col-lg-8">
            <!-- Orders & Shopping -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-shopping-cart me-2"></i>Orders & Shopping
                    </h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="ordersAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#order1">
                                    How do I place an order?
                                </button>
                            </h2>
                            <div id="order1" class="accordion-collapse collapse show" data-bs-parent="#ordersAccordion">
                                <div class="accordion-body">
                                    Placing an order is easy! Browse our products, select your items, choose size/color options, add to cart, and proceed to checkout. You'll need to create an account or checkout as guest.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order2">
                                    Can I modify or cancel my order?
                                </button>
                            </h2>
                            <div id="order2" class="accordion-collapse collapse" data-bs-parent="#ordersAccordion">
                                <div class="accordion-body">
                                    You can modify or cancel your order within 2 hours of placing it. After that, the order enters our processing system and cannot be changed. Contact customer service immediately if you need assistance.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order3">
                                    How do I track my order?
                                </button>
                            </h2>
                            <div id="order3" class="accordion-collapse collapse" data-bs-parent="#ordersAccordion">
                                <div class="accordion-body">
                                    Once your order ships, you'll receive an email with a tracking number. You can also track your order by logging into your account and viewing "Order History" or use our track package feature.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order4">
                                    What payment methods do you accept?
                                </button>
                            </h2>
                            <div id="order4" class="accordion-collapse collapse" data-bs-parent="#ordersAccordion">
                                <div class="accordion-body">
                                    We accept all major credit cards (Visa, MasterCard, American Express, Discover), PayPal, Apple Pay, Google Pay, and buy now, pay later options like Afterpay and Klarna.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Shipping & Delivery -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-shipping-fast me-2"></i>Shipping & Delivery
                    </h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="shippingAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ship1">
                                    What are your shipping options?
                                </button>
                            </h2>
                            <div id="ship1" class="accordion-collapse collapse show" data-bs-parent="#shippingAccordion">
                                <div class="accordion-body">
                                    We offer Express (2-3 days), Standard (5-7 days), and International (10-15 days) shipping. Express shipping costs $15.99, Standard is $7.99, and International is $24.99.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ship2">
                                    Do you offer free shipping?
                                </button>
                            </h2>
                            <div id="ship2" class="accordion-collapse collapse" data-bs-parent="#shippingAccordion">
                                <div class="accordion-body">
                                    Yes! We offer free standard shipping on all orders over $50. You can also get free express shipping on orders over $100.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ship3">
                                    How long does order processing take?
                                </button>
                            </h2>
                            <div id="ship3" class="accordion-collapse collapse" data-bs-parent="#shippingAccordion">
                                <div class="accordion-body">
                                    In-stock items typically process within 1-2 business days. Custom or pre-order items may take 3-7 business days to process before shipping.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ship4">
                                    Do you ship internationally?
                                </button>
                            </h2>
                            <div id="ship4" class="accordion-collapse collapse" data-bs-parent="#shippingAccordion">
                                <div class="accordion-body">
                                    Yes, we ship to most countries worldwide. International shipping times and costs vary by destination. Please note that customs fees may apply.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Returns & Exchanges -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-undo me-2"></i>Returns & Exchanges
                    </h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="returnsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#return1">
                                    What is your return policy?
                                </button>
                            </h2>
                            <div id="return1" class="accordion-collapse collapse show" data-bs-parent="#returnsAccordion">
                                <div class="accordion-body">
                                    We offer a 30-day return policy for unused items in original condition. Returns are free with a prepaid label, and refunds are processed within 5-7 business days.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#return2">
                                    How do I initiate a return?
                                </button>
                            </h2>
                            <div id="return2" class="accordion-collapse collapse" data-bs-parent="#returnsAccordion">
                                <div class="accordion-body">
                                    Log into your account, go to "Order History," select the order, and click "Return Item." Follow the prompts to select items and reason, then print the prepaid return label.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#return3">
                                    Can I exchange for a different size?
                                </button>
                            </h2>
                            <div id="return3" class="accordion-collapse collapse" data-bs-parent="#returnsAccordion">
                                <div class="accordion-body">
                                    Yes! Exchanges are easy. Select "Exchange" instead of return and choose your preferred size or color. We'll send the new item once we receive the original.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#return4">
                                    What items cannot be returned?
                                </button>
                            </h2>
                            <div id="return4" class="accordion-collapse collapse" data-bs-parent="#returnsAccordion">
                                <div class="accordion-body">
                                    Final sale items, personalized products, intimate apparel, perishable goods, and gift cards cannot be returned. Custom orders are evaluated case by case.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Account & Security -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-shield me-2"></i>Account & Security
                    </h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accountAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#account1">
                                    How do I create an account?
                                </button>
                            </h2>
                            <div id="account1" class="accordion-collapse collapse show" data-bs-parent="#accountAccordion">
                                <div class="accordion-body">
                                    Click "Register" in the top navigation, fill in your details including name, email, and password. You'll receive a confirmation email to verify your account.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account2">
                                    Is my payment information secure?
                                </button>
                            </h2>
                            <div id="account2" class="accordion-collapse collapse" data-bs-parent="#accountAccordion">
                                <div class="accordion-body">
                                    Absolutely! We use industry-standard SSL encryption and never store your payment details. All transactions are processed through secure payment gateways.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account3">
                                    How do I reset my password?
                                </button>
                            </h2>
                            <div id="account3" class="accordion-collapse collapse" data-bs-parent="#accountAccordion">
                                <div class="accordion-body">
                                    Click "Login" then "Forgot Password." Enter your email address, and we'll send you a secure link to reset your password. The link expires after 24 hours.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#account4">
                                    Can I change my email address?
                                </button>
                            </h2>
                            <div id="account4" class="accordion-collapse collapse" data-bs-parent="#accountAccordion">
                                <div class="accordion-body">
                                    Yes, you can update your email address in your account settings. You'll need to verify the new email address before it becomes active.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Search -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-search me-2"></i>Search FAQ
                    </h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Search for answers...">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Popular Topics -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-fire me-2"></i>Popular Topics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#ordersAccordion" class="btn btn-outline-primary text-start">
                            <i class="fas fa-shopping-cart me-2"></i>Order Tracking
                        </a>
                        <a href="#returnsAccordion" class="btn btn-outline-primary text-start">
                            <i class="fas fa-undo me-2"></i>Returns & Refunds
                        </a>
                        <a href="#shippingAccordion" class="btn btn-outline-primary text-start">
                            <i class="fas fa-shipping-fast me-2"></i>Shipping Info
                        </a>
                        <a href="#accountAccordion" class="btn btn-outline-primary text-start">
                            <i class="fas fa-user me-2"></i>Account Help
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Support -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-headset me-2"></i>Still Need Help?
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Can't find what you're looking for? Our support team is here to help.</p>
                    <div class="d-grid gap-2">
                        <a href="contact.php" class="btn btn-primary">
                            <i class="fas fa-envelope me-2"></i>Contact Support
                        </a>
                        <a href="tel:1-555-123-4567" class="btn btn-outline-secondary">
                            <i class="fas fa-phone me-2"></i>Call (555) 123-4567
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Help Categories -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-th-large me-2"></i>Help Categories
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-tag text-primary me-2"></i>Product Information
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-credit-card text-success me-2"></i>Payment & Billing
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-mobile-alt text-info me-2"></i>Mobile App
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-gift text-warning me-2"></i>Gift Cards & Promotions
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-shield-alt text-danger me-2"></i>Privacy & Security
                            </a>
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
