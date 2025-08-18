<?php
	ob_start();
	session_start();
	require_once("../include/config.php");
	require_once("../include/connection.php");

if (isset($_REQUEST['scode'])) {

	$scode = $_REQUEST['scode'];
	$session_id = $_REQUEST['sessionid'];
	$device_id = $_REQUEST['deviceid'];
	$trid = $_REQUEST['trid'];
	$heading = $_REQUEST['heading'];
	 
	$html ='<style type="text/css" media="print">
body { font-family:Arial; background-color:#FFFFFF; background-image:none; color:#000000;} 
img.butn { display:none; visibility:hidden; }
#header{display:none; color:#FFFFFF}
.page-break { page-break-before:always; }
@page {size:landscape;}
</style><link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />';
//echo "select * from tblarrival_unld where arrival_id='".$trid."'";	
$sql_tbl=mysql_query("select * from tblarrival_unld where arrival_id='".$trid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];
$truckno=$row_tbl['trans_vehno'];
//echo "select COUNT(*) from tblarrsub_sub_unld where arrival_id='".$arrival_id."' ";
$sql_class12=mysql_query("select COUNT(*) from tblarrsub_sub_unld where arrival_id='".$arrival_id."' ") or die(mysql_error());
$row_class12=mysql_fetch_array($sql_class12);

$sql_class13=mysql_query("select sum( qty ) from tblarrival_sub_unld where arrival_id='".$arrival_id."' ") or die(mysql_error());
$row_class13=mysql_fetch_array($sql_class13);

$tdate=$row_tbl['arrival_date'];
$tyear=substr($tdate,0,4);
$tmonth=substr($tdate,5,2);
$tday=substr($tdate,8,2);
$tdate=$tday."-".$tmonth."-".$tyear;
$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);

$address=$row_param['address'].", ".$row_param['ccity']." - ".$row_param['cpin'].", ".$row_param['cstate'].", Ph: 0".$row_param['cstd']." - ".$row_param['cphone'];

if($row_param['cphone1'] != ""){ $address.", ".$row_param['cphone1'];}

$address1=$row_param['plant']." - ".$row_param['ppin'].", ".$row_param['pstate'].", Ph: 0".$row_param['cstd']." - ".$row_param['pphone'];

if($row_param['pphone1'] != ""){ $address1.", ".$row_param['pphone1'];}

$logo="<img src='../help/vnrlogo1.jpg' width='57' align='middle' />";

$html=$html.'<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" style="border-collapse:collapse" > 
<tr ><td align="center" valign="middle" width="50" class="Mainheading" rowspan="2" >';$html=$html.$logo;$html=$html.'</td><td align="center" class="Mainheading" style="font-size:10pt; color:#000000"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><b>';$html=$html.$row_param['company_name'];$html=$html.'</b></font></td>
</tr></table><table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" >
<tr ><td align="center" class="smalltblheading">';$html=$html.$address;$html=$html.'</td></tr>
<tr ><td align="center" class="smalltblheading">';$html=$html.$address1;$html=$html.'</td></tr>
</table><hr style="border-bottom:thick; width:1000" />
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" ><tr class="Light">
<td align="center" class="Mainheading" ><font color="#000000" style="font-size:14pt;" colspan="2"><b>Raw Seed Unloading Sheet - ';$html=$html.$heading;$html=$html.'</b></font></td>
</tr>
</table><br />

<table align="center" border="1" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" > 
 <tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">Date of Arrival&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >';$html=$html.$tdate;$html=$html.'</td>
 <td width="121" align="right" valign="middle" class="tblheading">RSUS No.&nbsp;</td>
<td width="219" align="left" valign="middle" class="tbltext">';$html=$html.$row_tbl['arrival_code'];$html=$html.'</td>
</tr>
<tr class="Light" height="20">
<td width="187" align="right" valign="middle" class="tblheading">Truck No.&nbsp;</td>
<td width="263"  align="left" valign="middle" class="tbltext">';$html=$html.$truckno;$html=$html.'</td>

<td width="121" align="right" valign="middle" class="tblheading">Dispatch Location&nbsp;</td>
<td width="219" align="left" valign="middle" class="tbltext">';$html=$html.$row_tbl['disploc'];$html=$html.'</td>
</tr>';

$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
$row3=mysql_fetch_array($quer3);

$html=$html.'<tr class="Light" height="20">
<td align="right" width="187" valign="middle" class="tblheading">Pass in No.&nbsp;</td>
<td align="left" width="263" valign="middle" class="tbltext" >';$html=$html.$row_tbl['passinno'];$html=$html.'</td>
 <td width="121" align="right" valign="middle" class="tblheading">Total Bags&nbsp;</td>
<td width="219" align="left" valign="middle" class="tbltext">';$html=$html.$row_class12[0];$html=$html.'</td>
</tr>
</table><br />';
$totaldcbag=0; $totactbag=0; $totdiffbag=0; $totalgrqty=0; $totalnetqty=0; $totaltareqty=0; $totaldcqty=0; $totaldiffqty=0;
$sql_tbl_sub=mysql_query("select * from tblarrival_sub_unld where arrival_id='".$arrival_id."'") or die(mysql_error());

$html=$html.'<table align="center" border="1" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" > 
<tr height="20">
<td align="center" valign="middle" class="smalltblheading" width="1%" rowspan="2">#</td>
<td align="center" valign="middle" class="smalltblheading" width="9%" rowspan="2">Crop</td>
<td align="center" valign="middle" class="smalltblheading" width="8%" colspan="2">SP Code</td>
 <td align="center" valign="middle" class="smalltblheading" width="7%" rowspan="2">Lot No</td>
 <td align="center" valign="middle" class="smalltblheading" width="3%" colspan="3">No. of Bags</td>
 <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Moist</td>
 <td align="center" valign="middle" class="smalltblheading" colspan="10" width="47%" rowspan="2">
 <table border="1" align="center" cellspacing="0" cellpadding="0" style="border-collapse:collapse" width="100%" height="100%">
	<tr height="100%" style="width:100%">
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.1</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.2</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.3</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.4</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.5</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.6</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.7</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.8</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.9</td>
 <td align="center" valign="middle" class="smalltblheading" width="4.7%">Bag Qty.10</td>
 </tr></table></td>
 <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Total Qty.</td>
 <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Tare Qty.</td>
 <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Net Qty.</td>
 <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">DC Qty.</td>
 <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Diff. Qty.</td>
 <td align="center" valign="middle" class="smalltblheading" width="5%" rowspan="2">Remarks</td>
</tr>
<tr height="20">
 <td align="center" valign="middle" class="smalltblheading" width="4%" >F</td>
 <td align="center" valign="middle" class="smalltblheading" width="4%" >M</td>
 <td align="center" valign="middle" class="smalltblheading" width="1%" >DC</td>
 <td align="center" valign="middle" class="smalltblheading" width="1%" >Act.</td>
 <td align="center" valign="middle" class="smalltblheading" width="1%" >Diff.</td>
</tr>';

$srno=1; $srn=0;
$total_tbl=mysql_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{ 
$sql_class=mysql_query("select grosswt from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' ") or die(mysql_error());
$tot_ss=mysql_num_rows($sql_class);
$cnt=1;

$tot_ss1=ceil($tot_ss/10);
$sql_class1=mysql_query("select sum( grosswt ) , sum( tarewt ) , sum( netwt ) from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' ") or die(mysql_error());
$row_class1=mysql_fetch_array($sql_class1);
$lotno=explode("/",$row_tbl_sub['lotno']);

if($row_tbl_sub['moisture']=="Acceptable")
	$moist="AC";
if($row_tbl_sub['moisture']=="Not-Acceptable")
	$moist="NAC";
	
$totalqty=$row_class1[0];
$tareqty=$row_class1[1];
$netqty=$row_class1[2];
$dcqty=$row_tbl_sub['qty'];
$diffqty=$netqty-$row_tbl_sub['qty'];

$dcbag=$row_tbl_sub['act1'];
$bagdiff=$tot_ss-$dcbag;
$crop=$row_tbl_sub['lotcrop'];
$spcodef=$row_tbl_sub['spcodef'];
$spcodem=$row_tbl_sub['spcodem'];
//echo $tot_ss." -- ";
if($tot_ss>0){
$html=$html.'<tr class="Dark" height="20">
<tr class="Light" height="20">
	 <td align="center" valign="middle" class="smalltbltext" width="1%">';$html=$html.$srno;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="9%">';$html=$html.$crop;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="4%">';$html=$html.$spcodef;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="4%">';$html=$html.$spcodem;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="7%">';$html=$html.$lotno[0];$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="3%">';$html=$html.$dcbag;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="3%">';$html=$html.$tot_ss;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="3%">';$html=$html.$bagdiff;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$moist;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" colspan="10" width="47%">
	 <table border="1" align="center" cellspacing="0" cellpadding="0" style="border-collapse:collapse" width="100%" height="100%">';

	 while($cnt<=$tot_ss1)
	 {
	 $html=$html.'<tr height="100%" style="width:100%">';
	
	 if($cnt==1)
	 $start=0;
	 else
	 $start=(($cnt-1)*10);
	 
	 $end=10;
	 
	 //echo "select grosswt from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' LIMIT $start,$end <br />";
	 $bagarray = array();
	 $sql_class2=mysql_query("select arrsubsub_id,grosswt from tblarrsub_sub_unld where arrival_id='".$arrival_id."' and arrsub_id='".$row_tbl_sub['arrsub_id']."' LIMIT $start,$end") or die(mysql_error());
	$tot_ss2=mysql_num_rows($sql_class2);
	
	$forcnt=10-$tot_ss2;
	while($row_class2=mysql_fetch_array($sql_class2))
	{
	$html=$html.'<td align="center" valign="middle" class="smalltbltext" width="4.7%">';$html=$html.$row_class2['grosswt'];$html=$html.'</td>';
	
	}
	for($i=0;$i<$forcnt;$i++)
	 {
	 $html=$html.'<td align="center" valign="middle" class="smalltbltext" width="4.7%">&nbsp;</td>';
	 
	 }
	  $html=$html.'</tr>';
	 
	 $cnt++;}

$html=$html.'</table></td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$totalqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$tareqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$netqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$dcqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$diffqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$remarks;$html=$html.'</td>
</tr>';


}
else
{

$html=$html.'<tr class="Light" height="20">
	 <td align="center" valign="middle" class="smalltbltext" width="1%">';$html=$html.$srno;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="9%">';$html=$html.$crop;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="4%">';$html=$html.$spcodef;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="4%">';$html=$html.$spcodem;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="7%">';$html=$html.$lotno[0];$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="1%">';$html=$html.$dcbag;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="1%">';$html=$html.$tot_ss;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="1%">';$html=$html.$bagdiff;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$moist;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" colspan="10" width="47%"></td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$totalqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$tareqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$netqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$dcqty;$html=$html.'</td>
	 <td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$diffqty;$html=$html.'</td>
	<td align="center" valign="middle" class="smalltbltext" width="5%">';$html=$html.$remarks;$html=$html.'</td>
</tr> ';

}

$totaldcbag=$totaldcbag+$dcbag; 
$totactbag=$totactbag+$tot_ss; 
$totdiffbag=$totdiffbag+$bagdiff;
$totalgrqty=$totalgrqty+$totalqty; 
$totalnetqty=$totalnetqty+$netqty; 
$totaltareqty=$totaltareqty+$tareqty;
$totaldcqty=$totaldcqty+$dcqty;
$totaldiffqty=$totaldiffqty+$diffqty;
$srno++;
}
}


