<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from khenthuongkyluat where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_khenthuongkyluat = $sql->getdata($query);
    $hopDongs = [];
    while ($row = $data_khenthuongkyluat->fetch_assoc()) {
        $hopDongs[] = $row;
    }

    foreach ($hopDongs as $hopDong) {
        $maNhanVien = $hopDong['MaNhanVien'];
        $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

        echo " 
        <tr class=\"class noidungbang\">
        <td align=\"center\" width=\"4.34%\" >" . $hopDong['MaKhenThuongKyLuat'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['ThoiGianKhenThuongKyLuat'] ."</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['Loai'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['NoiDung'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['SoQuyetDinh'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['CoQuanQuyetDinh'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['HinhThuc'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['SoTien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['TrangThai'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['GhiChu'] . "</td> </tr> ";
    }
}
