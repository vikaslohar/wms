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
		$btntypval=trim($_POST['btntypval']);
		//exit;
		if($btntypval==0)
		{
			echo "<script>window.location='add_pronpslip_preview.php?p_id=$p_id'</script>";	
		}
		else
		{																																																																																																																																																																																																																																																																																							
			if($p_id>0)
			{
				$s_sub="UPDATE tbl_pnpslipmain SET pnpslipmain_tflag=0 where logid='".$logid."' and pnpslipmain_id='$p_id'";
				mysqli_query($link,$s_sub) or die(mysqli_error($link));	
			}
			echo "<script>window.location='home_pronpslip.php'</script>";
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Processing and Packing slip</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>

<script src="pronpslip.js"></script>
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
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
						//var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						//qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
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
	  
function qtychk1(qtyval1,srno)
{
		var sbin="txtbalnobp"+srno;
		var nob="txtextnob"+srno;
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else if(parseFloat(qtyval1)<=0)
	{
		alert("NoB entered for Processing can not be Zero");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}	
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("NoB entered for Processing can be Equal to or Less than Existing NoB in Bin");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1);
	}
}

function Bagschk1(qtyval1,srno)
{
	var actnob="recnobp"+srno;
	var sbin="txtbalqtyp"+srno;
	var nob="txtextqty"+srno;
	if(document.getElementById(actnob).value=="")
	{
		alert("Please enter NoB");
		var actqty="recqtyp"+srno;
		document.getElementById(actqty).value="";
		return false;
	}
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("Qty entered for Processing can be Equal to or Less than Existing Qty in Bin");
		var actnob="recqtyp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=Math.round((parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1))*100)/100;
	}
}

function pform()
{	
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Processing and Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	/*if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Processing and Packing Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	*/
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
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
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="P")
	{
		if(document.frmaddDepartment.srno2.value==2)
		{
			if(document.frmaddDepartment.recqtyp1.value=="" && document.frmaddDepartment.recqtyp2.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.recqtyp1.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Please enter Condition Seed NoB");
		document.frmaddDepartment.txtconnob.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Please enter Condition Seed Qty");
		document.frmaddDepartment.txtconqty.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Please enter Remnant (RM)");
		document.frmaddDepartment.txtconrem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Please enter Inert Material (IM)");
		document.frmaddDepartment.txtconim.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Please enter Processing Loss (PL)");
		document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
		{
			alert("Please select SLOC for Condition Seed");
			//document.frmaddDepartment.txtconpl.focus();
			f=1;
			return false;
		}
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDepartment.txtconslqty1.value;
		q2=document.frmaddDepartment.txtconslqty2.value;
		g=document.frmaddDepartment.balcqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in Condition Seed is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}	
	}
	
	if(f==1)
	{
		return false;
	}
	else
	{	
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			if(document.getElementById(acc).value!="")
			{ycc++;}
			else
			{ 
				if(document.getElementById('mpck_'+[l]).checked == true)
				{
					xcc++;
				} 
			}
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		/*if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
		{
			alert("Please select Barcode(s) for Pack Seed");
			f=1;
			return false;		
		}
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		if(y==x)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				return false;
				f=1;
			}
			if(document.frmaddDepartment.bpch.value>0)
			{
				alert("Balance Pouches not Linked");
				f=1;
				return false;
			}
		}*/
		
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

function pformedtup()
{	
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Processing and Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	/*if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Processing and Packing Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	*/
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
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
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="P")
	{
		if(document.frmaddDepartment.srno2.value==2)
		{
			if(document.frmaddDepartment.recqtyp1.value=="" && document.frmaddDepartment.recqtyp2.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.recqtyp1.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Please enter Condition Seed NoB");
		document.frmaddDepartment.txtconnob.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Please enter Condition Seed Qty");
		document.frmaddDepartment.txtconqty.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Please enter Remnant (RM)");
		document.frmaddDepartment.txtconrem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Please enter Inert Material (IM)");
		document.frmaddDepartment.txtconim.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Please enter Processing Loss (PL)");
		document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
		{
			alert("Please select SLOC for Condition Seed");
			//document.frmaddDepartment.txtconpl.focus();
			f=1;
			return false;
		}
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDepartment.txtconslqty1.value;
		q2=document.frmaddDepartment.txtconslqty2.value;
		g=document.frmaddDepartment.balcqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
			alert("Please check. Quantity in Condition Seed is not matching with Quantity distributed in Bins");
			return false;
			f=1;
		}	
	}
	if(f==1)
	{
		return false;
	}
	else
	{	
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			if(document.getElementById(acc).value!="")
			{ycc++;}
			else
			{ 
				if(document.getElementById('mpck_'+[l]).checked == true)
				{
					xcc++;
				} 
			}
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		/*if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
		{
			alert("Please select Barcode(s) for Pack Seed");
			f=1;
			return false;		
		}
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		if(y==x)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				return false;
				f=1;
			}
			if(document.frmaddDepartment.bpch.value>0)
			{
				alert("Balance Pouches not Linked");
				f=1;
				return false;
			}
		}*/
		
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}

function modetchk(classval)
{
	/*if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please Select Processing Slip Reference Number");
		document.frmaddDepartment.txtpsrn.focus();
		document.frmaddDepartment.txtcrop.selectedIndex=0;
		return false;
	}
	else*/
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		showUser(classval,'vitem','item','','','','','');
	}
}

function modetchk1()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		 alert("Please Select Crop");
		 document.frmaddDepartment.txtvariety.selectedIndex=0;
		 document.frmaddDepartment.txtcrop.focus();
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
	}
}

function openslocpop()
{
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		return false;
	}
	else if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var stage=document.frmaddDepartment.txtstage.value;
		var tid=document.frmaddDepartment.maintrid.value;
		var dop=document.frmaddDepartment.dopc.value;
		//alert(variety);
		winHandle=window.open('getuser_pronpslip_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid+'&dop='+dop,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function openslocpop1()
{
	if(document.frmaddDepartment.qc.value=="")
	{
		alert("Please Select QC.");
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

function wh1(wh1val)
{ 
	//alert(wh1val);
	if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
}

function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','1','','','');
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
		showUser(bin2val,'sbing2','bin','txtslsubbg2','2','','','');
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
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtconslnob1.value!="")
		var Bagsv1=document.frmaddDepartment.txtconslnob1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtconslqty1.value!="")
		var qtyv1=document.frmaddDepartment.txtconslqty1.value;
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
		
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtconslnob2.value!="")
		var Bagsv2=document.frmaddDepartment.txtconslnob2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtconslqty2.value!="")
		var qtyv2=document.frmaddDepartment.txtconslqty2.value;
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

function qtyf1(qtyval, sval)
{
	var sbbin="txtconslnob"+sval;
	var nobb="txtconslqty"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please Enter NoB");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("Qty can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}
