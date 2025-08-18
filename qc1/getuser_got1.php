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
	
if(isset($_GET['tid']))
	{
	 $a = $_GET['tid'];	 
	}
	$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_qctest where tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['sampleno'];
	$olotno2=$row_ck2['lotno'];
	$yearid2=$row_ck2['yearid'];
	
	$sql_ck23=mysqli_query($link,"select * from tbl_qctest where lotno='$olotno2' and sampleno='$osamp2' and yearid='$yearid2' order by tid desc") or die(mysqli_error($link));
	$zxzx=mysqli_num_rows($sql_ck23);
	if($zxzx > 0)
	{
	$row_ck23=mysqli_fetch_array($sql_ck23);
	$otid2=$row_ck23['tid'];
	}
	if($otid2!="")
	$a=$otid2;
if(isset($_POST['frm_action'])=='submit')
	{ //exit;
			 $dos= trim($_POST['pdate1']);
			$dcdate= trim($_POST['dcdate']);
			$loc = trim($_POST['txtloc']);
			$txtnop = trim($_POST['txtnop']);
			$txtnot = trim($_POST['txtnot']);
			$purity = trim($_POST['txtgenpurity']);
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
			$txtlot = $_POST['txtlot'];		
			$stage = $_POST['stage'];		
			$oldlot = $_POST['oldlot'];		
	   		//txtgenpurity
			$samp= $_POST['txtsamp'];
	
	$tdate22=split("-",$e);
	$tdate=$tdate22[2]."-".$tdate22[1]."-".$tdate22[0];
	
	$ddate=split("-",$dos);
	$doswdate=$ddate[2]."-".$ddate[1]."-".$ddate[0];
	 //exit;
	 
	$xamp=str_split($samp);
	$plcode=$xamp[0];
	$yrcd=$xamp[1];
	$smpcode=$xamp[2].$xamp[3].$xamp[4].$xamp[5].$xamp[6].$xamp[7];
	
	
	$sql_ck=mysqli_query($link,"select * from tbl_qctest where sampleno='$smpcode' and yearid='$yrcd'") or die(mysqli_error($link));
	while($row_ck=mysqli_fetch_array($sql_ck))
	{
	$ores=$row_ck['gotstatus'];
	$osamp22=$row_ck['sampleno'];
	$olotno22=$row_ck['lotno'];
	$yearid22=$row_ck['yearid'];
	$oldlot22=$row_ck['oldlot'];
	
	$olot=$row_ck['lotno'];
	$crp=$row_ck['crop'];
	$ver=$row_ck['variety'];
	$srdt=$row_ck['srdate'];
	$spdt=$row_ck['spdate'];
	$smpno=$row_ck['sampleno'];
	$stats=$row_ck['state'];
	$oqc=$row_ck['qc'];
	$stge=$row_ck['trstage'];
	$opp=$row_ck['pp'];
	$omt=$row_ck['moist'];
	$ogmp=$row_ck['gemp'];
	$oqcst=$row_ck['qcstatus'];
	$oqtdt=$row_ck['testdate'];
	//$oref=$row_ck['qcrefno'];
	$ogotdate=$row_ck['gotdate'];
	$odosdate=$row_ck['dosdate'];
	$ogot=$row_ck['got'];
	$ogotstatus=$row_ck['gotstatus'];
	$oaflg=$row_ck['aflg'];
	$obflg=$row_ck['bflg'];
	$ocflg=$row_ck['cflg'];
	$oqcflg=$row_ck['qcflg'];
	$ogotflg=$row_ck['gotflg'];
	$ogsflg=$row_ck['gsflg'];
	$ogs=$row_ck['gs'];
	$ogotrefno=$row_ck['gotrefno'];
	$ogotauth=$row_ck['gotauth'];
	$odoswdate=$row_ck['doswdate'];
	$ogotsmpdflg=$row_ck['gotsmpdflg'];
	$ostsno=$row_ck['stsno'];
	$oqcrefno=$row_ck['qcrefno'];
  	$yearid=$row_ck['yearid'];
  	$opurity=$row_ck['genpurity'];  
		
	if($ores=="RT")
	{
		$sql_sub_sub="insert into tbl_qctest(lotno,  oldlot, crop, variety, srdate, spdate, sampleno, state, qc, trstage, pp, moist, gemp, qcstatus, testdate, gotdate, dosdate, got, gotstatus, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, yearid, genpurity) values('$olot', '$oldlot', '$crp', '$ver', '$srdt', '$spdt', '$smpno', '$stats', '$oqc', '$stge', '$opp', '$omt', '$ogmp', '$oqcst', '$oqtdt', '$ogotdate', '$odosdate', '$ogot', '$ogotstatus', '$oaflg', '$obflg', '$ocflg', '$oqcflg', '$ogotflg', '$ogsflg', '$ogs', '$ogotrefno', '$ogotauth', '$odoswdate', '$ogotsmpdflg', '$ostsno', '$oqcrefno', '$yearid', '$opurity')";
		if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
		{
			$id=mysqli_insert_id($link);
			
			if($result!="RT")
		{
			$sql_sub_sub="insert into tbl_got_update(dos,yearcode, arid, cdate , gotrefno , nop , nott , purity , splants , otherdist , varaties, sterile, other, gotauth, result, remarks) values('$dos','$yearid_id', '$id','$tdate','$loc', '$txtnop','$txtnot','$purity','$txtst', '$txtod','$txtvar', '$txtsterile', '$txtother', '$total','$result','$remarks')";
			$qq=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
			
			$sql_sub_sub12="update tbl_qctest set gotstatus='$result', gotdate='$tdate', gotrefno='$loc', gotauth='$total', doswdate='doswdate', genpurity='$purity', gotflg=1 where tid='$id'";
			if(mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link)))
			{
				$x="";
				 $sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$purity' where orlot='$oldlot22'";
				$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
				$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$purity' where orlot='$oldlot22'";
				$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
				 $sql_subchk="update tbl_softr_sub set softrsub_srflg='0' where softrsub_lotno ='$oldlot22'";
				mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
			}
				$sql_sub_sub1222="update tbl_qctest set gotstatus='$result', gotdate='$tdate', gotrefno='$loc', gotauth='$total', doswdate='doswdate', gotflg=1 where lotno='$olotno22' and sampleno='$osamp22' and yearid='$yearid22'";
				$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
		}
		else
		{
			 $sql_sub_sub12="update tbl_qctest set gotstatus='$result', gotdate='$tdate', genpurity='$purity', gotflg=0 where tid='$id'";
			mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
			 $sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_genpurity='$purity' where orlot='$oldlot22'";
			$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_genpurity='$purity' where orlot='$oldlot22'";
			$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
		}
		
		echo	 $sql_sub_sub122="update tbl_qctest set gotflg=1 where sampleno='$osamp22' and yearid='$yearid22'";
		//	$qq22=mysqli_query($link,$sql_sub_sub122) or die(mysqli_error($link));
		}
	}
	else
	{
		if($result!="RT")
		{
			 $sql_sub_sub="insert into tbl_got_update(dos,yearcode, arid, cdate , gotrefno , nop , nott , purity , splants , otherdist , varaties, sterile, other, gotauth, result, remarks) values('$dos','$yearid_id', '$a','$tdate','$loc', '$txtnop','$txtnot','$purity','$txtst', '$txtod','$txtvar', '$txtsterile', '$txtother', '$total','$result','$remarks')";
			$qq=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
			
			 $sql_sub_sub12="update tbl_qctest set gotstatus='$result', gotdate='$tdate', gotrefno='$loc', gotauth='$total', doswdate='doswdate', genpurity='$purity', gotflg=1 where sampleno='$osamp22' and yearid='$yearid22'";
			if(mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link)))
			{
				$x="";
				$sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$purity' where orlot='$oldlot22'";
				$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
				$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$purity' where orlot='$oldlot22'";
				$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
				$sql_subchk="update tbl_softr_sub set softrsub_srflg='0' where softrsub_lotno ='$oldlot22'";
				mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
			}
				$sql_sub_sub1222="update tbl_qctest set gotstatus='$result', gotdate='$tdate', gotrefno='$loc', gotauth='$total', doswdate='doswdate', gotflg=1, genpurity='$purity' where lotno='$olotno22' and sampleno='$osamp22' and yearid='$yearid22'";
				$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
		}
		else
		{
			$sql_sub_sub12="update tbl_qctest set gotstatus='$result', gotdate='$tdate', genpurity='$purity', gotflg=0 where sampleno='$osamp22' and yearid='$yearid22'";
			mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
			$sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_genpurity='$purity' where orlot='$oldlot22'";
			$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$tdate', lotldg_genpurity='$purity' where orlot='$oldlot22'";
			$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
		}
	}
	}	
	//exit;//echo "<script>window.location='home_result.php'
		echo "<script>window.opener.location.href = window.opener.location.href; self.close();</script>";		
}
	
