<head>
    <title>First Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .image-container {
            position: relative;
            display: inline-block;
            /* ให้รูปภาพและปุ่มอยู่ในกลุ่มเดียวกัน */
        }

        .custom-img {
            width: 100%;
            /* ให้รูปภาพเต็มความกว้างของคอนเทนเนอร์ */
            height: auto;
            /* รักษาสัดส่วนของรูปภาพ */
            object-fit: cover;
            /* ให้รูปภาพครอบคลุมพื้นที่อย่างพอดี */
            border-radius: 15px;
            /* มุมโค้งของรูปภาพ */
        }

        .text-overlay {
            position: absolute;
            top: 20%;
            /* ตำแหน่งข้อความให้อยู่ที่ 20% จากขอบบนของรูปภาพ */
            left: 50%;
            transform: translateX(-50%);
            color: white;
            /* สีของข้อความ */
            font-size: 42px;
            /* ขนาดตัวอักษร */
            background-color: rgba(0, 0, 0, 0.5);
            /* พื้นหลังโปร่งแสงของข้อความ */
            padding: 10px;
            border-radius: 10px;
            /* มุมโค้งของพื้นหลังข้อความ */
            font-family: "Copperplate", fantasy;
            /* กำหนดฟอนต์เป็น Copperplate หรือฟอนต์ fantasy */
        }

        .btn-next {
            position: absolute;
            /* จัดตำแหน่งแบบ absolute ให้ปุ่มอยู่บนรูปภาพ */
            top: 90%;
            /* ตำแหน่งปุ่มให้อยู่กึ่งกลางแนวตั้งของรูปภาพ */
            left: 50%;
            /* ตำแหน่งปุ่มให้อยู่กึ่งกลางแนวนอนของรูปภาพ */
            transform: translate(-50%, -50%);
            /* ปรับให้ปุ่มอยู่ตรงกลางจริง ๆ */
            padding: 10px 20px;
            /* ขนาดของปุ่ม */
            font-size: 16px;
            /* ขนาดตัวอักษรของปุ่ม */
            border-radius: 10px;
            /* มุมโค้งมนของปุ่ม */
        }
    </style>
</head>
<!-- Content -->
<div class="container mt-3 text-center position-relative m-border" style="border: 2px solid #ddd; padding: 20px;">
    <h2>Welcome to My Web : THANA</h2>
    <div class="d-grid gap-2">

        <div class="image-container">
            <img src="images/Car1.jpg" alt="Welcome Image" class="img-fluid custom-img">

            <!-- ข้อความที่แสดงบนรูปภาพ -->
            <div class="text-overlay">This website is for recording car informmation.</div>

            <!-- ปุ่ม NEXT ที่อยู่บนรูปภาพ -->
            <a href="login.php" class="btn btn-primary btn-next">NEXT</a>
        </div>
    </div>
</div>
<!-- End Content -->
<div class="container mt-3 text-center position-relative m-border"
    style="border: 2px solid #ddd; padding: 20px;">
   
    <fieldset>
        <legend>ข้อมูลการLogin : Username/Password</legend>
        <p>Admin--admin@gmail.com/11111</p>
    <p>User--Thanatest@gmail.com/12345678Aa@</p>

    </fieldset>
    <style>
        legend {
            font-size: 2rem;
            font-weight: 500;
        }

        p {
            text-wrap: balance;
        }
    </style>
    
</div>


</div>
<!-- End Content -->
<div class="container mt-3 text-center position-relative m-border"
    style="border: 2px solid #ddd; padding: 20px;">
    <div class="image-container">
        <img src="images/.png" alt="Data Image" class="img-fluid custom-img">
    </div>
</div>
<br>
<br>
<br>
<br>
<br>