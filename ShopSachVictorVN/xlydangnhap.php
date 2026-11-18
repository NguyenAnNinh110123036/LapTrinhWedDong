<?php
// Bài 8 + Bài 10 (đã gộp): xử lý đăng nhập cho cả THÀNH VIÊN và QUẢN TRỊ.
// Form đăng nhập nằm ở footer.php (method POST).
include_once __DIR__ . '/includes/functions.php';
include("ketnoi.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    chuyenTrang('index.php');
}

$user = isset($_POST['tendn'])   ? trim($_POST['tendn']) : '';
$pass = isset($_POST['matkhau']) ? $_POST['matkhau']     : '';
$pass_md5 = md5($pass);                       // mật khẩu lưu trong CSDL là MD5

// ---- 1. Kiểm tra tài khoản QUẢN TRỊ ----
try {
    $st = mysqli_prepare($kn, "select passadmin from admin where useradmin = ?");
    mysqli_stmt_bind_param($st, 's', $user);
    mysqli_stmt_execute($st);
    mysqli_stmt_bind_result($st, $passadmin);
    if (mysqli_stmt_fetch($st) && is_string($passadmin) && (hash_equals($passadmin, $pass_md5) || hash_equals($passadmin, $pass))) {
        mysqli_stmt_close($st);
        unset($_SESSION['nguoidung']);
        $_SESSION['nguoiquantri'] = $user;
        chuyenTrang('baitap/quantri.php', 'Đăng nhập quản trị thành công!', 'ok');
    }
    mysqli_stmt_close($st);
} catch (mysqli_sql_exception $ex) {
    // Chưa có bảng admin -> bỏ qua, kiểm tra tiếp tài khoản thành viên
}

// ---- 2. Kiểm tra tài khoản THÀNH VIÊN (bảng nguoi_dung) - Bài 8 ----
$st = mysqli_prepare($kn, "select username from nguoi_dung where username = ? and password = ?");
mysqli_stmt_bind_param($st, 'ss', $user, $pass_md5);
mysqli_stmt_execute($st);
mysqli_stmt_store_result($st);
if (mysqli_stmt_num_rows($st) > 0) {
    mysqli_stmt_close($st);
    unset($_SESSION['nguoiquantri']);
    $_SESSION['nguoidung'] = $user;
    chuyenTrang('baitap/trangtt_canhan.php', 'Đăng nhập thành công!', 'ok');
}
mysqli_stmt_close($st);

chuyenTrang('index.php', 'Sai tên đăng nhập hoặc mật khẩu');
