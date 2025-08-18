<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['scode'])) {
    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$trid = $_REQUEST['trid'];

	$user_login = $db->isUserExisted($scode);
	//	print_r($user_login);
	if ($user_login != false) 
	{
		// user is found
		$user_trlist=$db->GetTranDetails($scode,$trid, $mobile1);
		//	print_r($user_trlist); exit;
		if ($user_trlist != false) 
		{
			$response["status"]=TRUE;
			$response["msg"]="Success";
			$response["user"]["trid"]=$trid;
			$response["user"]["scode"]=$scode;
			$response["user"]["lotarray"]=$user_trlist;
			
			$user_dommcode=$db->GetDomMacDetails($scode);
			//	print_r($user_login);
			if ($user_dommcode != false) 
			{
				$response["user"]["dommarray"]=$user_dommcode;
				
				
			}
			else
			{
				$response["user"]["dommarray"]=array();
				
			}

			$user_machineopr=$db->GetMacOprDetails($scode);
			//	print_r($user_login);
			if ($user_machineopr != false) 
			{
				$response["user"]["machineoprarray"]=$user_machineopr;
			}
			else
			{
				$response["user"]["machineoprarray"]=array();
				
			}
			echo json_encode($response);
		}
		else
		{
			$response["status"] = FALSE;
			$response["user"]=array();
			$response["msg"] = "Transaction not found. Please Try Again.";
			echo json_encode($response);
		}
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["user"]=array();
		$response["msg"] = "Invalid Login. Please try again.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
	$response["user"]=array();
    $response["msg"] = "Required parameters missing";
    echo json_encode($response);
}


?>

