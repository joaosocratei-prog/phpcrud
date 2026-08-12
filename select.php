<?php
include("connection.php");
$query = mysqli_query($sec,"SELECT * FROM employee");
?>
<table border="4">
    <tr><th>id</th>
    <th>username</th>
    <th>email</th>
    <th>password</th>
    <th colspan="4">option</th></tr>


<?php
while($q=mysqli_fetch_array($query)){
    echo"<tr><td>".$q['e_id']."</td>";
    echo"<td>".$q['username']."</td>";
    echo"<td>".$q['email']."</td>";
    echo"<td>".$q['password']."</td>";
    echo "<td><a href='delete.php?id=".$q['e_id']."'>Delete</a></td>";

}
?></table>