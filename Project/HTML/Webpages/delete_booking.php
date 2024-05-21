<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_no = $_POST['booking_no'];

    // Prepare the SQL delete statement
    $sql = "DELETE FROM booking WHERE booking_no = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the booking number to the statement
    mysqli_stmt_bind_param($stmt, 'i', $booking_no);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Set a session variable for the cancellation message
        $_SESSION['message'] = "Booking cancelled.";
        // Redirect back to the booking page after successful deletion
        header("Location: booking_ADMIN.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
