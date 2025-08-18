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

	if(isset($_REQUEST['p_id'])) { $pid = $_REQUEST['p_id']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
		$p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$txtslflchk=trim($_POST['txtslflchk']);
		$txtconchk=trim($_POST['txtconchk']);
		$txtupschk=trim($_POST['txtupschk']);
		$txtordno=trim($_POST['txtordno']);
		$txtporf=trim($_POST['txtporf']);
		$txtorderplby=trim($_POST['txtorderplby']);
		$txt11=trim($_POST['txt11']);
		$party=trim($_POST['txtpp']);
		$txtstatesl=trim($_POST['txtstatesl']);
		$txtlocationsl=trim($_POST['txtlocationsl']);
		$txtcountrysl=trim($_POST['txtcountrysl']);
		$remarks=str_replace("&","and",$remarks);
		
		if($txtslflchk=="selectp")
		{
			$txtptyp="";
			$txtptyp=trim($_POST['txtptyp']);
			if($txtptyp!="")
			{
				$txtparty=trim($_POST['txtparty']);
			}
			else
			{
				$txtparty="";
			}
		}
		else if($txtslflchk=="fillp")
		{
			$txtparty1=trim($_POST['txtparty1']);
			$txtadd1=trim($_POST['txtadd1']);
			$txtcity1=trim($_POST['txtcity1']);
			$txtstate1=trim($_POST['txtstate1']);
			$pstd1=trim($_POST['pstd1']);
			$pphno1=trim($_POST['pphno1']);
			$txtpin1=trim($_POST['txtpin1']);
			$txtcontact1=trim($_POST['txtcontact1']);
			$txttin=trim($_POST['txttin']);
			$txtpan=trim($_POST['txtpan']);
			$txtptyp="";
			$txtparty="";
		}
		else
		{
			$txtptyp="";
			$txtparty1="";
			$txtadd1="";
			$txtcity1="";
			$txtstate1="";
			$pstd1="";
			$pphno1="";
			$txtpin1="";
			$txtcontact1="";
			$txttin="";
			$txtpan="";
			$txtparty="";
		}

		if($txtconchk=="Yes1")
		{
			if($party!="Export Buyer")
			{
				$txtparty2=trim($_POST['txtparty2']);
				$txtadd2=trim($_POST['txtadd2']);
				$txtcity2=trim($_POST['txtcity2']);
				$txtstate2=trim($_POST['txtstate2']);
				$pstd2=trim($_POST['pstd2']);
				$pphno2=trim($_POST['pphno2']);
				$txtpin2=trim($_POST['txtpin2']);
				$txtcontact2=trim($_POST['txtcontact2']);
				$txttin2=trim($_POST['txttin2']);
				$txtpan2=trim($_POST['txtpan2']);
			}
			else
			{
				$txtparty2=trim($_POST['txtparty2country']);
				$txtadd2=trim($_POST['txtadd2country']);
				$txtcity2=trim($_POST['txtcity2country']);
				$txtstate2=trim($_POST['txtstate2country']);
				$pstd2=trim($_POST['pstd2country']);
				$pphno2=trim($_POST['pphno2country']);
				$txtpin2=trim($_POST['txtpin2country']);
				$txtcontact2=trim($_POST['txtcontact2country']);
				$txttin2=trim($_POST['txttin2country']);
				$txtpan2=trim($_POST['txtpan2country']);
			}
		}
		else
		{
			$txtparty2="";
			$txtadd2="";
			$txtcity2="";
			$txtstate2="";
			$pstd2="";
			$pphno2="";
			$txtpin2="";
			$txtcontact2="";
			$txttin2="";
			$txtpan2="";
		}
	
		if($txt11=="Transport")
		{
			$txttname=trim($_POST['txttname']);
			$txtlrn=trim($_POST['txtlrn']);
			$txtvn=trim($_POST['txtvn']);
			$txt14=trim($_POST['txt14']);
		}
		else
		{
			$txttname="";
			$txtlrn="";
			$txtvn="";
			$txt14="";
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
		
		echo "<script>window.location='add_trial_preview.php?p_id=$p_id&remarks=$remarks&txtslflchk=$txtslflchk&txtconchk=$txtconchk&txtupschk=$txtupschk&txtordno=$txtordno&txtporf=$txtporf&txtptyp=$txtptyp&txtparty=$txtparty&txtparty1=$txtparty1&txtadd1=$txtadd1&txtcity1=$txtcity1&txtstate1=$txtstate1&pstd1=$pstd1&pphno1=$pphno1&txtcontact1=$txtcontact1&txttin=$txttin&txtpan=$txtpan&txtpin1=$txtpin1&txtparty2=$txtparty2&txtadd2=$txtadd2&txtcity2=$txtcity2&txtstate2=$txtstate2&pstd2=$pstd2&pphno2=$pphno2&txtcontact2=$txtcontact2&txttin2=$txttin2&txtpan2=$txtpan2&txtpin2=$txtpin2&txtorderplby=$txtorderplby&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt13=$txt13&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&txtpp=$party&txtstatesl=$txtstatesl&txtlocationsl=$txtlocationsl&txtcountrysl=$txtcountrysl'</script>";		
			
	}
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
/*$sql_code="SELECT MAX(orderm_code) from tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' ORDER BY orderm_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TOD".$code."/".$ycode."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TOD".$code."/".$ycode."/".$lgnid;
		}
		
			$code12="TOR".$code."/".$ycode."/".$lgnid;*/
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order- Transaction -Trial/Demo/Free -Edit</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="ortrial.js"></script>
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

function loccontrychk(countryval)
{
		if(document.frmaddDepartment.txtpp.value!="")
		{
			var classval=document.frmaddDepartment.txtptype.value;
			document.getElementById('selectparty').style.display="block";
			showUser(classval,'selectparty','partychk',countryval,'','','','');
			document.frmaddDepartment.locationname.value=countryval;
			document.frmaddDepartment.txtcountry1.value=countryval;
		}
		else
		{
			alert("Please Select Party Type");
			document.frmaddDepartment.txtcountrysl.selectedIndex=0;
		}

}

function locslchk(statesl)
{
		if(document.frmaddDepartment.txtpp.value!="")
		{
			showUser(statesl,'locations','location','','','','','','');
		}
		else
		{
			alert("Please Select Party Type");
			document.frmaddDepartment.txtstatesl.selectedIndex=0;
		}
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
		if(classval=="C&F")
		{
		(classval="CandF")	
		//alert(classval);
		}
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'selectparty','partychk',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}

function clkparty(opt)
{
		if(opt!="")
		{
			if(opt=="selectp")
			{
				document.getElementById('select2').style.display="block";
				document.getElementById('fill2').style.display="none";
				document.frmaddDepartment.txtslflchk.value=opt;
				document.frmaddDepartment.txtparty1.value="";
				document.frmaddDepartment.txtadd1.value="";
				document.frmaddDepartment.txtcity1.value="";
				document.frmaddDepartment.txtpin1.value="";
				document.frmaddDepartment.txtstate1.selectedIndex=0;
				document.frmaddDepartment.pstd1.value="";
				document.frmaddDepartment.pphno1.value="";
				document.frmaddDepartment.txtcontact1.value="";
				document.frmaddDepartment.txttin.value="";
				document.frmaddDepartment.txtpan.value="";
			}
			else
			{
				document.getElementById('select2').style.display="none";
				document.getElementById('selectparty').style.display="none";
				document.getElementById('selectpartytype').style.display="none";
				document.getElementById('selectpartylocation').style.display="none";
				document.getElementById('fill2').style.display="block";
				document.frmaddDepartment.txtparty1.value="";
				document.frmaddDepartment.txtadd1.value="";
				document.frmaddDepartment.txtcity1.value="";
				document.frmaddDepartment.txtpin1.value="";
				document.frmaddDepartment.txtstate1.selectedIndex=0;
				document.frmaddDepartment.pstd1.value="";
				document.frmaddDepartment.pphno1.value="";
				document.frmaddDepartment.txtcontact1.value="";
				document.frmaddDepartment.txttin.value="";
				document.frmaddDepartment.txtpan.value="";
				document.frmaddDepartment.txtslflchk.value=opt;
			}	
		}
		else
		{
			alert("Please select Party type");
			document.frmaddDepartment.txtslflchk.value="";
		}
}

function FirstCharCap(charval) {var x=charval.substr(1); var y=charval.charAt(0);var zz=y.toUpperCase(); var cval=zz+x; return cval; }

function clkpartytyp(opt)
{
	if(document.frmaddDepartment.txtslflchk.value!="")
	{
		if(opt!="")
		{
			//var loc=document.frmaddDepartment.locationname.value;
			document.getElementById('selectpartytype').style.display="block";
			document.getElementById('selectparty').style.display="none";
			document.getElementById('selectpartylocation').style.display="none";
			showUser(opt,'selectpartytype','partytypechk','','','','','');
			document.frmaddDepartment.txtptyp.value=opt;
		}
		else
		{
			document.getElementById('selectparty').style.display="none";
			document.getElementById('selectpartytype').style.display="none";
			document.getElementById('selectpartylocation').style.display="none";
			alert("Please select Party selection type");
			document.frmaddDepartment.txtptyp.value="";
		}
	}
	else
	{
		alert("Please choose select or Fill Party");
		var radList = document.getElementsByName('txtpt');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
		document.frmaddDepartment.txtptyp.value="";
		
	}
}
function modetchk1(classval)
{	
		if(document.frmaddDepartment.txtslflchk.value=="")
		{
			alert("Please Select Type");
			document.frmaddDepartment.txtpp.selectedIndex=0;
			
		}
		else
		{
			//var loc=document.frmaddDepartment.txtlocationsl.value;
			document.getElementById('selectpartylocation').style.display="block";
			document.getElementById('selectparty').style.display="none";
			document.getElementById('fill22').style.display="none";
			document.getElementById('fill22country').style.display="none";
			document.frmaddDepartment.txtconchk.value="";
			document.frmaddDepartment.txtparty2.value="";
			document.frmaddDepartment.txtadd2.value="";
			document.frmaddDepartment.txtcity2.value="";
			document.frmaddDepartment.txtpin2.value="";
			document.frmaddDepartment.txtstate2.selectedIndex=0;
			document.frmaddDepartment.pstd2.value="";
			document.frmaddDepartment.pphno2.value="";
			document.frmaddDepartment.txtcontact2.value="";
			document.frmaddDepartment.txttin2.value="";
			document.frmaddDepartment.txtpan2.value="";
			document.frmaddDepartment.txtparty2country.value="";
			document.frmaddDepartment.txtadd2country.value="";
			document.frmaddDepartment.txtcity2country.value="";
			document.frmaddDepartment.txtpin2country.value="";
			document.frmaddDepartment.txtstate2country.value="";
			document.frmaddDepartment.pstd2country.value="";
			document.frmaddDepartment.pphno2country.value="";
			document.frmaddDepartment.txtcontact2country.value="";
			document.frmaddDepartment.txttin2country.value="";
			document.frmaddDepartment.txtpan2country.value="";
			var radList = document.getElementsByName('contxt');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
			showUser(classval,'selectpartylocation','partylocation','','','','','');
			document.frmaddDepartment.txtptype.value=classval;
		}
}
function clkp(opt)
{
	if(document.frmaddDepartment.txtslflchk.value!="")
	{
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value=="")
		{
			alert("Please Select Party type");
			var radList = document.getElementsByName('contxt');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
			document.frmaddDepartment.txtconchk.value="";
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value!="" && document.frmaddDepartment.txtparty.value=="")
		{
			alert("Please Select Party");
			var radList = document.getElementsByName('contxt');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
			document.frmaddDepartment.txtconchk.value="";
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="fillp" && document.frmaddDepartment.txtstate1.value=="")
		{
			alert("Please Select State");
			var radList = document.getElementsByName('contxt');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
			document.frmaddDepartment.txtconchk.value="";
			return false;
		}
		if(opt!="")
		{
			if(opt=="No1")
			{
				document.getElementById('fill22').style.display="none";
				document.getElementById('fill22country').style.display="none";
				document.frmaddDepartment.txtconchk.value=opt;
				document.frmaddDepartment.txtparty2.value="";
				document.frmaddDepartment.txtadd2.value="";
				document.frmaddDepartment.txtcity2.value="";
				document.frmaddDepartment.txtpin2.value="";
				document.frmaddDepartment.txtstate2.selectedIndex=0;
				document.frmaddDepartment.pstd2.value="";
				document.frmaddDepartment.pphno2.value="";
				document.frmaddDepartment.txtcontact2.value="";
				document.frmaddDepartment.txttin2.value="";
				document.frmaddDepartment.txtpan2.value="";
				document.frmaddDepartment.txtparty2country.value="";
				document.frmaddDepartment.txtadd2country.value="";
				document.frmaddDepartment.txtcity2country.value="";
				document.frmaddDepartment.txtpin2country.value="";
				document.frmaddDepartment.txtstate2country.value="";
				document.frmaddDepartment.pstd2country.value="";
				document.frmaddDepartment.pphno2country.value="";
				document.frmaddDepartment.txtcontact2country.value="";
				document.frmaddDepartment.txttin2country.value="";
				document.frmaddDepartment.txtpan2country.value="";
			}
			else
			{
				if(document.frmaddDepartment.txtslflchk.value=="selectp")
				{
					var ptype=document.frmaddDepartment.txtpp.value;
					if(ptype!="Export Buyer")
					{
						document.getElementById('fill22').style.display="block";
						document.getElementById('fill22country').style.display="none";
						document.frmaddDepartment.txtparty2.value="";
						document.frmaddDepartment.txtadd2.value="";
						document.frmaddDepartment.txtcity2.value="";
						document.frmaddDepartment.txtpin2.value="";
						document.frmaddDepartment.txtstate2.selectedIndex=0;
						document.frmaddDepartment.pstd2.value="";
						document.frmaddDepartment.pphno2.value="";
						document.frmaddDepartment.txtcontact2.value="";
						document.frmaddDepartment.txttin2.value="";
						document.frmaddDepartment.txtpan2.value="";
						document.frmaddDepartment.txtparty2country.value="";
						document.frmaddDepartment.txtadd2country.value="";
						document.frmaddDepartment.txtcity2country.value="";
						document.frmaddDepartment.txtpin2country.value="";
						document.frmaddDepartment.txtstate2country.value="";
						document.frmaddDepartment.pstd2country.value="";
						document.frmaddDepartment.pphno2country.value="";
						document.frmaddDepartment.txtcontact2country.value="";
						document.frmaddDepartment.txttin2country.value="";
						document.frmaddDepartment.txtpan2country.value="";
						document.frmaddDepartment.txtconchk.value=opt;
					}
					else
					{
						document.getElementById('fill22').style.display="none";
						document.getElementById('fill22country').style.display="block";
						document.frmaddDepartment.txtparty2.value="";
						document.frmaddDepartment.txtadd2.value="";
						document.frmaddDepartment.txtcity2.value="";
						document.frmaddDepartment.txtpin2.value="";
						document.frmaddDepartment.txtstate2.selectedIndex=0;
						document.frmaddDepartment.pstd2.value="";
						document.frmaddDepartment.pphno2.value="";
						document.frmaddDepartment.txtcontact2.value="";
						document.frmaddDepartment.txttin2.value="";
						document.frmaddDepartment.txtpan2.value="";
						document.frmaddDepartment.txtparty2country.value="";
						document.frmaddDepartment.txtadd2country.value="";
						document.frmaddDepartment.txtcity2country.value="";
						document.frmaddDepartment.txtpin2country.value="";
						document.frmaddDepartment.txtstate2country.value="";
						document.frmaddDepartment.pstd2country.value="";
						document.frmaddDepartment.pphno2country.value="";
						document.frmaddDepartment.txtcontact2country.value="";
						document.frmaddDepartment.txttin2country.value="";
						document.frmaddDepartment.txtpan2country.value="";
						document.frmaddDepartment.txtconchk.value=opt;
					}
				}
				else
				{
					document.getElementById('fill22').style.display="block";
					document.getElementById('fill22country').style.display="none";
					document.frmaddDepartment.txtparty2.value="";
					document.frmaddDepartment.txtadd2.value="";
					document.frmaddDepartment.txtcity2.value="";
					document.frmaddDepartment.txtpin2.value="";
					document.frmaddDepartment.txtstate2.selectedIndex=0;
					document.frmaddDepartment.pstd2.value="";
					document.frmaddDepartment.pphno2.value="";
					document.frmaddDepartment.txtcontact2.value="";
					document.frmaddDepartment.txttin2.value="";
					document.frmaddDepartment.txtpan2.value="";
					document.frmaddDepartment.txtparty2country.value="";
					document.frmaddDepartment.txtadd2country.value="";
					document.frmaddDepartment.txtcity2country.value="";
					document.frmaddDepartment.txtpin2country.value="";
					document.frmaddDepartment.txtstate2country.value="";
					document.frmaddDepartment.pstd2country.value="";
					document.frmaddDepartment.pphno2country.value="";
					document.frmaddDepartment.txtcontact2country.value="";
					document.frmaddDepartment.txttin2country.value="";
					document.frmaddDepartment.txtpan2country.value="";
					document.frmaddDepartment.txtconchk.value=opt;
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
		alert("Please Select Party type");
		var radList = document.getElementsByName('contxt');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
		document.frmaddDepartment.txtconchk.value="";
		return false;
	}
}
function pnamechk(pname)
{
	if(pname.length <= 1)
	{
	alert("Invalid Party Name");
	document.frmaddDepartment.txtparty1.value="";
	}
}
function cnamechk(cname)
{
	if(cname.length <= 1)
	{
	alert("Invalid Consignee Name");
	document.frmaddDepartment.txtparty2.value="";
	}
}
function cnamechkcountry(cname)
{
	if(cname.length <= 1)
	{
	alert("Invalid Consignee Name");
	document.frmaddDepartment.txtparty2country.value="";
	}
}
function trnamechk(trname)
{
	if(trname.length <= 1)
	{
	alert("Invalid Transport Name");
	document.frmaddDepartment.txttname.value="";
	}
}
function crnamechk(crname)
{
	if(crname.length <= 1)
	{
	alert("Invalid Courier Name");
	document.frmaddDepartment.txtcname.value="";
	}
}
function crnamechkcountry(crname)
{
	if(crname.length <= 1)
	{
	alert("Invalid Courier Name");
	document.frmaddDepartment.txtcnamecountry.value="";
	}
}
function prnamechk(prname)
{
	if(prname.length <= 1)
	{
	alert("Invalid Person Name");
	document.frmaddDepartment.txtpname.value="";
	}
}
function paddchk(addval)
{
	if(document.frmaddDepartment.txtparty1.value=="")
	{
		alert("Please enter Party Name");
		document.frmaddDepartment.txtadd1.value="";
	}
	if(addval.length <= 1)
	{
	alert("Invalid Party Address");
	document.frmaddDepartment.txtadd1.value="";
	return false;
	}
	var add=document.frmaddDepartment.txtadd1.value;
	var add1=add.replace(/(\r\n|[\r\n])/g, ", ");
	document.frmaddDepartment.txtadd1.value=add1;
}
function pcitychk(cityval)
{
	if(document.frmaddDepartment.txtadd1.value=="")
	{
		alert("Please enter Party Address");
		document.frmaddDepartment.txtcity1.value="";
	}
	if(cityval.length <= 1)
	{
	alert("Invalid Party City/Town/Village");
	document.frmaddDepartment.txtcity1.value="";
	}
}
function pstatechk()
{
	if(document.frmaddDepartment.txtcity1.value=="")
	{
		alert("Please enter Party City/Town/Village");
		document.frmaddDepartment.txtstate1.selectedIndex=0;
	}
}
function caddchk(addval1)
{
	if(document.frmaddDepartment.txtparty2.value=="")
	{
		alert("Please enter Consignee Name");
		document.frmaddDepartment.txtadd2.value="";
	}
	if(addval1.length <= 1)
	{
	alert("Invalid Consignee Address");
	document.frmaddDepartment.txtadd2.value="";
	return false;
	}
	var add=document.frmaddDepartment.txtadd2.value;
	var add1=add.replace(/(\r\n|[\r\n])/g, ", ");
	document.frmaddDepartment.txtadd2.value=add1;
}
function caddchkcountry(addval1)
{
	if(document.frmaddDepartment.txtparty2country.value=="")
	{
		alert("Please enter Consignee Name");
		document.frmaddDepartment.txtadd2country.value="";
	}
	if(addval1.length <= 1)
	{
	alert("Invalid Consignee Address");
	document.frmaddDepartment.txtadd2country.value="";
	return false;
	}
	var add=document.frmaddDepartment.txtadd2country.value;
	var add1=add.replace(/(\r\n|[\r\n])/g, ", ");
	document.frmaddDepartment.txtadd2country.value=add1;
}
function ccitychk(cityval1)
{
	if(document.frmaddDepartment.txtadd2.value=="")
	{
		alert("Please enter Consignee Address");
		document.frmaddDepartment.txtcity2.value="";
	}
	if(cityval1.length <= 1)
	{
	alert("Invalid Consignee City/Town/Village");
	document.frmaddDepartment.txtcity2.value="";
	}
}
function ccitychkcountry(cityval1)
{
	if(document.frmaddDepartment.txtadd2country.value=="")
	{
		alert("Please enter Consignee Address");
		document.frmaddDepartment.txtcity2country.value="";
	}
	if(cityval1.length <= 1)
	{
	alert("Invalid Consignee City/Town");
	document.frmaddDepartment.txtcity2country.value="";
	}
}
function cstatechk()
{
	if(document.frmaddDepartment.txtcity2.value=="")
	{
		alert("Please enter Consignee City/Town/Village");
		document.frmaddDepartment.txtstate2.selectedIndex=0;
	}
}
function cstatechkcountry()
{
	if(document.frmaddDepartment.txtcity2country.value=="")
	{
		alert("Please enter Consignee City/Town");
		document.frmaddDepartment.txtstate2country.value="";
	}
}
function orpbchk(opbval)
{
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please Select Consignee Applicable");
		document.frmaddDepartment.txtorderplby.value="";
	}
	if(opbval.length <= 1)
	{
	alert("Invalid Order Placed By");
	document.frmaddDepartment.txtorderplby.value="";
	}
}
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
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
			}
			else if(opt=="Courier")
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="block";
				document.getElementById('byhand').style.display="none";
				document.frmaddDepartment.txt11.value=opt;
			}	
			else
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="block";
				document.frmaddDepartment.txt11.value=opt;
			}	
		}
		else
		{
			alert("Please Select Mode of Dispatch");
			document.frmaddDepartment.txt11.value="";
		}
	}
	else
	{
		alert("Please  Select Order Placed By");
		var radList = document.getElementsByName('txt1');
		for (var i = 0; i < radList.length; i++) {
		if(radList[i].checked) radList[i].checked = false;}
		document.frmaddDepartment.txt11.value="";
		return false;
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
			if(document.frmaddDepartment.txtvariety.value==itm[i] && opt==itm1[i])
			{
				flg=1;
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
					document.getElementById('selectupst').style.display="block";
					document.frmaddDepartment.txtupschk.value=opt;
					showUser(opt,'selectupst','upschk',crop,variety,'','','');
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
/*function modetchk(classval)
{
	if(document.frmaddDepartment.txt11.value!="")
	{
		showUser(classval,'vitem','item','','','','','');
	}
	else
	{
		alert("Please select any one option of 'Dispatch Mode'");
		document.frmaddDepartment.txtcrop.selectedIndex=0;
	}			
}*/
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

/*
function cropchk()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
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
*/
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
	if(document.frmaddDepartment.txtslflchk.value=="")
	{
		alert("Please select TDF Party Type");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtslflchk.value!="")
	{
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value=="")
		{
			alert("Please Select Party type");
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value!="" && document.frmaddDepartment.txtparty.value=="")
		{
			alert("Please Select Party");
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="fillp")
		{
			if(document.frmaddDepartment.txtparty1.value=="")
			{
				alert("Please specify Party Name");
				document.frmaddDepartment.txtparty1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtadd1.value=="")
			{
				alert("Please specify Party Address ");
				document.frmaddDepartment.txtadd1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtcity1.value=="")
			{
				alert("Please specify Party Location");
				document.frmaddDepartment.txtcity1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtstate1.value=="")
			{
				alert("Please specify Party State");
				document.frmaddDepartment.txtstate1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtpin1.value!="")
			{
				if(document.frmaddDepartment.txtpin1.value.length < 6)
				{
				alert("Pin Code can not less than six digits");
				document.frmaddDepartment.txtpin1.value="";
				fl=1;
				return false;
				}
			}
		}
	}	
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please Select Consignee Applicable");
		document.frmaddDepartment.txtconchk.focus();
		fl=1;
		return false;
	}	
	
