<?php
// Bài 14: xóa một người dùng (chỉ quản trị, gửi bằng POST từ baitap/quantri.php)
include_once __DIR__ . '/includes/functions.php';
include_once __DIR__ . '/includes/taikhoan.php';
yeuCauAdmin();
include("ketnoi.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['user'])) {
    chuyenTrang('baitap/quantri.php');
}
$user = $_POST['user'];

$st = mysqli_prepare($kn, "select hinhdaidien from nguoi_dung where username = ?");
mysqli_stmt_bind_param($st, 's', $user);
mysqli_stmt_execute($st);
mysqli_stmt_bind_result($st, $anh);
$tonTai = mysqli_stmt_fetch($st);
mysqli_stmt_close($st);

if ($tonTai) {
    $st = mysqli_prepare($kn, "delete from nguoi_dung where username = ?");
    mysqli_stmt_bind_param($st, 's', $user);
    mysqli_stmt_execute($st);
    mysqli_stmt_close($st);
    xoaAnhDaiDien($anh);
}
chuyenTrang('baitap/quantri.php', 'Xóa thành công!', 'ok');
