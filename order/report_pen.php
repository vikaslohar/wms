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
		$sdate = $_POST['sdate'];
		$txtptyp=trim($_POST['txtptyp']);
		$txt11=trim($_POST['txt11']);
	    $reptyp1 = $_POST['reptyp1'];	
		
		$txtpartycat1="";
		$fillpartyname1="";
		$partyname="";
		$txtpp="";
		$txtstatesl="";
		$txtlocationsl="";
		$txtcountrysl="";
		$txtptype="";
		$txtparty="";

		$partyname=trim($_POST['partyname']);
		$fillpartyname1=trim($_POST['fillpartyname1']);
		if($fillpartyname1=="")
		{
			$txtpartycat1=trim($_POST['txtpartycat1']);
			$txtpp=trim($_POST['txtpp']);
			$txtptype=trim($_POST['txtptype']);
			if($txtpp!="Export Buyer")
			{
				$txtstatesl=trim($_POST['txtstatesl']);
				$txtlocationsl=trim($_POST['txtlocationsl']);
			}
			else
			{
				$txtcountrysl=trim($_POST['txtcountrysl']);
			}
			$txtparty=trim($_POST['txtparty']);
		}
		
		
				//exit;
		echo "<script>window.location='report_pending1.php?sdate=$sdate&txtptyp=$txtptyp&txt11=$txt11&txtpartycat1=$txtpartycat1&fillpartyname1=$fillpartyname1&partyname=$partyname&txtpp=$txtpp&txtstatesl=$txtstatesl&txtlocationsl=$txtlocationsl&txtcountrysl=$txtcountrysl&txtptype=$txtptype&txtparty=$txtparty&reptyp1=$reptyp1'</script>";
		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order-Report -Party wise Compiled Pending Order Report  </title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="party.js"></script>
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
function rck(rval)
{
document.frmaddDepartment.flagcode.value=rval;
}
function gotchk(gotval)
{	
var classval=document.frmaddDepartment.txtptyp.value; 
document.getElementById('selectpartylocation').style.display="none";
document.getElementById('selectparty').style.display="none";
showUser(classval,'partytyp','partytypslchk','','','','','');
document.frmaddDepartment.txt11.value=gotval; 
}
	function modetchk1(classval)
{	
	//alert(classval);
		//showUser(classval1,'party1','party','','','','','',classval1);
		if(classval != "")
		{
		if(classval=="C&F")classval="CandF";
		document.getElementById('selectpartylocation').style.display="block";
		document.getElementById('selectparty').style.display="none";
		showUser(classval,'selectpartylocation','partylocation','','','','','');
		document.frmaddDepartment.txtptype.value=classval;
		}
}
function locslchk(statesl)
{
showUser(statesl,'locations','location','','','','','','');
document.getElementById('selectparty').style.display="block";
}
function stateslchk(valloc)
{
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
	}
	else
	{
		var classval=document.frmaddDepartment.txtptype.value;
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'selectparty','partychk1',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}
function loccontrychk(countryval)
{
		if(document.frmaddDepartment.txtpp.value!="")
		{
			var classval=document.frmaddDepartment.txtptype.value;
			document.getElementById('selectparty').style.display="block";
			showUser(classval,'selectparty','partychk1',countryval,'','','','');
			document.frmaddDepartment.locationname.value=countryval;
		}
		else
		{
			alert("Please Select Party Type");
			document.frmaddDepartment.txtcountrysl.selectedIndex=0;
		}

}

function partycatsl1(catslval)
{
if(document.frmaddDepartment.reptyp1.value=="")
	{
		alert("Please select Hold Item Records to be part of Report Yes or No");
		document.frmaddDepartment.txtpartycat1.value="";
		return false;
	}
	else
	{
document.frmaddDepartment.fillpartyname1.value="";
document.frmaddDepartment.fillpartyname1.disabled=true;
//showUser(catslval,'orderpsltyp1','partytypslchk1','','','','','');
document.getElementById('orderpsltyp1').style.display="block";
document.getElementById('selectpartylocation').style.display="none";
document.getElementById('selectparty').style.display="none";
document.getElementById('txtpp').length = 1;
document.getElementById('txtpp').selectedIndex=0;
if(catslval!="TDF - Individual")
{
	var radList = document.getElementsByName('cattyp');
	for (var i = 0; i < radList.length; i++) {
	if(radList[i].value=="Commercial" || radList[i].value=="Both") radList[i].disabled = false;;
	if(radList[i].checked) radList[i].checked = false;}
}
else
{
	var radList = document.getElementsByName('cattyp');
	for (var i = 0; i < radList.length; i++) 
	{
		if(radList[i].value=="Commercial" || radList[i].value=="Both") radList[i].disabled = true;
		if(radList[i].value=="TDF") radList[i].checked = true;
	}
	showUser(catslval,'partytyp','partytypslchk','','','','','');
	document.frmaddDepartment.txt11.value="TDF"; 
}
document.frmaddDepartment.txtptyp.value=catslval;
}
}

function fillpartysl1(fpslval)
{
document.frmaddDepartment.txtpartycat1.SelectedIndex=0;
document.frmaddDepartment.txtpartycat1.disabled=true;
document.getElementById('orderpsltyp1').style.display="none";
document.getElementById('selectpartylocation').style.display="none";
document.getElementById('selectparty').style.display="none";
document.frmaddDepartment.partyname.value=fpslval;
}

