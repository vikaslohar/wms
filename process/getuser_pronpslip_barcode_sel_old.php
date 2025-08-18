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
	if(isset($_REQUEST['dval'])) { $dval=$_REQUEST['dval']; }
	//$lotno1="'$lotno'";
	//$txtpsrn1="'$txtpsrn'";
	
	if(isset($_REQUEST['dobg'])) { $dobg=$_REQUEST['dobg']; } else { $dobg=date("d-m-Y");}
	if(isset($_REQUEST['operatorcode'])) { $operatorcode=$_REQUEST['operatorcode']; } else { $operatorcode="";}
	if(isset($_REQUEST['wtmaccode'])) { $wtmaccode=$_REQUEST['wtmaccode']; } else { $wtmaccode="";}
	
	$s_sub3="delete from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_tid='".$tid."' and bar_subid='".$subtid."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));
		
	if(isset($_POST['frm_action'])=='submit')
	{
		$beseltyp=trim($_POST['beseltyp']);
		$dobg=trim($_POST['dobg']);
		$operatorcode=trim($_POST['operatorcode']);
		$wtmaccode=trim($_POST['wtmaccode']);
		//$operatorcode="'$operatorcode'";
		//$wtmaccode="'$wtmaccode'";
		//$dobg="'$dobg'";
		if($beseltyp=="csvbased")
		{
		
				echo "<script>window.location='getuser_pronpslip_barcode_new.php?totnomp=$totnomp&tid=$tid&lotno=$lotno&txtpsrn=$txtpsrn&subtid=$subtid&dval=$dval&dobg=$dobg&operatorcode=$operatorcode&wtmaccode=$wtmaccode'</script>";
		
		}
		else if($beseltyp=="pbxlsbased")
		{
		
				echo "<script>window.location='getuser_pronpslip_ppbarcode_new.php?totnomp=$totnomp&tid=$tid&lotno=$lotno&txtpsrn=$txtpsrn&subtid=$subtid&dval=$dval&dobg=$dobg&operatorcode=$operatorcode&wtmaccode=$wtmaccode'</script>";
		
		}
		else if($beseltyp=="entrybased")
		{
		if($totnomp > 10)
		{
		echo "<script>
					alert('No. of Master Pack is more than 10 therefore Manual Barcode Entry is disabled. Please use Excel CSV file to upload Barcodes')</script>";
		/*?>	
				<script>
					alert("No. of Master Pack is more than 10 therefore Manual Barcode Entry is disabled. Please use Excel CSV file to upload Barcodes");
					//window.location='getuser_pronpslip_barcode_sel.php?totnomp='+<?php echo $totnomp?>+'&tid='+<?php echo $tid?>+'&lotno='+<?php echo $lotno1?>+'&txtpsrn='+<?php echo $txtpsrn1?>+'&subtid='+<?php echo $subtid?>+'&dval='+<?php echo $dval?>+'&dobg='+<?php echo $dobg?>+'&operatorcode='+<?php echo $operatorcode?>+'&wtmaccode='+<?php echo $wtmaccode?>+'';
				</script>
		<?php*/
		}
		else
		{
		echo "<script>window.location='getuser_pronpslip_barcode.php?totnomp=$totnomp&tid=$tid&lotno=$lotno&txtpsrn=$txtpsrn&subtid=$subtid&dval=$dval&dobg=$dobg&operatorcode=$operatorcode&wtmaccode=$wtmaccode'</script>";
		/*?>
				<script>
					window.location='getuser_pronpslip_barcode.php?totnomp='+<?php echo $totnomp?>+'&tid='+<?php echo $tid?>+'&lotno='+<?php echo $lotno1?>+'&txtpsrn='+<?php echo $txtpsrn1?>+'&subtid='+<?php echo $subtid?>+'&dval='+<?php echo $dval?>+'&dobg='+<?php echo $dobg?>+'&operatorcode='+<?php echo $operatorcode?>+'&wtmaccode='+<?php echo $wtmaccode?>+'';
				</script>
		<?php*/
		}
		}
		else
		{
		
		}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1; accept-charset=utf-8"  />
<title>Processing - Transaction - Processing and Packing Slip</title>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
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

<script type="text/javascript" src="../include/validation.js"></script>
<script language='javascript'>
function onloadfocus()
{
	opener.document.frmaddDepartment.detmpbno.value=0;
}
function post_value()
{
}
function seltp(selval)
{
	document.frmaddDepartment.beseltyp.value=selval;
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
	dt1=getDateObject(document.frmaddDepartment.cdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dobg.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Barcode Generated cannot be more than Current Date.");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.operatorcode.value=="")
	{
		alert("Please select Weighing Machine Operator");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.wtmaccode.value=="")
	{
		alert("Please select Weighing machine");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.beseltyp.value=="")
	{
		alert("Please Select Barcode entry type");
		f=1;
		return false;
	}
	//alert(f);
	if(f==0)
	return true;
	else
	return false;
}

function post_close()
{
	opener.document.frmaddDepartment.detmpbno.value="";
	var dval=document.frmaddDepartment.dval.value;
	var x='dtail_'+dval;
	opener.document.getElementById(x).innerHTML='<a href=Javascript:void(0) onclick=detailspop()>Fill</a>';
	self.close();
}
</script>
			
</head>
<body topmargin="0" onLoad="onloadfocus();" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();" enctype="multipart/form-data"  > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	<input type="hidden" name="totnomp" class="tbltext" value="<?php echo $totnomp;?>"  />
	<input type="hidden" name="txtpsrn" value="<?php echo $txtpsrn;?>" />
	<input type="hidden" name="beseltyp" value="" />
	<input type="hidden" name="dval" value="<?php echo $dval?>" />

<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Barcode entry type</td>
</tr>
<tr class="Light" height="25">
<td width="50%" align="right" height="30" valign="middle" class="tblheading">Machine Generated Barcode File&nbsp;</td>
<td width="50%" align="left"  valign="middle">&nbsp;<input type="radio" name="besel" value="csvbased" onClick="seltp(this.value);" /></td>
</tr>
<tr class="Light" height="25">
<td width="50%" align="right" height="30" valign="middle" class="tblheading">Pre-Printed Barcode File&nbsp;</td>
<td width="50%" align="left"  valign="middle">&nbsp;<input type="radio" name="besel" value="pbxlsbased" onClick="seltp(this.value);" /></td>
</tr>  
<tr class="Light" height="25">
<td width="50%" align="right" height="30" valign="middle" class="tblheading">Manual Entry&nbsp;</td>
<td width="50%" align="left"  valign="middle">&nbsp;<input type="radio" name="besel" value="entrybased" onClick="seltp(this.value);" /></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<input name="dobg" id="dobg" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $dobg;?>" maxlength="10" readonly="true" style="background-color:#ECECEC" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dobg')" tabindex="6"><img src="../images/cal.gif" border="0" align="absmiddle" /></a>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<?php
$query=mysqli_query($link,"SELECT * FROM tbl_rm_wtopr where plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query);


$query2=mysqli_query($link,"SELECT * FROM tbl_rm_wtmac where plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
$numofrecords2=mysqli_num_rows($query2);
//$row2=mysqli_fetch_array($query2);

?>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine Operator&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<select name="operatorcode" class="tbltext" style="size:100px"  >
	<option value="" selected="selected">Select</option>
	<?php while($row=mysqli_fetch_array($query)) {?>
	<option value="<?php echo $row['wtopr_code'];?>"><?php echo $row['wtopr_code'];?></option>
	<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="light" height="25">
	<td align="right" valign="middle" class="tblheading">Weighing Machine&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<select name="wtmaccode" class="tbltext" style="size:100px"  >
	<option value="" selected="selected">Select</option>
	<?php while($row2=mysqli_fetch_array($query2)) {?>
	<option value="<?php echo $row2['wtmac_macid'];?>"><?php echo $row2['wtmac_macid'];?></option>
	<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="post_close()" />&nbsp;<input type="image" src="../images/next.gif" alt="Next" border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
