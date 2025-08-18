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
	$session_id = '';
	$device_id = '';
	$sampleno = $_REQUEST['sampleno'];
	$scode = $_REQUEST['scode'];
	$oprid = $_REQUEST['oprid'];

	if (isset($_REQUEST['testtype'])) {$testtype = $_REQUEST['testtype'];} else { $testtype = '';}
	if (isset($_REQUEST['sgtfcfltype'])) {$sgtfcfltype = $_REQUEST['sgtfcfltype'];} else { $sgtfcfltype = '';}
	if (isset($_REQUEST['fgtfcfltype'])) {$fgtfcfltype = $_REQUEST['fgtfcfltype'];} else { $fgtfcfltype = '';}
	if (isset($_REQUEST['fgtmtype'])) {$fgtmtype = $_REQUEST['fgtmtype'];} else { $fgtmtype = '';}
	
	if (isset($_REQUEST['seedsize'])) {$seedsize = $_REQUEST['seedsize'];} else { $seedsize = 0;}
	if (isset($_REQUEST['noofseedinonerep'])) {$noofseedinonerep = $_REQUEST['noofseedinonerep'];} else { $noofseedinonerep = 0;}
	if (isset($_REQUEST['noofseedinonerepfgt'])) {$noofseedinonerepfgt = $_REQUEST['noofseedinonerepfgt'];} else { $noofseedinonerepfgt = 0;}
	if (isset($_REQUEST['sgtnoofrep'])) {$sgtnoofrep = $_REQUEST['sgtnoofrep'];} else { $sgtnoofrep = 0;}
	
	if (isset($_REQUEST['sgtoobnormal1'])) {$sgtoobnormal1 = $_REQUEST['sgtoobnormal1'];} else { $sgtoobnormal1 = 0;}
	if (isset($_REQUEST['sgtoobnormal2'])) {$sgtoobnormal2 = $_REQUEST['sgtoobnormal2'];} else { $sgtoobnormal2 = 0;}
	if (isset($_REQUEST['sgtoobnormal3'])) {$sgtoobnormal3 = $_REQUEST['sgtoobnormal3'];} else { $sgtoobnormal3 = 0;}
	if (isset($_REQUEST['sgtoobnormal4'])) {$sgtoobnormal4 = $_REQUEST['sgtoobnormal4'];} else { $sgtoobnormal4 = 0;}
	if (isset($_REQUEST['sgtoobnormal5'])) {$sgtoobnormal5 = $_REQUEST['sgtoobnormal5'];} else { $sgtoobnormal5 = 0;}
	if (isset($_REQUEST['sgtoobnormal6'])) {$sgtoobnormal6 = $_REQUEST['sgtoobnormal6'];} else { $sgtoobnormal6 = 0;}
	if (isset($_REQUEST['sgtoobnormal7'])) {$sgtoobnormal7 = $_REQUEST['sgtoobnormal7'];} else { $sgtoobnormal7 = 0;}
	if (isset($_REQUEST['sgtoobnormal8'])) {$sgtoobnormal8 = $_REQUEST['sgtoobnormal8'];} else { $sgtoobnormal8 = 0;}
	if (isset($_REQUEST['sgtoobnormalavg'])) {$sgtoobnormalavg = $_REQUEST['sgtoobnormalavg'];} else { $sgtoobnormalavg = 0;}
	if (isset($_REQUEST['sgtoobnormaldt'])) {$sgtoobnormaldt = $_REQUEST['sgtoobnormaldt'];} else { $sgtoobnormaldt = '';}
	
	if (isset($_REQUEST['sgtnormal1'])) {$sgtnormal1 = $_REQUEST['sgtnormal1'];} else { $sgtnormal1 = 0;}
	if (isset($_REQUEST['sgtnormal2'])) {$sgtnormal2 = $_REQUEST['sgtnormal2'];} else { $sgtnormal2 = 0;}
	if (isset($_REQUEST['sgtnormal3'])) {$sgtnormal3 = $_REQUEST['sgtnormal3'];} else { $sgtnormal3 = 0;}
	if (isset($_REQUEST['sgtnormal4'])) {$sgtnormal4 = $_REQUEST['sgtnormal4'];} else { $sgtnormal4 = 0;}
	if (isset($_REQUEST['sgtnormal5'])) {$sgtnormal5 = $_REQUEST['sgtnormal5'];} else { $sgtnormal5 = 0;}
	if (isset($_REQUEST['sgtnormal6'])) {$sgtnormal6 = $_REQUEST['sgtnormal6'];} else { $sgtnormal6 = 0;}
	if (isset($_REQUEST['sgtnormal7'])) {$sgtnormal7 = $_REQUEST['sgtnormal7'];} else { $sgtnormal7 = 0;}
	if (isset($_REQUEST['sgtnormal8'])) {$sgtnormal8 = $_REQUEST['sgtnormal8'];} else { $sgtnormal8 = 0;}
	
	if (isset($_REQUEST['sgtnormalb1'])) {$sgtnormalb1 = $_REQUEST['sgtnormalb1'];} else { $sgtnormalb1 = 0;}
	if (isset($_REQUEST['sgtnormalb2'])) {$sgtnormalb2 = $_REQUEST['sgtnormalb2'];} else { $sgtnormalb2 = 0;}
	if (isset($_REQUEST['sgtnormalb3'])) {$sgtnormalb3 = $_REQUEST['sgtnormalb3'];} else { $sgtnormalb3 = 0;}
	if (isset($_REQUEST['sgtnormalb4'])) {$sgtnormalb4 = $_REQUEST['sgtnormalb4'];} else { $sgtnormalb4 = 0;}
	if (isset($_REQUEST['sgtnormalb5'])) {$sgtnormalb5 = $_REQUEST['sgtnormalb5'];} else { $sgtnormalb5 = 0;}
	if (isset($_REQUEST['sgtnormalb6'])) {$sgtnormalb6 = $_REQUEST['sgtnormalb6'];} else { $sgtnormalb6 = 0;}
	if (isset($_REQUEST['sgtnormalb7'])) {$sgtnormalb7 = $_REQUEST['sgtnormalb7'];} else { $sgtnormalb7 = 0;}
	if (isset($_REQUEST['sgtnormalb8'])) {$sgtnormalb8 = $_REQUEST['sgtnormalb8'];} else { $sgtnormalb8 = 0;}
	
	if (isset($_REQUEST['sgtnormalavga'])) {$sgtnormalavga = $_REQUEST['sgtnormalavga'];} else { $sgtnormalavga = 0;}
	if (isset($_REQUEST['sgtnormalavgb'])) {$sgtnormalavgb = $_REQUEST['sgtnormalavgb'];} else { $sgtnormalavgb = 0;}
	
	if (isset($_REQUEST['sgtnormalavg'])) {$sgtnormalavg = $_REQUEST['sgtnormalavg'];} else { $sgtnormalavg = 0;}
	if (isset($_REQUEST['sgtabnormal1'])) {$sgtabnormal1 = $_REQUEST['sgtabnormal1'];} else { $sgtabnormal1 = 0;}
	if (isset($_REQUEST['sgtabnormal2'])) {$sgtabnormal2 = $_REQUEST['sgtabnormal2'];} else { $sgtabnormal2 = 0;}
	if (isset($_REQUEST['sgtabnormal3'])) {$sgtabnormal3 = $_REQUEST['sgtabnormal3'];} else { $sgtabnormal3 = 0;}
	if (isset($_REQUEST['sgtabnormal4'])) {$sgtabnormal4 = $_REQUEST['sgtabnormal4'];} else { $sgtabnormal4 = 0;}
	if (isset($_REQUEST['sgtabnormal5'])) {$sgtabnormal5 = $_REQUEST['sgtabnormal5'];} else { $sgtabnormal5 = 0;}
	if (isset($_REQUEST['sgtabnormal6'])) {$sgtabnormal6 = $_REQUEST['sgtabnormal6'];} else { $sgtabnormal6 = 0;}
	if (isset($_REQUEST['sgtabnormal7'])) {$sgtabnormal7 = $_REQUEST['sgtabnormal7'];} else { $sgtabnormal7 = 0;}
	if (isset($_REQUEST['sgtabnormal8'])) {$sgtabnormal8 = $_REQUEST['sgtabnormal8'];} else { $sgtabnormal8 = 0;}
	if (isset($_REQUEST['sgtabnormalavg'])) {$sgtabnormalavg = $_REQUEST['sgtabnormalavg'];} else { $sgtabnormalavg = 0;}
	if (isset($_REQUEST['sgthardfug1'])) {$sgthardfug1 = $_REQUEST['sgthardfug1'];} else { $sgthardfug1 = 0;}
	if (isset($_REQUEST['sgthardfug2'])) {$sgthardfug2 = $_REQUEST['sgthardfug2'];} else { $sgthardfug2 = 0;}
	if (isset($_REQUEST['sgthardfug3'])) {$sgthardfug3 = $_REQUEST['sgthardfug3'];} else { $sgthardfug3 = 0;}
	if (isset($_REQUEST['sgthardfug4'])) {$sgthardfug4 = $_REQUEST['sgthardfug4'];} else { $sgthardfug4 = 0;}
	if (isset($_REQUEST['sgthardfug5'])) {$sgthardfug5 = $_REQUEST['sgthardfug5'];} else { $sgthardfug5 = 0;}
	if (isset($_REQUEST['sgthardfug6'])) {$sgthardfug6 = $_REQUEST['sgthardfug6'];} else { $sgthardfug6 = 0;}
	if (isset($_REQUEST['sgthardfug7'])) {$sgthardfug7 = $_REQUEST['sgthardfug7'];} else { $sgthardfug7 = 0;}
	if (isset($_REQUEST['sgthardfug8'])) {$sgthardfug8 = $_REQUEST['sgthardfug8'];} else { $sgthardfug8 = 0;}
	if (isset($_REQUEST['sgthardfugavg'])) {$sgthardfugavg = $_REQUEST['sgthardfugavg'];} else { $sgthardfugavg = 0;}
	
	if (isset($_REQUEST['sgtfug1'])) {$sgtfug1 = $_REQUEST['sgtfug1'];} else { $sgtfug1 = 0;}
	if (isset($_REQUEST['sgtfug2'])) {$sgtfug2 = $_REQUEST['sgtfug2'];} else { $sgtfug2 = 0;}
	if (isset($_REQUEST['sgtfug3'])) {$sgtfug3 = $_REQUEST['sgtfug3'];} else { $sgtfug3 = 0;}
	if (isset($_REQUEST['sgtfug4'])) {$sgtfug4 = $_REQUEST['sgtfug4'];} else { $sgtfug4 = 0;}
	if (isset($_REQUEST['sgtfug5'])) {$sgtfug5 = $_REQUEST['sgtfug5'];} else { $sgtfug5 = 0;}
	if (isset($_REQUEST['sgtfug6'])) {$sgtfug6 = $_REQUEST['sgtfug6'];} else { $sgtfug6 = 0;}
	if (isset($_REQUEST['sgtfug7'])) {$sgtfug7 = $_REQUEST['sgtfug7'];} else { $sgtfug7 = 0;}
	if (isset($_REQUEST['sgtfug8'])) {$sgtfug8 = $_REQUEST['sgtfug8'];} else { $sgtfug8 = 0;}
	if (isset($_REQUEST['sgtfugavg'])) {$sgtfugavg = $_REQUEST['sgtfugavg'];} else { $sgtfugavg = 0;}
	
	if (isset($_REQUEST['sgtdead1'])) {$sgtdead1 = $_REQUEST['sgtdead1'];} else { $sgtdead1 = 0;}
	if (isset($_REQUEST['sgtdead2'])) {$sgtdead2 = $_REQUEST['sgtdead2'];} else { $sgtdead2 = 0;}
	if (isset($_REQUEST['sgtdead3'])) {$sgtdead3 = $_REQUEST['sgtdead3'];} else { $sgtdead3 = 0;}
	if (isset($_REQUEST['sgtdead4'])) {$sgtdead4 = $_REQUEST['sgtdead4'];} else { $sgtdead4 = 0;}
	if (isset($_REQUEST['sgtdead5'])) {$sgtdead5 = $_REQUEST['sgtdead5'];} else { $sgtdead5 = 0;}
	if (isset($_REQUEST['sgtdead6'])) {$sgtdead6 = $_REQUEST['sgtdead6'];} else { $sgtdead6 = 0;}
	if (isset($_REQUEST['sgtdead7'])) {$sgtdead7 = $_REQUEST['sgtdead7'];} else { $sgtdead7 = 0;}
	if (isset($_REQUEST['sgtdead8'])) {$sgtdead8 = $_REQUEST['sgtdead8'];} else { $sgtdead8 = 0;}
	if (isset($_REQUEST['sgtdeadavg'])) {$sgtdeadavg = $_REQUEST['sgtdeadavg'];} else { $sgtdeadavg = 0;}
	if (isset($_REQUEST['sgtdt'])) {$sgtdt = $_REQUEST['sgtdt'];} else { $sgtdt = '';}
	if (isset($_REQUEST['sgtgermp'])) {$sgtgermp = $_REQUEST['sgtgermp'];} else { $sgtgermp = '';}
	if (isset($_REQUEST['sgtvremark'])) {$sgtvremark = $_REQUEST['sgtvremark'];} else { $sgtvremark = '';}
	
	if (isset($_REQUEST['fgtnoofrep'])) {$fgtnoofrep = $_REQUEST['fgtnoofrep'];} else { $fgtnoofrep = 0;}
	
	if (isset($_REQUEST['fgtoobnormal1'])) {$fgtoobnormal1 = $_REQUEST['fgtoobnormal1'];} else { $fgtoobnormal1 = 0;}
	if (isset($_REQUEST['fgtoobnormal2'])) {$fgtoobnormal2 = $_REQUEST['fgtoobnormal2'];} else { $fgtoobnormal2 = 0;}
	if (isset($_REQUEST['fgtoobnormal3'])) {$fgtoobnormal3 = $_REQUEST['fgtoobnormal3'];} else { $fgtoobnormal3 = 0;}
	if (isset($_REQUEST['fgtoobnormal4'])) {$fgtoobnormal4 = $_REQUEST['fgtoobnormal4'];} else { $fgtoobnormal4 = 0;}
	if (isset($_REQUEST['fgtoobnormal5'])) {$fgtoobnormal5 = $_REQUEST['fgtoobnormal5'];} else { $fgtoobnormal5 = 0;}
	if (isset($_REQUEST['fgtoobnormal6'])) {$fgtoobnormal6 = $_REQUEST['fgtoobnormal6'];} else { $fgtoobnormal6 = 0;}
	if (isset($_REQUEST['fgtoobnormal7'])) {$fgtoobnormal7 = $_REQUEST['fgtoobnormal7'];} else { $fgtoobnormal7 = 0;}
	if (isset($_REQUEST['fgtoobnormal8'])) {$fgtoobnormal8 = $_REQUEST['fgtoobnormal8'];} else { $fgtoobnormal8 = 0;}
	if (isset($_REQUEST['fgtoobnormalavg'])) {$fgtoobnormalavg = $_REQUEST['fgtoobnormalavg'];} else { $fgtoobnormalavg = 0;}
	if (isset($_REQUEST['fgtoobnormaldt'])) {$fgtoobnormaldt = $_REQUEST['fgtoobnormaldt'];} else { $fgtoobnormaldt = '';}
	
	if (isset($_REQUEST['fgtnormal1'])) {$fgtnormal1 = $_REQUEST['fgtnormal1'];} else { $fgtnormal1 = 0;}
	if (isset($_REQUEST['fgtnormal2'])) {$fgtnormal2 = $_REQUEST['fgtnormal2'];} else { $fgtnormal2 = 0;}
	if (isset($_REQUEST['fgtnormal3'])) {$fgtnormal3 = $_REQUEST['fgtnormal3'];} else { $fgtnormal3 = 0;}
	if (isset($_REQUEST['fgtnormal4'])) {$fgtnormal4 = $_REQUEST['fgtnormal4'];} else { $fgtnormal4 = 0;}
	if (isset($_REQUEST['fgtnormal5'])) {$fgtnormal5 = $_REQUEST['fgtnormal5'];} else { $fgtnormal5 = 0;}
	if (isset($_REQUEST['fgtnormal6'])) {$fgtnormal6 = $_REQUEST['fgtnormal6'];} else { $fgtnormal6 = 0;}
	if (isset($_REQUEST['fgtnormal7'])) {$fgtnormal7 = $_REQUEST['fgtnormal7'];} else { $fgtnormal7 = 0;}
	if (isset($_REQUEST['fgtnormal8'])) {$fgtnormal8 = $_REQUEST['fgtnormal8'];} else { $fgtnormal8 = 0;}
	
	if (isset($_REQUEST['fgtnormalb1'])) {$fgtnormalb1 = $_REQUEST['fgtnormalb1'];} else { $fgtnormalb1 = 0;}
	if (isset($_REQUEST['fgtnormalb2'])) {$fgtnormalb2 = $_REQUEST['fgtnormalb2'];} else { $fgtnormalb2 = 0;}
	if (isset($_REQUEST['fgtnormalb3'])) {$fgtnormalb3 = $_REQUEST['fgtnormalb3'];} else { $fgtnormalb3 = 0;}
	if (isset($_REQUEST['fgtnormalb4'])) {$fgtnormalb4 = $_REQUEST['fgtnormalb4'];} else { $fgtnormalb4 = 0;}
	if (isset($_REQUEST['fgtnormalb5'])) {$fgtnormalb5 = $_REQUEST['fgtnormalb5'];} else { $fgtnormalb5 = 0;}
	if (isset($_REQUEST['fgtnormalb6'])) {$fgtnormalb6 = $_REQUEST['fgtnormalb6'];} else { $fgtnormalb6 = 0;}
	if (isset($_REQUEST['fgtnormalb7'])) {$fgtnormalb7 = $_REQUEST['fgtnormalb7'];} else { $fgtnormalb7 = 0;}
	if (isset($_REQUEST['fgtnormalb8'])) {$fgtnormalb8 = $_REQUEST['fgtnormalb8'];} else { $fgtnormalb8 = 0;}
	
	if (isset($_REQUEST['fgtnormalavga'])) {$fgtnormalavga = $_REQUEST['fgtnormalavga'];} else { $fgtnormalavga = 0;}
	if (isset($_REQUEST['fgtnormalavgb'])) {$fgtnormalavgb = $_REQUEST['fgtnormalavgb'];} else { $fgtnormalavgb = 0;}
	
	if (isset($_REQUEST['fgtnormalavg'])) {$fgtnormalavg = $_REQUEST['fgtnormalavg'];} else { $fgtnormalavg = 0;}
	
	if (isset($_REQUEST['fgtabnormal1'])) {$fgtabnormal1 = $_REQUEST['fgtabnormal1'];} else { $fgtabnormal1 = 0;}
	if (isset($_REQUEST['fgtabnormal2'])) {$fgtabnormal2 = $_REQUEST['fgtabnormal2'];} else { $fgtabnormal2 = 0;}
	if (isset($_REQUEST['fgtabnormal3'])) {$fgtabnormal3 = $_REQUEST['fgtabnormal3'];} else { $fgtabnormal3 = 0;}
	if (isset($_REQUEST['fgtabnormal4'])) {$fgtabnormal4 = $_REQUEST['fgtabnormal4'];} else { $fgtabnormal4 = 0;}
	if (isset($_REQUEST['fgtabnormal5'])) {$fgtabnormal5 = $_REQUEST['fgtabnormal5'];} else { $fgtabnormal5 = 0;}
	if (isset($_REQUEST['fgtabnormal6'])) {$fgtabnormal6 = $_REQUEST['fgtabnormal6'];} else { $fgtabnormal6 = 0;}
	if (isset($_REQUEST['fgtabnormal7'])) {$fgtabnormal7 = $_REQUEST['fgtabnormal7'];} else { $fgtabnormal7 = 0;}
	if (isset($_REQUEST['fgtabnormal8'])) {$fgtabnormal8 = $_REQUEST['fgtabnormal8'];} else { $fgtabnormal8 = 0;}
	if (isset($_REQUEST['fgtabnormalavg'])) {$fgtabnormalavg = $_REQUEST['fgtabnormalavg'];} else { $fgtabnormalavg = 0;}
	if (isset($_REQUEST['fgtdead1'])) {$fgtdead1 = $_REQUEST['fgtdead1'];} else { $fgtdead1 = 0;}
	if (isset($_REQUEST['fgtdead2'])) {$fgtdead2 = $_REQUEST['fgtdead2'];} else { $fgtdead2 = 0;}
	if (isset($_REQUEST['fgtdead3'])) {$fgtdead3 = $_REQUEST['fgtdead3'];} else { $fgtdead3 = 0;}
	if (isset($_REQUEST['fgtdead4'])) {$fgtdead4 = $_REQUEST['fgtdead4'];} else { $fgtdead4 = 0;}
	if (isset($_REQUEST['fgtdead5'])) {$fgtdead5 = $_REQUEST['fgtdead5'];} else { $fgtdead5 = 0;}
	if (isset($_REQUEST['fgtdead6'])) {$fgtdead6 = $_REQUEST['fgtdead6'];} else { $fgtdead6 = 0;}
	if (isset($_REQUEST['fgtdead7'])) {$fgtdead7 = $_REQUEST['fgtdead7'];} else { $fgtdead7 = 0;}
	if (isset($_REQUEST['fgtdead8'])) {$fgtdead8 = $_REQUEST['fgtdead8'];} else { $fgtdead8 = 0;}
	if (isset($_REQUEST['fgtdeadavg'])) {$fgtdeadavg = $_REQUEST['fgtdeadavg'];} else { $fgtdeadavg = 0;}
	if (isset($_REQUEST['fgtdt'])) {$fgtdt = $_REQUEST['fgtdt'];} else { $fgtdt = '';}
	if (isset($_REQUEST['fgtgermp'])) {$fgtdt = $_REQUEST['fgtgermp'];} else { $fgtgermp = '';}
	if (isset($_REQUEST['fgtvremark'])) {$fgtvremark = $_REQUEST['fgtvremark'];} else { $fgtvremark = '';}
	
	if (isset($_REQUEST['docsrefno'])) {$docsrefno = $_REQUEST['docsrefno'];} else { $docsrefno = '';}
	
	if (isset($_REQUEST['oprremark'])) {$oprremark = $_REQUEST['oprremark'];} else { $oprremark = '';}
	if (isset($_REQUEST['remarks'])) {$remarks = $_REQUEST['remarks'];} else { $remarks = '';}
	
	
	//$sgtnormalb1, $sgtnormalb2, $sgtnormalb3, $sgtnormalb4, $sgtnormalb5, $sgtnormalb6, $sgtnormalb7, $sgtnormalb8, $sgtnormalavga, $sgtnormalavgb, $sgtfug1, $sgtfug2, $sgtfug3, $sgtfug4, $sgtfug5, $sgtfug6, $sgtfug7, $sgtfug8, $sgtfugavg, $fgtnormalb1, $fgtnormalb2, $fgtnormalb3, $fgtnormalb4, $fgtnormalb5, $fgtnormalb6, 	$fgtnormalb7, $fgtnormalb8, $fgtnormalavga, $fgtnormalavgb
	
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
				if($fgtfcfltype=="First Count")
				{$new_retImageString_ret = $sampleno.'_fgtfcimage'.'.'.$img_extn; }
				else 
				{$new_retImageString_ret = $sampleno.'_fgtimage'.'.'.$img_extn; }   
			}
			else if($testtype=="SGT")
			{
				if($sgtfcfltype=="First Count")
				{$new_retImageString_ret = $sampleno.'_sgtfcimage'.'.'.$img_extn;} 
				else
				{$new_retImageString_ret = $sampleno.'_sgtimage'.'.'.$img_extn;}   
			}
			else
			{
				if($sgtfcfltype=="First Count")
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
	
	$user_login = $db->GetGempDataUpdate($sampleno, $testtype, $sgtfcfltype, $fgtfcfltype, $fgtmtype, $seedsize, $noofseedinonerep, $sgtnoofrep, $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $sgtdt, $sgtvremark, $fgtnoofrep, $fgtoobnormal1, $fgtoobnormal2, $fgtoobnormal3, $fgtoobnormal4, $fgtoobnormal5, $fgtoobnormal6, $fgtoobnormal7, $fgtoobnormal8, $fgtoobnormalavg, $fgtoobnormaldt, $fgtnormal1, $fgtnormal2, $fgtnormal3, $fgtnormal4, $fgtnormal5, $fgtnormal6, $fgtnormal7, $fgtnormal8, $fgtnormalavg, $fgtabnormal1, $fgtabnormal2, $fgtabnormal3, $fgtabnormal4, $fgtabnormal5, $fgtabnormal6, $fgtabnormal7, $fgtabnormal8, $fgtabnormalavg, $fgtdead1, $fgtdead2, $fgtdead3, $fgtdead4, $fgtdead5, $fgtdead6, $fgtdead7, $fgtdead8, $fgtdeadavg, $fgtdt, $fgtvremark, $oprremark, $scode, $noofseedinonerepfgt, $remarks, $new_retImageString_ret, $sgtnormalb1, $sgtnormalb2, $sgtnormalb3, $sgtnormalb4, $sgtnormalb5, $sgtnormalb6, $sgtnormalb7, $sgtnormalb8, $sgtnormalavga, $sgtnormalavgb, $sgtfug1, $sgtfug2, $sgtfug3, $sgtfug4, $sgtfug5, $sgtfug6, $sgtfug7, $sgtfug8, $sgtfugavg, $fgtnormalb1, $fgtnormalb2, $fgtnormalb3, $fgtnormalb4, $fgtnormalb5, $fgtnormalb6, $fgtnormalb7, $fgtnormalb8, $fgtnormalavga, $fgtnormalavgb, $oprid);
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
