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
	
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where balqty > 0 ";

	if($crop!="ALL")
	{	
	$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
<title>psw - Report - Crop Variety wise Report</title>
<table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' ") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $crop=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		}
		else
		{
		$variety=$row_rr['lotldg_variety'];
		}
				$ccnt=0;
$sql_rr24=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' order by packtype asc") or die(mysqli_error($link));
$tot_rr24=mysqli_num_rows($sql_rr24);
while($row_rr24=mysqli_fetch_array($sql_rr24))
{
		
$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr24['packtype']."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotno='".$row_arhome['lotno']."' and packtype='".$row_rr24['packtype']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$row_is['whid']."' and lotno='".$row_arhome['lotno']."' and packtype='".$row_rr24['packtype']."' order by lotdgp_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$ccnt++;
}
}
}
}
//echo $ccnt;
if($ccnt > 0)
{
// 		Table code for crop & variety wise lot numbers
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#0BC5F4" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Crop Variety wise Pack Seed Report</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#0BC5F4" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="30" align="center" valign="middle" class="tblheading">#</td>
		<td width="120"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Size</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Qty</td>
			<?php if($slchk=="yes") { ?>
			<td width="288"  align="center" valign="middle" class="tblheading">SLOC</td>
			<?php } ?>
			<!--<td width="47"  align="center" valign="middle" class="tblheading">QC status</td>
			<td width="49" align="center" valign="middle" class="tblheading">Moist %</td>
			<td width="55" align="center" valign="middle" class="tblheading">Germ %</td>
	        <td width="68"  align="center" valign="middle" class="tblheading">DoT</td>
			<td width="74"  align="center" valign="middle" class="tblheading">GOT Status</td>
			<td width="55"  align="center" valign="middle" class="tblheading">Seed Status</td>-->
	</tr>

<?php
//	echo $row_rr['lotldg_variety'];



$srno=0; $totalbags=0; $totalqty=0;
	$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' order by packtype asc") or die(mysqli_error($link));
$tot_rr2=mysqli_num_rows($sql_rr2);
while($row_rr2=mysqli_fetch_array($sql_rr2))
{
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."'  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc="";$txtdot=""; 
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotno='".$row_arr_home['lotno']."' and packtype='".$row_rr2['packtype']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 


$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and packtype='".$row_rr2['packtype']."' order by lotdgp_id asc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_issuetbl['lotdgp_id']."<BR>";
  $cnt++;
	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	
	$upspacktype=$row_issuetbl['packtype'];
	$upspacktype=trim($upspacktype);
	$packtp=explode(" ",$upspacktype);
	$packt=trim($packtp[0]);
	$packtyp=explode(".",$packt); 
				
	if($packtyp[1]=="000")
	$upssize=$packtyp[0]." ".$packtp[1];
	
	if($row_issuetbl['lotldg_srflg'] > 0)
	{
		if($totsst!="")$totsst=$totsst."/"."S";
		else
		$totsst="S";
	}
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";
	if($totgemp==0 || $totgemp=="") $totgemp="";
	


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_issuetbl['lotldg_balbags'];
 $slqty=$row_issuetbl['balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slqty."<br/>";
}
}
}
//echo $cnt;
if($cnt>0)
{
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($totqc=="RT"){$txtdot=""; $totgemp="";}
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="tbltext"><?php echo $row_arr_home['lotno']?></td>
         	<td align="center" valign="middle" class="tbltext"><?php echo $upssize?></td>
		   	<td align="center" valign="middle" class="tbltext"><?php echo $totqty;?></td>
			<?php if($slchk=="yes") { ?>
			<td align="center" valign="middle" class="tbltext"><?php echo $sloc?></td>
			<?php } ?>
           <!--	<td align="center" valign="middle" class="tbltext"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="tbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="tbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="tbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="tbltext"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="tbltext"><?php echo $totsst;?></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="tbltext"><?php echo $row_arr_home['lotno']?></td>
         	<td align="center" valign="middle" class="tbltext"><?php echo $upssize?></td>
		   	<td align="center" valign="middle" class="tbltext"><?php echo $totqty;?></td>
			<?php if($slchk=="yes") { ?>
			<td align="center" valign="middle" class="tbltext"><?php echo $sloc?></td>
			<?php } ?>
           <!--	<td align="center" valign="middle" class="tbltext"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="tbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="tbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="tbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="tbltext"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="tbltext"><?php echo $totsst;?></td>-->
</tr>
<?php
}
//$srno=$srno++;
}
else{$srno--;}
}
}
}
}
if($ccnt > 0)
{
?>
<tr class="Dark">
			<td align="center" valign="middle" class="tblheading" colspan="3">Total</td>
         	<!--<td align="center" valign="middle" class="tblheading"><?php echo $totalbags?></td>-->
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
			<?php if($slchk=="yes") { ?>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<?php } ?>
</tr>
<?php
}
?>
</table>			
<br />
<?php

}
}
?>
  <br/>
<table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>