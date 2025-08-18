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
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
	if(isset($_REQUEST['cropid']))
	{
	$pid = $_REQUEST['cropid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	
		$p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$txtcla=trim($_POST['txtlot']);
		$txtdcno=trim($_POST['txtdcno']);
		$txt11=trim($_POST['txt11']);
		$txtstfp=trim($_POST['txtstfp']);
		$txtsttp=trim($_POST['txtsttp']);
		$txtlot=trim($_POST['txtlot']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$sstage=trim($_POST['sstage']);
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
		
		echo "<script>window.location='add_arrival_stock_preview.php?cropid=$p_id&remarks=$remarks&txtlot=$txtlot&sstage=$sstage&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&txtstfp=$txtstfp&txtcrop=$txtcrop&txtvariety=$txtvariety&txtsttp=$txtsttp&txtdcno=$txtdcno'</script>";	
			
	}

/*//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(trcode) FROM tblstock  ORDER BY trcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$ycode."/".$lgnid;
		}
		//}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$ycode."/".$lgnid;
		}*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Stock Transfer Arrival - Edit</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" /></head>

<script src="stockaddresschk.js"></script>
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

function pform()
{	
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	fl=1;
	return false;
	}
	if(document.frmaddDepartment.txtlot.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value) >= parseInt(document.frmaddDepartment.txtlot.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		//document.frmaddDepartment.txtlot.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		fl=1;
		return false;
	}
if(document.frmaddDepartment.sstage.value=="")
	{
		alert("Please Enter Stage.");
		document.frmaddDepartment.sstage.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.sstage.value.charCodeAt() == 32)
	{
		alert("Stage cannot start with space.");
		document.frmaddDepartment.sstage.focus();
		fl=1;
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
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please enter Vehicle No");
			document.frmaddDepartment.txtvn.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
			{
			alert("Vehicle No cannot start with space.");
			document.frmaddDepartment.txtvn.focus();
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txt14.value=="")
			{
			alert("Please select Payment Mode");
			fl=1;
			return false;
			}
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
			alert("Please enter Courier Name");
			document.frmaddDepartment.txtcname.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDepartment.txtcname.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value=="")
			{
			alert("Please enter Docket No.");
			document.frmaddDepartment.txtdc.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
			{
			alert("Docket No. cannot start with space.");
			document.frmaddDepartment.txtdc.focus();
			fl=1;
			return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
			alert("Please enter Person Name");
			document.frmaddDepartment.txtpname.focus();
			fl=1;
			return false;
			}	
		}
	}
	else
	{
		alert("Please select Mode of Transit");
		fl=1;
		return false;
	}
	
	if(document.frmaddDepartment.txtlot.value=="")
	{
		alert("Please Enter  No. of Lots ");
		document.frmaddDepartment.txtlot.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot.value.charCodeAt() == 32)
	{
		alert(" No. of Lots cannot start with space.");
		document.frmaddDepartment.txtlot.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Stock Transfer from");
		document.frmaddDepartment.txtstfp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtlotp.value=="")
	{
		alert("Please Enter Lot No.");
		document.frmaddDepartment.txtlotp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.sstage.value=="Pack Seed")
	{
		if(document.frmaddDepartment.sn.value > 0)
		{
			var sn=document.frmaddDepartment.sn.value;
			var qt=0;
			var cnt=1;
			var q=0;
			while(cnt<=sn)
			{
				if(document.getElementById("txtp_"+cnt).value=="")
				{
					q++;
				}
				cnt++;
			}
			alert(q); alert(sn);
			if(q == sn)
			{
				alert("Please enter Number of Packs in respective Pack size");
				fl=1;
				return false;
			}
		}
		else
		{
			alert("Pack Size not defined for this Variety. Please contact Administrator to Add the Pack Size for this Variety");
			fl=1;
			return false;
		}
	}
	if(document.frmaddDepartment.txtrawp.value=="")
	{
		alert("Please enter Dispatch Total Raw");
		document.frmaddDepartment.txtrawp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdisp.value=="")
	{
		alert("Please enter Disptach  Total No. Of Qty");
		document.frmaddDepartment.txtdisp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtqtystat.value=="")
	{
		alert("Please select Quality Status");
		document.frmaddDepartment.txtqtystat.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.recqtyp.value=="")
	{
		alert("Please enter  Received Qty");
		document.frmaddDepartment.recqtyp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtrecbagp.value=="")
	{
		alert("Please enter Received No. Of Bags");
		document.frmaddDepartment.txtrecbagp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtgermi.value=="")
	{
		alert("Please enter Germination");
		document.frmaddDepartment.txtgermi.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtmoist.value=="" || document.frmaddDepartment.txtmoist.value<=0)
	{
		alert("Please enter Moisture %");
		document.frmaddDepartment.txtmoist.focus();
		fl=1;
		return false;
	}
	if(fl==1)
	{
	return false;
	}
	else
	{	//alert("hi");
		
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
		//alert(a);
		//document.frmaddDepartment.bbbb.value=a
		showUser(a,'postingtable','mform','','','','','');
		}  
	}
}

function pformedtup()
{	
  	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	fl=1;
	return false;
	}
	/*if(document.frmaddDepartment.txtlot.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value) >= parseInt(document.frmaddDepartment.txtlot.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		//document.frmaddDepartment.txtlot.focus();
		fl=1;
		return false;
	}*/
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		fl=1;
		return false;
	}
if(document.frmaddDepartment.sstage.value=="")
	{
		alert("Please Enter Stage.");
		document.frmaddDepartment.sstage.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.sstage.value.charCodeAt() == 32)
	{
		alert("Stage cannot start with space.");
		document.frmaddDepartment.sstage.focus();
		fl=1;
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
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			fl=1;
			return false;
			}

			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please enter Vehicle No");
			document.frmaddDepartment.txtvn.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
			{
			alert("Vehicle No cannot start with space.");
			document.frmaddDepartment.txtvn.focus();
			fl=1;
			return false;
			}
			if(document.frmaddDepartment.txt14.value=="")
			{
			alert("Please select Payment Mode");
			fl=1;
			return false;
			}
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
			alert("Please enter Courier Name");
			document.frmaddDepartment.txtcname.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDepartment.txtcname.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value=="")
			{
			alert("Please enter Docket No.");
			document.frmaddDepartment.txtdc.focus();
			fl=1;
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
			{
			alert("Docket No. cannot start with space.");
			document.frmaddDepartment.txtdc.focus();
			fl=1;
			return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
			alert("Please enter Person Name");
			document.frmaddDepartment.txtpname.focus();
			fl=1;
			return false;
			}	
		}
	}
	else
	{
		alert("Please select Mode of Transit");
		fl=1;
		return false;
	}
	
	if(document.frmaddDepartment.txtlot.value=="")
	{
		alert("Please Enter  No. of Lots ");
		document.frmaddDepartment.txtlot.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot.value.charCodeAt() == 32)
	{
		alert(" No. of Lots cannot start with space.");
		document.frmaddDepartment.txtlot.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Stock Transfer from");
		document.frmaddDepartment.txtstfp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtlotp.value=="")
	{
		alert("Please Enter Lot No.");
		document.frmaddDepartment.txtlotp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.sstage.value=="Pack Seed")
	{
		if(document.frmaddDepartment.sn.value > 0)
		{
			var sn=document.frmaddDepartment.sn.value;
			var qt=0;
			var cnt=1;
			var q=0;
			while(cnt<=sn)
			{
				if(document.getElementById("txtp_"+cnt).value=="")
				{
					q++;
				}
				cnt++;
			}
			alert(q); alert(sn);
			if(q == sn)
			{
				alert("Please enter Number of Packs in respective Pack size");
				fl=1;
				return false;
			}
		}
		else
		{
			alert("Pack Size not defined for this Variety. Please contact Administrator to Add the Pack Size for this Variety");
			fl=1;
			return false;
		}
	}
	if(document.frmaddDepartment.txtrawp.value=="")
	{
		alert("Please enter Dispatch Total Raw");
		document.frmaddDepartment.txtrawp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdisp.value=="")
	{
		alert("Please enter Disptach  Total No. Of Qty");
		document.frmaddDepartment.txtdisp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtqtystat.value=="")
	{
		alert("Please select Quality Status");
		document.frmaddDepartment.txtqtystat.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.recqtyp.value=="")
	{
		alert("Please enter  Received Qty");
		document.frmaddDepartment.recqtyp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtrecbagp.value=="")
	{
		alert("Please enter Received No. Of Bags");
		document.frmaddDepartment.txtrecbagp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtgermi.value=="")
	{
		alert("Please enter Germination");
		document.frmaddDepartment.txtgermi.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtmoist.value=="" || document.frmaddDepartment.txtmoist.value<=0)
	{
		alert("Please enter Moisture %");
		document.frmaddDepartment.txtmoist.focus();
		fl=1;
		return false;
	}
	if(fl==1)
	{
	return false;
	}
	else
	{	//alert("hi");
		
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
		//alert(a);
		showUser(a,'postingtable','mformsubedt','','','','');
		}
	}
}

