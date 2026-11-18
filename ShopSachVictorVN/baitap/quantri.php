<?php
$goc = '../';
$tieuDe = 'Quản trị';
$trangHienTai = 'quantri';
include_once __DIR__ . '/../includes/functions.php';
include_once __DIR__ . '/../includes/taikhoan.php';
yeuCauAdmin($goc);
include_once __DIR__ . '/../ketnoi.php';

$kq = mysqli_query($kn, "select username, password, hoten, gioitinh+0 as gt, quocgia, hinhdaidien from nguoi_dung order by username");

include_once __DIR__ . '/../header.php';
?>
<h2>THÔNG TIN NGƯỜI DÙNG</h2>
<table class="bang-quantri">
    <tr>
        <th>Tên đăng nhập</th><th>Mật khẩu</th><th>Họ và tên</th>
        <th>Giới tính</th><th>Quốc gia</th><th>Hình đại diện</th><th>Sửa</th><th>Xóa</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($kq)): ?>
    <tr>
        <td><?php echo e($row['username']); ?></td>
        <td title="<?php echo e($row['password']); ?>"><?php echo e(substr($row['password'], 0, 8)); ?>…</td>
        <td><?php echo e($row['hoten']); ?></td>
        <td><?php echo $row['gt'] == 0 ? 'Nam' : 'Nữ'; ?></td>
        <td><?php echo e(tenQuocGia($row['quocgia'])); ?></td>
        <td><?php echo hienAnh($row['hinhdaidien'], $goc, 'avatar-nho'); ?></td>
        <td><a class="nut nut-xanh" href="sua.php?user=<?php echo urlencode($row['username']); ?>">Sửa</a></td>
        <td>
            <form action="../xoa.php" method="post" onsubmit="return confirm('Xóa người dùng này?');">
                <input type="hidden" name="user" value="<?php echo e($row['username']); ?>">
                <input type="submit" class="nut-do" value="Xóa" style="background:var(--do);padding:4px 10px;font-size:12px">
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include_once __DIR__ . '/../footer.php'; ?>
