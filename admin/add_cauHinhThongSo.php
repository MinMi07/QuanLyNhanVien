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
$giaTri = $data['GiaTri'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$cauHinh || !$giaTri) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Kiểm tra tài khoản đã tồn tại hay chưa
$queryCauHinh = "SELECT * from cauhinhthongso where CauHinh like '$cauHinh'";
$dataCauHinh = $sql->getdata($queryCauHinh);

if ($dataCauHinh->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Cấu hình đã tồn tại, vui lòng nhập cấu hình khác!"]);
    exit();
}

// Tránh lỗi SQL Injection
$rawQuery = "INSERT INTO cauhinhthongso (CauHinh,GiaTri) VALUES ('$cauHinh','$giaTri')";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm cấu hình thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm cấu hình!"]);
}
