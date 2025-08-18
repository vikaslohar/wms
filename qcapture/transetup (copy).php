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
	$dispdate = $_REQUEST['dispdate'];
	$dcdate = $_REQUEST['dcdate'];
	$dcno = $_REQUEST['dcno'];

	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetTranSetupInit($scode,$dispdate,$dcdate,$dcno);
		//	print_r($user_login);
		if ($user_trlist != false) 
		{
			$response["error"] = FALSE;
			$response["msg"] = "Success";
			$response["user"]["trid"] = $user_trlist["trid"];
			$response["user"]["scode"] = $scode;
			
			/*$user_trlotyrclist = $db->GetTranSetupLotyrcodelist();
			if ($user_trlotyrclist != false) 
			{
				$response["user"]["lotyearcode"] = $user_trlotyrclist;
			}*/
			
			$user_trlotchklist = $db->GetTranSetupLotchklist();
			//	print_r($user_login);
			if ($user_trlotchklist != false) 
			{
				$response["user"]["lotnumbers"] = $user_trlotchklist;
			}
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["error_msg"] = "Transactions cannot initiated. Please Try Again.";
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
    $response["error_msg"] = "Required parameters is missing";
    echo json_encode($response);
}


?>

