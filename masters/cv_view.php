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
 
	if(isset($_REQUEST['pid']))
	{
		$pid = $_REQUEST['pid'];
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch TDF Print Preview</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>

</head>
<body topmargin="0" >
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
<?php

	$tid=$pid; 
	$sql_tbl=mysqli_query($link,"select * from tblvariety where varietyid='".$tid."' and actstatus='Active'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dtdf_id'];


?>  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="Dark" height="25">
	<td width="24" align="center" class="smalltblheading" valign="middle">#</td>
	<td width="107" align="left" class="smalltblheading" valign="middle"><div align="left" class="smalltblheading" style="padding:0px 5px 0px 5px;">Commercial Variety</div></td>
	<td width="107" align="left" class="smalltblheading" valign="middle"><div align="left" class="smalltblheading" style="padding:0px 5px 0px 5px;">Production Variety</div></td>
	<td width="48" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Variety Type</div></td>
	<td width="94" align="left" class="smalltblheading" valign="middle"><div align="left" class="smalltblheading" style="padding:0px 5px 0px 5px;">Crop</div></td>
	<td width="53" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Auto GOT at Arrival</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">GSRP (Months)</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Dormancy Duration (Days)</div></td> 
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">EDOR-G (Days)</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">EDOR-T (Days)</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Test Weight Gms/1000 Seed</div></td>
	<td width="81" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Blending of Inorganic Lots at Raw Stage</div></td>
	<td width="244" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">UPS (SMC)</div></td>
	<td width="50" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Status</div></td>
</tr>
<?php
$srno=1;
	$sql_v=mysqli_query($link,"select * from tblvariety where pvverid='".$row_tbl['varietyid']."' and vertype='CV' and actstatus='Active'");
	$num_v=mysqli_num_rows($sql_v);
	while($row=mysqli_fetch_array($sql_v))
	{ 
	//echo $row['cropname'];
	$sql_c=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropname']."' order by cropname asc")or die(mysqli_error($link));
	$row_c=mysqli_fetch_array($sql_c);

	

	$p_array=explode(",",$row['gm']);
	$p_array1=explode(",",$row['wtmp']);
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
				$roles=$roles.", ".$ups.$resetresult['wt']." (".$p_array1[$i]."Kgs.)";
			}
			else
			{
				$roles=$ups.$resetresult['wt']." (".$p_array1[$i]."Kgs.)";
			}
		}
		$i++;
	}
		
	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
	<td valign="middle" align="center" class="smalltbltext"><?php echo $srno?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row['popularname'];?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row_tbl['popularname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['vt'];?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row_c['cropname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['opt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['gsdis'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['dorduration'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdtt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['stlduration'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php if($row['moinlors']=="Yes"){ echo "Allowed";} else { echo "Not-allowed";}  ?></td>
	<td valign="middle" align="left" class="smalltbltext"><div align="left" class="smalltbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $roles;?></div></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['actstatus'];?></td>
</tr>
<?php
	}
	else
	{ 
?>
<tr class="Dark" height="25">
	<td valign="middle" align="center" class="smalltbltext"><?php echo $srno?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row['popularname'];?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row_tbl['popularname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['vt'];?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row_c['cropname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['opt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['gsdis'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['dorduration'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdtt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['stlduration'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php if($row['moinlors']=="Yes"){ echo "Allowed";} else { echo "Not-allowed";}  ?></td>
	<td valign="middle" align="left" class="smalltbltext"><div align="left" class="smalltbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $roles;?></div></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['actstatus'];?></td>

</tr>
<?php	
}
$srno=$srno+1;
}
//}
?>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="950">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
