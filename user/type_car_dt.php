<?php
require_once '../condb.php'; // เชื่อมต่อฐานข้อมูล

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลประเภทของรถ รวมถึงยี่ห้อและรุ่น
$sql = "SELECT * FROM tb_cars";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$cars) {
    echo '<div class="alert alert-danger" role="alert">ไม่พบข้อมูลรถในระบบ</div>';
}
?>

<!-- เพิ่มลิงก์ CSS สำหรับ DataTable -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ตารางแสดงผลรถ</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card">

        <div class="card-body">
            <table id="carTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ยี่ห้อ</th>
                        <th>รุ่น</th>
                        <th>ประเภท</th>
                        <!-- <th>ราคา</th> -->
                        <th>สี</th>
                        <th>ทะเบียน</th>
                        <th>ปี</th>
                        <th>เวลา</th>
                        <th>รูปถ่าย</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($cars as $car) : ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo htmlspecialchars($car['brand']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['type']); ?></td>
                            <!-- <td><?php echo htmlspecialchars($car['price']); ?></td> -->
                            <td><?php echo htmlspecialchars($car['color']); ?></td>
                            <td><?php echo htmlspecialchars($car['license_plate']); ?></td>
                            <td><?php echo htmlspecialchars($car['year']); ?></td>
                            <td><?php echo htmlspecialchars($car['time_dt']); ?></td>
                            <td>
                                <?php if (!empty($car['picture'])) : ?>
                                    <img src="/miniproj/assets/dist/picture/<?php echo htmlspecialchars($car['picture']); ?>" alt="รูปภาพ" style="width: 80px; height: auto;">

                                <?php else : ?>
                                    <span>ไม่มีรูปภาพ</span>
                                <?php endif; ?>
                            </td>




                            </td>
                        </tr>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#carTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // ฟังก์ชันสำหรับการลบข้อมูล
        $('.delete-button').on('click', function() {
            const carId = $(this).data('car-id');

            Swal.fire({
                title: 'ยืนยันการลบ',
                text: 'คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลรถนี้? การกระทำนี้ไม่สามารถกู้คืนได้',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ส่งข้อมูลไปยังไฟล์ลบ
                    $.post('del_car.php', {
                        car_id: carId
                    }, function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                'ข้อมูลรถถูกลบเรียบร้อยแล้ว.',
                                'success'
                            ).then(() => {
                                location.reload(); // โหลดหน้าใหม่หลังจากลบเสร็จ
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'ไม่สามารถลบข้อมูลรถได้.',
                                'error'
                            );
                        }
                    }, 'json');
                }
            });
        });
    });
</script>