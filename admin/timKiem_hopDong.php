<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from hopdong where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_hopdong = $sql->getdata($query);
    $hopDongs = [];
    while ($row = $data_hopdong->fetch_assoc()) {
        $hopDongs[] = $row;
    }

    foreach ($hopDongs as $hopDong) {
        echo "<tr class=\"class noidungbang\">
                <td align=\"center\" width=\"4.34%\" >" . $hopDong['MaHopDong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['LoaiHopDong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['NgayBatDau'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['NgayHetHan'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['BacLuong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['HeSoLuong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['PhuCap'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['BaoHiem'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['LuongThoaThuan'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $hopDong['TrangThai'] . "</td>
                </tr> ";
    }
}
