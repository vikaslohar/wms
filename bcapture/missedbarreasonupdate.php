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
	$reason = $_REQUEST['reason'];
	$flg=0;

	$qrcode2=str_split($qrcode);
	
	/*$response["status"] = TRUE;
	$response["msg"] = $reason;
	echo json_encode($response);*/

	/*if(strlen($qrcode)!=11)
	{
		$response["status"] = FALSE;
		$response["msg"] = "Invalid BarCode1";
		echo json_encode($response);
		$flg++;
	}
	else
	{*/
		$chk_barcode = $db->updateReason($qrcode, $trid, $reason);
		//print_r($chk_barcode."dsafsdfdsfs");exit;
		if ($chk_barcode != 1) 
		{
			$response["status"] = TRUE;
			$response["msg"] = "Success";
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
				echo json_encode($response);
			}
			else if(!is_numeric($qrnum))
			{
				$response["status"] = FALSE;
				$response["msg"] = "Invalid BarCode3";
				echo json_encode($response);
			}
			else
			{
				$response["status"] = FALSE;
				$response["msg"] = "Reason not updated4";
				echo json_encode($response);
			}		
		}
	//}
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
