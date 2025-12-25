<?php
// Start the session to store selected layout
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Store selected layout in session and database if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['layout'])) {
    $layout = $_POST['layout'];

    // Save layout selection to session
    $_SESSION['selected_layout'] = $layout;

    // Insert the selected layout into the database
    $stmt = $conn->prepare("INSERT INTO layouts (selected_layout) VALUES (?)");
    $stmt->bind_param("s", $layout);
    $stmt->execute();
    $stmt->close();

    // Redirect to the next page after saving layout
    header('Location: kit2.php');
    exit;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kitchen Layout Selection</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    /* Basic Styling */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    header {
      background-color: #fff;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    header h1 {
      font-size: 24px;
      color: #333;
    }

    .step-indicator {
      font-size: 14px;
      color: #888;
      margin-top: 10px;
    }

    .container {
      max-width: 900px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .progress-bar {
      width: 100%;
      height: 10px;
      background-color: #e0e0e0;
      border-radius: 5px;
      margin-bottom: 30px;
      overflow: hidden;
    }

    .progress-bar-inner {
      height: 100%;
      background-color: #9333EA;
      width: 25%; /* Represents progress */
    }

    .layouts {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
    }

    .layout-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      background-color: #fff;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
      width: 48%;
      box-sizing: border-box;
    }

    .layout-card:hover {
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .layout-card input[type="radio"] {
      display: none;
    }

    .layout-card label {
      display: block;
      padding: 15px;
      font-weight: bold;
      color: #555;
      cursor: pointer;
    }

    .layout-card img {
      width: 100%;
      height: auto;
      max-width: 200px;
      margin: 10px 0;
    }

    .layout-card input[type="radio"]:checked + label {
      background-color: #9333EA;
      color: white;
      border: 1px solid #9333EA;
    }

    .layout-card input[type="radio"]:checked + label img {
      border: 2px solid #9333EA;
    }

    .footer {
      text-align: center;
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
    }

    button {
      padding: 3px 20px;
      height: 50px;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      background: #d9534f;
    }

    button a {
      color: white;
      text-decoration: none;
    }

    button:hover {
      background: #d9534f;
      color: white;
    }

    .back-button {
      background-color: #f1f1f1;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      color: #333;
      margin-top: 20px;
    }

    .back-button:hover {
      background-color: #ddd;
    }

  </style>
</head>
<body>

  <!-- Header Section -->
  <header>
    <h1>Kitchen Layout Selection</h1>
    <div class="step-indicator">Step 1/4: Select the layout of your kitchen</div>
  </header>

  <!-- Main Content Section -->
  <div class="container">

    <!-- Progress Bar -->
    <div class="progress-bar">
      <div class="progress-bar-inner" style="width: 25%;"></div>
    </div>

    <h2>Select the layout of your kitchen</h2>

    <!-- Message Display -->
    <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

    <!-- Layout Cards -->
    <form method="POST" action="">
      <div class="layouts">
        <div class="layout-card">
          <input type="radio" name="layout" id="l-shaped" value="L-shaped">
          <label for="l-shaped">
            <img src="k11.png" alt="L-shaped Layout">
            L-shaped
          </label>
        </div>

        <div class="layout-card">
          <input type="radio" name="layout" id="straight" value="Straight">
          <label for="straight">
            <img src="k12.png" alt="Straight Layout">
            Straight
          </label>
        </div>

        <div class="layout-card">
          <input type="radio" name="layout" id="u-shaped" value="U-shaped">
          <label for="u-shaped">
            <img src="k13.png" alt="U-shaped Layout">
            U-shaped
          </label>
        </div>

        <div class="layout-card">
          <input type="radio" name="layout" id="parallel" value="Parallel">
          <label for="parallel">
            <img src="k14.png" alt="Parallel Layout">
            Parallel
          </label>
        </div>
      </div>

      <!-- Footer with Navigation -->
      <div class="footer">
        <a href="interiordesign.html" class="back-button" style=" background: #f8eaea; color: #d9534f;">BACK</a>
        <button type="submit">Next</button>
      </div>
    </form>
  </div>

</body>
</html>
