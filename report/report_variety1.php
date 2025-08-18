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
	
	
	 if(isset($_GET['print']))
	{
	 $print = $_GET['print'];
	 if($print=='add')
	 {
	   $pr="Record Added Successfully";
	 }
	 
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
	
	
	$sql_sel="select * from tblvariety order by cropid, popularname ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblvariety");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>	
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse ">
                <tr class="tblsubtitle" height="25">
                  <td colspan="10" align="center" class="subheading">Variety List (
                      <?php echo $total_results;?>
                    )</td>
                </tr>
                <tr class="Dark" height="25">
                <td width="30" align="center" class="tblheading" valign="middle">#</td>
                <td width="160" align="left" class="tblheading" valign="middle">&nbsp;Variety Name </td>
		<td width="50" align="center" class="tblheading" valign="middle">&nbsp;Type </td>
		<td width="50" align="center" class="tblheading" valign="middle">&nbsp;Variety Type</td>
		<td width="50" align="center" class="tblheading" valign="middle">&nbsp;PV Name</td>
                <td width="150" align="left" class="tblheading" valign="middle">&nbsp;Crop</td>
		<td width="65" align="center" class="tblheading" valign="middle">Auto GOT at Arrival </td>
		<td width="297" align="center" class="tblheading" valign="middle">WB Applicable</td>	
		<td width="297" align="center" class="tblheading" valign="middle">UPS</td>
		<td width="50" align="center" class="tblheading" valign="middle">Status</td> 
                   
                </tr>
               <?php
	while($row=mysqli_fetch_array($res))
	{ 
	//echo $row['cropname'];
	$sql_c=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropname']."' order by cropname asc")or die(mysqli_error($link));
	$row_c=mysqli_fetch_array($sql_c);
	
	
	/*$sql_tra=mysqli_query($link,"select * from tblarrival where varietyid=".$row['varietyid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);*/
	
	$sql_v=mysqli_query($link,"select * from tblcrop where varietyid=".$row['varietyid'])or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);


/*$resettargetquery=mysqli_query($link,"select * from tblopr where id='".$row['help_id']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);


//$srno=1;
	while($row=mysqli_fetch_array($res))
	{*/	
	
	/*$resettargetquery=mysqli_query($link,"select * from tblups where uid='".$row['varietyid']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);*/
	
	$p_array=explode(",",$row['gm']);
			$i=0;
			$p=array();
			$roles="";
			foreach($p_array as $val)
				{
					if($val <> "")
					{
						
						$resettargetquery=mysqli_query($link,"select * from tblups where uid='".$val."'");
  						$resetresult=mysqli_fetch_array($resettargetquery);
						$ups1=$resetresult['ups'];
						$ups2=explode(".",$ups1);
						if($ups2[1]==000)
						$ups=$ups2[0];
						else
						$ups=$ups1;
						
						if($roles!="")
						{
						$roles=$roles.", ".$ups.$resetresult['wt'];
						}
						else
						{
						$roles=$ups.$resetresult['wt'];
						}
					}
				}
	$resettargetquery=mysqli_query($link,"select * from tblvariety where varietyid='".$row['pvverid']."'") or die(mysqli_error($link));
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	if($num_of_records_target_set=mysqli_num_rows($resettargetquery)==0)
	{
	$resettargetquery=mysqli_query($link,"select * from tblvariety where varietyid='".$row['varietyid']."'") or die(mysqli_error($link));
  	$resetresult=mysqli_fetch_array($resettargetquery);
	}
	// echo $row_c['cropname'];
		
	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
	<td  valign="middle" align="center" class="tbltext"><?php echo $srno?></td>
	<td valign="middle" align="left" class="tbltext">&nbsp;<?php echo $row['popularname'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $row['vt'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $row['vertype'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $resetresult['popularname'];?></td>
	<td valign="middle" align="left" class="tbltext">&nbsp;<?php echo $row_c['cropname'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $row['opt'];?></td>
	<td valign="middle" align="left" class="tbltext"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['wbtype'];?></div></td>
	<td valign="middle" align="left" class="tbltext"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $roles;?></div><
	<td valign="middle" align="center" class="tbltext"><?php echo $row['actstatus'];?></td>/td>        
</tr>
                <?php
	}
	else
	{ 
?>
<tr class="Dark" height="25">
	<td  valign="middle" align="center" class="tbltext"><?php echo $srno?></td>
	<td valign="middle" align="left" class="tbltext">&nbsp;<?php echo $row['popularname'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $row['vt'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $row['vertype'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $resetresult['popularname'];?></td>
	<td valign="middle" align="left" class="tbltext">&nbsp;<?php echo $row_c['cropname'];?></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $row['opt'];?></td>
	<td valign="middle" align="left" class="tbltext"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['wbtype'];?></div></td>
	<td valign="middle" align="left" class="tbltext"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $roles;?></div></td>
	<td valign="middle" align="center" class="tbltext"><?php echo $row['actstatus'];?></td>
</tr>
<?php	
}
$srno=$srno+1;
}
}

?>
              </table><br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
