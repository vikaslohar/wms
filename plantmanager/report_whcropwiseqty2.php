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
	
		$txtslwhg = $_REQUEST['txtslwhg'];
		$crop = $_REQUEST['txtcrop'];
		
	$crp="ALL"; 
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
	$qry1="select Distinct lotldg_crop from tbl_lot_ldg_pack where whid='$txtslwhg' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$qry1.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	
	$qry.=" group by lotldg_crop";
	$qry1.=" group by lotldg_crop";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry1) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home2['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	$crop2="";
	$cp=explode(",",$croparr);
	sort($cp);
	for($i=0; $i<count($cp); $i++)
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($crop2!="")
		$crop2=$crop2.",".$row312['cropid'];
		else
		$crop2=$row312['cropid'];
	}
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$txtslwhg."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
?>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>Plant - Report - Warehouse wise Crop wise Quantity Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-whcropwiseqty.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtstage=<?php echo $txtstage;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="tblheading" style="color:#303918;">Warehouse wise Crop wise Quantity Report</td>
</tr>  
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;WH: <?php echo $row_whouse['perticulars'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="5%"align="center" valign="middle" class="smalltblheading">#</td> 
	<td width="13%" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php
$srno=1;  $tnob=0; $tqty=0;
if(count($crop2) > 0)
{
$cont=0; 
$tnob=0; $tqty=0;
$crps=explode(",",$crop2);
$crps=array_unique($crps);
foreach($crps as $crval)
{
if($crval<>"")
{

$crop1="";

$totnob=0; $totqty=0;

	$stage=$row_rr['lotldg_sstage'];
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	

$ccnt=0;
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_whid='".$txtslwhg."' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_whid='".$txtslwhg."' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$txtslwhg."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and plantcode='$plantcode' order by lotldg_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_istbl))
 { 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$cont++;
 }	
}
}
}

$sql_arhome1=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where  lotldg_crop='".$crval."' and whid='".$txtslwhg."' and plantcode='$plantcode' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
while($row_arhome1=mysqli_fetch_array($sql_arhome1))
{  
	$sql_is1=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where  lotldg_crop='".$crval."' and lotno='".$row_arhome1['lotno']."' and whid='".$txtslwhg."' and plantcode='$plantcode' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

	while($row_is1=mysqli_fetch_array($sql_is1))
	{ 
		$sql_is11=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is1['subbinid']."' and binid='".$row_is1['binid']."' and whid='".$txtslwhg."' and lotno='".$row_arhome1['lotno']."' and plantcode='$plantcode' order by lotdgp_id asc ") or die(mysqli_error($link));
		$row_is11=mysqli_fetch_array($sql_is11); 
		
		$sql_istbl1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is11[0]."' and balqty > 0 and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link)); 
		$t1=mysqli_num_rows($sql_istbl1);
		if($t1 > 0)
		{
			while($row_issuetbl1=mysqli_fetch_array($sql_istbl1))
			{ 
				$totqty=$totqty+$row_issuetbl1['balqty']; 
				$totnob=$totnob+$row_issuetbl1['balnomp']; 
				$cont++;
			}	
		}
	}
}

if($totqty < 0)$totqty=0;
if($totqty==0 && $totnob > 0)$totnob=0;
if($totqty > 0)
{
$tnob=$tnob+$totnob; $tqty=$tqty+$totqty;
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Total&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $tnob;?></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $tqty;?></td>
</tr>
<?php
}
?>
</table>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-whcropwiseqty.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtstage=<?php echo $txtstage;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>