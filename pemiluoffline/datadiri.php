<?php 
session_start();
include 'koneksi.php';
 

$ambil=$koneksi->query("SELECT * FROM data_pemilih");
if (!isset($_SESSION['admin']))
{
    //echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
// $idpemilih = $_GET["id"];

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/new/bootstrap.css">
<!-- <link rel="stylesheet" href="css/new/style.css">
        <link rel="stylesheet" href="css/new/responsive.css">  -->
<link href="css/datadiri.css" rel="stylesheet">
<header><h1>Data Diri</h1></header>
</head>
<body>
<br>

<section>
  <!-- <article> -->
    <!-- <?php print_r($_SESSION['auktp']) ?> -->
  <table style="width:1000px">
  <tr>
    <th rowspan="7" style="width: 20%"><img src="images/<?php echo $_SESSION['auktp']["foto"] ?>.jpg" width="100%"></th>
    <td style="width: 20%">Nama</td>
    <td>: <?php echo $_SESSION['auktp']["nama_lengkap"];?></td>
  </tr>
  <tr>
    <td>Tempat & Tgl Lahir</td>
    <td>: <?php echo $_SESSION['auktp']["tempat_lahir"];?>, <?php echo $_SESSION['auktp']["tgl_lahir"];?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>: <?php echo $_SESSION['auktp']["alamat"];?></td>
  </tr>
  <tr>
    <td>RT/RW</td>
    <td>: <?php echo $_SESSION['auktp']["rt"];?>/<?php echo $_SESSION['auktp']["rw"];?></td>
  </tr>
  <tr>
    <td>Kota</td>
    <td>: <?php echo $_SESSION['auktp']["kota"];?></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td>: <?php echo $_SESSION['auktp']["kecamatan"];?></td>
  </tr>
  <tr>
    <td>Kelurahan</td>
    <td>: <?php echo $_SESSION['auktp']["kelurahan"];?></td>
  </tr>
</table>
  <!-- </article> -->
</section>
<br>
<h1>Jika data diri anda sudah benar silahkan tekan<br>tombol lanjut di bawah ini. Jika salah<br>silahan lapor ke petugas</h1>

<div>
<br>
<a href="pilihpresiden.php?id=<?php echo $_SESSION['auktp']['id_tag'] ?>" class="btn btn-success">Lanjut</a>


</div>

</body>
</html>