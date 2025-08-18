<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['scode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$trtype = $_REQUEST['trtype'];
	$grosswt = $_REQUEST['grosswt'];
	$qrcode = $_REQUEST['qrcode'];
	$mptype = $_REQUEST['packtype'];
	$wh_id = $_REQUEST['whid'];
	$bin_id = $_REQUEST['binid'];
	$subbin_id = $_REQUEST['subbinid'];
	
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetLMCQRScanningFinalize($scode, $trtype, $qrcode, $grosswt, $mptype, $wh_id, $bin_id, $subbin_id);
		//	print_r($user_trlist); exit;
		if ($user_trlist != false) 
		{
			$response["status"] = TRUE;
			$response["msg"]="Success";
			echo json_encode($response);
		}
		else
		{
			$response["status"] = FALSE;
			$response["msg"] = "Unable to update. Please try again.";
			echo json_encode($response);
		}
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["msg"] = "Invalid Login. Please try again.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
    $response["msg"] = "Required parameters missing";
    echo json_encode($response);
}
?>
