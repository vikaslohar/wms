<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	else
	{
	$year1=$_SESSION['ayear1'];
	$year2=$_SESSION['ayear2'];
	$username= $_SESSION['username'];
	$yearid_id=$_SESSION['yearid_id'];
	$role=$_SESSION['role'];
    $loginid=$_SESSION['loginid'];
    $logid=$_SESSION['logid'];
	$lgnid=$_SESSION['logid'];
	$plantcode=$_SESSION['plantcode'];
	$plantcode1=$_SESSION['plantcode1'];
	$plantcode2=$_SESSION['plantcode2'];
	$plantcode3=$_SESSION['plantcode3'];
	$plantcode4=$_SESSION['plantcode4'];
	}
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
if(isset($_REQUEST['tid']))
	{
		 $tid = $_REQUEST['tid'];
	}
	/*if(isset($_REQUEST['arival_id']))
	{
		 $tid = $_REQUEST['arrival_id'];
	}*/
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$germinationper=$_POST['germinationper'];
		$leduration=$_POST['leduration'];
		$germptestresult=$_POST['germptestresult'];
		$txtremark=$_POST['txtremark'];
		$samplenumber=$_POST['samplenumber'];
		$lotnumber=$_POST['lotnumber'];
		$result=$_POST['germptestresult'];
		$gemp=$_POST['germinationper'];
		$txtrefno=$_POST['txtrefno'];
		
		if($samplenumber!='')
		{
			$dt=date("d-m-Y h:i:sa"); $one=1; $two=2; $moist=0; $vchk='Acceptable'; $zero=0;
			$tdate=date("Y-m-d");
			if($germptestresult=="RT")
			{$zero=1;}
			$sql_in1="update tbl_qcgdata set qcg_germp='$germinationper', qcg_le='$leduration', qcg_supremark='$txtremark', qcg_suplogid='$logid', qcg_germpflg='$one', qcg_germpdt='$tdate', qcg_retult='$germptestresult', qcg_retestflg='$zero' where qcg_sampleno='$samplenumber' and qcg_retestflg=0";	
			if($aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link)))
			{
				
				$sql_mdata=mysqli_query($link,"select * from tbl_qcmdata where qcm_sampno='".$samplenumber."' ") or die(mysqli_error($link));
				if(mysqli_num_rows($sql_mdata)>0)
				{
					$row_mdata=mysqli_fetch_array($sql_mdata);
					$moist=$row_mdata['qcm_moistper'];
				}
				$sql_pdata=mysqli_query($link,"select * from tbl_qcpdata where qcp_sampleno='".$samplenumber."' ") or die(mysqli_error($link));
				if(mysqli_num_rows($sql_pdata)>0)
				{
					$row_pdata=mysqli_fetch_array($sql_pdata);
					$vchk=$row_pdata['qcp_ppresult'];
				}
				
				$nwlotn=str_split($lotnumber);
				$nwlotno=$nwlotn[0].$nwlotn[1].$nwlotn[2].$nwlotn[3].$nwlotn[4].$nwlotn[5].$nwlotn[6];
				$lotnn=$nwlotn[1].$nwlotn[2].$nwlotn[3].$nwlotn[4].$nwlotn[5].$nwlotn[6];
				
				$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where old='".$lotnn."'") or die(mysqli_error($link));
				$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
				$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
				$harvestdt=$row_tbl_sub['harvestdate'];
				if($harvestdt!="")
				{
					$trdate2=explode("-",$harvestdt);
					$m=$trdate2[1];
					$de=$trdate2[0];
					$y=$trdate2[2];
					
					//$dt=$a;
					if($leduration!="")
					{
						for($i=0; $i<=$leduration; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
					}
					else
					{$dp1="";}
				}
				else
				{$dp1="";}
				$leupto=$dp1;
				
				$hdate13=explode("-",$leupto);
				$ledate=$hdate13[2]."-".$hdate13[1]."-".$hdate13[0];
					
				$xamp=str_split($samplenumber);
				$plcode=$xamp[0];
				$yrcd=$xamp[1];
				$smpcode=$xamp[2].$xamp[3].$xamp[4].$xamp[5].$xamp[6].$xamp[7];
				
				
				
				
				$sqlck=mysqli_query($link,"select distinct sampleno from tbl_qctest where sampleno='$smpcode' and yearid='$yrcd' and  SUBSTRING(`oldlot`,1,7)='$nwlotno' order by tid desc") or die(mysqli_error($link));
				while($rowck=mysqli_fetch_array($sqlck))
				{
					$sqlck2=mysqli_query($link,"select * from tbl_qctest where sampleno='".$rowck['sampleno']."' and yearid='$yrcd' and  SUBSTRING(`oldlot`,1,7)='$nwlotno' and qcstatus!='OK' and qcstatus!='Fail' order by tid asc") or die(mysqli_error($link));
					while($rowck2=mysqli_fetch_array($sqlck2))
					{
					
						$sql_ck=mysqli_query($link,"select * from tbl_qctest where tid='".$rowck2['tid']."' order by tid desc") or die(mysqli_error($link));
						while($row_ck=mysqli_fetch_array($sql_ck))
						{
							$ores=$row_ck['qcstatus'];
							$osamp22=$row_ck['sampleno'];
							$olotno22=$row_ck['lotno'];
							$yearid22=$row_ck['yearid'];
							$olot=$row_ck['lotno'];
							$oldlotn=$row_ck['oldlot'];
							if($ores=="RT")
							{
								$crp=$row_ck['crop'];
								$ver=$row_ck['variety'];
								$srdt=$row_ck['srdate'];
								$spdt=$row_ck['spdate'];
								$smpno=$row_ck['sampleno'];
								$stats=$row_ck['state'];
								$oqc=$row_ck['qc'];
								$stge=$row_ck['trstage'];
								$opp=$row_ck['pp'];
								$omt=$row_ck['moist'];
								$ogmp=$row_ck['gemp'];
								$oqcst=$row_ck['qcstatus'];
								$oqtdt=$row_ck['testdate'];
								//$oref=$row_ck['qcrefno'];
								$ogotdate=$row_ck['gotdate'];
								$odosdate=$row_ck['dosdate'];
								$ogot=$row_ck['got'];
								$ogotstatus=$row_ck['gotstatus'];
								$oaflg=$row_ck['aflg'];
								$obflg=$row_ck['bflg'];
								$ocflg=$row_ck['cflg'];
								$oqcflg=$row_ck['qcflg'];
								$ogotflg=$row_ck['gotflg'];
								$ogsflg=$row_ck['gsflg'];
								$ogs=$row_ck['gs'];
								$ogotrefno=$row_ck['gotrefno'];
								$ogotauth=$row_ck['gotauth'];
								$odoswdate=$row_ck['doswdate'];
								$ogotsmpdflg=$row_ck['gotsmpdflg'];
								$ostsno=$row_ck['stsno'];
								$oqcrefno=$row_ck['qcrefno'];
								$yearid=$row_ck['yearid'];
								$stage=$row_ck['tratage'];
								
									
									
								$sql_sub_sub="insert into tbl_qctest(lotno,  oldlot, crop, variety, srdate, spdate, sampleno, state, qc, trstage, pp, moist, gemp, qcstatus, testdate, gotdate, dosdate, got, gotstatus, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, yearid, logid) values('$olotno22', '$oldlotn', '$crp', '$ver', '$srdt', '$spdt', '$smpno', '$stats', '$oqc', '$stge', '$opp', '$omt', '$ogmp', '$oqcst', '$oqtdt', '$ogotdate', '$odosdate', '$ogot', '$ogotstatus', '$oaflg', '$obflg', '$ocflg', '$oqcflg', '$ogotflg', '$ogsflg', '$ogs', '$ogotrefno', '$ogotauth', '$odoswdate', '$ogotsmpdflg', '$ostsno', '$oqcrefno', '$yearid', '$logid')";
								if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
								{
									$id=mysqli_insert_id($link);
									if($result=="OK" || $result=="Fail")
									{
										$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', testdate='$tdate', qcflg=1, qcrefno='$txtrefno' where tid='$id'";
											
										$sql_sub_sub1222="update tbl_qctest set qcflg=1 where lotno='$olotno22' and sampleno='$osamp22' and yearid='$yearid22'";
										$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
									}
									else if($result=="RT")
									{
										$sql_sub_sub12="update tbl_qctest set qcstatus='$result', testdate='$tdate', qcflg=0, gemp='$gemp', qcrefno='$txtrefno' where tid='$id'";
									}
									else
									{
										$sql_sub_sub12="update tbl_qctest set gemp='$gemp', qcstatus='$result', qcflg=0, testdate='$tdate', qcrefno='$txtrefno' where tid='$id'";
									}
									$qq=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
										
									$sql_sub_sub122="update tbl_qctest set qcflg=1 where tid='".$rowck2['tid']."'";
									$qq22=mysqli_query($link,$sql_sub_sub122) or die(mysqli_error($link));
								}
							}
							else
							{ 
								if($result=="OK" || $result=="Fail")
								{
									$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', testdate='$tdate', qcflg=1, qcrefno='$txtrefno' where tid='".$rowck2['tid']."' and sampleno='$osamp22' and yearid='$yearid22'";
									$sql_sub_sub1222="update tbl_qctest set qcflg=1 where sampleno='$osamp22' and yearid='$yearid22'";
									$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
								}
								else if($result=="RT")
								{
									$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', qcstatus='$result', testdate='$tdate', qcflg=0, gemp='$gemp', qcrefno='$txtrefno' where tid='".$rowck2['tid']."' and  sampleno='$osamp22' and yearid='$yearid22'";
								}
								else
								{
									$sql_sub_sub12="update tbl_qctest set pp='$vchk', moist='$moist', gemp='$gemp', qcstatus='$result', qcflg=0, testdate='$tdate', qcrefno='$txtrefno' where tid='".$rowck2['tid']."' and sampleno='$osamp22' and yearid='$yearid22'";
								}
								
								$qq=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
							}
								//exit;	
							if($result=="RT")
							{
								$sql_sub="update tbl_lot_ldg set lotldg_qc='$result', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
								$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='$result', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
								$sql_sub3="update tbl_salesrv_sub set salesrs_qc='$result', salesrs_dot='$tdate' where salesrs_orlot='$oldlotn' and (salesrs_qc='UT' OR salesrs_qc='RT')";
								$sql_sub4="update tbl_revalidate set rv_qc='$result', rv_dot='$tdate' where rv_lotno='$olot' and (rv_qc='UT' OR rv_qc='RT')";
							}
							else
							{
								$sql_sub="update tbl_lot_ldg set lotldg_qc='$result', lotldg_vchk='$vchk', lotldg_gemp='$gemp', lotldg_moisture='$moist', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
								$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='$result', lotldg_vchk='$vchk', lotldg_gemp='$gemp', lotldg_moisture='$moist', lotldg_qctestdate='$tdate' where orlot='$oldlotn'";
								$sql_sub3="update tbl_salesrv_sub set salesrs_qc='$result', salesrs_dot='$tdate' where salesrs_orlot='$oldlotn' and (salesrs_qc='UT' OR salesrs_qc='RT')";	
								$sql_sub4="update tbl_revalidate set rv_qc='$result', rv_dot='$tdate' where rv_lotno='$olot' and (rv_qc='UT' OR rv_qc='RT')";
							}
								$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
								$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
								$qq3=mysqli_query($link,$sql_sub3) or die(mysqli_error($link));
								$qq4=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
								
							$dt=date("Y-m-d"); 
							if($txtstage=="")
							{
								if($nwlotn[12]=="R")$txtstage="Raw";
								if($nwlotn[12]=="C")$txtstage="Condition";
								if($nwlotn[12]=="P")$txtstage="Pack";
							}
							$sqlisstbl=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$olot."'") or die(mysqli_error($link)); 
							if($totisstbl=mysqli_num_rows($sqlisstbl)>0)
							{
								$rowisstbl=mysqli_fetch_array($sqlisstbl);
								$sqlsubsub1="UPDATE tbl_lemain SET le_duration='$leduration', le_upto='$ledate'  where le_lotno='$olot' and le_stage='$txtstage'";
								mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
							}
							else
							{
								$sqlsubsub1="insert into tbl_lemain (le_lotno, le_stage, le_duration, le_upto) values( '$olot' ,'$txtstage', '$leduration','$ledate' )";
								mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
							}
							
							$sqlsubsub13="insert into tbl_learchive (lea_lotno, lea_stage, lea_duration, lea_upto, lea_date, lea_module, lea_logid) values( '$olot' ,'$txtstage', '$leduration','$ledate', '$dt', 'QC Manager', '$logid' )";
							mysqli_query($link,$sqlsubsub13) or die(mysqli_error($link));
								
							if($result=="Fail" || $result=="BL")	
							{
								$sqlin1="delete from tbl_revalidate where rv_lotno='$olot' and (rv_qc='UT' OR rv_qc='RT')";	
								$aa=mysqli_query($link,$sqlin1)or die(mysqli_error($link));
								$sqlsub2="update tbl_lot_ldg_pack set lotldg_rvflg='1' where lotno='$lotno'";
								$qqp2=mysqli_query($link,$sqlsub2) or die(mysqli_error($link));
							}
							if($result!="RT")
							{	
								$sql_chk=mysqli_query($link,"select * from tbl_lot_ldg where orlot='$oldlotn' order by lotldg_id desc") or die(mysqli_error($link));
								$tot_chk=mysqli_num_rows($sql_chk);
								if($tot_chk > 0)
								{
									$row_chk=mysqli_fetch_array($sql_chk);
									$zz=explode(" ", $row_chk['lotldg_got1']);
									/*if($zz[0]=="GOT-NR")
									{*/
										if(($row_chk['lotldg_got']=="OK" || $row_chk['lotldg_got']=="Fail") && $row_chk['lotldg_srflg']==1)
										{
											$x="";
											$sql_mainchk="update tbl_lot_ldg set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$oldlotn'";
											mysqli_query($link,$sql_mainchk) or die(mysqli_error($link));
											$sql_mainchk2="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$oldlotn'";
											mysqli_query($link,$sql_mainchk2) or die(mysqli_error($link));
											$sql_subchk="update tbl_softr_sub set softrsub_srflg='0' where softrsub_lotno ='$oldlotn'";
											mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
										}
									//}
								}
							}
						}
					}
				}
				
				
				
				
				echo "<script>window.opener.location.href = window.opener.location.href;  self.close();</script>";	
			}
		}
		else
		{
			echo "<script>alert('Germination data not updated. Please try again.'); </script>";	
		}
		//exit;	
	
	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction-Germination Data Review</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script type="text/javascript">
