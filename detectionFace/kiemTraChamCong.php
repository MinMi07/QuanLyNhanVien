<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once "sql.php";
$sql = new SQL();

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['name']) || empty($data['name'])) {
    echo json_encode(["error" => "Không có dữ liệu xx"]);
    exit();
}

$userName = $data['name'];
$today = date("Y-m-d 00:00:00");

$nhanVien = $sql->getdata("SELECT MaNhanVien FROM nhanvien WHERE TaiKhoan like '$userName'");


// Nếu không có dữ liệu, trả về JSON luôn và dừng script
if ($nhanVien->num_rows == 0) {
    echo json_encode([
        "is_checkin" => false,
        "message" => "Không tìm thấy người dùng '$userName'"
    ]);
    exit(); // Dừng script ngay sau khi trả về JSON
}

// Lấy dòng dữ liệu đầu tiên
$row = $nhanVien->fetch_assoc();
$maNhanVien = $row['MaNhanVien'] ?? null; // Dùng `??` để tránh lỗi nếu không tồn tại

// Kiểm tra xem user đã chấm công hôm nay chưa
$chamCong = $sql->getdata("select count(*) from chamcong where MaNhanVien = '$maNhanVien' and Thoigian > '$today'")->fetch_assoc();

if ($chamCong["count(*)"] > 0) {
    echo json_encode([
        "is_checkin" => true,
        "ma_nhan_vien" => $maNhanVien,
        "message" => "Đã chấm công"
    ]);
} else {
    echo json_encode([
        "is_checkin" => false,
        "ma_nhan_vien" => $maNhanVien,
        "message" => "Chưa chấm công"
    ]);
}
