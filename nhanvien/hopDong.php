<?php session_start();
require_once "./login/checkLogin.php";
require_once "./login/sql.php";
require_once "./infor_general.php";
$sql = new SQL(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="../admin/css/style.css">
    <title>Hợp đồng</title>
    <script> </script>
</head>

<body>
    <div class="hidden" id="thongbao_chucnang" style="z-index: 1000;">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <div id="thongbao_chucnang_1"> </div>
            </div>
        </div>
    </div>
    <div class="hidden" id="logout">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Đăng xuất</h2>
                <form class="" action="./dangXuat.php" method="post">
                    <div class="submit"> <button>Xác nhận đăng xuất</button> </div>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden" id="delete">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Thông báo </h2>
                <div id="delete_infor"> </div>
                <form class="" action="./dangXuat.php" method="post">
                    <div class="submit"> <button type="button" id="delete_confirm">Xóa</button> </div>
                </form>
            </div>
        </div>
    </div>
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
            <p>Nhân viên</p>
        </div>
        <div class="menu_mid">
            <ul class="menu_main">
                <li class="li1 "><a href="./nhanVien.php" class="taga"><i class="fas fa-home i_normal "></i>
                        <p>Home</p>
                    </a></li>
                <li class="li1"><a href="./hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal"></i>
                        <p>Hồ sơ nhân viên</p>
                    </a></li>
                <li class="li1"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                        <p>Chấm công</p>
                    </a></li>
                <li class="li1"><a href="./bacLuong.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal"></i>
                        <p>Bậc lương</p>
                    </a></li>
                <li class="li1 test"><a href="./hopDong.php" class="taga"><i class="fa-solid fa-file-contract i_normal i_to"></i>
                        <p class="to">Hợp đồng</p>
                    </a></li>
                <li class="li1"><a href="./khenThuongKyLuat.php" class="taga"><i class="fa-solid fa-circle-exclamation i_normal"></i>
                        <p>Khen thưởng kỷ luật</p>
                    </a></li>
                <li class="li1"><a href="./luong.php" class="taga"><i class="fa-solid fa-sack-dollar i_normal"></i>
                        <p>Lương</p>
                    </a></li>
                <li class="li1"><a href="./phanCongCongViec.php" class="taga"><i class="fa-solid fa-briefcase i_normal"></i>
                        <p>Phân công công việc</p>
                    </a></li>
                <li class="li1"><a href="./quaTrinhCongTac.php" class="taga"><i class="fa-solid fa-timeline i_normal"></i>
                        <p>Quá trình công tác</p>
                    </a></li>
                <li class="li1"><a href="#" id="logout_btn" class="taga"><i class="fas fa-sign-out-alt i_normal"></i>
                        <p>Đăng xuất</p>
                    </a></li>
            </ul>
        </div>
    </nav>
    <section>
        <header>
            <div class="account">
                <p> <?php echo $_SESSION['userNhanVien']; ?> </p> <i class="fas fa-user"></i>
            </div>
            <div>
                <h1>Quản lý thông tin</h1>
            </div>
        </header>
        <div class="con">
            <div class="content">
                <div class="chucnang">
                    <div class="chucnangchinh">
                        <input type="button" value="Xuất Excel" id="excel_btn">
                    </div>
                    <div class="timkiem"> <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="MaHopDong">Mã hợp đồng</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search"> </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="4.34%">Mã hợp đồng</th>
                            <th width="4.34%">Mã nhân viên</th>
                            <th width="4.34%">Loại hợp đồng</th>
                            <th width="4.34%">Ngày bắt đầu</th>
                            <th width="4.34%">Ngày hết hạn</th>
                            <th width="4.34%">Bậc lương</th>
                            <th width="4.34%">Hệ số lương</th>
                            <th width="4.34%">Phụ cấp</th>
                            <th width="4.34%">Bảo hiểm</th>
                            <th width="4.34%">Lương thỏa thuận</th>
                            <th width="4.34%">Trạng thái</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php
                            $maNhanVien = $_SESSION['maNhanVien'];
                            $query = "SELECT * from hopdong where MaNhanVien = $maNhanVien";
                            $data_hopdong = $sql->getdata($query);
                            while ($hopDong = $data_hopdong->fetch_assoc()) {
                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"4.34%\" >" . $hopDong['MaHopDong'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['MaNhanVien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['LoaiHopDong'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['NgayBatDau'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['NgayHetHan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['BacLuong'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['HeSoLuong'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['PhuCap'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['BaoHiem'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['LuongThoaThuan'] . "</td> 
                                </tr> ";
                            } ?> </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../admin/js/main.js"></script>
    <script>
        // Chức năng xuất excel
        document.getElementById("excel_btn").addEventListener("click", function() {
            // Lấy bảng
            var table = document.getElementById("table_class");
            var tableData = XLSX.utils.sheet_to_json(XLSX.utils.table_to_sheet(table), {
                header: 1
            });

            // Danh sách các cột cần định dạng ngày
            let dateColumns = [3, 4]; // Vị trí cột của ngày bắt đầu, ngày kết thúc

            // Chuyển đổi kiểu dữ liệu ngày cho tất cả các dòng
            tableData.forEach((row, rowIndex) => {
                dateColumns.forEach(colIndex => {
                    if (row[colIndex]) {
                        let excelDate = parseFloat(row[colIndex]);
                        if (!isNaN(excelDate)) { // Kiểm tra xem có phải số không
                            let date = new Date((excelDate - 25569) * 86400000);
                            row[colIndex] = date.toISOString().slice(0, 19).replace('T', ' '); // Định dạng yyyy-MM-dd HH:mm:ss
                        }
                    }
                });
            });

            // Tạo Workbook và Sheet mới
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([
                ["Mã Hợp Đồng", "Mã Nhân Viên", "Loại Hợp Đồng", "Ngày Bắt Đầu", "Ngày Hết Thúc", "Bậc Lương", "Hệ Số Lương", "Phụ Cấp", "Bảo Hiểm", "Lương Thỏa Thuận", "Trạng Thái"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "HopDong");

            // Xuất file Excel
            XLSX.writeFile(wb, "HopDong.xlsx");
        });


        // Chức năng tìm kiếm
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');

            if (this.value == '') {
                location.reload();
            }

            search('timKiem_hopDong.php', sel_search.value, this.value);
        }
    </script>
</body>

</html>