<?php
// Connect to the database
$servername = "localhost"; // Replace with your server name
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "contact_db";    // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']); // Get phone number
    $message = htmlspecialchars($_POST['message']);

    // Validate the inputs
    if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Save to the database
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $message); // Bind phone number

            if ($stmt->execute()) {
                echo "<p class='message'>Your message has been saved. Thank you for contacting us!</p>";
            } else {
                echo "<p class='message' style='color: red;'>Error saving your message. Please try again.</p>";
            }

            $stmt->close();
        } else {
            echo "<p class='message' style='color: red;'>Invalid email address. Please enter a valid email.</p>";
        }
    } else {
        echo "<p class='message' style='color: red;'>All fields are required. Please fill out the form completely.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Traditional and Colorful Web Design - Perfect for Interior and Garden blogs.">
  <title>Traditional Interior & Garden</title>
  <link rel="stylesheet" href="homepage.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
  <nav class="navbar">
    <div class="logo">
      <img src="logo.jpg" alt="logoimage" style="width: 90px; height: auto; border-radius: 50%;">
    </div>
    <ul class="navbar-links" id="navbar-links">
      <li><a href="#">Home</a></li>
      <li><a href="in.php">Interior Design</a></li>
      <li><a href="gardening/in.php">Garden Ideas</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <div class="navbar-toggle" id="navbar-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>
</header>

  

  <section id="home" class="hero">
    <div class="hero-content">
      
    </div>
  </section>
  <section id="main" class="side-by-side-section">
  <div class="content-column interior">
      <h2 class="int">Interior Design</h2>
  <p>Interior design is all about creating functional and aesthetically pleasing spaces that reflect personal style. It blends color, furniture, lighting, and textures to transform a room into a comfortable and inviting environment. From minimalist designs that promote simplicity to opulent spaces that showcase elegance, interior design can enhance the mood and functionality of any space. Thoughtful design choices not only beautify a home but also improve its flow and usability, making it a perfect blend of form and function. Whether you prefer modern, traditional, or eclectic styles, interior design helps turn visions into reality.Interior design is the art of crafting spaces that are both beautiful and functional.</p>
      <a href="in.php" class="btn-link">Explore Interior Design</a>
    </div>
    <div class="content-column garden">
      <h2 class="gar">Garden Ideas</h2>
     <p>Discover the joy of gardening through vibrant ideas and practical tips. From designing colorful flower beds to creating serene water features, our garden blog inspires you to transform your outdoor spaces. Learn how to nurture lush greenery, experiment with vertical gardens for compact spaces, and incorporate traditional decor to add charm. Whether you're a seasoned gardener or just starting, find endless ways to make your garden a peaceful retreat.Explore vibrant garden ideas and practical tips to transform your outdoor spaces into serene retreats. From colorful blooms to tranquil water features, let nature inspire your creativity!</p>
      <a href="gardening/in.php" class="btn-link">Explore Garden Ideas</a>
    </div>
 
  </section>
  
  

  <section id="about" class="section">
    <h2>About Us</h2>
    <p>At Heritage Design, we combine tradition and innovation to craft spaces that reflect culture and beauty.</p>
  </section>

  <section id="contact" class="section bg-light">
    <h2 class="section-title">Contact Us</h2>
    <p class="section-description">If you have any problem or inquiry, please write your message below and we will get in touch with you.</p>
    <div>
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="phone">Your Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>
            </div>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</section>

  

  <footer class="footer">
    <p>&copy; 2024 Heritage Design. All rights reserved.</p>
  </footer>
  <script src="homepage.js"></script>
</body>
</html>
