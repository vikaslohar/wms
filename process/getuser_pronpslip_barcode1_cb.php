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
	
	if(isset($_REQUEST['dobg'])) { $dobg=$_REQUEST['dobg']; } else { $dobg=date("d-m-Y");}
	if(isset($_REQUEST['operatorcode'])) { $operatorcode=$_REQUEST['operatorcode']; } else { $operatorcode="";}
	if(isset($_REQUEST['wtmaccode'])) { $wtmaccode=$_REQUEST['wtmaccode']; } else { $wtmaccode="";}
	
	
	$s_sub3="delete from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));
	
	$nobapmp=$_REQUEST['nobapmp'];
	$nobe=$_REQUEST['nobe'];
	$nobmos=$_REQUEST['nobmos'];
	$nnob=$_REQUEST['nnob'];
	$gwt=$_REQUEST['gwt'];
	
	$m1=$_REQUEST['m1'];
	$m2=$_REQUEST['m2'];
	$m3=$_REQUEST['m3'];
	$m4=$_REQUEST['m4'];
	$m5=$_REQUEST['m5'];
	$m6=$_REQUEST['m6'];
	$m7=$_REQUEST['m7'];
	$m8=$_REQUEST['m8'];
	$m9=$_REQUEST['m9'];
	$m10=$_REQUEST['m10'];
	$m11=$_REQUEST['m11'];
	$m12=$_REQUEST['m12'];
	$m13=$_REQUEST['m13'];
	$m14=$_REQUEST['m14'];
	$m15=$_REQUEST['m15'];
	$m16=$_REQUEST['m16'];
	$m17=$_REQUEST['m17'];
	$m18=$_REQUEST['m18'];
	$m19=$_REQUEST['m19'];
	$m20=$_REQUEST['m20'];
	$m21=$_REQUEST['m21'];
	$m22=$_REQUEST['m22'];
	$m23=$_REQUEST['m23'];
	$m24=$_REQUEST['m24'];
	$m25=$_REQUEST['m25'];
	$m26=$_REQUEST['m26'];
	$m27=$_REQUEST['m27'];
	$m28=$_REQUEST['m28'];
	$m29=$_REQUEST['m29'];
	$m30=$_REQUEST['m30'];
	$m31=$_REQUEST['m31'];
	$m32=$_REQUEST['m32'];
	$m33=$_REQUEST['m33'];
	$m34=$_REQUEST['m34'];
	$m35=$_REQUEST['m35'];
	$m36=$_REQUEST['m36'];
	$m37=$_REQUEST['m37'];
	$m38=$_REQUEST['m38'];
	$m39=$_REQUEST['m39'];
	$m40=$_REQUEST['m40'];
	
	$rf1=$_REQUEST['rf1'];
	$rt1=$_REQUEST['rt1'];
	$rf2=$_REQUEST['rf2'];
	$rt2=$_REQUEST['rt2'];
	$rf3=$_REQUEST['rf3'];
	$rt3=$_REQUEST['rt3'];
	$rf4=$_REQUEST['rf4'];
	$rt4=$_REQUEST['rt4'];
	$rf5=$_REQUEST['rf5'];
	$rt5=$_REQUEST['rt5'];
	$rf6=$_REQUEST['rf6'];
	$rt6=$_REQUEST['rt6'];
	/*$rf7=$_REQUEST['rf7'];
	$rt7=$_REQUEST['rt7'];
	$rf8=$_REQUEST['rf8'];
	$rt8=$_REQUEST['rt8'];
	$rf9=$_REQUEST['rf9'];
	$rt9=$_REQUEST['rt9'];
	$rf10=$_REQUEST['rf10'];
	$rt10=$_REQUEST['rt10'];*/
	
	$mo1=$_REQUEST['mo1'];
	$mo2=$_REQUEST['mo2'];
	$mo3=$_REQUEST['mo3'];
	$mo4=$_REQUEST['mo4'];
	$mo5=$_REQUEST['mo5'];
	$mo6=$_REQUEST['mo6'];
	$mo7=$_REQUEST['mo7'];
	$mo8=$_REQUEST['mo8'];
	$mo9=$_REQUEST['mo9'];
	$mo10=$_REQUEST['mo10'];
	$mo11=$_REQUEST['mo11'];
	$mo12=$_REQUEST['mo12'];
	$mo13=$_REQUEST['mo13'];
	$mo14=$_REQUEST['mo14'];
	$mo15=$_REQUEST['mo15'];
	$mo16=$_REQUEST['mo16'];
	$mo17=$_REQUEST['mo17'];
	$mo18=$_REQUEST['mo18'];
	$mo19=$_REQUEST['mo19'];
	$mo20=$_REQUEST['mo20'];
	$mo21=$_REQUEST['mo21'];
	$mo22=$_REQUEST['mo22'];
	$mo23=$_REQUEST['mo23'];
	$mo24=$_REQUEST['mo24'];
	$mo25=$_REQUEST['mo25'];
	$mo26=$_REQUEST['mo26'];
	$mo27=$_REQUEST['mo27'];
	$mo28=$_REQUEST['mo28'];
	$mo29=$_REQUEST['mo29'];
	$mo30=$_REQUEST['mo30'];
	$mo31=$_REQUEST['mo31'];
	$mo32=$_REQUEST['mo32'];
	$mo33=$_REQUEST['mo33'];
	$mo34=$_REQUEST['mo34'];
	$mo35=$_REQUEST['mo35'];
	$mo36=$_REQUEST['mo36'];
	$mo37=$_REQUEST['mo37'];
	$mo38=$_REQUEST['mo38'];
	$mo39=$_REQUEST['mo39'];
	$mo40=$_REQUEST['mo40'];
	
	$ss_array="";
	if($m1!="")$ss_array=$m1; if($m2!="" && $ss_array!="")$ss_array=$ss_array.",".$m2; if($m3!="" && $ss_array!="")$ss_array=$ss_array.",".$m3; if($m4!="" && $ss_array!="")$ss_array=$ss_array.",".$m4; if($m5!="" && $ss_array!="")$ss_array=$ss_array.",".$m5; if($m6!="" && $ss_array!="")$ss_array=$ss_array.",".$m6; if($m7!="" && $ss_array!="")$ss_array=$ss_array.",".$m7; if($m8!="" && $ss_array!="")$ss_array=$ss_array.",".$m8; if($m9!="" && $ss_array!="")$ss_array=$ss_array.",".$m9; if($m10!="" && $ss_array!="")$ss_array=$ss_array.",".$m10; if($m11!="" && $ss_array!="")$ss_array=$ss_array.",".$m11; if($m12!="" && $ss_array!="")$ss_array=$ss_array.",".$m12; if($m13!="" && $ss_array!="")$ss_array=$ss_array.",".$m13; if($m14!="" && $ss_array!="")$ss_array=$ss_array.",".$m14; if($m15!="" && $ss_array!="")$ss_array=$ss_array.",".$m15; if($m16!="" && $ss_array!="")$ss_array=$ss_array.",".$m16; if($m17!="" && $ss_array!="")$ss_array=$ss_array.",".$m17; if($m18!="" && $ss_array!="")$ss_array=$ss_array.",".$m18; if($m19!="" && $ss_array!="")$ss_array=$ss_array.",".$m19; if($m20!="" && $ss_array!="")$ss_array=$ss_array.",".$m20; if($m21!="" && $ss_array!="")$ss_array=$ss_array.",".$m21; if($m22!="" && $ss_array!="")$ss_array=$ss_array.",".$m22; if($m23!="" && $ss_array!="")$ss_array=$ss_array.",".$m23; if($m24!="" && $ss_array!="")$ss_array=$ss_array.",".$m24; if($m25!="" && $ss_array!="")$ss_array=$ss_array.",".$m25; if($m26!="" && $ss_array!="")$ss_array=$ss_array.",".$m26; if($m27!="" && $ss_array!="")$ss_array=$ss_array.",".$m27; if($m28!="" && $ss_array!="")$ss_array=$ss_array.",".$m28; if($m29!="" && $ss_array!="")$ss_array=$ss_array.",".$m29; if($m30!="" && $ss_array!="")$ss_array=$ss_array.",".$m30; if($m31!="" && $ss_array!="")$ss_array=$ss_array.",".$m31; if($m32!="" && $ss_array!="")$ss_array=$ss_array.",".$m32; if($m33!="" && $ss_array!="")$ss_array=$ss_array.",".$m33; if($m34!="" && $ss_array!="")$ss_array=$ss_array.",".$m34; if($m35!="" && $ss_array!="")$ss_array=$ss_array.",".$m35; if($m36!="" && $ss_array!="")$ss_array=$ss_array.",".$m36; if($m37!="" && $ss_array!="")$ss_array=$ss_array.",".$m37; if($m38!="" && $ss_array!="")$ss_array=$ss_array.",".$m38; if($m39!="" && $ss_array!="")$ss_array=$ss_array.",".$m39; if($m10!="" && $ss_array!="")$ss_array=$ss_array.",".$m40;
	
	$se_array="";
	if($rf1!="")
	{
		$se_array=$rf1;
		for($i=$rf1; $i<$rt1; $i++) { $rf1++; $se_array=$se_array.",".$rf1; } 
		if($rf2!="") { for($i=$rf2; $i<=$rt2; $i++) { $se_array=$se_array.",".$rf2; $rf2++; }} 
		if($rf3!="") { for($i=$rf3; $i<=$rt3; $i++) { $se_array=$se_array.",".$rf3; $rf3++; }} 
		if($rf4!="") { for($i=$rf4; $i<=$rt4; $i++) { $se_array=$se_array.",".$rf4; $rf4++; }} 
		if($rf5!="") { for($i=$rf5; $i<=$rt5; $i++) { $se_array=$se_array.",".$rf5; $rf5++; }} 
		if($rf6!="") { for($i=$rf6; $i<=$rt6; $i++) { $se_array=$se_array.",".$rf6; $rf6++; }} 
		/*if($rf7!="") { for($i=$rf7; $i<=$rt7; $i++) { $se_array=$se_array.",".$rf7; $rf7++; }} 
		if($rf8!="") { for($i=$rf8; $i<=$rt8; $i++) { $se_array=$se_array.",".$rf8; $rf8++; }} 
		if($rf9!="") { for($i=$rf9; $i<=$rt9; $i++) { $se_array=$se_array.",".$rf9; $rf9++; }} 
		if($rf10!="") { for($i=$rf10; $i<=$rt10; $i++) { $se_array=$se_array.",".$rf10; $rf10++; }} 
		if($rf11!="") { for($i=$rf11; $i<=$rt11; $i++) { $se_array=$se_array.",".$rf11; $rf11++; }} 
		if($rf12!="") { for($i=$rf12; $i<=$rt12; $i++) { $se_array=$se_array.",".$rf12; $rf12++; }} 
		if($rf13!="") { for($i=$rf13; $i<=$rt13; $i++) { $se_array=$se_array.",".$rf13; $rf13++; }} 
		if($rf14!="") { for($i=$rf14; $i<=$rt14; $i++) { $se_array=$se_array.",".$rf14; $rf14++; }} 
		if($rf15!="") { for($i=$rf15; $i<=$rt15; $i++) { $se_array=$se_array.",".$rf15; $rf15++; }} 
		if($rf16!="") { for($i=$rf16; $i<=$rt16; $i++) { $se_array=$se_array.",".$rf16; $rf16++; }} 
		if($rf17!="") { for($i=$rf17; $i<=$rt17; $i++) {  $se_array=$se_array.",".$rf17; $rf17++;}} 
		if($rf18!="") { for($i=$rf18; $i<=$rt18; $i++) { $se_array=$se_array.",".$rf18; $rf18++; }} 
		if($rf19!="") { for($i=$rf19; $i<=$rt19; $i++) { $se_array=$se_array.",".$rf19; $rf19++; }} 
		if($rf20!="") { for($i=$rf20; $i<=$rt20; $i++) { $se_array=$se_array.",".$rf20; $rf20++; }} */
	}
	
	$so_array="";
	if($mo1!="")$so_array=$mo1; if($mo2!="" && $so_array!="")$so_array=$so_array.",".$mo2; if($mo3!="" && $so_array!="")$so_array=$so_array.",".$mo3; if($mo4!="" && $so_array!="")$so_array=$so_array.",".$mo4; if($mo5!="" && $so_array!="")$so_array=$so_array.",".$mo5; if($mo6!="" && $so_array!="")$so_array=$so_array.",".$mo6; if($mo7!="" && $so_array!="")$so_array=$so_array.",".$mo7; if($mo8!="" && $so_array!="")$so_array=$so_array.",".$mo8; if($mo9!="" && $so_array!="")$so_array=$so_array.",".$mo9; if($mo10!="" && $so_array!="")$so_array=$so_array.",".$mo10; if($mo11!="" && $so_array!="")$so_array=$so_array.",".$mo11; if($mo12!="" && $so_array!="")$so_array=$so_array.",".$mo12; if($mo13!="" && $so_array!="")$so_array=$so_array.",".$mo13; if($mo14!="" && $so_array!="")$so_array=$so_array.",".$mo14; if($mo15!="" && $so_array!="")$so_array=$so_array.",".$mo15; if($mo16!="" && $so_array!="")$so_array=$so_array.",".$mo16; if($mo17!="" && $so_array!="")$so_array=$so_array.",".$mo17; if($mo18!="" && $so_array!="")$so_array=$so_array.",".$mo18; if($mo19!="" && $so_array!="")$so_array=$so_array.",".$mo19; if($mo20!="" && $so_array!="")$so_array=$so_array.",".$mo20; if($mo21!="" && $so_array!="")$so_array=$so_array.",".$mo21; if($mo22!="" && $so_array!="")$so_array=$so_array.",".$mo22; if($mo23!="" && $so_array!="")$so_array=$so_array.",".$mo23; if($mo24!="" && $so_array!="")$so_array=$so_array.",".$mo24; if($mo25!="" && $so_array!="")$so_array=$so_array.",".$mo25; if($mo26!="" && $so_array!="")$so_array=$so_array.",".$mo26; if($mo27!="" && $so_array!="")$so_array=$so_array.",".$mo27; if($mo28!="" && $so_array!="")$so_array=$so_array.",".$mo28; if($mo29!="" && $so_array!="")$so_array=$so_array.",".$mo29; if($mo30!="" && $so_array!="")$so_array=$so_array.",".$mo30; if($mo31!="" && $so_array!="")$so_array=$so_array.",".$mo31; if($mo32!="" && $so_array!="")$so_array=$so_array.",".$mo32; if($mo33!="" && $so_array!="")$so_array=$so_array.",".$mo33; if($mo34!="" && $so_array!="")$so_array=$so_array.",".$mo34; if($mo35!="" && $so_array!="")$so_array=$so_array.",".$mo35; if($mo36!="" && $so_array!="")$so_array=$so_array.",".$mo36; if($mo37!="" && $so_array!="")$so_array=$so_array.",".$mo37; if($mo38!="" && $so_array!="")$so_array=$so_array.",".$mo38; if($mo39!="" && $so_array!="")$so_array=$so_array.",".$mo39; if($mo40!="" && $so_array!="")$so_array=$so_array.",".$mo40;
	
	$main_array=$ss_array;
	if($se_array!="") $main_array=$main_array.",".$se_array;
	$main_array1=explode(",",$main_array);
	$so_array1=explode(",",$so_array);
	$arr = array_merge(array_diff($main_array1, $so_array1));
	//print_r($arr);
	
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
	/*$sql_barcode=mysqli_query($link,"Select bar_barcode from tbl_barcodes") or die(mysqli_error($link));
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
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes,bar_grosswt from tbl_barcodestmp") or die(mysqli_error($link));
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
	}*/
	
	//$b=explode(",",$arr);
	//print_r($b);
	foreach($arr as $sa)
	{
		if($sa<>"")
		{
			//echo $sa;
			$sql_barcode=mysqli_query($link,"Select bar_barcode from tbl_barcodes where bar_barcode='$sa' and plantcode='$plantcode'") or die(mysqli_error($link));
			$tot_barcode=mysqli_num_rows($sql_barcode);
			if($tot_barcode > 0)
			{
				if($zx!="")
				$zx=$zx.",".$sa;
				else
				$zx=$sa;
			}
			$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where bar_barcodes='$sa' and plantcode='$plantcode'") or die(mysqli_error($link));
			$tot_barcode2=mysqli_num_rows($sql_barcode2);
			if($tot_barcode2 > 0)
			{
				if($zx!="")
				$zx=$zx.",".$sa;
				else
				$zx=$sa;
			}
			
			/*if(in_array($sa,$arr))
			{
				if($zx!="")
				$zx=$zx.",".$sa;
				else
				$zx=$sa;
			}*/
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
	//echo $zx;
	if($zx!="")
	{
		$sysarr=explode(",",$zx);
		$finarr = array_merge(array_diff($arr, $sysarr));
		$count=sizeof($sysarr);
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$newbars=trim($_POST['newbars']);
		$finalarr=trim($_POST['finalarr']);
		$newnnob=trim($_POST['nnob']);
		$newgwt=trim($_POST['gwt']);
		$operatorcode=trim($_POST['operatorcode']);
		$wtmaccode=trim($_POST['wtmaccode']);
		$dobg1=explode("-",$dobg);
		$dobg2=$dobg1[2]."-".$dobg1[1]."-".$dobg1[0];
		
		$finbar=$newbars.",".$finalarr;
		$asd=explode(",",$finbar);
		foreach($asd as $finalbarcodes)
		{
			if($finalbarcodes<>"")
			{
				$sql_barcode="Insert into tbl_barcodestmp (bar_barcodes, bar_lotno, bar_tid, bar_subid, bar_logid, bar_yearid, bar_psrn, bar_grosswt, bar_wtdate, bar_poprid, bar_wtmcode, bar_bctyp, plantcode) values('$finalbarcodes', '$lotno', '$tid', '$subtid', '$logid', '$yearid_id' , '$txtpsrn', '$newgwt', '$dobg2', '$operatorcode', '$wtmaccode', 'range', '$plantcode')";
				//echo "<br/>";
				mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
			}
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
		/*
		echo "<script>
		opener.document.frmaddDepartment.detmpbno.value=$newnnob;
		opener.document.frmaddDepartment.mobar.value=$totbtsls;
		var x='dtail_$dval';
		opener.document.getElementById(x).innerHTML='<a href=Javascript:void(0) onclick=detailspop()>Details</a>';
		window.opener.bcsyncchk();
		self.close();
		</script>";	*/
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
}
function mySubmit()
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
return true;

}

function searchbarcode(searchval, tno)
{
	if(searchval.length==11)
	{
		var z=searchval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				return false;
			}
		}
		var pcode=document.from.plantcodes.value.split(",");
		var ycode=document.from.yearcodes.value.split(",");
		/*var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('confbarcodes'+[tno]).value="";
			document.getElementById('confbarcodes'+[tno]).focus();
			return false;
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById('confbarcodes'+[tno]).value="";
			document.getElementById('confbarcodes'+[tno]).focus();
			return false;
		}*/
		
		var id="barserch"+tno;
		var finar=document.from.finalarr.value;
		var dupnos=document.from.totdupbar.value;
		var sno=document.from.sysarr.value;
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
		searchUser(searchval,id,"barsearch",tno,finar,dupnos,xz);
	}
}
function chkbalbar(mltval1,tno)
{
	var mltval=mltval1;
	alert(mltval);
	if(mltval=="")
	{
		//alert("Invalid Barcode");
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				return false;
			}
		}
		var pcode=document.from.plantcodes.value.split(",");
		var ycode=document.from.yearcodes.value.split(",");
		/*var x=0;
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('confbarcodes'+[tno]).value="";
			document.getElementById('confbarcodes'+[tno]).focus();
			return false;
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById('confbarcodes'+[tno]).value="";
			document.getElementById('confbarcodes'+[tno]).focus();
			return false;
		}*/
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
}
</script>
			
