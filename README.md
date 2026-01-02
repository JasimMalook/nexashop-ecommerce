# eCommerce Website - Complete PHP Application

A fully functional eCommerce website with a modern, premium UI and comprehensive admin panel. Built with PHP, MySQL, Bootstrap 5, and MDBootstrap.

## 🚀 Features

### Frontend (User Website)
- **Modern UI/UX Design**: Clean, premium interface like a paid SaaS product
- **Fully Responsive**: Works perfectly on mobile, tablet, and desktop
- **Home Page**: Hero section, featured products, categories, newsletter
- **Shop Page**: Product listing with filters, search, sorting, pagination
- **Product Detail**: Product information, reviews, related products
- **Shopping Cart**: Add/remove items, quantity control, price calculation
- **Checkout**: Complete order process with billing information
- **User Authentication**: Secure login, registration, session management
- **User Dashboard**: Profile, order history, account management

### Admin Panel
- **Secure Admin Login**: Separate authentication for administrators
- **Dashboard**: Statistics, recent orders, low stock alerts
- **Product Management**: Add, edit, delete products with image upload
- **Category Management**: Organize products by categories
- **Order Management**: View orders, update status, order details
- **User Management**: View registered users and their activity

## 🛠️ Technology Stack

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Modern styling with animations
- **JavaScript (ES6)** - Interactive functionality
- **jQuery** - DOM manipulation and AJAX
- **Bootstrap 5** - Responsive framework
- **MDBootstrap** - Material Design components
- **Google Fonts** - Poppins & Montserrat typography

### Backend
- **PHP (Core)** - Server-side logic (no framework)
- **MySQL** - Database management
- **PDO** - Secure database operations
- **PHP Sessions** - User authentication

## 📁 Project Structure

```
eCommerce App/
├── config/
│   └── db.php                 # Database configuration
├── auth/
│   ├── login.php              # User login
│   ├── register.php           # User registration
│   └── logout.php             # Logout functionality
├── admin/
│   ├── admin_login.php        # Admin login
│   ├── dashboard.php          # Admin dashboard
│   ├── products.php           # Product management
│   ├── categories.php         # Category management
│   ├── orders.php             # Order management
│   └── users.php              # User management
├── cart/
│   ├── add_to_cart.php        # Add items to cart
│   ├── update_cart.php        # Update cart quantities
│   └── remove_cart.php        # Remove items from cart
├── assets/
│   ├── css/
│   │   └── style.css          # Custom styles
│   ├── js/
│   │   └── script.js          # Custom JavaScript
│   └── images/                # Product images
├── index.php                  # Home page
├── shop.php                   # Shop page
├── product.php                # Product details
├── cart.php                   # Shopping cart
├── checkout.php               # Checkout process
├── order_confirmation.php      # Order confirmation
├── dashboard.php              # User dashboard
├── database.sql               # Database schema
└── README.md                  # This file
```

## 🗄️ Database Schema

### Tables
- **users** - User accounts and authentication
- **categories** - Product categories
- **products** - Product information
- **orders** - Order records
- **order_items** - Order line items

## 🚀 Setup Instructions

### Prerequisites
- XAMPP/WAMP/MAMP (or similar PHP/MySQL environment)
- PHP 7.4+ with PDO extension
- MySQL 5.7+
- Modern web browser

### Installation Steps

1. **Download/Clone the Project**
   ```bash
   git clone <repository-url>
   # or extract the ZIP file
   ```

2. **Setup Database**
   - Start XAMPP and launch Apache & MySQL
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `ecommerce_db`
   - Import the `database.sql` file into the database

3. **Run Authentication Fix**
   - Open your browser and go to: `http://localhost/eCommerce App/fix_auth.php`
   - This will automatically fix the authentication system
   - The script will create proper password hashes and verify everything works
   - Wait for the "Authentication System Fixed!" message

