<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);
//echo $barcode = $_REQUEST['barcode']."test barcode";
if (isset($_REQUEST['mobile1']))
{
    // receiving the post params
    $mobile1 = $_REQUEST['mobile1'];
	$statename = $_REQUEST['statename'];
	$location = $_REQUEST['location'];
		// get the user by email and password
	$user = $db->getGOTSamplePendingList($statename, $location);
	//print_r($user);exit;
	if($user != false) 
	{
		// user is found
		$response["status"] = TRUE;
		$response["msg"]="Success";
		$response["user"]["samparray"] = $user;
		echo json_encode($response);
	} 
	else 
	{
		// required post params is missing
		$response["status"] = FALSE;
		$response["msg"] = "Location not found in selected State";
		$response["user"]["samparray"] = array();
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
    $response["msg"] = "Invalid Parameters";
	$response["user"]["samparray"] = array();
    echo json_encode($response);
}


?>

