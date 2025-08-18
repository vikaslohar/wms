<?php
	//ob_start();
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

	if(isset($_REQUEST['itmid']))
	{
	 $itmid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['subid']))
	{
	$subid = $_REQUEST['subid'];
	}
	if(isset($_REQUEST['tp']))
	{
	$tp = $_REQUEST['tp'];
	
	}
	if(isset($_REQUEST['lid']))
	{
	$lid = $_REQUEST['lid'];
	}
$html ='	
<style type="text/css" media="print">
body { font-family:Arial; background-color:#FFFFFF; background-image:none; color:#000000;} 
img.butn { display:none; visibility:hidden; }
#header{display:none; color:#FFFFFF}
.page-break { page-break-before:always; }
</style>';
$tid=$itmid; $cnt=0;
$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arrival_id=$tid") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];
	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$lrole=$row_tbl['arr_role'];
	$yearcode=$row_tbl['yearcode'];
	
	$tranid="AF".$row_tbl['arr_code']."-".$yearcode."-".$lrole."_".$tdate;
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	$sql_tbl_sub11=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id=$arrival_id") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub11);
	while($row_tbl_sub11=mysqli_fetch_array($sql_tbl_sub11))
	{ 
	if($cnt==4)
	{
	$cnt=0;
	$html=$html.'<pagebreak />';
	}
	$subid=$row_tbl_sub11[arrsub_id]; 
	$compname=$row_param['company_name'];
	$officeadd=$row_param['address'].", ".$row_param['ccity']."- ".$row_param['cpin'].", ".$row_param['cstate'].", Ph: 0 ".$row_param['cstd']."- ".$row_param['cphone']; 
	if($row_param['cphone1'] != "" && $row_param['cphone1'] != 0){  $officeadd=$officeadd.", ".$row_param['cphone1'];}
	$plantadd=$row_param['plant'].", ".$row_param['pcity']."- ".$row_param['ppin'].", ".$row_param['pstate'].", Ph: 0 ".$row_param['pstd']."- ".$row_param['pphone']; 
	if($row_param['pphone1'] != "" && $row_param['pphone1'] != 0){  $plantadd=$plantadd.", ".$row_param['pphone1'];}
	$logo=$row_param['logo'];
	//$logo="'$logo1'";
$html=$html.'	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="';$html=$html.$logo; $html=$html.'"  width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr class="Light">
<td align="left" valign="middle" class="tblheading" style="font-size:18pt;">&nbsp;<font size="font-size:25pt" face="Verdana, Arial, Helvetica, sans-serif">';$html=$html.$compname; $html=$html.'</font></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2" style="font-size:8pt;">&nbsp;Office:&nbsp;';$html=$html.$officeadd; $html=$html.'</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2" style="font-size:8pt; border-bottom:thick">&nbsp;Plant:&nbsp;';$html=$html.$plantadd; $html=$html.'</td>
</tr>
</table>
</td>
</tr>
</table><hr style="border-bottom:thick;" />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >';

$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrsub_id=$subid") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$ln1=explode("/",$row_tbl_sub[lotno]);
$a=implode($ln1);
$ln2=substr($a, 1,6);
$lcrop=$row_tbl_sub[lotcrop];
$farmer=$row_tbl_sub['farmer'];
$organiser=$row_tbl_sub['organiser'];
$plotno=$row_tbl_sub['plotno'];
$prodloc=$row_tbl_sub['ploc'];
$prodper=$row_tbl_sub['pper'];

$html=$html.'
<tr >
  <td colspan="6" align="center" class="Mainheading"><font color="#000000" style="font-size:9pt;"><b>Post Harvest Seed Receipt Note (PHSRN)</b></font></td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
 <tr class="Dark" height="20">
<td width="65" align="right" valign="middle" class="tblheading" style="font-size:9pt;">&nbsp;Date&nbsp;</td>
<td width="206"  align="left" valign="middle" class="smalltbltext" style="font-size:9pt;">&nbsp;';$html=$html.$tdate;$html=$html.'</td>

<td width="72" align="right" valign="middle" class="tblheading" style="font-size:9pt;">Lot No.&nbsp;</td>
<td width="206" align="left" valign="middle" class="smalltbltext" style="font-size:9pt;">&nbsp;';$html=$html.$ln2;$html=$html.'</td>

<td width="74" align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Crop&nbsp;</td>
<td width="153" align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;"  >&nbsp;';$html=$html.$lcrop;$html=$html.'</td>
</tr>
<tr class="Light" height="20">
	<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Organiser&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;">&nbsp;';$html=$html.$organiser;$html=$html.'</td>
<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Farmer&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;" >&nbsp;';$html=$html.$farmer;$html=$html.'</td>
<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Plot No.&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;">&nbsp;';$html=$html.$plotno;$html=$html.'</td>
</tr>
<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Prod. Loc.&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;"  >&nbsp;';$html=$html.$prodloc;$html=$html.'</td>
<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Prod. Per.&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;">&nbsp;';$html=$html.$prodper;$html=$html.'</td>';

$dq=explode(".",$row_tbl_sub['act']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['act'];}
$nob=$row_tbl_sub['act1'];
$nobqty=$nob." / ".$dcq;
$moist=$row_tbl_sub['moisture'];
$vchk=$row_tbl_sub['vchk'];

$html=$html.'
<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Act. NoB/Qty&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;">&nbsp;';$html=$html.$nobqty;$html=$html.' &nbsp;Kgs.</td>
</tr>
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="6" style="font-size:10pt;">Preliminary Quality Status</td>
</tr>
<tr class="Dark" height="20">
<td width="72" align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Moisture %&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;"  >&nbsp;';$html=$html.$moist;$html=$html.'</td>
<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Phys. Purity&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" style="font-size:9pt;">&nbsp;';$html=$html.$vchk;$html=$html.'</td>
<td width="82" align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Remarks&nbsp;</td>
<td width="1" align="left"  valign="middle" class="tbltext" style="font-size:9pt;">&nbsp;</td>
</tr>';
if($row_tbl_sub[vchk]=="Not-Acceptable")
{
$remarks=$row_tbl_sub['remarks'];
$html=$html.'
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading" style="font-size:9pt;">Reason&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="6" style="font-size:9pt;">&nbsp;';$html=$html.$remarks;$html=$html.'</td>
</tr>';

}
$html=$html.'
</table>

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="right" class="tblheading" colspan="6"><div  align="right" class="smalltbltext" style="padding:2px 5px 5px 5px; font-size:7pt;">Computer generated Note, need not be signed</div></td>
</tr>
</table>

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="center" class="tblheading" colspan="6"><div  align="center" class="smalltbltext" style="padding:2px 5px 5px 5px; font-size:7pt;">-------------------------------- cut here --------------------------------</div></td>
</tr>
</table><br/>';
$cnt++;
}

include("../mpdf/mpdf.php");
$mpdf=new mPDF('c'); 
//$mpdf=new mPDF('en-GB-x','A4','','',5,5,5,5,0,0); 

//$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)

$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet
//$stylesheet = file_get_contents('mpdfstylePaged.css');
//$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);
$flname="PHSRN_".$tranid.".pdf";
//$pathtosave=$_SERVER['DOCUMENT_ROOT']."/wms/Uploadfiles";
$mpdf->Output($flname);
exit;
?>