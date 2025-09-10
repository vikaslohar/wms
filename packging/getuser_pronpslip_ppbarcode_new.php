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
		$plantcode=$_SESSION['plantcode'];
		$plantcode1=$_SESSION['plantcode1'];
		$plantcode2=$_SESSION['plantcode2'];
		$plantcode3=$_SESSION['plantcode3'];
		$plantcode4=$_SESSION['plantcode4'];
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	require_once('../include/reader.php'); // include the class
	require_once("../include/insertxlsdata_ppbarcode.php");	
//error_reporting(E_ALL);
	
	if(isset($_REQUEST['totnomp'])) { $totnomp = $_REQUEST['totnomp']; }
	if(isset($_REQUEST['tid'])) { $tid = $_REQUEST['tid']; }
	if(isset($_REQUEST['subtid'])) { $subtid = $_REQUEST['subtid']; }
	if(isset($_REQUEST['lotno'])) { $lotno = $_REQUEST['lotno']; }
	if(isset($_REQUEST['txtpsrn'])) { $txtpsrn = $_REQUEST['txtpsrn']; }
	if(isset($_REQUEST['dval'])) { $dval=$_REQUEST['dval']; }
	if(isset($_REQUEST['dobg'])) { $dobg=$_REQUEST['dobg']; }
	if(isset($_REQUEST['operatorcode'])) { $operatorcode=$_REQUEST['operatorcode']; }
	if(isset($_REQUEST['wtmaccode'])) { $wtmaccode=$_REQUEST['wtmaccode']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		set_time_limit(120);
		//$txtbrowse=trim($_POST['txtbrowse']);
		$cnt1=0;
		$filename=$_FILES['txtbrowse']['name'];
		$filepath='../ExcelFileData/'.$filename;
		$name_tmp = $_FILES['txtbrowse']['tmp_name'];
		move_uploaded_file($name_tmp,$filepath);
		chmod($filepath, 0777);
		$lotno1="'$lotno'";
		$txtpsrn1="'$txtpsrn'";
		$zzz=implode(",", str_split($lotno));
		$lt=$zzz[28].$zzz[30];
		
		$lotchk=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$lt;
		
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
		
		$zxcvb=insertdata($filepath,$totnomp,$tid,$lotno,$txtpsrn,$subtid,$dval,$lotchk,$link,$plantcode);
		
		//echo $totnomp." = ".$cnt1." = ".$zxcvb;
		$cnt1=$cnt1+$zxcvb;
		//exit;
		
		
		if($cnt1>0)
		{
			if($totnomp!=$cnt1)
			{
				$str="delete from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_psrn='".$txtpsrn."' and bar_tid='$tid' and bar_subid='$subtid' and bar_logid='$logid' and bar_yearid='$yearid_id'";
				$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
			?>
				<script>
				alert('File Import Unsuccessfull.\nReason: Number of Barcodes to be enter as per Master Packs are not matching with number of Barcodes in Excel file.\nPlease Check the Excel file and try again.');
				//window.location='getuser_pronpslip_barcode_new.php?totnomp='+<?php echo $totnomp?>+'&tid='+<?php echo $tid?>+'&lotno='+<?php echo $lotno1?>+'&txtpsrn='+<?php echo $txtpsrn1?>+'&subtid='+<?php echo $subtid?>+'&dval='+<?php echo $dval?>+'&dobg='+<?php echo $dobg?>+'&operatorcode='+<?php echo $operatorcode?>+'&wtmaccode='+<?php echo $wtmaccode?>+'';
				</script>
			<?php 
			}
			else
			{
			echo "<script>window.location='getuser_pronpslip_barcode2_new.php?totnomp=$totnomp&tid=$tid&subtid=$subtid&lotno=$lotno&txtpsrn=$txtpsrn&dval=$dval&dobg=$dobg&operatorcode=$operatorcode&wtmaccode=$wtmaccode'</script>";
			}
		}
		else
		{
		?>
			<script>
				alert('File Import Unsuccessfull.\n\nResons:\n\n1. Lot Number mismatch.\n2. Barcodes are already Imported.\n\n Please Check the Excel file and try again.');
				//window.location='getuser_pronpslip_barcode_new.php?totnomp='+<?php echo $totnomp?>+'&tid='+<?php echo $tid?>+'&lotno='+<?php echo $lotno1?>+'&txtpsrn='+<?php echo $txtpsrn1?>+'&subtid='+<?php echo $subtid?>+'&dval='+<?php echo $dval?>+'';
			</script>
		<?php
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing Slip</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script type="text/javascript" src="../include/validation.js"></script>
<script language='javascript'>
function onloadfocus()
{
	opener.document.frmaddDepartment.detmpbno.value=0;
	document.frmaddDepartment.txtbrowse.focus();
}
function post_value()
{
}
function mySubmit()
{
	var filename=document.frmaddDepartment.txtbrowse.value;
	var filearr1=filename.split(".");
	var tarr=filearr1[0].split("_");
	var cnt=tarr.length;
	var filearr=tarr[0].split("");
	var charchk=(filearr[0]+filearr[1]+filearr[2]).trim();
	var destchk=(tarr[1]).trim();
	var flg=0;
	var dt=document.frmaddDepartment.cdate.value;
	var dtarr=dt.split("-");
	var cdate=(dtarr[0]+dtarr[1]+dtarr[2]).trim();
	var txtpsrn=document.frmaddDepartment.txtpsrn.value;
	
	if(document.frmaddDepartment.txtbrowse.value != "")
	{
		var extArray = new Array(".xls",".xlsx");
		var fileName = document.frmaddDepartment.txtbrowse.value;
						
		if(!fileName) {return false;}
		ext = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
						
		for (var i = 0; i < extArray.length; i++) {
		   if (extArray[i] == ext) flg=1;
		}
		/*alert("Please only upload files that end in type:  "
		+ (extArray.join("  ")) + "\nPlease select a new "
		+ "file to upload and submit again.");
		document.frmaddDepartment.txtbrowse.focus();
		return false;*/
	}
	/*if(flg==1)
	{ 
		if(charchk!="PBP")
		{
			alert("Excel File attached is Invalid1. ");
			document.frmaddDepartment.txtbrowse.value==""
			//document.frmaddDepartment.txtbrowse.focus();
			return false;
		}
		if(destchk!=cdate)
		{
			alert("Excel File attached is Invalid2. ");
			document.frmaddDepartment.txtbrowse.value==""
			//document.frmaddDepartment.txtbrowse.focus();
			return false;
		}
	}
	else
	{
				alert("Please only upload files that end in type: .xls, .xlsx "
				+ "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDepartment.txtbrowse.focus();
				return false;
	}*/
	 return true;

}

</script>
			
</head>
<body topmargin="0" onLoad="onloadfocus();" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();" enctype="multipart/form-data"  > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	<input type="hidden" name="totnomp" class="tbltext" value="<?php echo $totnomp;?>"  />
	<input type="hidden" name="txtpsrn" value="<?php echo $txtpsrn;?>" />
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Upload Excel with Barcode Number(s)</td>
</tr>
<tr class="light" height="25">
	<td width="50%" align="right" valign="middle" class="tblheading">Weighing Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input name="dobg" id="dobg" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $dobg;?>" maxlength="10" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine Operator&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="operatorcode" class="tbltext" value="<?php echo $operatorcode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="wtmaccode" class="tbltext" value="<?php echo $wtmaccode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
</table>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Excel with Barcode Number(s)</td>
</tr>
<tr class="Light" height="25">
<td width="79" align="right" height="30" valign="middle" class="tblheading">Attach File&nbsp;</td>
<td width="315" align="left"  valign="middle">&nbsp;<input name="txtbrowse" type="file" size="30" class="tbltext" tabindex="0"  />&nbsp;<font color="#FF0000" >*</font>
  </tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >

<td align="center" colspan="3"><a href="getuser_pronpslip_barcode_sel.php?totnomp=<?php echo $totnomp?>&tid=<?php echo $tid?>&subtid=<?php echo $subtid?>&lotno=<?php echo $lotno?>&txtpsrn=<?php echo $txtpsrn?>&nobe=<?php echo $nobe?>&nobmos=<?php echo $nobmos?>&nnob=<?php echo $nnob?>&dval=<?php echo $dval?>&dobg=<?php echo $dobg?>&operatorcode=<?php echo $operatorcode?>&wtmaccode=<?php echo $wtmaccode?>" ><img src="../images/back.gif" border="0" style="cursor:pointer" /></a>&nbsp;<a href="javascript:document.from.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<input type="image" src="../images/next.gif" alt="Next" border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
