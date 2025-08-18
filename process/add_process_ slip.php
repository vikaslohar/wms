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
		//exit;
		
	    $p_id=trim($_POST['maintrid']);
		
		echo "<script>window.location='add_proslip_preview.php?p_id=$p_id'</script>";	
			
	}

//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(proslipmain_code) FROM tbl_proslipmain where yearid='$yearid_id' and plantcode='$plantcode' ORDER BY proslipmain_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TPS".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TPS".$code."/".$yearid_id."/".$lgnid;
		}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Process- Transaction - Processing slip</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
</head>
<script src="proslip.js"></script>
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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  
function qtychk1(qtyval1,srno)
{
		var sbin="txtbalnobp"+srno;
		var nob="txtextnob"+srno;
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}	
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("NoB entered for Processing can be Equal to or Less than Existing NoB in Bin");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1);
	}
}

function Bagschk1(qtyval1,srno)
{
	var actnob="recnobp"+srno;
	var sbin="txtbalqtyp"+srno;
	var nob="txtextqty"+srno;
	if(document.getElementById(actnob).value=="")
	{
		alert("Please enter NoB");
		var actqty="recqtyp"+srno;
		document.getElementById(actqty).value="";
		return false;
	}
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("Qty entered for Processing can be Equal to or Less than Existing Qty in Bin");
		var actnob="recqtyp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1);
	}
}

function pform()
{	
var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="P")
	{
		if(document.frmaddDepartment.srno2.value==2)
		{
			if(document.frmaddDepartment.recqtyp1.value=="" && document.frmaddDepartment.recqtyp2.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.recqtyp1.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Please enter Condition Seed NoB");
		document.frmaddDepartment.txtconnob.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Please enter Condition Seed Qty");
		document.frmaddDepartment.txtconqty.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Please enter Remnant (RM)");
		document.frmaddDepartment.txtconrem.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Please enter Inert Material (IM)");
		document.frmaddDepartment.txtconim.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Please enter Processing Loss (PL)");
		document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please SLOC for Condition Seed");
		//document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}	
	else
	{	
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDepartment.txtconslqty1.value;
		if(document.frmaddDepartment.srno2.value==2)
		{
		q2=document.frmaddDepartment.txtconslqty2.value;
		}
		g=document.frmaddDepartment.txtconqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in Condition Seed is not matching with Quantity distributed in Bins");
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
			showUser(a,'postingtable','mform','','','','','');
		//showUser(a,'postingsubtable','mform','','','','','');
		
		}  
	}
}

function pformedtup()
{	
var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="P")
	{
		if(document.frmaddDepartment.srno2.value==2)
		{
			if(document.frmaddDepartment.recqtyp1.value=="" && document.frmaddDepartment.recqtyp2.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.recqtyp1.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Please enter Condition Seed NoB");
		document.frmaddDepartment.txtconnob.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Please enter Condition Seed Qty");
		document.frmaddDepartment.txtconqty.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Please enter Remnant (RM)");
		document.frmaddDepartment.txtconrem.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Please enter Inert Material (IM)");
		document.frmaddDepartment.txtconim.focus();
		f=1;
		return false;
	}	
	else if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Please enter Processing Loss (PL)");
		document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please SLOC for Condition Seed");
		//document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}		
	else
	{	
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDepartment.txtconslqty1.value;
		if(document.frmaddDepartment.srno2.value==2)
		{
		q2=document.frmaddDepartment.txtconslqty2.value;
		}
		g=document.frmaddDepartment.txtconqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in Condition Seed is not matching with Quantity distributed in Bins");
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
		showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}


function modetchk(classval)
{
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		 alert("Please Select Processing Slip Reference Number");
		 document.frmaddDepartment.txtpsrn.focus();
		  document.frmaddDepartment.txtcrop.selectedIndex=0;
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		showUser(classval,'vitem','item','','','','','');
	}
}

function modetchk1()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		 alert("Please Select Crop");
		 document.frmaddDepartment.txtvariety.selectedIndex=0;
		 document.frmaddDepartment.txtcrop.focus();
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
	}
}

