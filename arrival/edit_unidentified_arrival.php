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
		$txtarr=trim($_POST['txtarr']);
		$txt11=trim($_POST['txt11']);
		$txtlot2=trim($_POST['txtlot2']);
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
		echo "<script>window.location='add_arrival_unidentified_preview.php?p_id=$p_id&remarks=$remarks&arrivaltype=$arrivaltype&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&txtlot2=$txtlot2&txtarr=$txtarr'</script>";	
			
	}
		/*
		echo "<script>window.location='add_arrival_unidentified_preview.php?p_id=$pid&remarks=$remarks&txtlot=$txtcla&txtdcno=$txtdcno&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname'</script>";	
			
	}*/

/*//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(trcode) FROM tblstock  ORDER BY trcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}
		//}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Unidentified Arrival</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading1.js"></script>
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
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
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

function qtychk1(qtyval1)
{
		if(document.frmaddDepartment.txtdcnob.value=="")
		{
			alert("Please Enter NoB");
			document.frmaddDepartment.txtdcnob.focus();
		}
		if(parseFloat(qtyval1)>99999.999)
			{
				alert("Invalid Quantity");
				document.frmaddDepartment.txtdcqty.value="";
				document.frmaddDepartment.txtdcqty.focus();
			}

		
}

/*function qtychk2(actgqty)
{
	if(document.frmaddDepartment.txtdcqty.value=="")
		{
			alert("Enter Quantity as per PDN");
			document.frmaddDepartment.txtactqty.value="";
			document.frmaddDepartment.txtdiffqty.value="";
		}
		else
		{
		document.frmaddDepartment.txtdiffqty.value=parseFloat(document.frmaddDepartment.txtdcqty.value)-parseFloat(actgqty);
		}
}
*/function bagschk1()
{
		if(document.frmaddDepartment.txtcrop.value=="")
		{
			alert("Please Select Crop");
			//document.frmaddDepartment.txtdcnob.value="";
			document.frmaddDepartment.txtdcqty.value="";
		}
}
/*function bagschk2(actbags)
{
		if(document.frmaddDepartment.txtdcnob.value=="")
		{
			alert("Enter Number of Bags as per PDN");
			document.frmaddDepartment.txtactnob.value="";
			document.frmaddDepartment.txtdcqty.value="";
		}
		else
		{
		document.frmaddDepartment.txtdiffnob.value=parseFloat(document.frmaddDepartment.txtdcnob.value)-parseFloat(actbags);
		}
}*/
function moischk()
{
if(document.frmaddDepartment.txtparty.value=="")
		{
			alert("Please Select Party");
			document.frmaddDepartment.txtmoist.value="";
			document.frmaddDepartment.txtparty.focus();
		}
		if(document.frmaddDepartment.txtdcqty.value=="")
		{
			alert("Enter Quantity");
			document.frmaddDepartment.txtmoist.value="";
			document.frmaddDepartment.txtdcqty.focus();
		}
}

