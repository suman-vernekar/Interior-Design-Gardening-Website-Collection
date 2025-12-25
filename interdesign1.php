<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interiordata"; // Change to your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure apartment type is selected and sanitize the input
    $apartment_type = filter_input(INPUT_POST, 'apartment_type', FILTER_SANITIZE_STRING);

    // Validate that the apartment type is selected
    if ($apartment_type && in_array($apartment_type, ['1BHK', '2BHK', '3BHK', '4BHK', '5BHK+'])) {
        // Prepare and bind SQL query to insert selected apartment type into the database
        $stmt = $conn->prepare("INSERT INTO apartment_selections (type) VALUES (?)");

        if ($stmt === false) {
            die('Error preparing query: ' . $conn->error); // Check SQL preparation error
        }

        $stmt->bind_param("s", $apartment_type);

        if (!$stmt->execute()) {
            die('Error executing query: ' . $stmt->error); // Check SQL execution error
        } else {
            $message = "Your selection ($apartment_type) has been saved successfully.";

            // Redirect to the next page after successful save
            header("Location: interdesign2.php");
            exit;
        }

        $stmt->close();
    } else {
        // Display message when no apartment type is selected or invalid option
        $message = "Please select a valid apartment type. This field is required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Type Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        header {
            background-color: rgb(53, 54, 54);
            color: white;
            padding: 5px 32px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            position: absolute;
            top: 0px;
        }

        .container {
            width: 90%;
            max-width: 600px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin-top: 100px; /* Space for header */
        }

        h2 {
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            color: green;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }

        .error-message {
            color: red;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Apartment Type</h1>
</header>
<div class="container">
    <h2>Select Your Apartment Type</h2>

    <?php if ($message): ?>
        <div class="<?= (strpos($message, 'successfully') !== false) ? 'message' : 'error-message' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <!-- Apartment type selection form -->
    <form method="post" action="">
        <select id="apartment_type" name="apartment_type">
            <option value="">Select an option</option>
            <option value="1BHK">1BHK</option>
            <option value="2BHK">2BHK</option>
            <option value="3BHK">3BHK</option>
            <option value="4BHK">4BHK</option>
            <option value="5BHK+">5BHK+</option>
        </select>
        <button type="submit">Save and Next</button>
    </form>
</div>
</body>
</html>