function openslocpop()
{
if(document.frmaddDepartment.txtoprname.value=="")
{
 alert("Please Select Operator Name");
 return false;
}
else if(document.frmaddDepartment.txttreattyp.value=="")
{
 alert("Please Select Treatment Schema");
 return false;
}
else
{
document.getElementById("postingsubsubtable").innerHTML="";
document.frmaddDepartment.txtlot1.value="";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var stage=document.frmaddDepartment.txtstage.value;
var tid=document.frmaddDepartment.maintrid.value;
//alert(variety);
winHandle=window.open('getuser_proslip_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}


function openslocpop1()
{
if(document.frmaddDepartment.qc.value=="")
{
 alert("Please Select QC.");
 //document.frmaddDepartment.txt1.focus();
}
else
{
var itm=document.frmaddDepartment.sstatus.value;
winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

}


function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
}


function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','1','','','');
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
		showUser(bin2val,'sbing2','bin','txtslsubbg2','2','','','');
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
	{	//alert("subbin");
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtconslnob1.value!="")
		var Bagsv1=document.frmaddDepartment.txtconslnob1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtconslqty1.value!="")
		var qtyv1=document.frmaddDepartment.txtconslqty1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid);
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
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb2').selectedIndex=0;
		document.frmaddDepartment.txtslbing2.focus();
		}
		
		if(document.frmaddDepartment.txtslsubbg1.value!="")
		
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtconslnob2.value!="")
		var Bagsv2=document.frmaddDepartment.txtconslnob2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtconslqty2.value!="")
		var qtyv2=document.frmaddDepartment.txtconslqty2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function qtyf1(qtyval, sval)
{
	var sbbin="txtconslnob"+sval;
	var nobb="txtconslqty"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please Enter NoB");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("Qty can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}
