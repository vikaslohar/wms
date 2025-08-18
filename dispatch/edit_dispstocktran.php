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
	
	if(isset($_REQUEST['pid'])) { $pid = $_REQUEST['pid']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$mainid=trim($_POST['maintrid']);
		$txtstfp=trim($_POST['txtstfp']);
	   	$txtremarks=trim($_POST['txtremarks']);
		$txtremarks=str_replace("&","and",$txtremarks);
		$txt11=trim($_POST['txt11']);
		
		if($txt11=="Transport")
		{
			$txttname=trim($_POST['txttname']);
			$txtlrn=trim($_POST['txtlrn']);
			$txtvn=trim($_POST['txtvn']);
			$txt13=trim($_POST['txt13']);
		}
		else
		{
			$txttname="";
			$txtlrn="";
			$txtvn="";
			$txt13="";
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
		$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
		$row_month=mysqli_fetch_array($quer6);
		$pltcode=$row_month['code'];
		
		$quer5=mysqli_query($link,"SELECT distinct stcode FROM tbl_partymaser where p_id='$txtstfp' order by stcode asc"); 
		$noticia2 = mysqli_fetch_array($quer5); 
		$plantcodes=$noticia2['stcode'];
		
		$sql_main="update tbl_stoutm set stoutm_fromplant='$pltcode', stoutm_toplant='$plantcodes', stoutm_plant='$txtstfp', stoutm_ramarks='$txtremarks', tmode='$txt11', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt13', courier_name='$txtcname', docket_no='$txtdc', pname_byhand='$txtpname' where stoutm_id='$mainid'";
		$asdf=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	
		echo "<script>window.location='add_dispstocktrn_preview.php?pid=$mainid'</script>";	
		//exit;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch Stock Transfer</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="dispsttrn.js"></script>
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

function isNumberKey24(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 47 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isChar_o(Char) // This function accepts only alphabetic characters with no space, no special chars.
{
	var CharToChk = new String(Char);
	var LengthOfChar = CharToChk.length;
	var flag = true;
	for(var i=0;i<LengthOfChar;i++)
	{
		if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) 
		{
			flag = false;
			break;
		}	
	}
	return flag;
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
	var fl=0;	
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txtstfp.focus();
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
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	
	if(fl==1)
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
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txtstfp.focus();
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
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	
	if(fl==1)
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
	var f=0;
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Plant Name.");
		document.frmaddDepartment.txtcrop.value="";
		document.frmaddDepartment.txtcrop.selectedIndex=0;
		document.frmaddDepartment.txtstfp.focus();
		f=1;
	}
	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode of Transport");
		document.frmaddDepartment.txtcrop.value="";
		document.frmaddDepartment.txtcrop.selectedIndex=0;
		f=1;
	}
	if(document.frmaddDepartment.txt11.value!="")
	{
		if(document.frmaddDepartment.txt11.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
				alert("Please enter Transport Name");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txttname.focus();	
				f=1;
			}
				
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
				alert("Transport Name cannot start with space.");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txttname.focus();
				f=1;
			}
							
			if(document.frmaddDepartment.txtvn.value=="")
			{
				alert("Please enter Vehicle No");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txtvn.focus();
				f=1;
			}
				
			if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
			{
				alert("Vehicle No cannot start with space.");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txtvn.focus();
				f=1;
			}
			if(document.frmaddDepartment.txt13.value=="")
			{
				alert("Please select Payment Mode");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				f=1;
			}
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
				alert("Please enter Courier Name");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txtcname.focus();
				f=1;
			}
				
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
				alert("Courier Name cannot start with space.");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txtcname.focus();
				f=1;
			}
				
			if(document.frmaddDepartment.txtdc.value=="")
			{
				alert("Please enter Docket No.");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txtdc.focus();
				f=1;
			}
			
			if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
			{
				alert("Docket No. cannot start with space.");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txtdc.focus();
				f=1;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
				alert("Please enter Person Name");
				document.frmaddDepartment.txtcrop.value="";
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.txtpname.focus();
				f=1;
			}	
		}
	}
	if(f==1)
	{
		return false;
	}
	else
	{
		showUser(classval,'vitem','item','','','','','');
		document.frmaddDepartment.txtlot1.value=="";
		document.getElementById('showlots').innerHTML="";
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
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage first.");
		document.frmaddDepartment.txtstage.focus();
	}
	else
	{
		//var itm="Pack Seed";
		document.frmaddDepartment.txtlot1.value=="";
		document.getElementById('showlots').innerHTML="";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var stage=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		winHandle=window.open('getuser_strn_lotno.php?crop='+crop+'&variety='+variety+'&trid='+trid+'&stage='+stage,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
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
	var fl=0;	
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txtstfp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.maintrid.value=="0")
	{
		alert("You have not Posted any record");
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	if(fl==1)
	{
		return false;
	}
	else
	{
		return true;
	} 	 
}

function getdetails()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
	 alert("Please Select Lot Nos.");
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
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.txtstage.value;
			
		showUser(get,'showlots','get',crop,variety,tid,lotid,'','');
		//document.frmaddDepartment.getdetflg.value=1;
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
	if(qtyval1!="" && qtyval1 > 0)
	{
		var z1="txtdqtyp_"+val;
		var z2="txtqty_"+val;
		var z3="recqtyp_"+val;
		var b1="txtdbagp_"+val;
		if(parseFloat(document.getElementById(z3).value) > parseFloat(document.getElementById(z2).value))
		{
			alert( "Qty can be either equal or less than Actual Qty");
			document.getElementById(z1).value="";
			document.getElementById(z3).focus();
		}
		else
		{
		document.getElementById(z1).value=parseFloat(document.getElementById(z2).value)-parseFloat(qtyval1);
		if(document.getElementById(z1).value > 0 && document.getElementById(b1).value<=0)document.getElementById(b1).value=1;
		}
	}
	else
	{
		alert( "Qty can not be Zero");
		document.getElementById(z1).value="";
		document.getElementById(z3).value="";
		document.getElementById(z3).focus();
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
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
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
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
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
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
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
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
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
	var t=0;
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
	}
}

