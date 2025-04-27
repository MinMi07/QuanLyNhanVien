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
    <title>Bậc lương</title>
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
                <h2>Thêm bậc lương</h2>
                <form class="" action="" method="post">
                    <div class="box_content">
                        <div class="add_pass onceColumn"> <label for="MaBacLuong">Bậc lương<span>*</span></label> <input type="text" id="MaBacLuong"> </div>
                        <div class="add_pass onceColumn"> <label for="SoTien">Số tiền<span>*</span></label> <input type="text" id="SoTien"> </div>
                    </div>
                    <div class="button"> <button type="button" id="add_bacLuong">Thêm</button> </div>
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
                        <div class="add_pass onceColumn"> <label for="SoTien">Số tiền<span>*</span></label> <input type="text" id="SoTien_update"> </div>
                    </div>
                    <div class="button"> <button type="button" id="update_bacLuong">Sửa</button> </div>
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
                    <a href="#" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
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
                    <a href="#" class="taga"><i class="fa-solid fa-list-check i_normal i_to"></i>
                        <p class='to'>Khác</p>
                    </a>
                    <ul class="submenu">
                        <li class="li1"><a href="./phongBan.php" class="taga"><i class="fa-solid fa-hospital i_normal"></i>
                                <p>Phòng ban</p>
                            </a></li>
                        <li class="li1"><a href="./bacLuong.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal i_to"></i>
                                <p class='to'>Bậc lương</p>
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
                        <input type="button" value="Xóa" id="delete_btn">
                        <input type="button" value="Xuất Excel" id="excel_btn">
                    </div>
                    <div class="timkiem">
                        <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="MaBacLuong">Bậc lương</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search">
                    </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="50%">Bậc lương</th>
                            <th width="50%">Số tiền</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php $query = "SELECT * from bacluong";
                            $data_bacluong = $sql->getdata($query);
                            while ($bacluong = $data_bacluong->fetch_assoc()) {
                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"50%\" >" . $bacluong['MaBacLuong'] . "</td> 
                                <td align=\"center\" width=\"50%\">" . $bacluong['SoTien'] . "</td>
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
        document.getElementById('add_bacLuong').onclick = async function() {
            var MaBacLuong = document.getElementById('MaBacLuong');
            var SoTien = document.getElementById('SoTien');

            if (
                SoTien.value == "" || MaBacLuong.value == ""
            ) {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                let data = {
                    MaBacLuong: MaBacLuong.value,
                    SoTien: SoTien.value
                };

                try {
                    let checkResponse = await fetch('./add_bacLuong.php', {
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
                            window.location.href = "bacLuong.php";
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
            var maBacLuongs = [];
            get_ma(maBacLuongs, update_box, 'sửa');

            let dataById = await fetch('./getDataById.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Table: "bacluong",
                    IdBang: maBacLuongs[0],
                    TenCotId: "MaBacLuong"
                })
            });

            let dataText = await dataById.text();
            let dataResult = JSON.parse(dataText);

            document.getElementById('SoTien_update').value = dataResult.data.SoTien;
            document.getElementById('update_bacLuong').onclick = async function() {
                var MaNhanVien = document.getElementById('MaNhanVien_update');
                var SoTien = document.getElementById('SoTien_update');

                if (maBacLuongs.length == 0) {
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
                    SoTien.value == ""
                ) {
                    document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                    document.getElementById('thongbao_chucnang').style.display = 'block';
                } else {
                    let data = {
                        MaBacLuong: maBacLuongs[0],
                        SoTien: SoTien.value
                    };

                    try {
                        let checkResponse = await fetch('./update_bacLuong.php', {
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
                                window.location.href = "bacLuong.php";
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
            let dateColumns = [];

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
                ["Mã Bậc Lương", "Số Tiền"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "BacLuong");

            // Xuất file Excel
            XLSX.writeFile(wb, "BacLuong.xlsx");
        });


        // Chức năng tìm kiếm
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');
            search('timKiem_bacLuong.php', sel_search.value, this.value);
        }

        // Xóa
        document.getElementById('delete_btn').onclick = async function() {
            var BacLuongs = [];
            get_ma(BacLuongs, '', 'xóa');

            if (BacLuongs.length > 0) {
                var a = '';
                for (var i = 0; i < BacLuongs.length; i++) {
                    a += `
                        <p style="text-align: left ;font-size: 17px; font-weight: 500; color: #5C7AEA">Xác nhận xóa bậc lương có mã là <span style="color: #FFB319; font-weight: 600; border-bottom: 1px solid #FFB319">${BacLuongs[i]}</span></p>
                    `;
                }

                document.getElementById('delete_infor').innerHTML = a;
                document.getElementById('delete').style.display = 'block';
                document.getElementById('delete_confirm').onclick = async function() {
                    let data = {
                        MaBacLuong: BacLuongs[0]
                    };

                    try {
                        let checkResponse = await fetch('./delete_bacLuong.php', {
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
                                window.location.href = "bacLuong.php";
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
    </script>
</body>

</html>