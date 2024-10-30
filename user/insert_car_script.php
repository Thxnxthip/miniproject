<?php
session_start();
include('../condb.php'); // เชื่อมต่อกับฐานข้อมูล

// รับข้อมูลจากฟอร์ม
$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$color = $_POST['color'];
$license_plate = $_POST['license_plate'];
$type = $_POST['type'];
$time = $_POST['time_dt'];
$picture = $picture['picture'];

// ตรวจสอบการอัปโหลดไฟล์รูปภาพ
if (!empty($_FILES['picture']['name'])) {
    if ($_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์: " . $_FILES['picture']['error'];
        header("Location: insert_car_from.php");
        exit();
    }

    if ($_FILES['picture']['size'] > 2 * 1024 * 1024) { // 2MB
        $_SESSION['error'] = "ไฟล์ต้องมีขนาดไม่เกิน 2MB";
        header("Location: insert_car_from.php");
        exit();
    }

    $targetDir = realpath(__DIR__ . "/../assets/dist/picture/") . "/";
    $fileName = basename($_FILES['picture']['name']);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = uniqid() . '_' . time() . '.' . $fileType;
    $targetFilePath = $targetDir . $newFileName;

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFilePath)) {
            $picture = $newFileName;
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการย้ายไฟล์.";
            header("Location: insert_car_from.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "ประเภทไฟล์ไม่ถูกต้อง อนุญาตเฉพาะ JPG, JPEG, PNG & GIF เท่านั้น.";
        header("Location: insert_car_from.php");
        exit();
    }
}

// เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูล
$sql = "INSERT INTO tb_cars (brand, model, year, color, license_plate, type, time_dt, picture)
        VALUES (:brand, :model, :year, :color, :license_plate, :type, :time_dt, :picture)";
$stmt = $conn->prepare($sql);

// ผูกค่าเข้ากับพารามิเตอร์ใน SQL
$stmt->bindParam(':brand', $brand);
$stmt->bindParam(':model', $model);
$stmt->bindParam(':year', $year);
$stmt->bindParam(':color', $color);
$stmt->bindParam(':license_plate', $license_plate);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':time_dt', $time);
$stmt->bindParam(':picture', $picture);

// ดำเนินการเพิ่มข้อมูล
if ($stmt->execute()) {
    $_SESSION['success'] = "เพิ่มข้อมูลรถเรียบร้อยแล้ว";
    echo "<script>window.location.href = 'index.php';</script>";
} else {
    $_SESSION['error'] = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
    echo "<script>window.location.href = 'insert_car_form.php';</script>";
}
?>
