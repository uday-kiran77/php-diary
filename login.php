<?php

include "./config/db.php";
include "./config/functions.php";
$error="";
$email=$password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email=$_POST['email'];
   $password=$_POST['password'];
   if($email=="" && $password==""){
      $error="please fill out all the fields";
   }
   else{
         if(!checkEmailExists($email)){
         $error="Email doesn't Exist";
         }
         else{
            if(checkEmailandPass($email,$password)){
               session_start();
               $_SESSION['email']=$email;
               header("Location: index.php"); 
   
            }else{
               $error="Incorrect Password";
            }
         }
        
      }

}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- displays site properly based on user's device -->
      <link rel="stylesheet" href="style.css">
      <title>Intro component with sign up form</title>
      <style>
      </style>
   </head>
   <body>
      <div class="container">
         <div class="form">
            <div class="logo-container">
               <img src="./res/logo.png" alt="" class="form-logo">
               <h2>Secret Diary</h2>
            </div>
            <br>
            <form action="login.php" method="POST">
               <input type="email" name="email" value="<?php echo $email?>" placeholder="Email Address">
               <input type="password" name="password" placeholder="Password">
               <p class="error"><?php echo $error?></p>
               <button>Login</button>
            </form>
            <p class="form-bottom-btn">Don't have an account? <a href="register.php">Register</a> </p>
         </div>
      </div>
      </div>
     
   </body>
</html>