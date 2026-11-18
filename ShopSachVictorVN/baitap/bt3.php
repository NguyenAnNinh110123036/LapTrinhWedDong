<?php
$goc = '../';
$tieuDe = 'BT3 - Giải PT bậc II một ẩn';
$trangHienTai = 'bt3';
include_once __DIR__ . '/../includes/functions.php';

$a = post('a'); $b = post('b'); $c = post('c');
$ketqua = ''; $loi = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
        $loi = 'Vui lòng nhập a, b, c là số.';
    } else {
        $ketqua = giaiBac2((float)$a, (float)$b, (float)$c);
    }
}

include_once __DIR__ . '/../header.php';
?>
<h2>GIẢI PHƯƠNG TRÌNH BẬC 2: ax<sup>2</sup> + bx + c = 0</h2>
<form method="post" action="">
    <table cellpadding="3" style="width: 100%; max-width: 420px;">
        <tr>
            <td style="width: 110px;">Nhập a:</td>
            <td><input type="text" name="a" value="<?php echo e($a); ?>"></td>
        </tr>
        <tr>
            <td>Nhập b:</td>
            <td><input type="text" name="b" value="<?php echo e($b); ?>"></td>
        </tr>
        <tr>
            <td>Nhập c:</td>
            <td><input type="text" name="c" value="<?php echo e($c); ?>"></td>
        </tr>
    </table>
    <div class="form-actions">
        <input type="submit" value="Giải">
        <a href="bt3.php"><input type="button" value="Làm lại"></a>
    </div>
</form>
<?php if ($loi): ?><div class="error"><?php echo e($loi); ?></div><?php endif; ?>
<?php if ($ketqua): ?><div class="result"><?php echo e($ketqua); ?></div><?php endif; ?>
<?php include_once __DIR__ . '/../footer.php'; ?>
