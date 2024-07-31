<?php
session_start(); // Start the session

if (!isset($_SESSION['booking_id'])) {
    die("No booking details found.");
}

// Clear session data related to booking
unset($_SESSION['booking_id']);
unset($_SESSION['total_amount']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f7fa, #b9fbc0); /* Gradient background */
            color: #333;
            text-align: center;
        }
        .container {
            padding: 40px;
            max-width: 600px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }
        h1 {
            color: #28a745;
            font-size: 2.5em;
            margin-bottom: 15px;
            font-weight: 700;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
        }
        p {
            font-size: 1.1em;
            margin-bottom: 20px;
            line-height: 1.6;
            color: #555;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1.1em;
            color: #ffffff;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: 2px solid transparent;
        }
        .button:hover {
            background-color: #218838;
            transform: scale(1.05);
            border: 2px solid #218838;
        }
        .icon {
            font-size: 5em;
            color: #28a745;
            margin-bottom: 20px;
        }
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('img111.jpg') no-repeat center center;
            background-size: cover;
            filter: brightness(60%); /* Darken background image */
            z-index: -1;
        }
        .text-overlay {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="background-image"></div>
    <div class="container">
        <div class="text-overlay">
            <div class="icon">
                &#x1F4B3; <!-- Payment card emoji -->
            </div>
            <h1>Payment Successful</h1>
            <p>Your payment has been successfully processed.</p>
            <p>Thank you for booking with us!</p>
            <a href="homepage.php" class="button">Return to Home</a>
        </div>
    </div>
</body>
</html>
