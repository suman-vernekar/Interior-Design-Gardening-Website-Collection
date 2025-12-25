<?php
// Connect to the database
$servername = "localhost"; // Replace with your server details
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "your_database"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone_code = $_POST['phone_code'];
    $phone = htmlspecialchars($_POST['phone']);
    $property = htmlspecialchars($_POST['property']);
    $whatsapp_updates = isset($_POST['whatsapp_updates']) ? 1 : 0;

    if (!empty($name) && !empty($email) && !empty($phone)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Prepare and execute the SQL query to insert form data
            $stmt = $conn->prepare("INSERT INTO estimateskit4 (name, email, phone_code, phone, property, whatsapp_updates) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $name, $email, $phone_code, $phone, $property, $whatsapp_updates);

            if ($stmt->execute()) {
                // Redirect to the next page after successful submission
                header('Location: interdesign.html');
                exit; // Make sure the rest of the script doesn't run
            } else {
                echo "<p class='message error'>Error saving your estimate. Please try again.</p>";
            }

            $stmt->close();
        } else {
            echo "<p class='message error'>Invalid email address. Please enter a valid email.</p>";
        }
    } else {
        echo "<p class='message error'>All fields are required. Please fill out the form completely.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estimate Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    /* Header Styles */
    header {
      background-color: #fff;
      height: 70px;
      color: #333;
      width: 100%;
      position: fixed;
      top: 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .logo img {
      height: 40px;
    }

    .container {
      max-width: 600px;
      margin: 100px auto 0;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .progress-bar {
      width: 100%;
      height: 10px;
      background-color: #e0e0e0;
      border-radius: 5px;
      margin-bottom: 20px;
      position: relative;
    }

    .progress-bar-inner {
      height: 100%;
      background-color: #9333EA;
      width: 100%;
      position: absolute;
    }

    .progress-bar span {
      position: absolute;
      right: 10px;
      top: -20px;
      color: #555;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    form input, form select, form button {
      margin-bottom: 15px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    .phone-input {
      display: flex;
      gap: 10px;
    }

    .checkbox {
      display: flex;
      align-items: center;
    }

    .checkbox input {
      margin-right: 10px;
    }

    .terms, .recaptcha-notice {
      font-size: 12px;
      color: #888;
    }

    .terms a, .recaptcha-notice a {
      color: #9333EA;
      text-decoration: none;
    }

    button {
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      background-color: #9333EA;
    }

    button:hover {
      background-color: #7c2ae8;
    }
    
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="ilogo.avif" alt="Logo">
    </div>
    <div class="span">
      <span>4/4</span>
    </div>
  </header>

  <div class="container">
    <div class="progress-bar">
      <div class="progress-bar-inner"></div>
      <span>100%</span>
    </div>
    <main>
      <h2>Your estimate is almost ready</h2>
      <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email ID" required>
        <div class="phone-input">
          <select name="phone_code">
            <option value="+91">+91</option>
            <!-- Add other country codes as needed -->
          </select>
          <input type="tel" name="phone" placeholder="Phone number" required>
        </div>
        <div class="checkbox">
          <input type="checkbox" id="whatsapp-updates" name="whatsapp_updates" checked>
          <label for="whatsapp-updates">Send me updates on WhatsApp</label>
        </div>
        <input type="text" name="property" placeholder="Property Name">
        <p class="terms">
          By submitting this form, you agree to the <a href="#">privacy policy</a> & <a href="#">terms and conditions</a>.
        </p>
        <p class="recaptcha-notice">
          This site is protected by reCAPTCHA and the Google <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a> apply.
        </p>
        <button type="submit"><a href="interdesign.html">SUBMIT</a></button>
      </form>
    </main>
  </div>
</body>
</html>
