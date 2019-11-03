<?php

include 'koneksi.php';
 
?>

<?php


// ambil data dari thingspeak
// 878688 -- Data Coba
// 879580
$urlOnline = 'https://api.thingspeak.com/channels/879580/feeds.json'; 
$json = file_get_contents($urlOnline);
$data_json = json_decode($json, true);

$feeds = $data_json['feeds'];
$count = 0;
for ($q = 0; $q < count($feeds); $q++){
	$idtempat = $feeds[$q]['field1'];
	$idpresiden = $feeds[$q]['field2'];
	$idpartai = $feeds[$q]['field3'];
	$iddprri = $feeds[$q]['field4'];
	$hitung = $feeds[$q]['field5'];
	$idadmin = $feeds[$q]['field6'];
	$idvot = $feeds[$q]['field7'];

// close ambil data dari thingspeak

// insert data dari thingspeak ke database

	$simpanData = sprintf("INSERT INTO hasil_vot VALUES (id_vot, id_tps, id_calon, id_partai, id_dprri, hitung, id_admin)",$idvot, $idtempat, $idpresiden, $idpartai, $iddprri, $hitung, $idadmin);
	mysqli_query($connect, $simpanData);

// $koneksi->query("INSERT INTO hasil_vot(id_vot, id_tps, id_calon, id_partai, id_dprri, hitung, id_admin)
// VALUES('$idvot','$idtempat','$idpresiden','$idpartai','$iddprri','$count','$idadmin')");

// close insert data dari thingspeak ke database
}
// <!-- hitung presiden -->

for ($s=1; $s<=2 ; $s++) {
	$hitungpres[$s] = 0;
	$ambilpres[$s] = $koneksi->query("SELECT * FROM hasil_vot WHERE id_calon = $s");
	while ( $pecahpres[$s] = $ambilpres[$s]->fetch_assoc()) {
		$hitungpres[$s]++;
	}
}

// <!-- close hitung presiden -->


// hitung partai dengan looping

for ($i=1; $i<=20 ; $i++) {
	$hitungp[$i] = 0;
	$ambilp[$i] = $koneksi->query("SELECT * FROM hasil_vot WHERE id_partai = $i");
	while ( $pecahp[$i] = $ambilp[$i]->fetch_assoc()) {
		$hitungp[$i]++;
	}
}

// close hitung partai dengan looping


// <!-- hitung dprri dengan looping -->

for ($x=1; $x<=814 ; $x++) {
	$hitungdprri[$x] = 0;
	$ambildprri[$x] = $koneksi->query("SELECT * FROM hasil_vot WHERE id_dprri = $x");
	while ($pecahdprri[$x] = $ambildprri[$x]->fetch_assoc()) {
		$hitungdprri[$x]++;
	}

}

// <!-- close hitung dprri dengan looping -->


// penampilan perhitungan ke chart

$dataPoints = array(
	array("label"=> "Jokowi Amin", "y"=> $hitungpres[1]),
	array("label"=> "Prabowo Sandi", "y"=> $hitungpres[2]),
);

// close penampilan perhitungan ke chart

?>


<!DOCTYPE HTML>
<html>
<head>
<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
	<?php
	include 'menu.php';
	?>
<br><br><br>
	<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "KPU Hasil Pemilihan Online"
	},
	subtitles: [{
		text: "Hasil Pemilu Presiden dan Wakil Presiden Sementara"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		// yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="canvasjs/canvasjs.min.js"></script>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->

<?php



?>


</body>
</html>