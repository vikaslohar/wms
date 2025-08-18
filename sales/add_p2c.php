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
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
	   // exit;
		$tcode=trim($_POST['tcode']);
		$crop=trim($_POST['txtcrop']);
		$variety=trim($_POST['txtvariety']);
		$ups=trim($_POST['txtupsdc']);
		$lotno=trim($_POST['txtlot1']);
		$orlot=trim($_POST['orlot']);
		$ewh=trim($_POST['ewh']);
		$ebin=trim($_POST['ebin']);
		$esbin=trim($_POST['esbin']);
		$enop=trim($_POST['txtenop']);
		$eqty=trim($_POST['txteqty']);
		$qc=trim($_POST['txteqc']);
		$got=trim($_POST['txtegot']);
		$dogt=trim($_POST['txtedogt']);
		
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$sbin1=trim($_POST['txtslsubbg1']);
		$nob1=trim($_POST['txtslBagsg1']);
		$qty1=trim($_POST['txtslqtyg1']);
		
		$wh2=trim($_POST['txtslwhg2']);
		$bin2=trim($_POST['txtslbing2']);
		$sbin2=trim($_POST['txtslsubbg2']);
		$nob2=trim($_POST['txtslBagsg2']);
		$qty2=trim($_POST['txtslqtyg2']);
		
		$dt=date("Y-m-d");
		
		$sql="Insert into tbl_unpsp2c (unp_date, unp_tcode, unp_crop, unp_variety, unp_lotno, unp_orlot, unp_ups, unp_pwh, unp_pbin, unp_psbin, unp_pnop, unp_pqty, unp_cwh1, unp_cbin1, unp_csbin1, unp_cnob1, unp_cqty1, unp_cwh2, unp_cbin2, unp_csbin2, unp_cnob2, unp_cqty2, unp_logid, unp_yearcode, plantcode) values('$dt', '$tcode', '$crop', '$variety', '$lotno', '$orlot', '$ups', '$ewh', '$ebin', '$esbin', '$enop', '$eqty', '$wh1', '$bin1', '$sbin1', '$nob1', '$qty1', '$wh2', '$bin2', '$sbin2', '$nob2', '$qty2', '$logid', '$yearid_id', '$plantcode')";
		
		if(mysqli_query($link,$sql) or die(mysqli_error($link)))
		{
		$p_id=mysqli_insert_id($link);
		
		/*$sql_code="SELECT MAX(unp_code) FROM tbl_unpsp2c where plantcode='$plantcode' AND unp_yearcode='$yearid_id'  ORDER BY unp_code DESC";
		$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
		{
			$row_code=mysqli_fetch_row($res_code);
			$t_code=$row_code['0'];
			$code=$t_code+1;
		}
		else
		{
			$code=1;
		}	
		$sql_btslm2="update tbl_unpsp2c set unp_tflg=1, unp_code='$code' where unp_id='$p_id'";
		$xcvb=mysqli_query($link,$sql_btslm2) or die(mysqli_error($link));*/
		
		echo "<script>window.location='add_p2c_preview.php?pid=$p_id'</script>";	
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Transaction - Unpacking - P2C</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
</head>
<script src="unpp2c.js"></script>
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
		if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) 
		{
			flag = false;
			break;
		}	
	}
	return flag;
}

function mySubmit()
{
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please Select UPS");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot Number");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.getdet.value==0)
	{
		alert("Please click on Get Details");
		f=1;
		return false;
	}
	
	if(document.frmaddDepartment.txtslsubbg1.value==""&& document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please Select SLOC");
		f=1;
		return false;
	}
	var qt=parseFloat(document.frmaddDepartment.txteqty.value);
	var q1=document.frmaddDepartment.txtslqtyg1.value;
	var q2=document.frmaddDepartment.txtslqtyg2.value;
	if(q2=="")q2=0;
	var slqt=parseFloat(q1)+parseFloat(q2);
	
	if(parseFloat(qt)!=parseFloat(slqt))
	{
		alert("Please check. Quantity is not matching with Quantity distributed in Bins");
		f=1;
		return false;
	}
	if(f==1)
		return false; 
	else
		return true;
}

