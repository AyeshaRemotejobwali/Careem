<?php
session_start();
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careem Clone - Homepage</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f5f5f5;
        }
        header {
            background-color: #00cc00;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: space-around;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .hero {
            text-align: center;
            padding: 50px;
            background: linear-gradient(135deg, #00cc00, #009900);
            color: white;
        }
        .services {
            display: flex;
            justify-content: space-around;
            padding: 50px;
            flex-wrap: wrap;
        }
        .service-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .service-card img {
            width: 100%;
            border-radius: 10px;
        }
        .service-card button {
            background-color: #00cc00;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        @media (max-width: 768px) {
            .services {
                flex-direction: column;
                align-items: center;
            }
            .service-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Careem Clone</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="#" onclick="redirectTo('login.php')">Login</a>
        <a href="#" onclick="redirectTo('signup.php')">Signup</a>
        <a href="#" onclick="redirectTo('driver_signup.php')">Become a Driver</a>
        <a href="#" onclick="redirectTo('wallet.php')">Wallet</a>
    </nav>
    <div class="hero">
        <h2>Ride or Send with Ease</h2>
        <p>Book a ride or schedule a delivery in just a few clicks!</p>
    </div>
    <div class="services">
        <div class="service-card">
            <img src="https://via.placeholder.com/300x200?text=Ride" alt="Ride">
            <h3>Ride</h3>
            <p>Book a car or bike for quick and reliable transport.</p>
            <button onclick="redirectTo('ride_booking.php')">Book Now</button>
        </div>
        <div class="service-card">
            <img src="https://via.placeholder.com/300x200?text=Delivery" alt="Delivery">
            <h3>Delivery</h3>
            <p>Send parcels with our fast delivery service.</p>
            <button onclick="redirectTo('delivery_booking.php')">Send Now</button>
        </div>
    </div>
    <footer>
        <p>&copy; 2025 Careem Clone. All rights reserved.</p>
    </footer>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
