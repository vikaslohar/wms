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
	$samplewt = $_REQUEST['samplewt'];
	$pureseed = $_REQUEST['pureseed'];
	$pureseedper = $_REQUEST['pureseedper'];
	$imseed = $_REQUEST['imseed'];
	$imseedper = $_REQUEST['imseedper'];
	$lightseed = $_REQUEST['lightseed'];
	$lightseedper = $_REQUEST['lightseedper'];
	$ocseedno = $_REQUEST['ocseedno'];
	$ocseedinkg = $_REQUEST['ocseedinkg'];
	$odvseedno = $_REQUEST['odvseedno'];
	$odvseedinkg = $_REQUEST['odvseedinkg'];
	$dcseed = $_REQUEST['dcseed'];
	$dcseedper = $_REQUEST['dcseedper'];
	$phseedno = $_REQUEST['phseedno'];
	$phseedinkg = $_REQUEST['phseedinkg'];
	$ppphoto = $_REQUEST['ppphoto'];
	$scode = $_REQUEST['scode'];
	

	$user_login = $db->GetSamplePPUpdate($sampleno, $samplewt, $pureseed, $pureseedper, $imseed, $imseedper, $lightseed, $lightseedper, $ocseedno, $ocseedinkg, $odvseedno, $odvseedinkg, $dcseed, $dcseedper, $phseedno, $phseedinkg, $ppphoto, $scode);
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