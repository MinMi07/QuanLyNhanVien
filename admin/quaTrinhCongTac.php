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
    <title>Quá trình công tác</title>
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
                        <div class="add_pass"> <label for="NoiCongTac">Nơi công tác<span>*</span></label> <input type="text" id="NoiCongTac"> </div>
                        <div class="add_pass"> <label for="ThoiGian">Thời gian<span>*</span></label> <input type="date" id="ThoiGian"> </div>
                        <div class="add_pass"> <label for="MoTaChiTiet">Mô tả chi tiết<span>*</span></label> <input type="text" id="MoTaChiTiet"> </div>
                        <div class="add_pass"> <label for="ThoiGianKetThuc">Thời gian kết thúc<span>*</span></label> <input type="date" id="ThoiGianKetThuc"> </div>
                    </div>
                    <div class="button"> <button type="button" id="add_quaTrinhCongTac">Thêm</button> </div>
                    <p>Lưu ý: thông tin có chứa dấu (*) bắt buộc phải điền</p>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden" id="update">
        <div class="bk_mo ">
            <div class="box_fun"> <span class="close"><i class="fas fa-times"></i></span>
                <h2>Sửa thông tin công việc</h2>
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
                        <div class="add_pass"> <label for="NoiCongTac">Nơi công tác<span>*</span></label> <input type="text" id="NoiCongTac_update"> </div>
                        <div class="add_pass"> <label for="ThoiGian">Thời gian<span>*</span></label> <input type="date" id="ThoiGian_update"> </div>
                        <div class="add_pass"> <label for="MoTaChiTiet">Mô tả chi tiết<span>*</span></label> <input type="text" id="MoTaChiTiet_update"> </div>
                        <div class="add_pass"> <label for="ThoiGianKetThuc">Thời gian kết thúc<span>*</span></label> <input type="date" id="ThoiGianKetThuc_update"> </div>
                    </div>
                    <div class="button"> <button type="button" id="update_quaTrinhCongTac">Sửa</button> </div>
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
                <li class="li1"><a href="./MoTaChiTiet.php" class="taga"><i class="fa-solid fa-money-bill-trend-up i_normal"></i>
                        <p>Bậc lương</p>
                    </a></li>
                <li class="li1"><a href="./hopDong.php" class="taga"><i class="fa-solid fa-file-contract i_normal"></i>
                        <p">Hợp đồng</p>
                    </a></li>
                <li class=" li1"><a href="./khenThuongKyLuat.php" class="taga"><i class="fa-solid fa-circle-exclamation i_normal"></i>
                        <p>Khen thưởng kỷ luật</p>
                    </a></li>
                <li class=" li1"><a href="./luong.php" class="taga"><i class="fa-solid fa-sack-dollar i_normal"></i>
                        <p>Lương</p>
                    </a></li>
                <li class="li1"><a href="./phanCongCongViec.php" class="taga"><i class="fa-solid fa-briefcase i_normal"></i>
                        <p>Phân công công việc</p>
                    </a></li>
                <li class=" li1"><a href="./phongBan.php" class="taga"><i class="fa-solid fa-hospital i_normal"></i>
                        <p>Phòng ban</p>
                    </a></li>
                <li class="li1 test"><a href="./quaTrinhCongTac.php" class="taga"><i class="fa-solid fa-timeline i_normal i_to"></i>
                        <p class="to">Quá trình công tác</p>
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
                            <option value="MaQuaTrinh">Mã quá trình</option>
                            <option value="MaNhanVien">Mã nhân viên</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search"> </div>
                </div>
                <div class="content_content">
                    <table class="tenbang" id="myTable" cellspacing="0" width="100%" style="margin-bottom: 5px; width: calc(100%-15px);">
                        <tr class="bangtieude">
                            <th width="4.34%">Mã quá trình</th>
                            <th width="4.34%">Mã nhân viên</th>
                            <th width="4.34%">Tên nhân viên</th>
                            <th width="4.34%">Nơi công tác</th>
                            <th width="4.34%">Thời gian</th>
                            <th width="4.34%">Mô tả chi tiết</th>
                            <th width="4.34%">Thời gian kết thúc</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php $query = "SELECT * from quatrinhcongtac";
                            $data_quatrinhcongtac = $sql->getdata($query);
                            while ($quatrinhcongtac = $data_quatrinhcongtac->fetch_assoc()) {
                                $maNhanVien = $quatrinhcongtac['MaNhanVien'];
                                $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];
                                
                                echo " <tr class=\"class noidungbang\"> 
                                <td align=\"center\" width=\"4.34%\">" . $quatrinhcongtac['MaQuaTrinh'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $quatrinhcongtac['MaNhanVien'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $quatrinhcongtac['NoiCongTac'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $quatrinhcongtac['ThoiGian'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $quatrinhcongtac['MoTaChiTiet'] . "</td> 
                                <td align=\"center\" width=\"4.34%\">" . $quatrinhcongtac['ThoiGianKetThuc'] . "</td> 
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
        document.getElementById('add_quaTrinhCongTac').onclick = async function() {
            var MaNhanVien = document.getElementById('MaNhanVien');
            var NoiCongTac = document.getElementById('NoiCongTac');
            var ThoiGian = document.getElementById('ThoiGian');
            var MoTaChiTiet = document.getElementById('MoTaChiTiet');
            var ThoiGianKetThuc = document.getElementById('ThoiGianKetThuc');

            if (
                MaNhanVien.value == '' ||
                NoiCongTac.value == '' ||
                ThoiGian.value == '' ||
                MoTaChiTiet.value == '' ||
                ThoiGianKetThuc.value == ''
            ) {
                document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                document.getElementById('thongbao_chucnang').style.display = 'block';
            } else {
                let data = {
                    MaNhanVien: MaNhanVien.value,
                    NoiCongTac: NoiCongTac.value,
                    ThoiGian: ThoiGian.value,
                    MoTaChiTiet: MoTaChiTiet.value,
                    ThoiGianKetThuc: ThoiGianKetThuc.value
                };

                console.log(data);

                try {
                    let checkResponse = await fetch('./add_quaTrinhCongTac.php', {
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
                            window.location.href = "quaTrinhCongTac.php";
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
            var maQuaTrinhCongTacs = [];
            get_ma(maQuaTrinhCongTacs, update_box, 'sửa');

            let dataById = await fetch('./getDataById.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Table: "quatrinhcongtac",
                    IdBang: maQuaTrinhCongTacs[0],
                    TenCotId: "MaQuaTrinh"
                })
            });

            let dataText = await dataById.text();
            let dataResult = JSON.parse(dataText);

            document.getElementById('MaNhanVien_update').value = dataResult.data.MaNhanVien;
            document.getElementById('NoiCongTac_update').value = dataResult.data.NoiCongTac;
            document.getElementById('ThoiGian_update').value = moment(dataResult.data.ThoiGian).format("YYYY-MM-DD");
            document.getElementById('MoTaChiTiet_update').value = dataResult.data.MoTaChiTiet;
            document.getElementById('ThoiGianKetThuc_update').value = moment(dataResult.data.ThoiGianKetThuc).format("YYYY-MM-DD");

            document.getElementById('update_quaTrinhCongTac').onclick = async function() {
                var MaNhanVien = document.getElementById('MaNhanVien_update');
                var NoiCongTac = document.getElementById('NoiCongTac_update');
                var ThoiGian = document.getElementById('ThoiGian_update');
                var MoTaChiTiet = document.getElementById('MoTaChiTiet_update');
                var ThoiGianKetThuc = document.getElementById('ThoiGianKetThuc_update');

                if (maQuaTrinhCongTacs.length == 0) {
                    Toastify({
                        text: "Không tìm thấy mã quá trình công tác",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #FF7043, #E64A19)"
                    }).showToast();
                    return;
                }

                if (
                    MaNhanVien.value == '' ||
                    NoiCongTac.value == '' ||
                    ThoiGian.value == '' ||
                    MoTaChiTiet.value == '' ||
                    ThoiGianKetThuc.value == ''
                ) {
                    document.getElementById('thongbao_chucnang_1').innerHTML = ` 
                    <h2 style="color: rgb(1, 82, 233);">Thông báo</h2> 
                    <p style="font-size: 15px; margin-top: 20px;">Bạn chưa nhập đầy đủ thông tin</p> 
                `;
                    document.getElementById('thongbao_chucnang').style.display = 'block';
                } else {
                    let data = {
                        MaQuaTrinh: maQuaTrinhCongTacs[0],
                        MaNhanVien: MaNhanVien.value,
                        NoiCongTac: NoiCongTac.value,
                        ThoiGian: ThoiGian.value,
                        MoTaChiTiet: MoTaChiTiet.value,
                        ThoiGianKetThuc: ThoiGianKetThuc.value
                    };

                    try {
                        let checkResponse = await fetch('./update_quaTrinhCongTac.php', {
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
                                window.location.href = "quaTrinhCongTac.php";
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
            let dateColumns = [3,6]; // Vị trí cột của Thời gian

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
                ["Mã Quá Trình", "Mã Nhân Viên", "Tên Nhân Viên", "Thời gian", "Nơi công tác", "Mô tả chi tiết", "Thời gian kết thúc"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "QuaTrinhCongTac");

            // Xuất file Excel
            XLSX.writeFile(wb, "QuaTrinhCongTac.xlsx");
        });


        // Chức năng tìm kiếm
        document.getElementById('search').oninput = function() {
            var sel_search = document.getElementById('sel_search');

            if (this.value == '') {
                location.reload();
            }

            search('timKiem_quaTrinhCongTac.php', sel_search.value, this.value);
        }
    </script>
</body>

</html>