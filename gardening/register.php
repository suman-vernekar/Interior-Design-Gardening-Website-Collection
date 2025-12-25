<?php 

include 'gardening\gardening.html';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(fName,lName,email,password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: in.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if (isset($_POST['signIn'])) {
    // Retrieve the email and password from POST
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // "s" is the type for the string (email)
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any matching user is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password against the hashed password stored in the database
        if (password_verify($password, $row['password'])) {
            // Start the session if credentials are correct
            session_start();
            $_SESSION['email'] = $row['email'];  // Store user email in session
            header("Location: gardening/gardening.html"); // Redirect to gardening page
            exit();
        } else {
              // Incorrect password
              echo "Incorrect password";
            }
        } else {
            // No user found with that email
            echo "No user found with that email address";
        }
    
        // Close the prepared statement
        $stmt->close();
    }
?>