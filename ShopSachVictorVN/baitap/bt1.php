<?php
$goc = '../';
$tieuDe = 'BT1 - Máy tính';
$trangHienTai = 'bt1';
include_once __DIR__ . '/../includes/functions.php';

$a = post('a'); $b = post('b');
$ketqua = ''; $loi = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!is_numeric($a) || !is_numeric($b)) {
        $loi = 'Vui lòng nhập a và b là số.';
    } else {
        $ketqua = tinhToan((float)$a, (float)$b, post('pheptoan'));
    }
}

include_once __DIR__ . '/../header.php';
?>
<h1 class="title">Chương trình máy tính</h1>
<form method="post" action="">
    <table class="form">
        <tr><td class="label">Nhập a:</td><td><input type="text" name="a" value="<?php echo e($a); ?>"></td></tr>
        <tr><td class="label">Nhập b:</td><td><input type="text" name="b" value="<?php echo e($b); ?>"></td></tr>
        <tr>
            <td colspan="2" style="text-align:center">
                <fieldset>
                    <legend style="text-align:left">Chọn phép toán</legend>
                    <button type="submit" name="pheptoan" value="+">+</button>
                    <button type="submit" name="pheptoan" value="-">-</button>
                    <button type="submit" name="pheptoan" value="*">*</button>
                    <button type="submit" name="pheptoan" value="/">/</button>
                    <button type="submit" name="pheptoan" value="%">%</button>
                </fieldset>
            </td>
        </tr>
        <tr><td class="label">Kết quả:</td><td><strong><?php echo e($ketqua); ?></strong></td></tr>
    </table>
    <?php if ($loi): ?><div class="error" style="width:90%;margin:6px auto"><?php echo e($loi); ?></div><?php endif; ?>
</form>
<?php include_once __DIR__ . '/../footer.php'; ?>
