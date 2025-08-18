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
	$srno=1;
		
	
	$sql = mysqli_query($link,"SELECT * FROM tbl_partymaser order by business_name "); 
		$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_partymaser");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	
	$total=mysqli_num_rows($sql);
	//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblcrop");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

	if($total >0) { 
	
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<table width="491" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="450" style="border-collapse:collapse">
                <tr height="25" >
                  <td colspan="8" align="center" class="subheading" style="color:#303918; ">Report Party wise List 
                    (<?php echo $total_results;?>)</td>  
                                    
                </tr>
              </table>
            <table align="center" border="1" cellspacing="0" cellpadding="0" width="491" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="61" align="center" class="tblheading" valign="middle">#</td>
    <td width="281" align="left" class="tblheading" valign="middle">&nbsp;Party Name </td>
    <td width="141" align="center" class="tblheading" valign="middle">Classification<br />    </td>
    </tr>
  <?php
//$srno=1;
	while($row=mysqli_fetch_array($sql))
	{
	
	$sql_tra1=mysqli_query($link,"select * from tblarrival where party_id='".$row['p_id']."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
  	$row_tra1=mysqli_fetch_array($sql_tra1);
	  $num_tra1=mysqli_num_rows($sql_tra1);
	
	$sql1=mysqli_query($link,"select * from tbl_orderm where orderm_party ='".$row['p_id']."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
  	$row1=mysqli_fetch_array($sql1);
	  $num=mysqli_num_rows($sql1);
	/*$sql_v=mysqli_query($link,"select * from tbl_stldg_good where stlg_trpartyid='".$row['p_id']."'")or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_of_records_target_set2 =mysqli_num_rows($sql_v);
	
	$sql_v=mysqli_query($link,"select * from tbl_stldg_damage where stld_trpartyid='".$row['p_id']."'")or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_of_records_target_set3 =mysqli_num_rows($sql_v);*/
	//echo $row['classification'];
	if ($srno%2 != 0)
	{
	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['business_name'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['business_name'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    </tr>
  <?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
<br/>
<table width="491" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="528" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>