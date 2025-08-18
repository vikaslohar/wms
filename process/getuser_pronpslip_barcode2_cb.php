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
	$gwt=$_REQUEST['gwt'];
	
	if(isset($_REQUEST['m1'])) { $m1=$_REQUEST['m1']; } else { $m1="";}
	if(isset($_REQUEST['m2'])) { $m2=$_REQUEST['m2']; } else { $m2="";}
	if(isset($_REQUEST['m3'])) { $m3=$_REQUEST['m3']; } else { $m3="";}
	if(isset($_REQUEST['m4'])) { $m4=$_REQUEST['m4']; } else { $m4="";}
	if(isset($_REQUEST['m5'])) { $m5=$_REQUEST['m5']; } else { $m5="";}
	if(isset($_REQUEST['m6'])) { $m6=$_REQUEST['m6']; } else { $m6="";}
	if(isset($_REQUEST['m7'])) { $m7=$_REQUEST['m7']; } else { $m7="";}
	if(isset($_REQUEST['m8'])) { $m8=$_REQUEST['m8']; } else { $m8="";}
	if(isset($_REQUEST['m9'])) { $m9=$_REQUEST['m9']; } else { $m9="";}
	if(isset($_REQUEST['m10'])) { $m10=$_REQUEST['m10']; } else { $m10="";}
	if(isset($_REQUEST['m11'])) { $m11=$_REQUEST['m11']; } else { $m11="";}
	if(isset($_REQUEST['m12'])) { $m12=$_REQUEST['m12']; } else { $m12="";}
	if(isset($_REQUEST['m13'])) { $m13=$_REQUEST['m13']; } else { $m13="";}
	if(isset($_REQUEST['m14'])) { $m14=$_REQUEST['m14']; } else { $m14="";}
	if(isset($_REQUEST['m15'])) { $m15=$_REQUEST['m15']; } else { $m15="";}
	if(isset($_REQUEST['m16'])) { $m16=$_REQUEST['m16']; } else { $m16="";}
	if(isset($_REQUEST['m17'])) { $m17=$_REQUEST['m17']; } else { $m17="";}
	if(isset($_REQUEST['m18'])) { $m18=$_REQUEST['m18']; } else { $m18="";}
	if(isset($_REQUEST['m19'])) { $m19=$_REQUEST['m19']; } else { $m19="";}
	if(isset($_REQUEST['m20'])) { $m20=$_REQUEST['m20']; } else { $m20="";}
	if(isset($_REQUEST['m21'])) { $m21=$_REQUEST['m21']; } else { $m21="";}
	if(isset($_REQUEST['m22'])) { $m22=$_REQUEST['m22']; } else { $m22="";}
	if(isset($_REQUEST['m23'])) { $m23=$_REQUEST['m23']; } else { $m23="";}
	if(isset($_REQUEST['m24'])) { $m24=$_REQUEST['m24']; } else { $m24="";}
	if(isset($_REQUEST['m25'])) { $m25=$_REQUEST['m25']; } else { $m25="";}
	if(isset($_REQUEST['m26'])) { $m26=$_REQUEST['m26']; } else { $m26="";}
	if(isset($_REQUEST['m27'])) { $m27=$_REQUEST['m27']; } else { $m27="";}
	if(isset($_REQUEST['m28'])) { $m28=$_REQUEST['m28']; } else { $m28="";}
	if(isset($_REQUEST['m29'])) { $m29=$_REQUEST['m29']; } else { $m29="";}
	if(isset($_REQUEST['m30'])) { $m30=$_REQUEST['m30']; } else { $m30="";}
	if(isset($_REQUEST['m31'])) { $m31=$_REQUEST['m31']; } else { $m31="";}
	if(isset($_REQUEST['m32'])) { $m32=$_REQUEST['m32']; } else { $m32="";}
	if(isset($_REQUEST['m33'])) { $m33=$_REQUEST['m33']; } else { $m33="";}
	if(isset($_REQUEST['m34'])) { $m34=$_REQUEST['m34']; } else { $m34="";}
	if(isset($_REQUEST['m35'])) { $m35=$_REQUEST['m35']; } else { $m35="";}
	if(isset($_REQUEST['m36'])) { $m36=$_REQUEST['m36']; } else { $m36="";}
	if(isset($_REQUEST['m37'])) { $m37=$_REQUEST['m37']; } else { $m37="";}
	if(isset($_REQUEST['m38'])) { $m38=$_REQUEST['m38']; } else { $m38="";}
	if(isset($_REQUEST['m39'])) { $m39=$_REQUEST['m39']; } else { $m39="";}
	if(isset($_REQUEST['m40'])) { $m40=$_REQUEST['m40']; } else { $m40="";}

	if(isset($_REQUEST['rf1'])) { $rf1=$_REQUEST['rf1']; } else { $rf1="";}
	if(isset($_REQUEST['rt1'])) { $rt1=$_REQUEST['rt1']; } else { $rt1="";}
	if(isset($_REQUEST['rf2'])) { $rf2=$_REQUEST['rf2']; } else { $rf2="";}
	if(isset($_REQUEST['rt2'])) { $rt2=$_REQUEST['rt2']; } else { $rt2="";}
	if(isset($_REQUEST['rf3'])) { $rf3=$_REQUEST['rf3']; } else { $rf3="";}
	if(isset($_REQUEST['rt3'])) { $rt3=$_REQUEST['rt3']; } else { $rt3="";}
	if(isset($_REQUEST['rf4'])) { $rf4=$_REQUEST['rf4']; } else { $rf4="";}
	if(isset($_REQUEST['rt4'])) { $rt4=$_REQUEST['rt4']; } else { $rt4="";}
	if(isset($_REQUEST['rf5'])) { $rf5=$_REQUEST['rf5']; } else { $rf5="";}
	if(isset($_REQUEST['rt5'])) { $rt5=$_REQUEST['rt5']; } else { $rt5="";}
	if(isset($_REQUEST['rf6'])) { $rf6=$_REQUEST['rf6']; } else { $rf6="";}
	if(isset($_REQUEST['rt6'])) { $rt6=$_REQUEST['rt6']; } else { $rt6="";}
	if(isset($_REQUEST['rf7'])) { $rf7=$_REQUEST['rf7']; } else { $rf7="";}
	if(isset($_REQUEST['rt7'])) { $rt7=$_REQUEST['rt7']; } else { $rt7="";}
	if(isset($_REQUEST['rf8'])) { $rf8=$_REQUEST['rf8']; } else { $rf8="";}
	if(isset($_REQUEST['rt8'])) { $rt8=$_REQUEST['rt8']; } else { $rt8="";}
	if(isset($_REQUEST['rf9'])) { $rf9=$_REQUEST['rf9']; } else { $rf9="";}
	if(isset($_REQUEST['rt9'])) { $rt9=$_REQUEST['rt9']; } else { $rt9="";}
	if(isset($_REQUEST['rf10'])) { $rf10=$_REQUEST['rf10']; } else { $rf10="";}
	if(isset($_REQUEST['rt10'])) { $rt10=$_REQUEST['rt10']; } else { $rt10="";}
	
	if(isset($_REQUEST['mo1'])) { $mo1=$_REQUEST['mo1']; } else { $mo1="";}
	if(isset($_REQUEST['mo2'])) { $mo2=$_REQUEST['mo2']; } else { $mo2="";}
	if(isset($_REQUEST['mo3'])) { $mo3=$_REQUEST['mo3']; } else { $mo3="";}
	if(isset($_REQUEST['mo4'])) { $mo4=$_REQUEST['mo4']; } else { $mo4="";}
	if(isset($_REQUEST['mo5'])) { $mo5=$_REQUEST['mo5']; } else { $mo5="";}
	if(isset($_REQUEST['mo6'])) { $mo6=$_REQUEST['mo6']; } else { $mo6="";}
	if(isset($_REQUEST['mo7'])) { $mo7=$_REQUEST['mo7']; } else { $mo7="";}
	if(isset($_REQUEST['mo8'])) { $mo8=$_REQUEST['mo8']; } else { $mo8="";}
	if(isset($_REQUEST['mo9'])) { $mo9=$_REQUEST['mo9']; } else { $mo9="";}
	if(isset($_REQUEST['mo10'])) { $mo10=$_REQUEST['mo10']; } else { $mo10="";}
	if(isset($_REQUEST['mo11'])) { $mo11=$_REQUEST['mo11']; } else { $mo11="";}
	if(isset($_REQUEST['mo12'])) { $mo12=$_REQUEST['mo12']; } else { $mo12="";}
	if(isset($_REQUEST['mo13'])) { $mo13=$_REQUEST['mo13']; } else { $mo13="";}
	if(isset($_REQUEST['mo14'])) { $mo14=$_REQUEST['mo14']; } else { $mo14="";}
	if(isset($_REQUEST['mo15'])) { $mo15=$_REQUEST['mo15']; } else { $mo15="";}
	if(isset($_REQUEST['mo16'])) { $mo16=$_REQUEST['mo16']; } else { $mo16="";}
	if(isset($_REQUEST['mo17'])) { $mo17=$_REQUEST['mo17']; } else { $mo17="";}
	if(isset($_REQUEST['mo18'])) { $mo18=$_REQUEST['mo18']; } else { $mo18="";}
	if(isset($_REQUEST['mo19'])) { $mo19=$_REQUEST['mo19']; } else { $mo19="";}
	if(isset($_REQUEST['mo20'])) { $mo20=$_REQUEST['mo20']; } else { $mo20="";}
	if(isset($_REQUEST['mo21'])) { $mo21=$_REQUEST['mo21']; } else { $mo21="";}
	if(isset($_REQUEST['mo22'])) { $mo22=$_REQUEST['mo22']; } else { $mo22="";}
	if(isset($_REQUEST['mo23'])) { $mo23=$_REQUEST['mo23']; } else { $mo23="";}
	if(isset($_REQUEST['mo24'])) { $mo24=$_REQUEST['mo24']; } else { $mo24="";}
	if(isset($_REQUEST['mo25'])) { $mo25=$_REQUEST['mo25']; } else { $mo25="";}
	if(isset($_REQUEST['mo26'])) { $mo26=$_REQUEST['mo26']; } else { $mo26="";}
	if(isset($_REQUEST['mo27'])) { $mo27=$_REQUEST['mo27']; } else { $mo27="";}
	if(isset($_REQUEST['mo28'])) { $mo28=$_REQUEST['mo28']; } else { $mo28="";}
	if(isset($_REQUEST['mo29'])) { $mo29=$_REQUEST['mo29']; } else { $mo29="";}
	if(isset($_REQUEST['mo30'])) { $mo30=$_REQUEST['mo30']; } else { $mo30="";}
	if(isset($_REQUEST['mo31'])) { $mo31=$_REQUEST['mo31']; } else { $mo31="";}
	if(isset($_REQUEST['mo32'])) { $mo32=$_REQUEST['mo32']; } else { $mo32="";}
	if(isset($_REQUEST['mo33'])) { $mo33=$_REQUEST['mo33']; } else { $mo33="";}
	if(isset($_REQUEST['mo34'])) { $mo34=$_REQUEST['mo34']; } else { $mo34="";}
	if(isset($_REQUEST['mo35'])) { $mo35=$_REQUEST['mo35']; } else { $mo35="";}
	if(isset($_REQUEST['mo36'])) { $mo36=$_REQUEST['mo36']; } else { $mo36="";}
	if(isset($_REQUEST['mo37'])) { $mo37=$_REQUEST['mo37']; } else { $mo37="";}
	if(isset($_REQUEST['mo38'])) { $mo38=$_REQUEST['mo38']; } else { $mo38="";}
	if(isset($_REQUEST['mo39'])) { $mo39=$_REQUEST['mo39']; } else { $mo39="";}
	if(isset($_REQUEST['mo40'])) { $mo40=$_REQUEST['mo40']; } else { $mo40="";}
	
	$sql_barcode24=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_barcode24=mysqli_num_rows($sql_barcode24);
	if($tot_barcode24 > 0)
	{ $cont=0;
		while($row_barcode24=mysqli_fetch_array($sql_barcode24))
		{
			$cont++;
			if($abarc!="")
			$abarc=$abarc.",".$row_barcode24['bar_barcodes'];
			else
			$abarc=$row_barcode24['bar_barcodes'];
			$gwt=$row_barcode24['bar_grosswt'];
		}
	}
	/*$s_sub3="delete from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));*/
	
	$nobapmp=$_REQUEST['nobapmp'];
	$nobe=$cont;
	$nobmos=0;
	$nnob=$cont;
	$so_array="";
	$arr=explode(",",$abarc);
	$main_array1=$arr;
	$so_array1=explode(",",$so_array);

	//print_r($arr);
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
		$finbar=$newbars.",".$finalarr;
		$asd=explode(",",$finbar);
		
		$s_sub3="delete from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'";
		mysqli_query($link,$s_sub3) or die(mysqli_error($link));
	
		foreach($asd as $finalbarcodes)
		{
		if($finalbarcodes<>"")
		{
		$sql_barcode="Insert into tbl_barcodestmp (bar_barcodes, bar_lotno, bar_tid, bar_subid, bar_logid, bar_yearid, bar_psrn, plantcode) values('$finalbarcodes', '$lotno', '$tid', '$subtid', '$logid', '$yearid_id', '$txtpsrn', '$plantcode')";
		//echo "<br/>";
		mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
		}
		}
		//exit; 
		
		echo "<script>
		opener.document.frmaddDepartment.detmpbno.value=$newnnob;
		var x='dtail_$dval';
		opener.document.getElementById(x).innerHTML='<a href=Javascript:void(0) onclick=detailspop()>Details</a>';
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
	if(document.from.sysarr.value>0)
	{
	document.from.confbarcodes1.focus();
	}
}
function isNumberKey(evt)
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
	if(searchval.length==9)
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
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
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
		}
		
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
	var x=0
	var y=0;
	for(var i=0; i<pcode.length; i++)
	{
		if(pcode[i]==a)
		{
			x++;
		}
	}
	if(x==0)
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
	}
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
	   <input type="hidden" name="subid" value="<?php echo $subtid;?>" />
	   <input type="hidden" name="mainarr" value="<?php echo implode(",",$arr);?>" />
	   <input type="hidden" name="dval24" value="<?php echo $dval;?>" />
	   <input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	  <input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" />
	  
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
</tr>
<tr class="light" height="20">
  <td  align="right" class="tblheading">No. of Duplicate Barcodes - already present in system&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobdups" id="nobdups" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $count;?>" /></td>
