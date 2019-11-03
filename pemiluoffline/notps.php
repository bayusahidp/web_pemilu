<?php 
session_start();
//koneksi ke database dengan mysqli
include 'koneksi.php';

$ambil=$koneksi->query("SELECT * FROM data_tps");
$pecah=$ambil->fetch_assoc();


if (!isset($_SESSION['admin']))
{
    //echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pemilu 2024</title>
    <!-- Bootstrap core CSS -->
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="bikin.css" rel="stylesheet">
</head>
<body>


<section class="main_title" id="">
    <div class="container">
       <div class="main_title">
            <h2>Masukkan Data Lokasi<br>Tempat Pemilihan<br/></h2>
            <br>
        </div>
    </div>
</section>


<section class="main_title">
    <div class="container">
        <form method="post">
        <h4>No TPS</h4>
    		<div class="row">
    				<div class="col-md-12">
    					<select class="form-control" name="idtps4">
    						<option value="">Pilih No TPS</option>
    						<?php 
    						$ambil = $koneksi->query("SELECT * FROM data_tps");
                            while($datakota = $ambil->fetch_assoc()){
                            ?>
    						<option required value="<?php echo $datakota["id_tps"] ?>">
    							<?php echo $datakota['no_tps'] ?> 
    						</option>
    					<?php } ?>
    					</select>
    				</div>
    		</div>
        

    		<br><button class="btn btn-primary" name="masuk">Masuk</button>
    	</form>
        <?php 
                if (isset($_POST['masuk']))
                {
                    $ambil = $koneksi->query("SELECT * FROM data_tps WHERE kota_tps = '$_POST[kota_tps]' AND kecamatan_tps = '$_POST[kecamatan_tps]' AND kelurahan_tps = '$_POST[kelurahan_tps]' AND no_tps = '$_POST[no_tps]'");
                    $yangcocok = $ambil->num_rows; //mencari akun yang cocok
                    if ($yangcocok==1)
                    {
                        $_SESSION['konfig'] = $ambil->fetch_assoc();
                        echo "<div class='alert alert-info'>Berhasil</div>";
                        echo "<meta http-equiv='refresh' content='1;url=index.php?id=echo $pecah['id_pemilih']'>";
                    }
                    else
                    {
                        echo "<div class='alert alert-danger'>Data tidak sesuai</div>";
                        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                    }
                }

                 ?>
    </div>
</section>
</body>
</html>