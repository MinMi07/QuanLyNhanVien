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
$cauHinh = $data['CauHinh'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$cauHinh) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}


// Tránh lỗi SQL Injection
$rawQuery = "DELETE FROM cauhinhthongso WHERE CauHinh = '$cauHinh'";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Xóa cấu hình thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi xóa cấu hình!"]);
}
