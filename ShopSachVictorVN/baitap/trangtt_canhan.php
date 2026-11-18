<?php
$goc = '../';
$tieuDe = 'Thông tin cá nhân';
$trangHienTai = 'trangtt_canhan';
include_once __DIR__ . '/../includes/functions.php';
include_once __DIR__ . '/../includes/taikhoan.php';
if (!laThanhVien()) {
    chuyenTrang('dangky.php', 'Bạn không có quyền trên trang này! Hãy đăng nhập hoặc đăng ký.');
}
include_once __DIR__ . '/../ketnoi.php';

$user = $_SESSION['nguoidung'];
$st = mysqli_prepare($kn, "select username, hoten, gioitinh+0 as gt, quocgia, hinhdaidien from nguoi_dung where username = ?");
mysqli_stmt_bind_param($st, 's', $user);
mysqli_stmt_execute($st);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($st));
mysqli_stmt_close($st);
if (!$row) {                      // tài khoản đã bị xóa
    unset($_SESSION['nguoidung']);
    chuyenTrang('dangky.php', 'Tài khoản không còn tồn tại.');
}

include_once __DIR__ . '/../header.php';
?>
<h2>THÔNG TIN CỦA BẠN</h2>
<table class="thongtin">
    <tr><th colspan="2">Xin chào <?php echo e($row['username']); ?></th></tr>
    <tr><td>Họ và tên:</td><td><?php echo e($row['hoten']); ?></td></tr>
    <tr><td>Giới tính:</td><td><?php echo $row['gt'] == 0 ? 'Nam' : 'Nữ'; ?></td></tr>
    <tr><td>Thuộc quốc tịch:</td><td><?php echo e(tenQuocGia($row['quocgia'])); ?></td></tr>
    <tr><td>Ảnh đại diện:</td><td><?php echo hienAnh($row['hinhdaidien'], $goc); ?></td></tr>
</table>
<?php include_once __DIR__ . '/../footer.php'; ?>
