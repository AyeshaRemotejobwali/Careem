<?php
session_start();
require 'db.php';

if (!isset($_SESSION['driver_id'])) {
    header("Location: driver_login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ride_id'])) {
    $ride_id = $_POST['ride_id'];
    $stmt = $pdo->prepare("UPDATE rides SET driver_id = ?, status = 'accepted' WHERE id = ?");
    $stmt->execute([$_SESSION['driver_id'], $ride_id]);
    header("Location: driver_dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delivery_id'])) {
    $delivery_id = $_POST['delivery_id'];
    $stmt = $pdo->prepare("UPDATE deliveries SET driver_id = ?, status = 'accepted' WHERE id = ?");
    $stmt->execute([$_SESSION['driver_id'], $delivery_id]);
    header("Location: driver_dashboard.php");
    exit;
}

$rides = $pdo->query("SELECT * FROM rides WHERE status = 'pending'")->fetchAll();
$deliveries = $pdo->query("SELECT * FROM deliveries WHERE status = 'pending'")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard - Careem Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .dashboard-container h2 {
            color: #00cc00;
            text-align: center;
            margin-bottom: 20px;
        }
        .request {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .request button {
            background-color: #00cc00;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        @media (max-width: 480px) {
            .dashboard-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Driver Dashboard</h2>
        <h3>Ride Requests</h3>
        <?php foreach ($rides as $ride): ?>
            <div class="request">
                <p>Pickup: <?php echo $ride['pickup_location']; ?></p>
                <p>Dropoff: <?php echo $ride['dropoff_location']; ?></p>
                <p>Fare: $<?php echo $ride['fare']; ?></p>
                <form method="POST">
                    <input type="hidden" name="ride_id" value="<?php echo $ride['id']; ?>">
                    <button type="submit">Accept Ride</button>
                </form>
            </div>
        <?php endforeach; ?>
        <h3>Delivery Requests</h3>
        <?php foreach ($deliveries as $delivery): ?>
            <div class="request">
                <p>Pickup: <?php echo $delivery['pickup_location']; ?></p>
                <p>Dropoff: <?php echo $delivery['dropoff_location']; ?></p>
                <p>Package: <?php echo $delivery['package_details']; ?></p>
                <p>Fare: $<?php echo $delivery['fare']; ?></p>
                <form method="POST">
                    <input type="hidden" name="delivery_id" value="<?php echo $delivery['id']; ?>">
                    <button type="submit">Accept Delivery</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>deiver_
