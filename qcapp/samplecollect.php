<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_REQUEST['mobile1'])) {

    // receiving the post params
    $email = $_REQUEST['mobile1'];
	$session_id = '';
	$device_id = '';
	$sampleno = $_REQUEST['sampleno'];
	$smpdate = $_REQUEST['smpdate'];
	$scode = $_REQUEST['scode'];
	$srfseries = $_REQUEST['srfseries'];
	$srfno = $_REQUEST['srfno'];
	$oprid = $_REQUEST['oprid'];

	$user_login = $db->GetSampleCollect($scode, $sampleno, $smpdate, $srfseries, $srfno, $email, $oprid);
	//print_r($user_login); exit;
	if ($user_login != false) 
	{
		//print_r($user_compflg);
		$response["error"] = FALSE;
		$response["msg"]="Success";
		$response["user"]["srfno"] = $user_login;
		echo json_encode($response);
	}
	else
	{
		// user is not found with the credentials
		$response["error"] = TRUE;
		$response["error_msg"] = "Sample not collected. Please try again";
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
