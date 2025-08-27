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
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$edate = $_REQUEST['edate'];
	$sdate=$_REQUEST['sdate'];
	$trid = $_REQUEST['trid'];
	if(isset($_POST['frm_action'])=='submit')
	{
}

?>

<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<?php 
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
		
		$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
$sql2="select distinct(gottest_lotno) from tbl_gottest where gottest_gotflg=1 and gottest_tid='$trid'";		
$sql="select distinct(gottest_lotno) from tbl_gottest where gottest_gotflg=1 and gottest_tid='$trid'";
$sql.=" order by gottest_dosdate asc, gottest_lotno asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_arr_home2=mysqli_fetch_array($sql_arr_home);

$sqlarrhome=mysqli_query($link,$sql2) or die(mysqli_error($link));	
$rowarrhome=mysqli_fetch_array($sqlarrhome);
?>
<title>Quality - Comprehensive GOT Data Report (In Terra) - GOT Data</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--<a href="excel-gotdatapending.php?txtcrop=<?php echo $cid;?>&txtvariety=<?php echo $itemid;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
 <tr height="25" >
    <td align="center" class="subheading" style="color:#303918;" colspan="2">GOT Data for Lot No.: <?php echo $rowarrhome['gottest_lotno'];?></td>
  </tr>
</table>


<table  border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="20" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="7" >IN-SITU: DNA</td>
</tr>
<tr class="tblsubtitle" height="55">
<td height="55" align="center" valign="middle" class="smalltblheading">Repl. No.</td>
<td align="center" valign="middle" class="smalltblheading">Sample Reciept Date</td>
<td align="center" valign="middle" class="smalltblheading">DNA Extraction Date</td>
<td align="center" valign="middle" class="smalltblheading">DNA Extracted From</td>
<td align="center" valign="middle" class="smalltblheading" colspan="2">DNA Extraction Method</td>
<td align="center" valign="middle" class="smalltblheading">Sample Age</td>
</tr>

