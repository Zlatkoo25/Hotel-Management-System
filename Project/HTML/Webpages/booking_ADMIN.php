<?php
session_start();
include("connection.php");

$sql = "SELECT * FROM booking"; // Selecting all booking information from the database
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <style>
        body {
            background-color: #A9CCE3; 
            text-align: center;
        }
        
        table {
            border-collapse: collapse;
            border-color: #555555;
            text-align: center;
            margin: 0 auto;
            font-size: 14px;
            background-color: #CCCCCC; 
        }

        th, td {
            width: 120px;
            height: 30px;
        }

        th {
            background-color: #AEB6BF; 
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #AEB6BF;
            color: black;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #909497;
        }
    </style>
</head>
<body>

<h2>Booking Information</h2>

<?php
if (isset($_SESSION['message'])) {
    echo "<p style='color: green;'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']); // Clear the message after displaying it
}

if (mysqli_num_rows($result) > 0) {   // Checking if there are any bookings available
    echo "<table border='1' cellpadding='5'>"; 
    echo "<tr>
            <th>Booking No</th>
            <th>Customer ID</th>
            <th>Bill</th>
            <th>Action</th>
        </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['booking_no'] . "</td>";
        echo "<td>" . $row['customer_id'] . "</td>";
        echo "<td>$" . $row['bill'] . "</td>";
        echo "<td>
                <form method='post' action='delete_booking.php'>
                    <input type='hidden' name='booking_no' value='" . $row['booking_no'] . "'>
                    <input type='submit' value='Delete'>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No bookings available.";
}

mysqli_close($conn);
?>

<!-- Back Button -->
<button class="back-button" onclick="window.history.back()">Back</button>

</body>
</html>
