<?php
session_start();
require_once "./logIn/sql.php";
$sql = new SQL();

$maNhanVien = $_SESSION['maNhanVien'];
if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from khenthuongkyluat where MaNhanVien = $maNhanVien and " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_khenthuongkyluat = $sql->getdata($query);
    $hopDongs = [];
    while ($row = $data_khenthuongkyluat->fetch_assoc()) {
        $hopDongs[] = $row;
    }

    foreach ($hopDongs as $hopDong) {
        echo " 
        <tr class=\"class noidungbang\">
        <td align=\"center\" width=\"4.34%\" >" . $hopDong['MaKhenThuongKyLuat'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['ThoiGianKhenThuongKyLuat'] . "</td> 
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
