<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input{
            border-radius: 8px;
            border: none;
            background-color:cornsilk;
            height: 35px;
            box-shadow: 5px 5px 5px blue;
            transition: transform 0.4s ease, box-shadow 0.4s ease;       

        }
        input:hover {
            transform: translateX(15px);
            box-shadow: 10px 10px 10px blue;
        }
        .name{
            margin-left: 100px;
            margin-top: 70px;
        }
        body{
            background-color: wheat;
        }
          a{
            margin-left: 90px;
            color: blue;
        }
        .pro-btn {
        padding: 12px 25px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #979a9f, #7b2cff);
        color: white;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        margin-left: 120px;

        box-shadow: 0 6px 15px rgba(0, 102, 255, 0.35);

        transition: 
        transform 0.3s ease,
        box-shadow 0.3s ease,
        background 0.3s ease;
        }

     .pro-btn:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 25px rgba(123, 44, 255, 0.45);
      background: linear-gradient(135deg, #7b2cff, #0066ff);
       }

      .pro-btn:active {
       transform: translateY(2px);
       box-shadow: 0 3px 8px rgba(0, 102, 255, 0.3);
       }    
         

 </style>
</head>
<body>
    <div class="name">
        <form action="" method="POST">
            <h2>create accout</h2>
            <input type="text" name="username" placeholder="👤 Enter username" size="45"><br><br><br>
            <input type="date" name="birth_date" placeholder="Enter your birth date" size="100"><br><br><br>
            <input type="tel" name="phone" placeholder="📞 Enter phone number" size="45"><br><br><br>
            <input type="email" name="email" placeholder="📩 Enter email" size="45"><br><br><br>
            <input type="password" name="password" placeholder="🔑 Enter password" size="45"><br><br><br>
            <a href="login.php">Retry login</a>
            <button type="submit" name="send" class="pro-btn">send</button>

        </form></div>
    
</body>
</html>
<?php
include("connection.php");

if (isset($_POST['send'])) {

    $u = $_POST['username'];
    $b = $_POST['birth_date'];
    $h = $_POST['phone'];
    $e = $_POST['email'];
    $p = $_POST['password'];

    $query = mysqli_query($s,
        "INSERT INTO employee (username,birth_date,phone,email,password)
         VALUES ('$u', '$b', '$h', '$e', '$p')");

    
    
}
?>