<?php
//ob_start(); 
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
	
	if(isset($_GET['cropid']))
	{
	 $a = $_GET['cropid'];	 
	}
if(isset($_POST['frm_action'])=='submit')
	{
			 $dos= trim($_POST['date']);
			$dcdate= trim($_POST['dcdate']);
			$loc = trim($_POST['txtloc']);
			$txtnop = trim($_POST['txtnop']);
			$txtnot = trim($_POST['txtnot']);
			$purity = trim($_POST['purity']);
			$txtst = trim($_POST['txtst']);
		    $txtod = trim($_POST['txtod']);
			$txtvar = trim($_POST['txtvar']);
			$txtsterile = trim($_POST['txtsterile']);
			$txtother = trim($_POST['txtother']);
			$total= trim($_POST['txttotal']);
			$remarks =trim( $_POST['txtremarks']);	 
		    $result= trim($_POST['result']);	 
	        $e = $_POST['sdate'];
			 $got = $_POST['got'];		
	   
	
	$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
	 $tdate=$tyear."-".$tmonth."-".$tday;
	
	
		
		 $sql_sub_sub="insert into tbl_got_update(dos,yearcode, arid, cdate , location , nop , nott , purity , splants , otherdist , varaties, sterile, other, total, result, remarks) values('$dos','$yearid_id', '$code1','$dcdate','$loc', '$txtnop','$txtnot','$purity','$txtst', '$txtod','$txtvar', '$txtsterile', '$txtother', '$total','$result','$remarks')";
		if(mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link)))
		{
			 $sql_sub_sub12="update tbl_qctest set gotstatus='$got', gotdate='$tdate' , gotflg=1 where lotno='$a'";
		$qq=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
		//exit;
			echo "<script>window.location='home_result.php'</script>";	
	  }
	}							
$sql_code="SELECT MAX(arid) FROM tbl_got_update ORDER BY arid DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}
		//}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qty- Transaction -Add GOT Result Update </title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk1.js"></script>
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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.pdate,dt,document.frmaddDepartment.pdate, "dd-mmm-yyyy", xind, yind);
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
function bagschk2(actbags)
{
		if(document.frmaddDepartment.txtnop.value=="")
		{
			alert("Enter No. of Plants");
			document.frmaddDepartment.txtnot.value="";
			document.frmaddDepartment.txtnop.value="";
			
		}
		else
		{
		document.frmaddDepartment.purity.value=100-((parseFloat(document.frmaddDepartment.txtnot.value)/parseFloat(document.frmaddDepartment.txtnop.value))*100);
		}
}
function bagschk3(actbags)
{
		if(document.frmaddDepartment.txtother.value=="")
		{
			alert("Enter other Values");
			document.frmaddDepartment.txtst.value="";
			document.frmaddDepartment.txtnod.value="";
			document.frmaddDepartment.txtvar.value="";
			document.frmaddDepartment.txtsterile.value="";
			document.frmaddDepartment.txtother.value="";
			document.frmaddDepartment.txttotal.value="";
		}
		else 
		{
		document.frmaddDepartment.txttotal.value=parseInt(document.frmaddDepartment.txtst.value)+parseInt(document.frmaddDepartment.txtod.value)+parseInt(document.frmaddDepartment.txtvar.value)+parseInt(document.frmaddDepartment.txtsterile.value)+parseInt(document.frmaddDepartment.txtother.value);
		//alert(document.frmaddDepartment.txtnot.value);
		//alert(document.frmaddDepartment.txttotal.value);
			}
			if(parseInt(document.frmaddDepartment.txtnot.value) != parseInt(document.frmaddDepartment.txttotal.value))
	    {
		alert("No. of Off Types and total not matched Please Enter again");
		document.frmaddDepartment.txttotal.value="";
		document.frmaddDepartment.txtother.focus();
		return false;
			}
} 


