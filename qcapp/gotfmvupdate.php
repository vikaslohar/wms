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
	//$fmvdate = $_REQUEST['fmvdate'];
	
	$retest = $_REQUEST['retest'];
	$retesttype = $_REQUEST['retesttype'];
	$retest_reason = $_REQUEST['retest_reason'];
	$fmvdate = date("y-m-d");
	
	if($retest=="Yes")
	{
		$userlogin = $db->GetGoTRetestUpdate($sampleno, $retest, $retesttype, $retest_reason);
		//print_r($user_login); exit;
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
		$fmv_crophealth = $_REQUEST['fmv_crophealth'];
		$fmv_reasons = $_REQUEST['fmv_reasons'];
		$fmv_noofplants = $_REQUEST['fmv_noofplants'];
		$fmvphoto1 = $_REQUEST['fmvphoto1'];
		$fmvphoto2 = $_REQUEST['fmvphoto2'];
		$fmvphoto3 = $_REQUEST['fmvphoto3'];
		$scode = $_REQUEST['scode'];
		
		$user_login = $db->GetGoTFMVUpdate($sampleno, $fmvdate, $fmv_crophealth, $fmv_reasons, $fmv_noofplants, $scode, $fmvphoto1, $fmvphoto2, $fmvphoto3);
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