//}							

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
		}?>
		
	<!--echo "<script>//window.opener.location.href = window.opener.location.href; self.close();</script>";	-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction-GOT Result Updation</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style></head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script type="text/javascript">
/*function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.pdate,dt,document.frmaddDept.pdate, "dd-mmm-yyyy", xind, yind);
	}
	
function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate1,dt,document.frmaddDept.sdate1, "dd-mmm-yyyy", xind, yind);
	}	*/

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  	
function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;
	var dtObject;
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
	var dt1=getDateObject(document.frmaddDept.pdate1.value,"-");
	var dt2=getDateObject(document.frmaddDept.sdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	if(document.frmaddDept.dosdate.value!="--")
	var dt4=getDateObject(document.frmaddDept.dosdate.value,"-");
	else
	var dt4=getDateObject(document.frmaddDept.doscdate.value,"-");
	
	
	var f=0;
	//alert(dt1);alert(dt2);alert(dt3);alert(dt4);
	if(dt1 > dt3)
	{
	alert("Date of Sowing cannot be more or equal to todays date.");
	f=1;
	return false;
	}
	if(dt1 < dt4)
	{
	alert("Date of Sowing cannot be more than Date of Sample Dispatch (DOSD).");
	f=1;
	return false;
	}
	if(dt1 == dt2)
	{
	alert("Please check. Date of Sowing and Date of GOT Result cannot be same");
	f=1;
	return false;
	}
	if(dt2 <= dt1)
	{
	alert("Please check. Date of GOT Result cannot be less than or equal to Date of Sowing");
	f=1;
	return false;
	}
	if(dt2 > dt3)
	{
	alert("Please check. Date of GOT Result cannot be more than Today");
	f=1;
	return false;
	}
	
 if(document.frmaddDept.result.value=="")
	{
		alert("Please Select GOT Result");
		document.frmaddDept.result.focus();
		f=1;
		return false;
	}	
 if(document.frmaddDept.txtloc.value=="")
	{
		alert("Please enter GOT Doc. Ref No.");
		document.frmaddDept.txtloc.focus();
		f=1;
		return false;
	}
	if((document.frmaddDept.result.value=="OK" || document.frmaddDept.result.value=="Fail") && document.frmaddDept.txtgenpurity.value=="")
	{
		alert("Please enter Genetic Purity %");
		document.frmaddDept.txtgenpurity.focus();
		f=1;
		return false;
	}
	 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>100 || document.frmaddDept.txtgenpurity.value<0))
	{
		alert("Invalid Genetic Purity %. Value cannot be more than 100");
		document.frmaddDept.txtgenpurity.focus();
		f=1;
		return false;
	}
	 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>99 && document.frmaddDept.result.value=="Fail"))
	{
		alert("Cannot update GOT Result as FAIL for Genetic Purity % more than 99");
		document.frmaddDept.txtgenpurity.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDept.txttotal.value=="")
	{
		alert("Please Enter  GOT Result Authorised BY");
		document.frmaddDept.txttotal.focus();
		f=1;
		return false;
	}		
	
	if(f==0)
	{
		if(document.frmaddDept.result.value=="Fail")
		{
			if(confirm('You  are selecting \nGOT Result: FAIL \nLot Number: '+document.frmaddDept.txtlot.value+'\nDo you wish to continue?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
		}
		else if(document.frmaddDept.result.value=="RT")
		{
		//document.frmaddDept.pdate1.value=="";
		document.frmaddDept.txtloc.value=="";
		document.frmaddDept.txttotal.value=="";

			if(confirm('You  are selecting \nGOT Result: RETEST \nLot Number: '+document.frmaddDept.txtlot.value+'\nIf GOT Result Retest is selected then Values cannot be filled\nDo you wish to continue?')==true)
			{
			return true;
			}
			else
			{
			return false;
			}
		}
		else
		{
			if(confirm('You  are selecting \nGOT Result: '+document.frmaddDept.result.value+'\nLot Number: '+document.frmaddDept.txtlot.value+'\nDo you wish to continue?')==true)
			return true;
			else
			return false;
		}
	}
	else
	{
	return false;
	}	
}	

function genchk(genval)	
{
 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>100 || document.frmaddDept.txtgenpurity.value<0))
	{
		alert("Invalid Genetic Purity %. Value cannot be more than 100");
		document.frmaddDept.txtgenpurity.focus();
		//f=1;
		return false;
	}
	 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>99 && document.frmaddDept.result.value=="Fail"))
	{
		alert("Cannot update GOT Result as FAIL for Genetic Purity % more than 99");
		document.frmaddDept.txtgenpurity.focus();
		//f=1;
		return false;
	}		
}
			</script>

