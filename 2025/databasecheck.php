<?php
session_start();
$_SESSION['sign_up_error']='false';
$_SESSION['login_username_error']='false';
$_SESSION['login_password_error']='false';
$_SESSION['username_error'] = 'false';
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "SHOW DATABASES LIKE '$dbname'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
$sql = "CREATE DATABASE userdatabase";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}}

$conn->close();
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

  @$sql = "CREATE TABLE IF NOT EXISTS myGuests (
  username VARCHAR(50) NOT NULL PRIMARY KEY,
  password VARCHAR(50) NOT NULL,
  email VARCHAR(50),
  phone VARCHAR(20),
  birthdate DATE,
  image VARCHAR(50)
  )";
if ($conn->query($sql) === TRUE) {
  echo "Table myGuests created successfully";}
else {
  echo "Error creating table: " . $conn->error;
}
ob_end_clean();
?>