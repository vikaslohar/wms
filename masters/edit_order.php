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

	
	if(isset($_REQUEST['tid']))
	{
	 $tp = $_REQUEST['tid'];
	}
	$date=trim($_POST['txtdate']);
	if(isset($_POST['frm_action'])=='submit')
	{
			 $sql_in1="Update tbl_susorderm set	
											days='$date'
											where oid='$tp'";
							if(mysqli_query($link,$sql_in1)or die(mysqli_error($link)))	
							{
	
	echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";/**/	
	}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Master- Order suspension</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<script type="text/javascript" src="../include/validation.js"></script>
<script language='javascript'>


function clk(val, val1)
{
document.from.foccode.value=val;
document.from.foccode1.value=val1;
}

function mySubmit()
{
if(document.from.txtdate.value=="")
{
alert("Please Select Date");
return false;
}
return true;
}	
	
			</script>
</head>
<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Edit Form Auto suspension </td>
</tr>
  
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
		
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_susorderm where oid='$tp'") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_susorderm");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
 if($tot_arr_home >0) { //$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrtrflag=1"),0);

$srno=1;
if($tot_arr_home > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_arr_home))
{
			
?>

<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Light" height="30">
<td width="168"  align="left" valign="middle" class="tblheading">&nbsp;Date</td>
<td width="226"  align="center" valign="middle" class="tblheading">&nbsp;<select class="tbltext" name="txtdate" style="width:120px;" >
<option value="" selected>--Select  Date--</option>
 <option value="7" <?php if($row_tbl_sub['days']=="7"){ echo "Selected";} ?> >7</option>
 <option value="8" <?php if($row_tbl_sub['days']=="8"){ echo "Selected";} ?> >8</option>
 <option value="9" <?php if($row_tbl_sub['days']=="9"){ echo "Selected";} ?> >9</option>
 <option value="10" <?php if($row_tbl_sub['days']=="10"){ echo "Selected";} ?> >10</option>
 <option value="11" <?php if($row_tbl_sub['days']=="11"){ echo "Selected";} ?> >11</option>
 <option value="12" <?php if($row_tbl_sub['days']=="12"){ echo "Selected";} ?> >12</option>
 <option value="13" <?php if($row_tbl_sub['days']=="13"){ echo "Selected";} ?> >13</option>
 <option value="14" <?php if($row_tbl_sub['days']=="14"){ echo "Selected";} ?> >14</option>
 <option value="15" <?php if($row_tbl_sub['days']=="15"){ echo "Selected";} ?> >15</option>
 <option value="16" <?php if($row_tbl_sub['days']=="16"){ echo "Selected";} ?> >16</option>
 <option value="17" <?php if($row_tbl_sub['days']=="17"){ echo "Selected";} ?> >17</option>
   <option value="18" <?php if($row_tbl_sub['days']=="18"){ echo "Selected";} ?> >18</option>
 <option value="19" <?php if($row_tbl_sub['days']=="19"){ echo "Selected";} ?> >19</option>
 <option value="20" <?php if($row_tbl_sub['days']=="20"){ echo "Selected";} ?> >20</option>
 <option value="21" <?php if($row_tbl_sub['days']=="21"){ echo "Selected";} ?> >21</option>
 <option value="22" <?php if($row_tbl_sub['days']=="22"){ echo "Selected";} ?> >22</option>
 <option value="23" <?php if($row_tbl_sub['days']=="23"){ echo "Selected";} ?> >23</option>
 <option value="24" <?php if($row_tbl_sub['days']=="24"){ echo "Selected";} ?> >24</option>
 <option value="25" <?php if($row_tbl_sub['days']=="25"){ echo "Selected";} ?> >25</option>
 <option value="26" <?php if($row_tbl_sub['days']=="26"){ echo "Selected";} ?> >26</option>
 <option value="27" <?php if($row_tbl_sub['days']=="27"){ echo "Selected";} ?> >27</option>
 <option value="28" <?php if($row_tbl_sub['days']=="28"){ echo "Selected";} ?> >28</option>
 <option value="29" <?php if($row_tbl_sub['days']=="29"){ echo "Selected";} ?> >29</option>
 <option value="30" <?php if($row_tbl_sub['days']=="30"){ echo "Selected";} ?> >30</option>
																	
	</select><font color="#FF0000">*</font></td>
</tr>


<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
<?php
}
}
}
?>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" valign="middle" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
