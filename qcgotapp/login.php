<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_REQUEST['mobile1']) && isset($_REQUEST['password'])) {

    // receiving the post params
    $email = $_REQUEST['mobile1'];
    $password = $_REQUEST['password'];
	$session_id = '';
	$device_id = '';
	//$retBar = $_REQUEST['retBar'];
	//$company = $_REQUEST['company'];

	$user_login = $db->getUserByEmailAndPassword($email, $password, $session_id, $device_id);
//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
        $response["error"] = FALSE;
		$response["user"]["role"] = $user_login["role"];
		$response["user"]["deviceid"] = $device_id;
		$response["user"]["sessionid"] = $session_id;
		$rolesh=$user_login["role"];
		$response["user"]["rolesh"] = $rolesh;
		$response["user"]["scode"] = $user_login["scode"];
		$oprid=$user_login["scode"];
		
		$user_plantcode = $db->getPlantdetails();
		$response["user"]["pcode"] = $user_plantcode;
		
		$user_compflg = $db->getUserdetails($email, $password);
		//print_r($user_compflg);
		//exit;
		if ($user_compflg == false) 
		{
			// user is not found with the credentials
			$response["error"] = TRUE;
			$response["error_msg"] = "Invalid Login. Please try again or contact Administrator";
			echo json_encode($response);
		}
		else
		{
			//print_r($user_compflg);
			//$response["user"]["comparray"] =$user_compflg;
			$response["user"]["name"] = $user_compflg["name"];
			echo json_encode($response);
		}
		//$response["user"]["name"] = $user_login["name"];
		//echo json_encode($response);
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