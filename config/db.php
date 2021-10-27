<?php  
    $dbHost="localhost";  
    $dbName="diary";  
    $dbUser="root";     
    $dbPassword="";

    try{  
        $pdo= new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPassword);   
    } catch(Exception $e){  
    Echo "Database Connection failed";  
    die();
    }  
?>