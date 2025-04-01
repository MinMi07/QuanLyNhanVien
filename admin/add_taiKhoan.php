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
$taiKhoan = $data['TaiKhoan'] ?? null;
$matKhau = $data['MatKhau'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$taiKhoan || !$matKhau) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Kiểm tra tài khoản đã tồn tại hay chưa
$queryTaiKhoan = "SELECT * from taikhoan where TaiKhoan like '$taiKhoan'";
$dataTaiKhoan = $sql->getdata($queryTaiKhoan);

if ($dataTaiKhoan->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!"]);
    exit();
}

// Tránh lỗi SQL Injection
$rawQuery = "INSERT INTO taikhoan (TaiKhoan,MatKhau) VALUES ('$taiKhoan','$matKhau')";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm tài khoản thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm tài khoản!"]);
}
