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
    <title>Hồ sơ nhân viên</title>
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
                <li class="li1 test"><a href="./hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal i_to"></i>
                        <p class="to">Hồ sơ nhân viên</p>
                    </a></li>
                <li class="li1"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                        <p>Chấm công</p>
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
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="4.34%">Mã nhân viên</th>
                            <th width="4.34%">Họ tên</th>
                            <th width="4.34%">Ngày sinh</th>
                            <th width="4.34%">Giới tính</th>
                            <th width="4.34%">Trình độ</th>
                            <th width="4.34%">Ngoại ngữ</th>
                            <th width="4.34%">CMND</th>
                            <th width="4.34%">Địa chỉ</th>
                            <th width="4.34%">SĐT</th>
                            <th width="4.34%">Email</th>
                            <th width="4.34%">Tôn giáo</th>
                            <th width="4.34%">Dân tộc</th>
                            <th width="4.34%">Chức vụ</th>
                            <th width="4.34%">Phòng ban</th>
                            <th width="4.34%">Ngày vào đoàn</th>
                            <th width="4.34%">Ngày vào đảng</th>
                            <th width="4.34%">Loại nhân viên</th>
                            <th width="4.34%">Hôn nhân</th>
                            <th width="4.34%">Cha</th>
                            <th width="4.34%">Mẹ</th>
                            <th width="4.34%">Vợ/Cồng</th>
                            <th width="4.34%">Con</th>
                            <th width="4.34%">Bậc lương</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php 
                            $maNhanVien = $_SESSION['maNhanVien'];
                            $query = "SELECT * from nhanvien where MaNhanVien = '$maNhanVien'";

                            $data_nhanvien_bang = $sql->getdata($query);
                            while ($nhanVien = $data_nhanvien_bang->fetch_assoc()) {
                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"4.34%\" >" . $nhanVien['MaNhanVien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['HoTen'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgaySinh'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['GioiTinh'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['TrinhDo'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgoaiNgu'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['CMND'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['DiaChi'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['SDT'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['Email'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['TonGiao'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['DanToc'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['ChucVu'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['PhongBan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgayVaoDoan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgayVaoDang'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['LoaiNhanVien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['TinhTrangHonNhan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['Cha'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['Me'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['VoChong'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['Con'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $nhanVien['BacLuong'] . "</td></tr> ";
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
            let dateColumns = [2, 14, 15]; // Vị trí cột của Ngày Sinh, Ngày Vào Đoàn, Ngày Vào Đảng

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
                ["Mã NV", "Họ Tên", "Ngày Sinh", "Giới Tính", "Trình Độ", "Ngoại Ngữ", "CMND", "Địa Chỉ", "SDT", "Email", "Tôn Giáo", "Dân Tộc", "Chức Vụ", "Phòng Ban", "Ngày Vào Đoàn", "Ngày Vào Đảng", "Loại Nhân Viên", "Tình Trạng Hôn Nhân", "Cha", "Mẹ", "Vợ/Chồng", "Con", "Bậc Lương"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "DanhSachNhanVien");

            // Xuất file Excel
            XLSX.writeFile(wb, "DanhSachNhanVien.xlsx");
        });


        // Chức năng tìm kiếm
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');
            search('timKiem_hoSoNhanVien.php', sel_search.value, this.value);
        }

        // Thêm dữ liệu nhận diện khuân mặt
        document.getElementById('data_face').addEventListener("click", async function() {
            var taiKhoan = document.getElementById('TaiKhoan_data').value.trim();
            var files = document.getElementById('AnhMau_data').files;

            if (!taiKhoan) {
                alert("Vui lòng nhập tài khoản trước khi tải ảnh lên!");
                return;
            }

            if (files.length === 0) {
                alert("Vui lòng chọn ít nhất một ảnh!");
                return;
            }

            let formData = new FormData();
            formData.append("taiKhoan", taiKhoan);

            for (let i = 0; i < files.length; i++) {
                formData.append("images[]", files[i], `${i + 1}.jpg`);
            }

            let checkResponse = await fetch('./upload_face.php', {
                method: "POST",
                body: formData
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
                    window.location.href = "hoSoNhanVien.php";
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
        })
    </script>
</body>

</html>