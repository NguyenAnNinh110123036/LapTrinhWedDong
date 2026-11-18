<?php
$goc = '../';
$tieuDe = 'BT4 - Tính diện tích';
$trangHienTai = 'bt4';
include_once __DIR__ . '/../includes/functions.php';

$hinh = post('hinh');
$r = post('r'); $day = post('day'); $cao = post('cao'); $dai = post('dai'); $rong = post('rong');
$ketqua = ''; $loi = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hopLe = function () {
        foreach (func_get_args() as $v) {
            if (!is_numeric($v) || $v <= 0) return false;
        }
        return true;
    };
    if ($hinh === 'circle') {
        if ($hopLe($r)) $ketqua = 'Diện tích hình tròn = ' . num(M_PI * $r * $r);
        else $loi = 'Vui lòng nhập bán kính là số lớn hơn 0.';
    } elseif ($hinh === 'triangle') {
        if ($hopLe($day, $cao)) $ketqua = 'Diện tích tam giác = ' . num(0.5 * $day * $cao);
        else $loi = 'Vui lòng nhập đáy và chiều cao là số lớn hơn 0.';
    } elseif ($hinh === 'rectangle') {
        if ($hopLe($dai, $rong)) $ketqua = 'Diện tích hình chữ nhật = ' . num($dai * $rong);
        else $loi = 'Vui lòng nhập dài và rộng là số lớn hơn 0.';
    } else {
        $loi = 'Vui lòng chọn một hình.';
    }
}

include_once __DIR__ . '/../header.php';
?>
<h2>TÍNH DIỆN TÍCH</h2>
<form method="post" action="">
    <table cellpadding="3" style="width: 100%; max-width: 620px;">
        <tr>
            <td style="width: 160px;"><label><input type="radio" name="hinh" value="circle"<?php echo $hinh === 'circle' ? ' checked' : ''; ?>> Hình tròn</label></td>
            <td>Bán kính r: <input type="text" name="r" value="<?php echo e($r); ?>" size="8"></td>
        </tr>
        <tr>
            <td><label><input type="radio" name="hinh" value="triangle"<?php echo $hinh === 'triangle' ? ' checked' : ''; ?>> Tam giác</label></td>
            <td>Đáy: <input type="text" name="day" value="<?php echo e($day); ?>" size="8">
                Chiều cao: <input type="text" name="cao" value="<?php echo e($cao); ?>" size="8"></td>
        </tr>
        <tr>
            <td><label><input type="radio" name="hinh" value="rectangle"<?php echo $hinh === 'rectangle' ? ' checked' : ''; ?>> Chữ nhật</label></td>
            <td>Dài: <input type="text" name="dai" value="<?php echo e($dai); ?>" size="8">
                Rộng: <input type="text" name="rong" value="<?php echo e($rong); ?>" size="8"></td>
        </tr>
    </table>
    <div class="form-actions">
        <input type="submit" value="Tính">
        <a href="bt4.php"><input type="button" value="Làm lại"></a>
    </div>
</form>
<?php if ($loi): ?><div class="error"><?php echo e($loi); ?></div><?php endif; ?>
<?php if ($ketqua): ?><div class="result"><?php echo e($ketqua); ?></div><?php endif; ?>
<?php include_once __DIR__ . '/../footer.php'; ?>
