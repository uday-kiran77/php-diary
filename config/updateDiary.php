<?php
    include("./db.php");
    include "functions.php";
    session_start();

    if (array_key_exists("content", $_POST)) {
        
        $diary=encrypt($_SESSION['email'],$_POST['content']);
        $sql = "UPDATE users SET diary=? WHERE email=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$diary, $_SESSION['email']]);
        
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $diary=encrypt($_SESSION['email'],$_POST['content']);
        $sql = "UPDATE users SET diary=? WHERE email=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$diary, $_SESSION['email']]);
        echo $diary;
    }
   

?>
