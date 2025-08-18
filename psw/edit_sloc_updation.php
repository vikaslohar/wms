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
		$trid=trim($_POST['trid']);
		echo "<script>window.location='add_sloc_preview.php?pid=$trid'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw-Transction-Sloc Updation-Lot wise</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
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

<script src="slocup.js"></script>
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

function clks(val)
{
	document.frmaddDepartment.txt14.value=val;
}

function mySubmit()
{ 
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		return false;
	} 
	if(document.frmaddDepartment.trid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	/*if(parseInt(document.frmaddDepartment.extenomp.value)!=parseInt(document.frmaddDepartment.extnnomp.value))
	{
		alert("Please check. Existing Total NoMP not matching with Total NoMP in Updated SLOC");
		return false;
	}*/
	if(parseFloat(document.frmaddDepartment.exteqty.value)!=parseFloat(document.frmaddDepartment.extnqty.value))
	{
		alert("Please check. Existing Total Qty not matching with Total Qty in Updated SLOC");
		return false;
	}
	return true;	 
}

function modetchk(classval) 
{
	document.frmaddDepartment.txtlot1.value=""
	document.frmaddDepartment.trid.value=0;
	document.getElementById('subdiv').style.display="none";
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1(val)
{
	document.frmaddDepartment.txtlot1.value=""
	document.frmaddDepartment.trid.value=0;
	document.getElementById('subdiv').style.display="none";
}

function chktp(val)
{
	//document.frmaddDepartment.txtmtype.value=val;
	document.getElementById('subdiv').style.display="block";
	setTimeout('chktyp()',200);

}
function chktyp()
{ 
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		var trid=document.frmaddDepartment.trid.value;
			
		if(opttyp !="")
		{
			document.getElementById("maindiv").style.display="block";
			document.getElementById("subsubdiv").style.display="none";
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,trid,'');
		}
		else
		{
			alert("please select LOT Number");
		}
	}
	else
	{
		alert("please select LOT Number");
	}
}

function wh1(wh1val)
{ 
	showUser(wh1val,'bing1','wh','bing1','','','','');
}

function wh2(wh2val)
{   
	showUser(wh2val,'bing2','wh','bing2','','','','');
}

function wh3(wh3val)
{   
	showUser(wh3val,'bing3','wh','bing3','','','','');
}

function wh4(wh4val)
{   
	showUser(wh4val,'bing4','wh','bing4','','','','');
}

function wh5(wh5val)
{   
	showUser(wh5val,'bing5','wh','bing5','','','','');
}

function wh6(wh6val)
{   
	showUser(wh6val,'bing6','wh','bing6','','','','');
}

function wh7(wh7val)
{   
	showUser(wh7val,'bing7','wh','bing7','','','','');
}

function wh8(wh8val)
{   
	showUser(wh8val,'bing8','wh','bing8','','','','');
}