</tr>-->
<tr class="light" height="20">
  <td  align="right" class="tblheading">Net Number of Barcodes&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nnob" id="nnob" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $nnob-$count;?>" /></td>
</tr>
<tr class="light" height="20">
  <td  align="right" class="tblheading">Gross Weight&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="gwt" id="gwt" class="tbltext" style="background-color:#CCCCCC" readonly="true" size="5" value="<?php echo $gwt;?>" /></td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">Selected Barcodes</td>
<!--<td  align="center" valign="middle" class="tblheading">Mis Out Barcodes</td>-->
<td  align="center" valign="middle" class="tblheading">Barcodes to be changed</td>
<!--<td  align="center" valign="middle" class="tblheading">Accepted Barcodes</td>-->
</tr>
<tr class="Dark" height="25">
<td width="50%" align="center" valign="Top" class="tblheading"><?php foreach($main_array1 as $mainarr) if($mainarr<>"") echo $mainarr."<br/>";?></td>
<!--<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($so_array1 as $soarr) if($soarr<>"") echo $soarr."<br/>"; ?></td>-->
<td width="50%" align="center" valign="Top" class="tblheading" style="padding-top:5px;"><?php $ccnt=0; foreach($main_array1 as $sysarr1) { if($sysarr1<>"") { $ccnt++; 

echo "<div id='barserch$ccnt' style='padding:5px,5px,5px,5px;vertical-align:top;'><input type='text' name='confbarcodes$ccnt' id='confbarcodes$ccnt' onkeyup='searchbarcode(this.value,$ccnt)' onkeypress='return isNumberKey(event)' onblur='chkbalbar(this.value,$ccnt)' size='10' maxlength='9' class='tbltext' value='$sysarr1'><input type='hidden' name='totbarok$ccnt' id='totbarok$ccnt' value='1' /> </div>"; } }?><input type="hidden" name="totdupbar" value="<?php echo $count;?>" /></td>
<!--<td width="25%" align="center" valign="Top" class="tblheading"><?php foreach($finarr as $finarr1) if($finarr1<>"") echo $finarr1."<br/>"; ?></td>-->
</tr>
</table>

