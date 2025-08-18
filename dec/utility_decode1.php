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
	
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
	if(isset($_GET['txtloc']))
	{
	 $loc = $_GET['txtloc'];
	}
	
	if(isset($_GET['txtcrop']))
	{
	  $crop= $_GET['txtcrop'];
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode -Utility -SP code Query</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

</script>

<body>
<table width="774" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
<?php 
	$loc = $_REQUEST['txtloc'];
	$crop = $_REQUEST['txtcrop'];

	 $sql = "select * from tblspcodes where spcodef='$loc' and spcodem='$crop'  order by altdate desc ";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));	  
?>
	 	 
	  
	 
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
 <input name="frm_action" value="submit" type="hidden"> 
 <input type="hidden" name="crop" value="<?php echo $crop;?>" />	 
 <input type="hidden" name="loc" value="<?php echo $loc;?>" />	<br />
 
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="774" bordercolor="#7a9931"
 style="border-collapse:collapse">
   <tr class="tblsubtitle" height="20">
     <td align="center" valign="middle" class="tblheading" colspan="16">Utility Decode</td>
   </tr>
   <tr class="tblsubtitle" height="20">
     <td width="4%" align="center" valign="middle" class="tblheading">#</td>
     <td width="9%" align="center"  valign="middle" class="tblheading">Date</td>
  
     <td width="13%"align="center" valign="middle" class="tblheading">SP Code Female</td>
     <td width="13%" align="center" valign="middle" class="tblheading">SP Code Male</td>
     <td width="29%" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
     <td width="32%" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
   </tr>
<?php 
 	
				

$srno=1;
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
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
$tot_spdec==0;
	$sql_spdec=mysqli_query($link,"select * from tblspdec where spdecid = '".$row['spdecid']."' and spdectflg='1' ") or die(mysqli_error($link));
	$tot_spdec=mysqli_num_rows($sql_spdec);
	//$row_spdec=mysqli_fetch_array($sql_spdec);	
if($tot_spdec > 0)
{

if ($srno%2 != 0)
	{	

?>


   <tr class="Light" height="20">
      <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
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
 </table>
 <br/>

</form>

		  
<table align="center" width="774" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="utility_decode.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table></td><td width="30"></td>
</tr>
</table>


</body>
</html>