function Bagsf1(Bags1val, sval)
{
	var sbbin="sb"+sval;
	var nobb="txtconslnob"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("NoB can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}


function editrec(edtrecid)
{
	//alert(edtrecid);
	showUser(edtrecid,'postingtable','subformedt','','','','','');
}
function getdetails(stage)
{
	/*if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
		{
			alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
	if(document.frmaddDepartment.txt1.value=="")
		{
	 alert("Please Select Mode Of Transit.");
	 document.frmaddDepartment.txt1.focus();
	}*/
	
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
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;					
	var tid=document.frmaddDepartment.maintrid.value;
	var lotid=document.frmaddDepartment.subtrid.value;
	var dsrn="";
	var stage=document.frmaddDepartment.txtstage.value;
	//alert(tid);
	//alert(lotid);
	
	//document.getElementById("postingsubtable").style.display="block";
	showUser(get,'postingsubsubtable','get',crop,variety,tid,lotid,dsrn,stage);
				//showUser(get,'postingsubtable','get',crop,variety,stage,'','');
}
function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','','');
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
	else
	{
		document.frmaddDepartment.submit();	 return true;
	}
}

function prochktyp(protypval)
{
	dt1=getDateObject(document.frmaddDepartment.dopc.value,"-");
	dt2=getDateObject(document.frmaddDepartment.qctestdate.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of QC Test (DoT) cannot be more than Date of Processing and Packing.");
		for( var i=0; i<document.frmaddDepartment.protyp.length; i++)
		{
			document.getElementById('protyp').checked=false;
		}
		document.frmaddDepartment.protype.value="";
		return false;
	}
	else if(document.frmaddDepartment.qcdtyp.value=="")
	{
		alert("QC Date Type cannot be blank.");
		for( var i=0; i<document.frmaddDepartment.protyp.length; i++)
		{
			document.getElementById('protyp').checked=false;
		}
		document.frmaddDepartment.protype.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.protype.value=protypval;
		if(protypval!="")
		{
			if(protypval=="E")
			{
				var sltn=document.frmaddDepartment.txtlot1.value.split("");
				var newtnob=0;
				var newtqty=0;
				var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13]+sltn[14]+sltn[15]+"C";
				document.getElementById('recnobp1').value=document.frmaddDepartment.txtextnob1.value;
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value=0;
				document.getElementById('recqtyp1').value=document.frmaddDepartment.txtextqty1.value;
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value=0;
				newtnob=parseInt(newtnob)+parseInt(document.frmaddDepartment.txtextnob1.value);
				newtqty=parseFloat(newtqty)+parseFloat(document.frmaddDepartment.txtextqty1.value);
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value=document.frmaddDepartment.txtextnob2.value;
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value=0;
					document.getElementById('recqtyp2').value=document.frmaddDepartment.txtextqty2.value;
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value=0;
					newtnob=parseInt(newtnob)+parseInt(document.frmaddDepartment.txtextnob2.value);
					newtqty=parseFloat(newtqty)+parseFloat(document.frmaddDepartment.txtextqty2.value);
				}
				
				document.frmaddDepartment.txtconnob.value=newtnob;
				document.frmaddDepartment.txtconqty.value=newtqty;
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0.000";
				document.frmaddDepartment.txtclotno.value=cltn;
				document.getElementById('avlnobpck').value=newtnob;
				document.getElementById('avlqtypck').value=newtqty;
				
			}
			else if(protypval=="P")
			{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=false;
				document.getElementById('recnobp1').style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=false;
				document.getElementById('recqtyp1').style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=false;
					document.getElementById('recnobp2').style.backgroundColor="#FFFFFF";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=false;
					document.getElementById('recqtyp2').style.backgroundColor="#FFFFFF";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0";
				var sltn=document.frmaddDepartment.txtlot1.value;
				showUser(sltn,'cltno','cltnonew','','','','','');
			}
			else
			{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0";
			}
		}
		else
		{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0";
		}
		//document.getElementById('avlqtypck').value="";
		//alert(document.frmaddDepartment.paceptyp.length);
		for(q=1; q<=document.frmaddDepartment.paceptyp.length; q++)
		{
			//var fet="paceptyp"+q;
			document.getElementById("paceptyp").checked=false;
		}
			
		//document.getElementById('picqtyp').value="";
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		//document.getElementById('balcnob').value="";
		//document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		//document.getElementById('pcktype').value="";
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Attach";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			var det="dtail_"+j;
			//alert(det);
			
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			
			//document.getElementById(c).value="";
			//document.getElementById(d).value="";
			//document.getElementById(e).value="";
			//document.getElementById(f).value="";
			//document.getElementById(g).checked=false;
			
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Attach";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			
			//document.getElementById(c).disabled=true;
			//document.getElementById(d).disabled=true;
			//document.getElementById(e).disabled=true;
			//document.getElementById(f).disabled=true;
			//document.getElementById(g).disabled=true;
			
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
	}
}

function chkpronob(nobval)
{
	if(parseInt(document.frmaddDepartment.srno2.value==2))
	{
		if(document.getElementById('recqtyp1').value=="" && document.getElementById('recqtyp2').value=="")
		{
			alert("Enter Processing Qty");
			return false;
		}
	}
	else
	{
		if(document.getElementById('recqtyp1').value=="")
		{
			alert("Enter Processing Qty");
			return false;
		}
	}
	if(nobval<=0)
	{
		alert("NoB cannot be Zero")
		document.frmaddDepartment.txtconnob.value="";
		document.frmaddDepartment.txtconnob.focus();
		return false
	}
	else
	{
		if(nobval!="")
		document.getElementById('avlnobpck').value=nobval;
		else
		document.getElementById('avlnobpck').value="";
	}
}

function chkproqty(qtyval)
{
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Enter Condition Seed NoB");
		document.frmaddDepartment.txtconqty.value="";
		return false;
	}
	else
	{
		document.getElementById('avlqtypck').value=qtyval;
		for(q=1; q<=document.frmaddDepartment.paceptyp.length; q++)
		{
		//var fet="paceptyp"+q;
		document.getElementById("paceptyp").checked=false;
		}
		
		document.getElementById('picqtyp').value="";
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').value="";
		document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		document.getElementById('pcktype').value="";
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Attach";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			/*document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;*/
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Attach";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			/*document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;*/
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
	}
}
function chkconqty()
{
	var abc=0;
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Enter Condition Seed Qty");
		document.frmaddDepartment.txtconrem.value="0";
		document.frmaddDepartment.txtconloss.value="0";
		document.frmaddDepartment.txtconper.value="0";
		return false;
	}
	if(document.frmaddDepartment.srno2.value==2)
	{
		abc=parseFloat(document.getElementById('recqtyp1').value)+ parseFloat(document.getElementById('recqtyp2').value);
	}
	else
	{
		abc=parseFloat(document.getElementById('recqtyp1').value);
	}	
	if(parseFloat(document.frmaddDepartment.txtconqty.value)> abc)
	{
		alert("Condition Seed Qty cannot be more than Total Quantity picked for Processing");
		document.frmaddDepartment.txtconrem.value="";
		return false;
	}
}
function chkrm()
{
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Enter Remnant (RM)");
		document.frmaddDepartment.txtconim.value="0";
		document.frmaddDepartment.txtconloss.value="0";
		document.frmaddDepartment.txtconper.value="0";
		return false;
	}
}

function chkim(plval)
{
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Enter Inert Material (IM)");
		document.frmaddDepartment.txtconpl.value="0";
		document.frmaddDepartment.txtconloss.value="0";
		document.frmaddDepartment.txtconper.value="0";
		return false;
	}
	else
	{
	var tpl=parseFloat(document.frmaddDepartment.txtconrem.value)+parseFloat(document.frmaddDepartment.txtconim.value)+parseFloat(plval);
	var plper=parseFloat(document.getElementById('recqtyp1').value);
	if(document.frmaddDepartment.srno2.value==2)
	{
		plper=parseFloat(plper)+parseFloat(document.getElementById('recqtyp2').value);
	}
	
	//alert(tpl);
	//alert(document.frmaddDepartment.txtconqty.value);
	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.txtconqty.value);
	//alert((Math.round(totalval*1000)/1000));
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not eual to sum total of Condition Seed & Total Condition Loss");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconpl.focus();
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	document.frmaddDepartment.txtconloss.value=tpl;
	var vaal=parseFloat(document.frmaddDepartment.txtconloss.value)/parseFloat(plper)*100;
	document.frmaddDepartment.txtconper.value=Math.round((vaal)*100)/100;
	}
	}
}

