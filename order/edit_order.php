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

	if(isset($_REQUEST['p_id']))
	{
	$p_id = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
		$p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$txtconchk=trim($_POST['txtconchk']);
		$txtupschk=trim($_POST['txtupschk']);
		$txtordno=trim($_POST['txtordno']);
		$txtporf=trim($_POST['txtporf']);
		$txtstfp=trim($_POST['txtstfp']);
		$txt12=trim($_POST['txt12']);
		$txtorderplby=trim($_POST['txtorderplby']);
		$txt11=trim($_POST['txt11']);
		$party=trim($_POST['txtpp']);
		$txtstatesl=trim($_POST['txtstatesl']);
		$txtlocationsl=trim($_POST['txtlocationsl']);
		$txtcountrysl=trim($_POST['txtcountrysl']);
		$remarks=str_replace("&","and",$remarks);
		//exit;
		if($txtconchk=="Yes")
		{
			if($party!="Export Buyer")
			{
				$txtparty=trim($_POST['txtparty']);
				$txtadd=trim($_POST['txtadd']);
				$txtcity=trim($_POST['txtcity']);
				$txtstate=trim($_POST['txtstate']);
				$pstd=trim($_POST['pstd']);
				$pphno=trim($_POST['pphno']);
				$txtpin=trim($_POST['txtpin']);
				$txtcontact=trim($_POST['txtcontact']);
				$txtctin=trim($_POST['txtctin']);
				$txtccst=trim($_POST['txtccst']);
			}
			else
			{
				$txtparty=trim($_POST['txtpartycountry']);
				$txtadd=trim($_POST['txtaddcountry']);
				$txtcity=trim($_POST['txtcitycountry']);
				$txtstate=trim($_POST['txtstatecountry']);
				$pstd=trim($_POST['pstdcountry']);
				$pphno=trim($_POST['pphnocountry']);
				$txtpin=trim($_POST['txtpincountry']);
				$txtcontact=trim($_POST['txtcontactcountry']);
				$txtctin=trim($_POST['txtctincountry']);
				$txtccst=trim($_POST['txtccstcountry']);
			}
		}
		else
		{
		$txtparty="";
		$txtadd="";
		$txtcity="";
		$txtstate="";
		$pstd="";
		$pphno="";
		$txtpin="";
		$txtcontact="";
		$txtctin="";
		$txtccst="";
		}
		
		if($txt11=="Transport")
		{
		$txttname=trim($_POST['txttname']);
		$txtlrn=trim($_POST['txtlrn']);
		$txtvn=trim($_POST['txtvn']);
		$txt13=trim($_POST['txt13']);
		}
		else
		{
		$txttname="";
		$txtlrn="";
		$txtvn="";
		$txt13="";
		}
		
		if($txt11=="Courier")
		{
		$txtcname=trim($_POST['txtcname']);
		$txtdc=trim($_POST['txtdc']);
		}
		else
		{
		$txtcname="";
		$txtdc="";
		}
		if($txt11=="By Hand")
		{ 
		$txtpname=trim($_POST['txtpname']);
		}
		else
		{
		$txtpname="";
		}
		
		echo "<script>window.location='add_order_preview.php?p_id=$p_id&remarks=$remarks&txtconchk=$txtconchk&txtupschk=$txtupschk&txtordno=$txtordno&txtporf=$txtporf&txtstfp=$txtstfp&txt12=$txt12&txtparty=$txtparty&txtadd=$txtadd&txtcity=$txtcity&txtstate=$txtstate&pstd=$pstd&pphno=$pphno&txtcontact=$txtcontact&txtctin=$txtctin&txtccst=$txtccst&txtpin=$txtpin&txtorderplby=$txtorderplby&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt13=$txt13&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&txtpp=$party&txtstatesl=$txtstatesl&txtlocationsl=$txtlocationsl&txtcountrysl=$txtcountrysl'</script>";	
			
	}
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order- Transaction -Order Sales</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="orsal.js"></script>
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
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
						//var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						//qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
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

function FirstCharCap(charval) {var x=charval.substr(1); var y=charval.charAt(0);var zz=y.toUpperCase(); var cval=zz+x; return cval; }

function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
function clkp(opt)
{
	if(document.frmaddDepartment.txtstfp.value!="")
	{
		if(opt!="")
		{
			if(opt=="No")
			{
				document.getElementById('fill').style.display="none";
				document.getElementById('fillcountry').style.display="none";
				document.frmaddDepartment.txtconchk.value=opt;
				document.frmaddDepartment.txtparty.value="";
				document.frmaddDepartment.txtadd.value="";
				document.frmaddDepartment.txtcity.value="";
				document.frmaddDepartment.txtpin.value="";
				document.frmaddDepartment.txtstate.selectedIndex=0;
				document.frmaddDepartment.pstd.value="";
				document.frmaddDepartment.pphno.value="";
				document.frmaddDepartment.txtcontact.value="";
				document.frmaddDepartment.txtctin.value="";
				document.frmaddDepartment.txtccst.value="";
				document.frmaddDepartment.txtpartycountry.value="";
				document.frmaddDepartment.txtaddcountry.value="";
				document.frmaddDepartment.txtcitycountry.value="";
				document.frmaddDepartment.txtpincountry.value="";
				document.frmaddDepartment.txtstatecountry.value="";
				document.frmaddDepartment.pstdcountry.value="";
				document.frmaddDepartment.pphnocountry.value="";
				document.frmaddDepartment.txtcontactcountry.value="";
				document.frmaddDepartment.txtctincountry.value="";
				document.frmaddDepartment.txtccstcountry.value="";
			}
			else
			{
				var ptype=document.frmaddDepartment.txtpp.value;
				if(ptype!="Export Buyer")
				{
					document.getElementById('fill').style.display="block";
					document.getElementById('fillcountry').style.display="none";
					document.frmaddDepartment.txtconchk.value=opt;
					document.frmaddDepartment.txtparty.value="";
					document.frmaddDepartment.txtadd.value="";
					document.frmaddDepartment.txtcity.value="";
					document.frmaddDepartment.txtpin.value="";
					document.frmaddDepartment.txtstate.selectedIndex=0;
					document.frmaddDepartment.pstd.value="";
					document.frmaddDepartment.pphno.value="";
					document.frmaddDepartment.txtcontact.value="";
					document.frmaddDepartment.txtctin.value="";
					document.frmaddDepartment.txtccst.value="";
					document.frmaddDepartment.txtpartycountry.value="";
					document.frmaddDepartment.txtaddcountry.value="";
					document.frmaddDepartment.txtcitycountry.value="";
					document.frmaddDepartment.txtpincountry.value="";
					document.frmaddDepartment.txtstatecountry.value="";
					document.frmaddDepartment.pstdcountry.value="";
					document.frmaddDepartment.pphnocountry.value="";
					document.frmaddDepartment.txtcontactcountry.value="";
					document.frmaddDepartment.txtctincountry.value="";
					document.frmaddDepartment.txtccstcountry.value="";
				}
				else
				{
					document.getElementById('fill').style.display="none";
					document.getElementById('fillcountry').style.display="block";
					document.frmaddDepartment.txtconchk.value=opt;
					document.frmaddDepartment.txtparty.value="";
					document.frmaddDepartment.txtadd.value="";
					document.frmaddDepartment.txtcity.value="";
					document.frmaddDepartment.txtpin.value="";
					document.frmaddDepartment.txtstate.selectedIndex=0;
					document.frmaddDepartment.pstd.value="";
					document.frmaddDepartment.pphno.value="";
					document.frmaddDepartment.txtcontact.value="";
					document.frmaddDepartment.txtctin.value="";
					document.frmaddDepartment.txtccst.value="";
					document.frmaddDepartment.txtpartycountry.value="";
					document.frmaddDepartment.txtaddcountry.value="";
					document.frmaddDepartment.txtcitycountry.value="";
					document.frmaddDepartment.txtpincountry.value="";
					document.frmaddDepartment.txtstatecountry.value="";
					document.frmaddDepartment.pstdcountry.value="";
					document.frmaddDepartment.pphnocountry.value="";
					document.frmaddDepartment.txtcontactcountry.value="";
					document.frmaddDepartment.txtctincountry.value="";
					document.frmaddDepartment.txtccstcountry.value="";
				}
				
			}	
		}
		else
		{
			alert("Please Select Consignee Applicable");
			document.frmaddDepartment.txtconchk.value="";
			
		}
	}
	else
	{
			if(document.frmaddDepartment.txtpp.value=="")
			{
			alert("Please Select Party Type");
			document.frmaddDepartment.txtpp.focus();
			var radList = document.getElementsByName('txt12');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
			return false;
			}
			if(document.frmaddDepartment.txtpp.value!="")
			{
				if(document.frmaddDepartment.txtpp.value!="Export Buyer")
				{
					if(document.frmaddDepartment.txtstatesl.value=="")
					{
					alert("Please select State");
					var radList = document.getElementsByName('txt12');
				for (var i = 0; i < radList.length; i++) {
				if(radList[i].checked) radList[i].checked = false;}
						return false;
					}	
					if(document.frmaddDepartment.txtlocationsl.value=="")
					{
					alert("Please Select Location");
					var radList = document.getElementsByName('txt12');
				for (var i = 0; i < radList.length; i++) {
				if(radList[i].checked) radList[i].checked = false;}
						return false;
					}
				
				}
				else
				{
					if(document.getElementById("txtcountrysl").value=="")
					{
						alert("Please select Country");
						var radList = document.getElementsByName('txt12');
						for (var i = 0; i < radList.length; i++) {
						if(radList[i].checked) radList[i].checked = false;}
						return false;
					}
				}	
			
			}
			
			if(document.frmaddDepartment.txtstfp.value=="")
			{
				alert("Please select Invoice To");
				document.frmaddDepartment.txtstfp.focus();
				var radList = document.getElementsByName('txt12');
				for (var i = 0; i < radList.length; i++) {
				if(radList[i].checked) radList[i].checked = false;}
				return false;
			}
			
}
}