function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin2(bin2val)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin3(bin3val)
{
	if(document.frmaddDepartment.txtslwhg3.value!="")
	{
		showUser(bin3val,'sbing3','bin','txtslsubbg3','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin4(bin4val)
{
	if(document.frmaddDepartment.txtslwhg4.value!="")
	{
		showUser(bin4val,'sbing4','bin','txtslsubbg4','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin5(bin5val)
{
	if(document.frmaddDepartment.txtslwhg5.value!="")
	{
		showUser(bin5val,'sbing5','bin','txtslsubbg5','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin6(bin6val)
{
	if(document.frmaddDepartment.txtslwhg6.value!="")
	{
		showUser(bin6val,'sbing6','bin','txtslsubbg6','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin7(bin7val)
{
	if(document.frmaddDepartment.txtslwhg7.value!="")
	{
		showUser(bin7val,'sbing7','bin','txtslsubbg7','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin8(bin8val)
{
	if(document.frmaddDepartment.txtslwhg8.value!="")
	{
		showUser(bin8val,'sbing8','bin','txtslsubbg8','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w1==w2) || (w1==w3) || (w1==w4) || (w1==w5) || (w1==w6) || (w1==w7) || (w1==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg1.value!="")
		var nopv1=document.frmaddDepartment.exnopsg1.value;
		else
		var nopv1="";
		if(document.frmaddDepartment.exBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.exBagsg1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.exqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.exqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid,nopv1);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w2==w1) || (w2==w3) || (w2==w4) || (w2==w5) || (w2==w6) || (w2==w7) || (w2==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg2.value!="")
		var nopv2=document.frmaddDepartment.exnopsg2.value;
		else
		var nopv2="";
		if(document.frmaddDepartment.exBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.exBagsg2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.exqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.exqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid,nopv2);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing3.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w3==w1) || (w3==w2) || (w3==w4) || (w3==w5) || (w3==w6) || (w3==w7) || (w3==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg3.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg3.value!="")
		var nopv3=document.frmaddDepartment.exnopsg3.value;
		else
		var nopv3="";
		if(document.frmaddDepartment.exBagsg3.value!="")
		var Bagsv3=document.frmaddDepartment.exBagsg3.value;
		else
		var Bagsv3="";
		if(document.frmaddDepartment.exqtyg3.value!="")
		var qtyv3=document.frmaddDepartment.exqtyg3.value;
		else
		var qtyv3="";
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,Bagsv3,qtyv3,trid,nopv3);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing3.focus();
	}
}

function subbin4(subbin4val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing4.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w4==w1) || (w4==w2) || (w4==w3) || (w4==w5) || (w4==w6) || (w4==w7) || (w4==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg4.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg4.value!="")
		var nopv4=document.frmaddDepartment.exnopsg4.value;
		else
		var nopv4="";
		if(document.frmaddDepartment.exBagsg4.value!="")
		var Bagsv4=document.frmaddDepartment.exBagsg4.value;
		else
		var Bagsv4="";
		if(document.frmaddDepartment.exqtyg4.value!="")
		var qtyv4=document.frmaddDepartment.exqtyg4.value;
		else
		var qtyv4="";
		showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbg4',slocnogood,Bagsv4,qtyv4,trid,nopv4);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing4.focus();
	}
}

function subbin5(subbin5val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing5.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w5==w1) || (w5==w2) || (w5==w3) || (w5==w4) || (w5==w6) || (w5==w7) || (w5==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg5.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg5.value!="")
		var nopv5=document.frmaddDepartment.exnopsg5.value;
		else
		var nopv5="";
		if(document.frmaddDepartment.exBagsg5.value!="")
		var Bagsv5=document.frmaddDepartment.exBagsg5.value;
		else
		var Bagsv5="";
		if(document.frmaddDepartment.exqtyg5.value!="")
		var qtyv5=document.frmaddDepartment.exqtyg5.value;
		else
		var qtyv5="";
		showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbg5',slocnogood,Bagsv5,qtyv5,trid,nopv5);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing5.focus();
	}
}

function subbin6(subbin6val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing6.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w6==w1) || (w6==w2) || (w6==w3) || (w6==w4) || (w6==w5) || (w6==w7) || (w6==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg6.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg6.value!="")
		var nopv6=document.frmaddDepartment.exnopsg6.value;
		else
		var nopv6="";
		if(document.frmaddDepartment.exBagsg6.value!="")
		var Bagsv6=document.frmaddDepartment.exBagsg6.value;
		else
		var Bagsv6="";
		if(document.frmaddDepartment.exqtyg6.value!="")
		var qtyv6=document.frmaddDepartment.exqtyg6.value;
		else
		var qtyv6="";
		showUser(subbin6val,'slocrow6','subbin',itemv,'txtslsubbg6',slocnogood,Bagsv6,qtyv6,trid,nopv6);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing6.focus();
	}
}

function subbin7(subbin7val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing7.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w7==w1) || (w7==w3) || (w7==w4) || (w7==w5) || (w7==w6) || (w7==w2) || (w7==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg7.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg7.value!="")
		var nopv7=document.frmaddDepartment.exnopsg7.value;
		else
		var nopv7="";
		if(document.frmaddDepartment.exBagsg7.value!="")
		var Bagsv7=document.frmaddDepartment.exBagsg7.value;
		else
		var Bagsv7="";
		if(document.frmaddDepartment.exqtyg7.value!="")
		var qtyv7=document.frmaddDepartment.exqtyg7.value;
		else
		var qtyv7="";
		showUser(subbin7val,'slocrow7','subbin',itemv,'txtslsubbg7',slocnogood,Bagsv7,qtyv7,trid,nopv7);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing7.focus();
	}
}

function subbin8(subbin8val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing8.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w8==w1) || (w8==w3) || (w8==w4) || (w8==w5) || (w8==w6) || (w8==w7) || (w8==w2))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg8.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg8.value!="")
		var nopv8=document.frmaddDepartment.exnopsg8.value;
		else
		var nopv8="";
		if(document.frmaddDepartment.exBagsg8.value!="")
		var Bagsv8=document.frmaddDepartment.exBagsg8.value;
		else
		var Bagsv8="";
		if(document.frmaddDepartment.exqtyg8.value!="")
		var qtyv8=document.frmaddDepartment.exqtyg8.value;
		else
		var qtyv8="";
		showUser(subbin8val,'slocrow8','subbin',itemv,'txtslsubbg8',slocnogood,Bagsv8,qtyv8,trid,nopv8);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing8.focus();
	}
}

function nopsf1(nops1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg1.value="";
	}
	if(document.frmaddDepartment.txtslnopsg1.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg1.value);
		document.frmaddDepartment.balnopg1.value=parseInt(document.frmaddDepartment.txtslnopsg1.value,10);
		if(document.frmaddDepartment.txtslnopsg1.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg1.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg1.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg1.value=y;
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg1.value=document.frmaddDepartment.balqtyg1.value;
		document.frmaddDepartment.txtslqtyg1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value).toFixed(3);
	}
	else
	{
		document.frmaddDepartment.balnopg1.value="";
	}
}

