<?php
require_once "./logIn/sql.php";
$sql = new SQL();

if (isset($_GET['col']) && isset($_GET['inf']) && $_GET['inf'] != '') {

    switch ($_GET['col']) {
        case 'NhanSuNghiHuu':
            $query = "SELECT * FROM nhanvien 
            WHERE (GioiTinh LIKE 'Nam' AND DATE_ADD(NgaySinh, INTERVAL 61 YEAR) <= DATE_SUB(CURDATE(), INTERVAL 3 MONTH))
                OR 
                (GioiTinh LIKE 'Nữ' AND DATE_ADD(NgaySinh, INTERVAL 56 YEAR) <= DATE_SUB(CURDATE(), INTERVAL 8 MONTH))";
                
            break;
        case 'SinhNhatThang':
            $month = (int)$_GET['inf'];
            $query = "SELECT * FROM nhanvien WHERE MONTH(NgaySinh) = $month";
            break;
        case 'TangLuongTheoKy':
            $threeYearsAgo = date("Y-m-d", strtotime("-3 years"));
            // Truy vấn danh sách nhân viên có ngày tham gia công ty đúng 3 năm trước
            $query = "SELECT * FROM nhanvien WHERE NgayThamGia = '$threeYearsAgo'";
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
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['TrinhDo'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['NgoaiNgu'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['CMND'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['DiaChi'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['TonGiao'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['DanToc'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['NgayVaoDoan'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['NgayVaoDang'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['LoaiNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['TinhTrangHonNhan'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['Cha'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['Me'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['VoChong'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['Con'] . "</td> 
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['BacLuong'] . "</td>
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['PhongCongTac'] . "</td>
                <td align=\"center\" width=\"4.34%\" class=\"hidden_column\">" . $nhanVien['CongViec'] . "</td>
            </tr> ";
    }
}
