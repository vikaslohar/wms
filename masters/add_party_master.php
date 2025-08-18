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
	
		$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
		$row_param=mysqli_fetch_array($sql_param);
	
	if(isset($_POST['frm_action'])=='submit')
	{	
		$classification=trim($_POST['txtcla']);
		$bname=trim($_POST['txtbname']);
		$contact=trim($_POST['txtcpname']);
		$address=trim($_POST['txtaddress']);
		$phno=trim($_POST['txtphno']);
		$city=trim($_POST['txtcity']);
		$pin=trim($_POST['txtpin']);
		$state=trim($_POST['state']);
		$std=trim($_POST['std']);
		$mobile=trim($_POST['mobile']);
		$phno=trim($_POST['txtphno']);
		$pan=trim($_POST['txtpan']);
		//$cst=trim($_POST['txtcst']);
		$tin=trim($_POST['txttin']);
		$product=trim($_POST['txtproduct']);
		$product1=trim($_POST['txtproduct1']);
		$cphone1=trim($_POST['txtcphno1']);
		$email=trim($_POST['txtemail']);
		$txtplcode=trim($_POST['txtplcode']);
		
		$query=mysqli_query($link,"SELECT * FROM tblclassification where classification_id='$classification'") or die("Error: " . mysqli_error($link));
		$row=mysqli_fetch_array($query);
		
		$cl=$row['classification'];
		$query1=mysqli_query($link,"SELECT * FROM tblproductionlocation where productionlocationid='$city'") or die("Error: " . mysqli_error($link));
		$row1=mysqli_fetch_array($query1);
		
		$loc=$row1['productionlocation'];
	  $sql22=mysqli_query($link,"select * from tbl_partymaser where business_name='".$bname."'") or die(mysqli_error($link));
	  $num=mysqli_num_rows($sql22);
		
		$num24=0;
		
		if($classification=="Stock Transfer-Plant")
		{
		
		$sql24=mysqli_query($link,"select * from tbl_partymaser where classification='Stock Transfer-Plant' and p_id!='$pid' and stcode='".$txtplcode."' ") or die(mysqli_error($link));
	    $num24=mysqli_num_rows($sql24);
		}
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Party Name .\n  ID already Present.");
			  </script>
			 <?php
		}
		else if($num24 > 0)
		{	?>
			 <script>
			  alert("Duplicate Plant Code.\nPlant Code already Present.");
			  </script>
			 <?php
		}
		else
		{
			 $sql_in="insert into tbl_partymaser(location_id,classification,classification_id,business_name,contact, address, city, state, pin, mob, std,  phone, gstin,pan,stcode,product,email,cphone1,product1)values('$city','$classification','$classification', '$bname','$contact','$address', '$loc','$state','$pin','$mobile','$std','$phno','$tin','$pan','$txtplcode','$product','$email','$cphone1','$product1')";
				//exit;						
			if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
			{ 
				
				echo "<script>window.location='party_masterhome.php'</script>";	
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration - Master -Add  Party</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head><script src="orsal.js"></script>
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

function onloadfocus()
	{
	document.frmaddDepartment.txtcla.focus();
	}

function clk(opt)
{
	if(opt!="")
	{
		if(opt=="Vendor")
		{
			document.getElementById('pro').style.display="block";
		}
		else
		{
			document.getElementById('pro').style.display="none";
		}	
	}
	else
	{
		alert("Please entet Product");
	}
}
	function f1(val)
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
	 alert("Select Category of Party");
	 document.frmaddDepartment.txtbname.value="";
	 document.frmaddDepartment.txtcla.focus();
	 return false;
	}
	else
	{
	document.frmaddDepartment.txtbname.value=FirstCharCap(val);
	}
	
}