function wh(wh1val, whno)
{ 
	var whi="txtslwhg"+whno;
	if(whno>1)
	{
		var qtys="txtslqtyg"+whno-1;
		if(document.getElementsByName(qtys[0]).value=="")
		{
			alert("Please enter Qty in previous Bin")
			document.getElementsByName(whi[0]).selectedIndex=0;
			return false;
		}
		else
		{
			var bing="bing"+whno;
			showUser(wh1val,bing,'wh',bing,'','','','');
		}
	}
	else
	{
		var bing="bing"+whno;
		showUser(wh1val,bing,'wh',bing,'','','','');
	}
}

function bin(bin1val, binno)
{
	var whi="txtslwhg"+binno;
	var txtslbing="txtslbing"+binno;
	if(document.getElementsByName(whi)[0].value!="")
	{
		var sbing="sbing"+binno;
		var txtslsubbg="txtslsubbg"+binno;
		showUser(bin1val,sbing,'bin',txtslsubbg,'','','','');
	}
	else
	{
		alert("Please select Warehouse");
		getElementsByName(txtslbing)[0].selectedIndex=0;
		getElementsByName(whi)[0].focus();
		return false;
	}
}

function subbin(subbin1val,subbinno)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var txtslbing="txtslbing"+subbinno;
	if(document.getElementsByName(txtslbing)[0].value!="")
	{	
		var cnt=0; 
		var w=[];
		for (var i=1; i<=subbinno; i++)
		{
			var txtslwhg="txtslwhg"+i;
			var txtslbing="txtslbing"+i;
			var txtslsubbg="txtslsubbg"+i;
			w[i]=document.getElementsByName(txtslwhg)[0].value+document.getElementsByName(txtslbing)[0].value+document.getElementsByName(txtslsubbg)[0].value;
			cnt++;
		}
		if(cnt > 1)
		{
			var ct=0;
			for (var i=1; i<=cnt; i++)
			{
				for (var j=i+1; j<=cnt; j++)
				{
					if(w[i]==w[j])
					{
						ct++;
					}
				}
			}
			if(ct>0)
			{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb'+[subbinno]).selectedIndex=0;
				document.getElementById('sb'+[subbinno]).focus();
				return false;
			}
		}
		var slocnogood='Condition';
		var trid=0;
		var Bagsv1='P2C';
		var qtyv1="";
		var txtslsubbg="txtslsubbg"+subbinno;
		var slocrow="slocrow"+subbinno;
		showUser(subbin1val,slocrow,'subbin',itemv,txtslsubbg,slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		var txtslsubbg="txtslsubbg"+subbinno;
		alert("Please select Bin");
		document.getElementsByName(txtslsubbg)[0].selectedIndex=0;
		document.getElementsByName(txtslbing)[0].focus();
		return false;
	}
}


function Bagsf(Bags1val, bagno)
{
	var txtslsubbg="txtslsubbg"+bagno;
	var txtslBagsg="txtslBagsg"+bagno;
	if(document.getElementsByName(txtslsubbg)[0].value=="")
	{
		alert("Please select Sub Bin");
		document.getElementsByName(txtslsubbg)[0].focus();
		document.getElementsByName(txtslBagsg)[0].value="";
		return false;
	}
	if(document.getElementsByName(txtslBagsg)[0].value!="")
	{
	
	}
}

function qtyf(qty1val, qtyno)
{	
	var txtslBagsg="txtslBagsg"+qtyno;
	var txtslqtyg="txtslqtyg"+qtyno;
	if(document.getElementsByName(txtslBagsg)[0].value=="")
	{
		alert("Please enter Bags");
		document.getElementsByName(txtslBagsg)[0].focus();
		document.getElementsByName(txtslqtyg)[0].value="";
		return false;
	}
	if(document.getElementsByName(txtslqtyg)[0].value!="")
	{
		
	}
}

