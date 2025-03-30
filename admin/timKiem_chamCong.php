<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {

    switch ($_GET['col']) {
        case 'Thang':
            $month = (int)$_GET['inf'];
            $year = date("Y");
            $query = "SELECT * from chamcong WHERE MONTH(ThoiGian) = $month AND YEAR(ThoiGian) = $year";
            break;

        default:
            $query = "SELECT * from chamcong where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";
    }

    $data_chamcong = $sql->getdata($query);
    $chamCongs = [];
    while ($row = $data_chamcong->fetch_assoc()) {
        $chamCongs[] = $row;
    }

    foreach ($chamCongs as $chamCong) {
        echo " <tr class=\"class noidungbang\"> 
            <td align=\"center\" width=\"4.34%\" >" . $chamCong['MaChamCong'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $chamCong['MaNhanVien'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGian'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . ($chamCong['TrangThai'] ? "Chấm công đúng giờ" : "Chấm công muộn") . "</td></tr> ";
    }
}
