<?php
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "car_rentals";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Prepare and execute query to fetch booking details
    $stmt = $conn->prepare("SELECT id, name, phone, id_proof, start_date, end_date FROM bookings WHERE id = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->bind_result($car_id, $name, $phone, $id_proof, $start_date, $end_date);
    $stmt->fetch();
    $stmt->close();

    // Prepare and execute query to fetch car details
    $car_stmt = $conn->prepare("SELECT name, description FROM cars WHERE id = ?");
    if ($car_stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $car_stmt->bind_param("i", $car_id);
    $car_stmt->execute();
    $car_stmt->bind_result($car_name, $car_description);
    $car_stmt->fetch();
    $car_stmt->close();
} else {
    die("Booking ID not provided.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #ff6f61;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        .vehicle-details img {
            max-width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }
        .vehicle-details h3 {
            color: #ff6f61;
            margin: 20px 0 10px;
        }
        .vehicle-details p {
            font-size: 1em;
            line-height: 1.4;
            color: #666;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6f61;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button-container a:hover {
            background-color: #ff3f31;
        }
    </style>
</head>
<body>

<header>
    <h1>Booking Confirmation</h1>
</header>

<div class="container">
    <h2>Booking Details</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
    <p><strong>Start Date:</strong> <?php echo htmlspecialchars($start_date); ?></p>
    <p><strong>End Date:</strong> <?php echo htmlspecialchars($end_date); ?></p>
    <p><strong>ID Proof:</strong> <a href="uploads/id_proofs/<?php echo htmlspecialchars($id_proof); ?>" target="_blank">View</a></p>

    <h2>Vehicle Details</h2>
    <div class="vehicle-details">
        <img src="uploads/car_images/<?php echo htmlspecialchars($car_id); ?>.jpg" alt="<?php echo htmlspecialchars($car_name); ?>">
        <h3><?php echo htmlspecialchars($car_name); ?></h3>
        <p><?php echo htmlspecialchars($car_description); ?></p>
    </div>

    <div class="button-container">
        <a href="homepage.php">Return to Homepage</a>
    </div>
</div>

</body>
</html>