function clk(opt)
{
	if(document.frmaddDepartment.sstage.value!="")
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
	alert("Please enter Stage");
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

function Bagschk1(Bagsval1)
{
	document.frmaddDepartment.txtdbagp.value=parseFloat(document.frmaddDepartment.txtrawp.value)-parseFloat(Bagsval1);
}
function Bagschk(Bagsval1)
{
	document.frmaddDepartment.txtdisp.value=parseInt(Bagsval1)+parseInt(document.frmaddDepartment.recqtyp.value)-parseInt(document.frmaddDepartment.txtdqtyp.value);
}

function qtychk1(qtyval1)
{
		document.frmaddDepartment.txtdqtyp.value=parseFloat(document.frmaddDepartment.txtdisp.value)-parseFloat(qtyval1);
}

function showslocbins()
{
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
}

function classchk(itval)
{
if(document.frmaddDepartment.txtlotp.value=="")
	{
		alert("Please Fill ST Lot No. ");
		document.frmaddDepartment.txtqtystat.value="";
	}
	setTimeout('showslocbins()',200);
}
function itemcheck()
{
	if(document.frmaddDepartment.txtsttp.value=="")
	{
		alert("Please Fill Stock Transfer To Plant");
		document.frmaddDepartment.txtlotp.value="";
	}
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please Enter STN No.");
		document.frmaddDepartment.txtlotp.value="";
	}

	/*if(document.frmaddDepartment.txtlot.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		document.frmaddDepartment.txtlotp.value="";
		return false;
	}*/
}

