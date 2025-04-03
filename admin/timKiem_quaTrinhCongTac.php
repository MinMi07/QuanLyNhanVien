<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from quatrinhcongtac where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_quaTrinhCongTac = $sql->getdata($query);
    $quaTrinhCongTacs = [];
    while ($row = $data_quaTrinhCongTac->fetch_assoc()) {
        $quaTrinhCongTacs[] = $row;
    }

    foreach ($quaTrinhCongTacs as $quaTrinhCongTac) {
        $maNhanVien = $quaTrinhCongTac['MaNhanVien'];
        $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

        echo " 
        <tr class=\"class noidungbang\">
        <td align=\"center\" width=\"4.34%\" >" . $quaTrinhCongTac['MaQuaTrinh'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['MaNhanVien'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td>
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['ThoiGian'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['NoiCongTac'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['MoTaChiTiet'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['ThoiGianKetThuc'] . "</td>
                </tr> ";
    }
}