if(document.frmaddDepartment.txtconchk.value=="Yes")
{
	if(document.frmaddDepartment.txtpp.value!="Export Buyer")
	{
		if(document.frmaddDepartment.txtparty2.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtparty2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtadd2.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtadd2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtcity2.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcity2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtstate2.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstate2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtpin2.value!="")
		{
			if(document.frmaddDepartment.txtpin2.value.length < 6)
			{
			alert("Pin Code can not less than six digits");
			document.frmaddDepartment.txtpin2.value="";
			fl=1;
			return false;
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.txtparty2country.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtparty2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtadd2country.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtadd2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtcity2country.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcity2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtstate2country.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstate2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtpin2country.value!="")
		{
			if(document.frmaddDepartment.txtpin2country.value.length < 5)
			{
			alert("Pin Code can not less than Five digits");
			document.frmaddDepartment.txtpin2country.value="";
			fl=1;
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
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Dispatch");
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
		}
	}
	else
	{
		alert("Please select Mode of Dispatch");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtupschk.value=="")
	{
		alert("Select UPS Type");
		document.frmaddDepartment.txtupschk.focus();
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.srn.value=="" || document.frmaddDepartment.srn.value==0)
	{
		alert("UPS is not avilable for this Variety");
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
			fl=1;
			return false;
		}
	}
	
	if(fl==1)
	{
	return false;
	}
	else
	{	
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDepartment.bbbb.value=a;
		showUser(a,'postingtable','mform','','','','','');
	}
}

function pformedtup()
{	
  	var fl=0;
	if(document.frmaddDepartment.txtslflchk.value=="")
	{
		alert("Please select TDF Party Type");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtslflchk.value!="")
	{
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value=="")
		{
			alert("Please Select Party type");
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value!="" && document.frmaddDepartment.txtparty.value=="")
		{
			alert("Please Select Party");
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="fillp")
		{
			if(document.frmaddDepartment.txtparty1.value=="")
			{
				alert("Please specify Party Name");
				document.frmaddDepartment.txtparty1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtadd1.value=="")
			{
				alert("Please specify Party Address ");
				document.frmaddDepartment.txtadd1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtcity1.value=="")
			{
				alert("Please specify Party Location");
				document.frmaddDepartment.txtcity1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtstate1.value=="")
			{
				alert("Please specify Party State");
				document.frmaddDepartment.txtstate1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtpin1.value!="")
			{
				if(document.frmaddDepartment.txtpin1.value.length < 6)
				{
				alert("Pin Code can not less than six digits");
				document.frmaddDepartment.txtpin1.value="";
				fl=1;
				return false;
				}
			}
		}
	}	
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please Select Consignee Applicable");
		document.frmaddDepartment.txtconchk.focus();
		fl=1;
		return false;
	}	
	