function nopsf2(nops2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")

	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg2.value="";
	}
	if(document.frmaddDepartment.txtslnopsg2.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg2.value);
		document.frmaddDepartment.balnopg2.value=parseInt(document.frmaddDepartment.txtslnopsg2.value);
		if(document.frmaddDepartment.txtslnopsg2.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg2.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=y;
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg2.value=document.frmaddDepartment.balqtyg2.value;
		document.frmaddDepartment.txtslqtyg2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg2.value="";
	}
}

function nopsf3(nops3val)
{
	if(document.frmaddDepartment.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg3.value="";
	}
	if(document.frmaddDepartment.txtslnopsg3.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg3.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg3.value);
		document.frmaddDepartment.balnopg3.value=parseInt(document.frmaddDepartment.txtslnopsg3.value);
		if(document.frmaddDepartment.txtslnopsg3.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg3.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=y;
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg3.value=document.frmaddDepartment.balqtyg3.value;
		document.frmaddDepartment.txtslqtyg3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg3.value="";
	}
}

function nopsf4(nops4val)
{
	if(document.frmaddDepartment.txtslsubbg4.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg4.value="";
	}
	if(document.frmaddDepartment.txtslnopsg4.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg4.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg4.value);
		document.frmaddDepartment.balnopg4.value=parseInt(document.frmaddDepartment.txtslnopsg4.value);
		if(document.frmaddDepartment.txtslnopsg4.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg4.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=y;
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg4.value=document.frmaddDepartment.balqtyg4.value;
		document.frmaddDepartment.txtslqtyg4.value=parseFloat(document.frmaddDepartment.txtslqtyg4.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg4.value="";
	}
}

function nopsf5(nops5val)
{
	if(document.frmaddDepartment.txtslsubbg5.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg5.value="";
	}
	if(document.frmaddDepartment.txtslnopsg5.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg5.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg5.value);
		document.frmaddDepartment.balnopg5.value=parseInt(document.frmaddDepartment.txtslnopsg5.value);
		if(document.frmaddDepartment.txtslnopsg5.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg5.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=y;
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg5.value=document.frmaddDepartment.balqtyg5.value;
		document.frmaddDepartment.txtslqtyg5.value=parseFloat(document.frmaddDepartment.txtslqtyg5.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg5.value="";
	}
}

function nopsf6(nops6val)
{
	if(document.frmaddDepartment.txtslsubbg6.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg6.value="";
	}
	if(document.frmaddDepartment.txtslnopsg6.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg6.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg6.value);
		document.frmaddDepartment.balnopg6.value=parseInt(document.frmaddDepartment.txtslnopsg6.value);
		if(document.frmaddDepartment.txtslnopsg6.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg6.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=y;
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg6.value=document.frmaddDepartment.balqtyg6.value;
		document.frmaddDepartment.txtslqtyg6.value=parseFloat(document.frmaddDepartment.txtslqtyg6.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg6.value="";
	}
}

function nopsf7(nops7val)
{
	if(document.frmaddDepartment.txtslsubbg7.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg7.value="";
	}
	if(document.frmaddDepartment.txtslnopsg7.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg7.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg7.value);
		document.frmaddDepartment.balnopg7.value=parseInt(document.frmaddDepartment.txtslnopsg7.value);
		if(document.frmaddDepartment.txtslnopsg7.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg7.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=y;
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg7.value=document.frmaddDepartment.balqtyg7.value;
		document.frmaddDepartment.txtslqtyg7.value=parseFloat(document.frmaddDepartment.txtslqtyg7.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg7.value="";
	}
}

function nopsf8(nops8val)
{
	if(document.frmaddDepartment.txtslsubbg8.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg8.value="";
	}
	if(document.frmaddDepartment.txtslnopsg8.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg8.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg8.value);
		document.frmaddDepartment.balnopg8.value=parseInt(document.frmaddDepartment.txtslnopsg8.value);
		if(document.frmaddDepartment.txtslnopsg8.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg8.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=y;
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg8.value=document.frmaddDepartment.balqtyg8.value;
		document.frmaddDepartment.txtslqtyg8.value=parseFloat(document.frmaddDepartment.txtslqtyg8.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg8.value="";
	}
}

function Bagsf1(Bags1val)
{	
	if(document.frmaddDepartment.txtslBagsg1.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg1.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg1.value);
		document.frmaddDepartment.balnompg1.value=parseInt(document.frmaddDepartment.txtslBagsg1.value);
		if(document.frmaddDepartment.txtslnopsg1.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg1.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg1.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg1.value=y;
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg1.value=document.frmaddDepartment.balqtyg1.value;
		document.frmaddDepartment.txtslqtyg1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg1.value="";
	}

}

function Bagsf2(Bags2val)
{
	if(document.frmaddDepartment.txtslBagsg2.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg2.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg2.value);
		document.frmaddDepartment.balnompg2.value=parseInt(document.frmaddDepartment.txtslBagsg2.value);
		if(document.frmaddDepartment.txtslnopsg2.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg2.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=y;
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg2.value=document.frmaddDepartment.balqtyg2.value;
		document.frmaddDepartment.txtslqtyg2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg2.value="";
	}
}
function Bagsf3(Bags3val)
{
	if(document.frmaddDepartment.txtslBagsg3.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg3.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg3.value);
		document.frmaddDepartment.balnompg3.value=parseInt(document.frmaddDepartment.txtslBagsg3.value);
		if(document.frmaddDepartment.txtslnopsg3.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg3.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=y;
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg3.value=document.frmaddDepartment.balqtyg3.value;
		document.frmaddDepartment.txtslqtyg3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg3.value="";
	}
}
function Bagsf4(Bags4val)
{
	if(document.frmaddDepartment.txtslBagsg4.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg4.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg4.value);
		document.frmaddDepartment.balnompg4.value=parseInt(document.frmaddDepartment.txtslBagsg4.value);
		if(document.frmaddDepartment.txtslnopsg4.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg4.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=y;
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg4.value=document.frmaddDepartment.balqtyg4.value;
		document.frmaddDepartment.txtslqtyg4.value=parseFloat(document.frmaddDepartment.txtslqtyg4.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg4.value="";
	}
}
function Bagsf5(Bags5val)
{
	if(document.frmaddDepartment.txtslBagsg5.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg5.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg5.value);
		document.frmaddDepartment.balnompg5.value=parseInt(document.frmaddDepartment.txtslBagsg5.value);
		if(document.frmaddDepartment.txtslnopsg5.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg5.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=y;
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg5.value=document.frmaddDepartment.balqtyg5.value;
		document.frmaddDepartment.txtslqtyg5.value=parseFloat(document.frmaddDepartment.txtslqtyg5.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg5.value="";
	}
}
function Bagsf6(Bags6val)
{
	if(document.frmaddDepartment.txtslBagsg6.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg6.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg6.value);
		document.frmaddDepartment.balnompg6.value=parseInt(document.frmaddDepartment.txtslBagsg6.value);
		if(document.frmaddDepartment.txtslnopsg6.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg6.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=y;
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg6.value=document.frmaddDepartment.balqtyg6.value;
		document.frmaddDepartment.txtslqtyg6.value=parseFloat(document.frmaddDepartment.txtslqtyg6.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg6.value="";
	}
}
function Bagsf7(Bags7val)
{
	if(document.frmaddDepartment.txtslBagsg7.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg7.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg7.value);
		document.frmaddDepartment.balnompg7.value=parseInt(document.frmaddDepartment.txtslBagsg7.value);
		if(document.frmaddDepartment.txtslnopsg7.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg7.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=y;
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg7.value=document.frmaddDepartment.balqtyg7.value;
		document.frmaddDepartment.txtslqtyg7.value=parseFloat(document.frmaddDepartment.txtslqtyg7.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg7.value="";
	}
}
function Bagsf8(Bags8val)
{
	if(document.frmaddDepartment.txtslBagsg8.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg8.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg8.value);
		document.frmaddDepartment.balnompg8.value=parseInt(document.frmaddDepartment.txtslBagsg8.value);
		if(document.frmaddDepartment.txtslnopsg8.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg8.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=y;
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg8.value=document.frmaddDepartment.balqtyg8.value;
		document.frmaddDepartment.txtslqtyg8.value=parseFloat(document.frmaddDepartment.txtslqtyg8.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg8.value="";
	}
}



function pform()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslwhg3.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslbing3.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg3.value > 0) && (document.frmaddDepartment.txtslsubbg3.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg4.value>0) && (document.frmaddDepartment.txtslwhg4.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg4.value>0) && (document.frmaddDepartment.txtslbing4.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg4.value > 0) && (document.frmaddDepartment.txtslsubbg4.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg5.value>0) && (document.frmaddDepartment.txtslwhg5.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg5.value>0) && (document.frmaddDepartment.txtslbing5.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg5.value > 0) && (document.frmaddDepartment.txtslsubbg5.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg6.value>0) && (document.frmaddDepartment.txtslwhg6.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg6.value>0) && (document.frmaddDepartment.txtslbing6.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg6.value > 0) && (document.frmaddDepartment.txtslsubbg6.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg7.value>0) && (document.frmaddDepartment.txtslwhg7.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg7.value>0) && (document.frmaddDepartment.txtslbing7.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg7.value > 0) && (document.frmaddDepartment.txtslsubbg7.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg8.value>0) && (document.frmaddDepartment.txtslwhg8.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg8.value>0) && (document.frmaddDepartment.txtslbing8.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg8.value > 0) && (document.frmaddDepartment.txtslsubbg8.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var u1=document.frmaddDepartment.balnompg1.value;
		var u2=document.frmaddDepartment.balnompg2.value;
		var u3=document.frmaddDepartment.balnompg3.value;
		var u4=document.frmaddDepartment.balnompg4.value;
		var u5=document.frmaddDepartment.balnompg5.value;
		var u6=document.frmaddDepartment.balnompg6.value;
		var u7=document.frmaddDepartment.balnompg7.value;
		var u8=document.frmaddDepartment.balnompg8.value;
		
		var q1=document.frmaddDepartment.balqtyg1.value;
		var q2=document.frmaddDepartment.balqtyg2.value;
		var q3=document.frmaddDepartment.balqtyg3.value;
		var q4=document.frmaddDepartment.balqtyg4.value;
		var q5=document.frmaddDepartment.balqtyg5.value;
		var q6=document.frmaddDepartment.balqtyg6.value;
		var q7=document.frmaddDepartment.balqtyg7.value;
		var q8=document.frmaddDepartment.balqtyg8.value;
		
		var n1=document.frmaddDepartment.balnopg1.value;
		var n2=document.frmaddDepartment.balnopg2.value;
		var n3=document.frmaddDepartment.balnopg3.value;
		var n4=document.frmaddDepartment.balnopg4.value;
		var n5=document.frmaddDepartment.balnopg5.value;
		var n6=document.frmaddDepartment.balnopg6.value;
		var n7=document.frmaddDepartment.balnopg7.value;
		var n8=document.frmaddDepartment.balnopg8.value;
		
		var n=document.frmaddDepartment.txtnopsg.value;
		var d=document.frmaddDepartment.txtqtyg.value;
		var u=document.frmaddDepartment.txtBagsg.value;
				
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;if(q6=="")q6=0;if(q7=="")q7=0;if(q8=="")q8=0;
		if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;if(u4=="")u4=0;if(u5=="")u5=0;if(u6=="")u6=0;if(u7=="")u7=0;if(u8=="")u8=0;
		if(n1=="")n1=0;if(n2=="")n2=0;if(n3=="")n3=0;if(n4=="")n4=0;if(n5=="")n5=0;if(n6=="")n6=0;if(n7=="")n7=0;if(n8=="")n8=0;
		if(n=="")n=0;
		if(d=="")d=0;
		if(u=="")u=0;
		var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3)+parseFloat(q4)+parseFloat(q5)+parseFloat(q6)+parseFloat(q7)+parseFloat(q8);
		var Bagsd=parseInt(u1)+parseInt(u2)+parseInt(u3)+parseInt(u4)+parseInt(u5)+parseInt(u6)+parseInt(u7)+parseInt(u8);
		var nopsd=parseInt(n1)+parseInt(n2)+parseInt(n3)+parseInt(n4)+parseInt(n5)+parseInt(n6)+parseInt(n7)+parseInt(n8);
		var f=0;
		//alert(qtyd);
		/*if(parseInt(n) != parseInt(nopsd))
		{
			alert("Please check. NoP distributed in Bins not matching with Total NoP");
			f=1;return false;
			
		}
		if(parseInt(u) != parseInt(Bagsd))
		{
			alert("Please check. NoMP distributed in Bins not matching with Total NoMP");
			f=1;return false;
			
		}*/
		if(parseFloat(d) != parseFloat(qtyd))
		{
			alert("Please check. Balance Quantity distributed in Bins not matching with Total Quantity");
			f=1;return false;
			
		}
		if(qtyd==0)
		{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			f=1;return false;
			
		}
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'maindiv','mformcc','','','','','');
		}
	}
	else
	{
		alert("Please select Lot No.");
		return false;
	}
}	

function pformupdate()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslwhg3.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslbing3.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg3.value > 0) && (document.frmaddDepartment.txtslsubbg3.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg4.value>0) && (document.frmaddDepartment.txtslwhg4.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg4.value>0) && (document.frmaddDepartment.txtslbing4.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg4.value > 0) && (document.frmaddDepartment.txtslsubbg4.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg5.value>0) && (document.frmaddDepartment.txtslwhg5.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg5.value>0) && (document.frmaddDepartment.txtslbing5.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg5.value > 0) && (document.frmaddDepartment.txtslsubbg5.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg6.value>0) && (document.frmaddDepartment.txtslwhg6.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg6.value>0) && (document.frmaddDepartment.txtslbing6.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg6.value > 0) && (document.frmaddDepartment.txtslsubbg6.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg7.value>0) && (document.frmaddDepartment.txtslwhg7.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg7.value>0) && (document.frmaddDepartment.txtslbing7.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg7.value > 0) && (document.frmaddDepartment.txtslsubbg7.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg8.value>0) && (document.frmaddDepartment.txtslwhg8.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg8.value>0) && (document.frmaddDepartment.txtslbing8.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg8.value > 0) && (document.frmaddDepartment.txtslsubbg8.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var u1=document.frmaddDepartment.balnompg1.value;
		var u2=document.frmaddDepartment.balnompg2.value;
		var u3=document.frmaddDepartment.balnompg3.value;
		var u4=document.frmaddDepartment.balnompg4.value;
		var u5=document.frmaddDepartment.balnompg5.value;
		var u6=document.frmaddDepartment.balnompg6.value;
		var u7=document.frmaddDepartment.balnompg7.value;
		var u8=document.frmaddDepartment.balnompg8.value;
		
		var q1=document.frmaddDepartment.balqtyg1.value;
		var q2=document.frmaddDepartment.balqtyg2.value;
		var q3=document.frmaddDepartment.balqtyg3.value;
		var q4=document.frmaddDepartment.balqtyg4.value;
		var q5=document.frmaddDepartment.balqtyg5.value;
		var q6=document.frmaddDepartment.balqtyg6.value;
		var q7=document.frmaddDepartment.balqtyg7.value;
		var q8=document.frmaddDepartment.balqtyg8.value;
		
		var n1=document.frmaddDepartment.balnopg1.value;
		var n2=document.frmaddDepartment.balnopg2.value;
		var n3=document.frmaddDepartment.balnopg3.value;
		var n4=document.frmaddDepartment.balnopg4.value;
		var n5=document.frmaddDepartment.balnopg5.value;
		var n6=document.frmaddDepartment.balnopg6.value;
		var n7=document.frmaddDepartment.balnopg7.value;
		var n8=document.frmaddDepartment.balnopg8.value;
		
		var n=document.frmaddDepartment.txtnopsg.value;
		var d=document.frmaddDepartment.txtqtyg.value;
		var u=document.frmaddDepartment.txtBagsg.value;
				
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;if(q6=="")q6=0;if(q7=="")q7=0;if(q8=="")q8=0;
		if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;if(u4=="")u4=0;if(u5=="")u5=0;if(u6=="")u6=0;if(u7=="")u7=0;if(u8=="")u8=0;
		if(n1=="")n1=0;if(n2=="")n2=0;if(n3=="")n3=0;if(n4=="")n4=0;if(n5=="")n5=0;if(n6=="")n6=0;if(n7=="")n7=0;if(n8=="")n8=0;
		if(n=="")n=0;
		if(d=="")d=0;
		if(u=="")u=0;
		var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3)+parseFloat(q4)+parseFloat(q5)+parseFloat(q6)+parseFloat(q7)+parseFloat(q8);
		var Bagsd=parseInt(u1)+parseInt(u2)+parseInt(u3)+parseInt(u4)+parseInt(u5)+parseInt(u6)+parseInt(u7)+parseInt(u8);
		var nopsd=parseInt(n1)+parseInt(n2)+parseInt(n3)+parseInt(n4)+parseInt(n5)+parseInt(n6)+parseInt(n7)+parseInt(n8);
		var f=0;
		//alert(qtyd);
		/*if(parseInt(n) != parseInt(nopsd))
		{
			alert("Please check. NoP distributed in Bins not matching with Total NoP");
			f=1;return false;
			
		}
		if(parseInt(u) != parseInt(Bagsd))
		{
			alert("Please check. NoMP distributed in Bins not matching with Total NoMP");
			f=1;return false;
			
		}*/
		if(parseFloat(d) != parseFloat(qtyd))
		{
			alert("Please check. Balance Quantity distributed in Bins not matching with Total Quantity");
			f=1;return false;
			
		}
		if(qtyd==0)
		{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			f=1;return false;
			
		}
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'maindiv','mformccupdate','','','','','');
		}
	}
	else
	{
		alert("Please select Lot No.");
		return false;
	}
}

