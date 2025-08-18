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

	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$date=trim($_POST['date']);
		$tcode=trim($_POST['tcode']);
		$sstage="Pack";
		$crop=trim($_POST['txtcrop']);
		$variety=trim($_POST['txtvariety']);
		$lotno=trim($_POST['txtlot1']);
		$orlot=trim($_POST['orlot']);
		$upssize=trim($_POST['txtupsdc']);
		$enop=trim($_POST['txtenop']);
		$enomp=trim($_POST['txtenomp']);
		$eqty=trim($_POST['txteqty']);
		$qcsts="UT";
		$dot="";
		$got=trim($_POST['txtegot']);
		$go=explode(" ",$got);
		$got1=$go[1];
		$dogt=trim($_POST['txtedogt']);
		
		$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
			
		$edate12=explode("-",$dogt);
		$dogt=$edate12[2]."-".$edate12[1]."-".$edate12[0];
		
		
		$sql_sub="insert into tbl_revalidate (rv_date, rv_crop, rv_variety, rv_lotno, rv_ups, rv_enop, rv_enomp, rv_eqty, rv_qc, rv_dot, rv_got, rv_got1, rv_dogt, rv_tcode, rv_logid, rv_yearcode, plantcode) values('$date', '$crop', '$variety', '$lotno', '$upssize', '$enop', '$enomp', '$eqty', '$qcsts', '$dot', '$got', '$got1', '$dogt', '$tcode', '$logid', '$yearid_id', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$pid=mysqli_insert_id($link);
			echo "<script>window.location='add_qcrv_preview.php?p_id=$pid'</script>";	
		}		
		//exit;
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Pack Seed - Re-Printing</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="rv.js"></script>
<script src="../include/validation.js"></script>
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

function mySubmit()
{ 
	var fl=0;	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please Select UPS");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtenop.value=="" || document.frmaddDepartment.txtenop.value==0)
	{
		alert("Cannot Re-Printing Lot as Pouches are not present with this Lot Number");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtenomp.value>0)
	{
		alert("Cannot Re-Printing Lot as Master Pack present with this Lot Number");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txteqc.value=="UT" || document.frmaddDepartment.txteqc.value=="RT")
	{
		alert("Cannot Re-Printing Lot as QC is already under process with this Lot Number");
		fl=1;
		return false;
	}
	if(fl==1)
	{
		return false;
	}
	else
	{
		return true;	 
	} 
}
function modetchk(classval)
{
	document.frmaddDepartment.txtvariety.selectedIndex=0;
	document.frmaddDepartment.txtvariety.value="";
	document.frmaddDepartment.txtupsdc.selectedIndex=0;
	document.frmaddDepartment.txtupsdc.value="";
	document.frmaddDepartment.txtlot1.value="";
	document.getElementById('postmainform').innerHTML="";
	document.frmaddDepartment.getdet.value=0;
	showUser(classval,'vitem','item','','','','','');
}
function upschk(verval)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	document.frmaddDepartment.txtupsdc.selectedIndex=0;
	document.frmaddDepartment.txtupsdc.value="";
	document.frmaddDepartment.txtlot1.value="";
	document.getElementById('postmainform').innerHTML="";
	document.frmaddDepartment.getdet.value=0;
	showUser(verval,'upschd','upsch',crop,'','','');
}
function openslocpop()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please Select UPS first.");
		document.frmaddDepartment.txtupsdc.focus();
	}
	else
	{
		//var itm="Pack Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var ups=document.frmaddDepartment.txtupsdc.value;
		document.getElementById('postmainform').innerHTML="";
		document.frmaddDepartment.getdet.value=0;
		//document.frmaddDepartment.getdet.txtlot1="";
		winHandle=window.open('getuser_rv_lotno.php?crop='+crop+'&variety='+variety+'&ups='+ups,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}
function getdetails()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
	 alert("Please Select or enter Lot No.");
	}
	else
	{
		var get=document.frmaddDepartment.txtlot1.value;
		document.frmaddDepartment.getdet.value=0;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var upss=document.frmaddDepartment.txtupsdc.value;
		//var lotid=document.frmaddDepartment.subtrid.value;
		document.frmaddDepartment.getdet.value=1;	
		showUser(get,'postmainform','get',crop,variety,upss,'','','');
		//document.frmaddDepartment.getdetflg.value=1;
	}
}

function verchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety");
		document.frmaddDepartment.txtupsdc.value="";
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtlot1.value="";
		document.getElementById('postmainform').innerHTML="";
		document.frmaddDepartment.getdet.value=0;
	}
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Pack Seed Re-Printing - QC Sample Request</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=0;

	$tdate=date("d-m-Y");
	
	$sql_code="SELECT MAX(rv_tcode) FROM tbl_revalidate where rv_yearcode='$yearid_id'  ORDER BY rv_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="TRV".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="TRV".$code."/".$yearid_id."/".$lgnid;
	}	
	
?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="sstage" value="Pack" />
	<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
	<input type="hidden" name="date" value="<?php echo $tdate?>" />
	<input type="hidden" name="tcode" value="<?php echo $code;?>" />
	<input type="hidden" name="maintrid" value="<?php echo $tid?>" />
	<input type="hidden" name="txtsrtyp" value="" />
	</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Re-Printing - QC Sample Request</td>
</tr>

 <tr class="Dark" height="30">
<td width="213" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="267"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>

<td width="229" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="251" align="left" valign="middle" class="tbltext">&nbsp;<?php echo date("d-m-Y");?></td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
<tr class="Light" height="30">
<td width="213" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="upschk(this.value);" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
	<td align="left" valign="middle" class="tbltext" colspan="3" id="upschd" >&nbsp;<select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="0" /></td>	 
</tr>
</table><br />
<div id="postmainform">
<!--<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="213"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="267" valign="middle" class="tbltext">&nbsp;</td>	
<td align="right" width="229" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="251" valign="middle" class="tbltext">&nbsp;</td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;</td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;</td>
</tr>
</table>-->
</div>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_revalidate.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
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

  