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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
	 $pid = $_REQUEST['itmid'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction- GOT Sample Dispatch</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form name="mainform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
	  
 <?php 
  $pid;
$sql_tbl=mysqli_query($link,"select * from tbl_gsample where gsid='$pid'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
 
$tdate=$row_tbl['gsdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">GS SLOC Updation Preview </td>
</tr>

 <tr class="Dark" height="30">
<td width="159" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="233"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="269" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="179" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>


<tr class="Light" height="30">
 

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['gscrop'];?></td>

 <?php
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

	<td align="right"  valign="middle" class="tblheading">Variety &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['gsvariety'];?></td>
          </tr>
		   <tr class="Light" height="30">
<td align="right" width="202" valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['lotno'];?>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">Existing Sloc&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['gssloc'];?></td></tr>
	<tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" class="tblheading">New SLOC</td>
  </tr>
 <tr class="Light" height="30">
<td align="right" width="202" valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<?php echo "GH".$row_tbl['gswh'];?>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['gsbin'];?></td></tr>

</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
 
  <?php
$sql_tbl=mysqli_query($link,"select * from tbl_gsample where gsid='$pid'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
/*$lot=$row_tbl['lotno'];
$lot=$row_tbl['gscrop'];
$lot=$row_tbl['gsvariety'];*/

  $wh=""; $binn=""; $slocs="";
$wh="GH"."-".$row_tbl['gswhn']."/";
$binn=$row_tbl['gsbinn'];
$slocs=$wh.$binn;

  $wh1=""; $binn1=""; $slocs1="";
$wh1="GH"."-".$wh."/";
$binn1=$bin;
$slocs1=$wh.$binn;
  
$tid=$gsid;

$tdate=$row_tbl['gsdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
?>
<tr class="tblsubtitle" height="20">
              <td width="3%" align="center" valign="middle" class="tblheading">#</td>
			 
			  <td width="7%" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="14%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="18%" align="center" valign="middle" class="tblheading">Lotno.</td>
               <td width="14%" align="center" valign="middle" class="tblheading"  >Dogs</td>
			      <td width="14%" align="center" valign="middle" class="tblheading"  > Existing SLOC</td>
				   <td width="19%" align="center" valign="middle" class="tblheading"  >New SLOC</td>
	      </tr>
  <?php
 
$srno=1;

if($srno%2!=0)
{
/*$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['gsvariety']."'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['gscrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$lot=$row_tbl['lotno'];
	
*/

  



?>
  <tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gscrop'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gsvariety'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotno'];?></td>
	  	  <td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gssloc'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
        </tr>
  <?php
}

else
{
?>
  <tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gscrop'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gsvariety'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotno'];?></td>
	  	  <td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gssloc'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
        </tr>
  <?php
}
$srno++;


?>
</table>
<br />
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
