<?php
session_start();
include("connection.php");

$error = "";

if (isset($_POST['login'])) {

    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    // Banza urebe niba fields zuzuye
    if ($u == "" || $p == "") {

        $error = "Please enter username and password";

    } else {

        $query = mysqli_query($s,"SELECT * FROM employee WHERE username='$u' AND password='$p'");

        if (mysqli_num_rows($query) == 1) {

            $q = mysqli_fetch_array($query);

            $_SESSION['username'] = $q['username'];

            header("Location: select.php");
            exit();

        } else {

            $error = "Invalid username and password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input{
            border-radius: 6px;
            border: none;
            background-color: black;
            color: aliceblue;
            height: 30px;
            box-shadow: 5px 5px 10px blue;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
         input:hover {
            transform: translateX(15px);
            box-shadow: 10px 10px 10px blue;
        }
        .name{
            margin-left: 100px;
            margin-top: 90px;
        }
        button{
            border-radius: 6px;
            border: none;
            background-color: black;
            color: aliceblue;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            height: 24px;
            margin-left: 20px;
            margin-top: 20px;
            box-shadow: 5px 5px 5px blue;
            transform: translate 2.4s ease-in-out, box-shadow 2.4s ease-in-out;
        }
         button:hover {
            transform: translateX(10px);
            box-shadow: 10px 10px 10px blue;
        }
        a{
            margin-left: 90px;
            color: blue;
        }
        p{
            transform: translateY(-8px);
            font-size: small;
            cursor: pointer;
        }
    
    </style>
</head>
<body>
             <div class="name">
              <form action="" method="POST">
                <p class="pp" style="font-size: 37px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" >LOGIN</p>
                 <input type="text" name="username" placeholder="enter your username" size="40"><br><br><br>
                  <input type="password" name="password" placeholder="enter your password" size="40"><br><br> 
                  <?php

if (isset($error)) {
    echo "<p style='color:red; margin-left:100px;'>$error</p>";
}

?>
                  <a href="register.php">create account</a>
                  <button type="submit" name="login">login </button>
                  <p>create your account if is not and then login successfuly</p>
                 </form></div>
                
                </body>
                 </html> 
