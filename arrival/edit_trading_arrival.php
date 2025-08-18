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
		  $p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$txtcla=trim($_POST['txtcla']);
		$txtdcno=trim($_POST['txtdcno']);
		$txtgrn=trim($_POST['txtgrn']);
		$txtor=trim($_POST['txtor']);
		$txt11=trim($_POST['txt11']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$txtstage=trim($_POST['txtstage']);
		$txtlot2=trim($_POST['txtlot2']);
		$txtvv=trim($_POST['txtvv']);
		$txtparty=trim($_POST['txtparty']);
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
		
		/*<!--echo "<script>window.location='add_arrival_trading_preview.php?p_id=$pid&remarks=$remarks&txtlot=$txtcla&txtdcno=$txtdcno&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname'</script>";	
			
	}-->*/
	echo "<script>window.location='add_arrival_trading_preview.php?p_id=$p_id&remarks=$remarks&txtgrn=$txtgrn&txtdcno=$txtdcno&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&txtparty=$txtparty&txtvv=$txtvv&txtlot2=$txtlot2&txtstage=$txtstage&txtvariety=$txtvariety&txtcrop=$txtcrop&txtor=$txtor'</script>";	
			
	}
/*$sql_code="SELECT MAX(arrival_code) FROM tblarrival  ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAT".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAT".$code."/".$yearid_id."/".$lgnid;
		}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Trading Arrival</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script src="trading.js"></script>
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

function isNumberKey1(evt1)
      {
         var charCode = (evt1.which) ? evt1.which : evt1.keyCode;
		 if (charCode > 31 && (charCode < 48 || charCode > 57))
		/* if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode == 46 || charCode > 57))*/
            return false;

         return true;
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
			if(document.frmaddDepartment.txtremarks1.value=="")
			{
			alert("Please enter reason");
			document.frmaddDepartment.txtremarks1.focus();
			return false;
			}
			
			}
		/*if(document.frmaddDepartment.txtqc.value=="")
		{
			alert("Select QC Status");
			document.frmaddDepartment.txtgstat.SelectedIndex=0;
			return false;
		}*/
		if(document.frmaddDepartment.autogotstatus.value=="Mandatory")
		{
			document.frmaddDepartment.gotstatus.value=gchk+' UT';
			document.frmaddDepartment.gscheckbox.value=1;
		}
		else
		{
			if(gchk=="GOT-NR")
			{ 	
				document.frmaddDepartment.gotsample.checked=false;
				document.getElementById('gscb').disabled=false;
				if(document.frmaddDepartment.gotsample.checked==false)
				{ 
					document.frmaddDepartment.gotstatus.value=gchk+' NUT';
					document.frmaddDepartment.gscheckbox.value=0;
				}
				else
				{ 
					document.frmaddDepartment.gotstatus.value=gchk+' UT';
					document.frmaddDepartment.gscheckbox.value=1;
				}
			}
			else if(gchk=="GOT-R")
			{
					document.frmaddDepartment.gotstatus.value=gchk+' UT';
					document.frmaddDepartment.gotsample.checked=true;
					document.getElementById('gscb').disabled=true;
					document.frmaddDepartment.gscheckbox.value=1;
			}
			else
			{
					document.frmaddDepartment.gotstatus.value="";
					document.frmaddDepartment.gotsample.checked=false;
					document.getElementById('gscb').disabled=false;
					document.frmaddDepartment.gscheckbox.value=0;

			}
		}
}

/*function gensmpchk()
{
//alert(hi);
	
	if(document.frmaddDepartment.qc1.checked==false)
			{ 
				document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgot.value+' NUT';
				//document.getElementById('qcstatusid').style.display="block"
				//document.getElementById('qcstatusid1').style.display="none"
				//document.frmaddDepartment.txtqc1.value="UT";
				document.frmaddDepartment.gscheckbox.value=0;
			}
			else
			{ 
				document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgot.value+' UT';
				//document.getElementById('qcstatusid').style.display="none"
				//document.getElementById('qcstatusid1').style.display="block"
				//document.frmaddDepartment.txtqc1.value="UT";
				document.frmaddDepartment.gscheckbox.value=1;
			}
}
*/
function qtychk1(qty1val)
{
		if(document.frmaddDepartment.txtactnob.value=="")
		{
			alert("Enter Actual NoB");
			document.frmaddDepartment.txtdcqty.value="";
			document.frmaddDepartment.txtactnob.focus();
		}
		else if(parseFloat(qty1val)>99999.999)
			{
				alert("Invalid Quantity");
				document.frmaddDepartment.txtdcqty.value="";
				document.frmaddDepartment.txtdcqty.focus();
				return false;
			}
		
}

