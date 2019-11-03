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

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/new/bootstrap.css">
  <link href="css/datadiri.css" rel="stylesheet">

  <!-- <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Custom styles for this template -->
    <!-- <link href="css/shop-homepage.css" rel="stylesheet"> -->
    <!-- <link href="bikin.css" rel="stylesheet"> -->
    
<header><h1>KPU</h1></header>
</head>
<body>
  <br>
<!-- Ambil data dari link -->
  <?php 

  $idambil = $_GET["id"];
  $idlink = explode('?', $idambil, 4);
  $iddprri = $idlink[0];
  $idpartai = $idlink[1];
  $idpresiden = $idlink[2];
  $idpemilih = $idlink[3];
  $idtempat = $_SESSION['admin']["id_tps"];
  $idadmin = $_SESSION['admin']["id_admin"];
  $count = 1;

  // $idtempat_kirim = (int)$idtempat;

  

  ?>
<!-- Tutup Ambil data dari link -->

<!-- Kaitkan ke Presiden -->
<?php

$ambilpresiden = $koneksi->query("SELECT * FROM capres_cawapres WHERE id_calon = '$idpresiden'");
$pecahpresiden =  $ambilpresiden->fetch_assoc();

?>
<!-- Tutup Kaitan -->

<!-- Kaitkan ke Partai -->
<?php

$ambilpartai = $koneksi->query("SELECT * FROM partai_dpr_ri WHERE id_partai = '$idpartai'");
$pecahpartai = $ambilpartai->fetch_assoc();

?>
<!-- Tutup Kaitan -->

<!-- Kaitkan ke DPRRI -->
<?php

$ambildprri = $koneksi->query("SELECT * FROM calon_dprri WHERE id_dprri = '$iddprri'");
$pecahdprri = $ambildprri->fetch_assoc();

?>
<!-- Tutup Kaitan -->

<?php


?>

<section>
  <div>
  <br>
  <h1>Daftar Pilihan Anda<br>Jika Sudah Benar Silahkan Tekan Tombol OK dibagian Bawah<br>Jika Ada yang Salah Silahkan Tekan Tombol Kembali</h1>
  <br>
  </div>
  <!-- <article> -->


<div class="feature_inner row justify-content-center">
  <div class="col-lg-3 col-md-6">
    <div class="feature_item">
      <h1>Presiden dan Wakil Presiden Pilihan Anda</h1><br>
      <img src="images/<?php echo $pecahpresiden['foto']?>.jpg" width="50%" alt="">
      <h1><?php echo $pecahpresiden['nama_pasangan']?></h1>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="feature_item">
      <h1>Partai Pilihan Anda</h1><br>
      <img src="images/partai<?php echo $pecahpartai['no_urut'] ?>.jpg" width="50%" alt=""><br>
      <br>
      <h1>Anggota DPRRI Pilihan Anda</h1>
      <br>
      <h1><?php echo $pecahdprri['nama_dprri']; ?></h1>
      <!-- <p>Silahkan kalau mau nambahin penjelasan.</p> -->
    </div>
  </div>
  <!-- </article> -->
</section>
<form method="post">
<div>
<br>
<a href="dprri.php?id=<?php echo $idpartai?>?<?php echo $idpresiden?>?<?php echo $idpemilih?>" class="btn btn-danger" name="kembali">Kembali</a>
<button class="btn btn-primary" name="save" id="save">OK</button>
</div>




