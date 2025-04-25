<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chấm công khuân mặt</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="../admin/css/style.css">
    <script src="./face-api.min.js" defer></script>
    <script src="./index.js" defer></script>
</head>

<body>
    <div class="hidden" id="thongbao_chucnang" style="z-index: 1000;">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <div id="thongbao_chucnang_1"> </div>
            </div>
        </div>
    </div>
    <div class="hidden" id="delete">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Thông báo </h2>
                <div id="delete_infor"> </div>
                <form class="" action="./dangXuat.php" method="post">
                    <div class="submit"> <button type="button" id="delete_confirm">X├│a</button> </div>
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

                <li class="li1 test">
                    <a href="#" class="taga">
                        <i class="fas fa-vote-yea i_normal i_to"></i>
                        <p class="to">Mở rộng tính năng</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="../detectionFace/detectionFace.php" class="taga"><i class="fas fa-vote-yea i_normal i_to"></i>
                                <p class="to">Chấm công khuân mặt</p>
                            </a></li>
                        <li class="li1"><a href="../admin/taiKhoan.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                                <p>Tài khoản</p>
                            </a></li>
                        <li class="li1"><a href="../admin/cauHinhThongSo.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                                <p>Cấu hình thông số</p>
                            </a></li>
                    </ul>
                </li>

                <li class="li1"><a href="../admin/hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal"></i>
                        <p>Hồ sơ nhân viên</p>
                    </a></li>

                <li class="li1"><a href="#" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                        <p>Quản lý lương</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="../admin/chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                                <p>Chấm công</p>
                            </a></li>
                        <li class="li1"><a href="../admin/luong.php" class="taga"><i class="fa-solid fa-sack-dollar i_normal"></i>
                                <p>Lương</p>
                            </a></li>
                    </ul>
                </li>
                <li class="li1"><a href="#" class="taga"><i class="fa-solid fa-list-check i_normal"></i>
                        <p>Quản lý khác</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="../admin/bacLuong.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal"></i>
                                <p>Bậc lương</p>
                            </a></li>
                        <li class="li1"><a href="../admin/hopDong.php" class="taga"><i class="fa-solid fa-file-contract i_normal"></i>
                                <p>Hợp đồng</p>
                            </a></li>
                        <li class="li1"><a href="../admin/khenThuongKyLuat.php" class="taga"><i class="fa-solid fa-circle-exclamation i_normal"></i>
                                <p>Khen thưởng kỷ luật</p>
                            </a></li>
                        <li class="li1"><a href="../admin/phanCongCongViec.php" class="taga"><i class="fa-solid fa-briefcase i_normal"></i>
                                <p>Phân công công việc</p>
                            </a></li>
                        <li class="li1"><a href="../admin/phongBan.php" class="taga"><i class="fa-solid fa-hospital i_normal"></i>
                                <p>Phòng ban</p>
                            </a></li>
                        <li class="li1"><a href="../admin/quaTrinhCongTac.php" class="taga"><i class="fa-solid fa-timeline i_normal"></i>
                                <p>Quá trình công tác</p>
                            </a></li>
                    </ul>
                </li>
                <li class="li1"><a href="#" id="logout_btn" class="taga"><i class="fas fa-sign-out-alt i_normal"></i>
                        <p>Đăng xuất</p>
                    </a></li>
            </ul>
        </div>
    </nav>
    <section>
        <header>
            <div class="account"> </div>
            <div>
                <h1>Chấm công khuân mặt</h1>
            </div>
        </header>
        <div class="con">
    </section> <video src="" autoplay="true" id="videoItem"></video>
    <script src="../admin/js/main.js"></script>
</body>

</html>