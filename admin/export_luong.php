<!-- Lương của nhân viên = Bậc lương x Hệ số x Số ngày công + Phụ cấp - Bảo hiểm - phạt chấm công muộn + tăng ca. 
Nhân viên hợp đồng được trả lương theo thoả thuận -->

<?php
require_once "./logIn/sql.php";
$sql = new SQL();

// API gen lương thủ công: http://localhost/QuanLyNhanVien/admin/export_luong.php
$isCustom = false; // false - tắt/ true - bật: tắt bật xuất bảng lương demo
$monthCustom = 2; // Tháng cần xuất bảng lương

// Lấy ngày hiện tại
$today = date("Y-m-d");
$curMonth = date("n");

// Lấy thông tin chấm công
$startTime = date("Y-m-01 00:00:00", strtotime("first day of last month"));
$endTime = date("Y-m-t 23:59:59", strtotime("last day of last month"));

$thangLuong = date("m", strtotime("first day of last month"));

$startTimeDay = date("Y-m-d 00:00:00");
$endTimeDay = date("Y-m-d 23:59:59");

$createDate = date("Y-m-d H:i:s");
$exportMonth = (date("n") - 1);

// Xuất file lương nếu hôm nay là ngày đầu tiên của tháng
$firstDay = "01";

if (!$isCustom){
    if (date("d") !== $firstDay) { 
        exit();
    }
} else {
    $curMonth = $monthCustom + 1;
    $startTime = date("Y-$monthCustom-01 00:00:00", strtotime("first day of last month"));
    $endTime = date("Y-$monthCustom-t 23:59:59", strtotime("last day of last month"));
    $thangLuong = "0" . date($monthCustom, strtotime("first day of last month"));
    $startTimeDay = date("Y-$curMonth-01 00:00:00");
    $endTimeDay = date("Y-$curMonth-01 23:59:59");
    $createDate = date("Y-$curMonth-01 00:00:01");
    $exportMonth = $monthCustom;
}

$checkData = "SELECT * FROM luong WHERE MONTH(ThoiGianTao) = $curMonth";
$dataLuong = $sql->getdata($checkData);
if ($dataLuong && $dataLuong->num_rows > 0) {
    exit();
}

// Xác định bậc lương
$queryBacLuong = "SELECT MaBacLuong , SoTien FROM bacluong ORDER BY ThoiGianTao ASC";
$dataBacLuongs = $sql->getdata($queryBacLuong);

$bacLuongs = [];
if ($dataBacLuongs && $dataBacLuongs->num_rows > 0) {
    while ($row = $dataBacLuongs->fetch_assoc()) {
        $bacLuongs[$row["MaBacLuong"]] = $row["SoTien"];
    }
}

// Lấy thông tin LoaiHopDong, HeSoLuong, PhuCap, BaoHiem, LuongThoaThuan
$queryHopDong = "SELECT MaNhanVien , LoaiHopDong, HeSoLuong, PhuCap, BaoHiem, LuongThoaThuan, BacLuong FROM hopdong ORDER BY ThoiGianTao ASC";
$dataHopDongs = $sql->getdata($queryHopDong);

$hopDongs = [];
if ($dataHopDongs && $dataHopDongs->num_rows > 0) {
    while ($row = $dataHopDongs->fetch_assoc()) {
        $hopDongs[$row["MaNhanVien"]] = $row;
    }
}

$queryChamCong = "SELECT MaNhanVien, count(MaChamCong) AS 'SoCong' FROM chamcong WHERE Loai = 1 AND ThoiGian >= '$startTime' AND ThoiGian <= '$endTime' GROUP BY MaNhanVien";

$dataChamCongs = $sql->getdata($queryChamCong);

$ChamCongs = [];
if ($dataChamCongs && $dataChamCongs->num_rows > 0) {
    while ($row = $dataChamCongs->fetch_assoc()) {
        $ChamCongs[$row["MaNhanVien"]] = $row;
    }
}

