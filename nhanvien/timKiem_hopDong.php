<?php
session_start();
require_once "./logIn/sql.php";
$sql = new SQL();

$maNhanVien = $_SESSION['maNhanVien'];
if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from hopdong where MaNhanVien = $maNhanVien and " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_hopdong = $sql->getdata($query);
    $hopDongs = [];
    while ($row = $data_hopdong->fetch_assoc()) {
        $hopDongs[] = $row;
    }

    foreach ($hopDongs as $hopDong) {
        $maNhanVien = $hopDong['MaNhanVien'];
        $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

        echo "
            <tr class=\"class noidungbang\">
                <td align=\"center\" width=\"4.34%\" >" . $hopDong['MaHopDong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['LoaiHopDong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['NgayBatDau'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['NgayHetHan'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['BacLuong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['HeSoLuong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['PhuCap'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['BaoHiem'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['LuongThoaThuan'] . "</td> 
            </tr> ";
    }
}