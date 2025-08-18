<?php
	session_start();
	require_once("config.php");
	require_once("connection.php");
	
	if(isset($_GET['print']))
	{
	$print = $_GET['print'];
	$code = $_GET['code'];
	}
	
	if(isset($_GET['id']))
	{
	$id = $_GET['id'];
	}
	
			
if($print == 'classification'){
		$sql_query="delete from tblclassification where classification_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/home_classification.php'</script>";	
		exit;
			}
	}

	if($print == 'crop'){
		$sql_query="delete from tblcrop where cropid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_crop.php'</script>";	
		exit;
			}
	}

if($print == 'drymac'){
		$sql_query="delete from tbl_rm_drymac where drymac_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_drying_eqp.php'</script>";	
		exit;
			}
	}
if($print == 'promac'){
		$sql_query="delete from tbl_rm_promac where promac_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_processing_eqp.php'</script>";	
		exit;
			}
	}	
if($print == 'proopr'){
		$sql_query="delete from tbl_rm_proopr where proopr_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_pro_opr.php'</script>";	
		exit;
			}
	}	
if($print == 'wtmac'){
		$sql_query="delete from tbl_rm_wtmac where wtmac_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_wt_eqp.php'</script>";	
		exit;
			}
	}	
if($print == 'wtopr'){
		$sql_query="delete from tbl_rm_wtopr where wtopr_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_wt_opr.php'</script>";	
		exit;
			}
	}			
if($print == 'protreattyp'){
		$sql_query="delete from tbl_rm_treattype where treatt_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_pro_treattype.php'</script>";	
		exit;
			}
	}	
if($print == 'country'){
		$sql_query="delete from tblcountry where c_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_country.php'</script>";	
		exit;
			}
	}

if($print == 'plocation'){
		$sql_query="delete from tblproductionlocation where productionlocationid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_location.php'</script>";	
		exit;
			}
	}
	
	if($print == 'gotlocation'){
		$sql_query="delete from tbl_gotlocation where loc_id =".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_gotlocation.php'</script>";	
		exit;
			}
	}
if($print == 'ups'){
		$sql_query="delete from tblups where uid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_ups.php'</script>";	
		exit;
			}
	}

	if($print == 'up'){
		$sql_query="delete from tblups_tdf where tid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_ups1.php'</script>";	
		exit;
			}
	}
if($print == 'variety'){
		 $sql_query="delete from tblvariety where varietyid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			echo "<script>window.location='../masters/home_variety.php'</script>";	
		exit;
			}
	}

	if($print == 'party'){
		$sql_query="delete from tbl_partymaser where p_id=".$code;
		if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{ 
			echo "<script>window.location='../masters/party_masterhome.php'</script>";	
		exit;
			}
	}
	
if($print == 'farmer'){
		$sql_query="delete from tblfarmer where farmerid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_farmer.php'</script>";	
		exit;
			}
	}


if($print == 'orgname'){
		$sql_query="delete from tblorganiser where orgid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_organiser.php'</script>";	
		exit;
			}
	}
	
if($print == 'crop'){
		$sql_query="delete from tblcrop where cropid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_crop.php'</script>";	
		exit;
			}
	}

	

	
	
if($print == 'plocation'){
		$sql_query="delete from tblproductionlocation where productionlocationid=".$code;
		if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{ 
			echo "<script>window.location='../masters/home_location.php'</script>";	
		exit;
			}
	}
	
	
if($print == 'personnel'){
		$sql_query="delete from  tblproductionpersonnel where productionpersonnelid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/home_personnel.php'</script>";	
		exit;
			}
	}

	
if($print == 'variety'){
		 $sql_query="delete from tblvariety where varietyid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			echo "<script>window.location='../masters/home_variety.php'</script>";	
		exit;
			}
	}

if($print == 'help'){
		$sql_query="delete from tblhelp where help_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/help_home.php'</script>";	
		exit;
			}
	}	
	
	if($print == 'faq'){
		$sql_query="delete from tblfaq where id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../masters/faq_home.php'</script>";	
		exit;
			}
	}		
	
if($print == 'warehouse'){
		$sql_query="delete from tbl_warehouse where whid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/selectbin.php'</script>";	
		exit;
			}
	}

	
if($print == 'bin'){
		 $sql_query="delete from tbl_bin where binid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			 $sql_query1="delete from tbl_subbin where binid=".$code;
			mysqli_query($link,$sql_query1) or die(mysqli_error($link));
		echo "<script>window.location='../Masters/bin_home.php?whid=$id'</script>";	
		exit;
			}
	}


	
	
if($print == 'warehouse1'){
		$sql_query="delete from tblwarehouse where whid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/selectbin1.php'</script>";	
		exit;
			}
	}

	
if($print == 'bin1'){
		 $sql_query="delete from tblbin where binid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			 $sql_query1="delete from tblsubbin where binid=".$code;
			mysqli_query($link,$sql_query1) or die(mysqli_error($link));
		echo "<script>window.location='../Masters/bin_home1.php?whid=$id'</script>";	
		exit;
			}
	}