$html=$html.'<tr class="Light" height="20">
	 <td align="right" valign="middle" class="tblheading" width="5%" colspan="5">Total&nbsp;</td>
	 <td align="center" valign="middle" class="tbltext" width="1%">';$html=$html.$totaldcbag;$html=$html.'</td>
	 <td align="center" valign="middle" class="tbltext" width="1%">';$html=$html.$totactbag;$html=$html.'</td>
	 <td align="center" valign="middle" class="tbltext" width="1%">';$html=$html.$totdiffbag;$html=$html.'</td>
	 <td align="center" valign="middle" class="tbltext" colspan="11"></td>
	<td align="center" valign="middle" class="tbltext" width="5%">';$html=$html.$totalgrqty;$html=$html.'</td>
	<td align="center" valign="middle" class="tbltext" width="5%">';$html=$html.$totaltareqty;$html=$html.'</td>
	<td align="center" valign="middle" class="tbltext" width="5%">';$html=$html.$totalnetqty;$html=$html.'</td>
	<td align="center" valign="middle" class="tbltext" width="5%">';$html=$html.$totaldcqty;$html=$html.'</td>
	<td align="center" valign="middle" class="tbltext" width="5%">';$html=$html.$totaldiffqty;$html=$html.'</td>
	<td align="center" valign="middle" class="tbltext" width="5%">';$html=$html.$remarks;$html=$html.'</td>
