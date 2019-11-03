<?php
session_start();
//koneksi ke database dengan mysqli
include 'koneksi.php';
if (!isset($_SESSION['admin']))
{
    //echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
$ambil=$koneksi->query("SELECT * FROM calon_dprri");
$pecah=$ambil->fetch_assoc();

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/new/bootstrap.css">
  <link href="css/datadiri.css" rel="stylesheet">
<header><h1>KPU - DPRRI</h1></header>
</head>
<body>
  <br>

<h1>Silahkan Pilih Nama DPRRI Pilihan Anda<br>Tekan Tombol Sebelah Nama DPRRI untuk Memilih Anggota DPRRI Pilihan Anda</h1>
<br>

<section>
  <?php 

  $idp = $_GET["id"];
  $idlink = explode('?', $idp, 3);
  $idpartai = $idlink[0];
  $idpresiden = $idlink[1];
  $idpemilih = $idlink[2];

  // cari kota asal pemilih

  $ambilpemilih = $koneksi->query("SELECT * FROM data_pemilih WHERE id_tag = '$idpemilih'");
  $pecahpemilih = $ambilpemilih->fetch_assoc();

  // akhir pencarian

  // paduan kota pemilih dengan daftar calon dprri

  $ambildaerah = $koneksi->query("SELECT * FROM daerah_dprri WHERE daerah_kota = '$pecahpemilih[kota]'");
  $pecahdaerah = $ambildaerah->fetch_assoc();

  // akhir paduan

  ?>

  
  <!-- <article> -->
    <table style="width:800px">
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Aksi</th>
  </tr>
  <?php
  $nomor = 1;
  $ambilc = $koneksi->query("SELECT * FROM calon_dprri WHERE id_partai = '$idpartai' and nama_daerah = '$pecahdaerah[nama_daerah]'");?>
  <?php while($pecahc = $ambilc->fetch_assoc()){
  ?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $pecahc['nama_dprri']; ?></td>
    <td><a href="daftarpilihan.php?id=<?php echo $pecahc['id_dprri']?>?<?php echo $idp ?>" class="btn btn-primary">Pilih</td>
  </tr>
  <?php $nomor++; ?>
  <?php } ?>
</table>
  <!-- </article> -->
</section>


<div>
<br><a href="partai.php?id=<?php echo $idpresiden?>?<?php echo $idpemilih ?>" class="btn btn-primary">Kembali</a>
</div>

</body>
</html>