<?php
$goc = '../';
$tieuDe = 'BT9 - Số nguyên tố';
$trangHienTai = 'bt9';
include_once __DIR__ . '/../includes/functions.php';

$n = post('n');
$ketqua = ''; $loi = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!preg_match('/^-?\d+$/', $n)) {
        $loi = 'Vui lòng nhập một số nguyên.';
    } else {
        $ketqua = (int)$n . (laSoNguyenTo((int)$n) ? ' là số nguyên tố.' : ' không phải là số nguyên tố.');
    }
}

include_once __DIR__ . '/../header.php';
?>
<h2>KIỂM TRA SỐ NGUYÊN TỐ</h2>
<form method="post" action="">
    Nhập số: <input type="text" name="n" value="<?php echo e($n); ?>">
    <input type="submit" value="Kiểm tra">
</form>
<?php if ($loi): ?><div class="error"><?php echo e($loi); ?></div><?php endif; ?>
<?php if ($ketqua): ?><div class="result"><?php echo e($ketqua); ?></div><?php endif; ?>
<?php include_once __DIR__ . '/../footer.php'; ?>