function Bagsf1(Bags1val, sval)
{
	var sbbin="sb"+sval;
	var nobb="txtconslnob"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("NoB can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}




function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}
function getdetails(stage)
{
/*if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
if(document.frmaddDepartment.txt1.value=="")
	{
 alert("Please Select Mode Of Transit.");
 document.frmaddDepartment.txt1.focus();
}*/

var get=document.frmaddDepartment.txtlot1.value;
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var stage=document.frmaddDepartment.txtstage.value;

if(document.frmaddDepartment.txtlot1.value=="")
				{
					alert("Please enter Lot No.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
			if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
			if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(document.frmaddDepartment.txtlot1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDepartment.txtlot1.focus();
				return false;
				}
				/*else{
				alert(" Please Enter Corret Lot No.");
				}*/
		var crop=document.frmaddDepartment.txtcrop.value;
        var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
		var dsrn="";
		var stage=document.frmaddDepartment.txtstage.value;
		//alert(tid);
		//alert(lotid);
		
		//document.getElementById("postingsubtable").style.display="block";
		showUser(get,'postingsubsubtable','get',crop,variety,tid,lotid,dsrn,stage);
				//showUser(get,'postingsubtable','get',crop,variety,stage,'','');
}
function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','','');
	}
	else
	{
		return false;
	}
}


function mySubmit()
{ 
/*if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)!=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Pleasse Check Number of Lots and Number of Lots posted Mismatch.");
		//document.frmaddDepartment.txtlot1.focus();
		return false;
	}

	 if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Select Party.");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}		
	else if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}		

	else if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}		
else if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode Of Transit.");
		document.frmaddDepartment.txt11.focus();
		return false;
	}	
	else if(document.frmaddDepartment.txtvv.value=="")
	{
		alert("Please Enter Vendor Variety.");
		document.frmaddDepartment.txtvv.focus();
		return false;
	}		
	else if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("PleaseSelect No. Of Lots.");
		document.frmaddDepartment.txtlot2.focus();
		return false;
	}		
		/*else if(document.frmaddDepartment.txtdcnob.value=="")
	{
		alert("Please enter No. Of Bags");
		document.frmaddDepartment.txtdcnob.focus();
		return false;
	}	*/
	
	/*if(document.frmaddDepartment.txt11.value!="")
	{
		if(document.frmaddDepartment.txt11.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Please enter Transport Name");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
						
			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please enter Vehicle No");
			document.frmaddDepartment.txtvn.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
			{
			alert("Vehicle No cannot start with space.");
			document.frmaddDepartment.txtvn.focus();
			return false;
			}
			if(document.frmaddDepartment.txt14.value=="")
			{
			alert("Please select Payment Mode");
			return false;
			}
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
			alert("Please enter Courier Name");
			document.frmaddDepartment.txtcname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDepartment.txtcname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value=="")
			{
			alert("Please enter Docket No.");
			document.frmaddDepartment.txtdc.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
			{
			alert("Docket No. cannot start with space.");
			document.frmaddDepartment.txtdc.focus();
			return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
			alert("Please enter Person Name");
			document.frmaddDepartment.txtpname.focus();
			return false;
			}	
		}
	}
	else
	{
		alert("Please select Mode of Transit");
		return false;
	}
	*/
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;	 
}

function prochktyp(protypval)
{
	document.frmaddDepartment.protype.value=protypval;
	if(protypval!="")
	{
		if(protypval=="E")
		{
			document.getElementById('recnobp1').value=document.frmaddDepartment.txtextnob1.value;
			document.getElementById('recnobp1').readOnly=true;
			document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalnobp1').value=0;
			document.getElementById('recqtyp1').value=document.frmaddDepartment.txtextqty1.value;
			document.getElementById('recqtyp1').readOnly=true;
			document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp1').value=0;
			if (document.frmaddDepartment.srno2.value==2)
			{
			document.getElementById('recnobp2').value=document.frmaddDepartment.txtextnob2.value;
			document.getElementById('recnobp2').readOnly=true;
			document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalnobp2').value=0;
			document.getElementById('recqtyp2').value=document.frmaddDepartment.txtextqty2.value;
			document.getElementById('recqtyp2').readOnly=true;
			document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp2').value=0;
			}
			
			document.frmaddDepartment.txtconnob.value="";
			document.frmaddDepartment.txtconqty.value="";
			document.frmaddDepartment.txtconrem.value="";
			document.frmaddDepartment.txtconim.value="";
			document.frmaddDepartment.txtconpl.value="";
			document.frmaddDepartment.txtconloss.value="";
			document.frmaddDepartment.txtconper.value="";
			
			document.frmaddDepartment.txtslwhg1.value="";
			document.frmaddDepartment.txtslbing1.value="";
			document.frmaddDepartment.txtslsubbg1.value="";
			document.frmaddDepartment.txtconslnob1.value="";
			document.frmaddDepartment.txtconslqty1.value="";
			
			document.frmaddDepartment.txtslwhg2.value="";
			document.frmaddDepartment.txtslbing2.value="";
			document.frmaddDepartment.txtslsubbg2.value="";
			document.frmaddDepartment.txtconslnob2.value="";
			document.frmaddDepartment.txtconslqty2.value="";
			
		}
		else if(protypval=="P")
		{
			document.getElementById('recnobp1').value="";
			document.getElementById('recnobp1').readOnly=false;
			document.getElementById('recnobp1').style.backgroundColor="#FFFFFF";
			document.getElementById('txtbalnobp1').value="";
			document.getElementById('recqtyp1').value="";
			document.getElementById('recqtyp1').readOnly=false;
			document.getElementById('recqtyp1').style.backgroundColor="#FFFFFF";
			document.getElementById('txtbalqtyp1').value="";
			if (document.frmaddDepartment.srno2.value==2)
			{
			document.getElementById('recnobp2').value="";
			document.getElementById('recnobp2').readOnly=false;
			document.getElementById('recnobp2').style.backgroundColor="#FFFFFF";
			document.getElementById('txtbalnobp2').value="";
			document.getElementById('recqtyp2').value="";
			document.getElementById('recqtyp2').readOnly=false;
			document.getElementById('recqtyp2').style.backgroundColor="#FFFFFF";
			document.getElementById('txtbalqtyp2').value="";
			}
			document.frmaddDepartment.txtconnob.value="";
			document.frmaddDepartment.txtconqty.value="";
			document.frmaddDepartment.txtconrem.value="";
			document.frmaddDepartment.txtconim.value="";
			document.frmaddDepartment.txtconpl.value="";
			document.frmaddDepartment.txtconloss.value="";
			document.frmaddDepartment.txtconper.value="";
			
			document.frmaddDepartment.txtslwhg1.value="";
			document.frmaddDepartment.txtslbing1.value="";
			document.frmaddDepartment.txtslsubbg1.value="";
			document.frmaddDepartment.txtconslnob1.value="";
			document.frmaddDepartment.txtconslqty1.value="";
			
			document.frmaddDepartment.txtslwhg2.value="";
			document.frmaddDepartment.txtslbing2.value="";
			document.frmaddDepartment.txtslsubbg2.value="";
			document.frmaddDepartment.txtconslnob2.value="";
			document.frmaddDepartment.txtconslqty2.value="";
		}
		else
		{
			document.getElementById('recnobp1').value="";
			document.getElementById('recnobp1').readOnly=true;
			document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalnobp1').value="";
			document.getElementById('recqtyp1').value="";
			document.getElementById('recqtyp1').readOnly=true;
			document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp1').value="";
			if (document.frmaddDepartment.srno2.value==2)
			{
			document.getElementById('recnobp2').value="";
			document.getElementById('recnobp2').readOnly=true;
			document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalnobp2').value="";
			document.getElementById('recqtyp2').value="";
			document.getElementById('recqtyp2').readOnly=true;
			document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp2').value="";
			}
			document.frmaddDepartment.txtconnob.value="";
			document.frmaddDepartment.txtconqty.value="";
			document.frmaddDepartment.txtconrem.value="";
			document.frmaddDepartment.txtconim.value="";
			document.frmaddDepartment.txtconpl.value="";
			document.frmaddDepartment.txtconloss.value="";
			document.frmaddDepartment.txtconper.value="";
			
			document.frmaddDepartment.txtslwhg1.value="";
			document.frmaddDepartment.txtslbing1.value="";
			document.frmaddDepartment.txtslsubbg1.value="";
			document.frmaddDepartment.txtconslnob1.value="";
			document.frmaddDepartment.txtconslqty1.value="";
			
			document.frmaddDepartment.txtslwhg2.value="";
			document.frmaddDepartment.txtslbing2.value="";
			document.frmaddDepartment.txtslsubbg2.value="";
			document.frmaddDepartment.txtconslnob2.value="";
			document.frmaddDepartment.txtconslqty2.value="";
		}
	}
	else
	{
			document.getElementById('recnobp1').value="";
			document.getElementById('recnobp1').readOnly=true;
			document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalnobp1').value="";
			document.getElementById('recqtyp1').value="";
			document.getElementById('recqtyp1').readOnly=true;
			document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp1').value="";
			if (document.frmaddDepartment.srno2.value==2)
			{
			document.getElementById('recnobp2').value="";
			document.getElementById('recnobp2').readOnly=true;
			document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalnobp2').value="";
			document.getElementById('recqtyp2').value="";
			document.getElementById('recqtyp2').readOnly=true;
			document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp2').value="";
			}
			document.frmaddDepartment.txtconnob.value="";
			document.frmaddDepartment.txtconqty.value="";
			document.frmaddDepartment.txtconrem.value="";
			document.frmaddDepartment.txtconim.value="";
			document.frmaddDepartment.txtconpl.value="";
			document.frmaddDepartment.txtconloss.value="";
			document.frmaddDepartment.txtconper.value="";
			
			document.frmaddDepartment.txtslwhg1.value="";
			document.frmaddDepartment.txtslbing1.value="";
			document.frmaddDepartment.txtslsubbg1.value="";
			document.frmaddDepartment.txtconslnob1.value="";
			document.frmaddDepartment.txtconslqty1.value="";
			
			document.frmaddDepartment.txtslwhg2.value="";
			document.frmaddDepartment.txtslbing2.value="";
			document.frmaddDepartment.txtslsubbg2.value="";
			document.frmaddDepartment.txtconslnob2.value="";
			document.frmaddDepartment.txtconslqty2.value="";
	}
}

function chkpronob()
{
	if(document.frmaddDepartment.srno2.value==2)
	{
		if(document.getElementById('recqtyp1').value=="" && document.getElementById('recqtyp2').value=="")
		{
			alert("Enter Processing Qty");
			return false;
		}
	}
	else
	{
		if(document.getElementById('recqtyp1').value=="")
		{
			alert("Enter Processing Qty");
			return false;
		}
	}
}

function chkproqty()
{
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Enter Condition Seed NoB");
		document.frmaddDepartment.txtconqty.value="";
		return false;
	}
}
function chkconqty()
{
	var abc=0;
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Enter Condition Seed Qty");
		document.frmaddDepartment.txtconrem.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	if(document.frmaddDepartment.srno2.value==2)
	{
		abc=parseFloat(document.getElementById('recqtyp1').value)+ parseFloat(document.getElementById('recqtyp2').value);
	}
	else
	{
		abc=parseFloat(document.getElementById('recqtyp1').value);
	}	
	if(parseFloat(document.frmaddDepartment.txtconqty.value)> abc)
	{
		alert("Condition Seed Qty cannot be more than Total Quantity picked for Processing");
		document.frmaddDepartment.txtconrem.value="";
		return false;
	}
}
function chkrm()
{
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Enter Remnant (RM)");
		document.frmaddDepartment.txtconim.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
}

