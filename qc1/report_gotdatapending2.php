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
		
$sql="select distinct(gottest_lotno) from tbl_gottest where gottest_gotflg=0";


if($cid!="ALL")
{	
	$sql.=" and gottest_crop='".$cid."' ";
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$cid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	
}
else
{
	$crop=$cid;	
}	
		
	if($itemid!="ALL")
	{
		$sql.=" and gottest_variety='".$itemid."' ";
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$itemid' "); 
		$row_dept4=mysqli_fetch_array($quer4);
		$tot_var=mysqli_num_rows($quer4);
		if($tot_var > 0)
		{	
			$variet=$row_dept4['popularname'];
		}
		else 
		{
			$variet=$itemid;
		} 
	}
	else
	{
		$variet="ALL";
	}
$sql.=" order by gottest_dosdate asc, gottest_lotno asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);	
?>
<title>Quality - Pending GOT Report - GOT Data Pending</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--<a href="excel-gotdatapending.php?txtcrop=<?php echo $cid;?>&txtvariety=<?php echo $itemid;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
 <tr height="25" >
    <td align="center" class="subheading" style="color:#303918;" colspan="2">Pending GOT Report - GOT Data Pending</td>
  </tr>
  	<tr height="25">
	<td align="left" class="subheading" style="color:#303918;" width="50%">&nbsp;&nbsp;Arrival Period From: <?php echo $_REQUEST['sdate'];?></td>
	 <td align="right" class="subheading" style="color:#303918;">To: <?php echo $_REQUEST['edate'];?>&nbsp;&nbsp;</td>
  	</tr>
  <tr height="25" >
    <td align="left" class="subheading" style="color:#303918;" width="50%">&nbsp;&nbsp;Crop: <?php echo $crop;?></td>
	 <td align="right" class="subheading" style="color:#303918;">Variety: <?php echo $variet;?>&nbsp;&nbsp;</td>
  </tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading" rowspan="2">Date of Arrival</td>
			<td width="94"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
			<td width="176"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			<td width="123"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
			<td width="54"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
			<td align="center" valign="middle" class="tblheading" colspan="4" >IN_TERRA: Sowing</td>
			<td align="center" valign="middle" class="tblheading" colspan="9" >IN_TERRA: Transplanting</td>
</tr>
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading">Replication No.</td>
<td align="center" valign="middle" class="tblheading">Date of Sowing</td>
<td align="center" valign="middle" class="tblheading">Sowing Plot</td>
<td align="center" valign="middle" class="tblheading">No. of Seeds</td>
<td align="center" valign="middle" class="tblheading">Date of Transplant</td>
<td align="center" valign="middle" class="tblheading">Transplant Plot</td>
<td align="center" valign="middle" class="tblheading">Range</td>
<td align="center" valign="middle" class="tblheading">No. of Rows</td>
<td align="center" valign="middle" class="tblheading">Bed No.</td>
<td align="center" valign="middle" class="tblheading">Direction</td>
<td align="center" valign="middle" class="tblheading">State</td>
<td align="center" valign="middle" class="tblheading">Location</td>
<td align="center" valign="middle" class="tblheading">No. of Plants</td>
</tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
$sqlmax2="select MAX(gottest_tid) from tbl_gottest where gottest_lotno='".$row_arr_home2['gottest_lotno']."'";
$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));

$tot_max2=mysqli_num_rows($sql_max2);
$row_arr_home3=mysqli_fetch_array($sql_max2);

