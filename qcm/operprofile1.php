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
	
/*if(isset($_REQUEST['id']))
	{
 $id = $_REQUEST['id'];
	}*/

//$role="operator";
if(isset($_POST['frm_action'])=='submit')
	{
		//$name=trim($_POST['txtname']);
		$login=trim($_POST['txtId']);
		$pass=trim($_POST['txtpass']);
		$email=trim($_POST['txtemail']);
		$question=trim($_POST['txtquestion']);
		$ans=trim($_POST['txtans']);
        $status=trim($_POST['txt1']);
		$scode=trim($_POST['scode']);
		 $department=trim($_POST['department']);
		
	 $sql_in="update tblopr set login='$login',
									pass='$pass',
									email='$email'
									where id='$loginid'";
											//exit;
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		 
         $sql_in1="Update tbluser set	loginid='$login',
										password='$pass',
										email='$email'
										where role='quality' and scode='$scode'";	
				if(mysqli_query($link,$sql_in1)or die(mysqli_error($link)))
		{
		?>
		<script type="text/javascript">
		alert("Profile Updated Successfully!!")
		</script>

		<?php		
		}
			
}
		?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qauality- Transaction-operator Profile</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" src="../include/validation.js"></script>
<script language="javascript" type="text/javascript">
/*function onloadfocus()
	{
	document.frmaddDepartment.txtempfname.focus();
	}*/
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
function onloadfocus()
	{
	document.frmaddDepartment.txtId.focus();
	}
function mySubmit()
{ var n=document.frmaddDepartment.txtemail.value.charAt(0);
	/*if(document.frmaddDepartment.txtname.value=="")
	{
	alert("Please enter Admin  Name");
	document.frmaddDepartment.txtname.focus();
	return false;
	}
	if(document.frmaddDepartment.txtname.value.charCodeAt() == 32)
	{
	alert("Admin  Name cannot start with space.");
	document.frmaddDepartment.txtname.focus();
	return false;
	}*/
	if(document.frmaddDepartment.txtId.value=="")
	{
	alert("Please enter Login ID ");
	document.frmaddDepartment.txtId.focus();
	return false;
	}
	if(document.frmaddDepartment.txtId.value.charCodeAt() == 32)
	{
	alert("Login ID cannot start with space.");
	document.frmaddDepartment.txtId.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtId.value!="")
	{
	if(document.frmaddDepartment.txtId.value.length < 6)
	{
	alert("Login ID cannot be less than 6 characters.");
	document.frmaddDepartment.txtId.focus();
	return false;
	}
	}
	
	if(document.frmaddDepartment.txtpass.value=="")
	{
	alert("Please enter Password ");
	document.frmaddDepartment.txtpass.focus();
	return false;
	}
	if(document.frmaddDepartment.txtpass.value.charCodeAt() == 32)
	{
	alert("Password cannot start with space.");
	document.frmaddDepartment.txtpass.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtpass.value!="")
	{
	if(document.frmaddDepartment.txtpass.value.length < 6)
	{
	alert("Password cannot be less than 6 charecters.");
	document.frmaddDepartment.txtpass.focus();
	return false;
	}
	}
	if(document.frmaddDepartment.txtrepass.value=="")
	{
	alert("Please Retype Password");
	document.frmaddDepartment.txtrepass.focus();
	return false;
	}
	if(document.frmaddDepartment.txtrepass.value != document.frmaddDepartment.txtpass.value)
	{
	alert("Retype Password not matched with Password. Please Enter again");
	document.frmaddDepartment.txtrepass.focus();
	return false;
	}
	if(document.frmaddDepartment.txtemail.value =="")
	{
		alert("Please Enter VNR Email ID");
		document.frmaddDepartment.txtemail.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtemail.value!="")
	{
		
		if (n=="@")
		{
			alert("Please Enter Email ID");
			document.frmaddDepartment.txtemail.focus();
			return false;
		}		
		if (echeck(document.frmaddDepartment.txtemail.value)==false)
		{
			//document.frmaddDepartment.txtemail.value="";
			document.frmaddDepartment.txtemail.focus();
			return false;
		}
		if(!chkemail(document.frmaddDepartment.txtemail.value))
		{
			alert("Please Enter only VNRseeds Email ID");
			document.frmaddDepartment.txtemail.focus();
			return false;
		}
	}
		
	if(document.frmaddDepartment.txtId.value==document.frmaddDepartment.txtpass.value)
		{
		alert("Login Id and Password can not be same");
		document.frmaddDepartment.txtpass.focus();
		return(false);
		}
	/*if(document..txtquestion.value=="")
	{
	alert("Please enter Security Question");
	document.frmaddDepartment.txtquestion.focus();
	return false;
	}
	if(document.frmaddDepartment.txtquestion.value.charCodeAt() == 32)
	{
	alert("Security Question cannot start with space.");
	document.frmaddDepartment.txtquestion.focus();
	return false;
	}
	if(document.frmaddDepartment.txtans.value=="")
	{
	alert("Please enter Security Answer");
	document.frmaddDepartment.txtans.focus();
	return false;
	}
	if(document.frmaddDepartment.txtans.value.charCodeAt() == 32)
	{
	alert("Security Answer cannot start with space.");
	document.frmaddDepartment.txtans.focus();
	return false;
	}*/
	return true;	 
}
</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr>
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
        </tr>
      </table>
	        <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Operator  Profile </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
   
 <?php
	$result=mysqli_query($link,"SELECT * FROM tblopr where id='".$loginid."'")or die(mysqli_error($link)); 
	$row = mysqli_fetch_array($result);

	?>
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="scode" value="<?php echo "OP".$row['code'];?>">
	  <input name="txt11" value="<?php echo $row['status'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><br />

