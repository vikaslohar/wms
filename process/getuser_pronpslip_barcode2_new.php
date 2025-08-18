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
	$dobg=$_REQUEST['dobg'];
	$operatorcode=$_REQUEST['operatorcode'];
	$wtmaccode=$_REQUEST['wtmaccode']; 
	$lotno1="'$lotno'";
	$txtpsrn1="'$txtpsrn'";
	
	$abarc=""; $wtrc=""; $wtdt=''; $opcd=""; $wtmcd=""; $abrc="";
	
	$sql_barcode24=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_barcode24=mysqli_num_rows($sql_barcode24);
	
	if($tot_barcode24 > 0)
	{ 	$cont=0;
		while($row_barcode24=mysqli_fetch_array($sql_barcode24))
		{
			$cont++;
			$bcd=$row_barcode24['bar_barcodes'];
			if($abarc!="")
			$abarc=$abarc.",".$bcd;
			else
			$abarc=$bcd;
			if($abrc!="")
			$abrc=$abrc.","."'$bcd'";
			else
			$abrc="'$bcd'";
			if($wtrc!="")
			$wtrc=$wtrc.",".$row_barcode24['bar_grosswt'];
			else
			$wtrc=$row_barcode24['bar_grosswt'];
			
			$wtdt=$row_barcode24['bar_wtdate'];
			$opcd=$row_barcode24['bar_poprid'];
			$wtmcd=$row_barcode24['bar_wtmcode'];
		}
	}
	$totbtsls=0;
	$sqlbtsls=mysqli_query($link,"select distinct(btsl_id) from tbl_btslsub where btslsub_barcode IN ($abrc) and plantcode='$plantcode' order by btslsub_id asc") or die(mysqli_error($link));
	$totbtsls=mysqli_num_rows($sqlbtsls);
	
	$nobapmp=$_REQUEST['nobapmp'];
	$nobe=$cont;
	$nobmos=0;
	$nnob=$cont;
	$so_array="";
	$arr=explode(",",$abarc);
	$main_array1=$arr;
	$so_array1=explode(",",$so_array);
	
	if($flagcode=="")$flagcode=$abarc;
	if($flagcode1=="")$flagcode1=$wtrc;
	
	if($operatorcode=="")$operatorcode=$opcd;
	if($wtmaccode=="")$wtmaccode=$wtmcd;
	if($dobg=="")
	{
		$dobg1=explode("-",$wtdt);
		$dobg=$dobg1[2]."-".$dobg1[1]."-".$dobg[0];
	}
	
	$zx="";$a="";$b="";
	$sql_barcode=mysqli_query($link,"Select bar_barcode from tbl_barcodes where bar_barcode IN ($abrc) and plantcode='$plantcode'") or die(mysqli_error($link));
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
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid!='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."' and plantcode='$plantcode'") or die(mysqli_error($link));
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
	/*if($tot_barcode > 0)
	{
	$count=sizeof($zx);
	}
	else
	{*/
	$count=0;$sysarr=array();$finarr=$arr;
	//}
	$cont=0;
	if($zx!="")
	{
	$cont++;
	$sysarr=explode(",",$zx);
	$finarr = array_merge(array_diff($arr, $sysarr));
	$count=sizeof($sysarr);
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$totnomp=trim($_POST['totnomp']);
		$dval24=trim($_POST['dval24']);
		if(window.opener != null && !window.opener.closed)
		{
		  echo "HI"; //some code goes here.
		}
		echo "<script>
		opener.document.frmaddDepartment.detmpbno.value=$totnomp;
		opener.document.frmaddDepartment.mobar.value=$totbtsls;
		var x='dtail_$dval';
		opener.document.getElementById(x).innerHTML='<a href=Javascript:void(0) onclick=detailspop()>Details</a>';
		if(window.opener != null && !window.opener.closed)
		{
		window.opener.bcsyncchk();
		}
		self.close();
		</script>";	
		/*?>
		<script>
		opener.document.frmaddDepartment.detmpbno.value=<?php echo $totnomp?>;
		opener.document.frmaddDepartment.mobar.value=<?php echo $totbtsls?>;
		var x='dtail_'+<?php echo $dval24?>;
		opener.document.getElementById(x).innerHTML='<a href=Javascript:void(0) onclick=detailspop()>Details</a>';
		window.opener.bcsyncchk();
		self.close();
		</script>
		<?php*/
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
	/*if(document.from.sysarr.value>0)
	{
	document.from.confbarcodes1.focus();
	}*/
}
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 13 && charCode != 127 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
    return false;

    return true;
}

function post_value()
{
/*opener.document.frmaddDepartment.detmpbno.value=document.from.foccode.value;
self.close();
*/
}
function mycancel()
{
//opener.document.frmaddDepartment.detmpbno.value=document.from.foccode.value;
self.close();
}
function mySubmit()
{
if(document.from.cont.value>0)
{
	alert("Canno Submit. \nReason: "+document.from.cont.value+" Number of Barcodes are already present in system.");
	return false;
}
else
{
	var sno=document.from.sysarr.value;
	var xz="";
	for(var i=1; i<=sno; i++)
	{
		var id="confbarcodes"+i;
		if(xz!="")
			xz=xz+","+document.getElementById(id).value;
		else
			xz=document.getElementById(id).value;
	}
	document.from.newbars.value=xz;
}
//alert(document.from.newbars.value);
return true;

}

