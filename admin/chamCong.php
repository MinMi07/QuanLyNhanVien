<?php session_start();
require_once "./login/checkLoginAdmin.php";
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
    <link rel="stylesheet" href="./css/style.css">
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
    <div class="hidden" id="add">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Thêm</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_ma" style="width: 100%">
                            <label for="MaNhanVien">Mã nhân viên<span>*</span></label>
                            <select name="manhanvien" id="MaNhanVien">
                                <?php
                                $maNhanVien = "SELECT MaNhanVien from nhanvien ";
                                $dataMaNhanVien = $sql->getdata($maNhanVien);
                                while ($row = $dataMaNhanVien->fetch_assoc()) {
                                    echo "<option value=\"" . $row['MaNhanVien'] . "\">" . $row['MaNhanVien'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="add_pass"> <label for="ThoiGian">Thời gian<span>*</span></label> <input type="datetime-local" id="ThoiGian"> </div>
                        <div class="add_pass"> <label for="ThoiGianVe">Thời gian về<span>*</span></label> <input type="datetime-local" id="ThoiGianVe"> </div>
                        <div class="add_pass"> <label for="TrangThai">Trạng thái<span>*</span></label>
                            <select name="TrangThai" id="TrangThai">
                                <option value="0">Chấm công muộn</option>
                                <option value="1">Chấm công đúng giờ</option>
                            </select>
                        </div>
                        <div class="add_pass"> <label for="Loai">Loại<span>*</span></label>
                            <select name="Loai" id="Loai">
                                <option value="1">Công thường</option>
                                <option value="2">Tăng ca</option>
                            </select>
                        </div>
                    </div>
                    <div class="button"> <button type="button" id="add_chamCong">Thêm</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền</p>
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
                <li class="li1 "><a href="./admin.php" class="taga"><i class="fas fa-home i_normal "></i>
                        <p>Home</p>
                    </a></li>
                <li class="li1"><a href="./moRongTinhNang.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                        <p>Mở rộng tính năng</p>
                    </a></li>
                <li class="li1"><a href="./hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal"></i>
                        <p>Hồ sơ nhân viên</p>
                    </a></li>
                <li class="li1 test"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal i_to"></i>
                        <p class="to">Chấm công</p>
                    </a></li>
                <li class="li1"><a href="./bacLuong.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal"></i>
                        <p>Bậc lương</p>
                    </a></li>
                <li class="li1"><a href="./hopDong.php" class="taga"><i class="fa-solid fa-file-contract i_normal"></i>
                        <p>Hợp đồng</p>
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
                <li class="li1"><a href="./phongBan.php" class="taga"><i class="fa-solid fa-hospital i_normal"></i>
                        <p>Phòng ban</p>
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
                <p> <?php echo $_SESSION['userad']; ?> </p> <i class="fas fa-user"></i>
            </div>
            <div>
                <h1>Quản lý nhân viên</h1>
            </div>
        </header>
        <div class="con">
            <div class="content">
                <div class="chucnang">
                    <div class="chucnangchinh">
                        <input type="button" value="Xuất Excel" id="excel_btn">
                        <input type="button" value="Bổ sung công" id="add_btn">
                    </div>
                    <div class="timkiem">
                        <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="MaNhanVien">Mã nhân viên</option>
                            <option value="MaChamCong">Mã chấm công</option>
                        </select>
                        <input type="search" placeholder="Tìm kiếm" id="search">

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
                            <th width="4.34%">Tên nhân viên</th>
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

                            $query = "SELECT * from chamcong WHERE MONTH(ThoiGian) = $month AND YEAR(ThoiGian) = $year";

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
    </section>
    <script src="./js/main.js"></script>
    <script>
        // Bổ sung chấm công
        document.getElementById('add_chamCong').onclick = async function() {
            var MaNhanVien = document.getElementById('MaNhanVien');
            var ThoiGian = document.getElementById('ThoiGian');
            var ThoiGianVe = document.getElementById('ThoiGianVe');
            var TrangThai = document.getElementById('TrangThai');
            var Loai = document.getElementById('Loai');

            if (
                MaNhanVien.value == '' ||
                ThoiGian.value == '' ||
                ThoiGianVe.value == '' ||
                TrangThai.value == '' ||
                Loai.value == ''
            ) {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                let data = {
                    MaNhanVien: MaNhanVien.value,
                    ThoiGian: ThoiGian.value,
                    ThoiGianVe: ThoiGianVe.value,
                    TrangThai: TrangThai.value,
                    Loai: Loai.value
                };

                try {
                    let checkResponse = await fetch('./add_chamCong.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    let responseText = await checkResponse.text();
                    let checkResult = JSON.parse(responseText);

                    if (checkResult.success) {
                        Toastify({
                            text: checkResult.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
                        }).showToast();

                        setTimeout(() => {
                            window.location.href = "chamCong.php";
                        }, 3000);
                    } else {
                        Toastify({
                            text: checkResult.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "linear-gradient(to right, #FF7043, #E64A19)"
                        }).showToast();
                    }

                } catch (error) {
                    Toastify({
                        text: error.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #FF7043, #E64A19)"
                    }).showToast();
                }
            }
        }

        // Chức năng xuất excel
        document.getElementById("excel_btn").addEventListener("click", function() {
            // Lấy bảng
            var table = document.getElementById("table_class");
            var tableData = XLSX.utils.sheet_to_json(XLSX.utils.table_to_sheet(table), {
                header: 1
            });

            // Danh sách các cột cần định dạng ngày
            let dateColumns = [3, 4]; // Vị trí cột của thời gian chấm công

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
                ["Mã chấm công", "Mã nhân viên", "Tên nhân viên", "Thời gian", "Thời gian về", "Trạng thái", "Loại"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "ChamCong");

            // Xuất file Excel
            XLSX.writeFile(wb, "ChamCong.xlsx");
        });


        // Chức năng tìm kiếm
        document.querySelectorAll('#search, #search_thang, #search_nam').forEach(async function(input) {
            input.oninput = async function() {
                var sel_search = document.getElementById('sel_search').value;
                var search = document.getElementById('search');

                var sel_search_thang = document.getElementById('search_thang');
                var sel_search_nam = document.getElementById('search_nam');

                var searchValue = search.value ?? '';
                var thang = sel_search_thang.value ?? '';
                var nam = sel_search_nam.value ?? '';

                if (searchValue == '' && thang == '' && nam == '') {
                    location.reload();
                } else {
                    let dataById = await fetch('./timKiem_chamCong.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            Search: sel_search,
                            SearchValue: searchValue,
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