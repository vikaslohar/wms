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
	
	
	if(isset($_REQUEST['totnomp'])) { $totnomp = $_REQUEST['totnomp']; }
	if(isset($_REQUEST['tid'])) { $tid = $_REQUEST['tid']; }
	if(isset($_REQUEST['subtid'])) { $subtid = $_REQUEST['subtid']; }
	if(isset($_REQUEST['lotno'])) { $lotno = $_REQUEST['lotno']; }
	if(isset($_REQUEST['txtpsrn'])) { $txtpsrn = $_REQUEST['txtpsrn']; }
	if(isset($_REQUEST['nobe'])) { $nobe=$_REQUEST['nobe']; } else { $nobe=0;}
	if(isset($_REQUEST['nobmos'])) { $nobmos=$_REQUEST['nobmos']; } else { $nobmos=0;}
	if(isset($_REQUEST['nnob'])) { $nnob=$_REQUEST['nnob']; } else { $nnob=0;}
	if(isset($_REQUEST['dval'])) { $dval=$_REQUEST['dval']; }
	if(isset($_REQUEST['gwt'])) { $gwt=$_REQUEST['gwt']; }
	if(isset($_REQUEST['dobg'])) { $dobg=$_REQUEST['dobg']; } else { $dobg=date("d-m-Y");}
	if(isset($_REQUEST['operatorcode'])) { $operatorcode=$_REQUEST['operatorcode']; } else { $operatorcode="";}
	if(isset($_REQUEST['wtmaccode'])) { $wtmaccode=$_REQUEST['wtmaccode']; } else { $wtmaccode="";}
	
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
	/*if(isset($_REQUEST['rt6'])) { $rt6=$_REQUEST['rt6']; } else { $rt6="";}
	if(isset($_REQUEST['rf7'])) { $rf7=$_REQUEST['rf7']; } else { $rf7="";}
	if(isset($_REQUEST['rt7'])) { $rt7=$_REQUEST['rt7']; } else { $rt7="";}
	if(isset($_REQUEST['rf8'])) { $rf8=$_REQUEST['rf8']; } else { $rf8="";}
	if(isset($_REQUEST['rt8'])) { $rt8=$_REQUEST['rt8']; } else { $rt8="";}
	if(isset($_REQUEST['rf9'])) { $rf9=$_REQUEST['rf9']; } else { $rf9="";}
	if(isset($_REQUEST['rt9'])) { $rt9=$_REQUEST['rt9']; } else { $rt9="";}
	if(isset($_REQUEST['rf10'])) { $rf10=$_REQUEST['rf10']; } else { $rf10="";}
	if(isset($_REQUEST['rt10'])) { $rt10=$_REQUEST['rt10']; } else { $rt10="";}*/
	
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
	
	if(isset($_POST['frm_action'])=='submit')
	{
	$nobapmp=trim($_POST['nobapmp']);
	$nobe=trim($_POST['nobe']);
	$nobmos=trim($_POST['nobmos']);
	$nnob=trim($_POST['nnob']);
	$newgwt=trim($_POST['gwt']);
	$dobg=trim($_POST['dobg']);
	$operatorcode=trim($_POST['operatorcode']);
	$wtmaccode=trim($_POST['wtmaccode']);
	
	$m1=trim($_POST['m1']);
	$m2=trim($_POST['m2']);
	$m3=trim($_POST['m3']);
	$m4=trim($_POST['m4']);
	$m5=trim($_POST['m5']);
	$m6=trim($_POST['m6']);
	$m7=trim($_POST['m7']);
	$m8=trim($_POST['m8']);
	$m9=trim($_POST['m9']);
	$m10=trim($_POST['m10']);
	$m11=trim($_POST['m11']);
	$m12=trim($_POST['m12']);
	$m13=trim($_POST['m13']);
	$m14=trim($_POST['m14']);
	$m15=trim($_POST['m15']);
	$m16=trim($_POST['m16']);
	$m17=trim($_POST['m17']);
	$m18=trim($_POST['m18']);
	$m19=trim($_POST['m19']);
	$m20=trim($_POST['m20']);
	$m21=trim($_POST['m21']);
	$m22=trim($_POST['m22']);
	$m23=trim($_POST['m23']);
	$m24=trim($_POST['m24']);
	$m25=trim($_POST['m25']);
	$m26=trim($_POST['m26']);
	$m27=trim($_POST['m27']);
	$m28=trim($_POST['m28']);
	$m29=trim($_POST['m29']);
	$m30=trim($_POST['m30']);
	$m31=trim($_POST['m31']);
	$m32=trim($_POST['m32']);
	$m33=trim($_POST['m33']);
	$m34=trim($_POST['m34']);
	$m35=trim($_POST['m35']);
	$m36=trim($_POST['m36']);
	$m37=trim($_POST['m37']);
	$m38=trim($_POST['m38']);
	$m39=trim($_POST['m39']);
	$m40=trim($_POST['m40']);
	
	$rf1=trim($_POST['rf1']);
	$rt1=trim($_POST['rt1']);
	$rf2=trim($_POST['rf2']);
	$rt2=trim($_POST['rt2']);
	$rf3=trim($_POST['rf3']);
	$rt3=trim($_POST['rt3']);
	$rf4=trim($_POST['rf4']);
	$rt4=trim($_POST['rt4']);
	$rf5=trim($_POST['rf5']);
	$rt5=trim($_POST['rt5']);
	$rf6=trim($_POST['rf6']);
	$rt6=trim($_POST['rt6']);
	/*$rf7=trim($_POST['rf7']);
	$rt7=trim($_POST['rt7']);
	$rf8=trim($_POST['rf8']);
	$rt8=trim($_POST['rt8']);
	$rf9=trim($_POST['rf9']);
	$rt9=trim($_POST['rt9']);
	$rf10=trim($_POST['rf10']);
	$rt10=trim($_POST['rt10']);*/
	
	$mo1=trim($_POST['mo1']);
	$mo2=trim($_POST['mo2']);
	$mo3=trim($_POST['mo3']);
	$mo4=trim($_POST['mo4']);
	$mo5=trim($_POST['mo5']);
	$mo6=trim($_POST['mo6']);
	$mo7=trim($_POST['mo7']);
	$mo8=trim($_POST['mo8']);
	$mo9=trim($_POST['mo9']);
	$mo10=trim($_POST['mo10']);
	$mo11=trim($_POST['mo11']);
	$mo12=trim($_POST['mo12']);
	$mo13=trim($_POST['mo13']);
	$mo14=trim($_POST['mo14']);
	$mo15=trim($_POST['mo15']);
	$mo16=trim($_POST['mo16']);
	$mo17=trim($_POST['mo17']);
	$mo18=trim($_POST['mo18']);
	$mo19=trim($_POST['mo19']);
	$mo20=trim($_POST['mo20']);
	$mo21=trim($_POST['mo21']);
	$mo22=trim($_POST['mo22']);
	$mo23=trim($_POST['mo23']);
	$mo24=trim($_POST['mo24']);
	$mo25=trim($_POST['mo25']);
	$mo26=trim($_POST['mo26']);
	$mo27=trim($_POST['mo27']);
	$mo28=trim($_POST['mo28']);
	$mo29=trim($_POST['mo29']);
	$mo30=trim($_POST['mo30']);
	$mo31=trim($_POST['mo31']);
	$mo32=trim($_POST['mo32']);
	$mo33=trim($_POST['mo33']);
	$mo34=trim($_POST['mo34']);
	$mo35=trim($_POST['mo35']);
	$mo36=trim($_POST['mo36']);
	$mo37=trim($_POST['mo37']);
	$mo38=trim($_POST['mo38']);
	$mo39=trim($_POST['mo39']);
	$mo40=trim($_POST['mo40']);
	//exit;
	echo "<script>window.location='getuser_pronpslip_barcode1_cb.php?totnomp=$totnomp&tid=$tid&subtid=$subtid&lotno=$lotno&txtpsrn=$txtpsrn&nobe=$nobe&nobmos=$nobmos&nnob=$nnob&dval=$dval&gwt=$newgwt&m1=$m1&m2=$m2&m3=$m3&m4=$m4&m5=$m5&m6=$m6&m7=$m7&m8=$m8&m9=$m9&m10=$m10&m11=$m11&m12=$m12&m13=$m13&m14=$m14&m15=$m15&m16=$m16&m17=$m17&m18=$m18&m19=$m19&m20=$m20&m21=$m21&m22=$m22&m23=$m23&m24=$m24&m25=$m25&m26=$m26&m27=$m27&m28=$m28&m29=$m29&m30=$m30&m31=$m31&m32=$m32&m33=$m33&m34=$m34&m35=$m35&m36=$m36&m37=$m37&m38=$m38&m39=$m39&m40=$m40&rf1=$rf1&rt1=$rt1&rf2=$rf2&rt2=$rt2&rf3=$rf3&rt3=$rt3&rf4=$rf4&rt4=$rt4&rf5=$rf5&rt5=$rt5&rf6=$rf6&rt6=$rt6&mo1=$mo1&mo2=$mo2&mo3=$mo3&mo4=$mo4&mo5=$mo5&mo6=$mo6&mo7=$mo7&mo8=$mo8&mo9=$mo9&mo10=$mo10&mo11=$mo11&mo12=$mo12&mo13=$mo13&mo14=$mo14&mo15=$mo15&mo16=$mo16&mo17=$mo17&mo18=$mo18&mo19=$mo19&mo20=$mo20&mo21=$mo21&mo22=$mo22&mo23=$mo23&mo24=$mo24&mo25=$mo25&mo26=$mo26&mo27=$mo27&mo28=$mo28&mo29=$mo29&mo30=$mo30&mo31=$mo31&mo32=$mo32&mo33=$mo33&mo34=$mo34&mo35=$mo35&mo36=$mo36&mo37=$mo37&mo38=$mo38&mo39=$mo39&mo40=$mo40&dobg=$dobg&operatorcode=$operatorcode&wtmaccode=$wtmaccode'</script>";
	
	/*echo "<script>window.location='getuser_pronpslip_barcode1_cb.php?totnomp=$totnomp&tid=$tid&subtid=$subtid&lotno=$lotno&txtpsrn=$txtpsrn&nobe=$nobe&nobmos=$nobmos&nnob=$nnob&dval=$dval&gwt=$newgwt&m1=$m1&m2=$m2&m3=$m3&m4=$m4&m5=$m5&m6=$m6&m7=$m7&m8=$m8&m9=$m9&m10=$m10&m11=$m11&m12=$m12&m13=$m13&m14=$m14&m15=$m15&m16=$m16&m17=$m17&m18=$m18&m19=$m19&m20=$m20&m21=$m21&m22=$m22&m23=$m23&m24=$m24&m25=$m25&m26=$m26&m27=$m27&m28=$m28&m29=$m29&m30=$m30&m31=$m31&m32=$m32&m33=$m33&m34=$m34&m35=$m35&m36=$m36&m37=$m37&m38=$m38&m39=$m39&m40=$m40&rf1=$rf1&rt1=$rt1&rf2=$rf2&rt2=$rt2&rf3=$rf3&rt3=$rt3&rf4=$rf4&rt4=$rt4&rf5=$rf5&rt5=$rt5&rf6=$rf6&rt6=$rt6&rf7=$rf7&rt7=$rt7&rf8=$rf8&rt8=$rt8&rf9=$rf9&rt9=$rt9&rf10=$rf10&rt10=$rt10&rf11=$rf11&rt11=$rt11&rf12=$rf12&rt12=$rt12&rf13=$rf13&rt13=$rt13&rf14=$rf14&rt14=$rt14&rf15=$rf15&rt15=$rt15&rf16=$rf16&rt16=$rt16&rf17=$rf17&rt17=$rt17&rf18=$rf18&rt18=$rt18&rf19=$rf19&rt19=$rt19&rf20=$rf20&rt20=$rt20&mo1=$mo1&mo2=$mo2&mo3=$mo3&mo4=$mo4&mo5=$mo5&mo6=$mo6&mo7=$mo7&mo8=$mo8&mo9=$mo9&mo10=$mo10&mo11=$mo11&mo12=$mo12&mo13=$mo13&mo14=$mo14&mo15=$mo15&mo16=$mo16&mo17=$mo17&mo18=$mo18&mo19=$mo19&mo20=$mo20&mo21=$mo21&mo22=$mo22&mo23=$mo23&mo24=$mo24&mo25=$mo25&mo26=$mo26&mo27=$mo27&mo28=$mo28&mo29=$mo29&mo30=$mo30&mo31=$mo31&mo32=$mo32&mo33=$mo33&mo34=$mo34&mo35=$mo35&mo36=$mo36&mo37=$mo37&mo38=$mo38&mo39=$mo39&mo40=$mo40&dobg=$dobg&operatorcode=$operatorcode&wtmaccode=$wtmaccode'</script>";
	
	 echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>"; */
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
<script language='javascript'>
function onloadfocus()
{
	opener.document.frmaddDepartment.detmpbno.value=0;
	document.from.m1.focus();
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
//opener.document.frmaddDepartment.detmpbno.value=document.from.foccode.value;
//self.close();

}
function mySubmit()
{
	//return false;
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
	if(document.from.gwt.value=="")
	{
		alert("You must enter Gross Weight");
		return false;
	}
	return true;

}

function mltmorechk()
{
	document.from.mltm.value=parseInt(document.from.mltm.value)+1;
	if(document.from.mltm.value<=10)
	{
		var mlt="mlt"+document.from.mltm.value;
		document.getElementById(mlt).style.display="block";
		var mmm="m"+(parseInt(document.from.mltm.value)*4-3)
		document.getElementById(mmm).focus();
	}
	else
	{
		alert("You have reached maximum level");
	}
}

function mltlesschk()
{
	if(document.from.mltm.value>=2)
	{
		if(document.from.mltm.value>10)
		document.from.mltm.value=(parseInt(document.from.mltm.value)-1);
		
		var mlt="mlt"+document.from.mltm.value;
		document.getElementById(mlt).style.display="none";
		document.getElementById("m"+[parseInt(document.from.mltm.value)*4-3]).value="";
		document.getElementById("m"+[parseInt(document.from.mltm.value)*4-2]).value="";
		document.getElementById("m"+[parseInt(document.from.mltm.value)*4-1]).value="";
		document.getElementById("m"+[parseInt(document.from.mltm.value)*4]).value="";
		document.from.mltm.value=(parseInt(document.from.mltm.value)-1);
	}
	else
	{
		alert("You have reached Minimum level");
	}
}

function rngmorechk()
{
	document.from.rnge.value=parseInt(document.from.rnge.value)+1;
	if(document.from.rnge.value<=10)
	{
		var rng="rng"+document.from.rnge.value;
		document.getElementById(rng).style.display="block";
		var mmm="rf"+(parseInt(document.from.rnge.value)*2-1)
		document.getElementById(mmm).focus();
	}
	else
	{
		alert("You have reached maximum level");
	}
}

function rnglesschk()
{
	if(document.from.rnge.value>=2)
	{
		if(document.from.rnge.value>10)
		document.from.rnge.value=parseInt(document.from.rnge.value)-1;
		
		var rng="rng"+document.from.rnge.value;
		//alert(rng);
		document.getElementById(rng).style.display="none";
		document.getElementById("rf"+[parseInt(document.from.rnge.value)*2-1]).value="";
		document.getElementById("rf"+[parseInt(document.from.rnge.value)*2]).value="";
		document.getElementById("rt"+[parseInt(document.from.rnge.value)*2-1]).value="";
		document.getElementById("rt"+[parseInt(document.from.rnge.value)*2]).value="";
		document.from.rnge.value=parseInt(document.from.rnge.value)-1;
	}
	else
	{
		alert("You have reached Minimum level");
	}
}
	
function motmorechk()
{
	document.from.moout.value=parseInt(document.from.moout.value)+1;
	if(document.from.moout.value<=10)
	{
		var mot="mot"+document.from.moout.value;
		document.getElementById(mot).style.display="block";
		var mmm="mo"+(parseInt(document.from.moout.value)*4-3)
		document.getElementById(mmm).focus();
	}
	else
	{
		alert("You have reached maximum level");
	}
}

function motlesschk()
{
	if(document.from.moout.value>=2)
	{
		if(document.from.moout.value>10)
		document.from.moout.value=parseInt(document.from.moout.value)-1;
		
		var mot="mot"+document.from.moout.value;
		document.getElementById(mot).style.display="none";
		document.getElementById("mo"+[parseInt(document.from.moout.value)*4-3]).value="";
		document.getElementById("mo"+[parseInt(document.from.moout.value)*4-2]).value="";
		document.getElementById("mo"+[parseInt(document.from.moout.value)*4-1]).value="";
		document.getElementById("mo"+[parseInt(document.from.moout.value)*4]).value="";
		document.from.moout.value=parseInt(document.from.moout.value)-1;
	}
	else
	{
		alert("You have reached Minimum level");
	}
}

function chkmlt(mltval, mltno)
{
	mltval=mltval.toUpperCase();
	document.getElementById('m'+[mltno]).value=document.getElementById('m'+[mltno]).value.toUpperCase();
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById('m'+[mltno]).value="";
		var mltm=parseInt(document.from.mltm.value)*4;
		var cnt=0;
		for (var i=1; i<=mltm; i++)
		{
			if(document.getElementById('m'+[i]).value!="")
			{ cnt++; }
		}
		document.getElementById('nobe').value=cnt;
		document.getElementById('nnob').value=parseInt(document.getElementById('nobe').value)-parseInt(document.getElementById('nobmos').value);
		document.getElementById('m'+[mltno]).focus();
		return false;
	}
	else
	{
		var mlt=document.from.mltm.value;
		var mltn=mltno-1;
		var mmll=mltno+1;
		if(mltno>=2)
		{
			if(document.getElementById('m'+[mltn]).value=="")
			{
				alert("Please enter Barcode Number in "+mltn);
				document.getElementById('m'+[mltno]).value="";
				document.getElementById('m'+[mltn]).focus();
				return false;
			}
		}
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltno]).focus();
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltno]).focus();
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById('m'+[mltno]).value="";
				document.getElementById('m'+[mltno]).focus();
				return false;
			}
		}
		mltn++;
		var m='m'+mltn;
		var pcode=document.from.plantcodes.value.split(",");
		var ycode=document.from.yearcodes.value.split(",");
		var x=0
		var y=0;
		/*for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
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
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
			return false;
		}*/

		var mltm=parseInt(document.from.mltm.value)*4;
		var cnt=0;
		for (var i=1; i<=mltm; i++)
		{
			if(document.getElementById('m'+[i]).value!="")
			{ cnt++; }
		}
		document.getElementById('nobe').value=cnt;
		document.getElementById('nnob').value=parseInt(document.getElementById('nobe').value)-parseInt(document.getElementById('nobmos').value);
		document.getElementById('m'+[mmll]).focus();
	}
}

