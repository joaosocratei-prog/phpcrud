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
        <?php 
        if(isset($error)){ 
            echo"<P style='color: red;'>$error</p>";
             } ?>
             <div class="name">
              <form action="" method="POST">
                <p class="pp" style="font-size: 37px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" >LOGIN</p>
                 <input type="text" name="username" placeholder="enter your username" size="40"><br><br><br>
                  <input type="password" name="password" placeholder="enter your password" size="40"><br><br> 
                  <a href="form.html">create account</a>
                  <button type="submit" name="login">login </button>
                  <p>create your account if is not and then login successfuly</p>
                 </form></div>
                
                </body>
                 </html> 
                 <?php 
                 session_start(); 
                 include("connection.php"); 
                 if(isset($_POST['login'])){ 
                    $u= $_POST['username']; 
                    $p= $_POST['password'];

                     $query=mysqli_query($sec, "SELECT * FROM employee WHERE username='$u' AND password='$p'"); 
                     if(mysqli_num_rows($query)==1){    
                         $q=mysqli_fetch_array($query);
                          $_SESSION['username']=$q['username'];
                           header("location: index.html"); exit(); 
                           }else{ 
                            echo"<p style='color: red; margin-left: 100px; transform: translateY(-80px); font-weight: bold; cursor: pointer;' >!!!wrong username and password!!!</p>"; 
                            } 
                            }
                             ?>