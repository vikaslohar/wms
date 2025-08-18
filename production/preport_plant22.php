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
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	if(isset($_REQUEST['txtcrop']))
	{
		 $itemid = $_REQUEST['txtcrop'];
		 }
		 if(isset($_REQUEST['txtvariety']))
	{
		 $loc = $_REQUEST['txtvariety'];
		 }
	//$itemid = $_REQUEST['txtcrop'];
		//$loc = $_REQUEST['txtvariety'];
		$typ = $_REQUEST['txtvisualck'];
	if(isset($_POST['frm_action'])=='submit')
	{
		
}

?>

<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<title>Viewer- Report-Consolidated</title>
<table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-conso12.php?txtvisualck=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $loc;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <?php	
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

	/*$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	*/
	$crop="ALL";	 
	if($itemid=="ALL")
	{
	$sql_arrsubcrop=mysqli_query($link,"select distinct lotcrop from tblarrival_sub where plantcode='$plantcode' order by lotcrop asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	
	$sql_arrsubcrop=mysqli_query($link,"select distinct lotcrop from tblarrival_sub where lotcrop='".$crop."' and plantcode='$plantcode' order by lotcrop asc") or die(mysqli_error($link));
	}
	$tot_arrsubcrop=mysqli_num_rows($sql_arrsubcrop);
	
	//echo $tot_arsub;
if($tot_arrsubcrop > 0)	
{
?>   	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
	<?php if($typ=="Trading"){$typ1="Trading Arrival";}
	else if($typ=="Fresh Seed with PDN"){$typ1="Fresh Seed  Arrival with PDN";}
	else{$typ1="";}
	
	?>
      <td align="center" class="subheading" style="color:#303918; " colspan="3"><?php echo $typ1?>  - Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
    	</tr>
		</table>
		
	<?php 
	$vit="ALL";
	if($loc!="ALL")
	{
		$sql_vit=mysqli_query($link,"select * from tblvariety where varietyid='".$loc."' ") or die(mysqli_error($link));
		$row_vit=mysqli_fetch_array($sql_vit);
		$vit=$row_vit['popularname'];
	}
	while($row_arrsubcrop=mysqli_fetch_array($sql_arrsubcrop))
	{
		$cnt=0;
		$sql_subvar=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$row_arrsubcrop[0]."' and plantcode='$plantcode' order by lotvariety") or die(mysqli_error($link));
		while($row_subvar=mysqli_fetch_array($sql_subvar))
		{
			$sql_arr=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_subvar['arrival_id']."' and arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and plantcode='$plantcode' order by arrival_id") or die(mysqli_error($link));
			if($tot_arr=mysqli_num_rows($sql_arr)>0)
				$cnt++;
		}
		if($cnt>0)
		{
	?>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">	
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_arrsubcrop['lotcrop'];?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vit;?></td>
  	</tr>
	</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#ef0388" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="31" align="center" valign="middle" class="tblheading">#</td>
			<td width="185"  align="center" valign="middle" class="tblheading"> Variety </td> 
			<td width="116" align="center" valign="middle" class="tblheading">Stage </td>
			<td width="75" align="center" valign="middle" class="tblheading">Total Qty</td>
			<td width="75" align="center" valign="middle" class="tblheading">Qty: GOT-R</td>
			<td width="75" align="center" valign="middle" class="tblheading">Qty: GOT-NR</td>
</tr>

<?php 
	if($loc=="ALL" && $itemid!="ALL")
		$sql_arrsubvar=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where lotcrop='".$row_arrsubcrop[0]."' and plantcode='$plantcode' group by lotvariety, sstage") or die(mysqli_error($link));
	else if($loc!="ALL" && $itemid!="ALL")
		$sql_arrsubvar=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where lotcrop='".$row_arrsubcrop[0]."' and plantcode='$plantcode' and lotvariety='".$vit."' group by lotvariety, sstage") or die(mysqli_error($link));
	else
	{
		$sql_arrsubvar=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where lotcrop='".$row_arrsubcrop[0]."' and plantcode='$plantcode' group by lotvariety, sstage") or die(mysqli_error($link));
	}
	
	//$tot_arrsubvar=mysqli_num_rows($sql_arrsubvar);
	$srno=1;// $arr_id="";
	while($row_arrsubvar=mysqli_fetch_array($sql_arrsubvar))
	{
		$totqty=0; $gotrqty=0; $gotnrqty=0;
		$sql_var=mysqli_query($link,"select * from tblarrival_sub where lotvariety='".$row_arrsubvar[1]."' and sstage='".$row_arrsubvar[0]."' and plantcode='$plantcode' order by lotvariety asc") or die(mysqli_error($link));
		while($row_var=mysqli_fetch_array($sql_var))
		{
			$sql_arrmain=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_var['arrival_id']."' and arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and plantcode='$plantcode' order by lotvariety") or die(mysqli_error($link));
			$tot_arrmain=mysqli_num_rows($sql_arrmain);
			$row_arrmain=mysqli_fetch_array($sql_arrmain);
			if($tot_arrmain>0)
			{
				$totqty=$totqty+$row_var['act'];
				if($row_var['got']=="GOT-R")
				{
					$gotrqty=$gotrqty+$row_var['act'];
				}
				if($row_var['got']=="GOT-NR")
				{
					$gotnrqty=$gotnrqty+$row_var['act'];
				}
			}
		}
if($totqty>0)
{
if($srno%2 != 0)
{
?>
<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_arrsubvar[1];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_arrsubvar[0];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotrqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotnrqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_arrsubvar[1];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_arrsubvar[0];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotrqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotnrqty;?></td>
</tr>
<?php
//echo $sqty;
}
$srno++;	
}
}
}
}
?>
</table>
<?php }?>			
  <br/>
<table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-conso12.php?txtvisualck=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $loc;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>