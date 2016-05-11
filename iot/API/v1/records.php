<?php
	include_once '../../App_Data/dbconnection.php';
	
	if(isset($_POST['status'])){
		$status =  json_decode($_POST['status']);
		
		$anyrecord = date('Y-m-d H:i:s', strtotime('-8 hours'));
		
		if ($stmt = $mysqli->prepare("SELECT time
				FROM temp
				WHERE status = ?
				AND time > '$anyrecord'")) {
				$stmt->bind_param('i', $status);
		
				// Execute the prepared query.
				$stmt->execute();
		
				$stmt->store_result();
		
				// If there have been more than 5 failed logins
				if ($stmt->num_rows > 0) {
					echo 'true';
				} else {
					echo $status;
				}}
		
	} else {
		echo "no post";
	}
	
	
	
?>