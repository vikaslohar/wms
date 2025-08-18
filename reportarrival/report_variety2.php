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
		 $itemid = $_REQUEST['txtcrop'];
		 $vv = $_REQUEST['txtvariety'];
	
	 if(isset($_GET['print']))
	{
	 $print = $_GET['print'];
	 if($print=='add')
	 {
	   $pr="Record Added Successfully";
	 }
		
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		
}

?>

<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<?php 

$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$vv = $_REQUEST['txtvariety'];
	
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
		
			
	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

if($_GET['txtvariety'] != 'ALL')
	 {
	 $ss = "select popularname from tblvariety where varietyid='".$_GET['txtvariety']."'  and vertype='PV'";
	 		$rr = mysqli_query($link,$ss) or die(mysqli_error($link));	 
			$ros = mysqli_fetch_array($rr);
			$cls = $ros['popularname'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }
?>
<title>Arrival-Report-Unidentified</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $cls;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			   <td width="5%" align="center" valign="middle" class="tblheading">Date</td>
			    <td width="8%" align="center" valign="middle" class="tblheading">Arrival  Type</td>
			 <td width="8%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Prelminiary Qc</td>
			              <td align="center" valign="middle" class="tblheading">Got Ststus </td>
              </tr>
<?php
$srno=1;
$sql_armain=mysqli_query($link,"select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' group by arrival_date order by arrival_date desc ") or die(mysqli_error($link));
$tot_armain+mysqli_num_rows($sql_armain);

while($row_armain=mysqli_fetch_array($sql_armain))
{
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_date='".$row_armain['arrival_date']."' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date desc ") or die(mysqli_error($link));

while($row=mysqli_fetch_array($sql_arr_home))
	{
	
		$arrival_id=$row['arrival_id'];

	if($vv=="ALL" )
	{
		$sql_cit=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_cit=mysqli_fetch_array($sql_cit);
		$cit=$row_cit['cropname'];
		
		if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotcrop='".$itemid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		else
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotcrop='".$cit."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		//$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
		$tot_arsub=mysqli_num_rows($sql_tbl_sub);
	}
	else
	{
		$sql_vit=mysqli_query($link,"select * from tblvariety where varietyid='".$vv."'  and vertype='PV'") or die(mysqli_error($link));
		$row_vit=mysqli_fetch_array($sql_vit);
		$vit=$row_vit['popularname'];
		
		$sql_cit=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_cit=mysqli_fetch_array($sql_cit);
		$cit=$row_cit['cropname'];
		
		if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotvariety='".$vv."' and lotcrop='".$itemid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		else
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotvariety='".$vit."' and lotcrop='".$cit."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		$tot_arsub=mysqli_num_rows($sql_tbl_sub);
	}

if($tot_arsub > 0)	
{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	$sqty=0; $bags=0;
	$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	 $row_sloc['bags'];
	$sqty=$sqty+$row_sloc['qty'];
	$bags=$sqty+$row_sloc['bags'];
	}

	$stage="";
	
	if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
	{
	$stage=$row['sstage'];
	}
	else
	{
	$stage=$row_tbl_sub['sstage'];
	}
	
	$variety="";
	
	if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
	{
		$sql_vt=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
		$row_vt=mysqli_fetch_array($sql_vt);
		$variety=$row_vt['popularname'];
	}
	else
	{
	$variety=$row_tbl_sub['lotvariety'];
	}
	$crop="";
	
	if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
	{
		$sql_vt=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotcrop']."'") or die(mysqli_error($link));
		$row_vt=mysqli_fetch_array($sql_vt);
		$crop=$row_vt['cropname'];
	}
	else
	{
	$crop=$row_tbl_sub['lotcrop'];
	}
	$lotno=""; $bags="";
	if($lotno!="")
	{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
	}
	else
	{
		$lotno=$row_tbl_sub['lotno'];
	}

	$tdate=$row['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
		    <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row['arrival_type']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
              <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>
         </tr>
<?php
}
else
{
?>
<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
		    <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row['arrival_type']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
              <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
          </table>			
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>