function qtychk2(actgqty)
{
	if(document.frmaddDepartment.txtdcqty.value=="")
		{
			alert("Enter Quantity as per DC");
			document.frmaddDepartment.txtactqty.value="";
			document.frmaddDepartment.txtdiffqty.value="";
			document.frmaddDepartment.txtdcqty.focus();
		}
		else if(parseFloat(actgqty)>99999.999)
			{
				alert("Invalid Quantity");
				document.frmaddDepartment.txtactqty.value="";
				document.frmaddDepartment.txtactqty.focus();
				return false;
			}
		else
		{
		document.frmaddDepartment.txtdiffqty.value=parseFloat(actgqty)-parseFloat(document.frmaddDepartment.txtdcqty.value);
		}
		
}
function bagschk1()
{
		if(document.frmaddDepartment.txtstage.value=="")
		{
			alert("Enter Select Seed Status");
			document.frmaddDepartment.txtdcnob.value="";
			document.frmaddDepartment.txtdiffnob.value="";
			//document.frmaddDepartment.txtdcnob.focus();
		}
}
function bagschk2(actbags)
{
		if(document.frmaddDepartment.txtdcnob.value=="")
		{
			alert("Enter Number of Bags as per DC");
			document.frmaddDepartment.txtactnob.value="";
			document.frmaddDepartment.txtdiffnob.value="";
			document.frmaddDepartment.txtdcnob.focus();
		}
		else
		{
		document.frmaddDepartment.txtdiffnob.value=parseFloat(actbags)-parseFloat(document.frmaddDepartment.txtdcnob.value);
		}
}
function moischk(mosval)
{
		if(document.frmaddDepartment.txtactqty.value=="")
		{
			alert("Enter Actual Quantity");
			document.frmaddDepartment.txtmoist.value="";
		}
		if(parseFloat(mosval)>99.9)
		{
			alert("Invalid Moisture % value");
			document.frmaddDepartment.txtmoist.value="";
			document.frmaddDepartment.txtmoist.focus();
		}
}

function moischk1()
{
		if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Enter Moisture");
			document.frmaddDepartment.txtvisualck.value="";
			document.frmaddDepartment.txtmoist.focus();
		}
}
function visuchk(gchk)
{
if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Enter Moisture");
			document.frmaddDepartment.txtmoist.focus();
			document.getElementById("tvisualck").selectedIndex=0;
			return false;
		}
	if(gchk!="")
	{
		if(gchk=="Not-Acceptable")
		{
			document.getElementById('transs').style.display="block";
			document.frmaddDepartment.satype1.value=gchk;
		}
		else
		{
			document.getElementById('transs').style.display="none";
			document.frmaddDepartment.satype1.value=gchk;
		}	
	}
	else
		{
			document.getElementById('transs').style.display="none";
			document.frmaddDepartment.satype1.value=gchk;
		}	


/*
	if(document.frmaddDepartment.qc.value=="")
		{
			alert("Please Select Qc Status");
			//document.frmaddDepartment.txtgot.focus();
			return false;
		}*/
		if(document.frmaddDepartment.qc3.value=="Mandatory")
		{
			document.frmaddDepartment.gotstatus.value=gchk+' UT';
			//document.getElementById('qcstatusid').style.display="none"
			//document.getElementById('qcstatusid1').style.display="block"
			//document.frmaddDepartment.txtqc1.value="UT";
			document.frmaddDepartment.gscheckbox.value=1;
		}
		else
		{
			if(document.frmaddDepartment.qc1.checked==false)
			{ 
				document.frmaddDepartment.gotstatus.value=gchk+' NUT';
				//document.getElementById('qcstatusid').style.display="block"
				//document.getElementById('qcstatusid1').style.display="none"
				//document.frmaddDepartment.txtqc1.value="UT";
				document.frmaddDepartment.gscheckbox.value=0;
			}
			else
			{ 
				document.frmaddDepartment.qc1.value=gchk+' UT';
				//document.getElementById('qcstatusid').style.display="none"
				//document.getElementById('qcstatusid1').style.display="block"
				//document.frmaddDepartment.txtqc1.value="UT";
				document.frmaddDepartment.gscheckbox.value=1;
			}
		}
}
		
