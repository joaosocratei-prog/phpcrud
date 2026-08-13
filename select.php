<?php
include("connection.php");

$query = mysqli_query($s, "SELECT * FROM employee");

if (!$query) {
    die("SELECT ERROR: " . mysqli_error($s));
}
?>

<table border="4">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>birth_date</th>
        <th>phone</th>
        <th>Email</th>
        <th>Password</th>
        <th>Option</th>
    </tr>

<?php
while ($q = mysqli_fetch_array($query)) {

    echo "<tr>";
    echo "<td>".$q['e_id']."</td>";
    echo "<td>".$q['username']."</td>";
    echo "<td>".$q['birth_date']."</td>";
    echo "<td>".$q['phone']."</td>";
    echo "<td>".$q['email']."</td>";
    echo "<td>".$q['password']."</td>";
    echo "<td><a href='delete.php?id=".$q['e_id']."'>Delete</a></td>";
    echo "</tr>";
}
?>

</table>