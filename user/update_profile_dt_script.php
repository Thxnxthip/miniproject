
<?php
include('../condb.php');
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $dob = $_POST['dob'];
    
    $gender_id = $_POST['gender']; // รับค่า gender_id จากฟอร์ม

    // ดึงข้อมูลผู ้ใช้จากฐานข้อมูลเพื่อตรวจสอบรูปภาพเดิม
    $sql = "SELECT avatar FROM persons WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $person = $stmt->fetch(PDO::FETCH_ASSOC);
    $oldAvatar = $person['avatar'];

    // ตรวจสอบวาไดมการอปโหลดรปภาพใหมหรอไม
    if (!empty($_FILES['avatar']['name'])) {  // ถามการอปโหลดรปภาพใหม
        $targetDir = realpath(__DIR__ . "/../assets/dist/avatar/") . "/";  // ทอยของโฟลเดอร เกบไฟล
        $fileName = basename($_FILES['avatar']['name']); // เอาเฉพาะชอไฟลออกมา (ไมเอา path)
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); // เอาเฉพาะนามสกุลไฟล์
        $newFileName = uniqid() . '_' . time() . '.' . $fileType;
        $targetFilePath = $targetDir . $newFileName;

        // ตรวจสอบประเภทไฟล (สามารถเพมประเภททตองการได)
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif'); // ประเภทไฟล์ที่อนุญาต
        if (in_array($fileType, $allowTypes)) { // ตรวจสอบวาอยในประเภททอนญาตหรอไม
            // ตรวจสอบวามขอผดพลาดในการอปโหลดไฟลหรอไม
            if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {  // ถาไมมขอผดพลาด
                // อัปโหลดไฟล์ไปยังโฟลเดอร์ที่ต้องการ
                if (move_uploaded_file(
                    $_FILES['avatar']['tmp_name'],
                    $targetFilePath

                )) {  // ถ้าอัปโหลดส าเร็จ
                    // ลบรปภาพเกา (ถาม) เพอประหยดพนท
                    if (
                        !empty($oldAvatar) && file_exists($targetDir .
                            $oldAvatar)
                    ) { // ถา้มีรูปภาพเดิมและมีไฟลอ์ยจู่ ริง
                        unlink($targetDir . $oldAvatar); // ลบไฟลเ์ดิม (รูปภาพเก่า)ออก
                    }
                    // เกบ็ ชื่อไฟลร์ูปภาพใหม่
                    $avatar = $newFileName;
                } else {
                    echo '<script>
                            setTimeout(function() {
                            Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "เกิดข้อผิดพลาดในการย้ายไฟล์ไปยังโฟลเดอร์เป้าหมาย"์ ,
                            showConfirmButton: false,
                            timer: 1500
                            }).then(function() {
                            window.location = "update_profile.php"; //หน้าที่ต้องการให้
                            กระโดดไป
                            });
                            }, 1000);
                            </script>';
                    exit();
                }
            } else {
                echo '<script>
                        setTimeout(function() {
                        Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "เกิดข้อผิดพลาดในการอัปโหลดไฟล์" ,
                        showConfirmButton: false,
                        timer: 1500
                        }).then(function() {
                        window.location = "update_profile.php"; //หน้าที่ต้องการให้
                        กระโดดไป
                        });
                        }, 1000);
                        </script>';
                exit();
            }
        } else {
            echo '<script>
setTimeout(function() {
Swal.fire({
position: "center",
icon: "error",
title: "ประเภทไฟล์ไม่รองรับ",
showConfirmButton: false,
timer: 1500
}).then(function() {
window.location = "update_profile.php"; //หน้าที่ต้องการให้กระโดดไป
});
}, 1000);
</script>';
            exit();
        }
    } else {
        // ถาไมมการอปโหลดใหม ใหใชรปภาพเดม
        $avatar = $oldAvatar;
    }

    try {
        // ค าสั่ง SQL ส าหรับบันทึก fname และ lname ลงตาราง persons
        $sql1 ="UPDATE persons SET fname = ?, lname = ?, dob = ?, avatar = ?, club_id = ? , gender_id = ? WHERE id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bindParam(1, $fname);
        $stmt1->bindParam(2, $lname);
        $stmt1->bindParam(3, $dob);
        $stmt1->bindParam(4, $avatar);
        $stmt1->bindParam(5, $club_id);
        $stmt1->bindParam(6, $gender_id);
        $stmt1->bindParam(7, $id);
        $stmt1->execute();


        // ถ้าอัปเดตส าเร็จ

        echo '<script>
setTimeout(function() {
Swal.fire({
position: "center",
icon: "success",
title: "อัปเดตข้อมูลสำเร็จ!",
showConfirmButton: false,
timer: 1500
}).then(function() {
window.location = "update_profile.php"; //หน้าที่ต้องการให้กระโดดไป
});
}, 1000);
</script>';
        exit();
    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
}
?>