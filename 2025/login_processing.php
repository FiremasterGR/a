<?php
include 'databasecheck.php';
$_SESSION['login_count'] = 0;
$username=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT username FROM myguests WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql="SELECT password FROM myguests WHERE password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['login_password_error']='false';
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;
        $sql="SELECT email FROM myguests WHERE username='$username'";
        $email = $conn->query($sql);
        $row = mysqli_fetch_assoc($email);
        $_SESSION['email']=$row;
        $sql="SELECT phone FROM myguests WHERE username='$username'";
        $phone = $conn->query($sql);
        $row = mysqli_fetch_assoc($phone);
        $_SESSION['phone']=$row;
        $sql="SELECT birthdate FROM myguests WHERE username='$username'";
        $birthdate = $conn->query($sql);
        $row = mysqli_fetch_assoc($birthdate);
        $_SESSION['birthdate']=$row;
        $sql="SELECT image FROM myguests WHERE username='$username'";
        $image = $conn->query($sql);
        $row = mysqli_fetch_assoc($image);
        $_SESSION['image']=$row;
        header("Location: main_page.html");
    }
    else{
    $_SESSION['login_password_error']='true';
    header("Location: login.html");
    }}
else{
    $_SESSION['login_username_error']='true';
    header("Location: login.html");
}
?>