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
	
	$tid=$_REQUEST['tid'];
		
	if(isset($_POST['frm_action'])=='submit')
	{
	    /*$p_id=trim($_POST['maintrid']);
		$sql_btslm2="update tbl_btslmain set btsl_tflg=1 where btsl_id='$p_id'";
		$xcvb=mysqli_query($link,$sql_btslm2) or die(mysqli_error($link));*/
		
		echo "<script>window.location='home_bctosloc.php'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Barcode to SLOC Linking</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="btosloc.js"></script>
<script src="../include/validation.js"></script>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<script language="javascript" type="text/javascript">
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
function mySubmit()
{
	if(document.frmaddDepartment.totnobarcodes.value==0)
	{
		alert("Barcode cannot be blank");
		document.frmaddDepartment.barcode.focus();
		return false;
	}
	//showUser(wh1val,'bing1','wh','bing1','','','','');
	document.frmaddDepartment.submit();
	return true; 
}
function wh(wh1val)
{ 	
	showUser(wh1val,'bingn1','wh','','','','','');
}

function bin(bin2val)
{
	if(document.getElementById('txtwh').value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		showUser(bin2val,'sbingn1','bin','','','','','');
	}
}

function subbin(subbin2val)
{	
	if(document.getElementById('txtbing').value=="")
	{	
		alert("Please select Bin");
		return false;
	}
	else
	{
		var ssbin="slocr";
		var whid=document.frmaddDepartment.txtwhg.value;
		var binid=document.frmaddDepartment.txtbin.value;
		var variety=document.getElementById('itm').value;
		var crop=document.getElementById('txtcrop').value;
		showUser(subbin2val,ssbin,'subbin','slocsel',whid,binid,crop,variety,'');
		setTimeout(function() {  
		if(document.frmaddDepartment.flg.value==0){
		document.getElementById('txtbarcod').focus();}}, 400);
	}
}

/*function chkbarcode1(mltval)
{
	if(mltval.length==11)
	{
		chkbarcode(mltval);
	}
}*/
function chkbarcode1(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod";
	document.getElementById(txtbarcode).value=mltval;
	if(document.frmaddDepartment.txtsubb.value=="" && document.frmaddDepartment.txtsloc.value=="")
	{
		alert("Please Select SLOC");
		document.getElementById(txtbarcode).value="";
		flg=1;
		return false;
	}
	if(document.frmaddDepartment.flg.value>0)
	{
		alert("Please Select SLOC");
		document.getElementById(txtbarcode).value="";
		flg=1;
		return false;
	}
	if(document.frmaddDepartment.extbarcod.value!="")
	{
		var extbar=document.frmaddDepartment.extbarcod.value.split(",");
		var x=extbar.indexOf(mltval);
		if(x>=0)
		{
			alert("Duplicate Barcode entered");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
	}
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
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
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
	}
	if(flg==0)
	{
		var bardet="barcdslst";
		var trid=document.frmaddDepartment.maintrid.value;
		var typ="";
		if(document.frmaddDepartment.txtsloc.value!="")
		{
			var sl=document.frmaddDepartment.txtsloc.value.split("/");
			var whid=sl[0];
			var binid=sl[1];
			var subbin=sl[2];
			typ="slocfill";
		}
		else
		{
			var whid=document.frmaddDepartment.txtwhg.value;
			var binid=document.frmaddDepartment.txtbin.value;
			var subbin=document.frmaddDepartment.txtsubb.value;
			typ="slocsel";
		}
		//alert("HI");
		var tcode=document.frmaddDepartment.tcode.value;
		var variety=document.getElementById('itm').value;
		var crop=document.getElementById('txtcrop').value;
		showUser(mltval,bardet,'showbarlots',trid,typ,whid,binid,subbin,tcode,crop,variety); 
		setTimeout(function() {  
			if(document.frmaddDepartment.flg.value==0){
			document.getElementById('txtbarcod').focus();}}, 200);
	}
}

function chksloc1(slocval)
{
chksloc(slocval);
}
function chksloc(slocval)
{
	document.frmaddDepartment.txtsloc.value=slocval.toUpperCase();
	if(document.frmaddDepartment.txtsloc.value!="")
	{
		var sl=document.frmaddDepartment.txtsloc.value.split("/");
		var ewh=document.frmaddDepartment.ewh.value.split(",");
		var ebin=document.frmaddDepartment.ebin.value.split(",");
		var esbin=document.frmaddDepartment.esbin.value.split(",");
		var f=0;
		var x=ewh.indexOf(sl[0]);
		var y=ebin.indexOf(sl[1]);
		var z=esbin.indexOf(sl[2]);
		if(x==-1 || y==-1 || z==-1)
		f=1;
		if(f==0)
		{
			var ssbin="slocr";
			var subbin2val=sl[2];
			var whid=sl[0];
			var binid=sl[1];
			var variety=document.getElementById('itm').value;
			var crop=document.getElementById('txtcrop').value;
			showUser(subbin2val,ssbin,'subbin','slocfill',whid,binid,crop,variety,'');
			setTimeout(function() {  
			if(document.frmaddDepartment.flg.value==0){
			document.getElementById('txtbarcod').focus();}}, 200);
		}
		else
		{
			alert("Invalid SLOC");
			document.frmaddDepartment.txtsloc.value="";
			document.frmaddDepartment.txtsloc.focus();
			return false;
		}
	}
}

/*function deletebarcode1(mltval)
{
	if(mltval.length==11)
	{
		deletebarcode(mltval);
	}
}*/

function deletebarcode1(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod";
	document.getElementById(txtbarcode).value=mltval;
	if(document.frmaddDepartment.txtsubb.value=="" && document.frmaddDepartment.txtsloc.value=="")
	{
		alert("Please Select SLOC");
		document.getElementById(txtbarcode).value="";
		flg=1;
		return false;
	}
	if(document.frmaddDepartment.flg.value>0)
	{
		alert("Please Select SLOC");
		document.getElementById(txtbarcode).value="";
		flg=1;
		return false;
	}
	/*if(document.frmaddDepartment.extbarcod.value!="")
	{
		var extbar=document.frmaddDepartment.extbarcod.value.split(",");
		var x=extbar.indexOf(mltval);
		if(x>=0)
		{
			alert("Duplicate Barcode entered");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
	}*/
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
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
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
	}
	if(flg==0)
	{
		var bardet="barcdslst";
		var trid=document.frmaddDepartment.maintrid.value;
		var typ="";
		if(document.frmaddDepartment.txtsloc.value!="")
		{
			var sl=document.frmaddDepartment.txtsloc.value.split("/");
			var whid=sl[0];
			var binid=sl[1];
			var subbin=sl[2];
			typ="slocfill";
		}
		else
		{
			var whid=document.frmaddDepartment.txtwhg.value;
			var binid=document.frmaddDepartment.txtbin.value;
			var subbin=document.frmaddDepartment.txtsubb.value;
			typ="slocsel";
		}
		//alert("HI");
		showUser(mltval,bardet,'deletebarlots',trid,typ,whid,binid,subbin); 
		setTimeout(function() { document.getElementById('txtbarcod').focus();}, 100);
	}
}