function visuchk1()
{
		if(document.frmaddDepartment.txtvisualck.value=="")
		{
			alert("Please Select Physical Purity");
			//document.frmaddDepartment.txtvisualck.value="";
		}
		else
		{
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
		}

}
function sstschk()
{
		if(document.frmaddDepartment.txtvv.value=="")
		{
			alert("SelectEnter Vendor Variety");
			document.frmaddDepartment.txtvv.value="";
			document.frmaddDepartment.txtvv.focus()
		}
}

function sschk1(stage)
{
if(document.frmaddDepartment.txtlot2.value=="")
		{
			alert("Select No. of Lots");
			document.frmaddDepartment.txtlot2.value="";
			//document.frmaddDepartment.txtstage.SelectedIndex=0;
		}
		else
		{
			document.getElementById('postingsubtable').innerHTML="";
			document.frmaddDepartment.txtlot1.value="";
			/*var cod="";
			if(stage=="Raw"){cod="R";}else if(stage=="Condition"){cod="C";}else{cod="";}
			document.frmaddDepartment.txtold.value=document.frmaddDepartment.txtold.value+cod;
			var clasid=document.frmaddDepartment.cid.value;
			var itmid=document.frmaddDepartment.vid.value;
			showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,'','','');*/
		}
		
}

function sschk()
{
		if(document.frmaddDepartment.txtvisualck.value=="")
		{
			alert("Please Select Physical Purity");
			//document.frmaddDepartment.txtstage.value="";
		}
		else
		{
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
		}
}

function sstschk1()
{
		if(document.frmaddDepartment.txtvariety.value=="")
		{
			alert("Please Select Variety");
			document.frmaddDepartment.txtvariety.value="";
		}
}

function pdchk()
{
	if(document.frmaddDepartment.txt11.value=="")
	{
	alert("Please Select Mode of Transit");
	}
}
function pform()
{	

	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
		
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	return false;
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
				
		/*else if(document.frmaddDepartment.txtgrn.value=="")
	{
		alert("Please enter GRN No.");
		document.frmaddDepartment.txtgrn.focus();
		return false;
	}		//}/*
	else if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter DC No.");
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}		
	/*else if(document.frmaddDepartment.txtor.value=="")
	{
		alert("Please enter Order Ref No.");
		document.frmaddDepartment.txtor.focus();
		return false;
	}		*/
	 if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Select Party.");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}		
	/*else if(document.frmaddDepartment.txtcrop.value=="")
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
	}		*/
 if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Transit.");
		document.frmaddDepartment.txt11.focus();
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
	 if(document.frmaddDepartment.txtvv.value=="")
	{
		alert("Please Enter Vendor Variety.");
		document.frmaddDepartment.txtvv.focus();
		return false;
	}		
	else if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Please Select No.of Lots.");
		document.frmaddDepartment.txtlot2.focus();
		return false;
	}		
	/*else if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		return false;
	}		*/
		else if(document.frmaddDepartment.txtdcnob.value=="")
	{
		alert("Please enter No. of Bags");
		document.frmaddDepartment.txtdcnob.focus();
		return false;
	}		//}
	else if(document.frmaddDepartment.txtactnob.value=="")
	{
		alert("Please enter Actual No. of Bags");
		document.frmaddDepartment.txtactnob.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtdiffnob.value=="")
	{
		alert("Please enter Quantity");
		document.frmaddDepartment.txtdiffnob.focus();
		return false;
	}
		
	else if(document.frmaddDepartment.txtmoist.value=="")
	{
		alert("Please enter Moisture");
		document.frmaddDepartment.txtmoist.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtvisualck.value=="")
	{
		alert("Please Select Physical Purity");
		document.frmaddDepartment.txtvisualck.focus();
		return false;
	}
	/*else if(document.frmaddDepartment.qc.value=="")
	{
		alert("Please Select QC");
		document.frmaddDepartment.qc.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtgot.value=="")
	{
		alert("Please Select GOT");
		document.frmaddDepartment.txtgot.focus();
		return false;
	}
	<!--else if(document.frmaddDepartment.sstatus.value=="")
	{
		alert("Please Select Seed Status");
		document.frmaddDepartment.sstatus.focus();
		return false;
	}-->*/
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
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	else
	{	//alert("hi");
		
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		//var q3=document.frmaddDepartment.txtslqtyg3.value;
		//var q4=document.frmaddDepartment.txtslqtyd1.value;
		//var q5=document.frmaddDepartment.txtslqtyd2.value;
		var g=document.frmaddDepartment.txtactqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		var f=0;
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		
		if(g==0 )
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
		//alert(a);
			showUser(a,'postingtable','mform','','','','','');
		//showUser(a,'postingsubtable','mform','','','','','');
		}  
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