function sschk1()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtstage.selectedIndex=0;
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
	}
}

function sschk2()
{
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Select Stage");
		document.frmaddDepartment.txtpromech.selectedIndex=0;
		document.frmaddDepartment.txtstage.focus();
		return false;
	}
}

function sschk3()
{
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Select Processing Machine Code");
		document.frmaddDepartment.txtoprname.selectedIndex=0;
		document.frmaddDepartment.txtpromech.focus();
		return false;
	}
}

function sschk4()
{
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Select Operator");
		document.frmaddDepartment.txttreattyp.selectedIndex=0;
		document.frmaddDepartment.txtoprname.focus();
		return false;
	}
}

function mpchk(val1, val12)
{
	/*if(document.getElementById('lble_'+[val12]).value=="")
	{
		alert("Please enter Label No.");
		document.getElementById('mpck_'+[val12]).checked=false
		document.getElementById('lble_'+[val12]).focus()
		return false;
	}
	else*/
	{
		if(document.getElementById('mpck_'+[val12]).checked == true)
		{
			document.getElementById('nomp_'+[val12]).readOnly=false;
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#ffffff";
			//alert(document.getElementById('packqty_'+[val12]).value);
			//alert(document.getElementById('wtmp_'+[val12]).value);
			document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
			
			var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
			//alert(document.getElementById('nopc_'+[val12]).value);
			//alert(balnop);
			document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
			document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
			document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
			document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
			
			document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Attach</a>";
			
		}
		else
		{
			document.getElementById('nomp_'+[val12]).readOnly=true;
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			document.getElementById('dtail_'+[val12]).innerHTML="Attach";
		}
	}
}

function balnopcheck(balval, val12)
{
	var bv=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
	//alert(bv);
	//alert(balval);
	if(parseInt(balval) > parseInt(bv))
	{
		alert("No. of Master Pack cannot be greater than "+bv);
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
	else if(parseInt(document.getElementById('lodednomp_'+[val12]).value) > parseInt(balval))
	{
		alert("Max No. of Master Pack cannot be less than No of MP attached");
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
	else
	{
		var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
		document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
		document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
	}
}
function pcksel(pkselval)
{ //alert(pkselval);
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		for( var i=0; i<document.frmaddDepartment.paceptyp.length; i++)
		{
			document.getElementById('paceptyp').checked=false;
		}
		document.frmaddDepartment.pcktype.value="";
		return false;
	}
	else
	{
		if(pkselval=="P")
		{
			document.getElementById('picqtyp').value="";
			document.getElementById('picqtyp').readOnly=false;
			document.getElementById('picqtyp').style.backgroundColor="#ffffff";
			document.getElementById('balcnob').readOnly=false;
			document.getElementById('balcnob').style.backgroundColor="#ffffff";
			document.getElementById('balcnob').value="";
			document.getElementById('balcqty').value="";
			document.getElementById('conditionsloc').style.display="block";
			
			document.frmaddDepartment.txtslwhg1.value="";
			document.frmaddDepartment.txtslbing1.value="";
			document.frmaddDepartment.txtslsubbg1.value="";
			document.frmaddDepartment.txtconslnob1.value="";
			document.frmaddDepartment.txtconslqty1.value="";
			
			document.frmaddDepartment.txtslwhg2.value="";
			document.frmaddDepartment.txtslbing2.value="";
			document.frmaddDepartment.txtslsubbg2.value="";
			document.frmaddDepartment.txtconslnob2.value="";
			document.frmaddDepartment.txtconslqty2.value="";
			var sltn=document.frmaddDepartment.txtclotno.value.split("");
			var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13];
			var cl=sltn[14]+sltn[15];
			var c2=sprintf("%02d",(parseInt(cl)+1));
			cltn=cltn+c2+"P";
			document.frmaddDepartment.txtplotno.value=cltn;
		}
		else
		{
			document.getElementById('picqtyp').value=document.getElementById('avlqtypck').value;
			document.getElementById('picqtyp').readOnly=true;
			document.getElementById('picqtyp').style.backgroundColor="#cccccc";
			document.getElementById('balcnob').readOnly=true;
			document.getElementById('balcnob').style.backgroundColor="#cccccc";
			document.getElementById('balcnob').value=0;
			document.getElementById('balcqty').value=0;
			document.getElementById('conditionsloc').style.display="none";
			var pckloss=document.getElementById('pckloss').value;
			var ccloss=document.getElementById('ccloss').value;
			if(pckloss=="")pckloss=0;
			if(ccloss=="")ccloss=0;
			document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(pckloss)+parseFloat(ccloss))
			var sltn=document.frmaddDepartment.txtclotno.value.split("");
			var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13]+sltn[14]+sltn[15]+"P";
			document.frmaddDepartment.txtplotno.value=cltn;
		}
		document.getElementById('pcktype').value=pkselval;
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Attach";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			/*document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;*/
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Attach";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			/*document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;*/
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
	}
}

function chktotpouches(qtyval, qtyno)
{
	if(parseFloat(document.frmaddDepartment.balpck.value)!=parseFloat(qtyval))
	{
		alert("Please check. Quantity selected for packing and Quantity entered in Pack Seed is not matching");
		var packqty="packqty_"+qtyno;
		var nopc="nopc_"+qtyno;
		var domcs="domcs_"+qtyno;
		var lbls="lbls_"+qtyno;
		var domce="domce_"+qtyno;
		var lble="lble_"+qtyno;
		var mpck="mpck_"+qtyno;
		var nomp="nomp_"+qtyno;
		var noofpacks="noofpacks_"+qtyno;
		var detmpbno="detmpbno";
		
		document.getElementById(packqty).value="";
		document.getElementById(nopc).value="";
		/*document.getElementById(domcs).value="";
		document.getElementById(lbls).value="";
		document.getElementById(domce).value="";
		document.getElementById(lble).value="";
		document.getElementById(mpck).value="";*/
		document.getElementById(nomp).value="";
		document.getElementById(noofpacks).value="";
		document.getElementById(detmpbno).value="";
		return false;
	}
	else
	{
	var wtnop="wtnopkg_"+qtyno;
	var z="nopc_"+qtyno;
	var ds="noofpacks_"+qtyno;
	var zx=(parseFloat(qtyval)/parseFloat(document.getElementById(wtnop).value));
	document.getElementById(z).value=parseInt(zx);
	document.getElementById(ds).value=parseInt(zx);
	}
}

function domcchk(val1, val2)
{
	var x="domce_"+val2;
	var nopc="nopc_"+val2;
	var domcs="domcs_"+val2;
	
	if(val1!="")
	{
		document.getElementById(x).value=val1;
	}
	else
	{
		document.getElementById(x).value="";
	}
	
}

function domchk(dval)
{
	var x="domcs_"+dval;
	if(document.getElementById(x).value=="")
	{
		alert("Please select Label character");
		return false;
	}
}

