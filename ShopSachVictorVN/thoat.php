<?php
// Bài 6 + Bài 15 (gộp): thoát khỏi hệ thống (thành viên hoặc quản trị)
include_once __DIR__ . '/includes/functions.php';
$laQuanTri = isset($_SESSION['nguoiquantri']);
unset($_SESSION['nguoidung'], $_SESSION['nguoiquantri']);
chuyenTrang('index.php', $laQuanTri ? 'Bạn đã thoát ra khỏi hệ thống quản trị' : 'Bạn đã thoát ra khỏi hệ thống!', 'ok');
