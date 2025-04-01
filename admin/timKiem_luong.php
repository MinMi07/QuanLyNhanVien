<?php
session_start();
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {

    switch ($_GET['col']) {
        case 'Thang':
            $month = (int)$_GET['inf'];
            $year = date("Y");
            $query = "SELECT * from luong WHERE MONTH(ThoiGianTao) = $month AND YEAR(ThoiGianTao) = $year";
            break;

        default:
            $query = "SELECT * from luong where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";
    }

    $data_luong = $sql->getdata($query);
    $luongs = [];

    if ($data_luong->num_rows > 0) {
        while ($row = $data_luong->fetch_assoc()) {
            $luongs[] = $row;
        }
    }

    foreach ($luongs as $luong) {
        echo "<tr class=\"class noidungbang\"> 
                <td align=\"center\" width=\"4.34%\">" . $luong['MaLuong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['ThoiGianTao'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['SoTien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['TheLoai'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['MoTa'] . "</td> 
            </tr>";
    }
}