function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	
function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 	

function mySubmit()
{
	var flg=0;
	
	if(document.frmaddDept.germinationper.value=='')
	{
		alert("Germination % cannot be blank");
		flg=1;
		document.frmaddDept.germinationper.focus();
	}
	if(document.frmaddDept.germptestresult.value=='')
	{
		alert("Please select the result");
		flg=1;
		document.frmaddDept.germptestresult.focus();
	}
	if(document.frmaddDept.germptestresult.value=='OK')
	{
		if(document.frmaddDept.leduration.value=='')
		{
			alert("Please enter LE Duration");
			flg=1;
			document.frmaddDept.leduration.focus();
		}
	}
	if(flg>0)
	{
		return false;
	}
	else
	{
		return true;
	}
}	

function updgempdata(germpval)
{
document.frmaddDept.germinationper.value=germpval;
}
	
			</script>
</head>
<body topmargin="0" >
  
<table width="650" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit()" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input type="hidden" name="cnt" value="0" />
		  <input name="txt" value="" type="hidden"> 
		  <input name="btnval" value="0" type="hidden"> 
		</br>
		<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
?>
		<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >QC Germination Data Verification</td>
          </tr>
          <?php

$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
			
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$stage=$row_arr_home['trstage'];
		$crop=""; $variety=""; $lotno=""; $bags=0; $qty=0;  $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
