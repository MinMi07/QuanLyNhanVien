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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Khen thưởng kỷ luật</title>
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
                        <div class="add_pass"> <label for="ThoiGianKhenThuongKyLuat">Thời gian khen thưởng kỷ luật<span>*</span></label> <input type="date" id="ThoiGianKhenThuongKyLuat"> </div>
                        <div class="add_pass"> <label for="Loai">Loại<span>*</span></label> <input type="text" id="Loai"> </div>
                        <div class="add_pass"> <label for="NoiDung">Nội dung<span>*</span></label> <input type="text" id="NoiDung"> </div>
                        <div class="add_pass"> <label for="SoQuyetDinh">Số quyết định<span>*</span></label> <input type="text" id="SoQuyetDinh"> </div>
                        <div class="add_pass"> <label for="CoQuanQuyetDinh">Cơ quan quyết định<span>*</span></label> <input type="text" id="CoQuanQuyetDinh"> </div>
                        <div class="add_pass"> <label for="HinhThuc">Hình thức<span>*</span></label> <input type="text" id="HinhThuc"> </div>
                        <div class="add_pass"> <label for="SoTien">Số Tiền<span>*</span></label> <input type="text" id="SoTien"> </div>
                        <div class="add_pass"> <label for="TrangThai">Trạng thái<span>*</span></label> <input type="text" id="TrangThai"> </div>
                        <div class="add_pass"> <label for="GhiChu">Ghi chú<span>*</span></label> <input type="text" id="GhiChu"> </div>
                    </div>
                    <div class="button"> <button type="button" id="add_khenThuongKyLuat">Thêm</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền</p>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden" id="update">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Sửa thông tin hợp đồng</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_ma" style="width: 100%">
                            <label for="MaNhanVien">Mã nhân viên<span>*</span></label>
                            <select name="manhanvien" id="MaNhanVien_update">
                                <?php
                                $maNhanVien = "SELECT MaNhanVien from nhanvien ";
                                $dataMaNhanVien = $sql->getdata($maNhanVien);
                                while ($row = $dataMaNhanVien->fetch_assoc()) {
                                    echo "<option value=\"" . $row['MaNhanVien'] . "\">" . $row['MaNhanVien'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="add_pass"> <label for="ThoiGianKhenThuongKyLuat">Thời gian khen thưởng kỷ luật<span>*</span></label> <input type="date" id="ThoiGianKhenThuongKyLuat_update"> </div>
                        <div class="add_pass"> <label for="Loai">Loại<span>*</span></label> <input type="text" id="Loai_update"> </div>
                        <div class="add_pass"> <label for="NoiDung">Nội dung<span>*</span></label> <input type="text" id="NoiDung_update"> </div>
                        <div class="add_pass"> <label for="SoQuyetDinh">Số quyết định<span>*</span></label> <input type="text" id="SoQuyetDinh_update"> </div>
                        <div class="add_pass"> <label for="CoQuanQuyetDinh">Cơ quan quyết định<span>*</span></label> <input type="text" id="CoQuanQuyetDinh_update"> </div>
                        <div class="add_pass"> <label for="HinhThuc">Hình thức<span>*</span></label> <input type="text" id="HinhThuc_update"> </div>
                        <div class="add_pass"> <label for="SoTien">Số Tiền<span>*</span></label> <input type="text" id="SoTien_update"> </div>
                        <div class="add_pass"> <label for="TrangThai">Trạng thái<span>*</span></label> <input type="text" id="TrangThai_update"> </div>
                        <div class="add_pass"> <label for="GhiChu">Ghi chú<span>*</span></label> <input type="text" id="GhiChu_update"> </div>
                    </div>
                    <div class="button"> <button type="button" id="update_khenThuongKyLuat">Sửa</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền <br> Nếu chọn nhiều hơn 1 sẽ thực hiện sửa cho hàng đầu tiên mà bạn chọn </p>
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
                        <p">Hồ sơ nhân viên</p>
                    </a></li>
                <li class="li1"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                        <p>Chấm công</p>
                    </a></li>
                <li class="li1"><a href="./bacLuong.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal"></i>
                        <p>Bậc lương</p>
                    </a></li>
                <li class="li1"><a href="./hopDong.php" class="taga"><i class="fa-solid fa-file-contract i_normal"></i>
                        <p">Hợp đồng</p>
                    </a></li>
                <li class=" li1 test"><a href="./khenThuongKyLuat.php" class="taga"><i class="fa-solid fa-circle-exclamation i_normal i_to"></i>
                        <p class="to">Khen thưởng kỷ luật</p>
                    </a></li>
                <li class=" li1"><a href="./luong.php" class="taga"><i class="fa-solid fa-sack-dollar i_normal"></i>
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
                        <input type="button" value="Thêm" id="add_btn">
                        <input type="button" value="Sửa" id="update_btn">
                        <input type="button" value="Xuất Excel" id="excel_btn">
                    </div>
                    <div class="timkiem"> <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="MaKhenThuongKyLuat">Mã khen thưởng kỷ luật</option>
                            <option value="MaNhanVien">Mã nhân viên</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search"> </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="4.34%">Mã khen thưởng kỷ luật</th>
                            <th width="4.34%">Mã nhân viên</th>
                            <th width="4.34%">Tên nhân viên</th>
                            <th width="4.34%">Thời gian</th>
                            <th width="4.34%">Loại</th>
                            <th width="4.34%">Nội dung</th>
                            <th width="4.34%">Số quyết định</th>
                            <th width="4.34%">Cơ quan quyết định</th>
                            <th width="4.34%">Hình thức</th>
                            <th width="4.34%">Số tiền</th>
                            <th width="4.34%">Trạng thái</th>
                            <th width="4.34%">Ghi chú</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php $query = "SELECT * from khenthuongkyluat";
                            $data_hopdong = $sql->getdata($query);
                            while ($hopDong = $data_hopdong->fetch_assoc()) {
                                $maNhanVien = $hopDong['MaNhanVien'];
                                $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"4.34%\" >" . $hopDong['MaKhenThuongKyLuat'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['MaNhanVien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['ThoiGianKhenThuongKyLuat'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['Loai'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['NoiDung'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['SoQuyetDinh'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['CoQuanQuyetDinh'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['HinhThuc'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['SoTien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['TrangThai'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $hopDong['GhiChu'] . "</td> </tr> ";
                            } ?> </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/main.js"></script>
    <script>
        // Chức năng thêm thông tin
        document.getElementById('add_khenThuongKyLuat').onclick = async function() {
            var MaNhanVien = document.getElementById('MaNhanVien');
            var ThoiGianKhenThuongKyLuat = document.getElementById('ThoiGianKhenThuongKyLuat');
            var Loai = document.getElementById('Loai');
            var NoiDung = document.getElementById('NoiDung');
            var SoQuyetDinh = document.getElementById('SoQuyetDinh');
            var CoQuanQuyetDinh = document.getElementById('CoQuanQuyetDinh');
            var HinhThuc = document.getElementById('HinhThuc');
            var SoTien = document.getElementById('SoTien');
            var TrangThai = document.getElementById('TrangThai');
            var GhiChu = document.getElementById('GhiChu');

            if (
                MaNhanVien.value == '' ||
                ThoiGianKhenThuongKyLuat.value == '' ||
                Loai.value == '' ||
                NoiDung.value == '' ||
                SoQuyetDinh.value == '' ||
                CoQuanQuyetDinh.value == '' ||
                HinhThuc.value == '' ||
                SoTien.value == '' ||
                TrangThai.value == '' ||
                GhiChu.value == ''
            ) {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                let data = {
                    MaNhanVien: MaNhanVien.value,
                    ThoiGianKhenThuongKyLuat: ThoiGianKhenThuongKyLuat.value,
                    Loai: Loai.value,
                    NoiDung: NoiDung.value,
                    SoQuyetDinh: SoQuyetDinh.value,
                    CoQuanQuyetDinh: CoQuanQuyetDinh.value,
                    HinhThuc: HinhThuc.value,
                    SoTien: SoTien.value,
                    TrangThai: TrangThai.value,
                    GhiChu: GhiChu.value
                };

                console.log(data);

                try {
                    let checkResponse = await fetch('./add_khenThuongKyLuat.php', {
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
                            window.location.href = "khenThuongKyLuat.php";
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

        // Cập nhật hồ sơ nhân viên

        document.getElementById('update_btn').onclick = async function() {
            var maKhenThuongKyLuats = [];
            get_ma(maKhenThuongKyLuats, update_box, 'sửa');

            let dataById = await fetch('./getDataById.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Table: "khenthuongkyluat",
                    IdBang: maKhenThuongKyLuats[0],
                    TenCotId: "MaKhenThuongKyLuat"
                })
            });

            let dataText = await dataById.text();
            let dataResult = JSON.parse(dataText);

            document.getElementById('MaNhanVien_update').value = dataResult.data.MaNhanVien;
            document.getElementById('ThoiGianKhenThuongKyLuat_update').value = moment(dataResult.data.ThoiGianKhenThuongKyLuat).format("YYYY-MM-DD");
            document.getElementById('Loai_update').value = dataResult.data.Loai;
            document.getElementById('NoiDung_update').value = dataResult.data.NoiDung;
            document.getElementById('SoQuyetDinh_update').value = dataResult.data.SoQuyetDinh;
            document.getElementById('CoQuanQuyetDinh_update').value = dataResult.data.CoQuanQuyetDinh;
            document.getElementById('HinhThuc_update').value = dataResult.data.HinhThuc;
            document.getElementById('SoTien_update').value = dataResult.data.SoTien;
            document.getElementById('TrangThai_update').value = dataResult.data.TrangThai;
            document.getElementById('GhiChu_update').value = dataResult.data.GhiChu;

            document.getElementById('update_khenThuongKyLuat').onclick = async function() {
                var MaNhanVien = document.getElementById('MaNhanVien_update');
                var ThoiGianKhenThuongKyLuat = document.getElementById('ThoiGianKhenThuongKyLuat_update');
                var Loai = document.getElementById('Loai_update');
                var NoiDung = document.getElementById('NoiDung_update');
                var SoQuyetDinh = document.getElementById('SoQuyetDinh_update');
                var CoQuanQuyetDinh = document.getElementById('CoQuanQuyetDinh_update');
                var HinhThuc = document.getElementById('HinhThuc_update');
                var SoTien = document.getElementById('SoTien_update');
                var TrangThai = document.getElementById('TrangThai_update');
                var GhiChu = document.getElementById('GhiChu_update');

                if (maKhenThuongKyLuats.length == 0) {
                    Toastify({
                        text: "Không tìm thấy mã nhân viên",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #FF7043, #E64A19)"
                    }).showToast();
                    return;
                }

                if (
                    MaNhanVien.value == '' ||
                    ThoiGianKhenThuongKyLuat.value == '' ||
                    Loai.value == '' ||
                    NoiDung.value == '' ||
                    SoQuyetDinh.value == '' ||
                    CoQuanQuyetDinh.value == '' ||
                    HinhThuc.value == '' ||
                    SoTien.value == '' ||
                    TrangThai.value == '' ||
                    GhiChu.value == ''
                ) {
                    document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                    document.getElementById('thongbao_chucnang').style.display = 'block';
                } else {
                    let data = {
                        MaKhenThuongKyLuat: maKhenThuongKyLuats[0],
                        MaNhanVien: MaNhanVien.value,
                        ThoiGianKhenThuongKyLuat: ThoiGianKhenThuongKyLuat.value,
                        Loai: Loai.value,
                        NoiDung: NoiDung.value,
                        SoQuyetDinh: SoQuyetDinh.value,
                        CoQuanQuyetDinh: CoQuanQuyetDinh.value,
                        HinhThuc: HinhThuc.value,
                        SoTien: SoTien.value,
                        TrangThai: TrangThai.value,
                        GhiChu: GhiChu.value
                    };

                    try {
                        let checkResponse = await fetch('./update_khenThuongKyLuat.php', {
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
                                window.location.href = "khenThuongKyLuat.php";
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
        }

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
                ["Mã Khen Thưởng Kỷ Luật", "Mã Nhân Viên", "Tên nhân viên", "Thời Gian", "Loại", "Nội Dung", "Số Quyết Đinh", "Cơ Quan Quyết Định", "Hình Thức", "Số Tiền", "Trạng Thái", "Ghi Chú"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "KhenThuongKyLuat");

            // Xuất file Excel
            XLSX.writeFile(wb, "KhenThuongKyLuat.xlsx");
        });


        // Chức năng tìm kiếm
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');

            if (this.value == '') {
                location.reload();
            }

            search('timKiem_khenThuongKyLuat.php', sel_search.value, this.value);
        }
    </script>
</body>

</html>