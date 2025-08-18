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
	
	$cid = $_REQUEST['txtcrop'];
	$itemid = $_REQUEST['txtvariety'];	
	$edate = $_REQUEST['edate'];
	$sdate=$_REQUEST['sdate'];
	$cropage = $_REQUEST['cropage'];
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
		
$sql="select distinct(gottest_lotno) from tbl_gottest where gottest_gotflg=1";
$sql.=" order by gottest_dosdate asc, gottest_lotno asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);		
?>
<title>Quality - Comprehensive GOT Data Report (In Terra)</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--<a href="excel-gotdatapending.php?txtcrop=<?php echo $cid;?>&txtvariety=<?php echo $itemid;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
 <tr height="25" >
    <td align="center" class="subheading" style="color:#303918;" colspan="2">Comprehensive GOT Data Report (In Terra)</td>
  </tr>
  	<tr height="25">
	<td align="left" class="subheading" style="color:#303918;" width="50%">&nbsp;&nbsp;Arrival Period From: <?php echo $_REQUEST['sdate'];?></td>
	 <td align="right" class="subheading" style="color:#303918;">To: <?php echo $_REQUEST['edate'];?>&nbsp;&nbsp;</td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading" >#</td>
			<td width="70"  align="center" valign="middle" class="tblheading" >Date of Arrival</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Crop</td>
			<td width="123"  align="center" valign="middle" class="tblheading" >SP Codes</td>
			<td width="176"  align="center" valign="middle" class="tblheading" >Variety</td>
			<td width="54"  align="center" valign="middle" class="tblheading" >Stage</td>
			<td width="123"  align="center" valign="middle" class="tblheading" >Lot No.</td>
			<td width="54"  align="center" valign="middle" class="tblheading" >NoB</td>
			<td width="54"  align="center" valign="middle" class="tblheading" >Qty</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Production Location</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Organiser</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Farmer</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Production Personnel</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >GOT Status</td>
</tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
$sqlmax2="select MAX(gottest_tid) from tbl_gottest where gottest_lotno='".$row_arr_home2['gottest_lotno']."' and gottest_gotflg=1";
$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));

$tot_max2=mysqli_num_rows($sql_max2);
$row_arr_home3=mysqli_fetch_array($sql_max2);

$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_arr_home3[0]."' and gottest_gotflg=1 ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	$trdate=$row_arr_home['gottest_srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$trdate1=$row_arr_home['gottest_spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_arr_home['gottest_dosdate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
		
	$gotstatus=$row_arr_home['gottest_gotstatus'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type='IN-TERRA' ") or die(mysqli_error($link));
$tot_max6=mysqli_num_rows($sql_max6);
while($row_arr_home6=mysqli_fetch_array($sql_max6))
{	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where orlot='".$row_arr_home['gottest_oldlot']."'") or die(mysqli_error($link));  
	$row_tbl1=mysqli_fetch_array($sql_tbl1);
	
	$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
	
	if($total_tbl=mysqli_num_rows($sql1)>0)
	{
		$slups=0; $slqty=0; $sstage="";$got="";
		while($row_tbl_sub=mysqli_fetch_array($sql1))
		{
		$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
		$slups=$slups+$row_tbl_sub['lotldg_balnob'];
		$sstage=$row_tbl_sub['lotldg_sstage'];
		$got=$row_tbl_sub['lotldg_got1'];
		}
	}
	else
	{
	
		$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where orlot='".$row_arr_home['gottest_oldlot']."'") or die(mysqli_error($link));  
		$row_tbl1=mysqli_fetch_array($sql_tbl1);
		
		$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0")or die(mysqli_error($link));
		
		$total_tbl=mysqli_num_rows($sql1);
		$slups=0; $slqty=0; $sstage="";$got="";
		while($row_tbl_sub=mysqli_fetch_array($sql1))
		{
		$slqty=$slqty+$row_tbl_sub['balqty'];
		$slups=$slups+0;
		$sstage=$row_tbl_sub['lotldg_sstage'];
		$got=$row_tbl_sub['lotldg_got1'];
		}
	}
	//echo $slups;
	$aq=explode(".",$slqty);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
	
	$an=explode(".",$slups);
	if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage="";  $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	
	if($lotno!="")
	{
		$lotno=$lotno."<br>".$row_arr_home['gottest_oldlot'];
	}
	else
	{
		$lotno=$row_arr_home['gottest_oldlot'];
	}
	if($bags!="")
	{
		$bags=$bags."<br>".$acn;
	}
	else
	{
		$bags=$acn;
	}
	if($qty!="")
	{
		$qty=$qty."<br>".$ac;
	}
	else
	{
		$qty=$ac;
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['gottest_variety']."'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$tot_var=mysqli_num_rows($quer4);
	if($tot_var > 0)
	{	
		$variety=$row_dept4['popularname'];
	}
	else 
	{
		$variety=$row_arr_home['gottest_variety'];
	} 
	$arrdate=''; $flg=0; $trplntdt=''; $pper=''; $org=''; $farmer=''; $ploc='';
	$qry23="select * from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."'";
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
			
			$ploc=$row_arr_home23['ploc'];
			$org=$row_arr_home23['organiser'];
			$farmer=$row_arr_home23['farmer'];
			$pper=$row_arr_home23['pper'];
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
	
	$quer32=mysqli_query($link,"SELECT * FROM tblspcodes where variety ='".$row_arr_home['gottest_variety']."' "); 
	$rowvv2=mysqli_fetch_array($quer32);
	if(mysqli_num_rows($quer32)>0)
	$spcodes=$rowvv2['spcodef']." x ".$rowvv2['spcodem'];
	
	$stage=$row_arr_home['gottest_trstage'];
		//echo $row_arr_home['gottest_oldlot']."  -=-  ".$arrival_id."  -=-  ".$flg."<br/>";
if($flg>0)
{		
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $arrdate?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
	<td width="176" align="center" valign="middle" class="tblheading"><?php echo $spcodes?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="95" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $org;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $pper;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $gotstatus;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $arrdate?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
	<td width="176" align="center" valign="middle" class="tblheading"><?php echo $spcodes?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="95" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $org;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $pper;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $gotstatus;?></td>
</tr>
<?php
}
$srno=$srno+1;
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