function chkrngf(rngfval, rngfno)
{
	rngfval=rngfval.toUpperCase();
	document.getElementById('rf'+[rngfno]).value=document.getElementById('rf'+[rngfno]).value.toUpperCase();
	if(rngfval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById('rf'+[rngfno]).value="";
		document.getElementById('rf'+[rngfno]).focus();
		return false;
	}
	else
	{
		var mlt=document.from.rnge.value;
		var mltn=rngfno-1;
		var mmll=rngfno+1;
		if(rngfno>=2)
		{
			if(document.getElementById('rt'+[mltn]).value=="")
			{
				alert("Please enter Barcode Range");
				document.getElementById('rf'+[rngfno]).value="";
				document.getElementById('rt'+[mltn]).focus();
				return false;
			}
		}
		var z=rngfval.split("");
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
		mltn++;
		var pcode=document.from.plantcodes.value.split(",");
		var ycode=document.from.yearcodes.value.split(",");
		var x=0
		var y=0;
		/*for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('rf'+[rngfno]).value="";
			document.getElementById('rf'+[mltn]).focus();
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
			document.getElementById('rf'+[rngfno]).value="";
			document.getElementById('rf'+[mltn]).focus();
			return false;
		}*/
		document.getElementById('rt'+[rngfno]).focus();
	}
}

