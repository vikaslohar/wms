<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if(isset($_REQUEST['scode'])) {
    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$printshifttype = $_REQUEST['printshifttype'];
	$trid = $_REQUEST['trid'];
	// user is found
	$user_trlist = $db->GetPrintLabelChk($scode, $printshifttype, $trid);
	//	print_r($user_trlist); exit;
	if ($user_trlist != false) 
	{
		$response["status"] = TRUE;
		$response["msg"]="Success";
		echo json_encode($response);
	}
	else 
	{
		
		$response["status"] = FALSE;
		$response["msg"] = "Please try again";
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