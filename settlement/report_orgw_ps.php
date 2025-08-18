<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='login.php' ";
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
		$sdate=$_REQUEST['sdate'];
		$edate=$_REQUEST['edate'];
		$cid = $_REQUEST['txtcrop'];
		$itemid = $_REQUEST['txtvariety'];
		$txtpmcode = $_REQUEST['txtpmcode'];
		$setlps = $_REQUEST['setlps'];
		
		$btnval=$_REQUEST['btnval'];
		
		if($sdate!="" && $edate!="")
		{
		if($btnval!=0)
		{ 
		$sdate="'$sdate'";
		$edate="'$edate'";
		$txtpmcode="'$txtpmcode'"; 
		if($cid=="ALL")$cid="'ALL'";
		if($itemid=="ALL")$itemid="'ALL'";
		?>
		<script>
		mywindow='excel-orgwps.php?sdate=';
		mywindow=mywindow+<?php echo $sdate?>;
		mywindow=mywindow+'&edate='+<?php echo $edate?>;
		mywindow=mywindow+'&txtcrop='+<?php echo $cid?>+'&txtvariety='+<?php echo $itemid?>+'&txtpmcode='+<?php echo $txtpmcode?>+'&setlps='+<?php echo $setlps?>;
		winHandle=window.open(mywindow,'WelCome','top=5,left=5,width=5,height=1,scrollbars=No');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
		</script>
		<?php
		}
		else
		{
		echo "<script>window.location='report_orgw_ps1.php?sdate=$sdate&edate=$edate&txtcrop=$cid&txtvariety=$itemid&txtpmcode=$txtpmcode&setlps=$setlps'</script>";
		}
		}
		else
		 {?>
		 <script>
		  alert("Please Select Period for search");
		  </script>
		 <?php }
	}
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Settlement - Report - Organiser wise Settlement Status Report</title>
<link href="../include/main_settlement.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_settlement.css" rel="stylesheet" type="text/css" />
</head>
<script src="dailrep.js"></script>
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

function smpabort(btval)
{
		document.frmaddDepartment.btnval.value=btval;
		//alert(document.frmaddDepartment.btnval.value);
}	

function mySubmit()
{ 
	//alert(document.frmaddDepartment.btnval.value);
	dt1=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.edate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.cdate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
	
	if(dt2 > dt3)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
	
	if(dt1 > dt3)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
if(document.frmaddDepartment.txtpmcode.value == "")
{
alert("Please Select Organiser");
return false;
}
if(document.frmaddDepartment.txtcrop.value == "")
{
alert("Please select Crop");
return false;
}
if(document.frmaddDepartment.txtvariety.value == "")
{
alert("Please Select Variety");
return false;
}
	return true;	 
}
function modetchk(classval)
{	
	showUser(classval,'vitem','itemowpsr','','','','','');
}

function modetchk2(classval)
{	
	if(document.frmaddDepartment.txtcrop.value == "")
	{
		alert("Please select Crop");
		return false;
	}
}
function modetchk5(classval)
{	
/*	if(document.frmaddDepartment.txtvariety.value == "")
	{
		alert("Please Variety");
		return false;
	}
*/
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_settlement.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" style="border-bottom:solid; border-bottom-color:#ef0388" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >Organiser wise Settlement Status Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit()" > 
	  <input name="btnval" value="0" type="hidden">
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
          <tr height="7">
            <td height="7"></td>
          </tr>
          <tr>
            <td width="30"></td>
            <td><table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#ef0388" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">Organiser wise Settlement Status Report</td>
                </tr>
                <tr height="15">
                  <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
                </tr>
                <?php
 /*$code="";
$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept order by dept_name Asc"); */
?>
                <tr class="Dark" height="25">
                  <td width="33%" height="30" align="right" valign="middle" class="tblheading">Period &nbsp;&raquo;&nbsp;&nbsp;From&nbsp;</td>
                  <td width="19%" align="left"  valign="middle" >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
                  <td width="10%" align="right"  valign="middle" class="tblheading">&nbsp;To&nbsp;</td>
                  <td width="38%" align="left"  valign="middle" >&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDepartment.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
</tr>
<?php
$zzss="";
$sql_sel1="select distinct organiser from tblarrival_sub where plantcode='$plantcode' AND organiser!='$zzss' and organiser!='NULL' order by organiser asc";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
?>
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" colspan="2">Organiser&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2" >&nbsp;<select class="tbltext" name="txtpmcode" style="width:170px;" onChange="modetchk5(this.value)">
<option value="" selected>--Select--</option>
 <?php while($noticia_item1 = mysqli_fetch_array($res1)) { ?>
		<option value="<?php echo $noticia_item1['organiser'];?>" />   
		<?php echo $noticia_item1['organiser'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

                <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" colspan="2">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value)">
<option value="ALL" selected>ALL</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">
	<td align="right"  valign="middle" class="tblheading" colspan="2" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem" colspan="2">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onChange="modetchk2(this.value)" >
<option value="ALL" selected>ALL</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
                
</tr>

<tr class="Dark" height="25">
	<td align="right"  valign="middle" class="tblheading" colspan="2" >Settlement Status&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="2">&nbsp;<select class="tbltext" id="pstatus" name="setlps" style="width:170px;" >
<option value="both" selected>Both</option>
<option value="psdone" >PS Done</option>
<option value="psnotdone" >PS Not Done</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
                
</tr>
              </table>
                <table width="650" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center"><a href="report_orgw_prosts.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" />&nbsp;&nbsp;<input name="Submit" type="image" src="../images/excelicon1.jpg" alt="Export to Excel"  border="0" style="display:inline;cursor:pointer;" onClick="smpabort('1');" />
                        <input type="hidden" name="txtinv" />
                      <input type="hidden" name="flagcode" value=""/>
                      <input type="hidden" name="flagcode1" value=""/></td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
