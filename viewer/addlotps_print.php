<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='login.php' ";
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
		$variety = $_REQUEST['txtvariety'];
		$txtpmcode=$_REQUEST['txtpmcode'];
		$sid=$_REQUEST['sid'];
		
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
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
function dateDiff($start, $end) {
  $start_ts = strtotime($start);
  $end_ts = strtotime($end);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);	
  }	
?>
<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />
<title>Processing - Report - Organiser wise Processing Status Report</title>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="850" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--<a href="excel-owpsr6.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtpmcode=<?php echo $_REQUEST['txtpmcode'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onclick="window.close()" /></a>&nbsp;</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <tr class="Dark" height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Transaction - Settlement</td>
  	</tr>
	<tr class="Dark" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr class="Dark" height="25" >
	 <td align="left" width="40%" class="subheading" style="color:#303918; ">&nbsp;Organiser: <?php echo $txtpmcode;?></td>
	 <td align="left" width="30%" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
</table>
<br />
<?php
$sid2="";
$sid3=explode(",",$sid);
$ltcnts=count($sid3);
foreach($sid3 as $sd)
{
if($sd<>"")
{
$sd2="'$sd'";
if($sid2!="")
$sid2=$sid2.",".$sd2;
else
$sid2=$sd2;
}
}
//echo $sid2;
	$sql2="select * from tbl_proslipmain where plantcode='$plantcode' AND proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' ";
	if($crop!="ALL")
	{	
		$sql2.=" and proslipmain_crop='".$crop."'";
	}
	if($variety!="ALL")
	{	
		$sql2.=" and proslipmain_variety='".$variety."' ";
	}		
		 $sql2.=" order by proslipmain_date asc";
	//echo $sql2;	 
	$sql_rr222=mysqli_query($link,$sql2) or die(mysqli_error($link));
	$tot_rr222=mysqli_num_rows($sql_rr222);

