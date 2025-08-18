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
	
	if(isset($_REQUEST['whid']))
	{
    $whid = $_REQUEST['whid'];
	}
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />



<title>Master-Report- Location Master</title><table width="550" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse"  align="center">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
	if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;} 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
	$sql_sel="select * from tblproductionlocation where plantcode='".$plantcode."' order by state, productionlocation ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblproductionlocation WHERE plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
	
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="550" bordercolor="#4ea1e1" style="border-collapse:collapse"><tr class="tblsubtitle" height="20">
   <td colspan="7" align="center" class="subheading">Location List (<?php echo $total_results;?>)</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="43" align="center" class="tblheading" valign="middle">#</td>
<td width="199" align="left" class="tblheading" valign="middle">&nbsp;Location</td>
<td width="99" align="center" class="tblheading" valign="middle">State</td>

</tr>
<?php

	while($row=mysqli_fetch_array($res))
	{
	
	$sql_f=mysqli_query($link,"select *  from tblproductionlocation where productionlocation='".$row['productionlocationid']."' and plantcode='".$plantcode."'");
  	$result_f=mysqli_fetch_array($sql_f);
   $num_of_farmers=mysqli_num_rows($sql_f);
	
	
	$sql_v=mysqli_query($link,"select * from tbl_partymaser where location_id =".$row['productionlocationid'])or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	 $num_v=mysqli_num_rows($sql_v);
	/*$sql_tra=mysqli_query($link,"select * from tblarrival where productionlocationid=".$row['productionlocationid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);
	
	$sql_tra1=mysqli_query($link,"select * from tblissue where productionlocationid='".$row['productionlocationid']."'")or die(mysqli_error($link));
  	$row_tra1=mysqli_fetch_array($sql_tra1);
	$num_tra1=mysqli_num_rows($sql_tra1);*/
	
	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['productionlocation']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['state']?></td>
</tr>
	<?php
	} 
	else
	{
	?>

<tr class="Dark" height="25">
<td  valign="middle" align="center" class="tbltext"><?php echo $srno?></td>
<td valign="middle" align="left" class="tbltext">&nbsp;<?php echo $row['productionlocation']?></td>
<td valign="middle" align="center" class="tbltext"><?php echo $row['state']?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
</br>
<table width="550" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
