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

$search = $data['Search'] ?? null;
$searchValue = $data['SearchValue'] ?? null;
$thang = $data['Thang'] ?? null;
$nam = $data['Nam'] ?? null;

$query = "SELECT * from luong WHERE 1 = 1 ";

if ($search && $searchValue) {
    $query = $query . " AND $search = $searchValue ";
}

if ($thang) {
    $query = $query . " AND MONTH(ThoiGianTao) = $thang ";
}

if ($nam) {
    $query = $query . " AND YEAR(ThoiGianTao) = $nam ";
}

$data_luong = $sql->getdata($query);
$luongs = [];

if ($data_luong->num_rows > 0) {
    while ($row = $data_luong->fetch_assoc()) {
        $luongs[] = $row;
    }
}

foreach ($luongs as $luong) {
    $maNhanVien = $luong['MaNhanVien'];
    $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

    echo "<tr class=\"class noidungbang\"> 
                <td align=\"center\" width=\"4.34%\">" . $luong['MaLuong'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['MaNhanVien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['ThoiGianTao'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['SoTien'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['TheLoai'] . "</td> 
                <td align=\"center\" width=\"4.34%\">" . $luong['MoTa'] . "</td> 
            </tr>";
}