$luongTangCa = $sql->getdata("SELECT GiaTri FROM cauhinhthongso WHERE CauHinh = 'luongTangCa'")->fetch_assoc()['GiaTri'];
$phatChamCongMuon = $sql->getdata("SELECT GiaTri FROM cauhinhthongso WHERE CauHinh = 'phatChamCongMuon'")->fetch_assoc()['GiaTri'];

// Số lần đi muộn
$queryChamCongMuon = "SELECT MaNhanVien, count(MaChamCong) AS 'SoCong' FROM chamcong WHERE Loai = 1 AND TrangThai = 0 AND ThoiGian >= '$startTime' AND ThoiGian <= '$endTime' GROUP BY MaNhanVien";
$dataChamCongMuons = $sql->getdata($queryChamCongMuon);
$chamCongMuons = [];
if ($dataChamCongMuons && $dataChamCongMuons->num_rows > 0) {
    while ($row = $dataChamCongMuons->fetch_assoc()) {
        $chamCongMuons[$row["MaNhanVien"]] = $row["SoCong"];
    }
}

// Số giờ tăng ca
$queryTangCa = "SELECT MaNhanVien,ThoiGian,ThoiGianVe FROM chamcong WHERE Loai = 2 AND ThoiGian >= '$startTime' AND ThoiGian <= '$endTime'";
$dataTangCas = $sql->getdata($queryTangCa);
if ($dataTangCas && $dataTangCas->num_rows > 0) {
    while ($row = $dataTangCas->fetch_assoc()) {

        $checkIn = $row["ThoiGian"];
        $checkOut = $row["ThoiGianVe"];

        $start = new DateTime($checkIn);
        $end = new DateTime($checkOut);

        // Lấy tổng số giây giữa hai thời điểm
        $seconds = $end->getTimestamp() - $start->getTimestamp();

        // Chuyển đổi giây sang giờ (số thập phân)
        $hours = $seconds / 3600;

        // Làm tròn 2 chữ số thập phân (nếu muốn)
        round($hours, 2); // Kết quả: 5.01

        $soGioTangCa[$row["MaNhanVien"]] = round($hours, 2);
    }
}

$luongs = [];

// Lương của nhân viên = Bậc lương x Hệ số x Số ngày công + Phụ cấp - Bảo hiểm. 
// Nhân viên hợp đồng được trả lương theo thoả thuận
// LoaiHopDong, HeSoLuong, PhuCap, BaoHiem, LuongThoaThuan

foreach ($hopDongs as $maNhanVien => $hopDong) {
    // Nhân viên hợp đồng
    if ($hopDong["LoaiHopDong"] == "Hợp đồng") {
        $tongTien = $hopDong["LuongThoaThuan"] ?? 0;
    } else {
        $bacLuong = $bacLuongs[$hopDong["BacLuong"] ?? 0] ? (int)$bacLuongs[$hopDong["BacLuong"]] : 1;
        $heSo = $hopDong["HeSoLuong"] ?? 1;
        $soNgayCong = !empty($ChamCongs[$maNhanVien]) ? $ChamCongs[$maNhanVien]["SoCong"] : 1;
        $phuCap = $hopDong["PhuCap"] ?? 0;
        $baoHiem = $hopDong["BaoHiem"] ?? 0;
        $phatChamCong = !empty($chamCongMuons[$maNhanVien] ?? 0) ? $chamCongMuons[$maNhanVien]*$phatChamCongMuon : 0;
        $tienTangCa = !empty($soGioTangCa[$maNhanVien] ?? 0) ? $soGioTangCa[$maNhanVien]*$luongTangCa : 0;
        $tongTien = $bacLuong * $heSo * $soNgayCong + $phuCap - $baoHiem - $phatChamCong + $tienTangCa;
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
        "ThoiGianTao" => $createDate,
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

$query = "SELECT MaLuong,MaNhanVien,ThoiGianTao,SoTien,TheLoai,MoTa FROM luong WHERE ThoiGianTao >= '$startTimeDay' AND ThoiGianTao <= '$endTimeDay'";

$result = $sql->getdata($query);
if ($result && $result->num_rows > 0) {
    $filename = "bangLuongThang_" . $exportMonth . "Nam" . date("Y") . ".csv";
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
    echo "⚠️ Có lỗi khi xuất lương.\n";
}
