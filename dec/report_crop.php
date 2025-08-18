<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	if(isset($_REQUEST['txtclss']))
	{
	$cid = $_REQUEST['txtclss'];
	}
		if(isset($_POST['frm_action'])=='submit')
		{
		}
		
	
?>
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
<title>Report -Crop Wise Report</title>
<table width="730" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right"><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	   <input name="txtclass" value="<?php echo $cid;?>" type="hidden"> 
	    <input name="itemid" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
<?php 
	$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;

	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='$cid'") or die(mysqli_error($link));
	$row_crop=mysqli_fetch_array($sql_crop);
	$cropname=$row_crop['cropname'];
 	 
	 $sql = "select * from tblspcodes where altdate <= '$edate' and altdate >= '$sdate' and crop='$cid' ";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));	  
	
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="730" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Crop wise Report</td>
  	</tr>
  	</table>
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="730" style="border-collapse:collapse">
  <tr height="25" >
     <td align="left" class="subheading" style="color:#303918; ">&nbsp;&nbsp;Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
    <td width="380" align="right" class="subheading" style="color:#303918;" >Crop:&nbsp;<?php echo $cropname;?>&nbsp;&nbsp;</td>
  </tr>
  </table>
        <table align="center" border="1" cellspacing="0" cellpadding="0" width="730" bordercolor="#7a9931"
 style="border-collapse:collapse">
   <tr class="tblsubtitle" height="20">
     <td width="4%" align="center" valign="middle" class="tblheading">#</td>
     <td width="9%" align="center"  valign="middle" class="tblheading">Date</td>
  
     <td width="13%"align="center" valign="middle" class="tblheading">SP Code Female</td>
     <td width="13%" align="center" valign="middle" class="tblheading">SP Code Male</td>
     <td width="29%" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
     <td width="32%" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
   </tr>
<?php 
$srno=1; $cnt=0;
$t=mysqli_num_rows($rs);
while($row=mysqli_fetch_array($rs))
{ 
                $sql_class1=mysqli_query($link,"select * from tblcrop where cropid='".$row['crop']."'") or die(mysqli_error($link));
				$row_class1=mysqli_fetch_array($sql_class1);
						
	            $row0=mysqli_query($link,"select * from tblvariety where varietyid='".$row['variety']."'  and vertype='PV'") or die(mysqli_error($link));
				$row0=mysqli_fetch_array($row0);
	
	            $spcodef = $row['spcodef'];
				$spcodem = $row['spcodem'];
				$crop=$row_class1['cropname'];
				$variety=$row0['popularname'];
				$stlg_trdate=$row['altdate'];
	
			
			
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
$tot_spdec==0;
	$sql_spdec=mysqli_query($link,"select * from tblspdec where spdecid = '".$row['spdecid']."' and spdectflg='1' ") or die(mysqli_error($link));
	$tot_spdec=mysqli_num_rows($sql_spdec);
	//$row_spdec=mysqli_fetch_array($sql_spdec);	
if($tot_spdec > 0)
{
$cnt++;
if ($srno%2 != 0)
	{	
?>
   <tr class="Light" height="20">
      <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
            <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
     <td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
     <td width="32%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
   </tr>
<?php
}
else
{
?>
   <tr class="Light" height="20">
     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
            <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
     <td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
     <td width="32%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
   </tr>
<?php 
}
$srno=$srno+1;
}
}
?>
</table><br/>			
<table width="730" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right"><a href="excel-crop.php?txtclss=<?php echo $cid;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>