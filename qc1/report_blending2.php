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
	
	$qry="select varietyid from tblvariety where varietyid!='0' ";
	
	if($crop!="ALL")
	{
		$qry.=" and cropname='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety1!="ALL")
	{	
		$qry.="and varietyid='$variety1' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety1."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtvertype!="ALL")
	{	
		$qry.="and vt='$txtvertype' ";
	}
	
	$qry.=" order by cropid, popularname Asc";
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<title>QC Manager - Report - Periodical QC Manager Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="750" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-blending.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtvertype=<?php echo $_REQUEST['txtvertype'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onclick="window.close()" /></a>&nbsp;</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">
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
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<!--<td width="70" align="center" valign="middle" class="smalltblheading">#</td>-->
	<td width="115"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td align="center" valign="middle" class="smalltblheading">Variety</td>
	<td align="center" valign="middle" class="smalltblheading">Blending Date</td>
	<td  align="center" valign="middle" class="smalltblheading">Blended Lot No.</td>
	<td align="center" valign="middle" class="smalltblheading">Qty</td>
	<td align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td align="center" valign="middle" class="smalltblheading">Constituent Lot No.</td>
	<td align="center" valign="middle" class="smalltblheading">Qty</td>
	<td align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="40"  align="center" valign="middle" class="smalltblheading">QC</td>
	<td align="center" valign="middle" class="smalltblheading">DoT</td>
	<td align="center" valign="middle" class="smalltblheading">Germ.%</td>
	<td width="95"  align="center" valign="middle" class="smalltblheading">GOT</td>
	<td align="center" valign="middle" class="smalltblheading">DoGR</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['varietyid']."'") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		$cropname=$rowvv['cropid'];
	}
	
