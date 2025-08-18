<?php
	ob_start();session_start();
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
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
if(isset($_REQUEST['tid']))
	{
		$itmid = $_REQUEST['tid'];
	}
	if(isset($_REQUEST['txtpp']))
	{
		$txtpp = $_REQUEST['txtpp'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction-Qc Sampling slip</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
@font-face {
    font-family: 'qr_font_tfbregular';
    src: url('../css/qrfont-webfont.woff2') format('woff2'),
         url('../css/qrfont-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}
h1 {
font-family: 'qr_font_tfbregular', Arial, sans-serif;
font-weight:normal;
font-style:normal;
}
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<?php
include ('../include/phpqrcode/qrlib.php');
$itm=explode(",",$itmid);$srno=1;
$cont=0;$cnt=0;$v1=array();
foreach($itm as $tid)
{
if($tid <> "")
{
for($i=0; $i<$txtpp; $i++)
{
$sql_arr_home=mysql_query("select * from tbl_qctest where tid='$tid'") or die(mysql_error());
$tot_arr_home = mysql_num_rows($sql_arr_home);
 if($tot_arr_home >0) { 
?>
    <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="16">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php

while($row_arr_home=mysql_fetch_array($sql_arr_home))
{
	$qc1=$row_arr_home['sampleno'];

	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $orlot=""; $totnob=0; $totqty=0; $cont=0;

	$crop=$row_arr_home['crop'];
	$variety=$row_arr_home['variety'];	
	$lotno=$row_arr_home['lotno'];
	$orlot=$row_arr_home['oldlot'];
	$stage=$row_arr_home['trstage'];

	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	
	$quer3=mysql_query("SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
	
	$quer3=mysql_query("SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$row=mysql_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysql_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	 
	 $p_array1=explode(",", $row_arr_home['trstage']); 
	 $zx=count($p_array1);
	foreach($p_array1 as $val1)
	{ 
		if($val1<>"")
		{ 
			if($val1=="Pack")
			{ 
			$cont++;
			}
		}
	}
	
$sql_tblsub1=mysql_query("select distinct lotldg_sstage from tbl_lot_ldg where orlot='".$orlot."' order by orlot") or die(mysql_error());
$t_tblsub1=mysql_num_rows($sql_tblsub1);
while($rowtbl22=mysql_fetch_array($sql_tblsub1))
{
$p_array=explode(",", $row_arr_home['trstage']); 
$zx=count($p_array);
foreach($p_array as $val)
{ 
if($val<>"")
{ 
if($val==$rowtbl22['lotldg_sstage'])
{ 
$bags=0; $qty=0; 
$sql_tbl_sub1=mysql_query("select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$orlot."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."' group by lotldg_subbinid, lotldg_variety, orlot order by lotldg_subbinid") or die(mysql_error());
$t=mysql_num_rows($sql_tbl_sub1);
while($row_tbl22=mysql_fetch_array($sql_tbl_sub1))
{
$sql_tbl1=mysql_query("select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl22['lotldg_subbinid']."' and orlot='".$orlot."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."'") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
$sql1=mysql_query("select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysql_error());
$total_tbl=mysql_num_rows($sql1);
while($row_tbl=mysql_fetch_array($sql1))
{	
$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}
$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
$bags=$bags+$ac;
$qty=$qty+$acn;
}
}
$totnob=$totnob+$bags;
$totqty=$totqty+$qty;
}
}
}
}

if($cont>0)
{
$totnob="";
}
$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);

$tp1=$row_param['code'];
$quer3=mysql_query("SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
$row31=mysql_fetch_array($quer3);
$samplenumber=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$qc1);

$path = '../qcqrimages/'; 
$file = $path.$samplenumber.".png"; 
  
// $ecc stores error correction capability('L') 
$ecc = 'L'; 
$pixel_Size = 10; 
$frame_Size = 10; 
QRcode::png($samplenumber, $file, $ecc, $pixel_Size, $frame_size);
?>
      <tr class="Light" height="16">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading"  colspan="2" >&nbsp;<?php echo $row31['cropname'];?></td>
		<td width="54" align="center"  valign="middle" class="smalltblheading"rowspan="4">&nbsp;<img src="<?php echo $file;?>" height="50px;"  /><!--<img src="https://chart.googleapis.com/chart?chs=80x80&cht=qr&chl=<?php echo $samplenumber;?>&choe=UTF-8"  />-->&nbsp;</td>
      </tr>
      <tr class="Dark" height="16">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="2"  >&nbsp;<?php echo $vv;?></td>
      </tr>
      <tr class="Light" height="16">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="2" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="16">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="2"  >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="16">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $totnob;?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $totqty;?></td>
      </tr>
      <tr class="Dark" height="16">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
<td>&nbsp;</td>
<?php
if($srno == 3)
{
echo "</tr>";
echo "<tr><td>&nbsp;</td></tr>";
$srno = 0;
}	
$srno = $srno+1;					
}
}
}
?>	

  </tr>
</table>

<br/>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="542" align="right"><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>

