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

	if(isset($_POST['frm_action'])=='submit')
	{
	}

?>

<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />
<?php 
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
	
	$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
		
			
	$crp="ALL"; $ver="ALL";
		
	$sql_arr_home=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 order by arrival_date asc ") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	if($txtcrop!="ALL")
	{
		$qry_crop=mysqli_query($link,"select cropname from tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($qry_crop);
		$crp=$row_crop['cropname'];
	}
	if($txtvariety!="ALL")
	{
		$qry_ver=mysqli_query($link,"select popularname from tblvariety where varietyid='$txtvariety' order by popularname Asc") or die(mysqli_error($link));
		$row_ver=mysqli_fetch_array($qry_ver);
		$ver=$row_ver['popularname'];
	}
?>
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<title>Drying - Report - Cob Arrival Report</title><table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel_dryarr.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Cob Arrival Report</td>
  	</tr> 
 <tr height="25" >
      <td align="left" class="subheading" style="color:#303918; " width="34%" >
       Peroid From 
       <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
	    <td align="center" class="subheading" style="color:#303918; " width="33%" >Crop: <?php echo $crp;?>
		<td align="right" class="subheading" style="color:#303918; " width="33%" >Variety: <?php echo $ver;?>
  	</tr>
	
</table>
  
<table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#ef0388" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="20" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="57" align="center" valign="middle" class="tblheading" rowspan="2" >Date of Arrival </td>
	<td width="69"  align="center" valign="middle" class="tblheading" rowspan="2" >Crop</td>
	<td width="68" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td width="62" align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
	<td width="117"  align="center" valign="middle" class="tblheading" colspan="2" >Cob Arrival</td>
	<td width="51"  align="center" valign="middle" class="tblheading" colspan="2" >After Drying</td>
	<td align="center" valign="middle" class="tblheading" rowspan="2" >GOT Status</td>
	<td width="53" align="center" valign="middle" class="tblheading" rowspan="2">Production Personnel</td>
	<td width="79" rowspan="2" align="center" valign="middle" class="tblheading">Organiser</td>
	<td width="67" align="center" valign="middle" class="tblheading"rowspan="2" >Farmer</td>
	<td width="65" align="center" valign="middle" class="tblheading"rowspan="2" >Production Location</td>
	<td width="35" align="center" valign="middle" class="tblheading" rowspan="2">State</td>
</tr>
<tr class="tblsubtitle">
	<td align="center" valign="middle" class="tblheading">NoB</td>
	<td align="center" valign="middle" class="tblheading">Qty</td>
	<td align="center" valign="middle" class="tblheading">NoB</td>
	<td align="center" valign="middle" class="tblheading">Qty</td>
</tr>

<?php

$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	$sql="select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' ";
	if($txtcrop!="ALL")
	{
		$sql.=" and lotcrop='".$crp."'";
	}
	if($txtvariety!="ALL")
	{
		$sql.=" and lotvariety='".$ver."'";
	}
	$sql.=" order by lotcrop asc, lotvariety asc";
	//echo $sql;
	
	$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
	$farm="";$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $bags2=""; $qty2=""; $stage=""; $got=""; $qc="";$moist=""; $org=""; $pp=""; $pp1=""; $pp12="";$trdate1=""; $p=""; $stnno1="";
	
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate1!="") { $trdate1=$trdate1."<br>".$trdate; } else { $trdate1=$trdate; }	
	
	$aq=explode(".",$row_tbl_sub['act']);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
	
	$an=explode(".",$row_tbl_sub['act1']);
	if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
	if($ac>0 && $acn==0)$acn=1;
		
	if($crop!="") { $crop=$crop."<br>".$row_tbl_sub['lotcrop']; } else { $crop=$row_tbl_sub['lotcrop']; }
	if($variety!="") { $variety=$variety."<br>".$row_tbl_sub['lotvariety']; } else { $variety=$row_tbl_sub['lotvariety']; }
	if($lotno!="") { $lotno=$lotno."<br>".$row_tbl_sub['lotno']; } else { $lotno=$row_tbl_sub['lotno']; }
	if($bags!="") { $bags=$bags."<br>".$acn; } else { $bags=$acn; } 
	if($qty!="") { $qty=$qty."<br>".$ac; } else { $qty=$ac; }
	if($got!="") { $got=$got."<br>".$row_tbl_sub['got1']; } else { $got=$row_tbl_sub['got1']; }
	if($stage!="") { $stage=$stage."<br>".$row_tbl_sub['lotstate']; } else { $stage=$row_tbl_sub['lotstate']; }
	if($moist!="") { $moist=$moist."<br>".$row_tbl_sub['ploc']; } else { $moist=$row_tbl_sub['ploc']; }
	if($org!="") { $org=$org."<br>".$row_tbl_sub['organiser']; } else { $org=$row_tbl_sub['organiser']; }
	if($pp12!="") { $pp12=$pp12."<br>".$row_tbl_sub['pper']; } else { $pp12=$row_tbl_sub['pper']; }
	if($farm!="") { $farm=$farm."<br>".$row_tbl_sub['farmer']; } else { $farm=$row_tbl_sub['farmer']; }
	
	$qry_cobdry=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));
	$row_cobdry=mysqli_fetch_array($qry_cobdry);
	
	$aq=explode(".",$row_cobdry['qty1']);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_cobdry['qty1'];}
	
	$an=explode(".",$row_cobdry['nob1']);
	if($an[1]==000){$acn=$an[0];}else{$acn=$row_cobdry['nob1'];}
	if($ac>0 && $acn==0)$acn=1;
	
	if($bags2!="") { $bags2=$bags2."<br>".$acn; } else { $bags2=$acn; } 
	if($qty2!="") { $qty2=$qty2."<br>".$ac; } else { $qty2=$ac; }
	
if($srno%2!=0)
{
?>			  
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $trdate1;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $variety;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $lotno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bags;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bags2;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty2;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $got;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pp12;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $org;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $farm;?> </td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $stage;?> </td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $trdate1;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $variety;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $lotno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bags;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bags2;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty2;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $got;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pp12;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $org;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $farm;?> </td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $stage;?> </td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
else
{
?>
<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="16">Record not found</td>
</tr>
<?php
}
?>
</table><br/>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel_dryarr.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $_REQUEST['txtcrop'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>