function pformedtup()
{	

	
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
		
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	return false;
	}
	 /* if(document.frmaddDepartment.txtlot1.value=="")
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
				
		else if(document.frmaddDepartment.txtgrn.value=="")
	{
		alert("Please enter GRN No.");
		document.frmaddDepartment.txtgrn.focus();
		return false;
	}	*/	//}
	 if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter DC No.");
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}		
	/*else if(document.frmaddDepartment.txtor.value=="")
	{
		alert("Please enter Order Ref No.");
		document.frmaddDepartment.txtor.focus();
		return false;
	}		*/
	 if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Select Party.");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}		
	/*else if(document.frmaddDepartment.txtcrop.value=="")
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
	}		*/
 if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Transit.");
		document.frmaddDepartment.txt11.focus();
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
	 if(document.frmaddDepartment.txtvv.value=="")
	{
		alert("Please Enter Vendor Variety.");
		document.frmaddDepartment.txtvv.focus();
		return false;
	}		
	else if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Please Select No.of Lots.");
		document.frmaddDepartment.txtlot2.focus();
		return false;
	}		
	/*else if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		return false;
	}		*/
		else if(document.frmaddDepartment.txtdcnob.value=="")
	{
		alert("Please enter No. of Bags");
		document.frmaddDepartment.txtdcnob.focus();
		return false;
	}		//}
	else if(document.frmaddDepartment.txtactnob.value=="")
	{
		alert("Please enter Actual No. of Bags");
		document.frmaddDepartment.txtactnob.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtdiffnob.value=="")
	{
		alert("Please enter Quantity");
		document.frmaddDepartment.txtdiffnob.focus();
		return false;
	}
		
	else if(document.frmaddDepartment.txtmoist.value=="")
	{
		alert("Please enter Moisture");
		document.frmaddDepartment.txtmoist.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtvisualck.value=="")
	{
		alert("Please Select Physical Purity");
		document.frmaddDepartment.txtvisualck.focus();
		return false;
	}
	/*else if(document.frmaddDepartment.qc.value=="")
	{
		alert("Please Select QC");
		document.frmaddDepartment.qc.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtgot.value=="")
	{
		alert("Please Select GOT");
		document.frmaddDepartment.txtgot.focus();
		return false;
	}*/
	/*<!--else if(document.frmaddDepartment.sstatus.value=="")
	{
		alert("Please Select Seed Status");
		document.frmaddDepartment.sstatus.focus();
		return false;
	}-->*/
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
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	else
	{	//alert("hi");
		
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		//var q3=document.frmaddDepartment.txtslqtyg3.value;
		//var q4=document.frmaddDepartment.txtslqtyd1.value;
		//var q5=document.frmaddDepartment.txtslqtyd2.value;
		var g=document.frmaddDepartment.txtactqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		var f=0;
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		
		if(g==0 )
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
	//alert(a);
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}
//edtrecid,'postingsubtable','subformedt
function clk1(opt)
{
	if(document.frmaddDepartment.txtdcno.value!="")
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
	else
	{
	alert("Please enter STN Number");
	}
}

