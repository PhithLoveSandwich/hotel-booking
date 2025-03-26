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
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
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

        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
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
    <div class="container">
    <center><h1>ยินดีต้อนรับสู่โรงแรมของเรา 🛏</h1>

        <?php if (isset($_SESSION['user_id'])): ?>
            <p>คุณเข้าสู่ระบบแล้ว | <a href="logout.php">ออกจากระบบ</a></p>
            <a href="book.php">📅 จองห้อง</a>
            <a href="history.php">📜 ดูประวัติการจอง</a>
        <?php else: ?>
            <div class="login-register-links">
                <a href="login.php">🔑 เข้าสู่ระบบ</a>
                <a href="register.php">📝 สมัครสมาชิก</a>
            </div>
        <?php endif; ?>

    </center>
    </div>
</body>
</html>