function chkim(plval)
{
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Enter Inert Material (IM)");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	var tpl=parseFloat(document.frmaddDepartment.txtconrem.value)+parseFloat(document.frmaddDepartment.txtconim.value)+parseFloat(plval);
	var plper=parseFloat(document.getElementById('recqtyp1').value);
	if(document.frmaddDepartment.srno2.value==2)
	{
		plper=parseFloat(plper)+parseFloat(document.getElementById('recqtyp2').value);
	}
	
	//alert(tpl);
	//alert(document.frmaddDepartment.txtconqty.value);
	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.txtconqty.value);
	//alert((Math.round(totalval*1000)/1000));
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not eual to sum total of Condition Seed & Total Condition Loss");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconpl.focus();
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	document.frmaddDepartment.txtconloss.value=tpl;
	var vaal=parseFloat(document.frmaddDepartment.txtconloss.value)/parseFloat(plper)*100;
	document.frmaddDepartment.txtconper.value=Math.round((vaal)*100)/100;
	}
	}
}

function sschk1()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtstage.selectedIndex=0;
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
	}
}

function sschk2()
{
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Select Stage");
		document.frmaddDepartment.txtpromech.selectedIndex=0;
		document.frmaddDepartment.txtstage.focus();
		return false;
	}
}

function sschk3()
{
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Select Processing Machine Code");
		document.frmaddDepartment.txtoprname.selectedIndex=0;
		document.frmaddDepartment.txtpromech.focus();
		return false;
	}
}

