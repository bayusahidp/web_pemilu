<?php
 

include'koneksi.php';

// hitung partai dengan looping

for ($i=1; $i<=20 ; $i++) {
	$hitungp[$i] = 0;
	$ambilp[$i] = $koneksi->query("SELECT * FROM hasil_vot WHERE id_partai = $i");
	while ( $pecahp[$i] = $ambilp[$i]->fetch_assoc()) {
		$hitungp[$i]++;
	}
}

// close hitung partai dengan looping

$dataPoints = array(
	array("label"=> "PKB", "y"=> $hitungp[1]),
	array("label"=> "GERINDRA", "y"=> $hitungp[2]),
	array("label"=> "PDIP", "y"=> $hitungp[3]),
	array("label"=> "GOLKAR", "y"=> $hitungp[4]),
	array("label"=> "NASDEM", "y"=> $hitungp[5]),
	array("label"=> "GARUDA", "y"=> $hitungp[6]),
	array("label"=> "BERKARYA", "y"=> $hitungp[7]),
	array("label"=> "PKS", "y"=> $hitungp[8]),
	array("label"=> "PERINDO", "y"=> $hitungp[9]),
	array("label"=> "PPP", "y"=> $hitungp[10]),
	array("label"=> "PSI", "y"=> $hitungp[11]),
	array("label"=> "PAN", "y"=> $hitungp[12]),
	array("label"=> "HANURA", "y"=> $hitungp[13]),
	array("label"=> "DEMOKRAT", "y"=> $hitungp[14]),
	array("label"=> "ACEH", "y"=> $hitungp[15]),
	array("label"=> "SIRA", "y"=> $hitungp[16]),
	array("label"=> "PDACEH", "y"=> $hitungp[17]),
	array("label"=> "PNA", "y"=> $hitungp[18]),
	array("label"=> "PBB", "y"=> $hitungp[19]),
	array("label"=> "PKPI", "y"=> $hitungp[20])
);
	
?>
<!DOCTYPE HTML>
<html>
<head>
<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">KPU Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="kpuonline.php">Pres & Wapres
              <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="kpuonline_partai.php">Partai
              <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<br><br><br>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "Hasil Pemilu Partai - 2019"
	},
	axisY: {
		title: "Jumlah Suara",
		includeZero: false
	},
	axisX: {
		title: "Partai",
		includeZero: false
	},
	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<div id="chartContainer" style="height: 370px; width: 80%; margin: auto;"></div>
<script src="canvasjs/canvasjs.min.js"></script>
</body>
</html>