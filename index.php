<?php 

include "./config/functions.php";

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); 
}
else{
    $diary=fetchDiary();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Diary</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #FE7A7A;
            overflow-x: hidden ;
            max-width: 100vw;
        }
        .logo-container{
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .logout-btn{
            position: absolute;
            right: 10px;
            top: 15px;

        }
        .logout-btn button{
            background-color: #1fa86d;
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            border: 0px solid #fff;
            border-radius: 10px;
            text-transform: uppercase;
        }
        nav{
            height: 65px;
        }
        .text-area-container{
            margin: 10px; 
            height: 85vh;
        }
        .input-area{
            width:100%;
            height: 100%;
            border-radius: 5px;
            outline: none;
            padding: 20px;
            resize: none;
        }
        /* .credits{
            text-align: center;
            margin-top: -5px;
            margin-bottom: 5px;
            background-color: #fff;
            width: fit-content;
            padding:0 10px;
            margin-left: auto;
            margin-right: auto;
        } */
        .credits{
            background-color: #fff;
            text-align: center;
            padding:5px 0;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="./res/logo.png" alt="" class="form-logo">
            <h2>Secret Diary</h2>
         </div>
         <a href="logout.php" class="logout-btn"><button>Logout</button></a>
    </nav>
    <div class="text-area-container">
        <textarea name="" id="diary-input-area" class="input-area" placeholder="Write something..."><?php echo $diary ?></textarea>
    </div>
    <p class="form-bottom-btn credits">PHP Diary - <a href="https://github.com" target="_blank">source code</a></p>

    <script>
        const textarea=document.querySelector('#diary-input-area')

        textarea.addEventListener('change', ()=>{
            $.ajax({
                url: './config/updateDiary.php',
                type: 'post',
                data: {content:$('#diary-input-area').val()},
                success: function(response){
                    console.log(response)
                }
                });
        });

   

  
    </script>
</body>
</html>