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
    
	if(isset($_REQUEST['subid']))
	{
		$subid = $_REQUEST['subid'];
	}
	if(isset($_REQUEST['mainid']))
	{
		$mainid = $_REQUEST['mainid'];
	}
	
	if(isset($_REQUEST['frm_action'])=='submit')
	{
		 $p_id=trim($_REQUEST['maintrid']); //echo "<br />";
		 $s_id=trim($_REQUEST['subtrid']); //echo "<br />";
		
		 $qcdtyp=trim($_REQUEST['qcdtyp']); //echo "<br />";
		 $validityperiod=trim($_REQUEST['validityperiod']); //echo "<br />";
		 $validityupto=trim($_REQUEST['validityupto']); //echo "<br />";
		 $valdays=trim($_REQUEST['valdays']); //echo "<br />";
		 $qcstatus=trim($_REQUEST['qcstatus']); //echo "<br />";
		 $dopc=trim($_REQUEST['dopc']); //echo "<br />";
		 $qctestdate=trim($_REQUEST['qctestdate']); //echo "<br />";
		
		$tdate12=explode("-",$dopc);
		$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
		
		$tdate13=explode("-",$validityupto);
		$tdate3=$tdate13[2]."-".$tdate13[1]."-".$tdate13[0];
		
		$tdate14=explode("-",$qctestdate);
		$tdate4=$tdate14[2]."-".$tdate14[1]."-".$tdate14[0];
		
		$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$p_id."'") or die(mysqli_error($link));
		$subtbltot=mysqli_num_rows($sql_tbl_sub);
		$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
		$subid=$row_tbl_sub['pnpslipsub_id'];
		$x=0;
		$oflsub=mysqli_query($link,"select * from tbl_oflpnpslipbarcode where pnpslipsub_id='".$s_id."' ") or die(mysqli_error($link));
		$tot_oflsub=mysqli_num_rows($oflsub); echo "<br />";
		if($tot_oflsub>0)
		{
			while($row_oflsub=mysqli_fetch_array($oflsub))
			{
				$str="insert into tbl_pnpslipbarcode (pnpslipsub_id, pnpslipmain_id, pnpslipbar_lotno, pnpslipbar_ups, pnpslipbar_barcode, pnpslipbar_wtmp, pnpslipbar_grosswt, pnpslipbar_wtdate, pnpslipbar_wtmcode, pnpslipbar_wtmopr, pnpslipbar_wtgrfr, pnpslipbar_wtgrto, pnpslipbar_bctype, pnpslipbar_logid, pnpslipbar_yearid, pnpslipbar_whid, pnpslipbar_binid, pnpslipbar_subbinid, pnpslipbar_nop, plantcode) values('".$subid."', '".$p_id."', '".$row_oflsub['pnpslipbar_lotno']."', '".$row_oflsub['pnpslipbar_ups']."', '".$row_oflsub['pnpslipbar_barcode']."', '".$row_oflsub['pnpslipbar_wtmp']."', '".$row_oflsub['pnpslipbar_grosswt']."', '".$row_oflsub['pnpslipbar_wtdate']."', '".$row_oflsub['pnpslipbar_wtmcode']."', '".$row_oflsub['pnpslipbar_wtmopr']."', '".$row_oflsub['pnpslipbar_wtgrfr']."', '".$row_oflsub['pnpslipbar_wtgrto']."', '".$row_oflsub['pnpslipbar_bctype']."', '".$row_oflsub['pnpslipbar_logid']."', '".$row_oflsub['pnpslipbar_yearid']."', '".$row_oflsub['pnpslipbar_whid']."', '".$row_oflsub['pnpslipbar_binid']."', '".$row_oflsub['pnpslipbar_subbinid']."', '".$row_oflsub['pnpslipbar_nop']."', '".$row_oflsub['plantcode']."')";
					$x++;
				$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
	// echo "<br />";		
			}
		}
		
		//echo $tot_oflsub."==".$x;  echo "<br />";
		if($tot_oflsub==$x)
		{
			$sql_tblsub=mysqli_query($link,"select * from tbl_oflpnpslipsub where pnpslipsub_id='".$s_id."'") or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tblsub);
			$row_tblsub=mysqli_fetch_array($sql_tblsub);

			$sql_sub="Update tbl_pnpslipsub SET pnpslipsub_valperiod='".$validityperiod."', pnpslipsub_valupto='".$tdate3."', pnpslipsub_qc='".$qcstatus."', pnpslipsub_qcdot='".$tdate4."', pnpslipsub_qcdttype='".$qcdtyp."', plantcode='".$plantcode."',  pnpslipsub_slabelno='".$row_tblsub['pnpslipsub_slabelno']."', pnpslipsub_slabelno_temp1='".$row_tblsub['pnpslipsub_slabelno_temp1']."', pnpslipsub_slabelno_temp2='".$row_tblsub['pnpslipsub_slabelno_temp2']."', pnpslipsub_elabelno='".$row_tblsub['pnpslipsub_elabelno']."', pnpslipsub_elabelno_temp1='".$row_tblsub['pnpslipsub_elabelno_temp1']."', pnpslipsub_elabelno_temp2='".$row_tblsub['pnpslipsub_elabelno_temp2']."', pnpslipsub_mingrwt='".$row_tblsub['pnpslipsub_mingrwt']."', pnpslipsub_maxgrwt='".$row_tblsub['pnpslipsub_maxgrwt']."' where pnpslipmain_id='$p_id'";
 //echo "<br />";
			if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
			{
				$sql_main="Update tbl_pnpslipmain SET  pnpslipmain_dop='".$tdate2."', pnpslipmain_wbactflag='1' where pnpslipmain_id='$p_id'";
				mysqli_query($link,$sql_main) or die(mysqli_error($link));
 //echo "<br />";
	//exit;			
				echo "<script>window.opener.location.href=window.opener.location.href; self.close();</script>";
			}
		}
		exit;
		
		
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Offline Packing Syncing</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}
*/

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


