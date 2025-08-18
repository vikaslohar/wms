<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_REQUEST['scode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$session_id = $_REQUEST['sessionid'];
	$device_id = $_REQUEST['deviceid'];
	$trid = $_REQUEST['trid'];
	$lotno = $_REQUEST['lotno'];
	$qtyact = $_REQUEST['qtyact'];
	$tarewt = $_REQUEST['tarewt'];
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetTranUnldLotWtIns($scode,$trid,$lotno,$qtyact,$tarewt);
		//	print_r($user_login);
		if ($user_trlist != false) 
		{
			$response["error"] = FALSE;
			$response["msg"] = "Success";
			$response["user"]["trid"] = $trid;
			$response["user"]["scode"] = $scode;
			
			
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["error_msg"] = "Lot Number not inserted. Please Try Again.";
			echo json_encode($response);
		}
	}
	else
	{
		// user is not found with the credentials
		$response["error"] = TRUE;
		$response["error_msg"] = "Invalid Login. Please try again.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters Username or password is missing";
    echo json_encode($response);
}


?>

