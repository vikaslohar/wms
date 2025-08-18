<?php
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_REQUEST['mobile1'])) {

    // receiving the post params
    $email = $_REQUEST['mobile1'];
	$sampleno = $_REQUEST['sampleno'];
	
	
	$retest = $_REQUEST['retest'];
	$retesttype = $_REQUEST['retesttype'];
	$retest_reason = $_REQUEST['retest_reason'];
	
	if($retest=="Yes")
	{
		$userlogin = $db->GetGoTRetestUpdate($sampleno, $retest, $retesttype, $retest_reason);
		//print_r($user_login); exit;
		if ($userlogin != false) 
		{
			//print_r($user_compflg);
			$response["error"] = FALSE;
			$response["msg"]="Success";
			//$response["user"]["samplemoistarray"] =$user_login;
			//$response["user"]["name"] = $user_compflg["name"];
			echo json_encode($response);
		}
		else
		{
			// user is not found with the credentials
			$response["error"] = TRUE;
			$response["error_msg"] = "Retest not done for this Sample No. Please try again.";
			echo json_encode($response);
		}
	}
	else
	{
		$fnobser_obserdate = $_REQUEST['fnobser_obserdate'];
		$fnobser_noofplants = $_REQUEST['fnobser_noofplants'];
		$fnobser_maleplants = $_REQUEST['fnobser_maleplants'];
		$fnobser_maleper = $_REQUEST['fnobser_maleper'];
		$fnobser_femaleplants = $_REQUEST['fnobser_femaleplants'];
		$fnobser_femaleper = $_REQUEST['fnobser_femaleper'];
		$fnobser_total = $_REQUEST['fnobser_total'];
		$fnobser_totalper = $_REQUEST['fnobser_totalper'];
		$fnobser_otherofftype = $_REQUEST['fnobser_otherofftype'];
		$fnobser_otheroffper = $_REQUEST['fnobser_otheroffper'];
		$fnobser_blineps = $_REQUEST['fnobser_blineps'];
		$fnobser_blinepsper = $_REQUEST['fnobser_blinepsper'];
		$fnobser_totalofftype = $_REQUEST['fnobser_totalofftype'];
		$fnobser_totalofftypeper = $_REQUEST['fnobser_totalofftypeper'];
		$fnobser_self = $_REQUEST['fnobser_self'];
		$fnobser_selfper = $_REQUEST['fnobser_selfper'];
		$fnobser_pencilplants = $_REQUEST['fnobser_pencilplants'];
		$fnobser_pencilplantsper = $_REQUEST['fnobser_pencilplantsper'];
		$fnobser_aline = $_REQUEST['fnobser_aline'];
		$fnobser_alineper = $_REQUEST['fnobser_alineper'];
		$fnobser_blinesh = $_REQUEST['fnobser_blinesh'];
		$fnobser_blineshper = $_REQUEST['fnobser_blineshper'];
		$fnobser_lg = $_REQUEST['fnobser_lg'];
		$fnobser_lgper = $_REQUEST['fnobser_lgper'];
		$fnobser_fg = $_REQUEST['fnobser_fg'];
		$fnobser_fgper = $_REQUEST['fnobser_fgper'];
		$fnobser_bg = $_REQUEST['fnobser_bg'];
		$fnobser_bgper = $_REQUEST['fnobser_bgper'];
		$fnobser_rt = $_REQUEST['fnobser_rt'];
		$fnobser_rtper = $_REQUEST['fnobser_rtper'];
		$fnobser_tall = $_REQUEST['fnobser_tall'];
		$fnobser_tallper = $_REQUEST['fnobser_tallper'];
		$fnobser_late = $_REQUEST['fnobser_late'];
		$fnobser_lateper = $_REQUEST['fnobser_lateper'];
		$fnobser_fertile = $_REQUEST['fnobser_fertile'];
		$fnobser_fertileper = $_REQUEST['fnobser_fertileper'];
		$fnobser_sterile = $_REQUEST['fnobser_sterile'];
		$fnobser_sterileper = $_REQUEST['fnobser_sterileper'];
		$fnobser_outcrosspart = $_REQUEST['fnobser_outcrosspart'];
		$fnobser_outcrosspartper = $_REQUEST['fnobser_outcrosspartper'];
		$fnobser_remarks = $_REQUEST['fnobser_remarks'];
		$scode = $_REQUEST['scode'];
		
		$user_login = $db->GetGoTFinalObservationEdtUpdate($sampleno, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_late, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode);
		//print_r($user_login); exit;
		if ($user_login != false) 
		{
			//print_r($user_compflg);
			$response["error"] = FALSE;
			$response["msg"]="Success";
			//$response["user"]["samplemoistarray"] =$user_login;
			//$response["user"]["name"] = $user_compflg["name"];
			echo json_encode($response);
		}
		else
		{
			// user is not found with the credentials
			$response["error"] = TRUE;
			$response["error_msg"] = "Data not Updated OR Already Updated for this Sample No.";
			echo json_encode($response);
		}
	}
} 
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters Username or password is missing";
    echo json_encode($response);
}
?>
