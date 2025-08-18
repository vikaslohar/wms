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

	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Orderl-Transaction-Demo Order Note - TON</title>
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$itmid; 
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
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
</table></td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000"> Demo Order Note (DON)</font></td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr class="Light" height="30">
  <td width="86" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
      <td width="63"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "OD".$row_tbl['orderm_trcode']."/".$ycode."/".$lgnid;?></td>
    <td width="145" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
  </tr>
  <?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$partytype="";$partytyp=""; $partyname=""; $partyadd="";
	if($row_tbl['orderm_partyselect']=="selectp") {	$partytype="Select"; } else { $partytype="Fill"; }
	
	if($partytype == "Select")
	{
	$partytyp=$row_tbl['orderm_party_type'];
	$partyname=$row3['business_name']; 
	$city="";$pin1=""; $phno=""; $mbno=""; $tin="";
	if($row3['city']!="")
	$city=", ".$row3['city'];
	
	if($row3['pin']!="")
	 if ($row3['pin'] >0 ){ 
	 $pin1=" - ".$row3['pin'];}
	//$partyadd=$row3['address'].$city.", ".$row3['state'].$pin1;
	
	if($row3['mob']!="" && $row3['mob']!=0){$mbno="Mob no.-".$row3['mob'];}if($row3['phone']!=""){$phno="Phone no. ".$row3['std']."-".$row3['phone'];}if($row3['tin']!=""){$tin="TIN -".$row3['tin'];}
	
	$partyadd=$row3['address'].$city.", ".$row3['state'].$pin1.", ".$phno.", ".$mbno.", ".$tin; 
	}
	else
	{
	$partytyp=""; $phno=""; $mbno=""; $tin="";
	$partyname=$row_tbl['orderm_partyname'].",".$row_tbl['orderm_country'];
	$city="";
	if($row_tbl['orderm_partycity']!="")
	$city=", ".$row_tbl['orderm_partycity'];
	
	if($row_tbl['orderm_partyphno']!="")
	$phno="Phone no. ".$row_tbl['orderm_partyphstd']."-".$row_tbl['orderm_partyphno'];
	
	if($row_tbl['orderm_partymobile']!="")
	$mbno="Mob no. ".$row_tbl['orderm_partymobile'];
	
	if($row_tbl['orderm_partytin']!="")
	$tin="TIN - ".$row_tbl['orderm_partytin'];
	
	$pin="";
	if($row_tbl['orderm_partypin']!="")
	if ($row_tbl['orderm_partypin'] >0 ){ 
	$pin=" - ".$row_tbl['orderm_partypin'];}
	$partyadd=$row_tbl['orderm_partyaddress'].$city.$pin.", ".$row_tbl['orderm_partystate'].", ".$phno.", ".$mbno.", ".$tin; 
	
	}
