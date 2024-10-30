<?php
require_once '../condb.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['user_login'])) {
  $user_id = $_SESSION['user_login'];
  $sql = "SELECT persons.*, tb_users.* FROM persons
LEFT JOIN tb_users ON persons.id = tb_users.person_id
WHERE persons.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $user_id);
  $stmt->execute();
  $us = $stmt->fetch(PDO::FETCH_ASSOC);
  extract($us); // ไม่ตอ้งสร้างตวัแปรมารองรับ เรียกใชผ้า่ นชื่อฟิลดไ์ ดเ้ลย
  $imageURL = '../assets/dist/avatar/' . $avatar;
}
// ตรวจสอบวา่ มีการอปัโหลดรูปภาพหรือไม่ถา้ไม่มีให้ใชรู้ปภาพตวัอยา่ งแทน
$imageURL = !empty($avatar) ? $imageURL : '../assets/dist/avatar/default.png';
?>



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <div style=" display: flex; flex-direction: column; align-items: center; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
      <img src="<?php echo $imageURL ?>" style="width: 50%; max-width: 150px;
height: auto;" class="img-circle ">
      <!-- <br> -->
      <span class="brand-text font-weight-light"><?php echo $us['fname'] . ' '
                                                    . $us['lname']; ?></span>
    </div>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="index.php" class="nav-link">
            <i class="nav-icon fas fa-caravan" style="color:violet;"></i>
            <p>หน้าหลัก
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="view_all_member.php" class="nav-link">
             <i class="nav-icon fas fa-users" style="color:pink;"></i>
            <p>แสดงข้อมูลสมาชิก
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="show_member.php" class="nav-link">
            <i class="nav-icon fas fa-user-edit" style="color:red;"></i>
            <p>จัดการข้อมูลสมาชิก
            </p>
          </a>
        </li> -->
        <li class="nav-item">
           <a href="change_password.php" class="nav-link">
             <i class="nav-icon fas fa-chart-pie" style="color:gold;"></i>
             <p>เปลี่ยนรหัสผ่าน
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="update_profile.php" class="nav-link">
             <i class="nav-icon fas fa-chart-pie" style="color:gold;"></i>
             <p>แก้ไขข้อมูลส่วนตัว
             </p>
           </a>
         </li>
         <li class="nav-item">
          <a href="insert_car.php" class="nav-link">
            <i class="nav-icon fas fa-car-alt" style="color:red;"></i>
            <p>เพิ่มข้อมูลรถ
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="type_car.php" class="nav-link">
            <i class="nav-icon fas fa-truck" style="color:gold;"></i>
            <p>
              ตารางแสดงผลรถ
            </p>
          </a>
        </li>
        
       
        <li class="nav-item">
          <a href="../logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"style="color:white;"></i>
            <p>
              Logout
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>