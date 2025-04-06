<?php
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

$query = "SELECT * from chamcong WHERE 1 = 1 ";

if($search && $searchValue) {
    $query = $query . " AND $search = $searchValue ";
}

if($thang) {
    $query = $query . " AND MONTH(ThoiGian) = $thang ";
}

if($nam) {
    $query = $query . " AND YEAR(ThoiGian) = $nam ";
}

$data_chamcong = $sql->getdata($query);
$chamCongs = [];
while ($row = $data_chamcong->fetch_assoc()) {
    $chamCongs[] = $row;
}

foreach ($chamCongs as $chamCong) {
    $maNhanVien = $chamCong['MaNhanVien'];
    $tenNhanVien =  $sql->getdata("SELECT HoTen from nhanvien WHERE MaNhanVien = $maNhanVien")->fetch_assoc()['HoTen'];

    $loai = "Công thương";
    if ($chamCong['Loai'] == 1) {
        $loai = "Công thương";
    }

    if ($chamCong['Loai'] == 2) {
        $loai = "Tăng ca";
    }

    echo " <tr class=\"class noidungbang\"> 
        <td align=\"center\" width=\"4.34%\" >" . $chamCong['MaChamCong'] . "</td> 
        <td align=\"center\" width=\"4.34%\">" . $chamCong['MaNhanVien'] . "</td> 
        <td align=\"center\" width=\"4.34%\">" . $tenNhanVien . "</td> 
        <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGian'] . "</td> 
        <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGianVe'] . "</td> 
        <td align=\"center\" width=\"4.34%\">" . ($chamCong['TrangThai'] ? "Chấm công đúng giờ" : "Chấm công muộn") . "</td>
        <td align=\"center\" width=\"4.34%\">" . $loai . "</td>
        </tr> ";
}