function domchk1(lbval, dval)
{
	var x="lbls_"+dval;
	var tx="lble_"+dval;
	if(document.getElementById(x).value=="")
	{
		alert("Please enter Label number");
		document.getElementById(tx).focus();
		return false;
	}
	else
	{
		var z="nopc_1";
		var xx="lble_"+dval;
		if(parseInt(lbval)-parseInt(document.getElementById(x).value)<parseInt(document.getElementById(z).value))
		{
			alert("Total Label nos. are not matching with No. of Pouches");
			document.getElementById(xx).value="";
			return false;
		}
	}
}

function pfpchk(pfpval)
{
	document.getElementById('balcqty').value=Math.round((parseFloat(document.getElementById('avlqtypck').value)-parseFloat(pfpval))*100)/100;
	if(document.getElementById('balcqty').value<=0)
	{
		document.getElementById('balcqty').value=0;
		document.getElementById('balcnob').value=0;
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Attach";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		/*document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;*/
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Attach";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		/*document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;*/
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
}

function pfpchk1(pfpval)
{
	if(document.getElementById('picqtyp').value=="" || document.getElementById('picqtyp').value==0)
	{
		alert("Quantity Picked for Packing cannot be blank or Zero");
		document.getElementById('pckloss').value="";
		return false;
	}
	else
	{
		document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('ccloss').value)+parseFloat(pfpval));
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Attach";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		/*document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;*/
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Attach";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		/*document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;*/
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
}

function plchk1(pfpval)
{
	if(document.getElementById('pckloss').value=="")
	{
		alert("Packing Loss cannot be blank");
		document.getElementById('ccloss').value="";
		return false;
	}
	else
	{
		document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('pckloss').value)+parseFloat(pfpval));
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Attach";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		/*document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;*/
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Attach";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		/*document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;*/
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
}

function clk(snoval,upsid)
{
	//alert(snoval);
	var sno=document.frmaddDepartment.sno.value;
	//alert(sno);
	if(document.getElementById('ccloss').value=="")
	{
		alert("Captive Consumption cannot be blank");
		//document.getElementById('ccloss').value="";
		for(var i=1; i<=sno; i++)
		{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Attach";
		}
		return false;
	}
	else
	{
		if(snoval>0)
		{
			var upsname="upsname_"+snoval;
			document.frmaddDepartment.upssize.value=snoval;
			document.frmaddDepartment.upsidno.value=upsid;
			
			for(var j=1; j<=sno; j++)
			{
				//alert(j);
				var a="packqty_"+j;
				var b="nopc_"+j;
				var c="domcs_"+j;
				var d="lbls_"+j;
				var e="domce_"+j;
				var f="lble_"+j;
				var g="mpck_"+j;
				var h="nomp_"+j;
				var i="noofpacks_"+j;
				var det="dtail_"+j;
				//alert(det);
				document.getElementById(a).value="";
				document.getElementById(b).value="";
				/*document.getElementById(c).value="";
				document.getElementById(d).value="";
				document.getElementById(e).value="";
				document.getElementById(f).value="";
				document.getElementById(g).checked=false;*/
				document.getElementById(h).value="";
				document.getElementById(i).value="";
				document.getElementById(det).innerHTML="Attach";
				
				document.getElementById(a).disabled=true;
				document.getElementById(b).disabled=true;
				/*document.getElementById(c).disabled=true;
				document.getElementById(d).disabled=true;
				document.getElementById(e).disabled=true;
				document.getElementById(f).disabled=true;
				document.getElementById(g).disabled=true;*/
				document.getElementById(h).disabled=true;
				document.getElementById(i).disabled=true;
			}
			
			var a="packqty_"+snoval;
			var b="nopc_"+snoval;
			var c="domcs_"+snoval;
			var d="lbls_"+snoval;
			var e="domce_"+snoval;
			var f="lble_"+snoval;
			var g="mpck_"+snoval;
			var h="nomp_"+snoval;
			var i="noofpacks_"+snoval;
			var det2="dtail_"+snoval;
			document.getElementById(a).disabled=false;
			document.getElementById(b).disabled=false;
			/*document.getElementById(c).disabled=false;
			document.getElementById(d).disabled=false;
			document.getElementById(e).disabled=false;
			document.getElementById(f).disabled=false;*/
			document.getElementById(g).disabled=false;
			document.getElementById(h).disabled=false;
			//document.getElementById(i).disabled=false;
			//document.getElementById(det2).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Attach</a>";
			document.getElementById(det2).innerHTML="Attach";
			//alert(document.getElementById('pcktype').value);
			//if(document.getElementById('pcktype').value=="E")
			{
				document.getElementById(a).value=document.getElementById('balpck').value;
				var wtnop="wtnopkg_"+snoval;
				var z="nopc_"+snoval;
				var zx=(parseFloat(document.getElementById(a).value)/parseFloat(document.getElementById(wtnop).value));
				
				var xc=parseFloat(parseFloat(document.getElementById(wtnop).value)*parseInt(zx));
				//alert(xc); alert(document.getElementById(a).value);
				document.getElementById(z).value=parseInt(zx);
				if(parseFloat(xc)!=parseFloat(document.getElementById(a).value))
				{
					alert("Qty in NoP is not matching with Qty for Packing");
					document.getElementById(z).value="";
					return false;
				}
				document.getElementById(a).disabled=true;
			}
		}
	}
}

function detailspop(dval2)
{
//alert(dval2);
	var sno=document.frmaddDepartment.sno.value;
	var dval=0;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		if(document.getElementById(fet).checked==true)
		dval=i;
	}
	if(dval>0)
	{
		pform();
		/*var tx="lble_"+dval;
		if(document.getElementById(tx).value=="")
		{
			alert("Please enter Label number");
			document.getElementById(tx).focus();
			return false;
		}
		else
		{*/
		
		// Barcode code
		
		
		
			/*var mpck="mpck_"+dval;
			var nomp="nomp_"+dval;
			if(document.getElementById(mpck).checked==true)
			{
				var totnomp=document.getElementById(nomp).value;
				var tid=document.frmaddDepartment.maintrid.value;
				var subtid=document.frmaddDepartment.subtrid.value;
				var lotno=document.frmaddDepartment.txtplotno.value;
				var txtpsrn=document.frmaddDepartment.txtpsrn.value;
				//alert(variety);
				if(dval2=="edit")
				{ 
					winHandle=window.open('getuser_pronpslip_barcode3_new.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
					if(winHandle==null){
					alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
				}
				else
				{
					if(document.frmaddDepartment.detmpbno.value!="" && document.frmaddDepartment.detmpbno.value > 0)
					{
						winHandle=window.open('getuser_pronpslip_barcode3_new.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
						if(winHandle==null){
						alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
					}
					else
					{
						winHandle=window.open('getuser_pronpslip_barcode_sel.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
						if(winHandle==null){
						alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
					}
				}
			}*/
		//}
	}
}

function wh(wh1val, whno)
{ 	//alert(wh1val);
	//alert(whno);
	/*if(whno==1)
	{
		var z=0; var xs=0;
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="nopc_"+i;
			if(document.getElementById(fet).value=="")
			{z++;}
			else
			{xs=i;}
		}
		
		if(z==sno)
		{
			alert("Please select UPS");
			return false;
		}
		if(xs!=0)
		{ //alert(xs);
			var fet="nomp_"+xs;
			//alert(document.getElementById(fet).value);
			//alert(document.frmaddDepartment.detmpbno.value);
			if(document.getElementById(fet).value!="")
			{
				if(document.getElementById(fet).value!=document.frmaddDepartment.detmpbno.value)
				{
					alert("Barcode Labels are not matching with No. of Master Pack");
					return false;
				}
			}
		}
	}
	else
	{
		var whn=whno-1;
		var tqty="noptqtys_"+whn;
		var tqty1="txtwhg"+whno;
		if(document.getElementById(tqty).value=="")
		{
			alert("Please enter Master Pack/Pouches details in previous Bin");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			return false;
		}
	}*/
	var bin1 = 'bin'+whno;
	//alert(bin1);
	showUser(wh1val,bin1,'wh',whno,'','','','');
	//var bin="bingn"+whno;
	//showUser(wh1val,bin,'wh',bin,whno,'','','');
}