function visuchk1(opt)
{

	if(document.frmaddDepartment.txtmoist.value=="")
		{
			alert("Enter Moisture");
			document.frmaddDepartment.txtmoist.focus();
			document.getElementById("tvisualck").selectedIndex=0;
			return false;
		}
		/*else
		{
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
		}*/
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
function sstschk()
{
		if(document.frmaddDepartment.txtarr.value=="")
		{
			alert("Please Select Type");
			document.frmaddDepartment.txtarr.value="";
			document.frmaddDepartment.txtarr.focus()
		}
}

function sschk1(stage)
{
		if(document.frmaddDepartment.txtarr.value=="")
		{
			alert("Select arrived in");
			document.frmaddDepartment.txtarr.value="";
			document.frmaddDepartment.txtarr.focus()
			var cod="";
			if(stage=="Raw"){cod="R";}else if(stage=="Condition"){cod="C";}else{cod="";}
			document.frmaddDepartment.txtold.value=document.frmaddDepartment.gln.value+cod;
		}
}


function sschk2()
{
		if(document.frmaddDepartment.txtarr.value=="")
		{
			alert("Select Select No Of Lots");
			document.frmaddDepartment.txtlot2.value="";
			document.frmaddDepartment.txtlot2.focus()
		}
}

function sschk(stage)
{
		//alert(stage);
		if(document.frmaddDepartment.txtvisualck.value=="")
		{
			alert("Select Physical Purity");
			document.frmaddDepartment.txtstage.SelectedIndex=0;
		}
		else
		{
			var cod="";
			if(stage=="Raw"){cod="R";}else if(stage=="Condition"){cod="C";}else{cod="";}
			document.frmaddDepartment.txtold.value=document.frmaddDepartment.gln.value+cod;
			/*var clasid=document.frmaddDepartment.cid.value;
			var itmid=document.frmaddDepartment.vid.value;*/
			showUser(stage,'subsubdivgood','slocshowsubgood','','','');
		}

		var clasid=document.frmaddDepartment.txtcrop.value;
			//var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',clasid,'','');
		}

function sstschk()
{
		if(document.frmaddDepartment.txtarr.value=="")
		{
			alert("Select Arrived In");
			document.frmaddDepartment.txtlot2.value="";
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
if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
				{
					alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
					document.frmaddDepartment.txtlot1.focus();
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
	/*else
	{
		alert("Please select Mode of Transit");
		return false;
	}*/
	/*else if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter DC No.");
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}		
	else if(document.frmaddDepartment.txtor.value=="")
	{
		alert("Please enter Order Ref No.");
		document.frmaddDepartment.txtor.focus();
		return false;
	}		
	else if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please Select Party.");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}	*/	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}		

	

	/*else if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Please Select No.of Lots.");
		document.frmaddDepartment.txtlot2.focus();
		return false;
	}		*/
	else if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		return false;
	}		
		else if(document.frmaddDepartment.txtdcnob.value=="")
	{
		alert("Please enter No. of Bags");
		document.frmaddDepartment.txtdcnob.focus();
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
		alert("Please enter Visual Check");
		document.frmaddDepartment.txtvisualck.focus();
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
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	/*else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} */
	
	else
	{	//alert("hi");
		
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslBagsg1.value;
		var g=document.frmaddDepartment.txtdcqty.value;
		if(q1=="")q1=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1);
		var f=0;
		if(qtyg > 0 && (q2=="" || q2==0))
		{
		alert("Please check. NoB Received cannot be Zero or Blank");
		return false;
		f=1;
		}
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity received is not matching with Quantity distributed in Bins");
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

function pformedtup()
{	

/*if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
				{
					alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
*/	 if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}		
	
 if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Please Select Mode Of Transit.");
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
	
	if(document.frmaddDepartment.txtlot2.value=="")
	{
		alerd("Please Select No. Of Lots.");
		document.frmaddDepartment.txtlot2.focus();
		return false;
	}		
	else if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		dOcument.frmaddDepartment.txtstage.focus();
		return false;
	}		
		else if(document.frmaddDepartment.txtdcnob.value=="")
	{
		alert("Please enter No. of Bags");
		document.frmaddDepartment.txtdcnob.focus();
		return false;
	}		//}
	
	
	else if(document.frmaddDepartment.txtmoist.value=="")
	{
		alert("Please enter Moisture");
		document.frmaddDepartment.txtmoist.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtvisualck.value=="")
	{
		alert("Please enter Visual Check");
		document.frmaddDepartment.txtvisualck.focus();
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
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	/*else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} */
	
	else
	{	//alert(document.frmaddDepartment.txtslqtyg1.value);
		
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslBagsg1.value;
		var g=document.frmaddDepartment.txtdcqty.value;
		if(q1=="")q1=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1);
		var f=0;
		if(qtyg > 0 && (q2=="" || q2==0))
		{
		alert("Please check. NoB Received cannot be Zero or Blank");
		return false;
		f=1;
		}
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in Item received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		
		if(g==0 )
		{
		alert("Please check. Quantity Received  and Quantity Received Damage Both cannot be Zero or Blank");
		return false;
		f=1;
		}
		if(f==1)
		{
		return false;
		}
		else
		{	//alert("hi");
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}
//edtrecid,'postingsubtable','subformedt
function clk1(opt)
{
	if(document.frmaddDepartment.txtlot2.value!="")
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
	alert("Please Select No. of Lots");
	}
}

function clk(opt)
{
	if(document.frmaddDepartment.txtlot2.value!="")
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
	alert("Please Select No. of Lots");
	}
}





function clk1(val)
{
document.frmaddDepartment.txt14.value=val;
}




function showslocbins()
{
			
			var clasid=document.frmaddDepartment.txtclass.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
}




/*function modetchk(classval)
{
	if(document.frmaddDepartment.txt11.value!="")
	{
	alert("Please select Mode of Transit first");
		document.frmaddDepartment.txt11.selectedIndex=0;
	}
}
*/


function mode()
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
		return false;
	}
}
function openslocpop()
{
if(document.frmaddDepartment.txt11.value=="")
{
 alert("Please Select Mode of Transit.");
}
else
{
var crop=document.frmaddDepartment.txtarr.value;
var itm="Unidentified";
winHandle=window.open('getuser_unid_lotno.php?tp='+itm+'&crop='+crop,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}
function openslocpop1()
{
if(document.frmaddDepartment.txtvisualck.value=="")
{
alert("Please Select Physical Purity");
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
		//document.frmaddDepartment.txtslqtyg2.value="";
		document.frmaddDepartment.txtslBagsg2.focus();
	}
	/*if(document.frmaddDepartment.txtslqtyg2.value!="")
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
	}*/
	else
	{
	document.frmaddDepartment.balqty2.value="";
	}
}




function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDepartment.txtdcqty.value > 0)
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
	if(document.frmaddDepartment.txtdcqty.value > 0)
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
	var itemv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		/*if(document.frmaddDepartment.txtslBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.txtslBagsg1.value;
		else*/
		var Bagsv1=document.frmaddDepartment.txtcrop.value;
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
	var itemv=document.frmaddDepartment.txtcrop.value;
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
		/*if(document.frmaddDepartment.txtslBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg2.value;
		else*/
		var Bagsv2=document.frmaddDepartment.txtcrop.value;
		/*if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');*/
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
		/*var exu=0;
		if(document.frmaddDepartment.exusp2.value=="")
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


function editrec(edtrecid)
{
//alert(edtrecid);
addr=document.frmaddDepartment.txtarr.value;
showUser(edtrecid,'postingsubtable','subformedt',addr,'','','','','');
}
function getdetails(stage)
{
if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}

if(document.frmaddDepartment.txt1.value=="")
	{
 alert("Please Select Mode Of Transit.");
 document.frmaddDepartment.txt1.focus();
}
get=document.frmaddDepartment.txtlot1.value;
addr=document.frmaddDepartment.txtarr.value;
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
				//alert(addr);
				showUser(get,'postingsubtable','get',addr,'','','','');
}
function deleterec(v1,v2,v3)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
	addr=document.frmaddDepartment.txtarr.value;

		showUser(v1,'postingtable','delete',v2,v3,addr,'','','');
	}
	else
	{
		return false;
	}
}

function visuchk()
{
		/*if(document.frmaddDepartment.sstatus.value!="")
		{
			alert("Please select seed status");
			//document.frmaddDepartment.txtvisualck.value="";
		}
		else
		{*/
			var clasid=document.frmaddDepartment.txtcrop.value;
			//var itmid=document.frmaddDepartment.txtvariety.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',clasid,'','');
			//alert(clasid);
		}
