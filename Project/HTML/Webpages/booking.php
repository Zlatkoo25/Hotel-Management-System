<?php
session_start();

include('connection.php');

if (!isset($_SESSION['room_bookings'])) {
    $_SESSION['room_bookings'] = array();
}

if (!isset($_SESSION['billstore'])) {
    $_SESSION['billstore'] = 0.0;
}

$room_category = $bed_type = $check_in = $check_out = '';
$error_message = '';

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['room_category'])) {
        $room_category = sanitizeInput($_POST["room_category"]);
    } else {
        $error_message = "Room category is required.";
    }

    if (isset($_POST['bed_type'])) {
        $bed_type = sanitizeInput($_POST["bed_type"]);
    } else {
        $error_message = "Bed type is required.";
    }

    if (isset($_POST['check_in'])) {
        $check_in = sanitizeInput($_POST["check_in"]);
    } else {
        $error_message = "Check-in date is required.";
    }

    if (isset($_POST['check_out'])) {
        $check_out = sanitizeInput($_POST["check_out"]);
    } else {
        $error_message = "Check-out date is required.";
    }
    if((!empty($check_in) && !empty($check_out)) && ($check_in==$check_out)){
        $error_message = "Dates cannot be same.";
    }

    // If no error message, proceed to store booking details in the database
    if (empty($error_message)) {
        // Prepare statement to select the first room that matches the criteria and is available
        $stmt = $conn->prepare("SELECT * FROM rooms WHERE available=1 AND category=? AND beds=? LIMIT 1");
        $stmt->bind_param("ss", $room_category, $bed_type);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if there is a matching room
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Store each booking query as string associative array
            $roomno=$row['room_no'];
            $booking_details = array(
                'room_category' => $room_category,
                'bed_type' => $bed_type,
                'check_in' => $check_in,
                'check_out' => $check_out,
                'room_no' => $row['room_no']
            );
            $_SESSION['room_bookings'][] = $booking_details;
            
            //calculating the price for the number of days
            $start_date = new DateTime($_POST["check_in"]);
            $end_date = new DateTime($_POST["check_out"]);
            $interval = $start_date->diff($end_date);
            $daysElapsed = $interval->days;
            $pricePerDay = (float)$row['pricing']; 
            $totalPrice = (float)($daysElapsed * $pricePerDay);

            $_SESSION['billstore'] += (float)$totalPrice; // Ensure pricing is treated as a float

            $avb=0;
            $stm = $conn->prepare("UPDATE rooms SET available =(?) WHERE room_no=(?)");
            $stm->bind_param("ii", $avb,$roomno ); 
            $stm ->execute();
            $stm ->close();
            
        } else {
            $error_message = "No available rooms matching the criteria.";
        }

        $stmt->close();
    }
    else{
        echo $error_message;
    }
}

// Clear booking logic
include('clearbooking.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

    <a href="homepage.php" style="text-decoration: none; color: inherit;">
        <h1 style="background-color: beige;">NSU Hotel</h1>
    </a>

    <h2>Booking Confirmation</h2>
    <p>Your booking details:</p>
    <ul>
        <?php
            // Display the stored booking details
            if (isset($_SESSION['room_bookings']) && !empty($_SESSION['room_bookings'])) {
                foreach ($_SESSION['room_bookings'] as $booking) {
                    echo "<li>Room Category: " . $booking['room_category'] . "</li>";
                    echo "<li>Bed Type: " . $booking['bed_type'] . "</li>";
                    echo "<li>Check-In Date: " . $booking['check_in'] . "</li>";
                    echo "<li>Check-Out Date: " . $booking['check_out'] . "</li>";
                    echo "<li>Room Number: " . $booking['room_no'] . "</li>";
                    echo "<br>";
                }
                echo "<li>Total Bill: " . $_SESSION['billstore'] . "</li>";
            } else {
                echo "No bookings found";
            }
        ?>
    </ul>

    <form action="" method="POST">
        <button type="submit" name="clear_bookings" class="button">Clear All Bookings</button>
    </form>

    <a href="bookingpage.php" class="button">Add Another</a>
    
    <?php 
    if(!empty($_SESSION['room_bookings'])){
    ?>
    <form action="finalizebooking.php" method="POST">
        <button type="submit" name="finalize_booking" class="button" style="height: 100px; background-color:brown">Finalize Booking</button>
    </form>
    <?php
    }
    ?>

</body>
</html>