$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
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
		
	//$lrole=$row_arr_home['arr_role'];
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
	
	$sql_dtchk=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 order by arrival_id asc") or die(mysqli_error($link));
	$tot_dtchk=mysqli_num_rows($sql_dtchk);
	while($row_dtchk=mysqli_fetch_array($sql_dtchk))
	{
		$lid=explode(",",$row_dtchk['lotno']);
		foreach($lid as $fid)
		{
			if($fid <> "" && $fid!=0)
			{
				if($fid==$row_arr_home['gottest_tid'])
				{
				
				if($row_dtchk['pid']=="Yes")
				{
					$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_dtchk['party_id']."'"); 
					$row3=mysqli_fetch_array($quer3);
					$address=$row3['city'];
				}
				else
				{
					$address=$row_dtchk['city'];
				}
				$tmode=$row_dtchk['tmode'];
				}
			}	
		}
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
				//$flg=0;
				
				if($cropage!="" && $cropage>0)
				{
					$trplntdt=$row_ahome22['gottestss_doswdate'];
					$trdate6=split("-", $trplntdt);
					$tryear=$trdate6[0];
					$trmonth=$trdate6[1];
					$trday=$trdate6[2];
					$trdates=$trday."-".$trmonth."-".$tryear;
					
					$trdate6=split("-", $trplntdt);
					$tryear=$trdate6[0];
					$trmonth=$trdate6[1];
					$trday=$trdate6[2];
					$trdate=$tryear."-".$trmonth."-".$trday;
					
					$trdate240=date("Y-m-d");
					
					$diff = abs(strtotime($trdate240) - strtotime($trdate));
					$days = floor($diff / (60*60*24));
					if($cropage>=$days)
					{
						$z++;
						$trdate6=split("-", $row_ahome22['gottestss_dateoftr']);
						$tryear=$trdate6[0];
						$trmonth=$trdate6[1];
						$trday=$trdate6[2];
						$trdatetrp=$trday."-".$trmonth."-".$tryear;
						
						if($trdatesw!="") {	$trdatesw=$trdatesw."<br />".$trdates;} else { $trdatesw=$trdates;}
						if($trdatetrpl!="") { $trdatetrpl=$trdatetrpl."<br />".$trdatetrp;} else { $trdatetrpl=$trdatetrp;}
						if($replno!="") { $replno=$replno."<br />".$row_ahome22['replno'];} else { $replno=$row_ahome22['replno'];}
						if($swplot!="") { $swplot=$swplot."<br />".$row_ahome22['gottestss_swoingplot'];} else { $swplot=$row_ahome22['gottestss_swoingplot'];}
						if($noseeds!="") { $noseeds=$noseeds."<br />".$row_ahome22['gottestss_noofrows'];} else { $noseeds=$row_ahome22['gottestss_noofrows'];}
						if($trplplot!="") { $trplplot=$trplplot."<br />".$row_ahome22['gottestss_trplot'];} else { $trplplot=$row_ahome22['gottestss_trplot'];}
						if($rnge!="") { $rnge=$rnge."<br />".$row_ahome22['gottestss_range'];} else { $rnge=$row_ahome22['gottestss_range'];}
						if($norows!="") { $norows=$norows."<br />".$row_ahome22['gottestss_trrows'];} else { $norows=$row_ahome22['gottestss_trrows'];}
						if($bedno!="") { $bedno=$bedno."<br />".$row_ahome22['gottestss_bedno'];} else { $bedno=$row_ahome22['gottestss_bedno'];}
						if($directn!="") { $directn=$directn."<br />".$row_ahome22['gottestss_direction'];} else { $directn=$row_ahome22['gottestss_direction'];}
						if($stste!="") { $stste=$stste."<br />".$row_ahome22['gottestss_state'];} else { $stste=$row_ahome22['gottestss_state'];}
						if($locn!="") { $locn=$locn."<br />".$row_ahome22['gottestss_gotlocation'];} else { $locn=$row_ahome22['gottestss_gotlocation'];}
						if($noplnt!="") { $noplnt=$noplnt."<br />".$row_ahome22['gottestss_plantpopln'];} else { $noplnt=$row_ahome22['gottestss_plantpopln'];}
					}
				}
			}
		}
	}
	else
	{$flg=0;}
	
	if($z==0)$flg=0;
//}
//echo $dt2;

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
	<td width="176" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="95" align="center" valign="middle" class="tblheading"><?php echo $replno?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdatesw?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $swplot;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $noseeds;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdatetrpl;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $norows;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $bedno;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $directn;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stste;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $locn;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $noplnt;?></td>
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
	<td width="176" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="95" align="center" valign="middle" class="tblheading"><?php echo $replno?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdatesw?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $swplot;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $noseeds;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdatetrpl;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $trplplot;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $rnge;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $norows;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $bedno;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $directn;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stste;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $locn;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $noplnt;?></td>
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