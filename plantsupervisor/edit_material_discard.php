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
		$p_id=trim($_POST['trid']);
		$txtdrno=trim($_POST['txtdrno']);
		$txtparty=trim($_POST['txtparty']);
		$txtaddress=trim($_POST['txtaddress']);
		$adress1=trim($_POST['txtaddress1']);
		$city=trim($_POST['txtcity']);
		$pin=trim($_POST['txtpin']);
		$state=trim($_POST['txtstate']);
		$txtappli=trim($_POST['txtappli']);
		$rettyp=trim($_POST['rettyp']);
		$remarks=trim($_POST['txtremarks']);
		$txt11=trim($_POST['txt11']);
		$txtphone=trim($_POST['txtphone']);
		$txtparty=str_replace("&","and",$txtparty);
		$txtaddress=str_replace("&","and",$txtaddress);
		$adress1=str_replace("&","and",$adress1);
		$city=str_replace("&","and",$city);
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
		
		echo "<script>window.location='add_discard_str_preview.php?p_id=$p_id&txtdrno=$txtdrno&txtparty=$txtparty&txtaddress=$txtaddress&address1=$adress1&city=$city&pin=$pin&state=$state&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&txtappli=$txtappli&rettyp=$rettyp&remarks=$remarks&txtphone=$txtphone'</script>";
}
			/*echo "<script>window.location='select_dicard.php?p_id=$p_id'</script>";	*/
		
		
	

