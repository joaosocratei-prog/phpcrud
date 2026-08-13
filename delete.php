<?php

include("connection.php");

$id = $_GET['id'];

$query = mysqli_query($s, "DELETE FROM employee WHERE e_id='$id'");
header("location: select.php");
?>