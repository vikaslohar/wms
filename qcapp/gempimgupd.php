<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("status" => FALSE);

if (isset($_REQUEST['mobile1'])) {

    // receiving the post params
    $email = $_REQUEST['mobile1'];
	$sampleno = $_REQUEST['sampleno'];
	$scode = $_REQUEST['scode'];
	$oprid = $_REQUEST['oprid'];

	if (isset($_REQUEST['testtype'])) {$testtype = $_REQUEST['testtype'];} else { $testtype = '';}
	if (isset($_REQUEST['observation'])) {$observation = $_REQUEST['observation'];} else { $observation = '';}
	
	
	
	$ImageString = "image";//$_REQUEST['image'];
	
	$imgpath="../qcimages/";
	$location="../qcimages/";
	//if ($_FILES['image']['error'] == 4 || ($_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 0))
	{
		$new_retImageString_ret = "";
	}
	if(isset($_FILES["image"]))
	{
		$image_name_ret = $_FILES["image"]["name"]; 
		$tmp_arr = explode(".",$image_name_ret);
		$img_extn = end($tmp_arr);
		if($ImageString=="image")
		{ 
			if($testtype=="FGT")
			{
				if($observation=="First Count")
				{$new_retImageString_ret = $sampleno.'_fgtfcimage'.'.'.$img_extn; }
				else 
				{$new_retImageString_ret = $sampleno.'_fgtimage'.'.'.$img_extn; }   
			}
			else if($testtype=="SGT")
			{
				if($observation=="First Count")
				{$new_retImageString_ret = $sampleno.'_sgtfcimage'.'.'.$img_extn;} 
				else
				{$new_retImageString_ret = $sampleno.'_sgtimage'.'.'.$img_extn;}   
			}
			else
			{
				if($observation=="First Count")
				{$new_retImageString_ret = $sampleno.'_sgtdfcimage'.'.'.$img_extn;} 
				else
				{$new_retImageString_ret = $sampleno.'_sgtdimage'.'.'.$img_extn;}   
			}
		}
		$path=$imgpath.$new_retImageString_ret;
		 // Compress Image
		//compressedImage($_FILES['retImageString']['tmp_name'],$path,75);

		move_uploaded_file($_FILES["image"]["tmp_name"],$imgpath.$new_retImageString_ret);
	}
	
	$user_login = $db->GetGempImgDataUpdate($sampleno, $testtype, $observation, $new_retImageString_ret, $oprid);
	//print_r($user_login); exit;
	if ($user_login != false) 
	{
		//print_r($user_compflg);
		$response["status"] = TRUE;
		$response["msg"]="Success";
		//$response["user"]["samplegemparray"] =$user_login;
		//$response["user"]["name"] = $user_compflg["name"];
		echo json_encode($response);
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["msg"] = "Image not Updated for this Sample No.";
		echo json_encode($response);
	}
} 
else 
{
    // required post params is missing
    $response["status"] = FALSE;
    $response["msg"] = "Required parameters Username or password is missing";
    echo json_encode($response);
}
?>
