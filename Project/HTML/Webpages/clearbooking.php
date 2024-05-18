<?php
// Clear booking logic
if (isset($_POST['clear_bookings'])) {
    
    // Assuming booking_number is stored in session from a previous process
    if (isset($_SESSION['booking_number'])) {
        //reset the availability
        foreach ($_SESSION['room_bookings'] as $booking){
            $stm3 = $conn->prepare("UPDATE rooms SET available = 1 WHERE room_no=(?)");
            $stm3->bind_param("i",$booking['room_no'] ); //generated booking no, stored customer id and 0 bill
            $stm3 ->execute();
            $stm3 -> close();
        }
        //clear the booking data for the booking_no.
        if (isset($_SESSION['booking_number'])) {
            $bookno= $_SESSION['booking_number'];
            // Constructing the SQL query directly to delete all from booking table
            $sql = "DELETE FROM booking";
        
            // Executing the query
            if ($conn->query($sql) === TRUE) {
                echo "Booking deleted successfully.";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Booking number is not set.";
        }

    }

    $_SESSION['room_bookings'] = array(); // Clear all bookings
    $_SESSION['billstore'] = 0.0; // Reset the bill to zero
    unset($_SESSION['booking_number']);
}