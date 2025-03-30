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
$maNhanVien = $data['MaNhanVien'] ?? null;
$soTien = $data['SoTien'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$maNhanVien || !$soTien) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Kiểm tra user đã có bậc lương hay chưa
$queryBacLuongNhanVien = "SELECT * from bacluong where MaNhanVien = $maNhanVien";
$dataBacLuongNhanVien = $sql->getdata($queryBacLuongNhanVien);

if($dataBacLuongNhanVien->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Mã nhân viên 'maNhanVien' đã có bậc lương, vui lòng không thêm nữa!"]);
    exit();
}


// Tránh lỗi SQL Injection
$rawQuery = "INSERT INTO bacluong (MaNhanVien,SoTien) VALUES ('$maNhanVien','$soTien')";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm bậc lương thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm bậc lương!"]);
}
