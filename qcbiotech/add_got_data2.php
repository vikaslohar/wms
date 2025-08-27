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
	if(isset($_GET['tid']))
	{
		$a = $_GET['tid'];	 
	}
	if(isset($_GET['insitu']))
	{
		$insitu = $_GET['insitu'];	 
	}
	if(isset($_GET['interra']))
	{
		$interra = $_GET['interra'];	 
	}
	if(isset($_GET['insiturepl']))
	{
		$insiturepl = $_GET['insiturepl'];	 
	}
	if(isset($_GET['interrarepl']))
	{
		$interrarepl = $_GET['interrarepl'];	 
	}
	$tid=$a;
	$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['gottest_sampleno'];
	$olotno2=$row_ck2['gottest_lotno'];
	$yearid2=$row_ck2['yearid'];
	//echo "select * from tbl_qctest where lotno='$olotno2' and sampleno='$osamp2' and yearid='$yearid2' order by tid desc";
	$sql_ck23=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='$olotno2' and gottest_sampleno='$osamp2' and yearid='$yearid2' order by gottest_tid desc") or die(mysqli_error($link));
	$zxzx=mysqli_num_rows($sql_ck23);
	if($zxzx > 0)
	{
	$row_ck23=mysqli_fetch_array($sql_ck23);
	$otid2=$row_ck23['gottest_tid'];
	}
	if($otid2!="")
	$a=$otid2;
	
	if($interra=="yes") $type11="IN-TERRA";
	$sql_sub1=mysqli_query($link,"SELECT * FROM `tbl_gottestsub` where gottest_tid=$tid and gottests_type='IN-TERRA'")or die(mysqli_error($link));;
	$row_sub1=mysqli_fetch_array($sql_sub1);
	$tot=mysqli_num_rows($sql_sub1);
	$gots_id=$row_sub1['gottests_id'];
	/*if($tot==0)
	{
		$sql_sub="insert into tbl_gottestsub(gottest_tid, gottests_type,gottests_noofrefl) values('$tid','$type11', '$insiturepl')";
		$row_sub=mysqli_query($link,$sql_sub)or die(mysqli_error($link));
		$row=mysqli_fetch_array($row_sub);
		$gots_id=$row['gottests_id'];
	}*/
		
