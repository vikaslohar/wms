<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if(isset($_REQUEST['extbarcode']) && isset($_REQUEST['newbarcode'])) {

    // receiving the post params
    $scode = $_REQUEST['scode'];
	$mobile1 = $_REQUEST['mobile1'];
	$extqrcode = $_REQUEST['extbarcode'];
	$newqrcode = $_REQUEST['newbarcode'];
	
	$flg=0;
	if($newqrcode!="")
	{
		$qrcode2=str_split($newqrcode);
		
		if(count($qrcode2)!=11)
		{
			$response["status"] = FALSE;
			$response["msg"] = "Invalid BarCode";
			
			echo json_encode($response);
			$flg++;
		}
		else
		{
			$chk_barcode = $db->isBarCodeExisted($newqrcode);
			//	print_r($user_login);
			if ($chk_barcode != false) 
			{
				$response["status"] = FALSE;
				$response["msg"] = "BarCode Already Present in System";
				
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
					
					echo json_encode($response);
					$flg++;
				}
				if(!is_numeric($qrnum))
				{
					$response["status"] = FALSE;
					$response["msg"] = "BarCode";
					
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
			$user_trlist = $db->GetBarcodeUpdate($scode, $extqrcode, $newqrcode);
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
				$response["msg"] = "Barcode can not be updated. Please Try Again";
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
