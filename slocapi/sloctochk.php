<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

//if (isset($_REQUEST['scode']) && isset($_REQUEST['wh']) && isset($_REQUEST['bin']) && isset($_REQUEST['subbin']) && isset($_REQUEST['lotno']) && isset($_REQUEST['stage'])) {
if (isset($_REQUEST['scode']) && isset($_REQUEST['wh']) && isset($_REQUEST['bin']) && isset($_REQUEST['subbin']) && isset($_REQUEST['lotno']) && isset($_REQUEST['stage'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$slocwh = $_REQUEST['wh'];
	$slocbin = $_REQUEST['bin'];
	$slocsubbin = $_REQUEST['subbin'];
	$crop = $_REQUEST['crop'];
	$variety = $_REQUEST['variety'];
	$ups = $_REQUEST['ups'];
	$lotno = $_REQUEST['lotno'];
	$stage = $_REQUEST['stage'];
	$trid = $_REQUEST['trid'];
		
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetToSLOCchk($scode, $slocwh, $slocbin, $slocsubbin, $crop, $variety, $lotno, $stage, $trid);
			//print_r($user_trlist); exit;
		if ($user_trlist == 0) 
		{
			$response["error"] = FALSE;
			$response["msg"] = "Success";
			$response["user"] = $user_trlist;
			echo json_encode($response);
		}
		else
		{
			$response["error"] = TRUE;
			$response["msg"] = "Cannot update SLOC. Crop/Variety/Stage mismatch.";
			$response["user"] = $user_trlist;
			echo json_encode($response);
		}
	}
	else
	{
		// user is not found with the credentials
		$response["error"] = TRUE;
		$response["msg"] = "Invalid Login. Please try again.";
		$response["user"] = '';
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["msg"] = "Required parameters is missing";
	$response["user"] = '';
    echo json_encode($response);
}
?>
