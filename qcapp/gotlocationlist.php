<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);
//echo $barcode = $_REQUEST['barcode']."test barcode";
if (isset($_REQUEST['mobile1']))
{
    // receiving the post params
    $mobile1 = $_REQUEST['mobile1'];
	$statename = $_REQUEST['statename'];
		// get the user by email and password
	$user = $db->getGOTLocationList($statename);
	//print_r($user);exit;
	if($user != false) 
	{
		// user is found
		$response["error"] = FALSE;
		$response["msg"]="Success";
		$response["user"]["locationarray"] = $user;
		echo json_encode($response);
	} 
	else 
	{
		// required post params is missing
		$response["error"] = TRUE;
		$response["error_msg"] = "Location not found in selected State";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Invalid Parameters";
    echo json_encode($response);
}


?>