if(isset($_POST['frm_action'])=='submit')
{
	$id=trim($_POST['tid']);
	$srno=trim($_POST['srno']);
	$txtinterra=trim($_POST['interrarepl']);
	$crop=trim($_POST['txtcrop']);
	
	for($i=1; $i<$srno; $i++)
	{
		$txtpdate="pdate_".$i;
		$txtnoseeds="txtnoseeds_".$i;
		$txttrdate="trdate_".$i;
				
		if(isset($_REQUEST[$txtpdate])) { $pdate1=$_REQUEST[$txtpdate]; }else{$pdate1="";}
		if(isset($_REQUEST[$txtnoseeds])) { $seeds=$_REQUEST[$txtnoseeds]; }else{$seeds="";}
		if(isset($_REQUEST[$txttrdate])) { $trdate1=$_REQUEST[$txttrdate]; }else{$trdate1="";}
		
		/*echo $pdate1;
		echo $seeds;
		echo $trdate1." // ";*/
		
		$recdate1=$pdate1;
		$ddate=explode("-",$recdate1);
		$pdate=$ddate[2]."-".$ddate[1]."-".$ddate[0];
		
		$recdate1=$trdate1;
		$ddate=explode("-",$recdate1);
		$trdate=$ddate[2]."-".$ddate[1]."-".$ddate[0];
		//echo $pdate;
		//echo $trdate;
		//exit;
		if($trdate!="" && $seeds!="")
		{
			if($crop!="Paddy Seed")
			{
				$sql_sub_sub="insert into tbl_gottestsub_sub(gottest_tid, gottests_id, replno, gottestss_doswdate, gottestss_dotrdate, gottestss_noofseeds) values('$id','$gots_id', '$srno', '$pdate','$trdate','$seeds')";
				$row_sub_sub=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
			}
			else
			{
				$sql_sub_sub="insert into tbl_gottestsub_sub(gottest_tid, gottests_id, replno, gottestss_doswdate, gottestss_dotrdate, gottestss_noofseeds) values('$id','$gots_id', '$srno', '$pdate','$trdate','$seeds')";
				$row_sub_sub=mysqli_query($link,$sql_sub_sub)or die(mysqli_error($link));
			}
		}
	}
	
	echo "<script>window.location='add_got_data2.php?tid=$id&srno=$srno&interrarepl=$txtinterra'</script>";
}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - GOT Result Pending List</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script type="text/javascript">
//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

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
function chk(srno)
{
	//alert("Hiii...");
	if(document.getElementById('pdate_'+[srno]).value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.getElementById('txtnoseeds_'+[srno]).value="";
		document.getElementById('pdate_'+[srno]).focus();
		return false;
 	}
	if(document.getElementById('trdate_'+[srno]).value=="")
 	{
		alert("Please Select Date Of Transplant");
		document.getElementById('txtnoseeds_'+[srno]).value="";
		document.getElementById('trdate_'+[srno]).focus();
		return false;
 	}
	return true;
}
function dotchk(dotdate,srno)
{
	//var pdate="pdate_"+did;
	//alert(srno);
	//alert(document.getElementById('pdate_'+[srno]).value);
	
	if(document.getElementById('pdate_'+[srno]).value=="")
 	{
		alert("Please Select Date Of Sowing");
		document.frmaddDept.trdate.value="";
		document.getElementById(pdate).focus();
		return false;
 	}
	else
	{
		showCalendar(dotdate);
	}
	
}
function mySubmit()
{
	//alert("In Function...");
	if(document.frmaddDept.insiturepl.value=="" && document.frmaddDept.interrarepl.value=="")
	{
		alert("Select atleast 1 type...");
		//document.frmaddDept.result.value="";
		document.frmaddDept.insiturepl.focus();
		return false;
	}
}
function observation(gotssid,gotsid)
{
	var crop = document.frmaddDept.txtcrop.value;
	var id = document.frmaddDept.tid.value;
	var srno = document.frmaddDept.srno1.value;
	var dsowd = document.frmaddDept.dsowd.value;
	var trd = document.frmaddDept.trd.value;
	var noseeds = document.frmaddDept.noseeds.value;
	var interrarepl = document.frmaddDept.interrarepl.value;
	alert(srno);alert(dsowd);alert(trd);alert(noseeds);alert(interrarepl);
	if(crop == "Maize Seed" || crop == "Pearl Millet")
	{
		window.location.href='add_got_data4.php?tid='+id+'&srno='+srno+'&dsowd='+dsowd+'&trd='+trd+'&seed='+noseeds+'&interrarepl='+interrarepl+'&gotssid='+gotssid+'&gotsid='+gotsid;
	}
	else if(crop == "Paddy Seed")
	{
		window.location.href='add_got_data5.php?tid='+id+'&srno='+srno+'&dsowd='+dsowd+'&trd='+trd+'&seed='+noseeds+'&interrarepl='+interrarepl+'&gotssid='+gotssid+'&gotsid='+gotsid;
	}
	else
	{
		window.location.href='add_got_data3.php?tid='+id+'&srno='+srno+'&dsowd='+dsowd+'&trd='+trd+'&seed='+noseeds+'&interrarepl='+interrarepl+'&gotssid='+gotssid+'&gotsid='+gotsid;
	}
}	
function upschk1()
{
	//alert("Hi...");
	if(document.getElementById('insitu').checked == true)
	{
		document.getElementById('insiturepl').disabled=false;
		document.frmaddDept.insitu.value="yes";
	}
	else
	{
		document.getElementById('insiturepl').disabled=true;
		document.frmaddDept.insitu.value="no";
	}
}
function upschk11()
{
	if(document.getElementById('interra').checked == true)
	{
		document.getElementById('interrarepl').disabled=false;
		document.frmaddDept.interra.value="yes";
	}
	else
	{
		document.getElementById('interrarepl').disabled=true;
		document.frmaddDept.interra.value="no";
	}
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GOT Result Update </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	   <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt" value="" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$quer3=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['gottest_lotno'];
$oldlot=$noticia['gottest_oldlot'];
//echo "select * from tbl_qctest where lotno='".$a."'";
$sql_month=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['gottest_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['gottest_variety']."' and actstatus='Active'") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
$sap=$row['gottest_sampleno'];
 $sampl=$tp1.$row['yearid'].sprintf("%000006d",$sap);
  $tp22=$row['gottest_trstage'];
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >GOT Data and Result Update</td>
          </tr>
  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtcrop" type="text" size="10" class="tbltext" tabindex="" maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>"onchange="upschk(this.value);" id="itm"/>  &nbsp;</td>
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
		<?php  
	$tdates=$row['gottest_srdate'];
	$tyear=substr($tdates,0,4);
	$tmonth=substr($tdates,5,2);
	$tday=substr($tdates,8,2);
	$tdates=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row['gottest_spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdatee=$row['gottest_dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear; 

?>
<tr class="Dark" height="30">
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
<td width="217" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>&nbsp;</td>
<td width="125" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
<td width="223" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td> 

<td width="175" align="right" valign="middle" class="tblheading">&nbsp;Sample No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampl" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $sap;?>" maxlength="20"/>&nbsp;</td>
</tr>
</table>  
<br/>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<?php 
if($interra=="yes")
{
?>		  
<tr class="Dark" height="30">
<td width="185" align="right"  valign="middle" class="tblheading">IN-TERRA&nbsp;</td>
<td width="232" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;
  <input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value="" checked="checked" disabled="disabled"/></td>
<td width="186" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td width="237" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $interrarepl?></td>
</tr>
<?php 
}
?>		   
</table><br />

<?php 
$cnt1=$interrarepl;
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="8" align="center" class="tblheading" >IN-TERRA Replications</td>
</tr>
<tr class="Dark" height="30">
<td width="35" align="center" valign="middle" class="tblheading">Repl.</td>
 <td width="145" align="center" valign="middle" class="tblheading">Date of Sowing</td>
 <td width="151" align="center" valign="middle" class="tblheading">Date of Transplant</td>
 <td width="136" align="center" valign="middle" class="tblheading"><?php if($crop=="Maize Seed" || $crop=="Paddy Seed" || $crop=="Pearl Millet"){?>No. of Rows<?php }else{?>No. of Seeds
   <?php }?></td>
 <td width="87" align="center" valign="middle" class="tblheading">Observations</td>
 <td width="220" align="center" valign="middle" class="tblheading">Abort Remarks</td>
 <td width="60" align="center" valign="middle" class="tblheading">Abort</td>
 <td width="60" align="center" valign="middle" class="tblheading">Finalise Observation</td>
</tr>
<?php
$type="IN TERRA"; 
$srno=1;

$sql_s=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-TERRA' order by gottests_id asc")or die(mysqli_error($link));
$rows=mysqli_fetch_array($sql_s);

$sql_ss=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
//$rowss= mysqli_fetch_array($sql_ss);
while($rowss=mysqli_fetch_array($sql_ss))
{ 

	$dsowd1=$rowss['gottestss_doswdate'];
	$tyear=substr($dsowd1,0,4);
	$tmonth=substr($dsowd1,5,2);
	$tday=substr($dsowd1,8,2);
	$dsowd=$tday."-".$tmonth."-".$tyear; 

	$trd1=$rowss['gottestss_dotrdate'];
	$tyear=substr($trd1,0,4);
	$tmonth=substr($trd1,5,2);
	$tday=substr($trd1,8,2);
	$trd=$tday."-".$tmonth."-".$tyear; 
?>
<tr class="Dark" height="25">
<td width="35"align="center" valign="middle" class="smalltbltext"><?php echo $srno;?><input type="hidden" name="srno1" value="<?php echo $srno?>" /></td>
 <td width="145"align="center" valign="middle" class="smalltbltext"><?php echo $dsowd;?><input type="hidden" name="dsowd" value="<?php echo $dsowd?>" /></td>
 
 <td width="151" align="center" valign="middle" class="smalltbltext"><?php echo $trd;?><input type="hidden" name="trd" value="<?php echo $trd?>" /></td>
 
 <td width="136" align="center" valign="middle" class="smalltbltext"><?php echo $rowss['gottestss_noofseeds'];?><input type="hidden" name="noseeds" value="<?php echo $rowss['gottestss_noofseeds'];?>" /></td>
 
 <td width="87" align="center" valign="middle" class="smalltbltext"><?php if($crop=="Maize Seed" || $crop=="Pearl Millet"){?><a href="add_got_data4.php?srno=<?php echo $srno;?>&type=<?php echo $type;?>&tid=<?php echo $tid;?>&interrarepl=<?php echo $interrarepl;?>&dsowd=<?php echo $dsowd;?>&trd=<?php echo $trd;?>&seed=<?php echo $rowss['gottestss_noofseeds'];?>&gotssid=<?php echo $rowss['gottestss_id'];?>&gotsid=<?php echo $rowss['gottests_id'];?>" >Update</a><?php }else if($crop=="Paddy Seed"){?><a href="add_got_data5.php?srno=<?php echo $srno;?>&type=<?php echo $type;?>&tid=<?php echo $tid;?>&interrarepl=<?php echo $interrarepl;?>&dsowd=<?php echo $dsowd;?>&trd=<?php echo $trd;?>&seed=<?php echo $rowss['gottestss_noofseeds'];?>&gotssid=<?php echo $rowss['gottestss_id'];?>&gotsid=<?php echo $rowss['gottests_id'];?>" >Update</a><?php }else{?><a href="add_got_data3.php?srno=<?php echo $srno;?>&type=<?php echo $type;?>&tid=<?php echo $tid;?>&interrarepl=<?php echo $interrarepl;?>&dsowd=<?php echo $dsowd;?>&trd=<?php echo $trd;?>&seed=<?php echo $rowss['gottestss_noofseeds'];?>&gotssid=<?php echo $rowss['gottestss_id'];?>&gotsid=<?php echo $rowss['gottests_id'];?>" >Update</a><?php }?></td>
 
 <!--<td width="87" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="observation('<?php echo $rowss['gottestss_id']?>','<?php echo $rowss['gottests_id']?>')">Update</a></td>-->
 
 <td width="220" align="center" valign="middle" class="smalltbltext"><input name="remark_<?php echo $srno;?>" type="text" size="30" class="tbltext" tabindex=""  maxlength="30"  value="" onchange="remchk()"></td>
 
 <td width="60"align="center" valign="middle" class="smalltbltext"><input name="Submit" type="image" src="../images/abort.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;"  /></td>
 
  <td width="60"align="center" valign="middle" class="smalltbltext"><input name="Submit" type="image" src="../images/submit2.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;"  /></td>
</tr>
<?php
$srno++;
}
while($cnt1>=$srno)
{
?>
<tr class="Dark" height="25">
<td width="35"align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>

 <td width="145"align="center" valign="middle" class="smalltbltext"><input name="pdate_<?php echo $srno;?>" id="pdate_<?php echo $srno;?>" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('pdate_<?php echo $srno;?>')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
 
 <td width="151" align="center" valign="middle" class="smalltbltext"><input name="trdate_<?php echo $srno;?>" id="trdate_<?php echo $srno;?>" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('trdate_<?php echo $srno;?>','<?php echo $srno;?>')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></td>
 
 <td width="136" align="center" valign="middle" class="smalltbltext"><input name="txtnoseeds_<?php echo $srno;?>" id="txtnoseeds_<?php echo $srno;?>" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="chk('<?php echo $srno;?>')">&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
 
 <td width="87" align="center" valign="middle" class="smalltbltext">Update</td>
 
 <td width="220" align="center" valign="middle" class="smalltbltext"><input name="remark" type="text" size="30" class="tbltext" tabindex=""  maxlength="30"  value="" onchange="remchk()" disabled="disabled"></td>
 
 <td width="60"align="center" valign="middle" class="smalltbltext"></td>
 <td width="60"align="center" valign="middle" class="smalltbltext"></td>
</tr>
<?php
//$cnt1--;
$srno++; 
}
?>
</table>  
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
  <a href="add_got_data1.php?tid=<?php echo $tid?>"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" />&nbsp;&nbsp;</td>
  <input type="hidden" name="interrarepl" value="<?php echo $interrarepl?>" />
  <input type="hidden" name="srno" value="<?php echo $srno?>" />
</tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
		  
		  
<!-- actual page end--->	
		  
		  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