function inArray(needle,haystack)
{
	var count=haystack.length;
	for(var i=0;i<count;i++)
	{
		if(haystack[i]===needle){return true;}
	}
	return false;
}
function modetchk1(classval)
{	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtvariety.value="";
		document.frmaddDepartment.txtvariety.selectedIndex=0;
	}
	else
	{
		document.frmaddDepartment.txtlot1.value=="";
		document.getElementById('showlots').innerHTML="";
	}
}	

function verchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtstage.value="";
		document.frmaddDepartment.txtstage.selectedIndex=0;
	}
	else
	{
		document.frmaddDepartment.txtlot1.value=="";
		document.getElementById('showlots').innerHTML="";
	}
}
function modetchk2(varval)
{
	//showUser(varval,'upschd','upschdc','Standard','','','','','');
}
function locslchk(statesl)
{
	document.frmaddDepartment.locationname.value="";
	showUser(statesl,'locations','location','','','','','','');
}
function stateslchk(valloc)
{
	document.frmaddDepartment.locationname.value="";
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
	}
	else
	{
		var classval=document.frmaddDepartment.txtptype.value;
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'vitem1','item1',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}
function loccontrychk(countryval)
{
		document.frmaddDepartment.locationname.value="";
		if(document.frmaddDepartment.txtpp.value!="")
		{
			var classval=document.frmaddDepartment.txtptype.value;
			document.getElementById('selectparty').style.display="block";
			showUser(classval,'vitem1','item1',countryval,'','','','');
			document.frmaddDepartment.locationname.value=countryval;
			document.frmaddDepartment.txtcountry1.value=countryval;
		}
		else
		{
			alert("Please Select Party Type");
			document.frmaddDepartment.txtcountrysl.selectedIndex=0;
		}

}

function onloadfocus()
{
document.frmaddDepartment.txtstfp.focus();
}
function showaddr(prid)
{
	showUser(prid,'vaddress','vendor','','','','','');
	//setTimeout(function(){showUser(prid,'ordernos','ordrno','','','','','')},400);
	//setTimeout(function(){showUser(prid,'orderdetails','orderdet','','','','','')},400);
}

