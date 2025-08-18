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


	if(isset($_POST['frm_action'])=='submit')
	{

$sqq="";
	
	$c1 = $_POST['form'];
	$cc = $c1;
	if($cc!="")
	$sqq=" and lotnumber like '$cc'";
	else
	echo $sqq="";
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction-Existing Lot selection</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<script language='javascript'>

function post_value()
{
opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
self.close();
}

function clk(val)
{
document.from.foccode.value=val;
}

function mySubmit()
{
if(document.from.foccode.value=="")
{
alert("You must select Lot");
return false;
}
return true;
}	
	
			</script>
</head>
<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
		</br>
<?php 

$arrlots="";
$sql_arrival=mysqli_query($link,"select arrival_id from tbl_gotqc") or die(mysqli_error($link));
$tot_arrival=mysqli_num_rows($sql_arrival);
if($tot_arrival)
{
	while($row_arrival=mysqli_fetch_array($sql_arrival))
	{
		$sql_tbl_sub=mysqli_query($link,"select * from tbl_gotqc1 where arrival_id='".$row_arrival['arrival_id']."'") or die(mysqli_error($link));
		$tot_arrsub=mysqli_num_rows($sql_tbl_sub);
		if($tot_arrsub > 0)
		{
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				if($arrlots!="")
				{
					$arrlots=$arrlots.",".$row_tbl_sub['lotno'];
				}
				else
				{
					$arrlots=$row_tbl_sub['lotno'];
				}
			}
		}	
	}
}
$qr=("select * from tbl_qctest where got='UT' and gotflg=0 ");
$sql_tbl_sub=mysqli_query($link,$qr) or die(mysqli_error($link));
 $tot_row=mysqli_num_rows($sql_tbl_sub);
?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">Select Lot </td>
</tr>
<tr class="Dark" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Lot </td>


</tr>
<?php
if($tot_row > 0)
{
$srno=1;
while ($row=mysqli_fetch_array($sql_tbl_sub))
{

if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotno'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotno'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotno'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotno'];?></td>
</tr>     
<?php
}
 $srno=$srno+1;
}
}
else
{
?>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot numbers not found reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot numbers not Imported</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number not Generated using this Crop and Variety.</td>
</tr>
<?php
}
?>
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
