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
		$transp_date = $_REQUEST['transp_date'];
		$transp_state = $_REQUEST['transp_state'];
		$transp_loc = $_REQUEST['transp_loc'];
		$transp_plotno = $_REQUEST['transp_plotno'];
		$transp_bedno = $_REQUEST['transp_bedno'];
		$transp_direction = $_REQUEST['transp_direction'];
		$transp_noofrows = $_REQUEST['transp_noofrows'];
		$transp_range = $_REQUEST['transp_range'];
		$transp_noofplants = $_REQUEST['transp_noofplants'];
		
		$user_login = $db->GetGoTTransplatingingUpdate($sampleno, $transp_date, $transp_state, $transp_loc, $transp_plotno, $transp_bedno, $transp_direction, $transp_noofrows, $transp_range, $transp_noofplants, $scode);
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