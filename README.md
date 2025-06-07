Deployment Instructions

    1. Requirements:
        - Web server (Apache/Nginx)
        - PHP 7.4+
        - MySQL 5.7+
        - Node.js (optional for development)

    2. Setup:
        - Create database and import SQL schema
        - Configure database credentials in config/db.php
        - Upload all files to your server
        - Ensure the assets/images/ directory is writable if you'll upload images

    3. Development:
        - For local development, you can use XAMPP/WAMP/MAMP
        - Run a local PHP server: php -S localhost:8000

    4. Production:
        - Configure proper file permissions
        - Set up HTTPS
        - Consider adding caching headers for static assets

Features Implemented

    1. Responsive Design: 
       - Works on all device sizes
    2. Dark/Light Mode:
       - Toggle with persistent preference
    3. Multi-language Support: 
       - English
       - Khmer
       - Chinese
    4. Dynamic Content:
       - Projects loaded from database
    5. Interactive Contact Form:
       - With validation
    6. Smooth Animations:
       - For better user experience
    7. Accessibility:
       - Proper contrast and semantic HTML