if($print == 'warehouse2'){
		$sql_query="delete from tbldwarehouse where whid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/selectbin2.php'</script>";	
		exit;
			}
	}

	
if($print == 'bin2'){
		 $sql_query="delete from tbldbin where binid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			 $sql_query1="delete from tbldsubbin where binid=".$code;
			mysqli_query($link,$sql_query1) or die(mysqli_error($link));
		echo "<script>window.location='../Masters/bin_home2.php?whid=$id'</script>";	
		exit;
			}
	}

if($print == 'warehouse3'){
		$sql_query="delete from tblpvwarehouse where whid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/selectbin3.php'</script>";	
		exit;
			}
	}

	
if($print == 'bin3'){
		 $sql_query="delete from tblpvbin where binid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			 $sql_query1="delete from tblpvsubbin where binid=".$code;
			mysqli_query($link,$sql_query1) or die(mysqli_error($link));
		echo "<script>window.location='../Masters/bin_home3.php?whid=$id'</script>";	
		exit;
			}
	}


if($print == 'warehouse4'){
		$sql_query="delete from tblsrwarehouse where whid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/selectbin4.php'</script>";	
		exit;
			}
	}

	
if($print == 'bin4'){
		 $sql_query="delete from tblsrbin where binid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			 $sql_query1="delete from tblsrsubbin where binid=".$code;
			mysqli_query($link,$sql_query1) or die(mysqli_error($link));
		echo "<script>window.location='../Masters/bin_home4.php?whid=$id'</script>";	
		exit;
			}
	}
		
		
if($print == 'comp'){
		$sql_query="delete from tbl_parameters where id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/companyhome.php'</script>";	
		exit;
			}
	}	
	
	if($print == 'role'){
		$sql_query="delete from tbl_roles where id=".$code;
		$sql_query1="delete from tbl_user where uid='".$code."' and role='eindent'";
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{mysqli_query($link,$sql_query1) or die(mysqli_error($link));
		echo "<script>window.location='../Masters/role_home.php'</script>";	
		exit;
			}
	}	
	
	if($print == 'opr'){
		$sql_query="delete from tbl_opr where id=".$code;
			$sql_query1="delete from tbl_user where uid='".$code."'";
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{mysqli_query($link,$sql_query1) or die(mysqli_error($link));
		echo "<script>window.location='../Masters/operator_home.php'</script>";	
		exit;
			}
	}	
	if($print == 'report'){
		$sql_query="delete from tbl_report where id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Masters/home_report.php'</script>";	
		exit;
			}
	}		
	/*
	if($print == 'arrival'){
		$sql_query="delete from  tblarrival_sub where arrsub_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Transaction/add_arrival_vendor.php'</script>";	
		exit;
			}
	}	*/
	
	
	if($print == 'pindent'){
		$sql_query="delete from  tblissue_sub where issuesub_id=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
		echo "<script>window.location='../Transaction/add_issu_physical_indent.php'</script>";	
		exit;
			}
	}					
