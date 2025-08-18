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
		echo "<script>window.location='trn_arrvop_qty_preview.php?pid=$p_id'</script>";	
			
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales - Transaction - Sales Return Opening Stock</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->


</head>
<script src="farrival1.js"></script>
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
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	//dt2=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.edate.value,"-");
	
	var f=0;
	if(dt3>dt1)
	{
		alert("DoT cannot be later than todays date");
		f=1;
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
	val2=document.frmaddDepartment.ycodeeo.value;
	val5=document.frmaddDepartment.txtlot2o.value;
	val6=document.frmaddDepartment.stcodeo.value;
	val7=document.frmaddDepartment.pcodeo.value;
	val8=document.frmaddDepartment.stcode2o.value;
	if(val7=="")
	{
		alert("Please Select Plant code for Old Lot Number");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code for Old Lot Number");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Old Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Old Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Old Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Old Lot No.");
		f=1;
		return false;
	}
	if(val8=="")
	{
		alert("Please Enter Old Lot No.");
		f=1;
		return false;
	}
	if(val8.length < 2)
	{
		alert("Invalid Old Lot No.");
		f=1;
		return false;
	}
	val21=document.frmaddDepartment.ycodee.value;
	val51=document.frmaddDepartment.txtlot2.value;
	val61=document.frmaddDepartment.stcode.value;
	val71=document.frmaddDepartment.pcode.value;
	if(val71=="")
	{
		alert("Please Select Plant code for New Lot Number");
		f=1;
		return false;
	}
	if(val21=="")
	{
		alert("Please Select Year Code for New Lot Number");
		f=1;
		return false;
	}	
	if(val51=="")
	{
		alert("Please Enter New Lot No.");
		f=1;
		return false;
	}
	if(val51.length < 5)
	{
		alert("Invalid New Lot No.");
		f=1;
		return false;
	}
	if(val61=="")
	{
		alert("Please Enter New Lot No.");
		f=1;
		return false;
	}
	if(val61.length < 5)
	{
		alert("Invalid New Lot No.");
		f=1;
		return false;
	}
	if(val61<=0)
	{
		alert("Invalid New Lot No.");
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
	if(document.frmaddDepartment.txtactnob.value=="")
	{
		alert("Please enter NoB");
		document.frmaddDepartment.txtactnob.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtactqty.value=="")
	{
		alert("Please enter Qty");
		document.frmaddDepartment.txtactqty.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtactnob.value<=0)
	{
		alert("Please enter NoB");
		document.frmaddDepartment.txtactnob.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtactqty.value<=0)
	{
		alert("Please enter Qty");
		document.frmaddDepartment.txtactqty.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.qcstatus.value=="")
	{
		alert("Please Select QC Status");
		document.frmaddDepartment.qcstatus.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		if(dt1 < dt3)
		{
			alert("Please select Valid Date of Test.");
			return false;
		}
	}
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please Select PP");
		document.frmaddDepartment.txtpp.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtmoist.value=="")
	{
		alert("Please Select Moisture %");
		document.frmaddDepartment.txtmoist.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtmoist.value<=0)
	{
		alert("Invalid Moisture %");
		document.frmaddDepartment.txtmoist.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		if(document.frmaddDepartment.txtgemp.value=="")
		{
			alert("Please Select Germination %");
			document.frmaddDepartment.txtgemp.focus();
			f=1;
			return false;
		}
		if(document.frmaddDepartment.txtgemp.value<=0)
		{
			alert("Invalid Germination %");
			document.frmaddDepartment.txtgemp.focus();
			f=1;
			return false;
		}
	}
	/*if(document.frmaddDepartment.txtgottyp.value=="")
	{
		alert("Please Select GOT Type");
		document.frmaddDepartment.txtgottyp.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.gotstatus.value=="")
	{
		alert("Please Select GOT Status");
		document.frmaddDepartment.gotstatus.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.gotstatus.value=="OK" || document.frmaddDepartment.gotstatus.value=="Fail")
	{
		if(dt1 < dt2)
		{
			alert("Please select Valid Date of GOT Test.");
			return false;
		}
	}*/
		if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
		{
			alert("Please SLOC");
			f=1;
			return false;
		}	
		
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var act1=document.frmaddDepartment.txtactqty.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		var qty=parseFloat(q1)+parseFloat(q2);
		
		if(parseFloat(act1)!=parseFloat(qty))
		{
		alert("Please check. The Total of Quantity entered in Bins not matching with Quantity in Post form");
		return false;
		f=1;
		}
		if(q1==0 && q2==0)
		{
		alert("Please check. Quantity entered cannot be Zero or Blank in Bins");
		return false;
		f=1;
		}
	//alert(f);
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
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	//dt2=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.edate.value,"-");
	
	var f=0;
	if(dt3>dt1)
	{
		alert("DoT cannot be later than todays date");
		f=1;
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
	val2=document.frmaddDepartment.ycodeeo.value;
	val5=document.frmaddDepartment.txtlot2o.value;
	val6=document.frmaddDepartment.stcodeo.value;
	val7=document.frmaddDepartment.pcodeo.value;
	val8=document.frmaddDepartment.stcode2o.value;
	if(val7=="")
	{
		alert("Please Select Plant code for Old Lot Number");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code for Old Lot Number");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Old Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Old Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Old Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Old Lot No.");
		f=1;
		return false;
	}
	if(val8=="")
	{
		alert("Please Enter Old Lot No.");
		f=1;
		return false;
	}
	if(val8.length < 2)
	{
		alert("Invalid Old Lot No.");
		f=1;
		return false;
	}
	val21=document.frmaddDepartment.ycodee.value;
	val51=document.frmaddDepartment.txtlot2.value;
	val61=document.frmaddDepartment.stcode.value;
	val71=document.frmaddDepartment.pcode.value;
	if(val71=="")
	{
		alert("Please Select Plant code for New Lot Number");
		f=1;
		return false;
	}
	if(val21=="")
	{
		alert("Please Select Year Code for New Lot Number");
		f=1;
		return false;
	}	
	if(val51=="")
	{
		alert("Please Enter New Lot No.");
		f=1;
		return false;
	}
	if(val51.length < 5)
	{
		alert("Invalid New Lot No.");
		f=1;
		return false;
	}
	if(val61=="")
	{
		alert("Please Enter New Lot No.");
		f=1;
		return false;
	}
	if(val61.length < 5)
	{
		alert("Invalid New Lot No.");
		f=1;
		return false;
	}
	if(val61<=0)
	{
		alert("Invalid New Lot No.");
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
	if(document.frmaddDepartment.txtactnob.value=="")
	{
		alert("Please enter NoB");
		document.frmaddDepartment.txtactnob.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtactqty.value=="")
	{
		alert("Please enter Qty");
		document.frmaddDepartment.txtactqty.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtactnob.value<=0)
	{
		alert("Please enter NoB");
		document.frmaddDepartment.txtactnob.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtactqty.value<=0)
	{
		alert("Please enter Qty");
		document.frmaddDepartment.txtactqty.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.qcstatus.value=="")
	{
		alert("Please Select QC Status");
		document.frmaddDepartment.qcstatus.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		if(dt1 < dt3)
		{
			alert("Please select Valid Date of Test.");
			return false;
		}
	}
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please Select PP");
		document.frmaddDepartment.txtpp.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtmoist.value=="")
	{
		alert("Please Select Moisture %");
		document.frmaddDepartment.txtmoist.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtmoist.value<=0)
	{
		alert("Invalid Moisture %");
		document.frmaddDepartment.txtmoist.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		if(document.frmaddDepartment.txtgemp.value=="")
		{
			alert("Please Select Germination %");
			document.frmaddDepartment.txtgemp.focus();
			f=1;
			return false;
		}
		if(document.frmaddDepartment.txtgemp.value<=0)
		{
			alert("Invalid Germination %");
			document.frmaddDepartment.txtgemp.focus();
			f=1;
			return false;
		}
	}
	/*if(document.frmaddDepartment.txtgottyp.value=="")
	{
		alert("Please Select GOT Type");
		document.frmaddDepartment.txtgottyp.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.gotstatus.value=="")
	{
		alert("Please Select GOT Status");
		document.frmaddDepartment.gotstatus.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.gotstatus.value=="OK" || document.frmaddDepartment.gotstatus.value=="Fail")
	{
		if(dt1 < dt2)
		{
			alert("Please select Valid Date of GOT Test.");
			return false;
		}
	}*/
		if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
		{
			alert("Please SLOC");
			f=1;
			return false;
		}	
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var act1=document.frmaddDepartment.txtactqty.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		var qty=parseFloat(q1)+parseFloat(q2);
		
		if(parseFloat(act1)!=parseFloat(qty))
		{
		alert("Please check. The Total of Quantity entered in Bins not matching with Quantity in Post form");
		return false;
		f=1;
		}
		if(q1==0 && q2==0)
		{
		alert("Please check. Quantity entered cannot be Zero or Blank in Bins");
		return false;
		f=1;
		}
	//alert(f);
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

