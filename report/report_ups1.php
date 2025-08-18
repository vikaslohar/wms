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



<title>Master-Report- Bin List</title><table width="579" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="589" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
	$srno=1;
			
		$sql_sel="select * from tblups order by ups ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblups");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	
	if($total >0) { 
	
	
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="550" style="border-collapse:collapse">
  <tr height="25" >
    <td width="643" colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" /> UPS List (<?php echo $total_results;?>)</td> </tr>
   
      
 
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="378" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="33" align="center" class="tblheading" valign="middle">#</td>
<td width="125" align="left" class="tblheading" valign="middle">&nbsp;UPS</td>
<td width="105" align="center" class="tblheading" valign="middle">UoM</td>
<td width="105" align="center" class="tblheading" valign="middle">UoM in Kgs.</td>
  </tr>
<?php
$srno=1;$ups="";
	while($row=mysqli_fetch_array($res))
	{
	 $resettargetquery=mysqli_query($link,"select * from tblups where ups='".$row['uid']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
	$ups1=$row['ups'];
	$ups2=explode(".",$ups1);
	if($ups2[1]==000)
	$ups=$ups2[0];
	else
	$ups=$ups1;
	
	//echo $ups;
	if ($srno%2!= 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $ups;?></div></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['wt']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['uom']?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $ups;?></div></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['wt']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['uom']?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
</br>
<table width="589" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="589" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
