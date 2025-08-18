<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_REQUEST['trid'])) {

    // receiving the post params
   // $scode = $_REQUEST['scode'];
	/*$session_id = $_REQUEST['sessionid'];*/
	$unloadingJsonData = $_REQUEST['unloadingJsonData'];
	$trid = $_REQUEST['trid'];
	
	$jdata = json_decode($unloadingJsonData, true);
	//$jsdata=explode(",",$jdata);
	//$maindata=explode(",",$jdata['unloadingData']);
	//echo $xcx=count($jdata['unloadingData']);
	//print_r($jdata['unloadingData'][0]['lotno']); exit;
	$user_login = $db->UpdateUnloadingJsonData($trid,$jdata);
		//print_r($user_login); exit;
	if ($user_login != false) 
	{
		// user is found
		$response["error"] = FALSE;
		$response["msg"] = "Success";
		$response["user"]["trid"] = $trid;

		echo json_encode($response);
	}
	else
	{
		// user is not found with the credentials
		$response["error"] = TRUE;
		$response["error_msg"] = "Syncing Incomplete. Please try again.";
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
