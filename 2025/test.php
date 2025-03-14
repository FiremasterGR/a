<?php
include 'databasecheck.php';
$user=$_POST['username'];
    echo json_encode(['success' => $user]);
}
?>