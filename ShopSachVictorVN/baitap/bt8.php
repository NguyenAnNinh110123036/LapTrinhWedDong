<?php
$goc = '../';
$tieuDe = 'BT8 - Bảng cửu chương NC';
$trangHienTai = 'bt8';
include_once __DIR__ . '/../includes/functions.php';

$n = post('n');
$loi = ''; $hienBang = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!preg_match('/^\d+$/', $n) || (int)$n < 1 || (int)$n > 10) {
        $loi = 'Vui lòng nhập số nguyên dương từ 1 đến 10.';
    } else {
        $hienBang = true;
    }
}

include_once __DIR__ . '/../header.php';
?>
<h2>BẢNG CỬU CHƯƠNG NÂNG CAO</h2>
<form method="post" action="">
    Nhập số nguyên dương (&le; 10): <input type="text" name="n" value="<?php echo e($n); ?>" size="6">
    <input type="submit" value="Xem">
</form>
<?php if ($loi): ?><div class="error"><?php echo e($loi); ?></div><?php endif; ?>
<?php if ($hienBang) echo bangCuuChuong((int)$n); ?>
<?php include_once __DIR__ . '/../footer.php'; ?>
