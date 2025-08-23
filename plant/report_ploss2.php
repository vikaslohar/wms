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
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$slchk = $_REQUEST['slchk'];
	$slchk2 = $_REQUEST['slchk2'];
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
?>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>Plant Manager-Report - Crop Variety wise Packing Loss Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-ploss.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
$crp="ALL"; $ver="ALL";
	$qry="select * from tbl_pnpslipmain where pnpslipmain_date <='".$edt."' and pnpslipmain_date >='".$sdt."' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$qry.=" and pnpslipmain_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
		$qry.=" and pnpslipmain_variety='$variety' ";
	}
	
	$qry.=" group by pnpslipmain_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['pnpslipmain_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp);
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
			$crop2=$crop2.",".$row312['cropid'];
			else
			$crop2=$row312['cropid'];
		}
	}
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Crop Variety wise Packing Loss Report</td>
  </tr>
  <tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;Crop:&nbsp;<?php echo $crp;?>&nbsp;&nbsp;</td>
	<td align="right" class="tblheading" style="color:#303918;">Veriety:&nbsp;<?php echo $ver;?>&nbsp;&nbsp;</td>
</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="160" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="226" align="center" valign="middle" class="tblheading">Variety</td>
	<td align="center" valign="middle" class="tblheading">Packing Machine Code</td>
	<td align="center" valign="middle" class="tblheading">Picked for Packing Qty</td>
	<td align="center" valign="middle" class="tblheading">Packing Loss</td>
	<td align="center" valign="middle" class="tblheading">Packing Loss %</td>
	<td align="center" valign="middle" class="tblheading">Pack Seed Qty</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
$crps=explode(",",$crop2);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct pnpslipmain_variety from tbl_pnpslipmain where pnpslipmain_crop='".$crval."' and pnpslipmain_date <='".$edt."' and pnpslipmain_date >='".$sdt."' and plantcode='$plantcode'";
	if($variety!="ALL")
	{	
		$qry.=" and pnpslipmain_variety='$variety' ";
	}
	
	$qry.=" group by pnpslipmain_variety";
	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['pnpslipmain_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($ver2!="")
			$ver2=$ver2.",".$row312['varietyid'];
			else
			$ver2=$row312['varietyid'];
		}
	}

	$verps=explode(",",$ver2);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$totcqty=0; $totpqty=0; $ccnt=0; $totsrqty=0; $lossper=0; $pmc="";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$verty=$row_var['popularname'];
	 	
		$sql_is=mysqli_query($link,"select pnpslipmain_id, pnpslipmain_promachcode from tbl_pnpslipmain where  pnpslipmain_crop='".$crval."' and pnpslipmain_variety='".$verval."' and pnpslipmain_date <='".$edt."' and pnpslipmain_date >='".$sdt."' and plantcode='$plantcode' order by pnpslipmain_id asc") or die(mysqli_error($link));
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_istbl=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$row_is['pnpslipmain_id']."' and plantcode='$plantcode' order by pnpslipsub_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$totcqty=$totcqty+$row_issuetbl['pnpslipsub_pickpqty']; 
					$totpqty=$totpqty+$row_issuetbl['pnpslipsub_packloss']; 
					$totsrqty=$totsrqty+$row_issuetbl['pnpslipsub_packqty']; 
					
					$ccnt++;
				}	
			}
			
			$sql_pmc=mysqli_query($link,"select * from tbl_rm_promac where promac_id='".$row_is['pnpslipmain_promachcode']."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$row_arr_pmc=mysqli_fetch_array($sql_pmc);
			$pmc=$row_arr_pmc['promac_mac'].$row_arr_pmc['promac_macid'];
		}
		$lossper=round($totpqty/$totcqty*100,2);
if($ccnt > 0)
{
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pmc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lossper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pmc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lossper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
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

<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-ploss.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>