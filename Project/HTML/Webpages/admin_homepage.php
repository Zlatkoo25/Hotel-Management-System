<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="homepagestyle.css">
</head>
<body>

    
    <div>
        <h1>User found</h1>
    </div>

    <div>
        <img src="Images\Naujubillah.jpg" width="600">
    </div>


    <form action="logout.php" method="post"> 
        <input type="submit" name="logout" value="Logout"> 
    </form> 
    
</body>
</html>