<?php
// Connect to the database
$servername = "localhost"; // Replace with your server details
$username = "root";        // Replace with your MySQL username
$password = "";            // Replace with your MySQL password
$dbname = "interiordata"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['fName']);
    $email = htmlspecialchars($_POST['email']);
    $phone_code = $_POST['phone_code'];
    $phone = htmlspecialchars($_POST['phone']);
    $property = htmlspecialchars($_POST['property']);
    $whatsapp_updates = isset($_POST['whatsapp_updates']) ? 1 : 0;

    if (!empty($name) && !empty($email) && !empty($phone)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("INSERT INTO apartment_selections (fname, email, phone_code, phone, property, whatsapp_updates) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $name, $email, $phone_code, $phone, $property, $whatsapp_updates);

            if ($stmt->execute()) {
                echo "<p class='message success'>Your estimate has been saved. Thank you!</p>";
                // Redirect to the next page
                header("Location: interdesign.html");
                exit();
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

    header {
      background-color: rgb(53, 54, 54);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 16px 32px;
      height: 8vh;
    }

    header .header-container {
      display: flex;
      justify-content: center;
      color: white;
      font-size: 19px;
    }

    .container {
      max-width: 600px;
      margin: 100px auto 0;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

    form input, form select {
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
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      background-color: #9333EA;
    }
    button a{
      text-decoration:none;
      color: white;
    }
  </style>
</head>
<body>
<header>
  <div class="header-container">
    <h2>Other Room</h2>
  </div>
</header>

<div class="container">
  <main>
    <h2>Your estimate is almost ready</h2>
    <form method="POST" action="">
      <input type="text" name="fName" id="fName" placeholder="First Name" required oninput="validateName(this)">
      <input type="email" name="email" id="email" placeholder="Email" required oninput="validateEmail(this)">
      <div class="phone-input">
        <select name="phone_code">
          <option value="+91">+91</option>
        </select>
        <input type="tel" name="phone" id="phone" placeholder="Phone number" required oninput="validatePhone(this)">
      </div>
      <div class="checkbox">
        <input type="checkbox" id="whatsapp-updates" name="whatsapp_updates" checked>
        <label for="whatsapp-updates">Send me updates on WhatsApp</label>
      </div>
      <input type="text" name="property" id="property" placeholder="Enter The Property Address" required>
      <p class="terms">
        By submitting this form, you agree to the <a href="#">privacy policy</a> & <a href="#">terms and conditions</a>.
      </p>
      <p class="recaptcha-notice">
        This site is protected by reCAPTCHA and the Google <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a> apply.
      </p>
      <button type="submit"><a href="interdesign.php">SUBMIT</a></button>
    </form>
  </main>
</div>

<script>
  function validateName(input) {
    const namePattern = /^[a-zA-Z]+$/;
    if (!namePattern.test(input.value)) {
      input.setCustomValidity('Please enter only letters.');
    } else {
      input.setCustomValidity('');
    }
  }

  function validateEmail(input) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(input.value)) {
      input.setCustomValidity('Please enter a valid email address.');
    } else {
      input.setCustomValidity('');
    }
  }

  function validatePhone(input) {
    const phonePattern = /^[0-9]{10}$/;  // Accepts exactly 10 digits
    if (!phonePattern.test(input.value)) {
      input.setCustomValidity('Please enter a valid 10-digit phone number.');
    } else {
      input.setCustomValidity('');
    }
  }
</script>
</body>
</html>
