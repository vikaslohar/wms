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
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct salesrs_crop, salesrs_variety from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail')";

	if($crop!="ALL")
	{	
	$qry.=" and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by salesrs_crop, salesrs_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
<title>Sales Return - Report - Crop Variety wise Substandard Pack Seed Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-sscropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_rr=mysqli_query($link,"select distinct salesrs_variety from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$row_arr_home1['salesrs_variety']."' and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') order by salesrs_id desc") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['salesrs_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $crop=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['salesrs_variety']."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		}
		else
		{
		$variety=$row_rr['salesrs_variety'];
		}
		$ccnt=0;
$sql_arhome=mysqli_query($link,"select distinct salesrs_newlot from tbl_salesrv_sub where plantcode='$plantcode' AND  salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$row_rr['salesrs_variety']."'  and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') group by salesrs_newlot order by salesrs_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
/*	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_salesrv_sub where  salesrs_newlot='".$row_arhome['salesrs_newlot']."'  and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') group by subbinid order by salesrs_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(salesrs_id) from tbl_salesrv_sub where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$row_is['whid']."' and salesrs_newlot='".$row_arhome['salesrs_newlot']."' and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') order by salesrs_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 
*/
$sql_istbl=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_newlot='".$row_arhome['salesrs_newlot']."' and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') order by salesrs_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$rows=mysqli_fetch_array($sql_istbl);
$ccnt++;
}
}
//}
//echo $ccnt;
if($ccnt > 0)
{
// 		Table code for crop & variety wise lot numbers
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#a8a09e" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Sales Return - Crop Variety wise Substandard Pack Seed Report</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#a8a09e" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="22" align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
			<td width="43"  align="center" valign="middle" class="smalltblheading">NoP</td>
			<td width="55"  align="center" valign="middle" class="smalltblheading">Qty</td>
			<td width="156"  align="center" valign="middle" class="smalltblheading">SLOC</td>
			<td width="47"  align="center" valign="middle" class="smalltblheading">QC status</td>
			<!--<td width="49" align="center" valign="middle" class="smalltblheading">Moist %</td>
			<td width="55" align="center" valign="middle" class="smalltblheading">Germ %</td>-->
	        <td width="68"  align="center" valign="middle" class="smalltblheading">DoT</td>
			<td width="74"  align="center" valign="middle" class="smalltblheading">GOT Status</td>
			<!--<td width="74"  align="center" valign="middle" class="smalltblheading">Genetic Purity %</td>-->
			<td width="74"  align="center" valign="middle" class="smalltblheading">DOGR</td>
			<!--<td width="55"  align="center" valign="middle" class="smalltblheading">Seed Status</td>-->
	</tr>

<?php
//	echo $row_rr['lotldg_variety'];


$srno=0; $totalbags=0; $totalqty=0;
	$sql_arr_home=mysqli_query($link,"select distinct salesrs_newlot, salesrs_orlot from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$row_rr['salesrs_variety']."'  and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') group by salesrs_newlot order by salesrs_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $txtdot=""; $dogr="";
/*	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_salesrv_sub where  salesrs_newlot='".$row_arr_home['salesrs_newlot']."'  and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') group by subbinid order by salesrs_id asc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(salesrs_id) from tbl_salesrv_sub where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and salesrs_newlot='".$row_arr_home['salesrs_newlot']."' and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') order by salesrs_id asc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); */

$sql_issuetbl=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_newlot='".$row_arr_home['salesrs_newlot']."' and salesrs_rettype='P2P' and (salesrs_qc='Fail' OR salesrs_got1='Fail') order by salesrs_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_issuetbl['salesrs_id']."<BR>";
  $cnt++;
	$totqty=$totqty+$row_issuetbl['salesrs_qtydc']; 
	$totnob=$totnob+$row_issuetbl['salesrs_nobdc']; 

	$totqc=$row_issuetbl['salesrs_qc']; 
	$tgot=explode(" ", $row_issuetbl['salesrs_got']); 
	$totgot=$tgot[0]." ".$row_issuetbl['salesrs_got1'];
	$totmost=''; 
	$totgemp=''; 
	$genpp=''; 
	$totsst=''; 
	/*if($row_issuetbl['lotldg_srflg'] > 0)
	{
		if($totsst!="")$totsst=$totsst."/"."S";
		else
		$totsst="S";
	}*/
	if($txtdot=="")
	{
	$rdate=explode("-",$row_issuetbl['salesrs_dot']);
	$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
	}
	
	if($dogr=="")
	{
	$rdate=explode("-",$row_issuetbl['salesrs_dogt']);
	$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
	}
	
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";
	
	if($dogr=="00-00-0000" || $dogr=="--")
	$dogr="";
	if($totgemp==0 || $totgemp=="") $totgemp="";
	
	if($genpp=="0.00" || $genpp=="NULL")$genpp="";

$sql_issuetbl23=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_issuetbl['salesrs_id']."' order by salesrss_id asc") or die(mysqli_error($link)); 
$t23=mysqli_num_rows($sql_issuetbl23);
if($t23 > 0)
{
while($row_issuetbl23=mysqli_fetch_array($sql_issuetbl23))
{ 

$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_issuetbl23['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_issuetbl23['salesrss_bin']."' and whid='".$row_issuetbl23['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row_issuetbl23['salesrss_subbin']."' and binid='".$row_issuetbl23['salesrss_bin']."' and whid='".$row_issuetbl23['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
}
}


//$slups=$row_issuetbl['lotldg_balbags'];
 $slqty=$row_issuetbl['salesrs_qtydc'];
// $aq1=explode(".",$slups);
//if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
//$slups=$ac1;
$slqty=$acn1;

if($binn!="")
{
	if($sloc!="")
	$sloc=$sloc.$wareh.$binn." | ".$slqty."<br/>";
	else
	$sloc=$wareh.$binn." | ".$slqty."<br/>";
}
}
}
//}