function bin(bin2val, binno)
{
	var whc="txtwhg_"+binno;
	var sbin="subbin"+binno;
	var binc="vbin_"+binno;
	if(document.getElementById(whc).value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		var subbin = 'subbin'+binno;
		//alert(subbin);
		showUser(bin2val,subbin,'bin',binno,'','','','');
		//showUser(bin2val,sbin,'binnew',binc,binno,'','','');
	}
}

function subbin(subbin2val, subbinno)
{	
	var binc="vbin_"+subbinno;
	if(document.getElementById(binc).value=="")
	{	
		alert("Please select Bin");
		return false;
	}
	else
	{
		var itemv=document.frmaddDepartment.txtvariety.value;
		var slocnogood="Pack";
		var trid=document.frmaddDepartment.maintrid.value;
		var Bagsv1=document.frmaddDepartment.slnomp_1.value;
		var qtyv1=document.frmaddDepartment.slqt_1.value;
		var ssbin="slocr"+subbinno;
		var bins="txtsubbg"+subbinno;
		showUser(subbin2val,ssbin,'subbin',itemv,bins,slocnogood,Bagsv1,qtyv1,trid);
		//setTimeout(function() { sloccomment(subbinno); },800);
	}
}

function sloccomment(rval)
{
	//alert(rval);
	var mp="nopmpcs_"+rval;
	var p="noppchs_"+rval;
	var tp="noptpchs_"+rval;
	var tq="noptqtys_"+rval;
	var existview="existview"+rval;
	if(document.getElementById(existview).value=="")
	{
		setTimeout(function() { sloccomment(rval); },400);
	}
	else if(document.getElementById(existview).value=="Empty" || document.getElementById(existview).value=="Available")
	{
		if(document.frmaddDepartment.detmpbno.value!="" || document.frmaddDepartment.detmpbno.value > 0)
		{
			document.getElementById(mp).value="";
			document.getElementById(mp).readOnly=false;
			document.getElementById(mp).style.backgroundColor="#ffffff";
		}
		document.getElementById(p).value="";
		document.getElementById(p).readOnly=false;
		document.getElementById(p).style.backgroundColor="#ffffff";
		document.getElementById(tp).value="";
		document.getElementById(tq).value="";
	}
	else
	{
		document.getElementById(mp).value="";
		document.getElementById(mp).readOnly=true;
		document.getElementById(mp).style.backgroundColor="#cccccc";
		document.getElementById(p).value="";
		document.getElementById(p).readOnly=true;
		document.getElementById(p).style.backgroundColor="#cccccc";
		document.getElementById(tp).value="";
		document.getElementById(tq).value="";
		alert("Please select different Sub Bin");
		return false;
	}
}
function pacsbinchk(mpval, mpno)
{
	if(document.getElementById('txtsubbg'+[mpno]).value=="")
	{
		alert("Please Select Subbin first");
		return false;
	}
	else
	{
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval);
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
			}
		}
		if(document.getElementById('noppchs_'+[mpno]).value!="")
		{
		document.getElementById('noptpchs_'+[mpno]).value=parseInt(d)+parseInt(document.getElementById('noppchs_'+[mpno]).value);
		document.getElementById('noptqtys_'+[mpno]).value=(parseFloat(npwt)*parseFloat(document.getElementById('noppchs_'+[mpno]).value))+(parseFloat(mpval)*parseFloat(dd));
		document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
		else
		{
		document.getElementById('noptpchs_'+[mpno]).value=parseInt(d);
		document.getElementById('noptqtys_'+[mpno]).value=parseFloat(mpval)*parseFloat(dd);
		document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
	}
}

