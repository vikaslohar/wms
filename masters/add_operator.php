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

	if(isset($_POST['frm_action'])=='submit')
	{
		$name=trim($_POST['txtname']);
		$login=trim($_POST['txtId']);
		$pass=trim($_POST['txtpass']);
		$email=trim($_POST['txtemail']);
		$status=trim($_POST['txt1']);
		$code=trim($_POST['code']);
	    $scode=trim($_POST['scode']);
		$dept=trim($_POST['department']);
		$vflg=trim($_POST['txtvflg']);
		$rell=trim($_POST['role']);
		$txtplant=trim($_POST['txtplant']);
		
		/*if($plsl=="Plant Manager")
		{
			$plselect=trim($_POST['txtplsl']);
		}
		else
		{ 
			$plselect="";
		}*/
		
		
		$query1=mysqli_query($link,"SELECT * FROM tblopr where name='$name' and id!='$id'") or die("Error: " . mysqli_error($link));
		$numofrecords1=mysqli_num_rows($query1);
		
		$query2=mysqli_query($link,"SELECT * FROM tblopr where login='$login' and id!='$id'" ) or die("Error: " . mysqli_error($link));
		$numofrecords2=mysqli_num_rows($query2);
		
		$query3=mysqli_query($link,"SELECT * FROM tblopr where email='$email' and id!='$id' and pass='$pass'") or die("Error: " . mysqli_error($link));
		$numofrecords3=mysqli_num_rows($query3);
	/*	
		$query5=mysqli_query($link,"SELECT * FROM tbluser where loginid='$login'  and scode != '$scode'") or die("Error: " . mysqli_error($link));
		$numofrecords5=mysqli_num_rows($query5);
		
		$query6=mysqli_query($link,"SELECT * FROM tbluser where email='$email' and scode != '$scode'") or die("Error: " . mysqli_error($link));
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
	 $sql_in="insert into tblopr(name, login, pass, email,code,department_id,trvflag,plantcode) values(
											  '$name',
											  '$login',
											  '$pass',
											  '$email',
											  '$code',
											  '$dept',
											   '$vflg',
											   '$txtplant')";
										
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{ 
		//$id=mysqli_insert_id($link);
		
		
/*
		$tp1="";
			if($dept ==13) { $tp1="Plant Manager";}
			//else if($dept ==2) { $tp1="plant";}
		
	$lotstat=$tp1;*/
		$sql_in1="Insert into tbluser(uid,loginid, password , email,scode ,role, plantcode)values(
			 						'$id',
									'$login',
		 							'$pass',
									'$email',
									'$scode',
									'$rell',
									'$txtplant')";		
								
										//exit;	
					mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			echo "<script>window.location='operator_home1.php'</script>";	
		}
		}
	
	//}
	}
	//exit;
	
		$quer_cn=mysqli_query($link,"SELECT * FROM tbldept where department_id='".$department_id."'");
		$res_cn=mysqli_fetch_array($quer_cn);
		$dept1=$res_cn['department'];
		if($dept1=="QualityGot") $dept1="Quality GOT";

if($dept1=="Admin")
{
$rel="admin";
$cod="AD";
$mce=1;
}
else if($dept1=="Arrival")
{
$rel="arrival";
$cod="AR";
$mce=10;
}
else if($dept1=="CSW")
{
$rel="csw";
$cod="CS";
$mce=3;
}
else if($dept1=="Decode")
{
$rel="decode";
$cod="DC";
$mce=2;
}
else if($dept1=="Drying")
{
$rel="drying";
$cod="DY";
$mce=3;
}
else if($dept1=="Dispatch")
{
$rel="dispatch";
$cod="DP";
$mce=10;
}
else if($dept1=="Dispatch-XT")
{
$rel="dispatchxt";
$cod="DPX";
$mce=3;
}
else if($dept1=="Order Booking")
{
$rel="orderbooking";
$cod="OB";
$mce=3;
}
else if($dept1=="Packaging")
{
$rel="packaging";
$cod="PK";
$mce=8;
}
else if($dept1=="Plant Manager")
{
$rel="plantmanager";
$cod="PM";
$mce=1;
}
else if($dept1=="Processing")
{
$rel="processing";
$cod="PR";
$mce=5;
}

else if($dept1=="PSW")
{
$rel="psw";
$cod="PSW";
$mce=3;
}

else if($dept1=="Quality")
{
$rel="quality";
$cod="QC";
$mce=3;
}
else if($dept1=="RSW")
{
$rel="rsw";
$cod="RSW";
$mce=3;
}
else if($dept1=="Sales Return")
{
$rel="salesreturn";
$cod="SR";
$mce=5;
}
else if($dept1=="Quality GOT")
{
$rel="Got";
$cod="QG";
$mce=4;
}
else if($dept1=="QC Manager")
{
$rel="QCM";
$cod="QM";
$mce=1;
}
else if($dept1=="QC Supervisor")
{
$rel="QCS";
$cod="QS";
$mce=3;
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
$mce=0;
}

