<?php
$kn=mysqli_connect("localhost","root","") or die ("Không thể kết nối đến server".mysqli_connect_error());
$csdl=mysqli_select_db($kn,"online_shop") or die ("Không thể chọn được được csdl online_shop". mysqli_error($kn));
mysqli_query($kn,"SET NAMES 'utf8'");
?>
