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
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://kit.fontawesome.com;">
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
    <div class="hidden" id="add">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Thêm hồ sơ nhân viên</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_ma" style="width: 100%"> <label for="HoTen">Họ tên </label> <input type="text" name="malopadd" id="NamHoc"> </div>
                        <div class="add_pass"> <label for="NgaySinh">Ngày sinh<span>*</span></label> <input type="date" name="tenlopadd" id="BDHK1"> </div>
                        <div class="add_pass"> <label for="GioiTinh">Giới tính <span>*</span></label> <input type="radio" id="nam" name="GioiTinh" value="Nam"> <label for="nam">Nam</label><br> <input type="radio" id="nu" name="GioiTinh" value="Nữ"> <label for="nu">Nữ</label><br> </div>
                        <div class="add_pass"> <label for="TrinhDo">Trình độ <span>*</span></label> <input type="text" name="tenlopadd" id="BDHK2"> </div>
                        <div class="add_pass"> <label for="CMND">CMND <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="SDT">SĐT <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Email">Email <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="TonGiao">Tôn giáo <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="DanToc">Dân tộc <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="ChucVu">Chức vụ <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="PhongBan">Phòng ban <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="NgayVaoDoan">Ngày vào đoàn <span>*</span></label> <input type="date" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="NgayVaoDang">Ngày vào đảng<span>*</span></label> <input type="date" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="LoaiNhanVien">Loại nhân viên <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="HonNhan">Hôn nhân <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Cha">Cha <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Me">Mẹ <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="VoChong">Vợ chồng <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Con">Con <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="BacLuong">Bậc lương <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                    </div>
                    <div class="button"> <button type="button" id="add_namhoc">Thêm</button> </div>
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
                        <div class="add_ma" style="width: 100%"> <label for="HoTen">Họ tên </label> <input type="text" name="malopadd" id="NamHoc"> </div>
                        <div class="add_pass"> <label for="NgaySinh">Ngày sinh <span>*</span></label> <input type="date" name="tenlopadd" id="BDHK1"> </div>
                        <div class="add_pass"> <label for="GioiTinh">Giới tính <span>*</span></label> <input type="radio" id="nam" name="GioiTinh" value="Nam"> <label for="nam">Nam</label><br> <input type="radio" id="nu" name="GioiTinh" value="Nữ"> <label for="nu">Nữ</label><br> </div>
                        <div class="add_pass"> <label for="TrinhDo">Trình độ <span>*</span></label> <input type="text" name="tenlopadd" id="BDHK2"> </div>
                        <div class="add_pass"> <label for="CMND">CMND <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="SDT">SĐT <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Email">Email <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="TonGiao">Tôn giáo <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="DanToc">Dân tộc <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="ChucVu">Chức vụ <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="PhongBan">Phòng ban <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="NgayVaoDoan">Ngày vào đoàn <span>*</span></label> <input type="date" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="NgayVaoDang">Ngày vào đảng<span>*</span></label> <input type="date" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="LoaiNhanVien">Loại nhân viên <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="HonNhan">Hôn nhân <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Cha">Cha <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Me">Mẹ <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="VoChong">Vß╗ú/Cß╗ông <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="Con">Con <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                        <div class="add_pass"> <label for="BacLuong">Bậc lương <span>*</span></label> <input type="text" name="tenlopadd" id="KTHK2"> </div>
                    </div>
                    <div class="button"> <button type="button" id="update_namhoc">Sửa</button> </div>
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
                <li class="li1 "><a href="admin/admin.php" class="taga"><i class="fas fa-home i_normal "></i>
                        <p>Home</p>
                    </a></li>
                <li class="li1"><a href="../detectionFace/detectionFace.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                        <p>Chấm công khuân mặt</p>
                    </a></li>
                <li class="li1 test"><a href="./hoSoNhanVien.php" class="taga"><i class="fas fa-vote-yea i_normal i_to"></i>
                        <p class="to">Hồ sơ nhân viên</p>
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
                    <div class="chucnangchinh"> <input type="button" value="Thêm" id="add_btn"> <input type="button" value="Sửa" id="update_btn"> </div>
                    <div class="timkiem"> <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="HoTen">Họ tên</option>
                            <option value="Tuoi">Tuổi</option>
                            <option value="BacLuong">Bậc lương</option>
                            <option value="TrinhDo">Trình độ</option>
                            <option value="DangVien">Đảng viên</option>
                            <option value="PhongBan">Phòng ban</option>
                            <option value="CongViec">Công việc</option>
                            <option value="DienChinhSach">Diện chính sách</option>
                            <option value="GioiTinh">Giới tính</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search"> </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
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
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%"> <?php $query = "SELECT * from nhanvien";
                                                                                                        $data_nhanvien_bang = $sql->getdata($query);
                                                                                                        $nhanViens = [];
                                                                                                        while ($nhanVien = $data_nhanvien_bang->fetch_assoc()) {
                                                                                                            echo " <tr class=\"class noidungbang\"> <td align=\"center\" width=\"4.34%\" >" . $nhanVien['MaNhanVien'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['HoTen'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgaySinh'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['GioiTinh'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['TrinhDo'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgoaiNgu'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['CMND'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['DiaChi'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['SDT'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['Email'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['TonGiao'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['DanToc'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['ChucVu'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['PhongBan'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgayVaoDoan'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgayVaoDang'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['LoaiNhanVien'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['TinhTrangHonNhan'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['Cha'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['Me'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['VoChong'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['Con'] . "</td> <td align=\"center\" width=\"4.34%\">" . $nhanVien['BacLuong'] . "</td></tr> ";
                                                                                                        } ?> </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./Js/main.js"></script>
    <script>
        document.getElementById('add_namhoc').onclick = function() {
            var BD1 = document.getElementById('BDHK1');
            var KT1 = document.getElementById('KTHK1');
            var BD2 = document.getElementById('BDHK2');
            var KT2 = document.getElementById('KTHK2');
            var namhoc = document.getElementById('NamHoc');
            if (BD1.value == "" || KT1.value == "" || BD2.value == "" || KT2.value == "") {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` <h2 style=\"color: rgb(1, 82, 233);\">Thông báo</h2> <p style=\"font-size: 15px; margin-top: 20px;\">Bß║ín chã░a nhß║¡p th├┤ng tin</p> `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                var get = "NamHoc=" + namhoc.value + "&BD1=" + BD1.value + "&KT1=" + KT1.value + "&BD2=" + BD2.value + "&KT2=" + KT2.value;
                document.getElementById('add').style.display = 'none';
                add('add_namhoc.php', get);
                setTimeout(function() {
                    search('timkiem_namhoc.php', 'NamHoc', '');
                }, 300);
            }
        }
        document.getElementById('update_btn').onclick = function() {
            var lophoc = [];
            get_ma(lophoc, update_box, 'sß╗¡a');
            document.getElementById('update_namhoc').onclick = function() {
                var BD1 = document.getElementById('BDHK1_update');
                var KT1 = document.getElementById('KTHK1_update');
                var BD2 = document.getElementById('BDHK2_update');
                var KT2 = document.getElementById('KTHK2_update');
                if (BD1.value == "" && KT1.value == "" && BD2.value == "" && KT2.value == "") {
                    document.getElementById('thongbao_chucnang_1').innerHTML = ` <h2 style=\"color: rgb(1, 82, 233);\">Thông báo</h2> <p style=\"font-size: 15px; margin-top: 20px;\">Bß║ín chã░a nhß║¡p th├┤ng tin</p> `;
                    document.getElementById('thongbao_chucnang').style.display = 'block';
                } else {
                    var get = "NamHoc=" + lophoc[0] + "&BD1=" + BD1.value + "&KT1=" + KT1.value + "&BD2=" + BD2.value + "&KT2=" + KT2.value;
                    document.getElementById('update').style.display = 'none';
                    update('update_namhoc.php', get);
                    setTimeout(function() {
                        search('timkiem_namhoc.php', 'NamHoc', '');
                    }, 300);
                }
            }
        }
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');
            search('timKiem_hoSoNhanVien.php', sel_search.value, this.value);
        }
    </script>
</body>

</html>