function clk(opt)
{
	
	if(document.frmaddDepartment.txtparty.value!="")
	{/*if(document.frmaddDepartment.txtdcno.value!="")
	{*/
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
		alert("Please Select Party");
		document.frmaddDepartment.txt11.value="";
	}
	}
	/*else
	{
	alert("Please enter Order reference No.");
	}*/
}
	/*else
	{
	alert("Please enter Order Reference Number");
	}
}*/



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

/*function upschk(upsval)
{
	if(document.frmaddDepartment.txtdcqty.value > 0)
	{
		if(document.frmaddDepartment.txtupsdc.value > 0)
		{
			if(document.frmaddDepartment.txtupsd.value=="")
			document.frmaddDepartment.txtexshups.value=parseInt(upsval)-parseInt(document.frmaddDepartment.txtupsdc.value);
			else
			document.frmaddDepartment.txtexshups.value=parseInt(upsval)+parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(document.frmaddDepartment.txtupsdc.value);
		}
		else
		{
			alert("Please enter UPS as per DC first");
			document.frmaddDepartment.txtupsg.value="";

			//document.frmaddDepartment.txtexshqty.value="";
			document.frmaddDepartment.txtupsdc.focus();
		}
	}
	else
	{
		alert("Please enter Quantity as per DC first");
		document.frmaddDepartment.txtqtyg.value="";
		//document.frmaddDepartment.txtexshqty.value="";
		document.frmaddDepartment.txtdcqty.focus();
	}

}
*/
/*function upschk1(upsval1)
{
	if(document.frmaddDepartment.txtupsg.value >0)
	{
	document.frmaddDepartment.txtexshups.value=parseInt(upsval1)+parseInt(document.frmaddDepartment.txtupsg.value)-parseInt(document.frmaddDepartment.txtupsdc.value);*/
	/*}
	else
	{
	alert("Please enter UPS Good first");
	document.frmaddDepartment.txtupsd.value="";
	document.frmaddDepartment.txtexshqty.value="";
	document.frmaddDepartment.txtupsg.focus();
	}
}*/
function clk3(opt)
{

	if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Enter Moisture");
			document.frmaddDepartment.txtmoist.focus();
			document.getElementById("tvisualck").selectedIndex=0;
			return false;
		}
		else
		{
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
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
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
		}
}

function showslocbins()
{
			//var opttyp="good";
			//document.frmaddDepartment.rettyp.value=opttyp;
			var clasid=document.frmaddDepartment.txtclass.value;
			//var itmid=document.frmaddDepartment.txtitem.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
}


function dcno()
{
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please Fill DC NO.");
		document.frmaddDepartment.txtparty.value="";
	}
}



function modetchk(classval)
{
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
		document.frmaddDepartment.txtcrop.selectedIndex=0;
		//document.frmaddDepartment.txt11.focus();
		return false;
	}
		showUser(classval,'vitem','item','','','','','');
		document.getElementById('postingsubtable').innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
				//document.frmaddDepartment.txt11.selectedIndex=0;
	}

function varchk(varval)
{
	if(document.frmaddDepartment.txtcrop.value!="")
	{
		if(varval!="")
		{
			document.getElementById('postingsubtable').innerHTML="";
			document.frmaddDepartment.txtlot1.value="";
		}
		else
		{
			document.getElementById('postingsubtable').innerHTML="";
			document.frmaddDepartment.txtlot1.value="";
		}
	}
	else
	{
		alert("Please select Crop");
		document.frmaddDepartment.txtvariety.selectedIndex=0;
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
}
function vendorchk1()
{
	if(document.frmaddDepartment.dcdate.value=="")
	{
		alert("Please Select Dc Date");
		document.frmaddDepartment.txtdcno.value="";
	}
}


function vendorchk()
{
	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Select Party .");
		document.frmaddDepartment.txtor.value="";
	}
}

