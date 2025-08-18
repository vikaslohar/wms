<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
	
	
	if(isset($_REQUEST['cdate'])) { $cdate = $_REQUEST['cdate']; }
	if(isset($_REQUEST['txttypchk'])) { $txttypchk = $_REQUEST['txttypchk']; }
	if(isset($_REQUEST['txt11'])) { $txt11=trim($_REQUEST['txt11']); }
	if(isset($_REQUEST['foccode'])) { $foccode=trim($_REQUEST['foccode']); }
	if(isset($_REQUEST['foccode1'])) { $foccode1=trim($_REQUEST['foccode1']); }
	if(isset($_REQUEST['txtcrop'])) { $txtcrop=trim($_REQUEST['txtcrop']); }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety=trim($_REQUEST['txtvariety']); }
	if(isset($_REQUEST['txtpartycat1'])) { $txtpartycat1=trim($_REQUEST['txtpartycat1']); }
	if(isset($_REQUEST['fillpartyname1'])) { $fillpartyname1=trim($_REQUEST['fillpartyname1']); }
	if(isset($_REQUEST['orsrval'])) { $orsrval = $_REQUEST['orsrval']; }
	if(isset($_REQUEST['orderno'])) { $orderno = $_REQUEST['orderno']; }
	if(isset($_REQUEST['txtlot'])) { $txtlot = $_REQUEST['txtlot']; }
	if(isset($_REQUEST['txtlot1'])) { $txtlot1 = $_REQUEST['txtlot1']; }
	if(isset($_REQUEST['txtlot2'])) { $txtlot2 = $_REQUEST['txtlot2']; }
	if(isset($_REQUEST['partyname'])) { $partyname = $_REQUEST['partyname']; }
	if(isset($_REQUEST['txtpartycat'])) { $txtpartycat=trim($_REQUEST['txtpartycat']); }
	if(isset($_REQUEST['fillpartyname'])) { $fillpartyname=trim($_REQUEST['fillpartyname']); }
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	$partyname_org=$partyname;
	if($txtpp=="CandF")
	{
	$txtpp="C&F";
	}
	if($txtpp=="C")
	{
	$txtpp="C&F";
	}
if(isset($_POST['frm_action'])=='submit')
{
}
?>
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<?php
if($txttypchk=="Consolidated")
{
$mtyp="Consolidated";
$mtyp1="Consolidated Hold";
}
if($txttypchk=="Variety")
{
$mtyp="Variety";
$mtyp1="Variety Hold";
}
else if($txttypchk=="Party")
{
$mtyp="Party";
$mtyp1="Party Hold";
}
else if($txttypchk=="Order")
{
$mtyp="Order(s) of Party";
$mtyp1="Order(s) of Party Hold";
}
?>
<title>Order Booking-Report-Item on Hold Report</title><table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-hold.php?cdate=<?php echo $cdate?>&txttypchk=<?php echo $txttypchk?>&txt11=<?php echo $txt11?>&foccode=<?php echo $foccode?>&foccode1=<?php echo $foccode1?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtpartycat1=<?php echo $txtpartycat1?>&fillpartyname1=<?php echo $fillpartyname1?>&orsrval=<?php echo $orsrval?>&orderno=<?php echo $orderno?>&txtlot=<?php echo $txtlot?>&txtlot1=<?php echo $txtlot1?>&txtlot2=<?php echo $txtlot2?>&partyname=<?php echo $partyname_org?>&txtpartycat=<?php echo $txtpartycat?>&fillpartyname=<?php echo $fillpartyname?>&txtpp=<?php echo $txtpp?>&txtstatesl=<?php echo $txtstatesl?>&txtlocationsl=<?php echo $txtlocationsl?>&txtcountrysl=<?php echo $txtcountrysl?>&txtptype=<?php echo $txtptype?>&txtparty=<?php echo $txtparty?>&sdate=<?php echo $sdate?>&edate=<?php echo $edate?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" />&nbsp;</a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center"  border="1" bordercolor="#cc30cc" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="8">Item on Hold Report as on Date  <?php echo $_GET['cdate'];?></td>
<?php
if($txttypchk=="Consolidated")
{
?>

 <tr class="Dark" height="30">
<td width="190" align="right" valign="middle" class="tblheading">&nbsp;Type&nbsp;</td>
<td width="222"  align="left" valign="middle" class="smalltblheading" colspan="3">&nbsp;<?php echo $mtyp1;?></td>
</tr>
<?php
}
else
{
?>
 <tr class="Dark" height="30">
<td width="190" align="right" valign="middle" class="tblheading">&nbsp;Type&nbsp;</td>
<td width="222"  align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $mtyp1;?></td>

<td width="231" align="right"  valign="middle" class="tblheading" >&nbsp;Category&nbsp;</td>
<td align="left" width="297" valign="middle" class="smalltblheading" colspan="3">&nbsp;<?php echo $txt11;?></td>
</tr>

<?php
if($txttypchk=="Variety")
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."'  order by popularname Asc");
$noticia_item = mysqli_fetch_array($quer4);
?>
<tr class="Dark" height="30">
<td align="right" width="190" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" width="222" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia['cropname'];?></td>
<td align="right" width="231" valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left" width="297" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>
<?php
}
else if($txttypchk=="Party")
{
if($fillpartyname1=="")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$partyname."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname1=$row3['business_name']; 
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpartycat1;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpp;?></td>
  </tr>
  <?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
//echo $txtstatesl."  -  ".$txtlocationsl."  -  ".$txtcountrysl;
if($txtpp!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $txtcountrysl;?></td>
</tr>
<?php
}
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname;?></td>
</tr>
<?php
}
?>
<?php
}
else if($txttypchk=="Order")
{
?>
<?php
if($orsrval=="ordersearch")
{
$styp="Order Search";
}
else if($orsrval=="partysearch")
{
$styp="Party Search";
}
else if($orsrval=="datesearch")
{
$styp="Date Search";
}

?>
 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Search Type&nbsp;</td>
<td align="left"  valign="middle" class="smalltblheading"colspan="8">&nbsp;<?php echo $styp;?></td>
</tr>
<?php 
if($orsrval=="ordersearch")
{
$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
$row_m=mysqli_fetch_array($sql_m);
$orderno1=$row_m['orderm_porderno'];
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Order No.&nbsp;</td>
<td align="left"  valign="middle" class="smalltblheading" colspan="6" id="vaddress">&nbsp;<?php echo $orderno1;?></td>
</tr>
<?php
}
else if($orsrval=="partysearch")
{
if($fillpartyname=="")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$partyname."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname1=$row3['business_name']; 
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpartycat;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpp;?></td>
  </tr>
  <?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
//echo $txtstatesl."  -  ".$txtlocationsl."  -  ".$txtcountrysl;
if($txtpp!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $txtcountrysl;?></td>
</tr>
<?php
}
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname;?></td>
</tr>
<?php
}
?>
<?php
}
else if($orsrval=="datesearch")
{
?>
<tr class="Dark" height="30">
<td align="right" width="190" valign="middle" class="tblheading">Period - From Date&nbsp;</td>
<td align="left" width="222" valign="middle" class="smalltblheading">&nbsp;<?php echo $sdate;?></td>
<td align="right" width="231" valign="middle" class="tblheading">To Date&nbsp;</td>
<td align="left" width="297" valign="middle" class="smalltblheading">&nbsp;<?php echo $edate;?></td>
</tr>
<?php
}
}
?>
<?php
}
?>
</table>
<br />
<?php
 $a=$txttypchk;   $b=$txt11;
