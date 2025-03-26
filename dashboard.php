<?php
session_start();
include 'db.php';

// ดึงรายการห้องพักที่ว่าง
$rooms = $conn->query("SELECT * FROM rooms WHERE status='available'");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โรงแรมสุดหรู - หน้าแรก</title>
    <style>
        /* ตั้งค่าพื้นหลังเป็นภาพโรงแรม */
        body {
            font-family: 'Arial', sans-serif;
            background: url('hotel-background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: black;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        nav {
            background-color: rgba(204, 198, 198, 0.8);
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #f39c12;
        }

        .container {
            max-width: 800px;
            margin: 80px auto 20px auto; /* เพิ่ม margin-top สำหรับให้ navbar ไม่ทับ */
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2d3436;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #2d3436;
        }

        .room {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .room h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #2d3436;
        }

        .room p {
            font-size: 18px;
            color: #636e72;
        }

        .room img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 15px;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            background-color:rgb(254, 254, 254);
            color: black;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color:rgb(240, 247, 255);
        }

        .login-register-links a {
            background-color: #f39c12;
        }

        .login-register-links a:hover {
            background-color: #e67e22;
        }

        .room p span {
            font-weight: bold;
            color: #2d3436;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <ul>
            <li><a href="index.php">หน้าแรก</a></li>
            <li><a href="book.php">จองห้องพัก</a></li>
            <li><a href="history.php">ประวัติการจอง</a></li>
            <li><a href="logout.php">ออกจากระบบ</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>ยินดีต้อนรับสู่โรงแรมของเรา 🏨</h1>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p>คุณเข้าสู่ระบบแล้ว | <a href="logout.php">ออกจากระบบ</a></p>
            <a href="book.php">📅 จองห้อง</a>
            <a href="history.php">📜 ดูประวัติการจอง</a>
        <?php else: ?>
            <a href="login.php">🔑 เข้าสู่ระบบ</a>
            <a href="register.php">📝 สมัครสมาชิก</a>
        <?php endif; ?>

        <h2>🛏 ห้องพักที่มีให้บริการ</h2>

        <?php while ($room = $rooms->fetch_assoc()): ?>
            <div class="room">
                <h3><?= $room['room_type'] ?></h3>
                <p>ราคา: ฿<?= $room['price'] ?> ต่อคืน</p>
                <!-- แสดงภาพห้องจากโฟลเดอร์ src -->
                <img src="src/<?= $room['image_url']; ?>" alt="<?= $room['room_type']; ?>">
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
