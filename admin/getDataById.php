<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once "./logIn/sql.php";
require_once "./infor_general.php";

$sql = new SQL();
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["CONTENT_TYPE"] !== "application/json") {
    echo json_encode(["success" => false, "message" => "Sai kiểu dữ liệu, yêu cầu JSON"]);
    exit;
}

// Lấy dữ liệu từ request POST
$bang = $data['Table'] ?? null;
$idBang = $data['IdBang'] ?? null;
$tenCotId = $data['TenCotId'] ?? null;
$truongThongTin = $data['TruongThongTin'] ?? '*';

// Kiểm tra dữ liệu hợp lệ
if (!$bang || !$tenCotId || !$truongThongTin) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "SELECT $truongThongTin from $bang where $tenCotId = '$idBang'";

// var_dump($rawQuery);

$datas = $sql->getdata($rawQuery);
$info = [];
while ($row = $datas->fetch_assoc()) {
    $info = $row;
}

// Thực thi truy vấn
if ($info) {
    echo json_encode([
        "success" => true, 
        "data" => $info,
        "message" => "Lấy dữ liệu thành công!"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "data" => [],
        "message" => "Lấy dữ liệu thất bại!"
    ]);
}
