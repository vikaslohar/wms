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
	$pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$qcs1=trim($_POST['fet']);
		$p_id=trim($_POST['arrival_id']);
		$adress=trim($_POST['txtaddress']);
		$txtcla=trim($_POST['txtcla']);
		$city=trim($_POST['txtcity']);
		$pin=trim($_POST['txtpin']);
		$state=trim($_POST['txtstate']);
		$party=trim($_POST['txtparty']);
		 $txt12=trim($_POST['txt12']);
		$txt11=trim($_POST['txt11']);
		$party=str_replace("&","and",$party);
		$adress=str_replace("&","and",$adress);
		$adress1=str_replace("&","and",$adress1);
		$city=str_replace("&","and",$city);
		$remarks=str_replace("&","and",$remarks);
		
		$cphno1=trim($_POST['cphno1']);
		$txtmobile=trim($_POST['txtmobile']);
		
		//exit;
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
	
	 $txtlrn = $_POST['txtlrn'];	 
     $txtvn= $_POST['txtvn'];	 
	$tid = $_POST['g'];	 
	$city = $_POST['txtcity'];	 
	$pin = $_POST['txtpin'];	 
	$state = $_POST['txtstate'];	 
	$party = $_POST['txtparty'];	 
	$pname = $_POST['txtpname'];	 
	$txtaddress = $_POST['txtaddress'];	 
	$txtaddress1 = $_POST['txtaddress1'];	 
	$f = $_POST['txtcla'];	 
	$c = $_POST['txtid'];	 
    $dcdate= $_POST['date'];	 
	$txt11 = $_POST['txt11'];	 
    $txttname = $_POST['txttname'];	 
	$lot2= $_POST['txtlot1'];	
	$stage= $_GET['txtstage'];	
    $txt13 = $_POST['txt13'];	 
    $txt12 = $_POST['txt12'];	 
	$txtcontact = $_POST['txtcontact'];	 
	$p = $_POST['txtvariety'];	 
	$txtcname= $_POST['txtcname'];	 
	$txtdc = $_POST['txtdc'];	 
	$ddate1=$dcdate;
		$dday1=substr($ddate1,0,2);
		$dmonth1=substr($ddate1,3,2);
		$dyear1=substr($ddate1,6,4);
		$ddate1=$dyear1."-".$dmonth1."-".$dday1;	
	
	 $sql_main="update tbl_gotqc set party_id='$f', pid='$txt12', pname='$pname', party_name='$party', address='$txtaddress', address1='$txtaddress1', city='$city', pin='$pin', state='$state', std='$txtcontact', contactno='$cphno1', mobileno='$txtmobile', tmode='$txt11', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt13', courier_name='$txtcname', docket_no='$txtdc', lotno='$qcs1' where arrival_id='$pid'";		
	
	 if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		echo "<script>window.location='add_qcgot_preview.php?tid=$pid'</script>";	
	}		
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qty- Transaction -GOT Sample Dispatch</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading1.js"></script>
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
	{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
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
function clk(opt)
{
if(document.frmaddDepartment.txt.value=="")
{
		alert("Please Select QC Site");
	//document.frmaddDepartment.txt11."";
	return false;
	}
	
if(document.frmaddDepartment.txt.value=="Yes")
{

				document.frmaddDepartment.txtparty.value="";
				document.frmaddDepartment.txtaddress.value="";
				document.frmaddDepartment.txtcity.value="";
				document.frmaddDepartment.txtpin.value="";
				document.frmaddDepartment.txtstate.selectedIndex=0;
				document.frmaddDepartment.txtcontact.value="";
	if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Please Enter Party");
	document.frmaddDepartment.txtcla.focus();
	return false;
	}
}

 if(document.frmaddDepartment.txt.value=="No")
{
document.frmaddDepartment.txtcla.selectedIndex=0;

	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please enter Party Name");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}
	if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Please Enter Address ");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Please enter City/Town/Village");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtstate.value=="")
	{
		alert("Please Select State");
		document.frmaddDepartment.txtstate.focus();
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
	if(opt!="")
	{
		if(opt=="Transport")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt1.value=opt;
		}
		else if(opt=="Courier")
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt1.value=opt;
		}	
		else
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="block";
			document.frmaddDepartment.txt1.value=opt;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
		document.frmaddDepartment.txt1.value="";
	}
	}
	
