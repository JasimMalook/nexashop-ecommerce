<?php
// Set page title
$page_title = "Contact Us - eCommerce Store";

// Include header
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <!-- Contact Form Section -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary text-white">
                    <h2 class="mb-0">
                        <i class="fas fa-envelope me-2"></i>Get in Touch
                    </h2>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                    
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Your Name *</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <select class="form-select" id="subject" required>
                                <option value="">Select a topic</option>
                                <option value="general">General Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="billing">Billing Question</option>
                                <option value="feedback">Feedback</option>
                                <option value="partnership">Partnership Opportunity</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" rows="6" required placeholder="Tell us more about your inquiry..."></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    I'd like to receive updates about new products and special offers
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg shadow-soft">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contact Information Section -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Contact Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>Address
                        </h6>
                        <p class="text-muted">
                            123 Shopping Street<br>
                            Commerce City, CC 12345<br>
                            United States
                        </p>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-phone me-2"></i>Phone
                        </h6>
                        <p class="text-muted">
                            Main: +1 (555) 123-4567<br>
                            Support: +1 (555) 123-4568
                        </p>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-envelope me-2"></i>Email
                        </h6>
                        <p class="text-muted">
                            General: info@ecommerce.com<br>
                            Support: support@ecommerce.com
                        </p>
                    </div>
                    
                    <div>
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-clock me-2"></i>Business Hours
                        </h6>
                        <p class="text-muted">
                            Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 10:00 AM - 4:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Social Media -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-share-alt me-2"></i>Follow Us
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <a href="#" class="text-primary fs-4">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-info fs-4">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-danger fs-4">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-primary fs-4">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-danger fs-4">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>Frequently Asked Questions
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6>How long does shipping take?</h6>
                                <p class="text-muted">Standard shipping typically takes 5-7 business days, while express shipping takes 2-3 business days.</p>
                            </div>
                            <div class="mb-4">
                                <h6>What is your return policy?</h6>
                                <p class="text-muted">We offer a 30-day return policy for unused items in their original packaging.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6>Do you offer international shipping?</h6>
                                <p class="text-muted">Yes, we ship to most countries worldwide. International shipping times vary by location.</p>
                            </div>
                            <div class="mb-4">
                                <h6>How can I track my order?</h6>
                                <p class="text-muted">Once your order ships, you'll receive a tracking number via email to monitor your package.</p>
                            </div>
                        </div>
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
