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
	if(isset($_REQUEST['trid']))
	{
	 	$trid = $_REQUEST['trid'];
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
<title>Processing - Transaction - Lot selection</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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
	/*if(document.from.foccode.value!="" && j != document.from.nolots.value)
	{
		alert("No. of Lots selected are not matching with No. of Lot(s) to be Blending.");
		f=1;
		return false;
	}*/
	//alert(f);
	if(f==0)
	{
		//alert(document.from.foccode.value);
		opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
		//opener.document.frmaddDepartment.txtnlottom.value=j;
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


$arrlots="";
$sql_tbl_sub=mysqli_query($link,"select stouts_lotno from tbl_stouts where plantcode='".$plantcode."' and  stoutm_id='".$trid."'") or die(mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_tbl_sub);
if($tot_arrsub > 0)
{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
		if($arrlots!="")
		{
			$arrlots=$arrlots.",".$row_tbl_sub['stouts_lotno'];
		}
		else
		{
			$arrlots=$row_tbl_sub['stouts_lotno'];
		}
	}
}
	//echo $arrlots;	
	$qr="select distinct(lotldg_lotno) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='".$stage."' and lotldg_balqty > 0 and lotldg_mergerflg=0 $sss ";
	$sql_tbl_sub=mysqli_query($link,$qr) or die(mysqli_error($link));
	$tot_row=mysqli_num_rows($sql_tbl_sub);
?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
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
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where  plantcode='".$plantcode."' and lotldg_lotno='".$row[0]."' group by lotldg_subbinid, lotldg_binid order by lotldg_id asc") or die(mysqli_error($link));
$xt=mysqli_num_rows($sql_is);
while($row_is=mysqli_fetch_array($sql_is))
{ 

$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and  lotldg_lotno='".$row['lotldg_lotno']."' and lotldg_mergerflg=0 order by lotldg_id desc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1);

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_mergerflg=0  order by lotldg_id desc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	while($row_issuetbl24=mysqli_fetch_array($sql_istbl))
	{ 
		$ccnt++;
		
		if($row_issuetbl24['lotldg_sstatus']!="")
		{
			$ss=explode("/", $row_issuetbl24['lotldg_sstatus']);
			$z=count($ss);
			for($i=0; $i<$z; $i++)
			{
			if($ss[$i]=="R") $vflg++;
			}
		}
		
		if($arrlots!="")
		{
			$parray=explode(",", $arrlots);
			$ln=$row_issuetbl24['lotldg_lotno'];
			if(in_array($ln,$parray))
			$vflg++;
		}
		
		//echo $row['lotldg_lotno']." - ".$row_issuetbl24['lotldg_got1']."-".$row_issuetbl24['lotldg_qc']." - ".$row_issuetbl24['lotldg_srflg']." - ".$vflg."<BR>";
		
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
			/*if($row_issuetbl24['lotldg_got']=="Fail")
			{
				$vflg++; 
			}*/
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
			/*if($row_issuetbl24['lotldg_got']=="Fail")
			{
				$vflg++; 
			} */
		}
	}
}
}
//echo $row['lotldg_lotno']."  =  ".$ccnt."  =  ".$vflg."<br />";
if($ccnt==0)
{
	$vflg++;
}

if($vflg==0)
{ 
	$cflg++;
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
//}
if($cflg ==0)
{
?>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;No Lots available to Dispatch Stock Transfer. Reasons:</td>
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
