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
				
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - GOT Result Pending List</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="gotdata.js"></script>
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

function openslocpopprint(tid)
{
winHandle=window.open('getuser_got1.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}


function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
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
function mySubmit()
{	
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
return true;
}
function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}

function modetchk(classval)
{
	showUser(classval,'vitem','item','','','','','');
}
function openslocpop()
{
	if(document.frmaddDept.txtclass.value=="")
	{
	 alert("Please Select Crop");
	 return false;
	}
	else if(document.frmaddDept.txtitem.value=="")
	{
	 alert("Please Select Variety");
	 return false;
	}
	else
	{
	document.getElementById('maindiv').innerHTML="";
	var crop=document.frmaddDept.txtclass.value;
	var variety=document.frmaddDept.txtitem.value;
		
	winHandle=window.open('getuser_gotdata_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
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
	      <td width="940" height="25">&nbsp;Transaction - GOT Data </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">GOT Data</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop order by cropname") or die(mysqli_error($link));
?>

<tr class="Dark" height="25">
<td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
<td align="left" width="354" valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>
	</td>
	
<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
<td width="154" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext" id="vitem" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:170px;" onchange="modetchk24(this.value);" >
<option value="" selected>---Select Variety---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">
<td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="354" valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<input type="hidden" name="orlot" value="" /><a href="Javascript:void(0);" onclick="openslocpop();">Select</a><font color="#FF0000">*</font></td>
</tr>
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">GOT Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<tr class="Dark" height="25">
<td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;DoS&nbsp;</td>
<td width="354" align="left" valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtdate" type="text" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" /></td>
	          
<td width="154" align="right" valign="middle" class="tblheading">DoT&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdate" type="text" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" /></td>
</tr>

<tr class="Dark" height="25">
<td width="154" align="right" valign="middle" class="tblheading">BED NO.&nbsp;</td>
<td width="354" align="left" valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>

<td width="154"  align="right"  valign="middle" class="tblheading">DIR&nbsp;</td>
<td width="354" align="left" valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>
</tr>
<tr class="Dark" height="25">
<td width="154" align="right" valign="middle" class="tblheading">Location&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>

<td width="98" align="right" valign="middle" class="tblheading">Plant Popn&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>
</tr>

<tr class="Dark" height="25">
<td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Female&nbsp;</td>
<td width="354" align="left" valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlotnumber" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td width="154" align="right" valign="middle" class="tblheading">Male&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlotnumber" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td width="154" align="right" valign="middle" class="tblheading">OOF&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlotnumber" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>

<td width="154" align="right" valign="middle" class="tblheading">Total&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="3" class="tbltext" tabindex=""  maxlength="20"  value="" >&nbsp;No.&nbsp;&nbsp;&nbsp;<input name="txtlotnumber" type="text" size="4" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >%</td>
</tr>

<tr class="Dark" height="25">
<td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;GP (%)&nbsp;</td>
<td width="354" align="left" valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>

<td width="154" align="right" valign="middle" class="tblheading">DOO&nbsp;</td>
<td width="354" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>
</tr>

<tr class="Dark" height="25">
<td width="98" align="right" valign="middle" class="tblheading">GOT Status&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>

<td width="89" align="right" valign="middle" class="tblheading">Result Date&nbsp;</td>
<td width="193" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" ></td>
</tr>
</table>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr></table><br />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
</tr>
</table>

</td>
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
