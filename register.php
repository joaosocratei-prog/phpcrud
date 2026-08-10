<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>legister</title>
    <style>
        h1{
            cursor: pointer;
        }
        input{
            border-radius: 10px;
            border: none;
            height: 34px;
            width: 500px;
        }
        fieldset{
            width: 700px;
            border-radius: 10px;
            border: none;
            background-color: cadetblue;
        }
        button:hover{
            transform: translateY(-5px);
            color:darkblue;
            cursor: pointer;
            border-radius: 6px;
        }
    </style>
</head>
<body><center><br><br><br><br><br><br><form action="register.php" method="POST">
    <fieldset><h1>fill this option</h1>
    <input type="text" name="username" placeholder="Enter username"><br><br>
    <input type="text" name="email" placeholder="Enter email"><br><br>
    <input type="password" name="password" placeholder="Enter password"><br><br>
    <button type="submmit" name="send">save</button></fieldset></form></center>
</body>
</html>
<?php
include("connection.php");
if(isset($_POST['send'])){
    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = $_POST['password'];
    $query=mysqli_query($sec,"INSERT INTO `employee` (`e_id`, `username`, `email`, `password`) VALUES ('', 'u', 'e', 'p')");

    }
?>