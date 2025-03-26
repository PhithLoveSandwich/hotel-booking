<?php
$servername = "localhost";
$username = "root";  // ถ้าใช้ XAMPP ค่าเริ่มต้นคือ root
$password = "";  // ถ้าใช้ XAMPP ปกติจะไม่มีรหัสผ่าน
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}
?>
