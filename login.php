<?php

session_start();
include("connection.php");

$error = "";

if (isset($_POST['login'])) {

    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    if ($u == "" || $p == "") {

        $error = "Please enter username and password.";

    } else {

        $query = mysqli_query(
            $s,
            "SELECT * FROM employee
             WHERE username='$u' AND password='$p'"
        );

        if (mysqli_num_rows($query) == 1) {

            $q = mysqli_fetch_assoc($query);

            $_SESSION['user_id'] = $q['e_id'];
            $_SESSION['username'] = $q['username'];

            header("Location: /staff/abc.php");
            exit();

        } else {

            $error = "Invalid username and password.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <!-- IMPORTANT FOR RESPONSIVE DESIGN -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <title>Login</title>
    <meta name="google-site-verification"
      content="0iY9W3C1Uni2rCBgui2xafQfSYFWA6cgAAV_cCsIjBM">

    <style>

        /* =========================
           GENERAL
        ========================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background: #f2f2f2;

            font-family:
                'Franklin Gothic Medium',
                'Arial Narrow',
                Arial,
                sans-serif;
        }


        /* =========================
           LOGIN BOX
        ========================= */

        .name {
            width: 90%;
            max-width: 430px;

            padding: 30px;

            background: white;

            border-radius: 15px;

            box-shadow:
                0 5px 25px rgba(0, 0, 0, 0.2);
        }


        /* =========================
           LOGIN TITLE
        ========================= */

        .title {
            margin: 0 0 25px 0;

            text-align: center;

            font-size: 38px;

            color: #111;
        }


        /* =========================
           INPUTS
        ========================= */

        input {
            width: 100%;

            height: 45px;

            padding: 0 14px;

            border-radius: 6px;

            border: 1px solid #ccc;

            background-color: black;

            color: aliceblue;

            font-size: 16px;

            outline: none;

            box-shadow: 5px 5px 10px blue;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        input::placeholder {
            color: #ccc;
        }

        input:focus {
            transform: translateX(5px);

            box-shadow:
                7px 7px 12px blue;
        }


        /* =========================
           ERROR
        ========================= */

        .error {
            color: red;

            margin: 15px 0;

            text-align: center;

            font-size: 14px;
        }


        /* =========================
           REGISTER LINK
        ========================= */

        .register {
            display: block;

            margin-top: 15px;

            text-align: center;

            color: blue;

            text-decoration: none;

            font-size: 15px;
        }

        .register:hover {
            text-decoration: underline;
        }


        /* =========================
           LOGIN BUTTON
        ========================= */

        button {
            display: block;

            width: 100%;

            height: 43px;

            margin-top: 18px;

            border-radius: 6px;

            border: none;

            background-color: black;

            color: aliceblue;

            font-size: 16px;

            cursor: pointer;

            box-shadow: 5px 5px 5px blue;

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        button:hover {
            transform: translateY(-3px);

            box-shadow:
                8px 8px 10px blue;
        }


        /* =========================
           DESCRIPTION
        ========================= */

        .description {
            margin-top: 20px;

            text-align: center;

            font-size: 13px;

            color: #555;

            line-height: 1.5;
        }


        /* =========================
           SMALL PHONES
        ========================= */

        @media (max-width: 380px) {

            .name {
                width: 94%;

                padding: 22px;
            }

            .title {
                font-size: 30px;
            }

            input {
                height: 42px;

                font-size: 14px;
            }

            button {
                height: 42px;

                font-size: 15px;
            }
        }


        /* =========================
           TABLETS
        ========================= */

        @media (min-width: 600px) {

            .name {
                max-width: 450px;

                padding: 35px;
            }

            .title {
                font-size: 42px;
            }
        }


        /* =========================
           LARGE PC
        ========================= */

        @media (min-width: 1000px) {

            .name {
                max-width: 470px;

                padding: 40px;
            }
        }

    </style>

</head>


<body>

    <div class="name">

        <form action="" method="POST">

            <h1 class="title">
                LOGIN
            </h1>


            <!-- USERNAME -->

            <input
                type="text"
                name="username"
                placeholder="Enter your username"
                autocomplete="username"
            >


            <br><br>


            <!-- PASSWORD -->

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                autocomplete="current-password"
            >


            <!-- ERROR -->

            <?php

            if ($error != "") {

                echo "<p class='error'>$error</p>";

            }

            ?>


            <!-- REGISTER -->

            <a
                href="register.php"
                class="register"
            >
                Create account
            </a>


            <!-- LOGIN -->

            <button
                type="submit"
                name="login"
            >
                Login
            </button>


            <!-- DESCRIPTION -->

            <p class="description">
                Create your account if you don't have one,
                then login successfully.
            </p>

        </form>

    </div>

</body>

</html>
