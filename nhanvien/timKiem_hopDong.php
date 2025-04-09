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
        echo "
            <tr class=\"class noidungbang\">
                <td align=\"center\" width=\"10%\" >" . $hopDong['MaHopDong'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['LoaiHopDong'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['NgayBatDau'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['NgayHetHan'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['BacLuong'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['HeSoLuong'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['PhuCap'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['BaoHiem'] . "</td> 
                <td align=\"center\" width=\"10%\">" . $hopDong['LuongThoaThuan'] . "</td> 
            </tr> ";
    }
}