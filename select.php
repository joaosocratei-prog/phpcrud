<?php
include("connection.php");
$query = mysqli_query($sec,"SELECT * FROM user");
?>
<table border="4">
    <tr><th>id</th>
    <th>username</th>
    <th>password</th>
    <th colspan="4">option</th></tr>


<?php
while($q=mysqli_fetch_array($query)){
    echo"<tr><td>".$q['u_id']."</td>";
    echo"<td>".$q['username']."</td>";
    echo"<td>".$q['password']."</td></tr>";

}
?></table>