/*$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblopr where department_id='".$department_id."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
if($mce>0 && $total_results>=$mce)
{
	echo "<script>alert('Maximum Limit to add Operator(s) is Reached for selected Department')</script>";	
	echo "<script>window.location='operator_home1.php'</script>";	
}*/

	$sql_code="SELECT MAX(code) FROM tblopr where department_id='$department_id' ORDER BY code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				 $code1=$cod.$code;
		}
		else
		{
			$code=1;
			$code1=$cod.$code;
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administrator-  Master - Add Operator</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="../include/validation.js"></script>
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
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode != 32 && charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

//return true;
}
function modetchk(classval)
{ //alert("hi");
			showUser(classval,'dest','plant','','','','','');
			setTimeout('clk()', 400);
}

/*function clk()
{
var opt=document.frmaddDepartment.txtdest.value;
//alert(opt);
	if(opt!="")
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
function f1(val)
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
		document.frmaddDepartment.txtid.value=ucwords_w(val.toLowerCase());
	}
}

	function onloadfocus()
	{
		document.frmaddDepartment.txtcla.focus();
	}
	
	function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

/*function clk(val)
{
//alert(val);
document.frmaddDepartment.txt11.value=val;
}*/
function mySubmit()
{  
document.frmaddDepartment.txtcla.value=ucwords_w(document.frmaddDepartment.txtcla.value.toLowerCase())
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
		alert(" Operator Name cannot start with space.");
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
	/*if(document.frmaddDepartment.txtdest.value=="Plant")
	{
		if(document.frmaddDepartment.txtplsl.value=="")
		{
			alert("Please select Plant Location");
			document.frmaddDepartment.txtplsl.focus();
			return false;
		}
	}*/
		return true;	 
}
</script>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" >
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
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="cdinward_home.php" style="text-decoration:underline; cursor:pointer; color:#404d21;"></a>Operator Master - Add </td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onReset="onloadfocus();" > 
	   <input name="frm_action" value="submit" type="hidden">
		 <input name="txt11" value="" type="hidden">
		 <input type="hidden" name="code" value="<?php echo $code;?>" />
		  <input type="hidden" name="scode" value="<?php echo $code1;?>" />
		    <input type="hidden" name="role" value="<?php echo $rel;?>" />
		  
		 <br/>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse" height="400">
<tr>
<td valign="top">
<?php //if($row_rt < 3) { ?>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle"><span class="subheading" style="color:#303918; ">Add Operator </span></td>
</tr>

<tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>All fields are Mandatory&nbsp;</td>
  </tr>

 <tr class="Dark" height="30">
<td width="319" align="right" valign="middle" class="tblheading">&nbsp;Operator ID &nbsp;</td>
<td width="375"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="12" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"  disabled="disabled"  value="<?php echo $code1;?>"/></td></tr>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tbldept order by department Asc"); 
?>

 <?php
	 /*
		$quer_cn=mysqli_query($link,"SELECT DISTINCT department,department_id  FROM tbldept where department_id=$department_id ");
		 $res_cn=mysqli_fetch_array($quer_cn);
		 $dept1=$res_cn['department'];*/

	 ?> 
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Department&nbsp;</td>
<td width="375"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcla" type="text" size="25" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $dept1;?>" maxlength="25"/></td>

</tr> 
	<input type="hidden" name="department" value="<?php echo $department_id;?>" />
		<!--</table>

 <table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >

</tr>-->
<?php
$sql_comp=mysqli_query($link,"Select * from tbl_parameters order by pcity asc") or die(mysqli_error($link));
$tot_comp=mysqli_num_rows($sql_comp);
?>	
	<tr class="Dark" height="25">
    <td align="right" valign="middle" class="tblheading">&nbsp;Plant&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtplant" class="tbltext"  style="width:170px;" tabindex="" >
	<option value="" selected="selected">--Select State--</option>
<?php while($row_comp=mysqli_fetch_array($sql_comp)) {?>
    <option value="<?php echo $row_comp['plantcode'];?>" ><?php echo $row_comp['pcity'];?></option>
<?php } ?>  
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
<td  align="right" valign="middle" class="tblheading">&nbsp;Operator  Name&nbsp;</td>
<td width="375" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtname" type="text" class="tbltext" tabindex="" value="" size="25" maxlength="25"  onkeypress="return isCharKey(event);"   onBlur="javascript:this.value=ucwords_w(this.value.toLowerCase());"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light"  height="25">
<td  align="right" valign="middle" class="tblheading">&nbsp;Login Id&nbsp;</td>
<td width="375" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtId" type="text" class="tbltext" value="" size="15" maxlength="15"  tabindex=""/>&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 15</td> </tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpass" type="password" class="tbltext" tabindex="" value="" size="15" maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 15</td> </tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Confirm  Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtrepass" type="password" class="tbltext" value="" size="15" maxlength="15" tabindex=""/>&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 15</td> </tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">VNR&nbsp;&nbsp;e-mail&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="" name="txtemail" type="text" size="40" class="tbltext" value="@vnrseeds.com" maxlength="40" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">View &amp; Process other Operator's Transactions</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="" name="txtvflg" type="radio" class="tbltext" value="Yes" />Yes&nbsp;<input tabindex="" name="txtvflg" type="radio" class="tbltext" value="No" checked="checked" />No&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>


<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="operator_home.php?department_id=<?php echo $department_id?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a></a>&nbsp;&nbsp;&nbsp;<a href="javascript:document.frmaddDepartment.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;
  <input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit();" border="0" style="display:inline;cursor:pointer;" tabindex=""></td>
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
