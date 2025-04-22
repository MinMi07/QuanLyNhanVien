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
    <title>Lương</title>
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
            <p>Quản lý</p>
        </div>
        <div class="menu_mid">
            <ul class="menu_main">
                <li class="li1"><a href="./admin.php" class="taga"><i class="fas fa-home i_normal"></i>
                        <p>Home</p>
                    </a></li>
                <li class="li1"><a href="./chamCong.php" class="taga"><i class="fa-solid fa-calendar-days i_normal"></i>
                        <p>Chấm công</p>
                    </a></li>
                <li class="li1 test"><a href="./luong.php" class="taga"><i class="fa-solid fa-sack-dollar i_normal i_to"></i>
                        <p class="to">Lương</p>
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
                    </div>
                    <div class="timkiem">
                        <select name="luachontimkiem" class="luachon" id="sel_search">
                            <option value="MaLuong">Mã lương</option>
                            <option value="MaNhanVien">Mã nhân viên</option>
                        </select> <input type="search" placeholder="Tìm kiếm" id="search">

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
                            <th width="4.34%">Mã lương</th>
                            <th width="4.34%">Mã nhân viên</th>
                            <th width="4.34%">Tên nhân viên</th>
                            <th width="4.34%">Thời gian</th>
                            <th width="4.34%">Số tiền</th>
                            <th width="4.34%">Thể loại</th>
                            <th width="4.34%">Mô tả</th>
                        </tr>
                    </table>
                    <div class="thongtinbang">
                        <table id="table_class" class="bangnd" border="1" cellspacing="0" width="100%">
                            <?php
                            $year = date("Y");
                            $month = date("n");
                            $day = "01";
                            $query = "SELECT * FROM luong WHERE DAY(ThoiGianTao) = $day and MONTH(ThoiGianTao) = $month and YEAR(ThoiGianTao) =  $year";

                            $data_luong = $sql->getdata($query);
                            while ($luong = $data_luong->fetch_assoc()) {
                                $maNhanVien = $luong['MaNhanVien'];
                                $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

                                echo " <tr class=\"class noidungbang\"> 
                                        <td align=\"center\" width=\"4.34%\">" . $luong['MaLuong'] . "</td> 
                                        <td align=\"center\" width=\"4.34%\">" . $luong['MaNhanVien'] . "</td> 
                                        <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
                                        <td align=\"center\" width=\"4.34%\">" . $luong['ThoiGianTao'] . "</td> 
                                        <td align=\"center\" width=\"4.34%\">" . $luong['SoTien'] . "</td> 
                                        <td align=\"center\" width=\"4.34%\">" . $luong['TheLoai'] . "</td> 
                                        <td align=\"center\" width=\"4.34%\">" . $luong['MoTa'] . "</td> 
                                    </tr>";
                            } ?> </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/main.js"></script>
    <script>
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
            let dateColumns = [3];

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
                ["Mã Lương", "Mã Nhân Viên", "Tên Nhân Viên", "Thời Gian", "Số Tiền", "Thể Loại", "Mô Tả"], // Tiêu đề
                ...tableData
            ]);

            // Thêm sheet vào workbook
            XLSX.utils.book_append_sheet(wb, ws, "Luong");

            // Xuất file Excel
            XLSX.writeFile(wb, "Luong.xlsx");
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
                    console.log({
                        Search: sel_search,
                        SearchValue: searchValue,
                        Thang: thang,
                        Nam: nam
                    });
                    let dataById = await fetch('./timKiem_luong.php', {
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