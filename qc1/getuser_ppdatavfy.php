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
	
if(isset($_REQUEST['tid']))
	{
		 $tid = $_REQUEST['tid'];
	}
	/*if(isset($_REQUEST['arival_id']))
	{
		 $tid = $_REQUEST['arrival_id'];
	}*/
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$pptestresult=$_POST['pptestresult'];
		$txtremark=$_POST['txtremark'];
		$samplenumber=$_POST['samplenumber'];
		
		if($samplenumber!='')
		{
			$dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
			
			$sql_in1="update tbl_qcpdata set qcp_ppresult='$pptestresult', qcp_ppremark='$txtremark', qcp_qcslogid='$logid', qcp_ppdataflg='$one', qcp_ppflg='$one', qcp_ppdate='$dt' where qcp_sampleno='$samplenumber'";	
			if($aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link)))
			{
				echo "<script>window.opener.location.href = window.opener.location.href;  self.close();</script>";	
			}
		}
		else
		{
			echo "<script>alert('Moisture data not updated. Please try again.'); </script>";	
		}
		//exit;	
	
	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction-Physical Purity Data Review</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

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
	var flg=0;
	if(document.frmaddDept.pptestresult.value=='')
	{
		alert("Please select the result");
		flg=1;
		document.frmaddDept.pptestresult.focus();
	}
	if(flg>0)
	{
		return false;
	}
	else
	{
		return true;
	}
}	

	
			</script>
</head>
<body topmargin="0" >
  
<table width="600" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit()" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input type="hidden" name="cnt" value="0" />
		  <input name="txt" value="" type="hidden"> 
		  <input name="btnval" value="0" type="hidden"> 
		</br>
		<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
?>
		<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >QC Physical Purity Data Verification</td>
          </tr>
          <?php

$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
			
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$stage=$row_arr_home['trstage'];
		$crop=""; $variety=""; $lotno=""; $bags=0; $qty=0;  $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
$pp=$row_tbl_sub1['state'];	
	
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	$oldlotno=$row_tbl_sub1['oldlot'];
		
	}
		 $trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	


$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$lotno."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
while($row_is=mysqli_fetch_array($sql_is))
{ 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$lotno."' order by lotldg_id desc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty>0 order by lotldg_id desc") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$row_tbl=mysqli_fetch_array($sql_istbl);

$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}

	$bags=$bags+$ac;
	$qty=$qty+$acn;

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";	
}
}
	
/*	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
*/

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
$row31=mysqli_fetch_array($quer3);
$standmoistper=$row31['smp'];
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?>
		  
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Crop&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
            <td align="right"  valign="middle"  class="tblheading">&nbsp;Variety&nbsp;</td>
            <td width="173" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?></td>
          </tr>
		  <tr class="Light" height="25">
            		    <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Lot No.&nbsp;</td>
		                <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $lotno?><input type="hidden" name="lotnochk" value="<?php echo $oldlotno;?>" /></td>
			 <td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $stage?></td>
	      </tr>
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;NoB&nbsp;</td>
            <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $bags;?></td>
            <td align="right"  valign="middle"  class="tblheading">Qty&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $qty;?></td>
          </tr>
          <tr class="Light" height="25">
           
        <td align="right"  valign="middle" class="tblheading">SLOC&nbsp;</td>
            <?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
?>
            <td width="140" align="left" class="tblheading">&nbsp;<?php echo $slocs;?></td>
			    <td align="right"  valign="middle" class="tblheading" >QC Test&nbsp;</td>
                <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $pp?></td>
          </tr>
          <tr class="Dark" height="25">
            <td align="right"  valign="middle" class="tblheading">Sample No.&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
            <td width="128" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
            <td align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<?php echo $trdate;?></td>
          </tr>
        
          <input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
          <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
        </table><br />

<?php 
$qcp_samplewt=''; $qcp_pureseed=''; $qcp_pureseedper=''; $qcp_imseed=''; $qcp_imseedper=''; $qcp_lightseed=''; $qcp_lightseedper=''; $qcp_ocseedno=''; $qcp_ocseedinkg=''; $qcp_odvseedno=''; $qcp_odvseedinkg=''; $qcp_dcseed=''; $qcp_dcseedper=''; $qcp_phseedno=''; $qcp_phseedinkg=''; $qcp_pplogid=''; $qcp_ppphoto=''; 

