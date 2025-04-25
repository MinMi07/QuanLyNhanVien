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
                <li class="li1 test"><a href="./admin.php" class="taga"><i class="fas fa-home i_normal i_to"></i>
                        <p class="to">Home</p>
                    </a></li>
                <li class="li1">
                    <a href="#" class="taga">
                        <i class="fas fa-vote-yea i_normal"></i>
                        <p>Mở rộng tính năng</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="../detectionFace/detectionFace.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                                <p>Chấm công khuân mặt</p>
                            </a></li>
                        <li class="li1"><a href="./taiKhoan.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                                <p>Tài khoản</p>
                            </a></li>
                        <li class="li1"><a href="./cauHinhThongSo.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                                <p>Cấu hình thông số</p>
                            </a></li>
                    </ul>
                </li>

                <li class="li1"><a href="./hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal"></i>
                        <p>Hồ sơ nhân viên</p>
                    </a></li>

                <li class="li1"><a href="#" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                        <p>Quản lý lương</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                                <p>Chấm công</p>
                            </a></li>
                        <li class="li1"><a href="./luong.php" class="taga"><i class="fa-solid fa-sack-dollar i_normal"></i>
                                <p>Lương</p>
                            </a></li>
                    </ul>
                </li>
                <li class="li1"><a href="#" class="taga"><i class="fa-solid fa-list-check i_normal"></i>
                        <p>Quản lý khác</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./bacLuong.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal"></i>
                                <p>Bậc lương</p>
                            </a></li>
                        <li class="li1"><a href="./hopDong.php" class="taga"><i class="fa-solid fa-file-contract i_normal"></i>
                                <p>Hợp đồng</p>
                            </a></li>
                        <li class="li1"><a href="./khenThuongKyLuat.php" class="taga"><i class="fa-solid fa-circle-exclamation i_normal"></i>
                                <p>Khen thưởng kỷ luật</p>
                            </a></li>
                        <li class="li1"><a href="./phanCongCongViec.php" class="taga"><i class="fa-solid fa-briefcase i_normal"></i>
                                <p>Phân công công việc</p>
                            </a></li>
                        <li class="li1"><a href="./phongBan.php" class="taga"><i class="fa-solid fa-hospital i_normal"></i>
                                <p>Phòng ban</p>
                            </a></li>
                        <li class="li1"><a href="./quaTrinhCongTac.php" class="taga"><i class="fa-solid fa-timeline i_normal"></i>
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
                        <h1>Số lượng nhân Viên</h1>
                        <p> <?php echo $sql->getdata("SELECT count(*) as 'So' from nhanvien")->fetch_assoc()['So'] ?? 0; ?> </p>
                    </div>
                </div>
                <div class="infor_main infor_teacher"> <img src="Img/teacher.svg" alt="">
                    <div class="infor_content">
                        <h1>Tổng số tiền lương</h1>
                        <p> <?php
                            echo $sql->getdata("SELECT SUM(SoTien) as 'sum' from luong")->fetch_assoc()['sum'] ?? 0;
                            ?> </p>
                    </div>
                </div>
                <div class="infor_main infor_student"> <img src="Img/student.svg" alt="">
                    <div class="infor_content">
                        <h1>Số lượng công việc</h1>
                        <p> <?php echo ($sql->getdata("SELECT count(*) as 'So' from phancongcongviec")->fetch_assoc()['So'] ?? 0); ?> </p>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="content_home">
                    <div class="content_tieude">
                        <a href="#">
                            <h1>Nhân viên</h1>
                        </a> <a href="">
                            <p>Số nhân viên: <?php echo $sql->getdata("SELECT count(*) as 'So' from nhanvien")->fetch_assoc()['So'] ?? 0; ?></p>
                        </a>
                    </div>
                    <div class="class_infor class_infor_2_column">
                        <a href="#">
                            <canvas id="bieuDoNhanVien"></canvas>
                            <h3 class="label_chart">Biểu đồ nhân viên</h3>
                        </a>
                        <a href="#">
                            <canvas id="bieuDoCongViec"></canvas>
                            <h3 class="label_chart_bar">Danh sách công việc nhân viên </h3>
                        </a>
                    </div>
                </div>
                <div class="content_home" style="display:block">
                    <div class="content_tieude">
                        <h1>Chấm công</h1>
                    </div>
                    <div class="content_content">
                        <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                            <?php
                            $month = date("n");
                            $year = date("Y");
                            $date = date("d");
                            $query = "SELECT * from chamcong WHERE DAY(ThoiGian) = $date AND MONTH(ThoiGian) = $month AND YEAR(ThoiGian) = $year";

                            $data_chamcong = $sql->getdata($query) ?? [];
                            if (empty($data_chamcong) || empty($data_chamcong->fetch_assoc())) {
                                echo "<div class=\"content_tieude\"><p>Chưa có dữ liệu chấm công ngày hôm nay</p></div>";
                            } else echo "
                                <tr class=\"bangtieude\">
                                <th width=\"4.34%\">Mã chấm công</th>
                                <th width=\"4.34%\">Mã nhân viên</th>
                                <th width=\"4.34%\">Tên nhân viên</th>
                                <th width=\"4.34%\">Thời gian</th>
                                <th width=\"4.34%\">Thời gian về</th>
                                <th width=\"4.34%\">Trạng thái</th>
                                <th width=\"4.34%\">Loại</th>
                            </tr>";
                            ?>
                        </table>
                        <div class="">
                            <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                                <?php
                                $month = date("n");
                                $year = date("Y");
                                $date = date("d");

                                $query = "SELECT * from chamcong WHERE DAY(ThoiGian) = $date AND MONTH(ThoiGian) = $month AND YEAR(ThoiGian) = $year";

                                $data_chamcong = $sql->getdata($query) ?? [];
                                while ($chamCong = $data_chamcong->fetch_assoc()) {
                                    $maNhanVien = $chamCong['MaNhanVien'];
                                    $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

                                    $loai = "Công thương";
                                    if ($chamCong['Loai'] == 1) {
                                        $loai = "Công thương";
                                    }

                                    if ($chamCong['Loai'] == 2) {
                                        $loai = "Tăng ca";
                                    }

                                    echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"4.34%\" >" . $chamCong['MaChamCong'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $chamCong['MaNhanVien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGian'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGianVe'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . ($chamCong['TrangThai'] ? "Chấm công đúng giờ" : "Chấm công muộn") . "</td>
                                <td align=\"center\" width=\"4.34%\">" . $loai . "</td>
                                </tr> ";
                                } ?> </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        const bieuDoNhanVien = document.getElementById('bieuDoNhanVien').getContext('2d');
        new Chart(bieuDoNhanVien, {
            type: 'pie',
            data: {
                labels: [
                    'Nhân viên hợp đồng',
                    'Nhân viên chính thức'
                ],
                datasets: [{
                    label: 'Số nhân viên',
                    data: [
                        <?php
                        $loaiNhanVien = 'Hợp đồng';
                        echo $sql->getdata("SELECT count(*) as 'So' from nhanvien where LoaiNhanVien like '$loaiNhanVien'")->fetch_assoc()['So'] ?? 0;
                        ?>,
                        <?php
                        $loaiNhanVien = 'Hợp đồng';
                        echo $sql->getdata("SELECT count(*) as 'So' from nhanvien where LoaiNhanVien not like '$loaiNhanVien'")->fetch_assoc()['So'] ?? 0;
                        ?>
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 16 // Tăng cỡ chữ legend
                            }
                        }
                    },
                    tooltip: {
                        bodyFont: {
                            size: 16 // Cỡ chữ nội dung tooltip
                        },
                        titleFont: {
                            size: 16 // Cỡ chữ tiêu đề tooltip
                        }
                    }
                }
            }
        });

        <?php

        $dataNhanViens = $sql->getdata("SELECT MaNhanVien, TaiKhoan from nhanvien");
        $nhanViens = [];
        if ($dataNhanViens && $dataNhanViens->num_rows > 0) {
            while ($row = $dataNhanViens->fetch_assoc()) {
                $nhanViens[$row["MaNhanVien"]] = $row["TaiKhoan"];
            }
        }

        $dataCongViecs = $sql->getdata("SELECT MaNhanVien, count(MaCongViec) as SoCongViec from phancongcongviec group by MaNhanVien");

        $congViecs = [];
        if ($dataCongViecs && $dataCongViecs->num_rows > 0) {
            while ($row = $dataCongViecs->fetch_assoc()) {
                $taiKhoan = $nhanViens[$row["MaNhanVien"]] ?? '';
                $congViecs[$taiKhoan] = (int)$row["SoCongViec"]; // ép kiểu cho chắc
            }
        }

        // Tách key và value sang 2 biến riêng
        $labels = array_keys($congViecs);
        $values = array_values($congViecs);
        ?>

        const bieuDoCongViec = document.getElementById('bieuDoCongViec').getContext('2d');

        const labels = <?= json_encode($labels) ?>;
        const dataValues = <?= json_encode($values) ?>;

        // ✅ Hàm tạo màu ngẫu nhiên dạng rgba
        function getRandomColor(opacity = 1) {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            return `rgba(${r}, ${g}, ${b}, ${opacity})`;
        }

        // ✅ Tạo mảng màu tương ứng với từng cột
        const backgroundColors = dataValues.map(() => getRandomColor(0.5));
        const borderColors = backgroundColors.map(color => color.replace('0.5', '1'));

        const data = {
            labels: labels,
            datasets: [{
                label: 'Số lượng công việc',
                data: dataValues,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        };

        new Chart(bieuDoCongViec, {
            type: 'bar',
            data: data,
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14 // tăng cỡ chữ chú thích
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        bodyFont: {
                            size: 14 // tăng cỡ chữ tooltip
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                size: 14 // cỡ chữ trục y
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 14 // cỡ chữ trục x
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            await fetch("export_sinhNhat.php")
                .then(response => response.text())
                .then(data => console.log("Kết quả:", data))
                .catch(error => console.error("Lỗi khi gọi file export_sinhNhat.php:", error));

            // Danh sách nhân viên được tăng lương theo kỳ
            await fetch("export_nhanVienTangLuongTheoKy.php")
                .then(response => response.text())
                .then(data => console.log("Kết quả:", data))
                .catch(error => console.error("Lỗi khi gọi file export_nhanVienTangLuongTheoKy.php:", error));

            // Danh sách nhân viên đến tuổi nghỉ hưu
            await fetch("export_nhanVienNghiHuu.php")
                .then(response => response.text())
                .then(data => console.log("Kết quả:", data))
                .catch(error => console.error("Lỗi khi gọi file export_nhanVienNghiHuu.php:", error));

            // Tính lương
            await fetch("export_luong.php")
                .then(response => response.text())
                .then(data => console.log("Kết quả:", data))
                .catch(error => console.error("Lỗi khi gọi file expoexport_luongrt_sinhNhat.php:", error));
        });
    </script>

</body>

</html>