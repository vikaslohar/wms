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
	    $p_id=trim($_POST['maintrid']);
		
		$sql_code="SELECT MAX(btsl_code) FROM tbl_srbtslmain where plantcode='$plantcode' AND btsl_yearcode='$yearid_id'  ORDER BY btsl_code DESC";
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
		$sql_btslm2="update tbl_srbtslmain set btsl_tflg=1, btsl_code='$code' where btsl_id='$p_id'";
		$xcvb=mysqli_query($link,$sql_btslm2) or die(mysqli_error($link));
		
		echo "<script>window.location='home_bctosloc.php'</script>";	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Recall - Transaction - Barcode to SLOC Linking</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
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
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("Barcode not Linked");
		return false;
	}
	else
	{
		document.frmaddDepartment.submit();
		return true; 
	}
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
		var variety=document.frmaddDepartment.txtvariety1.value;
		var crop=document.frmaddDepartment.txtcrop1.value;
		showUser(subbin2val,ssbin,'subbin','slocsel',whid,binid,crop,variety,'');
		/*setTimeout(function() {  
		if(document.frmaddDepartment.flg.value==0){
		document.getElementById('txtbarcod').focus();}}, 200);*/
	}
}

/*function chkbarcode1(mltval)
{
	if(mltval.length==11)
	{
		chkbarcode(mltval);
	}
}
*/
function chkbarcode1(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod";
	document.getElementById(txtbarcode).value=mltval;
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
		var bardet="showcvdet";
		var trid=document.frmaddDepartment.maintrid.value;
		var typ="";
		//alert("HI");
		var tcode=document.frmaddDepartment.tcode.value;
		var tnot=0;
		//tnot=parseInt(document.frmaddDepartment.totnobarcodes.value);
		showUser(mltval,bardet,'showbarlots',trid,typ,tcode,'','','','','');
		//setTimeout("brcd()", 200);
		//setTimeout(function() {	document.getElementById('txtbarcod').value=""; document.getElementById('txtbarcod').focus(); }, 100);
	}
}

function chkbarcode24(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcoddel";
	document.getElementById(txtbarcode).value=mltval;
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
		if(confirm("You are deleting Barcode "+mltval+"\n\nAre you sure?")==true)
		{
		var bardet="postmainform";
		var trid=document.frmaddDepartment.maintrid.value;
		var typ="";
		//alert("HI");
		var tcode=document.frmaddDepartment.tcode.value;
		var tnot=0;
		//tnot=parseInt(document.frmaddDepartment.totnobarcodes.value);
		showUser(mltval,bardet,'deletebarlots',trid,typ,tcode,'','','','','');
		//setTimeout("brcd()", 200);
		//setTimeout(function() {	document.getElementById('txtbarcod').value=""; document.getElementById('txtbarcod').focus(); }, 100);
		}
		else
		{
			return false
		}
	}
}

function brcd(tnot)
{
	if(document.frmaddDepartment.txtflg.value!=0 )
	{
		document.getElementById('txtbarcod').focus();
		document.frmaddDepartment.txtflg.value=0;
	}	
	else
	{	
		//setTimeout("brcd()", 200);
	}
}
function tempAlert(msg,duration)
{
 var el = document.createElement("div");
 el.setAttribute("style","position:absolute;top:40%;left:20%;background-color:white;");
 el.innerHTML = msg;
 setTimeout(function(){
  el.parentNode.removeChild(el);
 },duration);
 document.body.appendChild(el);
}
function chksloc1(slocval)
{
 //chksloc(slocval);
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
			var variety=document.frmaddDepartment.txtvariety1.value;
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
	var txtbarcode="deltxtbarcod";
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
		var tnot=0;
		tnot=parseInt(document.frmaddDepartment.totnobarcodes.value);
		showUser(mltval,bardet,'deletebarlots',trid,typ,whid,binid,subbin); 
		if(parseInt(document.frmaddDepartment.totnobarcodes.value)==(parseInt(tnot)-1))
		document.getElementById('txtbarcod').focus();
		else
		setTimeout(function() {	document.getElementById('txtbarcod').focus();}, 100);
	}
}

function modetchk(classval)
{
	document.frmaddDepartment.txtwhg.selectedIndex=0;
	document.frmaddDepartment.txtbin.selectedIndex=0;
	document.frmaddDepartment.txtsubb.selectedIndex=0;
	document.frmaddDepartment.txtvariety.selectedIndex=0;
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
	document.getElementById("txtbarcod").focus();
}

function slclnkch(slclnkval)
{
	if(slclnkval=="new")
	{
		if(confirm("Selecting New SLOC will close the current SLOC for further linking.\n\n Are")==true)
		{
			document.frmaddDepartment.sloclnktyp.value=slclnkval;
		}	
	}
	
}

