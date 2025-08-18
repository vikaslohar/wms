<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['mobile1'])) {

    // receiving the post params
    $email = $_REQUEST['mobile1'];
	$sampleno = $_REQUEST['sampleno'];
	$scode = $_REQUEST['scode'];
	$ImageString = "image";//$_REQUEST['image'];
	$type = $_REQUEST['type'];
	$remarks = $_REQUEST['remarks'];
	$oprid = $_REQUEST['oprid'];
	
	$new_retImageString_ret='';

	$user_login = $db->GetSampleMoisFinalSubmit($sampleno, $scode, $new_retImageString_ret, $type, $remarks, $oprid);
	//print_r($user_login); exit;
	if ($user_login != false) 
	{
		//print_r($user_compflg);
		$response["status"] = TRUE;
		$response["msg"]="Success";
		//$response["user"]["samplemoistarray"] =$user_login;
		//$response["user"]["name"] = $user_compflg["name"];
		echo json_encode($response);
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["msg"] = "Data not Final Submitted for this Sample No.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
    $response["msg"] = "Required parameters Username or password is missing";
    echo json_encode($response);
}
?>

