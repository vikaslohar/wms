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
		$baryrcode=$_SESSION['baryrcode'];
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['totnomp'])) { $totnomp = $_REQUEST['totnomp']; }
	if(isset($_REQUEST['tid'])) { $tid = $_REQUEST['tid']; }
	if(isset($_REQUEST['subtid'])) { $subtid = $_REQUEST['subtid']; }
	if(isset($_REQUEST['lotno'])) { $lotno = $_REQUEST['lotno']; }
	if(isset($_REQUEST['txtpsrn'])) { $txtpsrn = $_REQUEST['txtpsrn']; }
	if(isset($_REQUEST['nobe'])) { $nobe=$_REQUEST['nobe']; } else { $nobe=0;}
	if(isset($_REQUEST['nobmos'])) { $nobmos=$_REQUEST['nobmos']; } else { $nobmos=0;}
	if(isset($_REQUEST['nnob'])) { $nnob=$_REQUEST['nnob']; } else { $nnob=0;}
	if(isset($_REQUEST['dval'])) { $dval=$_REQUEST['dval']; }
	
	if(isset($_REQUEST['flagcode'])) { $flagcode=$_REQUEST['flagcode']; } else { $flagcode="";}
	if(isset($_REQUEST['flagcode1'])) { $flagcode1=$_REQUEST['flagcode1']; } else { $flagcode1="";}
	
	if(isset($_REQUEST['dobg'])) { $dobg=$_REQUEST['dobg']; } else { $dobg=date("d-m-Y");}
	if(isset($_REQUEST['operatorcode'])) { $operatorcode=$_REQUEST['operatorcode']; } else { $operatorcode="";}
	if(isset($_REQUEST['wtmaccode'])) { $wtmaccode=$_REQUEST['wtmaccode']; } else { $wtmaccode="";}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$nobapmp=trim($_POST['nobapmp']);
		$nobe=trim($_POST['nobe']);
		$nobmos=trim($_POST['nobmos']);
		$nnob=trim($_POST['nnob']);
		$dobg=trim($_POST['dobg']);
		$operatorcode=trim($_POST['operatorcode']);
		$wtmaccode=trim($_POST['wtmaccode']);
		$flagcode=trim($_POST['flagcode']);
		$flagcode1=trim($_POST['flagcode1']);
		
		echo "<script>window.location='getuser_pronpslip_barcode1.php?totnomp=$totnomp&tid=$tid&subtid=$subtid&lotno=$lotno&txtpsrn=$txtpsrn&nobe=$nobe&nobmos=$nobmos&nnob=$nnob&dval=$dval&flagcode=$flagcode&flagcode1=$flagcode1&dobg=$dobg&operatorcode=$operatorcode&wtmaccode=$wtmaccode'</script>";
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing Slip</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<script language='javascript'>
function onloadfocus()
{
	opener.document.frmaddDepartment.detmpbno.value=0;
	document.from.operatorcode.focus();
}
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
function post_value()
{
/*opener.document.frmaddDepartment.detmpbno.value=document.from.foccode.value;
self.close();
*/
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
	var f=0;
	dt1=getDateObject(document.from.cdate.value,"-");
	dt2=getDateObject(document.from.dobg.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Barcode Generated cannot be more than Current Date.");
		f=1;
		return false;
	}
	if(document.from.operatorcode.value=="")
	{
		alert("Please enter Operator");
		f=1;
		return false;
	}
	if(document.from.nobe.value==0)
	{
		alert("You must enter Barcodes");
		f=1;
		return false;
	}
	if(document.from.nobe.value!=document.from.nobapmp.value)
	{
		alert("Net number of Barcodes not matching with Number of Barcodes as per Master Pack");
		f=1;
		return false;
	}
	
	document.from.flagcode.value ="";
	document.from.flagcode.value1 ="";
	if(document.from.srno.value>2)
	{
		for (var i = 0; i < document.from.barcode.length; i++) 
		{          
			if(document.from.barcode[i].value!="")
			{
				if(document.from.flagcode.value =="")
				{
					document.from.flagcode.value=document.from.barcode[i].value;
				}
				else
				{
					document.from.flagcode.value = document.from.flagcode.value +','+document.from.barcode[i].value;
				}
				if(document.from.flagcode1.value =="")
				{
					document.from.flagcode1.value=document.from.weight[i].value;
				}
				else
				{
					document.from.flagcode1.value = document.from.flagcode1.value +','+document.from.weight[i].value;
				}
			}
		}
	}
	else
	{
		if(document.from.barcode.value!="")
		{
			if(document.from.flagcode.value =="")
			{
				document.from.flagcode.value=document.from.barcode.value;
			}
			else
			{
				document.from.flagcode.value = document.from.flagcode.value +','+document.from.barcode.value;
			}
			if(document.from.flagcode1.value =="")
			{
				document.from.flagcode1.value=document.from.weight.value;
			}
			else
			{
				document.from.flagcode1.value = document.from.flagcode1.value +','+document.from.weight.value;
			}
		}
	}
	if(f==1)
	{
		return false;
	}
	else
	{
		return true;
	}	
}

