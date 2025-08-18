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
		$edate = $_POST['edate'];
		$cid = $_POST['txtcrop'];
		$itemid = $_POST['txtvariety'];
		$sstage = $_POST['sstage'];
		$result = $_POST['result'];
		$durtyp = $_POST['durtyp'];
		$dotage = $_POST['dotage'];
		$fillagetyp = $_POST['fillagetyp'];
		$totdays = $_POST['totdays'];
		echo "<script>window.location='qc_report_ondtage1.php?edate=$edate&txtcrop=$cid&txtvariety=$itemid&result=$result&dotage=$dotage&sstage=$sstage&durtyp=$durtyp&fillagetyp=$fillagetyp&totdays=$totdays'</script>";
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report -QC Test Ageing Status Report</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
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
<SCRIPT language="JavaScript">
function modetchk(classval)
{	
	showUser(classval,'vitem','item','','','','','');
}

function durtypsel(durtyp)
{
	if(durtyp=="dsel")
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="block";
		document.getElementById('filltbl').style.display="none";
	}
	else if(durtyp=="dfill")
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="none";
		document.getElementById('filltbl').style.display="block";
	}
	else
	{
		document.getElementById('dotage').selectedIndex=0;
		document.getElementById('dotage').value="ALL";
		document.getElementById('fillagetyp').selectedIndex=0;
		document.getElementById('fillagetyp').value="";
		document.frmaddDepartment.totdays.value="";
		document.getElementById('seltbl').style.display="none";
		document.getElementById('filltbl').style.display="none";
	}
	document.frmaddDepartment.durtyp.value=durtyp;
}

function mySubmit()
{ 
	var f=0;
	if(document.frmaddDepartment.txtcrop.value == "")
	{
		alert("Please select Crop");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value == "")
	{
		alert("Please Select Variety");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.durtyp.value == "")
	{
		alert("Please Select QC Test Duration Type");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.durtyp.value != "")
	{
		if(document.frmaddDepartment.durtyp.value == "dsel")
		{
			if(document.frmaddDepartment.dotage.value == "")
			{
				alert("Please Select Duration");
				f=1;
				return false;
			}
		}
		if(document.frmaddDepartment.durtyp.value == "dfill")
		{
			if(document.frmaddDepartment.fillagetyp.value == "")
			{
				alert("Please Select Duration");
				f=1;
				return false;
			}
			if(document.frmaddDepartment.totdays.value == "")
			{
				alert("Please fill Days");
				f=1;
				return false;
			}
		}
	}
	if(f==0)
	{
		return true;	 
	}
	else
	{
		return false;
	}
}
</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_csw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/csw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" style="border-bottom:solid; border-bottom-color:#fa8283" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;QC Test Ageing Status Report </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">QC Test Ageing Status Report</td>
                </tr>
                <tr height="15">
                  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
                </tr>
                <?php
 /*$code="";
$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept order by dept_name Asc"); */
?>
                <tr class="Dark" height="25">
                  <td width="272" align="right"  valign="middle" class="tblheading">&nbsp;As on Date&nbsp;</td>
                  <td width="272" align="left"  valign="middle" >&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;</td>
                </tr>
               <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
                </tr>
                <tr class="Light" height="25">
                   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
                </tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading" >Seed Stage&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="sstage" size="15" maxlength="15" class="tbltext" value="Condition" readonly="true" style="background-color:#CCCCCC" />
 <!--<select class="tbltext" name="sstage" style="width:100px;" >
    <option value="ALL" selected>--ALL--</option>
  	<option value="Raw" >Raw</option>
	<option value="Condition" >Condition</option>
	<option value="Pack" >Pack</option>
	</select>&nbsp;<font color="#FF0000">*</font>--></td>
</tr>				
				<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading" >Result&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="result" size="10" maxlength="10" class="tbltext" value="OK" readonly="true" style="background-color:#CCCCCC" /></td>
           </tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading" >Duration since last QC test&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="duration" class="tbltext" value="dsel" onclick="durtypsel(this.value)" />&nbsp;Select&nbsp;&nbsp;<input type="radio" name="duration" class="tbltext" value="dfill" onclick="durtypsel(this.value)" />&nbsp;Fill<input type="hidden" name="durtyp" value="" /></td>
           </tr>
 </table>
 <div id="seltbl" style="display:none">
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		   	   
<tr class="Light" height="30">
	<td width="272" align="right"  valign="middle" class="tblheading" >Select Duration&nbsp;</td>
 <td width="272" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="dotage" id="dotage" style="width:100px;" >
    <option value="ALL" selected>--ALL--</option>
  	<option value="less45" >Less than 45 days</option>
	<option value="45-90" >45 to 90 days</option>
	<option value="more90" >More than 90 days</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
</tr>		   
</table>
</div>
<div id="filltbl" style="display:none">
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		   	   
<tr class="Light" height="30">
	<td width="272" align="right"  valign="middle" class="tblheading" >Select Duration&nbsp;&nbsp;&nbsp;<select class="tbltext" name="fillagetyp" id="fillagetyp" style="width:100px;" >
	<option value="" selected="selected" >-Select-</option>
  	<option value="less" >Less than</option>
	<option value="equalto" >Equal to</option>
	<option value="more" >More than</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
 <td width="272" align="left"  valign="middle" class="tbltext">&nbsp;&nbsp;<input type="text" name="totdays" class="tbltext" size="3" maxlength="3" value="" />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;days</td>
</tr>		   
</table>
</div>
<table width="550" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"><input type="hidden" name="txtinv" /><input type="hidden" name="flagcode" value=""/><input type="hidden" name="fet1" value="" /></td>
</tr>
</table>
</td><td ></td>
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
