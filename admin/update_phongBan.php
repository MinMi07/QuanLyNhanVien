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
$maPhongBan = $data['MaPhongBan'] ?? null;
$tenPhongBan = $data['TenPhongBan'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$tenPhongBan) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}


// Tránh lỗi SQL Injection
$rawQuery = "UPDATE phongban 
            SET 
                TenPhongBan = '$tenPhongBan'
            WHERE MaPhongBan = $maPhongBan";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm phòng ban thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm phòng ban!"]);
}
