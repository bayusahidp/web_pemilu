<?php 
session_start();
//koneksi ke database dengan mysqli
include 'koneksi.php';

$ambil=$koneksi->query("SELECT * FROM data_pemilih");
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
            <h2>Tempelkan E-KTP Anda<br>Pada Alat yang Disediakan<br/></h2>
            <br>
        </div>
    </div>
</section>

<section class="main_title">
    <div class="container">
        <form method="post">
    		<div class="row">
    			<div class="form-group input-group">
                </div>
    		</div>
    		<br><button class="btn btn-primary" name="memilih">Lanjut</button>
        </form>
        <script>
            var serialport = require("serialport");
            var SerialPort = serialport.SerialPort;
            var portName = process.argv[2];
            var myPort = new SerialPort(portName,{
                baudrate:9600,
                parser:serialport.parsers.readline("\r\n")
            })
            myPort.on('open',onOpen);
            myPort.on('data',onData);
            function onOpen(){
                console.log("Open connection");
            }
            function onData(){
                console.log("onData "+data);
            }
        </script>
        <?php 
        
            if (isset($_POST['memilih'])) {
               
                $myfile = fopen("testfile.txt", "r") or die("Unable to open file!");
                $dapat = fread($myfile,filesize("testfile.txt"));
                echo ($dapat);
                fclose($myfile);

                $myfil = fopen("testfile.txt", "w+") or die("Unable to open file!");
                fread($myfil,filesize("testfile.txt"));
                fwrite($myfil, "\n");
        
                $ambil = $koneksi->query("SELECT * FROM data_pemilih WHERE id_tag = '$dapat'");
                $pecah = $ambil->fetch_assoc();
                $yangcocok = $ambil->num_rows; //mencari akun yang cocok
                if ($yangcocok==1)
                {
                    if ($pecah['hak_pilih'] == "belum") {
                        $_SESSION['auktp'] = $pecah;
                        echo "<div class='alert alert-info'>Berhasil</div>";
                        echo "<meta http-equiv='refresh' content='1;url=ausidikjari.php'>"; 
                    }
                    else {
                        echo "<div class='alert alert-danger'>Maaf Anda Sudah Menggunakan Hak Pilih</div>";
                        echo "<meta http-equiv='refresh' content='1;url=autentikasiktp.php'>";
                    }
                }
                else
                {
                    echo "<div class='alert alert-danger'>Data tidak sesuai</div>";
                    echo "<meta http-equiv='refresh' content='1;url=autentikasiktp.php'>";
                }
            }
        ?>
    </div>
</section>
<?php
 // echo shell_exec("python komunikasi.py 2>&1");
?>
</body>
</html>