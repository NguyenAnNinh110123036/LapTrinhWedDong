<?php
// Bài 4: Xử lý đăng ký thành viên (form ở baitap/dangky.php gửi POST tới đây)
include_once __DIR__ . '/includes/functions.php';
include_once __DIR__ . '/includes/taikhoan.php';
include("ketnoi.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    chuyenTrang('baitap/dangky.php');
}

$tdn = isset($_POST['tendn'])    ? trim($_POST['tendn']) : '';
$mk  = isset($_POST['matkhau'])  ? $_POST['matkhau']     : '';
$ht  = isset($_POST['hoten'])    ? trim($_POST['hoten']) : '';
$gt  = (isset($_POST['gioitinh']) && $_POST['gioitinh'] == '1') ? 1 : 0;
$qg  = isset($_POST['quocgia'])  ? $_POST['quocgia']     : 'vn';

// Kiểm tra dữ liệu nhập
if (!preg_match('/^[A-Za-z0-9_]{3,20}$/', $tdn)) {
    chuyenTrang('baitap/dangky.php', 'Tên đăng nhập gồm 3-20 ký tự: chữ, số hoặc dấu gạch dưới.');
}
if (strlen($mk) < 3) {
    chuyenTrang('baitap/dangky.php', 'Mật khẩu phải có ít nhất 3 ký tự.');
}
if ($ht === '' || mb_strlen($ht) > 50) {
    chuyenTrang('baitap/dangky.php', 'Họ tên không được để trống và tối đa 50 ký tự.');
}
if (!array_key_exists($qg, dsQuocGia())) {
    $qg = 'k';
}

// Kiểm tra tên đăng nhập đã tồn tại chưa
$st = mysqli_prepare($kn, "select username from nguoi_dung where username = ?");
mysqli_stmt_bind_param($st, 's', $tdn);
mysqli_stmt_execute($st);
mysqli_stmt_store_result($st);
if (mysqli_stmt_num_rows($st) > 0) {
    chuyenTrang('baitap/dangky.php', 'Đã có tên đăng nhập này. Bạn hãy chọn tên đăng nhập khác!');
}
mysqli_stmt_close($st);

// Lưu ảnh đại diện với tên mới (không trùng) rồi lấy đường dẫn để lưu vào CSDL
$duongdan = luuAnhDaiDien(isset($_FILES['hinhanh']) ? $_FILES['hinhanh'] : null, $loiAnh);
if ($duongdan === false) {
    chuyenTrang('baitap/dangky.php', $loiAnh);
}

// Mật khẩu được mã hóa MD5 trước khi lưu
$mk_md5 = md5($mk);

$st = mysqli_prepare($kn, "insert into nguoi_dung (username, password, hoten, gioitinh, quocgia, hinhdaidien) values (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($st, 'sssiss', $tdn, $mk_md5, $ht, $gt, $qg, $duongdan);
if (!mysqli_stmt_execute($st)) {
    xoaAnhDaiDien($duongdan);
    chuyenTrang('baitap/dangky.php', 'Không thể thêm người dùng này: ' . mysqli_stmt_error($st));
}
mysqli_stmt_close($st);

unset($_SESSION['nguoiquantri']);
$_SESSION['nguoidung'] = $tdn;
chuyenTrang('baitap/trangtt_canhan.php', 'Đăng ký thành công!', 'ok');
