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
	$mobile1 = $_REQUEST['mobile1'];
	$slocwh = $_REQUEST['wh'];
	$slocbin = $_REQUEST['bin'];
	$slocsubbin = $_REQUEST['subbin'];
	$trid = $_REQUEST['trid'];
	$jdata = $_REQUEST['germpdata'];
		
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetTodataUpdate($scode, $slocwh, $slocbin, $slocsubbin, $trid, $jdata);
//	echo "result = ";		print_r($user_trlist); exit;
		if ($user_trlist != false) 
		{
			$response["error"] = FALSE;
			$response["msg"] = "Success";
			
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["msg"] = "Transaction cannot be updated. Please Try Again.";
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

