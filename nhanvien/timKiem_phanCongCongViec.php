<?php
session_start();
require_once "./logIn/sql.php";
$sql = new SQL();

$maNhanVien = $_SESSION['maNhanVien'];
if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from phancongcongviec where MaNhanVien = $maNhanVien and " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_phancongcongviec = $sql->getdata($query);
    $congviecs = [];
    while ($row = $data_phancongcongviec->fetch_assoc()) {
        $congviecs[] = $row;
    }

    foreach ($congviecs as $phancongcongviec) {
        echo "  
        <tr class=\"class noidungbang\">
            <td align=\"center\" width=\"4.34%\" >" . $phancongcongviec['MaCongViec'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $phancongcongviec['MaNhanVien'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $phancongcongviec['TenCongViec'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $phancongcongviec['NgayBatDau'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $phancongcongviec['NgayKetThuc'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $phancongcongviec['TrangThai'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $phancongcongviec['TienDo'] . "</td> 
        </tr> ";
    }
}