function modetchk(classval)
{
	document.frmaddDepartment.txtvariety.selectedIndex=0;
	document.frmaddDepartment.txtvariety.value="";
	document.frmaddDepartment.txtupsdc.selectedIndex=0;
	document.frmaddDepartment.txtupsdc.value="";
	document.frmaddDepartment.txtlot1.value="";
	document.getElementById('postmainform').innerHTML="";
	document.frmaddDepartment.getdet.value=0;
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1()
{
	if(document.getElementById('txtcrop').value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtvariety.selectedIndex=0;
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

function onloadfocus()
{
	//document.getElementById("txtbarcod").focus();
}


function openslocpop()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	else
	{
		//var itm="Pack Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var ups=document.frmaddDepartment.txtupsdc.value;
		document.getElementById('postmainform').innerHTML="";
		document.frmaddDepartment.getdet.value=0;
		winHandle=window.open('getuser_p2c_lotno.php?crop='+crop+'&variety='+variety+'&ups='+ups,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function upschk(verval)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	document.frmaddDepartment.txtupsdc.selectedIndex=0;
	document.frmaddDepartment.txtupsdc.value="";
	document.frmaddDepartment.txtlot1.value="";
	document.getElementById('postmainform').innerHTML="";
	document.frmaddDepartment.getdet.value=0;
	showUser(verval,'upschd','upsch',crop,'','','');
}

function getdetails()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
	 alert("Please Select or enter Lot No.");
	}
	else
	{
		var get=document.frmaddDepartment.txtlot1.value;
		document.frmaddDepartment.getdet.value=0;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var upss=document.frmaddDepartment.txtupsdc.value;
		//var lotid=document.frmaddDepartment.subtrid.value;
		document.frmaddDepartment.getdet.value=1;	
		showUser(get,'postmainform','get',crop,variety,upss,'','','');
		//document.frmaddDepartment.getdetflg.value=1;
	}
}

function verchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety");
		document.frmaddDepartment.txtupsdc.value="";
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtlot1.value="";
		document.getElementById('postmainform').innerHTML="";
		document.frmaddDepartment.getdet.value=0;
	}
}


</script>

<body onload="onloadfocus();" >

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
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
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SR Unpacking - Pack to Condition (P2C)</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >
<?php
	
	$sql_code="SELECT MAX(unp_tcode) FROM tbl_unpsp2c where plantcode='$plantcode' AND unp_yearcode='$yearid_id'  ORDER BY unp_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="TPC".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="TPC".$code."/".$yearid_id."/".$lgnid;
	}	
?>
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	<input name="frm_action" value="submit" type="hidden">
	<input type="hidden" name="foccode" value="" />
	<input type="hidden" name="tcode" value="<?php echo $code;?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >SR Unpacking - Pack to Condition (P2C)</td>
</tr>
<tr class="Light" height="20">
  	<td width="160" align="right" valign="middle" class="smalltblheading">Transaction ID&nbsp;</td>
	<td width="260" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code1;?></td>
	<td width="94" align="right" valign="middle" class="smalltblheading">Date&nbsp;</td>
	<td width="326" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo date("d-m-Y");?> </td>
</tr>
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
<tr class="Light" height="20">
  	<td width="160" align="right" valign="middle" class="smalltblheading">Crop&nbsp;</td>
	<td width="260" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

	<td width="94" align="right" valign="middle" class="smalltblheading">Variety&nbsp;</td>
	<td width="326" align="left" valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="upschk(this.value);" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
	<td align="left" valign="middle" class="tbltext" colspan="2" id="upschd" >&nbsp;<select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="0" /></td>	 
</tr>
</table><br />

<div id="postmainform"> 

</div>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_srp2c.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  
