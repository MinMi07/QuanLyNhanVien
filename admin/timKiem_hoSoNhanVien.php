<?php require_once "./logIn/sql.php";
$sql = new SQL();
$table = '';
if (isset($_GET['col']) && isset($_GET['inf'])) {
    if ($_GET['inf'] != '' && $_GET['col'] != 'Tuoi' && $_GET['col'] != 'DienChinhSach') {
        $query = "SELECT * from nhanvien where " . $_GET['col'] . " like '%" . $_GET['inf'] . "%'";
        $data_nhanvien_bang = $sql->getdata($query);
        $nhanViens = [];
        while ($row = $data_nhanvien_bang->fetch_assoc()) {
            $nhanViens[] = $row;
        }
        foreach ($nhanViens as $nhanVien) {
            echo " <tr class=\"class noidungbang\"> 
            <td align=\"center\" width=\"4.34%\" >" . $nhanVien['MaNhanVien'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['HoTen'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgaySinh'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['GioiTinh'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['TrinhDo'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgoaiNgu'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['CMND'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['DiaChi'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['SDT'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['Email'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['TonGiao'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['DanToc'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['ChucVu'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['PhongBan'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgayVaoDoan'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['NgayVaoDang'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['LoaiNhanVien'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['TinhTrangHonNhan'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['Cha'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['Me'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['VoChong'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['Con'] . "</td> 
            <td align=\"center\" width=\"4.34%\">" . $nhanVien['BacLuong'] . "</td></tr> ";
        }
    }
}
echo $table;
