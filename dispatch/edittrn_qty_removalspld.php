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
	//exit;
	   	$p_id=trim($_POST['maintrid']);
		echo "<script>window.location='trn_rem_qty_previewspld.php?pid=$p_id'</script>";	
			
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch- Transaction - Pack Seed SP Release</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script src="qtyremspld.js"></script>
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
function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 
function pform()
{	
	var f=0;
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
		alert("Please select Valid Party DC Date.");
		fl=1;
		return false;
	}
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
	
	if(document.frmaddDepartment.getdetflg.value==0)
	{
		alert("Please click on Get Details first to remove Pack Seed Quantity");
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
	
	var val=document.frmaddDepartment.srno1.value;
	if(val!="")
	{	
		var v_1=0;
		var qtyd=0;
		var qtyo=0;
		var qtyb=0;
		var nop=0;
		var nomp=0;
		for(var i=1; i<=val; i++)
		{ 
			var dc="txtqty_"+i;
			var rem="recqtyp_"+i;
			var bal="txtdqtyp_"+i;
			var nop="txtrecbagp_"+i;
			var nomp="txtrecnomp_"+i;
			nop=parseInt(nop)+parseInt(document.getElementById(nop).value);
			nomp=parseInt(nomp)+parseInt(document.getElementById(nomp).value);
			if(document.getElementById(rem).value=="")
			{
				v_1++;
			}
				var q=document.getElementById(dc).value;
				var rq=document.getElementById(rem).value;
				var bq=document.getElementById(bal).value;
				
				if(rq=="")rq=0;
				
				var qtyd=parseFloat(qtyd)+parseFloat(rq);
				var qtyo=parseFloat(qtyo)+parseFloat(q);
				var qtyb=parseFloat(qtyb)+parseFloat(bq);
		}
		if(nop==0 && nomp==0)
		{
			alert("Please Enter NoP/NoMP to Remove");
			f=1;
			return false;
		}
		if(v_1>=val)
		{
			alert("Please Enter NoP/NoMP to Remove");
			f=1;
			return false;
		}					
		if(parseFloat(qtyd) > parseFloat(qtyo))
		{
			alert("Please check. Total Quantity Removed not matching with Total Quantity in Stock");
			return false;
			f=1;
		}		
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

function pformedtup()
{	
	var f=0;
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
		alert("Please select Valid Party DC Date.");
		fl=1;
		return false;
	}
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
	
	if(document.frmaddDepartment.getdetflg.value==0)
	{
		alert("Please click on Get Details first to remove Pack Seed Quantity");
		f=1;
		return false;
	}
	
	/*if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}*/
	
	var val=document.frmaddDepartment.srno1.value;
	if(val!="")
	{	
		var v_1=0;
		var qtyd=0;
		var qtyo=0;
		var qtyb=0;
		var nop=0;
		var nomp=0;
		for(var i=1; i<=val; i++)
		{ 
			var dc="txtqty_"+i;
			var rem="recqtyp_"+i;
			var bal="txtdqtyp_"+i;
			var nop="txtrecbagp_"+i;
			var nomp="txtrecnomp_"+i;
			nop=parseInt(nop)+parseInt(document.getElementById(nop).value);
			nomp=parseInt(nomp)+parseInt(document.getElementById(nomp).value);
			if(document.getElementById(rem).value=="")
			{
				v_1++;
			}
				var q=document.getElementById(dc).value;
				var rq=document.getElementById(rem).value;
				var bq=document.getElementById(bal).value;
				
				if(rq=="")rq=0;
				
				var qtyd=parseFloat(qtyd)+parseFloat(rq);
				var qtyo=parseFloat(qtyo)+parseFloat(q);
				var qtyb=parseFloat(qtyb)+parseFloat(bq);
		}
		if(nop==0 && nomp==0)
		{
			alert("Please Enter NoP/NoMP to Remove");
			f=1;
			return false;
		}
		if(v_1>=val)
		{
			alert("Please Enter NoP/NoMP to Remove");
			f=1;
			return false;
		}					
		if(parseFloat(qtyd) > parseFloat(qtyo))
		{
			alert("Please check. Total Quantity Removed not matching with Total Quantity in Stock");
			return false;
			f=1;
		}		
	}
		
		if(f==1)
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

function modetchk(classval)
{
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.txtlot1.value==""
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
	else if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please Select UPS first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	else
	{
		//var itm="Pack Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var txtups=document.frmaddDepartment.txtups.value;
		winHandle=window.open('getuser_rem_lotnospld.php?crop='+crop+'&variety='+variety+'&trid='+trid+'&txtups='+txtups,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
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
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
			
		showUser(get,'postingsubtable','get',crop,variety,tid,lotid,'','');
		document.frmaddDepartment.getdetflg.value=1;
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


function qtychk1(qtyval1,val)
{
	
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
				
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
				
	var m1="txtnomp_"+val;
	var m2="txtrecnomp_"+val;
	var m3="txtdnomp_"+val;
				
	var wtinmp="wtinmp_"+val;
	var pcktyp="upspacktype_"+val;
			
	var qty=0.000;
	var packtp=document.getElementById(pcktyp).value.split(" ");
					
	if(packtp[1]=="Gms")
	{ 
		var ptp=(parseFloat(packtp[0])/1000);
		var ptp1=(parseFloat(1000/packtp[0]));
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
		var ptp1=parseFloat(packtp[0]);
	}
			
	if(qtyval1!="" && qtyval1 > 0)
	{	
		document.getElementById(m2).value=Math.floor(parseFloat(qtyval1)/parseFloat(document.getElementById(wtinmp).value));
		var sd=parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value);
		var qtb=parseFloat(qtyval1)-parseFloat(sd);
		if(parseFloat(qtb)>0)
		{
			document.getElementById(z2).value=parseFloat(qtb)*parseFloat(ptp1);
		}
		else
		{
			document.getElementById(z2).value=0;
		}
		if(parseInt(document.getElementById(m2).value)>parseInt(document.getElementById(m1).value))
		{
			alert( "NoMP can be either equal or less than Actual NoMP");
			document.getElementById(m2).value="";
			document.getElementById(m3).value="";
			document.getElementById(m2).focus();
		}
		if(parseInt(document.getElementById(z2).value)>parseInt(document.getElementById(z1).value))
		{
			alert( "NoP can be either equal or less than Actual NoP");
			document.getElementById(z2).value="";
			document.getElementById(z3).value="";
			document.getElementById(z2).focus();
		}					
		document.getElementById(m3).value=parseInt(document.getElementById(m1).value)-parseInt(document.getElementById(m2).value);
		document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
		document.getElementById(q2).value=parseFloat(qtyval1);
		document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qtyval1);
		document.getElementById(q2).value=parseFloat(document.getElementById(q2).value).toFixed(3);
		document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
		if(parseFloat(document.getElementById(q2).value)<0)document.getElementById(q2).value=0;
		if(parseFloat(document.getElementById(q3).value)<0)document.getElementById(q3).value=0;
		//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
	}
	else
	{
		alert( "Qty can not be Zero");
		document.getElementById(z2).value="";
		document.getElementById(z3).value="";
		document.getElementById(q2).value="";
		document.getElementById(q3).value="";
		document.getElementById(m2).value="";
		document.getElementById(m3).value="";
		document.getElementById(m2).focus();
	}
}


function Bagschk1(Bagsval1, val)
{
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
		
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
		
	var m1="txtnomp_"+val;
	var m2="txtrecnomp_"+val;
	var m3="txtdnomp_"+val;
		
	var wtinmp="wtinmp_"+val;
	var pcktyp="upspacktype_"+val;
	
	var qty=0.000;
	var packtp=document.getElementById(pcktyp).value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
	}
	//alert(ptp);
	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		if(parseInt(document.getElementById(z2).value)>parseInt(document.getElementById(z1).value))
		{
			alert( "NoP can be either equal or less than Actual NoP");
			document.getElementById(z2).value="";
			document.getElementById(z3).value="";
			document.getElementById(z2).focus();
		}
		else
		{
			
			if(document.getElementById(m2).value!="" && document.getElementById(m2).value>0)
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value))+(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
			}
			else
			{
				qty=(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
			}
			
			document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qty);
			document.getElementById(q2).value=parseFloat(document.getElementById(q2).value).toFixed(3);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			if(parseFloat(document.getElementById(q2).value)<0)document.getElementById(q2).value=0;
			if(parseFloat(document.getElementById(q3).value)<0)document.getElementById(q3).value=0;
		}
	}
	else
	{
			if(document.getElementById(m2).value!="" && document.getElementById(m2).value>0)
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value));
				document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
				document.getElementById(q2).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(qty);
				document.getElementById(q2).value=parseFloat(document.getElementById(q2).value).toFixed(3);
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
				if(parseFloat(document.getElementById(q2).value)<0)document.getElementById(q2).value=0;
				if(parseFloat(document.getElementById(q3).value)<0)document.getElementById(q3).value=0;
			}
	}
}
function nompchk1(Bagsval1, val)
{
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
		
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
		
	var m1="txtnomp_"+val;
	var m2="txtrecnomp_"+val;
	var m3="txtdnomp_"+val;
		
	var wtinmp="wtinmp_"+val;
	var pcktyp="upspacktype_"+val;
	
	var qty=0.000;
	var packtp=document.getElementById(pcktyp).value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
	}
	
	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		if(parseInt(document.getElementById(m2).value)>parseInt(document.getElementById(m1).value))
		{
			alert( "NoMP can be either equal or less than Actual NoMP");
			document.getElementById(m2).value="";
			document.getElementById(m3).value="";
			document.getElementById(m2).focus();
		}
		else
		{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=((parseFloat(document.getElementById(m2).value))*(parseFloat(document.getElementById(wtinmp).value)))+((parseFloat(document.getElementById(z2).value))*(parseFloat(ptp)));
			}
			else
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value));
			}
			
			document.getElementById(m3).value=parseInt(document.getElementById(m1).value)-parseInt(document.getElementById(m2).value);
			document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qty);
			document.getElementById(q2).value=parseFloat(document.getElementById(q2).value).toFixed(3);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			if(parseFloat(document.getElementById(q2).value)<0)document.getElementById(q2).value=0;
			if(parseFloat(document.getElementById(q3).value)<0)document.getElementById(q3).value=0;
			//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
		}
	}
	else
	{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
				document.getElementById(q2).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(qty);
				document.getElementById(q2).value=parseFloat(document.getElementById(q2).value).toFixed(3);
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
				if(parseFloat(document.getElementById(q2).value)<0)document.getElementById(q2).value=0;
				if(parseFloat(document.getElementById(q3).value)<0)document.getElementById(q3).value=0;
			}
	}
}
function spmchk()
{
}
function dcdchk()
{
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	if(dt3 > dt4)
	{
		alert("Please select Valid Delivary Challan Date.");
		document.frmaddDepartment.txtdcno.value="";
		return false;
	}
	/*var t=0;
	var haystack=document.frmaddDepartment.extdcno.value.split(",");
	var needle=document.frmaddDepartment.txtdcno.value;
	var count=haystack.length;
	for(var i=0;i<count;i++)
	{
		if(haystack[i]===needle){t++;}
	}
	if(t>0)
	{
		alert("Duplicate Delivary Challan No.");
		document.frmaddDepartment.txtdcno.value="";
		return false;
	}*/
}
function varchk(varval)
{ 
	var b='vitem2';
	var crop=document.frmaddDepartment.txtcrop.value;
	showUser(varval,b,'item2',crop,'','','','');
}
function verchk()
{

}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Pack Seed SP Release</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
<?php  
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_pswrem where plantcode='".$plantcode."' and pswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pswrem_id'];