function pacpchchk(pchval, pchno)
{
	if(document.getElementById('txtsubbg'+[pchno]).value=="")
	{
		alert("Please Select Subbin first");
		return false;
	}
	else
	{
		var sno=document.frmaddDepartment.sno.value;
		var mpval=document.getElementById('nopmpcs_'+[pchno]).value;
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval);
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
			}
		}
		if(mpval!="")
		{
		document.getElementById('noptpchs_'+[pchno]).value=parseInt(d)+parseInt(pchval);
		document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(npwt)*parseFloat(pchval))+(parseFloat(mpval)*parseFloat(dd));
		document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
		else
		{
		document.getElementById('noptpchs_'+[pchno]).value=parseInt(pchval);
		document.getElementById('noptqtys_'+[pchno]).value=parseFloat(npwt)*parseFloat(pchval);
		document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
		document.frmaddDepartment.linkpch.value=parseInt(document.frmaddDepartment.linkpch.value)+parseInt(pchval);
		
		document.frmaddDepartment.bpch.value=parseInt(document.frmaddDepartment.extbpch.value)-parseInt(document.frmaddDepartment.linkpch.value);
	}
}
function openpackdetails(subtid,tid)
{
winHandle=window.open('packdetails_pnpslip_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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

function dateDiff(dateEarlier, dateLater) 
{
	var x=dateEarlier.split("-");
	var y=dateLater.split("-");
	dateEarlier=new Date(x[2],x[1]-1,x[0]);
	dateLater=new Date(y[2],y[1]-1,y[0]);
	var one_day=1000*60*60*24
    return (  Math.round((dateLater.getTime()-dateEarlier.getTime())/one_day)  );
}


function chkvalidity(valval)
{
	/*if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Enter Processing Loss");
		document.frmaddDepartment.txtconpl.focus();
		return false;
	}
	else*/
	{
	if(valval!="")
	{
		dt1=getDateObject(document.frmaddDepartment.date.value,"-");
		dt2=getDateObject(document.frmaddDepartment.dp1.value,"-");
		dt3=getDateObject(document.frmaddDepartment.dp2.value,"-");
		dt4=getDateObject(document.frmaddDepartment.dp3.value,"-");
		dt5=getDateObject(document.frmaddDepartment.dp4.value,"-");
		dt6=getDateObject(document.frmaddDepartment.dp5.value,"-");
		dt7=getDateObject(document.frmaddDepartment.dp6.value,"-");
		if(document.frmaddDepartment.qcdtyp.value=="DoT")
		{
			if(valval==3)
			{
				if(dt2 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp1.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp1.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt3 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp2.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp2.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt4 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp3.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp3.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
		}
		else if(document.frmaddDepartment.qcdtyp.value=="DoSF")
		{
			if(valval==3)
			{
				if(dt5 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp4.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp4.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt6 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp5.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp5.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt7 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp6.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp6.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
		}
		else
		{
			document.frmaddDepartment.validityupto.value="";
			document.frmaddDepartment.valdays.value="";
		}
	}
	else
	{
		document.frmaddDepartment.validityupto.value="";
		document.frmaddDepartment.valdays.value="";
	}
	}
}

function openprintsubbin(subid, bid, wid, lid)
{
var itm="";
var tp="";
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}


function packagingdetails(lotno, ups)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	winHandle=window.open('lotpackaging_details.php?lotno='+lotno+'&ups='+ups+'&crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocsyn(tval)
{
	if(document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0)
	{
		alert("Please attach Barcodes First");
		return false;
	}
	else
	{
		document.frmaddDepartment.slocssyncs24.value=tval;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var lotno=document.frmaddDepartment.txtplotno.value;
		var txtpsrn=document.frmaddDepartment.txtpsrn.value;
		var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
		var ups=document.frmaddDepartment.upsidno.value;
		var sno=document.frmaddDepartment.sno.value;
		var bpch=0;
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var noofpacks="noofpacks_"+i;
				bpch=document.getElementById(noofpacks).value;
			}
		}
		//alert(slocssyncs);
		showUser(lotno,'slocsync','slocsyncshow',txtpsrn,crop,variety,slocssyncs,ups,bpch);
		//alert("HI");
		/*winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }*/
	}
}
function bcsyncchk()
{
	if(document.frmaddDepartment.mobar.value!="" || document.frmaddDepartment.mobar.value > 0) 
	{
		document.getElementById("slsync").innerHTML="";
		var v1="synchn";
		var mobar=document.frmaddDepartment.mobar.value;
		showUser(v1,'slsync','slsynchk',mobar,'','','','');
	}
	else
	{
		document.getElementById("slsync").innerHTML="";
		var v1="nosynchn";
		var mobar=document.frmaddDepartment.mobar.value;
		showUser(v1,'slsync','slsynchk',mobar,'','','','');
	}
}
function showbarc(barcval)
{
	winHandle=window.open('lot_barcodes.php?barcval='+barcval,'WelCome','top=170,left=180,width=200,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function balbclink(barcval)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	var lotno=document.frmaddDepartment.txtplotno.value;
	var txtpsrn=document.frmaddDepartment.txtpsrn.value;
	var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
	
	winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&barcval='+barcval+'&slocssyncs='+slocssyncs,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function sprintf () {
  // From: http://phpjs.org/functions
  // +   original by: Ash Searle (http://hexmen.com/blog/)
  // + namespaced by: Michael White (http://getsprink.com)
  // +    tweaked by: Jack
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Paulo Freitas
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Dj
  // +   improved by: Allidylls
  // *     example 1: sprintf("%01.2f", 123.1);
  // *     returns 1: 123.10
  // *     example 2: sprintf("[%10s]", 'monkey');
  // *     returns 2: '[    monkey]'
  // *     example 3: sprintf("[%'#10s]", 'monkey');
  // *     returns 3: '[####monkey]'
  // *     example 4: sprintf("%d", 123456789012345);
  // *     returns 4: '123456789012345'
  
  var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g;
  var a = arguments,
    i = 0,
    format = a[i++];

  // pad()
  var pad = function (str, len, chr, leftJustify) {
    if (!chr) {
      chr = ' ';
    }
    var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
    return leftJustify ? str + padding : padding + str;
  };

  // justify()
  var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
    var diff = minWidth - value.length;
    if (diff > 0) {
      if (leftJustify || !zeroPad) {
        value = pad(value, minWidth, customPadChar, leftJustify);
      } else {
        value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
      }
    }
    return value;
  };

  // formatBaseX()
  var formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
    // Note: casts negative numbers to positive ones
    var number = value >>> 0;
    prefix = prefix && number && {
      '2': '0b',
      '8': '0',
      '16': '0x'
    }[base] || '';
    value = prefix + pad(number.toString(base), precision || 0, '0', false);
    return justify(value, prefix, leftJustify, minWidth, zeroPad);
  };

  // formatString()
  var formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
    if (precision != null) {
      value = value.slice(0, precision);
    }
    return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
  };

  // doFormat()
  var doFormat = function (substring, valueIndex, flags, minWidth, _, precision, type) {
    var number;
    var prefix;
    var method;
    var textTransform;
    var value;

    if (substring === '%%') {
      return '%';
    }

    // parse flags
    var leftJustify = false,
      positivePrefix = '',
      zeroPad = false,
      prefixBaseX = false,
      customPadChar = ' ';
    var flagsl = flags.length;
    for (var j = 0; flags && j < flagsl; j++) {
      switch (flags.charAt(j)) {
      case ' ':
        positivePrefix = ' ';
        break;
      case '+':
        positivePrefix = '+';
        break;
      case '-':
        leftJustify = true;
        break;
      case "'":
        customPadChar = flags.charAt(j + 1);
        break;
      case '0':
        zeroPad = true;
        break;
      case '#':
        prefixBaseX = true;
        break;
      }
    }

    // parameters may be null, undefined, empty-string or real valued
    // we want to ignore null, undefined and empty-string values
    if (!minWidth) {
      minWidth = 0;
    } else if (minWidth === '*') {
      minWidth = +a[i++];
    } else if (minWidth.charAt(0) == '*') {
      minWidth = +a[minWidth.slice(1, -1)];
    } else {
      minWidth = +minWidth;
    }

    // Note: undocumented perl feature:
    if (minWidth < 0) {
      minWidth = -minWidth;
      leftJustify = true;
    }

    if (!isFinite(minWidth)) {
      throw new Error('sprintf: (minimum-)width must be finite');
    }

    if (!precision) {
      precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined;
    } else if (precision === '*') {
      precision = +a[i++];
    } else if (precision.charAt(0) == '*') {
      precision = +a[precision.slice(1, -1)];
    } else {
      precision = +precision;
    }

    // grab value using valueIndex if required?
    value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

    switch (type) {
    case 's':
      return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
    case 'c':
      return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
    case 'b':
      return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'o':
      return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'x':
      return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'X':
      return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
    case 'u':
      return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'i':
    case 'd':
      number = +value || 0;
      number = Math.round(number - number % 1); // Plain Math.round doesn't just truncate
      prefix = number < 0 ? '-' : positivePrefix;
      value = prefix + pad(String(Math.abs(number)), precision, '0', false);
      return justify(value, prefix, leftJustify, minWidth, zeroPad);
    case 'e':
    case 'E':
    case 'f': // Should handle locales (as per setlocale)
    case 'F':
    case 'g':
    case 'G':
      number = +value;
      prefix = number < 0 ? '-' : positivePrefix;
      method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
      textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
      value = prefix + Math.abs(number)[method](precision);
      return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
    default:
      return substring;
    }
  };

  return format.replace(regex, doFormat);
}

function qctpchk(qtval)
{
	document.frmaddDepartment.qcdttype.value=qtval;
	document.frmaddDepartment.validityupto.value="";
	document.frmaddDepartment.valdays.value="";
	document.frmaddDepartment.validityperiod.value="";
	document.frmaddDepartment.validityperiod.selectedIndex=0;
	
	if(qtval=="")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot1.value;
	else if(qtval=="")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot2.value;
	else
		document.frmaddDepartment.qctestdate.value="";
}

function poucheschk(pchval,sno)
{
	var balnop=parseInt(document.getElementById('nomp_'+[sno]).value)*parseInt(document.getElementById('wtnop_'+[sno]).value);
	//alert(balnop); alert(pchval);
	document.getElementById('noofpacks_'+[sno]).value=parseInt(document.getElementById('nopc_'+[sno]).value)-parseInt(balnop)-parseInt(pchval);
	document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[sno]).value;
	document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[sno]).value;
	document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[sno]).value;
}



