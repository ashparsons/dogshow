<?php
// CONNECT TO DATABASE
$conn = mysqli_connect("localhost", "root", "", "dog_show");

session_start();

//STORE SESSION
$user_check = $_SESSION['username'];

//GET USER INFO
$query = "SELECT * 
          FROM users 
          WHERE username = '$user_check'";

$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);

$login_session = $row['username'];
$login_picture = $row['image_path_user'];
$login_email = $row['email'];
$login_id = $row['user_id'];

?>