function modetchk(classval)
{
	document.frmaddDepartment.txtwhg.selectedIndex=0;
	document.frmaddDepartment.txtbin.selectedIndex=0;
	document.frmaddDepartment.txtsubb.selectedIndex=0;
	document.getElementById('itm').selectedIndex=0;
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1()
{
	if(document.getElementById('txtcrop').value=="")
	{
		alert("Please Select Crop");
		document.getElementById('itm').selectedIndex=0;
		document.frmaddDepartment.txtwhg.selectedIndex=0;
		document.frmaddDepartment.txtbin.selectedIndex=0;
		document.frmaddDepartment.txtsubb.selectedIndex=0;
		document.getElementById('txtcrop').focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtwhg.selectedIndex=0;
		document.frmaddDepartment.txtbin.selectedIndex=0;
		document.frmaddDepartment.txtsubb.selectedIndex=0;
	}
}
</script>

<body >

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/process_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Barcode to SLOC Linking</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >
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
	
	$ewh=""; $ebin=""; $esbin="";
	$whquery=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
	while($noticiawh = mysqli_fetch_array($whquery)) 
	{ 
		if($ewh!="")
		$ewh=$ewh.",".$noticiawh['perticulars'];
		else
		$ewh=$noticiawh['perticulars'];
	}
	$sqlbin=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname")or die("Error:".mysqli_error($link));
	while($noticiabin = mysqli_fetch_array($sqlbin)) 
	{ 
		if($ebin!="")
		$ebin=$ebin.",".$noticiabin['binname'];
		else
		$ebin=$noticiabin['binname'];
	}
	$sqlsbin=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname")or die("Error:".mysqli_error($link));	
	while($noticiasubbin = mysqli_fetch_array($sqlsbin)) 
	{ 
		if($esbin!="")
		$esbin=$esbin.",".$noticiasubbin['sname'];
		else
		$esbin=$noticiasubbin['sname'];
	}
	
$sql_arr_home=mysqli_query($link,"select * from tbl_btslmain where plantcode='$plantcode' and btsl_id='$tid'") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_arr_home=mysqli_fetch_array($sql_arr_home);	

$trdate=$row_arr_home['btsl_date'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$trdate=$trday."-".$trmonth."-".$tryear;

$lrole=$row_arr_home['btsl_logid'];
$arrival_id=$row_arr_home['btsl_id'];

$quer_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_arr_home['btsl_crop']."' order by cropname Asc");
$noticiacrp = mysqli_fetch_array($quer_crp);
$ecrp=$noticiacrp['cropname'];

$quer_ver=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticiaver = mysqli_fetch_array($quer_ver);
$evariet=$noticiaver['popularname'];

$extbarlotslist="";
	$sqlbtslm=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='$tid' order by btslsub_id asc") or die(mysqli_error($link));
	while($rowbtslm=mysqli_fetch_array($sqlbtslm))
	{
		if($extbarlotslist!="")
			$extbarlotslist=$extbarlotslist.",".$rowbtslm['btslsub_barcode'];
		else
			$extbarlotslist=$rowbtslm['btslsub_barcode'];
	}
		
?>
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	<input name="frm_action" value="submit" type="hidden">
 	<input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	<input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" /> 
	<input type="hidden" name="foccode" value="" />
	<input type="hidden" name="ewh" value="<?php echo $ewh;?>" />
	<input type="hidden" name="ebin" value="<?php echo $ebin;?>" />
	<input type="hidden" name="esbin" value="<?php echo $esbin;?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >Barcode to SLOC Linking</td>
</tr>
<tr class="Light" height="20">
  	<td width="139" align="right" valign="middle" class="smalltblheading">Transaction ID&nbsp;</td>
	<td width="139" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "BS".$row_arr_home['btsl_code']."/".$row_arr_home['btsl_yearcode']."/".$lrole;?></td>
	<td width="139" align="right" valign="middle" class="smalltblheading">Date&nbsp;</td>
	<td width="139" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate;?></td>
</tr>
</table>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >Existing Crop, Variety, SLOC</td>
</tr>
</table>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="Light" height="20">
<?php
$quer3_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
  	<td width="92" align="right" valign="middle" class="smalltblheading">Existing Crop&nbsp;</td>
	<td width="94" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $ecrp?><input type="hidden" name="txtecrop" value="<?php echo $row_arr_home['btsl_crop'];?>" /></td>
	<td width="104" align="right" valign="middle" class="smalltblheading">Existing Variety&nbsp;</td>
	<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $evariet?><input type="hidden" name="txtevariety" value="<?php echo $row_arr_home['lotldg_variety'];?>" /></td>
</tr>	
  <tr class="Light" height="20">
  	<td width="92" align="right" valign="middle" class="smalltblheading">WH&nbsp;</td>
	
<?php
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_arr_home['btsl_wh']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_arr_home['btsl_bin']."' and whid='".$row_arr_home['btsl_wh']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_arr_home['btsl_subbin']."' and binid='".$row_arr_home['btsl_bin']."' and whid='".$row_arr_home['btsl_wh']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
?>

<td width="94" align="Left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $wareh;?>
  <input type="hidden" id="txtewh" name="ewh" value="<?php echo $row_arr_home['btsl_wh'];?>" /></td>
<td width="104" align="Right" valign="middle" class="smalltblheading">Bin&nbsp;</td>
   
<td width="75" align="Left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $binn;?>
  <input type="hidden" id="txtebing" name="txtebin" value="<?php echo $row_arr_home['btsl_bin'];?>" /></td>
 <td width="132" align="Right" valign="middle" class="smalltblheading" >Subbin&nbsp;</td>
<td width="139" align="Left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $subbinn;?><input type="hidden" id="txtesubbg" name="txtesubb" value="<?php echo $row_arr_home['btsl_subbin'];?>" /></td>
</tr>
<!--<tr class="Light" height="25">
<td align="Right" valign="middle" class="smalltblheading">Fill SLOC&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="5" id="txtslocchk">&nbsp;<input type="text" name="txtsloc" class="smalltbltext" size="12" maxlength="12" value="" onchange="chksloc(this.value);" onblur="chksloc1(this.value);" />&nbsp;&nbsp;e.g. - WH-01/A01/10</td>
</tr>-->

</table><br />

<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >New Crop, Variety, SLOC</td>
</tr>
</table>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="Light" height="20">
<?php
$quer3_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
  	<td width="97" align="right" valign="middle" class="smalltblheading">Crop&nbsp;</td>
	<td width="174" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtcrop" id="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia_crop = mysqli_fetch_array($quer3_crop)) { ?>
		<option value="<?php echo $noticia_crop['cropid'];?>" />   
		<?php echo $noticia_crop['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
	<td width="61" align="right" valign="middle" class="smalltblheading">Variety&nbsp;</td>
	<td width="208" align="left" valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1();" >
<option value="" selected>--Select Variety--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >Select / Fill SLOC</td>
</tr>
</table>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="Light" height="20">
  	<td width="139" align="right" valign="middle" class="smalltblheading">WH&nbsp;</td>
	
	  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="139" align="Left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" id="txtwh" name="txtwhg" style="width:70px;" onchange="wh(this.value);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_arr_home['btsl_wh']==$noticia_whd1['whid']) echo "Selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	<td width="140" align="Right" valign="middle" class="smalltblheading">Bin&nbsp;</td>
<?php
$sql_month=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_arr_home['btsl_wh']."' order by binname")or die("Error:".mysqli_error($link));
?>   
<td width="140" align="Left"  valign="middle" class="smalltbltext" id="bingn1">&nbsp;<select class="smalltbltext" name="txtbin" id="txtbing" style="width:60px;" onchange="bin(this.value);" >
<option value="" >Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($row_arr_home['btsl_bin']==$noticia_bing1['binid']) echo "Selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
 <td width="139" align="Right" valign="middle" class="smalltblheading" >Subbin&nbsp;</td>
 <?php
 $sql_month=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_arr_home['btsl_bin']."' order by sname")or die("Error:".mysqli_error($link));
 ?>
