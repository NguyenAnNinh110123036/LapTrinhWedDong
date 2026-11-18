<?php
$goc = '../';
$tieuDe = 'BT6 - Số ngày trong tháng';
$trangHienTai = 'bt6';
include_once __DIR__ . '/../includes/functions.php';

$thang = post('thang');
$ketqua = ''; $loi = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!preg_match('/^-?\d+$/', $thang)) {
        $loi = 'Tháng phải là số nguyên.';
    } else {
        $ketqua = soNgayTrongThang((int)$thang);
    }
}

include_once __DIR__ . '/../header.php';
?>
<h2>SỐ NGÀY TRONG THÁNG</h2>
<form method="post" action="">
    Nhập tháng: <input type="text" name="thang" value="<?php echo e($thang); ?>">
    <input type="submit" value="Xem">
</form>
<?php if ($loi): ?><div class="error"><?php echo e($loi); ?></div><?php endif; ?>
<?php if ($ketqua): ?><div class="result"><?php echo e($ketqua); ?></div><?php endif; ?>
<?php include_once __DIR__ . '/../footer.php'; ?>