function chkrngt(rngtval, rngtno)
{
	rngtval=rngtval.toUpperCase();
	document.getElementById('rt'+[rngtno]).value=document.getElementById('rt'+[rngtno]).value.toUpperCase();
	if(rngtval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById('rt'+[rngtno]).value="";
		var mltm=parseInt(document.from.mltm.value)*4;
		var cnt=0;
		var mmll=rngtno+1;
		for (var i=1; i<=mltm; i++)
		{
			if(document.getElementById('m'+[i]).value!="")
			{ cnt++; }
		}
				
		var rnge=parseInt(document.from.rnge.value)*2;
		//alert(document.from.rnge.value);
		var cnt1=0;
		for (var j=1; j<=rnge; j++)
		{
			if(document.getElementById('rf'+[j]).value!="" && document.getElementById('rt'+[j]).value!="")
			{
				var xx=document.getElementById('rf'+[j]).value.split("");
				var zz=document.getElementById('rt'+[j]).value.split("");
				var valt1=zz[2]+zz[3]+zz[4]+zz[5]+zz[6]+zz[7]+zz[8]+zz[9]+zz[10];
				var valf1=xx[2]+xx[3]+xx[4]+xx[5]+xx[6]+xx[7]+xx[8]+xx[9]+xx[10];
				//alert(valf1); alert(valt1);
				for(var k=valf1; k<=valt1; k++)
				{ cnt1++; }
			}
		}
		//alert(cnt); alert(cnt1); alert(document.from.rnge.value);
		document.getElementById('nobe').value=parseInt(cnt)+parseInt(cnt1);
		document.getElementById('nnob').value=parseInt(document.getElementById('nobe').value)-parseInt(document.getElementById('nobmos').value);
		document.getElementById('rt'+[rngtno]).focus();
		return false;
	}
	else
	{
		if(document.getElementById('rf'+[rngtno]).value=="")
		{
			alert("Please enter Barcode Range");
			document.getElementById('rt'+[rngtno]).value="";
			var mltm=parseInt(document.from.mltm.value)*4;
			var cnt=0;
			var mmll=rngtno+1;
			for (var i=1; i<=mltm; i++)
			{
				if(document.getElementById('m'+[i]).value!="")
				{ cnt++; }
			}
			
			var rnge=parseInt(document.from.rnge.value)*2;
			//alert(document.from.rnge.value);
			var cnt1=0;
			for (var j=1; j<=rnge; j++)
			{
				if(document.getElementById('rf'+[j]).value!="" && document.getElementById('rt'+[j]).value!="")
				{
					var xx=document.getElementById('rf'+[j]).value.split("");
					var zz=document.getElementById('rt'+[j]).value.split("");
					var valt1=zz[2]+zz[3]+zz[4]+zz[5]+zz[6]+zz[7]+zz[8]+zz[9]+zz[10];
					var valf1=xx[2]+xx[3]+xx[4]+xx[5]+xx[6]+xx[7]+xx[8]+xx[9]+xx[10];
					//alert(valf1); alert(valt1);
					for(var k=valf1; k<=valt1; k++)
					{ cnt1++; }
				}
			}
			//alert(cnt); alert(cnt1); alert(document.from.rnge.value);
			document.getElementById('nobe').value=parseInt(cnt)+parseInt(cnt1);
			document.getElementById('nnob').value=parseInt(document.getElementById('nobe').value)-parseInt(document.getElementById('nobmos').value);
			document.getElementById('rf'+[rngtno]).focus();
			return false;
		}
		else
		{
			var x=document.getElementById('rf'+[rngtno]).value.split("");
			var fchr=x[0]+x[1]
			var z=rngtval.split("");
			var a=z[0];
			var b=z[1];
			var tchr=z[0]+z[1];
			//alert(a);alert(b);alert(fchr);alert(tchr);
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
			if(fchr!=tchr)
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
			var valt=z[2]+z[3]+z[4]+z[5]+z[6]+z[7]+z[8]+z[9]+z[10];
			var valf=x[2]+x[3]+x[4]+x[5]+x[6]+x[7]+x[8]+x[9]+x[10];
			//mltn++;
			var pcode=document.from.plantcodes.value.split(",");
			var ycode=document.from.yearcodes.value.split(",");
			var x=0
			var y=0;
			/*for(var i=0; i<pcode.length; i++)
			{
				if(pcode[i]==a)
				{
					x++;
				}
			}
			if(x==0)
			{
				alert("Invalid Barcode");
				document.getElementById('rt'+[rngtno]).value="";
				document.getElementById('rt'+[rngtno]).focus();
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
				document.getElementById('rt'+[rngtno]).value="";
				document.getElementById('rt'+[rngtno]).focus();
				return false;
			}
			else */
			if(parseInt(valf)>parseInt(valt))
			{
				alert("Invalid Barcode Range");
				document.getElementById('rt'+[rngtno]).value="";
				document.getElementById('rt'+[rngtno]).focus();
				return false;
			}
			else
			{
				var mltm=parseInt(document.from.mltm.value)*4;
				var cnt=0;
				var mmll=rngtno+1;
				for (var i=1; i<=mltm; i++)
				{
					if(document.getElementById('m'+[i]).value!="")
					{ cnt++; }
				}
				
				var rnge=parseInt(document.from.rnge.value)*2;
				//alert(document.from.rnge.value);
				var cnt1=0;
				for (var j=1; j<=rnge; j++)
				{
					if(document.getElementById('rf'+[j]).value!="" && document.getElementById('rt'+[j]).value!="")
					{
						var xx=document.getElementById('rf'+[j]).value.split("");
						var zz=document.getElementById('rt'+[j]).value.split("");
						var valt1=zz[2]+zz[3]+zz[4]+zz[5]+zz[6]+zz[7]+zz[8]+zz[9]+zz[10];
						var valf1=xx[2]+xx[3]+xx[4]+xx[5]+xx[6]+xx[7]+xx[8]+xx[9]+xx[10];
						//alert(valf1); alert(valt1);
						for(var k=valf1; k<=valt1; k++)
						{ cnt1++; }
					}
				}
				//alert(cnt); alert(cnt1); alert(document.from.rnge.value);
				document.getElementById('nobe').value=parseInt(cnt)+parseInt(cnt1);
				document.getElementById('nnob').value=parseInt(document.getElementById('nobe').value)-parseInt(document.getElementById('nobmos').value);
				document.getElementById('rf'+[mmll]).focus();
			}
		}
	}
}

