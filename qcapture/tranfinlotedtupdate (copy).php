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
	$lotcrop = $_REQUEST['lotcrop'];
	$lotvariety = $_REQUEST['lotvariety'];
	$harvestdate = $_REQUEST['harvestdate'];
	$geoindex = $_REQUEST['geoindex'];
	$gottype = $_REQUEST['gottype'];
	$seedstatus = $_REQUEST['seedstatus'];
	$moisture = $_REQUEST['moisture'];
	$purity = $_REQUEST['purity'];
	$remark = $_REQUEST['remark'];
	$qcstatus = $_REQUEST['qcstatus'];
	$leduration = $_REQUEST['leduration'];
	$ledate = $_REQUEST['ledate'];
	$arrstatus = $_REQUEST['arrstatus'];
	$gotstatus = $_REQUEST['gotstatus'];
	$stage = $_REQUEST['stage'];
	$whname = $_REQUEST['whname'];
	$binname = $_REQUEST['binname'];
	$subbinname = $_REQUEST['subbinname'];
	$whname1 = $_REQUEST['whname1'];
	$binname1 = $_REQUEST['binname1'];
	$subbinname1 = $_REQUEST['subbinname1'];
	$slocnob = $_REQUEST['slocnob'];
	$slocqty = $_REQUEST['slocqty'];
	$slocnob1 = $_REQUEST['slocnob1'];
	$slocqty1 = $_REQUEST['slocqty1'];
	
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist=$db->GetTranLotEditUpdate($scode,$trid,$lotno,$harvestdate,$geoindex,$gottype,$seedstatus,$moisture,$purity,$remark,$qcstatus,$leduration,$ledate,$arrstatus,$gotstatus,$stage,$whname,$binname,$subbinname,$whname1,$binname1,$subbinname1,$slocnob,$slocnob1,$slocqty,$slocqty1);
		//print_r($user_trlist);exit;
		if ($user_trlist != false) 
		{
			$response["error"]=FALSE;
			$response["msg"]="Success";
			$response["user"]["trid"]=$trid;
			$response["user"]["scode"]=$scode;
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["error_msg"] = "Lot Numbers not found. Please Try Again.";
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
    $response["error_msg"] = "Required parameters missing";
    echo json_encode($response);
}
?>
