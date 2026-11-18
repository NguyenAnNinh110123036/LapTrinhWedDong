<?php
include_once __DIR__ . '/functions.php';
// Menu trái. Cần có $goc và $trangHienTai (khai báo ở trang gọi header.php).
$dsBaiTap = array(
    'bt1'  => 'BT1 - Máy tính',
    'bt2'  => 'BT2 - Số tròn chục, trăm, ngàn',
    'bt3'  => 'BT3 - Giải PT bậc II một ẩn',
    'bt4'  => 'BT4 - Tính diện tích',
    'bt5'  => 'BT5 - Tam giác',
    'bt6'  => 'BT6 - Số ngày trong tháng',
    'bt7'  => 'BT7 - Bảng cửu chương',
    'bt8'  => 'BT8 - Bảng cửu chương NC',
    'bt9'  => 'BT9 - Số nguyên tố',
    'bt10' => 'BT10 - Tổng các số chẵn ≤ N',
);

$dsMySQL = array(
    'dangky'  => 'Đăng ký thành viên',
    'quantri' => 'Quản trị',
);
?>
<table class="menu-trai" cellspacing="0" cellpadding="0">
    <tr><th><font color="orange">Bài tập PHP căn bản</font></th></tr>
    <?php foreach ($dsBaiTap as $key => $ten): ?>
        <tr><td<?php echo $trangHienTai === $key ? ' class="dang-chon"' : ''; ?>><a href="<?php echo $goc; ?>baitap/<?php echo $key; ?>.php"><?php echo e($ten); ?></a></td></tr>
    <?php endforeach; ?>
    <tr><th><font color="orange">Bài tập PHP-MySQL</font></th></tr>
    <?php foreach ($dsMySQL as $key => $ten): ?>
        <tr><td<?php echo $trangHienTai === $key ? ' class="dang-chon"' : ''; ?>><a href="<?php echo $goc; ?>baitap/<?php echo $key; ?>.php"><?php echo e($ten); ?></a></td></tr>
    <?php endforeach; ?>
</table>