//}
function mySubmit()
{ if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)!=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Please check, there is mismatch between number of lots mentioned and number of lots posted.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	 if(document.frmaddDepartment.txtarr.value=="")
	{
		alert("Please Select arrived in.");
		document.frmaddDepartment.txtarr.focus();
		return false;
	}		
if(document.frmaddDepartment.txt1.value=="")
	{
 alert("Please Select Mode Of Transit.");
 document.frmaddDepartment.txt1.focus();
}
	
	if(document.frmaddDepartment.txtcrop.value=="")
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
	}	
	
	else if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("PleaseSelect No. Of Lots.");
		document.frmaddDepartment.txtlot2.focus();
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Unidentified Arrival </td>
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
  <td colspan="6" align="center" class="tblheading">Edit Unidentified Arrival </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="209" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="327"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAU".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="211" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="193" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;
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
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="Unidentified Arrival" type="text" size="15" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="Unidentified Arrival" maxlength="15"/>  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
           </tr>
 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Unidentified Arrived in&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtarr" style="width:190px;">
    <option value="<?php echo $row_tbl['type'];?>" selected>--Select--</option>
	<option <?php if($row_tbl['type']=="Fresh Seed Arrival with PDN"){ echo "Selected";} ?> value="Fresh Seed Arrival with PDN">Fresh Seed Arrival with PDN</option>
