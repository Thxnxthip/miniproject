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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>จัดการข้อมูลรถยนต์
                        <a href="insert_car.php" class="btn btn-primary">+ เพิ่มข้อมูล</a> <!-- ลิงก์ไปยังหน้าเพิ่มข้อมูล -->
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ยี่ห้อ</th>
                        <th>รุ่น</th>
                        <th>ปี</th>
                        <th>สี</th>
                        <!-- <th>ราคา</th> -->
                        <th>ประเภท</th>
                        <th>ทะเบียน</th>
                        <th>เวลา</th>
                        <!-- <th>รูปภาพ</th> เพิ่มคอลัมน์สำหรับรูปภาพ -->
                        <th>Actions</th> <!-- คอลัมน์สำหรับการดำเนินการ -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car) : ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo htmlspecialchars($car['brand']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['year']); ?></td>
                            <td><?php echo htmlspecialchars($car['color']); ?></td>
                            <!-- <td><?php echo number_format($car['price'], 2); ?> บาท</td> -->
                            <td><?php echo htmlspecialchars($car['type']); ?></td> <!-- แสดงประเภท -->
                            <td><?php echo htmlspecialchars($car['license_plate']); ?></td> <!-- แสดงทะเบียน -->
                            <td><?php echo htmlspecialchars($car['time_dt']); ?></td> <!-- แสดงทะเบียน -->
                            <!-- <td>
                                <?php if (!empty($car['image'])): ?>
                                    <img src="<?php echo 'uploads/' . htmlspecialchars($car['image']); ?>" alt="Car Image" style="width: 100px; height: auto;">
                                <?php else: ?>
                                    <p>ไม่มีรูปภาพ</p>
                                <?php endif; ?>
                            </td> -->
                            <td>
                                <form action="update_car.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                                    <input type="submit" name="edit" value="Edit" class="btn btn-warning btn-sm">
                                </form>
                                <form action="del_car.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                                    <button type="button" class="delete-button btn btn-danger btn-sm" data-car-id="<?php echo $car['id']; ?>">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable(); // Initialize DataTable
    });

    function showDeleteConfirmation(carId) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได้!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'del_car.php';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'car_id';
                input.value = carId;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const carId = button.getAttribute('data-car-id');
            showDeleteConfirmation(carId);
        });
    });
</script>