function f2(val)
{
if(document.frmaddDepartment.txtbname.value=="")
	{
		alert("Define Party name ");
		document.frmaddDepartment.txtcpname.value==""
		document.frmaddDepartment.txtbname.focus();
		return false;
	}
}
	function f3(val)
{
if(document.frmaddDepartment.txtcpname.value=="")
	{
		alert("Define Contact Person");
		document.frmaddDepartment.txtaddress.value==""
		document.frmaddDepartment.txtcpname.focus();
		return false;
	}
}
	function f4(val)
{
if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Enter Address");
		document.frmaddDepartment.txtcity.value==""
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	else
	{
	document.frmaddDepartment.txtcity.value=FirstCharCap(val);
	}
}
	function f5(val)
	{
 if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Enter City");
		document.frmaddDepartment.state.value==""
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	}
	//}
	//}
	
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;
       return true;
      }
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode != 32 && charCode != 8 && charCode != 46 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}

function echeck(str) 
	{
		var at="@";
		var dot=".";
		var lat=str.indexOf(at);
		var lstr=str.length;
		var ldot=str.indexOf(dot);
		if (str.indexOf(at)==-1){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(at,(lat+1))!=-1){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(dot,(lat+2))==-1){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(" ")!=-1){
		alert("Invalid E-mail ID");
		return false;
		}
		return true;					
		}
		
/*		function chkemail(s)
		{
		var f=s.split("@");
		if(f[1]=="vnrseeds.com")
		{
		return true;
		}
		else
		{
		return false;
		}
	}
*/
function modetchk1(classval)
{	
//alert(classval);
		showUser(classval,'vitem1','item1','','','','','',classval);
}
  
