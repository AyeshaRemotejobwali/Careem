<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $package_details = $_POST['package_details'];
    $fare = rand(5, 20); // Dummy fare calculation

    $stmt = $pdo->prepare("INSERT INTO deliveries (user_id, pickup_location, dropoff_location, package_details, fare) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $pickup, $dropoff, $package_details, $fare]);
    header("Location: tracking.php?delivery_id=" . $pdo->lastInsertId());
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Booking - Careem Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .booking-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .booking-container h2 {
            color: #00cc00;
            text-align: center;
            margin-bottom: 20px;
        }
        .booking-container input, .booking-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .booking-container button {
            background-color: #00cc00;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        @media (max-width: 480px) {
            .booking-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <h2>Book a Delivery</h2>
        <form method="POST">
            <input type="text" name="pickup" placeholder="Pickup Location" required>
            <input type="text" name="dropoff" placeholder="Dropoff Location" required>
            <textarea name="package_details" placeholder="Package Details" required></textarea>
            <button type="submit">Book Delivery</button>
        </form>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
