<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate the inputs
    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Send an email (optional)
            $to = "your_email@example.com"; // Replace with your email address
            $subject = "New Contact Us Message from $name";
            $body = "You have received a new message from your website's contact form.\n\n";
            $body .= "Name: $name\nEmail: $email\nMessage:\n$message\n";
            $headers = "From: $email";

            if (mail($to, $subject, $body, $headers)) {
                echo "<script>alert('Message sent successfully. Thank you for contacting us!');</script>";
            } else {
                echo "<script>alert('Error sending the message. Please try again later.');</script>";
            }

            // Save to a database (optional)
            /*
            $conn = new mysqli("localhost", "root", "password", "contact_db"); // Update credentials
            if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
            }
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);
            if ($stmt->execute()) {
                echo "<script>alert('Message saved successfully.');</script>";
            } else {
                echo "<script>alert('Error saving the message.');</script>";
            }
            $stmt->close();
            $conn->close();
            */
        } else {
            echo "<script>alert('Invalid email address. Please enter a valid email.');</script>";
        }
    } else {
        echo "<script>alert('All fields are required. Please fill out the form completely.');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}
?>
