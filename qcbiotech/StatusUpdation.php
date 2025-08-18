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
		
	if(isset($_POST['txtlot1']))
	{
	$c = $_POST['txtlot1'];	 
	}

	if(isset($_POST['txtcrop']))
	{
	$a = $_POST['txtcrop'];	 
	}
		if(isset($_POST['txtvariety']))
	{
	$b= $_POST['txtvariety'];	 
	}
	
	if(isset($_POST['foccode']))
	{
	$d= $_POST['foccode'];	 
	}
	 $sql_main="update tbl_lot_ldg set lotldg_crop='$a' ,lotldg_variety='$b',lotldg_sstatus='$d'  where lotldg_lotno = '$c'";
  //exit;
mysqli_query($link,$sql_main) or die(mysqli_error($link));

		echo "<script>window.location='StatusUpdation.php'</script>";	
			
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW - Transaction - Status Updation</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading2.js"></script>
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

/*function modetchk(classval) 
{
document.frmaddDepartment.txtlot1.value=""
document.getElementById('subdiv').style.display="block";
showUser(classval,'vitem','item','','','','','');
}*/
function spmchk(val)
{
//alert(val);
		if(document.frmaddDepartment.txtcrop.value=="") 
		{
			alert ("Please Please Select Crop");
			document.frmaddDepartment.txtcrop.focus();
			return false;
		}
		
			if (document.frmaddDepartment.txtlot1.value!="") 
			{
			document.getElementById("vitem1").style.display="block";	 
			var crop=document.frmaddDepartment.txtcrop.value;
			var spf=document.frmaddDepartment.txtvariety.value;
			var lotno=document.frmaddDepartment.txtlot1.value;
			showUser(crop,'vitem1','item1',spf,val,lotno,'','','');
		}}
		
	function modetchk1()
{
document.frmaddDepartment.txtlot1.value=""
}
		

function modetchk(classval)
{
	//alert(classval);
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.txtvariety.value==""
				//document.frmaddDepartment.txt11.selectedIndex=0;
	}


function openslocpop()
{
if(document.frmaddDepartment.txtcrop.value=="")
{
 alert("Please Select Crop.");
 //document.frmaddDepartment.txt1.focus();
}
else
{
//var itm="Condition Seed";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('getuser_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}


function post_value()
{
var cnt=0;
for (var i = 0; i < document.frmaddDepartment.sstatus.length; i++) {          
		 
		  if(document.frmaddDepartment.sstatus[i].checked == true)
			{
				if(document.frmaddDepartment.foccode.value =="")
				{
				document.frmaddDepartment.foccode.value=document.frmaddDepartment.sstatus[i].value;
				//document.from.foccode1.value=document.from.sstatus[i].value;
				}
				else
				{
				document.frmaddDepartment.foccode.value = document.frmaddDepartment.foccode.value +'/'+document.frmaddDepartment.sstatus[i].value;
				//document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.sstatus[i].value;
				}
				cnt++;
			}
			
		}
}

function mySubmit()
{ 
	//alert(document.frmaddDepartment.foccode.value);

	if(document.frmaddDepartment.txtcrop.value=="")
	{
	alert("Please select Crop first");
	document.frmaddDepartment.txtcrop.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtvariety.value=="")
	{
	alert("Please select Variety first");
	document.frmaddDepartment.txtvariety.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
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
           <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Seed Status Updation </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="cnt" value="0" />
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field</td>
</tr>
 <tr class="Light" height="30">
 
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");

	 
?>

<td width="219" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="425" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
 
  </tr>
 
 <tr class="Dark" height="30">
    <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
   <td align="right"  valign="middle" class="tblheading">Lot No. &nbsp;</td>
  <td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" id="smt" type="text" class="tbltext" value="" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
   </tr>
</table>


<div id="vitem1" style="display:none"></div>
<br />
<table cellpadding="5" cellspacing="5" border="0" width="600" align="center">
<tr >
<td align="center" colspan="3"><a href="StatusUpdation.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="post_value();"/></td>
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

  