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
	
		
	if(isset($_REQUEST['sdate']))
	{
 	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['typ']))
	{
	  $typ = $_REQUEST['typ'];
	}
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order  -Utility Holding Status- Variety</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="party.js"></script>
<script src="../include/validation.js"></script>
 <SCRIPT language="JavaScript">
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




function vartypechk(varval)
{
     var classval=document.frmaddDepartment.txtcrop.value;
		showUser(classval,'vitem','itemuhold',varval,'','','','');

}
function cropchk(val)
{	
if(document.frmaddDepartment.txtvartyp.value=="")
	{
		alert("Please Select Variety Type");
		document.frmaddDepartment.txtvariety.selectedIndex=0;
	}  
	    var vtyp=document.frmaddDepartment.txtvartyp.value;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		document.getElementById("qr").style.display="block";
		 //alert(vtyp);	 
		showUser(crop,'qr','crop1',val,variety,vtyp,'','','');
}
	
function rck(rval)
{
///alert(rval);
document.frmaddDepartment.flagcode.value=rval;
}
function mySubmit()
{ 
	
	/*if(document.frmaddDepartment.flagcode.value=="")
	{
		alert("Select Report Type");
		document.frmaddDepartment.flagcode.focus();
		return false;
	}*/
	
	
return true;
}
function modetchk(classval)
{	
		document.frmaddDepartment.txtvartyp.selectedIndex=0;
		document.frmaddDepartment.txtvariety.selectedIndex=0;
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
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Utility -Variety Search
	        </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="txt11" value="<?php echo $_SESSION['yearid_id'];?>" type="hidden"> 
	 <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>
<?php 
$sdate = $_REQUEST['sdate'];
$typ = $_REQUEST['typ'];
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
/*
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='$typ' and  arrival_date ='$sdate' and arrtrflag=1 order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);*/
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
 
    <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="96" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
    <font color="#FF0000">*</font>&nbsp;</td>
	<td width="131" align="right"  valign="middle" class="tblheading">Select Variety Type&nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtvartyp" style="width:80px;" onchange="vartypechk(this.value)" >
<option value="" selected>--Select--</option>
<option value="Hybrid"/>Hybrid</option> 
<option value="OP" />OP</option>   
</select>
    <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  order by popularname Asc"); 
?>
	<td width="57" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="226" align="left"  valign="middle" class="tbltext" colspan="3"id="vitem" >&nbsp;
      <select class="tbltext"  name="txtvariety" style="width:170px;" onchange="cropchk(this.value)" id="itm">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
	<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  </table>
  <br/>
 <div id="qr" style="display:block"></div> 

 
</td>
<td ></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="utility_hold.php"><img src="../images/back.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" align="middle" /></a>&nbsp;&nbsp;</td>
</tr>
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
