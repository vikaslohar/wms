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
	
	
	if(isset($_REQUEST['id']))
	{
	$id = $_REQUEST['id'];
	}
	if(isset($_POST['frm_action'])=='submit')
	
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<title>Master- Report-Parameters List  Report</title>
<table width="428" align="center" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="621" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
	
		$srno=1;
		
		$sql_sel="select * from tbl_parameters where plantcode='".$plantcode."' order by company_name ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_parameters WHERE plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
<?php 
$sql_param=mysqli_query($link,"select * from tbl_parameters where plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
?>	
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Parameters List </td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="428" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="164" align="left" class="tblheading"  valign="middle">&nbsp;Particulars</td>
<td width="258" align="center" class="tblheading" valign="middle">Details</td>
</tr>
<?php
//$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	/* $resettargetquery=mysqli_query($link,"select * from tbl_parameters where id='".$row['id']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
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
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company Name</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['company_name'];?></td>
</tr>

<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company Logo</td>
<td valign="middle" class="tbltext" align="center"><img src="<?php echo $row['logo']; ?>" align="middle"></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['address'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company&nbsp;Phone No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cphone'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['ccity'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;&nbsp;Pin</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cpin'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;state</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cstate'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['plant'];?></td>
</tr>


<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Phone No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pphone'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pcity'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Seed License no</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['licence_no'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;TIN</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['tin'];?></td>
</tr>

<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;CST No</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cst_no'];?></td>
</tr>
<?php
}
	else
	{ 
	?>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company Name</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['company_name'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company Logo</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['logo'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['address'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company&nbsp;Phone No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cphone'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['ccity'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['plant'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Phone</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pphno'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pcity'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Pin</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pin'];?></td>
</tr><tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;State</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['state'];?></td>
</tr>

<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Seed License no</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['licence_no'];?></td>
</tr><tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;TIN</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['tin'];?></td>
</tr>

<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;CST No</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cst_no'];?></td>
</tr>	
<?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
</br>
<table width="428" align="center" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="624" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>