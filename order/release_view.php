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
	$party = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['txttype']))
	{
	$a = $_REQUEST['txttype'];
	}
	if(isset($_REQUEST['oid']))
	{
	 	$oid = $_REQUEST['oid'];
	}
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];	
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Transaction - Order Release- Preview</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
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
  <?php 
  
$sql_orrelm=mysqli_query($link,"Select * from tbl_orderrelease where plantcode='$plantcode' and orel_id='$oid'") or die(mysqli_error($link));
$tot_orrelm=mysqli_num_rows($sql_orrelm);
$row_orrelm=mysqli_fetch_array($sql_orrelm);
$tid240=explode(",",$row_orrelm['orel_ordermid']);  
foreach($tid240 as $tid6)
{
if($tid6<>"")
{
$tid=$tid6;
}
}

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl1=mysqli_fetch_array($sql_tbl);
$total_tbl=mysqli_num_rows($sql_tbl);			
//$tid=$row_tbl1['orderm_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_dispatch_flag=0 and order_sub_hold_flag=0 and orderm_id='".$tid."'") or die(mysqli_error($link));
  $total_tbl1=mysqli_num_rows($sql_tbl_sub);
?>
 <form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $p_id?>" />
		<!--<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />-->
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['orderm_code']?>" />
	  
 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"> Order - Release Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Dark" height="30">
	<td width="223" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
	<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo date("d-m-Y");?></td>
	<td width="139" align="right"  valign="middle" class="tblheading" >Order Release Type&nbsp;</td>
    <td width="277" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_orrelm['orel_type'];?></td>
</tr>
<?php
if($a!="TDF")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$party."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td width="201" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $a;?></td>
    <td width="139" align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td width="277" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $txtpp;?></td>
</tr>
<?php
if($txtpp!="Export Buyer")
{	
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
// $noticia3['productionlocation'];
?>	

<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia3['productionlocation'];?></td>
</tr>
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl1['orderm_country']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="8">&nbsp;<?php echo $row_tbl1['orderm_country'];?></td>
</tr>
<?php
}
?>
 <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address'];?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?>&nbsp;</td>
</tr>

<?php
}
else
{

$addrs=""; $partname="";
$sql_month22=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$party' and orderm_dispatchflag!=1 order by orderm_party")or die("Error:".mysqli_error($link));
$tott=mysqli_num_rows($sql_month22);

if($tott==0)
{
$sql_month22=mysqli_query($link,"select * from tbl_partymaser where p_id='$party'")or die("Error:".mysqli_error($link));
$row_month22=mysqli_fetch_array($sql_month22);
$partname=$row_month22['business_name'];
$add=$row_month22['address']; if($row_month22['city']!="") { $add=$add.", ".$row_month22['city']; } $add=$add.", ".$row_month22['state'];
}
else
{
$row_month22=mysqli_fetch_array($sql_month22);
$partname=$row_month22['orderm_partyname'];
$addrs=$row_month22['orderm_partyaddress']; if($row_month22['orderm_partycity']!="") { $addrs=$addrs.", ".$row_month22['orderm_partycity']; } $addrs=$addrs.", ".$row_month22['orderm_partystate'];
}
?>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $a;?></td>
</tr>
 <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $partname;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $addrs;?>&nbsp;</td>
</tr>
<?php
}
?>

</table>
<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order Date </td>
                 <td width="58" align="center" valign="middle" class="tblheading">Order No.</td>
			 <!-- <td width="75" align="center" valign="middle" class="tblheading">View Order</td>
			  <td width="43" align="center" valign="middle" class="tblheading">&nbsp;</td>
            <td width="48" align="center" valign="middle" class="tblheading">Party Name</td>-->
	</tr>
	</table>
  <?php
  $srno=1;
$sql_orrelm1=mysqli_query($link,"Select * from tbl_orderrelease where plantcode='$plantcode' and orel_id='$oid'") or die(mysqli_error($link));
$tot_orrelm1=mysqli_num_rows($sql_orrelm1);
$row_orrelm1=mysqli_fetch_array($sql_orrelm1);
$tid24=explode(",",$row_orrelm1['orel_ordermid']);  
foreach($tid24 as $tid)
{
if($tid<>"")
{
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='$tid'") or die(mysqli_error($link));

  

$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl=mysqli_fetch_array($sql_tbl))
{

 $arrival_id=$row_tbl['orderm_id'];
 
  $row_tbl['orderm_ncode'];
	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;<input name="fln" type="hidden" size="52" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <!-- <td width="75" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>-->
	
  </tr>
  </table>
 <?php
$srno++;
}
}
?>
<?php 
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and arrsub_id='".$subid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);*/
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
/*if($row_tbl['order_trtype']=="Order Sales")
{
*/	?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_dispatch_flag!=1 and order_sub_hold_flag!=1") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="116" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="167" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="39" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="76" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Released Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
        <!--<td width="38" align="center" valign="middle" class="tblheading">PT</td>
        <td width="39" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="40" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoMP</td>-->
</tr>
  <?php
$srno24=1;$itmdchk="";$itmdchk1="";
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
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1=""; $subsaubsubid="";$releaseqty="";
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

$subsaubsubid=$row_sloc['order_sub_sub_id'];


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

$sql_orrelss=mysqli_query($link,"Select * from tbl_orderrelsub_sub where plantcode='$plantcode' and orelsub_ordermsubsubid='$subsaubsubid' and orel_id='$oid'")or die(mysqli_error($link));
$tot_orrelss=mysqli_num_rows($sql_orrelss);
$row_orrelss=mysqli_fetch_array($sql_orrelss);


if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid" id="subsubid_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty" id="extorqty_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><?php echo $row_orrelss['orelsubsub_relqty'];?></td>
		<td width="129" align="center" valign="middle" class="tblheading"><?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid" id="subsubid_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty" id="extorqty_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><?php echo $row_orrelss['orelsubsub_relqty'];?></td>
		<td width="129" align="center" valign="middle" class="tblheading"><?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>		
<?php
}
$srno24++;
}
}
}
?>
 <input type="hidden" name="srno24" value="<?php echo $srno24;?>" />
</table>
 
<?php
}
}
?>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
