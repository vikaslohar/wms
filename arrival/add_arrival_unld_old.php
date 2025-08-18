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
		exit;
		$p_id=trim($_POST['maintrid']);
		$dcdate=trim($_POST['dcdate']);
		$dcdate1=trim($_POST['dcdate']);
		$txtdcnumber=trim($_POST['txtdcnumber']);
		$txt11=trim($_POST['txt11']);
		$remarks=trim($_POST['txtremarks1']);
		$remarks=str_replace("&","and",$remarks);
		
		if($txt11=="Transport")
		{
			$txttname=trim($_POST['txttname']);
			$txtlrn=trim($_POST['txtlrn']);
			$txtvn=trim($_POST['txtvn']);
			$txt14=trim($_POST['txt14']);
		}
		else
		{
			$txttname="";
			$txtlrn="";
			$txtvn="";
			$txt14="";
		}
		
		if($txt11=="Courier")
		{
			$txtcname=trim($_POST['txtcname']);
			$txtdc=trim($_POST['txtdc']);
		}
		else
		{
			$txtcname="";
			$txtdc="";
		}
		if($txt11=="By Hand")
		{ 
			$txtpname=trim($_POST['txtpname']);
		}
		else
		{
			$txtpname="";
		}
		
		echo "<script>window.location='add_arrival_unld_preview.php?p_id=$p_id&dcdate=$dcdate&dcdate1=$dcdate1&txtdcnumber=$txtdcnumber&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&remarks=$remarks'</script>";	
		
		
	}

	$sql_code="SELECT MAX(arrival_code) FROM tblarrival_unld where arrival_type='Fresh Seed with PDN'  AND yearcode ='$yearid_id' and plantcode='$plantcode' ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="TAF".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="TAF".$code."/".$yearid_id."/".$lgnid;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Fresh Seed Arrival with PDN</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

</head>

<script src="farrivalunld.js"></script>

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

function imgOnClick(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.txtpdndate,dt,document.frmaddDepartment.txtpdndate, "dd-mmm-yyyy", xind, yind);
	}  
function imgOnClick1(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}  
function imgOnClick2(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.dcdate,dt,document.frmaddDepartment.dcdate, "dd-mmm-yyyy", xind, yind);
	}  	
function imgOnClick3(dt, xind, yind)
	{//document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.dcdate1,dt,document.frmaddDepartment.dcdate1, "dd-mmm-yyyy", xind, yind);
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

function pform()
{	
	var f=0;
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.cdate.value,"-");
	dt5=getDateObject(document.frmaddDepartment.dcdate1.value,"-");
	if(document.frmaddDepartment.dcdate.value!="")
	{	
		if(dt3 > dt4)
		{
			alert("Please select Valid Delivery Challan Date.");
			f=1;
			return false;
		}
		if(dt3 > dt5)
		{
			alert("Please select Valid Delivery Challan Date.");
			f=1;
			return false;
		}
		if(dt5 > dt4)
		{
			alert("Please select Valid Dispatch Date.");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.dcdate1.value!="")
	{	
		if(dt3 > dt5)
		{
			alert("Please select Valid Dispatch Date.");
			f=1;
			return false;
		}
		if(dt5 > dt4)
		{
			alert("Please select Valid Dispatch Date.");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		document.frmaddDepartment.txtpdno.focus();
		f=1;
		return false;
	}
	else
	{	
		if(f==1)
		{
			return false;
		}
		else
		{	
			var a=formPost(document.getElementById('mainform'));
			showUser(a,'postingtable','mformlotsetup','','','','','');
		}  
	}
}

function pformedtup()
{	
	var f=0;
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.cdate.value,"-");
	dt5=getDateObject(document.frmaddDepartment.dcdate1.value,"-");
	if(document.frmaddDepartment.dcdate.value!="")
	{	
		if(dt3 > dt4)
		{
			alert("Please select Valid Delivery Challan Date.");
			f=1;
			return false;
		}
		if(dt3 > dt5)
		{
			alert("Please select Valid Delivery Challan Date.");
			f=1;
			return false;
		}
		if(dt5 > dt4)
		{
			alert("Please select Valid Dispatch Date.");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.dcdate1.value!="")
	{	
		if(dt3 > dt5)
		{
			alert("Please select Valid Dispatch Date.");
			f=1;
			return false;
		}
		if(dt5 > dt4)
		{
			alert("Please select Valid Dispatch Date.");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		document.frmaddDepartment.txtpdno.focus();
		f=1;
		return false;
	}
	else
	{	
		if(f==1)
		{
			return false;
		}
		else
		{	
			var a=formPost(document.getElementById('mainform'));
			showUser(a,'postingtable','mformsubedtlotsetup','','','','','');
		}
	}
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
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
function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function openslocpop()
{
document.getElementById("postingsubtable").style.display="none";
var itm="Fresh Seed with PDN";
winHandle=window.open('getuser_fpdnunld_lotno.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}


function deleterec(v1,v2,v3)
{
	if(confirm('Do You wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','fpdndelete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}

	
function mySubmit()
{ 
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.cdate.value,"-");
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	return false;
	}
	
			
	
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	return true;	 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#FAD682" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#FAD682" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#FAD682" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Fresh Seed Arrival with PDN - Unloading</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		 <input name="satype" value="" type="hidden"> 
		  <input name="satype1" value="" type="hidden"> 
		 <input name="cdate" value="<?php echo date("d-m-Y");?>" type="hidden"> 
		</br>
<?php
 $tid=0; $subtid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Fresh Seed Arrival with PDN - Unloading</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="131" align="right" valign="middle" class="tblheading"> Type of Arrival&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="arrivaltype1" type="text" size="35" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="Fresh Seed Arrival With PDN" maxlength="35"/>&nbsp;<input name="arrivaltype" type="hidden" size="35" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="Fresh Arrival With PDN" maxlength="35"/><input name="dateofarrival" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#efefef" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td width="205" align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#efefef" value="" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Dispatch Date&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="dcdate1" id="dcdate1"  type="text" size="10" class="tbltext" tabindex="1" readonly="true"  style="background-color:#efefef" value="" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>


<tr class="Dark" height="30">
<?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td width="205" align="right"  valign="middle" class="tblheading">DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txtdcnumber" type="text" size="21" class="tbltext" tabindex=""    maxlength="20" />&nbsp;&nbsp;</td>
</tr>
</table>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
  <td width="1%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-F</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-M</td>
	<td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN </td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
          </table>
		  <br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="8" class="tbltext" tabindex=""  maxlength="6"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
</tr>
</table><br />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubtable" style="display:block">
</div>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >

<tr>
<td valign="top" align="right"><a href="home_freshpdn_unld.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;"  /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Unloading Setup Finish"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  