<?php
// Start the session to store messages
session_start();

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_package = isset($_POST['package']) ? $_POST['package'] : null;

    if ($selected_package) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "your_database";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert the selected package into the database
        $sql = "INSERT INTO selected_packageskit3 (package_name) VALUES ('$selected_package')";

        if ($conn->query($sql) === TRUE) {
            $message = "Package saved successfully: " . htmlspecialchars($selected_package);
        } else {
            $message = "Error: " . $conn->error;
        }

        $conn->close();
    } else {
        $message = "No package selected!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick Your Package</title>
    <style>
        /* General Styles */
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        header {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .h-8 {
            height: 32px;
        }

        header span {
            font-size: 1rem;
            font-weight: 500;
            color: #4b5563;
        }

        /* Main Content Styles */
        main {
            max-width: 768px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        /* Progress Bar Styles */
        .progress-bar-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .progress-bar {
            flex-grow: 1;
            height: 10px;
            background-color: #e5e7eb;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        .progress-bar-inner {
            height: 100%;
            background-color: #9333ea;
            width: 75%;
            transition: width 0.3s ease-in-out;
        }

        .progress-bar-container span {
            margin-left: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Card Styles for Package Options */
        .package-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background-color: #f9fafb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            align-items: flex-start;
            cursor: pointer;
        }

        .package-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .package-card label {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .package-card input[type="radio"] {
            appearance: none;
            border: 1px solid #d1d5db;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            margin-right: 1rem;
            cursor: pointer;
        }

        .package-card input[type="radio"]:checked {
            background-color: #9333ea;
            border-color: #9333ea;
        }

        .package-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .package-card p {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
        }

        /* Buttons */
        button,
        a {
            background-color: #ef4444;
            color: #ffffff;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover,
        a:hover {
            background-color: #dc2626;
        }

        button:focus,
        a:focus {
            outline: none;
            box-shadow: 0 0 0 2px #fef2f2;
        }

        button:disabled,
        a:disabled {
            background-color: #f87171;
            cursor: not-allowed;
        }

        button:last-child {
            margin-left: auto;
        }

        .mt-8 {
            margin-top: 2rem;
        }

        /* Success/Error Messages */
        .message {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }

        .message.success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .message.error {
            background-color: #fee2e2;
            color: #b91c1c;
        }
    </style>
</head>

<body>
    <header>
        <div class="flex max-w-7xl mx-auto px-4 py-4">
            <img src="ilogo.avif" alt="Logo" class="h-8" style="padding-right:1000px">
        </div>
        <span class="text-sm font-medium text-gray-700" style="color: grey;font-size: 20px;">3/4</span>
    </header>

    <main>
        <div class="progress-bar-container">
            <div class="progress-bar">
                <div class="progress-bar-inner bg-purple-600" style="width: 75%;"></div>
            </div>
            <span class="ml-4 text-sm font-medium text-gray-700">75%</span>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pick your package</h2>

        <!-- Display the message if available -->
        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'Error') === false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="space-y-6">
                <div class="border rounded-lg p-4 bg-gray-50 shadow hover:shadow-lg transition-all cursor-pointer">
                    <label for="essentials" class="flex items-start space-x-4">
                        <input type="radio" id="essentials" name="package" value="essentials">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Essentials (₹₹)</h3>
                            <p class="text-sm text-gray-600 mb-4">Essential solutions for your home needs.</p>
                        </div>
                    </label>
                </div>

                <div class="border rounded-lg p-4 bg-gray-50 shadow hover:shadow-lg transition-all cursor-pointer">
                    <label for="premium" class="flex items-start space-x-4">
                        <input type="radio" id="premium" name="package" value="premium">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Premium (₹₹)</h3>
                            <p class="text-sm text-gray-600 mb-4">Superior solutions for enhanced interiors.</p>
                        </div>
                    </label>
                </div>

                <div class="border rounded-lg p-4 bg-gray-50 shadow hover:shadow-lg transition-all cursor-pointer">
                    <label for="luxury" class="flex items-start space-x-4">
                        <input type="radio" id="luxury" name="package" value="luxury">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Luxury (₹₹)</h3>
                            <p class="text-sm text-gray-600 mb-4">Premium luxury for a refined living experience.</p>
                        </div>
                    </label>
                </div>

            </div>

            <div class="mt-8 flex justify-between "style="display: flex;justify-content: space-evenly;">
        <button class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-full"><a href="kit2.php">Back</a></button>
        <button type="submit" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-full"><a href="kit4.php">Next</a></button>
      </div>
        </form>
    </main>
</body>

</html>
