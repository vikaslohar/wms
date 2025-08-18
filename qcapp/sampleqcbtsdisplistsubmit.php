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
	$oprid = $_REQUEST['oprid'];
	if (isset($_REQUEST['oprid'])) {$oprid = $_REQUEST['oprid'];} else {$oprid='';}
	if (isset($_REQUEST['qc_remarks'])) {$qc_remarks = $_REQUEST['qc_remarks'];} else {$qc_remarks='';}

	$user_login = $db->GetSampleInfobtsdisplist_submit($sampleno, $qc_remarks, $oprid);
	//print_r($user_login); exit;
	if ($user_login != false) 
	{
		if($user_login==1)
		{
			$response["error"] = FALSE;
			$response["msg"]="Success";
			//$response["user"]["name"] = $user_compflg["name"];
			echo json_encode($response);
		}
		else if($user_login==2)
		{
			$response["error"] = TRUE;
			$response["error_msg"] = "Sample already listed for dispatch or not added in germination";
			echo json_encode($response);
		}
		else if($user_login==3)
		{
			// user is not found with the credentials
			$response["error"] = TRUE;
			$response["error_msg"] = "Sample already listed for Dispatch";
			echo json_encode($response);
		}
	}
	else
	{
		$response["error"] = TRUE;
		$response["error_msg"] = "Sample Not Updated For Dispatch List. Please try again";
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