<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$bookings = $conn->query("SELECT bookings.*, rooms.room_type, rooms.image_url FROM bookings JOIN rooms ON bookings.room_id = rooms.id WHERE user_id='$user_id'");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการจอง</title>
    <style>
        /* ตั้งค่าพื้นหลังเป็นภาพโรงแรม */
        body {
            font-family: 'Arial', sans-serif;
            background: url('hotel-background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            font-size: 36px;
            margin-top: 20px;
            color:rgb(255, 255, 255);
        }

        .booking-list {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .booking-item {
            display: flex;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .booking-item img {
            width: 150px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 20px;
        }

        .booking-details {
            flex: 1;
        }

        .booking-details h3 {
            font-size: 24px;
            color: #2d3436;
            margin-bottom: 10px;
        }

        .booking-details p {
            font-size: 18px;
            color: #636e72;
            margin: 5px 0;
        }

        .booking-details .status {
            font-weight: bold;
            color: #2d3436;
        }
    </style>
</head>
<body>

<h2>ประวัติการจองของคุณ</h2>

<div class="booking-list">
    <?php while ($booking = $bookings->fetch_assoc()): ?>
        <div class="booking-item">
            <img src="src/<?= $booking['image_url'] ?>" alt="<?= $booking['room_type'] ?>"> <!-- รูปห้อง -->
            <div class="booking-details">
                <h3><?= $booking['room_type'] ?></h3>
                <p>Check-in: <?= $booking['check_in'] ?></p>
                <p>Check-out: <?= $booking['check_out'] ?></p>
                <p class="status">สถานะ: <?= $booking['status'] ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
