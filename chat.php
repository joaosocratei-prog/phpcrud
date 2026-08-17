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

$current_user = $_SESSION['user_id'];
$username = $_SESSION['username'];
$profile_query = mysqli_query(
    $s,
    "SELECT profile_picture
     FROM employee
     WHERE e_id='$current_user'"
);

$profile_data = mysqli_fetch_assoc($profile_query);

$profile_picture = !empty($profile_data['profile_picture'])
    ? "uploads/" . $profile_data['profile_picture']
    : "uploads/default.png";

$receiver_id = null;

/* =========================
   GET SELECTED USER
========================= */

if (isset($_GET['user'])) {
    $receiver_id = intval($_GET['user']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>MiniChat</title>


<style>

/* =========================
   GENERAL
========================= */
.search-box {
    margin-bottom: 15px;
}

.search-box input {
    width: 100%;
    height: 42px;

    padding: 0 14px;

    border: 1px solid #333;
    outline: none;

    border-radius: 12px;

    background: #292929;
    color: white;

    font-size: 14px;

    transition: 0.2s;
}

.search-box input::placeholder {
    color: #888;
}

.search-box input:focus {
    border-color: #6c2cff;
    box-shadow: 0 0 8px rgba(108, 44, 255, 0.5);
}

.user-chat {
    transition: 0.2s;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    background: #0d0d0d;
    color: white;
    font-family: Arial, sans-serif;
    overflow: hidden;
}


/* =========================
   APP
========================= */

.chat-app {

    height: 100vh;

    display: grid;

    grid-template-columns: 260px 1fr;

    grid-template-rows: 70px 1fr;
}


/* =========================
   HEADER
========================= */

header {

    grid-column: 1 / 3;

    background: #181818;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 25px;

    border-bottom: 1px solid #292929;
}


.logo {

    display: flex;

    align-items: center;

    gap: 10px;

    font-size: 23px;

    font-weight: bold;
}


.profile {

    display: flex;

    align-items: center;

    gap: 10px;

    font-size: 16px;
}


.profile img {

    width: 40px;

    height: 40px;

    border-radius: 50%;

    object-fit: cover;
}


.logout {

    margin-left: 15px;

    padding: 10px 16px;

    background: #6c2cff;

    color: white;

    text-decoration: none;

    border-radius: 8px;

    transition: 0.2s;
}


.logout:hover {

    background: #8147ff;

    transform: translateY(-2px);
}


/* =========================
   SIDEBAR
========================= */

aside {

    background: #181818;

    padding: 20px;

    border-right: 1px solid #292929;

    overflow-y: auto;
}


aside h3 {

    margin-top: 0;

    font-size: 20px;
}


.user-chat {

    padding: 12px;

    margin: 5px 0;

    border-radius: 10px;

    transition: 0.2s;
}


.user-chat:hover {

    background: #292929;
}


.user-chat a {

    color: #a970ff;

    text-decoration: none;

    font-size: 16px;
}


/* =========================
   MAIN CHAT
========================= */

main {

    background: #0d0d0d;

    height: calc(100vh - 70px);

    display: flex;

    flex-direction: column;

    min-width: 0;
}



/* =========================
   SELECTED USER
========================= */

.chat-header {

    height: 60px;

    min-height: 60px;

    background: #151515;

    border-bottom: 1px solid #292929;

    display: flex;

    align-items: center;

    padding: 0 20px;

    font-size: 18px;

    font-weight: bold;
}


.chat-header small {

    margin-left: 10px;

    color: #55e68a;

    font-size: 13px;
}


/* =========================
   MESSAGES
========================= */

.messages {

    flex: 1;

    overflow-y: auto;

    padding: 25px;

    display: flex;

    flex-direction: column;

    gap: 12px;

    scroll-behavior: smooth;
}


/* =========================
   MESSAGE
========================= */

.message {

    max-width: 65%;

    width: fit-content;

    padding: 10px 14px;

    border-radius: 16px;

    word-wrap: break-word;
}


.message small {

    display: block;

    font-size: 11px;

    margin-bottom: 4px;

    opacity: 0.75;
}


.message p {

    margin: 0;

    font-size: 15px;

    line-height: 1.4;
}


.message span {

    display: block;

    margin-top: 5px;

    font-size: 10px;

    opacity: 0.65;
}


/* =========================
   RECEIVED
========================= */

.received {

    align-self: flex-start;

    background: #292929;

    border-bottom-left-radius: 4px;
}


/* =========================
   SENT
========================= */

.sent {

    align-self: flex-end;

    background: #6c2cff;

    border-bottom-right-radius: 4px;
}


/* =========================
   MESSAGE FORM
========================= */

.message-form {

    width: 100%;

    display: flex;

    gap: 10px;

    padding: 15px 20px;

    background: #151515;

    border-top: 1px solid #292929;
}


.message-form input {

    flex: 1;

    height: 48px;

    padding: 0 16px;

    border: none;

    outline: none;

    border-radius: 25px;

    background: #292929;

    color: white;

    font-size: 15px;
}


.message-form input::placeholder {

    color: #999;
}


.message-form button {

    width: 50px;

    height: 48px;

    border: none;

    border-radius: 50%;

    background: #6c2cff;

    color: white;

    font-size: 20px;

    cursor: pointer;

    transition: 0.2s;
}


.message-form button:hover {

    transform: scale(1.08);

    background: #8147ff;
}


/* =========================
   SCROLLBAR
========================= */

.messages::-webkit-scrollbar {

    width: 7px;
}


.messages::-webkit-scrollbar-track {

    background: #111;
}


.messages::-webkit-scrollbar-thumb {

    background: #444;

    border-radius: 10px;
}


.messages::-webkit-scrollbar-thumb:hover {

    background: #6c2cff;
}


/* =========================
   WELCOME
========================= */

.welcome {

    display: flex;

    flex-direction: column;

    justify-content: center;

    align-items: center;

    height: 100%;

    color: #aaa;
}

</style>

</head>


<body>


<div class="chat-app">


<!-- =========================
     HEADER
========================= -->

<header>

    <div class="logo">

        💬 MiniChat

    </div>


    <div class="profile">

      <a href="profile.php" style="text-decoration: none; color: white;">
    👤 <?php echo htmlspecialchars($username); ?>
</a>


        <a href="logout.php" class="logout">
            Logout
        </a>

    </div>

</header>



<!-- =========================
     SIDEBAR
========================= -->

<aside>

    <h3>💬 Chats</h3>

    <div class="search-box">

        <input
            type="text"
            id="searchUsers"
            placeholder="🔍 Search chats..."
            autocomplete="off"
        >

    </div>

    <div id="usersList">

        <?php

        $users = mysqli_query(
            $s,
            "SELECT e_id, username
             FROM employee
             WHERE e_id != '$current_user'
             ORDER BY username ASC"
        );

        while ($user = mysqli_fetch_assoc($users)) {

            $other_id = $user['e_id'];

            $count = mysqli_query(
                $s,
                "SELECT COUNT(*) AS total
                 FROM messages
                 WHERE user_id = '$other_id'
                 AND receiver_id = '$current_user'
                 AND is_read = 0"
            );

            $row = mysqli_fetch_assoc($count);

            $unread = $row['total'];

        ?>

            <div
                class="user-chat"
                data-username="<?php echo strtolower(htmlspecialchars($user['username'])); ?>"
            >

                <a href="chat.php?user=<?php echo $other_id; ?>">

                    <span class="online">🟢</span>

                    <span class="username">
                        <?php echo htmlspecialchars($user['username']); ?>
                    </span>

                    <?php if ($unread > 0): ?>

                        <span class="notification">
                            <?php echo $unread; ?>
                        </span>

                    <?php endif; ?>

                </a>

            </div>

        <?php

        }

        ?>

    </div>

</aside>


<!-- =========================
     CHAT AREA
========================= -->

<?php if ($receiver_id == null): ?>


    <main>

        <div class="welcome">

            <h2>💬 MiniChat</h2>

            <p>
                Select someone to start chatting.
            </p>

        </div>

    </main>


<?php else: ?>


<?php

/* =========================
   GET RECEIVER
========================= */

$receiver_query = mysqli_query(

    $s,

    "SELECT e_id, username
     FROM employee
     WHERE e_id='$receiver_id'"

);


$receiver = mysqli_fetch_assoc($receiver_query);


/* =========================
   GET MESSAGES
========================= */

$query = mysqli_query(

    $s,

    "SELECT
        messages.*,
        employee.username

     FROM messages

     INNER JOIN employee

     ON messages.user_id = employee.e_id

     WHERE

     (
        messages.user_id='$current_user'
        AND
        messages.receiver_id='$receiver_id'
     )

     OR

     (
        messages.user_id='$receiver_id'
        AND
        messages.receiver_id='$current_user'
     )

     ORDER BY messages.created_at ASC"

);

?>


<main>


<!-- =========================
     SELECTED USER
========================= -->

<div class="chat-header">

    👤

    <?php

    echo htmlspecialchars(
        $receiver['username']
    );

    ?>

    <small>
        🟢 Online
    </small>

</div>



<!-- =========================
     MESSAGES
========================= -->

<div class="messages">


<?php

if (!$query) {

    echo "<p style='color:red;'>"
        . mysqli_error($s)
        . "</p>";

}

else {


    while (
        $msg = mysqli_fetch_assoc($query)
    ) {


        /* =====================
           SENT OR RECEIVED
        ===================== */

        if (
            $msg['user_id'] == $current_user
        ) {

            $class = "sent";

        }

        else {

            $class = "received";

        }


?>


<div class="message <?php echo $class; ?>">


    <small>

        <?php

        echo htmlspecialchars(
            $msg['username']
        );

        ?>

    </small>


    <p>

        <?php

        echo htmlspecialchars(
            $msg['message']
        );

        ?>

    </p>


    <span>

        <?php

        echo date(
            "H:i",
            strtotime(
                $msg['created_at']
            )
        );

        ?>

    </span>


</div>


<?php

    }

}

?>


</div>



<!-- =========================
     SEND MESSAGE
========================= -->

<form
    action="send.php"
    method="POST"
    class="message-form"
>


    <input

        type="hidden"

        name="receiver_id"

        value="<?php echo $receiver_id; ?>"

    >


    <input

        type="text"

        name="message"

        placeholder="Write a message..."

        autocomplete="off"

        required

    >


    <button

        type="submit"

        name="send"

    >

        ➤

    </button>


</form>


</main>


<?php endif; ?>


</div>



<!-- =========================
     AUTO SCROLL
========================= -->

<script>

const searchInput =
    document.getElementById("searchUsers");

const usersList =
    document.getElementById("usersList");


searchInput.addEventListener("input", function () {

    const searchValue =
        this.value.toLowerCase().trim();

    const users =
        usersList.querySelectorAll(".user-chat");


    users.forEach(function (user) {

        const username =
            user.dataset.username;

        if (username.includes(searchValue)) {

            user.style.display = "block";

        } else {

            user.style.display = "none";

        }

    });

});

</script>


</body>

</html>