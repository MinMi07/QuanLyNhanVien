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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="./css/style.css">
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

    <div class="hidden" id="DataDetecFace">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Thêm dữ liệu nhận diện khuân mặt</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_pass onceColumn"> <label for="TaiKhoan">Tài khoản<span>*</span></label>
                            <select name="TaiKhoan" id="TaiKhoan_data">
                                <?php
                                $taiKhoan = "SELECT TaiKhoan from taikhoan ";
                                $dataTaiKhoans = $sql->getdata($taiKhoan);
                                while ($row = $dataTaiKhoans->fetch_assoc()) {
                                    echo "<option value=\"" . $row['TaiKhoan'] . "\">" . $row['TaiKhoan'] . "</option>";
                                }
                                ?>
                            </select>
                            <!-- <input type="text" id="TaiKhoan_data"> -->
                        </div>
                        <div class="add_pass onceColumn"> <label for="AnhMau">Ảnh mẫu<span>*</span></label> <input type="file" id="AnhMau_data" multiple> </div>
                    </div>
                    <div class="button"> <button type="button" id="data_face">Tạo</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền</p>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden" id="add">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Thêm hồ sơ nhân viên</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_ma" style="width: 100%"> <label for="HoTen">Họ tên<span>*</span></label> <input type="text" id="HoTen"> </div>
                        <div class="add_pass"> <label for="NgaySinh">Ngày sinh<span>*</span></label> <input type="date" id="NgaySinh"> </div>
                        <div class="add_pass"> <label for="TaiKhoan">Tài khoản<span>*</span></label>
                            <select name="TaiKhoan" id="TaiKhoan">
                                <?php
                                $taiKhoan = "SELECT TaiKhoan from taikhoan ";
                                $dataTaiKhoan = $sql->getdata($taiKhoan);
                                while ($row = $dataTaiKhoan->fetch_assoc()) {
                                    echo "<option value=\"" . $row['TaiKhoan'] . "\">" . $row['TaiKhoan'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="add_pass"> <label for="GioiTinh">Giới tính <span>*</span></label> <input type="radio" id="nam" name="GioiTinh" value="Nam"> <label for="nam">Nam</label><br> <input type="radio" id="nu" name="GioiTinh" value="Nữ"> <label for="nu">Nữ</label><br> </div>
                        <div class="add_pass"> <label for="TrinhDo">Trình độ <span>*</span></label> <input type="text" id="TrinhDo"> </div>
                        <div class="add_pass"> <label for="NgoaiNgu">Ngoại ngữ <span>*</span></label> <input type="text" id="NgoaiNgu"> </div>
                        <div class="add_pass"> <label for="CMND">CMND <span>*</span></label> <input type="text" id="CMND"> </div>
                        <div class="add_pass"> <label for="DiaChi">Địa chỉ <span>*</span></label> <input type="text" id="DiaChi"> </div>
                        <div class="add_pass"> <label for="SDT">SĐT <span>*</span></label> <input type="text" id="SDT"> </div>
                        <div class="add_pass"> <label for="Email">Email <span>*</span></label> <input type="text" id="Email"> </div>
                        <div class="add_pass"> <label for="TonGiao">Tôn giáo <span>*</span></label> <input type="text" id="TonGiao"> </div>
                        <div class="add_pass"> <label for="DanToc">Dân tộc <span>*</span></label> <input type="text" id="DanToc"> </div>
                        <div class="add_pass"> <label for="ChucVu">Chức vụ <span>*</span></label> <input type="text" id="ChucVu"> </div>
                        <div class="add_pass"> <label for="PhongBan">Phòng ban <span>*</span></label> <input type="text" id="PhongBan"> </div>
                        <div class="add_pass"> <label for="NgayVaoDoan">Ngày vào đoàn <span></span></label> <input type="date" id="NgayVaoDoan"> </div>
                        <div class="add_pass"> <label for="NgayVaoDang">Ngày vào đảng<span></span></label> <input type="date" id="NgayVaoDang"> </div>
                        <div class="add_pass"> <label for="LoaiNhanVien">Loại nhân viên <span>*</span></label> <input type="text" id="LoaiNhanVien"> </div>
                        <div class="add_pass"> <label for="HonNhan">Hôn nhân <span>*</span></label> <input type="text" id="HonNhan"> </div>
                        <div class="add_pass"> <label for="Cha">Cha <span>*</span></label> <input type="text" id="Cha"> </div>
                        <div class="add_pass"> <label for="Me">Mẹ <span>*</span></label> <input type="text" id="Me"> </div>
                        <div class="add_pass"> <label for="VoChong">Vợ chồng <span>*</span></label> <input type="text" id="VoChong"> </div>
                        <div class="add_pass"> <label for="Con">Con <span>*</span></label> <input type="text" id="Con"> </div>
                        <div class="add_pass"> <label for="BacLuong">Bậc lương <span>*</span></label>
                            <select name="BacLuong" id="BacLuong">
                                <?php
                                $maBacLuong = "SELECT MaBacLuong from bacluong ";
                                $dataMaBacLuong = $sql->getdata($maBacLuong);
                                while ($row = $dataMaBacLuong->fetch_assoc()) {
                                    echo "<option value=\"" . $row['MaBacLuong'] . "\">" . $row['MaBacLuong'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="add_pass"> <label for="PhongCongTac">Phòng công tác <span>*</span></label> <input type="text" id="PhongCongTac"> </div>
                        <div class="add_pass"> <label for="CongViec">Công việc <span>*</span></label> <input type="text" id="CongViec"> </div>
                    </div>
                    <div class="button"> <button type="button" id="add_hosonhanvien">Thêm</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền</p>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden" id="update">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Sửa thông tin nhân viên</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_ma" style="width: 100%"> <label for="HoTen">Họ tên<span>*</span></label> <input type="text" id="HoTen_update"> </div>
                        <div class="add_pass"> <label for="NgaySinh">Ngày sinh<span>*</span></label> <input type="date" id="NgaySinh_update"> </div>
                        <div class="add_pass"> <label for="TaiKhoan">Tài khoản<span>*</span></label>
                            <select name="TaiKhoan" id="TaiKhoan_update">
                                <?php
                                $taiKhoan = "SELECT TaiKhoan from taikhoan ";
                                $dataTaiKhoan = $sql->getdata($taiKhoan);
                                while ($row = $dataTaiKhoan->fetch_assoc()) {
                                    echo "<option value=\"" . $row['TaiKhoan'] . "\">" . $row['TaiKhoan'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="add_pass"> <label for="GioiTinh">Giới tính <span>*</span></label> <input type="radio" id="nam" name="GioiTinh_update" value="Nam"> <label for="nam">Nam</label><br> <input type="radio" id="nu" name="GioiTinh_update" value="Nữ"> <label for="nu">Nữ</label><br> </div>
                        <div class="add_pass"> <label for="TrinhDo">Trình độ <span>*</span></label> <input type="text" id="TrinhDo_update"> </div>
                        <div class="add_pass"> <label for="NgoaiNgu">Ngoại ngữ <span>*</span></label> <input type="text" id="NgoaiNgu_update"> </div>
                        <div class="add_pass"> <label for="CMND">CMND <span>*</span></label> <input type="text" id="CMND_update"> </div>
                        <div class="add_pass"> <label for="DiaChi">Địa chỉ <span>*</span></label> <input type="text" id="DiaChi_update"> </div>
                        <div class="add_pass"> <label for="SDT">SĐT <span>*</span></label> <input type="text" id="SDT_update"> </div>
                        <div class="add_pass"> <label for="Email">Email <span>*</span></label> <input type="text" id="Email_update"> </div>
                        <div class="add_pass"> <label for="TonGiao">Tôn giáo <span>*</span></label> <input type="text" id="TonGiao_update"> </div>
                        <div class="add_pass"> <label for="DanToc">Dân tộc <span>*</span></label> <input type="text" id="DanToc_update"> </div>
                        <div class="add_pass"> <label for="ChucVu">Chức vụ <span>*</span></label> <input type="text" id="ChucVu_update"> </div>
                        <div class="add_pass"> <label for="PhongBan">Phòng ban <span>*</span></label> <input type="text" id="PhongBan_update"> </div>
                        <div class="add_pass"> <label for="NgayVaoDoan">Ngày vào đoàn <span></span></label> <input type="date" id="NgayVaoDoan_update"> </div>
                        <div class="add_pass"> <label for="NgayVaoDang">Ngày vào đảng<span></span></label> <input type="date" id="NgayVaoDang_update"> </div>
                        <div class="add_pass"> <label for="LoaiNhanVien">Loại nhân viên <span>*</span></label> <input type="text" id="LoaiNhanVien_update"> </div>
                        <div class="add_pass"> <label for="HonNhan">Hôn nhân <span>*</span></label> <input type="text" id="HonNhan_update"> </div>
                        <div class="add_pass"> <label for="Cha">Cha <span>*</span></label> <input type="text" id="Cha_update"> </div>
                        <div class="add_pass"> <label for="Me">Mẹ <span>*</span></label> <input type="text" id="Me_update"> </div>
                        <div class="add_pass"> <label for="VoChong">Vợ chồng <span>*</span></label> <input type="text" id="VoChong_update"> </div>
                        <div class="add_pass"> <label for="Con">Con <span>*</span></label> <input type="text" id="Con_update"> </div>
                        <div class="add_pass"> <label for="BacLuong">Bậc lương <span>*</span></label>
                            <select name="BacLuong" id="BacLuong_update">
                                <?php
                                $bacLuong = "SELECT MaBacLuong as BacLuong from bacluong ";
                                $dataBacLuong = $sql->getdata($bacLuong);
                                while ($row = $dataBacLuong->fetch_assoc()) {
                                    echo "<option value=\"" . $row['BacLuong'] . "\">" . $row['BacLuong'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="add_pass"> <label for="PhongCongTac">Phòng công tác <span>*</span></label> <input type="text" id="PhongCongTac_update"> </div>
                        <div class="add_pass"> <label for="CongViec">Công việc <span>*</span></label> <input type="text" id="CongViec_update"> </div>
                    </div>
                    <div class="button"> <button type="button" id="update_hosonhanvien">Sửa</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền <br> Nếu chọn nhiều hơn 1 sẽ thực hiện sửa cho hàng đầu tiên mà bạn chọn </p>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden" id="detail">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Chi tiết hồ sơ nhân viên</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="detail_pass"> <label for="MaNhanVien">Mã nhân viên <span></span></label> <input type="text" id="MaNhanVien_detail" disabled> </div>
                        <div class="detail_pass"> <label for="HoTen">Họ tên<span></span></label> <input type="text" id="HoTen_detail" disabled> </div>
                        <div class="detail_pass"> <label for="NgaySinh">Ngày sinh<span></span></label> <input type="date" id="NgaySinh_detail" disabled> </div>
                        <div class="detail_pass"> <label for="TaiKhoan">Tài khoản<span></span></label> <input type="text" id="TaiKhoan_detail" disabled> </div>
                        <div class="detail_pass"> <label for="GioiTinh">Giới tính <span></span></label> <input type="text" id="GioiTinh_detail" disabled> </div>
                        <div class="detail_pass"> <label for="TrinhDo">Trình độ <span></span></label> <input type="text" id="TrinhDo_detail" disabled> </div>
                        <div class="detail_pass"> <label for="NgoaiNgu">Ngoại ngữ <span></span></label> <input type="text" id="NgoaiNgu_detail" disabled> </div>
                        <div class="detail_pass"> <label for="CMND">CMND <span></span></label> <input type="text" id="CMND_detail" disabled> </div>
                        <div class="detail_pass"> <label for="DiaChi">Địa chỉ <span></span></label> <input type="text" id="DiaChi_detail" disabled> </div>
                        <div class="detail_pass"> <label for="SDT">SĐT <span></span></label> <input type="text" id="SDT_detail" disabled> </div>
                        <div class="detail_pass"> <label for="Email">Email <span></span></label> <input type="text" id="Email_detail" disabled> </div>
                        <div class="detail_pass"> <label for="TonGiao">Tôn giáo <span></span></label> <input type="text" id="TonGiao_detail" disabled> </div>
                        <div class="detail_pass"> <label for="DanToc">Dân tộc <span></span></label> <input type="text" id="DanToc_detail" disabled> </div>
                        <div class="detail_pass"> <label for="ChucVu">Chức vụ <span></span></label> <input type="text" id="ChucVu_detail" disabled> </div>
                        <div class="detail_pass"> <label for="PhongBan">Phòng ban <span></span></label> <input type="text" id="PhongBan_detail" disabled> </div>
                        <div class="detail_pass"> <label for="NgayVaoDoan">Ngày vào đoàn <span></span></label> <input type="text" id="NgayVaoDoan_detail" disabled> </div>
                        <div class="detail_pass"> <label for="NgayVaoDang">Ngày vào đảng<span></span></label> <input type="text" id="NgayVaoDang_detail" disabled> </div>
                        <div class="detail_pass"> <label for="LoaiNhanVien">Loại nhân viên <span></span></label> <input type="text" id="LoaiNhanVien_detail" disabled> </div>
                        <div class="detail_pass"> <label for="HonNhan">Hôn nhân <span></span></label> <input type="text" id="HonNhan_detail" disabled> </div>
                        <div class="detail_pass"> <label for="Cha">Cha <span></span></label> <input type="text" id="Cha_detail" disabled> </div>
                        <div class="detail_pass"> <label for="Me">Mẹ <span></span></label> <input type="text" id="Me_detail" disabled> </div>
                        <div class="detail_pass"> <label for="VoChong">Vợ chồng <span></span></label> <input type="text" id="VoChong_detail" disabled> </div>
                        <div class="detail_pass"> <label for="Con">Con <span></span></label> <input type="text" id="Con_detail" disabled> </div>
                        <div class="detail_pass"> <label for="BacLuong">Bậc lương <span></span></label> <input type="text" id="BacLuong_detail" disabled> </div>
                        <div class="detail_pass"> <label for="PhongCongTac">Phòng công tác <span></span></label> <input type="text" id="PhongCongTac_detail" disabled> </div>
                        <div class="detail_pass"> <label for="CongViec">Công việc <span></span></label> <input type="text" id="CongViec_detail" disabled> </div>
                    </div>
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
                <li class="li1"><a href="./admin.php" class="taga"><i class="fas fa-home i_normal"></i>
                        <p>Home</p>
                    </a></li>
                <li class="li_dad">
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

                <li class="li_dad">
                    <a href="#" class="taga"><i class="fa-solid fa-calendar-days i_normal i_to"></i>
                        <p class='to'>Thông tin nhân sự</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal i_to"></i>
                                <p class='to'>Hồ sơ nhân viên</p>
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
                    <a href="#" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                        <p>Lương</p>
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

                <li class="li_dad">
                    <a href="#" class="taga"><i class="fa-solid fa-list-check i_normal"></i>
                        <p>Khác</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./phongBan.php" class="taga"><i class="fa-solid fa-hospital i_normal"></i>
                                <p>Phòng ban</p>
                            </a></li>
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
                        <input type="button" value="Dữ liệu khuân mặt" id="data_to_detect_btn">
                        <input type="button" value="Xem chi tiết" id="detail_btn">
                    </div>
                    <div class="timkiem"> <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="MaNhanVien">Mã nhân viên</option>
                            <option value="SinhNhatThang">Sinh nhật tháng</option>
                            <option value="TangLuongTheoKy">Tăng lương theo kỳ</option>
                            <option value="NhanSuNghiHuu">Nhân sự đến tuổi nghỉ hưu</option>
                            <option value="HoTen">Họ tên nhân viên</option>
                            <option value="BacLuong">Bậc lương</option>
                            <option value="TrinhDo">Trình độ</option>
                            <!-- <option value="DangVien">Đảng viên</option> -->
                        </select> <input type="search" placeholder="Tìm kiếm" id="search"> </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="12.5%">Mã nhân viên</th>
                            <th width="12.5%">Họ tên</th>
                            <th width="12.5%">Ngày sinh</th>
                            <th width="12.5%">Giới tính</th>
                            <th width="12.5%">Chức vụ</th>
                            <th width="12.5%">Phòng ban</th>
                            <th width="12.5%">SĐT</th>
                            <th width="12.5%">Email</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php $query = "SELECT * from nhanvien";
                            $data_nhanvien_bang = $sql->getdata($query);
                            while ($nhanVien = $data_nhanvien_bang->fetch_assoc()) {
                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"12.5%\" >" . $nhanVien['MaNhanVien'] . "</td> 
                                <td align=\"center\" width=\"12.5%\">" . $nhanVien['HoTen'] . "</td> 
                                <td align=\"center\" width=\"12.5%\">" . $nhanVien['NgaySinh'] . "</td> 
                                <td align=\"center\" width=\"12.5%\">" . $nhanVien['GioiTinh'] . "</td> 
                                <td align=\"center\" width=\"12.5%\">" . $nhanVien['ChucVu'] . "</td> 
                                <td align=\"center\" width=\"12.5%\">" . $nhanVien['PhongBan'] . "</td> 
                                <td align=\"center\" width=\"12.5%\">" . $nhanVien['SDT'] . "</td> 
                                <td align=\"center\" width=\"12.5%\">" . $nhanVien['Email'] . "</td>
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['TrinhDo'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['NgoaiNgu'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['CMND'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['DiaChi'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['TonGiao'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['DanToc'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['NgayVaoDoan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['NgayVaoDang'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['LoaiNhanVien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['TinhTrangHonNhan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['Cha'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['Me'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['VoChong'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['Con'] . "</td> 
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['BacLuong'] . "</td>
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['PhongCongTac'] . "</td>
                                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['CongViec'] . "</td>
                                </tr> ";
                            } ?> </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/main.js"></script>
    <script>
        // Chức năng thêm thông tin
        document.getElementById('add_hosonhanvien').onclick = async function() {

            var itemGT = document.querySelector('input[name="GioiTinh"]:checked')
            var HoTen = document.getElementById('HoTen');
            var TaiKhoan = document.getElementById('TaiKhoan');
            var NgaySinh = document.getElementById('NgaySinh');
            var GioiTinh = itemGT ? itemGT.value : '';
            var TrinhDo = document.getElementById('TrinhDo');
            var NgoaiNgu = document.getElementById('NgoaiNgu');
            var CMND = document.getElementById('CMND');
            var DiaChi = document.getElementById('DiaChi');
            var SDT = document.getElementById('SDT');
            var Email = document.getElementById('Email');
            var TonGiao = document.getElementById('TonGiao');
            var DanToc = document.getElementById('DanToc');
            var ChucVu = document.getElementById('ChucVu');
            var PhongBan = document.getElementById('PhongBan');
            var NgayVaoDoan = document.getElementById('NgayVaoDoan') ?? null;
            var NgayVaoDang = document.getElementById('NgayVaoDang') ?? null;
            var LoaiNhanVien = document.getElementById('LoaiNhanVien');
            var HonNhan = document.getElementById('HonNhan');
            var Cha = document.getElementById('Cha');
            var Me = document.getElementById('Me');
            var VoChong = document.getElementById('VoChong');
            var Con = document.getElementById('Con');
            var BacLuong = document.getElementById('BacLuong');
            var PhongCongTac = document.getElementById('PhongCongTac');
            var CongViec = document.getElementById('CongViec');

            if (
                HoTen.value == "" ||
                TaiKhoan.value == "" ||
                NgaySinh.value == "" ||
                GioiTinh == "" ||
                TrinhDo.value == "" ||
                NgoaiNgu.value == "" ||
                DiaChi.value == "" ||
                CMND.value == "" ||
                SDT.value == "" ||
                Email.value == "" ||
                TonGiao.value == "" ||
                DanToc.value == "" ||
                ChucVu.value == "" ||
                PhongBan.value == "" ||
                LoaiNhanVien.value == "" ||
                HonNhan.value == "" ||
                Cha.value == "" ||
                Me.value == "" ||
                VoChong.value == "" ||
                Con.value == "" ||
                BacLuong.value == "" ||
                PhongCongTac.value == "" ||
                CongViec.value == ""
            ) {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                let data = {
                    HoTen: HoTen.value,
                    TaiKhoan: TaiKhoan.value,
                    NgaySinh: NgaySinh.value,
                    GioiTinh: GioiTinh,
                    TrinhDo: TrinhDo.value,
                    NgoaiNgu: NgoaiNgu.value,
                    CMND: CMND.value,
                    DiaChi: DiaChi.value,
                    SDT: SDT.value,
                    Email: Email.value,
                    TonGiao: TonGiao.value,
                    DanToc: DanToc.value,
                    ChucVu: ChucVu.value,
                    PhongBan: PhongBan.value,
                    NgayVaoDoan: NgayVaoDoan.value,
                    NgayVaoDang: NgayVaoDang.value,
                    LoaiNhanVien: LoaiNhanVien.value,
                    HonNhan: HonNhan.value,
                    Cha: Cha.value,
                    Me: Me.value,
                    VoChong: VoChong.value,
                    Con: Con.value,
                    BacLuong: BacLuong.value,
                    PhongCongTac: PhongCongTac.value,
                    CongViec: CongViec.value
                };

                try {
                    let checkResponse = await fetch('./add_hosonhanvien.php', {
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
            var maNhanViens = [];
            get_ma(maNhanViens, update_box, 'sửa');

            let dataById = await fetch('./getDataById.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Table: "nhanvien",
                    IdBang: maNhanViens[0],
                    TenCotId: "MaNhanVien"
                })
            });

            let dataText = await dataById.text();
            let dataResult = JSON.parse(dataText);

            document.getElementById('HoTen_update').value = dataResult.data.HoTen;
            document.getElementById('NgaySinh_update').value = dataResult.data.NgaySinh;
            document.getElementById('TrinhDo_update').value = dataResult.data.TrinhDo;
            document.getElementById('NgoaiNgu_update').value = dataResult.data.NgoaiNgu;
            document.getElementById('CMND_update').value = dataResult.data.CMND;
            document.getElementById('DiaChi_update').value = dataResult.data.DiaChi;
            document.getElementById('SDT_update').value = dataResult.data.SDT;
            document.getElementById('Email_update').value = dataResult.data.Email;
            document.getElementById('TonGiao_update').value = dataResult.data.TonGiao;
            document.getElementById('DanToc_update').value = dataResult.data.DanToc;
            document.getElementById('ChucVu_update').value = dataResult.data.ChucVu;
            document.getElementById('PhongBan_update').value = dataResult.data.PhongBan;
            document.getElementById('NgayVaoDoan_update').value = dataResult.data.NgayVaoDoan ?? null;
            document.getElementById('NgayVaoDang_update').value = dataResult.data.NgayVaoDang ?? null;
            document.getElementById('LoaiNhanVien_update').value = dataResult.data.LoaiNhanVien;
            document.getElementById('HonNhan_update').value = dataResult.data.TinhTrangHonNhan;
            document.getElementById('Cha_update').value = dataResult.data.Cha;
            document.getElementById('Me_update').value = dataResult.data.Me;
            document.getElementById('VoChong_update').value = dataResult.data.VoChong;
            document.getElementById('Con_update').value = dataResult.data.Con;
            document.getElementById('PhongCongTac_update').value = dataResult.data.PhongCongTac;
            document.getElementById('CongViec_update').value = dataResult.data.CongViec;

            // Tai khoan
            let valueToSet = dataResult.data.TaiKhoan;
            let selectElements = document.querySelectorAll('#TaiKhoan_update'); // Lấy tất cả select có id="TaiKhoan"

            selectElements.forEach(select => {
                let optionExists = [...select.options].some(option => option.value === valueToSet);

                if (optionExists) {
                    select.value = valueToSet;
                }
            });

            // Bac luong
            let valueToSetBacLuong = dataResult.data.BacLuong;
            let selectElementBacLuongs = document.querySelectorAll('#BacLuong_update'); // Lấy tất cả select có id="BacLuong"

            selectElementBacLuongs.forEach(select => {
                let optionExistBacLuongs = [...select.options].some(option => option.value === valueToSetBacLuong);

                if (optionExistBacLuongs) {
                    select.value = valueToSetBacLuong;
                }
            });

            var gioiTinhValue = dataResult.data.GioiTinh;
            let radios = document.querySelectorAll('input[name="GioiTinh_update"]');
            radios.forEach(radio => {
                if (radio.value === gioiTinhValue) {
                    radio.checked = true;
                }
            });

            document.getElementById('update_hosonhanvien').onclick = async function() {
                var itemGT = document.querySelector('input[name="GioiTinh_update"]:checked')
                var HoTen = document.getElementById('HoTen_update');
                var TaiKhoan = document.getElementById('TaiKhoan_update');
                var NgaySinh = document.getElementById('NgaySinh_update');
                var GioiTinh = itemGT ? itemGT.value : '';
                var TrinhDo = document.getElementById('TrinhDo_update');
                var NgoaiNgu = document.getElementById('NgoaiNgu_update');
                var CMND = document.getElementById('CMND_update');
                var DiaChi = document.getElementById('DiaChi_update');
                var SDT = document.getElementById('SDT_update');
                var Email = document.getElementById('Email_update');
                var TonGiao = document.getElementById('TonGiao_update');
                var DanToc = document.getElementById('DanToc_update');
                var ChucVu = document.getElementById('ChucVu_update');
                var PhongBan = document.getElementById('PhongBan_update');
                var NgayVaoDoan = document.getElementById('NgayVaoDoan_update');
                var NgayVaoDang = document.getElementById('NgayVaoDang_update');
                var LoaiNhanVien = document.getElementById('LoaiNhanVien_update');
                var HonNhan = document.getElementById('HonNhan_update');
                var Cha = document.getElementById('Cha_update');
                var Me = document.getElementById('Me_update');
                var VoChong = document.getElementById('VoChong_update');
                var Con = document.getElementById('Con_update');
                var BacLuong = document.getElementById('BacLuong_update');
                var PhongCongTac = document.getElementById('PhongCongTac_update');
                var CongViec = document.getElementById('CongViec_update');

                if (maNhanViens.length == 0) {
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
                    HoTen.value == "" ||
                    TaiKhoan.value == "" ||
                    NgaySinh.value == "" ||
                    GioiTinh == "" ||
                    TrinhDo.value == "" ||
                    NgoaiNgu.value == "" ||
                    DiaChi.value == "" ||
                    CMND.value == "" ||
                    SDT.value == "" ||
                    Email.value == "" ||
                    TonGiao.value == "" ||
                    DanToc.value == "" ||
                    ChucVu.value == "" ||
                    PhongBan.value == "" ||
                    LoaiNhanVien.value == "" ||
                    HonNhan.value == "" ||
                    Cha.value == "" ||
                    Me.value == "" ||
                    VoChong.value == "" ||
                    Con.value == "" ||
                    BacLuong.value == "" ||
                    PhongCongTac.value == "" ||
                    CongViec.value == ""
                ) {
                    document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                    document.getElementById('thongbao_chucnang').style.display = 'block';
                } else {
                    let data = {
                        MaNhanVien: maNhanViens[0],
                        HoTen: HoTen.value,
                        TaiKhoan: TaiKhoan.value,
                        NgaySinh: NgaySinh.value,
                        GioiTinh: GioiTinh,
                        TrinhDo: TrinhDo.value,
                        NgoaiNgu: NgoaiNgu.value,
                        CMND: CMND.value,
                        DiaChi: DiaChi.value,
                        SDT: SDT.value,
                        Email: Email.value,
                        TonGiao: TonGiao.value,
                        DanToc: DanToc.value,
                        ChucVu: ChucVu.value,
                        PhongBan: PhongBan.value,
                        NgayVaoDoan: NgayVaoDoan.value,
                        NgayVaoDang: NgayVaoDang.value,
                        LoaiNhanVien: LoaiNhanVien.value,
                        HonNhan: HonNhan.value,
                        Cha: Cha.value,
                        Me: Me.value,
                        VoChong: VoChong.value,
                        Con: Con.value,
                        BacLuong: BacLuong.value,
                        PhongCongTac: PhongCongTac.value,
                        CongViec: CongViec.value
                    };

                    try {
                        let checkResponse = await fetch('./update_hoSoNhanVien.php', {
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
            var table = document.getElementById("table_class");
            var rows = table.querySelectorAll("tr");
            var tableData = [];

            // Lấy dữ liệu từ bảng HTML
            rows.forEach(row => {
                let rowData = [];
                let cells = row.querySelectorAll("th, td");
                cells.forEach(cell => {
                    rowData.push(cell.innerText.trim());
                });
                tableData.push(rowData);
            });

            // Danh sách các cột cần định dạng ngày
            let dateColumns = [2, 14, 15]; // Ngày Sinh, Ngày Vào Đoàn, Ngày Vào Đảng

            // Định dạng ngày thành yyyy-MM-dd HH:mm:ss nếu là số Excel
            tableData.forEach((row, rowIndex) => {
                // Bỏ qua dòng tiêu đề
                if (rowIndex === 0) return;

                row.forEach((value, colIndex) => {
                    if (dateColumns.includes(colIndex) && value) {
                        let excelDate = parseFloat(value);
                        if (!isNaN(excelDate)) {
                            let date = new Date((excelDate - 25569) * 86400000);
                            row[colIndex] = date.toISOString().slice(0, 19).replace("T", " ");
                        } else {
                            row[colIndex] = value.toString(); // Chuỗi nếu không phải ngày
                        }
                    } else if (value !== undefined && value !== null) {
                        row[colIndex] = value.toString();
                    }
                });
            });

            // Tạo Workbook và Sheet mới
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([
                ["Mã NV", "Họ Tên", "Ngày Sinh", "Giới Tính", "Chức Vụ", "Phòng Ban", "SDT", "Email", "Trình Độ",
                    "Ngoại Ngữ", "CMND", "Địa Chỉ", "Tôn Giáo", "Dân Tộc", "Ngày Vào Đoàn", "Ngày Vào Đảng",
                    "Loại Nhân Viên", "Tình Trạng Hôn Nhân", "Cha", "Mẹ", "Vợ Chồng", "Con", "Bậc Lương", "Phòng Công Tác", "Công Việc"
                ], // Tiêu đề
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

            if (this.value == '') {
                location.reload();
            }

            search('timKiem_hoSoNhanVien.php', sel_search.value, this.value);
        }

        document.getElementById('sel_search').onchange = function() {
            var sel_search = document.getElementById('sel_search');

            if (this.value === 'TangLuongTheoKy' || this.value === 'NhanSuNghiHuu') {
                search('timKiem_hoSoNhanVien.php', sel_search.value, this.value);
            }
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

        // Xem chi tiết hồ sơ nhân viên
        document.getElementById('detail_btn').onclick = async function() {
            var maNhanViens = [];
            get_ma(maNhanViens, '', 'chi tiết');
            console.log(maNhanViens);

            let dataById = await fetch('./getDataById.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Table: "nhanvien",
                    IdBang: maNhanViens[0],
                    TenCotId: "MaNhanVien"
                })
            });

            let dataText = await dataById.text();
            let dataResult = JSON.parse(dataText);

            document.getElementById('HoTen_detail').value = dataResult.data.HoTen;
            document.getElementById('NgaySinh_detail').value = dataResult.data.NgaySinh;
            document.getElementById('TrinhDo_detail').value = dataResult.data.TrinhDo;
            document.getElementById('NgoaiNgu_detail').value = dataResult.data.NgoaiNgu;
            document.getElementById('CMND_detail').value = dataResult.data.CMND;
            document.getElementById('DiaChi_detail').value = dataResult.data.DiaChi;
            document.getElementById('SDT_detail').value = dataResult.data.SDT;
            document.getElementById('Email_detail').value = dataResult.data.Email;
            document.getElementById('TonGiao_detail').value = dataResult.data.TonGiao;
            document.getElementById('DanToc_detail').value = dataResult.data.DanToc;
            document.getElementById('ChucVu_detail').value = dataResult.data.ChucVu;
            document.getElementById('PhongBan_detail').value = dataResult.data.PhongBan;
            document.getElementById('NgayVaoDoan_detail').value = dataResult.data.NgayVaoDoan ?? '';
            document.getElementById('NgayVaoDang_detail').value = dataResult.data.NgayVaoDang ?? '';
            document.getElementById('LoaiNhanVien_detail').value = dataResult.data.LoaiNhanVien;
            document.getElementById('HonNhan_detail').value = dataResult.data.TinhTrangHonNhan;
            document.getElementById('Cha_detail').value = dataResult.data.Cha;
            document.getElementById('Me_detail').value = dataResult.data.Me;
            document.getElementById('VoChong_detail').value = dataResult.data.VoChong;
            document.getElementById('Con_detail').value = dataResult.data.Con;
            document.getElementById('BacLuong_detail').value = dataResult.data.BacLuong;
            document.getElementById('PhongCongTac_detail').value = dataResult.data.PhongCongTac;
            document.getElementById('CongViec_detail').value = dataResult.data.CongViec;
            document.getElementById('TaiKhoan_detail').value = dataResult.data.TaiKhoan;
            document.getElementById('GioiTinh_detail').value = dataResult.data.GioiTinh;
            document.getElementById('MaNhanVien_detail').value = maNhanViens[0];

            const detail = document.getElementById("detail");
            detail.style.display = "block";
        }
    </script>
</body>

</html>