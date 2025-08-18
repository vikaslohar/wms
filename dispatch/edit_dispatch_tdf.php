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
	require_once('../include/reader.php'); // include the class
	require_once("../include/insertxlsdata_rembar.php");	
	
	if(isset($_REQUEST['pid'])) { $pid = $_REQUEST['pid']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$remarks=trim($_POST['txtremarks1']);
		$remarks=str_replace("&","and",$remarks);
		$p_id=trim($_POST['maintrid']);
		$sql_main="update tbl_dtdf set dtdf_remarks='$remarks' where dtdf_id='$p_id'";
		$as=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		echo "<script>window.location='add_disptdf_preview.php?p_id=$p_id'</script>";	
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
<title>Dispatch - Transaction - Dispatch TDF</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="qtyrem_tdf.js"></script>
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
	/*dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");*/
	var fl=0;	
	document.getElementById('postbutn').disabled=true;
	/*if(dt3 > dt4)
	{
		alert("Please select Valid Party DC Date.");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter Party DC Number");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value.charCodeAt()==32)
	{
		alert("Party DC Number cannot start with Space");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		document.frmaddDepartment.txtpp.focus();
		fl=1;
		return false;
	}*/
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party Name");
		document.frmaddDepartment.txtstfp.focus();
		//document.getElementById('postbutn').disabled=false;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtolotno.value=="")
	{
		alert("Please select Lot No.");
		//document.frmaddDepartment.txtbrowse.focus();
		//document.getElementById('postbutn').disabled=false;
		fl=1;
		return false;
	}
	var sn=document.frmaddDepartment.sn.value;
	for (var i=1; i<sn; i++)
	{
		var sls="selsh_"+i;
		//alert(document.frmaddDepartment.mchksel.value); alert(i);
		//if(document.frmaddDepartment.mchksel.value!="" && document.frmaddDepartment.mchksel.value==i)
		if(document.getElementById(sls).checked==true)
		{
			//alert("checked");
			if(document.frmaddDepartment.txtolotno.value=="")
			{
				alert("Please select Lot No.");
				//document.frmaddDepartment.txtbrowse.focus();
				//document.getElementById('postbutn').disabled=false;
				fl=1;
				return false;
			}
			var bnop="bnop_"+i;
			
			var val=document.frmaddDepartment.srno2.value;
			//alert(val); 
			if(val!="")
			{	
				var v_1=0;
				var qtyd=0;
				var qtyo=0;
				var qtyb=0;
				var nop=0;
				var nomp=0;
				for(var j=1; j<=val; j++)
				{ 
					var dc="recnobp"+j;
					var rem="recqtyp"+j;
					var bal="txtbalqtyp"+j;
					var nop="txtbalnobp"+j;
					nop=parseInt(nop)+parseInt(document.getElementById(dc).value);
					nomp=parseInt(rem)+parseInt(document.getElementById(rem).value);
					if(document.getElementById(rem).value=="")
					{
						v_1++;
					}
						var q=document.getElementById(dc).value;
						var rq=document.getElementById(rem).value;
						var bq=document.getElementById(bal).value;
						
						if(rq=="")rq=0;
						
						var qtyd=parseFloat(qtyd)+parseFloat(rq);
						var qtyb=parseFloat(qtyb)+parseFloat(bq);
				}
				if(nop==0 && nomp==0)
				{
					alert("Please Enter NoB/Qty to Remove");
					//document.getElementById('postbutn').disabled=false;
					fl=1;
					return false;
				}
				if(v_1>=val)
				{
					alert("Please Enter NoB/Qty to Remove");
					document.getElementById('postbutn').disabled=false;
					fl=1;
					return false;
				}	
				//alert(parseFloat(qtyd));
				//alert(parseFloat(document.getElementById(bnop).value));				
				if(parseFloat(qtyd) > parseFloat(document.getElementById(bnop).value))
				{
					alert("Please check. Total Quantity to be Dispatched not matching with Total Balance Quantity in Order(s)");
					//document.getElementById('postbutn').disabled=false;
					fl=1;
					return false;
				}		
			}
		}
	}
	if(fl==1)
	{
		document.getElementById('postbutn').disabled=false;
		return false;
	}
	else
	{
		document.getElementById('postbutn').disabled=true;
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mform','','','','','');
	}  
}

