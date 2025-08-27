<?php
error_reporting(0);
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);
	
if (isset($_REQUEST['lasttrid'])) {

    // receiving the post params
    $lasttrid = $_REQUEST['lasttrid'];
	if(isset($_REQUEST['direct_flag']))
	{$dflag = $_REQUEST['direct_flag'];}
	else
	{$dflag = 0;}

	$user_trlist = $db->GetTrList($lasttrid,$dflag);
	//	print_r($user_trlist); exit;
	if ($user_trlist != false) 
	{
		$response["error"] = FALSE;
		$response["user"] = $user_trlist;
		echo json_encode($response);
	}
	else
	{
		$response["error"] = TRUE;
		$response["error_msg"] = "Transactions not found.";
		echo json_encode($response);
	}
} 
else if (isset($_REQUEST['barqrcode'])) {
	$response = array("status" => FALSE);
    	// receiving the post params
    	$barqrcode = $_REQUEST['barqrcode'];
	$type = $_REQUEST['type'];

	$result = $db->GetBarQRCodechk($barqrcode, $type);
	//	print_r($user_login);
	if ($result != false) 
	{
		if($result['flg'])
		{
			$response["status"] = TRUE;
			$response["disp_id"] = $result['disp_id'];
			$response["dispatch_date"] = $result['dispatch_date'];
			$response["Barcode_type"] = $result['Barcode_type'];
			echo json_encode($response);
		} else {
			$response["status"] = FALSE;
			$response["message"] = $result['msg'];
			echo json_encode($response);
		}
	}
	else
	{
		$response["status"] = FALSE;
		$response["message"] = "Transactions not found.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter missing";
    echo json_encode($response);
}
?>