function chkmoot(mootval, mootno)
{
	mootval=mootval.toUpperCase();
	document.getElementById('mo'+[mootno]).value=document.getElementById('mo'+[mootno]).value.toUpperCase();
	if(mootval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById('mo'+[mootno]).value="";
		var mltm=parseInt(document.from.moout.value)*4;
		var cnt=0;
		for (var i=1; i<=mltm; i++)
		{
			if(document.getElementById('mo'+[i]).value!="")
			{ cnt++; }
		}
		//alert(cnt);
		document.getElementById('nobmos').value=cnt;
		document.getElementById('nnob').value=parseInt(document.getElementById('nobe').value)-parseInt(document.getElementById('nobmos').value);
		document.getElementById('mo'+[mootno]).focus();
		return false;
	}
	else
	{
		var mlt=document.from.moout.value;
		var mltn=mootno-1;
		var mmll=mootno+1;
		if(mootno>=2)
		{
			if(document.getElementById('mo'+[mltn]).value=="")
			{
				alert("Please enter Barcode Number in "+mltn);
				document.getElementById('mo'+[mootno]).value="";
				document.getElementById('mo'+[mltn]).focus();
				return false;
			}
		}
		var z=mootval.split("");
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
		mltn++;
		var m='mo'+mltn;
		var pcode=document.from.plantcodes.value.split(",");
		var ycode=document.from.yearcodes.value.split(",");
		var x=0
		var y=0;
		/*for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('mo'+[mootno]).value="";
			document.getElementById('mo'+[mltn]).focus();
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
			document.getElementById('mo'+[mootno]).value="";
			document.getElementById('mo'+[mltn]).focus();
			return false;
		}*/
		var mltm=parseInt(document.from.moout.value)*4;
		var cnt=0;
		for (var i=1; i<=mltm; i++)
		{
			if(document.getElementById('mo'+[i]).value!="")
			{ cnt++; }
		}
		//alert(cnt);
		document.getElementById('nobmos').value=cnt;
		document.getElementById('nnob').value=parseInt(document.getElementById('nobe').value)-parseInt(document.getElementById('nobmos').value);
		document.getElementById('mo'+[mmll]).focus();
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
	  <input type="hidden" name="dval24" value="<?php echo $dval;?>" />
	  <input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	  <input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" />

<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Enter Barcode Number(s)</td>
</tr>
<tr class="light" height="20">
<td colspan="2" align="right" class="tblheading">No of Barcodes to be entered - as per Master Packs&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobapmp" id="nobapmp" class="tbltext" value="<?php echo $totnomp;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">Number of Barcodes entered&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobe" id="nobe" class="tbltext" value="<?php echo $nobe;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">No. of Barcodes Mis Out(s) - not part of range&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nobmos" id="nobmos" class="tbltext" value="<?php echo $nobmos;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>
<tr class="light" height="20">
  <td colspan="2" align="right" class="tblheading">Net Number of Barcodes&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="nnob" id="nnob" class="tbltext" value="<?php echo $nnob;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
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
  <td colspan="2" align="right" class="tblheading">Gross Weight&nbsp;</td><td colspan="2" align="left" class="tblheading">&nbsp;<input type="text" name="gwt" id="lotgwt" class="tbltext" value="<?php echo $gwt;?>" size="5" onkeypress="return isNumberKey(event)" /></td>
</tr>
<?php $mltm=1; ?>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading" colspan="4">Single</td>
</tr>
<tr class="Dark" height="25">
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m1" id="m1" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,1);" onkeypress="return isNumberKey24(event)" value="<?php echo $m1;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m2" id="m2" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,2);" onkeypress="return isNumberKey24(event)" value="<?php echo $m2;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m3" id="m3" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,3);" onkeypress="return isNumberKey24(event)" value="<?php echo $m3;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m4" id="m4" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,4);" onkeypress="return isNumberKey24(event)" value="<?php echo $m4;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
</tr>
</table>
<div id="mlt2" style="display:<?php if($m5!=""){ $mltm=2; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m5" id="m5" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,5);" onkeypress="return isNumberKey24(event)" value="<?php echo $m5;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m6" id="m6" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,6);" onkeypress="return isNumberKey24(event)" value="<?php echo $m6;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m7" id="m7" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,7);" onkeypress="return isNumberKey24(event)" value="<?php echo $m7;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m8" id="m8" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,8);" onkeypress="return isNumberKey24(event)" value="<?php echo $m8;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt3" style="display:<?php if($m9!=""){ $mltm=3; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m9" id="m9" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,9);" onkeypress="return isNumberKey24(event)" value="<?php echo $m9;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m10" id="m10" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,10);" onkeypress="return isNumberKey24(event)" value="<?php echo $m10;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m11" id="m11" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,11);" onkeypress="return isNumberKey24(event)" value="<?php echo $m11;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m12" id="m12" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,12);" onkeypress="return isNumberKey24(event)" value="<?php echo $m12;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt4" style="display:<?php if($m13!=""){ $mltm=4; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m13" id="m13" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,13);" onkeypress="return isNumberKey24(event)" value="<?php echo $m13;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m14" id="m14" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,14);" onkeypress="return isNumberKey24(event)" value="<?php echo $m14;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m15" id="m15" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,15);" onkeypress="return isNumberKey24(event)" value="<?php echo $m15;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m16" id="m16" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,16);" onkeypress="return isNumberKey24(event)" value="<?php echo $m16;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt5" style="display:<?php if($m17!=""){ $mltm=5; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m17" id="m17" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,17);" onkeypress="return isNumberKey24(event)" value="<?php echo $m17;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m18" id="m18" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,18);" onkeypress="return isNumberKey24(event)" value="<?php echo $m18;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m19" id="m19" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,19);" onkeypress="return isNumberKey24(event)" value="<?php echo $m19;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m20" id="m20" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,20);" onkeypress="return isNumberKey24(event)" value="<?php echo $m20;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt6" style="display:<?php if($m21!=""){ $mltm=6; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m21" id="m21" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,21);" onkeypress="return isNumberKey24(event)" value="<?php echo $m21;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m22" id="m22" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,22);" onkeypress="return isNumberKey24(event)" value="<?php echo $m22;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m23" id="m23" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,23);" onkeypress="return isNumberKey24(event)" value="<?php echo $m23;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m24" id="m24" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,24);" onkeypress="return isNumberKey24(event)" value="<?php echo $m24;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt7" style="display:<?php if($m25!=""){ $mltm=7; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m25" id="m25" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,25);" onkeypress="return isNumberKey24(event)" value="<?php echo $m25;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m26" id="m26" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,26);" onkeypress="return isNumberKey24(event)" value="<?php echo $m26;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m27" id="m27" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,27);" onkeypress="return isNumberKey24(event)" value="<?php echo $m27;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m28" id="m28" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,28);" onkeypress="return isNumberKey24(event)" value="<?php echo $m28;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt8" style="display:<?php if($m29!=""){ $mltm=8; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m29" id="m29" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,29);" onkeypress="return isNumberKey24(event)" value="<?php echo $m29;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m30" id="m30" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,30);" onkeypress="return isNumberKey24(event)" value="<?php echo $m30;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m31" id="m31" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,31);" onkeypress="return isNumberKey24(event)" value="<?php echo $m31;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m32" id="m32" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,32);" onkeypress="return isNumberKey24(event)" value="<?php echo $m32;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt9" style="display:<?php if($m33!=""){ $mltm=9; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m33" id="m33" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,33);" onkeypress="return isNumberKey24(event)" value="<?php echo $m33;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m34" id="m34" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,34);" onkeypress="return isNumberKey24(event)" value="<?php echo $m34;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m35" id="m35" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,35);" onkeypress="return isNumberKey24(event)" value="<?php echo $m35;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m36" id="m36" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,36);" onkeypress="return isNumberKey24(event)" value="<?php echo $m36;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mlt10" style="display:<?php if($m37!=""){ $mltm=10; echo "block";} else {echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25" >
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m37" id="m37" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,37);" onkeypress="return isNumberKey24(event)" value="<?php echo $m37;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m38" id="m38" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,38);" onkeypress="return isNumberKey24(event)" value="<?php echo $m38;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m39" id="m39" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,39);" onkeypress="return isNumberKey24(event)" value="<?php echo $m39;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td width="25%" align="center" valign="middle" class="tblheading"><input type="text" name="m40" id="m40" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,40);" onkeypress="return isNumberKey24(event)" value="<?php echo $m40;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="15">
<td width="50%" align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;<a href="Javascript:void(0);" onclick="mltlesschk();">less</a></td>
<td width="50%" align="right" valign="middle" class="smalltblheading" colspan="2"><a href="Javascript:void(0);" onclick="mltmorechk();">more</a>&nbsp;</td>
</tr>
<input type="hidden" name="mltm" value="<?php echo $mltm;?>" />
</table>
<?php $rnge=3; ?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading" colspan="4">&nbsp;Range</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf1" id="rf1" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,1);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf1;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt1" id="rt1" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,1);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt1;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf2" id="rf2" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,2);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf2;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt2" id="rt2" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,2);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt2;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
<!--<div id="rng2" style="display:<?php if($rf3!="") { $rnge=2; echo "block";} else {echo "none";}?>"> -->
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf3" id="rf3" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,3);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf3;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt3" id="rt3" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,3);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt3;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf4" id="rf4" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,4);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf4;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt4" id="rt4" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,4);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt4;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
<!--</div>
<div id="rng3" style="display:<?php if($rf5!="") { $rnge=3; echo "block";} else {echo "none";}?>"> -->
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf5" id="rf5" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,5);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf5;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt5" id="rt5" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,5);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt5;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf6" id="rf6" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,6);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf6;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt6" id="rt6" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,6);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt6;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
<!--</div>
<div id="rng4" style="display:<?php if($rf7!="") { $rnge=4; echo "block";} else {echo "none";}?>"> 
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf7" id="rf7" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,7);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf7;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt7" id="rt7" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,7);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt7;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf8" id="rf8" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,8);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf8;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt8" id="rt8" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,8);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt8;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="rng5" style="display:<?php if($rf9!="") { $rnge=5; echo "block";} else {echo "none";}?>"> 
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf9" id="rf9" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,9);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf9;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt9" id="rt9" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,9);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt9;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf10" id="rf10" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,10);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf10;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt10" id="rt10" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,10);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt10;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="rng6" style="display:<?php if($rf11!="") { $rnge=6; echo "block";} else {echo "none";}?>"> 
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf11" id="rf11" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,11);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf11;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt11" id="rt11" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,11);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt11;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf12" id="rf12" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,12);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf12;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt12" id="rt12" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,12);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt12;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="rng7" style="display:<?php if($rf13!="") { $rnge=7; echo "block";} else {echo "none";}?>"> 
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf13" id="rf13" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,13);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf13;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt13" id="rt13" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,13);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt13;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf14" id="rf14" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,14);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf14;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt14" id="rt14" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,14);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt14;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="rng8" style="display:<?php if($rf15!="") { $rnge=8; echo "block";} else {echo "none";}?>"> 
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf15" id="rf15" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,15);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf15;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt15" id="rt15" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,15);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt15;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf16" id="rf16" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,16);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf16;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt16" id="rt16" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,16);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt16;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="rng9" style="display:<?php if($rf17!="") { $rnge=9; echo "block";} else {echo "none";}?>"> 
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf17" id="rf17" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,17);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf17;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt17" id="rt17" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,17);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt17;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf18" id="rf18" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,18);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf18;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt18" id="rt18" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,18);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt18;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="rng10" style="display:<?php if($rf19!="") { $rnge=10; echo "block";} else {echo "none";}?>"> 
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
<td  align="center" valign="middle" class="tblheading">From</td>
<td  align="center" valign="middle" class="tblheading">To</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf19" id="rf19" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,19);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf19;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt19" id="rt19" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,19);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt19;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rf20" id="rf20" class="tbltext" size="11" maxlength="11" onchange="chkrngf(this.value,20);" onkeypress="return isNumberKey24(event)" value="<?php echo $rf20;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="rt20" id="rt20" class="tbltext" size="11" maxlength="11" onchange="chkrngt(this.value,20);" onkeypress="return isNumberKey24(event)" value="<?php echo $rt20;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="15">
<td width="50%" align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;<a href="Javascript:void(0);" onclick="rnglesschk();">less</a></td>
<td width="50%" align="right" valign="middle" class="smalltblheading" colspan="2"><a href="Javascript:void(0);" onclick="rngmorechk();">more</a>&nbsp;</td>
</tr>