function showsloc(val1, val2, val3)
{
	document.frmaddDepartment.oBags.value=val1;
	document.frmaddDepartment.oqty.value=val2;
	document.frmaddDepartment.orwoid.value=val3;
	var trid=document.frmaddDepartment.trid.value;
	//alert(val3);
	var opttyp=document.frmaddDepartment.txtlot1.value;
	var clasid=document.frmaddDepartment.txtcrop.value;
	var itmid=document.frmaddDepartment.txtvariety.value;
	//alert(opttyp);
	document.getElementById("subsubdiv").style.display="block";			
	showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'');
	//document.getElementById('sloc1').style.display="block";
}

function editrec(v1,v2,v3,v4)
{
	showUser(v1,'subsubdiv','etdrecsl',v2,v3,v4,'','');
}

function openslocpop()
{
	document.frmaddDepartment.trid.value=0;
	document.getElementById("maindiv").style.display="none";
	document.getElementById("subsubdiv").style.display="none";	
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		//document.frmaddDepartment.txt1.focus();
	}
	else
	{
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		winHandle=window.open('getuser_sloc_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}
function openprintsubbin(subid, bid, wid, lid)
{
	var itm="";
	var tp="";
	winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"   align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation - Lot wise</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_sloc_psw where plantcode='$plantcode' and slid='".$pid."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);

	$trid=$pid;	
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$pid."'")or die(mysqli_error($link));
    $row_sub=mysqli_fetch_array($sql_sub);
	
$txtcrop=$row['crop'];
$txtvariety=$row['variety'];
$txtlot1=$row['lotno'];
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="code" value="<?php echo $row['code'];?>" type="hidden">
	  <input name="txtmtype" value="" type="hidden">
	   <input type="hidden" name="rettyp" value="" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
	    <input type="hidden" name="oBags" value="" />
	   <input type="hidden" name="txtdate" value="<?php echo $tdate;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation - Lot wise</td>
</tr>
  <tr height="30">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>

 <?php 
$quer3=mysqli_query($link,"select * from tblcrop order by cropname") or die(mysqli_error($link));
?>
		 <tr class="Dark" height="25">
           <td width="376"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" >--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($row['crop']==$noticia_class['cropid']) { echo "Selected";} ?> value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
         </tr>
		<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$row['crop']."' and actstatus='Active'") or die(mysqli_error($link));
$sql_qc=mysqli_query($link,"SELECT distinct(variety) FROM tbl_qctest WHERE plantcode='$plantcode' and crop='".$row['crop']."' and variety NOT RLIKE '^[-+0-9.E]+$'");
$tt=mysqli_num_rows($sql_qc);
?> 
		  <tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="568" align="left" valign="middle" class="tbltext" id="vitem"  colspan="3">&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;"onchange="modetchk1(this.value)" >
<option value="" >--Select Variety--</option>
	<?php while($noticia_item = mysqli_fetch_array($itemqry)) { ?>
<option <?php if($row['variety']==$noticia_item['varietyid']){ echo "Selected";} ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
		<?php while($noticia_item1 = mysqli_fetch_array($sql_qc)) { ?>
		<option <?php if($row['variety']==$noticia_item1['variety']){ echo "Selected";} ?> value="<?php echo $noticia_item1['variety'];?>" />   
		<?php echo $noticia_item1['variety'];?>
		<?php } ?>
		</select>&nbsp;<font color="#FF0000">*</font></td>
         
      </tr>	 <input type="hidden" name="itmdchk" value="" />
	   <tr class="Light" height="25">
            <td width="376" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle" colspan="3"  class="tbltext">&nbsp;<input name="txtlot1" id="smt" type="text" class="tbltext" value="<?php echo $row['lotno'];?>" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
         </tr>	

</table>
<br />
<div id="maindiv">
<div id="subdiv" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
   <td colspan="6" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <td colspan="4" align="center" valign="middle" class="tblheading">Updated Sloc </td>
   <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
 </tr>
 <tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">UPS</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">NoP</td>
<td width="103" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<td width="129" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">NoP</td>
<td width="103" align="center" valign="middle" class="tblheading">NoMP</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>
<?php
$cnt=0;

$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' and lotno='".$txtlot1."'") or die(mysqli_error($link));

$srno=1;
$totnop=0; $totnomp=0; $totqty=0; $totnnop=0; $totnnomp=0; $totnqty=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$txtvariety."' and lotno='".$txtlot1."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 $sloc1=""; $cnt++; $nop=""; $nomp=""; $bqty=""; $nop1=0; 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

$sloc1=$wareh1.$binn1.$subbinn1;

$nop1=0; $nop2=0; $b1=0; $b2=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$packtp=explode(" ",$row_issuetbl['packtype']);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp2=(1000/$packtp[0]);
}
else
{
	$ptp2=$packtp[0];
}
$bl=($row_issuetbl['balqty']*100)/100;
$b2=(($wtinmp*$row_issuetbl['balnomp'])*100)/100;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;


if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp2*$penqty);
	}
	else
	{
		$nop1=($penqty/$ptp2);
	}
}
if($packtp[1]=="Gms")
{
	$nop2=($ptp2*$row_issuetbl['balqty']);
}
else
{
	$nop2=($row_issuetbl['balqty']/$ptp2);
}

