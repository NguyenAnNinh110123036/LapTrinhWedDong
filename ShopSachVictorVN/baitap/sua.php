<?php
$goc = '../';
$tieuDe = 'Sửa thông tin người dùng';
$trangHienTai = 'quantri';
include_once __DIR__ . '/../includes/functions.php';
include_once __DIR__ . '/../includes/taikhoan.php';
yeuCauAdmin($goc);
include_once __DIR__ . '/../ketnoi.php';

$userSua = isset($_GET['user']) ? $_GET['user'] : '';
$st = mysqli_prepare($kn, "select username, hoten, gioitinh+0 as gt, quocgia, hinhdaidien from nguoi_dung where username = ?");
mysqli_stmt_bind_param($st, 's', $userSua);
mysqli_stmt_execute($st);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($st));
mysqli_stmt_close($st);
if (!$row) {
    chuyenTrang('quantri.php', 'Không tìm thấy người dùng này.');
}

include_once __DIR__ . '/../header.php';
?>
<h2>SỬA THÔNG TIN NGƯỜI DÙNG</h2>
<form name="frmsua" action="../thuchien_sua.php" method="post" enctype="multipart/form-data">
    <table class="bang-form">
        <tr>
            <td>Username:</td>
            <td><input type="text" name="tendn" readonly value="<?php echo e($row['username']); ?>"></td>
        </tr>
        <tr>
            <td>Mật khẩu mới:</td>
            <td><input type="password" name="matkhau" placeholder="Để trống nếu không đổi"></td>
        </tr>
        <tr>
            <td>Họ tên:</td>
            <td><input type="text" name="hoten" maxlength="50" value="<?php echo e($row['hoten']); ?>" required></td>
        </tr>
        <tr>
            <td>Giới tính:</td>
            <td>
                <label><input type="radio" name="gioitinh" value="0"<?php echo $row['gt'] == 0 ? ' checked' : ''; ?>> Nam</label> &nbsp;&nbsp;
                <label><input type="radio" name="gioitinh" value="1"<?php echo $row['gt'] == 1 ? ' checked' : ''; ?>> Nữ</label>
            </td>
        </tr>
        <tr>
            <td>Quốc gia:</td>
            <td>
                <select name="quocgia">
                    <?php foreach (dsQuocGia() as $ma => $ten): ?>
                        <option value="<?php echo $ma; ?>"<?php echo $row['quocgia'] === $ma ? ' selected' : ''; ?>><?php echo e($ten); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Hình đại diện:</td>
            <td>
                <?php echo hienAnh($row['hinhdaidien'], $goc, 'avatar-nho'); ?><br>
                Ảnh mới: <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo DUNG_LUONG_ANH_TOI_DA; ?>">
                <input type="file" name="hinh" accept="image/*">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="form-actions">
                    <input type="submit" name="suatt" value="Sửa thông tin">
                    <input type="reset" name="huybo" value="Hủy bỏ">
                    <a class="nut nut-xanh" href="quantri.php">Quay lại</a>
                </div>
            </td>
        </tr>
    </table>
</form>
<?php include_once __DIR__ . '/../footer.php'; ?>