$pp=$row_tbl_sub1['state'];	
	
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	$oldlotno=$row_tbl_sub1['oldlot'];
		
	}
		 $trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	


$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$lotno."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
while($row_is=mysqli_fetch_array($sql_is))
{ 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$lotno."' order by lotldg_id desc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty>0 order by lotldg_id desc") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$row_tbl=mysqli_fetch_array($sql_istbl);

$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}

	$bags=$bags+$ac;
	$qty=$qty+$acn;

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";	
}
}
	
/*	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
*/

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
$row31=mysqli_fetch_array($quer3);
$standmoistper=$row31['smp'];
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?>
		  
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Crop&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
            <td align="right"  valign="middle"  class="tblheading">&nbsp;Variety&nbsp;</td>
            <td width="173" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?></td>
          </tr>
		  <tr class="Light" height="25">
            		    <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Lot No.&nbsp;</td>
		                <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $lotno?><input type="hidden" name="lotnochk" value="<?php echo $oldlotno;?>" /><input type="hidden" name="lotnumber" value="<?php echo $lotno?>" /></td>
			 <td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $stage?></td>
	      </tr>
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;NoB&nbsp;</td>
            <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $bags;?></td>
            <td align="right"  valign="middle"  class="tblheading">Qty&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $qty;?></td>
          </tr>
          <tr class="Light" height="25">
           
        <td align="right"  valign="middle" class="tblheading">SLOC&nbsp;</td>
            <?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