<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt" value="" type="hidden"> 
		</br>		</br>
		<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$quer3=mysqli_query($link,"SELECT * FROM tbl_qctest where tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['lotno'];
$oldlot=$noticia['oldlot'];

$sql_month=mysqli_query($link,"select * from tbl_qctest where lotno='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['variety']."' and actstatus='Active'") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
$sap=$row['sampleno'];
 $sampl=$tp1.$row['yearid'].sprintf("%000006d",$sap);
  $tp22=$row['trstage'];
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>


		<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >GOT Result Update</td>
          </tr>

		           
		  <!-- /*</table>
		   <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > */-->
		 
 
  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtstfp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>"onchange="upschk(this.value);" id="itm"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"style="background-color:#CCCCCC" readonly="true" value="<?php echo $variety;?>"/>
      &nbsp;</td>
           </tr>
		   <tr class="Dark" height="25">
            <td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlot" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $a?>"/>&nbsp;<input type="hidden" name="oldlot" value="<?php echo $oldlot;?>" /></td>
			  
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtstage" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp22?>"/>&nbsp;</td>
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
<td width="196" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
<td width="196" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>&nbsp;</td>
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
<td width="173" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
          </tr>
		   <tr class="Dark" height="30">


<td width="196" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" >GOT Result&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="result" style="width:100px;" >
    <option value="" selected>--Select--</option>
  	  <option value="OK" >OK</option>
	    <option value="Fail" >Fail</option>
		  <option value="RT" >Retest</option>
    
  </select><font color="#FF0000">*</font>	</td>            
             
          </tr>
		   <tr class="Light" height="30">

<td width="196" align="right" valign="middle" class="tblheading">&nbsp;Date of Sowing&nbsp;</td>
<td width="196" align="left" valign="middle" class="tbltext">&nbsp;<input name="pdate1" id="pdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('pdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	<td width="196" align="right" valign="middle" class="tblheading">&nbsp;Date of GOT Result&nbsp;</td>
    <td width="196" align="left" valign="middle" class="tbltext">&nbsp;<input name="sdate" id="sdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
	
           </tr>
 <tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading">GOT Doc Ref No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtloc" type="text" size="20" class="tbltext" tabindex="0" maxlength="20"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
		   <td align="right"  valign="middle" class="tblheading">Genetic Purity %&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="genchk(this.value)" /></td>
          </tr>
 <tr class="Light" height="30">
  <td align="right"  valign="middle" class="tblheading">GOT Result Authorised By&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txttotal" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          </tr>		  
          <input type="hidden" name="dcdate" value="<?php echo $trdate;?>" />
          <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
        </table>
		<br/>
<table cellpadding="5" cellspacing="5" border="0" width="750">
    <tr >
      <td align="center" colspan="3"><img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;
        <input name="image" type="image" style="display:inline;cursor:pointer;"onClick="return mySubmit();" src="../images/update.gif" alt="Submit Value" border="0"/><input type="hidden" name="txtsamp" value="<?php echo $sampl?>" /></td>
    </tr>
  </table>
</form>
</td></tr>
</table>

</body>
</html>