function clkp(opt)
{
	if(opt!="")
	{
	//alert(opt);
		if(opt=="Yes")
		{
			document.getElementById('select').style.display="block";
			document.getElementById('fill').style.display="none";
			document.frmaddDepartment.txt.value=opt;
		}
		else
		{
			document.getElementById('select').style.display="none";
			document.getElementById('fill').style.display="block";
			document.frmaddDepartment.txt.value=opt;
		}	
	}
	else
	{
		alert("Please Select Party");
		document.frmaddDepartment.txt.value="";
		
	}
}
function pform()
{

if(document.frmaddDepartment.txt.value=="")
{
		alert("Please Select QC Site");
	//document.frmaddDepartment.txt11."";
	return false;
	}
if(document.frmaddDepartment.txt.value=="Yes")
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Please Enter Party");
	document.frmaddDepartment.txtcla.focus();
	return false;
	}
}

 if(document.frmaddDepartment.txt.value=="No")
{
	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please enter Party Name");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}
	if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Please Enter Address ");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Please enter City/Town/Village");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtstate.value=="")
	{
		alert("Please Select State");
		document.frmaddDepartment.txtstate.focus();
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
if(document.frmaddDepartment.txt1.value!="")
	{
		if(document.frmaddDepartment.txt1.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Please Enter Transport Name");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
						
			if(document.frmaddDepartment.txtlrn.value=="")
			{
			alert("Please enter Lorry Receipt No");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
			{
			alert("Lorry Receipt No cannot start with space.");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}
			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please Enter Vehicle No");
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
		else if(document.frmaddDepartment.txt1.value=="Courier")
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
			if(document.frmaddDepartment.txtlot1.value=="")
	{
	alert("Please  Select Lot No.");
	document.frmaddDepartment.txtlot1.focus();
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

	if(document.frmaddDepartment.txtlot1.value=="")
			{
			alert("Please enter Lot No.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
			}	
	
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mform','','','','','');
		//alert(a);
		
		}  
	//}
//}

function pformedtup()
{

if(document.frmaddDepartment.txt.value=="Yes")
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Select Party");
	//document.frmaddDept.txtcla.focus();
	return false;
	}
}

 if(document.frmaddDepartment.txt.value=="NO")
{
	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Enter Party Name");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}
	/*if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Please Enter Address 1");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}*/
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Please enter City/Town/Village");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtstate.value=="")
	{
		alert("Please Select State");
		document.frmaddDepartment.txtstate.focus();
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

if(document.frmaddDepartment.txt1.value!="")
	{
		if(document.frmaddDepartment.txt1.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Please Enter Transport Name");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
						
			if(document.frmaddDepartment.txtlrn.value=="")
			{
			alert("Please enter Lorry Receipt No");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
			{
			alert("Lorry Receipt No cannot start with space.");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}
			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please Enter Vehicle No");
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
		else if(document.frmaddDepartment.txt1.value=="Courier")
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
			if(document.frmaddDepartment.txtlot1.value=="")
	{
	alert("Please  Select Lot No.");
	document.frmaddDepartment.txtlot1.focus();
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

	if(document.frmaddDepartment.txtlot1.value=="")
			{
			alert("Please enter Lot No.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
			}	
	
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','','');
		//alert(a);
		}  
		
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function clk1(val)
{
document.frmaddDepartment.txt14.value=val;
}

function openslocpop()
{
if(document.frmaddDepartment.txt.value=="Yes")
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Please Select Party");
	document.frmaddDept.txtcla.focus();
	return false;
	}
}

 if(document.frmaddDepartment.txt.value=="No")
{
	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Enter Party Name");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}
	if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Please Enter Address ");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Please enter City/Town/Village");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtstate.value=="")
	{
		alert("Please Select State");
		document.frmaddDepartment.txtstate.focus();
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

if(document.frmaddDepartment.txt1.value!="")
	{
		if(document.frmaddDepartment.txt1.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Please Enter Transport Name");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
						
			/*if(document.frmaddDepartment.txtlrn.value=="")
			{
			alert("Please enter Lorry Receipt No");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
			{
			alert("Lorry Receipt No cannot start with space.");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}*/
			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please Enter Vehicle No");
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
		else if(document.frmaddDepartment.txt1.value=="Courier")
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
//document.frmaddDepartment.txt11.focus();
}
winHandle=window.open('getuser_trading_lotno1.php','WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}	

function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
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
if(document.frmaddDepartment.txt.value=="")
{
		alert("Please Select Party Name");
	//document.frmaddDepartment.txt.focus();
	return false;
	}

	if(document.frmaddDepartment.txt.value=="Yes")
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Please Select Party");
	document.frmaddDept.txtcla.focus();
	return false;
	}
}

/*if(document.frmaddDepartment.fet.value==0)
	{
		alert("You have not Posted any Item. Please Select Lot& then click Preview");
		return false;
	}
	*/

 if(document.frmaddDepartment.txt.value=="No")
{
	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Enter Party Name");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}
	/*if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Please Enter Address ");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}*/
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Please enter City/Town/Village");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtstate.value=="")
	{
		alert("Please Select State");
		document.frmaddDepartment.txtstate.focus();
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

if(document.frmaddDepartment.txt1.value!="")
	{
		if(document.frmaddDepartment.txt1.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Please Enter Transport Name");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
						
			/*if(document.frmaddDepartment.txtlrn.value=="")
			{
			alert("Please enter Lorry Receipt No");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
			{
			alert("Lorry Receipt No cannot start with space.");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}*/
			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please Enter Vehicle No");
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
		else if(document.frmaddDepartment.txt1.value=="Courier")
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
return true;	 
}

</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - GOT Sample Dispatch </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php 
 $pid;
   $tid=$pid; 	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_stbl=mysqli_fetch_array($sql_tbl);			
 $arrival_id=$row_stbl['arrival_id'];
 //echo $tmode=$row_tbl['tmode'];

	$tdate=$row_stbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_gotqc1 where  arrival_id ='".$arrival_id."'") or die(mysqli_error($link));
  $subtbltot=mysqli_num_rows($sql_tbl_sub);
 $arrival_id=$row_arr['arrival_id'];
$subtid=0;
?>	  

	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt1" value="<?php echo $row_stbl['tmode'];?>" type="hidden"> 
	    
		<input type="hidden" name="txtid" value="<?php echo $row_stbl['arr_code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		 <input name="txt" value="<?php echo $row_stbl['pid'];?>" type="hidden"> 
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit GOT Sample Dispatch </td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="235" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID&nbsp;</td>
           <td width="239" align="left"  valign="middle">&nbsp;<?php echo "TQG".$row_stbl['arr_code']."/".$row_stbl['year_code']."/".$lgnid;?></td>
		 	<td width="137" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="229" colspan="3" align="left"  valign="middle">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>"/></td>
		   </tr>
		<tr class="Light" height="25">
 <td width="235"  align="right"  valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
   <td colspan="5" align="left"  valign="middle">&nbsp;<input name="txt12" type="radio" class="tbltext" value="Yes" onClick="clkp(this.value);" <?php if($row_stbl['pid'] == "Yes") { echo "checked"; } ?> />&nbsp;Select&nbsp;&nbsp;<input name="txt12" type="radio" class="tbltext" value="No" onClick="clkp(this.value);"  <?php if($row_stbl['pid'] == "No") { echo "checked"; } ?> />&nbsp;Fill&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table id="select"  align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style=" border-color:#4ea1e1; display:<?php if($row_stbl['pid'] == "Yes") { echo "Block"; } else { echo "none"; } ?>" > 
<?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Qc site' order by business_name"); 
?>
<tr class="Dark" height="30">
<td align="right" width="235" valign="middle" class="tblheading" style=" border-color:#d21704">&nbsp;Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5" style=" border-color:#d21704">&nbsp;<select class="tbltext" name="txtcla" style="width:230px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');">
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['p_id']==$row_stbl['party_id']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
if($row_stbl['party_id'] != "") 
{
	$quer4=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_stbl['party_id']."'"); 
	$row4=mysqli_fetch_array($quer4);
	$address=$row4['address'];
	$address=$row4['address'].", ".$row4['city'].", ".$row4['state'];
}
else
{
$address="";
}
 $row_stbl['courier_name'];
?>
<tr class="Light" height="30">
<td width="235" align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">&nbsp;Address&nbsp;</td>
<td width="609" colspan="8" align="left"  valign="middle" class="tbltext" id="vaddress" style=" border-color:#d21704"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $address;?></div></td>
</tr>
</table>
<table id="fill"  align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style=" border-color:#d21704;display:<?php if($row_stbl['pid'] == "No") { echo "Block"; } else { echo "none"; } ?>"  cols="3"> 
<tr class="Dark" height="25">
           <td width="235"  align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">Party&nbsp; </td>
           <td align="left"  valign="middle" colspan="8" style=" border-color:#d21704">&nbsp;<input name="txtparty" type="text" size="40" class="tbltext" tabindex="" maxlength="40" value="<?php echo $row_stbl['party_name'];?>"  />&nbsp;<font color="#FF0000"  >*</font>&nbsp;</td>
         </tr>
<tr class="Light" height="30">
<td width="235" align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">&nbsp;Address &nbsp;</td>
<td width="609" align="left"  valign="middle" class="tbltext" style=" border-color:#d21704" colspan="8">&nbsp;<textarea name="txtaddress" cols="35" rows="5" tabindex="" onChange="f2(this.value);"  class="tbltext"><?php echo $row_stbl['address'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="235" align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">&nbsp;City/Town/Village&nbsp;</td>
<td width="609" align="left"  valign="middle" class="tbltext" style=" border-color:#d21704" colspan="8">&nbsp;<input type="text" class="tbltext" name="txtcity" size="30" maxlength="30" value="<?php echo $row_stbl['city'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="235" align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">&nbsp;Pin&nbsp;</td>
<td width="609" align="left"  valign="middle" class="tbltext" style=" border-color:#d21704" colspan="8">&nbsp;<input type="text" class="tbltext" name="txtpin" size="6" maxlength="6" value="<?php if($row_stbl['pin'] > 0){ echo $row_stbl['pin'];} else { echo "";}?>" onkeypress="return isNumberKey(event)" >&nbsp;</td>
</tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="235" align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">&nbsp;State&nbsp;</td>
<td width="609" align="left"  valign="middle" class="tbltext" style=" border-color:#d21704" colspan="8">&nbsp;<select name="txtstate" class="tbltext"  style="width:170px;" tabindex="">
          <option value="">--Select State--</option>
		  <?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($row_stbl['state']==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
          
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
             <td width="236"  align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">Phone&nbsp;No.&nbsp; </td>
           <td width="708" colspan="8" align="left"  valign="middle" style=" border-color:#d21704">&nbsp;<b>STD</b>&nbsp;&nbsp;<input name="txtcontact" type="text" size="5" class="tbltext" tabindex="0" maxlength="5" value="<?php echo $row_stbl['std'];?>"  onkeypress="return isNumberKey(event)" />&nbsp;&nbsp;&nbsp;&nbsp;<b>Phone</b>&nbsp;&nbsp;<input name="cphno1" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey(event)" value="<?php echo $row_stbl['contactno'];?>" /></td>
		   </tr>
<tr class="Dark" height="25">
             <td width="236"  align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">Mobile&nbsp;No.&nbsp; </td>
           <td width="708" colspan="8" align="left"  valign="middle" style=" border-color:#d21704">&nbsp;<input name="txtmobile" type="text" size="15" class="tbltext" tabindex="0" maxlength="12"  onkeypress="return isNumberKey(event)"  value="<?php echo $row_stbl['mobileno'];?>"/><!--&nbsp;&nbsp;&nbsp;&nbsp;<b>Phone</b>&nbsp;&nbsp;<input name="cphno1" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey(event)" />--></td>
		   </tr></table>
<table id="transmode" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style=" border-color:#d21704; display:<?php if($row_stbl['tmode'] != "") { echo "Block"; } else { echo "none";} ?>" > 
<tr class="Dark" height="25">
           <td width="236" height="24"  align="right"  valign="middle" class="tblheading" style=" border-color:#d21704">&nbsp;Mode of Transit&nbsp;</td>
 <td width="608" colspan="5" align="left"  valign="middle" class="tbltext" style=" border-color:#d21704"><input name="txt11" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_stbl['tmode']=="Transport"){ echo "checked"; }?> />Transport&nbsp;<input name="txt11" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_stbl['tmode']=="Courier"){ echo "checked"; }?> />Courier&nbsp;<input name="txt11" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_stbl['tmode']=="By Hand"){ echo "checked"; }?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
  </table>

<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="display:<?php if($row_stbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Light" height="30">
<td align="right" width="236" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="35" class="tbltext" tabindex="" maxlength="35" value="<?php echo $row_stbl['trans_name'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="137" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="226" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="25" class="tbltext" tabindex="" value="<?php echo $row_stbl['trans_lorryrepno'];?>"  maxlength="25"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="236" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="241" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="25" class="tbltext" tabindex="" maxlength="25" value="<?php echo $row_stbl['trans_vehno'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt14" style="width:100px;" onchange="clk1(this.value);"  > 
<option value="">--Select Mode--</option>
<option <?php if($row_stbl['trans_paymode']=="TBB"){ echo "Selected";} ?> value="TBB">TBB</option>
<option <?php if($row_stbl['trans_paymode']=="ToPay"){ echo "Selected";} ?> value="ToPay" >To Pay</option>
<option <?php if($row_stbl['trans_paymode']=="Paid"){ echo "Selected";} ?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
 
<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="display:<?php if($row_stbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Dark" height="30">
<td align="right" width="236" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="241" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="35" class="tbltext" tabindex=""  maxlength="35" value="<?php echo $row_stbl['courier_name'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="136" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="227" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="20" class="tbltext" tabindex="" maxlength="20" value="<?php echo $row_stbl['docket_no'];?>"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="display:<?php if($row_stbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Dark" height="30">
<td align="right" width="236" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="608" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="35" class="tbltext" tabindex=""  maxlength="35" value="<?php echo $row_stbl['pname'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<div id="postingtable" style="display:block"><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
  <?php
 $tid=$pid; 	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
/*$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_gotqc1 where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	


 

	*/
?>
<tr class="tblsubtitle" height="20">
  <td width="25" height="19"align="center" valign="middle" class="tblheading">#</td>
			   <td width="74" align="center" valign="middle" class="tblheading">DOSR</td>
			    <td width="74" align="center" valign="middle" class="tblheading">DOSC</td>
			   <td width="129" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="151" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="114" align="center" valign="middle" class="tblheading">Lot No.</td> 
			  <td width="65" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="52" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
				  <td width="67" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 <?php
 
$srno=1;$qcs=""; $qcs12="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{
$qcs=$row_tbl_sub['lotno'];

 $p_array=explode(",",$row_tbl_sub['lotno']);
foreach($p_array as $val)
{
if($val <> "")
{
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$val' order by sampleno desc") or die(mysqli_error($link));
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_arr_home['spdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;		
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	if($qcs12!="")
	$qcs12=$qcs12.",".$qc1;
	else
	$qcs12=$qc1;
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $tp="12";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}

	
	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name from tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * from tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl_sub1['trstage'];
$pp=$row_tbl_sub1['state'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

}
if($srno%2!=0)
{
?>

 
  <tr class="Light" height="20">
    <td width="25" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="74" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="74" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="114" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="177" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
   <td width="67" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec('<?php echo $tid?>','<?php echo $row_tbl_sub['arrsub_id'];?>');" /></td>
  </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="25" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="74" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="74" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="114" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="177" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
   <td width="67" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec('<?php echo $tid?>','<?php echo $row_tbl_sub['arrsub_id'];?>');" /></td>
  </tr>
  <?php
}
$srno++;
}
}
}
}
}
//echo $qcs12;
?>
</table>
<input type="hidden" name="fet" value="<?php echo $qcs12?>" />
<br/>
</div>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_sampling2.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  