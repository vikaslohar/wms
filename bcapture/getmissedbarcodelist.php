<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);



    //receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$trid = $_REQUEST['trid'];
	$trtype = $_REQUEST['trtype'];

	
	
	
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		
		// user is found
		if($trtype=="OFL"){
			$bacode_list = $db->getMissedBarcodeListOFL($trid);
		}else{
			$bacode_list = $db->getMissedBarcodeList($trid);
		}
		//	print_r($user_trlist); exit;
		if ($bacode_list != false) 
		{
			$response["status"] = TRUE;
			$response["msg"]="Barcode list fetched successfully";
			$response["barcodelist"]=$bacode_list;
			echo json_encode($response);
		}
		else
		{
			$response["status"] = FALSE;
			$response["msg"] = "Barcode not found in system";
			$response["barcodelist"]=$bacode_list;
			echo json_encode($response);
		}
		
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["msg"] = "No data found";
		$response["barcodelist"]=array();
		echo json_encode($response);
	}
	

?>