$tdate=$row_tbl['pswrem_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
$tdate=$row_tbl['pswrem_dcdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;	
/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);*/
$subtid=0;
?>	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['pswrem_tcode'];?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="getdetflg" value="1" />
		</br>
	
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed SP Release-RO</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TCR".$row_tbl['pswrem_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <!--<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Stage&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;Pack </td>

</tr>-->


<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="smalltbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="<?php echo $row_tbl['pswrem_dcno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<input name="txtparty" type="text" size="50" class="smalltbltext" value="VNR Seeds Private Limited-Raipur Depot" readonly="true" style="background-color:#CCCCCC"  tabindex="0"/><input type="hidden" name="party" value="907" /></td>

</tr>
</table>

<br />
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pswrem_sub where plantcode='".$plantcode."' and pswrem_id='".$arrival_id."'") or die(mysqli_error($link));
 $subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#378b8b" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No.</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >UPS</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Crop</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Variety</td>
	<td width="91" align="center" valign="middle" class="tblheading"rowspan="2" >SLOC</td>
	<td align="center" valign="middle" class="tblheading"  colspan="3">Actual Quantity</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Quantity Released</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Balance Quantity</td>
	<td width="30" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
	<td width="39" align="center" valign="middle" class="tblheading"rowspan="2" >Delete</td>
</tr>
<tr class="tblsubtitle">
	<td width="50" align="center" valign="middle" class="tblheading" >NoP</td>
	<td width="50" align="center" valign="middle" class="tblheading" >NoMP</td>
	<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="53" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="52" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $difq="";  $rtotalnop=0; $rtotalups=0; $rtotalqty=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['pswrem_id'];

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pswremsub_sub where plantcode='".$plantcode."' and pswremsub_id='".$row_tbl_sub['pswremsub_id']."' and pswrem_id='".$row_tbl_sub['pswrem_id']."'") or die(mysqli_error($link));
while($row_subsub=mysqli_fetch_array($sql_tbl_subsub))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=""; $slocs=""; $gd=""; $slups=0; $slqty=0; $onob=0; $onomp=0; $oqty=0; $nob=0; $nomp=0; $qty=0; $baln=0; $balmp=0; $balq=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_subsub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_subsub['subbinid']."' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$onob=$onob+$row_subsub['opnop'];
$onomp=$onomp+$row_subsub['opnomp'];
$oqty=$oqty+$row_subsub['opqty'];
$nob=$nob+$row_subsub['remnop'];
$nomp=$nomp+$row_subsub['remnomp'];
$qty=$qty+$row_subsub['remqty'];
$baln=$baln+$row_subsub['balnop'];
$balmp=$balmp+$row_subsub['balnomp'];
$balq=$balq+$row_subsub['balqty'];

}
$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['crop']."' order by cropname Asc"); 
$row_crp = mysqli_fetch_array($sql_crp);

