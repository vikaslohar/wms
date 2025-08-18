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
				 $reptyp=trim($_POST['reptyp']);
				 $txt=trim($_POST['txt']);
			     $txtlot=trim($_POST['txtlot']);
				 $txtlot1=trim($_POST['txtlot1']);
				 $txtlot2=trim($_POST['txtlot2']);
				 $txtlot3=trim($_POST['txtlot3']);
				  $txtlo=trim($_POST['txtlo']);
				 $pcode=trim($_POST['pcode']);
				$txtcrop=trim($_POST['txtcrop']);
				$txtvariety=trim($_POST['txtvariety']);
				 $txtstage=trim($_POST['txtstage']);
				 $stcode=trim($_POST['stcode']);
				$ycode=trim($_POST['ycodee']);
				 $txtlot4=trim($_POST['txtlot4']);
				 $stcode2=trim($_POST['stcode2']);
				
		
		 $lotno=$pcode.$ycode.$txtlot2."/".$stcode."/".$stcode2;	
		
		echo "<script>window.location='utility_qc12.php?txtlot=$txtlot&txtcrop=$txtcrop&txtvariety=$txtvariety&txtstage=$txtstage&txtlot1=$txtlot1&pcode=$pcode&txt=$txt&txtlot2=$txtlot2&txtlot=$txtlot&txtlot3=$txtlot3&reptyp=$reptyp&txtlot4=$txtlot4&ycodee=$ycode&txtlo=$txtlo&stcode=$stcode&stcode2=$stcode2'</script>";
		
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction -QC Result Update </title>
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

function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	
function modetchk(classval)
{
	//alert(classval);
	showUser(classval,'vitem','item','','','','','');
	//document.frmaddDepartment.txtlot1.value==""
	}

	function openslocpop()
{
if(document.frmaddDepartment.txtcrop.value=="")
{
 alert("Please Select Crop.");
 //document.frmaddDepartment.txt1.focus();
}
if(document.frmaddDepartment.txtvariety.value=="")
{
 alert("Please Select Variety.");
 document.frmaddDepartment.txtvariety.focus();
}
else
{
//var itm="Raw Seed";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;

winHandle=window.open('getuser_qc_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=150,left=160,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function typchk(opt)
{
document.frmaddDepartment.txt11.value=opt;
		if(opt!="")
	{
		if(opt=="select")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			//document.getElementById('byhand').style.display="none";
		
		}
		else if(opt=="lotno")
		{
		//alert("lotno");
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			//document.getElementById('byhand').style.display="none";
			
		}	
		
	}
}

function mySubmit()
{	
//alert(document.frmaddDepartment.reptyp.value);
	var maintyp=document.frmaddDepartment.reptyp.value=document.frmaddDepartment.txt11.value;
	if(maintyp=="")
	{
		alert("Please Select Option");
		return false;
	}
if(maintyp=="select")
{
			val1=document.frmaddDepartment.txtcrop.value;
			val2=document.frmaddDepartment.txtvariety.value;
			val4=document.frmaddDepartment.txtstage.value;
			val5=document.frmaddDepartment.txtlot1.value;
			val3="";
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
			if(val4=="")
			{
				alert("Please Select Stage");
				return false;
			}
			if(val5=="")
			{
				alert("Please Select Lot No.");
				return false;
			}
}
		
if(maintyp=="lotno")
{
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	val8=document.frmaddDepartment.stcode2.value;
	var f=0;
	if(val7=="")
	{
		alert("Please Select Plant code");
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code");
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Lot No.");
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Lot No.");
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Lot No.");
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Lot No.");
		return false;
	} 
	if(val8=="")
	{
		alert("Please Enter Lot No.");
		return false;
	}
	if(val8.length < 2)
	{
		alert("Invalid Lot No.");
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
           <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
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
	      <td width="940" height="25">&nbsp;Utility - Lot Query </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">Select</td>
                </tr>
  		
				<tr class="Light" height="25">
                    
           <td width="376" align="right"  valign="middle" ><input type="radio" name="reptyp" value="select" onClick="typchk(this.value);" /></td>
		   <td width="468" height="30" align="left" valign="middle" class="tblheading">&nbsp;Crop Variety wise</td>
                </tr>
				<tr class="Dark" height="25">
                   
           <td align="right"  valign="middle" ><input type="radio" name="reptyp" value="lotno" onClick="typchk(this.value);" /></td>
		    <td align="left" height="30" valign="middle" class="tblheading">&nbsp;Lot No.</td>
                </tr>
				
              </table>
			  
<div id="trans" style="display:none">
           <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704"  style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Search</td>
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
		            <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#d21704"   colspan="3" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#ECECEC"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
           </tr>
	</table>		  
		   
</div>
<div id="courier"  style="display:none">
           <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704"  style="border-collapse:collapse"  > 
<tr class="Light" height="25">
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters  order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
		  <td width="377"  align="right"  valign="middle" class="tblheading">&nbsp;Select Lot No.&nbsp; </td>             
		     <td colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
    <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" selected="selected" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" style="width:40px;">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event);"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event);"  value="00000" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event);"  value="00" />
	  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
</table>	
		   
</div>
<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center">&nbsp;
                      <input name="Submit" type="image" src="../images/next.gif" alt="next Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" />
                        <input type="hidden" name="txtinv" />
                      <input name="txt11" value="" type="hidden"> 
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