//}}
//}
$sql_code="SELECT MAX(tcode) FROM tbl_discard WHERE plantcode='$plantcode' ORDER BY tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="DC".$code;
		}
		else
		{
			$code=1;
			$code1="DC".$code;
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transaction - Add material Discard</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="discrd.js"></script>
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


function openslocpop1()
{
	
	if(document.frmaddDept.txtitem.value!="")
	{
		
		var itm=document.frmaddDept.txtitem.value;
		winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
	}
	else
	{
		alert("Please Select Variety");
		document.frmaddDept.txtitem.focus();
	}
}
function openslocpop()
{
if(document.frmaddDept.txtclass.value=="")
{
 alert("Please Select Crop");
 return false;
}
else if(document.frmaddDept.txtitem.value=="")
{
 alert("Please Select Variety");
 return false;
}
else
{
document.getElementById('subdiv24').innerHTML="";
//document.getElementById("postingsubsubtable").innerHTML="";
document.frmaddDept.txtlot1.value="";
var crop=document.frmaddDept.txtclass.value;
var variety=document.frmaddDept.txtitem.value;
//var stage=document.frmaddDept.txtstage.value;
var tid=document.frmaddDept.maintrid.value;

winHandle=window.open('getuser_proslip_lotno.php?crop='+crop+'&variety='+variety+'&tid='+tid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function mySubmit()
{ 
	
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDept.txtcla.focus();
		return false;
	}
	if(document.frmaddDept.txtdrno.value=="")
	{
	alert("Please enter Discard Instruction Ref. No.");
	document.frmaddDept.txtdrno.focus();
	return false;
	}
	
	if(document.frmaddDept.txtdrno.value.charCodeAt() == 32)
	{
	alert("Discard Instruction Ref. No cannot start with space.");
	document.frmaddDept.txtdrno.focus();
	return false;
	}
	if(document.frmaddDept.txtparty.value=="")
	{
	alert("Please enter Party Name");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	if(document.frmaddDept.txtaddress.value=="")
	{
	alert("Please enter Address 1");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	if(document.frmaddDept.txtcity.value=="")
	{
	alert("Please enter City/Town/Village");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	if(document.frmaddDept.txtpin.value!="")
	{
		if(document.frmaddDept.txtpin.value.length < 6)
		{
		alert("Pin Code can not less than six digits");
		document.frmaddDept.txtpin.value="";
		return false;
		}
	}
	if(document.frmaddDept.txtstate.value=="")
	{
	alert("Please select State");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	
/*if(document.frmaddDept.txtparty.value=!"")
	{
		if(document.frmaddDept.txtparty.value.charCodeAt() == 32)
		{
		alert("Party Name cannot start with space.");
		document.frmaddDept.txtparty.focus();
		return false;
		}
	}
	
if(document.frmaddDept.txtaddress.value=!"")
	{
		if(document.frmaddDept.txtaddress.value.charCodeAt() == 32)
		{
		alert("Address cannot start with space.");
		document.frmaddDept.txtaddress.focus();
		return false;
		}
	}*/

if(document.frmaddDept.txtappli.value!="")
	{
	if(document.frmaddDept.txtappli.value=="Applicable")
	{
if(document.frmaddDept.txt11.value!="")
	{
		if(document.frmaddDept.txt11.value=="Transport")
		{
			if(document.frmaddDept.txttname.value=="")
			{
			alert("Please enter Transport Name");
			document.frmaddDept.txttname.focus();
			return false;
			}
			
			if(document.frmaddDept.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDept.txttname.focus();
			return false;
			}
						
			/*if(document.frmaddDept.txtlrn.value=="")
			{
			alert("Please enter Lorry Receipt No");
			document.frmaddDept.txtlrn.focus();
			return false;
			}
			
			if(document.frmaddDept.txtlrn.value.charCodeAt() == 32)
			{
			alert("Lorry Receipt No cannot start with space.");
			document.frmaddDept.txtlrn.focus();
			return false;
			}*/
			if(document.frmaddDept.txtvn.value=="")
			{
			alert("Please enter Vehicle No");
			document.frmaddDept.txtvn.focus();
			return false;
			}
			
			if(document.frmaddDept.txtvn.value.charCodeAt() == 32)
			{
			alert("Vehicle No cannot start with space.");
			document.frmaddDept.txtvn.focus();
			return false;
			}
			if(document.frmaddDept.txt14.value=="")
			{
			alert("Please select Payment Mode");
			return false;
			}
		}
		else if(document.frmaddDept.txt11.value=="Courier")
		{
			if(document.frmaddDept.txtcname.value=="")
			{
			alert("Please enter Courier Name");
			document.frmaddDept.txtcname.focus();
			return false;
			}
			
			if(document.frmaddDept.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDept.txtcname.focus();
			return false;
			}
			
			if(document.frmaddDept.txtdc.value=="")
			{
			alert("Please enter Docket No.");
			document.frmaddDept.txtdc.focus();
			return false;
			}
			
			if(document.frmaddDept.txtdc.value.charCodeAt() == 32)
			{
			alert("Docket No. cannot start with space.");
			document.frmaddDept.txtdc.focus();
			return false;
			}
		}
		else
		{
			if(document.frmaddDept.txtpname.value=="")
			{
			alert("Please enter Person Name");
			document.frmaddDept.txtpname.focus();
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
}
else
{
		alert("Please select Mode of Transit Applicable or Not Applicable");
		return false;
}

	
	if(document.frmaddDept.rettyp.value=="")
			{
			alert("Please select Type");
			//document.frmaddDept.rettyp.focus();
			return false;
			}
			
			if(document.frmaddDept.trid.value==0)
			{
			alert("You have not Posted any Lot. Please post & then click Preview");
			return false;
			}
			if(document.frmaddDept.txtremarks.value=="")
			{
			alert("Please enter Reason for Discard");
			return false;
			}
	return true;	 
}


function clkapp(optapp)
{
if(optapp!="")
	{
		if(optapp=="Applicable")
		{
			document.getElementById('transmode').style.display="block";
			//document.getElementById('courier').style.display="none";
			document.frmaddDept.txtappli.value=optapp;
		}
		else
		{
			document.getElementById('transmode').style.display="none";
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
			document.frmaddDept.txt1.checked=false;
			document.frmaddDept.txttname.value="";
			document.frmaddDept.txt11.value="";
			document.frmaddDept.txt14.value="";
			document.frmaddDept.txtlrn.value="";
			document.frmaddDept.txtvn.value="";
			document.frmaddDept.txt13.checked=false;
			document.frmaddDept.txtcname.value="";
			document.frmaddDept.txtdc.value="";
			document.frmaddDept.txtpname.value="";
			document.frmaddDept.txtappli.value=optapp;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
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
				document.frmaddDept.txt11.value=opt;
			}
			else if(opt=="Courier")
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="block";
				document.getElementById('byhand').style.display="none";
				document.frmaddDept.txt11.value=opt;
			}	
			else
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="block";
				document.frmaddDept.txt11.value=opt;
			}	
		}
		else
		{
			alert("Please Select Mode of Transport");
			document.frmaddDept.txt11.value="";
		}
}

var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDept.reset();
	 popUpCalendar(document.frmaddDept.date,dt,document.frmaddDept.date, "dd-mmm-yyyy", xind, yind);
	}  


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
function onloadfocus()
	{
	document.frmaddDept.txt12.focus();
	}
	
function pform()
{
//alert("Hi posting the form");
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDept.txtcla.focus();
		return false;
	}
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Select Crop");
		//document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Variety.");
		//document.frmaddDept.txtitem.focus();
		return false;
	}
	//alert(document.frmaddDept.srno.value);
	document.frmaddDept.chkbox.value="";
	document.frmaddDept.srno1.value="";
	if(document.frmaddDept.srno.value > 0)
	{
		if(document.frmaddDept.srno.value <= 2)
		{
			if(document.frmaddDept.slocissue.checked == true)
			{  
				if(document.frmaddDept.chkbox.value =="")
				{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue.value;
				}
				else
				{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue.value;
				}
				if(document.frmaddDept.srno1.value =="")
				{
					document.frmaddDept.srno1.value=parseInt(document.frmaddDept.srno.value)-1;
				}
				else
				{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+parseInt(document.frmaddDept.srno.value)-1;
				}
			}
		}
		else
		{ var j=1;
			for (var i = 0; i < document.frmaddDept.slocissue.length; i++) 
			{          
				if(document.frmaddDept.slocissue[i].checked == true)
				{
					if(document.frmaddDept.chkbox.value =="")
					{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue[i].value;
					}
					else
					{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue[i].value;
					}
					if(document.frmaddDept.srno1.value =="")
					{
					document.frmaddDept.srno1.value=j;
					}
					else
					{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+j;
					}
				} j++;
			}
		}
/*}
//alert(document.frmaddDept.chkbox.value);
if(document.frmaddDept.srno.value > 0)
{
	if(document.frmaddDept.txtups.value<=0)
	{
		alert("Please enter Bags");
		document.frmaddDept.txtups.focus();
		return false;
	}
	if(document.frmaddDept.txtqty.value<=0)
	{
		alert("Please enter Quantity");
		document.frmaddDept.txtqty.focus();
		return false;
	}*/
	if(document.frmaddDept.chkbox.value == "")
	{
	alert("Please select SLOC to Discard");
	return false;
	}
	//alert("HIIIIIIIIII");
	if(document.frmaddDept.chkbox.value != "")
	{	//alert(document.frmaddDept.chkbox.value);
		var str=document.frmaddDept.srno.value;
		var val=str.split(",");
		//alert(val);
		var tqty=0;
		if(val!="")
		for(var i=1; i<=val.length; i++)
		{ 
			var z2="upsavl_"+i;
			var z3="qtyavl_"+i;
			var z4="issueups_"+i;
			var z5="issueqty_"+i;
			var z="balups_"+i;
			var z1="balqty_"+i;
			tqty=tqty+parseFloat(document.getElementById(z5).value);
			
			if(document.getElementById(z1).value == "")
			{
			alert('Please enter Bags & Quantity to Discard in SLOC Row Number: '+i);
			return false;
			}
			if(parseFloat(document.getElementById(z5).value) > parseFloat(document.getElementById(z3).value))
			{
			alert('Discard Quantity cannot be more than the Existing Quantity');
			document.getElementById(z1).value="";
			document.getElementById(z5).value="";
			return false;
			}
			if(parseFloat(document.getElementById(z1).value) == 0 )
			{
			document.getElementById(z).value=0;
			}
			if(parseFloat(document.getElementById(z1).value) != 0 && parseInt(document.getElementById(z).value) == 0)
			{
			document.getElementById(z).value=1;
			}
		}
		/*if(parseFloat(tqty) != parseFloat(document.frmaddDept.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Discard');
		return false;
		}*/
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.txtremarks.value=a;
		showUser(a,'maindiv','discard3','','','','','');

}	
}

function chktyp()
{ 
	if(document.frmaddDept.txtitem.value!="")
	{
			var opttyp=document.frmaddDept.txtrettype.value;
			var clasid=document.frmaddDept.txtclass.value;
			var itmid=document.frmaddDept.txtitem.value;
			showUser(opttyp,'subdiv24','slocshowmrv',opttyp,clasid,itmid,opttyp,'');
			
	}
	else
	{
		alert("please select Variety first");
		
	}
}

function checkchk(chkval)
{
		var x="issueups_"+chkval;
		var y="issueqty_"+chkval;
		var z="balups_"+chkval;
		var z1="balqty_"+chkval;
		//alert(chkval);
		if(document.getElementById(chkval).checked==true)
		{
			document.getElementById(x).readOnly=false;
			document.getElementById(y).readOnly=false;
			document.getElementById(z).readOnly=false;
			document.getElementById(x).style.backgroundColor="#FFFFFF";
			document.getElementById(y).style.backgroundColor="#FFFFFF";
			document.getElementById(z).style.backgroundColor="#FFFFFF";
		}
		else
		{
			document.getElementById(x).value="";
			document.getElementById(y).value="";
			document.getElementById(z).value="";
			document.getElementById(z1).value="";
			document.getElementById(x).readOnly=true;
			document.getElementById(y).readOnly=true;
			document.getElementById(z).readOnly=true;
			document.getElementById(x).style.backgroundColor="#CCCCCC";
			document.getElementById(y).style.backgroundColor="#CCCCCC";
			document.getElementById(z).style.backgroundColor="#CCCCCC";
		}
}
function upschk(fid,fval)
{
var a="upsavl_"+fval;
var b="balups_"+fval;
document.getElementById(b).value=parseInt(document.getElementById(a).value)-parseInt(fid);
}

function qtychk(qid,qval)
{
			var z2="upsavl_"+qval;
			var z3="qtyavl_"+qval;
			var z4="issueups_"+qval;
			var z5="issueqty_"+qval;
			var z="balups_"+qval;
			var z1="balqty_"+qval;
			
			if(parseFloat(document.getElementById(z5).value) > parseFloat(document.getElementById(z3).value))
			{
			alert('Discard Quantity cannot be more than the Existing Quantity');
			document.getElementById(z1).value="";
			document.getElementById(z5).value="";
			return false;
			}
			if(parseFloat(document.getElementById(z1).value) == 0 )
			{
			document.getElementById(z).value=0;
			}
			if(parseFloat(document.getElementById(z1).value) != 0 && parseInt(document.getElementById(z).value) == 0)
			{
			document.getElementById(z).value=1;
			}
			if(parseFloat(document.getElementById(z5).value) == "")
			{
			alert('Discard Quantity cannot be blank');
			document.getElementById(z1).value=parseFloat(document.getElementById(z3).value);
			document.getElementById(z5).value=0;
			return false;
			}
			else
			{
			/*var c="qtyavl_"+qval;
			var d="balqty_"+qval;*/
			document.getElementById(z1).value=parseFloat(document.getElementById(z3).value)-parseFloat(document.getElementById(z5).value);
			}
}
function clks(val)
{
//alert(val);
document.frmaddDept.txt15.value=val;
}
function clk1(val)
{
//alert(val);
document.frmaddDept.txt14.value=val;
}

function modetchk(classval)
{
	var f=0;
	if(document.frmaddDept.txtappli.value=="")
	{
		alert("Please select Mode of Transit first");
		document.frmaddDept.txtclass.value="";
		document.getElementById('subdiv24').innerHTML="";
		document.frmaddDept.txtlot1.value="";
		f=1;
	}
	if(document.frmaddDept.txtappli.value=="Applicable")
	{
		if(document.frmaddDept.txt11.value=="Transport")
		{
			if(document.frmaddDept.txttname.value=="")
			{
				alert("Please enter Transport Name");
				document.frmaddDept.txttname.focus();
				f=1;
				return false;
			}
				
			if(document.frmaddDept.txttname.value.charCodeAt() == 32)
			{
				alert("Transport Name cannot start with space.");
				document.frmaddDept.txttname.focus();
				f=1;
				return false;
			}
							
			if(document.frmaddDept.txtvn.value=="")
			{
				alert("Please enter Vehicle No");
				document.frmaddDept.txtvn.focus();
				f=1;
				return false;
			}
				
			if(document.frmaddDept.txtvn.value.charCodeAt() == 32)
			{
				alert("Vehicle No cannot start with space.");
				document.frmaddDept.txtvn.focus();
				f=1;
				return false;
			}
			if(document.frmaddDept.txt14.value=="")
			{
				alert("Please select Payment Mode");
				f=1;
				return false;
			}
		}
		else if(document.frmaddDept.txt11.value=="Courier")
		{
			if(document.frmaddDept.txtcname.value=="")
			{
				alert("Please enter Courier Name");
				document.frmaddDept.txtcname.focus();
				f=1;
				return false;
			}
				
			if(document.frmaddDept.txtcname.value.charCodeAt() == 32)
			{
				alert("Courier Name cannot start with space.");
				document.frmaddDept.txtcname.focus();
				f=1;
				return false;
			}
				
			if(document.frmaddDept.txtdc.value=="")
			{
				alert("Please enter Docket No.");
				document.frmaddDept.txtdc.focus();
				f=1;
				return false;
			}
				
			if(document.frmaddDept.txtdc.value.charCodeAt() == 32)
			{
				alert("Docket No. cannot start with space.");
				document.frmaddDept.txtdc.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDept.txtpname.value=="")
			{
				alert("Please enter Person Name");
				document.frmaddDept.txtpname.focus();
				f=1;
				return false;
			}	
		}
	}
	if(f==0)
	{
		showUser(classval,'vitem','item','','','','','');
		document.getElementById('subdiv24').innerHTML="";
		document.frmaddDept.txtlot1.value="";
	}
}

function modetchk24(classval24)
{
document.getElementById('subdiv24').innerHTML="";
document.frmaddDept.txtlot1.value="";
}
function piupschk()
{
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDept.txtitem.focus();
	}
}
function piqtychk(edtid)
{
	if(document.frmaddDept.txtups.value=="")
	{
		alert("Please enter Bags first");
		document.frmaddDept.txtups.focus();
	}
	
}	

function classchk(itval)
{
if(document.frmaddDept.txtclass.value!="")
	{	
		if(document.frmaddDept.txtitem.value!="")
		{
			if(document.frmaddDept.itmdchk.value!="")
			{ 
				var flg=0;
				var itmchk=document.frmaddDept.itmdchk.value;
				var itm=itmchk.split(",");
				for(var i=0; i < itm.length; i++)
				{
					if(document.frmaddDept.txtitem.value==itm[i])
					{
						flg=1;
					}
				}
				if(flg==1)
				{
					alert("Please Check, this Variety is already posted in this transaction");
					document.frmaddDept.txtitem.selectedIndex=0;
					return false;
				}
				
			}
		}
		showUser(itval,'uom','itemuom','','','','','');
		setTimeout('chktyp()',200);
	}
	else
	{
		alert("Please Select Crop")
		//document.frmaddDept.txtitem.
		document.frmaddDept.txtitem.selectedIndex=0;
		document.frmaddDept.txtclass.focus();
	}
}
function editrecord(edtid)
{
//alert(edtid);
showUser(edtid,'subsubdiv','subformedt','','','','','');
}

function deleterec(v1,v2,v3)
{
if(confirm('Do You wish to delete this Variety?')==true)
{
showUser(v1,'maindiv','dddelete',v2,v3,'','','');
}
else
{
return false;
}
}

	function pupdateform()
{
	document.frmaddDept.chkbox.value="";
	document.frmaddDept.srno1.value="";
	if(document.frmaddDept.srno.value > 0)
	{
		if(document.frmaddDept.srno.value <= 2)
		{
			if(document.frmaddDept.slocissue.checked == true)
			{  
				if(document.frmaddDept.chkbox.value =="")
				{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue.value;
				}
				else
				{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue.value;
				}
				if(document.frmaddDept.srno1.value =="")
				{
					document.frmaddDept.srno1.value=parseInt(document.frmaddDept.srno.value)-1;
				}
				else
				{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+parseInt(document.frmaddDept.srno.value)-1;
				}
			}
		}
		else
		{ var j=1;
			for (var i = 0; i < document.frmaddDept.slocissue.length; i++) 
			{          
				if(document.frmaddDept.slocissue[i].checked == true)
				{
					if(document.frmaddDept.chkbox.value =="")
					{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue[i].value;
					}
					else
					{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue[i].value;
					}
					if(document.frmaddDept.srno1.value =="")
					{
					document.frmaddDept.srno1.value=j;
					}
					else
					{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+j;
					}
				} j++;
			}
		}
/*}
//alert(document.frmaddDept.chkbox.value);
if(document.frmaddDept.srno.value > 0)
{*/
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDept.txtcla.focus();
		return false;
	}
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Select Crop");
		//document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Variety.");
		//document.frmaddDept.txtitem.focus();
		return false;
	}
	/*if(document.frmaddDept.txtups.value<=0)
	{
		alert("Please enter Bags");
		document.frmaddDept.txtups.focus();
		return false;
	}
	if(document.frmaddDept.txtqty.value<=0)
	{
		alert("Please enter Quantity");
		document.frmaddDept.txtqty.focus();
		return false;
	}*/
	if(document.frmaddDept.chkbox.value == "")
	{
	alert("Please select SLOC to Discard");
	return false;
	}
	//alert("HIIIIIIIIII");
	if(document.frmaddDept.chkbox.value != "")
	{	//alert(document.frmaddDept.chkbox.value);
		var str=document.frmaddDept.srno.value;
		var val=str.split(",");
		//alert(val);
		var tqty=0;
		if(val!="")
		for(var i=1; i<=val.length; i++)
		{ 
			var z2="upsavl_"+i;
			var z3="qtyavl_"+i;
			var z4="issueups_"+i;
			var z5="issueqty_"+i;
			var z="balups_"+i;
			var z1="balqty_"+i;
			tqty=tqty+parseFloat(document.getElementById(z5).value);
			
			if(document.getElementById(z1).value == "")
			{
			alert('Please enter Bags & Quantity to Discard in SLOC Row Number: '+i);
			return false;
			}
			if(parseFloat(document.getElementById(z5).value) > parseFloat(document.getElementById(z3).value))
			{
			alert('Discard Quantity cannot be more than the Existing Quantity');
			document.getElementById(z1).value="";
			document.getElementById(z5).value="";
			return false;
			}
			if(parseFloat(document.getElementById(z1).value) == 0 )
			{
			document.getElementById(z).value=0;
			}
			if(parseFloat(document.getElementById(z1).value) != 0 && parseInt(document.getElementById(z).value) == 0)
			{
			document.getElementById(z).value=1;
			}
		}
		/*if(parseFloat(tqty) != parseFloat(document.frmaddDept.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Discard');
		return false;
		}*/
	}
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.txtremarks.value=a;
		showUser(a,'maindiv','mformddupdate','','','','','');
}
}	

function clkret(retopt)
{
	document.frmaddDept.rettyp.value=retopt;
}

function getdetails()
{
if(document.frmaddDept.txtlot1.value=="")
{
 alert("Please Select or enter Lot No.");
}
else
{

var get=document.frmaddDept.txtlot1.value;
//var grn=document.frmaddDept.grnnumber.value;

			if(document.frmaddDept.txtlot1.value=="")
				{
					alert("Please enter Lot No.");
					document.frmaddDept.txtlot1.focus();
					return false;
				}
			if(document.frmaddDept.txtlot1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.frmaddDept.txtlot1.focus();
					return false;
				}
		/*	if(!isChar_W(document.frmaddDept.txtlot1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDept.txtlot1.focus();
					return false;
				}*/
				if(document.frmaddDept.txtlot1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDept.txtlot1.focus();
				return false;
				}
				//alert(document.frmaddDept.txtcrop.value);
		var crop=document.frmaddDept.txtclass.value;
        var variety=document.frmaddDept.txtitem.value;					
		var tid=document.frmaddDept.maintrid.value;
		var lotid=document.frmaddDept.subtrid.value;
		//alert(tid);
		//alert(lotid);
		
		//document.getElementById("postingsubtable").style.display="block";
		showUser(get,'subdiv24','get',crop,variety,tid,lotid,'','');
}
}


</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"   align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Material Discard </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_discard where tid=$pid AND plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; $erid=0;
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform"  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input name="txt11" value="<?php echo $row['tmode'];?>" type="hidden"> 
	    <input name="txt14" value="<?php echo $row['pmode'];?>" type="hidden"> 
		<input name="txt15" value="" type="hidden"> 
		<input name="txt13" value="" type="hidden"> 
		<input name="txt" value="" type="hidden"> 
		<input type="hidden" name="code" value="<?php echo $row['code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
 		<input name="txtappli" value="<?php if($row['tmode'] == "") { echo "Not Applicable"; } else { echo "Applicable";} ?>" type="hidden"> 
  		 <input name="rettyp" value="<?php echo $row['rettyp'];?>" type="hidden"> 
		 <input name="txt1" value="" type="hidden"> 
<?php

 	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>
		</br>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">

<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Material Discard </td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="215" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID &nbsp;</td>
           <td width="234" align="left"  valign="middle">&nbsp;<?php echo "TMD".$row['tcode']."/".$yearid_id."/".$lgnid;?></td>
		   
		   <td width="84" height="24"  align="right"  valign="middle" class="tblheading">Discard&nbsp;Date&nbsp;</td>
           <td width="207" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>" /></td>
</tr>
		
		 <tr class="Light" height="25">
          <td width="215" height="24"  align="right"  valign="middle" class="tblheading"> Discard &nbsp;Instruction Ref. No.&nbsp;</td>
          <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtdrno" type="text" size="20" class="tbltext" tabindex="0" maxlength="15" onchange="showUser(this.value);" value="<?php echo $row['drno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		   
		   <tr class="Light" height="25">
           <td width="215" height="24"  align="right"  valign="middle" class="tblheading">Party Name &nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtparty" type="text" size="35" class="tbltext" tabindex="0" maxlength="35" value="<?php echo $row['party_name'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
	
</tr>
<tr class="Light" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#2e81c1">&nbsp;Address 1&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#2e81c1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtaddress" size="70" maxlength="70" value="<?php echo $row['address'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#2e81c1">&nbsp;Address 2&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#2e81c1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtaddress1" size="70" maxlength="70" value="<?php echo $row['address1'];?>" >&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#2e81c1">&nbsp;City/Town/Village&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#2e81c1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtcity" size="50" maxlength="50" value="<?php echo $row['city'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#2e81c1">&nbsp;Pin&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#2e81c1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtpin" size="6" maxlength="6" value="<?php if($row['pin'] > 0){ echo $row['pin'];} else { echo "";}?>" onkeypress="return isNumberKey(event)" >&nbsp;</td>
</tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#2e81c1">&nbsp;State&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#2e81c1" colspan="3">&nbsp;<select name="txtstate" class="tbltext"  style="width:170px;" tabindex="">
<option value="">--Select State--</option>          
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" <?php if($ro_states['state_name']==$row['state']) echo "selected";?>><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Dark" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#2e81c1">&nbsp;Phone No.&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#2e81c1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtphone" size="15" maxlength="15" value="<?php echo $row['phoneno'];?>" onkeypress="return isNumberKey(event)" >&nbsp;</td>
</tr>
  <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5"><input name="txtmode" type="radio" class="tbltext" value="Applicable" onClick="clkapp(this.value);" <?php if($row['tmode'] != "") { echo "checked"; } ?> />&nbsp;Applicable&nbsp;&nbsp;&nbsp;&nbsp;<input name="txtmode" type="radio" class="tbltext" value="Not Applicable" onClick="clkapp(this.value);" <?php if($row['tmode'] == "") { echo "checked"; } ?> />&nbsp;Not Applicable&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table id="transmode" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="display:<?php if($row['tmode'] != "") { echo "Block"; } else { echo "none";} ?>" > 
<tr class="Dark" height="25">
           <td width="194" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td width="550" colspan="5" align="left"  valign="middle" class="tbltext"><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row['tmode']=="Transport"){ echo "checked"; }?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row['tmode']=="Courier"){ echo "checked"; }?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row['tmode']=="By Hand"){ echo "checked"; }?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
  </table>
<table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="display:<?php if($row['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Light" height="30">
<td align="right" width="194" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" value="<?php echo $row['tname'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="102" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="232" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex="" value="<?php echo $row['lrno'];?>"  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="194" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="212" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row['vno'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:70px;" onchange="clk1(this.value);" >
<option value="" selected="selected">Select</option>
<option <?php if($row['pmode']=="TBB"){ echo "Selected";} ?> value="TBB">TBB</option>
<option <?php if($row['pmode']=="ToPay"){ echo "Selected";} ?> value="ToPay" >To Pay</option>
<option <?php if($row['pmode']=="Paid"){ echo "Selected";} ?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="display:<?php if($row['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Dark" height="30">
<td align="right" width="194" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="212" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['cname'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="102" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="232" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row['dcno'];?>"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="display:<?php if($row['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>" > 
<tr class="Dark" height="30">
<td align="right" width="194" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="550" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row['pname'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<br />

<div id="maindiv" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

			<tr class="tblsubtitle">
			  <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
			  <td width="18%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
			  <td colspan="3" align="center" valign="middle" class="tblheading">Existing</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
			  <td width="5%" align="center" valign="middle" class="tblheading">SLOC</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
                  	<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_discard_sub where did_s=$trid AND plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['variety'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['variety'].",";
	}
	
	$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; $stage="";
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['crop']."'") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);

$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_tblsub['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_tblsub['variety'];
}
/*if($trid > 0)
{*/
$sql_tblissue=mysqli_query($link,"select * from tbl_discard_sloc where discard_trid='".$trid."' and discard_id='".$row_eindent_sub['did']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);



while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tblissue['whid']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tblissue['subbin']."' and binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$row_tblissue['ups_discard'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";


$slqty=$row_tblissue['qty_discard'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$row_tblissue['ups_balance'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";


$balqty=$row_tblissue['qty_balance'];
if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tblissue['discard_rowid']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$row_stldg1=mysqli_fetch_array($sql_stldg1); 

$opups=$row_stldg1['lotldg_balbags'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$row_stldg1['lotldg_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['discard_id'];

if($stage!="")
$stage=$stage.$row_tblissue['sstage']."<br/>";
else
$stage=$row_tblissue['sstage']."<br/>";


}
/*}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $erid=0;
}*/
if($sr%2!=0)
{
?>		  
 <tr class="Light" height="20">
             <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="12%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['cropname'];?></td>
             <td width="18%" align="center" valign="middle" class="tbltext"><?php echo $itemid;?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['lotnumber'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups1;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $opqty1;?></td>
		     <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
             <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $balups1;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty1;?></td>
             <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['did_s'];?>,<?php echo $row_eindent_sub['did'];?>,'DD');" /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />

<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="12%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['cropname'];?></td>
             <td width="18%" align="center" valign="middle" class="tbltext"><?php echo $itemid;?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['lotnumber'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups1;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $opqty1;?></td>
			 <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
             <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $balups1;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty1;?></td>
             <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['did_s'];?>,<?php echo $row_eindent_sub['did'];?>,'DD');" /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<div id="subsubdiv" style="display:block">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>		
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop order by cropname") or die(mysqli_error($link));
?>
<tr class="Dark" height="25">
   <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>
	</td></tr>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
         <tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3" id="vitem" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:170px;" onchange="modetchk24(this.value);" >
<option value="" selected>---Select Variety---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
		 
</table><input name="txtrettype" value="good" type="hidden"><input name="txtrettyp" value="good" type="hidden"> 
<div id="subdiv" style="display:block">	
<div id="subdiv24">
<!--<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">Bags</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">Bags</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">Bags</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
 </table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>--></div>
<input type="hidden" name="maintrid" value="<?php echo $trid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div></div>
</div>	
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Return Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="ret" type="radio" class="tbltext" value="Returnable" onClick="clkret(this.value);" <?php if($row['rettyp']=="Returnable"){ echo "checked"; }?> />&nbsp;Returnable&nbsp;&nbsp;&nbsp;&nbsp;<input name="ret" type="radio" class="tbltext" value="Not Returnable" onClick="clkret(this.value);" <?php if($row['rettyp']=="Not Returnable"){ echo "checked"; }?> />&nbsp;Not Returnable&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row['remarks'];?>" ></td>
</tr>
</table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_discard.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
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
