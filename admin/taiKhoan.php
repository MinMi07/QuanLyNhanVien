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
    <title>Tài khoản</title>
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
                <h2>Thêm tài khoản</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_pass onceColumn"> <label for="TaiKhoan">Tài khoản<span>*</span></label> <input type="text" id="TaiKhoan"> </div>
                        <div class="add_pass onceColumn"> <label for="MatKhau">Mật khẩu<span>*</span></label> <input type="text" id="MatKhau"> </div>
                    </div>
                    <div class="button"> <button type="button" id="add_taiKhoan">Thêm</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền</p>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden" id="update">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Sửa thông tin tài khoản</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_pass onceColumn"> <label for="MatKhau">Mật khẩu<span>*</span></label> <input type="text" id="MatKhau_update"> </div>
                        <div class="add_pass onceColumn"> <label for="KichHoat">Kích hoạt<span>*</span></label> <input type="text" id="KichHoat_update"> </div>
                    </div>
                    <div class="button"> <button type="button" id="update_taiKhoan">Sửa</button> </div>
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
                <li class="li1 "><a href="../admin/admin.php" class="taga"><i class="fas fa-home i_normal "></i>
                        <p>Home</p>
                    </a></li>
                <li class="li1"><a href="../detectionFace/detectionFace.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                        <p>Chấm công khuân mặt</p>
                    </a></li>
                <li class="li1 test"><a href="./taiKhoan.php" class="taga"><i class="fa-solid fa-circle-user i_normal i_to"></i>
                        <p class="to">Tài khoản</p>
                    </a></li>
                <li class="li1"><a href="./cauHinhThongSo.php" class="taga"><i class="fa-solid fa-gear i_normal"></i>
                        <p>Cấu hình thông số</p>
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
                    </div>
                    <div class="timkiem"> <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="TaiKhoan">Tài khoản</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search"> </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="4.34%">Tài khoản</th>
                            <th width="4.34%">Mật khẩu</th>
                            <th width="4.34%">Thời gian</th>
                            <th width="4.34%">Kích hoạt</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php $query = "SELECT * from taikhoan";
                            $data_taikhoan = $sql->getdata($query) ?? [];
                            while ($taikhoan = $data_taikhoan->fetch_assoc()) {
                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"4.34%\">" . $taikhoan['TaiKhoan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $taikhoan['MatKhau'] . "</td>
                                <td align=\"center\" width=\"4.34%\">" . $taikhoan['ThoiGian'] . "</td>
                                <td align=\"center\" width=\"4.34%\">" . ($taikhoan['KichHoat'] ? 'Hoạt động' : 'Tạm khóa') . "</td>
                                </tr> ";
                            } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/main.js"></script>
    <script>
        // Chức năng thêm thông tin
        document.getElementById('add_taiKhoan').onclick = async function() {
            var TaiKhoan = document.getElementById('TaiKhoan');
            var MatKhau = document.getElementById('MatKhau');

            if (
                TaiKhoan.value == "" ||
                MatKhau.value == ""
            ) {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                let data = {
                    TaiKhoan: TaiKhoan.value,
                    MatKhau: MatKhau.value,
                };

                try {
                    let checkResponse = await fetch('./add_taiKhoan.php', {
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
                            window.location.href = "taiKhoan.php";
                        }, 1000);
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

        // Cập nhật bậc lương
        document.getElementById('update_btn').onclick = async function() {
            var taiKhoans = [];
            get_ma(taiKhoans, update_box, 'sửa');

            document.getElementById('update_taiKhoan').onclick = async function() {
                var MatKhau = document.getElementById('MatKhau_update');
                var KichHoat = document.getElementById('KichHoat_update');

                if (taiKhoans.length == 0) {
                    Toastify({
                        text: "Không tìm thấy mã phòng ban",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #FF7043, #E64A19)"
                    }).showToast();
                    return;
                }

                if (
                    MatKhau.value == "" ||
                    KichHoat.value == ""
                ) {
                    document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                    document.getElementById('thongbao_chucnang').style.display = 'block';
                } else {
                    let data = {
                        TaiKhoan: taiKhoans[0],
                        MatKhau: MatKhau.value,
                        KichHoat: KichHoat.value
                    };

                    try {
                        let checkResponse = await fetch('./update_taiKhoan.php', {
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
                                window.location.href = "taiKhoan.php";
                            }, 1000);
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

        // Chức năng tìm kiếm
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');
            search('timKiem_taiKhoan.php', sel_search.value, this.value);
        }
    </script>
</body>

</html>