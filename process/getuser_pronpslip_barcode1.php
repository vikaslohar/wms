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
		$baryrcode=$_SESSION['baryrcode'];
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$totnomp = $_REQUEST['totnomp'];
	$tid = $_REQUEST['tid'];
	$lotno = $_REQUEST['lotno'];
	$txtpsrn = $_REQUEST['txtpsrn'];
	$subtid = $_REQUEST['subtid'];
	$dval = $_REQUEST['dval'];
	
	$s_sub3="delete from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));
	
	$nobapmp=$_REQUEST['nobapmp'];
	$nobe=$_REQUEST['nobe'];
	$nobmos=$_REQUEST['nobmos'];
	$nnob=$_REQUEST['nnob'];
	
	$flagcode=$_REQUEST['flagcode'];
	$flagcode1=$_REQUEST['flagcode1'];
	if(isset($_REQUEST['dobg'])) { $dobg=$_REQUEST['dobg']; } else { $dobg=date("d-m-Y");}
	if(isset($_REQUEST['operatorcode'])) { $operatorcode=$_REQUEST['operatorcode']; } else { $operatorcode="";}
	if(isset($_REQUEST['wtmaccode'])) { $wtmaccode=$_REQUEST['wtmaccode']; } else { $wtmaccode="";}
	
	$main_array=$flagcode;
	$main_array1=explode(",",$main_array);
	$arr = $main_array1;
	
	$abrc="";
	foreach($arr as $sa24)
	{
		if($sa24<>"")
		{
			if($abrc!="")
				$abrc=$abrc.","."'$sa24'";
			else
				$abrc="'$sa24'";
		}
	}
	
	$totbtsls=0;
	$sqlbtsls=mysqli_query($link,"select distinct(btsl_id) from tbl_btslsub where btslsub_barcode IN ($abrc) and plantcode='$plantcode' order by btslsub_id asc") or die(mysqli_error($link));
	$totbtsls=mysqli_num_rows($sqlbtsls);
	
	$zx="";$a="";$b="";
	$sql_barcode=mysqli_query($link,"Select bar_barcode from tbl_barcodes where plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_barcode=mysqli_num_rows($sql_barcode);
	if($tot_barcode > 0)
	{
		while($row_barcode=mysqli_fetch_array($sql_barcode))
		{
			if($a!="")
			$a=$a.",".$row_barcode['bar_barcode'];
			else
			$a=$row_barcode['bar_barcode'];
		}
	}
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_barcode2=mysqli_num_rows($sql_barcode2);
	if($tot_barcode2 > 0)
	{
		while($row_barcode2=mysqli_fetch_array($sql_barcode2))
		{
			if($a!="")
			$a=$a.",".$row_barcode2['bar_barcodes'];
			else
			$a=$row_barcode2['bar_barcodes'];
		}
	}
	
	$b=explode(",",$a);
	foreach($b as $sa)
	{
		if($sa<>"")
		{
			if(in_array($sa,$arr))
			{
				if($zx!="")
				$zx=$zx.",".$sa;
				else
				$zx=$sa;
			}
		}
	}
	$count=0;$sysarr=array();$finarr=$arr;

	if($zx!="")
	{
		$sysarr=explode(",",$zx);
		$finarr = array_merge(array_diff($arr, $sysarr));
		$count=sizeof($sysarr);
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$flagcode1=trim($_POST['flagcode1']);
		$flagcode=trim($_POST['flagcode']);
		$dobg=trim($_POST['dobg']);
		$operatorcode=trim($_POST['operatorcode']);
		$wtmaccode=trim($_POST['wtmaccode']);
		$newnnob=trim($_POST['nnob']);
		$asd=explode(",",$flagcode);
		$zxc=explode(",",$flagcode1);
		$connt=count($asd);
		$dobg1=explode("-",$dobg);
		$dobg2=$dobg1[2]."-".$dobg1[1]."-".$dobg1[0];
		
		for($i=0; $i<$connt; $i++)
		{
			$sql_barcode="Insert into tbl_barcodestmp (bar_barcodes, bar_lotno, bar_tid, bar_subid, bar_logid, bar_yearid, bar_psrn, bar_grosswt, bar_wtdate, bar_poprid, bar_wtmcode, plantcode) values('".$asd[$i]."', '$lotno', '$tid', '$subtid', '$logid', '$yearid_id', '$txtpsrn', '".$zxc[$i]."', '$dobg2', '$operatorcode', '$wtmaccode', '$plantcode')";
			//echo "<br/>";
			mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
		}
		
		//exit; 
		echo "<script>
		opener.document.frmaddDepartment.detmpbno.value=$newnnob;
		opener.document.frmaddDepartment.mobar.value=$totbtsls;
		var x='dtail_$dval';
		opener.document.getElementById(x).innerHTML='<a href=Javascript:void(0) onclick=detailspop()>Details</a>';
		window.opener.bcsyncchk();
		self.close();
		</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Processing - Transaction - Processing and Packing Slip</title>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script src="search.js"></script>
<script language='javascript'>
function onloadfocus()
{
	
}
function isNumberKey(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}
function isNumberKey6(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 13 && charCode != 127 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
    return false;

    return true;
}
function isNumberKey24(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 47 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isChar_o(Char) // This function accepts only alphabetic characters with no space, no special chars.
{
		var CharToChk = new String(Char);
		var LengthOfChar = CharToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfChar;i++)
		{
			if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) {
			flag = false;
			break;
			}	
		}
		return flag;
}
function post_value()
{
/*opener.document.frmaddDepartment.detmpbno.value=document.from.foccode.value;
self.close();
*/
}
function mySubmit()
{
	if(document.from.nnob.value==0)
	{
		alert("You must enter Barcodes");
		return false;
	}
	if(document.from.nnob.value!=document.from.nobapmp.value)
	{
		alert("Net number of Barcodes not matching with Number of Barcodes as per Master Pack");
		return false;
	}
	return true;
}

</script>
			
</head>
<body topmargin="0" onload="onloadfocus();" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
<?php

$plantcodes=""; $yearcodes="";
		$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
		while($noticia = mysqli_fetch_array($quer4)) 
		{
			if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
			else
			$yearcodes=$noticia['ycode'];
		}
	   	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	   	$row_month=mysqli_fetch_array($quer6);
	  	$plantcodes=$row_month['code'];
		$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
		 while($noticia2 = mysqli_fetch_array($quer5)) 
		 {
		 	if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
			else
			$plantcodes=$noticia2['stcode'];
		 }
		 
?>  
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	 <input type="hidden" name="baryrcode" value="<?php echo $baryrcode;?>" />
	  <input type="hidden" name="cnt" value="0" />
	  <input type="hidden" name="sysarr" value="<?php echo $count;?>" />
	  <input type="hidden" name="finalarr" value="<?php echo implode(",",$finarr);?>" />
	  <input type="hidden" name="newbars" value="" />
	  <input type="hidden" name="dval24" value="<?php echo $dval;?>" />
	  <input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	  <input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" />
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	  <input type="hidden" name="flagcode" value="<?php echo $flagcode;?>" />
	  <input type="hidden" name="flagcode1" value="<?php echo $flagcode1;?>" />
	  
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Details of Barcode Number(s) Captured</td>
</tr>
<tr class="light" height="20">
<td colspan="2" align="right" class="tblheading">No of Barcodes to be entered - as per Master Packs&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobapmp" id="nobapmp" class="tbltext" value="<?php echo $totnomp;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">No of Barcodes entered&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobe" id="nobe" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nobe;?>" /></td>
</tr>
<!--<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">No. of Barcodes Mis Out(s) - not part of range&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;</td>
</tr>--><input type="hidden" name="nobmos" id="nobmos" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nobmos;?>" />
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">No. of Duplicate Barcodes - already present in system&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobdups" id="nobdups" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $count;?>" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">Net Number of Barcodes&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nnob" id="nnob" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nobe-$count;?>" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading" colspan="2">Weighing Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;<input name="dobg" id="dobg" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $dobg;?>" maxlength="10" readonly="true" style="background-color:#ECECEC" />&nbsp;</td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading" colspan="2">Weighing Machine Operator&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;<input type="text" name="operatorcode" class="tbltext" value="<?php echo $operatorcode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading" colspan="2">Weighing Machine&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;<input type="text" name="wtmaccode" class="tbltext" value="<?php echo $wtmaccode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">Selected Barcodes</td>
<!--<td  align="center" valign="middle" class="tblheading">Mis Out Barcodes</td>-->
<td  align="center" valign="middle" class="tblheading" colspan="2">Barcodes to be changed</td>
<td  align="center" valign="middle" class="tblheading">Accepted Barcodes</td>
</tr>
<tr class="Dark" height="25">
<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($main_array1 as $mainarr) if($mainarr<>"") echo $mainarr."<br/>";?></td>
<!--<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($so_array1 as $soarr) if($soarr<>"") echo $soarr."<br/>"; ?></td>-->
<td width="50%" align="center" valign="Top" class="tblheading" style="padding-top:5px;" colspan="2"><?php $ccnt=0; foreach($sysarr as $sysarr1) { if($sysarr1<>"") { $ccnt++; 

echo $sysarr1; } }?></td>
<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($finarr as $finarr1) if($finarr1<>"") echo $finarr1."<br/>"; ?></td>
</tr>
</table>

<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >

<td align="center" colspan="3"><a href="getuser_pronpslip_barcode.php?totnomp=<?php echo $totnomp?>&tid=<?php echo $tid?>&subtid=<?php echo $subtid?>&lotno=<?php echo $lotno?>&txtpsrn=<?php echo $txtpsrn?>&nobe=<?php echo $nobe?>&nobmos=<?php echo $nobmos?>&nnob=<?php echo $nnob?>&dval=<?php echo $dval?>&dobg=<?php echo $dobg?>&operatorcode=<?php echo $operatorcode?>&flagcode=<?php echo $flagcode?>&flagcode1=<?php echo $flagcode1?>&wtmaccode=<?php echo $wtmaccode;?>" ><img src="../images/edit.gif" border="0" style="cursor:pointer" /></a>&nbsp;<input type="image" src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