function chkmlt(mltval, mltno)
{
	//alert(mltval);alert(mltno);
	var f=0;
	
	mltval=mltval.toUpperCase();
	var sno=document.frmaddDepartment.sno.value;
	document.getElementById('m'+[mltno]).value=mltval;
	if(parseInt(document.getElementById('lodednomp_'+[sno]).value)>=parseInt(document.getElementById('nomp_'+[sno]).value))
	{
		alert("Cannot upload Barcodes more than Max No. of MP. Total numbers of Barcodes has been uploaded.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.wtmaccode.value=="")
	{
		alert("Please select Weighing Machine");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.wtrangefr.value=="" || document.frmaddDepartment.wtrangeto.value=="")
	{
		alert("Invalid Gross Weight Range. Please enter Gross Weight Range");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.lbls_1.value=="")
	{
		alert("Invalid Label No. 1. Please enter Label No. 1");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.vsubbin_1.value=="")
	{
		alert("Please select SLOC");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else
	{
		/*var mltn=mltno-1;
		var mmll=mltno+1;
		if(mltno>=2)
		{
			if(document.getElementById('w'+[mltn]).value=="")
			{
				alert("Please enter Weight in "+mltn);
				document.getElementById('m'+[mltno]).value="";
				document.getElementById('m'+[mltn]).value="";
				document.getElementById('m'+[mltn]).focus();
				f=1;
				return false;
			}
		}*/
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode1");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode2");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode3");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.weight.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
		}
		//mltn++;
		//var m='m'+mltn;
		//var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		//var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		/*for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
			f=1;
			return false;
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
			f=1;
			return false;
		}*/
		if(f==0)
		{
			//document.frmaddDepartment.barcode.disabled=true;
			chkbardup(mltval,mltno);
		}
		else
		{
			return false;
		}
	}
}

function enterbar(mltval,mltno)
{
	var a=formPost(document.getElementById('mainform'));
	var barcvaldchk="barcvaldchk"+mltno;
	if(document.frmaddDepartment.barcvaldchk.value=="ok")
	{
		callwtfile(mltno);
		var txtbarws="w"+(mltno);
		if(document.frmaddDepartment.weight.value=="")
		setTimeout(function(){callwtfile(mltno);}, 200);
	}
	else
	{
		if(document.frmaddDepartment.barcvaldchk.value=="fail")
		{
			alert("Invalid Barcode/Duplicate barcode. Please Scan Barcode again");
			document.frmaddDepartment.barcode.value="";
			var a=formPost(document.getElementById('mainform'));
			showUser(a,'postingtable','barcemtyform','','','','','');
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			return false;
		}
		if(document.frmaddDepartment.barcvaldchk.value=="")
		{
			//chkbardup(mltval,mltno);
			setTimeout(function(){chkbardup(mltval,mltno);}, 1000);
		}
	}
}

function chkbardup(mltval,mltno)
{
	var a=formPost(document.getElementById('mainform'));
	var barcvaldchk="barcvaldchk"+mltno;
	var wtbar="wtbar"+mltno;
	showUser(mltval,wtbar,'brchchk',mltno,'','','','','','','');
	setTimeout(function(){
	if(document.frmaddDepartment.barcvaldchk.value=="")
	{
		setTimeout(chkbardup(mltval,mltno), 200);
		//setTimeout(function(){showUser(mltval,wtbar,'brchchk',mltno,'','','','','','','');}, 1000);
	}
	else //if(document.getElementById(barcvaldchk).value!="")
	{
		//setTimeout(chkbardup(mltval,mltno), 500);
		enterbar(mltval,mltno);
	}}, 200);
}

function callwtfile(mltno)
{
	var ct=1;
	var a=formPost(document.getElementById('mainform'));
	var bardet="wtpdn"+mltno;
	var bardet1="wtws"+mltno;
	var bardet3="wtwsdelete"+mltno;
	var vname=document.frmaddDepartment.wtmaccode.value;
	var minwt=document.frmaddDepartment.wtrangefr.value;
	var maxwt=document.frmaddDepartment.wtrangeto.value;
	showUser(vname,bardet1,'bcwtpd',mltno,minwt,maxwt,'','','','','');
	
	setTimeout(function(){
		var txtbarws="w"+(mltno);
		if(document.frmaddDepartment.barcode.value!='' && document.frmaddDepartment.weight.value=="")
		{
			setTimeout(function(){showUser(vname,bardet1,'bcwtpd',mltno,minwt,maxwt,'','','','','');}, 200);
			ct++;
		}
		
		if(document.frmaddDepartment.weight.value!="")
		{ct=0;
			if(document.frmaddDepartment.weight.value=="" || parseFloat(document.frmaddDepartment.weight.value)<=0)
			{
				alert("Invalid Weight. \n\nReasons:\n\n1. Barcode Already Present in system.\n\n2. Either Gross Weight not in Range.\n\n3. Weight file not generated.\n\n4. Wrong File name.");
				document.frmaddDepartment.barcode.value="";
				var a=formPost(document.getElementById('mainform'));
				showUser(a,'postingtable','barcemtyform','','','','','');
				document.frmaddDepartment.weight.value="";
				document.frmaddDepartment.barcode.focus();
				
				return false;
			}
			else
			{
				var txtbarws="w"+(mltno);
				var bardet3="wtwsdelete"+mltno;
				var txtbarws="w"+(mltno);
				var vname=document.frmaddDepartment.wtmaccode.value;
				var minwt=document.frmaddDepartment.wtrangefr.value;
				var maxwt=document.frmaddDepartment.wtrangeto.value;
				if(parseFloat(document.frmaddDepartment.weight.value)<=0 || (parseFloat(document.frmaddDepartment.weight.value)<parseFloat(document.frmaddDepartment.wtrangefr.value) || parseFloat(document.frmaddDepartment.weight.value)>parseFloat(document.frmaddDepartment.wtrangeto.value)))
				{
					alert("Invalid Weight. \n\nReasons:\n\n1. Barcode Already Present in system.\n\n2. Either Gross Weight not in Range.\n\n3. Weight file not generated.\n\n4. Wrong File name.");
					document.frmaddDepartment.barcode.value="";
					var a=formPost(document.getElementById('mainform'));
					showUser(a,'postingtable','barcemtyform','','','','','');
					document.frmaddDepartment.weight.value="";
					document.frmaddDepartment.barcode.focus();
					
					return false;
				}
				else
				{
					barcodepform(mltno);
				}
				//setTimeout(callwtfile(mltno), 1000);
				//setTimeout(function(){showUser(vname,bardet3,'bcwtpdelete',mltno,minwt,maxwt,'','','','','');}, 500);
			}
		}
		else
		{
			if(document.frmaddDepartment.barcode.value!='' && document.frmaddDepartment.weight.value=="")
			setTimeout(function(){callwtfile(mltno);}, 200);
		}
	}, 200);
}

function chkmlt1(mltval, mltno)
{
	/*if(document.getElementById('m'+[mltno]).value=="")
	{
		alert("Please enter Barcode first.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		return false;
	}*/
}