function clkp1(opt)
{
	if(document.frmaddDepartment.txtvariety.value!="")
	{
		var flg=0;
		var itemdchk=document.frmaddDepartment.itmdchk.value;
		var itemdchk1=document.frmaddDepartment.itmdchk1.value;
		var itm=itemdchk.split(",");
		var itm1=itemdchk1.split(",");
		for(var i=0; i < itm.length; i++)
		{	
			if(itm[i] !="")
			{
				if(document.frmaddDepartment.txtvariety.value==itm[i] && opt==itm1[i])
				{
					flg=1;
				}
			}
		}
		if(flg==1)
		{
			alert("Please Check, the Variety with this UPS Type is already posted in this transaction");
			document.getElementById('itm').selectedIndex=0;
			document.getElementById('selectupst').style.display="none";
			document.frmaddDepartment.txtupschk.value="";
			var radList = document.getElementsByName('txtup');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
			return false;
		}
		else
		{
			if(opt!="")
			{
					var crop=document.frmaddDepartment.txtcrop.value;
					var variety=document.frmaddDepartment.txtvariety.value;
					var ptyp=document.frmaddDepartment.txtpp.value;
					document.getElementById('selectupst').style.display="block";
					document.frmaddDepartment.txtupschk.value=opt;
					showUser(opt,'selectupst','upschk',crop,variety,ptyp,'','');
			}
			else
			{
				alert("Please Select UPS Type");
				document.frmaddDepartment.txtupschk.value="";
			}
		}
	}
	else
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtupschk.value="";
		var radList = document.getElementsByName('txtup');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
	}
}

