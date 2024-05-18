<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NSU Hotels</title>
    <link rel="stylesheet" href="loginstyle.css">


</head>
<body>

    <a href="homepage.php" style="text-decoration: none; color: inherit;">
        <h1 style="background-color: beige;">NSU Hotel</h1>
    </a>
    <hr>

    <!-- if logged in, gets username from email by calling "username.php" 
    might be unnecessarily convoluted; might remove-->
    <?php
        if(isset($_SESSION['uid'])){ 
    ?> 
            <div class="derived_Username">

            <?php
                include('username.php');
            ?>
            </div>
    <?php } ?>


    <div> <!-- log in/out buttons -->
        <?php
        // Check if the user is logged in
        if(isset($_SESSION['uid'])) {
            // User is logged in, show logout button

            include('logoutbutton.html');
        } else {
        
            // User is not logged in, show login button
        
            include('loginbutton.html');
        }
        ?>
        
        <div>
            <?php
            // Check if the user is logged in
            if(isset($_SESSION['uid'])) {
                // User is logged in, show logout button
            ?>
                <form action="bookingpage.php" method="POST">
                <input type="submit" name="booking" value="Book" style="height: 30px; width: auto; position: absoulte; top: 8px; right: 16px;">
                </form>
            <?php
            } 
            ?>
        </div>
        
    </div>
    <hr>
    
    <div> <!-- this is the flavor text in the middle of the homepage -->
        <h2 style="font-size:x-large; position: static; width:100%; text-align:center; font-family: Tahoma, Geneva, Verdana, sans-serif;">
        Welcome to NSU Hotel</h2>
    </div>
    <div class="image_container" >
        
        <img src="Images/Single Room.jpg" width="33%" alt="Image 1">
        <img src="Images/Suite.jpg" width="33%" alt="Image 2">
        <img src="Images/VIP Room.jpg" width="33%" alt="Image 3">
    </div>
</body>
</html>