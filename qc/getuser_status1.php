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
		 $tid = $_REQUEST['tid'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{
		$tid = $_POST['tid'];
		
		$e=$_POST['sdate'];
		$btnval=$_POST['btnval'];
		$lotno=$_POST['lotnochk'];
		$lotn=$_POST['oldlotno'];
		$oldlotno=$_POST['oldlotno'];
		
		$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		if($btnval!=0 && $btnval!=2)
		{
			$sql_chk=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotn'") or die(mysqli_error($link));
			$tot_chk=mysqli_num_rows($sql_chk);
			
			$sql_tbl=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotn' order by tid desc limit 1,1") or die(mysqli_error($link));
			$tot_tbl=mysqli_num_rows($sql_tbl);
			if($tot_tbl > 0 && $tot_chk > 1)
			{
				$row_tbl=mysqli_fetch_array($sql_tbl);
				$qcresult=$row_tbl['qcstatus'];
				$gotresult=$row_tbl['gotstatus'];
				if($qcresult=="")$qcresult="UT";
				
				$sql_sub="update tbl_lot_ldg set lotldg_qc='$qcresult' where orlot='$lotn'";
				$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='$qcresult' where orlot='$lotn'";
				$sql_sub3="update tbl_salesrv_sub set salesrs_qc='$qcresult' where salesrs_orlot='$lotn' and (salesrs_qc='UT' OR salesrs_qc='RT')";	
				$sql_sub4="update tbl_revalidate set rv_qc='$qcresult' where rv_lotno='$lotno' and (rv_qc='UT' OR rv_qc='RT')";
				$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
				$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
				$qq3=mysqli_query($link,$sql_sub3) or die(mysqli_error($link));
				$qq4=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
			}
			else
			{
				$sql_sub="update tbl_lot_ldg set lotldg_qc='NUT' where orlot='$lotn'";
				$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));

				$sql_sub2="update tbl_lot_ldg_pack set lotldg_qc='NUT' where orlot='$lotn'";
				$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
			}		
			
			$sql_in1="delete from tbl_qctest where tid='$tid'";	
			$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			
			$sqlin1="delete from tbl_revalidate where rv_lotno='$lotno' and (rv_qc='UT' OR rv_qc='RT')";	
			$aa=mysqli_query($link,$sqlin1)or die(mysqli_error($link));
			$sqlsub2="update tbl_lot_ldg_pack set lotldg_rvflg='1' where lotno='$lotno'";
			$qqp2=mysqli_query($link,$sqlsub2) or die(mysqli_error($link));
			
			$arrival_id21=0;
			$sql_tbl21=mysqli_query($link,"select * from tbl_qcgen1 where arr_role='".$logid."' and lotno='".$lotn."'") or die(mysqli_error($link));
			while($row_tbl21=mysqli_fetch_array($sql_tbl21))
			{
				$arrival_id21=$row_tbl21['arrival_id'];	
				$s_sub21="delete from tbl_qcgen1 where arrival_id='".$row_tbl21['arrsub_id']."'";
				mysqli_query($link,$s_sub21) or die(mysqli_error($link));
			}
			$sql_tbl22=mysqli_query($link,"select * from tbl_qcgen1 where arr_role='".$logid."' and arrival_id='".$arrival_id21."'") or die(mysqli_error($link));
			if($tot_tbl22=mysqli_fetch_array($sql_tbl22) == 0)
			{
				$s_sub22="delete from tbl_qcgen where arr_role='".$logid."' and arrival_id='".$arrival_id21."'";
				mysqli_query($link,$s_sub22) or die(mysqli_error($link));	
			}	
		}
		else if($btnval==0)
		{
			$sql_chk=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
			$tot_chk=mysqli_num_rows($sql_chk);
			$row_chk=mysqli_fetch_array($sql_chk);
			
			$smpn=$row_chk['sampleno'];
			$yrd=$row_chk['yearid'];
			
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
				
			$sql_in1="update tbl_qctest set spdate='$tdate', bflg=1, stsno='$code' where sampleno='$smpn' and yearid='$yrd'";	
			$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			
			$sql_in2="update tbl_gottest set gottest_spdate='$tdate', gottest_bflg=1 where gottest_sampleno='$smpn' and yearid='$yrd'";	
			$aa2=mysqli_query($link,$sql_in2)or die(mysqli_error($link));
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
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.dcdate.value,"-");
	dt3=getDateObject(document.frmaddDept.cdate.value,"-");	
	if(dt1 > dt3)
	{
	alert("Please select Valid Date.");
	return false;
	}
if(dt1 < dt2)
	{
	alert("Please select Valid Date Of Sampling.");
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
 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit()" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input type="hidden" name="cnt" value="0" />
		  <input name="txt" value="" type="hidden"> 
		  <input name="btnval" value="0" type="hidden"> 
		  <input name="tid" value="<?php echo $tid;?>" type="hidden"> 
		</br>		
		<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
?>
		<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >QC Sample Collection update </td>
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
		
		$lotno=$row_tbl_sub1['lotno'];
		
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

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id desc") or die(mysqli_error($link));
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
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?>
		  <tr class="Light" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;DOSR&nbsp; </td>
		    <td align="left"  valign="middle" class="tblheading"  colspan="3">&nbsp;
		        <?php echo $trdate;?></td>
		    <!--<td width="87" align="right"  valign="middle"  class="tblheading">&nbsp;Lot No&nbsp;</td>
		    <td width="108" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $lotno?></td>-->
	      </tr>
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Crop&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
            <td align="right"  valign="middle"  class="tblheading">&nbsp;Variety&nbsp;</td>
            <td width="173" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?></td>
          </tr>
		  <tr class="Light" height="25">
            		    <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;Lot No.&nbsp;</td>
		                <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $lotno?><input type="hidden" name="lotnochk" value="<?php echo $lotno;?>" /><input type="hidden" name="oldlotno" value="<?php echo $oldlotno;?>" /></td>
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
                <td align="left"  valign="middle" class="tblheading" >&nbsp;
                <?php echo $pp?></td>
          </tr>
          <tr class="Dark" height="30">
            
                     <td align="right"  valign="middle" class="tblheading">Sample No.&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
               
                <td width="128" align="right" valign="middle" class="tblheading">&nbsp;Date  &nbsp;</td>
            <td align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></td>
             
             
          </tr>
        
          <input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
          <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
        </table>
	
<table cellpadding="5" cellspacing="5" border="0" width="550">
    <tr >
      <td align="center" colspan="3"><img src="../images/back.gif" border="0" onclick="window.close()" style="cursor:pointer" />&nbsp;<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="smpabort('1');" src="../images/abort.gif" alt="Abort Value" border="0"/>&nbsp;<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="mySubmit();" src="../images/update.gif" alt="Submit Value" border="0"/></td>
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