function stcodechk(stc)
{
	if(stc!="")
	{
		if(stc==18 || stc=="Stock Transfer-Plant")
		{
			document.getElementById('stcode').style.display="block";
		}
		else
		{
			document.getElementById('stcode').style.display="none";
		}	
	}
	else
	{
		alert("Please entet Product");
	}
}

	
function mySubmit()
{ 
var n=document.frmaddDepartment.txtemail.value.charAt(0);
 if(document.frmaddDepartment.state.value=="")
	{
		alert("Select State");
		document.frmaddDepartment.state.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Enter City/town/village");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcla.value=="")
	{
	 alert("Select Category of Party");
	// document.frmaddDepartment.txtcla.value.focus();
	 return false;
	}
	
	if(document.frmaddDepartment.txtbname.value=="")
	{
		alert("Define Party name ");
		document.frmaddDepartment.txtbname.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtcpname.value=="")
	{
		alert("Define Contact Person");
		document.frmaddDepartment.txtcpname.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Enter Address");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	if(document.frmaddDepartment.txtaddress.value.charCodeAt() == 32)
	{
		alert("Address cannot start with space.");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	
	/*<!--
	if(document.frmaddDepartment.txtcity.value.charCodeAt() == 32)
	{
		alert("City cannot start with space.");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}-->*/
	if(document.frmaddDepartment.txtpin.value!="")
	{
	if(document.frmaddDepartment.txtpin.value.length < 6 )
		{
			alert("Pin Code can not less than six digits");
			document.frmaddDepartment.txtpin.focus();
			return(false);
		}
	}

  
	
	/*if(document.frmaddDepartment.txtemail.value!="")
	{
		alert("Please Enter Email ID");
		document.frmaddDepartment.txtemail.focus();
		return false;
	}*/
	
	if(document.frmaddDepartment.txtemail.value!="")
	{
		
		/*if (n=="@")
		{
			alert("Please Enter Email ID");
			document.frmaddDepartment.txtemail.focus();
			return false;
		}		*/
		if (echeck(document.frmaddDepartment.txtemail.value)==false)
		{
			//document.frmaddDepartment.txtemail.value="";
			document.frmaddDepartment.txtemail.focus();
			return false;
		}
		/*if(!chkemail(document.frmaddDepartment.txtemail.value))
		{
			alert("Please Enter only  Email ID");
			document.frmaddDepartment.txtemail.focus();
			return false;
		}*/
	}

	if(document.frmaddDepartment.txtcla.value!="")
	{
	if(document.frmaddDepartment.txtcla.value=="Stock Transfer-Plant" || document.frmaddDepartment.txtcla.value==18)
	{
		if(document.frmaddDepartment.txtplcode.value=="")
		{
			alert("Enter Plant Code");
			document.frmaddDepartment.txtplcode.focus();
			return false;
		}
	}
	}
	return true;	
}

function plcchk(plc)
{
	if(document.frmaddDepartment.txtoplc.value!="")
	{
		if(plc==document.frmaddDepartment.txtoplc.value)
		{
			alert("Can not add Plant Code.\nReason: Plant code has been used as Application Plant Code");
			document.frmaddDepartment.txtplcode.value="";
			document.frmaddDepartment.txtplcode.focus();
			return false;
		}
	}
	else
	{
		alert("Can not add Plant Code.\nReason: Application Plant Code has not been defined in Parameter Master.");
		document.frmaddDepartment.txtplcode.value="";
		document.frmaddDepartment.txtplcode.focus();
		return false;
	}
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
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="employeemaster_home.php?dept_id=<?php echo $dept_id;?>" style="text-decoration:underline; cursor:hand; color:#404d21;"></a>Party Master - Add Party Master </td>
	    </tr></table></td>
	   	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="3" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit()"  > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="txt14" value="" type="hidden"> 
	 <input name="txtoplc" value="<?php echo $row_param['code'];?>" type="hidden"> 
	 <br /> 
	<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7">
<table align="center" border="1" width="624" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="30">
    <td colspan="7" align="center" class="tblheading">Add a New Party Form </td>
  </tr>
  <tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>  
  <tr class="Light" height="25">
   <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<select name="state" class="tbltext"  style="width:170px;" tabindex="" onChange="modetchk1(this.value)" >
<option value="" selected="selected">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
   <tr class="Light" height="30" >
  <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;City/Town/Village&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4" id="vitem1">&nbsp;<select class="tbltext" id="itm1" name="txtcity" style="width:170px;" >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['productionlocationid'];?>" />   
		<?php echo $noticia['productionlocation'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
    <?php
	
$quer3=mysqli_query($link,"SELECT classification_id, classification FROM tblclassification  where classification!='Export Buyer'"); 
?>
            <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;Select Party Classification&nbsp;</td>
<td width="392" colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtcla" style="width:170px;" onChange="stcodechk(this.value);" >
    <?php
if(!isset($_GET['lo']))
{
?>
    <option value="">--Select Classification--</option>
    <?php } ?>
    <?php while($noticia = mysqli_fetch_array($quer3)) { ?>
    <option  <?php if(isset($_GET['lo'])) { $cropid=$_GET['lo']; if($noticia['classification'] == $_GET['lo']) {$cropname=$noticia['classification']; echo "selected"; } } ?> value="<?php echo $noticia['classification'];?>" />  
    <?php echo $noticia['classification'];?>
    <?php } ?>
    <?php /* while($noticia = mysqli_fetch_array($quer2)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />      
		<?php echo $noticia['cropname'];?>
		<?php } */ ?>
  </select>  &nbsp;<font color="#FF0000" >*</font></td>
	 <?php
	 if(isset($_GET['lo']))
{
	 $lo1=$_GET['lo'];
		$quer_cn=mysqli_query($link,"SELECT DISTINCT cropname,cropid FROM tblclassification where classification_id=$lo1 ");
		 $res_cn=mysqli_fetch_array($quer_cn);
		 $cl=$res_cn['classification'];

	 ?> 
	<input type="hidden" name="classification" value="<?php echo $cl;?>" />
	
	<?php } ?>
</tr>

  <tr class="Dark" height="30" >
  <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtbname" type="text" size="50" class="tbltext" tabindex=""  maxlength="50" onChange="f1(this.value);" onBlur"javascript:this.value=FirstCharCap(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          </tr>
		    <tr class="Light" height="30" >
    <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;Contact Person&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<input name="txtcpname" type="text" size="50" class="tbltext" tabindex=""  maxlength="50" onChange="f2(this.value);" onBlur="javascript:this.value=FirstCharCap(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
        
  <tr class="Dark" height="30" >
   <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
    <td colspan="4" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtaddress" cols="20" rows="5" tabindex="" onChange="f3(this.value);" class="tbltext" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>    
 
       
  <tr class="Dark" height="30" >
  <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;Pin Code&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="txtpin" type="text" size="5" class="tbltext" tabindex="" maxlength="6" onKeyPress="return isNumberKey(event)"  />
      &nbsp;</td>
  </tr>
        
  
  <tr class="Dark" height="30"  >
    <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;Phone Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="std" type="text" size="5" class="tbltext" tabindex="7" maxlength="5" onKeyPress="return isNumberKey(event)" />&nbsp;&nbsp;<input name="txtphno" type="text" size="20" class="tbltext" tabindex="" maxlength="20"  />&nbsp;Alternate</font>&nbsp;&nbsp;<input name="txtcphno1" type="text" size="10" class="tbltext" tabindex="" maxlength="10" /></td>
  </tr>
       
  <tr class="Light" height="30" >
   <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;Mobile Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="mobile" type="text" size="15" class="tbltext" tabindex="" maxlength="13" onKeyPress="return isNumberKey(event)"  />&nbsp;</td>
  </tr>
  <tr class="Dark" height="25">
<td width="226" align="right"  valign="middle" class="tblheading">&nbsp;&nbsp;e-mail&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="" name="txtemail" type="text" size="40" class="tbltext" value="" maxlength="40" onChange="echeck(this.value);"/>&nbsp;&nbsp;</td>
</tr>
       
  <tr class="Dark" height="30" >
    <td width="226" align="right"  valign="middle" class="tblheading">&nbsp;PAN&nbsp;</td>
    <td width="392" colspan="4" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtpan" type="text" size="18" class="tbltext" tabindex="" maxlength="13"  />&nbsp;</td>
  </tr>
  <tr class="Dark" height="30" >
   <td width="226" align="right"  valign="middle" class="tblheading">GSTIN&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4" >&nbsp;<input name="txttin" type="text" size="18" class="tbltext" tabindex="" maxlength="18" />
      &nbsp;</td>
	  </tr>
       
	  <!-- <tr class="Light" height="30" >
    <td width="226" align="right"  valign="middle" class="tblheading">CST&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4">&nbsp;<input name="txtcst" type="text" size="18" class="tbltext" tabindex="" maxlength="18"  />&nbsp;</td>
	   </tr>-->
         <tr class="Light" height="30" >
    <td width="226"  align="right" valign="middle" class="tblheading">&nbsp;Seed&nbsp;Licence No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4">&nbsp;<input name="txtproduct1" type="text"  size="18"tabindex=""  class="tbltext">&nbsp;</td>
       </tr>
		 
  </table>
 <div id="pro" style="display:none">
  <table align="center" border="1" width="624" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
    <tr class="Light" height="30" >
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;Products&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4">&nbsp;<textarea name="txtproduct" cols="20" rows="5" tabindex=""  class="tbltext"></textarea>&nbsp;<font color="#FF0000">*</font></td>
       </tr>
</table>
</div>
<div id="stcode" style="display:none">
  <table align="center" border="1" width="624" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
    <tr class="Light" height="30" >
    <td width="226"  align="right" valign="middle" class="tblheading">&nbsp;Plant Code&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4">&nbsp;<input name="txtplcode" type="text" size="1" maxlength="1" tabindex=""  class="tbltext" onKeyPress="return isCharKey(event)" onBlur="javascript:this.value=this.value.toUpperCase();" onChange="plcchk(this.value);" />&nbsp;<font color="#FF0000">*</font></td>
       </tr>
</table>
</div>
</td></tr>
<tr>
<td><table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="party_masterhome.php?classification_id=<?php echo $classification_id;?>" tabindex="20"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" OnClick="return mySubmit();" border="0" style="display:inline;cursor:hand;" tabindex=""></td>
</tr>
</table></td><td width="30"></td>
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
