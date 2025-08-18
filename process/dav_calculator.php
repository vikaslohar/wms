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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Processing - Utility - Calculator - Date of Validity (DoV)</title>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
<script src="utilcdov.js"></script>
<script language='javascript'>
function isNumberKey1(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 13 && charCode != 127 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
    return false;

    return true;
}
function isNumberKey24(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 47 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isChar_o(Char) // This function accepts only alphabetic characters with no space, no special chars.
{
		var CharToChk = new String(Char);
		var LengthOfChar = CharToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfChar;i++)
		{
			if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) {
			flag = false;
			break;
			}	
		}
		return flag;
}
function lotchk()
{	
	var f=0;
	if(document.from.txtlot2.value!="" && document.from.txtlotnumber.value=="")
	{
		val2=document.from.ycodee.value;
		val5=document.from.txtlot2.value;
		val6=document.from.stcode.value;
		val7=document.from.pcode.value;
		val8=document.from.stcode2.value;
	
		if(val7=="")
		{
			alert("Please Select Plant code");
			f=1;
			return false;
		}
		if(val2=="")
		{
			alert("Please Select Year Code");
			f=1;
			return false;
		}	
		if(val5=="")
		{
			alert("Please Enter Lot No.");
			f=1;
			return false;
		}
		if(val5.length < 5)
		{
			alert("Invalid Lot No.");
			f=1;
			return false;
		}
		if(val6=="")
		{
			alert("Please Enter Lot No.");
			f=1;
			return false;
		}
		if(val6.length < 5)
		{
			alert("Invalid Lot No.");
			f=1;
			return false;
		} 
		if(val8=="")
		{
			alert("Please Enter Lot No.");
			f=1;
			return false;
		}
		if(val8.length < 2)
		{
			alert("Invalid Lot No.");
			f=1;
			return false;
		}
		
		if(f==1)
		{
			return false;
		}
		else
		{
			var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
			document.from.lotno1.value=txtlot1;
			var ltn=document.from.lotno1.value;
			document.getElementById('showdetails').style.display="block";
			showUser(ltn,'showdetails','shcdovdetail','','','','','');
			return true;	
		}
	}
	else if(document.from.txtlot2.value=="" && document.from.txtlotnumber.value!="")
	{
		if(document.from.txtlotnumber.value.length<16)
		{
			alert("Invalid Lot No.");
			document.from.lotno1.value="";
			document.from.txtlotnumber.value="";
			document.from.txtlotnumber.focus();
			f=1;
			return false;
		}
		else
		{
			var val1=document.from.ycd.value;
			var val2=document.from.stcd.value;
			var xlot=document.from.txtlotnumber.value.split("");
			var val11=val1.split(",");
			var val22=val2.split(",");
			var z=0; var v=0;
			for (var s=0; s<val22.length; s++ ) 
			{
				if(xlot[0]!=val22[s])
				z=1;
			}
			for (var s=0; s<val11.length; s++ ) 
			{
				if(xlot[1]!=val11[s])
				v=1;
			}
			for(var i=2; i<xlot.length; i++)
			{
				if(i<7)
				{
					if(isChar_o(xlot[i])==true)
					{
						alert("Invalid Lot Number");
						document.from.lotno1.value="";
						document.from.txtlotnumber.value="";
						document.from.txtlotnumber.focus();
						f=1;
						return false;
					}
				}
				if(xlot[7].charCodeAt()!=47)
				{
					alert("Invalid Lot Number");
					document.from.lotno1.value="";
					document.from.txtlotnumber.value="";
					document.from.txtlotnumber.focus();
					f=1;
					return false;
				}
				if(i>7 && i<13)
				{
					if(isChar_o(xlot[i])==true)
					{
						alert("Invalid Lot Number");
						document.from.lotno1.value="";
						document.from.txtlotnumber.value="";
						document.from.txtlotnumber.focus();
						f=1;
						return false;
					}
				}
				if(xlot[13].charCodeAt()!=47)
				{
					alert("Invalid Lot Number");
					document.from.lotno1.value="";
					document.from.txtlotnumber.value="";
					document.from.txtlotnumber.focus();
					f=1;
					return false;
				}
				if(i>13)
				{
					if(isChar_o(xlot[i])==true)
					{
						alert("Invalid Lot Number");
						document.from.lotno1.value="";
						document.from.txtlotnumber.value="";
						document.from.txtlotnumber.focus();
						f=1;
						return false;
					}
				}
			}
			
			if(f==1)
			{
				return false;
			}
			else
			{
				document.from.lotno1.value=document.from.txtlotnumber.value;
				var ltn=document.from.lotno1.value;
				document.getElementById('showdetails').style.display="block";
				showUser(ltn,'showdetails','shcdovdetail','','','','','');
				return true;	
			}
			
		}
	}
	else
	{
		document.from.lotno1.value="";
	}
	
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

function dateDiff(dateEarlier, dateLater) 
{
	var x=dateEarlier.split("-");
	var y=dateLater.split("-");
	dateEarlier=new Date(x[2],x[1]-1,x[0]);
	dateLater=new Date(y[2],y[1]-1,y[0]);
	var one_day=1000*60*60*24
    return (  Math.round((dateLater.getTime()-dateEarlier.getTime())/one_day)  );
}

function chkvalidity(valval)
{
	if(document.from.qctdate.value=="")
	{
		alert("DOT/DOSF cannot be blank check the Soft Release Ststus");
		return false;
	}
	else
	{
		if(valval!="")
		{
			dt1=getDateObject(document.from.date.value,"-");
			dt2=getDateObject(document.from.dp1.value,"-");
			dt3=getDateObject(document.from.dp2.value,"-");
			dt4=getDateObject(document.from.dp3.value,"-");
			if(valval==3)
			{
				if(dt2 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Today's Date.");
					document.from.validityperiod.value="";
					document.from.validityupto.value="";
					document.from.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.from.dopc.value, document.from.dp1.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.from.validityupto.value=document.from.dp1.value;
					document.from.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt3 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Today's Date.");
					document.from.validityperiod.value="";
					document.from.validityupto.value="";
					document.from.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.from.dopc.value, document.from.dp2.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.from.validityupto.value=document.from.dp2.value;
					document.from.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt4 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Today's Date.");
					document.from.validityperiod.value="";
					document.from.validityupto.value="";
					document.from.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.from.dopc.value, document.from.dp3.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.from.validityupto.value=document.from.dp3.value;
					document.from.valdays.value=ddiff;
				}
			}
		}
		else
		{
			document.from.validityupto.value="";
			document.from.valdays.value="";
		}
	}
}
</script>
</head>
<body topmargin="0" >
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  	<form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="lotno1" value="" />
	<input type="hidden" name="date" value="<?php echo date("d-m-Y");?>" />
	<input type="hidden" name="dopc" value="<?php echo date("d-m-Y");?>" />

<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="$adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Calculator - Date of Validity (DoV)</td>
</tr>
</table>
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="$adad11" style="border-collapse:collapse" > 
 <tr class="Light" height="30">
<td width="125" align="right" class="smalltblheading">Select Lot Number:&nbsp;</td>
<td width="419" align="left" class="smalltblheading">&nbsp;<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by years desc"); 

   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>
 <select class="tbltext" name="pcode" style="width:40px;">
	<option value="<?php echo $a;?>" selected="selected" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00" />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font class="tblheading">OR</font></td>	
</tr> 
 <tr class="Light" height="30">
<?php
	$stcd=""; $ycd="";
	$quer42=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by years desc"); 
	while($noticia2 = mysqli_fetch_array($quer42)) 
	{
		if($ycd!="")
		$ycd=$ycd.",".$noticia2['ycode'];
		else
		$ycd=$noticia2['ycode'];
	}
   	$quer62=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   	$row_month2=mysqli_fetch_array($quer62);
  	$stcd=$row_month2['code'];
	$quer52=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
	while($noticia52 = mysqli_fetch_array($quer52)) 
	{
		if($stcd!="")
		$stcd=$stcd.",".$noticia52['stcode'];
		else
		$stcd=$noticia52['stcode'];
	}
?>
<td width="125" align="right" class="smalltblheading">Enter Lot Number:&nbsp;</td>
<td width="419" align="left" class="smalltblheading">&nbsp;<input type="text" name="txtlotnumber" class="smalltbltext" size="16" maxlength="16" value="" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font><input type="hidden" name="stcd" value="<?php echo $stcd;?>" /> <input type="hidden" name="ycd" value="<?php echo $ycd;?>" /></td>	
</tr>
 <tr class="Light" height="30">
 <td align="center" colspan="2"><img src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();" /><!--<input type="image" src="../images/search.gif" border="0"  class="tbltext" name="sub" value="Search" style="display:inline;cursor:pointer; vertical-align:middle" onclick="lotchk();"> --></td>
 </tr>
</table>
<br />
<div id="showdetails" style="display:none">
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="$adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">Crop&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;</td>
	<td width="75" align="right" class="smalltblheading">Variety&nbsp;</td>
	<td width="166" align="left" class="smalltblheading">&nbsp;</td>
	<td width="115" align="right" class="smalltblheading">Stage&nbsp;</td>
	<td width="100" align="left" class="smalltblheading">&nbsp;</td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">QC Status&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;</td>
	<td width="75" align="right" class="smalltblheading">DoT/DoSF&nbsp;</td>
	<td width="166" align="left" class="smalltblheading">&nbsp;<input type="hidden" name="qctdate" value="<?php echo $qcdot;?>" /></td>
	<td width="115" align="right" class="smalltblheading">Soft Release Status&nbsp;</td>
	<td width="100" align="left" class="smalltblheading">&nbsp;</td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">Validity Period&nbsp;</td>
	<td align="left" class="smalltblheading" colspan="5">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="3" >3</option>
<option value="6" >6</option>
<option value="9" >9</option>
</select>&nbsp;Months</td>
</tr>
</table>
<br />
<div id="dovdetails">
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="$adad11" style="border-collapse:collapse" > 
<tr class="Light" height="30">
	<td width="90" align="right" class="smalltblheading">Valid upto&nbsp;</td>
	<td width="180" align="left" class="smalltblheading">&nbsp;<input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="15" readonly="true" style="background-color:#ECECEC"  /></td>
	<td width="90" align="right" class="smalltblheading">Validity Days&nbsp;</td>
	<td width="180" align="left" class="smalltblheading">&nbsp;<input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
</tr>
</table>
</div>
</div>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="700">
<tr >
<td align="right"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
 