<!-- 0ZFER5MXT6I2JE3D -- Data Coba --> 
<!-- S0V5AS7ZUXWC7INS -->
<!-- fungsi kirim data -->
<script type="text/javascript">
function KirimData(){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200){
      ready:
      var peroleh_data = JSON.parse(xhr.responseText);
      console.log(peroleh_data);
      var id_tps = peroleh_data.idtempat;
      var id_pres = peroleh_data.idpresiden;
      var id_partai = peroleh_data.idpartai;
      var id_dprri = peroleh_data.iddprri;
      var hitung_hasil = peroleh_data.hitung;
      var id_admin = peroleh_data.idadmin;
      var id_vot = peroleh_data.idvot;

      xhr1 = new XMLHttpRequest();
      xhr1.open("POST", "https://api.thingspeak.com/update?api_key=S0V5AS7ZUXWC7INS&field1="+id_tps, true);
      xhr1.send();

      xhr2 = new XMLHttpRequest();
      xhr2.open("POST", "https://api.thingspeak.com/update?api_key=S0V5AS7ZUXWC7INS&field2="+id_pres, true);
      xhr2.send();

      xhr3 = new XMLHttpRequest();
      xhr3.open("POST", "https://api.thingspeak.com/update?api_key=S0V5AS7ZUXWC7INS&field3="+id_partai, true);
      xhr3.send();

      xhr4 = new XMLHttpRequest();
      xhr4.open("POST", "https://api.thingspeak.com/update?api_key=S0V5AS7ZUXWC7INS&field4="+id_dprri, true);
      xhr4.send();

      xhr5 = new XMLHttpRequest();
      xhr5.open("POST", "https://api.thingspeak.com/update?api_key=S0V5AS7ZUXWC7INS&field5="+hitung_hasil, true);
      xhr5.send();

      xhr6 = new XMLHttpRequest();
      xhr6.open("POST", "https://api.thingspeak.com/update?api_key=S0V5AS7ZUXWC7INS&field6="+id_admin, true);
      xhr6.send();

      xhr7 = new XMLHttpRequest();
      xhr7.open("POST", "https://api.thingspeak.com/update?api_key=S0V5AS7ZUXWC7INS&field7="+id_vot, true);
      xhr7.send();
    }
  };
  xhr.open("GET", "apijson.json", true);
  xhr.send();
}
</script>

<!-- close fungsi kirim data -->

</form>

<!-- send database dan kirim data -->
<?php
if (isset($_POST['save'])) {

  $status = "sudah digunakan";

  $koneksi->query("UPDATE data_pemilih SET hak_pilih = '$status' WHERE id_tag = '$idpemilih' ");
  // ambil data dari thingspeak
  // 878688 -- Data Coba
  // 879580
  $urlOnline = 'https://api.thingspeak.com/channels/879580/feeds.json'; 
  $json = file_get_contents($urlOnline);
  $data_json = json_decode($json, true);

  $feeds = $data_json['feeds'];
  $count = 0;
  for ($q = 0; $q < count($feeds); $q++){
    $idtempatTS = $feeds[$q]['field1'];
    $idpresidenTS = $feeds[$q]['field2'];
    $idpartaiTS = $feeds[$q]['field3'];
    $iddprriTS = $feeds[$q]['field4'];
    $hitungTS = $feeds[$q]['field5'];
    $idadminTS = $feeds[$q]['field6'];
    $idvotTS = $feeds[$q]['field7'];

  // close ambil data dari thingspeak

  // insert data dari thingspeak ke database

    $simpanData = sprintf("INSERT INTO hasil_vot VALUES (id_vot, id_tps, id_calon, id_partai, id_dprri, hitung, id_admin)",$idvotTS, $idtempatTS, $idpresidenTS, $idpartaiTS, $iddprriTS, $hitungTS, $idadminTS);
    mysqli_query($connect, $simpanData);

  // $koneksi->query("INSERT INTO hasil_vot(id_vot, id_tps, id_calon, id_partai, id_dprri, hitung, id_admin)
  // VALUES('$idvot','$idtempat','$idpresiden','$idpartai','$iddprri','$count','$idadmin')");

  // close insert data dari thingspeak ke database
  }

  $hitungidvot = 0;
  $ambilidvot = $koneksi->query("SELECT * FROM hasil_vot WHERE hitung = 1");
  while ( $pecahidvot = $ambilidvot->fetch_assoc()) {
    $hitungidvot++;
  }
  $idvot = $hitungidvot+1;

  $dapat_data = array(
    "idtempat" => $idtempat,
    "idpresiden" => $idpresiden,
    "idpartai" => $idpartai,
    "iddprri" => $iddprri,
    "hitung" => 1,
    "idadmin" => $idadmin,
    "idvot" => $idvot
  );

  $json_dapat_data = json_encode($dapat_data);
  file_put_contents('apijson.json', $json_dapat_data);


  $koneksi->query("INSERT INTO hasil_vot(id_vot, id_tps, id_calon, id_partai, id_dprri, hitung, id_admin)
  VALUES('$idvot','$idtempat','$idpresiden','$idpartai','$iddprri','$count','$idadmin')");

  echo "<script> KirimData(); </script>";
  echo "<div class='alert alert alert-info'>Data tersimpan</div>";
  echo "<meta http-equiv='refresh' content='1;url=autentikasiktp.php'>";
  
}
?>
<!-- close send -->

</body>
</html>