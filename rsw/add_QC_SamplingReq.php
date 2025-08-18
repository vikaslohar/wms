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
		
		$sql_main="insert into tbl_rsw_main (year_code, arr_code, arrival_date, arr_role, plantcode)values('$yearid_id', '$txtid', '$tdate1', '$logid', '$plantcode')";
		if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
		{
			$mainid=mysqli_insert_id($link);
			$p_id=$mainid;
			$pl=explode(",", $txtlot1);
			foreach($pl as $val)
			{
				if($val<>"")
				{
					$sql_sub="insert into tbl_rsw (crop, variety, pp, moist, gemp, got, arr_role, lotno , arrival_id, arrival_date, arr_code, plantcode) values ('$txtcrop', '$txtvariety', '$chk1', '$chk2', '$chk3', '$chk4', '$logid', '$val', '$p_id', '$tdate1', '$dotage', '$plantcode')";
					mysqli_query($link,$sql_sub) or die(mysqli_error($link));
				}
			}
		}
		
		echo "<script>window.location='add_qcsmp_preview.php?cropid=$p_id&txtvariety=$txtvariety&txtcrop=$txtcrop'</script>";	
			
	}


	$sql_code="SELECT MAX(arr_code) FROM tbl_rsw_main WHERE plantcode='$plantcode' ORDER BY arr_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TRQ".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TRQ".$code."/".$yearid_id."/".$lgnid;
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
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="sstage" value="Raw" type="hidden"> 
	 <input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input type="hidden" name="txtlot1" value="" />
		</br>
<?php
$tid=0; $subtid=0;
?>
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
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

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
/*$quer3=mysqli_fetch_array($quer3);
		$quer3=$row_cls['cropname'];
*/	
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

 <tr class="Light" height="30" id="vitem">
<td align="right"  valign="middle" class="tblheading">Duration since last QC test&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="dotage" id="dotage" style="width:130px;" onchange="showlots(this.value)" >
    <option value="" selected>-Select-</option>
  	<option value="30" >More than 30 days</option>
	<option value="45" >More than 45 days</option>
	<option value="90" >More than 90 days</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
  <td align="right"  valign="middle" class="tblheading">&nbsp;Select QC Tests&nbsp;</td>
  <td  align="left"  valign="middle" class="tbltext" ><input name="txt1" type="checkbox" class="tbltext" tabindex="0" readonly="true" value="P" onclick="clk(this.value);"/>PP   
   &nbsp;
  <input name="txt12" type="checkbox" class="tbltext" tabindex="0" readonly="true" value="M" onclick="clk(this.value);"/>  
    Moisture  
    &nbsp;
    <input name="txt14" type="checkbox" checked="checked" class="tbltext" tabindex="0" readonly="true" value="G" onclick="clk(this.value);"/>
    Germination 
    &nbsp;
    <!--<input name="txt16" type="checkbox" class="tbltext" tabindex="0" readonly="true" value="T" onclick="clk(this.value);" />
GOT <font color="#FF0000">*</font>&nbsp;--></td>
</tr>

</table>
<div id="maindiv" style="display:block">
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

  