<td width="139" align="Left"  valign="middle" class="smalltbltext" id="sbingn1">&nbsp;<select class="smalltbltext" name="txtsubb" id="txtsubbg" style="width:60px;" onchange="subbin(this.value);"  >
<option value="" >Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($row_arr_home['btsl_subbin']==$noticia_subbing1['sid']) echo "Selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="Right" valign="middle" class="smalltblheading">Fill SLOC&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="5" id="txtslocchk">&nbsp;<input type="text" name="txtsloc" class="smalltbltext" size="12" maxlength="12" value="" onchange="chksloc(this.value);" onblur="chksloc1(this.value);" />&nbsp;&nbsp;e.g. - WH-01/A01/10</td>
</tr>
</table><br />
<div id="slocr">
<?php
if($row_subbinn['status']!="Pack" || $row_subbinn['status']!="Empty")$ct++;

$lotqry=mysqli_query($link,"select distinct lotldg_lotno, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_arr_home['btsl_subbin']."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$sstage=""; $crop=""; $variety="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_arr_home['btsl_subbin']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_issue['lotldg_lotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$sstage=$row_issuetbl['lotldg_sstage'];

if($sstage!="Pack")$cnt++;
if($row_issuetbl['lotldg_crop']!=$row_arr_home['btsl_crop'])$cnt++;
if($row_issuetbl['lotldg_variety']!=$row_arr_home['btsl_variety'])$cnt++;

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$variety=$noticia_item['popularname'];
}
}
}
if($cnt==0)
{
$lotqry=mysqli_query($link,"select distinct lotno, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_arr_home['btsl_subbin']."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$sstage=""; $crop=""; $variety="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_arr_home['btsl_subbin']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_issue['lotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$sstage=$row_issuetbl['lotldg_sstage'];

if($sstage!="Pack")$cnt++;
if($row_issuetbl['lotldg_crop']!=$row_arr_home['btsl_crop'])$cnt++;
if($row_issuetbl['lotldg_variety']!=$row_arr_home['btsl_variety'])$cnt++;

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$variety=$noticia_item['popularname'];
}
}
}
}
$fl=0;
//echo $cnt; echo $ct;
if($cnt > 0 && $ct > 0)$cnt=1;
if($cnt > 0 && $ct == 0)$cnt=1;
?><table align="center" height="25" width="650"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="smalltblheading" colspan="3">SLOC Details</td>
  </tr>	
