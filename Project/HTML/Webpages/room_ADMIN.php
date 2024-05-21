<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle'])) {
    $room_no = $_POST['room_no'];
    $current_availability = $_POST['current_availability'];
    $new_availability = $current_availability ? 0 : 1;

    $update_sql = "UPDATE rooms SET available = $new_availability WHERE room_no = $room_no";
    mysqli_query($conn, $update_sql);
}

$sql = "SELECT * FROM rooms"; // Selecting all rooms information from the database
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
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

<h2>Room Information</h2>

<?php
if (mysqli_num_rows($result) > 0) {   // Checking if there are any rooms available
    echo "<table border='1' cellpadding='5'>"; 
    echo "<tr>
            <th>Room_No</th>
            <th>Category</th>
            <th>Beds</th>
            <th>Pricing</th>
            <th>Available</th>
            <th>Toggle Availability</th>
        </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['room_no'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['beds'] . "</td>";
        echo "<td>$" . $row['pricing'] . "</td>";
        echo "<td>" . ($row['available'] ? '1' : '0') . "</td>";
        echo "<td>
                <form method='POST'>
                    <input type='hidden' name='room_no' value='" . $row['room_no'] . "'>
                    <input type='hidden' name='current_availability' value='" . $row['available'] . "'>
                    <input type='submit' name='toggle' value='Toggle'>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No rooms available.";
}

mysqli_close($conn);
?>

<!-- Back Button -->
<div>
    <button class="back-button" onclick="window.history.back()">Back</button>
</div>

</body>
</html>
