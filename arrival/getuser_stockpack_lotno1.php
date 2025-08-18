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
	if(isset($_REQUEST['mid']))
	{
	 $mid = $_REQUEST['mid'];
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
	$sqq=" and stlotimp_lotno like '$cc'";
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
opener.document.frmaddDepartment.txtlot11.value=document.from.foccode.value;
opener.document.frmaddDepartment.txtlotnoid.value=document.from.foccode1.value;
self.close();
}

function clk(val, val1)
{
	//alert(val);
	document.from.foccode.value=val;
	document.from.foccode1.value=val1;
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
				if(document.from1.c1.value.length<14)
				{
				alert("Lot No cannot be less than 14 digits alphanumaric with special character.");
				document.from1.c1.focus();
				return false;
				}
			if(!isChar_W(document.from1.c1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(1)))
				{
					alert("Invalid Lot Number1");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(2)))
				{
					alert("Invalid Lot Number2");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(3)))
				{
					alert("Invalid Lot Number3");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(4)))
				{
					alert("Invalid Lot Number4");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(5)))
				{
					alert("Invalid Lot Number5");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(6)))
				{
					alert("Invalid Lot Number6");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.charAt(7)!="/")
				{
					alert("Invalid Lot Number7");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(8)))
				{
					alert("Invalid Lot Number8");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(9)))
				{
					alert("Invalid Lot Number9");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(10)))
				{
					alert("Invalid Lot Number10");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(11)))
				{
					alert("Invalid Lot Number11");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(12)))
				{
					alert("Invalid Lot Number12");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(13)))
				{
					alert("Invalid Lot Number13");
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
				if(document.from1.c1.value.length<14)
				{
				alert("Lot No cannot be less than 14 digits alphanumaric with special character.");
				document.from1.c1.focus();
				return false;
				}
			if(!isChar_W(document.from1.c1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(1)))
				{
					alert("Invalid Lot Number1");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(2)))
				{
					alert("Invalid Lot Number2");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(3)))
				{
					alert("Invalid Lot Number3");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(4)))
				{
					alert("Invalid Lot Number4");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(5)))
				{
					alert("Invalid Lot Number5");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(6)))
				{
					alert("Invalid Lot Number6");
					document.from1.c1.focus();
					return false;
				}
				if(document.from1.c1.value.charAt(7)!="/")
				{
					alert("Invalid Lot Number7");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(8)))
				{
					alert("Invalid Lot Number8");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(9)))
				{
					alert("Invalid Lot Number9");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(10)))
				{
					alert("Invalid Lot Number10");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(11)))
				{
					alert("Invalid Lot Number11");
					document.from1.c1.focus();
					return false;
				}
				if(isChar_W(document.from1.c1.value.charAt(12)))
				{
					alert("Invalid Lot Number12");
					document.from1.c1.focus();
					return false;
				}
				if(!isChar_W(document.from1.c1.value.charAt(13)))
				{
					alert("Invalid Lot Number13");
					document.from1.c1.focus();
					return false;
				}
				var tp=document.from1.tp.value;
				var tp1=document.from1.tp1.value;
				var txtlot1=document.from1.c1.value;
	window.location='getuser_stock_lotno.php?tp='+tp+'&add='+tp1+'&sqq='+txtlot1;
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
<!--<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Search Lot Number</td>
</tr>-->
  <tr class="Light" height="25">
<td colspan="4" align="center" valign="middle"><table border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="middle" >
 <form name="from1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
  <input type="Hidden" name="tp" value="<?php echo $tp?>" />
   <input type="Hidden" name="tp1" value="<?php echo $tp1?>" />
 <!-- <input type="text" class="tbltext" name="c1" size="20" onchange="ltchk(this.value);" onBlur="javascript:this.value=this.value.toUpperCase();" value=""  maxlength="20"/>&nbsp;<img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" />--><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();"> -->
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
		
<?php 
if($sqq!="")
{
$sss=" and stlotimps_lotno like '".$sqq."'";
}
else
$sss="";
//echo "select * from tbl_stlotimp_pack_sub where stlotimpp_balqty>0 and stlotimpp_id='".$mid."' order by stlotimpp_lotno ";
$sql_tbl_sub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpp_balqty>0 and stlotimpp_id='".$mid."' and plantcode='$plantcode' order by stlotimpp_lotno ") or die(mysqli_error($link));
$tot_arrival=mysqli_num_rows($sql_tbl_sub);
?>
<br style="line-height:5px;" />

<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="30">
  <td align="left" colspan="4" valign="middle" class="tblheading" style="vertical-align:middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Lot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/back.gif" border="0" onClick="window.close()" style="cursor:pointer;vertical-align:middle" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;vertical-align:middle" onclick="return mySubmit();"/></td>

</tr>
<tr class="Light" height="30">
<td width="43" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="195"  align="left" valign="middle" class="tblheading">&nbsp;Lot</td>
<td width="65"  align="center" valign="middle" class="tblheading">&nbsp;Qty</td>
<!--<td width="87"  align="center" valign="middle" class="tblheading">&nbsp;Dispatch Date</td>-->
</tr>
<?php
$srno=1;
while($row=mysqli_fetch_array($sql_tbl_sub))
{
/*$ct=0;
$sql_arrival=mysqli_query($link,"select arrival_id from tblarrival where arrival_type='$tp' and arrtrflag=0") or die(mysqli_error($link));
$tot_arrival=mysqli_num_rows($sql_arrival);
if($tot_arrival)
{
	while($row_arrival=mysqli_fetch_array($sql_arrival))
	{
		$sql_tbl_sub1=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_arrival['arrival_id']."'") or die(mysqli_error($link));
		$tot_arrsub=mysqli_num_rows($sql_tbl_sub1);
		if($tot_arrsub > 0)
		{
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub1))
			{
				if($row_tbl_sub['lotno']==$row['stlotimp_lotno'] && $row_tbl_sub['dc_date']==$row['stlotimp_ddate'] && $row_tbl_sub['qty']==$row['stlotimp_qty'])
				{
					$ct++;
				}
			}
		}	
	}
}*/
//echo $ct;
if($ct==0)
{

	/*$trdate=$row['stlotimp_ddate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;*/
	
	$dq=explode(".",$row['stlotimpp_balqty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row['stlotimpp_balqty'];}
//echo $row['stlotimpp_lotno'];
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['stlotimpp_lotno'];?>" onclick="clk(this.value,'<?php echo $row['stlotimp_id'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['stlotimpp_lotno'];?></td>
<td align="center"  valign="middle" class="tbltext" >&nbsp;<?php echo $dcq;?></td>
<!--<td align="center"  valign="middle" class="tbltext" >&nbsp;<?php echo $trdate;?></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['stlotimpp_lotno'];?>" onclick="clk(this.value,'<?php echo $row['stlotimp_id'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['stlotimpp_lotno'];?></td>
<td align="center"  valign="middle" class="tbltext" >&nbsp;<?php echo $dcq;?></td>
<!--<td align="center"  valign="middle" class="tbltext" >&nbsp;<?php echo $trdate;?></td>-->
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
