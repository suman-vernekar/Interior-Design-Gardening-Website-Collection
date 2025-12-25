<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <style>
        *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"poppins",sans-serif;
}
body{
    background:linear-gradient(to right,#e2e2e2,#c9d6ff);
    background-image: url("logoback.jpg");
    background-size: cover;
    position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.container{
    background:#fafafa;
    width:450px;
    padding:1.5rem;
    margin:50px auto;
    border-radius:10px;
    box-shadow:0 20px 35px rgba(0,0,1,0.9),-0 -20px 35px rgba(0,0,1,0.9);
    z-index: 10;
}
form{
    margin:0 2rem;
}
.form-title{
    font-size:1.5rem;
    font-weight:bold;
    text-align:center;
    padding:1.3rem;
    margin-bottom:0.4rem;
}
input{
    color:inherit;
    width:100%;
    background-color:transparent;
    border:none;
    border-bottom:1px solid #757575;
    padding-left:1.5rem;
    font-size:15px;
}
.input-group{
    padding:1% 0;
    position:relative;

}
.input-group i{
    position:absolute;
    color:black;
}
input:focus{
    background-color: transparent;
    outline:transparent;
    border-bottom:2px solid hsl(327,90%,28%);
}
input::placeholder{
    color:transparent;
}
label{
    color:#757575;
    position:relative;
    left:1.2em;
    top:-1.3em;
    cursor:auto;
    transition:0.3s ease all;
}
input:focus~label,input:not(:placeholder-shown)~label{
    top:-3em;
    color:hsl(327,90%,28%);
    font-size:15px;
}
.recover{
    text-align:right;
    font-size:1rem;
    margin-bottom:1rem;

}
.recover a{
    text-decoration:none;
    color:rgb(125,125,235);
}
.recover a:hover{
    color:blue;
    text-decoration:underline;
}
.btn{
    font-size:1.1rem;
    padding:8px 0;
    border-radius:5px;
    outline:none;
    border:none;
    width:100%;
    background:rgb(125,125,235);
    color:white;
    cursor:pointer;
    transition:0.9s;
}
.btn:hover{
    background:#07001f;
}
.or{
    font-size:1.1rem;
    margin-top:0.5rem;
    text-align:center;
}
.icons{
    text-align:center;
}

.links{
    display:flex;
    justify-content:space-around;
    padding:0 4rem;
    margin-top:0.9rem;
    font-weight:bold;
}
button{
    color:rgb(125,125,235);
    border:none;
    background-color:transparent;
    font-size:1rem;
    font-weight:bold;
}
button:hover{
    text-decoration:underline;
    color:blue;
}
@media (max-width: 500px) {
    .container{
        width: 280px;
    }
    .links{
        padding:0.1rem; 
        font-size:.8rem;
    }
    button{
         font-size:.8rem; 
    }
}
    </style>
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
