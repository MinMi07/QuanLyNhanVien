<?php
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once "./logIn/sql.php";
$sql = new SQL();

$sql = new SQL();
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["CONTENT_TYPE"] !== "application/json") {
    echo json_encode(["success" => false, "message" => "Sai kiểu dữ liệu, yêu cầu JSON"]);
    exit;
}

$maNhanVien = $_SESSION['maNhanVien'];
$thang = $data['Thang'] ?? null;
$nam = $data['Nam'] ?? null;

$query = "SELECT * from chamcong WHERE MaNhanVien = $maNhanVien ";

if ($thang) {
    $query = $query . " AND MONTH(ThoiGian) = '$thang' ";
}

if ($nam) {
    $query = $query . " AND YEAR(ThoiGian) = '$nam' ";
}

$data_chamcong = $sql->getdata($query);
$chamCongs = [];
while ($row = $data_chamcong->fetch_assoc()) {
    $chamCongs[] = $row;
}

foreach ($chamCongs as $chamCong) {
    echo " <tr class=\"class noidungbang\"> 
        <td align=\"center\" width=\"4.34%\" >" . $chamCong['MaChamCong'] . "</td> 
        <td align=\"center\" width=\"4.34%\">" . $chamCong['MaNhanVien'] . "</td> 
        <td align=\"center\" width=\"4.34%\">" . $chamCong['ThoiGian'] . "</td> 
        <td align=\"center\" width=\"4.34%\">" . ($chamCong['TrangThai'] ? "Chấm công đúng giờ" : "Chấm công muộn") . "</td></tr> ";
}