function showordr(prid)
{
	showUser(prid,'orderdetails','orderdet','','','','','');
}
function chkbarcode1(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod";
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
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
	}
	if(flg==0)
	{
		var bardet=document.frmaddDepartment.txtornos.value;
		var trid=document.frmaddDepartment.maintrid.value;
		showUser(bardet,'orderdetails','ordrbar',mltval,trid,'','','')
		setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
	}
}
function clk(opt)
{
	if(document.frmaddDepartment.txtstfp.value=="")
	{
			alert("Please select Party.");
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
</script>

<body onLoad="onloadfocus();">

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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch Stock Transfer - Plant</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >

<?php
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_stoutm where plantcode='".$plantcode."' and stoutm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

	$tdate=$row_tbl['stoutm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
$code=$row_tbl['stoutm_tcode'];
$arrival_id=$row_tbl['stoutm_id'];

$quer5=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['stoutm_plant']."' order by stcode asc"); 
$noticia2 = mysqli_fetch_array($quer5); 
$plantname=$noticia2['business_name'];

	
$subtid=0;
?>  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $row_tbl['tmode'];?>" type="hidden">
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Stock Transfer - Plant</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="158" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDS".$row_tbl['stoutm_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="191" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<?php
$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where classification='Stock Transfer-Plant' order by classification"); 
?>
  <tr class="Dark" height="30">
<td width="158"  align="right"  valign="middle" class="tblheading">Plant Name&nbsp;</td>
<td  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<select class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['stoutm_plant']) echo "Selected"; ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>

<tr class="Dark" height="30">
<td width="158" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia2['address'];?><?php if($noticia2['city']!="") { echo ", ".$noticia2['city']; }?>, <?php echo $noticia2['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td width="158" align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Transport") echo "checked"; ?> />Transport&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Courier") echo "checked"; ?> />Courier&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="By Hand") echo "checked"; ?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
</tr>
</table>
<div id="trans" style="display:<?php if($row_tbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>; width:850">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="158" align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td width="262" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txttname" type="text" size="25" class="smalltbltext" tabindex="" maxlength="25" value="<?php echo $row_tbl['trans_name'];?>"></td>
<td width="191" align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtlrn" type="text" size="15" class="smalltbltext" tabindex=""  maxlength="15" value="<?php echo $row_tbl['trans_lorryrepno'];?>" ></td>
</tr>

<tr class="Light" height="25">
<td width="158" align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td width="262" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="smalltbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['trans_vehno'];?>" ></td>
<td width="191" align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txt13" style="width:70px;"  >
<option value="" selected="selected">Select</option>
<option <?php if($row_tbl['trans_paymode']=="TBB")echo "Selected";?> value="TBB">TBB</option>
<option <?php if($row_tbl['trans_paymode']=="To Pay")echo "Selected";?> value="To Pay" >To Pay</option>
<option <?php if($row_tbl['trans_paymode']=="Paid")echo "Selected";?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>; width:850">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="158" align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td width="262" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtcname" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['courier_name'];?>" ></td>
<td width="191" align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td width="256" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtdc" type="text" size="15" class="smalltbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['docket_no'];?>" ></td>
</tr>
</table>
</div>
<div id="byhand" style="display:<?php if($row_tbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>; width:850">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30">
<td width="158" align="right" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="txtpname" type="text" size="30" class="smalltbltext" tabindex=""  maxlength="30" value="<?php echo $row_tbl['pname_byhand'];?>" ></td>
</tr>
</table>
</div>
<br />
<div id="postingtable" style="display:block">

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Stock Transfer Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="73" align="center" class="smalltblheading">Edit</td>-->
	<td width="72" align="center" class="smalltblheading">Delete</td>
</tr>
<?php 
$srno=1;
$sql_sub=mysqli_query($link,"Select * from tbl_stouts where plantcode='".$plantcode."' and stoutm_id='$tid'") or die(mysqli_error($link));
if($tot_sub=mysqli_num_rows($sql_sub) > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stouts_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$crop=$noticia_class['cropname'];

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stouts_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variety=$noticia_item['popularname'];

$lotn=$row_sub['stouts_lotno'];
$stgw=$row_sub['stouts_stage'];
$nobs=$row_sub['stouts_nob'];
$qtys=$row_sub['stouts_qty'];

if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>
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
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Form</td>
</tr>

<?php
$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop order by cropname Asc"); 
?>
  <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia33 = mysqli_fetch_array($quer33)) { ?>
		<option value="<?php echo $noticia33['cropid'];?>" />   
		<?php echo $noticia33['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext"  id="itm" name="txtvariety" style="width:170px;" onChange="modetchk1(this.value);" >
<option value="" selected="selected">--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
	</tr>
 <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstage" style="width:100px;" onChange="verchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<option value="Raw">Raw</option>
<option value="Condition">Condition</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading"> Select Lot Nos.&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext">&nbsp;<a href="Javascript:void(0);" onclick="openslocpop()">Select</a><input type="hidden" name="txtlot1" value="" /></td>	
	</tr>
</table>
<br />

<div id="showlots"></div>
<br />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="70" align="right" valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="774" align="left" valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="120" value="<?php echo $row_tbl['stoutm_ramarks'];?>" ></td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_dispstocktran.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  
