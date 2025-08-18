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

	
	if(isset($_REQUEST['cropid']))
	{
		$pid = $_REQUEST['cropid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
	   	$date=trim($_POST['date']);
		$txtid=trim($_POST['txtid']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$dotage=trim($_POST['dotage']);
		$txtlot1=trim($_POST['txtlot1']);
		$chk=trim($_POST['chk']);
		$chk1=trim($_POST['chk1']);
		$chk2=trim($_POST['chk2']);
		$chk3=trim($_POST['chk3']);
		$chk4=trim($_POST['chk4']);
		$sstage=trim($_POST['sstage']);
		
		//$remarks=str_replace("&","and",$remarks);
		
		$tdate11=$date;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
		
		$p_id=$pid;
		$s_sub="delete from tbl_rsw where arrival_id='".$pid."'";
		mysqli_query($link,$s_sub) or die(mysqli_error($link));
			
		$pl=explode(",", $txtlot1);
		foreach($pl as $val)
		{
			if($val<>"")
			{
				$sql_sub="insert into tbl_rsw (crop, variety, pp, moist, gemp, got, arr_role, lotno , arrival_id, arrival_date, arr_code, plantcode) values ('$txtcrop', '$txtvariety', '$chk1', '$chk2', '$chk3', '$chk4', '$logid', '$val', '$p_id', '$tdate1', '$dotage', '$plantcode')";
				mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			}
		}
		
		echo "<script>window.location='add_qcsmp_preview.php?cropid=$p_id&txtvariety=$txtvariety&txtcrop=$txtcrop'</script>";	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW - Transaction - QC sampling</title>
<link href="../include/main_rsw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
</head>
<script src="qcsamp.js"></script>
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

function pform()
{	
	
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
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
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}

	if(document.frmaddDepartment.chk3.value=="")
	{
			alert("Please Select Qc Test Type ");
			f=1;
			return false;
	}
	/*if(document.frmaddDepartment.chk1.value=="" && document.frmaddDepartment.chk2.value=="" && document.frmaddDepartment.chk3.value=="")
	{
			alert("Please Select Qc Type ");
			f=1;
			return false;
	}*/
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mform','','','','','');
		
		}  
	}
//}

function pformedtup()
{	
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
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
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.chk3.value=="")
	{
			alert("Please Select Qc Test Type ");
			f=1;
			return false;
	}
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','');
		//alert(a);
		}
	}
//}

