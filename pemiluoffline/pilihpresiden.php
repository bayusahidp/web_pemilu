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
<header><h1>KPU - Presiden dan Wakil Presiden</h1></header>
</head>
<body>
  <br>

<section>
  <br>
  <h1>Tekan Salah Satu Gambar Presiden dan Wakil Presiden<br>Pilihan Anda</h1>
  <br>
  <!-- <article> -->

<?php
$idpemilih = $_GET["id"];
$_SESSION['pm'] = $idpemilih;

$ambil = $koneksi->query("SELECT * FROM capres_cawapres");
$pecah = $ambil->fetch_assoc();
?>

<div class="feature_inner row justify-content-center">
  <div class="col-lg-3 col-md-6">
    <div class="feature_item">
      <h1>Calon Pasangan No 1</h1><br>
      <a href="partai.php?id=1?<?php echo $idpemilih?>"><img src="images/paslon01.jpg" width="60%" alt=""></a>
      <!-- <p>Silahkan kalau mau nambahin penjelasan.</p> -->
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="feature_item">
      <h1>Calon Pasangan No 2</h1><br>
      <a href="partai.php?id=2?<?php echo $idpemilih?>"><img src="images/paslon02.jpg" width="60%" alt=""></a>
      <!-- <p>Silahkan kalau mau nambahin penjelasan.</p> -->
    </div>
  </div>

    <!-- <table style="width:800px">
  <tr>
    <th><img src="images/fotobayu.jpg" width="50%"></th>
    <td><img src="images/fotobayu.jpg" width="50%"></td>
  </tr>
</table> -->
  <!-- </article> -->
</section>


<div>
<br><button class="btn btn-primary" name="lanjut">Lanjut</button>
</div>

</body>
</html>