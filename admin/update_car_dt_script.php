<?php
include('../condb.php');
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car Data</title>
</head>
<body>
    <div class="container">

        <?php
        $id = $_POST['id'];
        $type = $_POST['type'];
        $color = $_POST['color'];
        $license_plate = $_POST['license_plate'];
        $year = $_POST['year'];
        $price = $_POST['price']; // ดึงค่าราคา

        // เริ่มต้นการทำงานของฐานข้อมูล
        try {
            $conn->beginTransaction();

            // คำสั่ง SQL สำหรับอัปเดตข้อมูลรถ
            $sql = "UPDATE tb_cars SET type = ?, color = ?, license_plate = ?, year = ?, price = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $type);
            $stmt->bindParam(2, $color);
            $stmt->bindParam(3, $license_plate);
            $stmt->bindParam(4, $year);
            $stmt->bindParam(5, $price); // รวมราคาในคำสั่ง
            $stmt->bindParam(6, $id);

            $stmt->execute();

            // // ตรวจสอบการอัปโหลดรูปภาพ
            // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            //     $image_name = $_FILES['image']['name'];
            //     $image_tmp = $_FILES['image']['tmp_name'];

            //     // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
            //     move_uploaded_file($image_tmp, 'uploads/' . $image_name);

            //     // อัปเดตรูปภาพในฐานข้อมูล
            //     $sql_image = "UPDATE tb_cars SET image = ? WHERE id = ?";
            //     $stmt_image = $conn->prepare($sql_image);
            //     $stmt_image->bindParam(1, $image_name);
            //     $stmt_image->bindParam(2, $id);
            //     $stmt_image->execute();
            // }

            // ถ้าทุกอย่างทำงานเรียบร้อย ให้ commit เพื่อยืนยันการบันทึกข้อมูล
            $conn->commit();
            $result = "success"; // กำหนดค่า result เป็น success เมื่อสำเร็จ
        } catch (Exception $e) {
            $conn->rollBack();
            $result = "error"; // กำหนดค่า result เป็น error เมื่อเกิดข้อผิดพลาด
        }

        // แสดงผลการอัปเดต
        if ($result === "success") {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลรถสำเร็จ",
                    showConfirmButton: false,
                    timer: 1000
                }).then(function() {
                    window.location = "edit_car.php"; // Redirect ไปยังหน้าที่ต้องการ
                });
            }, 1000);
            </script>';
        } else {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เกิดข้อผิดพลาดในการแก้ไขข้อมูล",
                    showConfirmButton: false,
                    timer: 1000
                }).then(function() {
                    window.location = "update_car.php"; // Redirect ไปยังหน้าที่ต้องการ
                });
            }, 1000);
            </script>';
        }
        ?>
    </div>
</body>
</html>
