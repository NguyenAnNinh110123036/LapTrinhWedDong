<?php
include_once __DIR__ . '/includes/functions.php';
if (!isset($goc))          $goc = '';
if (!isset($tieuDe))       $tieuDe = 'Trang chủ';
if (!isset($trangHienTai)) $trangHienTai = 'home';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($tieuDe); ?> - Cùng bạn đi tìm tri thức</title>
    <link rel="stylesheet" href="<?php echo $goc; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $goc; ?>css/baitap.css">
</head>
<body>
<table class="trang" border="1" cellspacing="0">

    <!-- Banner -->
    <tr>
        <td colspan="3"><img src="<?php echo $goc; ?>hinhanh/sachhay_new1.gif" alt="Banner"></td>
    </tr>

    <!-- Thanh trên: Trang chủ + dòng chữ chạy -->
    <tr>
        <td colspan="3">
            <table class="thanh-tren" border="0" width="100%">
                <tr>
                    <td width="80"><a href="<?php echo $goc; ?>index.php">Trang chủ</a></td>
                    <td><marquee><font color="orange">Cùng bạn đi tìm tri thức!</font></marquee></td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Ba cột: menu trái | khung bài tập | đăng nhập -->
    <tr height="400">
        <td width="200" valign="top">
            <?php include_once __DIR__ . '/includes/menu.php'; ?>
        </td>
        <td valign="top" class="khung-baitap">
<?php hienThongBao(); ?>
<!-- ===== Hết header: bên dưới là nội dung trang ===== -->
