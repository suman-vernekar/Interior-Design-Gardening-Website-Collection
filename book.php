<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "interiordata";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['num']);
    $property = htmlspecialchars($_POST['prop']);
    $whatsappUpdates = isset($_POST['whatsapp']) ? 'Yes' : 'No';

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($mobile) && !empty($property)) {
        // Prepare an SQL statement to insert data into the table
        $stmt = $conn->prepare("INSERT INTO enquiry (name, email, mobile, property, whatsapp_updates) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $mobile, $property, $whatsappUpdates);

        // Execute the statement
        if ($stmt->execute()) {
            $message = "Thank you, $name! Your details have been submitted successfully.";
        } else {
            $error = "Error: Could not submit your details. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } else {
        $error = "Please fill in all required fields.";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interia: Best Interior Design Solutions</title>
    <link rel="stylesheet" href="icons/css/all.css">
    <link rel="stylesheet" href="common-style.css">
    <link rel="stylesheet" href="book-style.css">
    <link rel="shortcut icon" href="source/favicon.ico" type="image/x-icon">
</head>
<body>

<div class="banner">
    <div class="navbar">
        <img onclick="btn('index.html');" src="" class="logo">
        <ul>
        <li><a href="interiordesign.html">HOME</a></li>
            <li><a href="design.html">Design ideas</a></li>
            <li><a href="how.html">How It Works?</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>TALK TO A DESIGNER</h1>
    </div>
</div>

<div class="m1">
    <div class="d1">
        <div class="final">
            <div class="form" id="frm">
                <form action="" method="POST">
                    <input class="inp" id="nam" type="text" name="name" autocomplete="off" required>
                    <label class="lab" id="lab_nam" for="name">
                        <span class="spn" id="content-name">Name</span>
                    </label>
                    
                    <input class="inp" id="email" type="email" name="email" autocomplete="off" required>
                    <label class="lab" id="lab_email" for="email">
                        <span class="spn" id="content-email">Email</span>
                    </label>
                    
                    <input class="inp" id="num" type="tel" name="num" pattern="[0-9]{10}" autocomplete="off" required>
                    <label class="lab" id="lab_num" for="num">
                        <span class="spn" id="content-num">Mobile Number</span>
                    </label>
                    
                    <div>
                        <input type="checkbox" id="whatsapp" name="whatsapp" checked>
                        <label id="lab_chk" for="whatsapp">Send me updates on Whatsapp</label>
                    </div>
        
                    <input class="inp" id="prop" type="text" name="prop" autocomplete="off" required>
                    <label class="lab" id="lab_prop" for="prop">
                        <span class="spn" id="content-prop">Looking For...</span>
                    </label>
                    
                    <button type="submit" id="sub-btn">BOOK ONLINE CONSULTATION</button>
                </form>
                <?php if (!empty($message)): ?>
                    <h2 id="subm" style="color: green;"><?= $message ?></h2>
                <?php elseif (!empty($error)): ?>
                    <h2 id="subm" style="color: red;"><?= $error ?></h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<!-- <div class="m2">
    <div class="t2">
        <h1>Superior interiors</h1>
        <p>With stunning designs and professional on-site services, we make dream homes come alive.</p>
    </div>
    <div class="d2">
        <div onclick="btn('show.html?topic=master-bedroom');">
            <a href="show.html?topic=master-bedroom"><img src="source/book-m2-1.jpg"></a>
            <h3>Bedroom</h3>
        </div>
        <div onclick="btn('show.html?topic=dining-room');">
            <img src="source/book-m2-2.jpg">
            <h3>Dining Room</h3>
        </div>
        <div onclick="btn('show.html?topic=living-room');">
            <img src="source/book-m2-3.jpg">
            <h3>Living Room</h3>
        </div>
    </div>
</div> -->

<div class="m3">
    <div class="d3">
        <div>
            <h1>Ensuring a safe experience from design to installation</h1>
            <p>We're following all protocols to ensure your safety and vaccination drives are underway to ensure our employees are ready to meet you safely.</p>
            <a href="corona.html"><p class="rd">know more →</p></a>
        </div>
        <div>
            <img src="source/safe.jpg">
        </div>
    </div>
</div>



<div class="m-last">
    <div class="last">
        <div>
            <h1>Your dream home is just a click away</h1>
            <button><a href="book.php" style="text-decoration:none">GET STARTED</a></button>
        </div>
    </div>
</div>

<footer>
    <div class="ftr-m">
        <div class="ftr-t">
           
        </div>
        <div class="ftr-d">
            <div>
                <h3>Design ideas</h3>
                <ul>
                    <li><a href="show.html?topic=living-room">Living Rooms</a></li>
                    <li><a href="show.html?topic=kitchen">Kitchens</a></li>
                    <li><a href="show.html?topic=master-bedroom">Master Bedrooms</a></li>
                    <li><a href="show.html?topic=kids-bedroom">Kids Bedrooms</a></li>
                </ul>
            </div>
            <div>
                <h3>Locations</h3>
                <ul>
                    <li><a href="https://www.google.com/maps/place/Mumbai" target="_blank">Mumbai</a></li>
                    <li><a href="https://www.google.com/maps/place/New+Delhi" target="_blank">New Delhi</a></li>
                    <li><a href="https://www.google.com/maps/place/Kolkata" target="_blank">Kolkata</a></li>
                    <li><a href="https://www.google.com/maps/place/Bengaluru" target="_blank">Bengaluru</a></li>
                </ul>
            </div><div>
                <h3>Explore</h3>
                <ul>
                    <li><a href="book.php">Book A Design</a></li>
                    <li><a href="how.html">How It Works?</a></li>
                </ul>
            </div><div>
                <h3>Get in touch</h3>
                <ul>
                    <li>Call us</li>
                    <a href="tel:8879109025">+91 7625086715</a>
                    <li>Email us</li>
                    <a href="">iterior@gmail.com</a>
                </ul>
            </div>
        </div>
        <div class="ftr-b">
            <h2>Designed By Meet</h2>
            <p>© 2022 Interia.com | All Rights Reserved</p>
        </div>
    </div>
</footer>


</body>
</html>
