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
	
		
	if(isset($_GET['department_id']))
	{
 		$department_id = $_GET['department_id'];
	}
	if(isset($_REQUEST['id']))
	{
	 	$id = $_REQUEST['id'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{
		$name=trim($_POST['txtname']);
		$login=trim($_POST['txtId']);
		$pass=trim($_POST['txtpass']);
		$email=trim($_POST['txtemail']);
		$status=trim($_POST['txt1']);
		$code=trim($_POST['code']);
		$scode=trim($_POST['scode']);
		$dept=trim($_POST['dpt']);
		//$plsl=trim($_POST['txtdest']);
		$vflg=trim($_POST['txtvflg']);
		$rel=trim($_POST['role']);
		$txtplant=trim($_POST['txtplant']);
		
		$query1=mysqli_query($link,"SELECT * FROM tblopr where name='$name' and id!='$id'") or die("Error: " . mysqli_error($link));
		$numofrecords1=mysqli_num_rows($query1);
		
		$query2=mysqli_query($link,"SELECT * FROM tblopr where login='$login' and id!='$id'" ) or die("Error: " . mysqli_error($link));
		$numofrecords2=mysqli_num_rows($query2);
		
		$query3=mysqli_query($link,"SELECT * FROM tblopr where email='$email' and id!='$id' and pass='$pass'") or die("Error: " . mysqli_error($link));
		$numofrecords3=mysqli_num_rows($query3);
		
		$query5=mysqli_query($link,"SELECT * FROM tbluser where loginid='$login'  and scode != '$scode'") or die("Error: " . mysqli_error($link));
		$numofrecords5=mysqli_num_rows($query5);
		
		/*$query6=mysqli_query($link,"SELECT * FROM tbluser where email='$email' and scode != '$scode'") or die("Error: " . mysqli_error($link));
		$numofrecords6=mysqli_num_rows($query6);*/
		 //exit;
   		// $numofrecords=mysqli_num_rows($query);
		 //exit;
	 	 if($numofrecords1>0 ||$numofrecords2>0 || $numofrecords3>0 || $numofrecords5>0 || $numofrecords6>0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
	  
			$sql_in="update tblopr set name='$name',
									login='$login',
									pass='$pass',
									email='$email',
									trvflag='$vflg',
									code='$code',
									department_id='$dept',
									plantcode='$txtplant'
									where id='$id'";
		
	 								
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{	
			
		   $sql_in1="Update tbluser set	loginid='$login',
										password='$pass',
										email='$email',
										role='$rel',
										plantcode='$txtplant'
										where scode='$scode'";		
									//	exit;
			mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
			
			echo "<script>window.location='operator_home.php?department_id=$department_id'</script>";	
		}
}}
		
		$quer_cn=mysqli_query($link,"SELECT * FROM tbldept where department_id='".$department_id."'");
		$res_cn=mysqli_fetch_array($quer_cn);
		$dept1=$res_cn['department'];
		if($dept1=="QualityGot") $dept1="Quality GOT";
		
if($dept1=="Admin")
{
$rel="admin";
$cod="AD";
}
else if($dept1=="Arrival")
{
$rel="arrival";
$cod="AR";
}
else if($dept1=="CSW")
{
$rel="csw";
$cod="CS";
}
else if($dept1=="Decode")
{
$rel="decode";
$cod="DC";
}
else if($dept1=="Drying")
{
$rel="drying";
$cod="DY";
}
else if($dept1=="Dispatch")
{
$rel="dispatch";
$cod="DP";
}
else if($dept1=="Dispatch-XT")
{
$rel="dispatchxt";
$cod="DPX";
}
else if($dept1=="Order Booking")
{
$rel="orderbooking";
$cod="OB";
}
else if($dept1=="Packaging")
{
$rel="packaging";
$cod="PK";
}
else if($dept1=="Plant Manager")
{
$rel="plantmanager";
$cod="PM";
}
else if($dept1=="Processing")
{
$rel="processing";
$cod="PR";
}

else if($dept1=="PSW")
{
$rel="psw";
$cod="PSW";
}

else if($dept1=="Quality")
{
$rel="quality";
$cod="QC";
}
else if($dept1=="RSW")
{
$rel="rsw";
$cod="RSW";
}
else if($dept1=="Sales Return")
{
$rel="salesreturn";
$cod="SR";
}
else if($dept1=="Quality GOT")
{
$rel="Got";
$cod="QG";
}
else if($dept1=="QC Manager")
{
$rel="QCM";
$cod="QM";
}
else if($dept1=="QC Supervisor")
{
$rel="QCS";
$cod="QS";
}
else if($dept1=="qcappmp")
{
$rel="QCMP";
$cod="qcappmp";
}
else if($dept1=="qcappgermp")
{
$rel="QCGP";
$cod="qcappgermp";
}
else if($dept1=="qcappgot")
{
$rel="QCGT";
$cod="qcappgot";
}
else if($dept1=="qcappbts")
{
$rel="QCBT";
$cod="qcappbts";
}
else
{
$rel="";
$cod="";
}
		
				
	//}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administrator- Operator Master -Edit Operator</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../include/validation.js"></script>

</head>
<script src="vaddresschk.js"></script>
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
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 32 && charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

//return true;
}

function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
/*function f1(val)
{
	if(document.frmaddDepartment.txtname.value=="")
	{
	 alert("Please enter Operator Name");
	 document.frmaddDepartment.txtid.value="";
	 document.frmaddDepartment.txtname.focus();
	 return false;
	}
	else
	{
	document.frmaddDept.frmaddDepartment.value=ucwords_w(val.toLowerCase());
	}
	}
function onloadfocus()
	{
	document.frmaddDepartment.txtname.focus();
	}

function modetchk(classval)
{ //alert("hi");
			showUser(classval,'dest','plant','','','','','');
			setTimeout('clk()', 400);
}

function clk()
{
var opt=document.frmaddDepartment.txtdest.value;*/
//alert(opt);
	/*if(opt!="")
	{
		if(opt=="Plant")
		{
			document.getElementById('plselect').style.display="block";
		}
		else
		{
			document.getElementById('plselect').style.display="none";
		}	
	}
	else
	{
		alert("Please Select Destination");
	}
}*/
function mySubmit()
{  
//document.frmaddDepartment.txtcla.value=ucwords_w(document.frmaddDepartment.txtcla.value.toLowerCase())
	var n=document.frmaddDepartment.txtemail.value.charAt(0);
	
	if(document.frmaddDepartment.txtcla.value=="")
	{
		alert("Please Select Department");
		document.frmaddDepartment.txtcla.focus();
		return false;
	}
	if(document.frmaddDepartment.txtplant.value=="")
	{
		alert("Please Select Plant");
		document.frmaddDepartment.txtplant.focus();
		return false;
	}
	if(document.frmaddDepartment.txtname.value=="")
	{
		alert("Please enter Operator Name");
		document.frmaddDepartment.txtname.focus();
		return false;
	}
	if(document.frmaddDepartment.txtname.value.charCodeAt() == 32)
	{
		alert("Operator Name cannot start with space.");
		document.frmaddDepartment.txtname.focus();
		return false;
	}
	if(document.frmaddDepartment.txtname.value.charCodeAt(0)==32)
{
	/*if(document.frmprodloc.txtlocation.value!="")
{
var txtVal = document.frmprodloc.txtlocation.value;
for(var i = 0;i<document.frmprodloc.txtlocation.value.length; i++)
{
if(txtVal.charAt(i) < 'A' || txtVal.charAt(i) > 'Z' && txtVal.charAt(i) <'a' || txtVal.charAt(i)>'z' && txtval.charAt(i)!=" " )
{
alert("Invalid Name Enter only Alphabets.");
document.frmprodloc.txtlocation.focus();
return false;
}
}
}*/
}	
	
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
	if(document.frmaddDepartment.txtId.value==document.frmaddDepartment.txtpass.value)
		{
		alert("Login Id and Password can not be same");
		document.frmaddDepartment.txtpass.focus();
		return(false);
		}
	}
	

	if(document.frmaddDepartment.txtrepass.value=="")
	{
		alert("Confirm Password");
		document.frmaddDepartment.txtrepass.focus();
		return false;
	}
	if(document.frmaddDepartment.txtrepass.value != document.frmaddDepartment.txtpass.value)
	{
		alert("Retype Password not matched with Password. Please Enter again");
		document.frmaddDepartment.txtrepass.focus();
		return false;
	}
	
/*	if(document.frmaddDepartment.txt11.value=="")
	{
		alert("Define Status");
		return false;
	}*/

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
	
		return true;	 
}
</script>


