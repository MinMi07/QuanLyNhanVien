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
$maHopDong = $data['MaHopDong'] ?? null;
$maNhanVien = $data['MaNhanVien'] ?? null;
$loaiHopDong = $data['LoaiHopDong'] ?? null;
$ngayBatDau = $data['NgayBatDau'] ?? null;
$ngayHetHan = $data['NgayHetHan'] ?? null;
$bacLuong = $data['BacLuong'] ?? null;
$heSoLuong = $data['HeSoLuong'] ?? null;
$phuCap = $data['PhuCap'] ?? null;
$baoHiem = $data['BaoHiem'] ?? null;
$luongThoaThuan = $data['LuongThoaThuan'] ?? null;
$trangThai = $data['TrangThai'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$maHopDong || !$maNhanVien || !$loaiHopDong || !$ngayBatDau || !$ngayHetHan || !$bacLuong || !$heSoLuong || !$phuCap || !$baoHiem || !$luongThoaThuan || !$trangThai) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "UPDATE hopdong 
            SET 
                MaNhanVien = '$maNhanVien',
                LoaiHopDong = '$loaiHopDong',
                NgayBatDau = '$ngayBatDau',
                NgayHetHan = '$ngayHetHan',
                BacLuong = '$bacLuong',
                HeSoLuong = '$heSoLuong',
                PhuCap = '$phuCap',
                BaoHiem = '$baoHiem',
                LuongThoaThuan = '$luongThoaThuan',
                TrangThai = '$trangThai'
            WHERE MaHopDong = $maHopDong";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Cập nhật nhân viên thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật nhân viên!"]);
}
