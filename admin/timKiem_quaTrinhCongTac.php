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
        echo " <td align=\"center\" width=\"4.34%\" >" . $quaTrinhCongTac['MaQuaTrinh'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['MaNhanVien'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['ThoiGian'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['Loai'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $quaTrinhCongTac['MoTaChiTiet'] . "</td>
                </tr> ";
    }
}
