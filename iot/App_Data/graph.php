<?php
	include_once 'dbconnection.php';
	include_once 'fusioncharts.php';
	
	$strQuery = "SELECT fah, time FROM temp ORDER BY time desc LIMIT 20";
		
	// Execute the query, or else return the error message.
	$results = $mysqli->query($strQuery);
		
	if ($results) {
		// The `$arrData` array holds the chart attributes and data
		$arrData = array(
				"chart" => array(
						"caption" => "Temperature timeline",
						"paletteColors" => "#0075c2",
						"bgColor" => "#ffffff",
						"borderAlpha"=> "20",
						"canvasBorderAlpha"=> "0",
						"usePlotGradientColor"=> "0",
						"plotBorderAlpha"=> "10",
						"showXAxisLine"=> "1",
						"xAxisLineColor" => "#999999",
						"showValues" => "0",
						"divlineColor" => "#999999",
						"divLineIsDashed" => "1",
						"showAlternateHGridColor" => "0",
						"yAxisMinValue" => "70",
						"yAxisMaxValue" => "100"
				)
		);
			
		$arrData["data"] = array();
			
		while($row = mysqli_fetch_array($results)) {
			array_push($arrData["data"], array(
					"label" => $row["time"],
					"value" => $row["fah"]
			)
					);
		}
			
		$jsonEncodedData = json_encode($arrData);
			
		$columnChart = new FusionCharts("line", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);
			
		// Render the chart
		$columnChart->render();
			
		// Close the database connection
		$mysqli->close();
	}
?>