/*	if($print == 'receive'){
		 				
		 	$sql_rec = "select * from tblreceive where receiveid=".$code;
			$result_rec = mysqli_query($link,$sql_rec) or die(mysqli_error($link));
			$row_rec = mysqli_fetch_array($result_rec);
			$id=$row_rec['arrivalid'];
			$storagelocationid=$row_rec['storagelocationid'];
			$flnid=$row_rec['flnid'];
			$stockid=$row_rec['stockid'];
			
			$sql_ar = "select * from tblarrival where arrivalid=".$id;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			$spf=$row_ar['spcodef'];
			$qcr=$row_ar['qcrid'];
			
			$sql_in1="update tblarrival set 	receiveid=0,
												qcflag=0 
												where arrivalid = $id";	
			$sql_in2="update tblstoragelocation set 	cropid='',
														focno='',
														fln='',
														qty='' 
														where storagelocationid = $storagelocationid";
			$sql_in3="update tblspcodes set 			foc=''
														where spcode = '$spf'";											


			$sql_in4="update tblqcr set 			flnid=''
													where qcrid = '$qcr'";

			$sql_query_fln="delete from tblfln where flnid=".$flnid;
			$sql_query_stock="delete from tblstockldg where stockid=".$stockid;
			$sql_query="delete from tblreceive where receiveid=".$code;
			
			if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
			{
			if(mysqli_query($link,$sql_in2) or die(mysqli_error($link)))
			if(mysqli_query($link,$sql_in3) or die(mysqli_error($link)))
			if(mysqli_query($link,$sql_in4) or die(mysqli_error($link)))
			if(mysqli_query($link,$sql_query_fln) or die(mysqli_error($link)))
			if(mysqli_query($link,$sql_query_stock) or die(mysqli_error($link)))
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
		echo "<script>window.location='../transaction/trreceivehome.php?print=delete'</script>";	
		exit;
			}
	}
	
	if($print == 'issue'){
		 				
		 	$sql_rec = "select * from tblissue where issueid=".$code;
			$result_rec = mysqli_query($link,$sql_rec) or die(mysqli_error($link));
			$row_rec = mysqli_fetch_array($result_rec);
			
			$sptype=$row_rec['sptype'];
			$flnid=$row_rec['flnid'];
			$spcodeid=$row_rec['spcodesid'];
			$issueqty=$row_rec['issueqty'];
			
			$flnid2=$row_rec['flnid2'];
			$spcodeid2=$row_rec['spcodesid2'];
			$issueqty2=$row_rec['issueqty2'];
			
			
			$sql_ar = "select * from tblstock where flnid=".$flnid;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			$bal=$balqty+$issueqty;
			$sql_in1="update tblstock set 		balanceqty=$bal
												where flnid = $flnid";	
			$st=mysqli_query($link,$sql_in1) or die(mysqli_error($link));									
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid;
			$s=mysqli_query($link,$sql_query_fln) or die(mysqli_error($link));
			
			if($sptype=="Crossing")	
			{	
			$sql_ar = "select * from tblstock where flnid=".$flnid2;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			$bal=$balqty+$issueqty2;
			
			$sql_in12="update tblstock set 		balanceqty=$bal
												where flnid = $flnid2";	
			$st2=mysqli_query($link,$sql_in12) or die(mysqli_error($link));										
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid2;
			$s2=mysqli_query($link,$sql_query_fln) or die(mysqli_error($link));
			}
			
			$sql_query="delete from tblissue where issueid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			echo "<script>window.location='../transaction/trissuehome.php?print=delete'</script>";	
			exit;
			}
	}
	
	if($print == 'issue2'){
		 				
		 	$sql_rec = "select * from tblissue where issueid=".$code;
			$result_rec = mysqli_query($link,$sql_rec) or die(mysqli_error($link));
			$row_rec = mysqli_fetch_array($result_rec);
			
			$sptype=$row_rec['sptype'];
			$flnid=$row_rec['flnid'];
			$spcodeid=$row_rec['spcodesid'];
			$issueqty=$row_rec['issueqty'];
			
			$flnid2=$row_rec['flnid2'];
			$spcodeid2=$row_rec['spcodesid2'];
			$issueqty2=$row_rec['issueqty2'];
			
			
			$sql_ar = "select * from tblstock where flnid=".$flnid;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			
			$sql_in1="update tblstock set 		balanceqty=$balqty+$issueqty
												where flnid = $flnid";	
			$st=mysqli_query($link,$sql_in1) or die(mysqli_error($link));										
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid;
			$s=mysqli_query($link,$sql_query_fln) or die(mysqli_error($link));
			
			if($sptype=="Crossing")	
			{	
			$sql_ar = "select * from tblstock where flnid=".$flnid2;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			
			$sql_in12="update tblstock set 		balanceqty=$balqty+$issueqty2
												where flnid = $flnid2";	
			$st2=mysqli_query($link,$sql_in12) or die(mysqli_error($link));										
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid2;
			$s2=mysqli_query($link,$sql_query_fln) or die(mysqli_error($link));
			}
			
			$sql_query="delete from tblissue where issueid=".$code;
			$sql_query1="delete from tblfdndetails where issueid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{if(mysqli_query($link,$sql_query1) or die(mysqli_error($link)))
			echo "<script>window.location='../transaction/trissuehome.php?print=delete'</script>";	
			exit;
			}
	}
	
	if($print == 'qcsqnr'){
		 				
		 	/*$sql_rec = "select * from tblqcsqnr where qcsqnrid=".$code;
			$result_rec = mysqli_query($link,$sql_rec) or die(mysqli_error($link));
			$row_rec = mysqli_fetch_array($result_rec);
			
			$flnid=$row_rec['flnid'];
			$qcrid=$row_rec['qcrid'];
			$issueqty=$row_rec['qcqty'];
			
			
			$sql_ar = "select * from tblstock where flnid=".$flnid;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			
			$sql_in1="update tblstock set 		balanceqty=$balqty+$issueqty
												where flnid = $flnid";	
			$st=mysqli_query($link,$sql_in1) or die(mysqli_error($link));
													
			 $sql_ar = "select * from tblqcr where qcrid=".$qcrid;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			
			
			$sql_in12="update tblstock set 		qcrqty=0
												where qcrid = $qcrid";	
			$st2=mysqli_query($link,$sql_in12) or die(mysqli_error($link));	//									
			
			$sql_query="delete from tblqcsqnr where qcsqnrid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			echo "<script>window.location='../transaction/trqcsqnrhome.php?print=delete'</script>";	
			exit;
			}
	}
	
	if($print == 'ci'){
		 	
			$sql_ar = "select * from tblciupdation where ciupdationid=".$code;
			$result_ar = mysqli_query($link,$sql_ar) or die(mysqli_error($link));
			$row_ar = mysqli_fetch_array($result_ar);
			$id=$row_ar['ci_id'];
			
			$sql_query="delete from tblciupdation where ciupdationid=".$code;
			if(mysqli_query($link,$sql_query) or die(mysqli_error($link)))
			{
			echo "<script>window.location='../transaction/tr_ci_output_updation.php?print=delete&id=$id'</script>";	
			exit;
			}
	}*/
	


?>