<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"   >
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Operator Master - Edit </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
 <?php 
 $sql1=mysqli_query($link,"select * from tbluser where role='$rel'")or die(mysqli_error($link)); 
	 $total1=mysqli_num_rows($sql1);
	 $row_tc=mysqli_fetch_array($sql1);
	 
    $sql=mysqli_query($link,"select * from tblopr where id='$id'")or die(mysqli_error($link)); 
	 $total=mysqli_num_rows($sql);
	$row=mysqli_fetch_array($sql);
	
	$quer3=mysqli_query($link,"SELECT * FROM tbldept order by department Asc");
	 $row_c=mysqli_fetch_array($quer3);
	 // $total1=mysqli_num_rows($quer3);
	if($row_cn['department']=="Admin")
{
$code1="Adm";
}
else if($row_cn['department']=="Arrival")
{
$code1="ARR";
}
else if($row_cn['department']=="CSW")
{
$code1="CSW";
}
else if($row_cn['department']=="Decode")
{
$code1="DEC";
}
else if($row_cn['department']=="Drying")
{
$code1="DRY";
}
else if($row_cn['department']=="Dispatch")
{
$code1="DISP";
}
else if($row_cn['department']=="Dispatch-XT")
{
$code1="DPXT";
}
else if($row_cn['department']=="Order Booking")
{
$code1="OR";
}
else if($row_cn['department']=="Packaging")
{
$code1="PK";
}
else if($row_cn['department']=="Plant Manager")
{
$code1="PM";
}
else if($row_cn['department']=="Processing")
{
$code1="PROC";
}

