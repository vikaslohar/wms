<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$cid = $_REQUEST['txtcrop'];
		$itemid = $_REQUEST['txtvariety'];
		
		echo "<script>window.location='report_rawsscrop1.php?txtcrop=$cid&txtvariety=$itemid'</script>";
	}
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW - Report - Crop Variety wise Substandard Raw Seed Report</title>
<link href="../../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="stock.js"></script>
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

function mySubmit()
{ 
	if(document.frmaddDepartment.txtcrop.value == "")
	{
		alert("Please select Crop");
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value == "")
	{
		alert("Please Variety");
		return false;
	}
return true;	 
}
	
function modetchk(classval)
{	//alert("hi");
			showUser(classval,'vitem','item','','','','','');
}

</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../../include/arr_plant1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >Crop Variety wise Substandard Raw Seed Report </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	  <input type="hidden" name="slck" value="yes" />
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
          <tr height="7">
            <td height="7"></td>
          </tr>
          <tr>
            <td width="30"></td>
            <td><table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="2" align="center" class="tblheading">Crop Variety wise Substandard Raw Seed Report</td>
                </tr>
                <tr height="15">
                  <td colspan="2" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
                </tr>

                <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
 <tr class="Light" height="25">
<td width="297" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="297" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value)">
<option value="ALL" selected>--ALL--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
</tr>
                <tr class="Dark" height="25">
                   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="ALL" selected>--ALL--</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
                
</tr>
              </table>
                <table width="600" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center"><a href="rsw_mod_ reports.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" /></td>
                  </tr>
              </table></td>
            <td ></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
	    <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	  </form>	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../../images/istratlogo.gif"  align="left"/><img src="../../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
 