<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" colspan="3"><a href="getuser_pronpslip_barcode.php?totnomp=<?php echo $totnomp?>&tid=<?php echo $tid?>&subtid=<?php echo $subtid?>&lotno=<?php echo $lotno?>&txtpsrn=<?php echo $txtpsrn?>&nobe=<?php echo $nobe?>&nobmos=<?php echo $nobmos?>&nnob=<?php echo $nnob?>&dval=<?php echo $dval?>&m1=<?php echo $m1?>&m2=<?php echo $m2?>&m3=<?php echo $m3?>&m4=<?php echo $m4?>&m5=<?php echo $m5?>&m6=<?php echo $m6?>&m7=<?php echo $m7?>&m8=<?php echo $m8?>&m9=<?php echo $m9?>&m10=<?php echo $m10?>&m11=<?php echo $m11?>&m12=<?php echo $m12?>&m13=<?php echo $m13?>&m14=<?php echo $m14?>&m15=<?php echo $m15?>&m16=<?php echo $m16?>&m17=<?php echo $m17?>&m18=<?php echo $m18?>&m19=<?php echo $m19?>&m20=<?php echo $m20?>&m21=<?php echo $m21?>&m22=<?php echo $m22?>&m23=<?php echo $m23?>&m24=<?php echo $m24?>&m25=<?php echo $m25?>&m26=<?php echo $m26?>&m27=<?php echo $m27?>&m28=<?php echo $m28?>&m29=<?php echo $m29?>&m30=<?php echo $m30?>&m31=<?php echo $m31?>&m32=<?php echo $m32?>&m33=<?php echo $m33?>&m34=<?php echo $m34?>&m35=<?php echo $m35?>&m36=<?php echo $m36?>&m37=<?php echo $m37?>&m38=<?php echo $m38?>&m39=<?php echo $m39?>&m40=<?php echo $m40?>&rf1=<?php echo $_REQUEST['rf1']?>&rt1=<?php echo $_REQUEST['rt1']?>&rf2=<?php echo $_REQUEST['rf2']?>&rt2=<?php echo $_REQUEST['rt2']?>&rf3=<?php echo $_REQUEST['rf3']?>&rt3=<?php echo $_REQUEST['rt3']?>&rf4=<?php echo $_REQUEST['rf4']?>&rt4=<?php echo $_REQUEST['rt4']?>&rf5=<?php echo $_REQUEST['rf5']?>&rt5=<?php echo $_REQUEST['rt5']?>&rf6=<?php echo $_REQUEST['rf6']?>&rt6=<?php echo $_REQUEST['rt6']?>&rf7=<?php echo $_REQUEST['rf7']?>&rt7=<?php echo $_REQUEST['rt7']?>&rf8=<?php echo $_REQUEST['rf8']?>&rt8=<?php echo $_REQUEST['rt8']?>&rf9=<?php echo $_REQUEST['rf9']?>&rt9=<?php echo $_REQUEST['rt9']?>&rf10=<?php echo $_REQUEST['rf10']?>&rt10=<?php echo $_REQUEST['rt10']?>&mo1=<?php echo $mo1?>&mo2=<?php echo $mo2?>&mo3=<?php echo $mo3?>&mo4=<?php echo $mo4?>&mo5=<?php echo $mo5?>&mo6=<?php echo $mo6?>&mo7=<?php echo $mo7?>&mo8=<?php echo $mo8?>&mo9=<?php echo $mo9?>&mo10=<?php echo $mo10?>&mo11=<?php echo $mo11?>&mo12=<?php echo $mo12?>&mo13=<?php echo $mo13?>&mo14=<?php echo $mo14?>&mo15=<?php echo $mo15?>&mo16=<?php echo $mo16?>&mo17=<?php echo $mo17?>&mo18=<?php echo $mo18?>&mo19=<?php echo $mo19?>&mo20=<?php echo $mo20?>&mo21=<?php echo $mo21?>&mo22=<?php echo $mo22?>&mo23=<?php echo $mo23?>&mo24=<?php echo $mo24?>&mo25=<?php echo $mo25?>&mo26=<?php echo $mo26?>&mo27=<?php echo $mo27?>&mo28=<?php echo $mo28?>&mo29=<?php echo $mo29?>&mo30=<?php echo $mo30?>&mo31=<?php echo $mo31?>&mo32=<?php echo $mo32?>&mo33=<?php echo $mo33?>&mo34=<?php echo $mo34?>&mo35=<?php echo $mo35?>&mo36=<?php echo $mo36?>&mo37=<?php echo $mo37?>&mo38=<?php echo $mo38?>&mo39=<?php echo $mo39?>&mo40=<?php echo $mo40?>" ><img src="../images/edit.gif" border="0" style="cursor:pointer" /></a>&nbsp;<input type="image" src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
