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
	
/*	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where aflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['tid'];	
}*/
		
	if(isset($_POST['frm_action'])=='submit')
	{

				$txt11=trim($_POST['txt11']);
				$txtcrop=trim($_POST['txtcrop']);
				$txtvariety=trim($_POST['txtvariety']);
				$cvslchb=trim($_POST['cvslchb']);
				$wh=trim($_POST['wh']);
		//exit;
		echo "<script>window.location='report_qcsamp1.php?txt11=$txt11&txtcrop=$txtcrop&txtvariety=$txtvariety&cvslchb=$cvslchb&wh=$wh'</script>";
		
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report - QC Sample Pending List</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading.js"></script>
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

function modetchk(classval)
{
	//alert(classval);
	showUser(classval,'vitem','item','','','','','');
	//document.frmaddDepartment.txtlot1.value==""
}
function typchk(opt)
{
//alert(opt);
	if(opt!="")
	{
		if(opt=="cvsloc")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
		}
		else if(opt=="sloc")
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
		}	
		else 
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
		}
		document.frmaddDepartment.txt11.value=opt;
	}
	else
	{
		document.frmaddDepartment.txt11.value="";
	}
}

function mySubmit()
{	
	var maintyp=document.frmaddDepartment.txt11.value;
	if(maintyp=="")
	{
		alert("Please Select Type");
		return false;
	}
	if(maintyp=="cvsloc")
		{
			val1=document.frmaddDepartment.txtcrop.value;
			val2=document.frmaddDepartment.txtvariety.value;
			//val4=document.frmaddDepartment.cvslhb.value;

			if(val1=="")
			{
				alert("Please Select Crop");
				return false;
			}
			if(val2=="")
			{
				alert("Please Select Variety");
				return false;
			}
/*			if(val4=="")
			{
				alert("Please Select ");
				return false;
			}
*/			
		}
		
		if(maintyp=="sloc")
		{
			val1=document.frmaddDepartment.wh.value;
			if(val1=="")
			{
				alert("Please Select Warehouse");
				return false;
			}
		}
return true;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_quality.php");?></td>
         </tr>
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="820" height="25">&nbsp;Report - QC Sample Pending List </td>
	    </tr></table></td>
	 <!-- <td width="116" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#F1B01E" bordercolordark="#F1B01E" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_result_update.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>
</table></td>-->
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">QC Sample Pending List</td>
                </tr>
  		
				<tr class="Light" height="25">
           <td width="376" align="right"  valign="middle" ><input type="radio" name="reptyp" value="cvsloc" onClick="typchk(this.value);" /></td>
		   <td width="468" height="30" align="left" valign="middle" class="tblheading">&nbsp;Crop-Variety SLOC wise</td>
                </tr>
				<tr class="Dark" height="25">
           <td align="right"  valign="middle" ><input type="radio" name="reptyp" value="sloc" onClick="typchk(this.value);" /></td>
		   <td align="left" height="30" valign="middle" class="tblheading">&nbsp;SLOC wise</td>
                </tr>
		</table>
			  
<div id="trans" style="display:none">
           <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704"  style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Crop-Variety SLOC wise</td>
</tr>
<tr height="15">
<td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Dark" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");

?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
    <tr class="Light" height="30" id="vitem">
		<td width="205" align="right" valign="middle" class="tblheading">SLOC WH wise&nbsp;</td>
		<td width="275"  align="left" valign="middle" class="tbltext" colspan="3"  ><input type="checkbox" name="cvslchb" value="cvslocwise" /></td>
	</tr>
	</table>		  
		   
</div>

<div id="courier"  style="display:none">
           <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704"  style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">SLOC wise</td>
</tr>		   
<tr class="Light" height="25">
<?php
$quer5=mysqli_query($link,"SELECT * FROM tbl_warehouse order by perticulars asc"); 
?>	
		  <td width="377"  align="right"  valign="middle" class="tblheading">&nbsp;Select WH&nbsp; </td>             
		     <td  align="left"  valign="middle">&nbsp;<select class="tbltext" name="wh" style="width:80px;">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['whid'];?>" />  
    <?php echo $noticia['perticulars'];?>
    <?php } ?> </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
</table>	
		   
</div>
<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center"><input name="Submit" type="image" src="../images/next.gif" alt="next Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" />
                        <input type="hidden" name="txtinv" />
                      <input type="hidden" name="flagcode" value=""/>
                      <input type="hidden" name="flagcode1" value=""/></td>
                  </tr>
              </table>
  </tr>       


<td width="30"></td>
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