</table>--><input type="hidden" name="rnge" value="<?php echo $rnge;?>" />
<?php $moout=1; ?>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading" colspan="4">&nbsp;Mis Out(s)</td>
</tr>
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo1" id="mo1" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,1);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo1;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo2" id="mo2" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,2);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo2;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo3" id="mo3" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,3);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo3;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo4" id="mo4" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,4);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo4;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
<div id="mot2" style="display:<?php if($mo5!="") { $moout=2; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo5" id="mo5" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,5);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo5;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo6" id="mo6" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,6);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo6;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo7" id="mo7" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,7);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo7;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo8" id="mo8" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,8);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo8;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot3" style="display:<?php if($mo9!="") { $moout=3; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo9" id="mo9" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,9);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo9;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo10" id="mo10" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,10);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo10;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo11" id="mo11" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,11);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo11;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo12" id="mo12" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,12);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo12;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot4" style="display:<?php if($mo13!="") { $moout=4; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo13" id="mo13" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,13);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo13;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo14" id="mo14" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,14);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo14;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo15" id="mo15" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,15);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo15;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo16" id="mo16" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,16);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo16;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot5" style="display:<?php if($mo17!="") { $moout=5; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo17" id="mo17" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,17);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo17;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo18" id="mo18" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,18);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo18;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo19" id="mo19" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,19);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo19;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo20" id="mo20" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,20);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo20;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot6" style="display:<?php if($mo21!="") { $moout=6; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo21" id="mo21" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,21);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo21;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo22" id="mo22" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,22);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo22;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo23" id="mo23" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,23);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo23;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo24" id="mo24" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,24);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo24;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot7" style="display:<?php if($mo25!="") { $moout=7; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo25" id="mo25" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,25);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo25;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo26" id="mo26" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,26);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo26;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo27" id="mo27" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,27);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo27;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo28" id="mo28" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,28);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo28;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot8" style="display:<?php if($mo29!="") { $moout=8; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo29" id="mo29" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,29);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo29;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo30" id="mo30" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,30);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo30;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo31" id="mo31" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,31);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo31;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo32" id="mo32" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,32);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo32;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot9" style="display:<?php if($mo33!="") { $moout=9; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo33" id="mo33" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,33);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo33;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo34" id="mo34" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,34);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo34;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo35" id="mo35" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,35);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo35;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo36" id="mo36" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,36);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo36;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<div id="mot10" style="display:<?php if($mo37!="") { $moout=10; echo "block";} else { echo "none";}?>">
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo37" id="mo37" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,37);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo37;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo38" id="mo38" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,38);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo38;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo39" id="mo39" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,39);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo39;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
<td  align="center" valign="middle" class="tblheading"><input type="text" name="mo40" id="mo40" class="tbltext" size="11" maxlength="11" onchange="chkmoot(this.value,40);" onkeypress="return isNumberKey24(event)" value="<?php echo $mo40;?>" onblur="javascript:this.value=this.value.toUpperCase();" /></td>
</tr>
</table>
</div>
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="15">
<td width="50%" align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;<a href="Javascript:void(0);" onclick="motlesschk();">less</a></td>
<td width="50%" align="right" valign="middle" class="smalltblheading" colspan="2"><a href="Javascript:void(0);" onclick="motmorechk();">more</a>&nbsp;</td>
</tr>
<input type="hidden" name="moout" value="<?php echo $moout;?>" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<a href="javascript:document.from.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<input type="image" src="../images/next.gif" alt="Next" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
 