//$tp1=$row_param['code'];
$tp1=$row_arr_home['plantcode'];
?>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $slocs;?></td>
			    <td align="right"  valign="middle" class="tblheading" >QC Test&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $pp?></td>
          </tr>
          <tr class="Dark" height="25">
            <td align="right"  valign="middle" class="tblheading">Sample No.&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
            <td width="128" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
            <td align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<?php echo $trdate;?></td>
          </tr>
        
          <input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
          <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
        </table><br />

<?php 
$qcp_samplewt=''; $qcp_pureseed=''; $qcp_pureseedper=''; $qcp_imseed=''; $qcp_imseedper=''; $qcp_lightseed=''; $qcp_lightseedper=''; $qcp_ocseedno=''; $qcp_ocseedinkg=''; $qcp_odvseedno=''; $qcp_odvseedinkg=''; $qcp_dcseed=''; $qcp_dcseedper=''; $qcp_phseedno=''; $qcp_phseedinkg=''; $qcp_pplogid=''; $qcp_ppphoto=''; 

$sampn=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$qc1);
$sql_mdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampn."' and qcg_retestflg=0 ") or die(mysqli_error($link));
$row_mdata=mysqli_fetch_array($sql_mdata);

	$qcg_testtype=$row_mdata['qcg_testtype']; 
	$qcg_setupdt=$row_mdata['qcg_setupdt'];
	$qcg_seedsize=$row_mdata['qcg_seedsize']; 
	$qcg_noofseedinonerep=$row_mdata['qcg_noofseedinonerep']; 
	$qcg_sgtoneobflg=$row_mdata['qcg_sgtoneobflg']; 
	$qcg_sgtnoofrep=$row_mdata['qcg_sgtnoofrep'];
	$qcg_sgtoobnormal1=$row_mdata['qcg_sgtoobnormal1'];
	$qcg_sgtoobnormal2=$row_mdata['qcg_sgtoobnormal2']; 
	$qcg_sgtoobnormal3=$row_mdata['qcg_sgtoobnormal3']; 
	$qcg_sgtoobnormal4=$row_mdata['qcg_sgtoobnormal4']; 
	$qcg_sgtoobnormal5=$row_mdata['qcg_sgtoobnormal5'];
	$qcg_sgtoobnormal6=$row_mdata['qcg_sgtoobnormal6'];
	$qcg_sgtoobnormal7=$row_mdata['qcg_sgtoobnormal7'];
	$qcg_sgtoobnormal8=$row_mdata['qcg_sgtoobnormal8'];
	$qcg_sgtoobnormalavg=$row_mdata['qcg_sgtoobnormalavg'];
	$qcg_sgtoobnormaldt=$row_mdata['qcg_sgtoobnormaldt'];
	$qcg_sgtoobnormallogid=$row_mdata['qcg_sgtoobnormallogid']; 
	$qcg_sgtnormal1=$row_mdata['qcg_sgtnormal1']; 
	$qcg_sgtnormal2=$row_mdata['qcg_sgtnormal2']; 
	$qcg_sgtnormal3=$row_mdata['qcg_sgtnormal3']; 
	$qcg_sgtnormal4=$row_mdata['qcg_sgtnormal4']; 
	$qcg_sgtnormal5=$row_mdata['qcg_sgtnormal5']; 
	$qcg_sgtnormal6=$row_mdata['qcg_sgtnormal6']; 
	$qcg_sgtnormal7=$row_mdata['qcg_sgtnormal7']; 
	$qcg_sgtnormal8=$row_mdata['qcg_sgtnormal8']; 
	$qcg_sgtnormalavg=$row_mdata['qcg_sgtnormalavg']; 
	$qcg_sgtabnormal1=$row_mdata['qcg_sgtabnormal1']; 
	$qcg_sgtabnormal2=$row_mdata['qcg_sgtabnormal2']; 
	$qcg_sgtabnormal3=$row_mdata['qcg_sgtabnormal3']; 
	$qcg_sgtabnormal4=$row_mdata['qcg_sgtabnormal4']; 
	$qcg_sgtabnormal5=$row_mdata['qcg_sgtabnormal5']; 
	$qcg_sgtabnormal6=$row_mdata['qcg_sgtabnormal6']; 
	$qcg_sgtabnormal7=$row_mdata['qcg_sgtabnormal7']; 
	$qcg_sgtabnormal8=$row_mdata['qcg_sgtabnormal8']; 
	$qcg_sgtabnormalavg=$row_mdata['qcg_sgtabnormalavg']; 
	$qcg_sgthardfug1=$row_mdata['qcg_sgthardfug1']; 
	$qcg_sgthardfug2=$row_mdata['qcg_sgthardfug2']; 
	$qcg_sgthardfug3=$row_mdata['qcg_sgthardfug3']; 
	$qcg_sgthardfug4=$row_mdata['qcg_sgthardfug4']; 
	$qcg_sgthardfug5=$row_mdata['qcg_sgthardfug5']; 
	$qcg_sgthardfug6=$row_mdata['qcg_sgthardfug6']; 
	$qcg_sgthardfug7=$row_mdata['qcg_sgthardfug7']; 
	$qcg_sgthardfug8=$row_mdata['qcg_sgthardfug8']; 
	$qcg_sgthardfugavg=$row_mdata['qcg_sgthardfugavg']; 
	$qcg_sgtdead1=$row_mdata['qcg_sgtdead1']; 
	$qcg_sgtdead2=$row_mdata['qcg_sgtdead2']; 
	$qcg_sgtdead3=$row_mdata['qcg_sgtdead3']; 
	$qcg_sgtdead4=$row_mdata['qcg_sgtdead4']; 
	$qcg_sgtdead5=$row_mdata['qcg_sgtdead5']; 
	$qcg_sgtdead6=$row_mdata['qcg_sgtdead6']; 
	$qcg_sgtdead7=$row_mdata['qcg_sgtdead7']; 
	$qcg_sgtdead8=$row_mdata['qcg_sgtdead8']; 
	$qcg_sgtdeadavg=$row_mdata['qcg_sgtdeadavg']; 
	$qcg_sgtdt=$row_mdata['qcg_sgtdt']; 
	$qcg_sgtlogid=$row_mdata['qcg_sgtlogid']; 
	$qcg_sgtflg=$row_mdata['qcg_sgtflg']; 
	$qcg_sgtvremark=$row_mdata['qcg_sgtvremark']; 
	
	$qcg_vigtesttype=$row_mdata['qcg_vigtesttype']; 
	$qcg_vignoofrep=$row_mdata['qcg_vignoofrep']; 
	$qcg_vigoobnormal1=$row_mdata['qcg_vigoobnormal1']; 
	$qcg_vigoobnormal2=$row_mdata['qcg_vigoobnormal2']; 
	$qcg_vigoobnormal3=$row_mdata['qcg_vigoobnormal3']; 
	$qcg_vigoobnormal4=$row_mdata['qcg_vigoobnormal4']; 
	$qcg_vigoobnormal5=$row_mdata['qcg_vigoobnormal5']; 
	$qcg_vigoobnormal6=$row_mdata['qcg_vigoobnormal6']; 
	$qcg_vigoobnormal7=$row_mdata['qcg_vigoobnormal7']; 
	$qcg_vigoobnormal8=$row_mdata['qcg_vigoobnormal8'];
	$qcg_vigoobnormalavg=$row_mdata['qcg_vigoobnormalavg'];
	$qcg_vigoobnormaldt=$row_mdata['qcg_vigoobnormaldt'];
	$qcg_vigoobnormallogid=$row_mdata['qcg_vigoobnormallogid'];
	$qcg_vignormal1=$row_mdata['qcg_vignormal1'];
	$qcg_vignormal2=$row_mdata['qcg_vignormal2'];
	$qcg_vignormal3=$row_mdata['qcg_vignormal3'];
	$qcg_vignormal4=$row_mdata['qcg_vignormal4'];
	$qcg_vignormal5=$row_mdata['qcg_vignormal5'];
	$qcg_vignormal6=$row_mdata['qcg_vignormal6'];
	$qcg_vignormal7=$row_mdata['qcg_vignormal7'];
	$qcg_vignormal8=$row_mdata['qcg_vignormal8'];
	$qcg_vignormalavg=$row_mdata['qcg_vignormalavg'];
	$qcg_vigabnormal1=$row_mdata['qcg_vigabnormal1'];
	$qcg_vigabnormal2=$row_mdata['qcg_vigabnormal2'];
	$qcg_vigabnormal3=$row_mdata['qcg_vigabnormal3'];
	$qcg_vigabnormal4=$row_mdata['qcg_vigabnormal4'];
	$qcg_vigabnormal5=$row_mdata['qcg_vigabnormal5'];
	$qcg_vigabnormal6=$row_mdata['qcg_vigabnormal6'];
	$qcg_vigabnormal7=$row_mdata['qcg_vigabnormal7'];
	$qcg_vigabnormal8=$row_mdata['qcg_vigabnormal8'];
	$qcg_vigabnormalavg=$row_mdata['qcg_vigabnormalavg'];
	$qcg_vigdead1=$row_mdata['qcg_vigdead1'];
	$qcg_vigdead2=$row_mdata['qcg_vigdead2'];
	$qcg_vigdead3=$row_mdata['qcg_vigdead3'];
	$qcg_vigdead4=$row_mdata['qcg_vigdead4'];
	$qcg_vigdead5=$row_mdata['qcg_vigdead5'];
	$qcg_vigdead6=$row_mdata['qcg_vigdead6'];
	$qcg_vigdead7=$row_mdata['qcg_vigdead7'];
	$qcg_vigdead8=$row_mdata['qcg_vigdead8'];
	$qcg_vigdeadavg=$row_mdata['qcg_vigdeadavg'];
	$qcg_viglogid=$row_mdata['qcg_viglogid'];
	$qcg_vigdt=$row_mdata['qcg_vigdt'];
	$qcg_vigflg=$row_mdata['qcg_vigflg'];
	$qcg_vigvremark=$row_mdata['qcg_vigvremark'];
	
	$qcg_oprremark=$row_mdata['qcg_oprremark'];
	$qcg_germpdata=$row_mdata['qcg_germpdata'];
	
	
	$qcg_supremark=$row_mdata['qcg_supremark'];
	$qcg_germp=$row_mdata['qcg_germp'];
	$qcg_germpdt=$row_mdata['qcg_germpdt'];
	$qcg_le=$row_mdata['qcg_le'];
	$qcg_germpflg=$row_mdata['qcg_germpflg'];
	