function modetchk(classval)
{	
		document.getElementById('selectupst').style.display="none";
		document.frmaddDepartment.txtupschk.value="";
		var radList = document.getElementsByName('txtup');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
		document.frmaddDepartment.txtvartyp.selectedIndex=0;
		document.frmaddDepartment.txtvariety.selectedIndex=0;
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please select any one option of 'Dispatch Mode'");
		document.frmaddDepartment.txtcrop.selectedIndex=0;
	}			
}
function vartypechk(varval)
{
		document.getElementById('selectupst').style.display="none";
		document.frmaddDepartment.txtupschk.value="";
		var radList = document.getElementsByName('txtup');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
		document.frmaddDepartment.txtvariety.selectedIndex=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop'");
		document.frmaddDepartment.txtvartyp.selectedIndex=0;
	}
	else
	{
		var classval=document.frmaddDepartment.txtcrop.value;
		showUser(classval,'vitem','item',varval,'','','','');
	}
}
function locslchk(statesl)
{
showUser(statesl,'locations','location','','','','','','');
}
function stateslchk(valloc)
{
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
	}
	else
	{
		var classval=document.frmaddDepartment.txtptype.value;
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'vitem1','item1',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}
function loccontrychk(countryval)
{
		if(document.frmaddDepartment.txtpp.value!="")
		{
			var classval=document.frmaddDepartment.txtptype.value;
			document.getElementById('selectparty').style.display="block";
			showUser(classval,'vitem1','item1',countryval,'','','','');
			document.frmaddDepartment.locationname.value=countryval;
			document.frmaddDepartment.txtcountry1.value=countryval;
		}
		else
		{
			alert("Please Select Party Type");
			document.frmaddDepartment.txtcountrysl.selectedIndex=0;
		}

}
function modetchk1(classval)
{	
		if(classval != "")
		{
		document.getElementById('selectpartylocation').style.display="block";
		document.getElementById('selectparty').style.display="none";
		showUser(classval,'selectpartylocation','partylocation','','','','','');
		document.frmaddDepartment.txtptype.value=classval;
		document.getElementById('fill').style.display="none";
		document.getElementById('fillcountry').style.display="none";
		document.frmaddDepartment.txtconchk.value="";
		document.frmaddDepartment.txtparty.value="";
		document.frmaddDepartment.txtadd.value="";
		document.frmaddDepartment.txtcity.value="";
		document.frmaddDepartment.txtpin.value="";
		document.frmaddDepartment.txtstate.selectedIndex=0;
		document.frmaddDepartment.pstd.value="";
		document.frmaddDepartment.pphno.value="";
		document.frmaddDepartment.txtcontact.value="";
		document.frmaddDepartment.txtctin.value="";
		document.frmaddDepartment.txtccst.value="";
		document.frmaddDepartment.txtpartycountry.value="";
		document.frmaddDepartment.txtaddcountry.value="";
		document.frmaddDepartment.txtcitycountry.value="";
		document.frmaddDepartment.txtpincountry.value="";
		document.frmaddDepartment.txtstatecountry.value="";
		document.frmaddDepartment.pstdcountry.value="";
		document.frmaddDepartment.pphnocountry.value="";
		document.frmaddDepartment.txtcontactcountry.value="";
		document.frmaddDepartment.txtctincountry.value="";
		document.frmaddDepartment.txtccstcountry.value="";
		var radList = document.getElementsByName('txt12');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
		}
		else
		{
		document.getElementById('selectpartylocation').style.display="none";
		document.getElementById('selectparty').style.display="none";
		document.frmaddDepartment.txtptype.value=classval;
		document.getElementById('fill').style.display="none";
		document.getElementById('fillcountry').style.display="none";
		document.frmaddDepartment.txtconchk.value="";
		document.frmaddDepartment.txtparty.value="";
		document.frmaddDepartment.txtadd.value="";
		document.frmaddDepartment.txtcity.value="";
		document.frmaddDepartment.txtpin.value="";
		document.frmaddDepartment.txtstate.selectedIndex=0;
		document.frmaddDepartment.pstd.value="";
		document.frmaddDepartment.pphno.value="";
		document.frmaddDepartment.txtcontact.value="";
		document.frmaddDepartment.txtctin.value="";
		document.frmaddDepartment.txtccst.value="";
		document.frmaddDepartment.txtpartycountry.value="";
		document.frmaddDepartment.txtaddcountry.value="";
		document.frmaddDepartment.txtcitycountry.value="";
		document.frmaddDepartment.txtpincountry.value="";
		document.frmaddDepartment.txtstatecountry.value="";
		document.frmaddDepartment.pstdcountry.value="";
		document.frmaddDepartment.pphnocountry.value="";
		document.frmaddDepartment.txtcontactcountry.value="";
		document.frmaddDepartment.txtctincountry.value="";
		document.frmaddDepartment.txtccstcountry.value="";
		var radList = document.getElementsByName('txt12');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
		}
}
function cropchk()
{
	if(document.frmaddDepartment.txtvartyp.value=="")
	{
		alert("Please Select Variety Type");
		document.frmaddDepartment.txtvariety.selectedIndex=0;
	}
	else
	{
		document.getElementById('selectupst').style.display="none";
		document.frmaddDepartment.txtupschk.value="";
		var radList = document.getElementsByName('txtup');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
	}	
		
}
function pform()
{	
	var fl=0;
	var olbtn="<img src='../images/post.gif' border='0' style='display:inline;cursor:pointer;' onclick='pform();' />&nbsp;&nbsp;";
	document.getElementById('frmbutn').innerHTML="<img src='../images/processing2.gif' border='0' style='display:inline;cursor:wait;' />&nbsp;&nbsp;";
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		//document.frmaddDepartment.txtpp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtpp.value!="")
	{
		if(document.frmaddDepartment.txtpp.value!="Export Buyer")
		{
			if(document.frmaddDepartment.txtstatesl.value=="")
			{
				alert("Please select State");
				//document.frmaddDepartment.txtstfp.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				fl=1;
				return false;
			}	
			if(document.frmaddDepartment.txtlocationsl.value=="")
			{
				alert("Please Select Location");
				//document.frmaddDepartment.txtconchk.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				fl=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtcountrysl.value=="")
			{
				alert("Please select Country");
				//document.frmaddDepartment.txtstfp.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				fl=1;
				return false;
			}	
		}	
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party");
		//document.frmaddDepartment.txtstfp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please Select Consignee Applicable");
		//document.frmaddDepartment.txtconchk.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
	
	if(document.frmaddDepartment.txtconchk.value=="Yes")
	{
		if(document.frmaddDepartment.txtpp.value!="Export Buyer")
		{
			if(document.frmaddDepartment.txtparty.value=="")
			{
				alert("Please specify Consignee's Name");
				//document.frmaddDepartment.txtparty.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtadd.value=="")
			{
				alert("Please specify Consignee's Address ");
				//document.frmaddDepartment.txtadd.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtadd.value!="")
			{
				if(document.frmaddDepartment.txtadd.value.length <= 1)
				{
					alert("Invalid Consignee's Address");
					document.frmaddDepartment.txtadd.value="";
					document.getElementById('frmbutn').innerHTML=olbtn;
					return false;
				}
			}
			if(document.frmaddDepartment.txtcity.value=="")
			{
				alert("Please specify Consignee's Location");
				//document.frmaddDepartment.txtcity.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtcity.value!="")
			{
				if(document.frmaddDepartment.txtcity.value.length <= 1)
				{
					alert("Invalid Consignee's Address");
					document.frmaddDepartment.txtcity.value="";
					document.getElementById('frmbutn').innerHTML=olbtn;
					return false;
				}
			}
			if(document.frmaddDepartment.txtstate.value=="")
			{
				alert("Please specify Consignee's State");
				//document.frmaddDepartment.txtstate.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtpin.value!="")
			{
					if(document.frmaddDepartment.txtpin.value.length < 6)
					{
						alert("Pin Code can not less than six digits");
						document.frmaddDepartment.txtpin.value="";
						document.getElementById('frmbutn').innerHTML=olbtn;
						return false;
					}
			}
		}
		else
		{
			if(document.frmaddDepartment.txtpartycountry.value=="")
			{
				alert("Please specify Consignee's Name");
				document.frmaddDepartment.txtpartycountry.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtaddcountry.value=="")
			{
				alert("Please specify Consignee's Address ");
				document.frmaddDepartment.txtaddcountry.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtaddcountry.value!="")
			{
				if(document.frmaddDepartment.txtaddcountry.value.length <= 1)
				{
					alert("Invalid Consignee's Address");
					document.frmaddDepartment.txtaddcountry.value="";
					document.getElementById('frmbutn').innerHTML=olbtn;
					return false;
				}
			}
			if(document.frmaddDepartment.txtcitycountry.value=="")
			{
				alert("Please specify Consignee's Location");
				document.frmaddDepartment.txtcitycountry.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtcitycountry.value!="")
			{
				if(document.frmaddDepartment.txtcitycountry.value.length <= 1)
				{
					alert("Invalid Consignee's Address");
					document.frmaddDepartment.txtcitycountry.value="";
					document.getElementById('frmbutn').innerHTML=olbtn;
					return false;
				}
			}
			if(document.frmaddDepartment.txtstatecountry.value=="")
			{
				alert("Please specify Consignee's State");
				document.frmaddDepartment.txtstatecountry.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
			if(document.frmaddDepartment.txtpincountry.value!="")
			{
				if(document.frmaddDepartment.txtpincountry.value.length < 5)
				{
					alert("Zip Code can not less than Five digits");
					document.frmaddDepartment.txtpincountry.value="";
					document.getElementById('frmbutn').innerHTML=olbtn;
					return false;
				}
			}
		}
	}	

	if(document.frmaddDepartment.txtorderplby.value=="")
	{
		alert("Please specify Order Placed By Name");
		document.frmaddDepartment.txtorderplby.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtorderplby.value!="")
	{
		if(document.frmaddDepartment.txtorderplby.value.length <= 1)
		{
		alert("Invalid Order Placed By Name");
		document.frmaddDepartment.txtorderplby.value="";
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
		}
	}	
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Dispatch Mode");
		document.frmaddDepartment.txt11.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.txt11.value!="")
	{
		if(document.frmaddDepartment.txt11.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Define Transport Name");
			document.frmaddDepartment.txttname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txttname.value!="")
			{
				if(document.frmaddDepartment.txttname.value.length <= 1)
				{
				alert("Invalid Transport Name");
				document.frmaddDepartment.txttname.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
				}
			}	
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
			alert("Define Courier Name");
			document.frmaddDepartment.txtcname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDepartment.txtcname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txtcname.value!="")
			{
				if(document.frmaddDepartment.txtcname.value.length <= 1)
				{
				alert("Invalid Courier Name");
				document.frmaddDepartment.txtcname.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
				}
			}	
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
			alert("Define Name of the Person");
			document.frmaddDepartment.txtpname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}	
			
			if(document.frmaddDepartment.txtpname.value!="")
			{
				if(document.frmaddDepartment.txtpname.value.length <= 1)
				{
				alert("Invalid Person Name Name");
				document.frmaddDepartment.txtpname.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
				}
			}	
		}
	}
	else
	{
		alert("Please select Mode of Dispatch");
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtupschk.value=="")
	{
		alert("Select UPS Type");
		document.frmaddDepartment.txtupschk.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.srn.value=="" || document.frmaddDepartment.srn.value==0)
	{
		alert("UPS is not avilable for this Variety");
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.srn.value!="" && document.frmaddDepartment.srn.value > 0)
	{	var j=1; var i=1; 
		for(i=1; i<=document.frmaddDepartment.srn.value; i++)
		{ 
			var fld=document.getElementById('txtqtydc_'+[i]).value;
			if(fld=="")
			{
				j++;
			}
		}
		if(i==j)
		{
			alert("Define Quantity");
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
		}
	}
	
	if(fl==1)
	{
	document.getElementById('frmbutn').innerHTML=olbtn;
	return false;
	}
	else
	{	
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mform','','','','','');
	}
}

function nopchk(val1, val2, val3, val4)
{
	val1=Math.round(val1*1000)/1000;
	//alert(val1);
	if(val1>0 && val1<=99999.999)
	{
		if(document.frmaddDepartment.txtupschk.value=="Yes")
		{
			var stdqty=parseFloat(document.getElementById('stdptval_'+[val4]).value);
			/*if(parseFloat(stdqty) > parseFloat(val1))
			{
				alert("Enter Minimum Quantity:"+stdqty+"\nOR\nEnter valid Quantity which is divisble by standard weight of the selected pack type");
				document.getElementById('txtnopdc_'+[val4]).value="";
				document.getElementById('txtqtydc_'+[val4]).value="";
				document.getElementById('txtlqtydc_'+[val4]).value="";
				document.getElementById('txtnopwb_'+[val4]).value="";
				document.getElementById('txtnopmp_'+[val4]).value="";
				return false;
			}
			else*/
			{
				var pt=document.getElementById('txtuptypchk_'+[val4]).value;
				/*if(pt=="Pouch")
				{*/
					var ups=0; var nop="";
					if(val3=="Gms")
					{
						ups=1000/parseFloat(val2); 
						nop=parseFloat(ups)*val1;
					}
					else
					{
						ups=parseFloat(val2);
						nop=val1/parseFloat(ups);
					}
					var nzzz=Math.round(nop*1000)/1000;
					var zz=nzzz+'';
					var zzz=zz.split(".");
					if(zzz[1] > 0)
					{
						alert("Enter valid Quantity which is divisible by UPS");
						document.getElementById('txtnopdc_'+[val4]).value="";
						document.getElementById('txtqtydc_'+[val4]).value="";
						document.getElementById('txtnopwb_'+[val4]).value="";
						document.getElementById('txtnopmp_'+[val4]).value="";
						return false;
					}
					else
					{
						document.getElementById('txtnopdc_'+[val4]).value=nzzz;
						document.getElementById('txtnopwb_'+[val4]).value="";
						document.getElementById('txtnopmp_'+[val4]).value="";
					}
				//}
				if(pt=="WBox")
				{
					var ups=0; var nop="";var nop22="";
					var wb=document.getElementById('wtnop_'+[val4]).value;
					if(val3=="Gms")
					{
						ups=0;
						ups=1000/parseFloat(val2); 
						nop=parseFloat(ups)* val1;
					}
					else
					{
						ups=0;
						ups=parseFloat(val2);
						nop=val1/parseFloat(ups);
					}
					var nop1;
					nop1=parseFloat(nop)/parseFloat(wb);
					var rnd=Math.round(nop1);
					var rndu=0;
					var rndd=0;
					var nzzz=Math.round(nop1*1000)/1000;
					var zz=nzzz+'';
					var zzz=zz.split(".");
					if(zzz[1] > 0)
					{ 
					var np=parseFloat(zzz[0])*parseFloat(wb);  
/*						if(zzz[1] >= 50)
						{
*/							if(val3=="Gms")
							{
								ups=0;
								ups=parseFloat(val2)/1000; 
								nop22=parseFloat(ups)*parseFloat(np);
								rndu=parseFloat(nop22);
								rndd=parseFloat(nop22)+parseFloat(stdqty);
							}
							else
							{
								ups=0;
								ups=parseFloat(val2);
								nop22=parseFloat(np)*parseFloat(ups);
								rndu=parseFloat(nop22);
								rndd=parseFloat(nop22)+parseFloat(stdqty);
							}
							rndu=Math.round(rndu*1000)/1000;
							rndd=Math.round(rndd*1000)/1000;
						/*}
						else
						{ 
							if(val3=="Gms")
							{
								ups=0;
								ups=parseFloat(val2)/1000; 
								nop22=parseFloat(ups)*parseFloat(np);
								rndu=parseFloat(nop22)+parseFloat(stdqty);
								rndd=parseFloat(nop22);
							}
							else
							{
								ups=0;
								ups=parseFloat(val2);
								nop22=parseFloat(np)*parseFloat(ups);
								rndu=parseFloat(nop22)+parseFloat(stdqty);
								rndd=parseFloat(nop22);
							}
						}*/
						alert("The entered quantity is not a divisible number by standard weight of window box\nYou need to enter:\n1) "+parseFloat(rndd)+"\n       OR\n2) "+parseFloat(rndu)+"\nor any other qty divisble by standard weight of the selected pack type");
						document.getElementById('txtnopdc_'+[val4]).value="";
						document.getElementById('txtqtydc_'+[val4]).value="";
						document.getElementById('txtlqtydc_'+[val4]).value="";
						document.getElementById('txtnopwb_'+[val4]).value="";
						document.getElementById('txtnopmp_'+[val4]).value="";
						return false;
						
						
					
					}
					else
					{	
						var ups4=0; var nop24="";
						var wb4=document.getElementById('wtmp_'+[val4]).value;
						nop24=parseFloat(val1)/parseFloat(wb4);
						nop14=parseFloat(val1)/parseFloat(document.getElementById('wtnopkg_'+[val4]).value);
						var rnd4=Math.round(nop14);
						var rndu4=0;
						var rndd4=0;
						var nzzz4=Math.round(nop24*1000)/1000;
						
						var zz4=nzzz4+'';
						var zzz4=zz4.split(".");
						//alert(zzz[0]);
						/*if(zzz4[1] > 0)
						{*/
							ups4=parseFloat(wb4)*parseFloat(zzz4[0]);
							rndu4=parseFloat(val1)-parseFloat(ups4);
							rndd4=ups4;
							var nzzz2=Math.round(zzz4[0]);		
							rndu4=Math.round(rndu4*1000)/1000;
							rndd4=Math.round(rndd4*1000)/1000;
						/*}
						else
						{
							rndu4=0;
							rndd4=ups4;
									
							rndu4=Math.round(rndu4*1000)/1000;
							rndd4=Math.round(rndd4*1000)/1000;	
						}	*/
						//alert(rndu4); alert(rndd4);
						document.getElementById('txtnopwb_'+[val4]).value=nzzz;
						document.getElementById('txtnopmp_'+[val4]).value=nzzz2;
						document.getElementById('txtlqtydc_'+[val4]).value=rndu4;
						document.getElementById('txtqtydc_'+[val4]).value=rndd4;
					}
				}
				
				if(pt=="MPack")
				{
					var ups=0; var nop2="";
					var wb=document.getElementById('wtmp_'+[val4]).value;
					nop2=parseFloat(val1)/parseFloat(wb);
					nop1=parseFloat(val1)/parseFloat(document.getElementById('wtnopkg_'+[val4]).value);
					var rnd=Math.round(nop1);
					if(document.getElementById('wtnopkg_'+[val4]).value=="")rnd="";
					var rndu=0;
					var rndd=0;
					var nzzz=Math.round(nop2*1000)/1000;
					//var nzzz2=Math.round(nop2);
					var zz=nzzz+'';
					var zzz=zz.split(".");
					//alert(zzz[0]);
					/*if(zzz[1] > 0)
					{*/
						ups=parseFloat(wb)*parseFloat(zzz[0]);
						rndu=parseFloat(val1)-parseFloat(ups);
						rndd=ups;
						var nzzz2=Math.round(zzz[0]);		
						rndu=Math.round(rndu*1000)/1000;
						rndd=Math.round(rndd*1000)/1000;
					/*}
					else
					{	
						rndu=0;
						rndd=ups;
									
						rndu=Math.round(rndu*1000)/1000;
						rndd=Math.round(rndd*1000)/1000;	
					}	*/
					//alert(rndu); alert(rndd);
					document.getElementById('txtnopwb_'+[val4]).value=rnd;
					document.getElementById('txtnopmp_'+[val4]).value=nzzz2;
					document.getElementById('txtlqtydc_'+[val4]).value=rndu;
					document.getElementById('txtqtydc_'+[val4]).value=rndd;
				}
			}
		}
	}
	else
	{
		alert("Quantity cannot be Zero(0) or less and cannot be more than 99999.999");
		document.getElementById('txtnopdc_'+[val4]).value="";
		document.getElementById('txtqtydc_'+[val4]).value="";
		document.getElementById('txtlqtydc_'+[val4]).value="";
		//document.getElementById('txtnopwb_'+[val4]).value="";
		//document.getElementById('txtnopmp_'+[val4]).value="";
		return false;
	}
}

function updchk(val1, val4)
{
	document.getElementById('upssizetyp_'+[val4]).value="";
	document.getElementById('upssizetyp_'+[val4]).selectedIndex=0;
	document.getElementById("txtqtydc_"+[val4]).value="";
	document.getElementById("txtnopdc_"+[val4]).value="";
	if(val1!="")
	{
		if(parseFloat(val1)<1)
		{
			alert("UPS cannot be Zero(0) or less i.e. 0.1 not allowed");
			document.getElementById('txtupdc_'+[val4]).value="";
			document.getElementById('txtupdc_'+[val4]).focus();
			return false;
		}
		else
		{
			var z="000";
			var val=val1.split(".");
			//alert(val.length);
			//alert(val);
			if(val.length>1)
			{
			if(val[1]<=0 || val[1]=="undefined")
				z="000";
			else
				z=val[1];
			}
			
			//alert(z);
			var d=val[0]+"."+z;
			d=parseFloat(d).toFixed(3);
			//alert(d);
			document.getElementById('txtupdc_'+[val4]).value=d;
		}
	}
}

function updmerg(val1, val4)
{
	if(val1!="")
	{
		if(document.getElementById('txtupdc_'+[val4]).value!="")
		{
			if(parseFloat(document.getElementById('txtupdc_'+[val4]).value)<1)
			{
				alert("UPS cannot be Zero(0) or less i.e. 0.1 not allowed");
				document.getElementById('upssizetyp_'+[val4]).value="";
				document.getElementById('upssizetyp_'+[val4]).selectedIndex=0;
				document.getElementById("txtqtydc_"+[val4]).value="";
				document.getElementById("txtnopdc_"+[val4]).value="";
				document.getElementById('txtupdc_'+[val4]).value="";
				document.getElementById('txtupdc_'+[val4]).focus();
				return false;
			}
			else
			{
				document.getElementById('txtupsdc_'+[val4]).value=document.getElementById('txtupdc_'+[val4]).value+" "+document.getElementById('upssizetyp_'+[val4]).value;
			}
		}
		else
		{
			alert("UPS cannot be Blank");
			document.getElementById('upssizetyp_'+[val4]).value="";
			document.getElementById('upssizetyp_'+[val4]).selectedIndex=0;
			document.getElementById("txtqtydc_"+[val4]).value="";
			document.getElementById("txtnopdc_"+[val4]).value="";
			document.getElementById('txtupsdc_'+[val4]).value="";
			document.getElementById('txtupdc_'+[val4]).focus();
		}
	}
	else
	{
		document.getElementById('upssizetyp_'+[val4]).value="";
		document.getElementById('upssizetyp_'+[val4]).selectedIndex=0
		document.getElementById("txtqtydc_"+[val4]).value="";
		document.getElementById("txtnopdc_"+[val4]).value="";
		document.getElementById('txtupsdc_'+[val4]).value="";
	}
}
function nopntchk(val1,val2,val3,val4)
{
	var upstt=document.frmaddDepartment.upstt.value.split(",");
	var upsqtytt=document.frmaddDepartment.upsqtytt.value.split(",");
	var up="txtupsdc_"+val4;
	var styp="upssizetyp_"+val4;
	var qtyp=val1;
	var upstyp=document.getElementById('txtupsdc_'+[val4]).value;
	var val3=document.getElementById('upssizetyp_'+[val4]).value;
	val1=Math.round(val1*1000)/1000;
	if(val1>0 && val1<=99999.999)
	{
		var val2=document.getElementById('txtupdc_'+[val4]).value;
		var ups=0; var nop="";
		if(val3=="Gms")
		{
			ups=1000/parseFloat(val2); 
			nop=parseFloat(ups)*val1;
		}
		else
		{
			ups=parseFloat(val2);
			nop=val1/parseFloat(ups);
		}
		var nzzz=Math.round(nop*1000)/1000;
		var zz=nzzz+'';
		var zzz=zz.split(".");
		if(zzz[1] > 0)
		{
			alert("Enter valid Quantity which is divisible by UPS");
			document.getElementById("txtqtydc_"+[val4]).value="";
			document.getElementById("txtnopdc_"+[val4]).value="";
			document.getElementById("txtqtydc_"+[val4]).focus();
			return false;
		}
		else
		{
			document.getElementById('txtnopdc_'+[val4]).value=nzzz;
		}
	}
	else
	{
		alert("Quantity cannot be Zero(0) or less and cannot be more than 99999.999");
		document.getElementById("txtqtydc_"+[val4]).value="";
		document.getElementById("txtnopdc_"+[val4]).value="";
		document.getElementById("txtqtydc_"+[val4]).focus();
		return false;
	}				
					
	var flg=0; var flg1=0;
	for(var i=0; i < upstt.length; i++)
	{	
		if(upstt[i]!="")
		{	
			if(upstt[i]==upstyp)
			{flg1++;
				var tt=parseFloat(qtyp)/parseFloat(upsqtytt[i]);
				var nzzz=Math.round(tt*1000)/1000;
				var zz=nzzz+'';
				var zzz=zz.split(".");
				if(zzz[1]>0)
				{
					flg=1;
				}
			}
		}
	}
	//alert(flg); alert(flg1);
	if(flg==0 && flg1>0)
	{
		alert("Quantity filled is available in Standard Master Pack for the mentioned UPS.\nPlease book order of this quantity under standard UPS type and not in non-standard UPS.");
		document.getElementById("txtqtydc_"+[val4]).value="";
		document.getElementById("txtnopdc_"+[val4]).value="";
		document.getElementById("txtqtydc_"+[val4]).focus();
		return false;
	}

} 
function uptypchk(val1, srn, variety)
{
	var nm="stdpt_"+srn;
	showUser(srn,nm,'ptck',variety,val1,'','','');
	document.getElementById('txtnopdc_'+[srn]).value="";
	document.getElementById('txtqtydc_'+[srn]).value="";
	document.getElementById('txtnopwb_'+[srn]).value="";
	document.getElementById('txtnopmp_'+[srn]).value="";
}
function pformedtup()
{	
  	var fl=0;
	var olbtn="<img src='../images/update.gif' border='0' style='display:inline;cursor:pointer;' onclick='pform();' />&nbsp;&nbsp;";
	document.getElementById('frmbutn').innerHTML="<img src='../images/processing2.gif' border='0' style='display:inline;cursor:wait;' />&nbsp;&nbsp;";
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		document.frmaddDepartment.txtpp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtpp.value!="")
	{
		if(document.frmaddDepartment.txtpp.value!="Export Buyer")
		{
			if(document.frmaddDepartment.txtstatesl.value=="")
			{
				alert("Please select State");
				document.frmaddDepartment.txtstfp.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				fl=1;
				return false;
			}	
			if(document.frmaddDepartment.txtlocationsl.value=="")
			{
				alert("Please Select Location");
				document.frmaddDepartment.txtconchk.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				fl=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtcountrysl.value=="")
			{
				alert("Please select Country");
				document.frmaddDepartment.txtstfp.focus();
				document.getElementById('frmbutn').innerHTML=olbtn;
				fl=1;
				return false;
			}	
		}	
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Bulk Party");
		document.frmaddDepartment.txtstfp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please Select Consignee Applicable");
		document.frmaddDepartment.txtconchk.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
	
	if(document.frmaddDepartment.txtconchk.value=="Yes")
{
	if(document.frmaddDepartment.txtpp.value!="Export Buyer")
	{
		if(document.frmaddDepartment.txtparty.value=="")
		{
			alert("Please specify Consignee's Name");
			//document.frmaddDepartment.txtparty.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtadd.value=="")
		{
			alert("Please specify Consignee's Address ");
			//document.frmaddDepartment.txtadd.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtadd.value!="")
		{
			if(document.frmaddDepartment.txtadd.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtadd.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
		}
		if(document.frmaddDepartment.txtcity.value=="")
		{
			alert("Please specify Consignee's Location");
			//document.frmaddDepartment.txtcity.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtcity.value!="")
		{
			if(document.frmaddDepartment.txtcity.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtcity.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
		}
		if(document.frmaddDepartment.txtstate.value=="")
		{
			alert("Please specify Consignee's State");
			//document.frmaddDepartment.txtstate.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtpin.value!="")
		{
				if(document.frmaddDepartment.txtpin.value.length < 6)
				{
					alert("Pin Code can not less than six digits");
					document.frmaddDepartment.txtpin.value="";
					document.getElementById('frmbutn').innerHTML=olbtn;
					return false;
				}
		}
	}
	else
	{
		if(document.frmaddDepartment.txtpartycountry.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtpartycountry.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtaddcountry.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtaddcountry.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtaddcountry.value!="")
		{
			if(document.frmaddDepartment.txtaddcountry.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtaddcountry.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
		}
		if(document.frmaddDepartment.txtcitycountry.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcitycountry.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtcitycountry.value!="")
		{
			if(document.frmaddDepartment.txtcitycountry.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtcitycountry.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
		}
		if(document.frmaddDepartment.txtstatecountry.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstatecountry.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
		if(document.frmaddDepartment.txtpincountry.value!="")
		{
			if(document.frmaddDepartment.txtpincountry.value.length < 5)
			{
				alert("Zip Code can not less than Five digits");
				document.frmaddDepartment.txtpincountry.value="";
				document.getElementById('frmbutn').innerHTML=olbtn;
				return false;
			}
		}
	}
}

	if(document.frmaddDepartment.txtorderplby.value=="")
	{
		alert("Please specify Order Placed By Name");
		document.frmaddDepartment.txtorderplby.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtorderplby.value!="")
	{
		if(document.frmaddDepartment.txtorderplby.value.length <= 1)
		{
		alert("Invalid Order Placed By Name");
		document.frmaddDepartment.txtorderplby.value="";
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
		}
	}	
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Dispatch Mode");
		document.frmaddDepartment.txt11.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
		if(document.frmaddDepartment.txt11.value!="")
	{
		if(document.frmaddDepartment.txt11.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Define Transport Name");
			document.frmaddDepartment.txttname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txttname.value!="")
	{
		if(document.frmaddDepartment.txttname.value.length <= 1)
		{
		alert("Invalid Transport Name");
		document.frmaddDepartment.txttname.value="";
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
		}
	}	
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
			alert("Define Courier Name");
			document.frmaddDepartment.txtcname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDepartment.txtcname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txtcname.value!="")
	{
		if(document.frmaddDepartment.txtcname.value.length <= 1)
		{
		alert("Invalid Courier Name");
		document.frmaddDepartment.txtcname.value="";
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
		}
	}	
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
			alert("Define Name of the Person");
			document.frmaddDepartment.txtpname.focus();
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
			}	
			
			if(document.frmaddDepartment.txtpname.value!="")
	{
		if(document.frmaddDepartment.txtpname.value.length <= 1)
		{
		alert("Invalid Person Name Name");
		document.frmaddDepartment.txtpname.value="";
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
		}
	}	
		}
	}
	else
	{
		alert("Please select Mode of Dispatch");
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtupschk.value=="")
	{
		alert("Select UPS Type");
		document.frmaddDepartment.txtupschk.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.srn.value=="" || document.frmaddDepartment.srn.value==0)
	{
		alert("UPS is not avilable for this Variety");
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.srn.value!="" && document.frmaddDepartment.srn.value > 0)
	{	var j=1; var i=1; 
		for(i=1; i<=document.frmaddDepartment.srn.value; i++)
		{ 
			var fld=document.getElementById('txtqtydc_'+[i]).value;
			if(fld=="")
			{
				j++;
			}
		}
		if(i==j)
		{
			alert("Define Quantity");
			document.getElementById('frmbutn').innerHTML=olbtn;
			fl=1;
			return false;
		}
	}
	
	if(fl==1)
	{
	document.getElementById('frmbutn').innerHTML=olbtn;
	return false;
	}
	else
	{	
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','');
	}
}

function orplchk()
{
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please select Consignee Applicable as Yes or No");
		document.frmaddDepartment.txtorderplby.value="";
	}
}
function clk(opt)
{
	if(document.frmaddDepartment.txtorderplby.value!="")
	{
	if(opt!="")
	{
		if(opt=="Transport")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
			document.frmaddDepartment.txtcname.value="";
			document.frmaddDepartment.txtpname.value="";
		}
		else if(opt=="Courier")
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
			document.frmaddDepartment.txttname.value="";
			document.frmaddDepartment.txtpname.value="";
		}	
		else 
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="block";
			document.frmaddDepartment.txt11.value=opt;
			document.frmaddDepartment.txttname.value="";
			document.frmaddDepartment.txtcname.value="";
		}	
	}
	else
	{
			alert("Please Select Mode of Transit");
			document.frmaddDepartment.txt11.value="";
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
			document.frmaddDepartment.txttname.value="";
			document.frmaddDepartment.txtcname.value="";
			document.frmaddDepartment.txtpname.value="";
	}
	}
	else
	{
			alert("Please enter Order Placed By");
			document.frmaddDepartment.txt11.value="";
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
			document.frmaddDepartment.txttname.value="";
			document.frmaddDepartment.txtcname.value="";
			document.frmaddDepartment.txtpname.value="";
			var radList = document.getElementsByName('txt1');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
	}
}
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode != 32 && charCode != 8 && charCode != 46 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}
function clk1(val)
{
document.frmaddDepartment.txt14.value=val;
}
function editrec(edtrecid, trid)
{
showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
}

function deleterec(v1,v2,v3)
{
	if(confirm('Do You wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}

function caddchk(addval1)
{
	if(addval1.length <= 1)
	{
	alert("Invalid Consignee Address");
	document.frmaddDepartment.txtadd.value="";
	return false;
	}
	var add=document.frmaddDepartment.txtadd.value;
	var add1=add.replace(/(\r\n|[\r\n])/g, ", ");
	document.frmaddDepartment.txtadd.value=add1;
}

function mySubmit()
{ 
var fl=0;
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		//document.frmaddDepartment.txtpp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtpp.value!="")
	{
		if(document.frmaddDepartment.txtpp.value!="Export Buyer")
		{
			if(document.frmaddDepartment.txtstatesl.value=="")
			{
				alert("Please select State");
				//document.frmaddDepartment.txtstfp.focus();
				fl=1;
				return false;
			}	
			if(document.frmaddDepartment.txtlocationsl.value=="")
			{
				alert("Please Select Location");
				//document.frmaddDepartment.txtconchk.focus();
				fl=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtcountrysl.value=="")
			{
				alert("Please select Country");
				//document.frmaddDepartment.txtstfp.focus();
				fl=1;
				return false;
			}	
		}	
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party");
		//document.frmaddDepartment.txtstfp.focus();
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please Select Consignee Applicable");
		//document.frmaddDepartment.txtconchk.focus();
		fl=1;
		return false;
	}	
	
if(document.frmaddDepartment.txtconchk.value=="Yes")
{
	if(document.frmaddDepartment.txtpp.value!="Export Buyer")
	{
		if(document.frmaddDepartment.txtparty.value=="")
		{
			alert("Please specify Consignee's Name");
			//document.frmaddDepartment.txtparty.focus();
			return false;
		}
		if(document.frmaddDepartment.txtadd.value=="")
		{
			alert("Please specify Consignee's Address ");
			//document.frmaddDepartment.txtadd.focus();
			return false;
		}
		if(document.frmaddDepartment.txtadd.value!="")
		{
			if(document.frmaddDepartment.txtadd.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtadd.value="";
				return false;
			}
		}
		if(document.frmaddDepartment.txtcity.value=="")
		{
			alert("Please specify Consignee's Location");
			//document.frmaddDepartment.txtcity.focus();
			return false;
		}
		if(document.frmaddDepartment.txtcity.value!="")
		{
			if(document.frmaddDepartment.txtcity.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtcity.value="";
				return false;
			}
		}
		if(document.frmaddDepartment.txtstate.value=="")
		{
			alert("Please specify Consignee's State");
			//document.frmaddDepartment.txtstate.focus();
			return false;
		}
		if(document.frmaddDepartment.txtpin.value!="")
		{
				if(document.frmaddDepartment.txtpin.value.length < 6)
				{

					alert("Pin Code can not less than six digits");
					document.frmaddDepartment.txtpin.value="";
					return false;
				}
		}
	}
	else
	{
		if(document.frmaddDepartment.txtpartycountry.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtpartycountry.focus();
			return false;
		}
		if(document.frmaddDepartment.txtaddcountry.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtaddcountry.focus();
			return false;
		}
		if(document.frmaddDepartment.txtaddcountry.value!="")
		{
			if(document.frmaddDepartment.txtaddcountry.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtaddcountry.value="";
				return false;
			}
		}
		if(document.frmaddDepartment.txtcitycountry.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcitycountry.focus();
			return false;
		}
		if(document.frmaddDepartment.txtcitycountry.value!="")
		{
			if(document.frmaddDepartment.txtcitycountry.value.length <= 1)
			{
				alert("Invalid Consignee's Address");
				document.frmaddDepartment.txtcitycountry.value="";
				return false;
			}
		}
		if(document.frmaddDepartment.txtstatecountry.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstatecountry.focus();
			return false;
		}
		if(document.frmaddDepartment.txtpincountry.value!="")
		{
			if(document.frmaddDepartment.txtpincountry.value.length < 5)
			{
				alert("Zip Code can not less than Five digits");
				document.frmaddDepartment.txtpincountry.value="";
				return false;
			}
		}
	}
}	

	if(document.frmaddDepartment.txtorderplby.value=="")
	{
		alert("Please specify Order Placed By Name");
		document.frmaddDepartment.txtorderplby.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtorderplby.value!="")
	{
		if(document.frmaddDepartment.txtorderplby.value.length <= 1)
		{
		alert("Invalid Order Placed By Name");
		document.frmaddDepartment.txtorderplby.value="";
		return false;
		}
	}	
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Dispatch Mode");
		document.frmaddDepartment.txt11.focus();
		fl=1;
		return false;
	}	
		if(document.frmaddDepartment.txt11.value!="")
	{
		if(document.frmaddDepartment.txt11.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Define Transport Name");
			document.frmaddDepartment.txttname.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txttname.value!="")
	{
		if(document.frmaddDepartment.txttname.value.length <= 1)
		{
		alert("Invalid Transport Name");
		document.frmaddDepartment.txttname.value="";
		return false;
		}
	}	
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
			alert("Define Courier Name");
			document.frmaddDepartment.txtcname.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDepartment.txtcname.focus();
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txtcname.value!="")
	{
		if(document.frmaddDepartment.txtcname.value.length <= 1)
		{
		alert("Invalid Courier Name");
		document.frmaddDepartment.txtcname.value="";
		return false;
		}
	}	
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
			alert("Define Name of the Person");
			document.frmaddDepartment.txtpname.focus();
			fl=1;
			return false;
			}	
			
			if(document.frmaddDepartment.txtpname.value!="")
	{
		if(document.frmaddDepartment.txtpname.value.length <= 1)
		{
		alert("Invalid Person Name Name");
		document.frmaddDepartment.txtpname.value="";
		return false;
		}
	}	
		}
	}
if(document.frmaddDepartment.txtremarks.value!="")
	{
		if(document.frmaddDepartment.txtremarks.value.length <= 1)
		{
		alert("Invalid Remarks");
		document.frmaddDepartment.txtpname.value="";
		return false;
		}
	}	

	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;	 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_order.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Order - Sales </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	
	<?php 
 $tid=$p_id;

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and logid='".$logid."' and order_trtype='Order Sales' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>	   
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $row_tbl['orderm_tmode']?>" type="hidden"> 
	    <input name="txt14" value="<?php echo $row_tbl['orderm_paymode']?>" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['orderm_code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="gln1" value="" />
		<input type="hidden" name="txtconchk" value="<?php echo $row_tbl['orderm_consigneeapp']?>" />
		<input type="hidden" name="txtptype" value="<?php echo $row_tbl['orderm_party_type'];?>" />
		
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit Order - Sales</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="256"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txttranid" type="text" size="16" class="tbltext" tabindex=""    maxlength="16"  value="<?php echo "TOS".$row_tbl['orderm_code']."/".$ycode."/".$lgnid;?>" style="background-color:#CCCCCC"  readonly="true"/>&nbsp;</td>

<td width="169" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="210" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Order Number &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtordno" type="text" size="16" class="tbltext" tabindex=""    maxlength="16"  value="<?php echo $row_tbl['orderm_porderno'];?>" style="background-color:#CCCCCC" readonly="true"/>&nbsp;&nbsp;&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Party Order Ref. No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtporf" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" value="<?php echo $row_tbl['orderm_partyrefno'];?>"/>&nbsp;&nbsp;</td>
           </tr>
<?php
$sql_month=mysqli_query($link,"select * from tblclassification where plantcode='$plantcode' and main='Channel'  order by classification")or die(mysqli_error($link));
$t=mysqli_num_rows($sql_month);
?>
<tr class="Dark" height="30">
<td width="202" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia['classification']==$row_tbl['orderm_party_type']){ echo "Selected";} ?>  value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php }?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>		   
<div id="selectpartylocation"style="display:<?php if($row_tbl['orderm_party_type']!=""){ echo "block";} else { echo "none"; }?>" >	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{	
?>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="256" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
<option value="">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($row_tbl['orderm_locstate']==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['orderm_locstate']."' order by productionlocation")or die(mysqli_error($link));
?>	
	<td width="169" align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="210" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
<option value="" selected>--Select--</option>
<?php while($noticia3 = mysqli_fetch_array($sql_month3)) { ?>
		<option <?php if($row_tbl['orderm_location']==$noticia3['productionlocationid']){ echo "Selected";} ?> value="<?php echo $noticia3['productionlocationid'];?>" />   
		<?php echo $noticia3['productionlocation'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry order by country")or die(mysqli_error($link));
?>
<tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)">
<option value="">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia['country']==$row_tbl['orderm_country']){ echo "Selected";} ?> value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
<?php
}
?>
</table>
</div>
<div id="selectparty"style="display:<?php if($row_tbl['orderm_party_type']!=""){ echo "block";} else { echo "none"; }?>" >	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where state='".$row_tbl['orderm_locstate']."' and classification='".$row_tbl['orderm_party_type']."' order by business_name")or die(mysqli_error($link));
}
else
{ 
$sql_month33=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['orderm_country']."' order by country")or die(mysqli_error($link));

$row_month33=mysqli_fetch_array($sql_month33); //echo $row_month33['c_id'];

$sql_month24=mysqli_query($link,"select * from tbl_partymaser where country='".$row_month33['c_id']."' and classification='".$row_tbl['orderm_party_type']."' order by business_name")or die(mysqli_error($link));
}
//echo $t=mysqli_num_rows($sql_month24);
?>
 <tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">Invoice To &nbsp;</td>
<td width="639"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<select class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');" >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month24)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['orderm_party']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
</table>
</div>
 <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
  
		<tr class="Dark" height="25">
 <td width="205"  align="right"  valign="middle" class="tblheading">&nbsp;Consignee Applicable&nbsp;</td>
   <td width="639" colspan="3" align="left"  valign="middle"><input name="txt12" type="radio" class="tbltext" value="Yes" onClick="clkp(this.value);" <?php if($row_tbl['orderm_consigneeapp']=="Yes"){ echo "Checked";} ?> />&nbsp;Yes&nbsp;&nbsp;<input name="txt12" type="radio" class="tbltext" value="No" onClick="clkp(this.value);" <?php if($row_tbl['orderm_consigneeapp']=="No"){ echo "Checked";} ?>  />&nbsp;No&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table> 
<div id="fill" style="display:<?php if($row_tbl['orderm_consigneeapp']=="Yes" && $row_tbl['orderm_party_type']!="Export Buyer"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse"  > 
<tr class="Light" height="25">
           <td width="205"  align="right"  valign="middle" class="tblheading">Consignee Name&nbsp; </td>
           <td align="left"  valign="middle" colspan="3" >&nbsp;<input name="txtparty" type="text" size="35" class="tbltext" tabindex="" maxlength="35" value="<?php echo $row_tbl['orderm_consigneename'];?>"  onBlur="javascript:this.value=FirstCharCap(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
 <tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">&nbsp;Address &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<textarea name="txtadd" cols="50" rows="3" tabindex=""  class="tbltext" onBlur="javascript:this.value=FirstCharCap(this.value);" onchange="caddchk(this.value);" ><?php echo $row_tbl['orderm_conadd'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td width="205" align="right"  valign="middle" class="tblheading" >&nbsp;City/Town/Village&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="4">&nbsp;<input type="text" class="tbltext" name="txtcity" size="20" maxlength="20" value="<?php echo $row_tbl['orderm_concity'];?>"  onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading" >&nbsp;Pin&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input type="text" class="tbltext" name="txtpin" size="6" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl['orderm_conpin'];?>" >&nbsp;</td>
</tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="205" align="right"  valign="middle" class="tblheading" >&nbsp;State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select name="txtstate" class="tbltext"  style="width:170px;" tabindex="">
          <option value="">--Select State--</option>
		  <?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($row_tbl['orderm_constate']==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="30"  >
   <td align="right" width="205" valign="middle" class="tblheading" >&nbsp;Phone No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="pstd" type="text" size="5" class="tbltext" tabindex="7" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl['orderm_conphonestd'];?>"/>&nbsp;&nbsp;<input name="pphno" type="text" size="15" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['orderm_conphoneno'];?>" /onkeypress="return isNumberKey(event)">&nbsp;STD | Phone</td>
  </tr>
<tr class="Light" height="25">
          <td width="205"  align="right"  valign="middle" class="tblheading" >Mobile&nbsp;No.&nbsp; </td>
           <td colspan="5" align="left"  valign="middle" style=" border-color:#cc30cc">&nbsp;<input name="txtcontact" type="text" size="16" class="tbltext" tabindex="0" maxlength="15"  onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl['orderm_conmobile'];?>" />&nbsp;</td>
		   </tr>
		   <tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading" >TIN&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtctin" type="text" size="16" class="tbltext" tabindex=""  value="<?php echo $row_tbl['orderm_contin'];?>"  maxlength="15" />&nbsp;&nbsp;</td>

<td align="right" width="145" valign="middle" class="tblheading" >CST&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtccst" type="text" size="16" class="tbltext" tabindex="" value="<?php echo $row_tbl['orderm_concst'];?>" maxlength="15" >&nbsp;&nbsp;</td>
</tr></table>
</div>
<div id="fillcountry" style="display:<?php if($row_tbl['orderm_consigneeapp']=="Yes" && $row_tbl['orderm_party_type']=="Export Buyer"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse"  > 
<tr class="Light" height="25">
           <td width="205"  align="right"  valign="middle" class="tblheading">Consignee Name&nbsp; </td>
           <td align="left"  valign="middle" colspan="3" >&nbsp;<input name="txtpartycountry" type="text" size="35" class="tbltext" tabindex="" maxlength="35" value="<?php echo $row_tbl['orderm_consigneename'];?>"  onBlur="javascript:this.value=FirstCharCap(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
 <tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">&nbsp;Address &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<textarea name="txtaddcountry" cols="50" rows="3" tabindex=""  class="tbltext" onBlur="javascript:this.value=FirstCharCap(this.value);" onchange="caddchk(this.value);" ><?php echo $row_tbl['orderm_conadd'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td width="205" align="right"  valign="middle" class="tblheading" >&nbsp;City/Town&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="4">&nbsp;<input type="text" class="tbltext" name="txtcitycountry" size="20" maxlength="20" value="<?php echo $row_tbl['orderm_concity'];?>"  onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading" >&nbsp;Zip&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input type="text" class="tbltext" name="txtpincountry" size="6" maxlength="6" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl['orderm_conpin'];?>" >&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="205" align="right"  valign="middle" class="tblheading" >&nbsp;State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtstatecountry" size="20" maxlength="20" value="<?php echo $row_tbl['orderm_constate'];?>"  onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtcountry1" type="text" size="25" class="tbltext" tabindex=""  value="<?php echo $row_tbl['orderm_country'];?>"  maxlength="25" />
	&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30"  >
   <td align="right" width="205" valign="middle" class="tblheading" >&nbsp;Phone No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="pstdcountry" type="text" size="5" class="tbltext" tabindex="7" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl['orderm_conphonestd'];?>"/>&nbsp;&nbsp;<input name="pphnocountry" type="text" size="15" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['orderm_conphoneno'];?>" /onkeypress="return isNumberKey(event)">&nbsp;STD | Phone</td>
  </tr>
<tr class="Light" height="25">
          <td width="205"  align="right"  valign="middle" class="tblheading" >Mobile&nbsp;No.&nbsp; </td>
           <td colspan="5" align="left"  valign="middle" style=" border-color:#cc30cc">&nbsp;<input name="txtcontactcountry" type="text" size="16" class="tbltext" tabindex="0" maxlength="15"  onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl['orderm_conmobile'];?>" />&nbsp;</td>
		   </tr>
		   <tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading" >UDF 1&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtctincountry" type="text" size="16" class="tbltext" tabindex=""  value="<?php echo $row_tbl['orderm_contin'];?>"  maxlength="15" />&nbsp;&nbsp;</td>

<td align="right" width="145" valign="middle" class="tblheading" >UDF 2&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtccstcountry" type="text" size="16" class="tbltext" tabindex="" value="<?php echo $row_tbl['orderm_concst'];?>" maxlength="15" >&nbsp;&nbsp;</td>
</tr></table>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="205" valign="middle" class="tblheading" >Order Placed By&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtorderplby" type="text" size="20" class="tbltext" tabindex=""  value="<?php echo $row_tbl['orderm_placedby'];?>"  maxlength="20" onchange="orplchk();"onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td width="205" align="right"  valign="middle" class="tblheading">&nbsp;Preferred Mode of Dispatch&nbsp;</td>
 <td width="639" colspan="3" align="left"  valign="middle" class="tbltext" ><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['orderm_tmode']=="Transport"){ echo "Checked";} ?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['orderm_tmode']=="Courier"){ echo "Checked";} ?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['orderm_tmode']=="By Hand"){ echo "Checked";} ?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="trans" style="display:<?php if($row_tbl['orderm_tmode']=="Transport"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Transport Name&nbsp;</td>
