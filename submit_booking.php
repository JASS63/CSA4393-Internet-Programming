<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "car_rentals";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $id_proof = $_FILES['id_proof']['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Define car names by car ID
    $car_names = [
        1 => "JEEP Wrangler Rubicon",
        2 => "Skoda Octavia VRS",
        3 => "Volkswagen Passat",
        4 => "Rolls Royce Phantom",
        5 => "Audi A8L",
        6 => "Brabus G800",
        7 => "Mini Cooper",
        8 => "Aston Martin DB12",
        9 => "Ford Shelby Mustang G500KR",
        10 => "Nissan GT R-35",
        11 => "Bentley Continental GT",
        12 => "Mercedes Benz-Maybach",
        13 => "Toyota Supra",
        14 => "Audi Q8",
        15 => "Porsche 911 Turbo S",
        16 => "Lamborghini Aventador",
        17 => "Volvo XC90",
        18 => "Jeep Cherokee",
        19 => "BMW M5",
        20 => "Dodge CHallenger",
        21 => "Red Bull F1 Sports Car"
    ];

    // Get car name from car ID
    $car_name = isset($car_names[$car_id]) ? $car_names[$car_id] : 'Unknown Car';

    // Define rental prices based on car ID
    $rental_prices = [
        1 => 8000,
        2 => 2500,
        3 => 4500,
        4 => 60000,
        5 => 20000,
        6 => 20000,
        7 => 2000,
        8 => 25000,
        9 => 25000,
        10 => 25000,
        11 => 22000,
        12 => 40000,
        13 => 7900,
        14 => 20000,
        15 => 30000,
        16 => 80000,
        17 => 15000,
        18 => 17000,
        19 => 18000,
        20 => 12000,
        21 => 200000
    ];

    // Check if car_id exists in the rental prices
    if (!array_key_exists($car_id, $rental_prices)) {
        die("Invalid car ID.");
    }

    // Calculate the rental days
    $start_date_obj = new DateTime($start_date);
    $end_date_obj = new DateTime($end_date);
    $interval = $start_date_obj->diff($end_date_obj);
    $rental_days = $interval->days + 1; // Include the end date

    // Calculate the total amount
    $price_per_day = $rental_prices[$car_id];
    $total_amount = $price_per_day * $rental_days;

    // Handle file upload for ID proof
    $id_proof_dir = "uploads/id_proofs/";
    if (!is_dir($id_proof_dir)) {
        mkdir($id_proof_dir, 0755, true);
    }
    $id_proof_target_file = $id_proof_dir . basename($_FILES["id_proof"]["name"]);
    if (!move_uploaded_file($_FILES["id_proof"]["tmp_name"], $id_proof_target_file)) {
        die("Error uploading ID proof.");
    }

    // Get the username from session
    $username = $_SESSION['username'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bookings (car_id, car_name, name, phone, id_proof, start_date, end_date, total_amount, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("issssssis", $car_id, $car_name, $name, $phone, $id_proof, $start_date, $end_date, $total_amount, $username);

    // Execute the query
    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;
        $_SESSION['booking_id'] = $booking_id; // Store booking ID in session
        $_SESSION['total_amount'] = $total_amount; // Store total amount in session

        // Update the car status to booked
        $update_stmt = $conn->prepare("UPDATE cars SET is_booked = 1 WHERE id = ?");
        if ($update_stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $update_stmt->bind_param("i", $car_id);
        $update_stmt->execute();
        $update_stmt->close();

        header("Location: payment.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