$nop2;
$zz=str_split($txtlot1);
$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];


$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=$row_mps['mpmain_crop'];
		$verarr=$row_mps['mpmain_variety'];
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=$row_mps['mpmain_upssize'];
		$noparr=explode(",", $row_mps['mpmain_mptnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nops=$nops+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=$row_mpl['mpmain_crop'];
		$verarr=$row_mpl['mpmain_variety'];
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=$row_mpl['mpmain_upssize'];
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopl=$nopl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
			}
		}
		
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$nopm+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtym=$qtym+($ptp*$noparr[$i]); $nompm=$nompm+$ct; 
			}
		}
		
	}
}

$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=$row_mpns['mpmain_crop'];
		$verarr=$row_mpns['mpmain_variety'];
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=$row_mpns['mpmain_upssize'];
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopns=$nopns+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=$row_mpnl['mpmain_crop'];
		$verarr=$row_mpnl['mpmain_variety'];
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=$row_mpnl['mpmain_upssize'];
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopnl=$nopnl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$ct; 
			}
		}
		
	}
}
//echo $nops."  -  ".$nopl;
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 	
$qty=$row_issuetbl['balqty']-$totextqtys;
$nop=$nop2-$totextpouches;
if($row_issuetbl['balqty']>0)
$nop=$nop2-$totextpouches;
//$qty=$nob*$ptp2;

