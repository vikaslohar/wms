<?php
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$maxid = $_REQUEST['maxid'];

	$data = [];
	if($maxid>0){
		$sql = "SELECT * FROM tbl_rpspackaging where packaging_id > $maxid and packaging_tflg=1";
	}else{
		$sql = "SELECT * FROM tbl_rpspackaging where `packaging_tdate`>'2024-10-01' and packaging_tflg=1";
	}
	
	$result = $link->query($sql);
	
	if ($result && $result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$row_id = $row['packaging_id'];
	
			// Initialize sub-records
			$data_sub = [];
	
			// Sub query with WHERE condition
			$sql_sub = "SELECT * FROM tbl_rpspackaging_sub WHERE packaging_id = $row_id";
			$result_sub = $link->query($sql_sub);
	
			if (!$result_sub) {
				die("Sub Query Error: " . $link->error); // Show exact error
			}
	
			while ($row_sub = $result_sub->fetch_assoc()) {
				$data_sub[] = $row_sub;
			}
	
			// Nest sub-records into main row
			$row['sub_records'] = $data_sub;
			$data[] = $row;
		}
	} else {
		die("Main Query Error: " . $link->error);
	}
	// Output final JSON
	echo json_encode($data, JSON_PRETTY_PRINT);
	
	// Close DB
	$link->close();
?>