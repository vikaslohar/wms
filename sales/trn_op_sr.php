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
	exit;
	   	$p_id=trim($_POST['maintrid']);
		echo "<script>window.location='trn_arrvop_qty_preview.php?pid=$p_id'</script>";	
			
	}
	$sql_code="SELECT MAX(arrival_code) FROM tblarrival where plantcode='$plantcode' AND arrival_type='Sales Return'  ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TSR".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TSR".$code."/".$yearid_id."/".$lgnid;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival - Transaction - Opening Stock</title>
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
	dt2=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.edate.value,"-");
	
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
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	if(val7=="")
	{
		alert("Please Select Plant code");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Lot No.");
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
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		if(document.frmaddDepartment.txtgemp.value=="")
		{
			alert("Please Select Germination %");
			document.frmaddDepartment.txtgemp.focus();
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.txtgottyp.value=="")
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
	dt2=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.edate.value,"-");
	
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
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	if(val7=="")
	{
		alert("Please Select Plant code");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Lot No.");
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
	if(document.frmaddDepartment.qcstatus.value=="OK" || document.frmaddDepartment.qcstatus.value=="Fail")
	{
		if(document.frmaddDepartment.txtgemp.value=="")
		{
			alert("Please Select Germination %");
			document.frmaddDepartment.txtgemp.focus();
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.txtgottyp.value=="")
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
	document.getElementById('txtstage').SelectedIndex=0;
	document.frmaddDepartment.txtstage.value="";
	document.getElementById('ycodee').SelectedIndex=0;
	document.frmaddDepartment.txtlot2.value="";
	document.frmaddDepartment.stcode.value="";
	document.getElementById('subsubdivgood').innerHTML="";
	showUser(classval,'vitem','item','','','','','');
}
function modetchk1(classval)
{
	//document.getElementById('itm').SelectedIndex=0;
	document.getElementById('txtstage').SelectedIndex=0;
	document.frmaddDepartment.txtstage.value="";
	document.getElementById('ycodee').SelectedIndex=0;
	document.frmaddDepartment.txtlot2.value="";
	document.frmaddDepartment.stcode.value="";
	document.frmaddDepartment.gotstatus.value="";
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
		var txtstage=document.frmaddDepartment.txtstage.value;
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
	else
	{
		var val1=document.frmaddDepartment.pcode.value;
		var val2=document.frmaddDepartment.ycodee.value;
		var val3=document.frmaddDepartment.txtlot2.value;
		var val4=document.frmaddDepartment.stcode.value;
		var lot=val1+val2+val3+"/"+val4;		
		document.frmaddDepartment.gotstatus.value="";
		showUser(lot,'lotcheck','lotchk',val1,val2,val3,val4,'','');
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

function ycodchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.ycodee.value="";
		document.getElementById('ycodee').SelectedIndex=0;
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
		document.getElementById('subsubdivgood').innerHTML="";
		return false;
	}
	else
	{
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="";
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
	}
	else
	{
	document.getElementById('txtgerm').disabled=false;
	document.getElementById('txtgerm').value="";
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
		if(document.frmaddDepartment.txtpp.value=="")
		{
			alert("Please Select PP");
			document.frmaddDepartment.txtmoist.value="";
		}
		if(parseFloat(mosval)>99.9)
		{
			alert("Invalid Moisture % value");
			document.frmaddDepartment.txtmoist.value="";
			document.frmaddDepartment.txtmoist.focus();
		}
}
function gemp(val)
{
		if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Please Enter Moisture %");
			document.frmaddDepartment.txtgemp.value="";
		}
		if(document.frmaddDepartment.txtmoist.value < 0)
		{
			alert("Please Enter Valid Moisture %");
			document.frmaddDepartment.txtgemp.value="";
		}
		if(parseFloat(val)>100)
		{
			alert("Invalid Germination %");
			document.frmaddDepartment.txtgemp.value="";
			document.frmaddDepartment.txtgemp.focus();
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
		document.frmaddDepartment.gotstatus.value="";
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
		document.frmaddDepartment.txtstage.value="";
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
		document.frmaddDepartment.txtstage.value="";
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Sales Return Opening Stock Add</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>
<?php
$tid=0; $subtid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return Opening Stock Add</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
</table>

<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
				<td width="22" align="center" valign="middle" class="tblheading">#</td>
			    <td width="85" align="center" valign="middle" class="tblheading">Crop</td>
			    <td width="105" align="center" valign="middle" class="tblheading">Variety</td>
				<td width="90" align="center" valign="middle" class="tblheading">Lot No.</td>
				<td width="66" align="center" valign="middle" class="tblheading">UPS</td>
				<td width="66" align="center" valign="middle" class="tblheading">NoP</td>
                <td width="70" align="center" valign="middle" class="tblheading">Qty</td>
				<td width="66" align="center" valign="middle" class="tblheading">Stage</td>
			    <td width="51" align="center" valign="middle" class="tblheading">QC Status</td>
		        <td width="78" align="center" valign="middle" class="tblheading">DoT</td>
		        <td width="39" align="center" valign="middle" class="tblheading">Gemp %</td>
			    <td width="128" align="center" valign="middle" class="tblheading">SLOC</td>
			    <td width="35" align="center" valign="middle" class="tblheading">Edit</td>
    			<td width="39" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
			  <?php $subtbltot=0;?>
			 <input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
          </table>
		  <br />
 <div id="postingsubtable" style="display:block">		 
		<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="101" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropname'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="117" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="191" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['popularname'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           
<td width="102" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" width="213" valign="middle" class="tbltext"  >&nbsp;<input type="hidden" id="txtstage" name="txtstage" value="Pack" />Pack</td>
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
<td align="left" width="232" valign="middle" class="tblheading">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex="0" maxlength="20" value="" style="background-color:#CCCCCC" readonly="true" />&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="tblheading" colspan="3" >&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchk();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="00" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotcheck"><input type="hidden" name="lotcheck1" value="0" /></div></td>	
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtactqty" type="text" size="9" class="tbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey(event)" onchange="actqty(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6" >Quality Details</td>
</tr>

<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpp" style="width:110px;" onchange="qcchk();">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex="" onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
	   <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtgemp" id="txtgerm" type="text" size="1" class="tbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="gemp(this.value);"/>%&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

           </tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="qcstatus" style="width:100px;"  onchange="varchk(this.value);"  >
    <option value="" selected>--Select--</option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
	<option value="UT" >UT</option>
    
  </select>  <font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">Date of Test (DoT)&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3"   >&nbsp;<input name="edate" id="edate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('edate1');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
          
	 
</tr>		   
</table>
<div id="subsubdivgood" style="display:block">
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="11">SLOC</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="160" align="center" valign="middle" class="tblheading">WH</td>
<td width="106" align="center" valign="middle" class="tblheading">Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Comments</td>
<td width="162" align="center" valign="middle" class="tblheading">Master Packs</td>
<td width="162" align="center" valign="middle" class="tblheading">Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>
</tr>
<tr class="light" height="25">
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg1" name="txtwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing1" id="txtbing1" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg1" id="txtsubbg1" style="width:60px;" onchange="subbin(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview1" id="existview1" class="tbltext" value="" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_1" id="nopmpcs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_1" id="noppchs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_1" id="noptpchs_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_1" id="noptqtys_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg2" name="txtwhg2" style="width:70px;" onchange="wh(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn2"><select class="smalltbltext" name="txtbing2" id="txtbing2" style="width:60px;" onchange="bin(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn2"><select class="smalltbltext" name="txtsubbg2" id="txtsubbg2" style="width:60px;" onchange="subbin(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview2" id="existview2" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
</table>
</div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
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

  