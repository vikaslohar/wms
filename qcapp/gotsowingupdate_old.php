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
	$sampleno = $_REQUEST['sampleno'];
	$scode = $_REQUEST['scode'];
	
	$retest = $_REQUEST['retest'];
	$retesttype = $_REQUEST['retesttype'];
	$retest_reason = $_REQUEST['retest_reason'];
	
	if($retest=="Yes")
	{
		$userlogin = $db->GetGoTRetestUpdate($sampleno, $retest, $retesttype, $retest_reason);
		//print_r($userlogin); exit;
		if ($userlogin != false) 
		{
			//print_r($user_compflg);
			$response["error"] = FALSE;
			$response["msg"]="Success";
			//$response["user"]["samplemoistarray"] =$user_login;
			//$response["user"]["name"] = $user_compflg["name"];
			echo json_encode($response);
		}
		else
		{
			// user is not found with the credentials
			$response["error"] = TRUE;
			$response["error_msg"] = "Retest not done for this Sample No. Please try again.";
			echo json_encode($response);
		}
	}
	else
	{
		$dosow = $_REQUEST['dosow'];
		$sow_nurplotno = $_REQUEST['sow_nurplotno'];
		$sow_noofseeds = $_REQUEST['sow_noofseeds'];
		$sow_sptype = $_REQUEST['sow_sptype'];
		$scode = $_REQUEST['scode'];
		
		$sow_state = $_REQUEST['sow_state'];
		$sow_loc = $_REQUEST['sow_loc'];
		$sow_noofcellstray = $_REQUEST['sow_noofcellstray'];
		$sow_nooftraylot = $_REQUEST['sow_nooftraylot'];
		$sow_bedno = $_REQUEST['sow_bedno'];
		$sow_direction = $_REQUEST['sow_direction'];
		$sow_noofrows = $_REQUEST['sow_noofrows'];
		$sow_noofplants = $_REQUEST['sow_noofplants'];
		
		$user_login = $db->GetGoTSowingUpdate($sampleno, $dosow, $sow_nurplotno, $sow_noofseeds, $sow_sptype, $scode, $sow_state, $sow_loc, $sow_noofcellstray, $sow_nooftraylot, $sow_bedno, $sow_direction, $sow_noofrows, $sow_noofplants, $retest, $retesttype, $retest_reason);
		//print_r($user_login); exit;
		if ($user_login != false) 
		{
			//print_r($user_compflg);
			$response["error"] = FALSE;
			$response["msg"]="Success";
			//$response["user"]["samplemoistarray"] =$user_login;
			//$response["user"]["name"] = $user_compflg["name"];
			echo json_encode($response);
		}
		else
		{
			// user is not found with the credentials
			$response["error"] = TRUE;
			$response["error_msg"] = "Data not Updated OR Already Updated for this Sample No.";
			echo json_encode($response);
		}
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