<td width="639" align="left"  valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txttname" type="text" size="35" class="tbltext" tabindex="" maxlength="35" value="<?php echo $row_tbl['orderm_trname'];?>" onBlur="javascript:this.value=FirstCharCap(this.value);"  />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['orderm_tmode']=="Courier"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="639" valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txtcname" type="text" size="35" class="tbltext" tabindex="" value="<?php echo $row_tbl['orderm_cname'];?>"  maxlength="35"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
 
</table>
</div>
<div id="byhand" style="display:<?php if($row_tbl['orderm_tmode']=="By Hand"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Name of Person&nbsp;</td>
<td width="639" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txtpname" type="text" size="30" class="tbltext" tabindex=""  maxlength="30" value="<?php echo $row_tbl['orderm_pname'];?>" onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
 <?php
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and logid='".$logid."' and order_trtype='Order Sales' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$ordm_id=$row_tbl['orderm_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$ordm_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="10%" align="center" valign="middle" class="tblheading">&nbsp;Crop</td>
        <td width="5%" align="center" valign="middle" class="tblheading">Variety Type</td>
        <td width="12%" align="center" valign="middle" class="tblheading">&nbsp;Variety</td>
		<td width="11%" align="center" valign="middle" class="tblheading">&nbsp;PV Variety</td>
		<td width="3%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="7%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="7%" align="center" valign="middle" class="tblheading">Total Qty (Kgs.)</td>
		<td width="6%" align="center" valign="middle" class="tblheading">SMC Qty (Kgs.)</td>
		<td width="6%" align="center" valign="middle" class="tblheading">L.Qty (Kgs.)</td>
        <td width="6%" align="center" valign="middle" class="tblheading">PT</td>
        <td width="4%" align="center" valign="middle" class="tblheading">Std MP</td>
        <td width="4%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="5%" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
		<td width="3%" align="center" valign="middle" class="tblheading">Edit</td>
        <td width="5%" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1=""; $grtqty=0; $grsmqty=0; $grlqty=0; $getmp=""; $grtnop=0; $grtnowb=0; $getnomp=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];

