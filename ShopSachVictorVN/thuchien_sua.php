<?php
// Bài 13: thực hiện sửa thông tin người dùng (chỉ quản trị)
include_once __DIR__ . '/includes/functions.php';
include_once __DIR__ . '/includes/taikhoan.php';
yeuCauAdmin();
include("ketnoi.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    chuyenTrang('baitap/quantri.php');
}

$tdn = isset($_POST['tendn'])   ? trim($_POST['tendn']) : '';
$mk  = isset($_POST['matkhau']) ? $_POST['matkhau']     : '';
$ht  = isset($_POST['hoten'])   ? trim($_POST['hoten']) : '';
$gt  = (isset($_POST['gioitinh']) && $_POST['gioitinh'] == '1') ? 1 : 0;
$qg  = isset($_POST['quocgia']) ? $_POST['quocgia']     : 'k';
if (!array_key_exists($qg, dsQuocGia())) $qg = 'k';
if ($ht === '' || mb_strlen($ht) > 50) {
    chuyenTrang('baitap/sua.php?user=' . urlencode($tdn), 'Họ tên không được để trống và tối đa 50 ký tự.');
}

// Lấy thông tin cũ (để biết ảnh cũ)
$st = mysqli_prepare($kn, "select hinhdaidien from nguoi_dung where username = ?");
mysqli_stmt_bind_param($st, 's', $tdn);
mysqli_stmt_execute($st);
mysqli_stmt_bind_result($st, $anhCu);
if (!mysqli_stmt_fetch($st)) {
    chuyenTrang('baitap/quantri.php', 'Không tìm thấy người dùng này.');
}
mysqli_stmt_close($st);

// Ảnh mới (nếu có chọn) -> tên mới không trùng; nếu không chọn thì giữ ảnh cũ
$anhMoi = luuAnhDaiDien(isset($_FILES['hinh']) ? $_FILES['hinh'] : null, $loiAnh);
if ($anhMoi === false) {
    chuyenTrang('baitap/sua.php?user=' . urlencode($tdn), $loiAnh);
}
$anh = ($anhMoi !== '') ? $anhMoi : $anhCu;

// Mật khẩu: để trống = giữ nguyên, có nhập = mã hóa MD5 mật khẩu mới
if ($mk === '') {
    $st = mysqli_prepare($kn, "update nguoi_dung set hoten=?, gioitinh=?, quocgia=?, hinhdaidien=? where username=?");
    mysqli_stmt_bind_param($st, 'sisss', $ht, $gt, $qg, $anh, $tdn);
} else {
    $mk_md5 = md5($mk);
    $st = mysqli_prepare($kn, "update nguoi_dung set password=?, hoten=?, gioitinh=?, quocgia=?, hinhdaidien=? where username=?");
    mysqli_stmt_bind_param($st, 'ssisss', $mk_md5, $ht, $gt, $qg, $anh, $tdn);
}
mysqli_stmt_execute($st);
mysqli_stmt_close($st);

if ($anhMoi !== '') {
    xoaAnhDaiDien($anhCu);           // xóa ảnh cũ sau khi đã lưu thành công
}
chuyenTrang('baitap/quantri.php', 'Sửa thông tin thành công!', 'ok');
