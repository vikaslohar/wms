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
	
	if(isset($_POST['frm_action'])=='submit')
?>

<?php
	
		$srno=1;
	
	
	
	$sql_sel="select * from tbl_warehouse where plantcode='".$plantcode."' order by perticulars ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_warehouse WHERE plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<table width="500" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" align="center" style="border-collapse:collapse">
<tr >
<td width="610" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>

<table width="500" height="20" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                  <tr height="25" >
                    <td width="472" colspan="8" align="center" class="subheading" style="color:#303918; ">Report Ware house List (<?php echo $total_results;?>)</td>
                  </tr>
</table>
          <table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
                  <tr class="tblsubtitle" height="25">
                    <td width="53" align="center" class="tblheading" valign="middle">#</td>
                    <td width="150" align="left" class="tblheading" valign="middle">&nbsp;Warehouse Number</td>
					<td width="179" align="left" class="tblheading" valign="middle">&nbsp;Warehouse Info</td>
                    <td width="118" align="center" class="tblheading" valign="middle">Bin</td>
            </tr>
                  <?php

	while($row=mysqli_fetch_array($res))
	{
	/*$resettargetquery=mysqli_query($link,"select * from tbl_warehouse where whid='".$row['whid']."'")or die(mysqli_error($link));
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	*/
	 $sql_p=mysqli_query($link,"select * from tbl_bin where whid='".$row['whid']."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
  	 $row_p=mysqli_fetch_array($sql_p);
	$num_of_records_target_set=mysqli_num_rows($sql_p);
	 $bin_no=$num_of_records_target_set;
	 $row['whid'];
	$sql_v=mysqli_query($link,"select * from tbl_subbin where whid='".$row['whid']."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);
	//$sb=$num_v*$num_of_records_target_set;
	$sub_bin_no="0"."/".$num_v;
	if ($srno%2 != 0)
	{
	
?>
                  <tr class="Light" height="25">
                    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
                    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['perticulars'];?></td>
					<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['whdetails'];?></td>
                    <td valign="middle" class="tbltext" align="center"><?php echo $bin_no;?> </td>
                    <?php
	}
	else
	{ 
	 
?>
                  <tr class="Dark" height="25">
                    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
                    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['perticulars'];?></td>
					<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['whdetails'];?></td>
                    <td valign="middle" class="tbltext" align="center"><?php echo $bin_no;?></td>
                    <?php	}
	 $srno=$srno+1;
	}
}
//}
//}
?>
</table>
</tr>
</br>
     <table width="500" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" align="center" style="border-collapse:collapse">
<tr >
<td width="610" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
     