$sql_pvveriety=mysqli_query($link,"select * from tblvariety where varietyid='".$p_1['pvverid']."' and actstatus='Active'") or die(mysqli_error($link));
$p_12=mysqli_fetch_array($sql_pvveriety);
$pvvariety=$p_12['popularname'];
		
$up=""; $up1=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $zz=""; $vtype=""; $smcqty=""; $lqty="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}


if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

if($smcqty!="")
$smcqty=$smcqty."<br />".$row_sloc['order_sub_subqty'];
else
$smcqty=$row_sloc['order_sub_subqty'];
 
if($lqty!="") 
$lqty=$lqty."<br />".$row_sloc['order_sub_sublqty'];
else
$lqty=$row_sloc['order_sub_sublqty'];


if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";

$grtqty=$grtqty+$qt1; 
$grsmqty=$grsmqty+$row_sloc['order_sub_subqty'];
$grlqty=$grlqty+$row_sloc['order_sub_sublqty'];
$grtnop=$grtnop+$row_sloc['order_sub_sub_nop'];
$grtnowb=$grtnowb+$nowb;
$getnomp=$getnomp+$nomp;

}
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
$vtype=$row_tbl_sub['order_sub_variety_typ'];

/*$grtqty=$grtqty+$qt; 
$grsmqty=$grsmqty+$smcqty;
$grlqty=$grlqty+$lqty;
$grtnop=$grtnop+$np;
$grtnowb=$grtnowb+$nowbp;
$getnomp=$getnomp+$nompp;
*/
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
		<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		<td width="10%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $vtype;?></td>
        <td width="12%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
		<td width="11%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $pvvariety;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><?php echo $up1;?></td>
		<td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
        <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $smcqty;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $lqty;?></td>
        <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $ptp;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $stdptv;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $np;?></td>
		<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $nowbp;?></td>
		<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $nompp;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order Sales');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		<td width="10%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $vtype;?></td>
        <td width="12%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
		<td width="11%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $pvvariety;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><?php echo $up1;?></td>
		<td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
        <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $smcqty;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $lqty;?></td>
        <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $ptp;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $stdptv;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $np;?></td>
		<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $nowbp;?></td>
		<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $nompp;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order Sales');" /></td>