4. **Test the System**
   - **Admin Login**: http://localhost/eCommerce%20App/admin/admin_login.php
   - **User Login**: http://localhost/eCommerce%20App/auth/login.php
   - **Registration**: http://localhost/eCommerce%20App/auth/register.php

5. **Access the Application**
   - **Frontend**: http://localhost/eCommerce%20App/
   - **Admin Panel**: http://localhost/eCommerce%20App/admin/admin_login.php

### Default Login Credentials

**Admin Account:**
- Email: `admin@admin.com`
- Password: `admin123`
- URL: `admin/admin_login.php`

**User Account:**
- Email: `john@example.com`
- Password: `user123`
- URL: `auth/login.php`

## 🎯 Key Features Explained

### Security Features
- **Prepared Statements**: All database queries use PDO prepared statements
- **Password Hashing**: Secure password storage using PHP's password_hash()
- **Session Management**: Secure session-based authentication
- **Input Sanitization**: All user inputs are sanitized
- **Role-Based Access**: Admin and user roles with proper access control

### Cart Functionality
- **Session-Based Cart**: Cart data stored in PHP sessions
- **Real-time Updates**: Cart updates without page refresh
- **Stock Management**: Automatic stock validation
- **Price Calculation**: Automatic subtotal, tax, and shipping calculations

### Admin Features
- **Dashboard Statistics**: Real-time metrics and analytics
- **Product Management**: Full CRUD operations with image upload
- **Order Management**: View and update order statuses
- **Low Stock Alerts**: Automatic notifications for low inventory
- **User Analytics**: Track user activity and spending

## 🎨 Design Features

### Modern UI Elements
- **Gradient Backgrounds**: Beautiful color gradients
- **Smooth Animations**: Hover effects and transitions
- **Card-Based Layout**: Clean, organized content presentation
- **Responsive Grid**: Bootstrap's responsive grid system
- **Material Design**: MDBootstrap components

### User Experience
- **Intuitive Navigation**: Clear menu structure
- **Search Functionality**: Live product search
- **Filter & Sort**: Advanced product filtering
- **Mobile-Friendly**: Touch-optimized interface
- **Loading States**: Visual feedback during operations

## 🔧 Customization

### Adding New Features
1. **Database Changes**: Update `database.sql` and run migrations
2. **Backend Logic**: Add PHP files in appropriate directories
3. **Frontend UI**: Update existing pages or create new ones
4. **Styling**: Modify `assets/css/style.css`

### Theme Customization
- **Colors**: Update CSS variables in `style.css`
- **Fonts**: Change Google Fonts imports
- **Layout**: Modify Bootstrap grid and components
- **Animations**: Adjust CSS transitions and effects

## 📱 Browser Support

- **Chrome** (Latest)
- **Firefox** (Latest)
- **Safari** (Latest)
- **Edge** (Latest)
- **Mobile Browsers** (iOS Safari, Chrome Mobile)

## 🐛 Troubleshooting

### Common Issues

**Database Connection Error**
```php
// Check config/db.php settings
// Verify MySQL service is running
// Confirm database name and credentials
```

**Session Issues**
```php
// Ensure session_start() is called at the top
// Check PHP session.save_path is writable
// Verify cookies are enabled in browser
```

**File Upload Issues**
```php
// Check assets/images/ folder permissions
// Verify upload_max_filesize in php.ini
// Ensure proper file permissions
```

**CSS/JS Not Loading**
```php
// Verify file paths are correct
// Check .htaccess URL rewriting
// Clear browser cache
```

## 📝 License

This project is for educational purposes. Feel free to use, modify, and distribute according to your needs.

## 🤝 Contributing

1. Fork the project
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📞 Support

For issues and questions:
- Check the troubleshooting section
- Review the code comments
- Test with the provided sample data

## 🎉 Enjoy!

You now have a complete, professional eCommerce website with all the features you need for an online store. The code is clean, well-documented, and ready for customization. Happy coding!