</head>
<body topmargin="0" >
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
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">No. of Barcodes Mis Out(s) - not part of range&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobmos" id="nobmos" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nobmos;?>" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">No. of Duplicate Barcodes - already present in system&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobdups" id="nobdups" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $count;?>" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">Net Number of Barcodes&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nnob" id="nnob" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nnob-$count;?>" /></td>
</tr>
<tr class="light" height="25">
	<td colspan="2" align="right" valign="middle" class="tblheading">Weighing Date&nbsp;</td>
	<td colspan="2" align="left" valign="middle" class="tblheading">&nbsp;<input name="dobg" id="dobg" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $dobg;?>" maxlength="10" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
	<td colspan="2" align="right" valign="middle" class="tblheading">Weighing Machine Operator&nbsp;</td>
	<td colspan="2" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="operatorcode" class="tbltext" value="<?php echo $operatorcode;?>" size="20" maxlength="20" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
	<td colspan="2" align="right" valign="middle" class="tblheading">Weighing Machine&nbsp;</td>
	<td colspan="2" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="wtmaccode" class="tbltext" value="<?php echo $wtmaccode;?>" size="20" maxlength="20" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">Gross Weight&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="gwt" id="gwt" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $gwt;?>" /></td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">Selected Barcodes</td>
<td  align="center" valign="middle" class="tblheading">Mis Out Barcodes</td>
<td  align="center" valign="middle" class="tblheading">Barcodes to be changed</td>
<td  align="center" valign="middle" class="tblheading">Accepted Barcodes</td>
</tr>
<tr class="Dark" height="25">
<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($main_array1 as $mainarr) if($mainarr<>"") echo $mainarr."<br/>";?></td>
<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($so_array1 as $soarr) if($soarr<>"") echo $soarr."<br/>"; ?></td>
<td width="25%" align="center" valign="Top" class="tblheading" style="padding-top:5px;"><?php $ccnt=0; foreach($sysarr as $sysarr1) { if($sysarr1<>"") { $ccnt++; ?>
<?php echo $sysarr1;?><?php /*?>
<div id="barserch<?php echo $ccnt;?>" style="padding:5px,5px,5px,5px; vertical-align:top;"> <input type="text"  name="confbarcodes<?php echo $ccnt;?>" id="confbarcodes<?php echo $ccnt;?>" onkeyup="searchbarcode(this.value,'<?php echo $ccnt;?>')" onkeypress="return isNumberKey24(event)" onblur="chkbalbar(this.value,'<?php echo $ccnt;?>')" size="11" maxlength="11" class="tbltext" value="<?php echo $sysarr1;?>"><font color="#FF0000" >* </font> </div><?php*/?><input type="hidden" name="totbarok<?php echo $ccnt;?>" id="totbarok<?php echo $ccnt;?>" value="1" /><?php echo "<br/>";} }?> <input type="hidden" name="totdupbar" value="<?php echo $count;?>" /></td>
<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($finarr as $finarr1) if($finarr1<>"") echo $finarr1."<br/>"; ?></td>
</tr>
</table>

