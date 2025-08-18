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
	$samplewt = $_REQUEST['samplewt'];
	$pureseed = $_REQUEST['pureseed'];
	$pureseedper = $_REQUEST['pureseedper'];
	$imseed = $_REQUEST['imseed'];
	$imseedper = $_REQUEST['imseedper'];
	$lightseed = $_REQUEST['lightseed'];
	$lightseedper = $_REQUEST['lightseedper'];
	$ocseedno = $_REQUEST['ocseedno'];
	$ocseedinkg = $_REQUEST['ocseedinkg'];
	$odvseedno = $_REQUEST['odvseedno'];
	$odvseedinkg = $_REQUEST['odvseedinkg'];
	$dcseed = $_REQUEST['dcseed'];
	$dcseedper = $_REQUEST['dcseedper'];
	$phseedno = $_REQUEST['phseedno'];
	$phseedinkg = $_REQUEST['phseedinkg'];
	$ppphoto = '';//$_REQUEST['image'];
	$scode = $_REQUEST['scode'];
	$ImageString = "image";//$_REQUEST['image'];
	$oprid = $_REQUEST['oprid'];
	
	
	$gsseedno = $_REQUEST['totalnoinsample_germp'];
	$gsseedinkg = $_REQUEST['tobeexnoperkg_germp'];
	$gsseedwt = $_REQUEST['germp_wt'];
	$gsseedper = $_REQUEST['germp_wt_per'];
	$gsremark = $_REQUEST['germp_remarks'];
	$ocseedwt = $_REQUEST['ocs_wt'];
	$ocseedper = $_REQUEST['ocs_wt_per'];
	$ocremark = $_REQUEST['ocs_remarks'];
	$odvseedwt = $_REQUEST['odv_wt'];
	$odvseedper = $_REQUEST['odv_wt_per'];
	$odvremark = $_REQUEST['odv_remarks'];
	$odv1010 = $_REQUEST['odv_1010'];
	$odvfinegrain = $_REQUEST['odv_fineGrain'];
	$odvboldgrain = $_REQUEST['odv_boldGrain'];
	$odvlonggrain = $_REQUEST['odv_longGrain'];
	$odvothertype = $_REQUEST['odv_otherTyp'];
	$odvtotal = $_REQUEST['odv_total'];
	$odvtotalper = $_REQUEST['odv_total_per'];
	$phseedwt = $_REQUEST['pinhole_wt'];
	$phseedper = $_REQUEST['pinhole_wt_per'];
	$phremark = $_REQUEST['pinhole_remarks'];
	
	
	
	
	
	
	$imgpath="../qcimages/";
	$location="../qcimages/";
	//if ($_FILES['image']['error'] == 4 || ($_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 0))
	{
		$new_retImageString_ret = "";
	}
	if(isset($_FILE["image"]))	
	{
		$image_name_ret = $_FILES["image"]["name"]; 
		$tmp_arr = explode(".",$image_name_ret);
		$img_extn = end($tmp_arr);
		if($ImageString=="image")
		{ $new_retImageString_ret = $sampleno.'_ppimage'.'.'.$img_extn;    }
		$path=$imgpath.$new_retImageString_ret;
		 // Compress Image
		//compressedImage($_FILES['retImageString']['tmp_name'],$path,75);

		move_uploaded_file($_FILES["image"]["tmp_name"],$imgpath.$new_retImageString_ret);
	}



	$user_login = $db->GetSamplePPUpdate($sampleno, $samplewt, $pureseed, $pureseedper, $imseed, $imseedper, $lightseed, $lightseedper, $ocseedno, $ocseedinkg, $odvseedno, $odvseedinkg, $dcseed, $dcseedper, $phseedno, $phseedinkg, $ppphoto, $scode, $new_retImageString_ret, $gsseedno,$gsseedinkg,$gsseedwt,$gsseedper,$ocseedwt,$ocseedper,$ocremark,$odvseedwt,$odvseedper,$odvremark,$odv1010,$odvfinegrain,$odvboldgrain,$odvlonggrain,$odvothertype,$odvtotal,$odvtotalper,$phseedwt,$phseedper,$phremark, $gsremark, $oprid);
	//print_r($user_login); exit;
	if ($user_login != FALSE) 
	{
		//print_r($user_compflg);
		$response["status"] = TRUE;
		$response["msg"]="Success";
		//$response["user"]["samplemoistarray"] =$user_login;
		//$response["user"]["name"] = $user_compflg["name"];
		echo json_encode($response);
	}
	else
	{
		// user is not found with the credentials
		$response["status"] = FALSE;
		$response["msg"] = "Data not Updated for this Sample No.";
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