</tr></table><br />';
$html=$html.'<table align="center" border="1" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="127" align="right"  valign="middle" class="smalltblheading">&nbsp;Full Truck Load Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;';$html=$html.$row_class13[0];$html=$html.'&nbsp;Kg.</td>
</tr>
<tr class="Light" height="20">
<td width="127" align="right"  valign="middle" class="smalltblheading">&nbsp;Received Net Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;';$html=$html.$totalnetqty;$html=$html.'&nbsp;Kg.</td>
</tr>
<tr class="Light" height="20">
<td width="127" align="right"  valign="middle" class="smalltblheading">&nbsp;Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;';$html=$html.number_format(($totalnetqty-$row_class13[0]), 2, '.', ',');$html=$html.'&nbsp;Kg.&nbsp;(Excess/Shortage)</td>
</tr>
</table><br />';
$html=$html.'<table align="center" border="1" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" >
<tr class="Light" height="40">
<td width="127" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">';$html=$html.$row_tbl['remarks'];$html=$html.'</td>
</tr></table><br /><br /><br /><br /><table align="center" border="0" width="800" cellspacing="0" cellpadding="0" style="border-collapse:collapse" ><tr class="Light" >
<td width="150" align="left" valign="middle" class="smalltblheading">&nbsp;Unloading Person&nbsp;</td>
<td width="150" align="right" valign="middle" class="smalltblheading">Checked By&nbsp;</td>
</tr></table>';
//echo $html;
//exit;
include("../mpdf/mpdf.php");
$mpdf=new mPDF('c'); 
//$mpdf=new mPDF('en-GB-x','A4','','',5,5,5,5,0,0); 

//$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)
$mpdf->SetDisplayMode('fullpage');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO} of {nbpg} pages||{PAGENO} of {nbpg} pages');

// LOAD a stylesheet
//$stylesheet = file_get_contents('mpdfstylePaged.css');
//$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);
$flname="RawSeedsUnloadingSheet_AR".$row_tbl['arrival_code'].".pdf";
$pathtosave=$_SERVER['DOCUMENT_ROOT']."/wms-test2/pdffiles/";
//$mpdf->Output($flname,'D');
//$location = __DIR__ .'/assets/pdf/';
$mpdf->Output($pathtosave.$flname, 'F');//\Mpdf\Output\Destination::FILE');

$response["error"] = false;
$response["filename"] = $flname;
$response["filepath"] = $pathtosave;
$response["msg"] = "File Saved Successfully";
echo json_encode($response);
exit;
}
else 
{
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters is missing";
    echo json_encode($response);
}
?>
