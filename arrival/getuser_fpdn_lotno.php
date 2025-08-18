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
	if(isset($_REQUEST['txtarr']))
	{
	 $crop = $_REQUEST['txtarr'];
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
	$sqq=" and lotnumber='$cc'";
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
				var tp=document.from1.tp.value;
				var txtlot1=document.from1.c1.value;
	window.location='getuser_fpdn_lotno.php?tp='+tp+'&sqq='+txtlot1;
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
 <input type="Hidden" name="tp" value="<?php echo $tp?>" />
  <input type="text" class="tbltext" name="c1" size="5" onchange="ltchk(this.value);" onBlur="javascript:this.value=this.value.toUpperCase();" value=""  maxlength="6"/>&nbsp;<img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" /><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();">--> 
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
$sql_arrival=mysqli_query($link,"select arrival_id from tblarrival where arrival_type='$tp' and arrtrflag=0 and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_arrival=mysqli_num_rows($sql_arrival);
if($tot_arrival)
{
	while($row_arrival=mysqli_fetch_array($sql_arrival))
	{
		$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_arrival['arrival_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
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
if($sqq!="")
{
$sss=" and lotnumber='".$sqq."'";
}
else
$sss="";

$yrcod=array();
$sql_class=mysqli_query($link,"select * from tbl_lgenyear order by lgenyearid DESC LIMIT 0,2") or die(mysqli_error($link));
while($row_class=mysqli_fetch_array($sql_class))
{
	array_push($yrcod,$row_class['lgenyearcode']);
}
//print_r($yrcod);

$sql="select * from tbllotimp where lottrtype='$tp' and lotimpflg=0 $sss order by lotnumber";
$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
?>
<!--<table align="center" cellpadding="1" cellspacing="1" border="0" width="400">
<tr >
<td align="right" valign="middle" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" style="display:inline;cursor:pointer; vertical-align:middle;" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer; vertical-align:middle;" onclick="post_value();"/></td>
</tr>
</table>-->
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td align="center" colspan="2" class="tblheading">Select Lot</td>

</tr>
<tr class="Light" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading" style="vertical-align:middle">&nbsp;Lot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/back.gif" border="0" onClick="window.close()" align="middle" style="vertical-align:middle" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer; vertical-align:middle" onclick="return mySubmit();" align="middle"/>&nbsp;&nbsp;</td>
</tr>
<?php
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
$str=str_split($row['lotnumber']);
if(!in_array($str[0],$yrcod))
{
	$ct++;
}
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
?>
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="right" valign="middle" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