function sschk4()
{
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Select Operator");
		document.frmaddDepartment.txttreattyp.selectedIndex=0;
		document.frmaddDepartment.txtoprname.focus();
		return false;
	}
}

/*function vendorchk1()
{
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Select Treat Schema");
		return false;
	}
}*/

function openprintsubbin(subid, bid, wid, lid)
{
var itm="";
var tp="";
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

</script>


<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_process.php");?></td>
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
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Processing slip&nbsp;<input type="hidden" name="logid" value="<?php echo $logid?>" /></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
		 
		</br>
<?php
$tid=0; $subtid=0;
?>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Processing Slip </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="134" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="144"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code1?></td>

<td width="95" align="right" valign="middle" class="smalltblheading">&nbsp;Date &nbsp;</td>
<td width="182" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
<td width="137" align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td width="144" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex=""    maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>


<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 

  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="145" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>

	<td width="95" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="182" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1();" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		<td width="137" align="right" valign="middle" class="smalltblheading">Seed Stage&nbsp;</td>
<td width="144"  align="left" valign="middle" class="smalltbltext"  >&nbsp;<select class="smalltbltext" name="txtstage" style="width:80px;" onChange="sschk1()">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <option value="Condition" >Condition</option>
	 <!--<option value="Pack" >Pack</option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
           </tr>
<?php
$sql_sel1="select * from tbl_rm_promac where plantcode='$plantcode' order by promac_type,promac_macid";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
?> 		   
<tr class="Light" height="30">
<td width="133" align="right" valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
<td  align="left" valign="middle" class="smalltbltext"  >&nbsp;<select class="smalltbltext" name="txtpromech" style="width:120px;" onChange="sschk2()">
    <option value="" selected>--Select--</option>
    <?php while($noticia_item1 = mysqli_fetch_array($res1)) { $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];?>
		<option value="<?php echo $noticia_item1['promac_id'];?>" />   
		<?php echo $num;?>
		<?php } ?>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
