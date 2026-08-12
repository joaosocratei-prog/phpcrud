<?php

include("connection.php");

$id = $_GET['id'];

$query = mysqli_query($sec, "DELETE FROM employee WHERE e_id = '$id'");
header("location: select.php");
?>