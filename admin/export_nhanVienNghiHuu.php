<?php
require_once "./logIn/sql.php";
$sql = new SQL();

// Lấy ngày hiện tại
$today = date("Y-m-d");

// Xác định ngày nghỉ hưu
$query = "
SELECT MaNhanVien, HoTen, GioiTinh, NgaySinh 
FROM nhanvien
WHERE 
    (GioiTinh LIKE 'Nam' AND DATE_ADD(NgaySinh, INTERVAL 61 YEAR) <= DATE_SUB(CURDATE(), INTERVAL 3 MONTH))
    OR 
    (GioiTinh LIKE 'Nữ' AND DATE_ADD(NgaySinh, INTERVAL 56 YEAR) <= DATE_SUB(CURDATE(), INTERVAL 8 MONTH))
";

$result = $sql->getdata($query);

if ($result && $result->num_rows > 0) {
    $filename = "nhanVienNghiHuu_" . date("Y-m-d") . ".csv";
    $filepath = __DIR__ . "/exports/" . $filename;

    // Tạo thư mục nếu chưa có
    if (!file_exists(__DIR__ . "/exports")) {
        mkdir(__DIR__ . "/exports", 0777, true);
    }

    // Mở file để ghi dữ liệu
    $file = fopen($filepath, "w");

    // **Thêm BOM để hỗ trợ Unicode trong Excel**
    fwrite($file, "\xEF\xBB\xBF");

    // Ghi tiêu đề cột
    fputcsv($file, ["Mã Nhân Viên", "Họ Tên", "Giới Tính", "Ngày Sinh", "Tuổi Hiện Tại"]);

    // Ghi dữ liệu
    while ($row = $result->fetch_assoc()) {
        // Tính tuổi hiện tại
        $dob = new DateTime($row["NgaySinh"]);
        $age = $dob->diff(new DateTime($today))->y;

        fputcsv($file, [
            $row["MaNhanVien"],
            $row["HoTen"],
            $row["GioiTinh"],
            $row["NgaySinh"],
            $age
        ]);
    }

    fclose($file);
    echo "✅ Xuất file thành công: $filename\n";
} else {
    echo "⚠️ Không có nhân viên nào đến tuổi nghỉ hưu.\n";
}
