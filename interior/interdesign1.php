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

    // Debugging: Check if form data is received
    echo "Form data: " . $apartment_type; // Debugging line

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
        }

        $stmt->close();
    } else {
        // Display message when no apartment type is selected or invalid option
        $message = "Please select a valid apartment type. This field is required.";
    }
}

// Retrieve and display the data
$results = $conn->query("SELECT * FROM apartment_selections");

if ($results === false) {
    die('Error retrieving data: ' . $conn->error); // Check if SELECT query fails
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
            background-color:rgb(53, 54, 54);
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

.dropdown-group {
    margin-bottom: 20px;
    text-align: left;
}

.dropdown-group label {
    font-size: 16px;
    margin-bottom: 8px;
    display: block;
}

select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

button {
    width: 12%;
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

.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

a {
    background-color: rgb(239, 68, 68);
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

a:hover {
    background-color: #e47171;
}

h3 {
    margin-top: 30px;
    font-size: 1.6em;
    color: #333;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    font-size: 1.2em;
    color: #555;
}
.div{
    display:flex;
    justify-content:space-between;
}

    </style>
</head>
<body>
<header>
        <h1>Apartment Type</h1>
    </header>
    <div class="container" style="margin:100px;">
        <h2>Select Your Apartment Type</h2>

        <?php if ($message): ?>
            <div class="<?= (strpos($message, 'successfully') !== false) ? 'message' : 'error-message' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Apartment type selection form -->
        <form method="post" action="">
            <select id="apartment_type" name="apartment_type" style="    margin-bottom: 15px;">
                <option value="">Select an option</option>
                <option value="1BHK">1BHK</option>
                <option value="2BHK">2BHK</option>
                <option value="3BHK">3BHK</option>
                <option value="4BHK">4BHK</option>
                <option value="5BHK+">5BHK+</option>
            </select>
            <div class="div">
            <button type="submit">save</button>
            <div style="margin-top: 20px;">
                <a href="interdesign2.php">Next</a>
                </div>
            </div>
        </form>

        <!-- Display stored data -->
        <!-- <h3>Previous Selections:</h3>
        <!-- <?php if ($results->num_rows > 0): ?>
            <ul>
                <?php while ($row = $results->fetch_assoc()): ?>
                    <li><?= htmlspecialchars($row['type']) ?></li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No previous selections found.</p>
        <?php endif; ?> --> 
    </div>
</body>
</html>