?>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Germination Test Data</td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Germination Test Type&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_testtype;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Setup Date&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_setupdt;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Seed Size&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_seedsize;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >No. of Seeds in 1 Replication&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_noofseedinonerep;?></td>
</tr>

</table><br />
<?php 
if($qcg_testtype!="Field Germination Test")
{
?>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Test Type&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;Standard Germination Test</td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >No. of Replications&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnoofrep;?></td>
</tr>
<?php 
if($qcg_sgtoneobflg>0)
{
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Standard Germination Test - First Count</td>
</tr>
<?php 
if($qcg_sgtnoofrep==1)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;<?php echo $qcg_sgtoobnormal1;?></td>
</tr>
<?php 
}
if($qcg_sgtnoofrep==2)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtoobnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtoobnormal2;?></td>
</tr>
<?php 
}
if($qcg_sgtnoofrep==4)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtoobnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtoobnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtoobnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtoobnormal4;?></td>
</tr>
<?php 
}
if($qcg_sgtnoofrep==8)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtoobnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtoobnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtoobnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtoobnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtoobnormal5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtoobnormal6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtoobnormal7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtoobnormal8;?></td>
</tr>
<?php } }?>

<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Standard Germination Test - Final Count</td>
</tr>
<?php 
if($qcg_sgtnoofrep==1)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal1;?></td>
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal1;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug1;?></td>
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead1;?></td>
</tr>
<?php 
}
if($qcg_sgtnoofrep==2)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtabnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgthardfug1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Hard/FUG Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtdead1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead2;?></td>
</tr>
<?php 
}
if($qcg_sgtnoofrep==4)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtabnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtabnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgthardfug1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Hard/FUG Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgthardfug3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Hard/FUG Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtdead1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtdead3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead4;?></td>
</tr>
<?php 
}
if($qcg_sgtnoofrep==8)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal8;?></td>
</tr>

