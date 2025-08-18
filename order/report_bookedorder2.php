<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	if(isset($_REQUEST['txtcrop'])) { $txtcrop = $_REQUEST['txtcrop']; }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety = $_REQUEST['txtvariety']; }
	if(isset($_REQUEST['txtups'])) { $txtups = $_REQUEST['txtups']; }
	if(isset($_REQUEST['txtordertyp'])) { $txtordertyp = $_REQUEST['txtordertyp']; }
	if(isset($_REQUEST['txtordersts'])) { $txtordersts = $_REQUEST['txtordersts']; }
	
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

<title>Order - Report - Booked Order Status Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-bookedorder.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtstatesl=<?php echo $_REQUEST['txtstatesl'];?>&txtlocationsl=<?php echo $_REQUEST['txtlocationsl'];?>&txtparty=<?php echo $_REQUEST['txtparty'];?>&txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtordertyp=<?php echo $_REQUEST['txtordertyp'];?>&txtups=<?php echo $_REQUEST['txtups'];?>&txtordersts=<?php echo $_REQUEST['txtordersts'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php 
	$sts="";
	if($txtordersts=="pending") $sts=" and orderm_dispatchflag!=1 and orderm_supflag=0 and orderm_cancelflag=0 ";
	if($txtordersts=="dispatch") $sts=" and orderm_dispatchflag=1 ";
	if($txtordersts=="suspend") $sts=" and orderm_supflag=1 ";
	if($txtordersts=="cancel") $sts=" and orderm_cancelflag=1 ";
	
	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
		
	$tdate2=explode("-",$edate);
	$edate=$tdate2[2]."-".$tdate2[1]."-".$tdate2[0];

$states=$txtstatesl; $loca="ALL"; $partee="ALL"; $crp="ALL"; $ver="ALL";
if($txtstatesl!="ALL")
{
	if($txtlocationsl!="ALL")
	{
		$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
		$noti = mysqli_fetch_array($sql_mon);
		$loca=$noti['productionlocation'];
	}
	if($txtparty!="ALL")
	{
		$sql_m=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtparty."' order by business_name")or die(mysqli_error($link));
		$notic = mysqli_fetch_array($sql_m);
		$partee=$notic['business_name'];
	}
}	
if($txtcrop!="ALL")
{
	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
	$noticii = mysqli_fetch_array($quer);
	$crp=$noticii['cropname'];
}
if($txtvariety!="ALL")
{
	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' and actstatus='Active' order by popularname")or die(mysqli_error($link));

	$notici = mysqli_fetch_array($sql_mont);
	$ver=$notici['popularname'];
}


$blank=""; $statearr=""; $locarr=""; $partyarr=""; $statearrc=""; $locarrc=""; $partyarrc=""; $crparr=""; $ortype="ALL"; $locarreb="";

