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
	$trtype = $_REQUEST['trtype'];
	$qrcode = $_REQUEST['qrcode'];
	$cropname = $_REQUEST['cropname'];
	$varietyname = $_REQUEST['varietyname'];
	$ups = $_REQUEST['ups'];
	
	$flg=0;
	
	$qrcode2=str_split($qrcode);
	
	
	if(count($qrcode2)!=11)
	{
		$response["status"] = FALSE;
		$response["msg"] = "Invalid BarCode";
		
		$user_wbdetails=$db->GetWBDetailsOFL($trid);
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
		$chk_barcode = $db->isDelBarCodeExistedOFL($qrcode,$trid);
		//print_r($user_login);
		if ($chk_barcode == false) 
		{
			$response["status"] = FALSE;
			$response["msg"] = "Unable to Delete.\n Reason:\n1. Barcode has been linked with another lot no.\n2. Barcode not found in system";
			
			$user_wbdetails=$db->GetWBDetailsOFL($trid);
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
				$response["msg"] = "Invalid BarCode";
				
				$user_wbdetails=$db->GetWBDetailsOFL($trid);
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
				$response["msg"] = "Invalid BarCode";
				
				$user_wbdetails=$db->GetWBDetailsOFL($trid);
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
//echo $trtype;	exit;
	if($flg==0)
	{
		$user_login = $db->isUserExisted($scode);
		//	print_r($user_login);
		if ($user_login != false) 
		{
			//user is found
			$user_trlist = $db->GetQRcodeDeleteOFL($scode, $trid, $scantype, $qrcode, $trtype);
			//	print_r($user_trlist); exit;
			if ($user_trlist != false) 
			{
				if($user_trlist!=8)
				{				
					$response["status"] = TRUE;
					$response["msg"]="Success";
					//$response["user"] = $user_trlist;
					//$cropname=$user_trlist[0]; $varietyname=$user_trlist[1]; $ups=$user_trlist[2];
					if($trid>0)
					{
						$user_wbdetails=$db->GetWBDetailsOFL($trid);
						//	print_r($user_wbdetails);exit;
						if ($user_wbdetails != false) 
						{
							$response["user"]=$user_wbdetails;
						}
						else
						{
							$response["user"]=array();
						}
					}
					
				}
				else
				{
					$response["status"] = FALSE;
					if($trid>0)
					{
						$user_wbdetails=$db->GetWBDetailsOFL($trid);
						//	print_r($user_login);
						if ($user_wbdetails != false) 
						{
							$response["user"]=$user_wbdetails;
						}
						else
						{
							$response["user"]=array();
						}
					}
					$response["msg"] = "Unable to Delete.\n Reason:\n1. Barcode is already Deleted.\n2. Barcode not found in system";
					echo json_encode($response);
				}
				echo json_encode($response);
			}
			else
			{
				$response["status"] = FALSE;
				if($trid>0)
				{
					$user_wbdetails=$db->GetWBDetailsOFL($trid);
					//	print_r($user_login);
					if ($user_wbdetails != false) 
					{
						$response["user"]=$user_wbdetails;
					}
					else
					{
						$response["user"]=array();
					}
				}
				$response["msg"] = "Unable to Delete.\n Reason:\n1. Barcode is already Deleted.\n2. Barcode not found in system";
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
