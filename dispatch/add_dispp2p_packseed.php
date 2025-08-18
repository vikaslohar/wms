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
		$mainid=trim($_POST['maintrid']);
		$txtstfp=trim($_POST['txttoplant']);
	   	$txtremarks=trim($_POST['txtremarks']);
		$txtremarks=str_replace("&","and",$txtremarks);
		$txt11=trim($_POST['txt11']);
		$trsbmval=trim($_POST['trsbmval']);
		if($trsbmval==0)
		{
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
			$plantcode=$noticia2['stcode'];
			//exit;
			$sql_main="update tbl_stoutmpack set stoutmp_tmode='$txt11', stoutmp_tname='$txttname', stoutmp_lorryrepno='$txtlrn', stoutmp_tvehno='$txtvn', stoutmp_paymode='$txt13', stoutmp_couriername='$txtcname', stoutmp_docketno='$txtdc', stoutmp_pnamebyhand='$txtpname' where stoutmp_id='$mainid'";
			$asdf=mysqli_query($link,$sql_main) or die(mysqli_error($link));
			
			echo "<script>window.location='add_dispstrn_packseed_preview.php?pid=$mainid'</script>";	
			
		}
		else
		{
			$sql_main="update tbl_stoutmpack set stoutmp_tflg='0' where stoutmp_id='$mainid'";
			$as=mysqli_query($link,$sql_main) or die(mysqli_error($link));
			echo "<script>window.location='home_dispp2p_packseed.php'</script>";	
		}
	}
	
	$sql_code="SELECT MAX(stoutm_tcode) FROM tbl_stoutm  ORDER BY stoutm_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="PSP".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="PSP".$code."/".$yearid_id."/".$lgnid;
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
<script src="dispsttrnpack.js"></script>
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
	if(document.frmaddDepartment.txttoplant.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txttoplant.focus();
		fl=1;
		return false;
	}
	//alert(document.frmaddDepartment.txtcrop.value);
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
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingsubtable','mform','','','','','');
		document.frmaddDepartment.barcode.focus();
		document.getElementById('txtbarcode').focus();
		document.getElementById('txtbarcode').focus();
		setTimeout('barfocus()',800);
		document.getElementById('txtbarcode').focus();
		document.getElementById('txtbarcode').focus();
		document.getElementById('txtbarcode').focus();
		document.frmaddDepartment.barcode.focus();
	}  
}
function barfocus()
{
	document.getElementById('txtbarcode').focus();
	document.frmaddDepartment.barcode.focus();
	if(document.getElementById('txtbarcode').value=="done" || document.getElementById('txtbarcode').value=="")
	{
		document.getElementById('txtbarcode').focus(); 
		document.getElementById('txtbarcode').scrollIntoView();
		document.getElementById('txtbarcode').value="";
	}
	document.getElementById('txtbarcode').focus();
	document.frmaddDepartment.barcode.focus();
}
function pformedtup()
{	
	var f=0;
	if(document.frmaddDepartment.txttoplant.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txttoplant.focus();
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
	if(document.frmaddDepartment.txttoplant.value=="")
	{
		alert("Please Select Plant Name.");
		document.frmaddDepartment.txtcrop.value="";
		document.frmaddDepartment.txtcrop.selectedIndex=0;
		document.frmaddDepartment.txttoplant.focus();
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
		winHandle=window.open('getuser_packseed_lotno.php?crop='+crop+'&variety='+variety+'&trid='+trid+'&stage='+stage,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function editrec(edtrecid, trid)
{
	//alert(trid);
	//var a=formPost(document.getElementById('mainform'));
	showUser(edtrecid,'edittable','edit',trid,'','','');
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


function mySubmit(sbmval)
{ 
	var fl=0;	
	if(document.frmaddDepartment.txttoplant.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txttoplant.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.maintrid.value=="" || document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not posted any records. Post records then click on Preview.");
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.subtrid.value!="" && document.frmaddDepartment.subtrid.value>0)
	{
		alert("You are in Loading Process. Click on Next to complete the Loading then click on Preview.");
		fl=1;
		return false;
	}	
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

function myhome()
{ 
	var fl=0;	
	if(document.frmaddDepartment.maintrid.value!="" || document.frmaddDepartment.maintrid.value>0)
	{
		if(document.frmaddDepartment.subtrid.value!="" && document.frmaddDepartment.subtrid.value>0)
		{
			alert("You are in Loading Process. Click on Next to complete the Loading then click on Back.");
			fl=1;
			return false;
		}
	}		
	if(fl==1)
	{
		return false;
	}
	else
	{
		window.location='home_dispp2p_packseed.php';
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
		showUser(classval,'upstp','uspsl','','','','','');
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
	document.frmaddDepartment.txttoplant.focus();
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

function showmbarcodes(barcodes)
{
	if(barcodes!="")
	{
		winHandle=window.open('getuser_mbarstatus1.php?tp='+barcodes,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function chkbarcode1(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcode";
	document.getElementById(txtbarcode).value=mltval;
	if(document.frmaddDepartment.txttobenomp.value!="" && document.frmaddDepartment.txttobenomp.value==document.frmaddDepartment.loadnomp.value)
	{
		alert("Loading Completed \n\n Clik on Next to select new Lot in Progress\n\nOR\n\nIncrease the value in To Load NoMP");
		document.frmaddDepartment.txttobenomp.focus();
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
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
		/*var pcode=document.frmaddDepartment.plantcodes.value.split(",");
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
			alert("Invalid Barcode4");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert("Invalid Barcode5");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}*/
	}
	if(flg==0)
	{
		//var bardet=document.frmaddDepartment.txtornos.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var ver=document.frmaddDepartment.txtvariety.value;
		var ups=document.frmaddDepartment.txtstage.value;
		var mchksel=document.frmaddDepartment.txttoplant.value;
		var brflg=document.frmaddDepartment.brflg.value;
		var ltno=document.frmaddDepartment.txtlot1.value;
		var upstyp='ST,NST';
		showUser(mltval,'barchk','barchk1',mltval,trid,ver,ups,mchksel,upstyp,ltno)
		mltval="'"+mltval+"'";
		
		setTimeout('showpmode('+mltval+')', 1500);
		//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
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
		if(document.frmaddDepartment.totbarcs.value!="")
		{
			var totbarcs=document.frmaddDepartment.totbarcs.value.split(",");
			var x=0;
			for(var i=0; i<totbarcs.length; i++)
			{
				if(totbarcs[i]==document.getElementById(txtbarcode).value)
				{
					alert(totbarcs[i]);
					x++;
				}
			}
			if(x==0)
			{
				alert("Barcode "+mltval+" cannot be Deleted/Unloaded.\n\nReason: Barcode not Loaded in this Transaction");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	}
	if(flg==0)
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','ordrbardet','','','','','');
		setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},800);
		
	}
}
function showpmode(mltval)
{
	//var bardet=document.frmaddDepartment.txtornos.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var ver=document.frmaddDepartment.txtvariety.value;
	var ups=document.frmaddDepartment.txtstage.value;
	var mchksel=document.frmaddDepartment.txttoplant.value;
	var brflg=document.frmaddDepartment.brflg.value;
	var ltno=document.frmaddDepartment.txtlot1.value;
	var upstyp='ST,NST';
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(mltval,'barchk','barchk1',mltval,trid,ver,ups,mchksel,upstyp,ltno)
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmode('+mltval+')', 1500);
	}
	else
	{
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==0)
		{
			updateform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
		else
		{
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Barcode not present in System");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==2)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Barcode already Dispatched");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==3)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Barcode already Loaded in current OR other Operator's Transaction");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==4)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Variety not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==5)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: UPS not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==6)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: This Lot's current QC/GOT Status is FAIL");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==7)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: This Lot's current QC/GOT Status is UT and Soft Release is not activated");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==8)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==9)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: This Barcode is already Unpackaged");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==10)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Lot is under Reserve Status");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==11)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Lot number not matching with Selected Lot Number");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==12)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Allocated Qty has been already Loaded to Selected Party");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==13)
			{
				alert("Barcode cannot be Dispatched.\n\nReason: Allocated Qty has been already Loaded to Selected Lot Number");
			}
			updateform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
	}
}

function showpmode1(mltval)
{
	//var bardet=document.frmaddDepartment.txtornos.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var ver=document.frmaddDepartment.txtvariety.value;
	var ups=document.frmaddDepartment.txtstage.value;
	var mchksel=document.frmaddDepartment.txttoplant.value;
	var brflg=document.frmaddDepartment.brflg.value;
	var upstyp='ST,NST';
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(mltval,'barchk','bardet',trid,subtrid,'','','')
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmode1('+mltval+')', 1500);
	}
	else
	{
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==0)
		{
			updateform1();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
		else
		{
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
			{
				alert("Barcode cannot be Unload.\n\nReason: Barcode not Loaded");
			}
			updateform1();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
	}
}

function updateform()
{	
	var fl=0;	
	if(document.frmaddDepartment.txttoplant.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txttoplant.focus();
		fl=1;
		return false;
	}
	//alert(document.frmaddDepartment.txtcrop.value);
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
		showUser(a,'postingtable','ordrbar','','','','','');
		setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},800);
	}  
}
function updateform1()
{	
	var fl=0;	
	if(document.frmaddDepartment.txttoplant.value=="")
	{
		alert("Please select Plant Name");
		document.frmaddDepartment.txttoplant.focus();
		fl=1;
		return false;
	}
	//alert(document.frmaddDepartment.txtcrop.value);
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
		showUser(a,'postingtable','ordrbardet','','','','','');
		setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},800);
	}  
}
function clk(opt)
{
	if(document.frmaddDepartment.txttoplant.value=="")
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
function stocknop(nop)
{
	document.frmaddDepartment.balnop.value=parseInt(document.frmaddDepartment.enop.value)-parseInt(nop);
	document.frmaddDepartment.balnomp.value=document.frmaddDepartment.enomp.value;
	
	if(document.frmaddDepartment.upstyp.value=="Gms")
	{
		document.frmaddDepartment.txttobeqty.value=parseFloat(nop)*parseFloat(document.frmaddDepartment.ups.value)/1000;
		document.frmaddDepartment.balqty.value=parseFloat(document.frmaddDepartment.eqty.value)-parseFloat((nop*document.frmaddDepartment.ups.value)/1000);
	}
	if(document.frmaddDepartment.upstyp.value=="Kgs")
	{
		document.frmaddDepartment.txttobeqty.value=parseFloat(nop)*parseFloat(document.frmaddDepartment.ups.value);
		document.frmaddDepartment.balqty.value=parseFloat(document.frmaddDepartment.eqty.value)-parseFloat((nop*document.frmaddDepartment.ups.value));
	}
	document.frmaddDepartment.txttobeqty.value=parseFloat(document.frmaddDepartment.txttobeqty.value).toFixed(3);
	document.frmaddDepartment.balqty.value=	parseFloat(document.frmaddDepartment.balqty.value).toFixed(3);
}
function stocknomp(nomp)
{

	if(parseInt(nomp)>parseInt(document.frmaddDepartment.txtavlnomp.value))
	{
		alert("Invalid NoMP");
		document.frmaddDepartment.txttobenomp.value="";
		document.frmaddDepartment.txttobenomp.focus();
		return false;
	}

	if(document.frmaddDepartment.txttobenop.value!="")
		var nop=document.frmaddDepartment.txttobenop.value;	
	else
		var nop=0;
	//alert(document.frmaddDepartment.enomp.value);
	//alert(nomp);
	//exit();
	document.frmaddDepartment.balnomp.value=parseInt(document.frmaddDepartment.enomp.value)-parseInt(nomp);
	if(document.frmaddDepartment.upstyp.value=="Gms")
	{
		document.frmaddDepartment.txttobeqty.value=parseFloat((nop*document.frmaddDepartment.ups.value)/1000)+parseFloat(nomp*document.frmaddDepartment.wtmp.value);
		
		document.frmaddDepartment.balqty.value=parseFloat(document.frmaddDepartment.eqty.value)-parseFloat(document.frmaddDepartment.txttobeqty.value);
	}
	if(document.frmaddDepartment.upstyp.value=="Kgs")
	{
		document.frmaddDepartment.txttobeqty.value=parseFloat(nop)*parseFloat(document.frmaddDepartment.ups.value)+parseFloat(nomp*document.frmaddDepartment.wtmp.value);
		document.frmaddDepartment.balqty.value=parseFloat(document.frmaddDepartment.eqty.value)-parseFloat((nop*document.frmaddDepartment.ups.value))-parseFloat(nomp*document.frmaddDepartment.wtmp.value);
	}
	document.frmaddDepartment.txttobeqty.value=parseFloat(document.frmaddDepartment.txttobeqty.value).toFixed(3);
	document.frmaddDepartment.balqty.value=	parseFloat(document.frmaddDepartment.balqty.value).toFixed(3);
	
	/*if(parseFloat(document.frmaddDepartment.txtavlqty.value)<parseInt(document.frmaddDepartment.txttobeqty.value))
	{
		document.frmaddDepartment.txttobeqty.value=parseFloat(document.frmaddDepartment.txtavlqty.value)
	}*/
}
function stockqty(qty)
{
	document.frmaddDepartment.balqty.value=parseFloat(document.frmaddDepartment.eqty.value)-parseFloat(qty);
	
	document.frmaddDepartment.balqty.value=	parseFloat(document.frmaddDepartment.balqty.value).toFixed(3);
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch Stock Transfer Pack Seed - Plant</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
   <?php
 /* $plantcodes=""; $yearcodes="";
	$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
	while($noticia = mysqli_fetch_array($quer4)) 
	{
		if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
		else
			$yearcodes=$noticia['ycode'];
	}
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$plantcodes=$row_month['code'];
	$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
	while($noticia2 = mysqli_fetch_array($quer5)) 
	{
		if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
		else
			$plantcodes=$noticia2['stcode'];
	}*/
  ?>
	  
	  <td align="center" colspan="4" >
  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="plantcodes" value="D" />
		<input type="hidden" name="yearcodes" value="" /> 
		<input type="hidden" name="trsbmval" value="0" /> 

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<?php
$maintrid=0; $subtid=0;
?>
<div id="postingtable">	

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Stock Transfer - Plant</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="158" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?><input type="hidden" name="code1" value="<?php echo $code1;?>" /></td>

<td width="191" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>

<?php
$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where classification='Stock Transfer-Plant' order by classification"); 
?>
  <tr class="Dark" height="30">
<td width="158"  align="right"  valign="middle" class="tblheading">Plant Name&nbsp;</td>
<td  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<select class="tbltext"  id="itm1" name="txttoplant" style="width:220px;" onChange="showaddr(this.value);" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>

<tr class="Dark" height="30">
<td width="158" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td width="158" align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3" ><input name="txt1" type="radio" class="smalltbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;<input name="txt11" value="" type="hidden"> </td>
</tr>
</table>
<div id="trans" style="display:none; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="158" valign="middle" class="smalltblheading" >&nbsp;Transport Name&nbsp;</td>
<td align="left" width="262"  valign="middle" class="smalltbltext" >&nbsp;<input name="txttname" type="text" size="25" class="smalltbltext" tabindex="" maxlength="25" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="191" align="right"  valign="middle" class="smalltblheading" >Lorry Receipt No.&nbsp;</td>
<td align="left" width="229" valign="middle" class="smalltbltext">&nbsp;<input name="txtlrn" type="text" size="15" class="smalltbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25" >
<td align="right" width="158" valign="middle" class="smalltblheading" >&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="262" valign="middle" class="smalltbltext"  >&nbsp;<input name="txtvn" type="text" size="12" class="smalltbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right" width="191"  valign="middle" class="smalltblheading" >&nbsp;Payment Mode&nbsp;</td>
 <td align="left" width="229"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txt13" style="width:70px;"  >
<option value="" selected="selected">Select</option>
<option value="TBB">TBB</option>
<option value="To Pay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:none; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30" >
<td align="right" width="158" valign="middle" class="smalltblheading" >&nbsp;Courier Name&nbsp;</td>
<td align="left" width="262" valign="middle" class="smalltbltext" >&nbsp;<input name="txtcname" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="191" valign="middle" class="smalltblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="229" valign="middle" class="smalltbltext">&nbsp;<input name="txtdc" type="text" size="15" class="smalltbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>

</table>
</div>
<div id="byhand" style="display:none; width:950">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse"> 
<tr class="Dark" height="30" >
<td align="right" width="158" valign="middle" class="smalltblheading" >&nbsp;Name of Person&nbsp;</td>
<td colspan="4" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtpname" type="text" size="30" class="smalltbltext" tabindex=""  maxlength="30" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<br />
<div id="postingsubtable" style="display:block">

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Stock Transfer Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="25" align="center" class="smalltblheading">#</td>
	<td width="135" align="center" class="smalltblheading">Crop</td>
	<td width="213" align="center" class="smalltblheading">Variety</td>
	<td width="162" align="center" class="smalltblheading">Lot No.</td>
	<td width="87" align="center" class="smalltblheading">UPS</td>
	<td width="72" align="center" class="smalltblheading">NoP</td>
	<td width="72" align="center" class="smalltblheading">NoMP</td>
	<td width="84" align="center" class="smalltblheading">Qty</td>
	<td width="80" align="center" class="smalltblheading">Edit</td>
	<!--<td width="72" align="center" class="smalltblheading">Delete</td>-->
</tr>

</table>
<br />

<div id="edittable">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
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
<td width="144" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext" id="upstp">&nbsp;<select class="tbltext" name="txtstage" style="width:170px;" onChange="verchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<!--<option value="Raw">Raw</option>
<option value="Condition">Condition</option>--> 
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading">Select Lot Nos.&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a>&nbsp;<font color="#FF0000">*</font></td>	
</tr>
</table>
<br />

<div id="showlots"></div>
<br /><input type="hidden" name="totbarcs" value="<?php echo $barc;?>" />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Loading</td></tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode during In-Progress Loading (Unloading)</td> </tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />&nbsp;<font color="#FF0000">*  Deleted Barcode will be stored back to its original SLOC Bin</font></td></tr>
</table><br />
<input type="hidden" name="maintrid" value="<?php echo $maintrid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" ><input type="hidden" name="txttobenomp" val=""/>
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0" style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="70" align="right" valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="774" align="left" valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="120" ></td>
</tr>
</table>
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_dispp2p_packseed.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return mySubmit('1');" />&nbsp;&nbsp;<img src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit('0');" />&nbsp;&nbsp;</td>
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

  
