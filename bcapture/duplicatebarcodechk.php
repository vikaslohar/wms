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
	$trid = $_REQUEST['trid'];
	$position = $_REQUEST['position'];
	$flg=0;

	$qrcode2=str_split($qrcode);


	if(count($qrcode2)!=11)
	{
		$response["status"] = FALSE;
		$response["msg"] = "Invalid BarCode";
		echo json_encode($response);
		$flg++;
	}
	else
	{
		$chk_barcode = $db->isBarCodeExisted($qrcode, $trid, $position);
		//	print_r($chk_barcode);
		if ($chk_barcode != false) 
		{
			if($chk_barcode==1){
				$response["status"] = FALSE;
				$response["msg"] = "This barcode is already listed as missed in another transaction.You cannot use this barcode.";
				echo json_encode($response);
				$flg++;
			}else{
				$response["status"] = FALSE;
				$response["msg"] = "BarCode Already Present in System";
				echo json_encode($response);
				$flg++;
			}
			
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
			else if(!is_numeric($qrnum))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid BarCode";
				echo json_encode($response);
				$flg++;
			}
			else
			{
				$response["status"] = TRUE;
				$response["msg"]="Success";
				//$response["user"] = $user_trlist;
				echo json_encode($response);
			}
					
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
