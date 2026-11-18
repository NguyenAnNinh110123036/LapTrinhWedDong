<?php
// Các hàm dùng chung và logic tính toán của bài tập

// Luôn bật session (dùng cho đăng nhập, thông báo)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Lưu thông báo vào session rồi chuyển trang (thay cho alert + window.location)
function chuyenTrang($url, $noiDung = '', $loai = 'loi')
{
    if ($noiDung !== '') {
        $_SESSION['thongbao'] = array($loai, $noiDung);
    }
    header('Location: ' . $url);
    exit();
}

// Hiển thị thông báo (chỉ hiện 1 lần) - được gọi trong header.php
function hienThongBao()
{
    if (!empty($_SESSION['thongbao'])) {
        list($loai, $nd) = $_SESSION['thongbao'];
        unset($_SESSION['thongbao']);
        echo '<div class="thongbao thongbao-' . ($loai === 'ok' ? 'ok' : 'loi') . '">'
            . htmlspecialchars($nd, ENT_QUOTES, 'UTF-8') . '</div>';
    }
}

function e($s)
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

// Lấy giá trị POST đã trim, nếu không có trả về chuỗi rỗng
function post($key)
{
    return isset($_POST[$key]) ? trim($_POST[$key]) : '';
}

// Định dạng số: bỏ số 0 thừa, tối đa 4 chữ số thập phân
function num($v)
{
    $s = rtrim(rtrim(number_format($v, 4, '.', ''), '0'), '.');
    return ($s === '-0' || $s === '') ? '0' : $s;
}

// BT1
function tinhToan($a, $b, $pt)
{
    switch ($pt) {
        case '+': return num($a + $b);
        case '-': return num($a - $b);
        case '*': return num($a * $b);
        case '/': return $b == 0 ? 'Không thể chia cho 0' : num($a / $b);
        case '%': return $b == 0 ? 'Không thể chia cho 0' : num(fmod($a, $b));
    }
    return 'Phép toán không hợp lệ';
}

// BT2: ax + b = 0
function giaiBac1($a, $b)
{
    if ($a == 0) {
        return $b == 0 ? 'Phương trình có vô số nghiệm' : 'Phương trình vô nghiệm';
    }
    return 'Phương trình có nghiệm x = ' . num(-$b / $a);
}

// BT3: ax^2 + bx + c = 0
function giaiBac2($a, $b, $c)
{
    if ($a == 0) {
        return 'a = 0, đây là phương trình bậc nhất: ' . giaiBac1($b, $c);
    }
    $delta = $b * $b - 4 * $a * $c;
    if ($delta < 0) {
        return 'Phương trình vô nghiệm (Δ = ' . num($delta) . ' < 0)';
    }
    if ($delta == 0) {
        return 'Phương trình có nghiệm kép x1 = x2 = ' . num(-$b / (2 * $a));
    }
    $x1 = (-$b + sqrt($delta)) / (2 * $a);
    $x2 = (-$b - sqrt($delta)) / (2 * $a);
    return 'Phương trình có 2 nghiệm phân biệt: x1 = ' . num($x1) . ', x2 = ' . num($x2);
}

// BT5
function loaiTamGiac($a, $b, $c)
{
    if ($a <= 0 || $b <= 0 || $c <= 0 || $a + $b <= $c || $a + $c <= $b || $b + $c <= $a) {
        return 'Ba cạnh đã nhập KHÔNG tạo thành một tam giác.';
    }
    $eps = 1e-9;
    $s = array($a, $b, $c);
    sort($s);
    $deu   = abs($a - $b) < $eps && abs($b - $c) < $eps;
    $can   = abs($a - $b) < $eps || abs($b - $c) < $eps || abs($a - $c) < $eps;
    $vuong = abs($s[0] * $s[0] + $s[1] * $s[1] - $s[2] * $s[2]) < $eps;

    if ($deu)               $loai = 'tam giác đều';
    elseif ($vuong && $can) $loai = 'tam giác vuông cân';
    elseif ($vuong)         $loai = 'tam giác vuông';
    elseif ($can)           $loai = 'tam giác cân';
    else                    $loai = 'tam giác thường';

    return 'Ba cạnh đã nhập tạo thành một ' . $loai . '.';
}

// BT6
function soNgayTrongThang($thang)
{
    if ($thang < 1 || $thang > 12) {
        return 'Không có tháng này.';
    }
    if ($thang == 2) {
        $ngay = '28 hoặc 29';
    } elseif (in_array($thang, array(4, 6, 9, 11))) {
        $ngay = '30';
    } else {
        $ngay = '31';
    }
    return 'Tháng ' . $thang . ' có ' . $ngay . ' ngày.';
}

// BT9
function laSoNguyenTo($n)
{
    if ($n < 2) {
        return false;
    }
    for ($i = 2; $i * $i <= $n; $i++) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

// Bảng cửu chương của số $n (dùng cho BT7, BT8)
function bangCuuChuong($n)
{
    $html = '<table class="cuuchuong"><tr><th>Bảng ' . $n . '</th></tr>';
    for ($j = 1; $j <= 10; $j++) {
        $html .= '<tr><td>' . $n . ' x ' . $j . ' = ' . ($n * $j) . '</td></tr>';
    }
    return $html . '</table>';
}
