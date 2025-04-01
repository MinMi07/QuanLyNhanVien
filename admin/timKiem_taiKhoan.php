<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {
    $query = "SELECT * from taikhoan where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";

    $data_taikhoan = $sql->getdata($query);
    $taikhoans = [];
    while ($row = $data_taikhoan->fetch_assoc()) {
        $taikhoans[] = $row;
    }

    foreach ($taikhoans as $taikhoan) {
        echo "  <td align=\"center\" width=\"4.34%\">" . $taikhoan['TaiKhoan'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $taikhoan['MatKhau'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . $taikhoan['ThoiGian'] . "</td>
                <td align=\"center\" width=\"4.34%\">" . ($taikhoan['KichHoat'] ? 'Hoạt động' : 'Tạm khóa') . "</td>
                </tr> ";
    }
}
