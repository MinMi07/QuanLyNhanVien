<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from bacluong where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_bacluong = $sql->getdata($query);
    $bacLuongs = [];
    while ($row = $data_bacluong->fetch_assoc()) {
        $bacLuongs[] = $row;
    }

    foreach ($bacLuongs as $bacLuong) {
        echo " <tr class=\"class noidungbang\"> 
            <td align=\"center\" width=\"4.34%\" >" . $bacLuong['MaBacLuong'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $bacLuong['MaNhanVien'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $bacLuong['SoTien'] . "</td> 
            </tr> ";
    }
}
