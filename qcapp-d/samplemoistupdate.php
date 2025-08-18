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
	$hmtype = $_REQUEST['hmtype'];
	$m1rep1 = $_REQUEST['m1rep1'];
	$m1rep2 = $_REQUEST['m1rep2'];
	$m1rep3 = $_REQUEST['m1rep3'];
	$m1rep4 = $_REQUEST['m1rep4'];
	$m2rep1 = $_REQUEST['m2rep1'];
	$m2rep2 = $_REQUEST['m2rep2'];
	$m2rep3 = $_REQUEST['m2rep3'];
	$m2rep4 = $_REQUEST['m2rep4'];
	$m3rep1 = $_REQUEST['m3rep1'];
	$m3rep2 = $_REQUEST['m3rep2'];
	$m3rep3 = $_REQUEST['m3rep3'];
	$m3rep4 = $_REQUEST['m3rep4'];
	$rep1moistper = $_REQUEST['rep1moistper'];
	$rep2moistper = $_REQUEST['rep2moistper'];
	$rep3moistper = $_REQUEST['rep3moistper'];
	$rep4moistper = $_REQUEST['rep4moistper'];
	$haommoistper = $_REQUEST['haommoistper'];
	$mmrep1 = $_REQUEST['mmrep1'];
	$mmrep2 = $_REQUEST['mmrep2'];
	$mmrep3 = $_REQUEST['mmrep3'];
	$mmrmoistper = $_REQUEST['mmrmoistper'];
	$scode = $_REQUEST['scode'];
	

	$user_login = $db->GetSampleMoistUpdate($sampleno,$hmtype, $m1rep1, $m1rep2, $m1rep3, $m1rep4, $m2rep1,$m2rep2, $m2rep3, $m2rep4, $m3rep1, $m3rep2, $m3rep3, $m3rep4, $rep1moistper, $rep2moistper, $rep3moistper, $rep4moistper, $haommoistper, $mmrep1, $mmrep2, $mmrep3, $mmrmoistper, $scode);
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