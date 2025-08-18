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
	$testtype = $_REQUEST['testtype'];
	$sgtnorep = $_REQUEST['sgtnorep'];
	$fgtnorep = $_REQUEST['fgtnorep'];
	$fgtmtype = $_REQUEST['fgtmtype'];
	if(isset($_REQUEST['docsrefno'])) {$docsrefno=$_REQUEST['docsrefno'];} else { $docsrefno='';}

	$user_login = $db->GetGempSetupUpdate($sampleno, $testtype, $sgtnorep, $fgtnorep, $fgtmtype, $docsrefno);
	//print_r($user_login); exit;
	if ($user_login != false) 
	{
		//print_r($user_compflg);
		$response["error"] = FALSE;
		$response["msg"]="Success";
		//$response["user"]["samplegemparray"] =$user_login;
		//$response["user"]["name"] = $user_compflg["name"];
		echo json_encode($response);
	}
	else
	{
		// user is not found with the credentials
		$response["error"] = TRUE;
		$response["error_msg"] = "Data not Updated for this Sample No.";
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