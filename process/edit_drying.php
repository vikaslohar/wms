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

	if(isset($_REQUEST['cropid']))
	{
	$pid = $_REQUEST['cropid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
 		$p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$remarks=str_replace("&","and",$remarks);
	   	
		echo "<script>window.location='add_drying_preview.php?p_id=$p_id&remarks=$remarks'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Processing - Transaction - Drying Slip</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script src="../include/datetimepicker_css.js"></script>
<script src="drying.js"></script>
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

function pform()
{	
	
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}

	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
			if(document.frmaddDepartment.txtdrefno.value=="")
	{
		alert("Please Enter  Drying slip reference No");
		document.frmaddDepartment.txtdrefno.focus();
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
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.recqtyptot.value=="")
	{
		alert("Please Enter NoB");
		document.frmaddDepartment.recqtyptot.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtrecbagptot.value=="")
	{
		alert("Please Enter Qty");
		document.frmaddDepartment.txtrecbagptot.focus();
		f=1;
		return false;
	}
	
	if(document.frmaddDepartment.txtcrop.value==61)
	{
		if(document.frmaddDepartment.txtdbagptot.value>90)
		{
			alert("Drying Loss is More than 90 percent Please check");
			f=1;
			return false;
		}
	}
	else
	{
		if(document.frmaddDepartment.txtdbagptot.value>25)
		{
			alert("Drying Loss is More than 25 percent Please check");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.dateend.value=="")
	{
		alert("Please select Drying End Date");
		//document.frmaddDepartment.dateend.focus();
		f=1;
		return false;
	}
	if(parseFloat(document.frmaddDepartment.txtrecbagptot.value)>parseFloat(document.frmaddDepartment.txtqtytot.value))
	{
		alert("Total Drying Qty cannot be more than Actual Qty");
		//document.frmaddDepartment.txtrecbagptot.focus();
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
		showUser(a,'postingtable','mform','','','','','');
		
		}  
	}
//}

function pformedtup()
{	
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}

	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
			if(document.frmaddDepartment.txtdrefno.value=="")
	{
		alert("Please Enter  Drying slip reference No");
		document.frmaddDepartment.txtdrefno.focus();
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
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.recqtyptot.value=="")
	{
		alert("Please Enter NoB");
		document.frmaddDepartment.recqtyptot.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtrecbagptot.value=="")
	{
		alert("Please Enter Qty");
		document.frmaddDepartment.txtrecbagptot.focus();
		f=1;
		return false;
	}
	
	if(document.frmaddDepartment.txtcrop.value==61)
	{
		if(document.frmaddDepartment.txtdbagptot.value>90)
		{
			alert("Drying Loss is More than 90 percent Please check");
			f=1;
			return false;
		}
	}
	else
	{
		if(document.frmaddDepartment.txtdbagptot.value>25)
		{
			alert("Drying Loss is More than 25 percent Please check");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.dateend.value=="")
	{
		alert("Please select Drying End Date");
		//document.frmaddDepartment.dateend.focus();
		f=1;
		return false;
	}
	if(parseFloat(document.frmaddDepartment.txtrecbagptot.value)>parseFloat(document.frmaddDepartment.txtqtytot.value))
	{
		alert("Total Drying Qty cannot be more than Actual Qty");
		//document.frmaddDepartment.txtrecbagptot.focus();
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
		showUser(a,'postingtable','mformsubedt','','','','');
		//alert(a);
		}
	}
//}

function modetchk(classval)
{
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.txtlot1.value==""
				//document.frmaddDepartment.txt11.selectedIndex=0;
}

function modetchk1()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		document.frmaddDepartment.txtvariety.value="";
	}
}	
function modetchk22()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		document.frmaddDepartment.txtstage.value="";
	}
}
function vendorchk1()
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
}	
	
