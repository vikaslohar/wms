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
	
	
	if(isset($_REQUEST['fid']))
	{
	 $fid = $_REQUEST['fid'];
	}
	
	if(isset($_REQUEST['department_id']))
	{
	 $department_id = $_REQUEST['department_id'];
	}	

?>

	 <?php
	
	$sql_sel="select * from tblfaq where plantcode='".$plantcode."'";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblfaq WHERE plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<table width="446" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php 
$sql_loc=mysqli_query($link,"select * from tbldept where department_id='$department_id' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_loc=mysqli_fetch_array($sql_loc); ?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; "><?php echo ucwords($row_loc['department'])?>- FAQs List </td>
  </tr>
  </table>


<table align="center" border="1" cellspacing="0" cellpadding="0" width="446" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="42" align="center" class="tblheading" valign="middle">#</td>
<td width="398" align="center" class="tblheading" valign="middle">Questions</td>
</tr>
<?php 
$srno=1;
//$sql_1=mysqli_query($link,)or die("Error:".mysqli_error($link));
	while($row=mysqli_fetch_array($res))
	{
	
	if($row['faq_role']!="")
{
			
			$p_array=explode(",",$row['faq_role']);
			$i=0;
			$p=array();
			
			foreach($p_array as $val)
				{
					if($val <> "")
					{
					if($val==$department_id)
					{ 
					?>
					<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px"><?php echo $row['faq_questions'];?></div></td>
</tr>
<?php 
					$srno++;}
					}
				}
				
}
}
}
?>
</table>
<br/>
<table width="446" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="528" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>