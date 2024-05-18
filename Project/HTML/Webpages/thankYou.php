<?php
session_start();

include('connection.php');

$bookings = $_SESSION['room_bookings'];


if (isset($bookings) && is_array($bookings)) {
    
    $stmt = $conn->prepare("INSERT INTO booked (room_no, booking_no, b_from, b_to) VALUES (?, ?, ?, ?)");

    if ($stmt) {
        
        $stmt->bind_param("iiss", $room_no, $booking_no, $b_from, $b_to);

        
        foreach ($bookings as $booking) {
            // Assuming each booking is an associative array with keys: room_no, booking_no, b_from, and b_to
            $room_no = $booking['room_no'];
            $booking_no = $_SESSION['booking_number'];
            $b_from = $booking['check_in'];
            $b_to = $booking['check_out'];

            // Execute the prepared statement with the current booking's data
            $stmt->execute();
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle error in preparing the statement
        echo "Error preparing statement: " . $conn->error;
    }
}

// Clear session variables
unset($_SESSION['room_bookings']); // Clear all bookings
unset($_SESSION['billstore']); // Reset the bill to zero
unset($_SESSION['booking_number']); // Reset booking_number variable

// Close the database connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You for Your Booking</title>
    <link rel="stylesheet" href="loginstyle.css">
    <style>
        .container {
            margin-top: 100px;
            text-align: center;
        }
        h2 {
            color: #006600;
        }
    </style>
</head>
<body>

    <a href="homepage.php" style="text-decoration: none; color: inherit;">
        <h1 style="background-color: beige;">NSU Hotel</h1>
    </a>
    <hr>

    <div class="container">
        <h2>Thank You for Your Booking</h2>
        <p>We appreciate your business and look forward to serving you.</p>
        <p>For any inquiries or changes to your booking, please feel free to contact us.</p>
    </div>
</body>
</html>
