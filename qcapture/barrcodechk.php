<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if(isset($_REQUEST['barcode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$qrcode = $_REQUEST['barcode'];
	$scanAction = $_REQUEST['scanAction'];
	
	$flg=0;
	if($qrcode!="")
	{
		$qrcode2=str_split($qrcode);
		
		if(count($qrcode2)!=11)
		{
			$response["status"] = FALSE;
			$response["msg"] = "Invalid BarCode1";
			
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
				$response["msg"] = "BarCode cannot be updated as Packing slip already finalised";
				
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
					$response["msg"] = "Invalid BarCode2";
					
					echo json_encode($response);
					$flg++;
				}
				if(!is_numeric($qrnum))
				{
					$response["status"] = FALSE;
					$response["msg"] = "Invalid BarCode3";
					
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
			if($scanAction=="Existing")
			{
				// user is found
				$user_trlist = $db->GetExtBarcodeDetails($scode, $qrcode);
				//	print_r($user_trlist); exit;
				//if ($user_trlist != false) 
				{
					if($user_trlist==0)
					{
						$response["status"] = FALSE;
						$response["msg"] = "Barcode not found in system";
						echo json_encode($response);
					}
					else if($user_trlist==1)
					{
						$response["status"] = TRUE;
						$response["msg"]="Success";
						$user_brdet = $db->GetBarCodeDetails($qrcode);
						if ($user_brdet != false) 
						{
							$response["barcodedetails"]=$user_brdet;
						}
						echo json_encode($response);
					}
					else if($user_trlist==2)
					{
						$response["status"] = FALSE;
						$response["msg"] = "Packing Slip Transaction Finalized";
						echo json_encode($response);
					}
					else
					{
						$response["status"] = FALSE;
						$response["msg"] = "Barcode not found in system";
						echo json_encode($response);
					}
				}
				/*else
				{
					$response["status"] = FALSE;
					$response["msg"] = "Barcode issue";
					echo json_encode($response);
				}*/
			}
			else
			{
				// user is found
				$user_trlist = $db->GetNewBarcodeDetails($scode, $qrcode);
				//	print_r($user_login);
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
					$response["msg"] = "Barcode already present in application";
					echo json_encode($response);
				}
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
