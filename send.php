<?php

session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['send'])) {

    $user_id = $_SESSION['user_id'];

    $receiver_id = intval($_POST['receiver_id']);

    $message = trim($_POST['message']);

    // Check receiver
    if ($receiver_id <= 0) {
        die("Please select a user.");
    }

    // Check empty message
    if ($message == "") {
        header("Location: chat.php?user=$receiver_id");
        exit();
    }

    // Prevent sending to yourself
    if ($receiver_id == $user_id) {
        die("You cannot send a message to yourself.");
    }

    // Protect message
    $message = mysqli_real_escape_string($s, $message);

    // Insert message
    $query = mysqli_query(
        $s,
        "INSERT INTO messages
        (user_id, receiver_id, message, is_read)
        VALUES
        ('$user_id', '$receiver_id', '$message', 0)"
    );

    if ($query) {

        header("Location: chat.php?user=$receiver_id");
        exit();

    } else {

        echo "Database Error: " . mysqli_error($s);

    }
}

?>