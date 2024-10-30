<?php
session_start();
include('../condb.php'); // เชื่อมต่อกับฐานข้อมูล

// รับข้อมูลจากฟอร์ม
$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$color = $_POST['color'];
$price = $_POST['price'];
$license_plate = $_POST['license_plate'];
$type = $_POST['type'];

// เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูล (ไม่รวมภาพ)
$sql = "INSERT INTO tb_cars (brand, model, year, color, price, license_plate, type) VALUES (:brand, :model, :year, :color, :price, :license_plate, :type)";
$stmt = $conn->prepare($sql);

// ผูกค่าเข้ากับพารามิเตอร์ใน SQL
$stmt->bindParam(':brand', $brand);
$stmt->bindParam(':model', $model);
$stmt->bindParam(':year', $year);
$stmt->bindParam(':color', $color);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':license_plate', $license_plate);
$stmt->bindParam(':type', $type);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ประมวลผลข้อมูลรถยนต์อื่น ๆ ...
    
    // // ประมวลผลการอัปโหลดภาพ
    // if (isset($_FILES['car_image']) && $_FILES['car_image']['error'] == 0) {
    //     $imageName = basename($_FILES['car_image']['name']);
    //     $targetDir = "uploads/"; // โฟลเดอร์สำหรับจัดเก็บภาพ
    //     $targetFile = $targetDir . $imageName;

    //     // ย้ายไฟล์ภาพไปยังโฟลเดอร์ที่กำหนด
    //     if (move_uploaded_file($_FILES['car_image']['tmp_name'], $targetFile)) {
    //         // บันทึก URL ของภาพในฐานข้อมูล
    //         $sql = "INSERT INTO tb_cars (brand, model, year, color, price, type, license_plate, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    //         $stmt = $conn->prepare($sql);
    //         $stmt->execute([$brand, $model, $year, $color, $price, $type, $license_plate, $targetFile]);
    //     } else {
    //         echo "เกิดข้อผิดพลาดในการอัปโหลดภาพ.";
    //     }
    // }
}


// ดำเนินการเพิ่มข้อมูล
if ($stmt->execute()) {
    $_SESSION['success'] = "เพิ่มข้อมูลรถเรียบร้อยแล้ว";
    $result = "success"; // ตั้งค่าสำเร็จ
} else {
    $_SESSION['error'] = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
    $result = "error"; // ตั้งค่าล้มเหลว
}

// แสดงผล SweetAlert2
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
if ($result === "success") {
    echo '<script>
        setTimeout(function() {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "เพิ่มข้อมูลรถเรียบร้อยแล้ว",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = "index.php"; // เปลี่ยนหน้าไปที่ index.php
            });
        }, 1000);
    </script>';
} else {
    echo '<script>
        setTimeout(function() {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "เกิดข้อผิดพลาดในการเพิ่มข้อมูล",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = "insert_car_form.php"; // เปลี่ยนหน้าไปที่หน้าฟอร์มเพิ่มรถ
            });
        }, 1000);
    </script>';
}
?>