else if($row_cn['department']=="PSW")
{
$code1="PSW";
}

else if($row_cn['department']=="Quality")
{
$code1="QTY";
}
else if($row_cn['department']=="RSW")
{
 $code1="RSW";
}
else if($row_cn['department']=="Sales Return")
{
$code1="SR";
}
else if($row_cn['department']=="qcappmp")
{
$code1="QMP";
}
else if($row_cn['department']=="qcappgermp")
{
$code1="QGP";
}
else if($row_cn['department']=="qcappgot")
{
$code1="QGT";
}
else if($row_cn['department']=="qcappbts")
{
$code1="QBT";
}
else
{
 $code1="";
 }
// echo $row_cn['department'];
?>
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  >
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="txt11" value="<?php echo $row['status'];?>" type="hidden"> 
	  <input type="hidden" name="code" value="<?php echo $row['code'];?>">
	 		  <input type="hidden" name="scode" value="<?php echo $cod.$row['code'];?>" />
			    <input type="hidden" name="role" value="<?php echo $rel;?>" />
				 <input type="hidden" name="dpt" value="<?php echo $department_id;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><br />

<table align="center" border="0" width="650" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC" style="border-collapse:collapse" > <tr><td>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle"> Edit Operator </td>
</tr>
<tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>All fields are Mandatoty&nbsp;</td>
  </tr>
   <tr class="Light" height="30">
