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
	
		

		$sql_sel="select * from tblhelp where plantcode='".$plantcode."' order by help_title ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblhelp WHERE plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) {
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<table width="723" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="723" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="32" align="center" class="tblheading" valign="middle">#</td>
<td width="315" align="left" class="tblheading" valign="middle">&nbsp;File Title </td>
<td width="368" align="center" class="tblheading" valign="middle">Operator</td>
</tr>
<?php
$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	
	$resettargetquery=mysqli_query($link,"select * from tblopr where id='".$row['help_id']."' and plantcode='".$plantcode."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
	$p_array=explode(",",$row['help_role']);
			$i=0;
			$p=array();
			$roles="Admin";
			foreach($p_array as $val)
				{
					if($val <> "")
					{
						
						$resettargetquery=mysqli_query($link,"select * from tblopr where id='".$val."' and plantcode='".$plantcode."'");
  						$resetresult=mysqli_fetch_array($resettargetquery);
						if($roles!="")
						{
						$roles=$roles.", ".$resetresult['name'];
						}
						else
						{
						$roles=$resetresult['name'];
						}
					}
				}
	
	if ($srno%2 != 0)
	{

	
?>

<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['help_title'];?></div></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo ($roles);?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#000000"><?php echo $row['help_title'];?></div></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo ($roles);?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
<br/>
<table width="723" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="528" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>