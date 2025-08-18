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
	$trid = $_REQUEST['trid'];
	$lotno = $_REQUEST['lotno'];
	

	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetTranFinLotSelEdit($scode,$trid,$lotno);
			//print_r($user_trlist); exit;
		if ($user_trlist != false) 
		{
			$response["error"] = FALSE;
			$response["msg"] = "Success";
			$response["user"]["trid"] = $trid;
			$response["user"]["scode"] = $scode;
			$response["user"]["arrival_code"] = $user_trlist['arrival_code'];
			$response["user"]["leduration"] = $user_trlist['leduration'];
			$response["user"]["opt"] = $user_trlist['opt'];
			$response["user"]["dcdate"] = $user_trlist['dcdate'];
			$response["user"]["pdndate"] = $user_trlist['pdndate'];
			$response["user"]["pdnno"] = $user_trlist['pdnno'];
			$response["user"]["spcodef"] = $user_trlist['spcodef'];
			$response["user"]["spcodem"] = $user_trlist['spcodem'];
			$response["user"]["organiser"] = $user_trlist['organiser'];
			$response["user"]["farmer"] = $user_trlist['farmer'];
			$response["user"]["prodloc"] = $user_trlist['ploc'];
			$response["user"]["lotstate"] = $user_trlist['lotstate'];
			$response["user"]["prodper"] = $user_trlist['pper'];
			$response["user"]["plotno"] = $user_trlist['plotno'];
			
			$response["user"]["lotno"] = $user_trlist['lotno'];
			$response["user"]["lotcrop"] = $user_trlist['lotcrop'];
			$response["user"]["lotvariety"] = $user_trlist['lotvariety'];
			$response["user"]["harvestdate"] = $user_trlist['harvestdate'];
			$response["user"]["geoindex"] = $user_trlist['geoindex'];
			$response["user"]["gottype"] = $user_trlist['gottype'];
			$response["user"]["seedstatus"] = $user_trlist['seedstatus'];
			$response["user"]["moisture"] = $user_trlist['moisture'];
			$response["user"]["purity"] = $user_trlist['purity'];
			$response["user"]["remark"] = $user_trlist['remark'];
			$response["user"]["qcstatus"] = $user_trlist['qcstatus'];
			$response["user"]["leduration"] = $user_trlist['leduration'];
			$response["user"]["ledate"] = $user_trlist['ledate'];
			$response["user"]["arrstatus"] = $user_trlist['arrstatus'];
			$response["user"]["gotstatus"] = $user_trlist['gotstatus'];
			$response["user"]["stage"] = $user_trlist['stage'];
			
			$response["user"]["whname"] = $user_trlist['whname'];
			$response["user"]["binname"] = $user_trlist['binname'];
			$response["user"]["subbinname"] = $user_trlist['subbinname'];
			$response["user"]["whname1"] = $user_trlist['whname1'];
			$response["user"]["binname1"] = $user_trlist['binname1'];
			$response["user"]["subbinname1"] = $user_trlist['subbinname1'];
			$response["user"]["slocnob"] = $user_trlist['slocnob'];
			$response["user"]["slocqty"] = $user_trlist['slocqty'];
			$response["user"]["slocnob1"] = $user_trlist['slocnob1'];
			$response["user"]["slocqty1"] = $user_trlist['slocqty1'];
			$response["user"]["plotno"] = $user_trlist['plotno'];
			
			$response["user"]["wharray"] = $user_trlist['wharray'];
			$response["user"]["binarray"] = $user_trlist['binarray'];
			$response["user"]["subbinarray"] = $user_trlist['subbinarray'];
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["error_msg"] = "Lot Number not Selected. Please Try Again.";
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