<?php
$srno=1;
$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$trid."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type!='IN-TERRA' ") or die(mysqli_error($link));
$tot_max6=mysqli_num_rows($sql_max6);
while($row_arr_home6=mysqli_fetch_array($sql_max6))
{	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage="";  $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	$arrdate='';	$flg=0;
	$qry23="select arrival_id from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."'";
	$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
	if($tot_arr_home23=mysqli_num_rows($sql_arr_home23)>0)
	{
		$row_arr_home23=mysqli_fetch_array($sql_arr_home23);
		
		$qry223="select arrival_date from tblarrival where arrival_id='".$row_arr_home23['arrival_id']."' and arrival_date>='$sdate' and arrival_date<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['arrival_date'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
		}
	}
	if($flg==0)
	{
		$qry223="select salesrs_dovfy from tbl_salesrv_sub where salesrs_orlot='".$row_arr_home['gottest_oldlot']."' and salesrs_dovfy>='$sdate' and salesrs_dovfy<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['salesrs_dovfy'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
		}
	}
	
	$replno=''; $swplot=''; $noseeds=''; $trplplot='';$rnge=''; $norows=''; $bedno=''; $directn=''; $stste=''; $locn=''; $noplnt=''; $trdatesw=''; $trdatetrpl=''; $z=0; $trdateded='';
	$qry22="select * from tbl_gottestsub_sub2 where gottest_tid='".$arrival_id."'  and geaflg>'0'";
	$sql_arr_home22=mysqli_query($link,$qry22) or die(mysqli_error($link));
	if($tot_arr_home22=mysqli_num_rows($sql_arr_home22)>0)
	{
		while($row_ahome22=mysqli_fetch_array($sql_arr_home22))
		{
			$qry223="select * from tbl_gottestsub_sub2 where gottest_tid='".$arrival_id."' and gottestss_id='".$row_ahome22['gottestss_id']."' ";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			//if($row_ahome22['gottestss_dateoftr']==NULL || $row_ahome22['gottestss_dateoftr']=='0000-00-00' || $row_ahome22['gottestss_dateoftr']=='--')
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$trdate6=explode("-", $row_ahome22['gottestss_samprecdate']);
				$tryear=$trdate6[0];
				$trmonth=$trdate6[1];
				$trday=$trdate6[2];
				$trdatetrp=$trday."-".$trmonth."-".$tryear;
						
				$trdatesw=$trdates;
				$trdatetrpl=$trdatetrp;
				
				$trdate7=explode("-", $row_ahome22['gottestss_dnaextdate']);
				$tryear=$trdate7[0];
				$trmonth=$trdate7[1];
				$trday=$trdate7[2];
				$trdateded=$trday."-".$trmonth."-".$tryear;
				
				$replno=$row_ahome22['replno'];
				//$swplot=$row_ahome22['gottestss_swoingplot'];
				$noseeds=$row_ahome22['gottestss_dnaextfrom'];
				$trplplot=$row_ahome22['gottestss_dnaextmethod'];
				$rnge=$row_ahome22['gottestss_dnaextmethod1'];
				$norows=$row_ahome22['gottestss_sampleage'];
				/*$bedno=$row_ahome22['gottestss_bedno'];
				$directn=$row_ahome22['gottestss_direction'];
				$stste=$row_ahome22['gottestss_state'];
				$locn=$row_ahome22['gottestss_gotlocation'];
				$noplnt=$row_ahome22['gottestss_plantpopln'];*/
		//echo $row_arr_home['gottest_oldlot']."  -=-  ".$arrival_id."  -=-  ".$flg."<br/>";
if($flg>0)
{		
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $replno?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdatesw?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdateded;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noseeds;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $norows;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $replno?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdatesw?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdateded;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noseeds;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $norows;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}
?>
</table>	
<br />


<table  border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="20" align="center" valign="middle" class="smalltblheading" rowspan="3">#</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="4" >IN-SITU : PCR Analysis</td>
</tr>
<tr class="tblsubtitle" height="55">
<td align="center" valign="middle" class="smalltblheading" rowspan="2">PCR Analysis Date</td>
<td align="center" valign="middle" class="smalltblheading" colspan="3">Marker</td>
</tr>
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="smalltblheading">Number</td>
<td align="center" valign="middle" class="smalltblheading">Type</td>
<td align="center" valign="middle" class="smalltblheading">Name</td>
</tr>

<?php
$srno=1;
$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$trid."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type!='IN-TERRA' ") or die(mysqli_error($link));
$tot_max6=mysqli_num_rows($sql_max6);
while($row_arr_home6=mysqli_fetch_array($sql_max6))
{	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage="";  $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	$arrdate='';	$flg=0;
	$qry23="select arrival_id from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."'";
	$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
	if($tot_arr_home23=mysqli_num_rows($sql_arr_home23)>0)
	{
		$row_arr_home23=mysqli_fetch_array($sql_arr_home23);
		
		$qry223="select arrival_date from tblarrival where arrival_id='".$row_arr_home23['arrival_id']."' and arrival_date>='$sdate' and arrival_date<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['arrival_date'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
		}
	}
	if($flg==0)
	{
		$qry223="select salesrs_dovfy from tbl_salesrv_sub where salesrs_orlot='".$row_arr_home['gottest_oldlot']."' and salesrs_dovfy>='$sdate' and salesrs_dovfy<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['salesrs_dovfy'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
		}
	}
	
	$replno=''; $swplot=''; $noseeds=''; $trplplot='';$rnge=''; $norows=''; $bedno=''; $directn=''; $stste=''; $locn=''; $noplnt=''; $trdatesw=''; $trdatetrpl=''; $z=0;
	$qry22="select * from tbl_gottestsub_sub where gottest_tid='".$arrival_id."'  and geaflg>'0'";
	$sql_arr_home22=mysqli_query($link,$qry22) or die(mysqli_error($link));
	if($tot_arr_home22=mysqli_num_rows($sql_arr_home22)>0)
	{
		while($row_ahome22=mysqli_fetch_array($sql_arr_home22))
		{
			$qry223="select * from tbl_gottestsub_sub2 where gottest_tid='".$arrival_id."' and gottestss_id='".$row_ahome22['gottestss_id']."' ";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			//if($row_ahome22['gottestss_dateoftr']==NULL || $row_ahome22['gottestss_dateoftr']=='0000-00-00' || $row_ahome22['gottestss_dateoftr']=='--')
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$trdate6=explode("-", $tot_arr_home223['gottestss2_pcrdate']);
				$tryear=$trdate6[0];
				$trmonth=$trdate6[1];
				$trday=$trdate6[2];
				$trdatetrp=$trday."-".$trmonth."-".$tryear;
						
				//$trdatesw=$trdates;
				$trdatetrpl=$trdatetrp;
				/*$replno=$row_ahome22['replno'];
				$swplot=$row_ahome22['gottestss_swoingplot'];
				$noseeds=$row_ahome22['gottestss_noofrows'];*/
				$trplplot=$tot_arr_home223['gottestss2_mnumber'];
				$rnge=$tot_arr_home223['gottestss2_mtype'];
				$norows=$tot_arr_home223['gottestss2_mname'];
				/*$bedno=$row_ahome22['gottestss_bedno'];
				$directn=$row_ahome22['gottestss_direction'];
				$stste=$row_ahome22['gottestss_state'];
				$locn=$row_ahome22['gottestss_gotlocation'];
				$noplnt=$row_ahome22['gottestss_plantpopln'];*/
		//echo $row_arr_home['gottest_oldlot']."  -=-  ".$arrival_id."  -=-  ".$flg."<br/>";
if($flg>0)
{		
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdatetrpl;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $norows;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdatetrpl;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $norows;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}
?>
</table>	
<br />

  
<table  border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="20" align="center" valign="middle" class="smalltblheading" rowspan="3">#</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="18" >IN-SITU : GEA</td>
</tr>
<tr class="tblsubtitle" height="55">
<td align="center" valign="middle" class="smalltblheading" rowspan="2">GEA Date</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Sample Size</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Samples Not Amplified</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Amplified Samples</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Male No.</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Male %</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Female No.</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Female %</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Outcross No.</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Outcross %</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">OOF No.</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">OOF %</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Total No.</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Total %</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2">Genetic Purity %</td>
<td align="center" valign="middle" class="smalltblheading" colspan="3">Base Pair Size</td>
</tr>
<tr class="tblsubtitle" height="55">
<td align="center" valign="middle" class="smalltblheading">Male</td>
<td align="center" valign="middle" class="smalltblheading">Female</td>
<td align="center" valign="middle" class="smalltblheading">Hybrid</td>
</tr>

<?php
$srno=1;
$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$trid."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type!='IN-TERRA' ") or die(mysqli_error($link));
$tot_max6=mysqli_num_rows($sql_max6);
while($row_arr_home6=mysqli_fetch_array($sql_max6))
{	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage="";  $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	$arrdate='';	$flg=0;
	$qry23="select arrival_id from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."'";
	$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
	if($tot_arr_home23=mysqli_num_rows($sql_arr_home23)>0)
	{
		$row_arr_home23=mysqli_fetch_array($sql_arr_home23);
		
		$qry223="select arrival_date from tblarrival where arrival_id='".$row_arr_home23['arrival_id']."' and arrival_date>='$sdate' and arrival_date<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['arrival_date'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
		}
	}
	if($flg==0)
	{
		$qry223="select salesrs_dovfy from tbl_salesrv_sub where salesrs_orlot='".$row_arr_home['gottest_oldlot']."' and salesrs_dovfy>='$sdate' and salesrs_dovfy<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['salesrs_dovfy'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
		}
	}
	
	$replno=''; $swplot=''; $noseeds=''; $trplplot='';$rnge=''; $norows=''; $bedno=''; $directn=''; $stste=''; $locn=''; $noplnt=''; $trdatesw=''; $trdatetrpl=''; $z=0;
	$qry22="select * from tbl_gottestsub_sub where gottest_tid='".$arrival_id."' and geaflg>'0'";
	$sql_arr_home22=mysqli_query($link,$qry22) or die(mysqli_error($link));
	if($tot_arr_home22=mysqli_num_rows($sql_arr_home22)>0)
	{
		while($row_ahome22=mysqli_fetch_array($sql_arr_home22))
		{
			$qry223="select * from tbl_gottestsub_sub2 where gottest_tid='".$arrival_id."' and gottestss_id='".$row_ahome22['gottestss_id']."' ";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			//if($row_ahome22['gottestss_dateoftr']==NULL || $row_ahome22['gottestss_dateoftr']=='0000-00-00' || $row_ahome22['gottestss_dateoftr']=='--')
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$trdate6=explode("-", $row_ahome22['gottestss2_gelelctdate']);
				$tryear=$trdate6[0];
				$trmonth=$trdate6[1];
				$trday=$trdate6[2];
				$trdatetrp=$trday."-".$trmonth."-".$tryear;
						
				$trdatesw=$trdates;
				$trdatetrpl=$trdatetrp;
				$replno=$row_ahome22['gottestss2_samplesize'];
				$swplot=$row_ahome22['gottestss2_sampnotamp'];
				$noseeds=$row_ahome22['gottestss2_sampamp'];
				$trplplot=$row_ahome22['gottestss2_maleno'];
				$rnge=$row_ahome22['gottestss2_maleper'];
				$norows=$row_ahome22['gottestss2_femaleno'];
				$bedno=$row_ahome22['gottestss2_femaleper'];
				$directn=$row_ahome22['gottestss2_outcrossno'];
				$stste=$row_ahome22['gottestss2_outcrossper'];
				$locn=$row_ahome22['gottestss2_oofno'];
				$noplnt=$row_ahome22['gottestss2_oofper'];
				
				$obrdate=$row_ahome22['gottestss2_totno'];
				$obrdate1=$row_ahome22['gottestss2_totper'];
				$obrdate2=$row_ahome22['gottestss2_genpurity'];
				$obrdate3=$row_ahome22['gottestss2_bspmale'];
				$obrdate4=$row_ahome22['gottestss2_bspfemale'];
				$obrdate5=$row_ahome22['gottestss2_bsphybrid'];
				
				
		//echo $row_arr_home['gottest_oldlot']."  -=-  ".$arrival_id."  -=-  ".$flg."<br/>";
if($flg>0)
{		
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $replno?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $swplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noseeds;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdatetrpl;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $norows;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $bedno;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $directn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stste;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $locn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noplnt;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate1;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate2;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate3;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate4;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate5;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $replno?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $swplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noseeds;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trdatetrpl;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $norows;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $bedno;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $directn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stste;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $locn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noplnt;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate1;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate2;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate3;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate4;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate5;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}
?>
</table>			
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--<a href="excel-gotdatapending.php?txtcrop=<?php echo $cid;?>&txtvariety=<?php echo $itemid;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>