function chkmlt(mltval, mltno)
{
	mltval=mltval.toUpperCase();
	document.getElementById('m'+[mltno]).value=mltval;
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById('m'+[mltno]).value="";
		document.getElementById('m'+[mltno]).focus();
		return false;
	}
	else
	{
		var mltn=mltno-1;
		var mmll=mltno+1;
		if(mltno>=2)
		{
			if(document.getElementById('w'+[mltn]).value=="")
			{
				alert("Please enter Weight in "+mltn);
				document.getElementById('m'+[mltno]).value="";
				document.getElementById('w'+[mltn]).focus();
				return false;
			}
		}
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltno]).focus();
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltno]).focus();
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById('m'+[mltno]).value="";
				document.getElementById('m'+[mltno]).focus();
				return false;
			}
		}
		mltn++;
		var m='m'+mltn;
		var pcode=document.from.plantcodes.value.split(",");
		var ycode=document.from.yearcodes.value.split(",");
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
			return false;
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
			return false;
		}

		var mltm=document.from.srno.value;
		var cnt=0;
		for (var i=1; i<mltm; i++)
		{
			if(document.getElementById('m'+[i]).value!="")
			{ cnt++; }
		}
		document.getElementById('nobe').value=cnt;
		document.getElementById('nnob').value=parseInt(document.getElementById('nobapmp').value)-parseInt(document.getElementById('nobe').value);
		document.getElementById('w'+[mltno]).focus();
	}
}
function chkmlt1(mltval, mltno)
{
	if(document.getElementById('m'+[mltno]).value=="")
	{
		alert("Please enter Barcode first.");
		document.getElementById('w'+[mltno]).value="";
		document.getElementById('m'+[mltno]).focus();
		return false;
	}
}	
</script>
			
</head>
<body topmargin="0" onload="onloadfocus();" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
<?php

$plantcodes=""; $yearcodes="";
		$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
		while($noticia = mysqli_fetch_array($quer4)) 
		{
			if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
			else
			$yearcodes=$noticia['ycode'];
		}
	   	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	   	$row_month=mysqli_fetch_array($quer6);
	  	$plantcodes=$row_month['code'];
		$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
		 while($noticia2 = mysqli_fetch_array($quer5)) 
		 {
		 	if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
			else
			$plantcodes=$noticia2['stcode'];
		 }
		 
?>  
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="post_value();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
	 <input type="hidden" name="baryrcode" value="<?php echo $baryrcode;?>" />
	 <input type="hidden" name="cnt" value="0" />
	 <input type="hidden" name="dval24" value="<?php echo $dval;?>" />
	 <input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	 <input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" />
	 <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	 <input type="hidden" name="flagcode" value="<?php echo $flagcode;?>" />
	 <input type="hidden" name="flagcode1" value="<?php echo $flagcode1;?>" />
	