$sql_rr=mysqli_query($link,"SELECT * FROM tbl_blendm WHERE blendm_variety='".$row_arr_home1['varietyid']."' and `blendm_date`<='$edate' and `blendm_date`>='$sdate' and blendm_bflg=1  order by blendm_id asc") or die(mysqli_error($link));
if($tot_rr=mysqli_num_rows($sql_rr)>0)
{
	while($row_rr=mysqli_fetch_array($sql_rr))
	{
		$rdate=$row_rr['blendm_date'];
		$ryear=substr($rdate,0,4);
		$rmonth=substr($rdate,5,2);
		$rday=substr($rdate,8,2);
		$blendingdate=$rday."-".$rmonth."-".$ryear;
				
		$sqlmonth2=mysqli_query($link,"SELECT distinct blends_newlot FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_delflg=0")or die("Error:".mysqli_error($link));
		$t2=mysqli_num_rows($sqlmonth2);
		while($rowmonth2=mysqli_fetch_array($sqlmonth2))
		{
			$lotno=""; $cqty=""; $mainsloc=""; $mwareh=""; $mbinn=""; $msubbinn="";
			$sqlmonth1=mysqli_query($link,"SELECT * FROM tbl_blendss WHERE blendm_id='".$row_rr['blendm_id']."' and blendss_newlot='".$rowmonth2['blends_newlot']."'")or die("Error:".mysqli_error($link));
			$t1=mysqli_num_rows($sqlmonth1);
			$rowmonth1=mysqli_fetch_array($sqlmonth1);
		
			$lotno=$rowmonth2['blends_newlot'];
			
			$sql_whousem=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$rowmonth1['blendss_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whousem=mysqli_fetch_array($sql_whousem);
			$mwareh=$row_whousem['perticulars']."/";
			
			$sql_binnm=mysqli_query($link,"select binname from tbl_bin where binid='".$rowmonth1['blendss_binid']."' and whid='".$rowmonth1['blendss_whid']."'") or die(mysqli_error($link));
			$row_binnm=mysqli_fetch_array($sql_binnm);
			$mbinn=$row_binnm['binname']."/";
			
			$sql_subbinnm=mysqli_query($link,"select sname from tbl_subbin where sid='".$rowmonth1['blendss_subbinid']."' and binid='".$rowmonth1['blendss_binid']."' and whid='".$rowmonth1['blendss_whid']."'") or die(mysqli_error($link));
			$row_subbinnm=mysqli_fetch_array($sql_subbinnm);
			$msubbinn=$row_subbinnm['sname'];
		
			$mainsloc=$mwareh.$mbinn.$msubbinn;
						
	
			$an2=explode(".",$rowmonth1['blendss_qty']);
			if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$rowmonth1['blendss_qty'];}
			$ctlotno=""; $rmqty1=""; $qcresult=''; $gotresult=''; $dogr=''; $dot=''; $slocs=""; $gemp="";
			$sqlmonth3=mysqli_query($link,"SELECT * FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_newlot='".$rowmonth2['blends_newlot']."' and blends_delflg=0")or die("Error:".mysqli_error($link));
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
				
				if($qcresult!="")
				$qcresult=$qcresult."<br />".$rowmonth3['blends_qc'];
				else
				$qcresult=$rowmonth3['blends_qc'];
				
				if($gotresult!="")
				$gotresult=$gotresult."<br />".$rowmonth3['blends_got'];
				else
				$gotresult=$rowmonth3['blends_got'];
				
				$dogr2=''; $dot2=''; $slocs2="";
				
				$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$rowmonth3['blends_lotno']."' and lotldg_trtype='Blending' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_lotno='".$rowmonth3['blends_lotno']."' and lotldg_trtype='Blending' order by lotldg_id desc ") or die(mysqli_error($link));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($link,"select lotldg_trqty, lotldg_trbags, lotldg_got1, lotldg_got, lotldg_gemp, lotldg_gottestdate, lotldg_qc, lotldg_qctestdate, lotldg_whid, lotldg_binid, lotldg_subbinid from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_istbl))
						{ 
							$slups=''; $slqty=''; $gemp2='';
							$gemp2=$row_issuetbl['lotldg_gemp'];
							
							$trdate1=$row_issuetbl['lotldg_gottestdate'];
							$tryear1=substr($trdate1,0,4);
							$trmonth1=substr($trdate1,5,2);
							$trday1=substr($trdate1,8,2);
							$trdate1=$trday1."-".$trmonth1."-".$tryear1;
							if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="--";
								$dogr2=$trdate1;
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$dot2=$trday."-".$trmonth."-".$tryear;
							if($dot2=="00-00-0000" || $dot2=="--")$dot2="--";
							
							
							
							$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
							$row_whouse=mysqli_fetch_array($sql_whouse);
							$wareh=$row_whouse['perticulars']."/";
							
							$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_binn=mysqli_fetch_array($sql_binn);
							$binn=$row_binn['binname']."/";
							
							$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_subbinn=mysqli_fetch_array($sql_subbinn);
							$subbinn=$row_subbinn['sname'];
						
							$slups=$row_issuetbl['lotldg_trbags'];
							$slqty=$row_issuetbl['lotldg_trqty'];
							$aq1=explode(".",$slups);
							if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
						
							$an1=explode(".",$slqty);
							if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
							$slups=$ac1;
							$slqty=$acn1;
							if($slqty>0)
							{
								if($slocs2!="")
									$slocs2=$slocs2.",".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
								else
									$slocs2=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
							}
							if($slocs!="")
							$slocs=$slocs."<br />".$slocs2;
							else
							$slocs=$slocs2;
						}
					}
				}
				if($dot!="")
				$dot=$dot."<br />".$dot2;
				else
				$dot=$dot2;
				
				if($dogr!="")
				$dogr=$dogr."<br />".$dogr2;
				else
				$dogr=$dogr2;
				
				if($gemp!="")
				$gemp=$gemp."<br />".$gemp2;
				else
				$gemp=$gemp2;
			}
if($srno%2!=0)
{
?>	
<tr class="Light">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendingdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mainsloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ctlotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendingdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mainsloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ctlotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr;?></td>
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