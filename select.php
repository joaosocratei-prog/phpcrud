<?php
include("connection.php");

$query = mysqli_query(
    $s,
    "SELECT 
        messages.*,
        employee.username
     FROM messages
     INNER JOIN employee
     ON messages.user_id = employee.e_id
     WHERE 
        (messages.user_id='$current_user'
        AND messages.receiver_id='$receiver_id')
        OR
        (messages.user_id='$receiver_id'
        AND messages.receiver_id='$current_user')
     ORDER BY messages.created_at ASC"
);
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