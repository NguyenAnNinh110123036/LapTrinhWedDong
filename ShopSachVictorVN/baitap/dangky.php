<?php
$goc = '../';
$tieuDe = 'Đăng ký thành viên';
$trangHienTai = 'dangky';
include_once __DIR__ . '/../includes/functions.php';
include_once __DIR__ . '/../includes/taikhoan.php';
include_once __DIR__ . '/../header.php';
?>
<h2>TRANG ĐĂNG KÝ THÀNH VIÊN</h2>
<form enctype="multipart/form-data" action="../xlydangky.php" name="frmdk" method="post">
    <table class="bang-form">
        <tr>
            <td>Tên đăng nhập:</td>
            <td><input type="text" name="tendn" maxlength="20" pattern="[A-Za-z0-9_]{3,20}" title="3-20 ký tự: chữ, số hoặc dấu gạch dưới" required></td>
        </tr>
        <tr>
            <td>Mật khẩu:</td>
            <td><input type="password" name="matkhau" required></td>
        </tr>
        <tr>
            <td>Họ tên:</td>
            <td><input type="text" name="hoten" maxlength="50" required></td>
        </tr>
        <tr>
            <td>Giới tính:</td>
            <td>
                <label><input type="radio" name="gioitinh" value="0" checked> Nam</label> &nbsp;&nbsp;
                <label><input type="radio" name="gioitinh" value="1"> Nữ</label>
            </td>
        </tr>
        <tr>
            <td>Quốc gia:</td>
            <td>
                <select name="quocgia">
                    <?php foreach (dsQuocGia() as $ma => $ten): ?>
                        <option value="<?php echo $ma; ?>"><?php echo e($ten); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Ảnh đại diện:</td>
            <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo DUNG_LUONG_ANH_TOI_DA; ?>">
                <input type="file" name="hinhanh" accept="image/*">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="form-actions">
                    <input type="submit" name="dangky" value="Đăng Ký">
                    <input type="reset" name="lamlai" value="Làm lại">
                </div>
            </td>
        </tr>
    </table>
</form>
<!-- <p class="ghi-chu">Ảnh tối đa 2MB (JPG, PNG, GIF, WEBP). Tên file sẽ được đổi ngẫu nhiên khi lưu.</p> -->
<?php include_once __DIR__ . '/../footer.php'; ?>
