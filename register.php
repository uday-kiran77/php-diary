<?php

include "./config/db.php";
include "./config/functions.php";
$error=$message="";
$user=array("null","udaykiranbujunuri@gmail.com","null");
$validateEmail=$validatePassword=false;
$emailExisis=true;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $user=array($_POST["name"],$_POST["email"],$_POST["password"]);

      if($user[0]=="" || $user[1]=="" || $user[2]==""){
         $error="please fillout all the fields";
      }
     
      if(!$error){
         $emailExisis=checkEmailExists($user[1]);
         if($emailExisis){
            $error="Email Exists";
         }
         if(!$emailExisis){
            $validateEmail=validateEmail($user[1]);
            if(!$validateEmail){
               $error="Email Invalid";
            }
            $validatePassword=validatePassword($user[2]);
            if(!$validatePassword){
               $error=$error."<br>Please Choose a strong password.";
            }
         }
      }
      if(!$emailExisis && $validateEmail && $validatePassword && $error==""){
         $encryptedPassword=password_hash($user[2], PASSWORD_ARGON2I);
         $sql = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
         $stmt= $pdo->prepare($sql);
         $stmt->execute([$user[0], $user[1], $encryptedPassword]);
         $message="Register Success...Proceed to login";
         $user=array(null,null,null);
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
      <title>Diary | Register</title>
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
            <form action="register.php" method="POST">
               <input type="text" name="name" placeholder="Name" value="<?php echo $user[0]?>"  >
               <input type="email" name="email" placeholder="Email Address" value="<?php echo $user[1]?>" required>
               <input type="password" name="password" placeholder="Password" required>
               <p class="error"><?php echo $error?></p>
               <p class="message"><?php echo $message?></p>
               <button type="submit">Register</button>
            </form>
            <p class="form-bottom-btn">Already have an account? <a href="login.php">Login</a> </p>
         </div>
      </div>
      </div>
   </body>
</html>