</tr>
<?php
}$srno++;
}
}
?>	
<tr class="Light" height="20">
    <td width="2%" align="right" valign="middle" class="smalltblheading" colspan="7">Grand Total&nbsp;</td>
    <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $grtqty;?></td>
	<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $grsmqty;?></td>
	<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $grlqty;?></td>
    <td width="6%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $grtnop;?></td>
	<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $grtnowb;?></td>
	<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $getnomp;?></td>
	<td width="3%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
</tr>
</table>
<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="106" align="right"  valign="middle" class="tblheading">Select Crop&nbsp;</td>
<td width="210" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			  <td width="116" align="right"  valign="middle" class="tblheading">Select Variety Type&nbsp;</td>
<td width="112" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtvartyp" style="width:80px;" onchange="vartypechk(this.value)">
<option value="" selected>--Select--</option>
<option value="Hybrid" />Hybrid</option> 
<option value="OP" />OP</option>   
</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="87" align="right"  valign="middle" class="tblheading" >Select Variety&nbsp;</td>
    <td width="205" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="cropchk();" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
		   <input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" /><input type="hidden" name="itmdchk1" value="<?php echo $itmdchk1;?>" />
		<tr class="Light" height="25">
<td align="right" width="106" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Select UPS Type&nbsp;</td>
   <td colspan="5" align="left"  valign="middle" ><input name="txtup" type="radio" class="tbltext" value="Yes" onClick="clkp1(this.value);" />&nbsp;Standard&nbsp;&nbsp;<input name="txtup" type="radio" class="tbltext" value="No" onClick="clkp1(this.value);"  />&nbsp;Non-Standard&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="txtupschk" value="" />
</table> 
<div id="selectupst" style="display:none">
</div>
<div id="subsubdivgood" style="display:block"></div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right" id="frmbutn" ><img src="../images/Post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="120" maxlength="90" value="<?php echo $row_tbl['remarks'];?>"></td>
</tr>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_ordersa.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  