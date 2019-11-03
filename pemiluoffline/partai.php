<?php 
session_start();
include 'koneksi.php';
if (!isset($_SESSION['admin']))
{
    //echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/new/bootstrap.css">
  <link href="css/datadiri.css" rel="stylesheet">
<header><h1>KPU - Partai</h1></header>
</head>
<body>
  <br>

<section>
  <!-- mecah id link -->
  <?php 

  $idp = $_GET["id"];
  $idlink = explode('?', $idp, 2);
  $idpresiden = $idlink[0];
  $idpemilih = $idlink[1];

  ?>

  <br>
<h1>Silahkan Pilih Partai Pilihan Anda<br>Tekan Gambar Partai untuk Memilih Partai Pilihan Anda</h1>
<br>
  <!-- <article> -->
    <table style="width:1200px">
  <tr>
    <td><a href="dprri.php?id=1?<?php echo $idp?>"><img src="images/partai1.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=2?<?php echo $idp?>"><img src="images/partai2.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=3?<?php echo $idp?>"><img src="images/partai3.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=4?<?php echo $idp?>"><img src="images/partai4.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=5?<?php echo $idp?>"><img src="images/partai5.jpg" width="50%"></a></td>
  </tr>
  <tr>
    <td><a href="dprri.php?id=6?<?php echo $idp?>"><img src="images/partai6.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=7?<?php echo $idp?>"><img src="images/partai7.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=8?<?php echo $idp?>"><img src="images/partai8.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=9?<?php echo $idp?>"><img src="images/partai9.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=10?<?php echo $idp?>"><img src="images/partai10.jpg" width="50%"></a></td>
  </tr>
  <tr>
    <td><a href="dprri.php?id=11?<?php echo $idp?>"><img src="images/partai11.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=12?<?php echo $idp?>"><img src="images/partai12.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=13?<?php echo $idp?>"><img src="images/partai13.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=14?<?php echo $idp?>"><img src="images/partai14.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=15?<?php echo $idp?>"><img src="images/partai15.jpg" width="50%"></a></td>
  </tr>
  <tr>
    <td><a href="dprri.php?id=16?<?php echo $idp?>"><img src="images/partai16.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=17?<?php echo $idp?>"><img src="images/partai17.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=18?<?php echo $idp?>"><img src="images/partai18.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=19?<?php echo $idp?>"><img src="images/partai19.jpg" width="50%"></a></td>
    <td><a href="dprri.php?id=20?<?php echo $idp?>"><img src="images/partai20.jpg" width="50%"></a></td>
  </tr>
</table>
  <!-- </article> -->
</section>

<section style="margin-left: 80px">
  <br><a href="pilihpresiden.php?id=<?php echo $idpemilih?>" class="btn btn-primary">Kembali</a>
</section>

</body>
</html>