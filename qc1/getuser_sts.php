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
<title>QC- Transaction-Qc Seed Testing slip</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$itm=explode(",",$itmid);$srno=1;
$cont=0;$cnt=0;$v1=array();
foreach($itm as $tid)
{
if($tid <> "")
{
for($i=0; $i<$txtpp; $i++)
{
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) { 
?>
	<tr>
    <td>
	<table  align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="Light" height="29">
        <td colspan="17"  align="center" class="tblheading">Seed Testing Slip</td>
      </tr>
	  
      <?php

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$qc1sts=$row_arr_home['stsno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
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

	
	
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$tp1sts=13;
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="35">
        <td width="54" align="right"  valign="middle" class="smalltblheading">Samp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
        <td width="55" align="right"  valign="middle" class="smalltblheading">DoS&nbsp;</td>
        <!--<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<?php echo $trdaytt;?>&nbsp;|&nbsp;<?php echo $trmonthtt;?>&nbsp;|&nbsp;<?php echo $tryeartt;?></td>-->
		<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;</td>
		<td width="43" align="center" class="smalltblheading">Test Method</td>
		<td width="56" align="center" class="smalltblheading">DoT</td>
		<td width="41" align="center" class="smalltblheading">NoS</td>
		<td width="43" align="center" class="smalltblheading">Normal</td>
		<td width="60" align="center" class="smalltblheading">Abnormal</td>
		<td width="36" align="center" class="smalltblheading">Dead</td>
		<td width="34" align="center" class="smalltblheading">Hard</td>
		<td width="30" align="center" class="smalltblheading">G%</td>
		<td width="51" align="center" class="smalltblheading">Valid Test</td>
      </tr>
	  
      <tr class="Light" height="35">
        <td align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $row31['cropname'];?></td>
        <td align="right"  valign="middle" class="smalltblheading">Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $vv?></td>
		 <td align="center" class="smalltblheading">Soil</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
      </tr>
	  
      <tr class="Light" height="35">
	   <td  align="right"  valign="middle" class="smalltblheading">Lot No&nbsp;</td>
        <td width="85"  align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $lotno?></td>
        <td width="31" align="right"  valign="middle" class="smalltblheading">NoB&nbsp;</td>
        <td width="29" align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td  align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="43"  align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
        <td width="35" align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td width="38" align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $stage;?></td>
		<td align="center" class="smalltblheading">Paper</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
      </tr>
	  
      <tr class="Light" height="35">
        <td align="right"  valign="middle" class="smalltblheading">Remarks&nbsp;</td>
        <td align="left"  valign="middle" class="smalltbltext" colspan="7" >&nbsp;</td>
		<td align="center" class="smalltblheading">P. Dish</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		</tr>
		
		<tr class="Light" height="35">
        <td align="center" class="smalltblheading">Result (Tick)</td>
		<td align="center" class="smalltbltext">OK</td>
		<td align="center" class="smalltbltext">Retest</td>
		<td align="center" class="smalltbltext">Fail</td>
		<td align="left"  valign="middle" class="smalltblheading">Evaluated By&nbsp;</td>
		<td align="center" class="smalltblheading" colspan="3" >&nbsp;</td>
		<td align="center" class="smalltblheading">Other</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		<td align="center" class="smalltblheading">&nbsp;</td>
		</tr>
    
	
<?php
}
?>	
</table></td>
<?php
if($srno == 3)
{
echo "</tr>";
$srno = 0;
}	
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td><hr></td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
$srno = $srno+1;					
}
}
}
}
?>	

  
</table>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="542" align="right"><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="29"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>