function dcnochk()
{
if(document.frmaddDepartment.txtdcno.value=="")
{
alert("Please enter STN first");
document.frmaddDepartment.txt1.value="";
}
}
/*function mode()
{
	if(document.frmaddDepartment.txt11.value=="")
	{
 alert("Please Select Mode Of Transit.");
  document.frmaddDepartment.txtlot1.value="";
}
}*/
function openslocpop()
{
if(document.frmaddDepartment.txtstage.value=="")
{
 alert("Please Select Seed Stage.");
 //document.frmaddDepartment.txt1.focus();
}
else
{
//document.getElementById("postingsubtable").style.display="none";
var itm="Trading";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('getuser_trading_lotno.php?tp='+itm+'&crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}
function openslocpop1()
{
/*if(document.frmaddDepartment.qc.value=="")
{
 alert("Please Select QC.");
 //document.frmaddDepartment.txt1.focus();
}
else
{*/
var itm=document.frmaddDepartment.sstatus.value;
winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

//}
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
			
		var exq=0;
		/*if(document.frmaddDepartment.exqty1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty1.value);
		document.frmaddDepartment.balqty1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value)+parseFloat(exq);*/
	}
	else
	{
	document.frmaddDepartment.balqty1.value="";
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
		var exq=0;
		/*if(document.frmaddDepartment.exqty2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty2.value);
		document.frmaddDepartment.balqty2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value)+parseFloat(exq);*/
	}
	else
	{
	document.frmaddDepartment.balqty2.value="";
	}
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
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
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
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
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
		//document.frmaddDepartment.txtslsubbg1.focus();
	}
	if(document.frmaddDepartment.txtslBagsg1.value!="")
	{
		if(parseInt(document.frmaddDepartment.txtslBagsg1.value)==0 || document.frmaddDepartment.txtslBagsg1.value=="")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg1.value="";
			//document.frmaddDepartment.txtslBagsg1.focus();
			
		}
		var exu=0;
		/*if(document.frmaddDepartment.exusp1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp1.value);
			document.frmaddDepartment.balBags1.value=parseInt(document.frmaddDepartment.txtslBagsg1.value)+parseInt(exu);*/
	}
	else
	{
	document.frmaddDepartment.balBags1.value="";
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
			document.frmaddDepartment.txtslBagsg2.focus();
		}
		var exu=0;
		if(document.frmaddDepartment.exusp2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp2.value);
			document.frmaddDepartment.balBags2.value=parseInt(document.frmaddDepartment.txtslBagsg2.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balBags2.value="";
	}
}


function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}
function getdetails(stage)
{
if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
if(document.frmaddDepartment.txt11.value=="")
	{
 alert("Please Select Mode of Transit.");
 document.frmaddDepartment.txt11.focus();
}

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
				showUser(get,'postingsubtable','get',crop,variety,stage,'','');
}
function deleterec(v1,v2,v3)
{
	if(confirm('Do u wish to delete this item?')==true)
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
if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)!=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Please Check, there is Mismatch between reported arrival of No. of Trading Lots and No. of Lots posted.");
		//document.frmaddDepartment.txtlot1.focus();
		return false;
	}

	 if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Select Party.");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}		
	/*else if(document.frmaddDepartment.txtcrop.value=="")
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
	}	*/
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
	
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;	 
}

function ltchk()
{
	if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
			alert("Please Check, there is Mismatch between reported arrival of No. of Trading Lots and No. of Lots posted.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtstage.value!="")
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
					alert("Please Select Seed Stage");
					document.frmaddDepartment.txtstage.value="";
					return false;
	}
				
}
window.history.forward(1);
function noBack()
{ 
	window.history.forward(); 
}
//window.onbeforeunload = function() { return "You work will be lost."; };
function showledur(led)
{
	var sdt=document.frmaddDepartment.date.value;
	if(sdt=="")
	{
		//setTimeout('gidtchk(sdate)', 1000);
	}
	else
	{
		//alert(sdt);alert(led);
		var sdt=document.frmaddDepartment.date.value;
		var ledr=document.frmaddDepartment.leduration.value;
		if(ledr==0)
		{
			alert("Invalid LE Duration");
			document.frmaddDepartment.leupto.value='';
		}
		else
		{
			showUser(ledr,'ledet','getledet',sdt,'','','');
		}
	}
}
</script>
<body onload="noBack();" onpageshow="if(event.persisted) noBack();" onunload="" oncontextmenu="return false;">

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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Trading Arrival </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
<?php
$subtid=0;
?>
<?php 
 $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];
 //echo $row_tbl['lotcrop'];
  //echo $row_tbl['lotvariety'];
	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
		 $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;


