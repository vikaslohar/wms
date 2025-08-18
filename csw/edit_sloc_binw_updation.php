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
	
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];	 
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{ 
		$who=trim($_POST['txtslwhg2']);
		$bino=trim($_POST['txtslbing2']);
		$subbino=trim($_POST['txtslsubbing2']);
		$whn=trim($_POST['txtslwhg24']);
		$binn=trim($_POST['txtslbing24']);
		$subbinn=trim($_POST['txtslsubbing24']);
		$cnt=trim($_POST['cnt']);
		$stageo=trim($_POST['stage']);
		$tdate=trim($_POST['txtdate']);
		$crop=trim($_POST['cropt']);
		$variety=trim($_POST['vert']);
		$olots=trim($_POST['olots']);
		$code=trim($_POST['code']);
		
	 	$sql_in1="update tbl_sloc_binw set sldate='$tdate', wh='$who', bin='$bino', subbin='$subbino', yearcode='$yearid_id', surole='$lgnid',stage='$stageo' where slid ='$pid'";
		
		if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
		{
			$mainid=$pid;
			$sql_del="delete from tbl_sloc_binw_sub where slocid='$pid'";
			$zxy=mysqli_query($link,$sql_del) or die(mysqli_error($link));
			
			$p_array=explode(",",$olots);
			foreach($p_array as $val)
			{
				if($val <> "")
				{
		 		$sql_in="insert into tbl_sloc_binw_sub(slocid, crop, variety, lotno, whid, binid, subbinid,plantcode) values('$mainid', '$crop', '$variety', '$val', '$whn', '$binn', '$subbinn','$plantcode')";
				mysqli_query($link,$sql_in) or die(mysqli_error($link));
				}
			}
		}
			echo "<script>window.location='add_sloc_binw_preview.php?pid=$mainid'</script>";	
	}
		
	$a="TBU";
	$sql_code="SELECT MAX(code) FROM tbl_sloc_binw  where yearcode='$yearid_id' and plantcode='".$plantcode."'  ORDER BY code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1=$a.$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1=$a.$code."/".$lgnid;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW -Transaction  - Sloc Update SubBin wise</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
</head>
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