function searchbarcode(searchval, tno)
{
	if(searchval.length==11)
	{
		var id="barserch"+tno;
		var finar=document.from.finalarr.value;
		var dupnos=document.from.totdupbar.value;
		var sno=document.from.sysarr.value;
		var subid=document.from.subid.value;
		var mainarr=document.from.mainarr.value;
		//alert(mainarr);
		var xz="";
		for(var i=1; i<=sno; i++)
		{
			if(i!=tno)
			{
			var id2="confbarcodes"+i;
			if(xz!="")
				xz=xz+","+document.getElementById(id2).value;
			else
				xz=document.getElementById(id2).value;
			}
		}
		searchUser(searchval,id,"barsearchedit",tno,finar,dupnos,xz,subid,mainarr);
	}
}
function chkbalbar(tno)
{
	var sno=document.from.sysarr.value;
	var cnt=0;
	for(var i=1; i<=sno; i++)
	{
		var id="totbarok"+i;
		if(document.getElementById(id).value==0)cnt++;
	}
	document.from.totdupbar.value=parseInt(document.from.sysarr.value)-cnt;
	if(document.from.totdupbar.value<document.from.sysarr.value)
	{
		document.from.nobdups.value=document.from.totdupbar.value;
		document.from.nnob.value=parseInt(document.from.nobe.value)-parseInt(document.from.nobmos.value)-parseInt(document.from.nobdups.value);
	}
}
</script>
			
</head>
<body topmargin="0" onLoad="onloadfocus();" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	 <input type="hidden" name="baryrcode" value="<?php echo $baryrcode;?>" />
	  <input type="hidden" name="cnt" value="0" />
	 
	  <input type="hidden" name="finalarr" value="<?php echo implode(",",$finarr);?>" />
	  <input type="hidden" name="newbars" value="" />
	   <input type="hidden" name="subid" value="<?php echo $subtid;?>" />
	   <input type="hidden" name="mainarr" value="<?php echo implode(",",$arr);?>" />
	   <input type="hidden" name="dval24" value="<?php echo $dval;?>" />
	   <input type="hidden" name="totnomp" value="<?php echo $totnomp?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">Details of Barcode Number(s) Captured</td>
</tr>
<tr class="light" height="20">
<td  align="right" class="tblheading">No of Barcodes to be entered - as per Master Packs&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobapmp" id="nobapmp" class="tbltext" value="<?php echo $totnomp;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>
<tr class="light" height="20">
  <td  align="right" class="tblheading">No of Barcodes entered&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobe" id="nobe" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nobe;?>" /></td>
</tr>
<!--<tr class="light" height="20">
  <td  align="right" class="tblheading">No. of Barcodes Mis Out(s) - not part of range&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobmos" id="nobmos" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nobmos;?>" /></td>
</tr>-->
<tr class="light" height="20">
  <td  align="right" class="tblheading">No. of Duplicate Barcodes - already present in system&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobdups" id="nobdups" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $count;?>" /></td>
</tr>
<tr class="light" height="20">
  <td  align="right" class="tblheading">Net Number of Barcodes&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nnob" id="nnob" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nnob-$count;?>" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input name="dobg" id="dobg" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $dobg;?>" maxlength="10" readonly="true" style="background-color:#ECECEC" />&nbsp;</td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine Operator&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="operatorcode" class="tbltext" value="<?php echo $operatorcode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="wtmaccode" class="tbltext" value="<?php echo $wtmaccode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">Selected Barcodes</td>
<!--<td  align="center" valign="middle" class="tblheading">Mis Out Barcodes</td>-->
<td  align="center" valign="middle" class="tblheading">Barcodes to be changed</td>
<!--<td  align="center" valign="middle" class="tblheading">Accepted Barcodes</td>-->
</tr>
<tr class="Dark" height="25">
<td width="50%" align="center" valign="Top" class="tblheading"><?php $ccnt=0; foreach($main_array1 as $mainarr) if($mainarr<>"") { $ccnt++; echo $mainarr."<br/>"; echo "<input type='hidden' name='confbarcodes$ccnt' id='confbarcodes$ccnt' readonly='true' size='10' maxlength='9' class='tbltext' value='$mainarr'>"; } ?> <input type="hidden" name="sysarr" value="<?php echo $ccnt;?>" /></td>
<!--<td width="25%" align="center" valign="Top" class="tblheading"><?php //foreach($so_array1 as $soarr) if($soarr<>"") echo $soarr."1<br/>"; ?></td>-->
<td width="50%" align="center" valign="Top" class="tblheading" style="padding-top:5px;"><?php $ccnt=0; if($cont > 0){foreach($sysarr as $sysarr1) { if($sysarr1<>"") { $ccnt++; 
if($ccnt<=$cont){ echo $sysarr1."<br/>";} } } }?><input type="hidden" name="cont" value="<?php echo $cont;?>" /></td>
<!--<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($finarr as $finarr1) if($finarr1<>"") echo $finarr1."<br/>"; ?></td>-->
</tr>
</table>

<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >

<td align="center" colspan="3"><a href="getuser_pronpslip_barcode_new.php?totnomp=<?php echo $totnomp?>&tid=<?php echo $tid?>&subtid=<?php echo $subtid?>&lotno=<?php echo $lotno?>&txtpsrn=<?php echo $txtpsrn?>&nobe=<?php echo $nobe?>&nobmos=<?php echo $nobmos?>&nnob=<?php echo $nnob?>&dval=<?php echo $dval?>&dobg=<?php echo $dobg?>&operatorcode=<?php echo $operatorcode?>&wtmaccode=<?php echo $wtmaccode?>"><img src="../images/cancel.gif" border="0" style="cursor:pointer" /></a>&nbsp;<input type="image" src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
