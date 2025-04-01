<?php session_start();
require_once "./login/checkLoginAdmin.php";
require_once "./infor_general.php";
$sql = new SQL(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="./css/style.css">
    <title>Quản lý</title>
</head>

<body>
    <div class="hidden" id="logout">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Đăng xuất </h2>
                <form class="" action="./dangXuat.php" method="post">
                    <div class="submit"> <button>Xác nhận đăng xuất</button> </div>
                </form>
            </div>
        </div>
    </div>
    <nav>
        <div class="menu_top"> <i class="fas fa-bookmark"></i>
            <p>Quản lý</p>
        </div>
        <div class="menu_mid">
            <ul class="menu_main">
                <li class="li1"><a href="./admin.php" class="taga"><i class="fas fa-home i_normal"></i>
                        <p>Home</p>
                    </a></li>
                <li class="li1"><a href="../detectionFace/detectionFace.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                        <p>Chấm công khuân mặt</p>
                    </a></li>
                <li class="li1"><a href="./taiKhoan.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                        <p>Tài khoản</p>
                    </a></li>
                <li class="li1"><a href="./cauHinhThongSo.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                        <p>Cấu hình thông số</p>
                    </a></li>
                <li class="li1"><a href="#" id="logout_btn" class="taga"><i class="fas fa-sign-out-alt i_normal"></i>
                        <p>Đăng xuất</p>
                    </a></li>
            </ul>
        </div> <!-- <div class="menu_img"></div> -->
    </nav>
    <section>
        <header>
            <div class="account">
                <p> <?php echo $_SESSION['userad']; ?> </p> <i class="fas fa-user"></i>
            </div>
            <div>
                <h1>Quản lý nhân viên</h1>
            </div>
        </header>
        <div class="con">
            <div class="menu">
                <div class="infor_main infor_class"> <img src="Img/class.svg" alt="">
                    <div class="infor_content">
                        <h1>Nhân Viên</h1>
                        <p> <?php echo $sql->getdata("SELECT count(*) as 'So' from nhanvien")->fetch_assoc()['So'] ?? 0; ?> </p>
                    </div>
                </div>
                <div class="infor_main infor_teacher"> <img src="Img/teacher.svg" alt="">
                    <div class="infor_content">
                        <h1>Phòng ban</h1>
                        <p> <?php echo $sql->getdata("SELECT count(*) as 'So' from phongban")->fetch_assoc()['So'] ?? 0; ?> </p>
                    </div>
                </div>
                <div class="infor_main infor_student"> <img src="Img/student.svg" alt="">
                    <div class="infor_content">
                        <h1>Công việc</h1>
                        <p> <?php echo ($sql->getdata("SELECT count(*) as 'So' from phancongcongviec")->fetch_assoc()['So'] ?? 0); ?> </p>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="content_home">
                    <div class="content_tieude"> <a href="#">
                            <h1>Nhân viên</h1>
                        </a> <a href="">
                            <p>Số nhân viên: <?php echo $sql->getdata("SELECT count(*) as 'So' from nhanvien")->fetch_assoc()['So'] ?? 0; ?></p>
                        </a> </div>
                    <div class="class_infor"> <a href="#">
                            <div class="khoi khoia"> <b>Công chức</b>
                                <div class="khoi_infor">
                                    <h3>Công chức</h3>
                                    <p> <?php echo $sql->getdata("SELECT count(*) as 'So' from nhanvien where LoaiNhanVien like '%công chức%'")->fetch_assoc()['So'] ?? 0 ?> </p>
                                </div>
                            </div>
                        </a> <a href="#">
                            <div class="khoi khoib"> <b>Hợp đồng</b>
                                <div class="khoi_infor">
                                    <h3>Hợp đồng</h3>
                                    <p> <?php echo $sql->getdata("SELECT count(*) as 'So' from nhanvien where LoaiNhanVien like '%hợp đồng%'")->fetch_assoc()['So'] ?? 0 ?> </p>
                                </div>
                            </div>
                        </a> </div>
                </div>
                <div class="content_home">
                    <div class="content_tieude"> <a href="#">
                            <h1>Phòng </h1>
                        </a> <a href="#">
                            <p>Số phòng ban: <?php echo $sql->getdata("SELECT count(*) as 'So' from phongban")->fetch_assoc()['So'] ?? 0; ?> </p>
                        </a> </div>
                    <div class="class_infor"> <a href="#">
                            <div class="khoi khoitunhien"> <b>A</b>
                                <div class="khoi_infor">
                                    <h3>Phòng ban A</h3>
                                    <p><i class="fas fa-chalkboard-teacher gv_icon"></i> </p>
                                </div>
                            </div>
                        </a> <a href="#">
                            <div class="khoi khoixahoi"> <b>B</b>
                                <div class="khoi_infor">
                                    <h3>Phòng ban B</h3>
                                    <p><i class="fas fa-chalkboard-teacher gv_icon"></i> </p>
                                </div>
                            </div>
                        </a> </div>
                </div>
                <div class="content_home">
                    <div class="content_tieude"> <a href="#">
                            <h1>Công việc</h1>
                        </a> <a href="">
                            <p>Số công việc: <?php echo ($sql->getdata("SELECT count(*) as 'So' from phancongcongviec")->fetch_assoc()['So'] ?? 0); ?></p>
                        </a> </div>
                    <div class="class_infor"> <a href="#">
                            <div class="khoi khoi6"> <b>QL</b>
                                <div class="khoi_infor">
                                    <h3>Quản lý</h3>
                                    <p><i class="fas fa-users hs_icon"></i> <?php echo ($sql->getdata("SELECT count(*) as 'So' from phancongcongviec where TenCongViec like '%quản lý%'")->fetch_assoc()['So'] ?? 0); ?> </p>
                                </div>
                            </div>
                        </a> </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./Js/main.js"></script>
</body>

</html>