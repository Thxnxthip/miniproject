<?php
require_once '../condb.php';
$sql = "SELECT * FROM tb_cars"; // ดึงข้อมูลจาก tb_cars
$stmt = $conn->prepare($sql);
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
$index = 1;
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert Car</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* สไตล์สำหรับจัดตำแหน่งฟุตเตอร์ */
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                /* ทำให้ร่างกายมีความสูงขั้นต่ำ 100% ของหน้าจอ */
                background-color: #f8f9fa;
                /* เพิ่มสีพื้นหลัง */
            }

            .container {
                flex: 1;
                /* ทำให้ container ขยายเต็มที่เพื่อเติมพื้นที่ว่าง */
                padding: 20px;
                /* เพิ่ม padding ให้กับ container */
                background-color: #ffffff;
                /* เพิ่มสีพื้นหลังของฟอร์ม */
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                /* เพิ่มเงาให้กับฟอร์ม */
                border-radius: 8px;
                /* เพิ่มมุมมนให้กับฟอร์ม */
            }

            footer {
                /* สไตล์ของฟุตเตอร์ */
                background-color: #343a40;
                /* สีพื้นหลังของฟุตเตอร์ */
                color: white;
                /* สีตัวอักษร */
                padding: 15px;
                text-align: center;
                position: relative;
            }

            .footer-link {
                color: #ffffff;
                /* สีของลิงค์ในฟุตเตอร์ */
                text-decoration: none;
                /* เอาเส้นใต้ลิงค์ออก */
            }

            .footer-link:hover {
                text-decoration: underline;
                /* เพิ่มเส้นใต้ลิงค์เมื่อ hover */
            }

            .btn-primary {
                background-color: #007bff;
                /* เปลี่ยนสีปุ่ม */
                border-color: #007bff;
                /* เปลี่ยนสีขอบปุ่ม */
            }

            .btn-primary:hover {
                background-color: #0056b3;
                /* สีเมื่อ hover บนปุ่ม */
                border-color: #0056b3;
                /* สีขอบเมื่อ hover บนปุ่ม */
            }
        </style>
    </head>
    <section class="content-header">

        <body>
            <div class="container mt-5">
                <h3 class="mt-4">ฟอร์มกรอกข้อมูลรถ</h3>
                <hr>
                <form action="insert_car_script.php" method="post">

                    <div class="mb-3">
                        <label for="brand" class="form-label">ยี่ห้อ</label>
                        <input type="text" class="form-control" name="brand" id="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">รุ่น</label>
                        <input type="text" class="form-control" name="model" id="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">วัน/เดือน/ปีที่ผลิต</label>
                        <input type="date" class="form-control" name="year" id="year" required>
                    </div>
                    <div class="mb-3">
                        <label for="time_dt" class="form-label">เวลา</label>
                        <input type="time" class="form-control" name="time_dt" id="time_dt" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">สี</label>
                        <input type="text" class="form-control" name="color" id="color" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="price" class="form-label">ราคา</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="license_plate" class="form-label">ทะเบียนรถ</label>
                        <input type="text" class="form-control" name="license_plate" id="license_plate" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">ประเภท</label>
                        <select class="form-select" name="type" id="type" required>
                            <option value="" disabled selected>กรุณาเลือกประเภท</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Coupe">Coupe</option>
                            <option value="SUV">SUV</option>
                            <option value="Truck">Truck</option>
                            <option value="Motorcycle">Motorcycle</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                        <br>
                        <div class="mb-3">
                        <label for="picture" class="form-label">บันทึกรูปภาพ</label>
                        <input type="file" class="form-control" name="picture" id="picture" accept=".jpg,.jpeg,.png,.gif" required> <!-- File input for the poster -->
                    </div>

                        <br>
                        <button type="submit" class="btn btn-primary">บันทึกข้อมูลรถ</button>
                </form>
                <hr>
                <p class="text-end">
                    <a href="index.php">กลับหน้าหลัก</a>
                </p>
            </div>



            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        </body>

        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</html>