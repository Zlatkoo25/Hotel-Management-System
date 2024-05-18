<?php
    session_start();

    include('connection.php');


    // ($_SESSION['billstore']);
    // echo (gettype($_SESSION['booking_number']));
    // echo " ";
    // echo(var_dump($_SESSION['booking_number']));

    //echo 'finalized';
    $bno=$_SESSION['booking_number'];
    $bills=$_SESSION['billstore'];


    //must store the bill in booking table and finalize order
    $stmt1 = $conn->prepare("UPDATE booking SET bill = (?) WHERE booking_no = (?)");
    $stmt1->bind_param("di", $bills, $bno ); //generated booking no, stored customer id and 0 bill
    $stmt1 ->execute();

    // //fetching all from booking table
    $sql = "SELECT * FROM booking WHERE booking_no=$bno LIMIT 1";
    $result=mysqli_query($conn,$sql); //stores the result from the query
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC); //tuple-by-tuple attributes stored in array
    $count=mysqli_num_rows($result); //number of tuples in resulting relation

    //clear button
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
            if($count==1){
                foreach ($_SESSION['room_bookings'] as $booking) {
                    echo "<li>Room Category: " . $booking['room_category'] . "</li>";
                    echo "<li>Bed Type: " . $booking['bed_type'] . "</li>";
                    echo "<li>Check-In Date: " . $booking['check_in'] . "</li>";
                    echo "<li>Check-Out Date: " . $booking['check_out'] . "</li>";
                    echo "<br>";
                }
                echo "<li> Total Price: " . $bills . "</li>";
            }
            else{
                echo "error no matching order";
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
    <form action="thankYou.php" method="POST">
        <button type="submit" name="finalize_booking" class="button" style="height: 100px; background-color:brown"
        >Confirm</button>
    </form>
    <?php
    }
    ?>

</body>
</html>