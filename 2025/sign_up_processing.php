<?php
include 'databasecheck.php';
$_SESSION['signup_count']=0;
$username=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT username FROM myguests WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $_SESSION['sign_up_error']='true';
    header("Location: sign_up.html");
}
else{
    $_SESSION['sign_up_error']='false';
    $sql = "INSERT INTO myGuests
    VALUES ('$username', '$password', NULL, NULL, NULL, NULL)";
    $conn->query($sql);
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    header("Location: main_page.html");
}
?>