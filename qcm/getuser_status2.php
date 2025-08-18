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
	
if(isset($_REQUEST['tid']))
	{
		$itmid = $_REQUEST['tid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		$tid=trim($_POST['tid']);
		$e=$_POST['sdate'];
	
		$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		$p=explode(",",$tid);
		foreach($p as $val)
		{
			if($val <> "")
			{
				$sql_code="SELECT MAX(stsno) FROM tbl_qctest";
				$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
						
					if(mysqli_num_rows($res_code) > 0)
						{
							$row_code=mysqli_fetch_row($res_code);
							$t_code=$row_code['0'];
							$code=$t_code+1;
					}
					else
					{
						$code=1;
					}
					
				$sql_in1="update tbl_qctest set spdate='$tdate', bflg=1, stsno='$code' where tid='$val'";	
				$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			}
		}	
		//exit;
	echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction-Qc Sampling slip</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script type="text/javascript">
function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
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
	dt3=getDateObject(document.frmaddDept.cdate.value,"-");	
	if(dt1 > dt3)
	{
	alert("Please select Valid Date.");
	return false;
	}
	
	return true;
}	


			</script>
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="tid" value="<?php echo $itmid?>" type="hidden"> <br />
<br />

<table align="center" border="1" width="200" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
      <tr class="tblsubtitle" height="16">
        <td colspan="2"  align="center" class="tblheading">QC Sample Collection update </td>
      </tr>

      <tr class="Light" height="16">
        <td width="35%" align="right"  valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
        <td width="65%" align="left"  valign="middle" class="smalltblheading">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<!--<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>--></td>
      </tr>
  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
</table>

<br/>
<table width="200" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="center" colspan="3"><img src="../images/close_1.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="post_value();"/></td>
</tr>
</table>
</form>
