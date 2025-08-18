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

	if(isset($_REQUEST['tp']))
	{
	$tp = $_REQUEST['tp'];
	}
	if(isset($_REQUEST['crop']))
	{
	$crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['variety']))
	{
	$variety = $_REQUEST['variety'];
	}
	if(isset($_REQUEST['sqq']))
	{
	$sqq = $_REQUEST['sqq'];
	}
	else
	{
	$sqq="";
	}
	
	if(isset($_POST['sub']))
	{
	$c1 = $_POST['c1'];
	$cc = $c1;
	if($cc!="")
	$sqq=" and lotnumber like '$cc'";
	else
	$sqq="";
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	/*echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	*/
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction-Existing Lot selection</title>
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script type="text/javascript" src="../include/validation.js"></script>
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
function ltchk()
{
		if(document.from1.c1.value=="")
				{
					alert("Please enter Lot No.");
					document.from1.c1.focus();
					return false;
				}
			if(document.from1.c1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.from1.c1.focus();
				return false;
				}
			if(!isChar_W(document.from1.c1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(1)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(2)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(3)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(4)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(5)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
}

function lotchk()
{
		if(document.from1.c1.value=="")
				{
					alert("Please enter Lot No.");
					document.from1.c1.focus();
					return false;
				}
			if(document.from1.c1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.from1.c1.focus();
				return false;
				}
			if(!isChar_W(document.from1.c1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(1)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(2)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(3)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(4)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(5)))
				{
					alert("Invalid Lot Number");
					document.from1.c1.focus();
					return false;
				}
			var val3=document.from1.crop.value;
			var val4=document.from1.variety.value;
			var tp=document.from1.tp.value;
			var txtlot1=document.from1.c1.value;
			window.location='getuser_trading_lotno.php?crop='+val3+'&variety='+val4+'&tp='+tp+'&sqq='+txtlot1;
return true;
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
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Search Lot Number</td>
</tr>
  <tr class="Light" height="25">
<td colspan="4" align="center" valign="middle"><table border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="middle" >
 <form name="from1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
  <input type="hidden" name="crop" value="<?php echo $crop?>" />
  <input type="hidden" name="variety" value="<?php echo $variety?>" />
  <input type="Hidden" name="tp" value="<?php echo $tp?>" />
  <input type="text" class="tbltext" name="c1" size="5" onchange="ltchk(this.value);" onBlur="javascript:this.value=this.value.toUpperCase();" value=""  maxlength="6"/>&nbsp;<img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" /><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();"> -->
    </form>
 </td></tr></table>
</td>
</tr>
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
		</br>
<?php 
$arrlots="";
$sql_arrival=mysqli_query($link,"select arrival_id from tblarrival where arrival_type='$tp' and arrtrflag=0") or die(mysqli_error($link));
$tot_arrival=mysqli_num_rows($sql_arrival);
if($tot_arrival)
{
	while($row_arrival=mysqli_fetch_array($sql_arrival))
	{
		$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_arrival['arrival_id']."'") or die(mysqli_error($link));
		$tot_arrsub=mysqli_num_rows($sql_tbl_sub);
		if($tot_arrsub > 0)
		{
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				if($arrlots!="")
				{
					$arrlots=$arrlots.",".$row_tbl_sub['old'];
				}
				else
				{
					$arrlots=$row_tbl_sub['old'];
				}
			}
		}	
	}
}
//$arrlots;
/*if($arrlots=="")
{*/
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$tot_crop=mysqli_num_rows($sql_crop);
if($tot_crop > 0)
{ $crop=$row_crop['cropname'];}

//echo  $crop;
$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);
$tot_variety=mysqli_num_rows($sql_variety);
if($tot_variety > 0)
{ $variety=$row_variety['popularname'];}
//echo $variety;

if($sqq!="")
{
$sss=" and lotnumber='".$sqq."'";
}
else
$sss="";
//echo $tp;
$sql_tbl_sub=mysqli_query($link,"select * from tbllotimp where lottrtype='$tp' and lotimpflg=0 and lotcrop='$crop' and lotvariety='$variety' $sss order by lotnumber") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub);
/*}
else
{*/
?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">Select Lot </td>
</tr>
<tr class="Light" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading" style="vertical-align:middle">&nbsp;Lot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/back.gif" border="0" onClick="window.close()" align="middle" style="vertical-align:middle" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer; vertical-align:middle" onclick="return mySubmit();" align="middle"/>&nbsp;&nbsp;</td>
</tr>
<?php
if($tot_row > 0)
{
$srno=1;
//echo $arrlots;
//$sql_tbl_sub=mysqli_query($link,"select * from tbllotimp where lottrtype='$tp' and lotnumber!='$val' and lotimpflg=0") or die(mysqli_error($link));
while ($row=mysqli_fetch_array($sql_tbl_sub))
{
$ct=0;
$parray=explode(",", $arrlots);
foreach($parray as $val)
{
	if($val<>"")
	{
		if($row['lotnumber']==$val)
		{
		$ct++;
		}
	}
}
  $row['lotnumber'];
//echo $ct;
if($ct==0)
{
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotnumber'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotnumber'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotnumber'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotnumber'];?></td>
</tr>     
<?php
}
 $srno=$srno+1;
}
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
<td align="right" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
