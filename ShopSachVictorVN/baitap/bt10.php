<?php
$goc = '../';
$tieuDe = 'BT10 - Tổng các số chẵn ≤ N';
$trangHienTai = 'bt10';
include_once __DIR__ . '/../header.php';
?>
<div class="n13">
<div class="container">
    <h2>Tính tổng các số chẵn nhỏ hơn hoặc bằng N</h2>

    <form method="post" action="">
        <label for="n">Nhập số nguyên dương N:</label>
        <input id="n" type="number" name="n" min="1" required>
        <button type="submit">Tính</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $N = (int) $_POST['n'];

    if ($N <= 0) {
        echo '<p class="error">Nhập số nguyên dương!</p>';
    } else {
        $tong = 0;
        for ($i = 2; $i <= $N; $i += 2) {
            $tong += $i;
        }
        echo "<p class=\"result\">Tổng các số chẵn nhỏ hơn hoặc bằng $N là: <strong>$tong</strong></p>";
    }
}
?>

</div>
</div>
<?php include_once __DIR__ . '/../footer.php'; ?>