$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' order by popularname Asc"); 
$row_var = mysqli_fetch_array($sql_var);

$rtotalnop=$rtotalnop+$onob;
$rtotalups=$rtotalups+$onomp;
$rtotalqty=$rtotalqty+$oqty;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_crp['cropname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_var['popularname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $slocs;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $onob;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balq;?></td>
    <td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
    <td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crp['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_var['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balq;?></td>
    <td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
    <td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pswremsub_id'];?>);" /></td>
  </tr>
<?php
}
$srno++;
}
}
?>
<input type="hidden" name="rtotalnop" value="<?php echo $rtotalnop;?>" />
<input type="hidden" name="rtotalups" value="<?php echo $rtotalups;?>" />
<input type="hidden" name="rtotalqty" value="<?php echo $rtotalqty;?>" />
</table>
		  <br />
 <div id="postingsubtable" style="display:block">		 
		<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  where cropname IN ('Paddy Seed','Bajra Seed','Maize Seed') order by cropname Asc");
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	<td width="72" height="30" align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
    <td width="158"  align="left"  valign="middle" class="smalltbltext" id="vitem2">&nbsp;<select class="smalltbltext" name="txtups" style="width:100px;" onchange="upschk(this.value)"  >
     <option value="" selected>--Select--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#378b8b" >&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" colspan="4" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>	  
		   
</table>

<!--<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_remqtyspld.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  