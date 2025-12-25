<?php
// Database configuration
$servername = "localhost"; // Replace with your server name
$username = "root";       // Replace with your database username
$password = "";           // Replace with your database password
$dbname = "interiordata";   // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $minEstimate = isset($_POST['minEstimate']) ? $_POST['minEstimate'] : null;
    $maxEstimate = isset($_POST['maxEstimate']) ? $_POST['maxEstimate'] : null;
    $imageName = isset($_POST['imageName']) ? $_POST['imageName'] : 'default_image.jpg';

    if ($minEstimate && $maxEstimate) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO apartment_selections (min_estimate, max_estimate, image_name) VALUES (?, ?, ?)");
        $stmt->bind_param("dds", $minEstimate, $maxEstimate, $imageName);

        // Execute the query
        if ($stmt->execute()) {
            $message = "Estimate successfully stored!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Invalid input. Please provide both minEstimate and maxEstimate.";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .header {
    background-color: #fff;
    padding: 20px;
    text-align: left;
    position: relative;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.header img {
    height: 40px;
    display: inline-block;
}

.header div {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    align-items: center;
}

.header a {
    text-decoration: none;
    color: #333;
    font-size: 16px;
    margin-right: 15px;
    padding: 8px 12px;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

.header a:hover {
    background-color:rgb(183, 190, 202);
    color: #fff;
}

.header a:active {
    background-color:rgb(170, 176, 180);
}

.container {
    max-width: 90%;
    margin: 20px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header a {
        font-size: 14px;
        margin-right: 10px;
    }
}

@media (max-width: 480px) {
    .header a {
        font-size: 12px;
        margin-right: 5px;
    }

    .header img {
        height: 30px;
    }
}
        .container {
            max-width: 90%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .illustration {
            margin-bottom: 20px;
        }

        .illustration img {
            width: 100%;
            max-width: 800px;
            border-radius: 8px;
            height: auto;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 16px;
            color: #777;
            margin-bottom: 20px;
        }

        .sub {
            font-size: 16px;
        }

        .su {
            font-size: 16px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            margin-top: 10px;
            color: #555;
        }

        .su a {
            text-decoration: none;
        }

        .estimate-card {
            margin-top: 20px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            width: 100%;
            max-width: 300px;
        }

        .estimate-card img {
            width: 70%;
            border-radius: 8px;
        }

        .estimate-text {
            margin-top: 10px;
        }

        .estimate-range {
            font-size: 22px;
            color: green;
            font-weight: bold;
        }

        .disclaimer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }

        .div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 768px) {
            .title {
                font-size: 20px;
            }

            .subtitle {
                font-size: 14px;
            }

            .estimate-range {
                font-size: 18px;
            }

            .container {
                padding: 15px;
            }

            .estimate-card {
                width: 90%;
            }
        }

        @media (max-width: 480px) {
            .title {
                font-size: 18px;
            }

            .subtitle {
                font-size: 12px;
            }

            .estimate-range {
                font-size: 16px;
            }

            .header img {
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="ilogo.avif" alt="Livspace Logo">
        <div>
            <a href="interiordesign.html">Home</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <div class="container">
        <div class="illustration">
            <img src="inter5.png" alt="Illustration">
        </div>
        <div class="title">Here's your estimate! Sounds like the start of a lovely home.</div>
        <div class="subtitle">We'd love to discuss it with you. We'll get in touch soon.</div>
        <div class="sub">Thanks For Choosing Us</div>
        <div class="su">For More Details <a href="book.php">Contact Us</a></div>

        <div class="div">
            <div class="estimate-card">
                <img id="estimateImage" src="" alt="Estimate Example">
                <div class="estimate-text">
                    <div class="estimate-range" id="estimateRange"></div>
                    <div>Superior home interior solutions that will take your interiors to the next level. <br> <span  style="color:red"> "Thise is not exact estimation" </span></div>
                </div>
            </div>
        </div>

        <div class="disclaimer">
            *This is only an indicative price based on our clients' average spends. The final price can be higher or lower depending on factors like finish material, number of furniture, civil work required (painting, flooring, plumbing, etc.), design elements, and wood type. Don't worry, our designers can help you understand this better.
        </div>

        <?php if (isset($message)) { ?>
            <div class="message" style="margin-top: 20px; color: #28a745; font-weight: bold;">
                <?php echo $message; ?>
            </div>
        <?php } ?>
    </div>

    <script>
       // Generate random estimates between 6L and 15L
const minEstimate = (Math.random() * (10 - 6) + 6).toFixed(1); // Random number between 6L and 10L
const maxEstimate = (Math.random() * (15 - 10) + 10).toFixed(1); // Random number between 10L and 15L

// Update the HTML element
document.getElementById("estimateRange").innerText = `₹${minEstimate}L - ₹${maxEstimate}L*`;

// List of image paths
const images = [
    "out1.jpg",
    "out2.jpg",
    "out3.jpg",
    "out4.jpg",
    "out5.jpg",
    "out6.jpg",
    "out7.jpg"
];

// Select a random image
const randomImage = images[Math.floor(Math.random() * images.length)];
document.getElementById("estimateImage").src = randomImage;

// Send the estimates to the server using Fetch API
fetch('', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `minEstimate=${minEstimate}&maxEstimate=${maxEstimate}&imageName=${randomImage}`,
})
.then(response => response.text())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));

    </script>
</body>
</html>