$olotno=$row_arr_home['salesrs_orlot'];
$dqty=0;
$sql_issuetbl99=mysqli_query($link,"select * from tbl_discard_sub where plantcode='$plantcode' AND lotnumber='".$olotno."'") or die(mysqli_error($link)); 
while($row_issuetbl99=mysqli_fetch_array($sql_issuetbl99))
{
	$dqty=$dqty+$row_issuetbl99['qty'];
}
if($totqty==$dqty)$cnt=0;

$blqty=0;
$sql_issue99=mysqli_query($link,"select distinct (lotldg_subbinid)  from tbl_lot_ldg where plantcode='$plantcode' AND orlot='$olotno'") or die(mysqli_error($link));
while ($row_issue99=mysqli_fetch_array($sql_issue99))
{
	$sql_issue199=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue99['lotldg_subbinid']."' and orlot='$olotno'") or die(mysqli_error($link));
	$row_issue199=mysqli_fetch_array($sql_issue199); 
	if($t99=mysqli_num_rows($sql_issue199)>0)
	{
		//echo $row_issue1[0];echo "<BR>";
		//echo $t=mysqli_num_rows($sql_issue1); echo "<BR>";
		$sql_issuetbl99=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue199[0]."' and lotldg_balqty>0") or die(mysqli_error($link)); 
		while($row_issuetbl99=mysqli_fetch_array($sql_issuetbl99))
		{
			$blqty=$blqty+$row_issuetbl99['lotldg_balqty'];
		}
	}
}	

if($blqty>0)$cnt=0;
//echo $cnt;
if($cnt>0)
{
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";

if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['salesrs_newlot']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           <!--	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>-->
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>-->
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['salesrs_newlot']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>-->
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>-->
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>-->
</tr>
<?php
}
}
else{$srno--;}
}
?>
<tr class="Dark">
			<td align="center" valign="middle" class="smalltblheading" colspan="2">Total</td>
         	<td align="center" valign="middle" class="smalltblheading"><?php echo $totalbags?></td>
		   	<td align="center" valign="middle" class="smalltblheading"><?php echo $totalqty;?></td>
			<td align="center" valign="middle" class="smalltblheading" colspan="5">&nbsp;</td>
</tr>
</table>			
<br />
<?php
}
}
}
}
?>
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-sscropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>