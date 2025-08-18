<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_REQUEST['scode']) && isset($_REQUEST['lotno']) ) {

    // receiving the post params
	$email = $_REQUEST['mobile1'];
    $scode = $_REQUEST['scode'];
	$lotno = $_REQUEST['lotno'];
	//$slocbin = $_REQUEST['bin'];
	//$slocsubbin = $_REQUEST['subbin'];
	

	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist=$db->GetLotList($scode, $lotno);
		//	print_r($user_trlist); exit;
		if ($user_trlist != false) 
		{
			$response["error"]=FALSE;
			$response["msg"]="Success";
			$response["user"]["lotarray"]=$user_trlist;
			
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["msg"] = "Lot Numbers not found. Please Try Again.";
			echo json_encode($response);
		}
	}
	else
	{
		// user is not found with the credentials
		$response["error"] = TRUE;
		$response["msg"] = "Invalid Login. Please try again.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["msg"] = "Required parameters Username or password is missing";
    echo json_encode($response);
}


?>


