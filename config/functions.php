<?php

function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
      }
      return true;
}
function validatePassword($password){
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{6,12}$/', $password)) {
        return false;
    }
    return true;
}
function checkEmailExists($email){
    include "./config/db.php";

    $sql = 'SELECT email FROM users where email="'.$email.'"';
    $statement = $pdo->query($sql);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if($result){
        return true;
    }
    else{
        return false;
    }
}

function checkEmailandpass($email,$password){
    include "./config/db.php";

    $sql = 'SELECT email,password FROM users where email="'.$email.'"';
    $statement = $pdo->query($sql);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $passwordVerify=password_verify( $password, $result['password']);
    if($result['email']==$email && $passwordVerify){
        return true;
    }
   else{
       return false;
   }
}

function fetchDiary(){
    include "./config/db.php";
    $email=$_SESSION['email'];

    $sql = 'SELECT diary FROM users where email="'.$email.'"';
    $statement = $pdo->query($sql);

    // fetch all rows
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $decryptedText=decrypt($_SESSION['email'],$result['diary']);
    return $decryptedText;
}

// function updateDiary($diary){
//     include "./config/db.php";
//     session_start();
//     $email=$_SESSION['email'];

//     $sql = 'UPDATE users
//     SET diary = :diary
//     WHERE email = :email';
//     $encryptedData=encrypt($_SESSION['email'],$diary);
//     // prepare statement
//     echo $encryptedData;
//     $statement = $pdo->prepare($sql);

//     // bind params
//     $statement->bindParam(':diary', $encryptedData);
//     $statement->bindParam(':email', $email);

//     // execute the UPDATE statment
//     if ($statement->execute()) {
//     echo 'The publisher has been updated successfully!';
//     }
// }

// function encrypt(){
//     //Key
// //Encryption:
// $textToEncrypt = "My Text to Encrypt";
// $encryptionMethod = "AES-256-CBC";
// $secretHash = "encryptionhash";
// $iv = mcrypt_create_iv(16, MCRYPT_RAND);
// $encryptedText = openssl_encrypt($textToEncrypt,$encryptionMethod,$secretHash, 0, $iv);

// echo $encryptedText;
// //Decryption:
// $decryptedText = openssl_decrypt($encryptedText, $encryptionMethod, $secretHash, 0, $iv);
// print "My Decrypted Text: ". $decryptedText;
// }
// encrypt();

function encrypt($email,$dataToEncrypt){
    // Store the cipher method
    $ciphering = "AES-128-CTR";
    
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    
    // Store the encryption key
    $encryption_key =$email;
    
    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt($dataToEncrypt, $ciphering,
                $encryption_key, $options, $encryption_iv);
    
    return $encryption;
  
}


function decrypt($email,$encryptedData){
    // Store the cipher method
    $ciphering = "AES-128-CTR";
      
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
      
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
    
    // Store the decryption key
    $decryption_key = $email;
    
    // Use openssl_decrypt() function to decrypt the data
    $decryption=openssl_decrypt ($encryptedData, $ciphering, 
                $decryption_key, $options, $decryption_iv);
    
    return $decryption;
}


?>