?>	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $row_tbl['tmode'];?>" type="hidden"> 
	 <input name="txt14" value="<?php echo $row_tbl['trans_paymode'];?>" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $row_tbl['arrival_code']?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	  <input name="satype1" value="" type="hidden"> 
		</br>

       
        <table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit Trading Arrival </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="240" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="296"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAT".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="151" align="right" valign="middle" class="tblheading">&nbsp;Date &nbsp;</td>
<td width="253" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;
  <input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<!--<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname  FROM tblcrop  order by cropname Asc"); 

?>


<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="131" align="right" valign="middle" class="tblheading">&nbsp;Date</td>
<td width="275" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>-->

<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='1"); 
?>

<td align="right"  valign="middle" class="tblheading">Type of Arrival&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="arrivaltype" type="text" size="15" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="Trading Arrival" maxlength="15"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<!--/*<td align="right"  valign="middle" class="tblheading">GRN No.&nbsp;</td>
    <td align="middle"  valign="middle" class="tbltext">&nbsp;<input name="txtgrn" type="text" size="5" class="tbltext" tabindex=""    maxlength="5" value="00000"   readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>*/-->
           </tr>
 
<tr class="Dark" height="30">
<td width="240" align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td width="296" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="dcdate"  id="sdate"type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp; <a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">DC&nbsp;No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"  value="<?php echo $row_tbl['dcno'];?>"onchange="vendorchk1();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
		   
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Trading Vendor' or classification='Import Trader'"); 
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtparty" style="width:230px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');">
<option value="" selected="selected">--Select Vendor--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['party_id']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">Order Ref No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtor" type="text" size="20" class="tbltext" tabindex=""    maxlength="20" onchange="vendorchk();"   value="<?php echo $row_tbl['orderno'];?>"/>&nbsp;&nbsp;</td>
           </tr> <?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
		if($row3['classification'] == "Import Trader" )
	{
	$country="";
	$sql_country=mysqli_query($link,"Select * from tblcountry where c_id='".$row3['country']."'") or die(mysqli_error($link));
	$row_country=mysqli_fetch_array($sql_country);
	$country=$row_country['country'];
	$address=$row3['address'].",".$row3['city'].",".$row3['state'];
	if($country!="")
	$address.=",".$country;
	if($row3['pin'] > 0)
	$address.=" - ".$row3['pin'];
	}
	else
	{
	$address=$row3['address'].",".$row3['city'].",".$row3['state'];
	if($row3['pin'] > 0)
	$address.=" - ".$row3['pin'];
	}
