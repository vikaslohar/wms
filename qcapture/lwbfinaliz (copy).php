<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['scode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$qrcode = $_REQUEST['qrcode'];
	$lotarray = $_REQUEST['lotarray'];
	$trtype = $_REQUEST['trtype'];
	//$qrcode = $_REQUEST['qrcode'];
//print_r($lotarray);
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetLWBFinalize($scode, $qrcode, $trtype, $lotarray);
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
