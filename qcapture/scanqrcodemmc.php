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
	$mptype = $_REQUEST['packtype'];
	$grosswt = $_REQUEST['grosswt'];
	
	$flg=0;
	if($scantype!="mpbarcode")
	{
		$qrcode2=str_split($qrcode);
		//echo count($qrcode2);
		if(count($qrcode2)!=13)
		{
			$response["status"] = FALSE;
			$response["msg"] = "Invalid QR Code";
			
			$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
			$response["user"] = $user_mmcdetails;
			$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
			//	print_r($user_login);
			if ($user_wbdetails != false) 
			{
				$response["lotarray"]=$user_wbdetails;
			}
			else
			{
				$response["lotarray"]=array();
			}
			echo json_encode($response);
			$flg++;
		}
		else
		{
			$qrchar=$qrcode2[0].$qrcode2[1];
			$qrnum=$qrcode2[2].$qrcode2[3].$qrcode2[4].$qrcode2[5].$qrcode2[6].$qrcode2[7].$qrcode2[8].$qrcode2[9].$qrcode2[10].$qrcode2[11].$qrcode2[12];			
			if(is_numeric($qrchar))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid QR Code";
				
				$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
				$response["user"] = $user_mmcdetails;
				$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["lotarray"]=$user_wbdetails;
				}
				else
				{
					$response["lotarray"]=array();
				}
				echo json_encode($response);
				$flg++;
			}
			if(!is_numeric($qrnum))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid QR Code";
				
				$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
				$response["user"] = $user_mmcdetails;
				$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["lotarray"]=$user_wbdetails;
				}
				else
				{
					$response["lotarray"]=array();
				}
				echo json_encode($response);
				$flg++;
			}
		}
	}
	else
	{
		$qrcode2=str_split($qrcode);
		
		if(count($qrcode2)!=11)
		{
			$response["status"] = FALSE;
			$response["msg"] = "Invalid BarCode";
			
			$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
			$response["user"] = $user_mmcdetails;
			$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
			//	print_r($user_login);
			if ($user_wbdetails != false) 
			{
				$response["lotarray"]=$user_wbdetails;
			}
			else
			{
				$response["lotarray"]=array();
			}
			echo json_encode($response);
			$flg++;
		}
		else
		{
			$chk_barcode = $db->isBarCodeExisted($qrcode);
			//	print_r($user_login);
			if ($chk_barcode != false) 
			{
				$response["status"] = FALSE;
				$response["msg"] = "BarCode Already Present in System";
				
				$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
				$response["user"] = $user_mmcdetails;
				$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["lotarray"]=$user_wbdetails;
				}
				else
				{
					$response["lotarray"]=array();
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
					$response["msg"] = "Invalid BarCode";
					
					$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
					$response["user"] = $user_mmcdetails;
					$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
					//	print_r($user_login);
					if ($user_wbdetails != false) 
					{
						$response["lotarray"]=$user_wbdetails;
					}
					else
					{
						$response["lotarray"]=array();
					}
					echo json_encode($response);
					$flg++;
				}
				if(!is_numeric($qrnum))
				{
					$response["status"] = FALSE;
					$response["msg"] = "Invalid BarCode";
					
					$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
					$response["user"] = $user_mmcdetails;
					$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
					//	print_r($user_login);
					if ($user_wbdetails != false) 
					{
						$response["lotarray"]=$user_wbdetails;
					}
					else
					{
						$response["lotarray"]=array();
					}
					echo json_encode($response);
					$flg++;
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
			$user_trlist = $db->GetMMCQRcodeUpdate($scode, $trid, $scantype, $qrcode, $grosswt, $mptype);
			//	print_r($user_trlist); exit;
			if($user_trlist != false) 
			{
				$response["status"] = TRUE;
				$response["msg"]="Success";
				
				$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
				$response["user"] = $user_mmcdetails;
				
				$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
				//	print_r($user_login);
				if ($user_wbdetails != false) 
				{
					$response["lotarray"]=$user_wbdetails;
				}
				else
				{
					$response["lotarray"]=array();
				}
				
				echo json_encode($response);
			}
			else
			{
				$response["status"] = FALSE;
				$user_mmcdetails=$db->GetMMCqtDetails($scode,$mptype);
				$response["user"] = $user_mmcdetails;
				$user_wbdetails=$db->GetMMCWBDetails($scode, $mptype);
				//	print_r($user_wbdetails); exit;
				if ($user_wbdetails != false) 
				{
					$response["lotarray"]=$user_wbdetails;
				}
				else
				{
					$response["lotarray"]=array();
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
			$response["lotarray"]=array();
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
	$response["lotarray"]=array();
    $response["msg"] = "Required parameters missing";
    echo json_encode($response);
}
?>
