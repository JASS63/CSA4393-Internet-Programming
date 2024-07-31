<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "car_rentals";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user bookings
$username = $_SESSION['username'];
$sql = "SELECT * FROM bookings WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #d3cce3, #e9e4f0);
            color: #333;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
        }
        nav a {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }
        nav a:hover {
            background-color: #555;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-bookings {
            font-size: 1.2em;
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>My Bookings</h1>
    </header>
    <nav>
        <a href="homepage.php">Home</a>
        <a href="vehicles.html">Vehicles</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <h2>Your Bookings</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>Car ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>ID Proof</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Amount</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['car_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_proof']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_amount']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="no-bookings">No bookings found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close statement and connection
$stmt->close();
$conn->close();
?>