function modetchk(classval)
{
	document.getElementById('itm').SelectedIndex=0;
	//document.getElementById('txtstage').SelectedIndex=0;
	//document.frmaddDepartment.txtstage.value="";
	document.getElementById('ycodee').SelectedIndex=0;
	document.frmaddDepartment.txtlot2.value="";
	document.frmaddDepartment.stcode.value="";
	document.getElementById('subsubdivgood').innerHTML="";
	showUser(classval,'vitem','item','','','','','');
}
function modetchk1(classval)
{
	//document.getElementById('itm').SelectedIndex=0;
	//document.getElementById('txtstage').SelectedIndex=0;
	//document.frmaddDepartment.txtstage.value="";
	document.getElementById('ycodee').SelectedIndex=0;
	document.frmaddDepartment.txtlot2.value="";
	document.frmaddDepartment.stcode.value="";
	/*document.frmaddDepartment.gotstatus.value="";*/
	document.getElementById('subsubdivgood').innerHTML="";
	//showUser(classval,'vitem','item','','','','','');
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
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	else
	{
		//var itm="Raw Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var txtstage=document.getElementById('txtstage').value;
		alert(txtstage);
		winHandle=window.open('getuser_srop_lotno.php?crop='+crop+'&variety='+variety+'&stage='+txtstage,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
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
	var z1="txtdqtyp_"+val;
	var z2="txtqty_"+val;
	document.getElementById(z1).value=parseFloat(document.getElementById(z2).value)-parseFloat(qtyval1);
}


function Bagschk1(Bagsval1, val)
{
/*if(document.frmaddDepartment.recqtyp.value=="")
		{
			alert("Please Enter  NoB�");
			document.frmaddDepartment.txtdbagp.value="";
			document.frmaddDepartment.recqtyp.focus();
		}
		if(document.frmaddDepartment.txtrecbagp.value > document.frmaddDepartment.txtqty.value)
		{     
					alert( "Fill number either equal or less than Before Drying Qty");
					//document.frmaddDepartment.txtrecbagp.value="";
					document.frmaddDepartment.txtrecbagp.focus();
		}*/
			
		/*	if(document.frmaddDepartment.txtdbagp.value>25)
		{
			alert("Drying Loss is More than 25 % , Please check");�
					}
		else100-((parseFloat(document.frmaddDepartment.txtnot.value)/parseFloat(document.frmaddDepartment.txtnop.value))*100);
		{*/
	var z1="txtdbagp_"+val;
	var z2="txtdisp_"+val;
	var z3="txtrecbagp_"+val;
	document.getElementById(z1).value=parseInt(document.getElementById(z2).value)-parseInt(document.getElementById(z3).value);
	if(document.getElementById(z1).value<=0)document.getElementById(z1).value=1;
}

function stchko()
{
	if(document.frmaddDepartment.txtlot2o.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcodeo.focus()
		document.frmaddDepartment.stcodeo.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else if(document.frmaddDepartment.stcodeo.value.length < 5)
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcodeo.focus()
		document.frmaddDepartment.stcodeo.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
		var val1=document.frmaddDepartment.pcodeo.value;
		var val2=document.frmaddDepartment.ycodeeo.value;
		var val3=document.frmaddDepartment.txtlot2o.value;
		var val4=document.frmaddDepartment.stcodeo.value;
		var val6=document.frmaddDepartment.stcode2o.value;
		var lot=val1+val2+val3+"/"+val4+"/"+val6;		
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//showUser(lot,'lotchko','lotchko',val1,val2,val3,val4,val6,clasid,itmid);	
		document.getElementById('subsubdivgood').innerHTML="";
	}
}

function stchko2()
{
	var val1=document.frmaddDepartment.pcodeo.value;
	var val2=document.frmaddDepartment.ycodeeo.value;
	var val3=document.frmaddDepartment.txtlot2o.value;
	var val4=document.frmaddDepartment.stcodeo.value;
	var val6=document.frmaddDepartment.stcode2o.value;
	var lot=val1+val2+val3+"/"+val4+"/"+val6;		
	var clasid=document.frmaddDepartment.txtcrop.value;
	var itmid=document.frmaddDepartment.txtvariety.value;
	//showUser(lot,'lotchko','lotchko',val1,val2,val3,val4,val6,clasid,itmid);	
	document.getElementById('subsubdivgood').innerHTML="";
}
function stchk()
{
	if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcode.focus()
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else if(document.frmaddDepartment.stcode.value.length < 5)
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcode.focus()
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else if(document.frmaddDepartment.stcode.value <= 0)
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcode.focus()
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	/*if(document.frmaddDepartment.lotchecko.value == 0)
	{
		alert("Lot Number not present in System");
		document.frmaddDepartment.stcode.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.stcodeo.focus();
	}*/
	else
	{
		var val1=document.frmaddDepartment.pcode.value;
		var val2=document.frmaddDepartment.ycodee.value;
		var val3=document.frmaddDepartment.txtlot2.value;
		var val4=document.frmaddDepartment.stcode.value;
		var val6=document.frmaddDepartment.stcode2.value;
		var lot=val1+val2+val3+"/"+val4+"/"+val6+"C";		
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		showUser(lot,'lotcheck','lotchk',val1,val2,val3,val4,val6,clasid,itmid);
		document.getElementById('subsubdivgood').innerHTML="";
	}
}

function pcdchk(pcdval)
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.pcodeo.value="";
		document.getElementById('pcodeo').SelectedIndex=0;
		document.frmaddDepartment.ycodeeo.value="";
		document.getElementById('ycodeeo').SelectedIndex=0;
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.pcode.value="";
		document.frmaddDepartment.ycodee.value="";
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
		document.frmaddDepartment.pcode.value=document.frmaddDepartment.pcodeo.value;
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.getElementById('subsubdivgood').innerHTML="";
	}
}
function ycodchko(ycodval)
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.ycodeeo.value="";
		document.getElementById('ycodeeo').SelectedIndex=0;
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.ycodee.value="";
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.ycodee.value=document.frmaddDepartment.ycodeeo.value;
		document.getElementById('subsubdivgood').innerHTML="";
	}
}

function ycodchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.ycodee.value="";
		document.getElementById('ycodee').SelectedIndex=0;
		//document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
		//document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
	}
}
function lot2chko(lotchval)
{
	if(document.frmaddDepartment.ycodeeo.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.txtlot2.value=document.frmaddDepartment.txtlot2o.value;
		document.getElementById('subsubdivgood').innerHTML="";
	}
}
function lot2chk()
{
	if(document.frmaddDepartment.ycodee.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
	}
}
function slocshow()
{
	if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		//document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
	var lotno=document.frmaddDepartment.pcode.value+document.frmaddDepartment.ycodee.value+document.frmaddDepartment.txtlot2.value+"/"+document.frmaddDepartment.stcode.value;
	
	var subid=document.frmaddDepartment.subtrid.value;
	var clasid=document.frmaddDepartment.txtcrop.value;
	var itmid=document.frmaddDepartment.txtvariety.value;
	var stage=document.frmaddDepartment.txtstage.value;
	showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,lotno,subid,'');
	}
}

function actnob()
{
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtactnob.value="";
		return false;
	}
	if(document.frmaddDepartment.txtactnob.value<=0)
	{
		alert("NoB cannot be Zero");
		document.frmaddDepartment.txtactnob.value="";
		return false;
	}
	if(document.frmaddDepartment.lotcheck1.value > 0)
	{

		alert("Lot Number already present in System");
		document.frmaddDepartment.txtactnob.value="";
		document.frmaddDepartment.stcode.focus();
	}
}
function actqty(qtyval)
{
	if(qtyval>0)
	{
		if(document.frmaddDepartment.txtactnob.value=="")
		{
			alert("Please enter NoB");
			document.frmaddDepartment.txtactqty.value="";
			return false;
		}
		if(document.frmaddDepartment.txtactnob.value<=0)
		{
			alert("NoB cannot be Zero");
			document.frmaddDepartment.txtactqty.value="";
			return false;
		}
	}
	else
	{
		alert("Qty cannot be Zero");
		document.frmaddDepartment.txtactqty.value="";
		return false;
	}
}
function varchk(val)
{
	if(document.frmaddDepartment.txtactqty.value=="")
	{
		alert("Please enter Qty");
		document.frmaddDepartment.qcstatus.value="";
		return false;
	}
	//alert(val);
	if(val!="OK" && val!="Fail")
	{
	document.getElementById('txtgerm').disabled=true;
	document.getElementById('txtgerm').value="";
	slocshow();
	}
	else
	{
	document.getElementById('txtgerm').disabled=false;
	document.getElementById('txtgerm').value="";
	slocshow();
	}
}

