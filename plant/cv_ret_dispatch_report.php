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
		
		$sdate=trim($_POST['sdate']);
		$edate=trim($_POST['edate']);
		/*$txtstate=trim($_POST['txtstate']);
		$txtloc=trim($_POST['locationname']);
		$txtparty=trim($_POST['txtparty']);*/
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		//$txtlotno=trim($_POST['txtlotno']);
		$txtupsdc=trim($_POST['txtupsdc']);	
		//$txtdisptype=trim($_POST['txtdisptype']);
		//locationname
		//exit;
		
		if($sdate!="")
		{
			echo "<script>window.location='cv_ret_dispatch_report1.php?sdate=$sdate&edate=$edate&txtcrop=$txtcrop&txtvariety=$txtvariety&txtupsdc=$txtupsdc'</script>";
		}
		else
		{
		?>
		<script>
			alert("Please Select Date");
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
<title>Dispatch-Report - Crop Variety Wise C&F Dispatch Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschkrep.js"></script>
<script src="../include/validation.js"></script>
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

function modetchk(classval)
{	
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1(classval)
{	
	var cropval=document.frmaddDepartment.txtcrop.value;
	showUser(classval,'vitem2','itemups',cropval,'','','','');
}

function verchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please selecy Variety");
		document.frmaddDepartment.txtupsdc.value;
		return false;
	}
}

function locsel(classval)
{
	document.frmaddDepartment.txtlocationsl.value="ALL";
	document.frmaddDepartment.txtlocationsl.selectedIndex=0;
	document.frmaddDepartment.txtparty.value="ALL";
	document.frmaddDepartment.txtparty.selectedIndex=0;
	var txtdisptype=document.frmaddDepartment.txtdisptype.value;
	showUser(classval,'litem2','itemloc','','','','','');
	setTimeout(function(){ 
	var locationname="ALL";
	showUser(locationname,'pitem2','selparty',txtdisptype,classval,'','','');
	//showUser(locationname,'pitem2','selparty',classval,'','','','');
	},1000);
}

function stateslchk(classval)
{
	document.frmaddDepartment.locationname.value="";
	document.frmaddDepartment.txtparty.value="ALL";
	document.frmaddDepartment.txtparty.selectedIndex=0;
	var txtdisptype=document.frmaddDepartment.txtdisptype.value;
	document.frmaddDepartment.locationname.value=classval;
	var txtstate=document.frmaddDepartment.txtstate.value;
	showUser(classval,'pitem2','selparty',txtdisptype,txtstate,'','','');
}

function loccontrychk(classval)
{
	document.frmaddDepartment.locationname.value="";
	document.frmaddDepartment.txtparty.value="ALL";
	document.frmaddDepartment.txtparty.selectedIndex=0;
	var txtdisptype=document.frmaddDepartment.txtdisptype.value;
	document.frmaddDepartment.locationname.value=classval;
	var txtstate='';
	showUser(classval,'pitem2','selparty',txtdisptype,txtstate,'','','');
}

function chkstloc(classval)
{
	if(classval=="C" || classval=="C&F" || classval=="CandF")
	{
		classval="CandF";
	}
	showUser(classval,'stloc','selstloc','','','','','');
	setTimeout(function(){ 
	if(classval=="Export Buyer")
	{	
		document.frmaddDepartment.txtcountrysl.value="ALL";	
		document.frmaddDepartment.txtcountrysl.selectedIndex=0;	
	}
	else
	{	
		document.frmaddDepartment.txtstate.value="ALL";	
		document.frmaddDepartment.txtstate.selectedIndex=0; 
		document.frmaddDepartment.txtlocationsl.value="ALL"; 
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
	}	
	document.frmaddDepartment.txtparty.value="ALL";
	document.frmaddDepartment.txtparty.selectedIndex=0;
	document.frmaddDepartment.locationname.value="ALL";
	var locationname=document.frmaddDepartment.locationname.value;
	//document.frmaddDepartment.locationname.value="ALL";
	if(classval=="Export Buyer")
		var txtstate='';
	else
		var txtstate='ALL';
	showUser(locationname,'pitem2','selparty',classval,txtstate,'','','');
	//showUser(locationname,'pitem2','selparty',classval,'','','','');
	},1000);
}

function chklot(lotval)
{
	var lt=lotval.split("");
	if(isChar_o(lt[0])==false)
	{
		alert("Invalid Lot number");
		return false;
	}
	if(isChar_o(lt[1])==false)
	{
		alert("Invalid Lot number");
		return false;
	}
	for(var i=2; i<lt.length; i++)
	{
		if(isChar_o(lt[i])==true)
		{
			alert("Invalid Lot number");
			return false;
		}
	}
	//alert(lt);
}

function mySubmit()
{ 
	dt1=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.edate.value,"-");
		
	if(dt1 > dt2)
	{
		alert("Please select Valid Date.");
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
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Crop Variety Wise C&F Dispatch Report</td>
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading" >Crop Variety Wise C&F Dispatch Report</td>
                </tr>
                <tr height="15">
                  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
                </tr>
                <tr class="Dark" height="25">
                  <td width="130" align="right"  valign="middle" class="smalltblheading">&nbsp;Period&nbsp;&raquo;&nbsp;&nbsp;&nbsp;From&nbsp;</td>
                 <td width="240" align="left"  valign="middle" class="smalltblheading">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a></td>
                
				
                  <td width="93" align="right"  valign="middle" class="smalltblheading">&nbsp;To&nbsp;</td>
                  <td width="277" align="left"  valign="middle" class="smalltblheading">&nbsp;<input name="edate" id="edate" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a></td>
                </tr>

	  <tr class="Light" height="25">   
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='Paddy' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
?>            
<td align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtcropname" style="width:150px; background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>"  /><input type="hidden" name="txtcrop" value="<?php echo $noticia['cropid'];?>" /></td>
<?php
$quer_ver=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer_ver);
?>
	<td align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" id="itm" name="txtvariety" style="width:70px; background-color:#CCCCCC" readonly="true" value="ALL"  /></td>
</tr>
<tr class="Light" height="25">
<?php
$quer_ups=mysqli_query($link,"Select * from tblups order by uom"); 
?>				
     <td align="right"  valign="middle" class="smalltblheading" >UPS&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" id="vitem2" colspan="3">&nbsp;<input type="text" class="smalltbltext" id="upsdc" name="txtupsdc" style="width:40px; background-color:#CCCCCC" readonly="true" value="ALL"  /></td>             
	
</tr>

 </table><br />
<table width="750" cellpadding="5" cellspacing="5" border="0" align="center" >
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
 