<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Enter Barcode Number(s)</td>
</tr>
<tr class="light" height="20">
<td align="right" class="tblheading">No of Barcodes to be entered - as per Master Packs&nbsp;</td>
<td align="left" class="tblheading">&nbsp;<input type="text" name="nobapmp" id="nobapmp" class="tbltext" value="<?php echo $totnomp;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>
<tr class="light" height="20">
  <td align="right" class="tblheading">Number of Barcodes entered&nbsp;</td>
  <td align="left" class="tblheading">&nbsp;<input type="text" name="nobe" id="nobe" class="tbltext" value="<?php echo $nobe;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>
<!--<tr class="light" height="20">
  <td align="right" class="tblheading">No. of Barcodes Mis Out(s) - not part of range&nbsp;</td>
  <td align="left" class="tblheading">&nbsp;</td>
</tr>--><input type="hidden" name="nobmos" id="nobmos" class="tbltext" value="<?php echo $nobmos;?>" style="background-color:#CCCCCC" readonly="true" size="5" />
<tr class="light" height="20">
  <td align="right" class="tblheading">Balance Barcodes&nbsp;</td>
  <td align="left" class="tblheading">&nbsp;<input type="text" name="nnob" id="nnob" class="tbltext" value="<?php echo $totnomp-$nobe;?>" style="background-color:#CCCCCC" readonly="true" size="5" /></td>
</tr>

<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input name="dobg" id="dobg" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $dobg;?>" maxlength="10" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine Operator&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="operatorcode" class="tbltext" value="<?php echo $operatorcode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="wtmaccode" class="tbltext" value="<?php echo $wtmaccode;?>" size="20" maxlength="20" readonly="true" style="background-color:#ECECEC" /></td>
</tr>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="2">Enter Barcodes</td>
</tr>

<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading">Barcodes</td>
	<td align="center" valign="middle" class="tblheading">Weight</td>
</tr>
<?php 
$srno=1; $ccn=0;
while($srno<=$totnomp)
{
$bar=""; $wght="";
if($flagcode!="")
{
	$zx=explode(",",$flagcode);
	$zc=explode(",",$flagcode1);
	$bar=$zx[$ccn]; $wght=$zc[$ccn];
	$ccn++;
}
?>
<tr class="Dark" height="25">
<td width="50%" align="center" valign="middle" class="tblheading"><input type="text" name="barcode" id="m<?php echo $srno;?>" class="tbltext" size="11" maxlength="11" onchange="chkmlt(this.value,<?php echo $srno;?>);" onkeypress="return isNumberKey24(event)" value="<?php echo $bar;?>" onblur="javascript:this.value=this.value.toUpperCase();"  /></td>
<td width="50%" align="center" valign="middle" class="tblheading"><input type="text" name="weight" id="w<?php echo $srno;?>" class="tbltext" size="6" maxlength="6" onchange="chkmlt1(this.value,<?php echo $srno;?>);" onkeypress="return isNumberKey1(event)" value="<?php echo $wght;?>"  /></td>

</tr>
<?php
$srno=$srno+1;
}
?>
<input type="hidden" name="srno" value="<?php echo $srno?>" />
</table>

<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >

<td align="center" colspan="3"><a href="getuser_pronpslip_barcode_sel.php?totnomp=<?php echo $totnomp?>&tid=<?php echo $tid?>&subtid=<?php echo $subtid?>&lotno=<?php echo $lotno?>&txtpsrn=<?php echo $txtpsrn?>&nobe=<?php echo $nobe?>&nobmos=<?php echo $nobmos?>&nnob=<?php echo $nnob?>&dval=<?php echo $dval?>&dobg=<?php echo $dobg?>&operatorcode=<?php echo $operatorcode?>&wtmaccode=<?php echo $wtmaccode?>" ><img src="../images/back.gif" border="0" style="cursor:pointer" /></a>&nbsp;<a href="javascript:document.from.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<input type="image" src="../images/next.gif" alt="Next" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
