<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
header('Content-Type: application/json');
require_once "sql.php";

$sql = new SQL();
$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['machamcong']) ||
    empty($data['machamcong'])
) {
    echo json_encode(["success" => false, "message" => "Không có dữ liệu"]);
    exit;
}

$maChamCong = $data['machamcong'];
$timeNow = date("Y-m-d H:i:s");

$rawQuery = "UPDATE chamcong SET ThoiGianVe = '$timeNow' WHERE MaChamCong = $maChamCong";

try {
    $query = $sql->exe($rawQuery);
} catch (Exception $e) {
    var_dump($e);
}

if ($query) {
    echo json_encode(["success" => true, "message" => "Chấm công về thành công"]);
} else {
    echo json_encode(["success" => false, "message" => "Chấm công về thất bại"]);
}