/*$totnop=$totnop+$nop;
$totnomp=$totnomp+$row_issuetbl['balnomp'];
$totqty=$totqty+$row_issuetbl['balqty'];
$nomp=$row_issuetbl['balnomp'];
$bqty=$row_issuetbl['balqty'];
$aq1=explode(".",$nop1);
$aq2=explode(".",$row_issuetbl['balnomp']);
$aq3=explode(".",$row_issuetbl['balqty']);
if($aq1[1]==000){$nop=$aq1[0];}else{$nop=$nop1;}
if($aq2[1]==000){$nomp=$aq2[0];}else{$nomp=$row_issuetbl['balnomp'];}
if($aq3[1]==000){$bqty=$aq3[0];}else{$bqty=$row_issuetbl['balqty'];}
*/
$nomp=$row_issuetbl['balnomp'];
$bqty=$row_issuetbl['balqty'];
$aq1=explode(".",$nop1);
$aq2=explode(".",$row_issuetbl['balnomp']);
$aq3=explode(".",$row_issuetbl['balqty']);
if($aq1[1]==000){$nop=$aq1[0];}else{$nop=$nop1;}
if($aq2[1]==000){$nomp=$aq2[0];}else{$nomp=$row_issuetbl['balnomp'];}
if($aq3[1]==000){$bqty=$aq3[0];}else{$bqty=$row_issuetbl['balqty'];}

