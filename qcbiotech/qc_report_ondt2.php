<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
  	$edate = $_REQUEST['edate'];
 	$itemid = $_REQUEST['txtcrop'];
	$vv= $_REQUEST['txtvariety'];
	$result = $_REQUEST['result'];
	
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
<title>Quality-Report QC Status Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-qcondt.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
  <br/>
<?php	
	$t=split("-", $edate);
	$edate=$t[2]."-".$t[1]."-".$t[0];
	
	$reslt="";
 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	 
	
	$qry="select distinct variety from tbl_qctest where spdate<='".$edate."' and crop='".$itemid."' ";
	
	
	if($vv!="ALL")
	{
		$qry.=" and variety='".$vv."' ";
	}
	if($result!="ALL")	
	{
		$qry.=" and qcstatus='".$result."' ";
		$reslt=" and qcstatus='".$result."' ";
	}
	
	$qry.=" order by variety asc,spdate asc ";
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
	$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$vv."' "); 
		$rowvv=mysqli_fetch_array($quer3);
		$tt=$rowvv['popularname'];
		$tot=mysqli_num_rows($quer3);	
		if($tot==0)
		{
			$vv=$vv;
		}
		else
		{
			$vv=$tt;
		}
	}
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">QC Status Report As on Date: <?php echo $_GET['edate'];?></td>
  	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vv;?>&nbsp;</td>
  	</tr>
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="19" align="center" valign="middle" class="tblheading">#</td>
			<td width="82"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="153"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="112"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="42"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="51"  align="center" valign="middle" class="tblheading">Qty</td>
			<!--<td width="68"  align="center" valign="middle" class="tblheading">Stage</td>-->
			<td width="61" align="center" valign="middle" class="tblheading">PP</td>
			<td width="56" align="center" valign="middle" class="tblheading" >Moist %</td>
			<td width="49" align="center" valign="middle" class="tblheading" >Germ %</td>
			<td width="69" align="center" valign="middle" class="tblheading">DOT</td>
            <td width="62" align="center" valign="middle" class="tblheading">QC Status</td>
			<td width="62" align="center" valign="middle" class="tblheading">QC Doc. Ref. No.</td>
            <td width="62" align="center" valign="middle" class="tblheading">DOGR</td>
            <td width="62" align="center" valign="middle" class="tblheading">GOT Status</td>
</tr>

<?php
$srno=1; $cnt=0;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_arr_home2=mysqli_query($link,"select distinct oldlot from tbl_qctest where spdate<='$edate' and crop='".$itemid."'  and variety='".$row_arr_home1['variety']."' and state!='T' $reslt order by variety asc, spdate asc ") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{

$sql_arr_home3=mysqli_query($link,"select MAX(tid) from tbl_qctest where spdate<='$edate' and crop='".$itemid."'  and variety='".$row_arr_home1['variety']."' and oldlot='".$row_arr_home2['oldlot']."' and state!='T' $reslt order by variety asc, spdate asc ") or die(mysqli_error($link));
while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
{
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where spdate<='$edate' and crop='".$itemid."'  and variety='".$row_arr_home1['variety']."' and oldlot='".$row_arr_home2['oldlot']."' and tid='".$row_arr_home3[0]."' $reslt order by variety asc, spdate asc ") or die(mysqli_error($link));

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['testdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$flg=0;	$qcresult="";
	$qcresult=$row_arr_home['qcstatus'];	
$slups=0; $slqty=0; $sstage="";	$qcrefno="";
$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where orlot='".$row_arr_home['oldlot']."'  order by lotldg_subbinid") or die(mysqli_error($link));
 $t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and orlot='".$row_arr_home['oldlot']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $row_arr_home['oldlot']."  ".$row_tbl1[0]."<br />";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";

while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$slups+$row_tbl_sub['lotldg_balbags'];
	$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
	if($qcresult=="" || $qcresult=="Abort")
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
}
$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where orlot='".$row_arr_home['oldlot']."'  order by subbinid") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
{
$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and orlot='".$row_arr_home['oldlot']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $row_arr_home['oldlot']."  ".$row_tbl1[0]."<br />";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";

while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	//$slups=$slups+$row_tbl_sub['lotldg_balbags'];
	$slqty=$slqty+$row_tbl_sub['balqty'];
	if($qcresult=="" || $qcresult=="Abort")
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
}
$lotno=$row_arr_home['oldlot'];
$sstage=$row_arr_home['trstage'];
if($got=="")
$got=$row_arr_home['moist'];
if($stage=="")
$stage=$row_arr_home['gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['qcstatus'];
$qcrefno=$row_arr_home['qcrefno'];
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}

		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
		}
		else
		{
		 $crop=$row_arr_home['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['variety'];
		}
		else
		{
		$variety=$row_arr_home['variety'];	
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
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  

    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

if($result!="ALL" && $result!=$qcresult)$flg++;	
if($qcresult=="NUT")$flg++;	
if(($qcresult=="OK" || $qcresult=="Fail") && $qty==0)$flg++;
if($qcresult=="RT" || $qcresult=="UT"){$stage=""; $trdate="";}

if($flg==0)
{$cnt++;
if($srno%2!=0)
{
?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="82" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="153" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="112" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="42" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		  <!--<td width="68" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>-->
         <td width="61" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="56" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="49" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $qcrefno?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $gotresult?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="82" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="153" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="112" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="42" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		 <!--<td width="68" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>-->
         <td width="61" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="56" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="49" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $qcrefno?></td>
        <td align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $gotresult?></td>
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
if($cnt==0)
{
?>
<tr  height="25"><td colspan="14" align="center" class="subheading">No Records found.</td></tr>
<?php
}
?>	
</table>
  <br/>

<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-qcondt.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>