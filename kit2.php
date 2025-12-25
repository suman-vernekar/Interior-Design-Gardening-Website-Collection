<?php
// Start the session to store selected measurements
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $measurementA = $_POST['measurementA'];
    $measurementB = $_POST['measurementB'];

    // Save the measurements to the session
    $_SESSION['measurementA'] = $measurementA;
    $_SESSION['measurementB'] = $measurementB;

    // Optionally, insert the measurements into the database
    $stmt = $conn->prepare("INSERT INTO measurementskit2 (measurementA, measurementB) VALUES (?, ?)");
    $stmt->bind_param("ii", $measurementA, $measurementB); // Assuming measurements are integers
    $stmt->execute();
    $stmt->close();

    // Redirect to the next page after saving
    header('Location: kit3.php');
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
    <title>Measurements Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            width: 50%; /* Represents progress */
        }

        .title {
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .measurement-box {
            display: flex;
            justify-content: space-around;
            margin-bottom: 15px;
        }

        .measurement-box div {
            background: #f8eaea;
            color: #6c757d;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
        }

        .notice {
            background: #fff8e1;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        button a {
            text-decoration: none;
            color: white;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .button.back {
            background: #f8eaea;
            color: #d9534f;
        }

        .button.next {
            background: #d9534f;
            color: white;
        }

    </style>
</head>
<body>

<header>
    <h1>Kitchen Layout Selection</h1>
    <div class="step-indicator">Step 2/4: Select the layout of your kitchen</div>
</header>

<div class="container">
    <div class="progress-bar">
        <div class="progress-bar-inner" style="width: 50%;"></div>
    </div>

    <div class="title">Now review the measurements for accuracy</div>
    <div class="measurement-box">
        <div>A</div>
        <div>B</div>
    </div>
    <div class="notice">Standard size has been set for your convenience</div>

    <form method="POST" action="">
        <div class="form-group">
            <label for="measurementA">A</label>
            <select id="measurementA" name="measurementA">
                <option value="8">8 ft.</option>
                <option value="9">9 ft.</option>
                <option value="10">10 ft.</option>
            </select>
        </div>
        <div class="form-group">
            <label for="measurementB">B</label>
            <select id="measurementB" name="measurementB">
                <option value="8">8 ft.</option>
                <option value="9">9 ft.</option>
                <option value="10">10 ft.</option>
            </select>
        </div>
        <div class="buttons">
            <button type="button" class="button back"><a href="kit1.php">BACK</a></button>
            <button type="submit" class="button next">NEXT</button>
        </div>
    </form>
</div>

</body>
</html>
