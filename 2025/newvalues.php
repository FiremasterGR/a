<?php
include 'databasecheck.php';
$_SESSION['page_count'] = 0;
$username=$_SESSION['username'];
$usernamenew=$_POST['username'];
$passwordnew=$_POST['password'];
$_SESSION['username_error'] = 'false';
$emailnew=$_POST['email'];
$phone=$_POST['phone'];
$phonenew = preg_replace("/[^0-9]/", "", $phone);
$birthdatenew=$_POST['birthdate'];
if (!$usernamenew==$username){
$sql="SELECT username FROM myguests WHERE username='$usernamenew'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
        $_SESSION['username_error'] = 'true';
        header("Location: main_page.html");
}}
    $sql="UPDATE myGuests SET username = '$usernamenew', password = '$passwordnew', email='$emailnew', phone='$phonenew', birthdate='$birthdatenew' WHERE username = '$username'";
    $result = $conn->query($sql);
    $sql="SELECT username FROM myguests";
    $_SESSION['usernames']=$conn->query($sql);
    $_SESSION['password']=$passwordnew;
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
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check == false) {
            $_SESSION['image_error']='true';
            header("Location: main_page.html");
        }
        $file = $_FILES['image'];
        $image = pathinfo($file['name'], PATHINFO_EXTENSION);
        $_SESSION['image']=$image;
        $sql="UPDATE myGuests SET image = '$image' WHERE username = '$usernamenew'";
        $result = $conn->query($sql);
        $target_file = "pictures/";
        $new_file_name = $usernamenew.'.'.$image;
        $target_file = $target_file.$new_file_name;
        $sql="SELECT image FROM myguests WHERE username='$usernamenew'";
        $image = $conn->query($sql);
        $row = mysqli_fetch_assoc($image);
        $_SESSION['image']=$row;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            header("Location: main_page.html");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
        header("Location: main_page.html");
?>