if($txtordertyp=="sales")
{
$ortype="Order Sales";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."'  and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."'  and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order Sales'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order Sales'  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="stock")
{
$ortype="Order Stock Transfer";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order Stock'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order Stock'  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="salesandstock")
{
$ortype="Order Sales and Order Stock Transfer";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and (order_trtype='Order Sales' OR order_trtype='Order Stock')   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and (order_trtype='Order Sales' OR order_trtype='Order Stock')  order by orderm_date asc ") or die(mysqli_error($link));
}
else if($txtordertyp=="tdf")
{
$ortype="Order TDF";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' and order_trtype='Order TDF' order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
}
else
{
$ortype="ALL";
$sqlstate=mysqli_query($link,"select distinct orderm_locstate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate!='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlstate1=mysqli_query($link,"select distinct orderm_partystate from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_locstate='".$blank."'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc=mysqli_query($link,"select distinct orderm_location from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location!='".$blank."'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc1=mysqli_query($link,"select distinct orderm_partycity from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlloc2=mysqli_query($link,"select distinct orderm_country from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_location='".$blank."' order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party!='0'  order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and  orderm_party='0' order by orderm_date asc ") or die(mysqli_error($link));
}

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
  <tr height="25">
    <td valign="middle" align="center" class="subheading" style="color:#303918;" colspan="3">Booked Order Status Report</td>
  </tr>
<tr height="25">  
   <td valign="middle" align="center" class="subheading" style="color:#303918;" colspan="3">Period From: <?php echo $_GET['sdate'];?>&nbsp;&nbsp;To: <?php echo $_GET['edate'];?></td>
</tr>
<tr height="25">  
   <td valign="middle" align="left" class="subheading" style="color:#303918;" colspan="3">&nbsp;Order Type: <?php echo $ortype;?></td>
</tr>
<tr height="25">  
   <td width="42%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Crop: <?php echo $crp;?></td>
   <td width="34%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Variety: <?php echo $ver;?>&nbsp;</td>
    <td width="24%" valign="middle" align="right" class="subheading" style="color:#303918;">UPS: <?php echo $txtups;?>&nbsp;</td>
</tr>
<tr height="25">  
   <td width="42%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;State: <?php echo $states;?></td>
   <td width="34%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Location: <?php echo $loca;?></td>
   <td width="24%" valign="middle" align="right" class="subheading" style="color:#303918;">Party: <?php echo $partee;?>&nbsp;</td>
</tr>
</table>
<br />
<?php

while($rowstate=mysqli_fetch_array($sqlstate))
{
if($statearr!="")
$statearr=$statearr.",".$rowstate['orderm_locstate'];
else
$statearr=$rowstate['orderm_locstate'];
}

while($rowstate1=mysqli_fetch_array($sqlstate1))
{
if($statearr!="")
$statearr=$statearr.",".$rowstate1['orderm_partystate'];
else
$statearr=$rowstate1['orderm_partystate'];
}


while($rowloc=mysqli_fetch_array($sqlloc))
{
if($locarr!="")
$locarr=$locarr.",".$rowloc['orderm_location'];
else
$locarr=$rowloc['orderm_location'];
}

while($rowloc1=mysqli_fetch_array($sqlloc1))
{
if($locarrc!="")
$locarrc=$locarrc.",".$rowloc1['orderm_partycity'];
else
$locarrc=$rowloc1['orderm_partycity'];
}



while($rowloc2=mysqli_fetch_array($sqlloc2))
{
if($statearr!="")
$statearr=$statearr.",".$rowloc2['orderm_country'];
else
$statearr=$rowloc2['orderm_country'];
}


while($rowpty=mysqli_fetch_array($sqlpty))
{
if($partyarr!="")
$partyarr=$partyarr.",".$rowpty['orderm_party'];
else
$partyarr=$rowpty['orderm_party'];
}

while($rowpty1=mysqli_fetch_array($sqlpty1))
{
if($partyarrc!="")
$partyarrc=$partyarrc.",".$rowpty1['orderm_partyname'];
else
$partyarrc=$rowpty1['orderm_partyname'];
}

$sqlcrp=mysqli_query($link,"select distinct cropid from tblcrop order by cropname asc ") or die(mysqli_error($link));
while($rowcrp=mysqli_fetch_array($sqlcrp))
{
if($crparr!="")
$crparr=$crparr.",".$rowcrp['cropid'];
else
$crparr=$rowcrp['cropid'];
}

$list3 = explode(",", implode(",",array_values(array_unique(explode(",",$statearr)))));
sort($list3);
$sstate=implode("','",$list3);
$zzz=array_values(array_unique(explode(",",$locarrc)));
$xx=array_values(array_unique(explode(",",$locarrc)));
$xz="";
foreach($xx as $valc)
{
if($valc<>"")
{
$query = mysqli_query($link,"SELECT `productionlocationid` FROM `tblproductionlocation` WHERE LOWER(`productionlocation`) = '".strtolower($valc)."'") or die(mysqli_error($link));
if($tot_s=mysqli_num_rows($query)>0)
{
if (($key = array_search($valc, $zzz)) !== false) {
    unset($zzz[$key]);
}
$row_s=mysqli_fetch_array($query);
if($xz!="")
$xz=$xz.",".$row_s['productionlocationid'];
else
$xz=$row_s['productionlocationid'];
}
}
}
$locarrc=implode(",",$zzz);
if($locarr!="")
$locarr=$locarr.",".$xz;
else
$locarr=$xz;

$locarr = implode(",",array_values(array_unique(explode(",",$locarr))));
$locarr.=",".$locarrc;
$sstate="'$sstate'";
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td width="22"align="center" valign="middle" class="smalltblheading">#</td> 
	<td width="62" align="center" valign="middle" class="smalltblheading">Date</td>
    <td width="85" align="center" valign="middle" class="smalltblheading">Order No.</td>
	<td width="85" align="center" valign="middle" class="smalltblheading">PO Ref. No.</td>
	<td width="192" align="center" valign="middle" class="smalltblheading">Party Name</td>
	<td align="center" valign="middle" class="smalltblheading">Location</td>
	<td align="center" valign="middle" class="smalltblheading">State</td>
	<td align="center" valign="middle" class="smalltblheading">Crop</td>
	<td align="center" valign="middle" class="smalltblheading">Variety</td>
	<td align="center" valign="middle" class="smalltblheading">Size</td>
	<td align="center" valign="middle" class="smalltblheading">Ordered Qty</td>
	<td align="center" valign="middle" class="smalltblheading">Balance Qty</td>
	<td align="center" valign="middle" class="smalltblheading">Status</td>
</tr>

<?php
$srno=1; 
if($txtstatesl!="ALL")
{
$list3=array($txtstatesl);
}
foreach($list3 as $stval)
{
if($stval<>"")
{
$omid="";

$s="select distinct orderm_id from tbl_orderm where orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='$stval' OR orderm_partystate='$stval' OR orderm_country='$stval') and orderm_tflag=1 $sts ";

if($txtordertyp=="sales")
{
$s.=" and order_trtype='Order Sales' ";
}
else if($txtordertyp=="stock")
{
$s.=" and order_trtype='Order Stock' ";
}
else if($txtordertyp=="salesandstock")
{
$s.=" and (order_trtype='Order Sales' OR order_trtype='Order Stock') ";
}
else if($txtordertyp=="tdf")
{
$s.=" and order_trtype='Order TDF' ";
}
else
{
$s.=" ";
}
$s.=" order by orderm_locstate asc, orderm_partystate asc ";
$sql_arrhome=mysqli_query($link,$s) or die(mysqli_error($link));
$tot_arrhome=mysqli_num_rows($sql_arrhome);

if($tot_arrhome > 0)
{ 
while($row_arrhome=mysqli_fetch_array($sql_arrhome))
{
if($omid!="")
$omid=$omid.", ".$row_arrhome['orderm_id'];
else
$omid=$row_arrhome['orderm_id'];
}
$omid1 = implode(",",array_values(array_unique(explode(",",$omid))));
$ormmid=explode(",",$omid);
foreach($ormmid as $ormid)
{
if($ormid<>"")
{
if($txtstatesl=="ALL")
{
$s="select * from tbl_orderm where orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='$stval' OR orderm_partystate='$stval' OR orderm_country='$stval') and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
else
{
$s="select * from tbl_orderm where orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='".$txtstatesl."' OR orderm_partystate='".$txtstatesl."' OR orderm_country='$stval') and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
$sql_arr_home=mysqli_query($link,$s) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($tot_arr_home > 0)
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	$orno=""; $party="";  $partyflg=0; 
	
	$partyid=$row_arr_home['orderm_party'];
	
	if($txtparty!="ALL" && $row_arr_home['orderm_party']==$txtparty)
	{
		$partyid=$txtparty;
	}
	else
	{
		$partyflg++;
	}
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr_home['orderm_party'] > 0)
	$party=$row3['business_name'];
	else
	$party=$row_arr_home['orderm_partyname'];
	
	$orno=$row_arr_home['orderm_porderno'];
	$porrefno=$row_arr_home['orderm_partyrefno'];
	
	$ssub="select * from tbl_order_sub where orderm_id='$ormid' ";
if($txtcrop!="ALL")
{
	if($txtvariety!="ALL")
	{
		$ssub.=" and order_sub_crop='$txtcrop' and order_sub_variety='$txtvariety' order by order_sub_crop, order_sub_variety";
	}
	else
	{
		$ssub.=" and order_sub_crop='$txtcrop' order by order_sub_crop, order_sub_variety";
	}
}
$sql_subor=mysqli_query($link,$ssub) or die(mysqli_error($link));
$ttoott=mysqli_num_rows($sql_subor);
$flg=0; $orstatus=""; 
while($row_subor=mysqli_fetch_array($sql_subor))
{	
	$oqty=0; $bqty=0; $upsize=""; $oqty1=""; $bqty1=""; $size1=""; $c=0; $oqt=0;
	$sqlsubsub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and  orderm_id='".$row_arr_home['orderm_id']."' and order_sub_id='".$row_subor['order_sub_id']."' group by order_sub_sub_ups") or die(mysqli_error($link));
	while($rowsubsub=mysqli_fetch_array($sqlsubsub))
	{
		$size=$rowsubsub['order_sub_sub_ups'];
		if($size1=="")$size1=$size;
		$ups=$size;
		$upp=explode(" ", $ups);
		$upc=floatval($upp[0]);
		$ups=$upc." ".$upp[1];
		$size=$ups;
		if($size==0)$size="";
		
		if($txtups!="ALL")
		{
			if($size!="" && $size==$txtups)
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}
			else
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}	
		}
		else
		{
			if($size!="" && $size==$size1)
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}
			else
			{
				$oqty=$rowsubsub['order_sub_sub_qty'];
				$bqty=$rowsubsub['order_sub_subbal_qty'];
			}	
		}
		if($bqty<0)	$bqty=0;
		
		if($row_subor['order_sub_totbal_qty']<=0)
		{$c=0;	$bqty=0;}
		if($upsize!="") $upsize=$upsize."<br />".$size;
		else $upsize=$size;
		
		if($oqty1!="") $oqty1=$oqty1."<br />".$oqty;
		else $oqty1=$oqty;
		
		if($bqty1!="") $bqty1=$bqty1."<br />".$bqty;
		else $bqty1=$bqty;
		
		$size1=$size;
		$c=$c+$bqty;
		$oqt=$oqt+$oqty;
	}
	
if($txtstatesl=="ALL")
{
	if($row_arr_home['orderm_locstate']!="")
	$statee=$row_arr_home['orderm_locstate'];
	else
	$statee=$row_arr_home['orderm_partystate'];
}
else
{
	$statee=$txtstatesl;
}
if($row_arr_home['orderm_party_type']=="Export Buyer")
$statee=$row_arr_home['orderm_country'];

$locflg=0;
$locarr=explode(",",$locarr);
if($txtlocationsl=="ALL")
{
	if($row_arr_home['orderm_location']!="")
	$valoc=$row_arr_home['orderm_location'];
	else
	$valoc=$row_arr_home['orderm_partycity'];
	
	/*if (($key = array_search($valoc, $zzz)) !== false) 
	{
		$locflg++;
	}*/

}
else
{
	$valoc=$txtlocationsl;
	
	/*if (($key = array_search($valoc, $zzz)) !== false) 
	{
		$locflg++;
	}*/
}	
if($row_arr_home['orderm_party_type']=="Export Buyer")
//$valoc=$row3['city'];
$valoc=$row_arr_home['orderm_partycity'];
if($oqty<=0)$locflg++;

if($txtups!="ALL" && $txtups!=$size)
$locflg=1;

if($txtparty!="ALL" && $partyflg>0)
$locflg=1;

if($locflg>0) 
$flg=1;
else
$flg=0;
	
if($row_arr_home['orderm_dispatchflag']==1 && $row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0)
$orstatus="Dispatched";
else if($row_arr_home['orderm_dispatchflag']==2 && $row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0)
$orstatus="Part Dispatched";
else if($bqty==0 && $row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0)
$orstatus="Dispatched";
else if($row_arr_home['orderm_cancelflag']==1)
$orstatus="Canceled";
else if($row_arr_home['orderm_supflag']==1)
{
	if($c==$oqt)
	{
	$orstatus="Suspended";
	}
	else if($c==0)
	{
	$orstatus="Dispatched";
	}
	else if($c<$oqt && $c>0)
	{
	$orstatus="Part Dispatched"."<br/>"."Suspended";
	}
	else
	{
	$orstatus="Suspended";
	}
}
else
$orstatus="Pending";

	$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$valoc."' order by productionlocation")or die(mysqli_error($link));
	$noti = mysqli_fetch_array($sql_mon);
	if($tloc=mysqli_num_rows($sql_mon) > 0)
	$loca=$noti['productionlocation'];
	else
	$loca=$valoc;

	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_subor['order_sub_crop']."' order by cropname Asc") or die(mysqli_error($link)); 
	$noticii = mysqli_fetch_array($quer);
	$crp1=$noticii['cropname'];
 
	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_subor['order_sub_variety']."' and actstatus='Active' order by popularname")or die(mysqli_error($link));
	$notici = mysqli_fetch_array($sql_mont);
	$ver1=$notici['popularname'];
if($bqty<0)	$bqty=0;
if($c==0 && $orstatus=="Part Dispatched")$orstatus="Dispatched";
	if($bqty==0)$orstatus="Dispatched";
if($flg==0) 
{
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $orno?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $porrefno?></td>
    <td width="192" align="center" valign="middle" class="smalltbltext"><?php echo $party?></td>
	<td width="87" align="center" valign="middle" class="smalltbltext"><?php echo $loca;?></td>
	<td width="84" align="center" valign="middle" class="smalltbltext"><?php echo $statee;?></td>
	<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $crp1;?></td>
	<td width="114" align="center" valign="middle" class="smalltbltext"><?php echo $ver1;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $upsize;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $oqty1;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $bqty1;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php if($orstatus=="Suspended" || $orstatus=="Canceled" || $orstatus=="Part Dispatched"."<br/>"."Suspended"){?><font color="#FF0000"><?php echo $orstatus;?></font><?php } else if($orstatus=="Dispatched" || $orstatus=="Part Dispatched"){?><font color="#0000FF"><?php echo $orstatus;?></font><?php } else { echo $orstatus; } ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $orno?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $porrefno?></td>
    <td width="192" align="center" valign="middle" class="smalltbltext"><?php echo $party?></td>
	<td width="87" align="center" valign="middle" class="smalltbltext"><?php echo $loca;?></td>
	<td width="84" align="center" valign="middle" class="smalltbltext"><?php echo $statee;?></td>
	<td width="76" align="center" valign="middle" class="smalltbltext"><?php echo $crp1;?></td>
	<td width="114" align="center" valign="middle" class="smalltbltext"><?php echo $ver1;?></td>
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $upsize;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $oqty1;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $bqty1;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php if($orstatus=="Suspended" || $orstatus=="Canceled" || $orstatus=="Part Dispatched"."<br/>"."Suspended"){?><font color="#FF0000"><?php echo $orstatus;?></font><?php } else if($orstatus=="Dispatched" || $orstatus=="Part Dispatched"){?><font color="#0000FF"><?php echo $orstatus;?></font><?php } else { echo $orstatus; } ?></td>
</tr>
<?php
}
$srno=$srno+1; 
}
}
}
}
}
}
}
}
}
?>
</table>

<br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-bookedorder.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtstatesl=<?php echo $_REQUEST['txtstatesl'];?>&txtlocationsl=<?php echo $_REQUEST['txtlocationsl'];?>&txtparty=<?php echo $_REQUEST['txtparty'];?>&txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtordertyp=<?php echo $_REQUEST['txtordertyp'];?>&txtups=<?php echo $_REQUEST['txtups'];?>&txtordersts=<?php echo $_REQUEST['txtordersts'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
