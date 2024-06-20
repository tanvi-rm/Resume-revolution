<?php

include 'config.php';

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select_users = mysqli_query($conn, "SELECT * FROM `resume_revolution` WHERE email = '$email' AND password = '$pass'") or die('query failed');
      //Performs a SQL SELECT query to check if a user with the provided email and password exists in the users table.
      //If a user is found, it adds a message to the $message array indicating that the user already exists

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
         //Checks if the entered password and confirmed password match.
         //If not, adds a message to the $message array indicating a mismatch.
         
      }else{
         mysqli_query($conn, "INSERT INTO `resume_revolution`( email, password ) VALUES( '$email', '$cpass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:template.html');
         //if the user doesn't exist and passwords match, inserts the user details into the users table after encrypting the password using MD5.
         //Adds a success message to the $message array and redirects to the login page.
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>
<nav class = "navbar">
        <div class="container">
            <div class = "navbar-content">
                <div class = "brand-and-toggler">
                    <p class = "navbar-brand">
                        <img src = "assets\images\logo1.png" alt = "" class = "navbar-brand-icon">
                        <span class = "navbar-brand-text">Resume <span>Revolution</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="nav-button">
                <button class="button" id="loginBtn" onclick="login()">Sign In</button>
                <button class="button" id="registerBtn" onclick="register()">Sign Up</button>
            </div>
    </nav>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">      

      <h3>Sign Up</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      

      <input type="submit" name="submit" value="Sign Up" class="btn1">
      <p>Already have an account? <a href="loginpage.php">Sign In</a></p>
   </form>

</div>
<script src="assets/js/app.js"></script>

</body>

<style>

.nav-button .button {
    width: 120px;
    height: 40px;
    font-size: 15px;
    font-weight: 500;
    background: #fdeffd;
    color: #000;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: .3s ease;
}

.button:hover{
    background: rgba(247, 208, 208, 0.3);
}

        .navbar{
    height: 80px;
    background-color: #fdeffd;
    display: flex;
    text-align: center;
    box-shadow: rgba(0, 0, 0, 0.08) 0px 3px 8px;
}

.navbar-brand-icon{
    width: 30px;
    margin-left: 100px;
    
}

.logo{
display: block;
margin-left: auto;
margin-right: auto;
width: 90px;
}

.container{
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.6rem;
}

.navbar{
    height: 80px;
    background-color: #fdeffd;
    display: flex;
    align-items: center;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 8px;
}
.navbar-brand{
    display: flex;
    align-items: center;
    justify-content: flex-start;
    font-size: 1.8rem;
}
.navbar-brand-text{
    color: var(--clr-dark);
    font-weight: 600;
    text-decoration: none;
}
.navbar-brand-text span{
    color: var(--clr-blue);
    text-decoration: none;
}
.brand-and-toggler{
    display: flex;
    
    justify-content: space-between;
}
::-webkit-input-placeholder {
    color:#656e83;
}

body {
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    background-color: #fdeffd;
    margin: 0;
    padding: 0;
}

.message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px 15px;
    margin: 10px 0;
    border-radius: 5px;
    position: relative;
}

.message span {
    display: inline-block;
    margin-right: 10px;
}

.message i {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
}

.form-container {
    max-width: 600px;
    margin: 100px auto;
    background-color: #fdeffd;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.form-container h3 {
    text-align: center;
    font-size: 30px;

    color: #1170CD;
}

.box {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    color: #000;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.btn1 {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn1:hover {
    background-color: #0056b3;
}

.btn1:active {
    background-color: #004080;
}

p {
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
    color: #333;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

</style>

</html>