$sampn=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$qc1);
$sql_mdata=mysqli_query($link,"select * from tbl_qcpdata where qcp_sampleno='".$sampn."' ") or die(mysqli_error($link));
$row_mdata=mysqli_fetch_array($sql_mdata);

	$qcp_samplewt=$row_mdata['qcp_samplewt']; 
	$qcp_pureseed=$row_mdata['qcp_pureseed'];
	$qcp_pureseedper=$row_mdata['qcp_pureseedper']; 
	$qcp_imseed=$row_mdata['qcp_imseed']; 
	$qcp_imseedper=$row_mdata['qcp_imseedper']; 
	$qcp_lightseed=$row_mdata['qcp_lightseed'];
	$qcp_lightseedper=$row_mdata['qcp_lightseedper'];
	$qcp_ocseedno=$row_mdata['qcp_ocseedno']; 
	$qcp_ocseedinkg=$row_mdata['qcp_ocseedinkg']; 
	$qcp_odvseedno=$row_mdata['qcp_odvseedno']; 
	$qcp_odvseedinkg=$row_mdata['qcp_odvseedinkg'];
	$qcp_dcseed=$row_mdata['qcp_dcseed'];
	$qcp_dcseedper=$row_mdata['qcp_dcseedper'];
	$qcp_phseedno=$row_mdata['qcp_phseedno'];
	$qcp_phseedinkg=$row_mdata['qcp_phseedinkg'];
	$qcp_pplogid=$row_mdata['qcp_pplogid']; 
	if($row_mdata['qcp_ppphoto']!='')
	$qcp_ppphoto='<img src="data:image/png;base64,'.$row_mdata['qcp_ppphoto'].'" width="150" height="200" />'; 
	if($row_mdata['qcp_odvseedno']>0 && $row_mdata['qcp_odvseedinkg']<=0) { $qcp_odvseedinkg=round(($row_mdata['qcp_odvseedno']/$row_mdata['qcp_samplewt'])*1000); }
?>
<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Physical Purity Test Data</td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Sample Weight (Gms.)&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;<?php echo $qcp_samplewt;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Pure Seed (Gms.)&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcp_pureseed;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Pure Seed (%)&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcp_pureseedper;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Inert Matter (Gms.)&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcp_imseed;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Inert Matter (%)&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcp_imseedper;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Light Seed (Gms.)&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcp_lightseed;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Light Seed (%)&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcp_lightseedper;?></td>
</tr>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Other Crop Seed</td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Total Number in the sample&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcp_ocseedno;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >To be expressed as<br />
(Number/kg seed)&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcp_ocseedinkg;?></td>
</tr>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Other Distinguishable Variety</td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Total Number in the sample&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcp_odvseedno;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >To be expressed as<br />
(Number/kg seed)&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcp_odvseedinkg;?></td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Discoloured Seed (Gms.)&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcp_dcseed;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >Discoloured Seed (%)&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcp_dcseedper;?></td>
</tr>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="4">Pin hole  seed</td>
</tr>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Total Number in the sample&nbsp;</td>
	<td width="17%" align="left" valign="middle" class="tbldtext">&nbsp;<?php echo $qcp_phseedno;?></td>
	<td width="36%" align="right"  valign="middle" class="tblheading" >To be expressed as<br />
(Number/kg seed)&nbsp;</td>
	<td width="17%" align="left"  valign="middle" class="tbldtext" >&nbsp;<?php echo $qcp_phseedinkg;?></td>
</tr>
<?php if($qcp_ppphoto!='') { ?>
<tr class="Dark" height="25">
	<td width="30%" align="right" valign="middle" class="tblheading">Photo&nbsp;</td>
	<td align="left" valign="middle" class="tbldtext" colspan="3">&nbsp;<?php echo $qcp_ppphoto;?></td>
</tr>
<?php } ?>
</table>
<br />


<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="2" >Physical Purity Test Result&nbsp;</td>
</tr>
<tr class="Dark" height="25">
	<td align="right" width="30%" valign="middle" class="tblheading" >Result&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<select name="pptestresult" class="tbldtext" style="size:150px;">
	<option selected="selected" value="">--Select--</option>
	<option value="Acceptable">Acceptable</option>
	<option value="Not Acceptable">Not Acceptable</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Dark" height="25">
	<td align="right" width="30%" valign="middle" class="tblheading" >Remarks&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<textarea name="txtremark" rows="2" cols="60" class="tbldtext" value=""  ></textarea></td>
</tr>
</table>	
<table cellpadding="5" cellspacing="5" border="0" width="600">
    <tr >
      <td align="center" colspan="3"><img src="../images/back.gif" border="0" onclick="window.close()" style="cursor:pointer" />&nbsp;<!--<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="smpabort('1');" src="../images/abort.gif" alt="Abort Value" border="0"/>&nbsp;--><input name="image" type="image" style="display:inline;cursor:pointer;" onclick="mySubmit();" src="../images/update.gif" alt="Submit Value" border="0"/><input type="hidden" name="standmoistper" value="<?php echo $standmoistper;?>" /><input type="hidden" name="newreplflg" value="0" /><input type="hidden" name="qcm_haommoistper" value="<?php echo $qcm_haommoistper;?>" /><input type="hidden" name="qcm_mmrmoistper" value="<?php echo $qcm_mmrmoistper;?>" /><input type="hidden" name="samplenumber" value="<?php echo $sampn;?>" /></td>
    </tr>
  </table>
</form>
<?php
}
}
}
?></td></tr>
</table>

</body>
</html>
