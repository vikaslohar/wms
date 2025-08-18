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
@page {size:landscape;}
</style>
<script language='javascript'>

function post_value()
{
opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
opener.document.frmaddDepartment.qcrsl.value=document.from.foccode1.value;
opener.document.frmaddDepartment.gotrsl.value=document.from.foccode2.value;
if(document.from.foccode1.value!="OK" && document.from.foccode1.value!="NT")
{
//window.opener.document.frmaddDepartment.txt14.checked=true;
window.opener.document.frmaddDepartment.txt14.disabled=true;
}
if(document.from.foccode2.value!="OK" && document.from.foccode2.value!="NT")
{
//opener.document.frmaddDepartment.txt16.checked=true;
opener.document.frmaddDepartment.txt16.disabled="disabled";
}
window.opener.showrec();
self.close();
}

function clk(val,val1,val2)
{
document.from.foccode.value=val;
document.from.foccode1.value=val1;
document.from.foccode2.value=val2;
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
	window.location='getuser_trading_lotno.php?crop='+val3+'&variety='+val4+'&sqq='+txtlot1;
	return true;	
	}
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
  <td valign="middle" class="tbltext" >
 <form name="from1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="lotchk();" >
 <input type="hidden" name="crop" value="<?php echo $crop?>" />
  <input type="hidden" name="variety" value="<?php echo $variety?>" />
 
   <?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters  order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>
  <select class="tbltext" name="pcode" style="width:40px;">
    <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" selected="selected" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00" />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" /><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();"> -->
    </form>
 </td></tr></table>
</td>
</tr>
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
		</br>
 <?php 
if($sqq!="")
{
$sss=" and orlot='".$sqq."'";
}
else
$sss="";
 
$arrlots="";
$sql_arrival=mysqli_query($link,"select arrival_id from tbl_qcgen where  arrtrflag=0") or die(mysqli_error($link));
$tot_arrival=mysqli_num_rows($sql_arrival);
if($tot_arrival)
{
	while($row_arrival=mysqli_fetch_array($sql_arrival))
	{ $row_arrival['arrival_id'];
		$sql_tbl_sub=mysqli_query($link,"select * from tbl_qcgen1 where arrival_id='".$row_arrival['arrival_id']."'and stage='$tp'") or die(mysqli_error($link));
		 $tot_arrsub=mysqli_num_rows($sql_tbl_sub);
		if($tot_arrsub > 0)
		{
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				if($arrlots!="")
				{
					$arrlots=$arrlots.",".$row_tbl_sub['oldlot'];
				}
				else
				{
					   $arrlots=$row_tbl_sub['oldlot'];
				}
			}
		}	
	}
}
 $tp;
$sql_tbl_sub=mysqli_query($link,"select distinct(orlot), lotldg_qc, lotldg_got from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_balqty > 0 and (lotldg_qc!='OK' or lotldg_qc!='NUT' or lotldg_qc!='Fail') $sss")or die(mysqli_error($link));
$ct1=mysqli_num_rows($sql_tbl_sub);
?>		
		<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<?php
if($ct1 > 0)
{
?>		
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">Select Lot </td>
</tr>
<tr class="Dark" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Lot </td>


</tr>
<?php
$srno=1;
while ($row=mysqli_fetch_array($sql_tbl_sub))
{
//echo $row['lotldg_got'];
$ct=0;
$parray=explode(",", $arrlots);
foreach($parray as $val)
{
	if($val<>"")
	{
		if($row['orlot']==$val)
		{
		$ct++;
		}
	}
}

//echo $ct;

 
if($ct==0)
{
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['orlot'];?>" onclick="clk(this.value,'<?php echo $row['lotldg_qc'];?>','<?php echo $row['lotldg_got'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo  $row['orlot'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['orlot'];?>" onclick="clk(this.value,'<?php echo $row['lotldg_qc'];?>','<?php echo $row['lotldg_got'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo  $row['orlot'];?></td>
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
<input type="hidden" name="foccode2" value="" />
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
