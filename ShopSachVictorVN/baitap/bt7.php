<?php
$goc = '../';
$tieuDe = 'BT7 - Bảng cửu chương';
$trangHienTai = 'bt7';
include_once __DIR__ . '/../includes/functions.php';
include_once __DIR__ . '/../header.php';
?>
<h2>BẢNG CỬU CHƯƠNG</h2>
<div class="bang-cuuchuong-wrap">
    <?php
    for ($i = 2; $i <= 10; $i++) {
        echo bangCuuChuong($i);
    }
    ?>
</div>
<?php include_once __DIR__ . '/../footer.php'; ?>
