<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['scode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$trid = $_REQUEST['trid'];
	$lbltype = $_REQUEST['lbltype'];
	$lblno = $_REQUEST['lblno'];
	$macoprname = $_REQUEST['macoprname'];
	$dopdate = $_REQUEST['dop'];
	
	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist = $db->GetRPSLblNoUpdate($scode, $trid, $lbltype, $lblno, $macoprname, $dopdate);
		//	print_r($user_trlist); exit;
		if ($user_trlist != false) 
		{
			$response["status"] = TRUE;
			$response["msg"]="Success";
			//$response["user"] = $user_trlist;
			echo json_encode($response);
		}
		else
		{
			$response["status"] = FALSE;
			//$response["user"]=array();
			$response["msg"] = "Unable to update. Please Try again.";
			echo json_encode($response);
		}
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		//$response["user"]=array();
		$response["msg"] = "Invalid Login. Please try again.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
	//$response["user"]=array();
    $response["msg"] = "Required parameters missing";
    echo json_encode($response);
}


?>

