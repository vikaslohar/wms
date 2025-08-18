<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['mobile1'])) {

    // receiving the post params
    $email = $_REQUEST['mobile1'];
	$scode = $_REQUEST['scode'];

	
	$user_login = $db->GetGempSetupSync($email, $scode);
	//print_r($user_login); exit;
	if ($user_login != false) 
	{
		//print_r($user_compflg);
		$response["status"] = TRUE;
		$response["user"]["samplegemparray"]=$user_login;
		$response["msg"]="Success";
		echo json_encode($response);
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["user"]["samplegemparray"]=array();
		$response["msg"] = "Image not Updated for this Sample No.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
    $response["msg"] = "Required parameters Username or password is missing";
    echo json_encode($response);
}
?>