function openslocpop()
{

if(document.frmaddDepartment.txtcrop.value=="")
{
 alert("Please Select Crop.");
document.frmaddDepartment.txtcrop.focus();
}
else if(document.frmaddDepartment.txtvariety.value=="")
{
alert("Please Select Variety first.");
document.frmaddDepartment.txtvariety.focus();
}
else if(document.frmaddDepartment.txtstage.value=="")
{
alert("Please Select Stage first.");
document.frmaddDepartment.txtstage.focus();
}
else
{
//var itm="Raw Seed";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var stage=document.frmaddDepartment.txtstage.value;
var tid=document.frmaddDepartment.maintrid.value;
winHandle=window.open('getuser_drying_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function editrec(edtrecid, trid)
{
//alert(trid);
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


function mySubmit()
{ 
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	if(document.frmaddDepartment.txtremarks.value=="")
	{
			alert("Please enter Remarks");
			document.frmaddDepartment.txtremarks.focus();
			return false;
	}
return true;	 
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
//var grn=document.frmaddDepartment.grnnumber.value;

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
		/*	if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}*/
				if(document.frmaddDepartment.txtlot1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDepartment.txtlot1.focus();
				return false;
				}
				//alert(document.frmaddDepartment.txtcrop.value);
		var crop=document.frmaddDepartment.txtcrop.value;
        var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
		var dsrn=document.frmaddDepartment.txtdrefno.value;
		var stage=document.frmaddDepartment.txtstage.value;
		//alert(tid);
		//alert(lotid);
		
		//document.getElementById("postingsubtable").style.display="block";
		showUser(get,'postingsubsubtable','get',crop,variety,tid,lotid,dsrn,stage);
}
}

function openslocpop1()
{

if(document.frmaddDepartment.txtlot1.value=="")
{
 alert("Please Select Lot No.");
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

function ltchk()
{
document.getElementById("postingsubtable").style.display="none";

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
				if(document.frmaddDepartment.txtlot1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDepartment.txtlot1.focus();
				return false;
				}
			if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(1)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(2)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(3)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(4)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(5)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
}


function qtychk1(qtyval1,srno)
{
var sbin="txtslsubbg"+srno;
var nob="recqtyp"+srno;
	if(document.getElementById(sbin).value=="")
	{
		alert("Select Subbin");
		document.getElementById(sbin).focus();
		document.getElementById(nob).value="";
		return false;
	}
		//document.frmaddDepartment.txtdqtyp.value=parseFloat(document.frmaddDepartment.txtdisp.value)-parseFloat(qtyval1);
}


function Bagschk1(Bagsval1,srno)
{
var acnob="";
var acqty="txtqty"+srno;
var dynob="recqtyp"+srno;
var dyqty="txtrecbagp"+srno;
var balqty="txtdqtyp"+srno;
var balper="txtdbagp"+srno;

var dynob1="recqtyp1";
var dyqty1="txtrecbagp1";
var balqty1="txtdqtyp1";
var balper1="txtdbagp1";

	if(document.getElementById(dynob).value=="")
	{
		alert("Please Enter  NoB ");
		document.getElementById(balqty).value="";
		document.getElementById(balper).value="";
		document.getElementById(dynob).focus();
	}
		document.getElementById(balqty).value=parseFloat(document.getElementById(acqty).value)-parseFloat(Bagsval1);
		/*if(document.frmaddDepartment.txtrecbagp.value > document.frmaddDepartment.txtqty.value)
		{     
					alert( "Fill number either equal or less than Before Drying Qty");
					//document.frmaddDepartment.txtrecbagp.value="";
					document.frmaddDepartment.txtrecbagp.focus();
		}*/
			
		
		/*else100-((parseFloat(document.frmaddDepartment.txtnot.value)/parseFloat(document.frmaddDepartment.txtnop.value))*100);
		{*/
	document.getElementById(balper).value=Math.round(parseFloat(document.getElementById(balqty).value)/parseFloat(document.getElementById(acqty).value)*100);

		if(document.frmaddDepartment.srno2.value==2)
		{   
		var dynob2=document.frmaddDepartment.recqtyp2.value;
		var dyqty2=document.frmaddDepartment.txtrecbagp2.value;
		var balqty2=document.frmaddDepartment.txtdqtyp2.value;
		var balper2=document.frmaddDepartment.txtdbagp2.value;  
		
		if(dynob2=="")dynob2=0;
		if(dyqty2=="")dyqty2=0;
		if(balqty2=="")balqty2=0;
		if(balper2=="")balper2=0; 
		
		document.frmaddDepartment.txtdqtyptot.value=parseFloat(document.getElementById(balqty1).value)+parseFloat(balqty2);
		//document.frmaddDepartment.txtdbagptot.value=parseFloat(document.getElementById(balper1).value)+parseFloat(document.getElementById(balper2).value);
		
		document.frmaddDepartment.recqtyptot.value=parseFloat(document.getElementById(dynob1).value)+parseFloat(dynob2);
		document.frmaddDepartment.txtrecbagptot.value=parseFloat(document.getElementById(dyqty1).value)+parseFloat(dyqty2);
		}
		else
		{
		document.frmaddDepartment.txtdqtyptot.value=parseFloat(document.getElementById(balqty1).value);
		//document.frmaddDepartment.txtdbagptot.value=parseFloat(document.getElementById(balper1).value);
		
		document.frmaddDepartment.recqtyptot.value=parseFloat(document.getElementById(dynob1).value);
		document.frmaddDepartment.txtrecbagptot.value=parseFloat(document.getElementById(dyqty1).value);
		}
		//document.frmaddDepartment.txtdqtyptot.value=parseFloat(document.frmaddDepartment.txtqtytot.value)-parseFloat(document.frmaddDepartment.txtrecbagptot.value);
		//alert(document.frmaddDepartment.txtdqtyptot.value);
		var val=parseFloat(document.frmaddDepartment.txtdqtyptot.value)/parseFloat(document.frmaddDepartment.txtqtytot.value)*100;
		document.frmaddDepartment.txtdbagptot.value=Math.round((val)*100)/100;
		//alert(document.frmaddDepartment.txtdbagptot.value);
		/*if(document.getElementById(balper).value>25)
		{
			alert("Drying Loss is More than 25 % , Please check"); 
		}*/
}

function dstimechk(dstval)
{
	if(document.frmaddDepartment.txtrecbagptot.value=="")
	{
		alert("Enter Drying Qty");
		document.frmaddDepartment.txtstime.value="";
		return false;
	}
}

function dstarttimechk(dstval)
{
	var stime="txtetime";
	var etime="txtetime";
	if(document.getElementById(stime).value=="")
	{
		alert("Select D. Start Time");
		document.getElementById(stime).focus();
		document.getElementById(etime).value="";
		return false;
	}
	else
	{
	
	}
}

function chktime(tval)
{
	var etime="datestart";
	var wh="txtdmtyp";
	if(document.getElementById(etime).value=="")
	{
		alert("Select D. Start Time");
		document.getElementById(etime).focus();
		document.getElementById(wh).value="";
		return false;
	}
}

function chkidtyp(idval)
{
	var etime="txtdmtyp";
	var wh="txtdid";
	if(document.getElementById(etime).value=="")
	{
		alert("Select Type in Drying Details");
		document.getElementById(etime).focus();
		document.getElementById(wh).value="";
		return false;
	}
}

function wh1(wh1val, srnval)
{ 
	/*var wh="txtslwhg"+srnval;
	var etime="txtdid"+srnval;
	if(document.getElementById(etime).value=="")
	{
		alert("Select ID in Drying Details");
		document.getElementById(etime).focus();
		document.getElementById(wh).value="";
		return false;
	}
	else
	{*/
	showUser(wh1val,'bing1','wh','bing1',srnval,'','','');
	//}
}

function wh2(wh2val, srnval)
{   
	/*var etime="txtdid"+srnval;
	var wh="txtslwhg"+srnval;
	if(document.getElementById(etime).value=="")
	{
		alert("Select ID in Drying Details");
		document.getElementById(etime).focus();
		document.getElementById(wh).value="";
		return false;
	}
	else
	{*/
		showUser(wh2val,'bing2','wh','bing2',srnval,'','','');
	//}
}



function bin1(bin1val, srnval)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1',srnval,'','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin2(bin2val, srnval)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2',srnval,'','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}



function subbin1(subbin1val, srnval)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		if(document.frmaddDepartment.srno2.value > 1)
		{
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		}
		/*if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		}*/
		var slocnogood=document.frmaddDepartment.txtstage.value;;
		var trid=document.frmaddDepartment.maintrid.value;
		/*if(document.frmaddDepartment.txtslBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.txtslBagsg1.value;
		else*/
		var Bagsv1=srnval;
		/*if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else*/
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val,srnval)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		/*if(w2==w1)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		}*/
		
		
		var slocnogood=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		/*if(document.frmaddDepartment.txtslBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg2.value;
		else*/
		var Bagsv2=srnval;
		/*if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else*/
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

function isValidDate(dateStr) 
{
 // Date validation Function 
 // Checks For the following valid Date formats:
 // MM/DD/YY MM/DD/YYYY MM-DD-YY MM-DD-YYYY
 
 var datePat = /^(\d{1,2})(\/|-)(\d{1,2})\2(\d{4})$/; // requires 4 digit Year
 
 var matchArray = dateStr.match(datePat); // Is the format ok?
 if (matchArray == "Null") 
 {
  alert(dateStr + " Date is not in a valid format.")
  return false;
 }
 
 Month = matchArray[1]; // parse Date into variables
 Day = matchArray[3];
 Year = matchArray[4];
 
 if (Month < 1 || Month > 12) 
 { // check Month range
  alert("Month must be between 1 and 12.");
  return false;
 }
 
 if (Day < 1 || Day > 31) 
 {
  alert("Day must be between 1 and 31.");
  return false;
 }
 
 if ((Month==4 || Month==6 || Month==9 || Month==11) && Day==31) 
 {
  alert("Month "+Month+" doesn't have 31 days!")
  return false;
 }
 
 if (Month == 2) 
 { // check For february 29th
  var isleap = (Year % 4 == 0 && (Year % 100 != 0 || Year % 400 == 0));
  if (Day>29 || (Day==29 && !isleap)) 
  {
   alert("February " + Year + " doesn't have " + Day + " days!");
   return false;
  }
 }
 return true;
}

function isValidTime(timeStr) 
{
 // Checks if time Is In HH:MM:SS AM/PM format.
 // The seconds And AM/PM are optional.
 
 var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;
 
 var matchArray = timeStr.match(timePat);
 if (matchArray == "Null") 
 {
  alert("Time is not in a valid format.");
  return false;
 }
 
 Hour = matchArray[1];
 Minute = matchArray[2];
 Second = matchArray[4];
 ampm = matchArray[6];
 
 if (Second=="") { Second = "Null"; }
 if (ampm=="") { ampm = "Null" }
 
 if (Hour < 0 || Hour > 23) {
  alert("Hour must be between 1 and 12. (or 0 and 23 for military time)");
  return false;
 }
 if (Hour <= 12 && ampm == "Null") {
  if (confirm("Please indicate which time format you are using. OK = Standard Time, CANCEL = Military Time")) {
   alert("You must specify AM or PM.");
   return false;
  }
 }
 if (Hour > 12 && ampm != "Null") {
  alert("You can't specify AM or PM for military time.");
  return false;
 }
 if (Minute < 0 || Minute > 59) {
  alert ("Minute must be between 0 and 59.");
  return false;
 }
 if (Second != "Null" && (Second < 0 || Second > 59)) {
  alert ("Second must be between 0 and 59.");
  return false;
 }
 return true;
}


function checkDate(dateform) {
 date1 = new Date();
 date2 = new Date();
 date3 = new Date();
 diff = new Date();
 
 dt1=document.frmaddDepartment.datestart.value.split(" ");
 dd1=dt1[0].split("-");
 dd=dd1[1]+"/"+dd1[0]+"/"+dd1[2];
 
 firstdate=dd;
 firsttime=dt1[1]+" "+dt1[2];
 
 dt2=document.frmaddDepartment.dateend.value.split(" ");
 dd2=dt2[0].split("-");
 dd3=dd2[1]+"/"+dd2[0]+"/"+dd2[2];
 
 seconddate=dd3;
 secondtime=dt2[1]+" "+dt2[2];
 
 dt3=document.frmaddDepartment.currentdate.value.split(" ");
 dd3=dt3[0].split("-");
 dd4=dd3[1]+"/"+dd3[0]+"/"+dd3[2];
 
 thirddate=dd4;
 thirdtime=dt3[1]+" "+dt3[2];
/* alert(firstdate);
  alert(firsttime);
   alert(seconddate);
    alert(secondtime);*/
  if (isValidDate(firstdate) && isValidTime(firsttime)) { // Validates first Date
  //alert("Valid 1");
  date1temp = new Date(firstdate + " " + firsttime);
  //alert(date1temp);
  date1.setTime(date1temp.getTime());
  //alert(date1);
 }
 else return false; // otherwise exits
 
 if (isValidDate(seconddate) && isValidTime(secondtime)) { // Validates Second Date
// alert("Valid 2");
  date2temp = new Date(seconddate + " " + secondtime);
 // alert(date2temp);
  date2.setTime(date2temp.getTime());
  //alert(date2);
 }
 else return false; // otherwise exits
 
  if (isValidDate(thirddate) && isValidTime(thirdtime)) { // Validates Second Date
// alert("Valid 2");
  date3temp = new Date(thirddate + " " + thirdtime);
 // alert(date2temp);
  date3.setTime(date3temp.getTime());
  //alert(date2);
 }
 else return false; // otherwise exits
//alert(date2);
//alert(date1);
if(date2<date3 || date2<date3)
{
 var dif = date2-date1;
}
else
{
var dif =-1;
} 
 //alert(dif);
 if(dif >=0)
 { // 2nd date is after the 1st date
 //alert("Correct");
  //return true;
 
 var zx=date1.getTime();
 var zy=date2.getTime();
 var zz=(Math.abs(zx))-(Math.abs(zy));
 diff.setTime(Math.abs(zz));
  //alert("HI");
 timediff = diff.getTime();
 
 /*weeks = Math.floor(timediff / (1000 * 60 * 60 * 24 * 7));
 timediff -= weeks * (1000 * 60 * 60 * 24 * 7);*/
 
 days = Math.floor(timediff / (1000 * 60 * 60 * 24));
 timediff -= days * (1000 * 60 * 60 * 24);
 
 hours = Math.floor(timediff / (1000 * 60 * 60));
 timediff -= hours * (1000 * 60 * 60);
 
 mins = Math.floor(timediff / (1000 * 60));
 timediff -= mins * (1000 * 60);
 
 secs = Math.floor(timediff / 1000);
 timediff -= secs * 1000;
 
 //alert("HI");
 //alert("Difference = " + weeks + " weeks, " + days + " days, " + hours + " hours, " + mins + " minutes, and " + secs + " seconds");
 var totdiff=days + " days, " + hours + " hours, and " + mins + " minutes ";
 //alert("Difference = " + days + " days, " + hours + " hours, and " + mins + " minutes ");
 document.frmaddDepartment.txttottime.value="";
 document.frmaddDepartment.txttottime.value=totdiff;
 //alert("HI");
 return true; // form should never submit, returns False
 }
 else
 {
 alert("Incorrect Date Selection");
 document.frmaddDepartment.dateend.value="";
 document.frmaddDepartment.txttottime.value="";
  return false;
 }
}

function tdelay(dval)
{
	dateform=document.frmaddDepartment.dateend.value;
	if(dateform!="")
	{
		if(dval==dateform && dval!="")
		checkDate(dateform);
		else
		setTimeout('tdelay()',100);
	}
	else
	{
		setTimeout('tdelay()',100);
	}
}

function caldiff()
{
	if(document.frmaddDepartment.txtdid.value!="")
	{
		dval=document.frmaddDepartment.dateend.value;
		NewCssCal('dateend','ddMMyyyy','arrow',true,'12');
		setTimeout('tdelay(dval)',100);
	}
	else
	{
		alert("Select Drying Details ID")
		return false;
	}
}

function firstdt()
{
	if(document.frmaddDepartment.txtrecbagptot.value!="")
	{
		document.frmaddDepartment.dateend.value="";
		document.frmaddDepartment.txttottime.value="";
		NewCssCal('datestart','ddMMyyyy','arrow',true,'12')
	}
	else
	{
		alert("Enter Drying Quantity")
		return false;
	}
}

function chkboxchk(srnval,whid,binid,sbinid)
{
	var samesl="samesloc"+srnval;
	var chkbox="chkbox"+srnval;
	var samebin="samebin"+srnval;
	if(document.getElementById(chkbox).checked==true)
	{
		//alert("Checked");
		showUser(srnval,samesl,'samesloc',whid,binid,sbinid,'checked','','');
		document.getElementById(samebin).value="Yes";
		//return false;
	}
	else
	{
		showUser(srnval,samesl,'samesloc',whid,binid,sbinid,'unchecked','','');
		document.getElementById(samebin).value="No";
	}
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
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Drying </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php 
  $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_drying where trid='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
?>
  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arr_code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<?php date_default_timezone_set ("Asia/Calcutta"); ?>	  
		<input type="hidden" name="currentdate" value="<?php echo date('d-m-Y h:i A');?>" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit Drying </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TPD".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date of Arival&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" class="tbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="25" />   <input type="hidden" class="tbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
if($totver=mysqli_num_rows($quer4) > 0)
{
	$vername=$noticia_item['popularname'];
	$verid=$noticia_item['varietyid'];
}
else
{
	$vername=$row_tbl['variety'];
	$verid=$row_tbl['variety'];
}
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input type="text" class="tbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $vername;?>" size="25" />   <input type="hidden" class="tbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $verid;?>" />&nbsp;</td>
           </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Drying slip reference No. &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdrefno" type="text" size="20" class="tbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['drefno']?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>

<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">
                    <tr class="tblsubtitle" height="20">
              <td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
			   <td width="89" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No. </td>
			   <td width="110" align="center" valign="middle" class="smalltblheading" rowspan="2">Existing SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading"  colspan="2">Before Drying </td>
			    <td width="110" align="center" valign="middle" class="smalltblheading"rowspan="2" >Updated SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying  </td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
			   <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying Start</td>
			    <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying End</td>
				<td width="91" align="center" valign="middle" class="smalltblheading" rowspan="2">Total D.Time</td>
				 <td width="49" align="center" valign="middle" class="smalltblheading" rowspan="2">Drying Details</td>
              <td width="20" align="center" valign="middle" class="smalltblheading" rowspan="2">Edit</td>
              <td width="35" align="center" valign="middle" class="smalltblheading"rowspan="2" >Delete</td>
  </tr>
  <tr class="tblsubtitle">
                    <td width="40" align="center" valign="middle" class="smalltblheading" >NoB</td>
                    <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="40" align="center" valign="middle" class="smalltblheading">NoB</td>
                    <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="40" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="35" align="center" valign="middle" class="smalltblheading">%</td>
                            </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++;
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_dryingsubsub where subtrid='".$row_tbl_sub['subtrid']."' and trid='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_subsub['owh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_subsub['osubbin']."' and binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_subsub['nwh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wareh1=$row_whouse1['perticulars']."/";

$sql_binn1=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$binn1=$row_binn1['binname']."/";

$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_subsub['nsubbin']."' and binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$subbinn1=$row_subbinn1['sname'];

$nb1=$row_tbl_subsub['onob']; 
//$qt1=$row_tbl_subsub['oqty']; 
$nb2=$row_tbl_subsub['nnob']; 
//$qt2=$row_tbl_subsub['nqty'];

$diq=explode(".",$row_tbl_subsub['oqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_subsub['nqty']);
if($diq[1]==000){$qt2=$diq[0];}else{$qt2=$row_tbl_subsub['nqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}

if($sloc1!=""){
$sloc1=$sloc1."<BR/>".$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}
else{
$sloc1=$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}

}	
$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $difq1;?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	 <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        <td width="20" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $difq1;?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        <td width="20" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<br/>

<div id="postingsubtable" style="display:block">		 
		<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2" >&nbsp;<select class="tbltext" name="txtstage" style="width:80px;" onchange="modetchk22(this.value)">
<option value="" selected>--Select--</option>
<option value="Raw" >Raw</option>
<option value="Condition" >Condition</option>
<!--<option value="Pack" >Pack</option>-->
</select>
              <font color="#FF0000">*</font>&nbsp;</td>
</tr>			  
<tr class="Light" height="30">

           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>	  
</tr>		   
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
 
<div id="postingsubsubtable" style="display:block">	

<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
</div>
</div>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="light" height="30">
  <td width="61" align="right" class="smalltblheading">Remarks&nbsp;</td>
  <td width="903" align="left" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" size="140" value="<?php echo $row_tbl['remarks'];?>" class="smalltbltext" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_drying.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  