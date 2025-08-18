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
	
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	if(isset($_REQUEST['txtordertyp'])) { $txtordertyp = $_REQUEST['txtordertyp']; }
	
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

<title>Order - Report -Periodical Booked Order Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-periodbookedorder.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtstatesl=<?php echo $_REQUEST['txtstatesl'];?>&txtlocationsl=<?php echo $_REQUEST['txtlocationsl'];?>&txtparty=<?php echo $_REQUEST['txtparty'];?>&txtordertyp=<?php echo $_REQUEST['txtordertyp'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php 
	$sts="";
	
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

$blank=""; $statearr=""; $locarr=""; $partyarr=""; $statearrc=""; $locarrc=""; $partyarrc=""; $crparr=""; $ortype="ALL"; $locarreb="";

if($txtordertyp=="sales")
{
	$ortype="Sales";
}
else if($txtordertyp=="branch")
{
	$ortype="Branch and C&F";
}
else if($txtordertyp=="tdf")
{
	$ortype="TDF";
}
else
{
	$ortype="ALL";
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
  <tr height="25">
    <td valign="middle" align="center" class="subheading" style="color:#303918;" colspan="3">Periodical Booked Order Report</td>
  </tr>
<!-- <tr height="25">
    <td valign="middle" align="center" class="subheading" style="color:#303918;" colspan="2">Booked Order Report</td>
  </tr>-->
<tr height="25">  
   <td valign="middle" align="center" class="subheading" style="color:#303918;" colspan="3">Period From: <?php echo $_GET['sdate'];?>&nbsp;&nbsp;To: <?php echo $_GET['edate'];?></td>
</tr>
<tr height="25">  
   <td valign="middle" align="left" class="subheading" style="color:#303918;" >&nbsp;Party Type: <?php echo $ortype;?></td>
   <td width="50%" valign="middle" align="right" class="subheading" style="color:#303918;">Party: <?php echo $partee;?>&nbsp;</td>
</tr>
<!--<tr height="25">  
   <td width="42%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Crop: <?php echo $crp;?></td>
   <td width="34%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;Variety: <?php echo $ver;?>&nbsp;</td>
    <td width="24%" valign="middle" align="right" class="subheading" style="color:#303918;">UPS: <?php echo $txtups;?>&nbsp;</td>
</tr>-->
<tr height="25">  
   <td width="50%" valign="middle" align="left" class="subheading" style="color:#303918;">&nbsp;State: <?php echo $states;?></td>
   <td width="50%" valign="middle" align="right" class="subheading" style="color:#303918;">Location: <?php echo $loca;?>&nbsp;</td>
   
</tr>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td width="22"align="center" valign="middle" class="smalltblheading">#</td> 
	<td width="62" align="center" valign="middle" class="smalltblheading">Date</td>
    <td width="85" align="center" valign="middle" class="smalltblheading">Order No.</td>
	<td width="85" align="center" valign="middle" class="smalltblheading">PO Ref. No.</td>
	<td align="center" valign="middle" class="smalltblheading">Party Type</td>
	<td width="127" align="center" valign="middle" class="smalltblheading">Party Name</td>
	<td align="center" valign="middle" class="smalltblheading">Location</td>
	<td align="center" valign="middle" class="smalltblheading">State</td>
	<td align="center" valign="middle" class="smalltblheading">Consignee Name/Location</td>
	<td align="center" valign="middle" class="smalltblheading">Total Order Qty</td>
</tr>

<?php
$srno=1; 
$omid="";

$s="select distinct orderm_id from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and orderm_tflag=1 $sts ";

if($txtordertyp=="sales")
{
$s.=" and orderm_party_type IN ('Dealer','Bulk','Export Buyer') ";
}
else if($txtordertyp=="branch")
{
$s.=" and orderm_party_type IN ('C&F','Branch') ";
}
else if($txtordertyp=="tdf")
{
$s.=" and orderm_party_type IN ('TDF - Individual','') ";
}
else
{
$s.=" ";
}
$s.=" order by orderm_id desc ";
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
//echo $omid."<br />";
$omid1 = implode(",",array_values(array_unique(explode(",",$omid))));
$ormmid=explode(",",$omid1);
foreach($ormmid as $ormid)
{
if($ormid<>"")
{
if($txtstatesl=="ALL")
{
$s="select * from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
else
{
$s="select * from tbl_orderm where plantcode='$plantcode' and orderm_date<='$edate' and orderm_date>='$sdate' and (orderm_locstate='".$txtstatesl."' OR orderm_partystate='".$txtstatesl."' OR orderm_country='$txtstatesl') and orderm_tflag=1 and orderm_id='".$ormid."' $sts ";
}
if($txtlocationsl!="ALL")
{
	$s.=" and orderm_location='".$txtlocationsl."'";
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
	$orno=""; $party="";  $partyflg=0; $optype='';
	
	if($row_arr_home['orderm_party_type']=='Dealer' || $row_arr_home['orderm_party_type']=='Bulk' || $row_arr_home['orderm_party_type']=='Export Buyer')
	$optyp='SON';
	else if($row_arr_home['orderm_party_type']=='C&F' || $row_arr_home['orderm_party_type']=='Branch')
	$optyp='TON';
	else if($row_arr_home['orderm_party_type']=='TDF - Individual' || $row_arr_home['orderm_party_type']=='' || $row_arr_home['orderm_party_type']==' ')
	$optyp='DON';
	else
	$optyp='';
	
	
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
	
	$partytype=$row_arr_home['orderm_party_type'];
	if($partytype=="")$partytype="TDF - Individual";
	//echo $row_arr_home['orderm_consigneeapp'];
	
	$orno=$row_arr_home['orderm_porderno'];
	$porrefno=$row_arr_home['orderm_partyrefno'];
	
$ssub="select * from tbl_order_sub where orderm_id='$ormid' order by order_sub_crop, order_sub_variety";
$sql_subor=mysqli_query($link,$ssub) or die(mysqli_error($link));
$ttoott=mysqli_num_rows($sql_subor);
$flg=0; $orstatus=""; $oqty=0; $bqty=0; $upsize=""; $oqty1=""; $bqty1=""; $size1=""; $c=0; $oqt=0;
while($row_subor=mysqli_fetch_array($sql_subor))
{	
	$sqlsubsub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_arr_home['orderm_id']."' and order_sub_id='".$row_subor['order_sub_id']."' group by order_sub_sub_ups") or die(mysqli_error($link));
	while($rowsubsub=mysqli_fetch_array($sqlsubsub))
	{
		$oqty=$rowsubsub['order_sub_sub_qty'];
		$bqty=$rowsubsub['order_sub_subbal_qty'];

		if($bqty<0)	$bqty=0;
		if($row_subor['order_sub_totbal_qty']<=0)
		{$c=0;	$bqty=0;}
		
		if($oqty1!="") $oqty1=$oqty1+$oqty;
		else $oqty1=$oqty;
		
		if($bqty1!="") $bqty1=$bqty1+$bqty;
		else $bqty1=$bqty;
		
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
}
else
{
	$valoc=$txtlocationsl;
}

if($row_arr_home['orderm_party_type']=="Export Buyer")
$valoc=$row3['city'];

if($oqty<=0)$locflg++;

if($txtparty!="ALL" && $partyflg>0)
$locflg=1;

if($locflg>0) 
$flg=1;
else
$flg=0;

	$sql_mon=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$valoc."' order by productionlocation")or die(mysqli_error($link));
	$noti = mysqli_fetch_array($sql_mon);
	if($tloc=mysqli_num_rows($sql_mon) > 0)
 	$loca=$noti['productionlocation'];
	else
	$loca=$valoc;

	$quer=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_subor['order_sub_crop']."' order by cropname Asc") or die(mysqli_error($link)); 
	$noticii = mysqli_fetch_array($quer);
	$crp1=$noticii['cropname'];

	$sql_mont=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_subor['order_sub_variety']."'  order by popularname")or die(mysqli_error($link));
	$notici = mysqli_fetch_array($sql_mont);
	$ver1=$notici['popularname'];
	
	$consignee="";
	if($row_arr_home['orderm_consigneeapp']=="Yes")
	{
		$consignee=$row_arr_home['orderm_consigneename']."/".$row_arr_home['orderm_concity'];
	}
	else
	{
		$consignee=$party."/".$statee;
	}
}	

if($bqty<0)	$bqty=0;
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
    <td width="57" align="center" valign="middle" class="smalltbltext"><?php echo $partytype?></td>
	<td width="127" align="center" valign="middle" class="smalltbltext"><?php echo $party?></td>
	<td width="77" align="center" valign="middle" class="smalltbltext"><?php echo $loca;?></td>
	<td width="57" align="center" valign="middle" class="smalltbltext"><?php echo $statee;?></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $consignee;?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $oqty1;?></td>
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
    <td width="57" align="center" valign="middle" class="smalltbltext"><?php echo $partytype?></td>
	<td width="127" align="center" valign="middle" class="smalltbltext"><?php echo $party?></td>
	<td width="77" align="center" valign="middle" class="smalltbltext"><?php echo $loca;?></td>
	<td width="57" align="center" valign="middle" class="smalltbltext"><?php echo $statee;?></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $consignee;?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $oqty1;?></td>
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
?>
</table>

<br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-periodbookedorder.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtstatesl=<?php echo $_REQUEST['txtstatesl'];?>&txtlocationsl=<?php echo $_REQUEST['txtlocationsl'];?>&txtparty=<?php echo $_REQUEST['txtparty'];?>&txtordertyp=<?php echo $_REQUEST['txtordertyp'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>