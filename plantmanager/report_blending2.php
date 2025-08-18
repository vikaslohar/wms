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
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety1 = $_REQUEST['txtvariety'];
	$txtvertype=$_REQUEST['txtvertype'];
		
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
		
	$crp="ALL"; $ver="ALL"; 
	//$qry="select varietyid, popularname from tblvariety where proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' ";
	
	$qry="select varietyid from tblvariety where cropname='$crop' ";
	$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
	$row_crp=mysqli_fetch_array($sql_crp);
	$crp=$row_crp['cropname'];
	
	if($variety1!="ALL")
	{	
		$qry.="and varietyid='$variety1' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety1."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtvertype!="ALL")
	{	
		$qry.="and vt='$txtvertype' ";
	}
	
	$qry.=" order by popularname Asc";
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>Plant Manager - Report - Periodical Blending Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="750" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-blending.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtvertype=<?php echo $_REQUEST['txtvertype'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onclick="window.close()" /></a>&nbsp;</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
   <tr class="Dark" height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Periodical Blending Report</td>
  	</tr>
	<tr class="Dark" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr class="Dark" height="25" >
	<td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crp;?></td>
    <td align="center" class="subheading" style="color:#303918; ">Variety Type: <?php echo $txtvertype;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <!--<td width="70" align="center" valign="middle" class="smalltblheading">#</td>-->
			<td width="115"  align="center" valign="middle" class="smalltblheading">Crop</td>
			<td align="center" valign="middle" class="smalltblheading">Variety</td>
			 <td align="center" valign="middle" class="smalltblheading">Blending Date</td>
			 <td  align="center" valign="middle" class="smalltblheading">Blended Lot No.</td>
			 <td align="center" valign="middle" class="smalltblheading">Qty</td>
			 <td align="center" valign="middle" class="smalltblheading">Constituent Lot No.</td>
			 <td align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['varietyid']."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
	}
	
$sql_rr=mysqli_query($link,"SELECT * FROM tbl_blendm WHERE blendm_variety='".$row_arr_home1['varietyid']."' and `blendm_date`<='$edate' and `blendm_date`>='$sdate' and blendm_bflg=1 and plantcode='$plantcode' order by blendm_id asc") or die(mysqli_error($link));
if($tot_rr=mysqli_num_rows($sql_rr)>0)
{
	while($row_rr=mysqli_fetch_array($sql_rr))
	{
		$rdate=$row_rr['blendm_date'];
		$ryear=substr($rdate,0,4);
		$rmonth=substr($rdate,5,2);
		$rday=substr($rdate,8,2);
		$trdate=$rday."-".$rmonth."-".$ryear;
				
		$sqlmonth2=mysqli_query($link,"SELECT distinct blends_newlot FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_delflg=0 and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		$t2=mysqli_num_rows($sqlmonth2);
		while($rowmonth2=mysqli_fetch_array($sqlmonth2))
		{
			$lotno=""; $cqty=""; 
			$sqlmonth1=mysqli_query($link,"SELECT * FROM tbl_blendss WHERE blendm_id='".$row_rr['blendm_id']."' and blendss_newlot='".$rowmonth2['blends_newlot']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			$t1=mysqli_num_rows($sqlmonth1);
			$rowmonth1=mysqli_fetch_array($sqlmonth1);
		
			$lotno=$rowmonth2['blends_newlot'];
	
			$an2=explode(".",$rowmonth1['blendss_qty']);
			if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$rowmonth1['blendss_qty'];}
			
			$ctlotno=""; $rmqty1=""; 
			$sqlmonth3=mysqli_query($link,"SELECT * FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_newlot='".$rowmonth2['blends_newlot']."' and blends_delflg=0 and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			$t3=mysqli_num_rows($sqlmonth3);
			while($rowmonth3=mysqli_fetch_array($sqlmonth3))
			{
				if($ctlotno!="")
				$ctlotno=$ctlotno."<br />".$rowmonth3['blends_lotno'];
				else
				$ctlotno=$rowmonth3['blends_lotno'];
				$aq3=explode(".",$rowmonth3['blends_qty']);
				if($aq3[1]==000){$rmqty=$aq3[0];}else{$rmqty=$rowmonth3['blends_qty'];}
				if($rmqty1!="")
				$rmqty1=$rmqty1."<br />".$rmqty;
				else
				$rmqty1=$rmqty;
			}
if($srno%2!=0)
{
?>	
<tr class="Light">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ctlotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ctlotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
</tr>

<?php
}
$srno=$srno+1;
//}
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
<td width="924" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-blending.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtvertype=<?php echo $_REQUEST['txtvertype'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;</td>
</tr>
</table>