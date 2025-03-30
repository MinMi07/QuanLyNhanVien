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
$hoTen = $data['HoTen'] ?? null;
$taiKhoan = $data['TaiKhoan'] ?? null;
$ngaySinh = $data['NgaySinh'] ?? null;
$gioiTinh = $data['GioiTinh'] ? (string)$data['GioiTinh'] : null;
$trinhDo = $data['TrinhDo'] ?? null;
$ngoaiNgu = $data['NgoaiNgu'] ?? null;
$cmnd = $data['CMND'] ?? null;
$diaChi = $data['DiaChi'] ?? null;
$sdt = $data['SDT'] ?? null;
$email = $data['Email'] ?? null;
$tonGiao = $data['TonGiao'] ?? null;
$danToc = $data['DanToc'] ?? null;
$chucVu = $data['ChucVu'] ?? null;
$phongBan = $data['PhongBan'] ?? null;
$ngayVaoDoan = $data['NgayVaoDoan'] ?? null;
$ngayVaoDang = $data['NgayVaoDang'] ?? null;
$loaiNhanVien = $data['LoaiNhanVien'] ?? null;
$tinhTrangHonNhan = $data['HonNhan'] ?? null;
$cha = $data['Cha'] ?? null;
$me = $data['Me'] ?? null;
$voChong = $data['VoChong'] ?? null;
$con = $data['Con'] ?? null;
$bacLuong = $data['BacLuong'] ?? null;
$phongCongTac = $data['PhongCongTac'] ?? null;
$congViec = $data['CongViec'] ?? null;

// Kiểm tra dữ liệu hợp lệ
if (!$hoTen || !$taiKhoan || !$ngaySinh || !$gioiTinh || !$trinhDo || !$ngoaiNgu || !$cmnd || !$diaChi || !$sdt || !$email || !$tonGiao || !$danToc || !$chucVu || !$phongBan || !$ngayVaoDoan || !$ngayVaoDang || !$loaiNhanVien || !$tinhTrangHonNhan || !$cha || !$me || !$voChong || !$con || !$bacLuong || !$phongCongTac || !$congViec) {
    echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
    exit;
}

// Tránh lỗi SQL Injection
$rawQuery = "INSERT INTO NhanVien (HoTen, TaiKhoan, NgaySinh, GioiTinh, TrinhDo, NgoaiNgu, CMND, DiaChi, SDT, Email, TonGiao, DanToc, ChucVu, PhongBan, NgayVaoDoan, NgayVaoDang, LoaiNhanVien, TinhTrangHonNhan, Cha, Me, VoChong, Con, BacLuong, PhongCongTac, CongViec) 
                        VALUES ('$hoTen','$taiKhoan','$ngaySinh','$gioiTinh','$trinhDo','$ngoaiNgu','$cmnd','$diaChi','$sdt','$email','$tonGiao','$danToc','$chucVu','$phongBan','$ngayVaoDoan','$ngayVaoDang','$loaiNhanVien','$tinhTrangHonNhan','$cha','$me','$voChong','$con','$bacLuong','$phongCongTac','$congViec')";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Thêm nhân viên thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi thêm nhân viên!"]);
}
