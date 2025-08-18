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
		/*$classification=trim($_POST['txtcla']);
		//$cropshort=strtoupper(trim($_POST['txtcropshort']));
		
	$query=mysqli_query($link,"SELECT * FROM tbl_classification where classification='$classification'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Classification is Already Present.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tblclassification(classification) values(
											  '$class'
												)";
											
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_classification.php'</script>";	
		}
		}*/
}

?>

<?php
	$srno=1;
		
	
	$sql_sel="select * from tblcrop order by cropname";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblcrop");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	
	
?><link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<table width="380" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="450" bordercolor="#4ea1e1" style="border-collapse:collapse"><tr class="tblsubtitle" height="25">
    <td colspan="7" align="center" class="subheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Crop List (<?php echo $total_results;?>)</td>
	
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="450" bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="Dark" height="25">
<td width="40" height="36" align="center" valign="middle" class="tblheading">#</td>
<td width="172" align="left" class="tblheading" valign="middle">&nbsp;Crop Name </td>
<td width="60" align="center" class="tblheading" valign="middle">&nbsp;Variety Number</td>
<td width="60" align="center" class="tblheading" valign="middle">&nbsp;SIG% (OP)</td>
<td width="60" align="center" class="tblheading" valign="middle">&nbsp;SIG% (Hybrid)</td>
<td width="80" align="center" class="tblheading" valign="middle">SM %</td>
<td width="80" align="center" class="tblheading" valign="middle">EDOR</td>
<td width="80" align="center" class="tblheading" valign="middle">Size</td>
<td width="80" align="center" class="tblheading" valign="middle">NSPRS</td>
<td width="80" align="center" class="tblheading" valign="middle">NSPRF</td>
</tr>
<?php
$srno=1;
if($total >0) { 
	while($row=mysqli_fetch_array($res))
	{
	
	/*$sql_tra=mysqli_query($link,"select * from tblvariety where varietyid=".$row['varietyid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);*/
	
	$sql_v=mysqli_query($link,"select * from tblvariety where cropname=".$row['cropid'])or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td  valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['cropname']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_v;?></td>
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig']?></td>	
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig1']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['smp']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['expdt']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['seedsize']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosior']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosiorfgt']?></td>	
</tr>
<?php
	}
	else
	{ 
?>
	<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td  valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['cropname']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_v;?></td>
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig']?></td>
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig1']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['smp']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['expdt']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['seedsize']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosior']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosiorfgt']?></td>
</tr>
  <?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
<br/>
<table width="380" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
