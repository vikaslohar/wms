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
		$p_id=trim($_POST['maintrid']);
		$dcdate=trim($_POST['dcdate']);
		$dcdate1=trim($_POST['dcdate']);
		$txtdcnumber=trim($_POST['txtdcnumber']);
		$txt11=trim($_POST['txt11']);
		$remarks=trim($_POST['txtremarks1']);
		$remarks=str_replace("&","and",$remarks);
		
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
		
		echo "<script>window.location='pdn_fresh1_preview.php?p_id=$p_id&dcdate=$dcdate&dcdate1=$dcdate1&txtdcnumber=$txtdcnumber&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&remarks=$remarks'</script>";	
		
		
	}

	$sql_code="SELECT MAX(arrival_code) FROM tbl_dryarrival where  plantcode='".$plantcode."' and   arrival_type='Fresh Seed with PDN'  ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAF".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAF".$code."/".$yearid_id."/".$lgnid;
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying- Transaction - Fresh Seed Arrival with PDN</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

</head>

<script src="farrival.js"></script>

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

function imgOnClick(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.txtpdndate,dt,document.frmaddDepartment.txtpdndate, "dd-mmm-yyyy", xind, yind);
	}  
function imgOnClick1(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}  
function imgOnClick2(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.dcdate,dt,document.frmaddDepartment.dcdate, "dd-mmm-yyyy", xind, yind);
	}  	
