<?php
session_start();
require_once "./logIn/sql.php";
$sql = new SQL();

$maNhanVien = $_SESSION['maNhanVien'];
if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from quatrinhcongtac  where MaNhanVien = $maNhanVien and " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_quaTrinhCongTac = $sql->getdata($query);
    $quaTrinhCongTacs = [];
    while ($row = $data_quaTrinhCongTac->fetch_assoc()) {
        $quaTrinhCongTacs[] = $row;
    }

    foreach ($quaTrinhCongTacs as $quaTrinhCongTac) {
        echo " 
        <tr class=\"class noidungbang\">
            <td align=\"center\" width=\"4.34%\" >" . $quaTrinhCongTac['MaQuaTrinh'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['MaNhanVien'] . "</td>
            <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['NoiCongTac'] . "</td>
            <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['ThoiGian'] . "</td>
            <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['MoTaChiTiet'] . "</td>
            <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['ThoiGianKetThuc'] . "</td>
        </tr> ";
    }
}
