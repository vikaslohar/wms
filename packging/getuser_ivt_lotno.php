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
	$tid = $_REQUEST['tp'];
	}
	if(isset($_REQUEST['crop']))
	{
	 $crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['frvariety']))
	{
	 $variety = $_REQUEST['frvariety'];
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
<title>Packaging - Transaction - Lot selection</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script type="text/javascript" src="../include/validation.js"></script>
<script language='javascript'>
function post_value()
{//alert(document.from.foccode.value);
	opener.document.frmaddDept.txtlot1.value=document.from.foccode.value;
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
<?php 
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
//echo "select distinct(lotldg_lotno) from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='Condition' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_balqty > 0 ";
$arrlots="";
$sql_tbl_sub=mysqli_query($link,"select * from tbl_ivtsub where plantcode='$plantcode' and ivt_id='".$tid."'") or die(mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_tbl_sub);
if($tot_arrsub > 0)
{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
		if($arrlots!="")
		{
			$arrlots=$arrlots.",".$row_tbl_sub['ivts_olotno'];
		}
		else
		{
			  $arrlots=$row_tbl_sub['ivts_olotno'];
		}
	}
}



//echo $arrlots;
if($variety==468)
{
	$qr="select distinct(lotldg_lotno) from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."'  and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotldg_lotno asc ";
}
else
{
	$qr="select distinct(lotldg_lotno) from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='Condition' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotldg_lotno asc ";
}
$sql_tbl_sub=mysqli_query($link,$qr) or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub);
?>
<table border="0" width="400" cellspacing="0" cellpadding="0">
<tr >
<td align="right" valign="baseline"><img src="../images/back.gif" border="0" onClick="window.close()" style="vertical-align:baseline" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer; vertical-align:baseline" onclick="return mySubmit();"/>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
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
$vflg=0; $ccnt=0; $ct=0; $qt=0; $qc='';
if($variety==468)
{
	$sql_issue24=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_lotno='".$row['lotldg_lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'") or die(mysqli_error($link));
}
else
{
	$sql_issue24=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='Condition' and lotldg_lotno='".$row['lotldg_lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'") or die(mysqli_error($link));
}
while($row_issue24=mysqli_fetch_array($sql_issue24))
{ 
	if($variety==468)
	{
		$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue24['lotldg_subbinid']."' and lotldg_binid='".$row_issue24['lotldg_binid']."' and lotldg_whid='".$row_issue24['lotldg_whid']."' and lotldg_lotno='".$row['lotldg_lotno']."'  order by lotldg_id desc ") or die(mysqli_error($link));
		$row_is1=mysqli_fetch_array($sql_is1);
		
		$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotldg_lotno asc") or die(mysqli_error($link)); 
		$t=mysqli_num_rows($sql_istbl);
	}
	else
	{
		$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue24['lotldg_subbinid']."' and lotldg_binid='".$row_issue24['lotldg_binid']."' and lotldg_whid='".$row_issue24['lotldg_whid']."' and lotldg_lotno='".$row['lotldg_lotno']."' and lotldg_sstage='Condition' order by lotldg_id desc ") or die(mysqli_error($link));
		$row_is1=mysqli_fetch_array($sql_is1);
		
		$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_is1[0]."' and lotldg_sstage='Condition' and lotldg_balqty > 0 and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotldg_lotno asc") or die(mysqli_error($link)); 
		$t=mysqli_num_rows($sql_istbl);
	}
	//echo $t." = ".$row['lotldg_lotno']."  -  ".$row_is1[0]."  =  "."<br/>";
	if($t > 0)
	{
		while($row_issuetbl24=mysqli_fetch_array($sql_istbl))
		{ 
			$qt++;
			$qc=$row_issuetbl24['lotldg_srflg'];
			if($arrlots!="")
			{
				$parray=explode(",", $arrlots);
				//print_r($parray);
				$ln=$row['lotldg_lotno'];
				if(in_array($ln,$parray)){$ct++;}
			}
		}
	}
}
if($qt==0)$ct++;
//echo $ct." = ".$qc."  =  ".$row['lotldg_lotno']."<br/>";
if($ct==0)
{//echo $ct." = ".$qc."  =  ".$row['lotldg_lotno']."<br/>";
$cflg++;
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotldg_lotno'];?>" onclick="clk(this.value,'<?php echo $row['lotldg_lotno'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotldg_lotno'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="radio" name="loc" value="<?php echo $row['lotldg_lotno'];?>" onclick="clk(this.value,'<?php echo $row['lotldg_lotno'];?>');" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['lotldg_lotno'];?></td>
</tr>     
<?php
}
 $srno=$srno+1;
} 
}
}
//}
//}
//echo $cflg;
if($cflg ==0)
{
?>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;No Lots available to IVT. Reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lots having QC or GOT status FAIL</td>
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