<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtabnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtabnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtabnormal5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtabnormal7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormal8;?></td>
</tr>

<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgthardfug1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Hard/FUG Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgthardfug3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Hard/FUG Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgthardfug5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Hard/FUG Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgthardfug7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Hard/FUG Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfug8;?></td>
</tr>

<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtdead1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtdead3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtdead5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtdead7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdead8;?></td>
</tr>
<?php }?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Average&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormalavg;?></td>
	<td width="36%" align="right" valign="middle" class="tblheading">Abnormal Average&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtabnormalavg;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Hard/FUG Average&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgthardfugavg;?></td>
	<td width="36%" align="right" valign="middle" class="tblheading">Dead Average&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtdeadavg;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Vigour Remark&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;<?php echo $qcg_sgtvremark;?></td>
</tr>
</table>
<?php } ?>


<?php 
if($qcg_testtype!="Standard Germination Test")
{
?>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Test Type&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;Field Germination Test</td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Media Type&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigtesttype;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >No. of Replications&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignoofrep;?></td>
</tr>
<?php 
if($qcg_vigoneobflg>0)
{
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Field Germination Test - First Count</td>
</tr>
<?php 
if($qcg_vignoofrep==1)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;<?php echo $qcg_vigoobnormal1;?></td>
</tr>
<?php 
}
if($qcg_vignoofrep==2)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigoobnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigoobnormal2;?></td>
</tr>
<?php 
}
if($qcg_vignoofrep==4)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigoobnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigoobnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigoobnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigoobnormal4;?></td>
</tr>
<?php 
}
if($qcg_vignoofrep==8)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigoobnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigoobnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigoobnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigoobnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigoobnormal5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigoobnormal6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigoobnormal7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigoobnormal8;?></td>
</tr>
<?php } }?>