function mySubmit()
{ 
if(document.frmaddDepartment.reptyp1.value=="")
	{
		alert("Please Select Hold Or Unhold Type");
		return false;
	}
	if(document.frmaddDepartment.fillpartyname1.value=="" && document.frmaddDepartment.txtptyp.value=="")
	{
		alert("Select Order Type \n\nOR \n\nFill Party Name");
		return false;
	}
	if(document.frmaddDepartment.fillpartyname1.value=="" && document.frmaddDepartment.txtptyp.value!="")
	{
		if(document.frmaddDepartment.txt11.value=="")
		{
			alert("Select Category");
			return false;
		}
		if(document.frmaddDepartment.txtpp.value=="")
		{
			alert("Select Party Type");
			return false;
		}
		if(document.frmaddDepartment.txtpp.value!="")
		{
			if(document.frmaddDepartment.txtpp.value!="Export Buyer")
			{
				if(document.frmaddDepartment.txtstatesl.value=="")
				{
					alert("Please Select State");
					return false
				}
				if(document.frmaddDepartment.txtlocationsl.value=="")
				{
					alert("Please Select Location");
					return false
				}
				if(document.frmaddDepartment.txtlocationsl.value!="")
				{
					if(document.frmaddDepartment.txtparty.value=="")
					{
						alert("Please Select Party");
						return false
					}
				}
			}
			else
			{
				if(document.frmaddDepartment.txtcountrysl.value=="")
				{
					alert("Please Select Country");
					return false
				}
				if(document.frmaddDepartment.txtcountrysl.value!="")
				{
					if(document.frmaddDepartment.txtparty.value=="")
					{
						alert("Please Select Party");
						return false
					}
				}
			}
		}
	}	
	return true;
}
function holdchk(hlval)
{
	document.frmaddDepartment.reptyp1.value=hlval;
}
</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_order.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Party wise Compiled Pending Order Report  
	        </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	 <input name="txtptype" value="" type="hidden">
	 <input name="txtptyp" value="" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	 <input name="reptyp1" value="" type="hidden"> 
	 <input type="hidden" name="txtconchk" value="" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Party wise Compiled Pending Order Report</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 <?php
 /*$code="";
$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept order by dept_name Asc"); */
?>
		<tr class="Dark" height="25">
		<td align="right" height="30" valign="middle" class="tblheading">Hold Item Records to be part of Report&nbsp;</td>
     <td align="left"  valign="middle" ><input type="radio" name="reptyp" value="hold" onclick="holdchk(this.value);" />&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="reptyp" value="unhold" onclick="holdchk(this.value);"  />&nbsp;No&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           <td align="right" width="201" height="30" valign="middle" class="tblheading">&nbsp;As on Date&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<font color="#FF0000" >*</font></td>
   </tr>
<!-- <tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Select Order Type&nbsp;</td>
<td width="230" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgstat" style="width:150px;" onChange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="Order Sales" >Sales</option>
	<option value="Order Stock">Stock Transfer</option>
	<option value="TDF - Individual">TDF</option>
	</select>&nbsp;</td>
<?php
$sql_month=mysqli_query($link,"select * from tblclassification where main='Stock Transfer' order by classification")or die(mysqli_error($link));
?>
 
<td width="161" align="right"  valign="middle" class="tblheading">Fill Party name&nbsp;</td>
<td width="248" align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" name="fillpartyname1" class="tbltext" size="35" value="" <?php if($a=="Commercial") echo 'disabled'; ?> title="Fill the TDF Party Name to search which is not available in Party master" onchange="fillpartysl1(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp; <input type="hidden" name="partyname" value="" /></td>
	</tr>-->
			<tr class="Dark" height="30">
<td width="170" align="right"  valign="middle" class="tblheading" >Select Order Type&nbsp;</td>
<td width="206" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpartycat1" style="width:80px;" onChange="partycatsl1(this.value);">
    <option value="" selected="selected">--Select--</option>
	<option value="Order Sales" >Sales</option>
	<option value="Order Stock">Stock Transfer</option>
	<option value="TDF - Individual">TDF</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading" >Fill Party Name&nbsp;</td>
<td width="342" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="fillpartyname1" class="tbltext" size="35" value="" <?php if($a=="Commercial") echo 'disabled'; ?> title="Fill the TDF Party Name to search which is not available in Party master" onChange="fillpartysl1(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp; <input type="hidden" name="partyname" value="" /></td>
</tr>

<tr height="15"><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">Select Order Type to select Party in cases where party is listed under party master.</div></td><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">In case of TDF, where party is not present in party master. Specify Exact Party Name, here</div></td></tr>	
		</table>
<div id="orderpsltyp1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="25">
<td width="170" align="right" valign="middle" class="tblheading">Category&nbsp;</td>
<td width="206" align="left" valign="middle" class="tbltext">&nbsp;<input type="radio" name="cattyp" value="Commercial" onClick="gotchk(this.value);" />&nbsp;Commercial&nbsp;<input type="radio" name="cattyp" value="TDF" onClick="gotchk(this.value);" />&nbsp;TDF&nbsp;<input type="radio" name="cattyp" value="Both" onClick="gotchk(this.value);" />&nbsp;Both</td>
<?php
$sql_month=mysqli_query($link,"select * from tblclassification where main='Stock Transfer' order by classification")or die(mysqli_error($link));
?>
 
<td width="122" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td width="342" align="left"  valign="middle" class="tbltext"   id="partytyp" >&nbsp;<select class="tbltext" id="txtpp" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" >
<option value="" selected>--Select--</option>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>
</div>
<div id="selectpartylocation" style="display:none" ></div>		   
<div id="selectparty" style="display:none" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="171" align="right"  valign="middle" class="tblheading" >Party Name &nbsp;</td>
<td width="673" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;"  >
<option value="ALL" selected="selected">--ALL--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="report_pending.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"><input type="hidden" name="flagcode" value=""/></td>
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
