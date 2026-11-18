<?php
$goc = '../';
$tieuDe = 'BT2 - Số tròn chục, trăm, ngàn';
$trangHienTai = 'bt2';
include_once __DIR__ . '/../header.php';
?>
<h2>SỐ TRÒN CHỤC, TRÒN TRĂM, TRÒN NGÀN</h2>
<form name="frmNhap" action="" method="post">
    <table align="center">
        <tr>
            <td>Nhập số n: </td>
            <td><input type="number" name="txtNhap"></td>
        </tr>
        <tr>
            <td><input type="submit" name="sbmXem" value="Xem KQ" /></td>
            <td><input type="reset" name="rsHuy" value="Hủy bỏ" /></td>
        </tr>
    </table>
</form>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div class="result">
        <?php include_once __DIR__ . '/bt2_alg.php'; ?>
    </div>
<?php endif; ?>
<?php include_once __DIR__ . '/../footer.php'; ?>
