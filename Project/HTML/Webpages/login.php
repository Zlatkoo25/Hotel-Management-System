<?php
session_start();
include("connection.php");
// Get the submitted email and password from loginpage.php
$email = $_POST['email'];
$password = $_POST['password'];
$password=sha1($password); //stored the hash

//below are text formatting to remove potential issues in mysql queries
$email=stripcslashes($email);
$password=stripcslashes($password);
$email=mysqli_real_escape_string($conn,$email);
$password=mysqli_real_escape_string($conn,$password);

$sql="SELECT * FROM users WHERE email='$email' and pass='$password'"; //stores the query in string
$result=mysqli_query($conn,$sql); //stores the result from the query
$row=mysqli_fetch_array($result,MYSQLI_ASSOC); //tuple-by-tuple attributes stored in array
$count=mysqli_num_rows($result); //number of tuples in resulting relation

if ($count==1) {
    $_SESSION['uid']=$row['user_id'];
    $_SESSION['email']=$row['email'];
    if($row['isAdmin']==1){ //redirection for admins
        header('Location: admin_homepage.php');//change to landing page for admins
    }
    else{//redirection for normal users
        header('Location: homepage.php');//change to booking page

    }
}
else {
    //Default redirection if no specific conditions are met
    header('Location: loginpage.php');
}

session_commit();
exit;
