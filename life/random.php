<?php
require_once 'config.php';
$db= mysqli_connect($dbhost, $dbuser, $dbpassword, $database);
$query="select cid,name,phone,address,dob from customer where policy_no=3";
$result=mysqli_query($db,$query);
echo "<table>";
echo "<tr><th>cid</th><th>name</th><th>phone</th><th>address</th><th>dob</th></tr>";
while($row=mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>".$row[0]."</td>";
    echo "<td>".$row[1]."</td>";
    echo "<td>".$row[2]."</td>";
    echo "<td>".$row[3]."</td>";
    echo "<td>".$row[4]."</td>";
    echo "</tr>";
}
echo "</table>";