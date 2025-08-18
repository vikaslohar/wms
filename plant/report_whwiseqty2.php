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
		$variety = $_REQUEST['txtvariety'];
		$txtstage = $_REQUEST['txtstage'];
		
	$crp="ALL"; $ver="ALL"; $stg="ALL";
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
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry1.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtstage!="ALL")
	{	
		$qry.=" and lotldg_sstage='$txtstage' ";
		$qry1.=" and lotldg_sstage='$txtstage' ";
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
<title>Rsw-ReportQuality  Based Raw Seed report</title>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-whwiseqty.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtstage=<?php echo $txtstage;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
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
	$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row312=mysqli_fetch_array($sql_crop2);
	$crop2=$row312['cropname'];	
	$sql_variety2=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
	$ttt2=mysqli_num_rows($sql_variety2);
	if($ttt2 > 0)
	{
		$rowvv2=mysqli_fetch_array($sql_variety2);
		$variety2=$rowvv2['popularname'];
	}
	else
	{
		$variety2=$variety;
	}	
?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;WH: <?php echo $row_whouse['perticulars'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Crop: <?php echo $crop2;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety2;?>&nbsp;&nbsp;|&nbsp;&nbsp;Stage: <?php echo $txtstage;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="5%"align="center" valign="middle" class="smalltblheading">#</td> 
	<td width="13%" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="18%" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">Stage</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">NoB/NoMP</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php
$srno=1; $tnob=0; $tqty=0;

$crop1=""; $variety1=""; $stage="";
if($txtstage!="ALL")
{
	$sql_rrrr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_sstage='".$txtstage."' and lotldg_whid='".$txtslwhg."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));
	$sql_rrrr1=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_sstage='".$txtstage."' and lotldg_whid='".$txtslwhg."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));
}
else
{
	$sql_rrrr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));
	$sql_rrrr1=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));
}
$vert="";
$tot_rrrr=mysqli_num_rows($sql_rrrr);
while($row_rrrr=mysqli_fetch_array($sql_rrrr))
{
	if($vert!="")
	$vert=$vert.",".$row_rrrr['lotldg_variety'];
	else
	$vert=$row_rrrr['lotldg_variety'];
}
$tot_rrrr1=mysqli_num_rows($sql_rrrr1);
while($row_rrrr1=mysqli_fetch_array($sql_rrrr1))
{
	if($vert!="")
	$vert=$vert.",".$row_rrrr1['lotldg_variety'];
	else
	$vert=$row_rrrr1['lotldg_variety'];
}

$verps=explode(",",$vert);
$verps=array_unique($verps);
foreach($verps as $verrval)
{
if($verrval<>"")
{

$stage="";
if($txtstage!="ALL")
{
	$sql_rr=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verrval."' and lotldg_sstage='".$txtstage."' and lotldg_whid='".$txtslwhg."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));
}
else
{
	$sql_rr=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verrval."' and lotldg_whid='".$txtslwhg."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{
	$totnob=0; $totqty=0;

	$stage=$row_rr['lotldg_sstage'];
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$verrval."'") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety1=$rowvv['popularname'];
	}
	else
	{
		$variety1=$verrval;
	}
	$ccnt=0;
	$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verrval."' and lotldg_sstage='".$row_rr['lotldg_sstage']."' and lotldg_whid='".$txtslwhg."' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
	{  
		$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verrval."' and lotldg_sstage='".$row_rr['lotldg_sstage']."' and lotldg_whid='".$txtslwhg."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
	
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$txtslwhg."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='".$row_rr['lotldg_sstage']."' and plantcode='$plantcode' order by lotldg_id asc ") or die(mysqli_error($link));
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
//}
$totnob=0; $totqty=0;
//$stage="Pack";
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
$crop1=$row31['cropname'];	
$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$verrval."'") or die(mysqli_error($link));
$ttt=mysqli_num_rows($sql_variety);
if($ttt > 0)
{
	$rowvv=mysqli_fetch_array($sql_variety);
	$variety1=$rowvv['popularname'];
}
else
{
	$variety1=$verrval;
}
$ccnt=0;
$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verrval."' and whid='".$txtslwhg."' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where  lotldg_crop='".$crval."' and lotldg_variety='".$verrval."' and whid='".$txtslwhg."' and lotno='".$row_arhome['lotno']."' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));

	while($row_is=mysqli_fetch_array($sql_is))
	{ 
		$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$txtslwhg."' and lotno='".$row_arhome['lotno']."' and plantcode='$plantcode' order by lotdgp_id asc ") or die(mysqli_error($link));
		$row_is1=mysqli_fetch_array($sql_is1); 
		
		$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty > 0 and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
		$t=mysqli_num_rows($sql_istbl);
		if($t > 0)
		{
			while($row_issuetbl=mysqli_fetch_array($sql_istbl))
			{ 
				$totqty=$totqty+$row_issuetbl['balqty']; 
				$totnob=$totnob+$row_issuetbl['balnomp']; 
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo "Pack";?></td>
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo "Pack";?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
//}
if($tqty>0)
{
?>
<tr class="Light">
	<td align="right" valign="middle" class="smalltblheading" colspan="4">Total&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $crop1;?>&nbsp;&nbsp;</td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $tnob;?></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $tqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltblheading" colspan="6">No Records Found</td>
</tr>
<?php
}
?>	
</table>	
<?php
//}
}
}
}
?>	
  <br/>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-whwiseqty.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtstage=<?php echo $txtstage;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>