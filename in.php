<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
 
<div class="out-container">
  <div class="out-in">
        <div class="container" id="signup" style="display:none;">
      <h1 class="form-title">Register</h1>
      <form method="post" action="register.php">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="fName" id="fName" placeholder="First Name" required oninput="validateName(this)">
           <label for="fname">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required oninput="validateName(this)">
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required oninput="validateEmail(this)">
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required oninput="validatePassword(this)">
            <label for="password">Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <p class="or">
        ----------or--------
      </p>
      
      <div class="links">
        <p>Already Have Account ?</p>
        <button id="signInButton">Sign In</button>
      </div>
    </div>
    </div>
    </div>

    <div class="out-container">
    <div class="out-in">
    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required oninput="validateEmail(this)">
              <label for="email">Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required oninput="validatePassword(this)">
              <label for="password">Password</label>
          </div>
          
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">
          ----------or--------
        </p>
       
        <div class="links">
          <p>Don't have account yet?</p>
          <button id="signUpButton">Sign Up</button>
        </div>
      </div>
      </div>
      </div>
      <script>
        document.getElementById('signInButton').addEventListener('click', () => {
            document.getElementById('signup').style.display = 'none';
            document.getElementById('signIn').style.display = 'block';
        });

        document.getElementById('signUpButton').addEventListener('click', () => {
            document.getElementById('signup').style.display = 'block';
            document.getElementById('signIn').style.display = 'none';
        });

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

        function validatePassword(input) {
            const passwordPattern = /^(?=.*[A-Z]).{8,}$/;
            if (!passwordPattern.test(input.value)) {
                input.setCustomValidity('Password must be at least 8 characters long and contain at least one uppercase letter.');
            } else {
                input.setCustomValidity('');
            }
        }
      </script>
</body>
</html>