$totnop=$totnop+$nop;
$totnomp=$totnomp+$nomp;
$totqty=$totqty+$bqty;

if($nomp<=0){$nomp=0;}
if($totnomp<=0){$totnomp=0;}
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['packtype'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $bqty;?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotdgp_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $snop=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balnp=0; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0; $blnp=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."' and rowid='".$row_issue1[0]."' order by slocsubid") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slnop=$row_sloc['nop'];
if($sBags!="")
$snop=$snop.$slnop."<br/>";
else
$snop=$slnop."<br/>";

$slBags=$row_sloc['nomp'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";

$slqty=$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$orwoid=$row_sloc['rowid'];

$totnnop=$totnnop+$slnop;
$totnnomp=$totnnomp+$slBags;
$totnqty=$totnqty+$slqty;

if($nomp<=0){$nomp=0;}
if($totnomp<=0){$totnomp=0;}
}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $snop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['balnomp'];?>','<?php echo $row_issuetbl['balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['packtype'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $bqty;?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotdgp_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $snop=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balnp=0; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0; $blnp=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slnop=$row_sloc['nop'];
if($sBags!="")
$snop=$snop.$slBags."<br/>";
else
$snop=$slBags."<br/>";

$slBags=$row_sloc['nomp'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";

$slqty=$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$orwoid=$row_sloc['rowid'];

$totnnop=$totnnop+$slnop;
$totnnomp=$totnnomp+$slBags;
$totnqty=$totnqty+$slqty;
}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $snop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['balnomp'];?>','<?php echo $row_issuetbl['balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="3">Total</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnop;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnomp;?><input type="hidden" name="extenomp" value="<?php echo $totnomp;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?><input type="hidden" name="exteqty" value="<?php echo $totqty;?>" /></td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnnop;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnnomp;?><input type="hidden" name="extnnomp" value="<?php echo $totnnomp;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnqty;?><input type="hidden" name="extnqty" value="<?php echo $totnqty;?>" /></td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
</tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="11">Variety not in Stock</td>
 </tr>
 <?php
 }
 ?>
 <input type="hidden" name="txtBagsg" value="<?php echo $totnomp;?>" /> <input type="hidden" name="txtnopsg" value="<?php echo $totnop;?>" /><input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" /></div>
<div id="subsubdiv">
</div><br />
</div>


<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><a href="home_sloc.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
</tr>
</table>
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
