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
	if(isset($_REQUEST['stage']))
	{
	 $stage = $_REQUEST['stage'];
	}
	if(isset($_REQUEST['nolots']))
	{
	 $nolots = $_REQUEST['nolots'];
	}
	
	if($stage=="Raw")
	{ $cd="R";}
	else if($stage=="Condition")
	{ $cd="C";}
	else
	{ $cd="R";}


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
<title>Plant - Transaction - Lot selection</title>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script type="text/javascript" src="../include/validation.js"></script>
<script language='javascript'>

function post_value()
{
	var f=0; var j=0;
	document.from.foccode.value="";
	if(document.from.srno.value > 0)
	{
		if(document.from.srno.value <= 2)
		{
			if(document.from.loc.checked == true)
			{  j++;
				if(document.from.foccode.value =="")
				{
					document.from.foccode.value=document.from.loc.value;
				}
				else
				{
					document.from.foccode.value = document.from.foccode.value +','+document.from.loc.value;
				}
			}
		}
		else
		{ 
			for (var i = 0; i < document.from.loc.length; i++) 
			{          
				if(document.from.loc[i].checked == true)
				{ j++;
					if(document.from.foccode.value =="")
					{
					document.from.foccode.value=document.from.loc[i].value;
					}
					else
					{
					document.from.foccode.value = document.from.foccode.value +','+document.from.loc[i].value;
					}
				}
			}
		}
	}
	if(document.from.foccode.value=="")
	{
		alert("Please Select Lots.");
		f=1;
		return false;
	}
	//alert(j);
	if(document.from.foccode.value!="" && j != document.from.nolots.value)
	{
		alert("No. of Lots selected are not matching with No. of Lot(s) to be Merged.");
		f=1;
		return false;
	}
	//alert(f);
	if(f==0)
	{
		//alert(document.from.foccode.value);
		opener.document.frmaddDept.txtlot1.value=document.from.foccode.value;
		opener.getdetails();
		self.close();
	}
	else
	{
		return false;
	}
}

function clk(val)
{
document.from.foccode.value=val;
}
/*
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
}*/
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
<?php /*
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Search Lot Number</td>
</tr>
  <tr class="Light" height="25">
<td colspan="4" align="center" valign="middle"><table border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="middle" >
 <form name="from1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="lotchk();" >
 <input type="hidden" name="crop" value="<?php echo $crop?>" />
  <input type="hidden" name="variety" value="<?php echo $variety?>" />
  <input type="hidden" name="stage" value="<?php echo $stage?>" />
 
   <?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>
  <select class="tbltext" name="pcode" style="width:40px;">
    <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" />
	   </select>&nbsp;<b><?php echo $cd;?></b>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" /><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();"> -->
    </form>
 </td></tr></table>
 </td></tr>
 */
 ?>
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	  <input type="hidden" name="cnt" value="0" />
	  <input type="Hidden" name="nolots" value="<?php echo $nolots?>" />
		</br>
<?php 

if($sqq!="")
{
$sss=" and orlot='".$sqq."'";
}
else
$sss="";
$qr="select distinct(lotldg_lotno) from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='".$stage."' and lotldg_balqty > 0 $sss and plantcode='$plantcode'";
$sql_tbl_sub=mysqli_query($link,$qr) or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub);
?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
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
$srno=1; $cflg=0;
while ($row=mysqli_fetch_array($sql_tbl_sub))
{

$vflg=0; $ccnt=0;
$zz=str_split($row['lotldg_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000")$vflg++;

//print_r($zz);
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row['lotldg_lotno']."'  and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$row['lotldg_lotno']."' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
while($row_issuetbl24=mysqli_fetch_array($sql_istbl))
{ 
$ccnt++;

if($row_issuetbl24['lotldg_sstage']=="Raw")
{
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_variety);
	if($row_variety['moinlors']=="No")
	{
		$sql_arrsub=mysqli_query($link,"Select * from tblarrival_sub where lotno='".$row['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$row_arrsub=mysqli_fetch_array($sql_arrsub);
		if($row_arrsub['prodtype']=="Inorganic" || $row_arrsub['prodtype']=='NULL' || $row_arrsub['prodtype']=="")$vflg++;
	}
}


if($row_issuetbl24['lotldg_sstatus']!="")
{
	$ss=explode("/", $row_issuetbl24['lotldg_sstatus']);
	$z=count($ss);
	for($i=0; $i<$z; $i++)
	{
	if($ss[$i]=="R") $flg++;
	}
}
//echo $row_issuetbl24['lotldg_got1']."<BR>";

$zz=explode(" ", $row_issuetbl24['lotldg_got1']);

if($zz[0]=="GOT-NR")
{
	/*if(($row['lotldg_got']=="UT" || $row['lotldg_got']=="RT") && $row['lotldg_srflg']==0)
	{
		$vflg++; 
	}*/
	if(($row_issuetbl24['lotldg_qc']=="UT" || $row_issuetbl24['lotldg_qc']=="RT") && $row_issuetbl24['lotldg_srflg']==0)
	{
		$vflg++; 
	}
	if($row_issuetbl24['lotldg_got']=="Fail" || $row_issuetbl24['lotldg_qc']=="Fail")
	{
		$vflg++; 
	}
}
else
{
	if(($row_issuetbl24['lotldg_got']=="UT" || $row_issuetbl24['lotldg_got']=="RT") && $row_issuetbl24['lotldg_srflg']==0)
	{
		$vflg++; 
	}
	if($row_issuetbl24['lotldg_got']=="OK" && ($row_issuetbl24['lotldg_qc']=="UT" || $row_issuetbl24['lotldg_qc']=="RT") && $row_issuetbl24['lotldg_srflg']==0)
	{
		$vflg++; 
	}
	if($row_issuetbl24['lotldg_got']=="Fail" || $row_issuetbl24['lotldg_qc']=="Fail")
	{
		$vflg++; 
	} 
}
}
}
}
if($ccnt==0)
{
$vflg++;
}
if($vflg==0)
{ $cflg++;
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" value="<?php echo $row['lotldg_lotno'];?>" onclick="clk(this.value,'<?php echo $row['lotldg_lotno'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotldg_lotno'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" value="<?php echo $row['lotldg_lotno'];?>" onclick="clk(this.value,'<?php echo $row['lotldg_lotno'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotldg_lotno'];?></td>
</tr>     
<?php
}
 $srno=$srno+1;
} 
}
}
if($cflg ==0)
{
?>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;No Lots available to Merge. Reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lots having QC or GOT status FAIL</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lots not havinf Soft / Super Soft Release status.</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;3. No Lots present under selected Crop and Variety.</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;4. Lots having tag Inorganic.</td>
</tr>
<?php
}
?>
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
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