<table align="center" border="0" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704"
 style="border-collapse:collapse" > <tr><td>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#d21704"
 style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle">Operator Profile </td>
</tr>

<tr class="Light" height="25">
<td colspan="2" align="right" class="tblheading" valign="middle"><font color="#FF0000" >* </font>All fields are mandatory&nbsp;</td>
</tr>
<?php 
$result=mysqli_query($link,"SELECT * FROM tblopr where id='".$loginid."'")or die(mysqli_error($link)); 
$row = mysqli_fetch_array($result);
?>
<tr class="Dark"  height="25">
<td  align="right" valign="middle" class="tblheading">Name&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['name'];?>&nbsp;</td>
</tr>	
<?php 
$result1=mysqli_query($link,"SELECT * FROM tbldept where department_id='".$row['department_id']."'")or die(mysqli_error($link)); 
$row0 = mysqli_fetch_array($result1);
$tp1="";
			if($row['department_id'] ==1) { $tp1="Admin";}
			else if($row['department_id'] ==2) { $tp1="Decode";}
		    else if($row['department_id'] ==3) { $tp1="Arrival";}
			else if($row['department_id'] ==4) { $tp1="Rsw";}
			else if($row['department_id'] ==5) { $tp1="Processing";}
			else if($row['department_id'] ==6) { $tp1="Csw";}
			else if($row['department_id'] ==7) { $tp1="Packaging";}
			else if($row['department_id'] ==8) { $tp1="Psw";}
			else if($row['department_id'] ==9) { $tp1="Order Booking";}
			else if($row['department_id'] ==10) { $tp1="Dispatch";}
			else if($row['department_id'] ==11) { $tp1="Quality";}
			else if($row['department_id'] ==12) { $tp1="Sales Return";}
			else if($row['department_id'] ==13) { $tp1="Plant Manager";}
	$lotstat=$tp1;
?>
<tr class="Light"  height="25">
<td   align="right" valign="middle" class="tblheading">Stage</td>
<td width="349" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $lotstat;?></td>
</tr>	
<tr class="Dark"  height="25">
<td  align="right" valign="middle" class="tblheading">&nbsp;Login Id&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtId" type="text" class="tbltext" tabindex="0" value="<?php echo $row['login'];?>" size="25" maxlength="25"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;Min 6 Max 10</td>
</tr>		
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpass" type="password" class="tbltext" tabindex="" value="<?php echo $row['pass'];?>" size="25" maxlength="15"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;Min 6 Max 10</td>
</tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Retype Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtrepass" type="password" class="tbltext" tabindex="" value="<?php echo $row['pass'];?>" size="25" maxlength="15"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;Min 6 Max 10</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">VNR&nbsp;&nbsp;E-mail&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="" name="txtemail" type="text" size="40" maxlength="40" class="tbltext" value="<?php echo $row['email'];?>"/>&nbsp;<font color="#FF0000" >* </font></td>
</tr>	
<?php
$quer24=mysqli_query($link,"SELECT * FROM tbldestination where did='".$row['did']."' order by dest"); 
$noticia24=mysqli_fetch_array($quer24);
if($role=="plant")
{
?>	
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Plant Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia24['dest'];?></td>
</tr>
<?php
}
?>
</table></td></tr>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="varifiermaster_home.php"></a>&nbsp;&nbsp;
  <input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:pointer;"></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	<!--<table cellpadding="5" cellspacing="5" align="center">
<tr><td class="smalltext1"><br /><br /><br /><br /><br /><br />Sorry ,Currently No Record is Present.<br /><br /><br /><br /></td></tr>
</table>  -->
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
