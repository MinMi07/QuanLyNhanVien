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
$thoiGian = $data['ThoiGian'] ?? null;
$thoiGianVe = $data['ThoiGianVe'] ?? null;
$loai = $data['Loai'] ?? null;
$trangThai = $data['TrangThai'];

// Kiểm tra dữ liệu hợp lệ

if (!$maNhanVien || !$thoiGian || !$thoiGianVe || !$loai) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

$checkIn = new DateTime($thoiGian);
$checkOut = new DateTime($thoiGianVe);
$now = new DateTime(); // thời gian hiện tại

// 1. Kiểm tra cùng ngày
if ($checkIn->format('Y-m-d') !== $checkOut->format('Y-m-d')) {
    echo json_encode([
        "success" => false,
        "message" => "Thời gian chấm công và thời gian chấm công về phải cùng một ngày!"
    ]);
    exit;
}

// 2. Kiểm tra checkOut phải sau checkIn
if ($checkOut <= $checkIn) {
    echo json_encode([
        "success" => false,
        "message" => "Thời gian chấm công về phải lớn hơn thời gian chấm công!"
    ]);
    exit;
}

// 3. Kiểm tra cả 2 thời điểm đều < hiện tại
if ($checkIn > $now || $checkOut > $now) {
    echo json_encode([
        "success" => false,
        "message" => "Thời gian chấm công và chấm công về phải nhỏ hơn thời điểm hiện tại!"
    ]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "INSERT INTO chamcong (MaNhanVien,ThoiGian,ThoiGianVe,Loai,TrangThai) VALUES ('$maNhanVien','$thoiGian','$thoiGianVe','$loai','$trangThai')";
try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm dữ liệu chấm công thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm dữ liệu chấm công!"]);
}
