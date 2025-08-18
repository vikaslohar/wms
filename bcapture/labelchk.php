<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if(isset($_REQUEST['packmachcode'])) {
    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$packmachcode = $_REQUEST['packmachcode'];
	$shifttype = 'start';
	//$packmachno = $_REQUEST['packmachno'];
	$trid = $_REQUEST['trid'];
	// user is found
	$user_trlist = $db->GetExtLabelDetails($scode, $packmachcode, $shifttype, $trid);
	//	print_r($user_trlist); exit;
	if ($user_trlist != false) 
	{
		$response["status"] = TRUE;
		$response["msg"]="Success";
		$response["labelno"]=$user_trlist;
		echo json_encode($response);
	}
	else 
	{
		
		$response["status"] = FALSE;
		$response["msg"] = "Label not found in system";
		$response["labelno"]='';
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
