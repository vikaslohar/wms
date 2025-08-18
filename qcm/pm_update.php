<?php
//ob_start(); 
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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="OP1";
	//$lgnid="OP1";
				$reptyp=trim($_REQUEST['reptyp']);
				 $txt=trim($_REQUEST['txt']);
				 $txtlot=trim($_REQUEST['txtlot']);
				 $txtlo=trim($_REQUEST['txtlo']);
				 $txtlot1=trim($_REQUEST['txtlot1']);
				 $txtlot2=trim($_REQUEST['txtlot2']);
			     //$txtlot3=trim($_REQUEST['txtlot3']);
				 $pcode=trim($_REQUEST['pcode']);
				 $txtcrop=trim($_REQUEST['txtcrop']);
				 $txtvariety=trim($_REQUEST['txtvariety']);
				 //$txtstage=trim($_REQUEST['txtstage']);
				 $stcode=trim($_REQUEST['stcode']);
			     $ycode=trim($_REQUEST['ycodee']);
				 $txtlot4=trim($_REQUEST['txtlot4']);
		
	$lotno=$pcode.$ycode.$txtlot2."/".$stcode;	
	   
	if(isset($_POST['frm_action'])=='submit')
	{
	$crop = $_POST['txtcrop'];	
	$variety = $_POST['txtvariety'];	
	$vchk = $_POST['txtpp'];	
	$moist = $_POST['txtmoist'];	
   	$e = $_POST['sdate'];
	$txtsamp = $_POST['txtsamp'];

	$tdate=$e;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;
	
	$sql_main="Insert into tbl_pmupdate (pmup_date, crop, variety, lotno, pp, moist) values ('$tdate', '$crop', '$variety', '$txtsamp', '$vchk', '$moist')";
	$xx=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	
$sql_sub="update tbl_lot_ldg set lotldg_vchk='$vchk',lotldg_moisture='$moist' where orlot='$txtsamp'";
	$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
//exit;
		echo "<script>window.location='pmupdate.php'</script>";	
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qty- Transaction - PP Moisture % Updation</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="staddresschk.js"></script>
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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
function moischk(mosval)
{
		if(document.frmaddDepartment.txtpp.value=="")
		{
			alert("Please Select PP");
			document.frmaddDepartment.txtmoist.value="";
		}
		if(parseFloat(mosval)>99.9)
		{
			alert("Invalid Moisture % value");
			document.frmaddDepartment.txtmoist.value="";
			document.frmaddDepartment.txtmoist.focus();
		}
}
function mySubmit()
{ 
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please Select Physical Purity");
		document.frmaddDepartment.txtpp.focus();
		return false;
	}
	if(document.frmaddDepartment.txtmoist.value=="")
	{
		alert("Please Enter Moisture %.");
		document.frmaddDepartment.txtmoist.focus();
		return false;
	}
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
	      <td width="813" height="25" class="Mainheading">&nbsp; QC Transaction- PP Moisture Update </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="btnval" value="0" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">PP Moisture Update</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php
$sampl=$txtlo;  
if($reptyp=="lotno")
{ 
 $sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."' order by lotldg_id desc") or die(mysqli_error($link));
}
else 
{
$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' and orlot='".$txtlot1."' order by lotldg_id desc") or die(mysqli_error($link));
}

	$row_tbl=mysqli_fetch_array($sql_tbl);
 	$tot=mysqli_num_rows($sql_tbl);		

	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl['lotldg_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop=$row31['cropname'];	
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['lotldg_variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	$tt=$rowvv['popularname'];
	
	$tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	 }
?>
 <tr class="Dark" height="30">
<td width="148" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtsamp" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['orlot'];?>"/>&nbsp;</td>
 </tr>
 
 <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="209" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext" tabindex=""  style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>" id="itm"/>&nbsp;</td>
<td width="93" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td width="290" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="30" class="tbltext" tabindex="" maxlength="30" style="background-color:#CCCCCC" readonly="true" value="<?php echo $vv;?>"/>&nbsp;&nbsp;</td>
</tr>

<tr class="Dark" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  >&nbsp;<select class="tbltext" name="txtpp" style="width:150px;">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
           </tr>
		   
  </table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="Center"><a href="pmupdate.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

 
