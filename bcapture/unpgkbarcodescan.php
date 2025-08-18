<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if(isset($_REQUEST['barcode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$trid = $_REQUEST['trid'];
	$qrcode = $_REQUEST['barcode'];
	
	$flg=0;
	
	$qrcode2=str_split($qrcode);
	
	
	if(count($qrcode2)!=11)
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
	else
	{
		
			$qrchar=$qrcode2[0].$qrcode2[1];
			$qrnum=$qrcode2[2].$qrcode2[3].$qrcode2[4].$qrcode2[5].$qrcode2[6].$qrcode2[7].$qrcode2[8].$qrcode2[9].$qrcode2[10];			
			if(is_numeric($qrchar))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid BarCode Scanned";
				echo json_encode($response);
				$flg++;
			}
			if(!is_numeric($qrnum))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid BarCode Scanned";
				echo json_encode($response);
				$flg++;
			}
	}
	//exit;
	if($flg==0)
	{
		$user_login = $db->isUserExisted($scode);
		//	print_r($user_login);
		if ($user_login != false) 
		{
			// user is found
			$user_trlist = $db->GetBarcodeUnpkg($scode, $trid, $qrcode);
				//print_r($user_trlist); exit;
			if ($user_trlist == 1) 
			{
				$response["status"] = TRUE;
				$response["msg"]="Success";
				//$response["user"] = $user_trlist;
				echo json_encode($response);
			}
			else if ($user_trlist == 2)
			{
				$response["status"] = FALSE;
				$response["msg"] = "Barcode already scanned";
				echo json_encode($response);
			}
			else if ($user_trlist == 2)
			{
				$response["status"] = FALSE;
				$response["msg"] = "Unable to unpackage";
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
