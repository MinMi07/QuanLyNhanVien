<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from phongban where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_phongban = $sql->getdata($query);
    $phongBans = [];
    while ($row = $data_phongban->fetch_assoc()) {
        $phongBans[] = $row;
    }

    foreach ($phongBans as $phongBan) {
        echo " <td align=\"center\" width=\"4.34%\" >" . $phongBan['MaPhongBan'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $phongBan['TenPhongBan'] . "</td></tr> ";
    }
}