function mySubmit()
{

	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Valid upto cannot be blank");
		return false;
	}
	if(document.frmaddDepartment.valdays.value=="")
	{
		alert("Validity days cannot be blank");
		return false;
	}
	return true;
}


function qctpchk(qtval)
{
	document.frmaddDepartment.qcdttype.value=qtval;
	document.frmaddDepartment.validityupto.value="";
	document.frmaddDepartment.valdays.value="";
	document.frmaddDepartment.validityperiod.value="";
	document.frmaddDepartment.validityperiod.selectedIndex=0;
	
	if(qtval=="DoT")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot1.value;
	else if(qtval=="DoSF")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot2.value;
	else
		document.frmaddDepartment.qctestdate.value="";
}


function chkvalidity(valval)
{
	/*if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Enter Processing Loss");
		document.frmaddDepartment.txtconpl.focus();
		return false;
	}
	else*/
	{
	if(valval!="")
	{
		dt1=getDateObject(document.frmaddDepartment.date.value,"-");
		dt2=getDateObject(document.frmaddDepartment.dp1.value,"-");
		dt3=getDateObject(document.frmaddDepartment.dp2.value,"-");
		dt4=getDateObject(document.frmaddDepartment.dp3.value,"-");
		dt5=getDateObject(document.frmaddDepartment.dp4.value,"-");
		dt6=getDateObject(document.frmaddDepartment.dp5.value,"-");
		dt7=getDateObject(document.frmaddDepartment.dp6.value,"-");
		if(document.frmaddDepartment.qcdtyp.value=="DoT")
		{
			if(valval==3)
			{
				if(dt2 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp1.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp1.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt3 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp2.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp2.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt4 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp3.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp3.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
		}
		else if(document.frmaddDepartment.qcdtyp.value=="DoSF")
		{
			if(valval==3)
			{
				if(dt5 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp4.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp4.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt6 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp5.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp5.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt7 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp6.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp6.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
		}
		else
		{
			document.frmaddDepartment.validityupto.value="";
			document.frmaddDepartment.valdays.value="";
		}
	}
	else
	{
		document.frmaddDepartment.validityupto.value="";
		document.frmaddDepartment.valdays.value="";
	}
	}
}

	
			</script>
</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="crdate" value="<?php echo date("d-m-Y");?>" />
	 <input type="hidden" name="date" value="<?php echo date("d-m-Y");?>" />
	 <input type="hidden" name="maintrid" value="<?php echo $mainid;?>" />
	 <input type="hidden" name="subtrid" value="<?php echo $subid;?>" />
	  
 <?php 
$tid=$mainid;

$sqtbl=mysqli_query($link,"select * from tbl_oflpnpslipsub where pnpslipsub_id='".$subid."'") or die(mysqli_error($link));
$rotbl=mysqli_fetch_array($sqtbl);			

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Offline Packing Syncing</td>
</tr>

</table>
<?php
	//echo "select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$a."'  ";
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$rotbl['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
  $tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
 $nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype="";
 while($row_issue=mysqli_fetch_array($lotqry))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$rotbl['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
	$nob=$nob+$row_issuetbl['lotldg_balbags']; 
	$qty=$qty+$row_issuetbl['lotldg_balqty'];
	$qc=$row_issuetbl['lotldg_qc'];
	if($qc=="OK")
	{
		$trdate=$row_issuetbl['lotldg_qctestdate'];
		$trdate=explode("-",$trdate);
				$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		$qcdttype="DOT";
	}
//else
{
	$zz=str_split($rotbl['pnpslipsub_lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	//if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($qcdot2=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];

				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";
if($qcdot1=="00-00-0000" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="00-00-0000" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

$tdt="";
$sql_qcs=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='$ltno' and qcstatus='OK' order by tid desc Limit 0,2") or die(mysqli_error($link));
if($tot_qcs=mysqli_num_rows($sql_qcs)>=2)
{
	while($row_qcs=mysqli_fetch_array($sql_qcs))
	{
		if($tdt!="")
		$tdt=$tdt.",".$row_qcs['testdate'];
		else
		$tdt=$row_qcs['testdate'];
	}
}
$tdt1=""; $tdt2="";

$tdt=explode(",",$tdt);
$tdt1=$tdt[0];
$tdt2=$tdt[1];


if($qcdot1!="")
{
	$crdate=date("d-m-Y");
	$now = strtotime($qcdot1); // or your date as well
	$your_date = strtotime($crdate);
	$datediff2 = (($your_date - $now)/(60*60*24));
}
else
$datediff2 = 0;
//echo $qcdot2;
if($datediff2>15)	
{
	$qcdot2="";
}
else
{
	if($tdt2!="")
	{
		if($qcdot2!="" && $qcdot1!="")
		{
			$tdte2=explode("-",$qcdot2);
			$m=$tdte2[1];
			$de=$tdte2[0];
			$y=$tdte2[2];
		  	$tdte2=$y."-".$m."-".$de;
			
			$start_ts = strtotime($tdt2);
			$end_ts = strtotime($tdt1);
			$user_ts = strtotime($tdte2);
			
			//if((($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			if((($user_ts <= $start_ts) || ($user_ts >= $end_ts)))
			//if(!(($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			{
				$qcdot2="";
			}
		}
	}
}
if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";$dp4="";$dp5="";$dp6="";
if($qcdot1!="")
{
	$trdate2=explode("-",$qcdot1);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
if($qcdot2!="")
{
	$trdate2=explode("-",$qcdot2);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp4=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp4="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp5=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp5="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp6=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp6="";}
}
}	
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td width="108" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">DoSF</td>
	<td width="112" align="center" valign="middle" class="tblheading">DoP</td>
	<td width="61" align="center" valign="middle" class="smalltblheading">QC Date Type </td>
	<td width="122" align="center" valign="middle" class="tblheading">Validity Period</td>
	<td width="107" align="center" valign="middle" class="tblheading">Valid upto</td>
	<td width="160" align="center" valign="middle" class="tblheading">Validity Days</td>
  </tr>

  <tr class="Light" height="25">
    <td width="108" align="center" valign="middle" class="smalltblheading"><?php echo $rotbl['pnpslipsub_lotno'];?><input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /></td>
    <td width="40" align="center" valign="middle" class="smalltblheading"><?php echo $qc;?><input type="hidden" name="qcstatus" value="<?php echo $qc;?>" /></td>
	<td width="60" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot1;?><input type="hidden" name="qcdot1" value="<?php echo $qcdot1;?>" /></td>
	<td width="60" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot2;?><input type="hidden" name="qcdot2" value="<?php echo $qcdot2;?>" />
    <input type="hidden" name="qctestdate" value="<?php if($qcdot1!="") echo $qcdot1; else if($qcdot1=="" && $qcdot2!="") echo $qcdot2; else echo "";?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /><input type="hidden" name="dp4" value="<?php echo $dp4;?>" /><input type="hidden" name="dp5" value="<?php echo $dp5;?>" /><input type="hidden" name="dp6" value="<?php echo $dp6;?>" /><input type="hidden" name="qcdttype" value="<?php if($qcdot1!="") echo "DoT"; else if($qcdot1=="" && $qcdot2!="") echo "DoSF"; else ""; ?>" /></td>
	<td width="112" align="left" valign="middle" class="smalltbltext">&nbsp;
  <input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dopc')" tabindex="6"><img src="../images/cal.gif" border="0" align="absmiddle" /></a>&nbsp;<font color="#FF0000">*</font></td>
	<td align="center" valign="middle" class="smalltblheading"><select name="qcdtyp" style="size:50px;" class="smalltbltext" <?php if(($qcdot1=="" && $qcdot2!="") || ($qcdot1!="" && $qcdot2=="") || ($qcdot1=="" && $qcdot2=="")) echo "disabled"; ?> onchange="qctpchk(this.value);" >
      <?php if($qcdot1=="" && $qcdot2==""){ ?>
      <option value="" <?php if(($qcdot1=="" && $qcdot2=="")) echo "selected"; ?> ></option>
      <?php }	?>
      <?php if($qcdot1!="" || $qcdot2!=""){ ?>
      <option value="DoT" <?php if($qcdot1!="") echo "selected"; ?> >DoT</option>
      <option value="DoSF" <?php if($qcdot1=="" && $qcdot2!="") echo "selected"; ?> >DoSF</option>
      <?php }	?>
    </select></td>
	<td width="122" align="center" valign="middle" class="tblheading">&nbsp;
  <select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="9" >9</option>
<option value="6" >6</option>
<option value="3" >3</option>
</select>&nbsp;Months</td>
<td width="107" align="center" valign="middle" class="tblheading">&nbsp;
  <input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="10" readonly="true" style="background-color:#ECECEC"  /></td>
<td width="160" align="center" valign="middle" class="tblheading">&nbsp;
  <input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>

  </tr> <input name="protype" value="" type="hidden"> 
</table>

<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<img src="../images/close_1.gif"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
