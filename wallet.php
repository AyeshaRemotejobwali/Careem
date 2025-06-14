<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, amount, type) VALUES (?, ?, 'recharge')");
    $stmt->execute([$_SESSION['user_id'], $amount]);
    $stmt = $pdo->prepare("UPDATE users SET wallet_balance = wallet_balance + ? WHERE id = ?");
    $stmt->execute([$amount, $_SESSION['user_id']]);
    header("Location: wallet.php");
    exit;
}

$stmt = $pdo->prepare("SELECT wallet_balance FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet - Careem Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .wallet-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .wallet-container h2 {
            color: #00cc00;
            text-align: center;
            margin-bottom: 20px;
        }
        .wallet-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .wallet-container button {
            background-color: #00cc00;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        @media (max-width: 480px) {
            .wallet-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="wallet-container">
        <h2>Your Wallet</h2>
        <p>Balance: $<?php echo $user['wallet_balance']; ?></p>
        <form method="POST">
            <input type="number" name="amount" placeholder="Enter amount to recharge" required>
            <button type="submit">Recharge</button>
        </form>
    </div>
    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