function pform()
{	
	var f=0;
	if(document.frmaddDepartment.barcode.value=="")
	{
		alert("Please enter Barcode");
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	var sno=document.frmaddDepartment.srno.value;
	if(sno==0)
	{
		alert("Please enter Valid Barcode");
		f=1;
		return false;
	}
	for (var i=1; i<=sno; i++)
	{
		var crp="txtcrop_"+i;
		var ver="txtvariety_"+i;
		if(document.getElementById(crp).value=="")
		{
			alert("Please Select Crop");
			f=1;
			return false;
		}
		if(document.getElementById(ver).value=="")
		{
			alert("Please Select Variety");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.sloclnktyp.value=="same")
	{
	if(document.frmaddDepartment.txtesubb.value=="")
	{
		alert("Please SLOC");
		f=1;
		return false;
	}
	}	
	if(document.frmaddDepartment.sloclnktyp.value!="same")
	{
	if(document.frmaddDepartment.txtsubb.value=="")
	{
		alert("Please SLOC");
		f=1;
		return false;
	}
	}
	if(document.frmaddDepartment.sbinflg.value>0)
	{
		alert("Cannot Link to the selected SLOC. Please select different SLOC");
		f=1;
		return false;
	}	
	if(f==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postmainform','mform','','','','','');
	}  
}

function pformedtup()
{	
	var f=0;
	if(document.frmaddDepartment.barcode.value=="")
	{
		alert("Please enter Barcode");
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	var sno=document.frmaddDepartment.srno.value;
	if(sno==0)
	{
		alert("Please enter Valid Barcode");
		f=1;
		return false;
	}
	for (var i=1; i<=sno; i++)
	{
		var crp="txtcrop_"+i;
		var ver="txtvariety_"+i;
		if(document.getElementById(crp).value=="")
		{
			alert("Please Select Crop");
			f=1;
			return false;
		}
		if(document.getElementById(ver).value=="")
		{
			alert("Please Select Variety");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.sloclnktyp.value=="same")
	{
	if(document.frmaddDepartment.txtesubb.value=="")
	{
		alert("Please SLOC");
		f=1;
		return false;
	}
	}	
	if(document.frmaddDepartment.sloclnktyp.value!="same")
	{
	if(document.frmaddDepartment.txtsubb.value=="")
	{
		alert("Please SLOC");
		f=1;
		return false;
	}
	}
		
	if(f==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','');
	}
}

function editrec(edtrecid, trid)
{
	
	showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
} 

function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','');
	}
	else
	{
		return false;
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Barcode to SLOC Linking - Edit</td>
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
	/*$whquery=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
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
	*/
	$sql_main=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_id='$tid'") or die(mysqli_error($link));
	$row=mysqli_fetch_array($sql_main);
	$code=$row['btsl_code'];
	$code1="BS".$row['btsl_code']."/".$row['btsl_yearcode']."/".$row['btsl_logid'];
	$code12=$row['btsl_trrefno'];
	$code2=$row['btsl_trefno'];
	
	$dott=explode("-", $row['btsl_date']);
	$dt=$dott[2]."-".$dott[1]."-".$dott[0];
?>
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	<input name="frm_action" value="submit" type="hidden">
 	<input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	<input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" /> 
	<input type="hidden" name="foccode" value="" />
	<!--<input type="hidden" name="ewh" value="<?php echo $ewh;?>" />
	<input type="hidden" name="ebin" value="<?php echo $ebin;?>" />
	<input type="hidden" name="esbin" value="<?php echo $esbin;?>" />-->
	<input type="hidden" name="tcode" value="<?php echo $code;?>" />
	<input type="hidden" name="rcrefcode" value="<?php echo $code12;?>" />
	<input type="hidden" name="rcrfcode" value="<?php echo $code2;?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="6" >Barcode to SLOC Linking - Edit</td>
</tr>
<tr class="Light" height="20">
	<td width="89" align="right" valign="middle" class="smalltblheading">Transaction ID&nbsp;</td>
	<td width="146" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code1;?></td>
	<td width="35" align="right" valign="middle" class="smalltblheading">Date&nbsp;</td>
	<td width="114" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dt;?></td>
	<td width="94" align="right" valign="middle" class="smalltblheading">Recall Ref. No&nbsp;</td>
	<td width="158" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code12;?> </td>
</tr>
</table><br />

<div id="postmainform">
<?php
$subtid=0;
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onchange="chkbarcode1(this.value)" /></td>
</tr>
</table><br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Delete Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="delbarcode" id="txtbarcoddel" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onchange="chkbarcode24(this.value)" /></td>
</tr>
</table><br />


<div id="showcvdet"></div>
<br />
<table align="center" height="25" width="950"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="smalltblheading" colspan="7">SLOC Details - Identified Barcodes</td>
  </tr>	
<tr class="tblsubtitle" height="20">
	<td width="4%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">WH</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Sub-Bin</td>
    <td width="23%" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="28%" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="12%" align="center" valign="middle" class="smalltblheading">No. of Barcode(s)</td>
</tr>
<?php
$sno1=1; $nobrc=0; $nobcd="";
 $sql_identfy1=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub where plantcode='$plantcode' AND btsl_id='$tid'") or die(mysqli_error($link));
 $tot_identfy1=mysqli_num_rows($sql_identfy1);
 if($tot_identfy1 > 0)
 {
 while($row_identfy1=mysqli_fetch_array($sql_identfy1))
 {
 	if($isbn!="")
	$isbn=$isbn.",".$row_identfy1['btslss_subbin'];
	else
	$isbn=$row_identfy1['btslss_subbin'];

 $sql_identfy2=mysqli_query($link,"select max(btslss_id) from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."'") or die(mysqli_error($link));
 $tot_identfy2=mysqli_num_rows($sql_identfy2);
 $row_identfy2=mysqli_fetch_array($sql_identfy2);

	
 $sql_identfy=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_id='".$row_identfy2[0]."'") or die(mysqli_error($link));
 $tot_identfy=mysqli_num_rows($sql_identfy);
 while($row_identfy=mysqli_fetch_array($sql_identfy))
 {
 $ssid=$row_identfy['btslsub_id'];
 
 $sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_identfy['btslss_bin']."' and plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_identfy['btslss_subbin']."' and binid='".$row_identfy['btslss_bin']."' and whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sql_sub=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_id='".$row_identfy['btslsub_id']."'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_sub['btslsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crp=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_sub['btslsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$ver=$noticia_item['popularname'];
$nobcd="";
$sql_identfy24=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."' and btsl_id='$tid'") or die(mysqli_error($link));
$nobrc=mysqli_num_rows($sql_identfy24);
while($rowbarcsub=mysqli_fetch_array($sql_identfy24))
{
	$brcod=$row_sub['btslsub_barcode'];
	if($nobcd!="")
	$nobcd=$nobcd.",".$brcod;
	else
	$nobcd=$brcod;
}

?> 	
<tr>
	<td width="4%" align="center"  valign="middle" class="smalltbltext" ><?php echo $sno1?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $wareh?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $binn?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $subbinn?></td>
	<td width="23%" align="center"  valign="middle" class="smalltbltext" ><?php echo $crp?></td>
	<td width="28%" align="center"  valign="middle" class="smalltbltext" ><?php echo $ver?></td>
	<td width="12%" align="center"  valign="middle" class="smalltbltext" title="<?php echo $nobcd;?>" ><?php echo $nobrc?></td>
</tr>
<?php
}
}
}
?>
</table><br />

<table align="center" height="25" width="950"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="smalltblheading" colspan="7">SLOC Details - Un-Identified Barcodes</td>
  </tr>	
<tr class="tblsubtitle" height="20">
	<td width="4%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">WH</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Sub-Bin</td>
    <td width="23%" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="28%" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="12%" align="center" valign="middle" class="smalltblheading">No. of Barcode(s)</td>
</tr>	
<?php
$sno2=1; $nobrc=0; $nobcd="";
 $sql_identfy1=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btsl_id='$tid'") or die(mysqli_error($link));
 $tot_identfy1=mysqli_num_rows($sql_identfy1);
 if($tot_identfy1 > 0)
 {
 while($row_identfy1=mysqli_fetch_array($sql_identfy1))
 {
 	if($isbn!="")
	$isbn=$isbn.",".$row_identfy1['btslss_subbin'];
	else
	$isbn=$row_identfy1['btslss_subbin'];

 $sql_identfy2=mysqli_query($link,"select max(btslss_id) from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."'") or die(mysqli_error($link));
 $tot_identfy2=mysqli_num_rows($sql_identfy2);
 $row_identfy2=mysqli_fetch_array($sql_identfy2);

	
 $sql_identfy=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_id='".$row_identfy2[0]."'") or die(mysqli_error($link));
 $tot_identfy=mysqli_num_rows($sql_identfy);
 while($row_identfy=mysqli_fetch_array($sql_identfy))
 {
 $ssid=$row_identfy['btslsub_id'];
 
 $sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_identfy['btslss_bin']."' and plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_identfy['btslss_subbin']."' and binid='".$row_identfy['btslss_bin']."' and whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sql_sub=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_id='".$row_identfy['btslsub_id']."'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_sub['btslsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crp=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_sub['btslsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$ver=$noticia_item['popularname'];
$nobcd="";
$sql_identfy24=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."' and btsl_id='$tid'") or die(mysqli_error($link));
$nobrc=mysqli_num_rows($sql_identfy24);
while($rowbarcsub=mysqli_fetch_array($sql_identfy24))
{
	$brcod=$row_sub['btslsub_barcode'];
	if($nobcd!="")
	$nobcd=$nobcd.",".$brcod;
	else
	$nobcd=$brcod;
}

?> 	
<tr>
	<td width="4%" align="center"  valign="middle" class="smalltbltext" ><?php echo $sno2?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $wareh?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $binn?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $subbinn?></td>
	<td width="23%" align="center"  valign="middle" class="smalltbltext" ><?php echo $crp?></td>
	<td width="28%" align="center"  valign="middle" class="smalltbltext" ><?php echo $ver?></td>
	<td width="12%" align="center"  valign="middle" class="smalltbltext" title="<?php echo $nobcd;?>" ><?php echo $nobrc?></td>
</tr>
<?php
}
}
}
?>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>


<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
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

  