if($a=="Consolidated")
{ 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1;  $rec=0;
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));

$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
if($row_main['orderm_holdflag']==1)
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
}
else
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 and order_sub_hold_flag=1 group by orderm_id") or die(mysqli_error($link));
}

$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$flgtyp="";
while($row_sub=mysqli_fetch_array($sql_sub))
{

if($row_main['orderm_holdflag']==1)
{
$flgtyp=$row_main['orderm_holdtype'];
}
else
{
$flgtyp=$row_sub['order_sub_hold_type'];
}
	
	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $flgtyp;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $flgtyp;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<?php
}
else if($a=="Variety")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1; $cnt=0;
$sql_main=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$txtcrop."' and order_sub_variety='".$txtvariety."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 and order_sub_hold_flag=1 group by orderm_id") or die(mysqli_error($link));
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{

if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else
{
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$tdate=$row_sub['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_sub['orderm_party']!="" && $row_sub['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_sub['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_sub['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_main['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_sub_hold_type'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_main['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_sub_hold_type'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>

<?php
}
else if($a=="Party")
{ 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1;  $rec=0;
$ortyp="Order TDF"; 
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>

<?php
}
else if($a=="Order")
{ 
?>
<?php
if($orsrval!="partysearch")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1; $cnt=0; 
$ortyp="Order TDF"; 
if($orsrval=="ordersearch")
{
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{

		$sdate=$sdate;
		$sday=substr($sdate,0,2);
		$smonth=substr($sdate,3,2);
		$syear=substr($sdate,6,4);
		$sdate1=$syear."-".$smonth."-".$sday;
		
		$edate=$edate;
		$eday=substr($edate,0,2);
		$emonth=substr($edate,3,2);
		$eyear=substr($edate,6,4);
		$edate1=$eyear."-".$emonth."-".$eday;	
			
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>

<?php
}
else
{
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1;  $rec=0;
$ortyp="Order TDF"; 
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
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
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<?php
}
?>
<?php
}
else 
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Criteria</td></tr>
  </table>
<?php
}
?>

<br/>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-hold.php?cdate=<?php echo $cdate?>&txttypchk=<?php echo $txttypchk?>&txt11=<?php echo $txt11?>&foccode=<?php echo $foccode?>&foccode1=<?php echo $foccode1?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtpartycat1=<?php echo $txtpartycat1?>&fillpartyname1=<?php echo $fillpartyname1?>&orsrval=<?php echo $orsrval?>&orderno=<?php echo $orderno?>&txtlot=<?php echo $txtlot?>&txtlot1=<?php echo $txtlot1?>&txtlot2=<?php echo $txtlot2?>&partyname=<?php echo $partyname_org?>&txtpartycat=<?php echo $txtpartycat?>&fillpartyname=<?php echo $fillpartyname?>&txtpp=<?php echo $txtpp?>&txtstatesl=<?php echo $txtstatesl?>&txtlocationsl=<?php echo $txtlocationsl?>&txtcountrysl=<?php echo $txtcountrysl?>&txtptype=<?php echo $txtptype?>&txtparty=<?php echo $txtparty?>&sdate=<?php echo $sdate?>&edate=<?php echo $edate?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" />&nbsp;</a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>