function spmchk(val)
{
		if(document.frmaddDepartment.txtlot1.value=="")
				{
					alert("Please enter Lot No.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
			if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
			if(!isNumberKey(document.frmaddDepartment.txtlot1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(document.frmaddDepartment.txtlot1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDepartment.txtlot1.focus();
				return false;
				}
						
			if (document.frmaddDepartment.txtlot1.value!="") 
			{
				document.getElementById("vitem").style.display="block";	 
	
			var crop=document.frmaddDepartment.txtlot1.value;
			//var spf=document.frmaddDepartment.txtlot2.value;
			showUser(crop,'vitem','item',val,'','','');
		}
		else
		{
			alert ("Please add Seed Production (SP) Code-Male");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
			
}

function spmchk1(val)
{
document.frmaddDepartment.txtnop.value=parseFloat(document.frmaddDepartment.txtnot.value)/parseFloat(actgqty);
		if(document.frmaddDepartment.txtlot2.value=="")
				{
					alert("Please enter Sample No.");
					document.frmaddDepartment.txtlot2.focus();
					return false;
				}
			if(document.frmaddDepartment.txtlot2.value.charCodeAt() == 32)
				{
					alert("SampleNo cannot start with space.");
					document.frmaddDepartment.txtlot2.focus();
					return false;
				}
			if(!isChar_W(document.frmaddDepartment.txtlot2.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDepartment.txtlot2.focus();
					return false;
				}
				if(document.frmaddDepartment.txtlot2.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDepartment.txtlot2.focus();
				return false;
				}
	
			if (document.frmaddDepartment.txtlot2.value!="") 
			{
				document.getElementById("vitem").style.display="block";	 
			var crop=document.frmaddDepartment.txtlot2.value;
			//var spf=document.frmaddDepartment.txtlot2.value;
			showUser(crop,'vitem','item',val,'','','');
		}
		else
		{
			alert ("Please add Seed Production (SP) Code-Male");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
			
}


function mySubmit()
{
dt1=getDateObject(document.frmaddDepartment.date.value,"-");
dt2=getDateObject(document.frmaddDepartment.doscdate.value,"-");
dt3=getDateObject(document.frmaddDepartment.dosdate.value,"-");
dt4=getDateObject(document.frmaddDepartment.dcdate.value,"-");
dt5=getDateObject(document.frmaddDepartment.sdate.value,"-");
			
	/**/	if(dt2 < dt1)
	{
	alert("Please select Valid Date of Sample collected.");
	return false;
	}
		if(dt3 < dt2)
	{
	alert("Please select Valid Date of Sample Dispatch.");
	return false;
	}
		if(dt4 < dt3)
	{
	alert("Please select Valid Date of Sowing.");
	return false;
	}
		if(dt5 < dt4)
	{
	alert("Please select Valid Date of Sowing.");
	return false;
	}
	/*if(dt4 >dt5)
	{
	alert("Please select Valid Date of Sowing.");
	return false;
	}*/
 if(document.frmaddDepartment.txtloc.value=="")
	{
		alert("Please enter Location.");
		document.frmaddDepartment.txtloc.focus();
		return false;
	}		
	if(document.frmaddDepartment.txtnop.value=="")
	{
		alert("Please Enter  No. of Plants");
		document.frmaddDepartment.txtnop.focus();
		return false;
	}		
		
		 if(document.frmaddDepartment.txtnot.value=="")
	{
		alert("Please Enter  No. off Types");
		document.frmaddDepartment.txtnot.focus();
		return false;
	}		
		
	 if(document.frmaddDepartment.txtst.value=="")
	{
		alert("Please Enter Self Types.");
		document.frmaddDepartment.txtst.focus();
		return false;
	}		
	 if(document.frmaddDepartment.txtod.value=="")
	{
		alert("Please enter Other Distinguishable.");
		document.frmaddDepartment.txtod.focus();
		return false;
	}		

 if(document.frmaddDepartment.txtvar.value=="")
	{
		alert("Please Select Varieties.");
		document.frmaddDepartment.txtvar.focus();
		return false;
	}		
 if(document.frmaddDepartment.txtsterile.value=="")
	{
		alert("Please enter Strile.");
		document.frmaddDepartment.txtsterile.focus();
		return false;
	}	
	 if(document.frmaddDepartment.txtother.value=="")
	{
		alert("Please Enter Other.");
		document.frmaddDepartment.txtother.focus();
		return false;
	}		
 if(document.frmaddDepartment.result.value=="")
	{
		alert("Please Select Result.");
		document.frmaddDepartment.result.focus();
		return false;
	}
	 if(document.frmaddDepartment.got.value=="")
	{
		alert("Please Select GOT Status.");
		document.frmaddDepartment.got.focus();
		return false;
	}
	 if(document.frmaddDepartment.txtremarks.value=="")
	{
		alert("Please Enter Remarks");
		document.frmaddDepartment.txtremarks.focus();
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
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
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
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction- GOT Result Updation </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tbl_qctest where lotno='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $a=mysqli_num_rows($quer3);
 $a=$noticia['lotno'];

$sql_month=mysqli_query($link,"select * from tbl_qctest where lotno='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['variety']."' and actstatus='Active'") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
 $sap=$row['sampleno'];
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>

<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add GOT Result Update </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Dark" height="30">
<td width="206" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="274"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
<td width="147" align="right" valign="middle" class="tblheading">&nbsp;Date &nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="sdate" id="stdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" />&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtstfp2" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $a?>"/>  &nbsp;</td>
			  
<td align="right"  valign="middle" class="tblheading">Sample No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtstfp2" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp1?><?php echo $row['yearid']?><?php echo sprintf("%000006d",$qc1);?>"/>  &nbsp;</td>
           </tr>
		  <!-- /*</table>
		   <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > */-->
		 
 
  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtstfp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>"onchange="upschk(this.value);" id="itm"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"style="background-color:#CCCCCC" readonly="true" value="<?php echo $variety;?>"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
	 <!--
 

<td align="right"  valign="middle" class="tblheading">Sample No.  &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="txtstfp2" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" value="<?php echo $tp1?><?php echo $yearid_id?>/00000<?php echo $qc1?><?php echo $sap;?>"/>  &nbsp;</td>
  </tr>-->
		<?php  
	$tdates=$row['srdate'];
	$tyear=substr($tdates,0,4);
	$tmonth=substr($tdates,5,2);
	$tday=substr($tdates,8,2);
	$tdates=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row['spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdatee=$row['dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear; 

?>
<tr class="Light" height="30">
<td width="206" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
<td width="274" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>&nbsp;</td>
<td width="147" align="right" valign="middle" class="tblheading">&nbsp;DOSC &nbsp;</td>
<td width="213" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
           </tr>
		   <tr class="Dark" height="30">


<td width="206" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td>
<tr class="tblsubtitle" height="20">
<td colspan="6" align="center" class="tblheading">GOT Result Updation </td>
</tr>
		   <tr class="Light" height="30">
<td width="206" align="right" valign="middle" class="tblheading">&nbsp;Date of Sowing&nbsp;</td>
<td width="274" align="left" valign="middle" class="tbltext">&nbsp;<input name="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#efefef" value="<?php echo date("d-m-Y", time());?>" maxlength="10" id="pdate"/>&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.dcdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender_1.js" ></script>&nbsp;&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">Location of Sowing&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtloc" type="text" size="15" class="tbltext" tabindex="0" maxlength="14"/>
           &nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
           </tr>
		   <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Plants  &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnop" type="text" size="4" class="tbltext" tabindex="0" maxlength="3" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">No. of off Types&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnot" type="text" size="15" class="tbltext" tabindex="0" maxlength="14"  onchange="bagschk2(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
           </tr>
	 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="purity" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" maxlength="10"/>  &nbsp;</td>
           </tr>
		   <tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Brake Up of off Types </td>
</tr>
		   <tr class="Dark" height="30">

<td align="right"  valign="middle" class="tblheading">Self Types &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtst"   type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">Other Distinguishable&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtod"  type="text"size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
		   <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Varities&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtvar"  type="text"size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">Sterile&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtsterile"  type="text"size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)"   /> &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
		   <tr class="Dark" height="30">


<td align="right"  valign="middle" class="tblheading">Other &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="txtother"  type="text"size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="bagschk3(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	           </tr>
		   <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading"> Total &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txttotal" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" />&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading" >Result&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="result" style="width:100px;" >
    <option value="" selected>--Select--</option>
  	  <option value="OK" >OK</option>
	    <option value="Fail" >Fail</option>
		  <option value="Retest" >Retest</option>
    
  </select>  <font color="#FF0000">*</font>	</td>
           </tr>
		   <tr class="Dark" height="20">
 <td align="right"  valign="middle" class="tblheading">GOT&nbsp;Status</td>
 <td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="got" style="width:100px;">
    <option value="" selected>--Select--</option>
   	  <option value="OK" >OK</option>
	    <option value="Fail" >Fail</option>
	      </select>  <font color="#FF0000">*</font></td>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">&nbsp;Remarks</td>
<td width="638" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_result.php" ><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
<!--<table align="center" width="850" cellpadding="5" cellspacing="5" border="0"  bordercolor="d21704">
<tr >
<td valign="top" align="Center"><a href="add_arrival_stocktransfer2.php" tabindex="20"><img src="../images/submit.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/reset.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>-->
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

  