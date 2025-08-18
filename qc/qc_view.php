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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
	 $pid = $_REQUEST['itmid'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction- GOT Sample Dispatch</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form name="mainform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
	  
 <?php 
  $pid;
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arr_role='".$logid."' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	

?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">GOT Sample Dispatch  Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;Date of Arrival &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="20">
<?php
if($row['pid']=="Yes")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	//$tot=mysqli_num_rows($row3);		
 $business_name=$row3['business_name'];
	$address=$row3['address'].", ".$row3['city'].", ".$row3['state'];
	if ($row3['phone']!="" && $row3['phone']!=0)
	{
	$phone="0".$row3['std']." ".$row3['phone'];
	}
	}
	else
	{
	$business_name=$row['party_name'];
	$address=$row['address'];
	if($row['city']!="")
	{
	$address=$address."  ".$row['city'];
	}
	if($row['pin']!="" && $row['pin']!=0)
	{
	$address=$address." - ".$row['pin'];
	}
	if($row['state']!="")
	{
	$address=$address.", ".$row['state'];
	}
	if ($row['contactno']!="" && $row['contactno']!=0)
	{
	$phone="0".$row['std']." ".$row['contactno'];
	}
	if ($row['mobileno']!="" && $row['mobileno']!=0)
	{
	if($phone!="")
	$phone=$phone.", <b>Mobile No:</b> ".$row['mobileno'];
	else
	$phone=$row['mobileno'];
	}
	}
?>

<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5" >&nbsp;<?php echo $business_name;?></td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $address;?></div></td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Phone&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $phone;?></div></td>
</tr>
<?php
$txt11=$row['tmode'];
if($txt11!= "") 
{
?>
<tr class="Light" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5" >&nbsp;<?php echo $txt11;?></td>
</tr>
<?php

if($txt11 == "Transport")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_name'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['trans_vehno']?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($txt11 == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['courier_name'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="5" align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row['pname'];?></td>
</tr>
<?php
}
?>
</table>
<?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_gottest where gottest_aflg=0 and gottest_bflg=1  and gottest_cflg=0  order by gottest_sampleno desc") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

 if($tot_arr_home >0) { 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="20">
              <td width="28" height="19"align="center" valign="middle" class="tblheading">#</td>
			   <td width="83" align="center" valign="middle" class="tblheading">DOSR</td>
			    <td width="83" align="center" valign="middle" class="tblheading">DOSC</td>
			   <td width="145" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="171" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="129" align="center" valign="middle" class="tblheading">Lot No.</td> 
			  <td width="74" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="59" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
				 </tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

$p_array=explode(",",$row['lotno']);
			foreach($p_array as $val)
				{
				if($val <> "")
				{
				if($val==$row_arr_home['gottest_tid'])
					{ 	
					
	$trdate=$row_arr_home['gottest_srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_arr_home['gottest_spdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;		
	
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['gottest_tid'];
	$qc1=$row_arr_home['gottest_sampleno'];
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_gottest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['gottest_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['gottest_lotno'];
		}

	
	$lrole=$row_arr_home['logid'];
	$quer3=mysqli_query($link,"SELECT business_name from tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * from tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' and actstatus='Active'"); 
	$row33=mysqli_fetch_array($quer3);
	 $tt=$row33['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['gottest_variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl_sub1['gottest_trstage'];
$pp='T';	
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

$tp1="12";
}
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="145" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="74" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="119" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>
   </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="145" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="74" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="119" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>
	 </tr>
<?php
}
$srno=$srno+1;
}}}
}
}
}
}
?>
</table><br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
