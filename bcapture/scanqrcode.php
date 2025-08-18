<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if(isset($_REQUEST['scode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$trid = $_REQUEST['trid'];
	$scantype = $_REQUEST['scantype'];
	$qrcode = $_REQUEST['qrcode'];
	$grossWeight = $_REQUEST['grossWeight'];
	$reason = $_REQUEST['reason'];
	
	$flg=0;
	
	$qrcode2=str_split($qrcode);
	
	
	if(count($qrcode2)!=11)
	{
		$response["status"] = FALSE;
		$response["msg"] = "Invalid BarCode";
		
		$user_wbdetails=$db->GetWBDetails($trid);
		if ($user_wbdetails != false) 
		{
			$response["user"]=$user_wbdetails;
		}
		else
		{
			$response["user"]=array();
		}
		echo json_encode($response);
		$flg++;
	}
	else
	{
		$chk_barcode = $db->isBarCodeExisted($qrcode, $trid, 0);
		//	print_r($user_login);
		if ($chk_barcode != false) 
		{
			$response["status"] = FALSE;
			$response["msg"] = "BarCode Already Present in System";
			
			$user_wbdetails=$db->GetWBDetails($trid);
			if ($user_wbdetails != false) 
			{
				$response["user"]=$user_wbdetails;
			}
			else
			{
				$response["user"]=array();
			}
			echo json_encode($response);
			$flg++;
		}
		else
		{
			$qrchar=$qrcode2[0].$qrcode2[1];
			$qrnum=$qrcode2[2].$qrcode2[3].$qrcode2[4].$qrcode2[5].$qrcode2[6].$qrcode2[7].$qrcode2[8].$qrcode2[9].$qrcode2[10];			
			if(is_numeric($qrchar))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid BarCode Scanned";
				
				$user_wbdetails=$db->GetWBDetails($trid);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				echo json_encode($response);
				$flg++;
			}
			if(!is_numeric($qrnum))
			{
				$response["status"] = FALSE;
				$response["msg"] = "BarCode";
				
				$user_wbdetails=$db->GetWBDetails($trid);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				echo json_encode($response);
				$flg++;
			}
		}
	}
	//exit;
	if($flg==0)
	{
		$user_login = $db->isUserExisted($scode);
		//	print_r($user_login);
		if ($user_login != false) 
		{
			if($reason==""){
				$user_trlist = $db->GetQRcodeUpdate($scode, $trid, $scantype, $qrcode, $grossWeight);
				//print_r($user_trlist); exit;
				if ($user_trlist != false) 
				{
					$response["status"] = TRUE;
					$response["msg"]="Success";
					//$response["user"] = $user_trlist;
					
					$user_wbdetails=$db->GetWBDetails($trid);
					//	print_r($user_login);
					if ($user_wbdetails != false) 
					{
						$response["user"]=$user_wbdetails;
					}
					else
					{
						$response["user"]=array();
						
					}
					
					echo json_encode($response);
				}
				else
				{
					$response["status"] = FALSE;
					$user_wbdetails=$db->GetWBDetails($trid);
					//	print_r($user_login);
					if ($user_wbdetails != false) 
					{
						$response["user"]=$user_wbdetails;
					}
					else
					{
						$response["user"]=array();
						
					}
					$response["msg"] = "Unable to update.\n Reason:\n1. Barcode is already Scanned.\n2. Barcode not found in system";
					echo json_encode($response);
				}
			}else{
				$chk_barcode = $db->updateReason($qrcode, $trid, $reason);
				//print_r($user_trlist); exit;
				
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetWBDetails($trid);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
					
				}
				if($reason=="UWT"){
					$response["msg"] = "Unable to update.\n Reason:\n1. Barcode is Under Weight";
				}else if($reason=="OWT"){
					$response["msg"] = "Unable to update.\n Reason:\n1. Barcode is Over Weight";
				}else{
					$response["msg"] = "Unable to update.\n Reason:\n1. Barcode is No Weight";
				}
				echo json_encode($response);
			}
			// user is found
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
