<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_REQUEST['lasttrid'])) {

    // receiving the post params
    $lasttrid = $_REQUEST['lasttrid'];

	$user_trlist = $db->GetTrList($lasttrid);
	//	print_r($user_login);
	if ($user_trlist != false) 
	{
		$response["error"] = FALSE;
		$response["user"]["transarray"] = $user_trlist;
		echo json_encode($response);
	}
	else
	{
		$response["error"] = TRUE;
		$response["error_msg"] = "Transactions not found.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter missing";
    echo json_encode($response);
}
?>

