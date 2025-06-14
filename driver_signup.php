<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $vehicle_type = $_POST['vehicle_type'];
    $license_plate = $_POST['license_plate'];

    $stmt = $pdo->prepare("INSERT INTO drivers (username, email, password, phone, vehicle_type, license_plate) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $phone, $vehicle_type, $license_plate]);
    header("Location: driver_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Signup - Careem Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        .signup-container h2 {
            color: #00cc00;
            margin-bottom: 20px;
        }
        .signup-container input, .signup-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .signup-container button {
            background-color: #00cc00;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .signup-container a {
            color: #00cc00;
            text-decoration: none;
        }
        @media (max-width: 480px) {
            .signup-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Driver Sign Up</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <select name="vehicle_type" required>
                <option value="car">Car</option>
                <option value="bike">Bike</option>
            </select>
            <input type="text" name="license_plate" placeholder="License Plate" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already a driver? <a href="#" onclick="redirectTo('driver_login.php')">Login</a></p>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