<tr class="tblsubtitle" height="20">
    <td width="31%" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="40%" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="29%" align="center" valign="middle" class="smalltblheading">Stage</td>
  </tr>	
	<tr>
 		<td width="31%" align="center"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $crop;?><input type="hidden" name="txtcrp" value="<?php echo $crop;?>" /> </td>
		<td width="40%" align="center"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $variety;?><input type="hidden" name="txtvariet" value="<?php echo $variety;?>" /></td>
		<td width="29%" align="center"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $sstage;?><input type="hidden" name="txtstage" value="<?php echo $sstage;?>" /></td>
 	</tr>
<?php	if($cnt > 0) { $fl=1;?>
	<tr>
 		<td align="center"  valign="middle" class="smalltblheading" colspan="3" ><font color="#FF0000">Variety/Stage Mismatch. Barcodes can be linked to same Variety in pack stage OR empty subbins.</font></td>
 	</tr>
<?php } if($sstage=="") {?>
<tr>
 		<td align="center"  valign="middle" class="smalltblheading" colspan="3" >Empty Subbin</td>
 	</tr>
<?php } ?>	
<input type="hidden" name="flg" value="<?php echo $fl;?>" />	
</table>
</div>
<br />


<div id="barcdslst">
<?php
	$barlotslist="";
	$sql_btslm=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='$tid' order by btslsub_id asc") or die(mysqli_error($link));
	while($row_btslm=mysqli_fetch_array($sql_btslm))
	{
		if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btslm['btslsub_barcode'];
		else
			$barlotslist=$row_btslm['btslsub_barcode'];
	}
