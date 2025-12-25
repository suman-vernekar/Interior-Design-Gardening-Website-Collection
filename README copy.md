# Mini Project - Interior Design & Gardening Website Collection

This repository contains two web projects: an interior design website and a gardening website. Both are built using HTML, CSS, JavaScript, and PHP with MySQL database connectivity.

## Projects Overview

### 1. Interior Design Website

🏠 An interior design website offering solutions for home design. The website provides various features such as design ideas, booking quotes, and information about interior design services.

**Key Features:**
- ✨ Responsive design for optimal viewing on different devices
- 🔗 Navigation bar with links to different sections
- 🎯 Banner section with call-to-action for quotes
- 🏆 Sections highlighting design services and benefits
- 🛋️ Showcasing different rooms and their design options
- 👥 Testimonials from satisfied clients
- 💬 Contact and estimation forms
- 🎨 Modern UI with interactive elements

**File Structure:**
- 📁 `interior/`: Main interior design website files
  - 📁 `interiordesign.html`: Main design page
  - 📁 `homepage.php`: PHP homepage with session management
  - 📁 `book.php`: Booking/quote page
  - 📁 `design.html`: Design ideas page
  - 📁 `how.html`: How-it-works page
  - 📁 `show.html`: Gallery/showcase page
  - 📁 `style.css`, `design-style.css`, `home-style.css`: Styling files
  - 📁 `code.js`, `book-code.js`, `home-code.js`: JavaScript functionality
  - 📁 `icons/`: Font Awesome icons
  - 📁 `connect.php`: Database connection
  - 📁 `register.php`, `login.php`, `logout.php`: Authentication

### 2. Gardening Website

🌱 A gardening website providing information about lawn care, plants, nurseries, and gardening tips.

**Key Features:**
- 🌿 Information on lawn care (natural grass vs artificial turf)
- 🌺 Plant care information and tips
- 🏡 Gardening ideas and resources
- 📞 Nursery contact information
- 📚 Comparison tables for different grass types
- 🌍 Environmental impact information

**File Structure:**
- 📁 `gardening/`: Main gardening website files
  - 📁 `gardening.html`: Main gardening page
  - 📁 `lawn.html`: Lawn care information
  - 📁 `plants.html`: Plant information
  - 📁 `contact.html`: Nursery contact page
  - 📁 `styles.css`, `contact.css`, `lawn.css`, `plant.css`: Styling files
  - 📁 `script.js`: JavaScript functionality
  - 📁 `connect.php`: Database connection
  - 📁 `register.php`, `homepage.php`, `logout.php`: Authentication
  - 📁 `nursery-specific files`: Individual nursery pages (deepu-nursery.html, green-grass-growers.html, etc.)

## Technologies Used

- 🌐 HTML5
- 🎨 CSS3
- ⚡ JavaScript
- 🔧 PHP
- 🗄️ MySQL (via connect.php)
- 📱 Responsive Design

## Database Setup

Both projects use PHP with MySQL database connectivity:
- 📁 `connect.php` files contain database connection details
- User authentication with session management
- Registration and login functionality

## Usage

💡 To use these projects, you can follow these steps:

1. Download or clone the repository
2. Set up a local server environment (like XAMPP, WAMP, or MAMP)
3. Place the project files in your server's root directory
4. Configure your database settings in the `connect.php` files
5. Start your local server
6. Access the websites through your browser:
   - Interior Design: Navigate to `interior/` folder
   - Gardening: Navigate to `gardening/` folder

📝 Note: Both websites include backend functionality for user authentication and database connectivity. Make sure your server supports PHP and MySQL to use all features.

## Project Structure

The repository is organized as follows:
```
├── interior/          # Interior design website
├── gardening/         # Gardening website
├── icons/             # Shared icon resources
├── README.md          # This file
└── [root files]       # Shared files and entry points
```

## Credits

👏 These websites were created as part of a mini project combining interior design and gardening information.
🔧 Both projects utilize HTML, CSS, JavaScript, and PHP for full functionality.
📷 Images and resources may be from various sources for demonstration purposes.