<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Field Germination Test - Final Count</td>
</tr>
<?php 
if($qcg_vignoofrep==1)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormal1;?></td>
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal1;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3" >&nbsp;<?php echo $qcg_vigdead1;?></td>
</tr>
<?php 
}
if($qcg_vignoofrep==2)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vignormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigabnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigdead1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigdead2;?></td>
</tr>
<?php 
}
if($qcg_vignoofrep==4)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vignormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_sgtnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_sgtnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigabnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigabnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigdead1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigdead2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigdead3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigdead4;?></td>
</tr>
<?php 
}
if($qcg_vignoofrep==8)
{
?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vignormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vignormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vignormal5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormal6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vignormal7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Normal Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormal8;?></td>
</tr>

<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigabnormal1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigabnormal3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigabnormal5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Abnormal Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigabnormal7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Abnormal Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormal8;?></td>
</tr>

<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-1&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigdead1;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-2&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigdead2;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-3&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigdead3;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-4&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigdead4;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-5&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigdead5;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-6&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigdead6;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Rep-7&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcg_vigdead7;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Dead Rep-8&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigdead8;?></td>
</tr>
<?php }?>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Normal Average&nbsp;</td>
	<td width="26%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vignormalavg;?></td>
	<td width="36%" align="right" valign="middle" class="tblheading">Abnormal Average&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext" >&nbsp;<?php echo $qcg_vigabnormalavg;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Dead Average&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3" >&nbsp;<?php echo $qcg_vigdeadavg;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Vigour Remark&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;<?php echo $qcg_vigvremark;?></td>
