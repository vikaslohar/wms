<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['scode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$trid = 0;
	$scantype = $_REQUEST['scantype'];
	$qrcode = $_REQUEST['qrcode'];
	$cropname = $_REQUEST['cropname'];
	$varietyname = $_REQUEST['varietyname'];
	$ups = $_REQUEST['ups'];
	$grosswt = $_REQUEST['grosswt'];
	$mptype = $_REQUEST['packtype'];
	$mpwt = $_REQUEST['mpwt'];
	
	$flg=0;
	if($scantype!="mpbarcode")
	{
		$qrcode2=str_split($qrcode);
		//echo count($qrcode2);
		if(count($qrcode2)!=13)
		{
			$response["status"] = FALSE;
			$response["msg"] = "Invalid QR Code1";
			$flg++;
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
			
		}
		else
		{
			$qrchar=$qrcode2[0].$qrcode2[1];
			$qrnum=$qrcode2[2].$qrcode2[3].$qrcode2[4].$qrcode2[5].$qrcode2[6].$qrcode2[7].$qrcode2[8].$qrcode2[9].$qrcode2[10].$qrcode2[11].$qrcode2[12];			
			if(is_numeric($qrchar))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid QR Code2";
				$flg++;
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
				
			}
			if(!is_numeric($qrnum))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid QR Code3";
				$flg++;
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
				
			}
		}
	}
	else
	{
		$qrcode2=str_split($qrcode);
		
		if(count($qrcode2)!=11)
		{
			$response["status"] = FALSE;
			$response["msg"] = "Invalid BarCode1";
			$flg++;
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
			
		}
		else
		{
			$chk_barcode = $db->isBarCodeExisted($qrcode);
			//	print_r($user_login);
			if ($chk_barcode != false) 
			{
				$response["status"] = FALSE;
				$response["msg"] = "BarCode Already Present in System";
				$flg++;
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
				
			}
			else
			{
				$qrchar=$qrcode2[0].$qrcode2[1];
				$qrnum=$qrcode2[2].$qrcode2[3].$qrcode2[4].$qrcode2[5].$qrcode2[6].$qrcode2[7].$qrcode2[8].$qrcode2[9].$qrcode2[10];			
				if(is_numeric($qrchar))
				{
					$response["status"] = FALSE;
					$response["msg"] = "Invalid BarCode2";
					$flg++;
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
					
				}
				if(!is_numeric($qrnum))
				{
					$response["status"] = FALSE;
					$response["msg"] = "Invalid BarCode3";
					$flg++;
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
					
				}
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
			// user is found
			$user_trlist = $db->GetLMCQRcodeUpdate($scode, $trid, $scantype, $qrcode, $cropname, $varietyname, $ups, $grosswt, $mptype, $mpwt);
			//	print_r($user_trlist); exit;
			if($user_trlist==0) 
			{
				$response["status"] = TRUE;
				$response["msg"]="Success";
				//$response["user"] = $user_trlist;
				
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
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
			else if($user_trlist==1) 
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Crop Details not found. Please try again.";
				echo json_encode($response);
			}
			else if($user_trlist==2) 
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Variety Details not found. Please try again.";
				echo json_encode($response);
			}
			else if($user_trlist==3) 
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Window Box QR Code already Linked OR Crop/Variety/UPS Mismatch. Please try again.";
				echo json_encode($response);
			}
			else if($user_trlist==4) 
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Window Box QR Code already Linked. Please try again.";
				echo json_encode($response);
			}
			else if($user_trlist==5) 
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Master Pack QR Code already Linked. Please try again.";
				echo json_encode($response);
			}
			else if($user_trlist==6) 
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Master Pack Barcode already Linked. Please try again.";
				echo json_encode($response);
			}
			else if($user_trlist==7) 
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Invalid Scan TYpe. Please try again.";
				echo json_encode($response);
			}
			else
			{
				$response["status"] = FALSE;
				$user_wbdetails=$db->GetLMCWBDetails($scode, $cropname, $varietyname, $ups);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["user"]=$user_wbdetails;
				}
				else
				{
					$response["user"]=array();
				}
				$response["msg"] = "Unable to update.\n Reason:\n1. QR Code/Barcode is already Scanned.\n2. QR Code/Barcode not found in system";
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
