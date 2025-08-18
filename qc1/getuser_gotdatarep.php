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
	<td align="center" valign="middle" class="smalltblheading" colspan="4" >IN_TERRA: Sowing</td>
</tr>
<tr class="tblsubtitle" height="55">
<td height="55" align="center" valign="middle" class="smalltblheading">Repl. No.</td>
<td align="center" valign="middle" class="smalltblheading">Date of Sowing</td>
<td align="center" valign="middle" class="smalltblheading">Sowing Plot</td>
<td align="center" valign="middle" class="smalltblheading">No. of Seeds</td>
</tr>

<?php
$srno=1;
$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$trid."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type='IN-TERRA' ") or die(mysqli_error($link));
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
	$qry22="select * from tbl_gottestsub_sub where gottest_tid='".$arrival_id."' and gottestss_doswdate IS NOT NULL and  gottestss_doswdate!='0000-00-00' and gottestss_doswdate!='--' and gottestss_dateoftr IS NOT NULL and  gottestss_dateoftr!='0000-00-00' and gottestss_dateoftr!='--'";
	$sql_arr_home22=mysqli_query($link,$qry22) or die(mysqli_error($link));
	if($tot_arr_home22=mysqli_num_rows($sql_arr_home22)>0)
	{
		while($row_ahome22=mysqli_fetch_array($sql_arr_home22))
		{
			$qry223="select gottestss3_id from tbl_gottestsub_sub3 where gottest_tid='".$arrival_id."' and gottestss_id='".$row_ahome22['gottestss_id']."' ";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			//if($row_ahome22['gottestss_dateoftr']==NULL || $row_ahome22['gottestss_dateoftr']=='0000-00-00' || $row_ahome22['gottestss_dateoftr']=='--')
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$trdate6=split("-", $row_ahome22['gottestss_dateoftr']);
				$tryear=$trdate6[0];
				$trmonth=$trdate6[1];
				$trday=$trdate6[2];
				$trdatetrp=$trday."-".$trmonth."-".$tryear;
						
				$trdatesw=$trdates;
				$trdatetrpl=$trdatetrp;
				$replno=$row_ahome22['replno'];
				$swplot=$row_ahome22['gottestss_swoingplot'];
				$noseeds=$row_ahome22['gottestss_noofrows'];
				$trplplot=$row_ahome22['gottestss_trplot'];
				$rnge=$row_ahome22['gottestss_range'];
				$norows=$row_ahome22['gottestss_trrows'];
				$bedno=$row_ahome22['gottestss_bedno'];
				$directn=$row_ahome22['gottestss_direction'];
				$stste=$row_ahome22['gottestss_state'];
				$locn=$row_ahome22['gottestss_gotlocation'];
				$noplnt=$row_ahome22['gottestss_plantpopln'];
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
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $swplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noseeds;?></td>
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
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $swplot;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noseeds;?></td>
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
	<td width="20" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="9" >IN_TERRA: Transplanting</td>
</tr>
<tr class="tblsubtitle" height="55">
<td align="center" valign="middle" class="smalltblheading">Date of Transplant</td>
<td align="center" valign="middle" class="smalltblheading">Transplant Plot</td>
<td align="center" valign="middle" class="smalltblheading">Range</td>
<td align="center" valign="middle" class="smalltblheading">No. of Rows</td>
<td align="center" valign="middle" class="smalltblheading">Bed No.</td>
<td align="center" valign="middle" class="smalltblheading">Direction</td>
<td align="center" valign="middle" class="smalltblheading">State</td>
<td align="center" valign="middle" class="smalltblheading">Location</td>
<td align="center" valign="middle" class="smalltblheading">No. of Plants</td>

</tr>

<?php
$srno=1;
$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$trid."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type='IN-TERRA' ") or die(mysqli_error($link));
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
	$qry22="select * from tbl_gottestsub_sub where gottest_tid='".$arrival_id."' and gottestss_doswdate IS NOT NULL and  gottestss_doswdate!='0000-00-00' and gottestss_doswdate!='--' and gottestss_dateoftr IS NOT NULL and  gottestss_dateoftr!='0000-00-00' and gottestss_dateoftr!='--'";
	$sql_arr_home22=mysqli_query($link,$qry22) or die(mysqli_error($link));
	if($tot_arr_home22=mysqli_num_rows($sql_arr_home22)>0)
	{
		while($row_ahome22=mysqli_fetch_array($sql_arr_home22))
		{
			$qry223="select gottestss3_id from tbl_gottestsub_sub3 where gottest_tid='".$arrival_id."' and gottestss_id='".$row_ahome22['gottestss_id']."' ";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			//if($row_ahome22['gottestss_dateoftr']==NULL || $row_ahome22['gottestss_dateoftr']=='0000-00-00' || $row_ahome22['gottestss_dateoftr']=='--')
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$trdate6=split("-", $row_ahome22['gottestss_dateoftr']);
				$tryear=$trdate6[0];
				$trmonth=$trdate6[1];
				$trday=$trdate6[2];
				$trdatetrp=$trday."-".$trmonth."-".$tryear;
						
				$trdatesw=$trdates;
				$trdatetrpl=$trdatetrp;
				$replno=$row_ahome22['replno'];
				$swplot=$row_ahome22['gottestss_swoingplot'];
				$noseeds=$row_ahome22['gottestss_noofrows'];
				$trplplot=$row_ahome22['gottestss_trplot'];
				$rnge=$row_ahome22['gottestss_range'];
				$norows=$row_ahome22['gottestss_trrows'];
				$bedno=$row_ahome22['gottestss_bedno'];
				$directn=$row_ahome22['gottestss_direction'];
				$stste=$row_ahome22['gottestss_state'];
				$locn=$row_ahome22['gottestss_gotlocation'];
				$noplnt=$row_ahome22['gottestss_plantpopln'];
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
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $bedno;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $directn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stste;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $locn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noplnt;?></td>
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
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $bedno;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $directn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $stste;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $locn;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $noplnt;?></td>
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
	<td width="20" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="13" >IN-TERRA : Obsevations</td>
</tr>
<tr class="tblsubtitle" height="55">
<td align="center" valign="middle" class="smalltblheading">Repl. No.</td>
<td align="center" valign="middle" class="smalltblheading">Plant Population</td>
<td align="center" valign="middle" class="smalltblheading">Male / Desi Type No.</td>
<td align="center" valign="middle" class="smalltblheading">Male / Desi Type %</td>
<td align="center" valign="middle" class="smalltblheading">Female / Branching</td>
<td align="center" valign="middle" class="smalltblheading">Female / Branching %</td>
<td align="center" valign="middle" class="smalltblheading">OOF</td>
<td align="center" valign="middle" class="smalltblheading">OOF %</td>
<td align="center" valign="middle" class="smalltblheading">Total</td>
<td align="center" valign="middle" class="smalltblheading">Total %</td>
<td align="center" valign="middle" class="smalltblheading">Genetic Purity %</td>
<td align="center" valign="middle" class="smalltblheading">GOT Status</td>
<td align="center" valign="middle" class="smalltblheading">Date of Observation</td>
</tr>

<?php
$srno=1;
$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$trid."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type='IN-TERRA' ") or die(mysqli_error($link));
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
	$qry22="select * from tbl_gottestsub_sub where gottest_tid='".$arrival_id."' and gottestss_doswdate IS NOT NULL and  gottestss_doswdate!='0000-00-00' and gottestss_doswdate!='--' and gottestss_dateoftr IS NOT NULL and  gottestss_dateoftr!='0000-00-00' and gottestss_dateoftr!='--'";
	$sql_arr_home22=mysqli_query($link,$qry22) or die(mysqli_error($link));
	if($tot_arr_home22=mysqli_num_rows($sql_arr_home22)>0)
	{
		while($row_ahome22=mysqli_fetch_array($sql_arr_home22))
		{
			$qry223="select gottestss3_id from tbl_gottestsub_sub3 where gottest_tid='".$arrival_id."' and gottestss_id='".$row_ahome22['gottestss_id']."' ";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			//if($row_ahome22['gottestss_dateoftr']==NULL || $row_ahome22['gottestss_dateoftr']=='0000-00-00' || $row_ahome22['gottestss_dateoftr']=='--')
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$trdate6=split("-", $row_ahome22['gottestss_dateoftr']);
				$tryear=$trdate6[0];
				$trmonth=$trdate6[1];
				$trday=$trdate6[2];
				$trdatetrp=$trday."-".$trmonth."-".$tryear;
						
				$trdatesw=$trdates;
				$trdatetrpl=$trdatetrp;
				$replno=$row_ahome22['replno'];
				$swplot=$row_ahome22['gottestss_plantpopln'];
				$noseeds=$row_ahome22['gottestss3_maleno'];
				$trplplot=$row_ahome22['gottestss3_maleper'];
				$rnge=$row_ahome22['gottestss3_femaleno'];
				$norows=$row_ahome22['gottestss3_femaleper'];
				$bedno=$row_ahome22['gottestss3_oofno'];
				$directn=$row_ahome22['gottestss3_oofper'];
				$stste=$row_ahome22['gottestss3_totno'];
				$locn=$row_ahome22['gottestss3_totper'];
				$noplnt=$row_ahome22['gottestss3_genpurity'];
				
				$obrdate=$row_ahome22['gottestss3_doobrdate'];
				
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