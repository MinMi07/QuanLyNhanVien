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
$maBacLuong = $data['MaBacLuong'] ?? null;
$soTien = $data['SoTien'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$maBacLuong || !$soTien) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "UPDATE bacluong 
            SET SoTien = '$soTien'
            WHERE MaBacLuong = $maBacLuong";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Cập nhật bậc lương thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật bậc lương!"]);
}