if($tot_rr222>0)
{
if($ltcnts>1)
	$qry24="select distinct lotcrop from tblarrival_sub where plantcode='$plantcode' AND organiser='".$txtpmcode."'  and lotno IN ($sid2) ";
else	
	$qry24="select distinct lotcrop from tblarrival_sub where plantcode='$plantcode' AND organiser='".$txtpmcode."'  and lotno='$sid' ";	
	
if($crop!="ALL" && $variety!="ALL")
{	
	$qry24.=" and lotcrop='".$crp."' and lotvariety='".$ver."' and sstage='Raw' ";
}
else if($crop!="ALL" && $variety=="ALL")
{
	$qry24.=" and lotcrop='".$crp."' and sstage='Raw' ";
}
else
{
	$qry24.=" and sstage='Raw' ";
}	
	$qry24.=" order by lotcrop";
	$sql_arr_home24=mysqli_query($link,$qry24) or die(mysqli_error($link));
	$tot_arr_home24=mysqli_num_rows($sql_arr_home24);
	
while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
{
if($ltcnts>1)
$qry23="select distinct lotvariety from tblarrival_sub where plantcode='$plantcode' AND organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotno IN ($sid2) ";
else
$qry23="select distinct lotvariety from tblarrival_sub where plantcode='$plantcode' AND organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotno='$sid' ";

if($variety!="ALL")
{
	$qry23.=" and lotvariety='".$ver."' and sstage='Raw' ";
}
else
{
	$qry23.=" and sstage='Raw' ";
}	
	$qry23.=" order by lotvariety";
	$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
	$tot_arr_home23=mysqli_num_rows($sql_arr_home23);
	
while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
{	
$arid='';
if($ltcnts>1)
	$qry2="select arrival_id from tblarrival_sub where plantcode='$plantcode' AND organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' and lotno IN ($sid2)";
else
	$qry2="select arrival_id from tblarrival_sub where plantcode='$plantcode' AND organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' and lotno='$sid'";
	
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
if($arid!='')
$arid=$arid.",".$row_arr_home2['arrival_id'];
else
$arid=$row_arr_home2['arrival_id'];
}
if($arid!='')
{
?>
<!--<br />
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
	<tr class="Dark" height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $row_arr_home24['lotcrop'];?></td>
    <td align="right" width="50%" class="subheading" style="color:#303918; ">Variety: <?php echo $row_arr_home23['lotvariety'];?>&nbsp;</td>
  	</tr>
</table>-->
<?php
$qry="select arrival_id, arrival_date from tblarrival where plantcode='$plantcode' AND arrival_type='Fresh Seed with PDN' and arrtrflag=1 and arrival_id IN($arid)";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

?>	
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#ef0388" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
            <td width="60" align="center" valign="middle" class="smalltblheading" >Date of Arrival</td>
  <td width="50" align="center" valign="middle" class="smalltblheading" >Days</td>
            <td width="101" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
			<td width="105"  align="center" valign="middle" class="smalltblheading" >Prod. Location</td>
			<td width="105" align="center" valign="middle" class="smalltblheading">Prod. Personel</td>
			 <td width="105" align="center" valign="middle" class="smalltblheading">Farmer</td>
			 <td width="58"  align="center" valign="middle" class="smalltblheading" >PDN Qty</td>
			 <td width="58" align="center" valign="middle" class="smalltblheading" >Arrival Qty</td>
			 <td width="58" align="center" valign="middle" class="smalltblheading">Raw<br />Seed Qty</td>
			 <td width="58" align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
			 <td width="66"  align="center" valign="middle" class="smalltblheading" >Cond. Loss (RM + IM)</td>
             <td width="58"  align="center" valign="middle" class="smalltblheading" >GOT Result</td>
             <td width="60"  align="center" valign="middle" class="smalltblheading" >DOGR</td>
             </tr>

<?php
$cnt=0;
if($tot_arr_home > 0)
{
$srno=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

if($ltcnts>1)
	$sql_rr=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' AND arrival_id='".$row_arr_home1['arrival_id']."' and organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' and psflg=0 and lotno IN ($sid2) order by orlot asc") or die(mysqli_error($link));
else
	$sql_rr=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' AND arrival_id='".$row_arr_home1['arrival_id']."' and organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' and psflg=0 and lotno='$sid' order by orlot asc") or die(mysqli_error($link));
	

$tot_rr=mysqli_num_rows($sql_rr);
if($tot_rr > 0)
{
while($row_rr=mysqli_fetch_array($sql_rr))
{
$lgt=explode("/",$row_rr['orlot']);
$lotno1=$lgt[0];
$lotno=$row_rr['lotno'];
$ploc=$row_rr['ploc'];
$pper=$row_rr['pper'];
$farmer=$row_rr['farmer'];

$ax1=explode(".",$row_rr['qty']);
if($ax1[1]==000){$pqty=$ax1[0];}else{$pqty=$row_rr['qty'];}
$ax2=explode(".",$row_rr['act']);
if($ax2[1]==000){$arrqty=$ax2[0];}else{$arrqty=$row_rr['act'];}			
/*$pqty=$row_rr['qty'];
$arrqty=$row_rr['act'];*/
$tqty=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$lotno."' ") or die(mysqli_error($link));
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo $row_issue1[0];
$sql_issuetbl1=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
while($row_issuetbl1=mysqli_fetch_array($sql_issuetbl1))
{ 
$tqty=$tqty+$row_issuetbl1['lotldg_balqty']; 
$gotr1=explode(" ", $row_issuetbl1['lotldg_got1']); 
$gotr=$gotr1[0]." ".$row_issuetbl1['lotldg_got']; 

	$trdate=$row_issuetbl1['lotldg_gottestdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate=="--" || $trdate=="00-00-0000")$trdate="";
$dogr=$trdate; 
}
}
$rswqty=$tqty; 
 

	$sql_crp23=mysqli_query($link,"select * from tblcrop where cropname='".$row_rr['lotcrop']."'") or die(mysqli_error($link));
	$row_crp23=mysqli_fetch_array($sql_crp23);
	$crp23=$row_crp23['cropid'];

	$sql_var23=mysqli_query($link,"select * from tblvariety where popularname='".$row_rr['lotvariety']."' and actstatus='Active'") or die(mysqli_error($link));
	$row_var23=mysqli_fetch_array($sql_var23);
	$ver23=$row_var23['varietyid'];
		
		 
$cswqty=""; $tplqty="";  $flg=0;
$sql="select * from tbl_proslipmain where plantcode='$plantcode' AND proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' ";
	if($crop!="ALL")
	{	
		$sql.=" and proslipmain_crop='".$crp23."'";
	}
	if($variety!="ALL")
	{	
		$sql.=" and proslipmain_variety='".$ver23."'";
	}		
		 $sql.="  and proslipmain_stage='".$row_rr['sstage']."' and proslipmain_tflag=1 order by proslipmain_date asc";
		 
	$sql_rr22=mysqli_query($link,$sql) or die(mysqli_error($link));
	if($tot_rr22=mysqli_num_rows($sql_rr22)>0)
	{ 
//$sql_rr22=mysqli_query($link,"select * from tbl_proslipmain where plantcode='$plantcode' AND proslipmain_crop='".$crp23."' and proslipmain_variety='".$ver23."' and proslipmain_stage='".$row_rr['sstage']."' and proslipmain_tflag=1 order by proslipmain_id asc") or die(mysqli_error($link));

//$tot_rr22=mysqli_num_rows($sql_rr22);
while($row_rr22=mysqli_fetch_array($sql_rr22))
{
	$sql_issuetbl=mysqli_query($link,"select * from tbl_proslipsub where plantcode='$plantcode' AND proslipmain_id='".$row_rr22['proslipmain_id']."' and proslipsub_lotno='".$lotno."' order by proslipsub_lotno asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
	if($t > 0)
	{ $rmqty1=0;$imqty1=0;$flg++;
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{ 
			$an2=explode(".",$row_issuetbl['proslipsub_conqty']);
			if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$row_issuetbl['proslipsub_conqty'];}
			
			$aq3=explode(".",$row_issuetbl['proslipsub_rm']);
			if($aq3[1]==000){$rmqty1=$aq3[0];}else{$rmqty1=$row_issuetbl['proslipsub_rm'];}
			
			$an3=explode(".",$row_issuetbl['proslipsub_im']);
			if($an3[1]==000){$imqty1=$an3[0];}else{$imqty1=$row_issuetbl['proslipsub_im'];}
		
			$tplqty=$rmqty1+$imqty1;
			$cswqty=$cqty1;
		}
	}
}
}
	$trdate1=$row_arr_home1['arrival_date'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;

$start1 = $row_arr_home1['arrival_date'];
$end1 = date("Y-m-d");
$diff=dateDiff($start1, $end1);

if($flg>0)
{
$cnt++;
if($srno%2!=0)
{
?>			  
<tr class="Light">
  <td width="60" align="center" valign="middle" class="smallesttbltext"><?php echo $trdate1;?></td>
  <td width="50" align="center" valign="middle" class="smallesttbltext"><?php echo $diff;?></td>
			<td width="101" align="center" valign="middle" class="smallesttbltext"><?php echo $lotno1;?></td>
		   	<td align="center" valign="middle" class="smallesttbltext"><?php echo $ploc;?></td>
          	<td align="center" valign="middle" class="smallesttbltext"><?php echo $pper?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $farmer?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $pqty?></td>
		   	<td align="center" valign="middle" class="smallesttbltext"><?php echo $arrqty;?></td>
           	<td align="center" valign="middle" class="smallesttbltext"><?php echo $rswqty;?></td>
           	<td align="center" valign="middle" class="smallesttbltext"><?php echo $cswqty;?></td>
			<td align="center" valign="middle" class="smallesttbltext"><?php echo $tplqty?></td>
		  	<td align="center" valign="middle" class="smallesttbltext"><?php echo $gotr?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $dogr?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
  <td width="60" align="center" valign="middle" class="smallesttbltext"><?php echo $trdate1;?></td>
  <td width="50" align="center" valign="middle" class="smallesttbltext"><?php echo $diff;?></td>
			<td width="101" align="center" valign="middle" class="smallesttbltext"><?php echo $lotno1;?></td>
		   	<td align="center" valign="middle" class="smallesttbltext"><?php echo $ploc;?></td>
          	<td align="center" valign="middle" class="smallesttbltext"><?php echo $pper?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $farmer?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $pqty?></td>
		   	<td align="center" valign="middle" class="smallesttbltext"><?php echo $arrqty;?></td>
           	<td align="center" valign="middle" class="smallesttbltext"><?php echo $rswqty;?></td>
           	<td align="center" valign="middle" class="smallesttbltext"><?php echo $cswqty;?></td>
			<td align="center" valign="middle" class="smallesttbltext"><?php echo $tplqty?></td>
		  	<td align="center" valign="middle" class="smallesttbltext"><?php echo $gotr?></td>
         	<td align="center" valign="middle" class="smallesttbltext"><?php echo $dogr?></td>
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
<?php
}
if($cnt==0)
{
?>	
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#ef0388" style="border-collapse:collapse">

<tr class="Dark" height="20">
<td align="center" valign="middle" class="smalltblheading" >Record not Found</td>
</tr>
</table>
<?php
}}}}
?>	
<br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--<a href="excel-owpsr6.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtpmcode=<?php echo $_REQUEST['txtpmcode'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;</td>
</tr>
</table>