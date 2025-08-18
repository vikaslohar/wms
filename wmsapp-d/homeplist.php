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

	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetTrList($scode);
		//	print_r($user_login);
		if ($user_trlist != false) 
		{
			$response["error"] = FALSE;
			/*$response["user"]["Transaction_id"] = $user_trlist["arrival_code"];
			$response["user"]["disp_date"] = $user_trlist["disp_date"];
			$response["user"]["pper"] = $user_trlist["pper"];
			$response["user"]["ploc"] = $user_trlist["ploc"];
			$response["user"]["state"] = $user_trlist["lotstate"];
			$response["user"]["setupflag"] = $user_trlist["arrsetupflag"];
			$response["user"]["setuplogid"] = $user_trlist["setuplogid"];
			$response["user"]["unldflag"] = $user_trlist["arrunldflag"];
			$response["user"]["unldlogid"] = $user_trlist["unldlogid"];
			$response["user"]["finflag"] = $user_trlist["arrtrflag"];
			$response["user"]["finlogid"] = $user_trlist["logid"];*/
			$response["user"]["transarray"] = $user_trlist;
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["error_msg"] = "Transactions not found.";
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

