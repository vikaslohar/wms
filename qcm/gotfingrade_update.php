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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['itmid']))
	{
		 $tid = $_REQUEST['itmid'];
	}
	/*if(isset($_REQUEST['arival_id']))
	{
		 $tid = $_REQUEST['arrival_id'];
	}*/
	if(isset($_POST['frm_action'])=='submit')
	{
		
		
		$e=$_POST['sdate'];
		$btnval=$_POST['btnval'];
		$tid=$_POST['tid'];
		$finalgotgrade=$_POST['finalgotgrade'];
		
		$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
	
		if($btnval==0)
		{
			$sql_arr_home=mysqli_query($link,"select * from tbl_btsplatingsub_sub2 where btsplatingss2_id='$tid'") or die(mysqli_error($link));
			$tot_arr_home=mysqli_num_rows($sql_arr_home);
			if($tot_arr_home >0) 
			{
				$row_arr_home=mysqli_fetch_array($sql_arr_home);
	
				$trdate=$row_arr_home['btsplatingss2_resultdate'];
				
				
				$trid=$row_arr_home['btsplatingss2_id'];
				$offtypeper=''; $femaletypeper=''; $maletypeper='';	
				
				$qry_btsgerm=mysqli_query($link,"select * from tbl_btssdldispm_sub where btssdldispms_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
				$row_btsgerm=mysqli_fetch_array($qry_btsgerm);		
				$hybcode=$row_btsgerm['btssdldispms_hybrid'];
					
				$qry_arr_sub=mysqli_query($link,"select * from tblarrival_sub where lotno='".$row_arr_home['btsplatingss2_lotno']."' order by lotno") or die(mysqli_error($link));
				$row_arr_sub=mysqli_fetch_array($qry_arr_sub);
				
				$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
				$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
				$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
				
				
				
				
				$extlotno=$row_arr_home['btsplatingss2_lotno'];
				$orlot=$row_arr_sub['orlot'];
				$sampleno=$row_btsgerm['btssdldispms_sampleno'];
				$crop=$row_btsgerm['btssdldispms_crop'];
				$variety=$row_btsgerm['btssdldispms_variety'];
				
				if($row_arr_home['btsplatingss2_retestflg']==1)
				{
					$qry_btsplating_retest=mysqli_query($link,"select * from tbl_btsseedling_retest where seelingretest_lotno='".$row_arr_home['btsplatingss2_lotno']."' order by seelingretest_id DESC") or die(mysqli_error($link));
					$row_btsplating_retest=mysqli_fetch_array($qry_btsplating_retest);
					
					$noofampsamples=$row_btsplating_retest['seelingretest_noofpcrampsamples'];
					$offtype=$row_btsplating_retest['seelingretest_offtype'];
					$femaletype=$row_btsplating_retest['seelingretest_femaletype'];
					$maletype=$row_btsplating_retest['seelingretest_maletype'];
					$impurities=$row_btsplating_retest['seelingretest_impuritiesper'];
					$gpper=$row_btsplating_retest['seelingretest_gpper'];
					$noofhybrid=$row_btsplating_retest['seelingretest_noofhybrid'];
					$btsgrade=$row_btsplating_retest['seelingretest_grade'];
					
					$offtypeper=round((($row_btsplating_retest['seelingretest_offtype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
					$femaletypeper=round((($row_btsplating_retest['seelingretest_femaletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
					$maletypeper=round((($row_btsplating_retest['seelingretest_maletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
				}
				else
				{
					$noofampsamples=$row_arr_home['btsplatingss2_noofpcrampsamples'];
					$offtype=$row_arr_home['btsplatingss2_offtype'];
					$femaletype=$row_arr_home['btsplatingss2_femaletype'];
					$maletype=$row_arr_home['btsplatingss2_maletype'];
					$impurities=$row_arr_home['btsplatingss2_impuritiesper'];
					$gpper=$row_arr_home['btsplatingss2_gpper'];
					$btsgrade=$row_arr_home['btsplatingss2_grade'];
					$noofhybrid=$row_arr_home['btsplatingss2_noofhybrid'];
					
					$offtypeper=round((($row_arr_home['btsplatingss2_offtype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
					$femaletypeper=round((($row_arr_home['btsplatingss2_femaletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
					$maletypeper=round((($row_arr_home['btsplatingss2_maletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
				}
				$prodgrade=$row_arr_sub['prodgrade'];
				$farmerid=$row_btsgerm['btssdldispms_farmerid'];
				$agreementid=$row_btsgerm['btssdldispms_agreementid'];
				
	
				$sql_in1="Insert into tbl_gotgrade (gotgrade_date, gotgrade_crop, gotgrade_variety, gotgrade_lotno, gotgrade_orlot, gotgrade_prodgrade, gotgrade_sampleno, gotgrade_farmerid, gotgrade_agreementid, gotgrade_noampsamples, gotgrade_offtype, gotgrade_offtypeper, gotgrade_femaletype, gotgrade_femaletypeper, gotgrade_maletype, gotgrade_maletypeper, gotgrade_noofhybrid, gotgrade_impurper, gotgrade_gpper, gotgrade_grade, gotgrade_btsresultdate, gotgrade_finalgrade, gotgrade_tflg, gotgrade_yearcode, gotgrade_logid, gotgrade_hybrid) Values('".$tdate."', '".$crop."', '".$variety."', '".$extlotno."', '".$orlot."', '".$prodgrade."', '".$sampleno."', '".$farmerid."', '".$agreementid."', '".$noofampsamples."', '".$offtype."', '".$offtypeper."', '".$femaletype."', '".$femaletypeper."', '".$maletype."', '".$maletypeper."', '".$noofhybrid."', '".$impurities."', '".$gpper."', '".$btsgrade."', '".$trdate."', '".$finalgotgrade."', '1', '".$yearid_id."', '".$logid."', '".$hybcode."')";	
				$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			}	
		}
		else
		{
		
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
<title>Quality- Transaction-Existing Lot updation</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
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
	if(document.frmaddDept.finalgotgrade.value=='')
	{
		alert("Please select Final GOT Grade");
		return false;
	}
	if(document.frmaddDept.btnval.value==2)
	{
		return false;
	}
	else
	{
		return true;
	}
}	

function smpabort(btval)
{
	if(!confirm("Do you wish to Abort this QC Request?")==true)
	{
		document.frmaddDept.btnval.value=2;
		return false;
	}
	else
	{
		document.frmaddDept.btnval.value=btval;
		return true;
	}
}	
			</script>
</head>
<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input type="hidden" name="cnt" value="0" />
		  <input name="txt" value="" type="hidden"> 
		  <input name="btnval" value="0" type="hidden"> 
		  <input name="tid" value="<?php echo $tid;?>" type="hidden"> 
		</br>		
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_btsplatingsub_sub2 where btsplatingss2_id='$tid'") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) {
?>
		<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >GOT Final Grade update </td>
          </tr>
<?php

$srno=1;
	$row_arr_home=mysqli_fetch_array($sql_arr_home);

			
	$trdate=$row_arr_home['btsplatingss2_resultdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trid=$row_arr_home['btsplatingss2_id'];
	//$drole=$row_arr_home['blendm_logid'];
	$offtypeper=''; $femaletypeper=''; $maletypeper='';	
	
	$qry_btsgerm=mysqli_query($link,"select * from tbl_btssdldispm_sub where btssdldispms_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
	$row_btsgerm=mysqli_fetch_array($qry_btsgerm);		
		
	$qry_arr_sub=mysqli_query($link,"select * from tblarrival_sub where lotno='".$row_arr_home['btsplatingss2_lotno']."' order by lotno") or die(mysqli_error($link));
	$row_arr_sub=mysqli_fetch_array($qry_arr_sub);
	
	$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
	$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
	$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
	
	$extlotno=$row_arr_home['btsplatingss2_lotno'];
	
	$qry_tbl_makerselection=mysqli_query($link,"select * from tbl_makerselection where makersel_farmerid='".trim($row_btsgerm['btssdldispms_farmerid'])."'") or die(mysqli_error($link));
	$tot_tbl_makerselection=mysqli_num_rows($qry_tbl_makerselection);	
	$row_tbl_makerselection=mysqli_fetch_array($qry_tbl_makerselection);	
	
	$qry_tbl_makerselection_sub=mysqli_query($link,"select * from tbl_makerselection_sub where makersel_id='".$row_tbl_makerselection['makersel_id']."'") or die(mysqli_error($link));
	$tot_tbl_makerselection_sub=mysqli_num_rows($qry_tbl_makerselection_sub);	
	$row_tbl_makerselection_sub=mysqli_fetch_array($qry_tbl_makerselection_sub);	
	
	if($row_arr_home['btsplatingss2_retestflg']==1)
	{
		$qry_btsplating_retest=mysqli_query($link,"select * from tbl_btsseedling_retest where seelingretest_lotno='".$row_arr_home['btsplatingss2_lotno']."' order by seelingretest_id DESC") or die(mysqli_error($link));
		$row_btsplating_retest=mysqli_fetch_array($qry_btsplating_retest);
		
		$crop=$row_btsgerm['btssdldispms_crop'];
		$variety=$row_btsgerm['btssdldispms_variety'];
		$noofpcrampsamples=$row_btsplating_retest['seelingretest_noofpcrampsamples'];
		$offtype=$row_btsplating_retest['seelingretest_offtype'];
		$femaletype=$row_btsplating_retest['seelingretest_femaletype'];
		$maletype=$row_btsplating_retest['seelingretest_maletype'];
		$impuritiesper=$row_btsplating_retest['seelingretest_impuritiesper'];
		$gpper=$row_btsplating_retest['seelingretest_gpper'];
		$grade=$row_arr_sub['prodgrade'];
		$btsgrade=$row_btsplating_retest['seelingretest_grade'];
		
		$offtypeper=round((($row_btsplating_retest['seelingretest_offtype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
		$femaletypeper=round((($row_btsplating_retest['seelingretest_femaletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
		$maletypeper=round((($row_btsplating_retest['seelingretest_maletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
	}
	else
	{
		$crop=$row_btsgerm['btssdldispms_crop'];
		$variety=$row_btsgerm['btssdldispms_variety'];
		$noofpcrampsamples=$row_arr_home['btsplatingss2_noofpcrampsamples'];
		$offtype=$row_arr_home['btsplatingss2_offtype'];
		$femaletype=$row_arr_home['btsplatingss2_femaletype'];
		$maletype=$row_arr_home['btsplatingss2_maletype'];
		$impuritiesper=$row_arr_home['btsplatingss2_impuritiesper'];
		$gpper=$row_arr_home['btsplatingss2_gpper'];
		$grade=$row_arr_sub['prodgrade'];
		$btsgrade=$row_arr_home['btsplatingss2_grade'];
		
		$offtypeper=round((($row_arr_home['btsplatingss2_offtype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
		$femaletypeper=round((($row_arr_home['btsplatingss2_femaletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
		$maletypeper=round((($row_arr_home['btsplatingss2_maletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
	}
?>
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Crop&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $crop;?></td>
            <td align="right"  valign="middle"  class="tblheading">&nbsp;Variety&nbsp;</td>
            <td width="173" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
          </tr>
		  <tr class="Light" height="25">
            		    <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Lot No.&nbsp;</td>
		                <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $extlotno?></td>
			 <td align="right"  valign="middle" class="tblheading">Sample No.&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $row_btsgerm['btssdldispms_sampleno'];?></td>
	      </tr>
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;BTS Result Date&nbsp;</td>
            <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $trdate;?></td>
            <td align="right"  valign="middle"  class="tblheading">No of Amp. Samples&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $noofpcrampsamples;?></td>
          </tr>
          <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tblheading">Off Type&nbsp;</td>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $offtype;?></td>
			    <td align="right"  valign="middle" class="tblheading" >Off Type %&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $offtypeper?></td>
          </tr>
		  <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tblheading">Female Type&nbsp;</td>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $femaletype;?></td>
			    <td align="right"  valign="middle" class="tblheading" >Female Type %&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $femaletypeper?></td>
          </tr>
		  <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tblheading">Male Type&nbsp;</td>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $maletype;?></td>
			    <td align="right"  valign="middle" class="tblheading" >Male Type %&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $maletypeper?></td>
          </tr>
		  <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tblheading">Impurities %&nbsp;</td>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $impuritiesper;?></td>
			    <td align="right"  valign="middle" class="tblheading" >GP %&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $gpper?></td>
          </tr>
		  <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tblheading">BTS Grade&nbsp;</td>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $btsgrade;?></td>
			    <td align="right"  valign="middle" class="tblheading" >Prod. Grade&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_arr_sub['prodgrade']?></td>
          </tr>
		  
		  <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tblheading">BTS Remark&nbsp;</td>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $row_tbl_makerselection_sub['makersels_remark'];?></td>
			    <td align="right"  valign="middle" class="tblheading" >BTS Termination Remark&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_btsgerm['btssdldispms_terremark']?></td>
          </tr>
          <tr class="Dark" height="30">
            
                     <td align="right"  valign="middle" class="tblheading">Final GOT Grade&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<select name="finalgotgrade"  style="width:80px;" class="tbltext" tabindex="" >
<option value="" selected>Select</option>
<option value="A+">A+</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="BL">BL</option>
<option value="Hold">Hold</option>
<option value="Substandard">Substandard</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
               
                <td width="128" align="right" valign="middle" class="tblheading">&nbsp;Date  &nbsp;</td>
            <td align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y");?>" style="background-color:#EFEFEF" /></td>
             
             
          </tr>
        
          <input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
          <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
        </table>
	
<table cellpadding="5" cellspacing="5" border="0" width="550">
    <tr >
      <td align="center" colspan="3"><img src="../images/back.gif" border="0" onclick="window.close()" style="cursor:pointer" />&nbsp;<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="return mySubmit();" src="../images/update.gif" alt="Submit Value" border="0"/></td>
    </tr>
  </table>
</form>
<?php
}
?></td></tr>
</table>

</body>
</html>
