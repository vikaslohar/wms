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
<title>Quality- Transaction-Existing Lot selection</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
<script language='javascript'>

function post_value()
{
	opener.document.frmaddDepartment.txtlot1.value=document.from.foccode1.value;
	opener.document.frmaddDepartment.txtlot2.value=document.from.foccode.value;
	self.close();
}

function clk(val)
{
document.from.foccode.value=val;
}

function slocshow()
{
	if(document.from1.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		//document.from1.txtlot2.value="";
		document.from1.stcode.value="00000";
		return false;
	}
}

function ycodchk()
{
		document.from1.txtlot2.value="";
		document.from1.stcode.value="00000";
}

function lot2chk()
{
	if(document.from1.ycodee.value=="")
	{
		alert("Invalid Lot Number");
		document.from1.txtlot2.value="";
		document.from1.stcode.value="00000";
		return false;
	}
	else
	{
		document.from1.stcode.value="00000";
	}
}
function lotchk()
{	
	val2=document.from1.ycodee.value;
	val5=document.from1.txtlot2.value;
	val6=document.from1.stcode.value;
	val7=document.from1.pcode.value;
	val8=document.from1.stcode2.value;
	var f=0;
	if(val7=="")
	{
		alert("Please Select Plant code");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	} 
	if(val8=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val8.length < 2)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	}
	if(f==1)
	{
	return false;
	}
	else
	{
	val3=document.from1.crop.value;
	val4=document.from1.variety.value;
	val2=document.from1.ycodee.value;
	val5=document.from1.txtlot2.value;
	val6=document.from1.stcode.value;
	val7=document.from1.pcode.value;
	val8=document.from1.stcode2.value;
	var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
	window.location='getuser_utility_lotno.php?crop='+val3+'&variety='+val4+'&sqq='+txtlot1;
	return true;	
	}
}	


function mySubmit()
{
	var cnt=0;
	document.from.foccode.value ="";
	document.from.foccode1.value ="";
	if(document.from.srno.value>2)
	{
		for (var i = 0; i < document.from.loc.length; i++) 
		{          
			if(document.from.loc[i].checked == true)
			{
				cnt++;
				if(document.from.foccode.value =="")
				{
					document.from.foccode.value=document.from.loc[i].value;
				}
				else
				{
					document.from.foccode.value = document.from.foccode.value +','+document.from.loc[i].value;
				}
				if(document.from.foccode1.value =="")
				{
					document.from.foccode1.value=document.from.smpno[i].value;
				}
				else
				{
					document.from.foccode1.value = document.from.foccode1.value +','+document.from.smpno[i].value;
				}
			}
		}
	}
	else
	{
		if(document.from.loc.checked == true)
		{
			cnt++;
			if(document.from.foccode.value =="")
			{
				document.from.foccode.value=document.from.loc.value;
			}
			else
			{
				document.from.foccode.value = document.from.foccode.value +','+document.from.loc.value;
			}
			if(document.from.foccode1.value =="")
			{
				document.from.foccode1.value=document.from.smpno.value;
			}
			else
			{
				document.from.foccode1.value = document.from.foccode1.value +','+document.from.smpno.value;
			}
		}
	}
	if(document.from.foccode.value=="")
	{
		alert("You must select Lots");
		return false;
	}
return true;
}	
	
			</script>
</head>
<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >

  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
		
<?php 
$qr="select * from tbl_gottest where gottest_crop='".$crop."' and gottest_variety='".$variety."' group by gottest_sampleno, yearid order by gottest_oldlot ASC";
$sql_tbl_sub=mysqli_query($link,$qr) or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub);
?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Lot </td>
</tr>
<tr class="Dark" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;LOT</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Sample No.</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Stage</td>

</tr>
<?php
if($tot_row > 0)
{
$srno=1;
while ($row=mysqli_fetch_array($sql_tbl_sub))
{
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$gottest_trstage=$row['gottest_trstage'];

$lots=str_split($row['gottest_lotno']);
//print_r($lots);
//echo "<br />";
$lotstage=$lots[16];

if($gottest_trstage=="")
{
if($lotstage=="C"){$gottest_trstage="Condition";}
else if($lotstage=="P"){$gottest_trstage="Pack";}
else {$gottest_trstage="Raw";}
}

$tp1=$row['plantcode'];
$qc1=$row['gottest_sampleno'];
$sampno=$tp1.$row['yearid'].sprintf("%000006d",$qc1);
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" value="<?php echo $row['gottest_tid'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['gottest_oldlot'];?></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $sampno;?><input type="hidden" name="smpno" value="<?php echo $row['gottest_oldlot'];?>" /></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $gottest_trstage;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" value="<?php echo $row['gottest_tid'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['gottest_oldlot'];?></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $sampno;?><input type="hidden" name="smpno" value="<?php echo $row['gottest_oldlot'];?>" /></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $gottest_trstage;?></td>
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
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
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
