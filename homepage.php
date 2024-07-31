<?php
session_start();

// Assuming the username is stored in the session after login
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Vehicle Rental System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        header {
            background-color: #004d40;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        header .logout-button {
            position: absolute;
            right: 20px;
            top: 20px;
            background-color: #d32f2f;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        header .logout-button:hover {
            background-color: #b71c1c;
            transform: scale(1.05);
        }

        header .welcome-message {
            position: absolute;
            left: 20px;
            top: 20px;
            font-size: 1.2em;
            color: #ffffff;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #00796b;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: #ffffff;
            padding: 14px 25px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 1.1em;
        }

        nav a:hover {
            background-color: #004d40;
            color: #ffffff;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        #welcome {
            text-align: center;
            padding: 50px 20px;
            background: url('img1.jpg') no-repeat center center/cover;
            color: #ffffff;
            position: relative;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #welcome::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Black overlay with 50% opacity */
            z-index: 1;
            border-radius: 10px;
        }

        #welcome h2, #welcome p, .cta-button {
            position: relative;
            z-index: 2;
        }

        #welcome h2 {
            font-size: 3em;
            margin-bottom: 20px;
            font-weight: 700;
        }

        #welcome p {
            font-size: 1.2em;
            max-width: 800px;
            margin: auto;
            line-height: 1.6;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            margin-top: 20px;
            background-color: #00796b;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .cta-button:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }

        .vehicles-section {
            text-align: center;
            padding: 50px 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .vehicles-section h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .vehicle-card {
            display: inline-block;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 20px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .vehicle-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .vehicle-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .vehicle-card img:hover {
            transform: scale(1.1);
        }

        .vehicle-card h3 {
            padding: 20px;
            font-size: 1.5em;
            font-weight: 600;
        }

        .vehicle-card p {
            padding: 0 20px 20px;
            font-size: 1em;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<header>
    <h1>Vehicle Rental System</h1>
    <a href="logout.php" class="logout-button">Logout</a>
    <div class="welcome-message">Welcome, <?php echo htmlspecialchars($username); ?>!</div>
</header>

<nav>
    <a href="homepage.php">Home</a>
    <a href="vehicles.html">Vehicles</a>
    <a href="booking.php">My Bookings</a>
    <a href="aboutus.html">About Us</a>

</nav>

<div class="container">
    <section id="welcome">
        <h2>Welcome to Our Vehicle Rental System</h2>
        <p>Discover our wide range of vehicles and find the perfect one for your needs. Whether you're looking for a compact car for city driving or a spacious SUV for a family trip, we have something for everyone.</p>
        <a href="vehicles.html" class="cta-button">Browse Vehicles</a>
    </section>

    <section class="vehicles-section">
        <h2>Our Popular Vehicles</h2>
        <div class="vehicle-card">
            <img src="img2.jpg" alt="Vehicle Image">
            <h3>Sports Car</h3>
            <p>Perfect for city driving with excellent fuel efficiency.</p>
        </div>
        <div class="vehicle-card">
            <img src="img3.jpg" alt="Vehicle Image">
            <h3>SUV</h3>
            <p>Spacious and comfortable, ideal for family trips.</p>
        </div>
        <div class="vehicle-card">
            <img src="img4.jpg" alt="Vehicle Image">
            <h3>Luxury Car</h3>
            <p>Experience luxury and comfort for your special occasions.</p>
        </div>
    </section>
</div>

</body>
</html>
