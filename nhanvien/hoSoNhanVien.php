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
                <li class="li1"><a href="./nhanvien.php" class="taga"><i class="fas fa-home i_normal"></i>
                        <p>Home</p>
                    </a></li>
                <li class="li_dad">
                    <a href="#" class="taga">
                        <i class="fas fa-vote-yea i_normal i_to"></i>
                        <p class="to">Thông tin nhân sự</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./hoSoNhanVien.php" class="taga"><i class="fa-solid fa-folder-open i_normal i_to"></i>
                                <p class="to">Hồ sơ nhân viên</p>
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
                        <i class="fas fa-vote-yea i_normal"></i>
                        <p>Lương</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                                <p>Chấm công</p>
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
                <div class="content_content">
                    <div class="box_fun">
                        <form class="" action="" method="post">
                            <div class="box_content" style="width:100%">
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
        </div>
    </section>
    <script src="../admin/js/main.js"></script>
    <script>
        var maNhanVien = "<?php echo isset($_SESSION['maNhanVien']) ? $_SESSION['maNhanVien'] : ''; ?>";

        fetch('../admin/getDataById.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Table: "nhanvien",
                    IdBang: maNhanVien,
                    TenCotId: "MaNhanVien"
                })
            })
            .then(response => response.json()) // Chuyển phản hồi thành JSON
            .then(dataResult => {
                if (dataResult.data) { // Kiểm tra nếu dữ liệu tồn tại
                    document.getElementById('HoTen_detail').value = dataResult.data.HoTen || '';
                    document.getElementById('NgaySinh_detail').value = dataResult.data.NgaySinh || '';
                    document.getElementById('TrinhDo_detail').value = dataResult.data.TrinhDo || '';
                    document.getElementById('NgoaiNgu_detail').value = dataResult.data.NgoaiNgu || '';
                    document.getElementById('CMND_detail').value = dataResult.data.CMND || '';
                    document.getElementById('DiaChi_detail').value = dataResult.data.DiaChi || '';
                    document.getElementById('SDT_detail').value = dataResult.data.SDT || '';
                    document.getElementById('Email_detail').value = dataResult.data.Email || '';
                    document.getElementById('TonGiao_detail').value = dataResult.data.TonGiao || '';
                    document.getElementById('DanToc_detail').value = dataResult.data.DanToc || '';
                    document.getElementById('ChucVu_detail').value = dataResult.data.ChucVu || '';
                    document.getElementById('PhongBan_detail').value = dataResult.data.PhongBan || '';
                    document.getElementById('NgayVaoDoan_detail').value = dataResult.data.NgayVaoDoan || '';
                    document.getElementById('NgayVaoDang_detail').value = dataResult.data.NgayVaoDang || '';
                    document.getElementById('LoaiNhanVien_detail').value = dataResult.data.LoaiNhanVien || '';
                    document.getElementById('HonNhan_detail').value = dataResult.data.TinhTrangHonNhan || '';
                    document.getElementById('Cha_detail').value = dataResult.data.Cha || '';
                    document.getElementById('Me_detail').value = dataResult.data.Me || '';
                    document.getElementById('VoChong_detail').value = dataResult.data.VoChong || '';
                    document.getElementById('Con_detail').value = dataResult.data.Con || '';
                    document.getElementById('BacLuong_detail').value = dataResult.data.BacLuong || '';
                    document.getElementById('PhongCongTac_detail').value = dataResult.data.PhongCongTac || '';
                    document.getElementById('CongViec_detail').value = dataResult.data.CongViec || '';
                    document.getElementById('TaiKhoan_detail').value = dataResult.data.TaiKhoan || '';
                    document.getElementById('GioiTinh_detail').value = dataResult.data.GioiTinh || '';
                    document.getElementById('MaNhanVien_detail').value = maNhanVien;
                } else {
                    console.error("Dữ liệu không hợp lệ:", dataResult);
                }
            })
            .catch(error => console.error("Lỗi khi lấy dữ liệu:", error));
    </script>
</body>

</html>