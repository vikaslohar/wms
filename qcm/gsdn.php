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

	if(isset($_GET['tid']))
	{
	 $tid = $_GET['tid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>QC-Transaction  -GSDN</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arrival_id='$tid'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl);			
 $arrival_id=$row['arrival_id'];
 $code1="GSD"."/".$row['year_code']."/".$row['gsdn'];
$tot=mysqli_num_rows($sql_tbl);

	$tdate=$row['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	


	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table><hr />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">GOT Sample Dispatch Note (GSDN)</font></td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;GSDN No. &nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;DOSD&nbsp;</td>
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
	if(($row3['std']!=" " && $row3['std']!=0) && ($row3['phone']!=" " && $row3['phone']!=0))$phone="0".$row3['std']." ".$row3['phone'];else $phone=" ";
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
}
?>
</table><br />
<?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where aflg=0 and bflg=1  and cflg=0  order by sampleno desc") or die(mysqli_error($link));
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
				if($val==$row_arr_home['tid'])
					{ 	
					
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_arr_home['spdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;		
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}

	
	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name from tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * from tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$row_arr_home['variety']."'"); 
	$row33=mysqli_fetch_array($quer3);
	 $tt=$row33['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl_sub1['trstage'];
$pp=$row_tbl_sub1['state'];	
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

$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
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
		  <td width="119" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
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
		  <td width="119" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
	 </tr>
<?php
}
$srno=$srno+1;
}}
}
}
}
}
?>
</table>
          <br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
<table cellpadding="5" cellspacing="5" border="0" width="750" align="center">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><!--<img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />--></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