<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >

<td align="center" colspan="3"><a href="getuser_pronpslip_barcode_cb.php?totnomp=<?php echo $totnomp?>&tid=<?php echo $tid?>&subtid=<?php echo $subtid?>&lotno=<?php echo $lotno?>&txtpsrn=<?php echo $txtpsrn?>&nobe=<?php echo $nobe?>&nobmos=<?php echo $nobmos?>&nnob=<?php echo $nnob?>&dval=<?php echo $dval?>&m1=<?php echo $m1?>&m2=<?php echo $m2?>&m3=<?php echo $m3?>&m4=<?php echo $m4?>&m5=<?php echo $m5?>&m6=<?php echo $m6?>&m7=<?php echo $m7?>&m8=<?php echo $m8?>&m9=<?php echo $m9?>&m10=<?php echo $m10?>&m11=<?php echo $m11?>&m12=<?php echo $m12?>&m13=<?php echo $m13?>&m14=<?php echo $m14?>&m15=<?php echo $m15?>&m16=<?php echo $m16?>&m17=<?php echo $m17?>&m18=<?php echo $m18?>&m19=<?php echo $m19?>&m20=<?php echo $m20?>&m21=<?php echo $m21?>&m22=<?php echo $m22?>&m23=<?php echo $m23?>&m24=<?php echo $m24?>&m25=<?php echo $m25?>&m26=<?php echo $m26?>&m27=<?php echo $m27?>&m28=<?php echo $m28?>&m29=<?php echo $m29?>&m30=<?php echo $m30?>&m31=<?php echo $m31?>&m32=<?php echo $m32?>&m33=<?php echo $m33?>&m34=<?php echo $m34?>&m35=<?php echo $m35?>&m36=<?php echo $m36?>&m37=<?php echo $m37?>&m38=<?php echo $m38?>&m39=<?php echo $m39?>&m40=<?php echo $m40?>&rf1=<?php echo $_REQUEST['rf1']?>&rt1=<?php echo $_REQUEST['rt1']?>&rf2=<?php echo $_REQUEST['rf2']?>&rt2=<?php echo $_REQUEST['rt2']?>&rf3=<?php echo $_REQUEST['rf3']?>&rt3=<?php echo $_REQUEST['rt3']?>&rf4=<?php echo $_REQUEST['rf4']?>&rt4=<?php echo $_REQUEST['rt4']?>&rf5=<?php echo $_REQUEST['rf5']?>&rt5=<?php echo $_REQUEST['rt5']?>&rf6=<?php echo $_REQUEST['rf6']?>&rt6=<?php echo $_REQUEST['rt6']?>&mo1=<?php echo $mo1?>&mo2=<?php echo $mo2?>&mo3=<?php echo $mo3?>&mo4=<?php echo $mo4?>&mo5=<?php echo $mo5?>&mo6=<?php echo $mo6?>&mo7=<?php echo $mo7?>&mo8=<?php echo $mo8?>&mo9=<?php echo $mo9?>&mo10=<?php echo $mo10?>&mo11=<?php echo $mo11?>&mo12=<?php echo $mo12?>&mo13=<?php echo $mo13?>&mo14=<?php echo $mo14?>&mo15=<?php echo $mo15?>&mo16=<?php echo $mo16?>&mo17=<?php echo $mo17?>&mo18=<?php echo $mo18?>&mo19=<?php echo $mo19?>&mo20=<?php echo $mo20?>&mo21=<?php echo $mo21?>&mo22=<?php echo $mo22?>&mo23=<?php echo $mo23?>&mo24=<?php echo $mo24?>&mo25=<?php echo $mo25?>&mo26=<?php echo $mo26?>&mo27=<?php echo $mo27?>&mo28=<?php echo $mo28?>&mo29=<?php echo $mo29?>&mo30=<?php echo $mo30?>&mo31=<?php echo $mo31?>&mo32=<?php echo $mo32?>&mo33=<?php echo $mo33?>&mo34=<?php echo $mo34?>&mo35=<?php echo $mo35?>&mo36=<?php echo $mo36?>&mo37=<?php echo $mo37?>&mo38=<?php echo $mo38?>&mo39=<?php echo $mo39?>&mo40=<?php echo $mo40?>&gwt=<?php echo $gwt?>&dobg=<?php echo $_REQUEST['dobg']?>&operatorcode=<?php echo $_REQUEST['operatorcode']?>&wtmaccode=<?php echo $_REQUEST['wtmaccode']?>" ><img src="../images/edit.gif" border="0" style="cursor:pointer" /></a>&nbsp;<input type="image" src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
<!--&rf7=<?php echo $_REQUEST['rf7']?>&rt7=<?php echo $_REQUEST['rt7']?>&rf8=<?php echo $_REQUEST['rf8']?>&rt8=<?php echo $_REQUEST['rt8']?>&rf9=<?php echo $_REQUEST['rf9']?>&rt9=<?php echo $_REQUEST['rt9']?>&rf10=<?php echo $_REQUEST['rf10']?>&rt10=<?php echo $_REQUEST['rt10']?>-->
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