$zxc=explode(",", $barlotslist);
$tno=count($zxc);	
?>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="2" >Barcodes Captured</td>
  </tr>
  <tr class="Light" height="20">
    <td align="center" valign="middle" class="tblheading" ><textarea name="extbarcod" rows="10" cols="100" class="smalltbltext" style="background-color:#CCCCCC" readonly="readonly"><?php echo $barlotslist;?></textarea></td>
  </tr>
</table>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">  
  <tr class="Light" height="20">
    <td width="501" align="Right" valign="middle" class="tblheading" >No. of Barcodes&nbsp;</td>
	<td width="43" align="Left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="totnobarcodes" class="smalltbltext" size="2" value="<?php echo $tno;?>" readonly="true" style="background-color:#ECECEC" /> </td>
  </tr>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>"   />
</table>
<br />

<table align="center" border="1" width="350" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext" onchange="chkbarcode1(this.value);" onkeypress="return isNumberKey24(event)" /></td>
</tr>
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Delete Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="delbarcode" id="deltxtbarcod" size="11" maxlength="11" class="smalltbltext" onchange="deletebarcode1(this.value);" onkeypress="return isNumberKey24(event)" /></td>
</tr>
</table>
</div>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_bctosloc.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<img src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:Pointer;" tabindex="0" onClick="return mySubmit();" />&nbsp;&nbsp;</td>
</tr>
</table>


</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  
