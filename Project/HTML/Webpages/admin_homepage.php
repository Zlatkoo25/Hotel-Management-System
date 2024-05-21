<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff; /* Light blue background color */
            font-family: Arial, sans-serif;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .button-container button {
            width: 200px;
            height: 50px;
            font-size: 16px;
            margin: 10px;
            background-color: #4CAF50; /* Green background color */
            color: white; /* White text color */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .logout-container {
            position: absolute;
            bottom: 20px;
        }
        .logout-container input[type="submit"] {
            width: 200px;
            height: 50px;
            font-size: 16px;
            background-color: #f44336; /* Red background color */
            color: white; /* White text color */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-container input[type="submit"]:hover {
            background-color: #e53935; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <h1>
        Admin Homepage
    </h1>
    <hr>

    <div class="button-container">
        <button onclick="location.href='booked_ADMIN.php'">Booked</button>
        <button onclick="location.href='booking_ADMIN.php'">Booking</button>
        <button onclick="location.href='room_ADMIN.php'">Rooms</button>
        <button onclick="location.href='users_ADMIN.php'">Users</button>
    </div>

    <div class="logout-container">
        <form action="logout.php" method="post"> 
            <input type="submit" name="logout" value="Logout"> 
        </form>
    </div>
    
</body>
</html>
