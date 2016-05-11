<?php 
	include_once 'App_Data/photon.php';
	include_once 'App_Data/fusioncharts.php';
	include_once 'App_Data/dbconnection.php';
?>

<!DOCTYPE HTML>
<html>
<head>
	<link rel = "Stylesheet" type = "text/css" href = "css/iot.css">
	<link rel = "Stylesheet" type = "text/css" href = "css/bootstrap.css">
	<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/JavaScript" src="js/iot.js"></script>
	<script type="text/JavaScript" src="js/fusioncharts.js"></script>
	<script type="text/JavaScript" src="js/fusioncharts-jquery-plugin.js"></script>
	<title>IoT Project</title>	
</head>
<body onload='start()'>
	<header class="navbar navbar-static-top bs-docs-nav navbar-fixed-top navbar-inverse" id="top" role="banner">
	    <h2 id='header'>University of St. Thomas - Internet of Things</h2>
	</header>
	<?php include_once 'App_Data/graph.php'; ?>
	<div id='contentPanel'>
		<table class="table table-bordered">
			<tr>
				<td><h2>Status: </h2></td>
				<td id='status1'><h2 id='status'></h2></td>
			</tr>
		</table>
		<br>
		<table class="table table-bordered">
			<tr>
				<th style=' text-align: center;'>Object</th>
				<th style=' text-align: center;'>Celcious</th>
				<th style=' text-align: center;'>Fahrenheit</th>
			</tr>
			<tr>
				<td id='graph'></td>
				<td id='cel'></td>
				<td id='fah'></td>
			</tr>
		</table>
		<br>
		<div id="chart-1"><!-- Fusion Charts will render here--></div>
	</div>
</body>
</html>