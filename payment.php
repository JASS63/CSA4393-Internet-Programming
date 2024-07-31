<?php
session_start();

// Check if the total amount is set in the session
if (!isset($_SESSION['total_amount'])) {
    die("No booking details found.");
}

$total_amount = $_SESSION['total_amount'];
unset($_SESSION['total_amount']); // Clear the session variable

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            text-align: center;
        }
        .container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Limiting max width for better readability */
            width: 100%;
        }
        h1 {
            color: #ff6f61;
            margin-bottom: 15px;
            font-size: 2em; /* Larger font size */
        }
        p {
            font-size: 1.1em;
            margin-bottom: 25px;
            color: #666;
        }
        button {
            background-color: #ff6f61;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-weight: 600;
        }
        button:hover {
            background-color: #e55b4f;
            transform: scale(1.05);
        }
        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 111, 97, 0.5); /* Focus ring for accessibility */
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Payment Page</h1>
        <p>Total Amount to Pay: Rs. <?php echo number_format($total_amount, 2); ?></p>
        <form action="pay.php" method="post">
            <button type="submit">Pay Now</button>
        </form>
    </div>

</body>
</html>
