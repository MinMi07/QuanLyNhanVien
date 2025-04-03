<?php
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once "./logIn/sql.php";
$sql = new SQL();
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["CONTENT_TYPE"] !== "application/json") {
    echo json_encode(["success" => false, "message" => "Sai kiểu dữ liệu, yêu cầu JSON"]);
    exit;
}

$maNhanVien = $_SESSION['maNhanVien'];
$search = $data['Search'] ?? null;
$searchValue = $data['SearchValue'] ?? null;
$thang = $data['Thang'] ?? null;
$nam = $data['Nam'] ?? null;

$query = "SELECT * from khenthuongkyluat WHERE MaNhanVien = $maNhanVien ";

if ($search && $searchValue) {
    $query = $query . " AND $search = '$searchValue' ";
}

if ($thang) {
    $query = $query . " AND MONTH(ThoiGianKhenThuongKyLuat) = '$thang' ";
}

if ($nam) {
    $query = $query . " AND YEAR(ThoiGianKhenThuongKyLuat) = '$nam' ";
}

    $data_khenthuongkyluat = $sql->getdata($query);
    $khenThuongKyLuats = [];
    while ($row = $data_khenthuongkyluat->fetch_assoc()) {
        $khenThuongKyLuats[] = $row;
    }

    foreach ($khenThuongKyLuats as $khenThuongKyLuat) {
        echo " 
        <tr class=\"class noidungbang\">
        <td align=\"center\" width=\"4.34%\" >" . $khenThuongKyLuat['MaKhenThuongKyLuat'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['ThoiGianKhenThuongKyLuat'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['Loai'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['NoiDung'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['SoQuyetDinh'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['CoQuanQuyetDinh'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['HinhThuc'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['SoTien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['TrangThai'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $khenThuongKyLuat['GhiChu'] . "</td> </tr> ";
}
