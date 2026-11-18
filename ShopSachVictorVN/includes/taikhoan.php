<?php
// Hàm dùng cho phần PHP-MySQL (đăng ký, đăng nhập, quản trị)

const THU_MUC_ANH = 'hinhanh/avatar/';       // thư mục lưu ảnh đại diện (tính từ thư mục gốc web)
const DUNG_LUONG_ANH_TOI_DA = 2097152;        // 2MB

function dsQuocGia()
{
    return array('vn' => 'Việt Nam', 'cn' => 'China', 'jp' => 'Japan', 'k' => 'Khác');
}

function tenQuocGia($ma)
{
    $ds = dsQuocGia();
    return isset($ds[$ma]) ? $ds[$ma] : $ma;
}

function laAdmin()     { return isset($_SESSION['nguoiquantri']); }
function laThanhVien() { return isset($_SESSION['nguoidung']); }

// Bắt buộc là quản trị, nếu không thì quay về trang chủ
function yeuCauAdmin($goc = '')
{
    if (!laAdmin()) {
        chuyenTrang($goc . 'index.php', 'Bạn không có quyền trên trang này!');
    }
}

/*
 * Lưu ảnh đại diện lên server với TÊN MỚI NGẪU NHIÊN (không bao giờ trùng).
 * Tên mới = thời gian + chuỗi ngẫu nhiên 16 ký tự + đuôi file, ví dụ: 20261118093015_9f3a1c7be2d84a10.jpg
 * Trả về: đường dẫn lưu vào CSDL | '' nếu không chọn ảnh | false nếu lỗi (nội dung lỗi ở $loi)
 */
function luuAnhDaiDien($file, &$loi)
{
    $loi = '';
    if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return '';
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $loi = 'Không tải được ảnh lên (mã lỗi ' . $file['error'] . ').';
        return false;
    }
    if ($file['size'] > DUNG_LUONG_ANH_TOI_DA) {
        $loi = 'Ảnh quá lớn, tối đa 2MB.';
        return false;
    }
    // Kiểm tra đúng là file ảnh thật (không tin vào đuôi file người dùng gửi)
    $info = @getimagesize($file['tmp_name']);
    $cho_phep = array('image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp');
    if ($info === false || !isset($cho_phep[$info['mime']])) {
        $loi = 'File tải lên phải là ảnh JPG, PNG, GIF hoặc WEBP.';
        return false;
    }

    $thuMuc = __DIR__ . '/../' . THU_MUC_ANH;
    if (!is_dir($thuMuc)) {
        mkdir($thuMuc, 0755, true);
    }
    do {
        $tenMoi = date('YmdHis') . '_' . bin2hex(random_bytes(8)) . '.' . $cho_phep[$info['mime']];
    } while (file_exists($thuMuc . $tenMoi));

    if (!move_uploaded_file($file['tmp_name'], $thuMuc . $tenMoi)) {
        $loi = 'Không lưu được ảnh vào thư mục ' . THU_MUC_ANH;
        return false;
    }
    return THU_MUC_ANH . $tenMoi;
}

// Xóa file ảnh cũ (chỉ xóa file nằm trong thư mục avatar cho an toàn)
function xoaAnhDaiDien($duongDan)
{
    if ($duongDan !== '' && strpos($duongDan, THU_MUC_ANH) === 0 && basename($duongDan) !== '') {
        $f = __DIR__ . '/../' . THU_MUC_ANH . basename($duongDan);
        if (is_file($f)) {
            unlink($f);
        }
    }
}

// Thẻ <img> hiển thị ảnh đại diện (hoặc chữ nếu chưa có ảnh)
function hienAnh($duongDan, $goc, $lop = 'avatar')
{
    if ($duongDan === '' || $duongDan === null) {
        return '<em>Chưa có ảnh</em>';
    }
    return '<img class="' . $lop . '" src="' . e($goc . $duongDan) . '" alt="Ảnh đại diện">';
}
