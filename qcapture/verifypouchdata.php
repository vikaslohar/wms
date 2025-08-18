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
	$labelno = $_REQUEST['labelno'];
	
	//exit;
	
	
		$user_login = $db->isUserExisted($scode);
		//print_r($user_login);
		if ($user_login != false) 
		{
			$user_trlist = $db->updateDataVerification($scode, $trid);
				//print_r($user_trlist); exit;
				if ($user_trlist != false) 
				{
					$imgpath="../bcaptureimages/";
					$location="../bcaptureimages/";
					if(isset($_FILES["image"]))
					{
						$image_name_ret = $_FILES["image"]["name"]; 
						$tmp_arr = explode(".",$image_name_ret);
						$img_extn = end($tmp_arr);
						
						$new_retImageString_ret = $labelno.'.'.$img_extn;
						
						$path=$imgpath.$new_retImageString_ret;
						 // Compress Image
						//compressedImage($_FILES['retImageString']['tmp_name'],$path,75);
				
						move_uploaded_file($_FILES["image"]["tmp_name"],$imgpath.$new_retImageString_ret);
					}
					$response["status"] = TRUE;
					$response["msg"]="Success";
					//$response["user"] = $user_trlist;
					echo json_encode($response);
				}
				else
				{
					$response["status"] = FALSE;
					$response["msg"] = "Unable to update";
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
else 
{
    // required post params is missing
    $response["status"] = FALSE;
	$response["user"]=array();
    $response["msg"] = "Required parameters missing";
    echo json_encode($response);
}

?>
