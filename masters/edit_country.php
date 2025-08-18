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
	}	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
	
		
	if(isset($_REQUEST['c_id']))
	{
	$classification_id = $_REQUEST['c_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$classification=trim($_POST['txtcla']);
		//$main=trim($_POST['txtmain']);
				
		 $query=mysqli_query($link,"SELECT * FROM tblcountry where country='$classification' and c_id!='$classification_id'") or die("Error: " . mysqli_error($link));
		// exit;
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
	  $sql_in="UPDATE tblcountry SET country='$classification' where c_id ='$classification_id'";
		
					//exit;						
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_country.php'</script>";	
		}
	  }	
	}

/*$sql_code="SELECT MAX(`location_code`) FROM tbllocation  ORDER BY `location_code` DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				//$code=sprintf("%004d",$code);
		}
		else
		{
			//$code=sprintf("%004d","0001");
			$code=1;
		}
*/	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration - Country Master -Edit Classification</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
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

function FirstCharCap(charval) {var x=charval.substr(1); var y=charval.charAt(0);var zz=y.toUpperCase(); var cval=zz+x; return cval; }
/*function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode != 32 && charCode != 8 && charCode != 46 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}
*/
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode != 32 && charCode != 8 && charCode != 45  && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 40|| charCode > 41) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}
function f1()
{ 
if(document.frmaddDepartment.txtcla.value!="")
	{
	 if(document.frmaddDepartment.txtcla.value=="India" || document.frmaddDepartment.txtcla.value=="india")
	{
	alert("You cannot add India here. Reason: Exporting to India will not be undertaken");
		document.frmaddDepartment.txtcla.value="";
		document.frmaddDepartment.txtcla.focus();
		}
		}
		}
function mySubmit()
{ 
		
		
		if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Please Enter Country Name ");
	document.frmaddDepartment.txtcla.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtcla.value.charCodeAt() == 32)
	{
	alert("Country name cannot start with space.");
	document.frmaddDepartment.txtcla.focus();
	return false;
	}

	
	if(document.frmaddDepartment.txtcla.value!="")
	{
		if(document.frmaddDepartment.txtcla.value.length <=3)
		{
		alert("Invalid Country");
		document.frmaddDepartment.txtcla.value="";
		document.frmaddDepartment.txtcla.focus();
		return false;
		}
		
	}	
	
	
return true;
}</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">


		  
<!-- actual page start--->	
	  
		   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Country Master - Edit Country</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
   <?php
	 $sql1=mysqli_query($link,"select * from tblcountry where c_id='$classification_id'")or die(mysqli_error($link));
  	$row=mysqli_fetch_array($sql1);
	
	 ?> 
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">&nbsp;Edit Country</td>
</tr>
<tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Light" height="25">
 <td width="291" align="right"  valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td width="289" align="left"  valign="middle">&nbsp;<input name="txtcla" type="text" size="52" class="tbltext" tabindex="0" maxlength="52" value="<?php echo $row['country'];?>"onBlur="javascript:this.value=FirstCharCap(this.value);" onKeyPress="return isCharKey(event)" onChange="f1(this.value);"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>

</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_country.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;
  <input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
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