function dotchk(val)
{
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		showCalendar(val)
	}
	else
	{
		alert("Date of Test cannot be selected for Retest or UT QC Status");
		return false;
	}
}

function qcchk()
{
	if(document.frmaddDepartment.qcstatus.value=="")
	{
		alert("Please Select QC Status");
		document.frmaddDepartment.txtpp.value="";
		return false;
	}
}
function moischk(mosval)
{
	var f=0;
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please Select PP");
		document.frmaddDepartment.txtmoist.value="";
		f=1;
		return false
	}
	if(parseFloat(mosval)>99.9)
	{
		alert("Invalid Moisture % value");
		document.frmaddDepartment.txtmoist.value="";
		document.frmaddDepartment.txtmoist.focus();
		f=1;
		return false
	}
	if(f!=0)
	{
		return false;
	}
	else
	{
		slocshow();
	}	
}
function gemp(val)
{
	var f=0;
	if(document.frmaddDepartment.txtmoist.value=="")
	{
		alert("Please Enter Moisture %");
		f=1;
		document.frmaddDepartment.txtgemp.value="";
	}
	if(document.frmaddDepartment.txtmoist.value < 0)
	{
		alert("Please Enter Valid Moisture %");
		f=1;
		document.frmaddDepartment.txtgemp.value="";
	}
	if(parseFloat(val)>100)
	{
		alert("Invalid Germination %");
		f=1;
		document.frmaddDepartment.txtgemp.value="";
		document.frmaddDepartment.txtgemp.focus();
	}
	if(f!=0)
	{
		return false;
	}
	else
	{
		slocshow();
	}
}