<?php
$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and proopr_status='Active' order by proopr_fname") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
?>
<td width="95" align="right" valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
<td width="182" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtoprname" style="width:150px;" onChange="sschk3()">
    <option value="" selected>--Select--</option>
    <?php while($row_popr = mysqli_fetch_array($query_popr)) { ?>
		<option value="<?php echo $row_popr['proopr_id'];?>" />   
		<?php echo $row_popr['proopr_fname'];?> <?php echo $row_popr['proopr_lname']?>
		<?php } ?>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
<?php
$sql_sel="select * from tbl_rm_treattype where plantcode='$plantcode' order by treatt_type";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$total=mysqli_num_rows($res);
?>  
<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<select class="smalltbltext" name="txttreattyp" style="width:120px;" onChange="sschk4()">
    <option value="none" selected>None</option>
 <?php while($noticia_item = mysqli_fetch_array($res)) { ?>
		<option value="<?php echo $noticia_item['treatt_type'];?>" />   
		<?php echo $noticia_item['treatt_type'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>
<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" colspan="5">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex=""    maxlength="15" onchange="vendorchk1();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>-->
</table>


<br />
  

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="1%" rowspan="3" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="12%" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	 <!--<td width="10%" align="center" valign="middle" class="smalltblheading" colspan="2">Raw Seed </td>-->
	 <td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
	 <td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
	 <td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed </td>
     <td align="center" valign="middle" class="smalltblheading"  rowspan="2">RM</td>

	 	 <td align="center" valign="middle" class="smalltblheading"  rowspan="2">IM </td>
<td align="center" valign="middle" class="smalltblheading"  rowspan="2">PL</td>
<td align="center" valign="middle" class="smalltblheading"  colspan="2">Total C. Loss</td>
		  <!--/*<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">QC Status </td>	 
		   <td width="12%" rowspan="3" align="center" valign="middle" class="smalltblheading">GOT Type </td>*/-->
    <td width="11%" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="8%" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
    <td width="3%" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
  </tr>
   <tr class="tblsubtitle">
    
     <!--<td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="smalltblheading">%</td>-->
     <td width="5%" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<!--<td width="4%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="2%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">%</td>-->
	    <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">%</td>
              </tr>
			  <?php
			  $total_tbl=0;
			  ?>
			<input type="hidden" name="itmdchk" value="<?php echo $total_tbl;?>" /> 
          </table>
		  <br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#adad11">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#adad11">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#adad11">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"> </div>
</div></div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_pslip.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

 
