<?php
include('../condb.php');

// เช็คว่ามีการส่ง car_id มาหรือไม่
if (isset($_POST['car_id'])) {
    $car_id = $_POST['car_id'];

    try {
        $conn->beginTransaction(); // เริ่มต้น Transaction

        // ลบข้อมูลจาก tb_cars
        $sql = "DELETE FROM tb_cars WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $car_id);
        $stmt->execute();

        $conn->commit(); // Commit การเปลี่ยนแปลง
        echo "Data deleted successfully.";
        header("Location: edit_car.php"); // Redirect กลับไปยังหน้าที่แสดงข้อมูลรถ
        exit;
    } catch (PDOException $e) {
        $conn->rollBack(); // ยกเลิกการเปลี่ยนแปลงในกรณีที่เกิดข้อผิดพลาด
        echo "Error: " . $e->getMessage();
    }
}
?>
