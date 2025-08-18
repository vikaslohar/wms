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
	
/*$sql_tbl=mysqli_query($link,"select * from tbl_sloc_psw where surole='".$logid."' and supflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['slid'];	
	
	$s_sub="delete from tbl_sloc_psw_sub where slocid='".$arrival_id."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
}

	$s_sub="delete from tbl_sloc_psw where surole='".$logid."' and supflg=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
*/

	
	if(isset($_POST['frm_action'])=='submit')
	{ 
		$trid=trim($_POST['trid']);
		echo "<script>window.location='add_spci_preview.php?pid=$trid'</script>";	
	}
		
	
	$a="TCI";
	$sql_code="SELECT MAX(code) FROM tbl_sloc_psw  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY code DESC";
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
<title>psw -Transaction  - Cycle Inventory</title>
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
		}
		document.frmaddDepartment.txtslqtyg1.value=document.frmaddDepartment.balqtyg1.value;
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
		}
		document.frmaddDepartment.txtslqtyg2.value=document.frmaddDepartment.balqtyg2.value;
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
		}
		document.frmaddDepartment.txtslqtyg3.value=document.frmaddDepartment.balqtyg3.value;
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
		}
		document.frmaddDepartment.txtslqtyg4.value=document.frmaddDepartment.balqtyg4.value;
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
		}
		document.frmaddDepartment.txtslqtyg5.value=document.frmaddDepartment.balqtyg5.value;
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
		}
		document.frmaddDepartment.txtslqtyg6.value=document.frmaddDepartment.balqtyg6.value;
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
		}
		document.frmaddDepartment.txtslqtyg7.value=document.frmaddDepartment.balqtyg7.value;
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
		}
		document.frmaddDepartment.txtslqtyg8.value=document.frmaddDepartment.balqtyg8.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg1.value);
		document.frmaddDepartment.balnompg1.value=parseFloat(document.frmaddDepartment.txtslBagsg1.value);
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
		}
		document.frmaddDepartment.txtslqtyg1.value=document.frmaddDepartment.balqtyg1.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg2.value);
		document.frmaddDepartment.balnompg2.value=parseFloat(document.frmaddDepartment.txtslBagsg2.value);
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
		}
		document.frmaddDepartment.txtslqtyg2.value=document.frmaddDepartment.balqtyg2.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg3.value);
		document.frmaddDepartment.balnompg3.value=parseFloat(document.frmaddDepartment.txtslBagsg3.value);
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
		}
		document.frmaddDepartment.txtslqtyg3.value=document.frmaddDepartment.balqtyg3.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg4.value);
		document.frmaddDepartment.balnompg4.value=parseFloat(document.frmaddDepartment.txtslBagsg4.value);
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
		}
		document.frmaddDepartment.txtslqtyg4.value=document.frmaddDepartment.balqtyg4.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg5.value);
		document.frmaddDepartment.balnompg5.value=parseFloat(document.frmaddDepartment.txtslBagsg5.value);
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
		}
		document.frmaddDepartment.txtslqtyg5.value=document.frmaddDepartment.balqtyg5.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg6.value);
		document.frmaddDepartment.balnompg6.value=parseFloat(document.frmaddDepartment.txtslBagsg6.value);
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
		}
		document.frmaddDepartment.txtslqtyg6.value=document.frmaddDepartment.balqtyg6.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg7.value);
		document.frmaddDepartment.balnompg7.value=parseFloat(document.frmaddDepartment.txtslBagsg7.value);
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
		}
		document.frmaddDepartment.txtslqtyg7.value=document.frmaddDepartment.balqtyg7.value;
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
		exq=parseFloat(document.frmaddDepartment.exBagsg8.value);
		document.frmaddDepartment.balnompg8.value=parseFloat(document.frmaddDepartment.txtslBagsg8.value);
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
		}
		document.frmaddDepartment.txtslqtyg8.value=document.frmaddDepartment.balqtyg8.value;
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
		if(parseInt(n) != parseInt(nopsd))
		{
			alert("Please check. NoP distributed in Bins not matching with Total NoP");
			return false;
			f=1;
		}
		if(parseInt(u) != parseInt(Bagsd))
		{
			alert("Please check. NoMP distributed in Bins not matching with Total NoMP");
			return false;
			f=1;
		}
		if(parseFloat(d) != parseFloat(qtyd))
		{
			alert("Please check. Balance Quantity distributed in Bins not matching with Total Quantity");
			return false;
			f=1;
		}
		if(qtyd==0)
		{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			return false;
			f=1;
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
		if(parseInt(n) != parseInt(nopsd))
		{
			alert("Please check. NoP distributed in Bins not matching with Total NoP");
			return false;
			f=1;
		}
		if(parseInt(u) != parseInt(Bagsd))
		{
			alert("Please check. NoMP distributed in Bins not matching with Total NoMP");
			return false;
			f=1;
		}
		if(parseFloat(d) != parseFloat(qtyd))
		{
			alert("Please check. Balance Quantity distributed in Bins not matching with Total Quantity");
			return false;
			f=1;
		}
		if(qtyd==0)
		{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			return false;
			f=1;
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
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SP Cycle Inventory</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysqli_query($link,"select * from tbl_bin")or die(mysqli_error($link));
    	$noticia=mysqli_fetch_array($sql1);*/
	$trid=0;
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="code" value="<?php echo $code;?>" type="hidden">
	   <input name="txtmtype" value="" type="hidden">
	   <input type="hidden" name="rettyp" value="" />
	  <input type="hidden" name="oBags" value="" />
	  <input type="hidden" name="oqty" value="" />
	  <input type="hidden" name="txtdate" value="<?php echo date("d-m-Y");?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SP Cycle Inventory</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<!--<tr class="Dark" height="25">
           <td width="200" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
            <td width="415"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
		   
		   <td width="64" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="161" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" /></td>
		   </tr>-->
<?php 
$classqry=mysqli_query($link,"select * from tblcrop order by cropname") or die(mysqli_error($link));
?>
<tr class="Light" height="25">
   <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td width="268" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>
	</td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
         
<td width="102" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="317" align="left" valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" onchange="modetchk1(this.value);" >
<option value="" selected>--Select Variety--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />

<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
 <tr class="Light" height="25">
            <td width="153" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
    <!--<option value="" >--Select--</option>-->
	<option value="<?php echo $a;?>" selected ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  <td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After entry of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="0" /></td>	 
         </tr>	
</table>
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Lot Details</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="73" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="70" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="70" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="65" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="80" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="90" align="center" valign="middle" class="tblheading">GOT Status</td>
	<td width="80" align="center" valign="middle" class="tblheading">DoGR</td>
	<td width="222" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="80" align="center" valign="middle" class="tblheading">Status</td>
</tr>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading">Raw</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">Released</td>
</tr>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading">Condition</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">Released</td>
</tr>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading">Pack</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">Released</td>
</tr>
</table><br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Add Quantity</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="Dark" height="30" >
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="221" align="left" valign="middle" class="tbltext"  >&nbsp;Condition<input type="hidden" class="tbltext" name="txtstage" id="sstage" /></td>
<td width="140" align="right" valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="280" align="left" valign="middle" class="tbltext" id="lotnshow">&nbsp;<input name="txtlotnumber" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value=""  >&nbsp;<input type="hidden" name="orlot" value="" /></td>

</tr>	
 <tr class="Light" height="25">
            <td width="199" height="24"  align="right"  valign="middle" class="tblheading">Last Batch No.&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<input name="txtlot1" id="smt" type="text" class="tbltext" value="" style="background-color:#CCCCCC" readonly="true"  />&nbsp;</td>
		   <td width="140" align="right" valign="middle" class="tblheading">New Batch Number&nbsp;</td>
<td width="280" align="left" valign="middle" class="tbltext" id="lotnshow">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<input type="hidden" name="orlot" value="" /></td>
 </tr>	
	<tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Generate QC Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="qc2"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 <td align="right"  valign="middle" class="tblheading">QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqc" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="UT" maxlength="20"/></td>
</tr>
</table><br />
	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Subbin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
	
  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $sr2;?>" name="txtslwhg<?php echo $sr2;?>" style="width:70px;" onchange="wh<?php echo $sr2;?>(this.value,<?php echo $sr2;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_eindent_sub2['mergerss_whid']==$noticia_whd1['whid']) echo "Selected";?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_eindent_sub2['mergerss_whid']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $sr2;?>"><select class="smalltbltext" name="txtslbing<?php echo $sr2;?>" style="width:60px;" onchange="bin<?php echo $sr2;?>(this.value,<?php echo $sr2;?>);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_eindent_sub2['mergerss_binid']==$noticia_bing1['binid']) echo "Selected";?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_eindent_sub2['mergerss_binid']."' and whid='".$row_eindent_sub2['mergerss_whid']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $sr2;?>"><select class="smalltbltext" name="txtslsubbg<?php echo $sr2;?>" id="txtslsubbg<?php echo $sr2;?>" style="width:60px;" onchange="subbin<?php echo $sr2;?>(this.value,<?php echo $sr2;?>);"  >
<option value="" selected>Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($row_eindent_sub2['mergerss_subbinid']==$noticia_subbing1['sid']) echo "Selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $sr2;?>" id="txtconslnob<?php echo $sr2;?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,1);" value="<?php echo $row_eindent_sub2['mergerss_nob'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $sr2;?>" id="txtconslqty<?php echo $sr2;?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,1);"  onkeypress="return isNumberKey(event)"  value="<?php echo $row_eindent_sub2['mergerss_qty'];?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>

  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $sr2;?>" name="txtslwhg<?php echo $sr2;?>" style="width:70px;" onchange="wh<?php echo $sr2;?>(this.value,<?php echo $sr2;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_eindent_sub2['mergerss_whid']==$noticia_whd1['whid']) echo "Selected";?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_eindent_sub2['mergerss_whid']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $sr2;?>"><select class="smalltbltext" name="txtslbing<?php echo $sr2;?>" style="width:60px;" onchange="bin<?php echo $sr2;?>(this.value,<?php echo $sr2;?>);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_eindent_sub2['mergerss_binid']==$noticia_bing1['binid']) echo "Selected";?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_eindent_sub2['mergerss_binid']."' and whid='".$row_eindent_sub2['mergerss_whid']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $sr2;?>"><select class="smalltbltext" name="txtslsubbg<?php echo $sr2;?>" id="txtslsubbg<?php echo $sr2;?>" style="width:60px;" onchange="subbin<?php echo $sr2;?>(this.value,<?php echo $sr2;?>);"  >
<option value="" selected>Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($row_eindent_sub2['mergerss_subbinid']==$noticia_subbing1['sid']) echo "Selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $sr2;?>" id="txtconslnob<?php echo $sr2;?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,1);" value="<?php echo $row_eindent_sub2['mergerss_nob'];?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $sr2;?>" id="txtconslqty<?php echo $sr2;?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,1);"  onkeypress="return isNumberKey(event)"  value="<?php echo $row_eindent_sub2['mergerss_qty'];?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
</table>	 
<div id="maindiv" style="display:none">
<div id="subdiv" style="display:none">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="122" align="center" valign="middle" class="tblheading">Bags</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" />
</div>
<br />
<div id="subsubdiv"></div><br />


</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_spci.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
