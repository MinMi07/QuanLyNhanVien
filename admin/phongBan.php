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
    <title>Phòng ban</title>
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
                <h2>Thêm phòng ban</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_pass onceColumn"> <label for="TenPhongBan">Phòng ban<span>*</span></label> <input type="text" id="TenPhongBan"> </div>
                    </div>
                    <div class="button"> <button type="button" id="add_phongBan">Thêm</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền</p>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden" id="update">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Sửa thông tin bậc lương</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_pass onceColumn"> <label for="TenPhongBan">Phòng ban<span>*</span></label> <input type="text" id="TenPhongBan_update"> </div>
                    </div>
                    <div class="button"> <button type="button" id="update_phongBan">Sửa</button> </div>
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
                <li class="li1"><a href="../detectionFace/detectionFace.php" class="taga"><i class="fas fa-vote-yea i_normal"></i>
                        <p>Chấm công khuân mặt</p>
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
                <li class="li1 test"><a href="./phongBan.php" class="taga"><i class="fa-solid fa-hospital i_normal i_to"></i>
                        <p class="to">Phòng ban</p>
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
                            <option value="MaPhongBan">Mã phòng ban</option>
                            <option value="TenPhongBan">Tên phòng ban</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search"> </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="4.34%">Mã phòng ban</th>
                            <th width="4.34%">Tên phòng ban</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php $query = "SELECT * from phongban";
                            $data_phongban = $sql->getdata($query) ?? [];
                            while ($phongban = $data_phongban->fetch_assoc()) {
                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"4.34%\">" . $phongban['MaPhongBan'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $phongban['TenPhongBan'] . "</td>
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
        document.getElementById('add_phongBan').onclick = async function() {
            var TenPhongBan = document.getElementById('TenPhongBan');

            if (
                TenPhongBan.value == ""
            ) {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                let data = {
                    TenPhongBan: TenPhongBan.value
                };

                try {
                    let checkResponse = await fetch('./add_phongBan.php', {
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
                            window.location.href = "phongBan.php";
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
            var maPhongBans = [];
            get_ma(maPhongBans, update_box, 'sửa');

            document.getElementById('update_phongBan').onclick = async function() {
                var TenPhongBan = document.getElementById('TenPhongBan_update');

                if (maPhongBans.length == 0) {
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
                    TenPhongBan.value == ""
                ) {
                    document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                    document.getElementById('thongbao_chucnang').style.display = 'block';
                } else {
                    let data = {
                        MaPhongBan: maPhongBans[0],
                        TenPhongBan: TenPhongBan.value
                    };

                    try {
                        let checkResponse = await fetch('./update_phongBan.php', {
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
                                window.location.href = "phongBan.php";
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

        // Chức năng xuất excel
        document.getElementById("excel_btn").addEventListener("click", function() {
            // Lấy bảng
            var table = document.getElementById("table_class");
            var tableData = XLSX.utils.sheet_to_json(XLSX.utils.table_to_sheet(table), {
                header: 1
            });


            // Tạo Workbook và Sheet mới
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([
                ["Mã Phòng Ban", "Tên Phòng Ban"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "PhongBan");

            // Xuất file Excel
            XLSX.writeFile(wb, "PhongBan.xlsx");
        });


        // Chức năng tìm kiếm
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');
            search('timKiem_phongBan.php', sel_search.value, this.value);
        }
    </script>
</body>

</html>