function pformedtup()
{	
	/*dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");*/
	var fl=0;	
	document.getElementById('updatebutn').disabled=true;
	/*if(dt3 > dt4)
	{
		alert("Please select Valid Party DC Date.");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter Party DC Number");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value.charCodeAt()==32)
	{
		alert("Party DC Number cannot start with Space");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
	
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		document.frmaddDepartment.txtpp.focus();
		fl=1;
		return false;
	}*/
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party Name");
		//document.getElementById('updatebutn').disabled=false;
		document.frmaddDepartment.txtstfp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtolotno.value=="")
	{
		alert("Please select Lot No.");
		//document.getElementById('updatebutn').disabled=false;
		//document.frmaddDepartment.txtbrowse.focus();
		fl=1;
		return false;
	}
	var sn=document.frmaddDepartment.sn.value;
	for (var i=1; i<sn; i++)
	{
		var sls="selsh_"+i;
		//if(document.getElementById(sls).checked==true)
		{
			if(document.frmaddDepartment.txtolotno.value=="")
			{
				alert("Please select Lot No.");
				//document.getElementById('updatebutn').disabled=false;
				//document.frmaddDepartment.txtbrowse.focus();
				fl=1;
				return false;
			}
			var bnop="bnop_"+i;
			var eqtp="eqty_"+i;
			var rqtp="rqty_"+i;
			var val=document.frmaddDepartment.srno2.value;
			
			if(val!="")
			{	
				var v_1=0;
				var qtyd=0;
				var qtyo=0;
				var qtyb=0;
				var nop=0;
				var nomp=0;
				for(var j=1; j<=val; j++)
				{ 
					var dc="recnobp"+j;
					var rem="recqtyp"+j;
					var orem="txtrecoqtyp"+j;
					var bal="txtbalqtyp"+j;
					var nop="txtbalnobp"+j;
				
					nop=parseInt(nop)+parseInt(document.getElementById(dc).value);
					nomp=parseInt(rem)+parseInt(document.getElementById(rem).value);
					if(document.getElementById(rem).value=="")
					{
						v_1++;
					}
					var q=document.getElementById(dc).value;
					var orq=document.getElementById(orem).value;
					var rq=document.getElementById(rem).value;
					var bq=document.getElementById(bal).value;
						
					if(rq=="")rq=0;
						
					var qtyd=parseFloat(qtyd)+parseFloat(rq);
					var qtyb=parseFloat(qtyb)+parseFloat(bq);
					var qtyo=parseFloat(qtyo)+parseFloat(orq);
				}
				if(nop==0 && nomp==0)
				{
					alert("Please Enter NoB/Qty to Remove");
					fl=1;
					return false;
				}
				if(v_1>=val)
				{
					alert("Please Enter NoB/Qty to Remove");
					//document.getElementById('updatebutn').disabled=false;
					fl=1;
					return false;
				}
					
				//alert(parseFloat(qtyd));
				//alert(parseFloat(document.getElementById(bnop).value));
				if(document.getElementById(bnop).value > 0)
				{				
					if(((parseFloat(document.getElementById(rqtp).value)-parseFloat(qtyo))+parseFloat(qtyd)) > parseFloat(document.getElementById(eqtp).value))
					{
						alert("Please check. Total Quantity to be Dispatched not matching with Total Balance Quantity in Order(s)");
						//document.getElementById('updatebutn').disabled=false;
						fl=1;
						return false;
					}	
				}
				else
				{
					if(parseFloat(qtyd) > parseFloat(document.getElementById(eqtp).value))
					{
						alert("Please check. Total Quantity to be Dispatched not matching with Total Balance Quantity in Order(s)");
						//document.getElementById('updatebutn').disabled=false;
						fl=1;
						return false;
					}	
				}	
			}
		}
	}
	if(fl==1)
	{
		document.getElementById('updatebutn').disabled=false;
		return false;
	}
	else
	{
		document.getElementById('updatebutn').disabled=true;
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
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	else
	{
		//var itm="Pack Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var trid=document.frmaddDepartment.maintrid.value;
		winHandle=window.open('getuser_rem_lotno.php?crop='+crop+'&variety='+variety+'&trid='+trid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function editrec(val1, sno1, val2, val3, sn, val4)
{
	document.frmaddDepartment.ltchksel.value=sno1;
	var trid=document.frmaddDepartment.maintrid.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value;
	showUser(val1,'postingsubsubtable','subformedt',sno1,trid,val2,val3,sn,subtrid,subsubtrid,val4);
	//showUser(edtrecid,'postingsubtable','subformedt',trid,lotno,'','','');
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
	//return false;
	if(document.frmaddDepartment.maintrid.value==0 || document.frmaddDepartment.maintrid.value=="")
	{
		alert("You have not Posted any Item. Please post & then click Preview");
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
	if(qtyval1!="" && qtyval1 > 0)
	{
		var z1="txtextnob"+val;
		var z2="recnobp"+val;
		var z3="txtbalnobp"+val;
		
		document.getElementById(z2).value=parseInt(qtyval1);
		document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(qtyval1);
		//if(document.getElementById(z1).value > 0 && document.getElementById(b1).value<=0)document.getElementById(b1).value=1;
		if(document.getElementById(z2).value<=0)document.getElementById(z2).value=0;
		//if(document.getElementById(z3).value>0 && document.getElementById(z3).value<=0)document.getElementById(z3).value=1;
		
		
		if(document.frmaddDepartment.sstage.value=="Pack")
		{
			if(parseInt(document.getElementById(z2).value)>parseInt(document.getElementById(z1).value))
			{
				alert( "NoB can be either equal or less than Actual NoB");
				document.getElementById(z2).value="";
				document.getElementById(z3).value="";
				document.getElementById(z2).focus();
			}
			var b1="txtbalqtyp"+val;
			var b2="txtextqty"+val;
			var b3="recqtyp"+val;
			//var txtnups=document.frmaddDepartment.txtnups.value;
			var packtp=document.frmaddDepartment.txtnups.value.split(" ");
				
			if(packtp[1]=="Gms")
			{ 
				var ptp=(parseFloat(packtp[0])/1000);
			}
			else
			{
				var ptp=parseFloat(packtp[0]);
			}
			var qty=0.000;
			qty=parseFloat(qtyval1)*parseFloat(ptp);
			document.getElementById(b3).value=parseFloat(qty);
			document.getElementById(b3).value=parseFloat(document.getElementById(b3).value).toFixed(3);
			document.getElementById(b1).value=parseFloat(document.getElementById(b2).value)-parseFloat(document.getElementById(b3).value);
			document.getElementById(b1).value=parseFloat(document.getElementById(b1).value).toFixed(3);
			if(document.getElementById(b1).value<=0)document.getElementById(b1).value=0;	
		}
		
	}
	else
	{
		alert( "NoB can not be Zero");
		document.getElementById(z1).value="";
		document.getElementById(z2).value="";
		document.getElementById(z1).focus();
	}
}

function Bagschk1(Bagsval1, val)
{
	var z1="txtextnob"+val;
	var z2="recnobp"+val;
	var z3="txtbalnobp"+val;
		
	var q1="txtextqty"+val;
	var q2="recqtyp"+val;
	var q3="txtbalqtyp"+val;

	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		/*if(parseInt(document.getElementById(z2).value)>parseInt(document.getElementById(z1).value))
		{
			alert( "NoB/NoP can be either equal or less than Actual NoB/NoP");
			document.getElementById(z2).value="";
			document.getElementById(z3).value="";
			document.getElementById(z2).focus();
		}
		else*/
		{
			//alert(document.frmaddDepartment.txtstage.value);
			if(document.frmaddDepartment.txtstage.value=="Pack")
			{
				var tqt=parseFloat(document.getElementById(z1).value)*parseFloat(document.frmaddDepartment.ewtmp.value);
				//alert(tqt);
				var qst=parseFloat(document.getElementById(q1).value)-parseFloat(tqt);
				//alert(qst);
				var qty=parseFloat(Bagsval1)/parseFloat(document.frmaddDepartment.ewtmp.value);
				if(parseInt(document.getElementById(z1).value)==0)qty=0;
				qty1=parseFloat(qty).toFixed(3);
				var xs=qty1.split(".");
				//alert(xs[1]);
				//if(qst<=0 && xs[1]>0)
				
				
				var packtp=document.frmaddDepartment.txtnups.value.split(" ");
				
				if(packtp[1]=="Gms")
				{ 
					var ptp=(1000/parseFloat(packtp[0]));
				}
				else
				{
					var ptp=parseFloat(packtp[0]);
				}
				
				document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(qty);
				document.getElementById(z2).value=parseInt(qty);
				var qqt=parseFloat(document.frmaddDepartment.ewtmp.value)*parseFloat(document.getElementById(z2).value);
				var tlsub=parseFloat(Bagsval1)-parseFloat(qqt);
				if(packtp[1]=="Gms")
				var nlps=parseFloat(Bagsval1)*parseFloat(ptp);
				else
				var nlps=parseFloat(Bagsval1)/parseFloat(ptp);
				//alert(nlps);
				if(nlps<1)
				{
					alert("ALERT\n\nThe selected Lot is not having inventory in loose pouches.\nPlease enter Qty only in NoMP's");
					document.getElementById(z3).value="";
					document.getElementById(q3).value="";
					document.getElementById(z2).value="";
					document.getElementById(q2).value="";
					document.getElementById(q2).focus();
					return false;
				}
				
				nlps=parseFloat(nlps).toFixed(0);
				//alert(Bagsval1); alert(qqt); alert(ptp); alert(tlsub); alert(nlps);
				document.getElementById(z2).value=parseInt(nlps);
				if(parseInt(document.getElementById(z2).value)<0)
				document.getElementById(z2).value=0;
				
				/*if(nlps==0)
				{
					alert("ALERT\n\nThe selected Lot is not having inventory in loose pouches.\nPlease enter Qty only in NoMP's");
					document.getElementById(z3).value="";
					document.getElementById(q3).value="";
					document.getElementById(z2).value="";
					document.getElementById(q2).value="";
					document.getElementById(q2).focus();
					return false;
				}*/
				
				document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
				document.getElementById(q2).value=parseFloat(Bagsval1);
				document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(Bagsval1);
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
				if(document.getElementById(q3).value<0)document.getElementById(q3).value=0;
				if(document.getElementById(q2).value > 0 && document.getElementById(z2).value<=0)document.getElementById(z2).value=1;
				if(document.getElementById(q3).value > 0 && document.getElementById(z3).value<=0)document.getElementById(z3).value=1;
			}
			else
			{
				if((document.getElementById(z2).value=="" || document.getElementById(z2).value<=0) && Bagsval1>0)document.getElementById(z2).value=1;
				document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
				document.getElementById(q2).value=parseFloat(Bagsval1);
				document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(Bagsval1);
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
				if(document.getElementById(q3).value<0)document.getElementById(q3).value=0;
				if(document.getElementById(q2).value > 0 && document.getElementById(z2).value<=0)document.getElementById(z2).value=1;
				if(document.getElementById(q3).value > 0 && document.getElementById(z3).value<=0)document.getElementById(z3).value=1;
			}
			if(parseFloat(document.getElementById(q2).value)>parseFloat(document.getElementById(q1).value))
			{
				alert( "Qty can be either equal or less than Actual Qty");
				document.getElementById(q2).value="";
				document.getElementById(q3).value="";
				document.getElementById(q2).focus();
			}
		}
	}
	else
	{
		alert( "Qty can not be Zero");
		document.getElementById(q2).value="";
		document.getElementById(q3).value="";
		document.getElementById(q2).focus();
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
	/*if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter DC Number first");
		document.frmaddDepartment.txtpp.selectedIndex=0;
		document.getElementById('selectpartylocation').style.display="none";
		document.getElementById('selectparty').style.display="none";
		document.frmaddDepartment.txtptype.value="";
		//document.frmaddDepartment.rettype.value="";
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtdcno.value.charCodeAt()==32)
	{
		alert("DC Number cannot start with Space");
		document.frmaddDepartment.txtpp.selectedIndex=0;
		document.getElementById('selectpartylocation').style.display="none";
		document.getElementById('selectparty').style.display="none";
		document.frmaddDepartment.txtptype.value="";
		//document.frmaddDepartment.rettype.value="";
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}
	else*/
	{
		if(classval != "")
		{
			document.getElementById('selectpartylocation').style.display="block";
			document.getElementById('selectparty').style.display="none";
			showUser(classval,'selectpartylocation','partylocation','','','','','');
			document.frmaddDepartment.txtptype.value=classval;
			/*if(classval=="Dealer" || classval=="Bulk" || classval=="Export Buyer")
			document.frmaddDepartment.rettype.value="Sales Return P to C";	
			else if(classval=="Branch" || classval=="C&F")
			document.frmaddDepartment.rettype.value="Stock Transfer P to C";	
			else
			document.frmaddDepartment.rettype.value="";	*/
		}
		else
		{
			document.getElementById('selectpartylocation').style.display="none";
			document.getElementById('selectparty').style.display="none";
			document.frmaddDepartment.txtptype.value=classval;
			//document.frmaddDepartment.rettype.value="";	
		}
	}	
}	

function modetchk2(varval)
{
	showUser(varval,'upschd','upschdc','Standard','','','','','');
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
	var typ="selectp";
	if(isNaN(prid))typ="fillp";
	showUser(prid,'vaddress','vendor',typ,'','','','');
	//setTimeout(function(){showUser(prid,'ordernos','ordrno','','','','','')},400);
	setTimeout(function(){showUser(prid,'orderdetails','orderdet',typ,'','','','')},400);
}

function showordr(prid)
{
	var typ="selectp";
	if(isNaN(prid))typ="fillp";
	showUser(prid,'orderdetails','orderdet',typ,'','','','');
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

function alloctype(typ)
{
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Party First");
		document.getElementById('barcwise').style.display="block";
		document.getElementById('lotnwise').style.display="none";
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.txtlotn.value="";
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else
	{
		if(typ=="lotwise")
		{
			document.getElementById('barcwise').style.display="none";
			document.getElementById('lotnwise').style.display="block";
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.txtlotn.value="";
		}
		else if(typ=="barcodewise")
		{
			document.getElementById('barcwise').style.display="block";
			document.getElementById('lotnwise').style.display="none";
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.txtlotn.value="";
		}
		else
		{
			document.getElementById('barcwise').style.display="none";
			document.getElementById('lotnwise').style.display="none";
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.txtlotn.value="";
		}
	}
}

function selshow(sno,val1,val2,val3,val4)
{
	var sn=document.frmaddDepartment.sn.value;
	if(document.frmaddDepartment.maintrid.value<=0 || document.frmaddDepartment.maintrid.value=="")
	{
		if(document.frmaddDepartment.txt11.value!="")
		{
			if(document.frmaddDepartment.txt11.value=="Transport")
			{
				if(document.frmaddDepartment.txttname.value=="")
				{
					alert("Please enter Transport Name");
					document.frmaddDepartment.txttname.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
				if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
				{
					alert("Transport Name cannot start with space.");
					document.frmaddDepartment.txttname.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
				if(document.frmaddDepartment.txtvn.value=="")
				{
					alert("Please enter Vehicle No");
					document.frmaddDepartment.txtvn.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
				if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
				{
					alert("Vehicle No cannot start with space.");
					document.frmaddDepartment.txtvn.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
				if(document.frmaddDepartment.txt13.value=="")
				{
					alert("Please select Payment Mode");
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
			}
			else if(document.frmaddDepartment.txt11.value=="Courier")
			{
				if(document.frmaddDepartment.txtcname.value=="")
				{
					alert("Please enter Courier Name");
					document.frmaddDepartment.txtcname.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
				if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
				{
					alert("Courier Name cannot start with space.");
					document.frmaddDepartment.txtcname.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
				if(document.frmaddDepartment.txtdc.value=="")
				{
					alert("Please enter Docket No.");
					document.frmaddDepartment.txtdc.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
				if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
				{
					alert("Docket No. cannot start with space.");
					document.frmaddDepartment.txtdc.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}
			}
			else
			{
				if(document.frmaddDepartment.txtpname.value=="")
				{
					alert("Please enter Person Name");
					document.frmaddDepartment.txtpname.focus();
					for (var i=1; i<sn; i++)
					{
						var selsh="selsh_"+i;
						document.getElementById(selsh).checked=false;
					}
					return false;
				}	
			}
		}
		else
		{
			alert("Please select Mode of Transit");
			for (var i=1; i<sn; i++)
			{
				var selsh="selsh_"+i;
				document.getElementById(selsh).checked=false;
			}
			return false;
		}
	}

	
	if(sno>0)
	{
		for (var i=1; i<sn; i++)
		{
			var selsh="selsh_"+i;
			//alert(selsh);
			if(i!=sno)document.getElementById(selsh).checked=false;
		}
	}
	document.getElementById('lottbl').innerHTML="";
	document.getElementById('lotdt').innerHTML="";
	document.getElementById('lotsldt').innerHTML="";
	document.getElementById('tmt').value="";
	document.getElementById('tmt').selectedIndex=0;
	document.frmaddDepartment.mchksel.value=sno;
	document.frmaddDepartment.selcrp.value=val1;
	document.frmaddDepartment.selver.value=val2;
	document.frmaddDepartment.selord.value=val3;
	document.frmaddDepartment.selups.value=val4;
	/*var trid=document.frmaddDepartment.maintrid.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value;
	showUser(sno,'postingsubtable','ordetshow',val1,val2,val3,trid,subtrid,subsubtrid);*/
}

function sschk(stageval)
{
	document.frmaddDepartment.txtstage.value=stageval;
	document.getElementById('lottbl').innerHTML="";
	document.getElementById('lotdt').innerHTML="";
	document.getElementById('lotsldt').innerHTML="";
	var sno=document.frmaddDepartment.mchksel.value;
	var val1=document.frmaddDepartment.selcrp.value;
	var val2=document.frmaddDepartment.selver.value;
	var val3=document.frmaddDepartment.selord.value;
	var val4=document.frmaddDepartment.selups.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value;
	if(sno=="")
	{
		alert("Please select Line Item first");
		return false;
	}
	else
	{
		showUser(sno,'postingsubtable','ordetshow',val1,val2,val3,trid,subtrid,subsubtrid,stageval,val4);
	}
}

function sellot(val1, sno1, val2, val3, sn, val4, stageval, selups)
{
	var bnop="bnop_"+sn;
	var selsh="selsh_"+sn;
	if(document.getElementById(bnop).value==0)
	{
		alert("Balance Qty to be Dispatch is ZERO.");
		document.getElementById(selsh).checked=false;
		return false;
	}
	else
	{
		document.frmaddDepartment.ltchksel.value=sno1;
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value;
		showUser(val1,'postingsubsubtable','lotshow',sno1,trid,val2,val3,sn,subtrid,subsubtrid,val4,stageval,selups);
	}
}

function editrecmain(edtrecid, trid, sn)
{
	//alert("Edit main");
	showUser(edtrecid,'postingtable','mainformedt',trid,sn,'','','');
}

function bform()
{
	if(document.frmaddDepartment.subtrid.value=="" || document.frmaddDepartment.subtrid.value==0)
	{
		alert("You have not posted any record for selected Crop/Variety");
		//document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
	else
	{
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value
		//alert(a);
		showUser(subtrid,'postingtable','mbform',trid,subsubtrid,'','','');
		return false;
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

function showmbarcodes(nlots, sid, trid, sn)
{
	//var pid=document.frmaddDepartment.pid.value;
	winHandle=window.open('disptdf_lotdet.php?&pid='+trid+'&sid='+sid+'&sn='+sn+'&nlots='+nlots,'WelCome','top=170,left=180,width=520,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch TDF</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
<?php
  
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

	$arrival_id=$row_tbl['dtdf_id'];

	$tdate=$row_tbl['dtdf_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dtdf_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$subtid=0;
	$subsubtid=0;
	
?> 
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" enctype="multipart/form-data"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $row_tbl['tmode'];?>" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['dtdf_tcode']?>" />
		<input type="hidden" name="logid" value="<?php echo $row_tbl['dtdf_logid']?>" />
		<input type="hidden" name="getdetflg" value="0" />
		<input type="hidden" name="txtconchk" value="" />
		<input type="hidden" name="txtptype" value="<?php echo $row_tbl['dtdf_partytype']; ?>" />
		<input type="hidden" name="txtcountrysl" value="<?php echo $row_tbl['dtdf_location']; ?>" />
		<input type="hidden" name="txtcountryl" value="<?php echo $row_tbl['dtdf_location']; ?>" />
		<input type="hidden" name="rettype" value=""  />
		<input type="hidden" name="txtstage" value="" />

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch TDF</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dtdf_tcode']."/".$row_tbl['dtdf_yearcode']."/".$row_tbl['dtdf_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?><input name="dcdate" id="dcdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;</td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_dcno'];?><input name="txtdcno" type="hidden" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="<?php echo $row_tbl['dtdf_dcno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<?php

//$quer3=mysqli_query($link,"SELECT * FROM tblclassification  where (main='Channel' or main='Stock Transfer') order by classification"); 
?>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dtdf_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dtdf_partytype']; ?>"  />
</td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php

if($row_tbl['dtdf_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dtdf_state']; ?>" />
</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dtdf_state']."' and productionlocationid='".$row_tbl['dtdf_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dtdf_location']; ?>" />
</td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location']; ?>" />
<?php
}
else
{
	$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dtdf_location']."' order by country")or die(mysqli_error($link));
	$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dtdf_location'];?>" />
</td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >-->
<?php
$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
	if($tt=mysqli_num_rows($quer33)>0)
	{
		$row33=mysqli_fetch_array($quer33);
		$name=$row33['business_name'];
		$address=$row33['address'];
		$city=$row33['city']; 
		$state=$row33['state'];
		$pincode=$row33['pin'];
	}
	else
	{
		$sql_month2=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1'")or die("Error:".mysqli_error($link));
		$tt=mysqli_num_rows($sql_month2);
		$row_month2=mysqli_fetch_array($sql_month2);
		$name=$row_month2['orderm_partyname'];
		$address=$row_month2['orderm_partyaddress'];
		$city=$row_month2['orderm_partycity']; 
		$state=$row_month2['orderm_partystate'];
		$pincode=$row_month2['orderm_partypin'];
	}
	$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dtdf_party']."' order by business_name")or die(mysqli_error($link));
	$noticia = mysqli_fetch_array($sql_month24);
	//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $name;?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dtdf_party'];?>"  />
<!--<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month24)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['dtdf_party']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;--></td>
	</tr>
<?php
	
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $address;?><?php if($city!="") { echo ", ".$city; }?>, <?php echo $state;?><?php if($pincode!="") { echo " - ".$pincode; }?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td align="right" valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
<div id="orderdetails">
<?php
$quer330=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
if($tt=mysqli_num_rows($quer330)>0)
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
else
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
//$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);
if($t==0)
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
$t=mysqli_num_rows($sqlmonth);
$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtbl['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid
$ver="";
if($arrivalid!="")
{
	$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
	$totver2=mysqli_num_rows($sql_ver2);
	while($row_ver2=mysqli_fetch_array($sql_ver2))
	{
		if($ver!="")
			$ver=$ver.",".$row_ver2['order_sub_variety'];
		else
			$ver=$row_ver2['order_sub_variety'];
	}
}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Crop</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Variety</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS Type</td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoP</td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">No. of Orders</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">No. of Lots</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoB Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Balance</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Select</td>
</tr>
<?php 

/*$arid=explode(",",$arrivalid);
foreach($arid as atrid)
{
if($atrid<>"")
{*/

$sn=1; $sn24=0; $sid=0; $dflg=0;
//if($arrivalid!="")
{
/*$sql_crp=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_crp);
while($row_crp=mysqli_fetch_array($sql_crp))
{
$sql_ver=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and orderm_id in($arrivalid) order by order_sub_variety") or die(mysqli_error($link));
$totver=mysqli_num_rows($sql_ver);
while($row_ver=mysqli_fetch_array($sql_ver))
{*/
//$sqlver=mysqli_query($link,"select distinct order_sub_ups_type from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and order_sub_variety='".$row_ver['order_sub_variety']."' and orderm_id in($arrivalid) order by order_sub_ups_type") or die(mysqli_error($link));
//$totv=mysqli_num_rows($sqlver);
//while($rowver=mysqli_fetch_array($sqlver))
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{
$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}

//$sqlmon=mysqli_query($link,"select * from tbl_order_sub where order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
//$totz=mysqli_num_rows($sqlmon);
//while($rowtblsub=mysqli_fetch_array($sqlmon))
//{
	$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid)  and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
	$totvs=mysqli_num_rows($sqlsloc);
	while($rowsloc=mysqli_fetch_array($sqlsloc))
	{
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus=""; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
	$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_id")or die("Error:".mysqli_error($link));
	$totz=mysqli_num_rows($sqlmon);
	while($rowtblsub=mysqli_fetch_array($sqlmon))
	{

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
		if($tot=mysqli_num_rows($sql_m) > 0)
		{
			while($row_m=mysqli_fetch_array($sql_m))
			{
				if($ordno!="")
				$ordno=$ordno.",".$row_m['orderm_porderno'];
				else
				$ordno=$row_m['orderm_porderno'];
				$nord++;
			}
		}
		$orxd=explode(",",$ordno);
		$tid240=array_keys(array_flip($orxd));
		$ordno=implode(",",$tid240);
		
		if($reptyp1=="hold")
	    {	
			if($rowtblsub['order_sub_hold_flag']!=0)
			$statussub=$rowtblsub['order_sub_hold_type'];	
		}
		else
		{
			$statussub="";
		}


		$variet=$row_dept4['popularname'];
		$upstyp=$rowtblsub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		/*if($crop!="")
		{
		$crop=$crop."<br>".$rowtblsub['order_sub_crop'];
		// $rowtblsub['lotcrop'];
		}
		else
		{*/
		$crop=$rowtblsub['order_sub_crop'];
		//}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		/*if($variety!="")
		{
		$variety=$variety."<br>".$rowtblsub['order_sub_variety'];
		}
		else
		{*/
		$variety=$rowtblsub['order_sub_variety'];	
		//}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		if($lotno!="")
		{
			$lotno=$lotno."<br>".$rowtblsub['lotno'];
		}
		else
		{
			$lotno=$rowtblsub['lotno'];
		}
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
		if($qc!="")
		{
			$qc=$qc."<br>".$rowtblsub['qc'];
		}
		else
		{
			$qc=$rowtblsub['qc'];
		}
		if($got!="")
		{
			$got=$got."<br>".$rowtblsub['got'];
		}
		else
		{
			$got=$rowtblsub['got'];
		}
		if($stage!="")
		{
			$stage=$stage."<br>".$rowtblsub['order_sub_totbal_qty'];
		}
		else
		{
			$stage=$rowtblsub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
			$per=$per."<br>".$rowtblsub['pper'];
		}
		else
		{
			$per=$rowtblsub['pper'];
		}
		//echo $rowtblsub['order_sub_id'];

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";


	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($qt > 0 )	 
{
//$selups="";
$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		
$selups=$rowsloc['order_sub_sub_ups'];
$dq=explode(" ",$selups);
//if($upstyp=="ST")
{
$diq=explode(".",$dq[0]);
if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
$selups=$difq." ".$dq[1];
}
//echo "Select * from tbl_dtdf_sub where dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdfs_flg!=1 and dtdf_id='$tid' and dtdfs_upstype='$upstyp' and dtdfs_ups='".$selups."'";
$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdfs_flg!=1 and dtdf_id='$tid' and dtdfs_upstype='$upstyp' and dtdfs_ups='".$selups."'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $nolots=0;
 $to=mysqli_num_rows($sq);
if($to > 0)
{
	$ro=mysqli_fetch_array($sq);
	$nups=$ro['dtdfs_ups']; 
	$nnob=$ro['dtdfs_nob']; 
	$nqty=$ro['dtdfs_qty']; 
	$nbqty=$ro['dtdfs_bqty'];
	$crpnm=$cp; 
	$vernm=$vt;
	$sid=$ro['dtdfs_id'];
	$sn24=$sn;
	$dbsflg=$ro['dtdfs_flg'];
	
	$sq23=mysqli_query($link,"Select distinct dbss_lotno from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$sid' and dtdf_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
	}
$stageval=$ro['dtdfs_stage'];
$selups=$ro['dtdfs_ups'];
}
//echo "<br />";

?>
<tr class="Light" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext" title="<?php echo $ordno ?>"><?php echo $nord;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /><input type="hidden" name="enoordno<?php echo $sn;?>" id="enoordno_<?php echo $sn;?>" value="<?php echo $nord;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $selups;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $selups;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nolots;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($nqty==0 && $dbsflg==0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>','<?php echo $selups?>')" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>','<?php echo $selups?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
</tr>
<?php
$sn++;
}
}
}
}
}
}
//}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" /><input type="hidden" name="selcrp" value="" /><input type="hidden" name="selver" value="" /><input type="hidden" name="selord" value="" /><input type="hidden" name="selups" value="" />
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="50%"  align="right"  valign="middle" class="tblheading">Select Stage&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="sstage" style="width:120px;" onchange="sschk(this.value)" id="tmt">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <option value="Condition" >Condition</option>
	<option value="Pack" >Pack</option>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
</tr>
</table>	
<br />

<div id="postingsubtable" style="display:block">

<?php $sno1=0;?>
<table id="lottbl" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<input type="hidden" name="sno1" value="<?php echo $sno1;?>" /><input type="hidden" name="ltchksel" value="" />

<br />

<div id="postingsubsubtable" style="display:block">
<table id="lotdt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<table id="lotsldt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="0" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
</div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl['dtdf_remarks'];?>" ></td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_disptdf.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();"></td>
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

  