<?php
include 'databasecheck.php';
$user=$_POST['username'];
$sql= "SELECT username FROM myguests WHERE username=$user";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo json_encode(true);
}
else{
    echo json_encode(false);
}
?>