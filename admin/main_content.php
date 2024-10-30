<?php
require_once '../condb.php';

// SQL สำหรับการนับจำนวนผู้ใช้ที่ลงทะเบียน
$sql = "SELECT COUNT(*) AS total_users FROM tb_users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_users = $result['total_users'];

// SQL สำหรับการนับจำนวนรถใน tb_cars
$sql_cars = "SELECT COUNT(*) AS total_cars FROM tb_cars"; // เปลี่ยนให้เชื่อมกับ tb_cars
$stmt = $conn->prepare($sql_cars);
$stmt->execute();
$result_cars = $stmt->fetch(PDO::FETCH_ASSOC);
$total_cars = $result_cars['total_cars'];

// SQL สำหรับการนับจำนวนกิจกรรมอบรม
$sql_maintenance = "SELECT COUNT(*) AS total_maintenance FROM activities WHERE category_id = 401";
$stmt = $conn->prepare($sql_maintenance);
$stmt->execute();
$result_maintenance = $stmt->fetch(PDO::FETCH_ASSOC);
$total_maintenance = $result_maintenance['total_maintenance'];

// SQL สำหรับการนับจำนวนประเภทของรถ
$sql_types = "SELECT COUNT(*) AS total_types FROM car_categories"; // ใช้ตาราง car_categories แทน activities
$stmt = $conn->prepare($sql_types);
$stmt->execute();
$result_types = $stmt->fetch(PDO::FETCH_ASSOC);
$total_types = $result_types['total_types'];
?>

<link rel="stylesheet"
  href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .slideshow-container {
      display: flex;
      /* จัดเรียงรูปภาพในแนวนอน */
      max-width: 100%;
      overflow: hidden;
      /* ซ่อนส่วนที่เกิน */
      position: relative;
      /* สำหรับการจัดการตำแหน่ง */
    }

    .ad-slide {
      min-width: 100%;
      /* กำหนดความกว้างของแต่ละภาพ */
      height: 180px;
      /* กำหนดความสูงของรูปภาพ */
      transition: transform 1s ease-in-out;
      /* กำหนดการเลื่อน */
    }

    .ad-slide img {
      width: 100%;
      height: 160px;
      /* กำหนดความสูงของรูปภาพ */
      object-fit: cover;
      /* ครอบภาพให้พอดีกับความสูง */
    }
  </style>
</head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="slideshow-container">
    <div class="ad-slide">
      <img src="../images/ads1.jpg" alt="Advertisement 1">
    </div>
    <div class="ad-slide">
      <img src="../images/ads2.jpg" alt="Advertisement 2">
    </div>
    <div class="ad-slide">
      <img src="../images/ads3.jpg" alt="Advertisement 3">
    </div>
    <div class="ad-slide">
      <img src="../images/ads4.jpg" alt="Advertisement 4">
    </div>
    <div class="ad-slide">
      <img src="../images/ads5.jpg" alt="Advertisement 5">
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-5 col-5">
          <div class="card" style="border: 15px outset #007bff; border-radius: 10px; background-color: #0000FF;">
            <div class="card-body" style="text-align: center;">
              <h1 style="color: white;"><?php echo $total_cars; ?></h1>
              <p style="color: white;">จำนวนรถในข้อมูล</p>
              <div class="icon" style="font-size: 50px;">
                <i class="nav-icon fas fa-car-alt" style="color:white;"></i>
              </div>
              <a href="edit_car.php" class="btn btn-info" style="margin-top: 10px;">ดูรายละเอียด <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-5 col-5">
          <div class="card" style="border: 15px outset #dc3545; border-radius: 10px; background-color: #FF0000;">
            <div class="card-body" style="text-align: center;">
              <h1 style="color: white;"><?php echo $total_types; ?></h1>
              <p style="color: white;">ข้อมูลประเภทรถ</p>
              <div class="icon" style="font-size: 50px;">
                <i class="nav-icon fas fa-truck" style="color:white;"></i>
              </div>
              <a href="type_car.php" class="btn btn-info" style="margin-top: 10px;">ดูรายละเอียด <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-5 col-5">
          <div class="card" style="border: 15px outset #228B22; border-radius: 10px; background-color: #026C3D;">
            <div class="card-body" style="text-align: center;">
              <h1 style="color: white;"><?php echo $total_users; ?></h1>
              <p style="color: white;">จำนวนผู้ใช้งาน</p>
              <div class="icon" style="font-size: 50px;">
                <i class="nav-icon ion-person-add" style="color:white;"></i>
              </div>
              <a href="show_member.php" class="btn btn-info" style="margin-top: 10px;">ดูรายละเอียด <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  let slideIndex = 0;
  const slides = document.getElementsByClassName("ad-slide");
  const totalSlides = slides.length;

  function showSlides() {
    slideIndex++;
    if (slideIndex >= totalSlides) {
      slideIndex = 0; // กลับไปที่ภาพแรก
    }

    for (let i = 0; i < totalSlides; i++) {
      slides[i].style.transform = `translateX(-${slideIndex * 100}%)`; // เลื่อนภาพไปทางซ้าย
    }

    setTimeout(showSlides, 3000); // เปลี่ยนภาพทุกๆ 3 วินาที
  }

  showSlides(); // เรียกใช้ฟังก์ชัน
</script>