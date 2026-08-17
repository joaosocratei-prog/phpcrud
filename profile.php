<?php

session_start();
include("connection.php");


/* =========================
   CHECK LOGIN
========================= */

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$message = "";
$message_type = "success";


/* =========================
   UPLOAD PROFILE
========================= */

if (isset($_POST['upload'])) {

    if (!isset($_FILES['profile'])) {

        $message = "Please select an image.";
        $message_type = "error";

    } else {

        $file = $_FILES['profile'];

        $file_name  = $file['name'];
        $file_tmp   = $file['tmp_name'];
        $file_size  = $file['size'];
        $file_error = $file['error'];


        /* =========================
           CHECK UPLOAD ERROR
        ========================= */

        if ($file_error !== UPLOAD_ERR_OK) {

            $message = "Error uploading image.";
            $message_type = "error";

        } else {


            /* =========================
               ALLOWED FILE TYPES
            ========================= */

            $allowed = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];


            $extension = strtolower(
                pathinfo(
                    $file_name,
                    PATHINFO_EXTENSION
                )
            );


            /* =========================
               CHECK EXTENSION
            ========================= */

            if (!in_array($extension, $allowed)) {

                $message =
                    "Only JPG, JPEG, PNG and WEBP are allowed.";

                $message_type = "error";

            }


            /* =========================
               CHECK FILE SIZE
            ========================= */

            elseif ($file_size > 5 * 1024 * 1024) {

                $message =
                    "Image must be less than 5MB.";

                $message_type = "error";

            }


            else {


                /* =========================
                   UPLOAD FOLDER
                ========================= */

                $upload_dir =
                    __DIR__ .
                    DIRECTORY_SEPARATOR .
                    "uploads";


                /* =========================
                   CREATE FOLDER
                ========================= */

                if (!is_dir($upload_dir)) {

                    if (!mkdir(
                        $upload_dir,
                        0777,
                        true
                    )) {

                        $message =
                            "Failed to create uploads folder.";

                        $message_type = "error";

                    }

                }


                /* =========================
                   CONTINUE IF FOLDER EXISTS
                ========================= */

                if ($message == "") {


                    /* =========================
                       CREATE UNIQUE FILE NAME
                    ========================= */

                    $new_name =
                        "profile_" .
                        $user_id .
                        "_" .
                        time() .
                        "." .
                        $extension;


                    /* =========================
                       FULL FILE PATH
                    ========================= */

                    $upload_path =
                        $upload_dir .
                        DIRECTORY_SEPARATOR .
                        $new_name;


                    /* =========================
                       MOVE FILE
                    ========================= */

                    if (
                        move_uploaded_file(
                            $file_tmp,
                            $upload_path
                        )
                    ) {


                        /* =========================
                           SAVE FILE NAME IN DATABASE
                        ========================= */

                        $update = mysqli_query(

                            $s,

                            "UPDATE employee
                             SET profile_picture='$new_name'
                             WHERE e_id='$user_id'"

                        );


                        if ($update) {

                            $message =
                                "Profile picture updated successfully!";

                            $message_type = "success";

                        } else {

                            $message =
                                "Image uploaded, but database update failed.";

                            $message_type = "error";

                        }

                    } else {

                        $message =
                            "Failed to move uploaded image.";

                        $message_type = "error";

                    }

                }

            }

        }

    }

}


/* =========================
   GET USER DATA
========================= */

$query = mysqli_query(

    $s,

    "SELECT username, profile_picture
     FROM employee
     WHERE e_id='$user_id'"

);


if (!$query) {

    die(
        "Database error: " .
        mysqli_error($s)
    );

}


$user = mysqli_fetch_assoc($query);


/* =========================
   PROFILE IMAGE
========================= */