function Bagsdcchk()
{
if(document.frmaddDepartment.txtqtystat.value=="")
	{
		alert("Please Select Quality Status");
		document.frmaddDepartment.txtqtystat.value="";
	}
	if(document.frmaddDepartment.txtrecbagp.value!="")
	{	
		document.frmaddDepartment.txtdbagp.value=parseFloat(document.frmaddDepartment.txtrawp.value)-parseFloat(document.frmaddDepartment.txtrecbagp.value);
	}
	
}


function Bagsdcchk1()
{
	if(document.frmaddDepartment.recqtyp.value!="")
	{	
		document.frmaddDepartment.txtdqtyp.value=parseFloat(document.frmaddDepartment.txtdisp.value)-parseFloat(document.frmaddDepartment.recqtyp.value);
	}
}

function recqty()
{
}

function Bagsdcchk2()
{
}

function modetchk(classval)
{	
			showUser(classval,'vitem','vitem','','','','','');
}

function variety()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety");
		document.frmaddDepartment.sstage.value="";
		document.frmaddDepartment.txtvariety.focus();

	}
	else
	{
	var variet=document.frmaddDepartment.txtvariety.value;
	var stage=document.frmaddDepartment.sstage.value;
	var crop=document.frmaddDepartment.txtcrop.value;
	showUser(stage,'postingsubtable','showpostform',crop,variet,'','','');
	
	}
}
function packqchk()
{
	if(document.frmaddDepartment.sn.value > 0)
	{
		var sn=document.frmaddDepartment.sn.value;
		var qt=0;
		var cnt=1;
		var q=0;
		while(cnt<=sn)
		{
			if(document.getElementById("txtp_"+cnt).value!="")
			{
				q=parseFloat(q)+(parseFloat(document.getElementById("txtp_"+cnt).value) * parseFloat(document.getElementById("txtqtinkgs_"+cnt).value));
				qt=parseFloat(qt)+(parseFloat(document.getElementById("txtp_"+cnt).value));
			}
			cnt++;
		}
		if(q > 0)
		{
		document.frmaddDepartment.recqtyp.value=q;
		document.frmaddDepartment.txtrecbagp.value=qt;
		}
		else
		{
		document.frmaddDepartment.recqtyp.value="";
		document.frmaddDepartment.txtrecbagp.value="";
		}
	}
	else
	{
	alert("Unit Pack Size hs not been defined");
	}
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

function wh1(wh1val)
{ 
if(document.frmaddDepartment.txtgermi.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	else
	{
		alert("Please enter Germination");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtgermi.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','','','','');
	}
	else
	{
		alert("Please enter Quantity Good");
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
		var slocnogood=document.frmaddDepartment.sstage.value;
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
		
		var slocnogood=document.frmaddDepartment.sstage.value;
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
		var exu=0;
		if(document.frmaddDepartment.exusp1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp1.value);
			document.frmaddDepartment.balBags1.value=parseInt(document.frmaddDepartment.txtslBagsg1.value)+parseInt(exu);
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
		if(document.frmaddDepartment.exqty1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty1.value);
		document.frmaddDepartment.balqty1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value)+parseFloat(exq);
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
		if(document.frmaddDepartment.exqty2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty2.value);
		document.frmaddDepartment.balqty2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value)+parseFloat(exq);
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


function mySubmit()
{ 
	if(document.frmaddDepartment.txtlot.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)!=parseInt(document.frmaddDepartment.txtlot.value)))
	{
		alert("Number of Lots & Number of Records  Posted Mismatch.");
		return false;
	}
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;	 
}