function gempchk()
{
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		if(document.frmaddDepartment.txtgemp.value=="")
		{
			alert("Please Enter Germination %");
			document.frmaddDepartment.txtgottyp.value="";
		}
	}
}

function gottypchk()
{
	if(document.frmaddDepartment.txtgottyp.value=="")
	{
		alert("Please Select GOT Type");
		/*document.frmaddDepartment.gotstatus.value="";*/
	}
	else
	{
	var lotno=document.frmaddDepartment.pcode.value+document.frmaddDepartment.ycodee.value+document.frmaddDepartment.txtlot2.value+"/"+document.frmaddDepartment.stcode.value;
	
	var subid=document.frmaddDepartment.subtrid.value;
	var clasid=document.frmaddDepartment.txtcrop.value;
	var itmid=document.frmaddDepartment.txtvariety.value;
	var stage=document.frmaddDepartment.txtstage.value;
	showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,lotno,subid,'');
	}
}	

function dogtchk(val)
{
	if(document.frmaddDepartment.gotstatus.value=="OK" || document.frmaddDepartment.gotstatus.value=="Fail")
	{
		showCalendar(val)
	}
	else
	{
		alert("Date of GOT Test cannot be selected for Retest or UT GOT Status");
		return false;
	}
}
	
function gotschk()
{
	if(document.frmaddDepartment.stcode.value=="")
	{
		alert("Invalid Lot Number");
		//document.frmaddDepartment.txtstage.value="";
		/*document.frmaddDepartment.ycodee.value="";
		document.getElementById('ycodee').SelectedIndex=0;
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";*/
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	if(document.frmaddDepartment.lotcheck1.value > 0)
	{
		alert("Lot Number already present in System");
		//document.frmaddDepartment.txtstage.value="";
		document.frmaddDepartment.stcode.focus();
	}
	/*document.frmaddDepartment.ycodee.value="";
	document.getElementById('ycodee').SelectedIndex=0;
	document.frmaddDepartment.txtlot2.value="";
	document.frmaddDepartment.stcode.value="";
	document.getElementById('subsubdivgood').innerHTML="";*/
}
function openprintsubbin(subid, bid, wid, lid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm="";
var tp="";
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function wh1(wh1val)
{ 
	if(document.frmaddDepartment.stcode.value!="")
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
		document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		document.frmaddDepartment.txtslsubbg1.value="";
	}
	else
	{
		alert("Please enter Lot Number");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.stcode.value!="")
	{
		showUser(wh2val,'bing2','wh','bing2','','','','');
		document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		document.frmaddDepartment.txtslsubbg2.value="";
	}
	else
	{
		alert("Please enter Lot Number");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
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

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	
		var slocnogood=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtslBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.txtslBagsg1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslsubbg1.value="";
		document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		document.frmaddDepartment.txtslbing1.focus();
		return false;
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
			return false;
		}
		
		if(document.frmaddDepartment.txtslsubbg1.value!="")
		
		var slocnogood=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtslBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslsubbg2.value="";
		document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function Bagsf1(Bags1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg1.value="";
	}
	if(document.frmaddDepartment.txtslBagsg1.value!="")
	{
		if(parseInt(document.frmaddDepartment.txtslBagsg1.value)==0 || document.frmaddDepartment.txtslBagsg1.value=="")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg1.value="";
		}
	}
}