<td width="right" align="right" valign="middle" class="tblheading">&nbsp;Operator ID &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="12" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $cod.$row['code'];?>"/></td></tr>

 
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Department&nbsp;</td>
<td width="375"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcla" type="text" size="25" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $dept1;?>" maxlength="25"/></td>

</tr> 
	<input type="hidden" name="department" value="<?php echo $dept1;?>" />
<?php
$sql_comp=mysqli_query($link,"Select * from tbl_parameters order by pcity asc") or die(mysqli_error($link));
$tot_comp=mysqli_num_rows($sql_comp);
?>	
	<tr class="Dark" height="25">
    <td align="right" valign="middle" class="tblheading">&nbsp;Plant&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtplant" class="tbltext"  style="width:170px;" tabindex="" >
	<option value="" selected="selected">--Select State--</option>
<?php while($row_comp=mysqli_fetch_array($sql_comp)) {?>
    <option <?php if($row['plantcode']==$row_comp['plantcode']) {echo "Selected";} ?> value="<?php echo $row_comp['plantcode'];?>" ><?php echo $row_comp['pcity'];?></option>
<?php } ?>  
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>	
	<tr class="Dark"  height="25">
<td width="46%"  align="right" valign="middle" class="tblheading"> Operator  Name&nbsp;</td>
<td width="472" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtname" type="text" class="tbltext" tabindex="" value="<?php echo $row['name'];?>" size="25" maxlength="25"  onKeyPress="return isCharKey(event)"  onBlur="javascript:this.value=ucwords_w(this.value.toLowerCase());"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Light"  height="25">
<td  align="right" valign="middle" class="tblheading">&nbsp;Login Id&nbsp;</td>
<td width="472" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtId" type="text" class="tbltext" tabindex="0" value="<?php echo $row['login'];?>" size="15" maxlength="15"/>&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 15</td> </tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpass" type="password" class="tbltext" tabindex="1" value="<?php echo $row['pass'];?>" size="15" maxlength="15"/>&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 15</td> </tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Confirm Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtrepass" type="password" class="tbltext" tabindex="2" value="<?php echo $row['pass'];?>" size="15" maxlength="15"/>&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 15</td> </tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;&nbsp;VNR&nbsp;e-mail&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="3" name="txtemail" type="text" size="40" class="tbltext" value="<?php echo $row['email'];?>" maxlength="40"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">View &amp; Process other Operator's Transactions</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="" name="txtvflg" <?php if($row['trvflag']=="Yes") { echo "checked"; }?> type="radio" class="tbltext" value="Yes" />Yes&nbsp;<input tabindex="" name="txtvflg" type="radio" class="tbltext" value="No" <?php if($row['trvflag']=="No") { echo "checked"; }?> />No&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

</table></td></tr>
</table>
<?php 
$quer3=mysqli_query($link,"SELECT department_id, department from tbldept where department_id='".$row['department_id']."'")or die("Error:".mysqli_error($link));
$result=mysqli_fetch_array($quer3);
?>
<!--<table id="plselect" align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse; display:<?php if($result['department']=="Plant"){echo "block";}else { echo "none";}?>" >
<?php // echo $row['did'];
$quer24=mysqli_query($link,"SELECT * FROM tbldestination order by dest"); 
?>
<tr class="Light" height="25">
<td width="319" align="right" valign="middle" class="tblheading">&nbsp;&nbsp;&nbsp;Plant Location&nbsp;</td>
<td width="375" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtplsl" style="width:170px;" >
<option value="" selected>--Select--</option>
	<?php while($noticia24=mysqli_fetch_array($quer24)) { ?>
		<option  <?php if($noticia24['did']==$row['did']){ echo "Selected";} ?> value="<?php echo $noticia24['did'];?>" />   
		<?php echo $noticia24['dest'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
</tr> 
</table>-->

<div id="dest"><input type="hidden" name="txtdest" value="<?php echo $result['department'];?>" /></div>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="operator_home.php?department_id=<?php echo $department_id?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;</a>&nbsp;<input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:pointer;"></td>
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