function modetchk(classval)
{
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.dotage.value="";
	document.getElementById('maindiv').innerHTML="";
}
function modetchk1(classval)
{
	document.frmaddDepartment.dotage.value="";
	document.getElementById('maindiv').innerHTML="";
}
function openslocpop()
{
if(document.frmaddDepartment.txtcrop.value=="")
{
 alert("Please Select Crop.");
document.frmaddDepartment.txtcrop.focus();
}
else if(document.frmaddDepartment.txtvariety.value=="")
{
alert("Please Select Variety first.");
document.frmaddDepartment.txtvariety.focus();
}
else if(document.frmaddDepartment.dotage.value=="")
{
alert("Please Select Duration since last QC test.");
document.frmaddDepartment.dotage.focus();
}
else
{
//var itm="Raw Seed";
document.getElementById('maindiv').innerHTML="";
document.frmaddDepartment.txtlot1.value="";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var trid=document.frmaddDepartment.maintrid.value;
var dotage=document.frmaddDepartment.dotage.value;
winHandle=window.open('getuser_qcsamp_lotno.php?crop='+crop+'&variety='+variety+'&trid='+trid+'&dotage='+dotage,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
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
var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
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
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.chk3.value=="")
	{
			alert("Please Select Qc Test Type ");
			f=1;
			return false;
	}
	
	document.frmaddDepartment.txtlot1.value="";
	if(document.frmaddDepartment.srn.value > 1)
	{
		if(document.frmaddDepartment.srn.value <= 2)
		{
			if(document.frmaddDepartment.fet.checked == true)
			{  
				if(document.frmaddDepartment.txtlot1.value =="")
				{
					document.frmaddDepartment.txtlot1.value=document.frmaddDepartment.fet.value;
				}
				else
				{
					document.frmaddDepartment.txtlot1.value = document.frmaddDepartment.txtlot1.value +','+document.frmaddDepartment.fet.value;
				}
			}
		}
		else
		{ 
			for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
			{          
				if(document.frmaddDepartment.fet[i].checked == true)
				{ 
					if(document.frmaddDepartment.txtlot1.value =="")
					{
						document.frmaddDepartment.txtlot1.value=document.frmaddDepartment.fet[i].value;
					}
					else
					{
						document.frmaddDepartment.txtlot1.value = document.frmaddDepartment.txtlot1.value +','+document.frmaddDepartment.fet[i].value;
					}
				}
			}
		}
	}
	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	//alert(document.frmaddDepartment.txtlot1.value);
	if(f==1)
	{
		return false;
	}
	else
	{	
		return true;
	}	 
}

function clk(cval)
{
//alert(document.frmaddDepartment.txt1.checked);
	if(document.frmaddDepartment.txt1.checked==true) 
	{
		document.frmaddDepartment.chk1.value=document.frmaddDepartment.txt1.value;
	}
	else
	{
		document.frmaddDepartment.chk1.value="";
	}
	
	if(document.frmaddDepartment.txt12.checked==true)
	{
		document.frmaddDepartment.chk2.value=document.frmaddDepartment.txt12.value;
	}
	else
	{
		document.frmaddDepartment.chk2.value="";
	}
	
	if(document.frmaddDepartment.txt14.checked==true)
	{
		document.frmaddDepartment.chk3.value=document.frmaddDepartment.txt14.value;
	}
	else
	{
		document.frmaddDepartment.txt14.checked=true;
		document.frmaddDepartment.chk3.value="G";
	}
	
	/*if(document.frmaddDepartment.txt16.checked==true)
	{
		document.frmaddDepartment.chk4.value=document.frmaddDepartment.txt16.value;
	}
	else
	{
		document.frmaddDepartment.chk4.value="";
	}*/
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

function showlots()
{
	document.getElementById('maindiv').innerHTML="";
	var crop=document.frmaddDepartment.txtcrop.value;
    var variety=document.frmaddDepartment.txtvariety.value;					
	var stage="Raw";
	//var lotid=document.frmaddDepartment.txtlot1.value;
	var dotage=document.frmaddDepartment.dotage.value;
	showUser(crop,'maindiv','get',variety,stage,dotage,dotage,'','');
}

function chkall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		document.frmaddDepartment.fet[i].checked=true;
	} 
}

function clall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		document.frmaddDepartment.fet[i].checked=false;
	} 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_rsw.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/csw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" style="border-bottom:solid; border-bottom-color:#e48324" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - QC Sampling Request </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php 
  $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_rsw_main where arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbll=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);				