function Bagsf2(Bags2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg2.value="";
		document.frmaddDepartment.txtslsubbg2.focus();
	}
	if(document.frmaddDepartment.txtslBagsg2.value!="")
	{
		if(document.frmaddDepartment.txtslBagsg2.value==0 || document.frmaddDepartment.txtslBagsg2.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg2.value="";
		}
	}
	
}

function qtyf1(qty1val)
{	
	if(document.frmaddDepartment.txtslBagsg1.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg1.value="";
	}
	if(document.frmaddDepartment.txtslqtyg1.value!="")
	{
			if(document.frmaddDepartment.txtslqtyg1.value==0 || document.frmaddDepartment.txtslqtyg1.value=="0")
			{
				alert("Quantity can not be ZERO");
				document.frmaddDepartment.txtslqtyg1.value="";
				document.frmaddDepartment.txtslqtyg1.focus();
			}
			if(parseFloat(qty1val)>99999.999)
			{
				alert("Invalid Quantity");
				//document.frmaddDepartment.txtslqtyg1.value="";
				document.frmaddDepartment.txtslqtyg1.focus();
			}
	}

}

function qtyf2(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg2.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg2.value="";
		document.frmaddDepartment.txtslBagsg2.focus();
	}
	if(document.frmaddDepartment.txtslqtyg2.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg2.value==0 || document.frmaddDepartment.txtslqtyg2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg2.value="";
			document.frmaddDepartment.txtslqtyg2.focus();
		}
		if(parseFloat(qty2val)>99999.999)
			{
				alert("Invalid Quantity");
				//document.frmaddDepartment.txtslqtyg2.value="";
				document.frmaddDepartment.txtslqtyg2.focus();
			}
	}
}

