<?php
session_start();
require_once "./logIn/sql.php";
$sql = new SQL();

$maNhanVien = $_SESSION['maNhanVien'];
if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from luong where MaNhanVien = $maNhanVien and " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    if($_GET['col'] == 'Thang') {

        $month = $_GET['inf'];
        $year = date("Y");

        $query = "SELECT * from luong where MaNhanVien = $maNhanVien and  MONTH(ThoiGianTao) = $month and YEAR(ThoiGianTao) = $year";
    }
    
    $data_luong = $sql->getdata($query);
    $luongs = [];

    while ($row = $data_luong->fetch_assoc()) {
        $luongs[] = $row;
    }

    foreach ($luongs as $luong) {
        echo " 
        <tr class=\"class noidungbang\"> 
            <td align=\"center\" width=\"4.34%\">" . $luong['MaLuong'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $luong['MaNhanVien'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $luong['ThoiGianTao'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $luong['SoTien'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $luong['TheLoai'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $luong['MoTa'] . "</td> 
        </tr>";
    }
}