</tr>
</table>
<?php } ?>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td width="21%" align="right" valign="middle" class="tblheading">Technician Remark&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;<?php echo $qcg_oprremark;?></td>
</tr>
</table>
<br />


<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="2" >Germination Test Result&nbsp;</td>
</tr>
<?php 
if($qcg_testtype=="Both Germination Test")
{
?>
<tr class="Dark" height="25">
	<td align="right" valign="middle" class="tblheading" >Select Germination %&nbsp;</td>
	<td width="70%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="radio" name="germper" value="<?php echo $qcg_sgtnormalavg;?>" onclick="updgempdata(this.value)" />SGT-<?php echo $qcg_sgtnormalavg;?>&nbsp;&nbsp;<input type="radio" name="germper" value="<?php echo $qcg_vignormalavg;?>" onclick="updgempdata(this.value)" />FGT-<?php echo $qcg_vignormalavg;?>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Dark" height="25">
	<td align="right" valign="middle" class="tblheading" >Germination %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="germinationper" value="" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" />&nbsp;%&nbsp;<font color="#FF0000">*</font></td>
</tr>
<?php 
}
else
{
?>
<tr class="Dark" height="25">
	<td align="right" valign="middle" class="tblheading" >Germination %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="germinationper" value="<?php if($qcg_sgtnormalavg>0) {echo $qcg_sgtnormalavg;} else if($qcg_sgtnormalavg==0) {echo $qcg_vignormalavg;} else {}?>" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" />&nbsp;%&nbsp;<font color="#FF0000">*</font></td>
</tr>
<?php
}
?>
<tr class="Dark" height="25">
	<td align="right" valign="middle" class="tblheading" >LE Duration&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<select name="leduration" class="tbltext" tabindex="0" style="width:60px;"   > 
 <option value="">Select</option>
  <?php for($i=1; $i<=36; $i++) {?>
 <option value="<?php echo $i;?>" <?php if($dt==$i)echo "Selected";?>><?php echo $i;?></option>
 <?php } ?>
 </select>&nbsp;Months&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
	<td align="right" width="30%" valign="middle" class="tblheading" >Result&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<select name="germptestresult" class="tbldtext" style="size:150px;">
	<option selected="selected" value="">--Select--</option>
	<option value="OK">OK</option>
	<option value="Fail">Fail</option>
	<option value="RT">RT</option>
	<option value="BL">BL</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Dark" height="25">
 <td align="right"  valign="middle" class="tblheading">QC Doc Ref No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtrefno" type="text" size="20" class="tbltext" tabindex="0" maxlength="20"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</tr>
<tr class="Dark" height="25">
	<td align="right" width="30%" valign="middle" class="tblheading" >Remarks&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<textarea name="txtremark" rows="2" cols="60" class="tbldtext" value=""  ></textarea></td>
</tr>
</table>	
<table cellpadding="5" cellspacing="5" border="0" width="650">
    <tr >
      <td align="center" colspan="3"><img src="../images/back.gif" border="0" onclick="window.close()" style="cursor:pointer" />&nbsp;<!--<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="smpabort('1');" src="../images/abort.gif" alt="Abort Value" border="0"/>&nbsp;--><input name="image" type="image" style="display:inline;cursor:pointer;" onclick="mySubmit();" src="../images/update.gif" alt="Submit Value" border="0"/><input type="hidden" name="standmoistper" value="<?php echo $standmoistper;?>" /><input type="hidden" name="newreplflg" value="0" /><input type="hidden" name="qcm_haommoistper" value="<?php echo $qcm_haommoistper;?>" /><input type="hidden" name="qcm_mmrmoistper" value="<?php echo $qcm_mmrmoistper;?>" /><input type="hidden" name="samplenumber" value="<?php echo $sampn;?>" /></td>
    </tr>
  </table>
</form>
<?php
}
}
}
?></td></tr>
</table>

</body>
</html>