</script>
<body>

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
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
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
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Sales Return Opening Stock - Edit</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
<?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Opening Stock Condition' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['salesr_id'];

	$tdate=$row_tbl['salesr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?> 	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txt11" value="" type="hidden"> 
	<input name="txt14" value="" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />



<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return Opening Stock - Edit</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TSR".$row_tbl['salesr_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date</td>
<td width="229" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
</table>

<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Opening Stock Condition' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="22" align="center" valign="middle" class="tblheading">#</td>
	<td width="85" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="105" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="90" align="center" valign="middle" class="tblheading">Old Lot No.</td>
	<td width="66" align="center" valign="middle" class="tblheading">New Lot No.</td>
	<td width="66" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="70" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="66" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="51" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="78" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="39" align="center" valign="middle" class="tblheading">Gemp %</td>
	<td width="128" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="35" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="39" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

if($row_tbl_sub['salesrs_pp']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['salesrs_pp']=="Not-Acceptable")
{
$cc="NAC";
}

	$trdate=$row_tbl_sub['salesrs_dot'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
		
if($row_tbl_sub['salesrs_qc']!="OK" && $row_tbl_sub['salesrs_qc']!="Fail")
{
$trdate="--";
}


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tbl_salesrsub_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_id='".$row_tbl_sub['salesrs_id']."' order by salesrss_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_sloc['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_sloc['salesrss_bin']."' and whid='".$row_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_sloc['salesrss_subbin']."' and binid='".$row_sloc['salesrss_bin']."' and whid='".$row_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['salesrss_nob']; 
$slqty=$slqty+$row_sloc['salesrss_qty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_gemp'] > 0 ) echo $row_tbl_sub['salesrs_gemp'];?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_gemp'] > 0 ) echo $row_tbl_sub['salesrs_gemp'];?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>
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
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="98" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="107" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="211" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           
<td width="86" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" width="164" valign="middle" class="smalltblheading"  >&nbsp;<input type="hidden" id="txtstage" name="txtstage" value="Condition" />Condition</td>
</tr>
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Old Lot Number&nbsp;</td>
<td align="left" width="270" valign="middle" class="smalltbltext">&nbsp;
  <select class="smalltbltext" name="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey24(event)"  value="" onchange="stchko();" onblur="Javascript:this.value=this.value.toUpperCase()" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="3" class="smalltbltext" tabindex="0" maxlength="3" onkeypress="return isNumberKey24(event)"  value="000" onchange="stchko2();" onblur="Javascript:this.value=this.value.toUpperCase()" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotchko"><input type="hidden" name="lotchecko" value="0" /></div></td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchk();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="00" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotcheck"><input type="hidden" name="lotcheck1" value="0" /></div></td>	
</tr>

<tr class="Light" height="30">
<!--<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"  >&nbsp;<input name="txtactqty" type="text" size="9" class="smalltbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey(event)" onchange="actqty(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6" >QC Information</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="qcstatus" style="width:100px;"  onchange="varchk(this.value);"  >
    <option value="" selected>--Select--</option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
	<option value="UT" >UT</option>
    
  </select>  <font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">Date of Test (DoT)&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"   >&nbsp;<input name="edate" id="edate1" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('edate1');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
          
	 
</tr>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtpp" style="width:110px;" onchange="qcchk();">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="smalltbltext" tabindex="" onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
	   <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtgemp" id="txtgerm" type="text" size="1" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="gemp(this.value);"/>%&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

           </tr>
		   
</table>
<div id="subsubdivgood" style="display:block"></div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_optrn.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  