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
	
	
	if(isset($_REQUEST['items_id']))
	{
	$id = $_REQUEST['items_id'];
	}
	
	if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$classification=trim($_POST['txtcla']);
		//$cropshort=strtoupper(trim($_POST['txtcropshort']));
		
	$query=mysqli_query($link,"SELECT * FROM tbl_classification where classification='$classification' and plantcode='".$plantcode."'") or die("Error: " . mysqli_error($link));
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
	
		
	
	$sql_sel="select * from tblclassification where plantcode='".$plantcode."' order by classification ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblclassification WHERE plantcode='".$plantcode."' ");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<table width="550" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="271" style="border-collapse:collapse">  <tr height="25" >
   <td width="271" colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" />
    Classification List (<?php echo $total_results;?>)</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="550" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="33" align="center" class="tblheading" valign="middle">#</td>
<td width="125" align="left" class="tblheading" valign="middle">&nbsp;Classification Name</td>
<td width="105" align="center" class="tblheading" valign="middle">Party<br />
  (in nos.)</td>
  <td width="105" align="center" class="tblheading" valign="middle">Main<br />
  Category</td>
  </tr>
<?php
//$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	 $resettargetquery=mysqli_query($link,"select * from tbl_partymaser where classification='".$row['classification']."' and plantcode='".$plantcode."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
   	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	/*$sql_v=mysqli_query($link,"select * from tblvariety where cropname=".$row['cropid'])or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);
	$sql_p=mysqli_query($link,"select * from tbl_stores where items_id=".$row['items_id'])or die(mysqli_error($link));
  	$row_p=mysqli_fetch_array($sql_p);
	$num_p=mysqli_num_rows($sql_p);
	$sql_v=mysqli_query($link,"select * from tblvariety where cropid=".$row['cropid'])or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);
	$sql_tra=mysqli_query($link,"select * from tblarrival where cropid=".$row['cropid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);
	*/
	if ($srno%2!= 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['classification'];?></div></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_of_records_target_set;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['main'];?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['classification'];?></div></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_of_records_target_set;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['main'];?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
<br/>
<table width="550" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="528" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>