<option <?php if($row_tbl['type']=="Stock Transfer-Plant"){ echo "Selected";} ?> value="Stock Transfer-Plant">Stocktransfer From Plant</option>
<option <?php if($row_tbl['type']=="Trading Arrival"){ echo "Selected";} ?> value="Trading Arrival">Trading Arrival</option>
    </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">No. of Bag&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtlot2" class="tbltext"  style="width:100px;" tabindex="" onChange="sstschk()" >
          <option value="<?php echo $row_tbl['nolot'];?>"><?php echo $row_tbl['nolot'];?></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="6"><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Transport"){ echo "checked"; }?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Courier"){ echo "checked"; }?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="By Hand"){ echo "checked"; }?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<div id="trans" style="display:<?php if($row_tbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>" >
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Light" height="30">
<td align="right" width="210" valign="middle" class="tblheading" >&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="21" class="tbltext" tabindex="" maxlength="20" value="<?php echo $row_tbl['trans_name'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="172" align="right"  valign="middle" class="tblheading" style="border-color:#F1B01E">Lorry Receipt No.&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex="" value="<?php echo $row_tbl['trans_lorryrepno'];?>"  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="210" valign="middle" class="tblheading" >&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="323" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['trans_vehno'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading" >&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:100px;" onchange="clk1(this.value);"  > 
<option value="">--Select Mode--</option>
<option <?php if($row_tbl['trans_paymode']=="TBB"){ echo "Selected";} ?> value="TBB">TBB</option>
<option <?php if($row_tbl['trans_paymode']=="To Pay"){ echo "Selected";} ?> value="To Pay" >To Pay</option>
<option <?php if($row_tbl['trans_paymode']=="Paid"){ echo "Selected";} ?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>"  >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="210" valign="middle" class="tblheading" >&nbsp;Courier Name&nbsp;</td>
<td align="left" width="323" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['courier_name'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="172" valign="middle" class="tblheading" s>&nbsp;Docket No.&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['docket_no'];?>"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
</div>
<div id="byhand" style="display:<?php if($row_tbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>" >
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="209" valign="middle" class="tblheading" >&nbsp;Name of Person&nbsp;</td>
<td width="735" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['pname_byhand'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
  
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Unidentified' and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>-->
    <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="13%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
	<td width="8%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
	 <!--/* <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Difference</td>*/-->
		<td width="9%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>

		  <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status</td>	 
		   <!--<td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type </td>-->
		 	 <td width="10%" align="center" valign="middle" class="tblheading"   rowspan="2">GOT Status</td>	 
	<td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>	     
    <td colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="6%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
     <!--<td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>-->
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

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

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
   <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
	 <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
     <!-- <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>-->
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <!--<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>-->
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>

  
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
    <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="4%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Unidentified');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
   <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
	 <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
     <!-- <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
     <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>-->
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	<!-- <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>-->
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>

  
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
    <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="4%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Unidentified');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
</table>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse "> 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;Lot Number&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E">&nbsp;<input name="txtlot1" type="text" size="6" class="tblheading" tabindex=""  maxlength="6"  value="<?php echo $mode;?>" onchange="ltchk(this.value);"  readonly="true" style="background-color:#CCCCCC" />
</span>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a>&nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table>
<br />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="pdnum" value="<?php echo $a;?>" />
<div id="postingsubtable" style="display:block">
</div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row_tbl['remarks'];?>" ></td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_bag.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  