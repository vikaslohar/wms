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
	
if(isset($_REQUEST['tid']))
	{
		$itmid = $_REQUEST['tid'];
	}
		$txtpp = 1;
		
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
<title>GOT Record Sheet</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial; margin:0;}
img.butn { display:none; visibility:hidden; }
.tblpdark{background-color:#CECECE;}
.tblplight{font-size:11px;
		font-weight:lighter; color: #ffffff;
background: #ffffff;
text-shadow: 1px 1px 4px#ccc;}

</style>
<table align="center" border="0" width="700" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php

$sql_arr=mysqli_query($link,"select * from tbl_gotqc where arrival_id='$itmid'") or die(mysqli_error($link));
$tot_arr= mysqli_fetch_array($sql_arr);

$itm=explode(",",$tot_arr['lotno']);$srno=1;
$cont=0;$cnt=0;$v1=array();
foreach($itm as $tid)
{
if($tid <> "")
{
for($i=0; $i<$txtpp; $i++)
{
$sql_arr_home=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) { 
?>
	<tr>
    <td>
	<table  align="center" border="0" width="700" cellspacing="0" cellpadding="0" bordercolor="#000000" style="border-collapse:collapse" >
      <tr class="Light" height="29">
        <td colspan="17"  align="center" class="tblheading"><font style="font-size:16px">GOT Record Sheet</font></td>
      </tr>
	  </table>
	  <table  align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#000000" style="border-collapse:collapse" >
      <?php

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['gottest_srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['gottest_tid'];
	$qc1=$row_arr_home['gottest_sampleno'];
	$qc1sts=$row_arr_home['gottest_stsno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['gottest_crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['gottest_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['gottest_variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['gottest_variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['gottest_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['gottest_lotno'];
		}
	}
	$trdate=$row_arr_home['gottest_srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['gottest_variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
		$d=date("Y-m-d");
	$trdatett=$d;
	$tryeartt=substr($trdatett,0,4);
	$trmonthtt=substr($trdatett,5,2);
	$trdaytt=substr($trdatett,8,2);

	
	$code1="GSD"."/".$row_arr_home['yearid']."/".$tot_arr['gsdn'];
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$tp1sts=13;
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      
	  
      <tr class="tblpdark" height="27">
        <td align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row31['cropname'];?></td>
        <td align="right"  valign="middle" class="smalltblheading">Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $vv?></td>
      </tr>
	  
	  <tr class="tblpdark" height="27">
        <td width="110" align="right"  valign="middle" class="smalltblheading">GRS No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $tp1sts?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
        <td width="110" align="right"  valign="middle" class="smalltblheading">Date of Sampling&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $trdaytt;?>-<?php echo $trmonthtt;?>-<?php echo $tryeartt;?></td>
      </tr>
	  
      <tr class="tblpdark" height="27">
	   <td  align="right"  valign="middle" class="smalltblheading">GSDN No&nbsp;</td>
        <td width="235"  align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $code1?></td>
        <td width="110" align="right"  valign="middle" class="smalltblheading">Sample No.&nbsp;</td>
        <td width="235" align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
      </tr>
	  
      <tr class="Dark" height="27">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $lotno?></td>
		<td align="right" class="smalltblheading">Qty&nbsp;</td>
		<td align="left" class="smalltblheading">&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
		</tr>
		
		<tr class="Light" height="27">
        <td align="right" class="smalltblheading">Date of Sowing&nbsp;</td>
		<td align="left" class="smalltbltext"><table border="1" height="100%" bordercolor="#000000" width="100%" cellpadding="0" cellspacing="0">
		<tr> <td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-left:none; border-top:none;">DD</td><td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-top:none;" >MM</td><td align="center" valign="middle" class="tblplight" width="34%" style="border-bottom:none; border-top:none; border-right:none;">YY</td></tr></table></td>
		<td align="right" class="smalltblheading">Date of Transplant&nbsp;</td>
		<td align="left" class="smalltbltext"><table border="1" height="100%" bordercolor="#000000" width="100%" cellpadding="0" cellspacing="0">
		<tr> <td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-left:none; border-top:none;">DD</td><td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-top:none;" >MM</td><td align="center" valign="middle" class="tblplight" width="34%" style="border-bottom:none; border-top:none; border-right:none;">YY</td></tr></table></td>
		</tr>
		
    <tr class="Light" height="27">
        <td align="right" class="smalltblheading">Test Location&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		<td align="right" class="smalltblheading">Plot No.&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		</tr>
		
	<tr class="Light" height="27">
        <td align="center" class="smalltblheading" colspan="2">Observation 1&nbsp;</td>
		<td align="center" class="smalltblheading" colspan="2">Observation 2&nbsp;</td>
		</tr>
		
		<tr class="Light" height="27">
        <td align="right" class="smalltblheading">Date&nbsp;</td>
		<td align="left" class="smalltbltext"><table border="1" height="100%" bordercolor="#000000" width="100%" cellpadding="0" cellspacing="0">
		<tr> <td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-left:none; border-top:none;">DD</td><td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-top:none;" >MM</td><td align="center" valign="middle" class="tblplight" width="34%" style="border-bottom:none; border-top:none; border-right:none;">YY</td></tr></table></td>
		<td align="right" class="smalltblheading">Date&nbsp;</td>
		<td align="left" class="smalltbltext"><table border="1" height="100%" bordercolor="#000000" width="100%" cellpadding="0" cellspacing="0">
		<tr> <td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-left:none; border-top:none;">DD</td><td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-top:none;" >MM</td><td align="center" valign="middle" class="tblplight" width="34%" style="border-bottom:none; border-top:none; border-right:none;">YY</td></tr></table></td>
		</tr>
		
		<tr class="Light" height="27">
        <td align="right" class="smalltblheading">No. of Off Types&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		<td align="right" class="smalltblheading">No. of Off Types&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		</tr>
		
		<tr class="Light" height="27">
        <td align="right" class="smalltblheading">Remarks &nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		<td align="right" class="smalltblheading">Remarks &nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		</tr>
		
		<tr class="Light" height="27">
        <td align="center" class="smalltblheading" colspan="4">Final Observation</td>
		</tr>
		
		<tr class="Light" height="27">
        <td align="right" class="smalltblheading">Date of Result&nbsp;</td>
		<td align="left" class="smalltbltext"><table border="1" height="100%" bordercolor="#000000" width="100%" cellpadding="0" cellspacing="0">
		<tr> <td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-left:none; border-top:none;">DD</td><td align="center" valign="middle" class="tblplight" width="33%" style="border-bottom:none; border-top:none;" >MM</td><td align="center" valign="middle" class="tblplight" width="34%" style="border-bottom:none; border-top:none; border-right:none;">YY</td></tr></table></td>
		<td align="right" class="smalltblheading">Total No. of Plants&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		</tr>
		<tr class="Light" height="27">
        <td align="right" class="smalltblheading">Total No. Off Types&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		<td align="right" class="smalltblheading">Genetic Purity %&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		</tr>
		<tr class="Light" height="27">
        <td align="right" class="smalltblheading">Remarks&nbsp;</td>
		<td align="left" class="smalltbltext" colspan="3">&nbsp;</td>
		</tr>
		<tr class="Light" height="27">
        <td align="center" class="smalltblheading" colspan="2">GOT Status&nbsp;</td>
		<td align="right" class="smalltblheading">Evaluated By&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		</tr>
		<tr class="Light" height="27">
		<td align="left" class="smalltbltext" colspan="2"><table border="1" height="100%" bordercolor="#000000" width="100%" cellpadding="0" cellspacing="0" style="border-top:none; border-bottom:none; border-left:none; border-right:none">
		<tr> <td align="center" valign="middle" class="smalltblheading" width="33%" style="border-bottom:none; border-top:none; border-left:none; ">OK</td><td align="center" valign="middle" class="smalltblheading" width="33%" style="border-bottom:none; border-top:none;">RETEST</td><td align="center" valign="middle" class="smalltblheading" width="34%" style="border-bottom:none; border-top:none; border-right:none; ">FAIL</td></tr></table></td>
		<td align="right" class="smalltblheading">Authorized By&nbsp;</td>
		<td align="left" class="smalltbltext">&nbsp;</td>
		</tr>
<?php
}
?>	
</table></td>
<?php
if($srno == 2)
{
echo "</tr>";
$srno = 1;
}
echo "<tr height='10'><td></td></tr>";
echo "<tr><td align='center' class='smalltbltext'>-------------------------------------------------------------------------------- Cut Here --------------------------------------------------------------------------------</td></tr>";
echo "<tr height='10'><td></td></tr>";
$srno = $srno+1;					
}
}
}
}
?>
</table>
<table width="700" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="542" align="right"><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="29"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>