function imgOnClick3(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.dcdate1,dt,document.frmaddDepartment.dcdate1, "dd-mmm-yyyy", xind, yind);
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
	var zxt=document.frmaddDepartment.gotstatus.value.split(" ");
	if(document.frmaddDepartment.txt11.value!="")
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
	dt1=getDateObject(document.frmaddDepartment.txtpdndate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.cdate.value,"-");
	dt5=getDateObject(document.frmaddDepartment.dcdate1.value,"-");
	
	if(document.frmaddDepartment.dcdate.value!="")
	{		
	/*if(dt1 < dt2)
	{
	alert("Please select Valid PDN Date.");
	return false;
	}*/
	if(dt1 > dt4)
	{
	alert("PDN Date cannot be more than todays Date.");
	return false;
	}
	if(dt1 > dt3)
	{
	alert("Please select Valid DC Date.");
	return false;
	}
	
	/*if(dt2 > dt1)
	{
	alert("Please select Valid Date of Harvest.");
	return false;
	}*/
	if(dt2 > dt3)
	{
	alert("Please select Valid Date of Harvest.");
	return false;
	}
	if(dt2 > dt4)
	{
	alert("Please select Valid Date of Harvest.");
	return false;
	}
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	if(dt3 > dt5)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	if(dt3 < dt2)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	if(dt3 < dt1)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	
	if(dt4 < dt5)
	{
	alert("Please select Valid Date of Dispatch.");
	return false;
	}
	}		
			
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
				//}

	if(document.frmaddDepartment.txtpdno.value=="")
	{
		alert("Please Enter PDN No.");
		document.frmaddDepartment.txtpdno.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtgstat.value=="")
	{
		alert("Please select Got.");
		document.frmaddDepartment.txtgstat.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtactnob.value=="")
	{
		alert("Please enter Bags Received Good");
		document.frmaddDepartment.txtactnob.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtactqty.value=="")
	{
		alert("Please enter Quantity Received Good");
		document.frmaddDepartment.txtactqty.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtvisualck.value=="Not-Acceptable" && document.frmaddDepartment.txtremarks.value=="")
		{
			alert("Please enter reason");
			document.frmaddDepartment.txtremarks.focus();
			return false;
		}
	
	else if(zxt[0]!= document.frmaddDepartment.txtgstat.value)
	{
		alert("GOT Type and GOT Status not matching");
		document.getElementById('tmt').SelectedIndex=0;
		return false;
	}
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
	{
		alert("Warehouse Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
	{
		alert("Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;
	} 
	else
	{	//alert("hi");
		var f=0;
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var g=document.frmaddDepartment.txtactqty.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		if(g==0)
		{
		alert("Please check. Quantity Received cannot be Zero or Blank");
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
		showUser(a,'postingtable','mformupdate','','','','','');
		
		}  
	}
}

function pformedtup()
{	
	var zxt=document.frmaddDepartment.gotstatus.value.split(" ");
	if(document.frmaddDepartment.txt11.value!="")
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
	dt1=getDateObject(document.frmaddDepartment.txtpdndate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.cdate.value,"-");
	dt5=getDateObject(document.frmaddDepartment.dcdate1.value,"-");
	if(document.frmaddDepartment.dcdate.value!="")
				{	
	/*if(dt1 < dt2)
	{
	alert("Please select Valid PDN Date.");
	return false;
	}*/
	if(dt1 > dt4)
	{
	alert("PDN Date cannot be more than todays Date.");
	return false;
	}
	if(dt1 > dt3)
	{
	alert("Please select Valid DC Date.");
	return false;
	}
	
	/*if(dt2 > dt1)
	{
	alert("Please select Valid Date Of Harvest.");
	return false;
	}*/
	if(dt2 > dt3)
	{
	alert("Please select Valid Date Of Harvest.");
	return false;
	}
	if(dt2 > dt4)
	{
	alert("Please select Valid Date Of Harvest.");
	return false;
	}
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	if(dt3 > dt5)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	if(dt3 < dt2)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	if(dt3 < dt1)
	{
	alert("Please select Valid Delivery Challan Date.");
	return false;
	}
	}
	/*if(dt5 < dt1)
	{
	alert("Please select Valid Delivary Challan Date.");
	return false;
	}*/
	if(document.frmaddDepartment.txtpdno.value=="")
	{
		alert("Please Enter PDN No.");
		document.frmaddDepartment.txtpdno.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtgstat.value=="")
	{
		alert("Please select Got.");
		document.frmaddDepartment.txtgstat.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtactnob.value=="")
	{
		alert("Please enter Bags Received Good");
		document.frmaddDepartment.txtactnob.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtactqty.value=="")
	{
		alert("Please enter Quantity Received Good");
		document.frmaddDepartment.txtactqty.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtvisualck.value=="Not-Acceptable" && document.frmaddDepartment.txtremarks.value=="")
		{
			alert("Please enter reason");
			document.frmaddDepartment.txtremarks.focus();
			return false;
		}
	
	else if(zxt[0]!= document.frmaddDepartment.txtgstat.value)
	{
		alert("GOT Type and GOT Status not matching");
		document.getElementById('tmt').SelectedIndex=0;
		return false;
	}
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
	{
		alert("Warehouse Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
	{
		alert("Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;
	} 
	else
	{	
		var f=0;
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var g=document.frmaddDepartment.txtactqty.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		if(g==0)
		{
		alert("Please check. Quantity Received cannot be Zero or Blank");
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
		showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}

function clk2(opt)
{
	
	if(opt!="")
	{
		if(opt=="organiser")
		{
			document.getElementById('organiser').style.display="block";
			document.getElementById('farmer').style.display="none";
			document.frmaddDepartment.satype.value=opt;
		}
		else if(opt=="farmer")
		{
			document.getElementById('organiser').style.display="none";
			document.getElementById('farmer').style.display="block";
			document.frmaddDepartment.satype.value=opt;
		}	
	}
	else
	{
		alert("Please Select Seed Receives From");
		document.frmaddDepartment.txtgrn.value="";
	}
	}
	

function clk(opt)
{
	if(document.frmaddDepartment.dcdate1.value=="")
	{
			alert("Please select Dispatch Date.");
			for(i=0;i<document.frmaddDepartment.txt1.length;i++)
			{
			document.frmaddDepartment.txt1[i].checked=false;
			}
			return false;
	}
	else
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
				alert("Please Select Mode of Transport");
				document.frmaddDepartment.txt11.value="";
			}
	}
}
	
function clk3(opt)
{

	if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Enter Moisture");
			document.frmaddDepartment.txtmoist.focus();
			document.getElementById("tvisualck").selectedIndex=0;
			return false;
		}
	if(opt!="")
	{
		if(opt=="Not-Acceptable")
		{
			document.getElementById('transs').style.display="block";
			document.frmaddDepartment.satype1.value=opt;
		}
		else
		{
			document.getElementById('transs').style.display="none";
			document.frmaddDepartment.satype1.value=opt;
		}	
	}
	else
		{
			document.getElementById('transs').style.display="none";
			document.frmaddDepartment.satype1.value=opt;
		}	
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
function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
function clk1(val)
{
document.frmaddDepartment.txt14.value=val;
}

function showslocbins()
{
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
}

function openslocpop()
{

if(document.frmaddDepartment.txt1.value=="")
{
 alert("Please Select Mode of Transit.");
}
else
{
document.getElementById("postingsubtable").style.display="none";
var itm="Fresh Seed with PDN";
winHandle=window.open('getuser_fpdn_lotno.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}


function openslocpop1()
{
var vr=document.frmaddDepartment.txtvariety.value+"-";
var vr1=vr.split("-");
//alert(vr1[1]);
if(document.frmaddDepartment.sstage.value=="")
{
 alert("Please Select Seed Stage.");
 //document.frmaddDepartment.txt1.focus();
}
if(vr1[1]=="Coded")
{
 alert("Coded Variety cannot be added for Drying");
 //document.frmaddDepartment.txt1.focus();
}
else
{
var itm=document.frmaddDepartment.sstatus.value;
var stage=document.frmaddDepartment.sstage.value;
winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
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

function editrec(edtrecid)
{
var tid=document.frmaddDepartment.maintrid.value;
document.getElementById('postingsubtable').style.display="block";
showUser(edtrecid,'postingsubtable','etdrec',tid,'','','','');
}

function deleterec(v1,v2,v3)
{
	if(confirm('Do You wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','fpdndelete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}


function showtbl()
{
	if(document.frmaddDepartment.grnnumber.value=="")
	{
	alert("Please enter GRN Number");
	return false;
	}
}

/*function noofpdnchk()
{
		if(document.frmaddDepartment.grnnumber.value=="")
		{
			alert("Enter GRN Number");
			document.frmaddDepartment.txtdcnumber.value="";
			return false;
		}
}*/

function pper(plocid)
{
	if(document.frmaddDepartment.spcodef.value!="")
	{
		showUser(plocid,'personnel','ppersonnel','','','','','');
	}
}

function farm(pperid)
{
	if(document.frmaddDepartment.txtloc.value!="")
	{
		showUser(pperid,'farm','farm','','','','','');
	}
}

function spmchk(spm)
{
		if(document.frmaddDepartment.txtpdno.value=="")
		{
			alert("Enter PDN Number");
			document.frmaddDepartment.spcodem.value="";
		}

}

function spfchk(spf)
{
		if(document.frmaddDepartment.spcodem.value=="")
		{
			alert("Enter SP Code Male");
			document.frmaddDepartment.spcodef.value="";
		}
		else
		{
			var spm=document.frmaddDepartment.spcodem.value;
			showUser(spm,'crver','cropver',spf,'','','','');
		}
}

function plnchk()
{
		if(document.frmaddDepartment.organi.value!="" && document.frmaddDepartment.txtfar.value=="")
		{
			alert("Select Farmer");
			document.frmaddDepartment.txtplot.value="";
		}
}

function gichk(gcod)
{
	var one=gcod.charAt(0);
	if(document.frmaddDepartment.txtpdno.value=="")
	{
		alert("Enter PDN Number");
		document.frmaddDepartment.txtpdno.value="";
	}
	else if(document.frmaddDepartment.txtpdndate.value=="")
	{
		alert("Select PDN Date");
		document.frmaddDepartment.gcode.value="";
	}
	else if(gcod.length < 3)
	{
		alert("Geographic Index can not be less than 3 digits.");
		document.frmaddDepartment.gcode.value="";
		document.frmaddDepartment.gcode.focus();
		return false;
	}
	else if(one%2==0)
	{
		alert("Invalid Geographic Index.");
		document.frmaddDepartment.gcode.value="";
		document.frmaddDepartment.gcode.focus();
		return false;
	}
}

function gotchk(gchk)
{
		if(document.frmaddDepartment.txtvisualck.value=="")
		{
			alert("Please Select Physical Purity");
			document.frmaddDepartment.txtvisualck.focus();
		}
		if(document.frmaddDepartment.txtvisualck.value=="Not-Acceptable")
		{
			if(document.frmaddDepartment.txtremarks.value=="")
			{
			alert("Please enter reason");
			document.frmaddDepartment.txtremarks.focus();
			return false;
			}
		}
		/*if(document.frmaddDepartment.txtqc.value=="")
		{
			alert("Select QC Status");
			document.frmaddDepartment.txtgstat.SelectedIndex=0;
			return false;
		}
		
		if(document.frmaddDepartment.autogotstatus.value=="Mandatory" || document.frmaddDepartment.autogotstatus.value=="")
		{
			document.frmaddDepartment.gotstatus.value=gchk+' UT';
			document.frmaddDepartment.gscheckbox.value=1;
		}*/
		else
		{
			if(gchk=="GOT-NR")
			{ 	
				document.frmaddDepartment.gotsample.checked=false;
				//document.getElementById('gscb').disabled=false;
				if(document.frmaddDepartment.gotsample.checked==false)
				{ 
					document.frmaddDepartment.gotstatus.value=gchk+' NUT';
					document.frmaddDepartment.gscheckbox.value=0;
				}
				else
				{ 
					document.frmaddDepartment.gotstatus.value=gchk+' UT';
					document.frmaddDepartment.gscheckbox.value=0;
				}
			}
			else if(gchk=="GOT-R")
			{
					document.frmaddDepartment.gotstatus.value=gchk+' UT';
					document.frmaddDepartment.gotsample.checked=true;
					document.getElementById('gscb').disabled=true;
					document.frmaddDepartment.gscheckbox.value=0;
			}
			else
			{
					document.frmaddDepartment.gotstatus.value="";
					/*document.frmaddDepartment.gotsample.checked=false;
					document.getElementById('gscb').disabled=false;
					document.frmaddDepartment.gscheckbox.value=0;*/

			}
		}
}

function gensmpchk()
{
	if(document.frmaddDepartment.gotsample.checked==false)
	{ 
		document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgstat.value+' NUT';
		//document.getElementById('qcstatusid').style.display="block"
		//document.getElementById('qcstatusid1').style.display="none"
		//document.frmaddDepartment.txtqc1.value="UT";
		document.frmaddDepartment.gscheckbox.value=0;
	}
	else
	{ 
		document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgstat.value+' UT';
		//document.getElementById('qcstatusid').style.display="none"
		//document.getElementById('qcstatusid1').style.display="block"
		//document.frmaddDepartment.txtqc1.value="UT";
		document.frmaddDepartment.gscheckbox.value=0;
	}
}

function visuchk1()
{
		if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Enter Moisture");
			document.frmaddDepartment.txtvisualck.SelectedIndex=0;
			return false;
		}
}

function visuchk(qval)
{
		if(document.frmaddDepartment.txtvisualck.value=="")
		{
			alert("Select Physical Purity");
			document.frmaddDepartment.txtqc.SelectedIndex=0;
			return false;
		}
		else
		{
			//document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgstat.value+' '+qval;
			document.frmaddDepartment.txtqc1.value=qval;
		}
}
function qtychk1()
{
		if(document.frmaddDepartment.txtactnob.value=="")
		{
			alert("Enter Actual Number of Bags");
			document.frmaddDepartment.txtdcnob.value="";
			document.frmaddDepartment.txtdiffnob.value="";
		}
		else if(parseFloat(document.frmaddDepartment.txtdcqty.value)>99999.999)
		{
			alert("Invalid Quantity");
			document.frmaddDepartment.txtdcqty.value="";
			document.frmaddDepartment.txtdcqty.focus();
		}
		else if(document.frmaddDepartment.txtdcqty.value!="" && document.frmaddDepartment.txtactqty.value!="")
		{
		document.frmaddDepartment.txtdiffqty.value=Math.round((parseFloat(document.frmaddDepartment.txtactqty.value)-parseFloat(document.frmaddDepartment.txtdcqty.value))*1000)/1000;
		}
		else
		{
		document.frmaddDepartment.txtdiffqty.value="";
		}
}

function qtychk2(actgqty)
{
		if(document.frmaddDepartment.txtdcqty.value=="")
		{
			alert("Enter Quantity as per PDN");
			document.frmaddDepartment.txtactqty.value="";
			document.frmaddDepartment.txtdiffqty.value="";
		}
		else if(parseFloat(actgqty)>99999.999)
		{
			alert("Invalid Quantity");
			document.frmaddDepartment.txtactqty.focus();
		}
		else if(document.frmaddDepartment.txtdcqty.value!="" && document.frmaddDepartment.txtactqty.value!="")
		{
			document.frmaddDepartment.txtdiffqty.value=Math.round((parseFloat(document.frmaddDepartment.txtactqty.value)-parseFloat(document.frmaddDepartment.txtdcqty.value))*1000)/1000;/*document.frmaddDepartment.txtdiffqty.value=parseFloat(document.frmaddDepartment.txtactqty.value)-parseFloat(document.frmaddDepartment.txtdcqty.value);*/
		}
		else
		{
		document.frmaddDepartment.txtdiffqty.value="";
		}
		
}

function bagschk1()
{
		/*if(document.frmaddDepartment.gcode.value=="")
		{
			alert("Enter Geographic Index");
			document.frmaddDepartment.txtdcnob.value="";
			return false;
		}*/
		if(document.frmaddDepartment.sdate.value=="")
		{
			alert("Select Harvest Date");
			document.frmaddDepartment.txtdcnob.value="";
			return false;
		}
		if(document.frmaddDepartment.txtdcnob.value!="" && document.frmaddDepartment.txtactnob.value!="")
		{
		document.frmaddDepartment.txtdiffnob.value=parseInt(document.frmaddDepartment.txtactnob.value)-parseInt(document.frmaddDepartment.txtdcnob.value);
		}
		else
		{
		document.frmaddDepartment.txtdiffnob.value="";
		}
		
}

function bagschk2(actbags)
{
		if(document.frmaddDepartment.txtdcnob.value=="")
		{
			alert("Enter Number of Bags as per PDN");
			document.frmaddDepartment.txtactnob.value="";
			document.frmaddDepartment.txtdiffnob.value="";
		}
		if(document.frmaddDepartment.txtdcnob.value!="" && document.frmaddDepartment.txtactnob.value!="")
		{
		document.frmaddDepartment.txtdiffnob.value=parseInt(document.frmaddDepartment.txtactnob.value)-parseInt(document.frmaddDepartment.txtdcnob.value);
		}
		else
		{
		document.frmaddDepartment.txtdiffnob.value="";
		}
}

function moischk(mosval)
{
		if(document.frmaddDepartment.txtactqty.value=="")
		{
			alert("Enter Actual Quantity");
			document.frmaddDepartment.txtmoist.value="";
		}
		/*if(parseFloat(mosval)>99.9)
		{
			alert("Invalid Moisture % value");
			document.frmaddDepartment.txtmoist.value="";
			document.frmaddDepartment.txtmoist.focus();
		}*/
}

function sschk(stage)
{
		var v=document.frmaddDepartment.txtvariety.value;
		var nv=document.frmaddDepartment.txtcrop.value+"-"+"Coded";
		if(document.frmaddDepartment.txtgstat.value=="")
		{
			alert("Please Select GOT Type");
			
			document.getElementById('tmt').selectedIndex=0;
			document.frmaddDepartment.txtgstat.focus();
			return false;
		}
		else if((v!=nv) && (document.frmaddDepartment.autogotstatus.value==""))
		{
			alert("Auto GOT at Arrival Status cannot be blank");
			document.getElementById('tmt').SelectedIndex=0;
			return false;
		}
		else
		{
			var zxt=document.frmaddDepartment.gotstatus.value.split(" ");
			if(zxt[0]!= document.frmaddDepartment.txtgstat.value)
			{
				alert("GOT Type and GOT Status not matching");
				document.getElementById('tmt').SelectedIndex=0;
				return false;
			}
			else
			{
				var cod="";
				if(stage=="Raw"){cod="R";}else if(stage=="Condition"){cod="C";}else{cod="";}
				document.frmaddDepartment.glotno.value=document.frmaddDepartment.gln.value+cod;
				var clasid=document.frmaddDepartment.cid.value;
				var itmid=document.frmaddDepartment.vid.value;
				showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,'','','');
			}
		}
}

function sstschk()
{
		if(document.frmaddDepartment.sstage.value=="")
		{
			alert("Select Seed Stage");
		}
}

function pdchk()
{
	if(document.frmaddDepartment.txt1.value=="")
	{
	alert("Please Select Mode of Transit");
	}
}
function lot()
{
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
}
	
	
function mySubmit()
{ 
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.cdate.value,"-");
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	return false;
	}
	
			
	
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;	 
}

function wh1(wh1val)
{ 
if(document.frmaddDepartment.txtactqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	else
	{
		alert("Please enter Actual Quantity");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtactqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','','','','');
	}
	else
	{
		alert("Please enter Actual Quantity");
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
	var itemv=document.frmaddDepartment.vid.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	
		var slocnogood=document.frmaddDepartment.sstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		/*if(document.frmaddDepartment.txtslBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.txtslBagsg1.value;
		else*/
		var Bagsv1=document.frmaddDepartment.txtcrop.value;
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		
		var spcodef=document.frmaddDepartment.spcodef.value;
		var spcodem=document.frmaddDepartment.spcodem.value;
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid,spcodef,spcodem);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.vid.value;
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
		
		var slocnogood=document.frmaddDepartment.sstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		/*if(document.frmaddDepartment.txtslBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg2.value;
		else*/
		var Bagsv2=document.frmaddDepartment.txtcrop.value;
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else
		var qtyv2="";
		
		var spcodef=document.frmaddDepartment.spcodef.value;
		var spcodem=document.frmaddDepartment.spcodem.value;
		
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid,spcodef,spcodem);
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
				
			 if(document.frmaddDepartment.txt11.value!="")
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
		document.getElementById("postingsubtable").style.display="block";
		showUser(get,'postingsubtable','get','','','','');
}
}

function ltchk()
{
document.getElementById("postingsubtable").style.display="none";
if(document.frmaddDepartment.txt1.value!="")
{
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
else
{
				alert("Please Select Mode of Transit");
				document.frmaddDepartment.txt1.value="";
				return false;
}
				
}
function qcsamp(clval)
{
	if(document.frmaddDepartment.qc2.checked==true)
	{
		document.frmaddDepartment.txtqc.value="UT";
	}
	else
	{
		document.frmaddDepartment.txtqc.value="";
	}	
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#FAD682" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#FAD682" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#FAD682" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Fresh Seed Arrival with PDN </td>
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
		 <input name="satype" value="" type="hidden"> 
		  <input name="satype1" value="" type="hidden"> 
		 <input name="cdate" value="<?php echo date("d-m-Y");?>" type="hidden"> 
		</br>
<?php
 $tid=0; $subtid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Fresh Seed Arrival with PDN</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="131" align="right" valign="middle" class="tblheading"> Arrival&nbsp;Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="dateofarrival" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#efefef" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Type of Arrival&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="arrivaltype1" type="text" size="35" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="Fresh Seed Arrival With PDN" maxlength="35"/>&nbsp;<input name="arrivaltype" type="hidden" size="35" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="Fresh Arrival With PDN" maxlength="35"/></td>
<td align="right"  valign="middle" class="tblheading">Dispatch Date&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="dcdate1" id="dcdate1"  type="text" size="10" class="tbltext" tabindex="1" readonly="true"  style="background-color:#efefef" value="" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		<!--<td align="right"  valign="middle" class="tblheading">Dispatch Date&nbsp;</td>
    <td align="middle"  valign="middle" class="tbltext">&nbsp;<input name="dcdate1" id="dcdate1" type="text" size="10" class="tbltext" tabindex="1" readonly="true"  style="background-color:#efefef" value="" maxlength="10" onclick="showCalendar('dcdate1')"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->
           </tr>

 <?php
//$quer4=mysqli_query($link,"SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
<!--<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Seed received From&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="receivedfrom" type="radio" class="tbltext" value="organiser" onClick="clk2(this.value);" />Organiser&nbsp;<input name="receivedfrom" type="radio" class="tbltext" value="farmer" onClick="clk2(this.value);" />Farmer&nbsp;<font color="#FF0000">*</font></td>
</tr>-->
<!--</table>
<table id="organiser" align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="display:none; border-color:#adad11" > 
<?php 
//$organizer=mysqli_query($link,"select orgid , orgname from  tblorganiser order by orgid ") or die(mysqli_error($link));
?>
<tr class="Dark" height="30">-->
<!--<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;Organiser&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" style="border-color:#adad11">&nbsp;<select class="tbltext" name="txtorganizer" style="width:180px;" >
<option value="" selected>--Select--</option>
	<?php //while($noticia_class = mysqli_fetch_array($organizer)) { ?>
		<option value="<?php //=$noticia_class['orgid'];?>" />   
		<?php //=$noticia_class['orgname'];?>
		<?php //} ?>
	</select>
	&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;No.Of PDN &nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3" style="border-color:#adad11">&nbsp;<input name="noofpdn" type="text" size="15" class="tbltext" tabindex="" maxlength="15" onchange="showtbl()"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>-->
<!--<table id="farmer" align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="display:none; border-color:#adad11" > -->
<?php 
//$farmer1=mysqli_query($link,"select farmerid , farmername from  tblfarmer order by farmerid ") or die(mysqli_error($link));
?>
<!--<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;Farmer&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" style="border-color:#adad11">&nbsp;<select class="tbltext" name="txtfarmer" style="width:180px;" 	>
<option value="" selected>--Select--</option>
	<?php //while($noticia_class = mysqli_fetch_array($farmer1)) { ?>
		<option value="<?php //=$noticia_class['farmerid'];?>" />   
		<?php //=$noticia_class['farmername'];?>
		<?php //} ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="99" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;No.Of PDN &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3" style="border-color:#adad11">&nbsp;<input name="noofpdn1" type="text" size="15" class="tbltext" tabindex="" maxlength="15"  onchange="showtbl(this.value)"  onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > -->
<tr class="Dark" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td width="205" align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#efefef" value="" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;</td>

	<td width="130" align="right"  valign="middle" class="tblheading">DC No.&nbsp;</td>
    <td width="230" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcnumber" type="text" size="21" class="tbltext" tabindex=""    maxlength="20" />&nbsp;&nbsp;</td>
           </tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="trans" style="display:none; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="230" valign="middle" class="tblheading" >&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txttname" type="text" size="25" class="tbltext" tabindex="" maxlength="25" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="149" align="right"  valign="middle" class="tblheading" >Lorry Receipt No.&nbsp;</td>
<td align="left" width="258" valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25" >
<td align="right" width="230" valign="middle" class="tblheading" >&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="303" valign="middle" class="tbltext"  >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading" >&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txt13" style="width:70px;" onchange="clk1(this.value);" >
<option value="" selected="selected">Select</option>
<option value="TBB">TBB</option>
<option value="To Pay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:none; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse"> 
<tr class="Dark" height="30" >
<td align="right" width="231" valign="middle" class="tblheading" >&nbsp;Courier Name&nbsp;</td>
<td align="left" width="302" valign="middle" class="tbltext" >&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="149" valign="middle" class="tblheading" >&nbsp;Docket No.&nbsp;</td>
<td align="left" width="258" valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>

</table>
</div>
<div id="byhand" style="display:none; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse"> 
<tr class="Dark" height="30" >
<td align="right" width="230" valign="middle" class="tblheading" >&nbsp;Name of Person&nbsp;</td>
<td width="714" colspan="8" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtpname" type="text" size="30" class="tbltext" tabindex=""  maxlength="30" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
  <td width="1%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-F</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-M</td>
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN </td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>
		  <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		   <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">GOT</td>
		 <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td width="4%" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="tblheading">Moist %</td>
      <td width="8%" align="center" valign="middle" class="tblheading">PP</td>
  </tr>
          </table>
		  <br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubtable" style="display:block">
</div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >

<tr>
<td valign="top" align="right"><a href="home_freshpdn.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  