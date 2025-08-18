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
if(isset($_REQUEST['id']))
	{
	$id = $_REQUEST['id'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{
		//$name=trim($_POST['txtname']);
		
		
		$cname=trim($_POST['txtcname']);
		$address=trim($_POST['txtadd']);
		$ccity=trim($_POST['ccity']);
		$cpin=trim($_POST['cpin']);
		$cstate=trim($_POST['cstate']);
		$cphno=trim($_POST['cphno']);
		$cphno1=trim($_POST['cphno1']);
		$plant=trim($_POST['txtplant']);
		$pcity=trim($_POST['pcity']);
		$ppin=trim($_POST['ppin']);
		$pstate=trim($_POST['pstate']);
		$pphno=trim($_POST['pphno']);
		$pphno1=trim($_POST['pphno1']);
		$pstd=trim($_POST['pstd']);
        $cstd=trim($_POST['cstd']);
		$licenceno=trim($_POST['txtlcn']);
		$tin=trim($_POST['txttin']);
		$cst=trim($_POST['txtcstno']);
		$sloc=trim($_POST['txtloc']);
		$code=trim($_POST['txtcode']);
		$parentimage1=trim($_FILES['brouse']['name']);
		
		 if($parentimage1<>"")
		{
		$imagepath1="../help/".$parentimage1;
		copy($_FILES['brouse']['tmp_name'],$imagepath1);
		$str="update tbl_parameters set logo='$imagepath1' where id='$id'";
		$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
		}
		  $sql_in="UPDATE  tbl_parameters SET
										    company_name='$cname',
											address='$address',
											ccity='$ccity',
											cphone='$cphno',
											cphone1='$cphno1',
											cstate='$cstate',
											cpin='$cpin',
											cstd='$cstd',
											pstd='$pstd',
											plant='$plant',
											pcity='$pcity',
											pphone='$pphno',
											pphone1='$pphno1',
											pstate='$pstate',
											ppin='$ppin',
											licence_no='$licenceno',
											gstin='$tin',
										    cin='$cst',
											sloc='$sloc',
											code='$code'
										    where id='$id'";
											//exit;
											
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{		
			echo "<script>window.location='companyhome.php'</script>";	
		}
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration - Parameter Master -Edit Parameter</title>
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
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  
function onloadfocus()
	{
	document.frmaddDept.txtcname.focus();
	}
   function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }	

function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}
	function mySubmit()
{ 
	if(document.frmaddDept.txtcname.value=="")
	{
	alert("Define Company Name ");
	document.frmaddDept.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDept.txtcname.value.charCodeAt() == 32)
	{
	alert("Company Name cannot start with space.");
	document.frmaddDept.txtcname.focus();
	return false;
	}
	
	
	
	
	if(document.frmaddDept.txt.value!="")
	{
	if(document.frmaddDept.brouse.value!="")
	{
	alert("Attach company logo.");
	document.frmaddDept.brouse.focus();
	return false;
	}
	}		
	if(document.frmaddDept.txtadd.value=="")
	{
	alert("Define Address. ");
	document.frmaddDept.txtadd.focus();
	return false;
	}
	if(document.frmaddDept.txtadd.value.charCodeAt() == 32)
	{
	alert("Address  cannot start with space.");
	document.frmaddDept.txtadd.focus();
	return false;
	}
	
	if(document.frmaddDept.ccity.value=="")
	{
		alert("Enter City/town/village");
		document.frmaddDept.ccity.focus();
		return false;
	}
	
	if(document.frmaddDept.ccity.value.charCodeAt() == 32)
	{
		alert("City cannot start with space.");
		document.frmaddDept.ccity.focus();
		return false;
	}
	
	if(document.frmaddDept.cpin.value=="")
	{
		alert("Please enter Pin Code");
		document.frmaddDept.cpin.focus();
		return false;
	}
	if(document.frmaddDept.cpin.value.charCodeAt() == 32)
	{
		alert("pin cannot start with space.");
		document.frmaddDept.cpin.focus();
		return false;
	}
	if(document.frmaddDept.cpin.value.length < 6 )
		{
			alert("Pin Code can not less than six digits");
			document.frmaddDept.cpin.focus();
			return(false);
		}
	
		
   if(document.frmaddDept.cstate.value=="")
	{
		alert("Select State");
		document.frmaddDept.cstate.focus();
		return false;
	}
	
	 if(document.frmaddDept.cstate.value=="")
	{
		alert("Select State");
		document.frmaddDept.cstate.focus();
		return false;
	}
	
	if(document.frmaddDept.cstd.value=="")
	{
	alert("Please enter STD Code");
	document.frmaddDept.cstd.focus();
	return false;
	}
	
	/*if(document.frmaddDept.cstd.value!="")
	{
		if(!isNumeric(document.frmaddDept.cstd.value))
		{
			alert("STD Code Allows Only Numeric value");
			document.frmaddDept.cstd.focus();
			return(false);
		}
	}*/
	if(document.frmaddDept.cphno.value=="")
	{
	alert("Please enter Phone Number");
	document.frmaddDept.cphno.focus();
	return false;
	}
		
	if(document.frmaddDept.cphno.value!="")
	{
		if(isNaN(document.frmaddDept.cphno.value))
		{
			alert("Phone Number Allows Only Numeric value");
			document.frmaddDept.cphno.focus();
			return(false);
		}
	}
	if(document.frmaddDept.txtplant.value=="")
	{
	alert("Define  Plant Address. ");
	document.frmaddDept.txtplant.focus();
	return false;
	}
	if(document.frmaddDept.txtplant.value.charCodeAt() == 32)
	{
	alert(" Plant Address  cannot start with space.");
	document.frmaddDept.txtplant.focus();
	return false;
	}
	
	if(document.frmaddDept.pcity.value=="")
	{
		alert("Enter City/town/village");
		document.frmaddDept.pcity.focus();
		return false;
	}
	
	if(document.frmaddDept.pcity.value.charCodeAt() == 32)
	{
		alert("City cannot start with space.");
		document.frmaddDept.pcity.focus();
		return false;
	}
	if(document.frmaddDept.ppin.value=="")
	{
		alert("Please enter Pin Code");
		document.frmaddDept.ppin.focus();
		return false;
	}
	if(document.frmaddDept.ppin.value.charCodeAt() == 32)
	{
		alert("pin cannot start with space.");
		document.frmaddDept.ppin.focus();
		return false;
	}
	if(document.frmaddDept.ppin.value.length < 6 )
		{
			alert("Pin Code can not less than six digits");
			document.frmaddDept.ppin.focus();
			return(false);
		}
		
	   if(document.frmaddDept.pstate.value=="")
	{
		alert("Select State");
		document.frmaddDept.pstate.focus();
		return false;
	}
	
	
	if(document.frmaddDept.cstd.value=="")
	{
	alert("Please enter STD Code");
	document.frmaddDept.cstd.focus();
	return false;
	}
	
	/*if(document.frmaddDept.cstd.value!="")
	{
		if(!isNumeric(document.frmaddDept.cstd.value))
		{
			alert("STD Code Allows Only Numeric value");
			document.frmaddDept.cstd.focus();
			return(false);
		}
	}*/
	
	if(document.frmaddDept.pphno.value=="")
	{
	alert("Please enter Phone Number");
	document.frmaddDept.pphno.focus();
	return false;
	}
		
	/*if(document.frmaddDept.pphno.value!="")
	{
		if(isNaN(document.frmaddDept.pphno.value))
		{
			alert("Phone Number Allows Only Numeric value");
			document.frmaddDept.pphno.focus();
			return(false);
		}
	}*/
	if(document.frmaddDept.txtloc.value=="")
	{
	alert("Please Enter Seed Application Location");
	document.frmaddDept.txtloc.focus();
	return false;
	}
	if(document.frmaddDept.txtcode.value=="")
	{
	alert("Please Enter Plant code");
	document.frmaddDept.txtcode.focus();
	return false;
	}
	if(document.frmaddDept.txtcode.value!="")
{
var txtVal = document.frmaddDept.txtcode.value;
for(var i = 0;i<document.frmaddDept.txtcode.value.length; i++)
{
if(txtVal.charAt(i) < 'A' || txtVal.charAt(i) > 'Z' && txtVal.charAt(i) <'a' || txtVal.charAt(i)>'z' )
{
alert("Invalid Name Enter only Alphabets.");
document.frmaddDept.txtcode.focus();
return false;
}
}
}


	if(document.frmaddDept.txtlcn.value=="")
	{
	alert("Define seed license number. ");
	document.frmaddDept.txtlcn.focus();
	return false;
	}
	if(document.frmaddDept.txtlcn.value.charCodeAt() == 32)
	{
	alert("Seed Licence No cannot start with space.");
	document.frmaddDept.txtlcn.focus();
	return false;
	}
	
	if(document.frmaddDept.txttin.value=="")
	{
	alert("Define TIN number. ");
	document.frmaddDept.txttin.focus();
	return false;
	}
	if(document.frmaddDept.txttin.value.charCodeAt() == 32)
	{
	alert("Tin cannot start with space.");
	document.frmaddDept.txttin.focus();
	return false;
	}
	
	if(document.frmaddDept.txtcstno.value=="")
	{
	alert("Define Cst.");
	document.frmaddDept.txtcstno.focus();
	return false;
	}
	if(document.frmaddDept.txtcstno.value.charCodeAt() == 32)
	{
	alert("Cst cannot start with space.");
	document.frmaddDept.txtcstno.value.focus();
	return false;
	}
			
return true;
}
</SCRIPT>


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
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">			  
<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Parameters  Master - Edit </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  <form name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" > 
	 <input name="frm_action" value="submit" type="hidden">
	  <input name="txt" value="" type="hidden"> 
	  <br />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="640" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Edit  Parameters </td>
</tr>
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
 <?php
$sql_qry=mysqli_query($link," select * from tbl_parameters where id='$id'")or die("Error".mysqli_error($link));
$row_qry=mysqli_fetch_array($sql_qry);
//$total=mysqli_num_rows($sql_qry);
 
?>
<tr class="Light" height="25">
<td width="184"  align="right"  valign="middle" class="tblheading">Company Name&nbsp;</td>
<td width="450" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="30" class="tbltext" tabindex="0" maxlength="30" value="<?php echo $row_qry['company_name'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
  
 <?php
//$row=mysqli_query($link,"SELECT * FROM tbl_parameters  where id='".$id."'")or die(mysqli_error($link)); 
?>
<tr class="Dark" height="25">
<td width="184"  align="right"  valign="middle" class="tblheading">Company Logo&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<img src="<?php echo $row_qry['logo']; ?>" width="57" align="middle"><br/>&nbsp;<input name="brouse" class="tbltext" type="file" size="40" onChange="f1(this.value);"/>&nbsp;<font color="#FF0000">*</font></td></tr>
<tr class="Light" height="25">
<td width="184"  align="right"  valign="middle" class="tblheading">Office Address &nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<textarea name="txtadd" cols="20" rows="5" tabindex=""  onChange="f2(this.value);" class="tbltext"><?php echo $row_qry['address'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
 <tr class="Dark" height="30">
   <td width="184"  align="right"  valign="middle" class="tblheading">Office&nbsp;City/Town/Village&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="ccity" type="text" size="25" class="tbltext" tabindex="" maxlength="25"   value="<?php echo $row_qry['ccity'];?>" onChange="f3(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Light" height="30">
   <td width="184"  align="right"  valign="middle" class="tblheading">&nbsp;Pin Code&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="cpin" type="text" size="5" class="tbltext" tabindex="" maxlength="6" value="<?php echo $row_qry['cpin'];?>" onKeyPress="return isNumberKey(event)"  onChange="f4(this.value);"/> &nbsp;<font color="#FF0000">*</font>
     </td>
  </tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
  <tr class="Dark" height="25">
    <td width="184"  align="right"  valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<select name="cstate" class="tbltext"  style="width:170px;" tabindex="" onChange="f5(this.value);">
	<option value="">--Select State--</option>
 <?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" <?php if($ro_states['state_name']==$row_qry['cstate']) echo "selected";?>><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Light" height="30">
    <td width="184"  align="right"  valign="middle" class="tblheading"> Office &nbsp;Phone Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="cstd" type="text" size="4" class="tbltext" tabindex="" maxlength="5" value="<?php echo $row_qry['cstd'];?>" onKeyPress="return isNumberKey(event)"/>&nbsp;&nbsp;<input name="cphno" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_qry['cphone'];?>" onKeyPress="return isNumberKey(event)" onChange="f6(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<font class="tblheading" style="text-align:center; vertical-align:middle">Additional</font>&nbsp;&nbsp;&nbsp;
      <input name="cphno1" type="text" size="10" class="tbltext" tabindex="" maxlength="10" value="<?php echo $row_qry['cphone1'];?>" /></td>
  </tr>
<tr class="Dark" height="25">
<td width="184"  align="right"  valign="middle" class="tblheading"> Plant Address &nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<textarea name="txtplant" cols="20" rows="5" tabindex=""  onChange="f7(this.value);" class="tbltext"><?php echo $row_qry['plant'];?></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
 <tr class="Light" height="30">
    <td width="184"  align="right"  valign="middle" class="tblheading">Plant&nbsp;City/Town/Village&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="pcity" type="text" size="25" class="tbltext" tabindex="" maxlength="25"   value="<?php echo $row_qry['pcity'];?>" onChange="f8(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Dark" height="30">
    <td width="184"  align="right"  valign="middle" class="tblheading">&nbsp;Pin Code&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="ppin" type="text" size="5" class="tbltext" tabindex="" maxlength="6" value="<?php echo $row_qry['ppin'];?>" onKeyPress="return isNumberKey(event)" onChange="f9(this.value);"/>&nbsp;<font color="#FF0000">*</font>
     </td>
  </tr>
<?php
$sq_states2=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states2=mysqli_num_rows($sq_states2);
?>  
  <tr class="Light" height="25">
    <td width="184"  align="right"  valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<select name="pstate" class="tbltext"  style="width:170px;" tabindex="" onChange="f10(this.value);">
	<option value="">--Select State--</option>
<?php while($ro_states2=mysqli_fetch_array($sq_states2)) {?>
    <option value="<?php echo $ro_states2['state_name'];?>" <?php if($ro_states2['state_name']==$row_qry['pstate']) echo "selected";?>><?php echo $ro_states2['state_name'];?></option>
<?php } ?>  
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Dark" height="30">
   <td width="184"  align="right"  valign="middle" class="tblheading">Plant &nbsp;Phone Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="pstd" type="text" size="4" class="tbltext" tabindex="" maxlength="5" value="<?php echo $row_qry['pstd'];?>" onKeyPress="return isNumberKey(event)"/>&nbsp;&nbsp;<input name="pphno" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_qry['pphone'];?>" onKeyPress="return isNumberKey(event)" onChange="f11(this.value);"/>
    &nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<font class="tblheading" style="text-align:center; vertical-align:middle">Additional</font>&nbsp;&nbsp;
    <input name="pphno1" type="text" size="10" class="tbltext" tabindex="" maxlength="10" value="<?php echo $row_qry['pphone1'];?>" /></td>
  </tr>
  <tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Seedtrac Application Location &nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtloc" type="text" size="26" class="tbltext" tabindex="0" maxlength="25"   value="<?php echo $row_qry['sloc'];?>"/>&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
<tr class="Light" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Plant Code&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtcode" type="text" size="1" class="tbltext" tabindex="0" maxlength="1" onBlur="javascript:this.value=this.value.toUpperCase();"  value="<?php echo $row_qry['code'];?>" onKeyPress="return isCharKey(event)"/>&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
 <tr class="Light" height="20">
<td width="184"  align="right"  valign="middle" class="tblheading">Seed License No.&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlcn" type="text" size="40" class="tbltext" tabindex="0" maxlength="40" value="<?php echo $row_qry['licence_no'];?>" onChange="f12(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>

<tr class="Dark" height="25">
<td width="184"  align="right"  valign="middle" class="tblheading">PAN&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtpan" type="text" size="10" class="tbltext" tabindex="0" maxlength="10" value="<?php echo $row_qry['panno'];?>" onChange="f13(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>

<tr class="Dark" height="25">
<td width="184"  align="right"  valign="middle" class="tblheading">GSTIN&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txttin" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" value="<?php echo $row_qry['gstin'];?>" onChange="f13(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
 
 <tr class="Light" height="25">
<td width="184"  align="right"  valign="middle" class="tblheading">CIN&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtcstno" type="text" size="25" class="tbltext" tabindex="0" maxlength="25" value="<?php echo $row_qry['cin'];?>" onChange="f14(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
 
</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="companyhome.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
