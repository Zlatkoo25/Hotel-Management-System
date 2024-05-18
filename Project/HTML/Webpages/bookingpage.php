<?php
    session_start();
    include('connection.php');
    
// Check if booking_number is not already set in the session
    if (!isset($_SESSION['booking_number'])) {
        // Create a new booking
        $b = 0.0; // Initialize bill
        $_SESSION['booking_number']=0;
        $stmt1 = $conn->prepare("INSERT INTO booking (customer_id, bill) VALUES (?, ?)");
        $stmt1->bind_param("id", $_SESSION['uid'], $b); // Bind parameters
        $stmt1->execute(); // Execute the prepared statement

        // Check if the booking was successfully created
        if ($stmt1->affected_rows > 0) {
            // Fetch booking number from the newly inserted row
            $booking_number = $stmt1->insert_id; // Get the auto-generated booking number 

            // Store the booking number in the session variable
            $_SESSION['booking_number'] = $booking_number;
        } else {
            echo "Error creating booking.";
        }

        // Close the statement
        $stmt1->close();
    }

    // Close the database connection
    $conn->close();
    // // debugging booking_number type
    // echo (gettype($_SESSION['booking_number']));
    // echo " ";
    // echo(($_SESSION['booking_number']));
    // //echo(get_class($_SESSION['booking_number']));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="loginstyle.css">

</head>
<body>
    <a href="homepage.php" style="text-decoration: none; color: inherit;">
        <h1 style="background-color: beige;">NSU Hotel</h1>
    </a>
    <hr>

    <h2 style="background-color: antiquewhite;">Room Booking</h2>
    <div>
        <div>
            <img src="Images/VIP Room.jpg" width="800" style="float: right;">
        </div>

        <div style="position: relative;">
        <form action="booking.php" method="POST" style="position: absolute; top: 0; left: 0;"> 

            <label for="room_category">Room Category:</label>
            <select name="room_category" id="room_category" style="width: 100%;" required>
                <option value="" disabled selected>Select Room Category</option>
                <option value="Single Room">Single Room</option>
                <option value="Suite">Suite</option>
                <option value="VIP">VIP</option>
            </select><br><br>

            <label for="bed_type">Bed Type:</label>
            <select name="bed_type" id="bed_type" style="width: 100%;" required>
                <option value="" disabled selected>Select Bed Type</option>
                <option value="King Bed">King Bed</option>
                <option value="Queen Bed">Queen Bed</option>
            </select><br><br>

            <label for="check_in">From:</label>
            <input type="date" name="check_in" id="check_in" style="width: 100%;" required><br><br>

            <label for="check_out">To:</label>
            <input type="date" name="check_out" id="check_out" style="width: 100%;" required><br><br>

            <button type="submit" name="Add" class="button">Add</button>
        </form>

        </div>
    </div>
    
</body>
</html>
