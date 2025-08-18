<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
	$cid = $_REQUEST['txtcrop'];
	$itemid = $_REQUEST['txtvariety'];	
	$sdate=date("d-m-Y");
	if(isset($_POST['frm_action'])=='submit')
	{
}

?>

<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<?php 
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
$sql="select distinct sampleno from tbl_qctest where gotflg=0 and (got='UT' or got='RT') and plantcode='$plantcode'";
if($cid!="ALL")
{	
$sql.=" and crop='".$cid."'";
}
if($itemid!="ALL")
{	
$sql.=" and variety='".$itemid."'";
}
$sql.=" order by dosdate asc, oldlot asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($cid!="ALL")
{	
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
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$itemid'"); 
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
?>
<title>Quality -Report- Under Got Report</title><table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-undergot.php?txtcrop=<?php echo $cid;?>&txtvariety=<?php echo $itemid;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
 <tr height="25" >
    <td align="center" class="subheading" style="color:#303918;" colspan="2">Pending GOT Report</td>
  	</tr>
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918;" colspan="2">As on Date: <?php echo date("d-m-Y");?> </td>
  	</tr>
  <tr height="25" >
    <td align="left" class="subheading" style="color:#303918;" width="50%">&nbsp;&nbsp;Crop: <?php echo $crop;?></td>
	 <td align="right" class="subheading" style="color:#303918;">Variety: <?php echo $variet;?>&nbsp;&nbsp;</td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="21" align="center" valign="middle" class="tblheading">#</td>
			<td width="97"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="182"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="135"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="57"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="63"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="70"  align="center" valign="middle" class="tblheading">DOSR</td>
			<td width="72"  align="center" valign="middle" class="tblheading">DOSC</td>
			<td width="77" align="center" valign="middle" class="tblheading">DOSD</td>
			<td width="66" align="center" valign="middle" class="tblheading" >Location</td>
			<td width="57" align="center" valign="middle" class="tblheading" >Mode</td>
            </tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$sqlmax2="select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and plantcode='$plantcode'";
if($cid!="ALL")
{
$sqlmax2.=" and crop='".$cid."'";
}
if($itemid!="ALL")
{	
$sqlmax2.=" and variety='".$itemid."'";
}
$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));
$tot_max2=mysqli_num_rows($sql_max2);
while($row_arr_home3=mysqli_fetch_array($sql_max2))
{
$sql_max=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$trdate1=$row_arr_home['spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_arr_home['dosdate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' and plantcode='$plantcode' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	$T=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$slups=0; $slqty=0; $sstage="";
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
}
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}

$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";

$sql_dtchk=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 and plantcode='$plantcode' order by arrival_id asc") or die(mysqli_error($link));
	$tot_dtchk=mysqli_num_rows($sql_dtchk);
	while($row_dtchk=mysqli_fetch_array($sql_dtchk))
	{
		$lid=explode(",",$row_dtchk['lotno']);
		foreach($lid as $fid)
		{
			if($fid <> "" && $fid!=0)
			{
				if($fid==$row_arr_home['tid'])
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
		if($qcresult!="")
		{
		$qcresult=$qcresult."<br>".$row_arr_home['qcstatus'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $qcresult=$row_arr_home['qcstatus'];
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['oldlot'];
		}
		else
		{
		$lotno=$row_arr_home['oldlot'];
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_arr_home['pp'];
		}
		else
		{
		$qc=$row_arr_home['pp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['moist'];
		}
		else
		{
		$got=$row_arr_home['moist'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['gemp'];
		}
		else
		{
		$stage=$row_arr_home['gemp'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_arr_home['sstatus'];
		}
		else
		{
		$sstatus=$row_arr_home['sstatus'];
		}
	
	
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	*/
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['variety']."'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$tot_var=mysqli_num_rows($quer4);
		if($tot_var > 0)
		{	
			$variety=$row_dept4['popularname'];
		}
		else 
		{
			$variety=$row_arr_home['variety'];
		} 
	if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="97" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="182" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		 <td width="135" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="63" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
          <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
         </tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="97" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="182" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		 <td width="135" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="63" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
          <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
         </tr
>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
</table>			
  <br/>
<table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-undergot.php?txtcrop=<?php echo $cid;?>&txtvariety=<?php echo $itemid;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