if(document.frmaddDepartment.txtconchk.value=="Yes")
{
	if(document.frmaddDepartment.txtpp.value!="Export Buyer")
	{
		if(document.frmaddDepartment.txtparty2.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtparty2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtadd2.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtadd2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtcity2.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcity2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtstate2.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstate2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtpin2.value!="")
		{
			if(document.frmaddDepartment.txtpin2.value.length < 6)
			{
			alert("Pin Code can not less than six digits");
			document.frmaddDepartment.txtpin2.value="";
			fl=1;
			return false;
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.txtparty2country.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtparty2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtadd2country.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtadd2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtcity2country.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcity2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtstate2country.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstate2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtpin2country.value!="")
		{
			if(document.frmaddDepartment.txtpin2country.value.length < 5)
			{
			alert("Pin Code can not less than Five digits");
			document.frmaddDepartment.txtpin2country.value="";
			fl=1;
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
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Dispatch");
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
		}
	}
	else
	{
		alert("Please select Mode of Dispatch");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtupschk.value=="")
	{
		alert("Select UPS Type");
		document.frmaddDepartment.txtupschk.focus();
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.srn.value=="" || document.frmaddDepartment.srn.value==0)
	{
		alert("UPS is not avilable for this Variety");
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
			fl=1;
			return false;
		}
	}
	
	if(fl==1)
	{
	return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformsubedt','','','','');
	}
}
function isNumberKey_Nowithdot(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function isNumberKey_OnlyNo(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 32 && charCode != 8 && charCode != 46 && (charCode < 65 || charCode > 90) && (charCode 
< 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
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


function mySubmit()
{ 
var fl=0;
	if(document.frmaddDepartment.txtslflchk.value=="")
	{
		alert("Please select TDF Party Type");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtslflchk.value!="")
	{
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value=="")
		{
			alert("Please Select Party type");
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="selectp" && document.frmaddDepartment.txtptyp.value!="" && document.frmaddDepartment.txtparty.value=="")
		{
			alert("Please Select Party");
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtslflchk.value=="fillp")
		{
			if(document.frmaddDepartment.txtparty1.value=="")
			{
				alert("Please specify Party Name");
				document.frmaddDepartment.txtparty1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtadd1.value=="")
			{
				alert("Please specify Party Address ");
				document.frmaddDepartment.txtadd1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtcity1.value=="")
			{
				alert("Please specify Party Location");
				document.frmaddDepartment.txtcity1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtstate1.value=="")
			{
				alert("Please specify Party State");
				document.frmaddDepartment.txtstate1.focus();
				fl=1;
				return false;
			}
			if(document.frmaddDepartment.txtpin1.value!="")
			{
				if(document.frmaddDepartment.txtpin1.value.length < 6)
				{
				alert("Pin Code can not less than six digits");
				document.frmaddDepartment.txtpin1.value="";
				fl=1;
				return false;
				}
			}
		}
	}	
	if(document.frmaddDepartment.txtconchk.value=="")
	{
		alert("Please Select Consignee Applicable");
		document.frmaddDepartment.txtconchk.focus();
		fl=1;
		return false;
	}	
	
if(document.frmaddDepartment.txtconchk.value=="Yes")
{
	if(document.frmaddDepartment.txtpp.value!="Export Buyer")
	{
		if(document.frmaddDepartment.txtparty2.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtparty2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtadd2.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtadd2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtcity2.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcity2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtstate2.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstate2.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtpin2.value!="")
		{
			if(document.frmaddDepartment.txtpin2.value.length < 6)
			{
			alert("Pin Code can not less than six digits");
			document.frmaddDepartment.txtpin2.value="";
			fl=1;
			return false;
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.txtparty2country.value=="")
		{
			alert("Please specify Consignee's Name");
			document.frmaddDepartment.txtparty2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtadd2country.value=="")
		{
			alert("Please specify Consignee's Address ");
			document.frmaddDepartment.txtadd2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtcity2country.value=="")
		{
			alert("Please specify Consignee's Location");
			document.frmaddDepartment.txtcity2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtstate2country.value=="")
		{
			alert("Please specify Consignee's State");
			document.frmaddDepartment.txtstate2country.focus();
			fl=1;
			return false;
		}
		if(document.frmaddDepartment.txtpin2country.value!="")
		{
			if(document.frmaddDepartment.txtpin2country.value.length < 5)
			{
			alert("Pin Code can not less than Five digits");
			document.frmaddDepartment.txtpin2country.value="";
			fl=1;
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
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Dispatch");
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
		}
	}
	else
	{
		alert("Please select Mode of Dispatch");
		fl=1;
		return false;
	}
	
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	return true;	 
}
function nopchk(val1, val2, val3, val4)
{
val1=Math.round(val1*1000)/1000;
	if(val1>0 && val1<=99999.999)
	{
		if(document.frmaddDepartment.txtupschk.value=="Yes")
		{
			var stdqty=parseFloat(document.getElementById('stdptval_'+[val4]).value);
			if(parseFloat(stdqty) > parseFloat(val1))
			{
				alert("Enter Minimum Quantity:"+stdqty+"\nOR\nEnter valid Quantity which is divisble by standard weight of the selected pack type");
				document.getElementById('txtnopdc_'+[val4]).value="";
				document.getElementById('txtqtydc_'+[val4]).value="";
				return false;
			}
			else
			{
					var ups=0; var nop="";
					if(val3=="Gms")
					{
						ups=1000/parseFloat(val2); 
						nop=parseFloat(ups)* val1;
					}
					else
					{
						ups=parseFloat(val2);
						nop=val1/parseFloat(ups);
					}
					var zz=nop+'';
					var zzz=zz.split(".");
					if(zzz[1] > 0)
					{
						alert("Enter valid Quantity which is divisible by UPS");
						document.getElementById('txtnopdc_'+[val4]).value="";
						document.getElementById('txtqtydc_'+[val4]).value="";
						return false;
					}
					else
					{
						document.getElementById('txtnopdc_'+[val4]).value=nop;
					}
			}
		}
	}
	else
	{
	alert("Quantity cannot be Zero(0) or less and cannot be more than 99999.999");
	document.getElementById('txtnopdc_'+[val4]).value="";
	document.getElementById('txtqtydc_'+[val4]).value="";
	return false;
	}
}

function updmerg(val1, val4)
{
	if(val1!="")
	{
		if(document.getElementById('txtupdc_'+[val4]).value!="")
		{
			document.getElementById('txtupsdc_'+[val4]).value=document.getElementById('txtupdc_'+[val4]).value+" "+document.getElementById('upssizetyp_'+[val4]).value;
		}
		else
		{
			document.getElementById('txtupsdc_'+[val4]).value="";
		}
	}
	else
	{
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
		var nzzz=Math.round(nop*100)/100;
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
				var nzzz=Math.round(tt*100)/100;
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Order - Trial/Demo/Free</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
<?php 
$tid=$pid;
 
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and logid='".$logid."' and order_trtype='Order TDF' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];
$ordm_id=$row_tbl['orderm_id'];
	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	$subtid=0;
	
?>	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
	 	<input name="txt11" value="<?php echo $row_tbl['orderm_tmode'];?>" type="hidden"> 
	    <input type="hidden" name="txtid" value="<?php echo $row_tbl['orderm_code']?>" />
		<input type="hidden" name="logid" value="<?php echo "TOD".$row_tbl['orderm_code']."/".$ycode."/".$lgnid;?>" />
		<input type="hidden" name="txtslflchk" value="<?php echo $row_tbl['orderm_partyselect'];?>" />
		<input type="hidden" name="txtptyp" value="<?php echo $row_tbl['orderm_party_type'];?>" />
		<input type="hidden" name="txtconchk" value="<?php echo $row_tbl['orderm_consigneeapp'];?>" />
		<input type="hidden" name="txtptype" value="<?php echo $row_tbl['orderm_party_type'];?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit - Order-Trial/Demo/Free</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="200" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="261"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txttranid" type="text" size="16" class="tbltext" tabindex=""  readonly="true"   maxlength="16"  value="<?php echo "TOD".$row_tbl['orderm_code']."/".$ycode."/".$lgnid;?>" style="background-color:#CCCCCC" />&nbsp;</td>

<td width="169" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="210" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Order No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtordno" type="text" size="16" class="tbltext" tabindex="" readonly="true" maxlength="16"  value="<?php echo $row_tbl['orderm_porderno'];?>" style="background-color:#CCCCCC" />&nbsp;&nbsp;&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Party Order Ref. No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtporf" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" value="<?php echo $row_tbl['orderm_partyrefno'];?>"  />&nbsp;</td>
           </tr>
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
		<tr class="Dark" height="25">
<td width="201" align="right"  valign="middle" class="tblheading">&nbsp;Party&nbsp;</td>
   <td width="643" colspan="3" align="left"  valign="middle" >&nbsp;<input name="txtpt" type="radio" class="tbltext" value="selectp" onClick="clkparty(this.value);" <?php if($row_tbl['orderm_partyselect']=="selectp"){ echo "Checked";} ?> />
   &nbsp;Select From Master&nbsp;&nbsp;
   <input name="txtpt" type="radio" class="tbltext" value="fillp" onClick="clkparty(this.value);" <?php if($row_tbl['orderm_partyselect']=="fillp"){ echo "Checked";} ?>  />&nbsp;Fill&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<div id="select2" style="display:<?php if($row_tbl['orderm_partyselect']=="selectp"){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
$sql_month111=mysqli_query($link,"select * from tblclassification where plantcode='$plantcode' and classification='".$row_tbl['orderm_party_type']."' order by classification")or die(mysqli_error($link));
$t111=mysqli_fetch_array($sql_month111);
$main=$t111['main'];
?>
<tr class="Light" height="25">
 <td width="201" align="right"  valign="middle" class="tblheading">&nbsp;Select&nbsp;</td>
  <td width="643" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtptselect" type="radio" class="tbltext" value="Channel" onClick="clkpartytyp(this.value);" <?php if($main=="Channel"){ echo "Checked";} ?> />&nbsp;Channel&nbsp;&nbsp;<input name="txtptselect" type="radio" class="tbltext" value="Stock Transfer" onClick="clkpartytyp(this.value);" <?php if($main=="Stock Transfer"){ echo "Checked";} ?> />&nbsp;Stock Transfer&nbsp;&nbsp;<input name="txtptselect" type="radio" class="tbltext" value="TDF - Individual" onClick="clkpartytyp(this.value);" <?php if($row_tbl['orderm_party_type']=="TDF - Individual"){ echo "Checked";} ?> />&nbsp;Individual-TDF&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<div id="selectpartytype"style="display:<?php if($row_tbl['orderm_partyselect']=="selectp"){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
$sql_month=mysqli_query($link,"select * from tblclassification where plantcode='$plantcode' and main='".$main."'  order by classification")or die(mysqli_error($link));
$t=mysqli_num_rows($sql_month);
?>
<tr class="Dark" height="30">
<td width="202" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
<?php if($row_tbl['orderm_party_type']!="TDF - Individual"){ while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia['classification']==$row_tbl['orderm_party_type']){ echo "Selected";} ?>  value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } } else {?>
		<option value="TDF - Individual" selected="selected" >TDF - Individual </option><?php } ?> 
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>
</div>	
<div id="selectpartylocation"style="display:<?php if($row_tbl['orderm_partyselect']=="selectp"){ echo "block";} else { echo "none"; }?>" >	
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
<td width="202" align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
<option value="">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($row_tbl['orderm_locstate']==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['orderm_locstate']."' order by productionlocation")or die(mysqli_error($link));
?>	
	<td align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
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
<td width="202"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtcountrysl" style="width:220px;" onchange="loccontrychk(this.value)">
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
<div id="selectparty" style="display:<?php if($row_tbl['orderm_partyselect']=="selectp" && $row_tbl['orderm_party_type']!=""){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where state='".$row_tbl['orderm_locstate']."' and classification='".$row_tbl['orderm_party_type']."' order by business_name")or die(mysqli_error($link));
}
else
{ 
$sql_month33=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['orderm_country']."' order by country")or die(mysqli_error($link));
$row_month33=mysqli_fetch_array($sql_month33); 

$sql_month24=mysqli_query($link,"select * from tbl_partymaser where country='".$row_month33['c_id']."' and classification='".$row_tbl['orderm_party_type']."' order by business_name")or die(mysqli_error($link));
}
//echo $row_tbl['orderm_party_type'];
//echo $t=mysqli_num_rows($sql_month24);
?>
 <tr class="Dark" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia24 = mysqli_fetch_array($sql_month24)) { //echo $noticia24['p_id'];?>
		<option <?php if($noticia24['p_id']==$row_tbl['orderm_party']){ echo "Selected";} ?> value="<?php echo $noticia24['p_id'];?>" />   
		<?php echo $noticia24['business_name'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="643" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress"> <div style="padding-left:3px;"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?><input type="hidden" name="adddchk" value="" /></div>  </td>
</tr>
</table>
</div>
</div> 
<div id="fill2" style="display:<?php if($row_tbl['orderm_partyselect']=="fillp"){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse"   > 
<tr class="Light" height="25">
           <td width="199"  align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
           <td align="left"  valign="middle" colspan="6" >&nbsp;<input name="txtparty1" type="text" size="35" class="tbltext" tabindex="" maxlength="35" onchange="pnamechk(this.value);" value="<?php echo $row_tbl['orderm_partyname'];?>"  onBlur="javascript:this.value=FirstCharCap(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
 <tr class="Dark" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<textarea name="txtadd1" cols="50" rows="3" tabindex=""  class="tbltext" onchange="paddchk(this.value);" onBlur="javascript:this.value=FirstCharCap(this.value);"><?php echo $row_tbl['orderm_partyaddress'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;City/Town/Village&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input type="text" class="tbltext" name="txtcity1" size="20" maxlength="20" onchange="pcitychk(this.value);" onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" value="<?php echo $row_tbl['orderm_partycity'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;Pin Code&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="4">&nbsp;<input type="text" class="tbltext" name="txtpin1" size="6" maxlength="6" onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_partypin'];?>" >&nbsp;</td>
</tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select name="txtstate1" class="tbltext"  style="width:170px;" tabindex="" onchange="pstatechk();">
          <option value="">--Select State--</option>
		  <?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($row_tbl['orderm_partystate']==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30"  >
   <td align="right" width="201" valign="middle" class="tblheading" >&nbsp;Phone No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="pstd1" type="text" size="5" class="tbltext" tabindex="7" maxlength="5" onkeypress="return isNumberKey_OnlyNo(event)"  value="<?php echo $row_tbl['orderm_partyphstd'];?>"/>&nbsp;&nbsp;<input name="pphno1" type="text" size="15" class="tbltext" tabindex="" maxlength="12"  onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_partyphno'];?>" />&nbsp;STD | Phone</td>
  </tr>
<tr class="Light" height="25">
          <td width="201"  align="right"  valign="middle" class="tblheading" >Mobile&nbsp;No.&nbsp;</td>
           <td colspan="5" align="left"  valign="middle" >&nbsp;<input name="txtcontact1" type="text" size="16" class="tbltext" tabindex="0" maxlength="15"  onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_partymobile'];?>" />&nbsp;</td>
		   </tr>
		   <tr class="Dark" height="30">
<td align="right" width="201" valign="middle" class="tblheading" >TIN&nbsp;</td>
<td width="218" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttin" type="text" size="16" class="tbltext" tabindex=""   maxlength="15" value="<?php echo $row_tbl['orderm_partytin'];?>"  />&nbsp;&nbsp;</td>

<td align="right" width="205" valign="middle" class="tblheading">PAN&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtpan" type="text" size="16" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['orderm_partypan'];?>" >&nbsp;&nbsp;</td>
</tr>
</table>
</div>
 <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="25">
 <td width="201"  align="right"  valign="middle" class="tblheading">&nbsp;Consignee Applicable&nbsp;</td>
  <td width="643" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="contxt" type="radio" class="tbltext" value="Yes1" onClick="clkp(this.value);" <?php if($row_tbl['orderm_consigneeapp']=="Yes1"){ echo "Checked";} ?> />&nbsp;Yes&nbsp;&nbsp;<input name="contxt" type="radio" class="tbltext" value="No1" onClick="clkp(this.value);" <?php if($row_tbl['orderm_consigneeapp']=="No1"){ echo "Checked";} ?>  />&nbsp;No&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table> 
<div id="fill22" style="display:<?php if($row_tbl['orderm_consigneeapp']=="Yes1" && $row_tbl['orderm_party_type']!="Export Buyer"){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse"   > 
<tr class="Dark" height="25">
           <td width="201"  align="right"  valign="middle" class="tblheading" >Consignee Name&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" >&nbsp;<input name="txtparty2" type="text" size="35" class="tbltext" tabindex="" maxlength="35" onchange="cnamechk(this.value);" value="<?php echo $row_tbl['orderm_consigneename'];?>"  onBlur="javascript:this.value=FirstCharCap(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
 <tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<textarea name="txtadd2" cols="50" rows="3" tabindex=""  onchange="caddchk(this.value);" onBlur="javascript:this.value=FirstCharCap(this.value);"  class="tbltext"><?php echo $row_tbl['orderm_conadd'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;City/Town/Village&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="4">&nbsp;<input type="text" class="tbltext" name="txtcity2" size="20" maxlength="20" onchange="ccitychk(this.value);" onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" value="<?php echo $row_tbl['orderm_concity'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;Pin Code&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input type="text" class="tbltext" name="txtpin2" size="6" maxlength="6" onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_conpin'];?>" >&nbsp;</td>
</tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select name="txtstate2" class="tbltext"  style="width:170px;" tabindex=""  onchange="cstatechk();">
          <option value="">--Select State--</option>
		  <?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($row_tbl['orderm_constate']==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30"  >
   <td align="right" width="201" valign="middle" class="tblheading" >&nbsp;Phone No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="pstd2" type="text" size="5" class="tbltext" tabindex="7" maxlength="5" onkeypress="return isNumberKey_OnlyNo(event)"  value="<?php echo $row_tbl['orderm_conphonestd'];?>"/>&nbsp;&nbsp;<input name="pphno2" type="text" size="15" class="tbltext" tabindex="" maxlength="12"  onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_conphoneno'];?>"  />&nbsp;STD | Phone</td>
  </tr>
<tr class="Light" height="25">
          <td width="201"  align="right"  valign="middle" class="tblheading" >Mobile&nbsp;No.&nbsp;</td>
           <td colspan="5" align="left"  valign="middle" >&nbsp;<input name="txtcontact2" type="text" size="16" class="tbltext" tabindex="0" maxlength="15"  onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_conmobile'];?>" />&nbsp;</td>
		   </tr>
		   <tr class="Dark" height="30">
<td align="right" width="201" valign="middle" class="tblheading" >TIN&nbsp;</td>
<td width="218" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttin2" type="text" size="16" class="tbltext" tabindex=""   maxlength="15" value="<?php echo $row_tbl['orderm_contin'];?>" />&nbsp;&nbsp;</td>

<td align="right" width="205" valign="middle" class="tblheading" >PAN&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtpan2" type="text" size="16" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['orderm_conpan'];?>"  >&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<div id="fill22country" style="display:<?php if($row_tbl['orderm_consigneeapp']=="Yes1" && $row_tbl['orderm_party_type']=="Export Buyer"){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse"   > 
<tr class="Dark" height="25">
           <td width="201"  align="right"  valign="middle" class="tblheading" >Consignee Name&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" >&nbsp;<input name="txtparty2country" type="text" size="35" class="tbltext" tabindex="" maxlength="35" onchange="cnamechkcountry(this.value);" value="<?php echo $row_tbl['orderm_consigneename'];?>"  onBlur="javascript:this.value=FirstCharCap(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
 <tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<textarea name="txtadd2country" cols="50" rows="3" tabindex=""  onchange="caddchkcountry(this.value);" onBlur="javascript:this.value=FirstCharCap(this.value);"  class="tbltext"><?php echo $row_tbl['orderm_conadd'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;City/Town&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="4">&nbsp;<input type="text" class="tbltext" name="txtcity2country" size="20" maxlength="20" onchange="ccitychkcountry(this.value);" onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" value="<?php echo $row_tbl['orderm_concity'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;Zip&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input type="text" class="tbltext" name="txtpin2country" size="6" maxlength="6" onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_conpin'];?>" >&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="201" align="right"  valign="middle" class="tblheading" >&nbsp;State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtstate2country" size="20" maxlength="20" onchange="cstatechkcountry(this.value);" onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" value="<?php echo $row_tbl['orderm_constate'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtcountry1" type="text" size="16" class="tbltext" tabindex=""  value="<?php echo $row_tbl['orderm_country'];?>"  maxlength="15" />
	&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30"  >
   <td align="right" width="201" valign="middle" class="tblheading" >&nbsp;Phone No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="pstd2country" type="text" size="5" class="tbltext" tabindex="7" maxlength="5" onkeypress="return isNumberKey_OnlyNo(event)"  value="<?php echo $row_tbl['orderm_conphonestd'];?>"/>&nbsp;&nbsp;<input name="pphno2country" type="text" size="15" class="tbltext" tabindex="" maxlength="12"  onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_conphoneno'];?>"  />&nbsp;STD | Phone</td>
  </tr>
<tr class="Light" height="25">
          <td width="201"  align="right"  valign="middle" class="tblheading" >Mobile&nbsp;No.&nbsp;</td>
           <td colspan="5" align="left"  valign="middle" >&nbsp;<input name="txtcontact2country" type="text" size="16" class="tbltext" tabindex="0" maxlength="15"  onkeypress="return isNumberKey_OnlyNo(event)" value="<?php echo $row_tbl['orderm_conmobile'];?>" />&nbsp;</td>
		   </tr>
		   <tr class="Dark" height="30">
<td align="right" width="201" valign="middle" class="tblheading" >UDF 1&nbsp;</td>
<td width="218" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttin2country" type="text" size="16" class="tbltext" tabindex=""   maxlength="15" value="<?php echo $row_tbl['orderm_contin'];?>" />&nbsp;&nbsp;</td>

<td align="right" width="205" valign="middle" class="tblheading" >UDF 2&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtpan2country" type="text" size="16" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['orderm_conpan'];?>"  >&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="201" valign="middle" class="tblheading" >Order Placed By&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtorderplby" type="text" size="20" class="tbltext" tabindex="" onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" maxlength="20" onchange="orpbchk(this.value);" value="<?php echo $row_tbl['orderm_placedby'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
<td width="201" align="right"  valign="middle" class="tblheading">&nbsp;Mode of Dispatch&nbsp;</td>
 <td width="643" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['orderm_tmode']=="Transport"){ echo "Checked";} ?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['orderm_tmode']=="Courier"){ echo "Checked";} ?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['orderm_tmode']=="By Hand"){ echo "Checked";} ?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="trans" style="display:<?php if($row_tbl['orderm_tmode']=="Transport"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="201" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Transport Name&nbsp;</td>
<td width="643" align="left"  valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txttname" type="text" size="35" class="tbltext" tabindex="" maxlength="35" value="<?php echo $row_tbl['orderm_trname'];?>" onBlur="javascript:this.value=FirstCharCap(this.value);"  />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['orderm_tmode']=="Courier"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="201" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="643" valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txtcname" type="text" size="35" class="tbltext" tabindex="" value="<?php echo $row_tbl['orderm_cname'];?>"  maxlength="35"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<div id="byhand" style="display:<?php if($row_tbl['orderm_tmode']=="By Hand"){ echo "block";} else { echo "none"; }?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="201" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Name of Person&nbsp;</td>
<td width="643" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txtpname" type="text" size="35" class="tbltext" tabindex=""  maxlength="35" value="<?php echo $row_tbl['orderm_pname'];?>" onkeypress="return isCharKey(event)" onBlur="javascript:this.value=FirstCharCap(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="17%" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
        <td width="6%" align="center" valign="middle" class="tblheading">Variety Type</td>
        <td width="20%" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
		<td width="4%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="8%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="9%" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="4%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="3%" align="center" valign="middle" class="tblheading">Edit</td>
        <td width="8%" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1="";
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
		
$up=""; $up1=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $zz="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

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
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="17%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="20%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="4%" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="8%" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
        <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order TDF');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="17%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="20%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="4%" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="8%" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
        <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['order_sub_id'];?>,<?php echo $ordm_id;?>);" /></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $ordm_id?>,<?php echo $row_tbl_sub['order_sub_id'];?>,'Order TDF');" /></td>
</tr>
<?php
}
$srno++;
}
}
?>
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
<div id="selectupst" style="display:none"> </div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl['remarks'];?>" ></td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_trial.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  