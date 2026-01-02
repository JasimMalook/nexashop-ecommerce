<?php
// Set page title
$page_title = "About Us - eCommerce Store";

// Include header
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="card">
        <div class="card-header bg-gradient-primary text-white">
            <h2 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>About Us
            </h2>
        </div>
        <div class="card-body">
            
            <!-- About Section -->
            <section class="mb-5">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h3 class="card-title text-primary mb-4">
                                    <i class="fas fa-store me-2"></i>Our Story
                                </h3>
                                <p class="lead">
                                    Welcome to eCommerce Store, your trusted online shopping destination since 2024. 
                                    We started with a simple mission: to provide quality products at unbeatable prices 
                                    while delivering an exceptional shopping experience.
                                </p>
                                <p>
                                    What began as a small startup has grown into a comprehensive e-commerce platform 
                                    serving thousands of satisfied customers worldwide. Our commitment to quality, 
                                    value, and customer satisfaction remains at the heart of everything we do.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h3 class="card-title text-success mb-4">
                                    <i class="fas fa-bullseye me-2"></i>Our Mission
                                </h3>
                                <p class="lead">
                                    Our mission is to make online shopping simple, secure, and enjoyable for everyone. 
                                    We believe that great products should be accessible to all, without compromising on quality or service.
                                </p>
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <i class="fas fa-check text-primary me-2"></i>
                                        <strong>Quality Products:</strong> Curated selection of premium items
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-check text-success me-2"></i>
                                        <strong>Best Prices:</strong> Competitive pricing without sacrificing quality
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-check text-info me-2"></i>
                                        <strong>Customer Service:</strong> Support that cares about your satisfaction
                                    </li>
                                    <li>
                                        <i class="fas fa-check text-warning me-2"></i>
                                        <strong>Secure Shopping:</strong> Safe and protected transactions
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Values Section -->
            <section class="mb-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Our Core Values</h3>
                    <p class="text-muted">The principles that guide everything we do</p>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 text-center border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="text-primary mb-3">
                                    <i class="fas fa-heart fa-2x"></i>
                                </div>
                                <h5 class="card-title">Quality First</h5>
                                <p class="card-text">
                                    Every product is carefully selected and tested to ensure the highest quality standards.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 text-center border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="text-success mb-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <h5 class="card-title">Customer Focus</h5>
                                <p class="card-text">
                                    Our customers are at the center of our decisions. We listen, learn, and improve based on your feedback.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 text-center border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="text-info mb-3">
                                    <i class="fas fa-shield-alt fa-2x"></i>
                                </div>
                                <h5 class="card-title">Integrity Always</h5>
                                <p class="card-text">
                                    We conduct business with honesty, transparency, and respect for our customers, partners, and team.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 text-center border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="text-warning mb-3">
                                    <i class="fas fa-rocket fa-2x"></i>
                                </div>
                                <h5 class="card-title">Innovation Driven</h5>
                                <p class="card-text">
                                    We continuously improve our platform, processes, and offerings to provide the best shopping experience.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section class="mb-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Meet Our Team</h3>
                    <p class="text-muted">The people behind eCommerce Store</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="https://via.placeholder.com/150x150/4f46e5/ffffff?text=JD" 
                                         alt="John Doe" 
                                         class="rounded-circle mb-3"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <h5 class="card-title">John Doe</h5>
                                <p class="text-muted">Founder & CEO</p>
                                <p class="card-text small">
                                    Leading our vision with over 10 years of e-commerce experience and a passion for customer satisfaction.
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin me-1"></i>LinkedIn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="https://via.placeholder.com/150x150/28a745/ffffff?text=SM" 
                                         alt="Sarah Miller" 
                                         class="rounded-circle mb-3"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <h5 class="card-title">Sarah Miller</h5>
                                <p class="text-muted">Head of Operations</p>
                                <p class="card-text small">
                                    Ensuring smooth operations, logistics, and customer service excellence across all departments.
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin me-1"></i>LinkedIn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="https://via.placeholder.com/150x150/dc3545/ffffff?text=TC" 
                                         alt="Tom Chen" 
                                         class="rounded-circle mb-3"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <h5 class="card-title">Tom Chen</h5>
                                <p class="text-muted">Head of Technology</p>
                                <p class="card-text small">
                                    Driving innovation and ensuring our platform stays ahead of the curve with cutting-edge technology.
                                </p>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin me-1"></i>LinkedIn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="mb-5">
                <div class="card bg-gradient-primary text-white">
                    <div class="card-body text-center py-4">
                        <h3 class="mb-4">Our Impact</h3>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="display-4">
                                    <h2 class="fw-bold">50K+</h2>
                                    <p class="mb-0">Happy Customers</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="display-4">
                                    <h2 class="fw-bold">1000+</h2>
                                    <p class="mb-0">Products Listed</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="display-4">
                                    <h2 class="fw-bold">99%</h2>
                                    <p class="mb-0">Satisfaction Rate</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-0">
                                <div class="display-4">
                                    <h2 class="fw-bold">24/7</h2>
                                    <p class="mb-0">Customer Support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section>
                <div class="text-center">
                    <h3 class="fw-bold mb-4">Ready to Start Shopping?</h3>
                    <p class="lead mb-4">
                        Join thousands of satisfied customers and discover why eCommerce Store is the preferred choice for quality products and exceptional service.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="shop.php" class="btn btn-primary btn-lg shadow-soft">
                            <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                        </a>
                        <a href="contact.php" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
