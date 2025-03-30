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
$maCongViec = $data['MaCongViec'] ?? null;
$maNhanVien = $data['MaNhanVien'] ?? null;
$tenCongViec = $data['TenCongViec'] ?? null;
$ngayBatDau = $data['NgayBatDau'] ?? null;
$ngayKetThuc = $data['NgayKetThuc'] ?? null;
$trangThai = $data['TrangThai'] ?? null;
$tienDo = $data['TienDo'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$maNhanVien || !$tenCongViec || !$ngayBatDau || !$ngayKetThuc || !$trangThai || !$tienDo) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "UPDATE phancongcongviec 
            SET 
                MaNhanVien = '$maNhanVien',
                TenCongViec = '$tenCongViec',
                NgayBatDau = '$ngayBatDau',
                NgayKetThuc = '$ngayKetThuc',
                TrangThai = '$trangThai',
                TienDo = '$tienDo'
            WHERE MaCongViec = $maCongViec";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Cập nhật phân công công việc thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật phân công công việc!"]);
}