<script src="slocupbin.js"></script>
<script language="javascript" type="text/javascript">
var x = 0;

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function mySubmit()
{ 
	if(document.frmaddDepartment.cnt.value==0)
	{
		alert("No lots found to update SLOC");
		return false;
	}
	document.frmaddDepartment.olots.value="";
	//alert(document.frmaddDepartment.cnt.value);
	if(document.frmaddDepartment.cnt.value>1)
	{
		for (var i=1; i <=document.frmaddDepartment.cnt.value; i++) 
		{          
			var lotsn1="lotsn"+i;
			//alert(lotsn1);
			if(document.getElementById(lotsn1).checked==true)
			{
				if(document.frmaddDepartment.olots.value=="")
				{
					document.frmaddDepartment.olots.value=document.getElementById(lotsn1).value;
				}
				else
				{
					document.frmaddDepartment.olots.value=document.frmaddDepartment.olots.value+','+document.getElementById(lotsn1).value;
				}
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.lotsn.checked==true)
		{
			if(document.frmaddDepartment.olots.value=="")
			{
				document.frmaddDepartment.olots.value=document.frmaddDepartment.lotsn.value;
			}
			else
			{
				document.frmaddDepartment.olots.value=document.frmaddDepartment.olots.value+','+document.frmaddDepartment.lotsn.value;
			}
		}
	}
	if(document.frmaddDepartment.txtslsubbing24.value=="")
	{
		alert("No Sub-Bin selected to update SLOC");
		return false;
	}
	return true;	 
}
/*function typchk1(opt1)
{
	document.frmaddDepartment.txt123.value=opt1;
	if(opt1=="binwise")
	{
		document.getElementById('binwisesloc').style.display="block";
		document.getElementById('subbinwisesloc').style.display="none";
	}
	else if(opt1=="subbinwise")
	{
		document.getElementById('binwisesloc').style.display="none";
		document.getElementById('subbinwisesloc').style.display="block";
	}
	else
	{
		document.getElementById('binwisesloc').style.display="none";
		document.getElementById('subbinwisesloc').style.display="none";
	}
}*/
/*function wh(wh1val)
{ 
		var b='bing';
		showUser(wh1val,b,'wh','1','','','','');
}*/
function wh1(wh1val)
{ 
	document.getElementById('showsloc').innerHTML="";	
	var b='bing2';
	showUser(wh1val,b,'wh1','2','','','','');
}
/*function wh2(wh1val)
{ 
		var b='bing222';
		showUser(wh1val,b,'wh2','3','','','','');
}*/
function wh4(wh1val)
{ 
	if(document.frmaddDepartment.crpflg.value > 0 || document.frmaddDepartment.verflg.value > 0 || document.frmaddDepartment.stageflg.value > 0)
	{
		alert("Cannot update SLOC.\n\nReason:\n\nLots with different Crop/Variety/Stage Stored in above selected SubBin");
		document.frmaddDepartment.txtslwhg24.value="";
		return false;
	}
	else
	{
		var b='bing24';
		showUser(wh1val,b,'wh3','4','','','','');
	}
}
/*function bin1(binval)
{
	if(document.frmaddDepartment.txtslwhg.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing.value="";
		return false;
	}
	else
	{
		var b='showsloc';
		var wh=document.frmaddDepartment.txtslwhg.value;
		var f=document.frmaddDepartment.txt123.value;
		showUser(binval,b,'showslocs',wh,'',f,'','');
	}
}*/
function bin2(binval)
{
	document.getElementById('showsloc').innerHTML="";
	if(document.frmaddDepartment.txtslwhg2.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing2.value="";
		document.frmaddDepartment.txtslsubbing2.value="";
		return false;
	}
	else
	{
		var b='sbing2';
		showUser(binval,b,'bin2','2','','','','');
	}
}
/*function bin3(binval)
{
	if(document.frmaddDepartment.txtslwhg222.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing222.value="";
		return false;
	}
}*/
function bin4(binval)
{
	if(document.frmaddDepartment.txtslwhg24.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing24.value="";
		document.frmaddDepartment.txtslsubbing24.value="";
		return false;
	}
	else
	{
		var b='sbing24';
		showUser(binval,b,'bin4','4','','','','');
	}
}
function subbin2(subbinval)
{
	document.getElementById('showsloc').innerHTML="";
	if(document.frmaddDepartment.txtslbing2.value=="")
	{
		alert("Select Bin");
		document.frmaddDepartment.txtslsubbing2.value="";
		return false;
	}
	else
	{
		var b='showsloc';
		var wh=document.frmaddDepartment.txtslwhg2.value;
		var bin=document.frmaddDepartment.txtslbing2.value;
		var f=document.frmaddDepartment.txt123.value;
		showUser(subbinval,b,'showslocs',wh,bin,f,'','');
	}
}
function subbin4(subbinval)
{
	document.getElementById('prvewshow').innerHTML="";
	if(document.frmaddDepartment.txtslbing24.value=="")
	{
		alert("Select Bin");
		document.frmaddDepartment.txtslsubbing24.value="";
		return false;
	}
	else if(document.frmaddDepartment.txtslsubbing24.value==document.frmaddDepartment.txtslsubbing2.value)
	{
		alert("Cannot update in same SLOC");
		document.frmaddDepartment.txtslsubbing24.value="";
		return false;
	}
	else
	{
		var b='prvewshow';
		var wh=document.frmaddDepartment.txtslwhg24.value;
		var bin=document.frmaddDepartment.txtslbing24.value;
		var f=document.frmaddDepartment.stage.value;
		var g=document.frmaddDepartment.vert.value;
		showUser(subbinval,b,'prvewshw',wh,bin,f,g,'');
	}
}


function chkall()
{
	var sno1=document.frmaddDepartment.srno.value;
	var totlots="";
	if(sno1>2)
	{
		for(var i=0; i<document.frmaddDepartment.lotsn.length; i++)
		{
			document.frmaddDepartment.lotsn[i].checked=true;
		}
	}
	else
	{
		document.frmaddDepartment.lotsn.checked=true;
	}
	//showUser(sno1,'postingsubsubtable','lotshowmmc',totlots,strid,tid,ups,ver,nomp,qt,ssid)
}

function clrall(strid,tid,ups,ver,nomp,qt,ssid)
{
	var sno1=document.frmaddDepartment.srno.value;
	var totlots="";
	if(sno1>2)
	{
		for(var i=0; i<document.frmaddDepartment.lotsn.length; i++)
		{
			document.frmaddDepartment.lotsn[i].checked=false;
		}
	}
	else
	{
		document.frmaddDepartment.lotsn.checked=false;
	}
	//showUser(sno1,'postingsubsubtable','lotshowmmc',totlots,strid,tid,ups,ver,nomp,qt,ssid)
}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_csw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/csw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#fa8283"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" style="border-bottom:solid; border-bottom-color:#fa8283" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation Sub-Bin wise</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>

	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="code" value="<?php echo $code;?>" type="hidden">
	   <input name="txt123" value="" type="hidden">
	  <input type="hidden" name="olots" value="" />
	  <input type="hidden" name="txtdate" value="<?php echo date("Y-m-d");?>" />
	  
<?php
	$sql1=mysqli_query($link,"select * from tbl_sloc_binw where slid='".$pid."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_binw_sub where slocid='".$pid."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
    $row_sub=mysqli_fetch_array($sql_sub);
?> 	  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation Sub-Bin wise</td>
</tr>

<tr class="Dark" height="25">
	<td width="159" height="30" align="right" valign="middle" class="tblheading">Select Ware House&nbsp;</td>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse  where plantcode='".$plantcode."' order by perticulars");
?>                 
				<td width="149"  align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:80px;" onChange="wh1(this.value);"   >
            <option value="" selected>--WH--</option>
            <?php while($noticia_whg2=mysqli_fetch_array($whg2_query)) { ?>
            <option <?php if($row['wh']==$noticia_whg2['whid']) echo "selected"; ?> value="<?php echo $noticia_whg2['whid'];?>" />    
            <?php echo $noticia_whg2['perticulars'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
    <td width="120" height="30" align="right" valign="middle" class="tblheading">Select Bin&nbsp;</td>
<?php
$sql_month=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$row['wh']."' and plantcode='".$plantcode."' order by binname")or die("Error:".mysqli_error($link));
?>                  
    <td width="194"  align="left"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:80px;" onchange="bin2(this.value);"  >
     <option value="" selected>--Bin--</option>
	 <?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($row['bin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	    <td width="117" height="30" align="right" valign="middle" class="tblheading">Select Sub Bin&nbsp;</td>
<?php
$sql_month2=mysqli_query($link,"select sid, sname from tbl_subbin where binid='".$row['bin']."' and plantcode='".$plantcode."' order by sname")or die("Error:".mysqli_error($link));
?>                  
    <td width="197"  align="left"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbing2" style="width:80px;" onchange="subbin2(this.value);"  >
     <option value="" selected>--SubBin--</option>
	 <?php while($noticia_subbing1 = mysqli_fetch_array($sql_month2)) { ?>
		<option <?php if($row['subbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
</tr>
</table>
<div id="showsloc" style="display:block">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse"  cols="2">
<tr class="tblsubtitle">
	<td width="70" align="center" valign="middle" class="tblheading" ><a href="Javascript:void(0);" onclick="chkall();">CA</a> / <a href="Javascript:void(0);" onclick="clrall();">CL</a></td>
	<td width="318" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="296" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="256" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="256" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="56" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="56" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $cnt=0; $cropt="";$vert=""; $crpflg=0; $verflg=0; $stage=""; $stageflg=0;
$sql_iss=mysqli_query($link,"select distinct (lotldg_lotno)  from tbl_lot_ldg where lotldg_whid='".$row['wh']."' and plantcode='".$plantcode."' and lotldg_binid='".$row['bin']."' and lotldg_subbinid='".$row['subbin']."'") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_iss);
while($row_iss=mysqli_fetch_array($sql_iss))
{ 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row['subbin']."' and plantcode='".$plantcode."' and lotldg_binid='".$row['bin']."' and lotldg_whid='".$row['wh']."' and lotldg_lotno='".$row_iss['lotldg_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and plantcode='".$plantcode."' and lotldg_balqty>0") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
$cnt++;
$lot=$row_issuetbl['lotldg_lotno'];
if($cropt=="")
{
$cropt=$row_issuetbl['lotldg_crop'];
}
else
{
if($cropt!=$row_issuetbl['lotldg_crop'])
$crpflg++;
}
if($vert=="")
{
$vert=$row_issuetbl['lotldg_variety'];
}
else
{
if($vert!=$row_issuetbl['lotldg_variety'])
$verflg++;
}
if($stage=="")
{
$stage=$row_issuetbl['lotldg_sstage'];
}
else
{
if($stage!=$row_issuetbl['lotldg_sstage'])
$stageflg++;
}
$sql_crop=mysqli_query($link,"Select * from tblcrop where cropid='".$row_issuetbl['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crp=$row_crop['cropname'];
$sql_veriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$row_veriety=mysqli_fetch_array($sql_veriety);
$vv=$row_veriety['popularname'];

$tot_sub2=0;
$sql_sub2=mysqli_query($link,"select * from tbl_sloc_binw_sub where slocid='".$pid."' and lotno='".$lot."' and plantcode='".$plantcode."' and whid='".$row_sub['whid']."' and binid='".$row_sub['binid']."' and subbinid='".$row_sub['subbinid']."'")or die(mysqli_error($link));
$row_sub2=mysqli_fetch_array($sql_sub2);
$tot_sub2=mysqli_num_rows($sql_sub2);
if($srno%2!=0)
{
?> 
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotsn" id="lotsn<?php echo $srno;?>" value="<?php echo $lot;?>" <?php if($tot_sub2 > 0) echo "checked";?> /></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" value="<?php echo $lot;?>" /></td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balbags'];?>&nbsp;</td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balqty'];?>&nbsp;</td>
</tr>
 <?php
}
else
{
?>
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotsn" id="lotsn<?php echo $srno;?>" value="<?php echo $lot;?>" <?php if($tot_sub2 > 0) echo "checked";?> /></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" value="<?php echo $lot;?>" /></td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balbags'];?>&nbsp;</td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balqty'];?>&nbsp;</td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
<input type="hidden" name="cnt" value="<?php echo $cnt;?>" /><input type="hidden" name="crpflg" value="<?php echo $crpflg;?>" /><input type="hidden" name="cropt" value="<?php echo $cropt;?>" /><input type="hidden" name="verflg" value="<?php echo $verflg;?>" /><input type="hidden" name="vert" value="<?php echo $vert;?>" /><input type="hidden" name="stageflg" value="<?php echo $stageflg;?>" /><input type="hidden" name="stage" value="<?php echo $stage;?>" /><input type="hidden" name="srno" value="<?php echo $srno;?>" />
 </table>
 <br />
 <?php
if($cnt>0)
{
?><br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse"> <tr class="tblsubtitle">
    <td align="center" valign="middle" class="tblheading" colspan="6">Select New SLOC</td>
  </tr>
<tr class="Dark" height="25">
	<td width="159" height="30" align="right" valign="middle" class="tblheading">Select Ware House&nbsp;</td>
  <?php
$whg24_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='".$plantcode."' order by perticulars");
?>                 
				<td width="149"  align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg24" style="width:80px;" onChange="wh4(this.value);"   >
            <option value="" selected>--WH--</option>
            <?php while($noticia_whg24=mysqli_fetch_array($whg24_query)) { ?>
            <option <?php if($row_sub['whid']==$noticia_whg24['whid']) echo "selected"; ?> value="<?php echo $noticia_whg24['whid'];?>" />    
            <?php echo $noticia_whg24['perticulars'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
    <td width="120" height="30" align="right" valign="middle" class="tblheading">Select Bin&nbsp;</td>
<?php
$sql_month24=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$row_sub['whid']."' and plantcode='".$plantcode."' order by binname")or die("Error:".mysqli_error($link));
?>                    
    <td width="194"  align="left"  valign="middle" class="tbltext" id="bing24">&nbsp;<select class="tbltext" name="txtslbing24" style="width:80px;" onchange="bin4(this.value);"  >
     <option value="" selected>--Bin--</option>
	 <?php while($noticia_bing124 = mysqli_fetch_array($sql_month24)) { ?>
		<option <?php if($row_sub['binid']==$noticia_bing124['binid']) echo "selected"; ?> value="<?php echo $noticia_bing124['binid'];?>" />   
		<?php echo $noticia_bing124['binname'];?>
		<?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	    <td width="117" height="30" align="right" valign="middle" class="tblheading">Select Sub Bin&nbsp;</td>
<?php
$sql_month240=mysqli_query($link,"select sid, sname from tbl_subbin where binid='".$row_sub['binid']."' and plantcode='".$plantcode."' order by sname")or die("Error:".mysqli_error($link));
?>                     
    <td width="197"  align="left"  valign="middle" class="tbltext" id="sbing24">&nbsp;<select class="tbltext" name="txtslsubbing24" style="width:80px;" onchange="subbin4(this.value);"  >
     <option value="" selected>--SubBin--</option>
	 <?php while($noticia_subbing124 = mysqli_fetch_array($sql_month240)) { ?>
		<option <?php if($row_sub['subbinid']==$noticia_subbing124['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing124['sid'];?>" />   
		<?php echo $noticia_subbing124['sname'];?>
		<?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
</tr>
</table>
<div id="prvewshow">
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_sloc_binw.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<?php
}
else
{
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse">
<tr class="tblsubtitle">
	<td align="center" valign="middle" class="tblheading" >Records Not Found.</td>
</tr>
</table> 
<div id="prvewshow">
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_sloc_binw.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;</td>
</tr>
</table> 
</div>
<?php
}
?>
</div>

</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
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
