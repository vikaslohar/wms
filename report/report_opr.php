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
	
	
	
	if(isset($_REQUEST['department_id']))
	{
	echo $department_id = $_REQUEST['department_id'];
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


<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<?php
$sql_sel="select * from tblopr where department_id='$department_id' and plantcode='".$plantcode."' order by name";
   	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	 $total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblopr where department_id='$department_id' and plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	if($total >0) { 
	
?>

<table width="450" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Operator List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="450" bordercolor="#4ea1e1" style="border-collapse:collapse ">
                <tr class="tblsubtitle" height="25">
                  <td width="130" align="center" class="tblheading" valign="middle">Operator ID </td>
<td width="187" align="left" class="tblheading" valign="middle">&nbsp;&nbsp;Name</td>
<td width="130" align="center" class="tblheading" valign="middle">Department</td>
</tr>
<?php
$sql_del=mysqli_query($link,"select max(department_id) from tblopr where department_id='$department_id' and plantcode='".$plantcode."'")or die("Error".mysqli_error($link));
 $row_del=mysqli_fetch_row($sql_del);
$code=$row_del[0];

$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	$resettargetquery=mysqli_query($link,"select * from tblopr where id='".$row['id']."' and plantcode='".$plantcode."' ");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
	$sql_p=mysqli_query($link,"SELECT * FROM tbldept where department_id='".$row['department_id']."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
  	$row_p=mysqli_fetch_array($sql_p);
 	$num_p=mysqli_num_rows($sql_p);
	
	$quer24=mysqli_query($link,"SELECT * FROM tbldestination where did='".$row['did']."' and plantcode='".$plantcode."' order by dest"); 
	$noticia24=mysqli_fetch_array($quer24);

	if($row_p['department']=="Admin")
{
$row['code']="Adm";
}
if($row_p['department']=="Arrival")
{
$row['code']="ARR";
}
else if($row_p['department']=="CSW")
{
$row['code']="CSW";
}
else if($row_p['department']=="Decode")
{
$row['code']="DEC";
}
else if($row_p['department']=="Dispatch")
{
$row['code']="DISP";
}
else if($row_p['department']=="Order Booking")
{
$row['code']="OB";
}
else if($row_p['department']=="Packaging")
{
$row['code']="PAC";
}
else if($row_p['department']=="Plant Manager")
{
$row['code']="PM";
}
else if($row_p['department']=="Processing")
{
$row['code']="PROC";
}

else if($row_p['department']=="PSW")
{
$row['code']="PSW";
}

else if($row_p['department']=="Quality")
{
$row['code']="QTY";
}
else if($row_p['department']=="RSW")
{
$row['code']="RSW";
}
else if($row_p['department']=="Sales Return")
{
$row['code']="SR";
}
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $row['code'].$srno;?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['department'];?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $row['code'].$srno;?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['department'];?></td>
                                                  </tr>
<?php	
}
$srno=$srno+1;
}
}

?>
              </table><br/>
<table width="450" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>