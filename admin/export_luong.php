<!-- Lương của nhân viên = Bậc lương x Hệ số x Số ngày công + Phụ cấp - Bảo hiểm. 
Nhân viên hợp đồng được trả lương theo thoả thuận -->

<?php
require_once "./logIn/sql.php";
$sql = new SQL();

// Lấy ngày hiện tại
$today = date("Y-m-d");
$curMonth = date("n");

// Xuất file lương nếu hôm nay là ngày đầu tiên của tháng
$firstDay = "01";
if (date("d") !== $firstDay) { 
    exit();
}

$checkData = "SELECT * FROM luong WHERE MONTH(ThoiGianTao) = $curMonth";
$dataLuong = $sql->getdata($checkData);
if ($dataLuong && $dataLuong->num_rows > 0) {
    exit();
}

// Xác định bậc lương
$queryBacLuong = "SELECT MaNhanVien , SoTien FROM bacluong ORDER BY ThoiGianTao ASC";
$dataBacLuongs = $sql->getdata($queryBacLuong);

$bacLuongs = [];
if ($dataBacLuongs && $dataBacLuongs->num_rows > 0) {
    while ($row = $dataBacLuongs->fetch_assoc()) {
        $bacLuongs[$row["MaNhanVien"]] = $row["SoTien"];
    }
}

// Lấy thông tin LoaiHopDong, HeSoLuong, PhuCap, BaoHiem, LuongThoaThuan
$queryHopDong = "SELECT MaNhanVien , LoaiHopDong, HeSoLuong, PhuCap, BaoHiem, LuongThoaThuan FROM hopdong WHERE TrangThai = 1 ORDER BY ThoiGianTao ASC";
$dataHopDongs = $sql->getdata($queryHopDong);

$hopDongs = [];
if ($dataHopDongs && $dataHopDongs->num_rows > 0) {
    while ($row = $dataHopDongs->fetch_assoc()) {
        $hopDongs[$row["MaNhanVien"]] = $row;
    }
}

// Lấy thông tin chấm công
$startTime = date("Y-m-01 00:00:00", strtotime("first day of last month"));
$endTime = date("Y-m-t 23:59:59", strtotime("last day of last month"));

$queryChamCong = "SELECT MaNhanVien, count(MaChamCong) AS 'SoCong' FROM chamcong WHERE ThoiGian >= '$startTime' AND ThoiGian <= '$endTime' GROUP BY MaNhanVien";

$dataChamCongs = $sql->getdata($queryChamCong);

$ChamCongs = [];
if ($dataChamCongs && $dataChamCongs->num_rows > 0) {
    while ($row = $dataChamCongs->fetch_assoc()) {
        $ChamCongs[$row["MaNhanVien"]] = $row;
    }
}

$luongs = [];
$thangLuong = date("m", strtotime("first day of last month"));

// Lương của nhân viên = Bậc lương x Hệ số x Số ngày công + Phụ cấp - Bảo hiểm. 
// Nhân viên hợp đồng được trả lương theo thoả thuận
// LoaiHopDong, HeSoLuong, PhuCap, BaoHiem, LuongThoaThuan

foreach ($hopDongs as $maNhanVien => $hopDong) {
    // Nhân viên hợp đồng
    if ($hopDong["LoaiHopDong"] == "Hợp đồng") {
        $tongTien = $hopDong["LuongThoaThuan"] ?? 0;
    } else {
        $bacLuong = $bacLuongs[$maNhanVien] ? (int)$bacLuongs[$maNhanVien] : 1;
        $heSo = $hopDong["HeSoLuong"] ?? 1;
        $soNgayCong = !empty($ChamCongs[$maNhanVien]) ? $ChamCongs[$maNhanVien]["SoCong"] : 1;
        $phuCap = $hopDong["PhuCap"] ?? 0;
        $baoHiem = $hopDong["BaoHiem"] ?? 0;
        $tongTien = $bacLuong * $heSo * $soNgayCong + $phuCap - $baoHiem;
    }

    // Không có dữ liệu ngày công
    if(
        empty($ChamCongs[$maNhanVien]) ||
        ($ChamCongs[$maNhanVien]["SoCong"] ?? 0) == 0
    ) {
        $tongTien = 0;    
    }

    $luongs[] = [
        "MaNhanVien" => $maNhanVien,
        "ThoiGianTao" => date("Y-m-d H:i:s"),
        "SoTien" => $tongTien,
        "TheLoai" => "Chuyển tiền thành công",
        "MoTa" => "Lương tháng $thangLuong"
    ];
}

// Lưu vào bảng lương

foreach ($luongs as $luong) {
    $dataMaNhanVien = $luong["MaNhanVien"];
    $dataThoiGianTao = $luong["ThoiGianTao"];
    $dataSoTien = $luong["SoTien"];
    $dataTheLoai = $luong["TheLoai"];
    $dataMoTa = $luong["MoTa"];

    $queryInsert = "INSERT INTO luong (MaNhanVien, ThoiGianTao, SoTien, TheLoai, MoTa) VALUES ('$dataMaNhanVien','$dataThoiGianTao','$dataSoTien','$dataTheLoai','$dataMoTa')";
    $sql->exe($queryInsert);
}

$startTimeDay = date("Y-m-d 00:00:00");
$endTimeDay = date("Y-m-d 23:59:59");

$query = "SELECT MaLuong,MaNhanVien,ThoiGianTao,SoTien,TheLoai,MoTa FROM luong WHERE ThoiGianTao >= '$startTimeDay' AND ThoiGianTao <= '$endTimeDay'";

$result = $sql->getdata($query);
if ($result && $result->num_rows > 0) {
    $filename = "bangLuongThang_" . date("n") . "Nam" . date("Y") . ".csv";
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
    fputcsv($file, ["Mã Lương", "Mã Nhân Viên", "Thời Gian", "Số Tiền", "Thể Loại", "Mô Tả"]);
    // Ghi dữ liệu
    while ($row = $result->fetch_assoc()) {
        fputcsv($file, [
            $row["MaLuong"],
            $row["MaNhanVien"],
            $row["ThoiGianTao"],
            $row["SoTien"],
            $row["TheLoai"],
            $row["MoTa"]
        ]);
    }

    fclose($file);
    echo "✅ Xuất file thành công: $filename\n";
} else {
    echo "⚠️ Không có nhân viên nào đến tuổi nghỉ hưu.\n";
}
