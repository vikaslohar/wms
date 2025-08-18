<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['scode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	//$device_id = $_REQUEST['deviceid'];

	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->getUnpkgTrpendingList($scode);
		//	print_r($user_trlist);
		if ($user_trlist != false) 
		{
			$response["status"] = TRUE;
			$response["msg"] = "success";
			$response["data"] = $user_trlist;
			echo json_encode($response);
		}
		else
		{
			$response["status"] = FALSE;
			$response["msg"] = "Transactions not found.";
			$response["data"] = array();
			echo json_encode($response);
		}
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["data"] = array();
		$response["msg"] = "Invalid Login. Please try again.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
    $response["data"]= array();
    $response["msg"] = "Required parameters missing";
    echo json_encode($response);
}
?>