?>
		  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $address;?></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="6"><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Transport"){ echo "checked"; }?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Courier"){ echo "checked"; }?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="By Hand"){ echo "checked"; }?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="trans" style="display:<?php if($row_tbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>">
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="239" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="25" class="tbltext" tabindex="" maxlength="25" value="<?php echo $row_tbl['trans_name'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="143" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex="" value="<?php echo $row_tbl['trans_lorryrepno'];?>"  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="239" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="304" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['trans_vehno'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:100px;" onchange="clk1(this.value);"  > 
<option value="">--Select Mode--</option>
<option <?php if($row_tbl['trans_paymode']=="TBB"){ echo "Selected";} ?> value="TBB">TBB</option>
<option <?php if($row_tbl['trans_paymode']=="To Pay"){ echo "Selected";} ?> value="To Pay" >To Pay</option>
<option <?php if($row_tbl['trans_paymode']=="Paid"){ echo "Selected";} ?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="239" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="304" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['courier_name'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="147" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="250" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['docket_no'];?>"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<div id="byhand" style="display:<?php if($row_tbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>">
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"   > 
<tr class="Dark" height="30">
<td align="right" width="239" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="705" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="30" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['pname_byhand'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div><div id="postingtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
  <tr class="Light" height="30">
 <?php   
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['lotcrop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);

?>
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="303" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtcrop1" style="background-color:#CCCCCC"  onchange="modetchk(this.value)"value="<?php echo $row_tbl['lotcrop'];?>"  size="30" readonly="true" type="text"><input type="hidden" name="txtcrop" value="<?php echo $row_tbl['lotcrop'];?>" />
&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	  <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['lotvariety']."' and actstatus='Active' and vertype='PV' order by popularname Asc"); 
$noticia = mysqli_fetch_array($quer4);
?>
	<td width="145" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td width="254" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtvariety1" style="background-color:#CCCCCC" id="itm" value="<?php echo $row_tbl['lotvariety'];?>" size="30" readonly="true" type="text">
              <font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtvariety" value="<?php echo $row_tbl['lotvariety'];?>" /></td>
           </tr>
          
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Vendor  Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvv" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"   value="<?php echo $row_tbl['vvariety'];?>" >&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">No. of Lots&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtlot2" class="tbltext"  style="width:100px;" tabindex="" onChange="sstschk()" >
          <option value="1" <?php if($row_tbl['nolot']==1) { echo "Selected";}?>>1</option>
          <option value="2" <?php if($row_tbl['nolot']==2) { echo "Selected";}?>>2</option>
          <option value="3" <?php if($row_tbl['nolot']==3) { echo "Selected";}?>>3</option>
          <option value="4" <?php if($row_tbl['nolot']==4) { echo "Selected";}?>>4</option>
          <option value="5" <?php if($row_tbl['nolot']==5) { echo "Selected";}?>>5</option>
          <option value="6" <?php if($row_tbl['nolot']==6) { echo "Selected";}?>>6</option>
          <option value="7" <?php if($row_tbl['nolot']==7) { echo "Selected";}?>>7</option>
          <option value="8" <?php if($row_tbl['nolot']==8) { echo "Selected";}?>>8</option>
          <option value="9" <?php if($row_tbl['nolot']==9) { echo "Selected";}?>>9</option>
          <option value="10" <?php if($row_tbl['nolot']==10) { echo "Selected";}?>>10</option>
          </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="238" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  colspan="3">&nbsp;<input  name="txtstage1" style="background-color:#CCCCCC" onChange="sschk1()" value="<?php echo $row_tbl['sstage'];?>"  readonly="true" type="text"><input type="hidden" name="txtstage" value="<?php echo $row_tbl['sstage'];?>"/>
   &nbsp;<font color="#FF0000">*</font>	</td>
</tr></table>

<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
 
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Trading' and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">V. Lot No.</td>
	<td width="7%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per DC</td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>

	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>

		  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		   <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type </td>
		 	
		   <td width="9%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="5%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="5%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="6%" align="center" valign="middle" class="tblheading">Moist %</td>
      <td width="7%" align="center" valign="middle" class="tblheading">PP</td>
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
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}

/*$lotqry=mysqli_query($link,"select * from tbllotimp where lotnumber='".$a."'");
$row= mysqli_fetch_array($lotqry)or die (mysqli_error($link));

  $lot=$row['lotcrop'];	
 $variety=$row['lotvariety'];
  $oldlot=$row['lotoldlot'];		


$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
*/if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>	
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
      <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>
	  <?php $aq=explode(".",$row_tbl_sub['act']); if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];} ?>	
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
	<?php $aq1=explode(".",$row_tbl_sub['diff']); if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$row_tbl_sub['diff'];} ?>
    <td align="center" valign="middle" class="tblheading"><?php echo $ac1;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Trading');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>	
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
      <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>
	  <?php $aq=explode(".",$row_tbl_sub['act']); if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];} ?>	
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
	<?php $aq1=explode(".",$row_tbl_sub['diff']); if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$row_tbl_sub['diff'];} ?>
    <td align="center" valign="middle" class="tblheading"><?php echo $ac1;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Trading');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E">&nbsp;<input name="txtlot1" type="text" size="6" class="tblheading" tabindex=""  maxlength="6"  value="<?php echo $mode;?>" onchange="ltchk(this.value);" readonly="true" style="background-color:#CCCCCC"  />
</span>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> (After selection of lot no. click on 'Get Details')</td>
</tr>
</table>
<br />
		  
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="pdnum" value="<?php echo $a;?>" />
<div id="postingsubtable" style="display:block"></div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl['remarks'];?>" ></td>
</tr>
</table>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_trading.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  