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
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
		$p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$txtlot=trim($_POST['txtlot']);
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

//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(arrival_code) FROM tblarrival where plantcode='$plantcode' and arrival_type='StockTransfer Arrival'  ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$ycode."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$ycode."/".$lgnid;
		}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>order- Transaction -Sales Channel</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
</head>
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

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Sales channel </td>
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
		</br>
<?php
$tid=0; $subtid=0;
if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$b."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$c."' and actstatus='Active'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);
$variet=$row_variety['popularname'];

$tot_row=0;
$lotqry=mysqli_query($link,"select * from tbllotimp where plantcode='$plantcode' and lotnumber='".$a."' and lotcrop='".$crop."' and lotvariety='".$variet."'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	

 
 if($row['lotvariety']!="")
 {
 	$variety=$row['lotvariety'];
 	$lotqry1=mysqli_query($link,"select * from tblvariety where popularname='".$variety."' and actstatus='Active'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$qctyp=$row11['opt'];
	$i=$row11['varietyid'];
 }
 else
 {
 	$sql_spc=mysqli_query($link,"select * from tblspcodes where spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	$xx=mysqli_num_rows($sql_spc);
	if($xx > 0)
	{
	$x=$row_spc['variety'];
	$z=$row_spc['crop'];
	$lotqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$x."' and actstatus='Active'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$variety=$row11['popularname'];
	$qctyp=$row11['opt'];
	}
	else
	{
	$variety="";
	$qctyp="";
	$x=0;
	}
 }
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Arrival From Stock Transfer </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="121" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="239" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Name of Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcla" style="width:150px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');">
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">DCNo.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20" onchange="vendorchk();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

 <?php
$quer4=mysqli_query($link,"SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td width="205" align="right" valign="middle" class="tblheading">&nbsp;DC Date</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
           </tr>
<!--<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Name of Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="select" style="width:150px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer3)) { ?>
    <option value="<?php echo $noticia['p_id'];?>" />  
    <?php echo $noticia['business_name'];?>
    <?php } ?>
  </select>  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
 <?php
$quer4=mysqli_query($link,"SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;</td>
</tr>-->
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Packages  &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsg" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschk(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Type of Packages &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyg" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtychk(this.value);">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="display:none; border-color:#cc30cc" > 
<tr class="Light" height="30">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="99" align="right"  valign="middle" class="tblheading" style="border-color:#cc30cc">Lorry Receipt No&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3" style="border-color:#cc30cc">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext"  style="border-color:#cc30cc">&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#cc30cc">&nbsp;<select class="tbltext" name="txt13" style="width:70px;" onchange="clk1(this.value);" >
<option value="" selected="selected">Select</option>
<option value="TBB">TBB</option>
<option value="ToPay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="display:none; border-color:#cc30cc" > 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="99" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Docket NO.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3" style="border-color:#cc30cc">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="display:none; border-color:#cc30cc" > 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#cc30cc">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#cc30cc">&nbsp;<input name="txtpname" type="text" size="30" class="tbltext" tabindex=""  maxlength="30" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

</table>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">SRN No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtupsg" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschk(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="1%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="3" valign="middle" class="tblheading">Crop</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">UPS</td>
                <td colspan="8"  align="center" valign="middle" class="tblheading">quantity</td>
            
              <td width="3%" rowspan="3" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			
          </table>
		  <br />
		  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 
         <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="113" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="249" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;
      <select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
<input type="hidden" name="itmdchk" value="" />
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="361" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Old Lot No. &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsdcchk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Generate New Lot No. &nbsp;</td>
<td width="361" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Old Lot No. &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsdcchk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Store in to&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt1" type="radio" class="tbltext" value="Transport"  />
 Psw
   <input name="txt1" type="radio" class="tbltext" value="Courier"  />
   Csw&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Qcr&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt1" type="radio" class="tbltext" value="Transport"  />
 Yes
   <input name="txt1" type="radio" class="tbltext" value="Courier"  />
   No&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS Damage&nbsp;</td>
<td width="361" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschk1(this.value);"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Quantity Damage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value);"  />&nbsp;</td>
</tr>

 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Excess/Shortage UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtexshups" type="text" size="10" class="tbltext" tabindex="" maxlength="5" readonly="true" style="background-color:#CCCCCC"  /></td>
<td align="right"  valign="middle" class="tblheading">Excess/Shortage&nbsp;<br />Quantity&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>-->
</table>

<div id="subsubdivgood" style="display:block"></div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
</div>
<?php
//$quer2=mysqli_query($link,"SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysqli_fetch_array($quer2);
?>

<?php
//$quer3=mysqli_query($link,"SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_arrival_stocktransfer2.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  