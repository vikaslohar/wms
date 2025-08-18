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
		$edate = $_POST['edate'];
		$crop = $_POST['txtcrop'];
		$veriety = $_POST['txtvariety'];
		$txtpname=trim($_POST['txtpname']);
		$txtlocaion=trim($_POST['txtlocation']);
		$txtups=trim($_POST['txtups']);
		$txtsrnno=trim($_POST['txtsrnno']);
		$txtpp=trim($_POST['txtpp']);
		$txtstatesl=trim($_POST['txtstatesl']);
		echo "<script>window.location='periodical_sr_report1.php?sdate=$sdate&edate=$edate&txtcrop=$crop&txtvariety=$veriety&txtpname=$txtpname&txtpp=$txtpp&txtstatesl=$txtstatesl&txtlocaion=$txtlocaion&txtups=$txtups&txtsrnno=$txtsrnno'</script>";	
	}

	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Periodical Sales Return Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->


</head>
<script src="srcrrep.js"></script>
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
	showUser(classval,'vitem1','vitem1','','','','','');
}
function locchk(classval) 
{
	showUser(classval,'vloc','vloc','','','','','');
}

function partychk(classval) 
{
	var loc=document.frmaddDepartment.txtlocation.value;
	var ptype=document.frmaddDepartment.txtpp.value;
	showUser(classval,'vpname','vpname',loc,ptype,'','','');
}
function varchk()
{

}
function mySubmit()
{
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.edate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.cdate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	fl=1;
	return false;
	}
	
	if(dt2 > dt3)
	{
	alert("Please select Valid Date Range.");
	fl=1;
	return false;
	}
	
	if(dt1 > dt3)
	{
	alert("Please select Valid Date Range.");
	fl=1;
	return false;
	}
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		//document.frmaddDepartment.txtpp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please select State");
		//document.frmaddDepartment.txtstatesl.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please selct Crop");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please selct Variety");
		fl=1;
		return false;
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

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Report - Periodical Sales Return Report</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >

<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
<input type="hidden" name="txtconchk" value="" />
<input type="hidden" name="txtptype" value="" />
<input type="hidden" name="txtcountrysl" value="" />
<input type="hidden" name="txtcountryl" value="" />
<input type="hidden" name="cdate" value="<?php echo date("d-m-Y")?>" />

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Periodical Sales Return Report</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Dark" height="25">
<td width="150" height="30" align="right" valign="middle" class="tblheading">&nbsp;Period&nbsp;&raquo;&nbsp;&nbsp;&nbsp;From&nbsp;</td>
<td width="220" align="left"  valign="middle" >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
<td width="87" align="right"  valign="middle" class="tblheading">&nbsp;To&nbsp;</td>
<td width="283" align="left"  valign="middle" >&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
</tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="150"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locchk(this.value)">
<option value="ALL" selected="selected">--ALL--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="87"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vloc">&nbsp;<select class="tbltext" name="txtlocation" style="width:120px;"  onchange="partychk(this.value)" >
<option value="ALL" selected="selected">--ALL--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblclassification  where (main='Channel' or main='Stock Transfer') order by classification"); 
?>	
<td width="150" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="partychk(this.value)" >
<option value="ALL" selected>--ALL--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"select * from tbl_partymaser order by business_name"); 
?>		
<td width="87" align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vpname" >&nbsp;<select class="tbltext" name="txtpname" style="width:250px;">
<option value="ALL" selected>--ALL--</option>
	<?php while($noticia = mysqli_fetch_array($quer4)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<?php
$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>
<tr class="Light" height="30">
<td width="150"  align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)" >
<option value="ALL" selected="selected">--ALL--</option>
<?php while($ro_states=mysqli_fetch_array($quer5)) {?>
    <option value="<?php echo $ro_states['cropid'];?>" ><?php echo $ro_states['cropname'];?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="87"  align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem1">&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" onchange="varchk();" >
<option value="ALL" selected="selected">--ALL--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
  <tr class="Light" height="30">
<td width="150"  align="right"  valign="middle" class="tblheading">UPS wise&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input type="radio" class="tbltext" name="txtups" value="Yes" checked="checked" />&nbsp;Yes&nbsp;&nbsp;<input type="radio" class="tbltext" name="txtups" value="No"  />&nbsp;No&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer6=mysqli_query($link,"select * from tbl_salesrv where salesr_trtype='Sales Return' and plantcode='$plantcode' order by salesr_yearcode Asc, salesr_slrno ASC");
?>
	<td width="87"  align="right"  valign="middle" class="tblheading">SRN No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtsrnno" style="width:120px;">
<option value="ALL" selected="selected">--ALL--</option>
<?php while($row_tbl=mysqli_fetch_array($quer6)) {?>
    <option value="<?php echo $row_tbl['salesr_id'];?>" ><?php echo "SRN"."/".$row_tbl['salesr_yearcode']."/".sprintf("%00005d",$row_tbl['salesr_slrno']);?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  