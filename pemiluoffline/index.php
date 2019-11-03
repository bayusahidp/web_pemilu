<?php

include 'koneksi.php';
 
?>

<?php

// ambil data dari thingspeak

$urlOnline = 'https://api.thingspeak.com/channels/878688/feeds.json';
$json = file_get_contents($urlOnline);
$data_json = json_decode($json, true);
// echo $data_json;

$feeds = $data_json['feeds'];
$count = 0;
for ($q = 0; $q < count($feeds); $q++){
	$field1 = $feeds[$q]['field2'];
	echo $field1;
	// for ($s=1; $s<=2 ; $s++) {
	// 	$hitungpres[$s] = 0;
	// 	while ($field1 == $s){
	// 		$hitungpres[$s]++;
	// 		ini_set('max_execution_time', 300);
	// 		set_time_limit(300);
	// 	}
	// }
}

// close ambil data dari thingspeak

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