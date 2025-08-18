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
	
	if(isset($_REQUEST['ep_id']))
	{
		$epid = $_REQUEST['ep_id'];
	}
	if(isset($_REQUEST['cropid']))
	{
		$tid = $_REQUEST['cropid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$maintrid=trim($_POST['maintrid']);
		$subtrid=trim($_POST['subtrid']);
		$epid = trim($_GET['ep_id']);
		$trsbmval=trim($_POST['trsbmval']);
		if($trsbmval==0)
		{
			echo "<script>window.location='add_arrival_packstock_preview.php?cropid=$maintrid&ep_id=$epid'</script>";	
		}
		else
		{
			$sql_main="update tbl_arrpack set arrpack_arrtrflg='0' where arrpack_id='$maintrid'";
			$as=mysqli_query($link,$sql_main) or die(mysqli_error($link));
			echo "<script>window.location='add_arrival_stocktransfer1.php'</script>";	
		}
			
	}

//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(arrpack_code) FROM tbl_arrpack where plantcode='$plantcode' ORDER BY arrpack_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
		{
			$row_code=mysqli_fetch_row($res_code);
			$t_code=$row_code['0'];
			$code=$t_code+1;
			$code1="TAP".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAP".$code."/".$yearid_id."/".$lgnid;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Arrival Pack Seed Stock Transfer Plant</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<script src="stockpack.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
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
	 popUpCalendar(document.frmaddDepartment.dcdate,dt,document.frmaddDepartment.dcdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
	}

function imgOnClick3(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	
	 popUpCalendar(document.frmaddDepartment.dcdate1,dt,document.frmaddDepartment.dcdate1, "dd-mmm-yyyy", xind, yind);
	 }
	 

 function imgOnClick4(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 if(document.frmaddDepartment.gotstatus.value =="OK" || document.frmaddDepartment.gotstatus.value =="Fail")
{
	 popUpCalendar(document.frmaddDepartment.dcdate12,dt,document.frmaddDepartment.dcdate12, "dd-mmm-yyyy", xind, yind);
	 }
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
function classchk(val12)
{
if(document.frmaddDepartment.recqtyp.value=="")
		{
			alert("Please Enter Actual  Qty");
			document.frmaddDepartment.recqtyp.focus();
			//document.frmaddDepartment.txtqtystat.value="";
			return(false);
		}

 }
/*else if(document.frmaddDepartment.txtqtystat.value =="OK" || document.frmaddDepartment.txtqtystat.value =="Fail")
{
document.getElementById("rn1").disabled=false;
document.getElementById("rn2").disabled=false;
document.getElementById("rn3").disabled=false;
document.getElementById("rn4").disabled=false;
document.getElementById("transs").style.display="none";
document.getElementById("rn1").style.backgroundColor="#FFFFFF";
document.getElementById("rn2").style.backgroundColor="#FFFFFF";
document.getElementById("rn3").style.backgroundColor="#FFFFFF";
document.getElementById("rn4").style.backgroundColor="#FFFFFF";
}
else
{
//alert(document.getElementById('rn1').selectedIndex);
document.getElementById('rn1').selectedIndex=0;
//document.frmaddDepartment.txtvisualck.SelectedIndex=0;
document.frmaddDepartment.txtmoist.value="";
document.frmaddDepartment.txtgermi.value="";
document.frmaddDepartment.dcdate1.value="";
document.getElementById("rn1").disabled=true;
document.getElementById("rn2").disabled=true;
document.getElementById("rn3").disabled=true;
document.getElementById("rn4").disabled=true;
//document.frmaddDepartment.txtreason.value="";
document.getElementById("transs").style.display="none";
document.getElementById("rn1").style.backgroundColor="#CCCCCC";
document.getElementById("rn2").style.backgroundColor="#CCCCCC";
document.getElementById("rn3").style.backgroundColor="#CCCCCC";
document.getElementById("rn4").style.backgroundColor="#CCCCCC";
}

}
*/
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
				
			 if(document.frmaddDepartment.txt1.value!="")
	{
		if(document.frmaddDepartment.txt1.value=="Transport")
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
		return false;
	}
		var mid=document.frmaddDepartment.ep_id.value;
		var lotid=document.frmaddDepartment.txtlot1.value;
		
		//alert(mid);alert(lotid);
		//document.getElementById("get").style.display="block";
		showUser(mid,'get','getdetails',lotid,'','','');
}
}

function getdetails1()
{
if(document.frmaddDepartment.txtlot11.value=="")
{
 alert("Please Select or enter Lot No.");
}
else
{

var get=document.frmaddDepartment.txtlot11.value;
//var grn=document.frmaddDepartment.grnnumber.value;
if(document.frmaddDepartment.txtlot11.value=="")
{
	alert("Please enter Lot No.");
	document.frmaddDepartment.txtlot11.focus();
	return false;
}
if(document.frmaddDepartment.txtlot11.value.charCodeAt() == 32)
{
	alert("Lot No cannot start with space.");
	document.frmaddDepartment.txtlot11.focus();
	return false;
}
if(!isChar_W(document.frmaddDepartment.txtlot11.value.charAt(0)))
{
	alert("Lot No cannot start with Numaric value.");
	document.frmaddDepartment.txtlot11.focus();
	return false;
}
if(document.frmaddDepartment.txtlot11.value.length<6)
{
	alert("Lot No cannot be less than 6 digits alphanumaric.");
	document.frmaddDepartment.txtlot11.focus();
	return false;
}
//alert(document.frmaddDepartment.txt1.value);
if(document.frmaddDepartment.txt1.value!="")
{
	if(document.frmaddDepartment.txt1.value=="Transport")
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
		if(document.frmaddDepartment.txt13.value=="")
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
	return false;
}
var mid=document.frmaddDepartment.ep_id.value;
var lotid=document.frmaddDepartment.txtlot11.value;

//alert(mid);alert(lotid);
//document.getElementById("get").style.display="block";
showUser(mid,'upklotinfo','upklotinfo1',lotid,'','','');
}
}

function openslocpopp()
{

if(document.frmaddDepartment.txt1.value=="")
{
 alert("Please Select Mode of Transit.");
}
else
{
//document.getElementById("postingsubtable").style.display="none";
var itm="StockTransfer Arrival pack";
var mid=document.frmaddDepartment.ep_id.value;
winHandle=window.open('getuser_stockpack_lotno.php?tp='+itm+'&mid='+mid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function openslocpopp1()
{

if(document.frmaddDepartment.txt1.value=="")
{
 alert("Please Select Mode of Transit.");
}
else
{
//document.getElementById("postingsubtable").style.display="none";
var itm="StockTransfer Arrival pack";
var mid=document.frmaddDepartment.ep_id.value;
winHandle=window.open('getuser_stockpack_lotno1.php?tp='+itm+'&mid='+mid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function ppreasonchk(ppval)
{
	if(ppval!="")
	{
		if(ppval=="Not-Acceptable")
		{
			document.getElementById("transs").style.display="block";
			document.frmaddDepartment.txtreason.value="";
		}
		else
		{
			document.getElementById("transs").style.display="none";
			document.frmaddDepartment.txtreason.value="";
		}
	}
	else
	{
		document.getElementById("transs").style.display="none";
		document.frmaddDepartment.txtreason.value="";
	}
}

function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
function gotch(ch)
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert(" Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
}

function pform(type)
{	
	if(document.frmaddDepartment.txt1.value!="")
	{
		if(document.frmaddDepartment.txt1.value=="Transport")
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
			if(document.frmaddDepartment.txt13.value=="")
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
	
	var a=formPost(document.getElementById('mainform'));
	//alert(a);
	//exit;
	if(type=="Expected NoP")
	{
		showUser(a,'postingtable','mform1','','','','','');
	}
	if(type=="NoP With Barcode")
	{
		showUser(a,'postingtable','mform2','','','','','');
	}
	if(type=="NoP Without Barcode")
	{
		showUser(a,'postingtable','mform3','','','','','');
	}
	//alert("a");
}
function sloccheck(mltval)
{
	var a=formPost(document.getElementById('mainform'));
	//alert(a);
	//exit;
	showUser(a,'barchk','barchk12','','','','','');
	mltval="'"+mltval+"'";
	setTimeout('chkbarcode1('+mltval+')',400);
}
function chkbarcode1(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcode";
	document.getElementById(txtbarcode).value=mltval;
	
	/*if(parseInt(document.frmaddDepartment.brchflg.value)==1)
	{
		alert("Please Select SLOC of respective lot no.");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else*/ if(parseInt(document.frmaddDepartment.brchflg.value)==2)
	{
		alert("Barcode already scaned for current transaction");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		if(document.frmaddDepartment.arrbar.value!="")
		{
			var totbarcs=document.frmaddDepartment.arrbar.value.split(",");
			var x=0;
			for(var i=0; i<totbarcs.length; i++)
			{
				if(totbarcs[i]==document.getElementById(txtbarcode).value)
				{
					x++;
				}
			}
			if(x==0)
			{
				alert("Barcode not present in current transaction");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	
		if(mltval.length < 11)
		{
			alert("Invalid Barcode. Barcode cannot be less than 11 digit");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		else
		{
			var z=mltval.split("");
			//alert(z); 
			
			var a=z[0];
			var b=z[1];
			if(isChar_o(a)==false)
			{
				alert("Invalid Barcode1");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
			if(isChar_o(b)==false)
			{
				alert("Invalid Barcode2");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
			for(var i=2; i<z.length; i++)
			{
				if(isChar_o(z[i])==true)
				{
					alert("Invalid Barcode3");
					document.getElementById(txtbarcode).value="";
					document.getElementById(txtbarcode).focus();
					flg=1;
					return false;
				}
			}
			if(flg==0)
			{	
				var a=formPost(document.getElementById('mainform'));
				//alert(a);
				//exit;
				showUser(a,'postingtable','mform','','','','','');
			}
		}
	}
}
function chkbarcode(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtdelbarcod";
	document.getElementById(txtbarcode).value=mltval;
	
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		//alert(z); 
		
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode1");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode2");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode3");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		if(flg==0)
		{	
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'postingtable','mformdelete','','','','','');
		}
	}
}
function pformedtup()
{	
 dt6=getDateObject(document.frmaddDepartment.dcdate12.value,"-");
  dt5=getDateObject(document.frmaddDepartment.dcdate1.value,"-");
dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
		
	
	
	
		if(document.frmaddDepartment.recqtyp.value=="")
	{
		alert("Please enter  Actual NoB");
		document.frmaddDepartment.recqtyp.focus();
		return false;
	}
	if(document.frmaddDepartment.txtrecbagp.value=="")
	{
		alert("Please enter Actual Qty");
		document.frmaddDepartment.txtrecbagp.focus();
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Stock Transfer From Plant");
		document.frmaddDepartment.txtstfp.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();

		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		return false;
	}
if(document.frmaddDepartment.sstage.value=="")
	{
		alert("Please Enter Stage.");
		document.frmaddDepartment.sstage.focus();
		return false;
	}
	if(document.frmaddDepartment.sstage.value.charCodeAt() == 32)
	{
		alert("Stage cannot start with space.");
		document.frmaddDepartment.sstage.focus();
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
	
	
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Stock Transfer from");
		document.frmaddDepartment.txtstfp.focus();
		return false;
	}
	
	else if(document.frmaddDepartment.txtrawp.value=="")
	{
		alert("Please enter Dispatch Total Raw");
		document.frmaddDepartment.txtrawp.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtdisp.value=="")
	{
		alert("Please enter Disptach  Total No. Of Qty");
		document.frmaddDepartment.txtdisp.focus();
		return false;
	}
	/*else if(document.frmaddDepartment.txtqtystat.value=="")
	{
		alert("Please select Quality Status");
		document.frmaddDepartment.txtqtystat.focus();
		return false;
	}*/
	else if(document.frmaddDepartment.recqtyp.value=="")
	{
		alert("Please enter  Received Qty");
		document.frmaddDepartment.recqtyp.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtrecbagp.value=="")
	{
		alert("Please enter Received No. Of Bags");
		document.frmaddDepartment.txtrecbagp.focus();
		return false;
	}

	else
		{	
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var g=document.frmaddDepartment.recqtyp.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var f=0;
		
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
		showUser(a,'postingtable','mformsubedt','','','','');
		}
	}
}

function clk(opt)
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

function actq(Bagsval1)
{
	document.frmaddDepartment.txtdbag.value=parseInt(Bagsval1)+parseInt(document.frmaddDepartment.txtaqty.value)-parseInt(document.frmaddDepartment.txtraw.value);
}

function actb(Bagsval1)
{
	document.frmaddDepartment.txtdqty.value=parseFloat(Bagsval1)+parseFloat(document.frmaddDepartment.txtbag.value)-parseInt(document.frmaddDepartment.txtqty.value);
}



function clk1(val)
{
document.frmaddDepartment.txt14.value=val;
}

function Bagschk(Bagsval)
{
	if(document.frmaddDepartment.txtqtydc.value > 0)
	{
		if(document.frmaddDepartment.txtBagsdc.value > 0)
		{
			if(document.frmaddDepartment.txtBagsd.value=="")
			document.frmaddDepartment.txtexshBags.value=parseInt(Bagsval)-parseInt(document.frmaddDepartment.txtBagsdc.value);
			else
			document.frmaddDepartment.txtexshBags.value=parseInt(Bagsval)+parseInt(document.frmaddDepartment.txtBagsd.value)-parseInt(document.frmaddDepartment.txtBagsdc.value);
		}
		else
		{
			alert("Please enter Bags as per DC first");
			document.frmaddDepartment.txtBagsg.value="";
			document.frmaddDepartment.txtBagsdc.focus();
		}
	}
	else
	{
		alert("Please enter Quantity as per DC first");
		document.frmaddDepartment.txtqtyg.value="";
		document.frmaddDepartment.txtexshqty.value="";
		document.frmaddDepartment.txtqtydc.focus();
	}

}

function Bagsdcchk()
{
if(document.frmaddDepartment.txtlotp3.value=="")
		{
			alert("Enter Lot 5 Digit No.");
			document.frmaddDepartment.txtlotp3.focus();
			//document.frmaddDepartment.txtwrap.value="";
		}
		if(document.frmaddDepartment.txtrawp.value!="" && document.frmaddDepartment.txtrecbagp.value!="")
		{
		document.frmaddDepartment.txtdbagp.value=parseFloat(document.frmaddDepartment.txtrawp.value)-parseFloat(document.frmaddDepartment.txtrecbagp.value);
	}
	else{
	document.frmaddDepartment.txtdbagp.value="";
	}
	
}
function Bagsdcchk1(qty1val)
{
if(document.frmaddDepartment.txtlotp3.value=="")
		{
			alert("Please Enter Lot No.");
			document.frmaddDepartment.txtlotp3.focus();
			return(false);
		}

if(document.frmaddDepartment.txtlotp3.value.length < 5 )
		{
			alert("Enter 5 Numbers Only ");
			document.frmaddDepartment.txtlotp3.focus();
			return(false);
		}
	if(document.frmaddDepartment.txtrawp.value=="")
		{
			alert("Enter Dispatch NoB");
			document.frmaddDepartment.txtdisp.value="";
			document.frmaddDepartment.txtrawp.focus();
		}
		else if(parseFloat(qty1val)>99999.999)
			{
				alert("Invalid Quantity");
				document.frmaddDepartment.txtdisp.value="";
				document.frmaddDepartment.txtdisp.focus();
				return false;
			}
		else if(document.frmaddDepartment.txtdisp.value!="" && document.frmaddDepartment.recqtyp.value!="")
		{

		document.frmaddDepartment.txtdqtyp.value=parseFloat(document.frmaddDepartment.txtdisp.value)-parseFloat(document.frmaddDepartment.recqtyp.value);
	}
	else{
	document.frmaddDepartment.txtdqtyp.value="";
	}
}




function qtychk1(qtyval1)
{
	if(document.frmaddDepartment.txtrecbagp.value=="")
	{
		alert("Enter Actual  NoB");
		document.frmaddDepartment.recqtyp.value="";
		document.frmaddDepartment.txtrecbagp.focus();
	}
	else
	{
		document.frmaddDepartment.txtdqtyp.value=parseFloat(qtyval1)-parseFloat(document.frmaddDepartment.txtdisp.value);
	}
	if(parseFloat(qtyval1)>99999.999)
	{
		alert("Invalid Quantity");
		document.frmaddDepartment.recqtyp.value="";
		document.frmaddDepartment.txtrecbagp.focus();
	}
}
function showslocbins()
{
	var clasid=document.frmaddDepartment.txtcrop.value;
	var itmid=document.frmaddDepartment.txtvariety.value;
	showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
}

function item6()
{
	if(document.frmaddDepartment.sstage.value=="")
	{
		alert("Please Select Stage.");
		document.frmaddDepartment.sstage.focus();
		document.frmaddDepartment.txtlotp12.value="";
	
	}
	document.frmaddDepartment.txtlotp1.value="";
}


function Bagschk1(Bagsval1)
{
	if(document.frmaddDepartment.txtdisp.value=="")
	{
		alert("Please Enter Dispatch Total No. of Qty ");
		document.frmaddDepartment.txtrecbagp.value="";
		document.frmaddDepartment.txtdisp.focus();
	}
	else
	{
		document.frmaddDepartment.txtdbagp.value=parseFloat(Bagsval1)-parseFloat(document.frmaddDepartment.txtrawp.value);
	}
}
function Bagschk(Bagsval1)
{
	document.frmaddDepartment.txtdisp.value=parseInt(Bagsval1)+parseInt(document.frmaddDepartment.recqtyp.value)-parseInt(document.frmaddDepartment.txtdqtyp.value);
}

function recqty()
{
}

function Bagsdcchk2()
{
}
function modetchk(classval)
{	
	 if(document.frmaddDepartment.txt11.value!="")
	{
	//document.frmaddDepartment.txtcrop.value="";
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
			showUser(classval,'vitem','vitem','','','','','');
			//document.frmaddDepartment.txt11.value=="";
}
	


function vendorchk()
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
		alert("Please select Stock Transfer from first");
		document.frmaddDepartment.txtdcno.value="";
	}
}

function dcnochk()
{
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter STN first");
		document.frmaddDepartment.txtporn.value="";
	}
}


function openslocpop()
{
	if(document.frmaddDepartment.txtvariety.value!="")
	{
		var itm=document.frmaddDepartment.txtvariety.value;
		winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
		alert("Please Select Item first.");
		document.frmaddDepartment.txtvariety.focus();
	}
}
function newsloc(srno)
{
	//alert("test");
	var newwh='wh'+srno;
	showUser(srno,newwh,'wh1','','','','','');
	srno="'"+srno+"'";
	setTimeout('newsloc1('+srno+')',200);
}

function newsloc1(srno)
{
	var bin='bin'+srno;
	showUser(srno,bin,'bin1','','','','','');
	srno="'"+srno+"'";
	setTimeout('newsloc2('+srno+')',200);
}
function newsloc2(srno)
{
	var subbin='subbin'+srno;
	showUser(srno,subbin,'sbin1','','','','','');
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
		var exu=0;
		//if(document.frmaddDepartment.exusp1.value=="")
		//exu=0;
		//else
		//exu=parseInt(document.frmaddDepartment.exusp1.value);
			//document.frmaddDepartment.balBags1.value=parseInt(document.frmaddDepartment.txtslBagsg1.value)+parseInt(exu);
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
		/*if(document.frmaddDepartment.exusp2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp2.value);
			document.frmaddDepartment.balBags2.value=parseInt(document.frmaddDepartment.txtslBagsg2.value)+parseInt(exu);*/
	}
	else
	{
	document.frmaddDepartment.balBags2.value="";
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
			
		/*var exq=0;
		if(document.frmaddDepartment.exqty1.value=="")
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
		/*var exq=0;
		if(document.frmaddDepartment.exqty2.value=="")
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
function editrec(edtrecid, trid)
{
	showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
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


function mySubmit(sbmval)
{ 
	/*if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	return true;*/
	var fl=0;	
	
	if(document.frmaddDepartment.maintrid.value=="" || document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not posted any records. Post records then click on Preview.");
		fl=1;
		return false;
	}	
	/*if(document.frmaddDepartment.subtrid.value=="" && document.frmaddDepartment.subtrid.value==0)
	{
		alert("You are in Loading Process. Click on Next to complete the Loading then click on Preview.");
		fl=1;
		return false;
	}	*/
	if(fl==1)
	{
		return false;
	}
	else
	{
		//return false;
		document.frmaddDepartment.trsbmval.value=sbmval;
		document.frmaddDepartment.submit();
		return true;
	}	 
}

function gensmpchk()
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
function openslocpop1()
{
	var itm=document.frmaddDepartment.sstatus.value;
	winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function moischk()
{
	if(document.frmaddDepartment.recqtyp.value=="")
	{
		alert("Enter Received Qty");
		document.frmaddDepartment.txtmoist.value="";
	}
}

function moischk1()
{
	if(document.frmaddDepartment.gotstatus.value=="")
	{
		alert("Please Select Got Status");
		document.frmaddDepartment.txtgermi.value="";
	}
}
function wh(cls, srno)
{
	//alert(cls);alert(srno);
	if(document.frmaddDepartment.txt1.value=="")
	{
		alert("Please Select Mode of Transit");
		//document.frmaddDepartment.txtwhg_.value="";
		document.getElementById('txtwhg_'+srno).value="";
		document.frmaddDepartment.txt1.focus();
		return false;
	}
	else
	{
		var bin1 = 'bin'+srno;
		//alert(bin1);
		showUser(cls,bin1,'wh',srno,'','','','');
	}
}

function bin2(cls, srno)
{
	//alert(cls);alert(srno);
	var subbin = 'subbin'+srno;
	showUser(cls,subbin,'bin',srno,'','','','');
}

function barinfo1(mltval)
{
	var flg=0;
	var cls=mltval;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcode";
	document.getElementById(txtbarcode).value=mltval;
	
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		//alert(z); 
		
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode1");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode2");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode3");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	}
	if(flg==0)
	{
		showUser(cls,'barinfo','barcodeinfo','','','','','');
	}
}

function packarr()
{
	if(document.frmaddDepartment.txt1.value=="")
	{
		 alert("Please Select Mode of Transit.");
		 return false;
	}
	if(document.frmaddDepartment.arrtyp.value=="packarr")
	{
		document.getElementById('arrsubtyp').value="";
		document.getElementById('arrsubtyp').selectedIndex=0;
		document.getElementById('arrsubtyp').disabled=true;
		document.getElementById('upknop').style.display="none";
	    document.getElementById('bardiv').style.display="block";
		document.getElementById('txtbarcode').value=".";
		document.getElementById('txtbarcode').value="";
		document.getElementById('txtbarcode').focus();
	}
	if(document.frmaddDepartment.arrtyp.value=="unpackarr")
	{
		document.getElementById('arrsubtyp').disabled=false;
		document.getElementById('bardiv').style.display="none";
	    //document.getElementById('upknop').style.display="block";
	}
}
function packarrsub()
{
	//alert(document.frmaddDepartment.arrsubtyp.value);
	//alert(srno);
	if(document.frmaddDepartment.arrsubtyp.value=="NoP")
	{
		document.getElementById('bardiv').style.display="none";
		document.getElementById('nopwbar').style.display="none";
		document.getElementById('upknop').style.display="block";
	}
	if(document.frmaddDepartment.arrsubtyp.value=="NoP With Barcode")
	{
		//document.getElementById('arrsubtyp').disabled=false;
		document.getElementById('bardiv').style.display="none";
		document.getElementById('upknop').style.display="none";
		document.getElementById('get').style.display="none";
	    document.getElementById('nopwbar').style.display="block";
	}
	if(document.frmaddDepartment.arrsubtyp.value=="NoP Without Barcode")
	{
		//document.getElementById('arrsubtyp').disabled=false;
		document.getElementById('bardiv').style.display="none";
		document.getElementById('upknop').style.display="none";
		document.getElementById('get').style.display="none";
	    document.getElementById('nopwbar').style.display="none";
		document.getElementById('upknopnobar').style.display="block";
		
	}
}
function intrloss()
{
	//alert(cls);
	//alert(document.frmaddDepartment.lossbook.value);
	if(document.frmaddDepartment.lossbook.value=="Yes-Complete")
	{
		document.frmaddDepartment.txtlossnop.value=parseInt(document.frmaddDepartment.txtbalnop.value);
		document.frmaddDepartment.txtlossnomp.value=parseInt(document.frmaddDepartment.txtbalnomp.value);
		document.frmaddDepartment.txtarrqty.value=parseInt(document.frmaddDepartment.txtbalqty.value);
		document.frmaddDepartment.txtbalnop.value=0;
		document.frmaddDepartment.txtbalnomp.value=0;
		document.frmaddDepartment.txtbalqty.value=0;
	}
	if(document.frmaddDepartment.lossbook.value=="Yes-Partial")
	{
		if(document.frmaddDepartment.txtlossnop.value=="")
		{
			alert("Enter Loss NoP");
			document.frmaddDepartment.txtlossnop.focus();
			return false;
		}
	}
}
function nopcal(nop)
{	
	var upknomp;
	if(parseInt(nop) > parseInt(document.frmaddDepartment.txtnop.value))
	{
		alert("Invalid NoP");
		//alert(nop+">"+document.frmaddDepartment.txtnop.value)
		document.frmaddDepartment.txtarrnop.value="";
		document.frmaddDepartment.txtarrnop.focus();
		return false;
	}
	
	var ups = document.frmaddDepartment.ups.value;
	var wtmp = document.frmaddDepartment.wtmp.value;
	var ups1 = ups.split(" ");
	
	if(ups1[1]=="Kgs")
	{
		document.frmaddDepartment.txtarrqty.value = parseFloat(ups1[0]) * parseFloat(nop);
	}
	if(ups1[1]=="Gms")
	{
		document.frmaddDepartment.txtarrqty.value = parseFloat(ups1[0]/1000) * parseFloat(nop);
	}
	
	upknomp=parseFloat(document.frmaddDepartment.txtarrqty.value/wtmp);
	//alert(upknomp);
	var upknomp12 = upknomp+"";
	var upknomp1 = upknomp12.split(".");
	
	if(upknomp1[1]>0)
		document.frmaddDepartment.txtupknomp.value = parseInt(upknomp1[0])+1;
	else
		document.frmaddDepartment.txtupknomp.value = parseInt(upknomp1[0]);
		
	document.frmaddDepartment.txtbalnop.value = parseInt(document.frmaddDepartment.txtnop.value) - parseInt(nop);
	document.frmaddDepartment.txtbalnomp.value = parseInt(document.frmaddDepartment.txtnomp.value) - parseInt(document.frmaddDepartment.txtupknomp.value);
	document.frmaddDepartment.txtbalqty.value = parseFloat(document.frmaddDepartment.txtqty.value) - parseFloat(document.frmaddDepartment.txtarrqty.value);
	if(parseInt(document.frmaddDepartment.txtbalnop.value)<=0)document.frmaddDepartment.txtbalnop.value=0;
	if(parseInt(document.frmaddDepartment.txtbalnomp.value)<=0)document.frmaddDepartment.txtbalnomp.value=0;
	if(parseFloat(document.frmaddDepartment.txtbalqty.value)<=0)document.frmaddDepartment.txtbalqty.value=0.000;
}

function lossnopcal(lossnop)
{
	//alert(document.frmaddDepartment.txtarrnop.value);
	var txtlossqty=document.frmaddDepartment.txtlossqty.value;
	var lossnomp;
	if(document.frmaddDepartment.txtarrnop.value=="")
	{
		alert("Enter Arrived NoP");
		document.frmaddDepartment.txtlossnop.value="";
		document.frmaddDepartment.txtarrnop.focus();
		return false;
	}
	if(parseInt(lossnop) > parseInt(document.frmaddDepartment.txtbalnop.value))
	{
		alert("Invalid NoP");
		document.frmaddDepartment.txtlossnop.value="";
		document.frmaddDepartment.txtlossnop.focus();
		return false;
	}
	document.frmaddDepartment.txtbalnop.value = parseInt(document.frmaddDepartment.txtbalnop.value) - parseInt(lossnop);	
	
	var ups = document.frmaddDepartment.ups.value;
	var wtmp = document.frmaddDepartment.wtmp.value;
	
	txtlossqty = parseFloat(txtlossqty) + (parseFloat(wtmp) * parseFloat(lossnomp));
	
	var ups1 = ups.split(" ");
	if(ups1[1]=="Kgs")
	{
		document.frmaddDepartment.txtlossqty.value = parseFloat(ups1[0]) * parseFloat(lossnop);
	}
	if(ups1[1]=="Gms")
	{
		document.frmaddDepartment.txtlossqty.value = parseFloat(ups1[0]/1000) * parseFloat(lossnop);
	}
		
	lossnomp=parseFloat(document.frmaddDepartment.txtlossqty.value/wtmp);
	var lossnomp12 = lossnomp+"";
	var lossnomp1 = lossnomp12.split(".");
	
	document.frmaddDepartment.txtlossnomp.value = parseInt(lossnomp1[0]);
	
	document.frmaddDepartment.txtbalnomp.value = parseInt(document.frmaddDepartment.txtnomp.value) - parseInt(document.frmaddDepartment.txtupknomp.value) - parseInt(document.frmaddDepartment.txtlossnomp.value);
	
	document.frmaddDepartment.txtbalqty.value = parseFloat(document.frmaddDepartment.txtqty.value) - parseFloat(document.frmaddDepartment.txtarrqty.value) - parseFloat(document.frmaddDepartment.txtlossqty.value);
	if(parseInt(document.frmaddDepartment.txtbalnop.value)<=0)document.frmaddDepartment.txtbalnop.value=0;
	if(parseInt(document.frmaddDepartment.txtbalnomp.value)<=0)document.frmaddDepartment.txtbalnomp.value=0;
	if(parseFloat(document.frmaddDepartment.txtbalqty.value)<=0)document.frmaddDepartment.txtbalqty.value=0.000;
}

function expnopcal(nop)
{	
	//alert(nop);
	//alert(cls);
	if(nop>document.frmaddDepartment.pnop.value)
	{
		alert("Invalid NoP");
		document.frmaddDepartment.arrnop.value="";
		document.frmaddDepartment.arrnop.focus();
		return false;
	}
	
	var ups = document.frmaddDepartment.ups.value;
	var ups1 = ups.split(" ");
	//alert(ups1[1]);
	if(ups1[1]=="Kgs")
	{
		document.frmaddDepartment.arrqty.value = parseFloat(ups1[0]) * parseFloat(nop);
	}
	if(ups1[1]=="Gms")
	{
		document.frmaddDepartment.arrqty.value = parseFloat(ups1[0]/1000) * parseFloat(nop);
	}
			
	document.frmaddDepartment.txtbalnop.value = parseInt(document.frmaddDepartment.pnop.value) - parseInt(nop);
	document.frmaddDepartment.txtbalqty.value = parseFloat(document.frmaddDepartment.expqty.value) - parseFloat(document.frmaddDepartment.arrqty.value);
	if(parseInt(document.frmaddDepartment.txtbalnop.value)<=0)document.frmaddDepartment.txtbalnop.value=0;
	if(parseInt(document.frmaddDepartment.txtbalnomp.value)<=0)document.frmaddDepartment.txtbalnomp.value=0;
	if(parseFloat(document.frmaddDepartment.txtbalqty.value)<=0)document.frmaddDepartment.txtbalqty.value=0.000;
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction -  Arrival Pack Seed Stock Transfer - Plant</td>
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
		<input type="hidden" name="gln1" value="" />
		<input type="hidden" name="trsbmval" value="0" />
		<!--<input type="hidden" name="ep_id" value="<?php echo $epid?>" />-->
		</br>
<?php
//$tid=0; //$subtid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"><span class="Subheading">Arrival Pack Seed Stock Transfer - Plant</span></td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font> indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?><input type="hidden" class="tbltext" name="transactionid" value="<?php echo $code1;?>" /></td> 

<td width="192" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<?php
//echo "select * from tbl_stlotimp_pack where stlotimpp_id='$epid' and stlotimpp_trflg!=1 ";
$sql_arr_home=mysqli_query($link,"select * from tbl_stlotimp_pack where stlotimpp_id='$epid' and stlotimpp_trflg!=1 ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_arr_home=mysqli_fetch_array($sql_arr_home);
//echo "SELECT p_id, business_name FROM tbl_partymaser where stcode='".$row_arr_home['stlotimpp_plantcode']."'";
$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where stcode='".$row_arr_home['stlotimpp_plantcode']."'"); 
$noticia = mysqli_fetch_array($quer3);
?>
 <tr class="light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="tbltext" name="txtstfp" value="<?php echo $noticia['p_id'];?>" />   
		
</td>
	</tr>
<!--<td width="159" align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant &nbsp;</td>
<td width="228" align="left"  valign="middle" class="tbltext">&nbsp;
  <input name="txtsttp" type="text" size="35" class="tbltext" tabindex="" value="<?php echo $plname.", ".$city1;?>" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<?php echo $noticia['address'];?>,<?php echo $noticia['city'];?>,<?php echo $noticia['state'];?><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<?php 
$sql_transitmode=mysqli_query($link,"SELECT * FROM tbl_arrpack where arrpack_id='".$tid."' and plantcode='$plantcode'");
$row_transitmode = mysqli_fetch_array($sql_transitmode);
?>
<tr class="Light" height="25">
<td width="230" align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Transport" onClick="clk(this.value);" <?php if($row_transitmode['arrpack_tmode']=="Transport") echo "checked"; ?> />Transport&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Courier" onClick="clk(this.value);" <?php if($row_transitmode['arrpack_tmode']=="Courier") echo "checked"; ?> />Courier&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_transitmode['arrpack_tmode']=="By Hand") echo "checked"; ?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;<input name="txt11" value="<?php echo $row_transitmode['arrpack_tmode'];?>" type="hidden"> </td>
</tr>
</table>
<div id="trans"  style="display:<?php if($row_transitmode['arrpack_tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>; width:850">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="230" align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td width="262" align="left"  valign="middle" class="smalltbltext">&nbsp;
  <input name="txttname" type="text" size="25" class="smalltbltext" tabindex="" maxlength="25" value="<?php echo $row_transitmode['arrpack_transname'];?>"></td>
<td width="192" align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtlrn" type="text" size="15" class="smalltbltext" tabindex=""  maxlength="15" value="<?php echo $row_transitmode['arrpack_lrno'];?>" ></td>
</tr>

<tr class="Light" height="25">
<td width="230" align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td width="262" align="left" valign="middle" class="smalltbltext" >&nbsp;
  <input name="txtvn" type="text" size="12" class="smalltbltext" tabindex="" maxlength="12" value="<?php echo $row_transitmode['arrpack_vehno'];?>" ></td>
<td width="192" align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txt13" style="width:70px;"  >
<option value="" selected="selected">Select</option>
<option <?php if($row_transitmode['arrpack_paymode']=="TBB")echo "Selected";?> value="TBB">TBB</option>
<option <?php if($row_transitmode['arrpack_paymode']=="To Pay")echo "Selected";?> value="To Pay" >To Pay</option>
<option <?php if($row_transitmode['arrpack_paymode']=="Paid")echo "Selected";?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_transitmode['arrpack_tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td width="264" align="left" valign="middle" class="smalltbltext">&nbsp;
  <input name="txtcname" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20" value="<?php echo $row_transitmode['arrpack_couriername'];?>" ></td>
<td width="192" align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtdc" type="text" size="15" class="smalltbltext" tabindex="" maxlength="15" value="<?php echo $row_transitmode['arrpack_docketno'];?>" ></td>
</tr>
</table>
</div>
<div id="byhand" style="display:<?php if($row_transitmode['arrpack_tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="229" align="right" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td width="715" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;
  <input name="txtpname" type="text" size="30" class="smalltbltext" tabindex=""  maxlength="30" value="<?php echo $row_transitmode['arrpack_pname'];?>" ></td>
</tr>
</table>
</div>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
	<td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="6%" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
	<td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">Ups</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Dispatch</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Received</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
	<td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">QC</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">SLOC</td>
	<!--<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>-->
</tr>
<tr class="tblsubtitle">
	<td width="3%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="3%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="3%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="10%" align="center" valign="middle" class="tblheading">WH</td>
	<td width="10%" align="center" valign="middle" class="tblheading">Bin</td>
	<td width="10%" align="center" valign="middle" class="tblheading">SubBin</td>
	<td width="7%" align="center" valign="middle" class="tblheading"></td>
</tr>
<?php 
$srno=1; $arrlot="";
$sql_impsub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_impsub=mysqli_num_rows($sql_impsub);
while($row_impsub=mysqli_fetch_array($sql_impsub))
{
	$crop=""; $variety=""; $lotno=""; $dispnop=""; $dispnomp=""; $dispqty=""; $recnop=""; $recnomp=""; $recqty=""; $balnop=""; $balnomp=""; $balqty=""; $qc=""; $pp=""; $moist="";$germ=""; $gottyp=""; $gotstatus="";	
	
$crop=$row_impsub['stlotimpp_crop']; 
$variety=$row_impsub['stlotimpp_variety']; 
$lotno=$row_impsub['stlotimpp_lotno']; 
$dispnop=$row_impsub['stlotimpp_nop']; 
$dispnomp=$row_impsub['stlotimpp_nomp']; 
$dispqty=$row_impsub['stlotimpp_qty']; 
$recnop=$row_impsub['stlotimpp_arrnop']; 
$recnomp=$row_impsub['stlotimpp_arrnomp']; 
$recqty=$row_impsub['stlotimpp_arrqty']; 
$balnop=$row_impsub['stlotimpp_balnop']; 
$balnomp=$row_impsub['stlotimpp_balnomp']; 
$balqty=$row_impsub['stlotimpp_balqty']; 
$qc=$row_impsub['stlotimpp_qc']; 
$ups=$row_impsub['stlotimpp_ups']; 
$moist=$row_impsub['stlotimpp_moist'];
$germ=$row_impsub['stlotimpp_germ']; 
$gottyp=$row_impsub['stlotimpp_gottype']; 
$gotstatus=$row_impsub['stlotimpp_got'];

$wh1=""; $bin=""; $subbin="";
//echo "select * from tbl_arrpack_subsub where arrpack_id='".$tid."' and arrpackss_lotno='".$lotno."' ";
$sql_arrsloc=mysqli_query($link,"select * from tbl_arrpack_subsub where arrpack_id='".$tid."' and arrpackss_lotno='".$lotno."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_arrsloc=mysqli_num_rows($sql_impsub);
while($row_arrsloc=mysqli_fetch_array($sql_arrsloc))
{
$whid=$row_arrsloc['arrpackss_whid']; $binid=$row_arrsloc['arrpackss_binid']; $subbinid=$row_arrsloc['arrpackss_subbinid'];
	$whd1=mysqli_query($link,"select * from tbl_warehouse where whid='".$row_arrsloc['arrpackss_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
	$row_whd1=mysqli_fetch_array($whd1);
	
	$bin1=mysqli_query($link,"select * from tbl_bin where binid='".$row_arrsloc['arrpackss_binid']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_bin1=mysqli_fetch_array($bin1);
	
	$subbin1=mysqli_query($link,"select * from tbl_subbin where sid='".$row_arrsloc['arrpackss_subbinid']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_subbin1=mysqli_fetch_array($subbin1);
	
	if($wh1=="")
		$wh1=$row_whd1['perticulars'];
	else
		$wh1=$wh1."<br />".$row_whd1['perticulars'];
	
	if($bin=="") 
		 $bin=$row_bin1['binname'];
	else
		 $bin=$bin."<br />".$row_bin1['binname'];
	
	 if($subbin=="")
		$subbin=$row_subbin1['sname'];
	 else
		$subbin=$subbin."<br />".$row_subbin1['sname'];
}
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));	
// echo $bin1;
?>

<tr class="Light" height="20">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?><input type="hidden" name="txtlot_<?php echo $srno;?>" value="<?php echo $lotno;?>" /></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $dispnop;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $dispnomp;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $dispqty;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $recnop;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $recnomp;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $recqty;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $balnop;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnomp;?></td>
	<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td width="10%" align="left" valign="middle" class="smalltbltext" id="wh<?php echo $srno;?>">&nbsp;<?php if($wh1!=""){ echo $wh1;?><input type="hidden" name="txtwhg_<?php echo $srno;?>" id="txtwhg_<?php echo $srno?>" value="<?php echo $whid;?>"  /><?php } else {?><select class="smalltbltext" id="txtwhg_<?php echo $srno?>" name="txtwhg1" style="width:70px;" onchange="wh(this.value,'<?php echo $srno?>');"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select><?php }?></td>
	
	<td width="10%" align="left" valign="middle" class="smalltbltext" id="bin<?php echo $srno;?>">&nbsp;<?php if($bin!=""){ echo $bin;?><input type="hidden" name="vbin_<?php echo $srno;?>" id="vbin_<?php echo $srno?>" value="<?php echo $binid;?>"  /><?php } else {?>
	  <select class="smalltbltext" id="vbin_<?php echo $srno;?>" name="vbin_<?php echo $srno;?>" style="width:60px;" onchange="bin2(this.value,'<?php echo $srno?>');" >
<option value="" selected>Bin</option>
	<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select><?php }?></td>
		
		<td width="10%" align="left" valign="middle" class="smalltbltext" id="subbin<?php echo $srno;?>">&nbsp;<?php if($subbin!=""){echo $subbin;?><input type="hidden"  id="vsubbin_<?php echo $srno;?>" name="vsubbin_<?php echo $srno;?>" value="<?php echo $subbinid;?>"  /><?php } else {?>
		  <select class="smalltbltext" id="vsubbin_<?php echo $srno;?>" name="vsubbin_<?php echo $srno;?>" style="width:60px;" >
<option value="" selected>SubBin</option>
	<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?><?php }?></select></td>
		<td width="7%" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="newsloc('<?php echo $srno?>')">NEW SLOC</a></td>
</tr>
<?php 
if($arrlot=="")
	$arrlot=$lotno;
else
	$arrlot=$arrlot.",".$lotno;	
$srno++;
}
$subtbltot=0;
?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
<input type="hidden" name="txtarrlot" value="<?php echo $arrlot;?>" />
<input type="hidden" name="arrbar" value="<?php echo $arrbar;?>" />
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>
<br/>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Type</td>
</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
<td width="714" align="left"  valign="middle" class="tbltext">&nbsp;<select class="smalltbltext" id="arrtyp" name="arrtyp" style="width:130px;" onchange="packarr(this.value);" >
<option value="packarr" selected>Packaged Arrival</option>
<option value="unpackarr" >Un-Packaged Arrival</option>
</select></td>

<td width="230"  align="right"  valign="middle" class="tblheading">Sub Types&nbsp;</td>
<td width="714" align="left"  valign="middle" class="tbltext">&nbsp;<select class="smalltbltext" id="arrsubtyp" name="arrsubtyp" style="width:130px;" onchange="packarrsub(this.value);" disabled="disabled" >
<option value="" selected>--Select--</option>
<option value="NoP" >Expected NoP</option>
<option value="NoP With Barcode" >Arrived NoP With Barcode</option>
<option value="NoP Without Barcode" >Arrived NoP Without Barcode</option>
</select>
</td></tr>
</table><br />
<div id="upknop" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpopp();">Select</a><input type="hidden" name="txtlotnoid" /></td>
<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table><br /></div>
<div id="get">

</div>
<div id="bardiv">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Arrival</td>
</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="sloccheck(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode During In-Progress Arrival</td> </tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />
&nbsp;<font color="#FF0000"></font></td>
</tr>
</table><br /></div>

<div id="nopwbar" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Unpackaging</td>
</tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Unpackaged Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="upkbarcode" id="txtbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="barinfo1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barinfo">

</div>
</div>

<div id="upknopnobar" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<input name="txtlot11" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpopp1();">Select</a><input type="hidden" name="txtlotnoid" /></td>
<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails1();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table><br />

<div id="upklotinfo">

</div>
</div>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="ep_id" value="<?php echo $epid?>" />
<div id="postingsubtable" style="display:block">
</div></div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="150" maxlength="90" ></td>
</tr>
</table>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_arrival_stocktransfer1.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<img src="../images/cancel.gif" border="0" style="display:inline;cursor:Pointer;" onclick="return mySubmit('1');" />&nbsp;&nbsp;<img src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit('0');" />&nbsp;&nbsp;</td>
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

  