function barcodepform(mltno)
{
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dobg.value,"-");
	var a=formPost(document.getElementById('mainform'));
	/*if(dt2 > dt1)
	{
		alert("Date of Weighing cannot be more than Todays Date.");
		f=1;
		return false;
	}*/
	if(document.frmaddDepartment.operatorcode.value=="")
	{
		alert("Please select Weighing Machine Operator.");
		document.frmaddDepartment.operatorcode.focus();
		f=1;
		//return false;
	}	
	else if(document.frmaddDepartment.wtmaccode.value=="")
	{
		alert("Please Select Weighing Machine.");
		document.frmaddDepartment.wtmaccode.focus();
		f=1;
		//return false;
	}		
	else if(document.frmaddDepartment.wtrangefr.value=="")
	{
		alert("Please enter Gross Weight Range starts From.");
		document.frmaddDepartment.wtrangefr.focus();
		f=1;
		//return false;
	}		
	else if(document.frmaddDepartment.wtrangeto.value=="")
	{
		alert("Please enter Gross Weight Range up to");
		document.frmaddDepartment.wtrangeto.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.barcode.value=="")
	{
		alert("Please enter Barcode");
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.barcode.value.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.barcvaldchk.value!="" && document.frmaddDepartment.barcvaldchk.value=="fail")
	{
		alert("Invalid Barcode/Duplicate barcode. Please Scan Barcode again");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.weight.value=="")
	{
		alert("Gross weight cannot be blank");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.weight.value!="")
	{
		if(parseFloat(document.frmaddDepartment.weight.value)<=0 || (parseFloat(document.frmaddDepartment.weight.value)<parseFloat(document.frmaddDepartment.wtrangefr.value) || parseFloat(document.frmaddDepartment.weight.value)>parseFloat(document.frmaddDepartment.wtrangeto.value)))
		{
			alert("Invalid Weight. \n\nReasons:\n\n1. Barcode Already Present in system.\n\n2. Either Gross Weight not in Range.\n\n3. Weight file not generated.\n\n4. Wrong File name.");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			//return false;
		}
	}
	if(f==1)
	{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','barcemtyform','','','','','');
		//return false;
	}
	else
	{
		var lbcdwt=0; var ft=0;
		if(document.frmaddDepartment.weight.value!='' && document.frmaddDepartment.lastbarcodewt.value!='' && parseFloat(document.frmaddDepartment.weight.value)==parseFloat(document.frmaddDepartment.lastbarcodewt.value))
		{
			lbcdwt=1;
		}
		if(lbcdwt>0)
		{
			if(confirm("Previous Barcode Weight "+document.frmaddDepartment.lastbarcodewt.value+" and current Barcode Weight "+document.frmaddDepartment.weight.value+" is Same. Do you want proceed?")==false)
			{
				var vname=document.frmaddDepartment.wtmaccode.value;
				var minwt=document.frmaddDepartment.wtrangefr.value;
				var maxwt=document.frmaddDepartment.wtrangeto.value;
				showUser(vname,bardet3,'bcwtpdelete',mltno,minwt,maxwt,'','','','','');
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.weight.value="";
				document.frmaddDepartment.lastbarcodewt.value="";
				document.frmaddDepartment.barcode.focus();
				ft=1;
				//return false;
				var a=formPost(document.getElementById('mainform'));
				showUser(a,'postingtable','barcemtyform','','','','','');
			}
		}
		if(ft==1)
		{
			return false;
		}
		else
		{
		
			var txtbarws="w"+(mltno);
			var bardet3="wtwsdelete"+mltno;
			var txtbarws="w"+(mltno);
			var vname=document.frmaddDepartment.wtmaccode.value;
			var minwt=document.frmaddDepartment.wtrangefr.value;
			var maxwt=document.frmaddDepartment.wtrangeto.value;
			var a=formPost(document.getElementById('mainform'));
			showUser(a,'postingtable','barcform','','','','','');
			//alert(a);
			
			////showUser(a,'postingsubtable','mform','','','','','');
			//setTimeout(function(){document.frmaddDepartment.barcode.focus();}, 200);
			setTimeout(function(){showUser(vname,bardet3,'bcwtpdelete',mltno,minwt,maxwt,'','','','','');}, 200);
			setTimeout(function(){
			document.frmaddDepartment.barcode.focus();
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			}, 400);
		}
	}    
}
function mycancel()
{
	if(confirm('Do You wish to Cancel this Transaction?')==true)
	{
		document.frmaddDepartment.btntypval.value=1;
		document.frmaddDepartment.submit();	
	}
	else
	{
		return false;
	}
}

function nxtpform()
{
	return false;
}

function chkwtfileval(mltno)
{
	document.getElementById('w'+[mltno]).value="";
	document.getElementById('m'+[mltno]).value="";
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
function openbarcodedetails(subtid,tid)
{
winHandle=window.open('barcodedetails_pnpslip_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
</script>

<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Online Processing and Packing slip&nbsp;<input type="hidden" name="logid" value="<?php echo $logid?>" /></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
		 
		</br>
<?php  

 $tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

	$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['pnpslipmain_dop'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
$subtid=0;
?>	
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Edit Online Processing and Packing Slip </td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Processing &amp; Packing&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="157" align="right"  valign="middle" class="smalltblheading">Packing Slip Ref. No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['pnpslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="152" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="166" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="107" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" /> &nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where plantcode='$plantcode' and promac_id='".$row_tbl['pnpslipmain_promachcode']."' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and proopr_id='".$row_tbl['pnpslipmain_proopr']."'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtpromech" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtoprname" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txttreattyp" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
	</tr>

</table>
<br />
 <?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="17" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="101" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	 <!--<td width="10%" align="center" valign="middle" class="smalltblheading" colspan="2">Raw Seed </td>-->
	 <td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="60" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
	 <td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
	 <td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed </td>
     <td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>

	 	 <td align="center" valign="middle" class="smalltblheading"  rowspan="2">IM </td>
<td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
<td align="center" valign="middle" class="smalltblheading"  colspan="2">Total C. Loss</td>
		  <!--/*<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">QC Status </td>	 
		   <td width="12%" rowspan="3" align="center" valign="middle" class="smalltblheading">GOT Type </td>*/-->
    <td width="108" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">CSW SLOC</td>
	<td width="108" colspan="3" align="center" valign="middle" class="smalltblheading">Pack Details</td>
	<td width="55" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
    <td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
    <td width="39" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
  </tr>
   <tr class="tblsubtitle">
    
     <!--<td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="smalltblheading">%</td>-->
     <td width="45" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<!--<td width="4%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="2%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">%</td>-->
	    <td width="51" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="30" align="center" valign="middle" class="smalltblheading">%</td>
      <td width="54" align="center" valign="middle" class="smalltblheading">NoMP</td>
      <td width="54" align="center" valign="middle" class="smalltblheading">Barcodes</td>
      <td width="108" align="center" valign="middle" class="smalltblheading">Details</td>
  </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['pnpslipsubsub_subbin']."' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['pnpslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['pnpslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['pnpslipsubsub_bqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/
$tot_barcnomp=0;
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row_tbl_sub['pnpslipsub_plotno']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlper'];?></td>
	<td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nomp'];?><input type="hidden" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['pnpslipsub_nomp'];?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openbarcodedetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)"><?php echo $tot_barcnomp;?></a><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="30" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_tlper'];?></td>
	<td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nomp'];?><input type="hidden" name="totlotnomp<?php echo $srno;?>" id="totlotnomp_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['pnpslipsub_nomp'];?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openbarcodedetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)"><?php echo $tot_barcnomp;?></a><input type="hidden" name="totlotbar<?php echo $srno;?>" id="totlotbar_<?php echo $srno;?>" value="<?php echo $tot_barcnomp;?>" /></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
        <td width="30" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['pnpslipsub_id'];?>);" /></td>
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
<!--<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>-->
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"> </div>
</div></div>

<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_pronpslip.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return mycancel();" />&nbsp;&nbsp;<img src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();"  />&nbsp;&nbsp;<input type="hidden" name="btntypval" value="0" /> </td>
</tr>
</table>


</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
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

  