if (
    !empty($user['profile_picture']) &&
    file_exists(
        __DIR__ .
        "/uploads/" .
        $user['profile_picture']
    )
) {

    $picture =
        "uploads/" .
        $user['profile_picture'];

} else {

    $picture =
        "uploads/default.png";

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>MiniChat - Profile</title>


<style>

/* =========================
   GENERAL
========================= */

* {
    box-sizing: border-box;
}

body {

    margin: 0;

    background:
        radial-gradient(
            circle at top,
            #211044,
            #0d0d0d 55%
        );

    color: white;

    font-family: Arial, sans-serif;

    display: flex;

    justify-content: center;

    align-items: center;

    min-height: 100vh;

}


/* =========================
   PROFILE BOX
========================= */

.profile-box {

    width: 400px;

    padding: 35px;

    background: rgba(24,24,24,0.95);

    border: 1px solid #333;

    border-radius: 24px;

    text-align: center;

    box-shadow:
        0 0 30px rgba(108,44,255,.25);

}


/* =========================
   TITLE
========================= */

.profile-box h1 {

    margin-top: 0;

    margin-bottom: 25px;

    font-size: 25px;

}


/* =========================
   PROFILE IMAGE
========================= */

.profile-box img {

    width: 140px;

    height: 140px;

    border-radius: 50%;

    object-fit: cover;

    border: 4px solid #6c2cff;

    box-shadow:
        0 0 20px rgba(108,44,255,.5);

    margin-bottom: 15px;

}


/* =========================
   USERNAME
========================= */

.profile-box h2 {

    margin-top: 5px;

    margin-bottom: 25px;

    font-size: 20px;

}


/* =========================
   FILE INPUT
========================= */

.profile-box input[type="file"] {

    width: 100%;

    padding: 12px;

    background: #292929;

    color: #ddd;

    border: 1px solid #444;

    border-radius: 10px;

    cursor: pointer;

}


/* =========================
   BUTTON
========================= */

button {

    width: 100%;

    margin-top: 20px;

    padding: 13px 25px;

    border: none;

    border-radius: 12px;

    background: #6c2cff;

    color: white;

    cursor: pointer;

    font-size: 15px;

    font-weight: bold;

    transition: .2s;

}


button:hover {

    background: #8147ff;

    transform: translateY(-2px);

    box-shadow:
        0 8px 20px rgba(108,44,255,.4);

}


/* =========================
   SUCCESS / ERROR
========================= */

.message {

    margin-top: 18px;

    padding: 10px;

    border-radius: 8px;

    font-size: 14px;

}


.success {

    color: #55e68a;

    background: rgba(85,230,138,.08);

}


.error {

    color: #ff5c5c;

    background: rgba(255,92,92,.08);

}


/* =========================
   BACK LINK
========================= */

.back {

    display: block;

    margin-top: 22px;

    color: #a970ff;

    text-decoration: none;

}


.back:hover {

    color: white;

}


/* =========================
   MOBILE
========================= */

@media (max-width: 500px) {

    .profile-box {

        width: 90%;

        padding: 25px;

    }

}

</style>

</head>


<body>


<div class="profile-box">


    <h1>
        👤 My Profile
    </h1>


    <!-- PROFILE IMAGE -->

    <img
        src="<?php echo htmlspecialchars($picture); ?>"
        alt="Profile Picture"
    >


    <!-- USERNAME -->

    <h2>

        <?php

        echo htmlspecialchars(
            $user['username']
        );

        ?>

    </h2>


    <!-- UPLOAD FORM -->

    <form

        action="profile.php"

        method="POST"

        enctype="multipart/form-data"

    >


        <input

            type="file"

            name="profile"

            accept=".jpg,.jpeg,.png,.webp"

            required

        >


        <button

            type="submit"

            name="upload"

        >

            📷 Upload Profile Picture

        </button>


    </form>


    <!-- MESSAGE -->

    <?php if ($message != ""): ?>

        <div
            class="message <?php echo $message_type; ?>"
        >

            <?php

            echo htmlspecialchars(
                $message
            );

            ?>

        </div>

    <?php endif; ?>


    <!-- BACK -->

    <a
        href="chat.php"
        class="back"
    >

        ← Back to MiniChat

    </a>


</div>


</body>

</html>