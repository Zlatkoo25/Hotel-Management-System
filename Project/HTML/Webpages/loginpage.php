<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <a href="homepage.php" style="text-decoration: none; color: inherit;">
        <h1 style="background-color: beige;">NSU Hotel</h1>
    </a>
    <hr>

    <div class="login form">
        
        <form action="login.php" method="POST">
            <div class="email">
                <label for="Email">Email: </label>
                <input type="email" name="email" id="Email" placeholder="Enter email" required>
            </div>
            <br>
            <div class="password">
                <label for="Password">Password: </label>
                <input type="password" name="password" id="Password" placeholder="Enter password" required>
            </div>
            <br>
            <div>
                <input type="reset"> <input type="submit" name="submit">
            </div>
            
        </form>
    </div>
        <div style="text-align: center;">
            <img src="Images/Exterior.jpg" width="44%" style="border: 0px;" alt="Test Image">
            <img src="Images/Exterior2.jpg" width="40%" alt="Test cat">
        </div>
    <div> <!-- this is the flavor text in the middle of the homepage -->
        <h2 style="font-size:xx-large; position: static; width:100%; text-align:center; font-family: Tahoma, Geneva, Verdana, sans-serif;">
        Log in to NSU Hotel</h2>
    </div>

    
</body>
</html>