$arrival_id=$row_tbll['arrival_id'];

	$tdate=$row_tbll['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
$sql_tbl_sub2=mysqli_query($link,"select * from tbl_rsw where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub2);
$sql_tbl_sub=mysqli_query($link,"select * from tbl_rsw where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);

 $arrival_id=$row_tbl_sub['arrival_id'];
$subtid=0;
?>	 	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="sstage" value="Raw" type="hidden"> 
	 <input type="hidden" name="txtid" value="<?php echo $row_tbl['arr_code']?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input type="hidden" name="txtlot1" value="" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">QC  Sampling Request </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRQ".$row_tbll['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date of&nbsp;Sampling&nbsp;Request&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Stage&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;Raw </td>

</tr>

</table>

<br />
<div id="postingtable" style="display:block">
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Dark" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <? if($noticia['cropid']==$row_tbl_sub['crop']){ echo "Selected";} ?>  value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
<?php
$sql_month=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl_sub['crop']."' and actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option <? if($noticia_item['varietyid']==$row_tbl_sub['variety']){ echo "Selected";} ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

 <tr class="Light" height="30" id="vitem">
<td align="right"  valign="middle" class="tblheading">Duration since last QC test&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="dotage" id="dotage" style="width:130px;" onchange="showlots(this.value)" >
    <option value="" selected>-Select-</option>
  	<option <? if($row_tbl_sub['arr_code']=="30"){ echo "Selected";} ?> value="30" >More than 30 days</option>
	<option <? if($row_tbl_sub['arr_code']=="45"){ echo "Selected";} ?> value="45" >More than 45 days</option>
	<option <? if($row_tbl_sub['arr_code']=="90"){ echo "Selected";} ?> value="90" >More than 90 days</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
  <td align="right"  valign="middle" class="tblheading">&nbsp;Select QC Tests&nbsp;</td>
  <td  align="left"  valign="middle" class="tbltext" ><input name="txt1" type="checkbox" class="tbltext" tabindex="0" readonly="true" value="P" onclick="clk(this.value);" <?php if($row_tbl_sub['pp']=="P"){ echo "checked";}  ?> />PP   
   &nbsp;
  <input name="txt12" type="checkbox" class="tbltext" tabindex="0" readonly="true" value="M" onclick="clk(this.value);" <?php if($row_tbl_sub['moist']=="M"){ echo "checked";}  ?>/>  
    Moisture  
    &nbsp;
    <input name="txt14" type="checkbox" checked="checked" class="tbltext" tabindex="0" readonly="true" value="G" onclick="clk(this.value);" <?php if($row_tbl_sub['gemp']=="G"){ echo "checked";}  ?>  />
    Germination 
    &nbsp;
    <!--<input name="txt16" type="checkbox" class="tbltext" tabindex="0" readonly="true" value="T" onclick="clk(this.value);" />
GOT <font color="#FF0000">*</font>&nbsp;--></td>
</tr>

</table>
<div id="maindiv" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="4" align="center" class="tblheading">List of Lots</td>
</tr>
</table>		   
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td width="30" align="center" valign="middle" class="tblheading">#</td>
<td width="146" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="76" align="center" valign="middle" class="tblheading">QC Status</td>
<td width="107" align="center" valign="middle" class="tblheading">DoT</td>
<td width="107" align="center" valign="middle" class="tblheading">Days since DoT</td>
<td width="118" align="center" valign="middle" class="tblheading">NoB</td>
<td width="100" align="center" valign="middle" class="tblheading">Qty</td>
<td width="100" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="chkall()">CA</a>  |  <a href="Javascript:void(0);" onclick="clall()">CL</a></td>
</tr>

<?php
$srn=1; $totalups=0; $totalqty=0; $cnt=0;
$dotage=$row_tbl_sub['arr_code'];
$sql_m=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$row_tbl_sub['crop']."' and lotldg_variety='".$row_tbl_sub['variety']."' and lotldg_sstage='Raw' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_m=mysqli_num_rows($sql_m);
if($tot_m > 0)
{
while($row_m=mysqli_fetch_array($sql_m))
{
$val=$row_m['lotldg_lotno'];
$vflg=0;
$rtotalups=0; $rtotalqty=0; $qc=""; $got=""; $blends_sstatus="";
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row_tbl_sub['crop']."' and lotldg_variety='".$row_tbl_sub['variety']."' and lotldg_sstage='Raw' and lotldg_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
$trtr=mysqli_num_rows($sql_issue);
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$row_tbl_sub['variety']."' and lotldg_sstage='Raw'  and lotldg_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 

$qc=$row_issuetbl['lotldg_qc']; 
$got123=explode(" ",$row_issuetbl['lotldg_got1']); 
$got=$got123[0]." ".$row_issuetbl['lotldg_got']; 
$rtotalups=$rtotalups+$row_issuetbl['lotldg_balbags'];
$rtotalqty=$rtotalqty+$row_issuetbl['lotldg_balqty'];


$trdate=$row_issuetbl['lotldg_qctestdate'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$dot=$trday."-".$trmonth."-".$tryear;
if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
if($dot=="00-00-0000" || $dot=="--")$dot="";
}
}
$trdate240=date("Y-m-d");
$flg=0;
if($dotage!="" && $dotage=="30")
{
	$dt=30;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else if($dotage!="" && $dotage=="45")
{
	$dt=45;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else if($dotage!="" && $dotage=="90")
{
	$dt=90;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else
{
}
//echo $trdate."  =  ".$trdate240."<br />";	
$diff = abs(strtotime($trdate240) - strtotime($trdate));
$days = floor($diff / (60*60*24));
$days=$days;

if($days <= $dotage)
{
$vflg++;
}
if($flg>0)
{
//$vflg++;
}

if($qc!="OK")
{
$vflg++;
}

if($rtotalqty<=0)
{
$vflg++;
}

if($vflg==0)
{
$ltchk=0;
$sqltblsub=mysqli_query($link,"select * from tbl_rsw where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($subtbltot2=mysqli_fetch_array($sqltblsub))
{
if($subtbltot2['lotno']==$val)$ltchk++;
}

$totalups=$totalups+$rtotalups;
$totalqty=$totalqty+$rtotalqty;

$cnt++;
if($srn%2!=0)
{
?>  
  <tr class="Light" height="30">
<td align="center" valign="middle" class="tblheading"><?php echo $srn;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="lotno_<?php echo $srn;?>" name="lotno_<?php echo $srn;?>" value="<?php echo $val;?>" /><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="qcst_<?php echo $srn;?>" name="qcst_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $qc;?>" size="10" /><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dot_<?php echo $srn;?>" name="dot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dot;?>" size="10" /><?php echo $dot;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dsdot_<?php echo $srn;?>" name="dsdot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $days;?>" size="10" /><?php echo $days;?> Days</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><input type="hidden" id="upsavl_<?php echo $srn;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalups;?>" size="9" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?><input type="hidden" id="qtyavl_<?php echo $srn;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalqty;?>" size="10" /></td>
<td align="center" valign="middle" class="tblheading"><input type="checkbox" name="fet" id="foc_"<?php echo $srn;?> value="<?php echo $val;?>" <?php if($ltchk > 0) echo "checked";?> /></td>
  </tr>
<?php
}
else
{
?>
  <tr class="Light" height="30">
<td align="center" valign="middle" class="tblheading"><?php echo $srn;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="lotno_<?php echo $srn;?>" name="lotno_<?php echo $srn;?>" value="<?php echo $val;?>" /><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="qcst_<?php echo $srn;?>" name="qcst_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $qc;?>" size="10" /><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dot_<?php echo $srn;?>" name="dot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dot;?>" size="10" /><?php echo $dot;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="dsdot_<?php echo $srn;?>" name="dsdot_<?php echo $srn;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $days;?>" size="10" /><?php echo $days;?> Days</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><input type="hidden" id="upsavl_<?php echo $srn;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalups;?>" size="9" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?><input type="hidden" id="qtyavl_<?php echo $srn;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalqty;?>" size="10" /></td>
<td align="center" valign="middle" class="tblheading"><input type="checkbox" name="fet" id="foc_"<?php echo $srn;?> value="<?php echo $val;?>" <?php if($ltchk > 0) echo "checked";?> /></td>
  </tr>
<?php
}
$srn++;
}
}
}

?>
<?php if($cnt > 0){ ?>
<tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totalups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
<td align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="chkall()">CA</a>  |  <a href="Javascript:void(0);" onclick="clall()">CL</a></td>
  </tr>
<?php } ?> 
<input type="hidden" name="srn" value="<?php echo $srn;?>" /> 
</table>
<?php if($cnt > 0){ ?>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
<?php } ?>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="chk" value="" />
<input type="hidden" name="chk1" value="" />
<input type="hidden" name="chk2" value="" />
<input type="hidden" name="chk3" value="G" />
<input type="hidden" name="chk4" value="" />
</div>
</div>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_qc.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;</td>
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

  