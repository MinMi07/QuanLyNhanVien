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
    <title>Chấm công</title>
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
                <li class="li1"><a href="./nhanvien.php" class="taga"><i class="fas fa-home i_normal"></i>
                        <p>Home</p>
                    </a></li>
                <li class="li_dad">
                    <a href="#" class="taga">
                        <i class="fas fa-vote-yea i_normal"></i>
                        <p>Thông tin nhân sự</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal"></i>
                                <p>Hồ sơ nhân viên</p>
                            </a></li>
                        <li class="li1"><a href="./hopDong.php" class="taga"><i class="fa-solid fa-file-contract i_normal"></i>
                                <p>Hợp đồng</p>
                            </a></li>
                        <li class="li1"><a href="./quaTrinhCongTac.php" class="taga"><i class="fa-solid fa-timeline i_normal"></i>
                                <p>Quá trình công tác</p>
                            </a></li>
                        <li class="li1"><a href="./phanCongCongViec.php" class="taga"><i class="fa-solid fa-briefcase i_normal"></i>
                                <p>Phân công công việc</p>
                            </a></li>
                        <li class="li1"><a href="./khenThuongKyLuat.php" class="taga"><i class="fa-solid fa-circle-exclamation i_normal"></i>
                                <p>Khen thưởng kỷ luật</p>
                            </a></li>
                    </ul>
                </li>
                <li class="li_dad">
                    <a href="#" class="taga">
                        <i class="fas fa-vote-yea i_normal i_to"></i>
                        <p class="to">Lương</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal i_to"></i>
                                <p class="to">Chấm công</p>
                            </a></li>
                        <li class="li1"><a href="./luong.php" class="taga"><i class="fa-solid fa-sack-dollar i_normal"></i>
                                <p>Bảng lương</p>
                            </a></li>
                    </ul>
                </li>
                <li class="li_dad">
                    <a href="#" class="taga">
                        <i class="fas fa-vote-yea i_normal"></i>
                        <p>Khác</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./bacLuong.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal"></i>
                                <p>Bậc lương</p>
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
                    <div class="timkiem">
                        <select name="luachontimkiem" class="luachon" id="sel_search_thang">
                            <option value="Thang">Tháng</option>
                        </select>
                        <input type="search" placeholder="Tìm kiếm" id="search_thang">

                        <select name="luachontimkiem" class="luachon" id="sel_search_nam">
                            <option value="Nam">Năm</option>
                        </select>
                        <input type="search" placeholder="Tìm kiếm" id="search_nam">
                    </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="4.34%">Mã chấm công</th>
                            <th width="4.34%">Mã nhân viên</th>
                            <th width="4.34%">Thời gian</th>
                            <th width="4.34%">Thời gian về</th>
                            <th width="4.34%">Trạng thái</th>
                            <th width="4.34%">Loại</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php
                            $month = date("n");
                            $year = date("Y");
                            $maNhanVien = $_SESSION['maNhanVien'];
                            $query = "SELECT * from chamcong WHERE MaNhanVien = $maNhanVien AND MONTH(ThoiGian) = $month AND YEAR(ThoiGian) = $year";

                            $data_chamcong = $sql->getdata($query);
                            if ($data_chamcong && $data_chamcong->num_rows > 0) {
                                while ($chamCong = $data_chamcong->fetch_assoc()) {
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
                                    <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGian'] . "</td> 
                                    <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGianVe'] . "</td> 
                                    <td align=\"center\" width=\"4.34%\">" . ($chamCong['TrangThai'] ? "Chấm công đúng giờ" : "Chấm công muộn") . "</td>
                                    <td align=\"center\" width=\"4.34%\">" . $loai . "</td>
                                    </tr> ";
                                }
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
            let dateColumns = [2, 3]; // Vị trí cột của thời gian chấm công

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
                ["Mã chấm công", "Mã nhân viên", "Thời gian", "Thời gian về", "Trạng thái", "Loại"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "ChamCong");

            // Xuất file Excel
            XLSX.writeFile(wb, "ChamCong.xlsx");
        });


        // Chức năng tìm kiếm
        document.querySelectorAll('#search_thang, #search_nam').forEach(async function(input) {
            input.oninput = async function() {
                var sel_search_thang = document.getElementById('search_thang');
                var sel_search_nam = document.getElementById('search_nam');

                var thang = sel_search_thang.value ?? '';
                var nam = sel_search_nam.value ?? '';

                if (thang == '' && nam == '') {
                    location.reload();
                } else {
                    let dataById = await fetch('./timKiem_chamCongNhanVien.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            Thang: thang,
                            Nam: nam
                        })
                    });

                    let dataText = await dataById.text();
                    document.getElementById("table_class").innerHTML = dataText
                }
            }
        });
    </script>
</body>

</html>