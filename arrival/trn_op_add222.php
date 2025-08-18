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
		echo "<script>window.location='trn_arrvop_qty_preview.php?pid=$p_id'</script>";	
			
	}
	$sql_code="SELECT MAX(arrival_code) FROM tblarrival where arrival_type='Opening Stock'  ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TOP".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TOP".$code."/".$yearid_id."/".$lgnid;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival - Transaction - Opening Stock</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />

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
	/*document.getElementById('txtstage').SelectedIndex=0;
	document.frmaddDepartment.txtstage.value="";
	document.getElementById('ycodee').SelectedIndex=0;
	document.frmaddDepartment.txtlot2.value="";
	document.frmaddDepartment.stcode.value="";*/
	//document.getElementById('subsubdivgood').innerHTML="";
	showUser(classval,'vitem','item','','','','','');
}
function modetchk1(classval)
{
	//document.getElementById('itm').SelectedIndex=0;
	/*document.getElementById('txtstage').SelectedIndex=0;
	document.frmaddDepartment.txtstage.value="";
	document.getElementById('ycodee').SelectedIndex=0;
	document.frmaddDepartment.txtlot2.value="";
	document.frmaddDepartment.stcode.value="";
	document.frmaddDepartment.gotstatus.value="";*/
	//document.getElementById('subsubdivgood').innerHTML="";
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
		winHandle=window.open('getuser_drying_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
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
			alert("Please Enter  NoB ");
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
			alert("Drying Loss is More than 25 % , Please check"); 
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
           <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Opening Stock - Condition Seed (Lots-listed in application)</td>
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

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Opening Stock - Condition Seed (Lots-listed in application)</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
</table>

<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
				<td width="18" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			    <td width="104" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
			    <td width="117" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
				<td width="70" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
				<td width="56" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
				<td width="53" rowspan="2" align="center" valign="middle" class="tblheading">Arrival Qty</td>
				<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Raw Seed Qty</td>
				<td width="71" rowspan="2" align="center" valign="middle" class="tblheading">Difference Qty</td>
				<td colspan="2" align="center" valign="middle" class="tblheading">Condition Seed</td>
				<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
                <td width="57" rowspan="2" align="center" valign="middle" class="tblheading">Dispatch Qty</td>
			    <td width="46" rowspan="2" align="center" valign="middle" class="tblheading">Pack Qty</td>
			    <td width="44" rowspan="2" align="center" valign="middle" class="tblheading">PP Loss</td>
			    <td width="27" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    			<td width="51" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td align="center" valign="middle" class="tblheading">NoB</td>
  <td align="center" valign="middle" class="tblheading">Qty</td>
</tr>
			  <?php $subtbltot=0;?>
			 <input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
          </table>
		  <br />
 <div id="postingsubtable" style="display:block">		 
		<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="175" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropname'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="236" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="271" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['popularname'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" valign="middle" class="tblheading"  >&nbsp;<input type="Hidden" id="txtstage" name="txtstage" value="Condition">Condition</td>
<td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<input name="txtlot1" type="text" size="13" class="tbltext" tabindex="0" maxlength="13" value="" style="background-color:#CCCCCC" readonly="true" />&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>	
</tr>
<tr class="Light" height="30" >
<td align="left" valign="middle" class="tblheading" id="lotdetails" colspan="4">
<table align="center" border="1" width="100%" height="100%" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">Arrival Qty&nbsp;</td>
<td align="left" width="257" valign="middle" class="tblheading">&nbsp;<input name="txtarrqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right" width="236" valign="middle" class="tblheading">Raw Seed Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txtrswqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="" style="background-color:#CCCCCC" readonly="true" />&nbsp;in hand</td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tblheading" colspan="3">&nbsp;<input name="txtplqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="" style="background-color:#CCCCCC" readonly="true" /></td>	
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Condition Seed NoB&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtactnob" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;in hand</td>
<td align="right"  valign="middle" class="tblheading">Condition Seed Qty&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtactqty" type="text" size="9" class="tbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey(event)" onchange="actqty(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;in hand</td>

</tr>
<tr class="Light" height="30" >
<td align="right" width="173"  valign="middle" class="tblheading">Dispatch Qty&nbsp;</td>
<td align="left" width="256" valign="middle" class="tblheading">&nbsp;<input name="txtdispqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td align="right" width="236" valign="middle" class="tblheading">Pack Qty&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<input name="txtpackqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="" />&nbsp;<font color="#FF0000">*</font>&nbsp;in hand</td>	
</tr>
<tr class="Light" height="30" >
<td align="right" width="173"  valign="middle" class="tblheading">Processing &amp; Packing Loss&nbsp;</td>
<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<input name="txtplqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="" style="background-color:#CCCCCC" readonly="true" />&nbsp;till date</td>	
</tr>
</table>
</td>
</tr>	

</table>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="5" align="center" valign="middle" class="tblheading">SLOC Details</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="183" align="center" valign="middle" class="tblheading">WH</td>
    <td width="165" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="211" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="170" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="209" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="183" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
    <td width="165" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
        <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin") or die(mysqli_error($link));
?>
    <td width="211" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
        <select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
          <td  align="center" width="170"  valign="middle" class="tbltext">&nbsp;
            <input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="205" align="center"  valign="middle" class="tbltext">&nbsp;
            <input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="183" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
    <td width="165" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin") or die(mysqli_error($link));
?>
    <td width="211" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
        <tr>
          <td width="170" align="center"  valign="middle" class="tbltext">&nbsp;
            <input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="205"  align="center"  valign="middle" class="tbltext">&nbsp;
            <input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>

</table>
</div>
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

  