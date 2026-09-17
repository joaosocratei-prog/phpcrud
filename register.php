<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <style>
/* =====================================
   RESET
===================================== */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


/* =====================================
   BODY
===================================== */

html {
    scroll-behavior: smooth;
}

body {
    min-height: 100vh;

    display: flex;
    justify-content: center;
    align-items: center;

    padding: 20px;

    font-family: Arial, sans-serif;

    background:
        radial-gradient(
            circle at top left,
            rgba(123, 44, 255, 0.35),
            transparent 35%
        ),
        radial-gradient(
            circle at bottom right,
            rgba(0, 102, 255, 0.30),
            transparent 35%
        ),
        #0d0d0d;

    color: white;
}


/* =====================================
   REGISTER BOX
===================================== */

.name {
    width: 100%;
    max-width: 430px;

    padding: 35px;

    background: rgba(24, 24, 24, 0.96);

    border: 1px solid #333;

    border-radius: 20px;

    box-shadow:
        0 20px 50px rgba(0, 0, 0, 0.6);

    animation: showForm 0.6s ease;
}


/* =====================================
   FORM ANIMATION
===================================== */

@keyframes showForm {

    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


/* =====================================
   TITLE
===================================== */

.name h2 {
    text-align: center;

    margin-bottom: 25px;

    font-size: 27px;

    color: white;

    text-transform: capitalize;
}


/* =====================================
   INPUTS
===================================== */

.name input {
    width: 100%;

    height: 45px;

    padding: 0 14px;

    margin-bottom: 15px;

    border: 1px solid #3a3a3a;

    border-radius: 10px;

    outline: none;

    background-color: #292929;

    color: white;

    font-size: 14px;

    box-shadow: none;

    transition:
        border-color 0.3s ease,
        box-shadow 0.3s ease,
        transform 0.3s ease;
}


/* =====================================
   PLACEHOLDER
===================================== */

.name input::placeholder {
    color: #999;
}


/* =====================================
   INPUT HOVER
===================================== */

.name input:hover {
    transform: translateY(-2px);

    border-color: #6c2cff;

    box-shadow:
        0 5px 15px rgba(108, 44, 255, 0.25);
}


/* =====================================
   INPUT FOCUS
===================================== */

.name input:focus {
    border-color: #7b2cff;

    box-shadow:
        0 0 0 3px rgba(123, 44, 255, 0.15),
        0 5px 15px rgba(123, 44, 255, 0.25);

    transform: translateY(-2px);
}


/* =====================================
   LOGIN LINK
===================================== */

.name a {
    display: inline-block;

    margin-top: 5px;
    margin-left: 0;

    color: #a970ff;

    text-decoration: none;

    font-size: 14px;

    transition: 0.3s ease;
}

.name a:hover {
    color: #c39cff;

    text-decoration: underline;
}


/* =====================================
   SEND BUTTON
===================================== */

.pro-btn {
    width: 100%;

    height: 46px;

    margin-top: 18px;
    margin-left: 0;

    border: none;

    border-radius: 10px;

    background:
        linear-gradient(
            135deg,
            #7b2cff,
            #0066ff
        );

    color: white;

    font-size: 15px;

    font-weight: bold;

    cursor: pointer;

    box-shadow:
        0 7px 20px rgba(108, 44, 255, 0.35);

    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease,
        filter 0.3s ease;
}


/* =====================================
   BUTTON HOVER
===================================== */

.pro-btn:hover {
    transform: translateY(-3px);

    box-shadow:
        0 12px 28px rgba(123, 44, 255, 0.5);

    filter: brightness(1.1);
}


/* =====================================
   BUTTON CLICK
===================================== */

.pro-btn:active {
    transform: translateY(1px);

    box-shadow:
        0 4px 10px rgba(108, 44, 255, 0.3);
}


/* =====================================
   MOBILE
===================================== */

@media (max-width: 600px) {

    body {
        padding: 15px;
    }

    .name {
        max-width: 100%;

        padding: 25px 20px;

        border-radius: 16px;
    }

    .name h2 {
        font-size: 23px;

        margin-bottom: 20px;
    }

    .name input {
        height: 44px;

        font-size: 14px;

        margin-bottom: 13px;
    }

    .pro-btn {
        height: 44px;

        font-size: 14px;
    }

}


/* =====================================
   SMALL PHONE
===================================== */

@media (max-width: 380px) {

    body {
        padding: 10px;
    }

    .name {
        padding: 22px 16px;
    }

    .name h2 {
        font-size: 21px;
    }

    .name input {
        height: 42px;

        font-size: 13px;
    }

    .pro-btn {
        height: 42px;
    }

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