?>
  <tr class="Dark" height="30">
    <td align="right" width="86" valign="middle" class="tblheading">&nbsp;Order No.&nbsp;</td>
    <td align="left" width="63" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_porderno'];?></td>
    <td align="right" width="145" valign="middle" class="tblheading">&nbsp;Party Order Ref. No.&nbsp;</td>
    <td align="left" width="25" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_partyrefno'];?></td>
  </tr>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Party&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $partytype;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $partytyp;?></td>
  </tr>
  <?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['orderm_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
if($partytype == "Select")
{
if($row_tbl['orderm_party_type']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_locstate'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['orderm_country'];?></td>
</tr>
<?php
}
}
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $partyname;?></td>
  </tr>
  <tr class="Dark" height="30">
    <td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
     <td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div style="padding-left:4px"><?php echo $partyadd;?></div></td>
  </tr>
   <?php
if($partytype != "Select")
{
?>
          <tr class="Dark" height="30">
            <td align="right" width="188" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
            <td align="left" width="219" valign="middle" class="tbltext">&nbsp;
                <?php echo $row_tbl['orderm_partytin'];?></td>
            <td align="right" width="240" valign="middle" class="tblheading">PAN&nbsp;</td>
            <td align="left" width="293" valign="middle" class="tbltext">&nbsp;
                <?php echo $row_tbl['orderm_partypan'];?></td>
          </tr>
          <?php
}
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading">Consignee Applicable&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"  colspan="5">&nbsp;<?php if($row_tbl['orderm_consigneeapp']=="Yes1"){ echo "Yes";} else{ echo "No";}?></td>
  </tr>
  
  <?php 
if($row_tbl['orderm_consigneeapp']=="Yes1")
{
?>
  <tr class="Dark" height="30">
    <td align="right" width="86" valign="middle" class="tblheading">&nbsp;Consignee Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['orderm_consigneename'];?></td>
  </tr>
  <tr class="Light" height="25">
    <td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
   <td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div style="padding-left:4px"><?php if($row_tbl['orderm_conadd']!=""){?><?php echo $row_tbl['orderm_conadd'];}?><?php if($row_tbl['orderm_concity']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_concity'];}?><?php if($row_tbl['orderm_constate']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_constate'];}?><?php if($row_tbl['orderm_country']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_country'];}?> <?php if($row_tbl['orderm_conpin']!="") {?>,&nbsp;Pin<?php echo $pin; }?> <?php if($row_tbl['orderm_conphoneno']!=""){?>Phone:<?php echo $row_tbl['orderm_conphonestd']."-".$row_tbl['orderm_conphoneno'];}?> <?php if($row_tbl['orderm_conmobile']!=""){?> Mobile:<?php echo $row_tbl['orderm_conmobile'];}?>
    </div></td>
  </tr>
  <?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{
?>
          <tr class="Dark" height="30">
            <td align="right" width="188" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
            <td align="left" width="219" valign="middle" class="tbltext">&nbsp;
                <?php echo $row_tbl['orderm_contin'];?></td>
            <td align="right" width="240" valign="middle" class="tblheading">&nbsp;PAN&nbsp;</td>
            <td align="left" width="293" valign="middle" class="tbltext">&nbsp;
                <?php echo $row_tbl['orderm_conpan'];?></td>
          </tr>
          <?php
}
else
{
?>
          <tr class="Dark" height="30">
            <td align="right" width="188" valign="middle" class="tblheading">&nbsp;UDF 1&nbsp;</td>
            <td align="left" width="219" valign="middle" class="tbltext">&nbsp;
                <?php echo $row_tbl['orderm_contin'];?></td>
            <td align="right" width="240" valign="middle" class="tblheading">&nbsp;UDF 2&nbsp;</td>
            <td align="left" width="293" valign="middle" class="tbltext">&nbsp;
                <?php echo $row_tbl['orderm_conpan'];?></td>
          </tr>
          <?php
}
?>
          <?php
}
?>
  <tr class="Light" height="30">
    <td align="right" width="86" valign="middle" class="tblheading">&nbsp;Order Placed By&nbsp;</td>
    <td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_placedby'];?></td>
  </tr>
  <tr class="Dark" height="25">
    <td align="right"  valign="middle" class="tblheading">&nbsp;Preferred Mode of Dispatch&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_tmode'];?></td>
    <?php
if($row_tbl['orderm_tmode'] == "Transport")
{
?>
    <td align="right" width="145" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_trname'];?></td>
    <?php
}
else if($row_tbl['orderm_tmode'] == "Courier")
{
?>
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
    <td width="17" align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_cname'];?></td>
    <?php
}
else 
{
?>
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
    <td width="20" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_pname'];?></td>
    <?php
}
?>
  </tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="141" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
        <td width="74" align="center" valign="middle" class="tblheading">Variety Type</td>
        <td width="242" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
		<td width="45" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="83" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="34" align="center" valign="middle" class="tblheading">NoP</td>
		</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		
$up=""; $up1=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $zz="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";

}
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="141" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="74" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="242" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="83" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="34" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
  <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="141" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="74" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="242" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="83" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="34" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		</tr>		
<?php
}
$srno++;
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

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;Verified by &nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Verified By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>-->
<table cellpadding="5" cellspacing="5" border="0" width="750" align="center">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><!--<img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />--></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form></td></tr>
</table>

</body>
</html>
