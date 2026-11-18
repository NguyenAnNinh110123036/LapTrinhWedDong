<?php
include_once __DIR__ . '/includes/functions.php';
include_once __DIR__ . '/includes/taikhoan.php';
if (!isset($goc)) $goc = '';
?>
<!-- ===== Hết nội dung trang ===== -->
        </td>
        <td valign="top" width="200">

<?php if (laAdmin()): ?>
            <div class="dangnhap">
                <div class="dangnhap-tieude">Xin chào, <?php echo e($_SESSION['nguoiquantri']); ?></div>
                <div class="dangnhap-lienket">
                    <a href="<?php echo $goc; ?>baitap/quantri.php">Trang quản trị</a>
                    <a href="<?php echo $goc; ?>thoat.php">Thoát</a>
                </div>
            </div>
<?php elseif (laThanhVien()): ?>
            <div class="dangnhap">
                <div class="dangnhap-tieude">Xin chào, <?php echo e($_SESSION['nguoidung']); ?></div>
                <div class="dangnhap-lienket">
                    <a href="<?php echo $goc; ?>baitap/trangtt_canhan.php">Thông tin cá nhân</a>
                    <a href="<?php echo $goc; ?>thoat.php">Thoát</a>
                </div>
            </div>
<?php else: ?>
            <!-- Form đăng nhập: gửi bằng POST tới xlydangnhap.php (xử lý chung cho thành viên và quản trị) -->
            <form class="dangnhap" name="frmDangNhap" action="<?php echo $goc; ?>xlydangnhap.php" method="post">
                <div class="dangnhap-tieude">Đăng nhập</div>
                <div class="dangnhap-dong">
                    <label for="tendn">Tên đăng nhập:</label>
                    <input type="text" id="tendn" name="tendn" required>
                </div>
                <div class="dangnhap-dong">
                    <label for="matkhau">Mật khẩu:</label>
                    <input type="password" id="matkhau" name="matkhau" required>
                </div>
                <div class="dangnhap-nut">
                    <input type="submit" name="dangnhap" value="Đăng nhập">
                    <input type="reset" name="huybo" value="Hủy bỏ">
                </div>
            </form>
<?php endif; ?>

        </td>
    </tr>

    <!-- Chân trang -->
    <tr>
        <td colspan="3" class="chantrang">
            CopyRight&copy; sachhay.com<br>
            Design by TrucMaiPham
        </td>
    </tr>
</table>
</body>
</html>