function nolchk(nolval)
{
	if(nolval <= 0 )
	{
	alert("Number of Lots cannot be Zero");
	document.frmaddDepartment.txtlot.value=="";
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
				//document.frmaddDepartment.txtqc1.value="Under Test";
				document.frmaddDepartment.gscheckbox.value=0;
			}
			else
			{ 
				document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgot.value+' Under Test';
				//document.getElementById('qcstatusid').style.display="none"
				//document.getElementById('qcstatusid1').style.display="block"
				//document.frmaddDepartment.txtqc1.value="Under Test";
				document.frmaddDepartment.gscheckbox.value=1;
			}
}
function openslocpop1()
{
if(document.frmaddDepartment.txtvisualck.value=="")
{
 alert("Please Select Visual check.");
 //document.frmaddDepartment.txtvisualck.focus();
}
else
{
var itm=document.frmaddDepartment.sstatus.value;
winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
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

function visuchk()
{


		if(document.frmaddDepartment.txtvisualck.value=="")
		{
			alert("Please Select visual Check");
			//document.frmaddDepartment.txtgot.SelectedIndex=0;
			return false;
		}
		/*if(document.frmaddDepartment.qc3.value=="Mandatory")
		{
			document.frmaddDepartment.gotstatus.value=gchk+' Under Test';
			//document.getElementById('qcstatusid').style.display="none"
			//document.getElementById('qcstatusid1').style.display="block"
			//document.frmaddDepartment.txtqc1.value="Under Test";
			document.frmaddDepartment.gscheckbox.value=1;
		}
		else
		{
			if(document.frmaddDepartment.qc1.checked==false)
			{ 
				document.frmaddDepartment.gotstatus.value=gchk+' NUT';
				//document.getElementById('qcstatusid').style.display="block"
				//document.getElementById('qcstatusid1').style.display="none"
				//document.frmaddDepartment.txtqc1.value="Under Test";
				document.frmaddDepartment.gscheckbox.value=0;
			}
			else
			{ 
				document.frmaddDepartment.qc1.value=gchk+' Under Test';
				//document.getElementById('qcstatusid').style.display="none"
				//document.getElementById('qcstatusid1').style.display="block"
				//document.frmaddDepartment.txtqc1.value="Under Test";
				document.frmaddDepartment.gscheckbox.value=1;
			}
		}*/
}
	
	function visuchk1()
{
		if(document.frmaddDepartment.txtgot.value=="")
		{
			alert("Please Select Got Type");
			//document.frmaddDepartment.txtvisualck.value="";
		}
		else
		{
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
		}

}	
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_order.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Arrival from StockTransfer </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $row_tbl['tmode'];?>" type="hidden"> 
	    <input name="txt14" value="<?php echo $row_tbl['trans_paymode'];?>" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arrival_code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Arrival From StockTransfer </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arrival_code']."/".$ycode."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date of Arival&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['lotcrop']."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
?>


<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" name="txtcrop1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['cropname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtcrop" value="<?php echo $noticia['cropid'];?>" /></td>
	  <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['lotvariety']."' and actstatus='Active' order by popularname Asc"); 
$noticia = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading">Variety &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3"  id="vitem" >&nbsp;<input type="text" name="txtvariety1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['popularname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtvariety" value="<?php echo $noticia['varietyid'];?>" /></td>
           </tr>

  <?php
	 
//$quer5=mysqli_query($link,"SELECT st_id , stage FROM tblstages where stage='".$row_tbl['lotvariety']."' order by stage Asc"); 
//	$row5=mysqli_fetch_array($quer5);
?>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" >&nbsp;<input type="text" name="sstage" readonly="true" style="background-color:#CCCCCC;"  size="32" value="<?php echo $row_tbl['sstage'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="6"><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Transport"){ echo "checked"; }?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Courier"){ echo "checked"; }?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="By Hand"){ echo "checked"; }?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="display:<?php if($row_tbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Light" height="30" bordercolor="#cc30cc">
<td align="right" width="206" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" value="<?php echo $row_tbl['trans_name'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="173" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="226" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex="" value="<?php echo $row_tbl['trans_lorryrepno'];?>"  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25" bordercolor="#cc30cc">
<td align="right" width="206" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['trans_vehno'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:100px;" onchange="clk1(this.value);"  > 
<option value="">--Select Mode--</option>
<option <?php if($row_tbl['trans_paymode']=="TBB"){ echo "Selected";} ?> value="TBB">TBB</option>
<option <?php if($row_tbl['trans_paymode']=="ToPay"){ echo "Selected";} ?> value="ToPay" >To Pay</option>
<option <?php if($row_tbl['trans_paymode']=="Paid"){ echo "Selected";} ?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="display:<?php if($row_tbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Dark" height="30" bordercolor="#cc30cc">
<td align="right" width="205" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['courier_name'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="227" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['docket_no'];?>"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="display:<?php if($row_tbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Dark" height="30" bordercolor="#cc30cc">
<td align="right" width="205" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="639" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['pname_byhand'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 

 <tr class="Light" height="25">
           <td width="204"  align="right"  valign="middle" class="tblheading">&nbsp;No. of Lots&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlot" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $row_tbl['nolot'];?>" onchange="nolchk(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>

<?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>
 <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td width="235" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstfp" style="width:190px;" >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['p_id']==$row_tbl['party_id']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
?>
<td width="172" align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant&nbsp;</td>
<td width="229" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtsttp" type="text" size="35" class="tbltext" tabindex="" onkeypress="return isNumberKey(event)"  value="<?php echo $plname.", ".$city1;?>">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="204" align="right"  valign="middle" class="tblheading">Date of Receipt&nbsp;</td>
<td width="235" align="left"  valign="middle" class="tbltext" >&nbsp;
  <input name="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle">&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">STN&nbsp;No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"  value="<?php echo $row_tbl['dcno'];?>"onchange="vendorchk1();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
			 <tr class="tblsubtitle" height="20">
             <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="58" align="center" valign="middle" class="tblheading">Variety</td>
			 <td width="75" align="center" valign="middle" class="tblheading">UPS</td>
			 <td width="43" align="center" valign="middle" class="tblheading">Quantity </td>
              <td width="48" align="center" valign="middle" class="tblheading">NoP</td>
                  <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="9%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
			  <td align="center" valign="middle" class="tblheading">Bag</td>
			  <td align="center" valign="middle" class="tblheading">Qty</td>
               
              </tr>
<?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
             <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='$plantcode' and arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>			 
             <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
             <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
             <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
             <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
			  <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
			 <td width="5%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'StockTransfer Arrival');"   /></td>
 </tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
            <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
             <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='$plantcode' and arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>			 
             <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
             <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
             <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
             <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
			  <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
			 <td width="5%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'StockTransfer Arrival');"   /></td>
 </tr> 
<?php
}
$srno++;
}
}
?> 
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />  			  
</table>
		  <br />
		  <div id="postingsubtable" style="display:block">
<?php 
if($row_tbl['sstage']!="Pack Seed")
{
?> 		  
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="25">
           <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;ST Lot Number&nbsp;</td>
           <td width="250" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlotp" type="text" size="35" class="tbltext" tabindex="" maxlength="35" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   <td align="right"  valign="middle" class="tblheading">Quality Status .&nbsp;</td>
<td width="260" align="left"  valign="middle" class="tbltext">&nbsp;<select name="txtqtystat" class="tbltext"  style="width:120px;" tabindex=""  onchange="classchk(this.value);">
		<option value="">---Select Status---</option>
		<option value="Ok">Ok</option>
		<option value="GOTOk">GOTOk</option>
		</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>

         <tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch Total Bags&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsdcchk();" /></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="177" align="right"  valign="middle" class="tblheading" >Dispatch Total No. of Qty&nbsp;</td>
<td width="260" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="Bagsdcchk1();" /  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Receive No. of Bags&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagschk1(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Received Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="qtychk1(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr> 

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Difference Bags&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagschk(this.value);" style="background-color:#CCCCCC" readonly="true" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000"  readonly="true" >*</font>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"  value="<?php echo $row_tbl_sub['moisture'];?>" //>%&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:100px;" onchange="visuchk()">
   <option <?php if($row_tbl_sub['vchk']=="Acceptable"){ echo "Selected";} ?> value="Acceptable">Acceptable</option>
	<option <?php if($row_tbl_sub['vchk']=="Not-Acceptable"){ echo "Selected";} ?>   value="Not-Acceptable" >Not- Acceptable</option>

     
  </select>  <font color="#FF0000">*</font>	</td>
</tr>

<tr class="Dark" height="20">
	<td width="147" align="right"  valign="middle" class="tblheading">Seed status&nbsp;</td>
<td width="272" align="left"  valign="middle" class="tbltext"   colspan="3">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a>	</td>
  </tr>
  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgot" style="width:100px;" onchange="visuchk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="GOTR" >GOT-R</option>
    <option value="GOTNR" >GOT-NR</option>
  </select>  <font color="#FF0000">*</font>
  </td>

<td align="right"  valign="middle" class="tblheading">GOT Status &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="gotstatus" style="width:100px;" onchange="visuchk1(this.value)">
    <option value="" selected>--Select--</option>
    <option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="Retest" >Retest</option>
  </select>  <font color="#FF0000">*</font>
  </td>

  </tr>
  <tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtgermi" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk1();" onkeypress="return isNumberKey(event)" value="<?php echo $row_tbl_sub['gemp'];?>"/>%&nbsp;<font color="#FF0000">*</font>	</td>
 
</tr>
</table>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
 <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="84" align="center" valign="middle" class="tblheading">Bin</td>
<td width="103" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="65" align="center" valign="middle" class="tblheading">Bags</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">Bags</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
<br />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="25">
           <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;ST Lot Number&nbsp;</td>
           <td width="250" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlotp" type="text" size="35" class="tbltext" tabindex="" maxlength="35" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   <td align="right"  valign="middle" class="tblheading">Quality Status &nbsp;</td>
<td width="260" align="left"  valign="middle" class="tbltext">&nbsp;<select name="txtqtystat" class="tbltext"  style="width:120px;" tabindex=""  onchange="classchk(this.value);">
		<option value="">---Select Status---</option>
		<option value="" selected>--Select--</option>
    <option value="UnderTest" >UnderTest</option>
	  <option value="OK" >OK</option>
	    <option value="Fail" >Fail</option>
		  <option value="Retest" >Retest</option>
		</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>

<?php
$sql_var=mysqli_query($link,"select * from tblvariety where cropname='".$row_tbl['lotcrop']."' and varietyid='".$row_tbl['lotvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$tot_var=mysqli_num_rows($sql_var);
$row_var=mysqli_fetch_array($sql_var);
//echo $row_var['gm'];
$parr=explode(",", $row_var['gm']);
$sn=0;
foreach($parr as $val)
{
if($val<>"")
{
$sql_ups=mysqli_query($link,"select * from tblups where plantcode='$plantcode' and uid='".$val."'") or die(mysqli_error($link));
$row_ups=mysqli_fetch_array($sql_ups);
$sn++;
?>
<tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading"><?php echo $row_ups['ups']." ".$row_ups['wt']; ?></td>
<td align="left" valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txtp_<?php echo $sn;?>" id="txtp_<?php echo $sn;?>" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="packqchk();" /></a>&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtqtinkgs_<?php echo $sn;?>" id="txtqtinkgs_<?php echo $sn;?>" value="<?php echo $row_ups['uom']; ?>" /><input type="hidden" name="txtpcktyp_<?php echo $sn;?>" id="txtpcktyp_<?php echo $sn;?>" value="<?php echo $row_ups['ups']." ".$row_ups['wt']; ?>" /></td>
</tr>
<?php
}
}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" />
         <tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch Total Packs&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsdcchk();" /></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="177" align="right"  valign="middle" class="tblheading" >Dispatch Total No. of Qty&nbsp;</td>
<td width="260" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="Bagsdcchk1();" /  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Receive No. of Packs&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagschk1(this.value);" readonly="true" style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Received Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="qtychk1(this.value);" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr> 

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Difference Packs&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Difference Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000"  readonly="true" >*</font>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"  />%&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:100px;" onchange="visuchk()">
   <option value="" selected>--Select--</option>
   <option value="Acceptable">Acceptable</option>
	<option  value="Not-Acceptable" >Not- Acceptable</option>

     
  </select>  <font color="#FF0000">*</font>	</td>
</tr>

<tr class="Dark" height="20">
	<td width="147" align="right"  valign="middle" class="tblheading">Seed status&nbsp;</td>
<td width="272" align="left"  valign="middle" class="tbltext"   colspan="3">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
  </tr>
  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgot" style="width:100px;" onchange="visuchk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="GOTR" >GOT-R</option>
    <option value="GOTNR" >GOT-NR</option>
  </select>  <font color="#FF0000">*</font>
  </td>

<td align="right"  valign="middle" class="tblheading">GOT Status &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="gotstatus" style="width:100px;" onchange="visuchk1(this.value)">
    <option value="" selected>--Select--</option>
    <option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="Retest" >Retest</option>
  </select>  <font color="#FF0000">*</font>
  </td>

  </tr>
  <tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtgermi" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk1();" onkeypress="return isNumberKey(event)"   />%&nbsp;<font color="#FF0000">*</font>	</td>
 
</tr>
</table>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
 <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="84" align="center" valign="middle" class="tblheading">Bin</td>
<td width="103" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="65" align="center" valign="middle" class="tblheading">Bags</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">Bags</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
<br />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>
</div>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl['remarks'];?>" ></td>
</tr>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_arrival_stocktransfer2.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  