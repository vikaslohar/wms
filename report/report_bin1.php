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



<title>Master-Report- Bin List</title><table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
	$srno=1;
			
	$sql_sel="select * from tbl_bin where whid='".$whid."' and plantcode='$plantcode' order by binname ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_bin where whid='".$whid."' AND plantcode='".$plantcode."' ");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	
	$sql_p=mysqli_query($link,"select * from tbl_warehouse where whid='".$whid."' and plantcode='".$plantcode."' ");
  	$row_p=mysqli_fetch_array($sql_p);
	$num_p=mysqli_num_rows($sql_p);
	
	if($total >0) { 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; "><?php echo $row_p['perticulars'];?> - Report Bin List (<?php echo $total_results;?>)</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="449" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="61" align="center" class='tblheading' valign="middle">#</td>
<td width="171" align="left" class="tblheading" valign="middle">&nbsp;Bin Number</td>
<td width="209" align="center" class="tblheading" valign="middle">Sub-Bin</td>
</tr>
<?php
//$srno=1;
	while($row=mysqli_fetch_array($res))
	{
		
	/*$resettargetquery=mysqli_query($link,"select * from tbl_bin where binid='".$row['whid']."' and plantcode='".$plantcode."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);*/
	$sql_v=mysqli_query($link,"select * from tbl_subbin where binid='".$row['binid']."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);
	$sub_bin_no=$num_v;
	/*$sql_tra=mysqli_query($link,"select * from tblarrival where cropid=".$row['cropid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);
	*/
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $sub_bin_no;?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $sub_bin_no;?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
//}
?>
</table>
</br>
<table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
