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

$whileConfig = ['thoiGianChamCong', 'thoiGianChamCongVe', 'phatChamCongMuon', 'luongTangCa'];
$typeTimeConfig = ['thoiGianChamCong', 'thoiGianChamCongVe'];
$typeMoneyConfig = ['phatChamCongMuon', 'luongTangCa'];

if (in_array($cauHinh, $whileConfig)) {
    // Kiểm tra định dạng
    if (in_array($cauHinh, $typeTimeConfig)) {
        $valid = DateTime::createFromFormat('H:i:s', $giaTri);

        if (!$valid || $valid->format('H:i:s') !== $giaTri) {
            echo json_encode(["success" => false, "message" => "Cấu hình '$cauHinh' không dúng định dạng thời gian. VD: 09:00:00"]);
            exit();
        }
    }

    if (in_array($cauHinh, $typeMoneyConfig)) {
        $giaTri = (int)$giaTri;
        if (!is_int($giaTri) || $giaTri <= 0) {
            echo json_encode(["success" => false, "message" => "Cấu hình '$cauHinh' không dúng định dạng số tiền. VD: 100000"]);
            exit();
        }
    }
}

// Tránh lỗi SQL Injection
$rawQuery = "UPDATE cauhinhthongso 
            SET 
                GiaTri = '$giaTri'
            WHERE CauHinh = '$cauHinh'";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

// Thực thi truy vấn
if ($query) {
    echo json_encode(["success" => true, "message" => "Cập nhật cấu hình thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật cấu hình!"]);
}
