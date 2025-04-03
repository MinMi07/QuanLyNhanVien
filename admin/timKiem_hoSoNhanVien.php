<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {

    switch ($_GET['col']) {
        case 'Tuoi':
            $age = (int)$_GET['inf'];
            $currentYear = date("Y");
            $birthYear = $currentYear - $age;

            $query = "SELECT * FROM nhanvien WHERE YEAR(NgaySinh) = $birthYear";
            break;
        case 'DangVien':
            if ($_GET['inf'] == 'có') {
                $query = "SELECT * FROM nhanvien WHERE NgayVaoDang IS NOT NULL";
            } else {
                $query = "SELECT * FROM nhanvien WHERE NgayVaoDang IS NULL";
            }
            break;
        case 'ThangSinhNhat':
            $month = (int)$_GET['inf'];
            $query = "SELECT * FROM nhanvien WHERE MONTH(NgaySinh) = $month";
            break;
        default:
            $query = "SELECT * from nhanvien where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";
    }

    $data_nhanvien_bang = $sql->getdata($query);
    $nhanViens = [];
    while ($row = $data_nhanvien_bang->fetch_assoc()) {
        $nhanViens[] = $row;
    }
    foreach ($nhanViens as $nhanVien) {
        echo " <tr class=\"class noidungbang\"> 
                <td align=\"center\" width=\"12.5%\" >" . $nhanVien['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"12.5%\">" . $nhanVien['HoTen'] . "</td> 
                <td align=\"center\" width=\"12.5%\">" . $nhanVien['NgaySinh'] . "</td> 
                <td align=\"center\" width=\"12.5%\">" . $nhanVien['GioiTinh'] . "</td> 
                <td align=\"center\" width=\"12.5%\">" . $nhanVien['ChucVu'] . "</td> 
                <td align=\"center\" width=\"12.5%\">" . $nhanVien['PhongBan'] . "</td> 
                <td align=\"center\" width=\"12.5%\">" . $nhanVien['SDT'] . "</td> 
                <td align=\"center\" width=\"12.5%\">" . $nhanVien['Email'] . "</td>
            </tr> ";
    }
}
