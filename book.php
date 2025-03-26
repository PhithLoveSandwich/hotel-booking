<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO bookings (user_id, room_id, check_in, check_out, status) 
            VALUES ('$user_id', '$room_id', '$check_in', '$check_out', 'pending')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-message'>จองห้องสำเร็จ!</p>";
    } else {
        echo "<p class='error-message'>เกิดข้อผิดพลาด: " . $conn->error . "</p>";
    }
}

$rooms = $conn->query("SELECT * FROM rooms WHERE status='available'");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองห้องพัก</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('hotel-background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: black;
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

        h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
            color: #2d3436;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        select, input {
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin: 5px 0;
        }

        select {
            background-color: #f9f9f9;
        }

        button {
            padding: 15px 30px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color:rgb(214, 214, 214);
        }

        .success-message, .error-message {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>จองห้องพัก</h2>
    
    <form method="POST">
        <label for="room_id">เลือกห้องที่ต้องการจอง:</label>
        <select name="room_id" required>
            <option value="" disabled selected>เลือกห้องพัก</option>
            <?php while ($room = $rooms->fetch_assoc()): ?>
                <option value="<?= $room['id'] ?>"><?= $room['room_type'] ?> - ฿<?= $room['price'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="check_in">วันที่เช็คอิน:</label>
        <input type="date" name="check_in" required>

        <label for="check_out">วันที่เช็คเอาท์:</label>
        <input type="date" name="check_out" required>

        <button type="submit">จองห้อง</button>
    </form>
</div>

</body>
</html>
