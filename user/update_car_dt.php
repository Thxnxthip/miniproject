<?php
require_once '../condb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['car_id'])) {
    $id = $_POST['car_id'];

    $sql = "SELECT * FROM tb_cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        echo '<div class="alert alert-danger" role="alert">ไม่พบข้อมูลรถที่ต้องการแก้ไข</div>';
        exit();
    }

    // เข้าถึงค่าจาก $car
    $brand = htmlspecialchars($car['brand']);
    $model = htmlspecialchars($car['model']);
    $year = htmlspecialchars($car['year']);
    $color = htmlspecialchars($car['color']);
    // $price = htmlspecialchars($car['price']);
    $license_plate = htmlspecialchars($car['license_plate']);
    $type = htmlspecialchars($car['type']);
} else {
    echo '<div class="alert alert-danger" role="alert">ไม่มีการส่งข้อมูล ID รถ</div>';
    exit();
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขข้อมูลรถ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Car Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <form action="update_car_dt_script.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                            <!-- ฟิลด์สำหรับข้อมูลรถ -->
                            <div class="mb-3">
                                <label for="brand" class="form-label">ยี่ห้อ</label>
                                <input type="text" class="form-control" name="brand" id="brand" value="<?php echo $brand; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">รุ่น</label>
                                <input type="text" class="form-control" name="model" id="model" value="<?php echo $model; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">ปีที่ผลิต</label>
                                <input type="number" class="form-control" name="year" id="year" value="<?php echo $year; ?>" required min="1886" max="<?php echo date('Y'); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">สี</label>
                                <input type="text" class="form-control" name="color" id="color" value="<?php echo $color; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="license_plate" class="form-label">ทะเบียนรถ</label>
                                <input type="text" class="form-control" name="license_plate" id="license_plate" value="<?php echo $license_plate; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">ประเภท</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="">เลือกประเภท</option>
                                    <option value="sedan" <?php echo ($type == 'sedan') ? 'selected' : ''; ?>>Sedan</option>
                                    <option value="suv" <?php echo ($type == 'suv') ? 'selected' : ''; ?>>SUV</option>
                                    <option value="truck" <?php echo ($type == 'truck') ? 'selected' : ''; ?>>Truck</option>
                                    <option value="coupe" <?php echo ($type == 'coupe') ? 'selected' : ''; ?>>Coupe</option>
                                    <option value="hatchback" <?php echo ($type == 'hatchback') ? 'selected' : ''; ?>>Hatchback</option>
                                    <option value="convertible" <?php echo ($type == 'convertible') ? 'selected' : ''; ?>>Convertible</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
