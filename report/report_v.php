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
   // $role=$_SESSION['role'];
    //$role="cdinward";

if(isset($_REQUEST['id']))
	{
	$id = $_REQUEST['id'];
	}
	 //$role='eindent';
	//$status='active';
	if(isset($_POST['frm_action'])=='submit')
	{
		$name=trim($_POST['txtname']);
		$login=trim($_POST['txtId']);
		$pass=trim($_POST['txtpass']);
		$email=trim($_POST['txtemail']);
		$status=trim($_POST['txt1']);
		
		
		$query1=mysqli_query($link,"SELECT * FROM tbl_opr where name='$name' and id!='$id' and plantcode='".$plantcode."'") or die("Error: " . mysqli_error($link));
		$numofrecords1=mysqli_num_rows($query1);
		
		$query2=mysqli_query($link,"SELECT * FROM tbl_opr where login='$login' and id!='$id' and plantcode='".$plantcode."'") or die("Error: " . mysqli_error($link));
		$numofrecords2=mysqli_num_rows($query2);
		
		$query3=mysqli_query($link,"SELECT * FROM tbl_opr where email='$email' and id!='$id' and plantcode='".$plantcode."'") or die("Error: " . mysqli_error($link));
		$numofrecords3=mysqli_num_rows($query3);
		 //exit;
   		// $numofrecords=mysqli_num_rows($query);
		 //exit;
	 	 if($numofrecords1 >0 || $numofrecords2>0 || $numofrecords3>0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
	 $sql_in="update tbl_opr set 	name='$name',
											login='$login',
											pass='$pass',
											email='$email',
											status='$status'
											where id='$id'";
											//exit;
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{	
				 $sql_in1="Update tbl_user set	loginid='$login',
											password='$pass'
											where id='0'";	
										
						mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
			
								echo "<script>window.location='operator_home.php?id=$id'</script>";	
			}
}}
		
	//}
?>
		 <link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
		 
<title>Administration-Report- Viewer Report</title><table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
	
			$srno=1;
	
	
		
	$sql_sel="select * from tbl_viewer where plantcode='".$plantcode."' order by name ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_viewer WHERE plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
	
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; "> Report Viewers List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="477" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
 <td width="43" height="22" align="center" valign="middle" class="tblheading">#</td>
<td width="114" align="left" class="tblheading" valign="middle">&nbsp;Name</td>
<td width="94" align="center" class="tblheading" valign="middle"> Login ID </td>
<td width="107" align="center" class="tblheading" valign="middle">Status</td>
<td width="107" align="center" class="tblheading" valign="middle">Code</td>
 </tr>
<?php
//$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	
	 $resettargetquery=mysqli_query($link,"select * from tbl_viewer where vid='".$row['vid']."' and plantcode='".$plantcode."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
	/*$sql_p=mysqli_query($link,"select * from tblzone where dept_id=".$row['dept_id'])or die(mysqli_error($link));
  	$row_p=mysqli_fetch_array($sql_p);
	$num_p=mysqli_num_rows($sql_p);
	$sql_v=mysqli_query($link,"select * from tblregion where dept_id=".$row['dept_id'])or die(mysqli_error($link));
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
 <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo "SRV".$row['vcode'];?></td>
 </tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
 <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo "SRV".$row['vcode'];?></td>
 </tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='500' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; 
//}*/

?>
</br>
<table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>