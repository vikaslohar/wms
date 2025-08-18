<?php session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
		echo '<script language="JavaScript" type="text/JavaScript">';
		echo "window.location='../login.php' ";
		echo '</script>';
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['sdate']))
	{
		$sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
		$edate = $_REQUEST['edate'];
	}
	if(isset($_GET['print']))
	{
		$print = $_GET['print'];
		if($print=='add')
		{
			$pr="Record Added Successfully";
		}
	}
	if(isset($_POST['frm_action'])=='submit')
	{

	}
?>

<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<title>Quality GOT- Report Periodical GOT Result Report</title><table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--<a href="excel-pgotresult.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php	
	$t=split("-",$sdate);
	$z=sprintf("%02d",$t[0]);
	$sdate=$z."-".$t[1]."-".$t[2];

	$t=split("-",$edate);
	$z=sprintf("%02d",$t[0]);
	$edate=$z."-".$t[1]."-".$t[2];
	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;
	
	$edate=$edate;
	$tday=substr($edate,0,2);
	$tmonth=substr($edate,3,2);
	$tyear=substr($edate,6,4);
	$edate=$tyear."-".$tmonth."-".$tday;
	
	
$sql="select distinct gottest_sampleno from tbl_gottest where gottest_gotdate<='$edate' and gottest_gotdate>='$sdate' ";
$sql.=" and gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Periodical GOT Result Report Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
</table>
<?php
if($tot_arr_home > 0)
{
?>  
<table  border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="19" align="center" valign="middle" class="tblheading">#</td>
	<td width="82"  align="center" valign="middle" class="tblheading">Crop</td>
	<td width="153"  align="center" valign="middle" class="tblheading">Variety</td>
	<td width="112"  align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="42"  align="center" valign="middle" class="tblheading">NoB</td>
	<td width="51"  align="center" valign="middle" class="tblheading">Qty</td>
	<td width="68"  align="center" valign="middle" class="tblheading">Stage</td>
	<td width="54" align="center" valign="middle" class="tblheading">PP</td>
	<td width="61" align="center" valign="middle" class="tblheading" >Moist %</td>
	<td width="52" align="center" valign="middle" class="tblheading" >Germ %</td>
	<td width="68" align="center" valign="middle" class="tblheading">DOT</td>
	<!--<td width="62" align="center" valign="middle" class="tblheading">QC Status</td>-->
	<td width="62" align="center" valign="middle" class="tblheading">DOGR</td>
	<td width="62" align="center" valign="middle" class="tblheading">GOT Status</td>
	<td width="62" align="center" valign="middle" class="tblheading">GP %</td>
</tr>
<?php
$srno=1;
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
	$sql2="select MAX(gottest_tid) from tbl_gottest where gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' and gottest_gotdate<='$edate' and gottest_gotdate>='$sdate'  ";
	$sql2.=" and gottest_gotflg=1 order by gottest_tid desc ";
	//echo $sql2;
	$sql_arr_home2=mysqli_query($link,$sql2) or die(mysqli_error($link));
	$tot_max2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home3=mysqli_fetch_array($sql_arr_home2))
	{
	
	$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
	$tot_max=mysqli_num_rows($sql_max);
	while($row_arr_home=mysqli_fetch_array($sql_max))
	{
		$trdate=$row_arr_home['gottest_gotdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;
		
		$gpp=$row_arr_home['genpurity'];	
		//$lrole=$row_arr_home['arr_role'];
		$arrival_id=$row_arr_home['gottest_tid'];
		$crop=""; $variety=""; $lotno=""; $spcodes=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult=""; $gpp='';
		
		$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['gottest_lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
		$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
		if($T=mysqli_num_rows($sql_tbl_sub1)>0)
		{
		
			$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
			$row_tbl1=mysqli_fetch_array($sql_tbl1);
		
			$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));
		
			$total_tbl=mysqli_num_rows($sql1);
			$slups=0; $slqty=0; $sstage="";
			while($row_tbl_sub=mysqli_fetch_array($sql1))
			{
				$slups=$slups+$row_tbl_sub['lotldg_balbags'];
				$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
				$sstage=$row_tbl_sub['lotldg_sstage'];
				$qcresult=$row_tbl_sub['lotldg_qc'];
				$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
				$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
				$lotno=$row_tbl_sub['lotno'];
				$qc=$row_tbl_sub['lotldg_vchk'];
				if($got=="")
				$got=$row_tbl_sub['lotldg_moisture'];
				if($stage=="")
				$stage=$row_tbl_sub['lotldg_gemp'];
				$sstatus=$row_tbl_sub['lotldg_sstatus'];
				if($gpp=='')$gpp=$row_tbl_sub['lotldg_genpurity'];	
				
				$trdate1=$row_tbl_sub['lotldg_qctestdate'];
				$tryear1=substr($trdate1,0,4);
				$trmonth1=substr($trdate1,5,2);
				$trday1=substr($trdate1,8,2);
				$trdate1=$trday1."-".$trmonth1."-".$tryear1;
				if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
				
			}
		}
		else
		{
			/*$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid, variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['gottest_lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
			$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
			if($T=mysqli_num_rows($sql_tbl_sub1)>0)
			{
			
				$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
			
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));
			
				$total_tbl=mysqli_num_rows($sql1);
				$slups=0; $slqty=0; $sstage="";
				while($row_tbl_sub=mysqli_fetch_array($sql1))
				{
					$slups=$slups+$row_tbl_sub['lotldg_balbags'];
					$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
					$sstage=$row_tbl_sub['lotldg_sstage'];
					$got=$row_tbl_sub['lotldg_got1'];
				}
			}*/
		}
		$got1=explode(" ",$got);
		$got2=$got1[0];
		//echo $slups;
		$aq=explode(".",$slqty);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
	
		$an=explode(".",$slups);
		if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
		
			$bags=$acn;
			//$qty=$ac;
				
		
		
		if($qcresult!="")
		{
			$qcresult=$qcresult."<br>".$got2." ".$row_arr_home['gottest_gotstatus'];
			// $row_tbl_sub['lotcrop'];
		}
		else
		{
			$qcresult=$got2." ".$row_arr_home['gottest_gotstatus'];
		}
		
		if($crop!="")
		{
			$crop=$crop."<br>".$row_arr_home['gottest_crop'];
			// $row_tbl_sub['lotcrop'];
		}
		else
		{
			$crop=$row_arr_home['gottest_crop'];
		}
		if($variety!="")
		{
			$variety=$variety."<br>".$row_arr_home['gottest_variety'];
		}
		else
		{
			$variety=$row_arr_home['gottest_variety'];	
		}
		if($lotno!="")
		{
			$lotno=$lotno."<br>".$row_arr_home['gottest_oldlot'];
		}
		else
		{
			$lotno=$row_arr_home['gottest_oldlot'];
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}
		
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' "); 
		$row_ver=mysqli_fetch_array($quer3);
		$tt=$row_ver['popularname'];
		$tot=mysqli_num_rows($quer3);	
		if($tot==0)
		{
			$vvrt=$row_arr_home['variety'];
		}
		else
		{
			 $vvrt=$tt;
		 }
	    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
		$row31=mysqli_fetch_array($quer3);
		
		$quer32=mysqli_query($link,"SELECT * FROM tblspcodes where variety ='".$row_arr_home['gottest_variety']."' "); 
		$rowvv2=mysqli_fetch_array($quer32);
		if(mysqli_num_rows($quer32)>0)
		$spcodes=$rowvv2['spcodef']." x ".$rowvv2['spcodem'];
		if($srno%2!=0)
		{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $vvrt?></td>
	<td width="112" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="68" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="61" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
	<!--<td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>-->
	<td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $gpp;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $vvrt?></td>
	<td width="112" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="68" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="61" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
	<!--<td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>-->
	<td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $gpp;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<?php
}
else
{
?>
<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
</table>
<br/>
<?php
}
?>			
<br/>
  
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--<a href="excel-pgotresult.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>