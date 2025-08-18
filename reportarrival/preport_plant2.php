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

<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<title>Arrival-Report-Consolidated</title><table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-conso1.php?txtvisualck=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $loc;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
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
	
	$crop="ALL";	
	$vit="ALL";
	$sqltbls="select distinct lotcrop, sstage, lotvariety from tblarrival_sub where arrival_id!=0 and plantcode='".$plantcode."'";
	
	if($itemid!="ALL")
	{
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	 
	
	$sqltbls.=" and lotcrop='".$crop."' ";
	
	}
	if($loc!="ALL")
	{
	$sql_vit=mysqli_query($link,"select * from tblvariety where varietyid='".$loc."'  and vertype='PV'") or die(mysqli_error($link));
	$row_vit=mysqli_fetch_array($sql_vit);
	$vit=$row_vit['popularname'];
	$sqltbls.=" and lotvariety='".$vit."' ";
	
	}
	$sqltbls.=" group by lotcrop, lotvariety, sstage";
	//echo $sqltbls;
	$sql_tbl_s=mysqli_query($link,$sqltbls) or die(mysqli_error($link));
	$tot_arsub=mysqli_num_rows($sql_tbl_s);
	//echo $tot_arsub;
if($tot_arsub > 0)	
{
?>   	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
	<?php if($typ=="Trading"){$typ1="Trading Arrival";}
	else if($typ=="Fresh Seed with PDN"){$typ1="Fresh Seed  Arrival with PDN";}
	else if($typ=="Maize Dry Arrival"){$typ1="Arrival Maize-Dried Seed";}
	else if($typ=="StockTransfer Arrival"){$typ1="Arrival Stock Transfer-Plant";}
	else{$typ1="";}
	?>
      <td align="center" class="subheading" style="color:#303918; " colspan="3"><?php echo $typ1?>  - Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
    	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vit;?></td>
  	</tr>
	</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#F1B01E" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="31" align="center" valign="middle" class="tblheading">#</td>
			<td width="116" align="center" valign="middle" class="tblheading">Crop </td>
			<td width="185"  align="center" valign="middle" class="tblheading"> Variety </td> 
			<td width="116" align="center" valign="middle" class="tblheading">Stage </td>
			<td width="75" align="center" valign="middle" class="tblheading">Total Qty</td>
			<td width="75" align="center" valign="middle" class="tblheading">Qty: GOT-R</td>
			<td width="75" align="center" valign="middle" class="tblheading">Qty: GOT-NR</td>
</tr>

<?php 	
$srno=1; $arr_id="";
while($row_tbl_s=mysqli_fetch_array($sql_tbl_s))
{
//echo $row_tbl_s[0]."<br>";
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$row_tbl_s[0]."' and lotvariety='".$row_tbl_s[2]."' and sstage='".$row_tbl_s[1]."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
/*if($loc=="ALL")
{
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$row_tbl_s[1]."' and sstage='".$row_tbl_s[0]."'") or die(mysqli_error($link));
}
else
{
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$row_tbl_s[1]."' and sstage='".$row_tbl_s[0]."'") or die(mysqli_error($link));
}*/
$tot_sub=mysqli_num_rows($sql_tbl_sub);
if($tot_sub > 0)
{
$sqty=0; $gotrq=0; $gotnrq=0; $cnt=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($arr_id!="")
$arr_id=$arr_id.",".$row_tbl_sub['arrival_id'];
else
$arr_id=$row_tbl_sub['arrival_id'];
$sql_armain=mysqli_query($link,"select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and arrival_id='".$row_tbl_sub['arrival_id']."' and plantcode='".$plantcode."' order by arrival_date desc") or die(mysqli_error($link));
$tot_armain=mysqli_num_rows($sql_armain);
if($tot_armain > 0)
{
	$arr_id=$row_tbl_sub['arrival_id'];
	$sqty=$sqty+$row_tbl_sub['act'];
	if($row_tbl_sub['got']=="GOT-R")
	{
		$gotrq=$gotrq+$row_tbl_sub['act'];
	}
	if($row_tbl_sub['got']=="GOT-NR")
	{
		$gotnrq=$gotnrq+$row_tbl_sub['act'];
	}
	$cnt++;
}
}
if($arr_id!="")$aaaa=" and arrival_id IN ($arr_id)";
else
$aaaa="";
//echo $sql="select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 $aaaa order by arrival_date desc";
$sql_armain12=mysqli_query($link,"select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and plantcode='".$plantcode."' $aaaa order by arrival_date desc") or die(mysqli_error($link));
$tot_armain12=mysqli_num_rows($sql_armain12);
if($tot_armain12 > 0 && $cnt > 0)
{
if($srno%2 != 0)
{
?>
<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[0];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[2];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[1];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotrq;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotnrq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[0];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[2];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[1];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotrq;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotnrq;?></td>
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
  <br/>
<table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-conso1.php?txtvisualck=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $loc;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>