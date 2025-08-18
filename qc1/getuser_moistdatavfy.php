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
		
		$newreplflg=$_POST['newreplflg'];
		$txtmmper=$_POST['txtmmper'];
		$txtmmresult=$_POST['txtmmresult'];
		$standmoistper=$_POST['standmoistper'];
		$qcm_haommoistper=$_POST['qcm_haommoistper'];
		$qcm_mmrmoistper=$_POST['qcm_mmrmoistper'];
		$samplenumber=$_POST['samplenumber'];
		
		
		$txtmmsrep1=0; $txtmmsrep2=0; $txtmmsrep3=0; $txtmmsper=0; $qcm_haomflg=0; $qcm_mmrflg=0;
		if($newreplflg>0)
		{
			$txtmmsrep1=$_POST['mmsrep1'];
			$txtmmsrep2=$_POST['mmsrep2'];
			$txtmmsrep3=$_POST['mmsrep3'];
			$txtmmsper=$_POST['mmsper'];
		}	
		if($samplenumber!='')
		{
			$dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
			
			$sql_in1="update tbl_qcmdata set qcm_mmsrep1='$txtmmsrep1', qcm_mmsrep2='$txtmmsrep2', qcm_mmsrep3='$txtmmsrep3', qcm_mmsreplogid='$logid', qcm_mmsrepdt='$dt', qcm_mmrsmoistper='$txtmmsper', qcm_mmrsflg='$two', qcm_moistflg='$one', qcm_moistper='$txtmmper', qcm_moistdt='$dt'  where qcm_sampno='$samplenumber'";	
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
<title>Quality- Transaction-Moisture Data Review</title>
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
	if(document.frmaddDept.newreplflg.value>0)
	{
		if(document.frmaddDept.mmsrep1.value=='')
		{
			alert("Please add Reading 1 first");
			flg=1;
			document.frmaddDept.mmsrep1.focus();
		}
		if(document.frmaddDept.mmsrep2.value=='')
		{
			alert("Please add Reading 2 first");
			flg=1;
			document.frmaddDept.mmsrep2.focus();
		}
	}
	if(document.frmaddDept.txtmmper.value=='')
	{
		alert("Please click on Display button to calculate the result");
		flg=1;
		//document.frmaddDept.mmsrep2.focus();
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



function opennewrepl()
{
	document.getElementById('newreading').style.display='block';
	document.frmaddDept.newreplflg.value=1;
	document.frmaddDept.txtmmper.value='';
	document.frmaddDept.txtmmresult.value='';
	document.getElementById("recomshow").style.display="none";
}
function closenewrepl()
{
	document.frmaddDept.mmsrep1.value='';
	document.frmaddDept.mmsrep2.value='';
	document.frmaddDept.mmsrep3.value='';
	document.frmaddDept.mmsper.value='';
	document.getElementById('newreading').style.display='none';
	document.frmaddDept.newreplflg.value=0;
	document.frmaddDept.txtmmper.value='';
	document.frmaddDept.txtmmresult.value='';
	document.getElementById("recomshow").style.display="none";
}

function calmoistper(nval)
{
	if(nval>1)
	{
		document.frmaddDept.txtmmper.value='';
		document.frmaddDept.txtmmresult.value='';
		document.getElementById("recomshow").style.display="none";
		var mmsrep1=0;
		var mmsrep2=0;
		var mmsrep3=0;
		var mmsper=0;
		if(document.frmaddDept.mmsrep1.value!='')mmsrep1=document.frmaddDept.mmsrep1.value;
		if(document.frmaddDept.mmsrep2.value!='')mmsrep2=document.frmaddDept.mmsrep2.value;
		if(document.frmaddDept.mmsrep3.value!='')mmsrep3=document.frmaddDept.mmsrep3.value;
		if(mmsrep2!="")
		{
			mmsper=(parseFloat(mmsrep1)+parseFloat(mmsrep2))/2;
		}
		if(mmsrep3!="")
		{
			mmsper=(parseFloat(mmsrep1)+parseFloat(mmsrep2)+parseFloat(mmsrep3))/3;
		}
		mmsper=mmsper.toFixed(2);
		if(nval==2 && document.frmaddDept.mmsrep1.value=='')
		{
			alert("Please add Reading 1 first");
			document.frmaddDept.mmsrep2.value='';
			document.frmaddDept.mmsrep1.focus();
		}
		else if(nval==3 && document.frmaddDept.mmsrep2.value=='')
		{
			alert("Please add Reading 2 first");
			document.frmaddDept.mmsrep3.value='';
			document.frmaddDept.mmsrep2.focus();
		}
		else
		{
			document.frmaddDept.mmsper.value=mmsper;
		}
	}
}
function showresult()
{
	if(document.frmaddDept.newreplflg.value>0 && document.frmaddDept.mmsper.value>0)
	{document.frmaddDept.txtmmper.value=parseFloat(document.frmaddDept.mmsper.value);}
	else if(document.frmaddDept.qcm_mmrmoistper.value>0)
	{document.frmaddDept.txtmmper.value=parseFloat(document.frmaddDept.qcm_mmrmoistper.value);}
	else
	{document.frmaddDept.txtmmper.value=parseFloat(document.frmaddDept.qcm_haommoistper.value);}
	
	if(document.frmaddDept.txtmmper.value!='')
	{
		if(parseFloat(document.frmaddDept.txtmmper.value)>parseFloat(document.frmaddDept.standmoistper.value))
		{document.frmaddDept.txtmmresult.value="HIGH"; document.getElementById("recomshow").style.display="block";}
		else
		{document.frmaddDept.txtmmresult.value="OK"; document.getElementById("recomshow").style.display="none";}
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
            <td colspan="4" align="center" class="tblheading" >QC Moisture Data Verification</td>
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
          <tr class="Light" height="30">
           
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
          <tr class="Dark" height="30">
            <td align="right"  valign="middle" class="tblheading">Sample No.&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
            <td width="128" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
            <td align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<?php echo $trdate;?></td>
          </tr>
        
          <input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
          <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
        </table><br />

<?php 
$qcm_m1rep1=''; $qcm_m1rep2=''; $qcm_m1rep3=''; $qcm_m1rep4=''; $qcm_m2rep1=''; $qcm_m2rep2=''; $qcm_m2rep3=''; $qcm_m2rep4=''; $qcm_m3rep1=''; $qcm_m3rep2=''; $qcm_m3rep3=''; $qcm_m3rep4=''; $qcm_rep1moistper=''; $qcm_rep2moistper=''; $qcm_rep3moistper=''; $qcm_rep4moistper=''; $qcm_haommoistper=0; $qcm_haomflg=0; $qcm_mmrep1=''; $qcm_mmrep2=''; $qcm_mmrep3=''; $qcm_mmrmoistper=0; $qcm_mmrflg=0; $qcm_moistflg=0;

$sampn=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$qc1);
$one=1;
$sql_in1="update tbl_qcmdata set qcm_mmrflg='$one' where qcm_sampno='$sampn' and qcm_mmrmoistper>0";	
$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
	

$sql_mdata=mysqli_query($link,"select * from tbl_qcmdata where qcm_sampno='".$sampn."' ") or die(mysqli_error($link));
$row_mdata=mysqli_fetch_array($sql_mdata);

$qcm_haomflg=$row_mdata['qcm_haomflg'];
if($row_mdata['qcm_haommoistper']>0)
{
	$qcm_m1rep1=$row_mdata['qcm_m1rep1']; 
	$qcm_m1rep2=$row_mdata['qcm_m1rep2'];
	$qcm_m1rep3=$row_mdata['qcm_m1rep3']; 
	$qcm_m1rep4=$row_mdata['qcm_m1rep4']; 
	$qcm_m2rep1=$row_mdata['qcm_m2rep1']; 
	$qcm_m2rep2=$row_mdata['qcm_m2rep2'];
	$qcm_m2rep3=$row_mdata['qcm_m2rep3'];
	$qcm_m2rep4=$row_mdata['qcm_m2rep4']; 
	$qcm_m3rep1=$row_mdata['qcm_m3rep1']; 
	$qcm_m3rep2=$row_mdata['qcm_m3rep2']; 
	$qcm_m3rep3=$row_mdata['qcm_m3rep3'];
	$qcm_m3rep4=$row_mdata['qcm_m3rep4'];
	$qcm_rep1moistper=$row_mdata['qcm_rep1moistper'];
	$qcm_rep2moistper=$row_mdata['qcm_rep2moistper'];
	$qcm_rep3moistper=$row_mdata['qcm_rep3moistper'];
	$qcm_rep4moistper=$row_mdata['qcm_rep4moistper']; 
	$qcm_haommoistper=$row_mdata['qcm_haommoistper']; 
}
$qcm_mmrflg=$row_mdata['qcm_mmrflg'];
if($qcm_mmrflg>0)
{
	$qcm_mmrep1=$row_mdata['qcm_mmrep1']; 
	$qcm_mmrep2=$row_mdata['qcm_mmrep2']; 
	$qcm_mmrep3=$row_mdata['qcm_mmrep3'];
	$qcm_mmrmoistper=$row_mdata['qcm_mmrmoistper'];
}

$qcm_moistflg=$row_mdata['qcm_moistflg'];
if($row_mdata['qcm_haommoistper']>0)
{
?>

<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
	<td align="right" valign="middle" class="tblheading" colspan="2">Moisture Test Type&nbsp;</td>
	<td align="left"  valign="middle" class="tblheading" colspan="3" >&nbsp;Hot Air Oven Method</td>
</tr>
<tr class="Dark" height="30">
	<td width="20%" align="center" valign="middle" class="tblheading">Rep #</td>
	<td width="20%" align="center" valign="middle" class="tblheading">M1</td>
	<td width="20%" align="center"  valign="middle" class="tblheading" >M2</td>
	<td width="20%" align="center"  valign="middle" class="tblheading" >M3</td>
	<td width="20%" align="center"  valign="middle" class="tblheading" >Moisture %</td>
</tr>
<tr class="Dark" height="30">
	<td width="20%" align="center" valign="middle" class="tblheading">1</td>
	<td width="20%" align="center" valign="middle" class="tblheading"><?php echo $qcm_m1rep1;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m2rep1;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m3rep1;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_rep1moistper;?></td>
</tr>
<tr class="Dark" height="30">
	<td width="20%" align="center" valign="middle" class="tblheading">2</td>
	<td width="20%" align="center" valign="middle" class="tblheading"><?php echo $qcm_m1rep2;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m2rep2;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m3rep2;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_rep2moistper;?></td>
</tr>
<tr class="Dark" height="30">
	<td width="20%" align="center" valign="middle" class="tblheading">3</td>
	<td width="20%" align="center" valign="middle" class="tblheading"><?php echo $qcm_m1rep3;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m2rep3;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m3rep3;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_rep3moistper;?></td>
</tr>
<tr class="Dark" height="30">
	<td width="20%" align="center" valign="middle" class="tblheading">4</td>
	<td width="20%" align="center" valign="middle" class="tblheading"><?php echo $qcm_m1rep4;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m2rep4;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_m3rep4;?></td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_rep4moistper;?></td>
</tr>
<tr class="Dark" height="30">
	<td align="right"  valign="middle" class="tblheading"  colspan="4">Moisture %&nbsp;</td>
	<td width="20%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_haommoistper;?></td>
</tr>
</table>
<?php
}
if($qcm_mmrflg>0)
{
?>
<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
	<td width="50%" align="right" valign="middle" class="tblheading" >Moisture Test Type&nbsp;</td>
	<td width="50%" align="left"  valign="middle" class="tblheading" >&nbsp;Moisture Meter</td>
</tr>
<tr class="Dark" height="30">
	<td width="50%" align="center" valign="middle" class="tblheading">Reading 1</td>
	<td width="50%" align="center" valign="middle" class="tblheading"><?php echo $qcm_mmrep1;?></td>
</tr>
<tr class="Dark" height="30">
	<td width="50%" align="center" valign="middle" class="tblheading">Reading 2</td>
	<td width="50%" align="center" valign="middle" class="tblheading"><?php echo $qcm_mmrep2;?></td>
</tr>
<tr class="Dark" height="30">
	<td width="50%" align="center" valign="middle" class="tblheading">Reading 3</td>
	<td width="50%" align="center" valign="middle" class="tblheading"><?php echo $qcm_mmrep3;?></td>
</tr>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading"  >Moisture %&nbsp;</td>
	<td width="50%" align="center"  valign="middle" class="tblheading" ><?php echo $qcm_mmrmoistper;?></td>
</tr>
</table>
<?php
}
?>
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
	<td align="right" valign="middle" class="tblheading" ><a href="Javascript:void(0);" onclick="opennewrepl();">Supervisor Test Reading</a>&nbsp;</td>
</tr>
</table>	
<div id="newreading" style="display:none">
<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
	<td align="center" valign="middle" class="tblheading" colspan="2" >New Moisture Test&nbsp;</td>
</tr>
<tr class="Dark" height="30">
	<td width="50%" align="right" valign="middle" class="tblheading">Reading 1&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="mmsrep1" size="5" maxlength="5" class="tbldtext" value="" onchange="calmoistper(1);" />&nbsp;%&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Dark" height="30">
	<td width="50%" align="right" valign="middle" class="tblheading">Reading 2&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="mmsrep2" size="5" maxlength="5" class="tbldtext" value="" onchange="calmoistper(2);" />&nbsp;%&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Dark" height="30">
	<td width="50%" align="right" valign="middle" class="tblheading">Reading 3&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="mmsrep3" size="5" maxlength="5" class="tbldtext" value="" onchange="calmoistper(3);" />&nbsp;%&nbsp;</td>
</tr>
<tr class="Dark" height="30">
	<td align="right"  valign="middle" class="tblheading"  >Moisture %&nbsp;</td>
	<td width="50%" align="left"  valign="middle" class="tblheading" >&nbsp;<input type="text" name="mmsper" size="5" maxlength="5" class="tbldtext" value="" readonly="true" style="background-color:#CCCCCC" />&nbsp;%&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
	<td align="right" valign="middle" class="tblheading" ><a href="Javascript:void(0);" onclick="closenewrepl();">Cancel</a>&nbsp;</td>
</tr>
</table>
</div><br />
<table cellpadding="5" cellspacing="5" border="0" width="600">
    <tr >
      <td align="center" colspan="3"><img src="../images/display.gif" border="0" onclick="showresult()" style="cursor:pointer" alt="Display Result" /></td>
    </tr>
  </table>
<br />

<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
	<td align="center" valign="middle" class="tblheading" colspan="2" >Moisture Test Result&nbsp;</td>
</tr>
<tr class="Dark" height="30">
	<td align="right" width="50%" valign="middle" class="tblheading" >Moisture %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="txtmmper" size="5" maxlength="5" class="tbldtext" value="" readonly="true" style="background-color:#CCCCCC" />&nbsp;%&nbsp;</td>
</tr>
<?php
$moiresolt="OK";
if($qcm_mmrmoistper>$standmoistper){$moiresolt="HIGH";}

?>

<tr class="Dark" height="30">
	<td align="right" width="50%" valign="middle" class="tblheading" >Result&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="txtmmresult" size="10" class="tbldtext" value="" readonly="true" style="background-color:#CCCCCC" /><span id="recomshow" style="display:none" class="tbltext">&nbsp;More than standard, Drying recommended</span></td>
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
