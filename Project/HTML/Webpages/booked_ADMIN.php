<?php
session_start();
include("connection.php");

// Check if the user is an admin
if (!isset($_SESSION['uid']) || !isset($_SESSION['email'])) {
    header('Location: loginpage.php');
    exit;
}

// Fetch user details from the database
$sql = "SELECT * FROM booked";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error retrieving user data: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booked Rooms</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            background-color: beige;
            padding: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .admin {
            background-color: #ffcccc;
        }
        .normal {
            background-color: #ccffcc;
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

    <h1>Booked Rooms</h1>
    <table>
        <tr>
            <th>Room no.</th>
            <th>Booking no.</th>
            <th>b_from</th>
            <th>b_to</th>
        </tr>

        <?php
        // Loop through the results and display the user details
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<td>" . htmlspecialchars($row['room_no']) . "</td>";
            echo "<td>" . htmlspecialchars($row['booking_no']) . "</td>";
            echo "<td>" . htmlspecialchars($row['b_from']) . "</td>";
            echo "<td>" . htmlspecialchars($row['b_to']) . "</td>";
            echo "</tr>";
        }
        ?>

    </table>

    <!-- Back Button -->
    <button class="back-button" onclick="window.history.back()">Back</button>
    
</body>
</html>

<?php
mysqli_close($conn);
?>
