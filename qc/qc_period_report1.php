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
	
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
		 $itemid = $_REQUEST['txtcrop'];
		$vv= $_REQUEST['txtvariety'];
		$result = $_REQUEST['result'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report Periodical Qc Report</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
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

</script>
<SCRIPT language="JavaScript">

function openprint()
{

var sdate=document.frmaddDepartment.sdate.value; 
var edate=document.frmaddDepartment.edate.value; 
var loc=document.frmaddDepartment.txtcrop.value;
var itemid=document.frmaddDepartment.txtvariety.value;
var result=document.frmaddDepartment.result.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('qc_period_report2.php?sdate='+sdate+'&txtcrop='+loc+'&txtvariety='+itemid+'&edate='+edate+'&result='+result,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/qty_quality.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="30">&nbsp;Periodical QC Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
<?php 
	
	 $sdate = $_REQUEST['sdate'];
 	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	 $result = $_REQUEST['result'];
?>	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	   <input name="txtvariety" value="<?php echo $vv;?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $itemid;?>" type="hidden">  
		  <input name="result" value="<?php echo $result;?>" type="hidden">  
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php	
	$t=explode("-", $sdate);
	$sdate=$t[2]."-".$t[1]."-".$t[0];
	/*$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		echo $sdate=$tyear."-".$tmonth."-".$tday;*/
	
	$t=explode("-", $edate);
	$edate=$t[2]."-".$t[1]."-".$t[0];
	/*$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		 $edate=$tyear."-".$tmonth."-".$tday;*/
	
	 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 

	if($vv=="ALL")
	{
	if($result=="ALL")	
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
	}
	else
	{
	if($result=="ALL")	
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
	}

 $tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$vv."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $variet=$vv;
	 }
	 else
	 {
	  $variet=$tt;
	  }
	}
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $variet;?>&nbsp;</td>
  	</tr>
	</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="19" align="center" valign="middle" class="tblheading">#</td>
			<td width="82"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="153"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="112"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="42"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="51"  align="center" valign="middle" class="tblheading">Qty</td>
			<!--<td width="68"  align="center" valign="middle" class="tblheading">Stage</td>-->
			<td width="54" align="center" valign="middle" class="tblheading">PP</td>
			<td width="61" align="center" valign="middle" class="tblheading" >Moist %</td>
			<td width="52" align="center" valign="middle" class="tblheading" >Germ %</td>
			<td width="68" align="center" valign="middle" class="tblheading">DOT</td>
            <td width="62" align="center" valign="middle" class="tblheading">QC Status</td>
            <td width="62" align="center" valign="middle" class="tblheading">DOGR</td>
            <td width="62" align="center" valign="middle" class="tblheading">GOT Status</td>
</tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{

if($vv=="ALL")
{
	if($result=="ALL")	
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
}
else
{
	if($result=="ALL")	
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
}

$row_arr_home3=mysqli_fetch_array($sql_arr_home2);

$sql_arr_home3=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' and sampleno='".$row_arr_home2['sampleno']."' and qcflg=1 order by spdate asc") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home3);
while($row_arr_home=mysqli_fetch_array($sql_arr_home3))
{		
	
	$trdate=$row_arr_home['testdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	
	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	 $t=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$slups=0; $slqty=0; $sstage="";
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
$got=$row_arr_home['moist'];
$stage=$row_arr_home['gemp'];

while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
$qcresult=$row_tbl_sub['lotldg_qc'];
$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
$lotno=$row_tbl_sub['lotldg_lotno'];
$qc=$row_tbl_sub['lotldg_vchk'];
if($got=="")
$got=$row_tbl_sub['lotldg_moisture'];
if($stage=="")
$stage=$row_tbl_sub['lotldg_gemp'];
$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
$lotno=$row_arr_home['oldlot'];
$sstage=$row_arr_home['trstage'];

if($qcresult=="")
$qcresult=$row_arr_home['qcstatus'];
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
/*	//$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id." '") or die(mysqli_error($link));
	
		
		lotno
		
if($vv=="ALL")
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$itemid."'") or die(mysqli_error($link));
	}
	else
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$crop."' and lotvariety='".$vv."'") or die(mysqli_error($link));
	}	
	echo  $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
		
		if($qcresult!="")
		{
		$qcresult=$qcresult."<br>".$row_arr_home['qcstatus'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $qcresult=$row_arr_home['qcstatus'];
		}*/
		
	//	$qcresult=$row_arr_home['qcstatus'];
//$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
/*$gotresult=$row_arr_home['gotstatus'];
if($gotresult=="" || $gotresult=="NULL")$gotresult=$row_arr_home['got'];*/
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $crop=$row_arr_home['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['variety'];
		}
		else
		{
		$variety=$row_arr_home['variety'];	
		}
		/*if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['lotno'];
		}
		else
		{
		$lotno=$row_arr_home['lotno'];
		}*/
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		/*if($qc!="")
		{
		$qc=$qc."<br>".$row_arr_home['pp'];
		}
		else
		{
		$qc=$row_arr_home['pp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['moist'];
		}
		else
		{
		$got=$row_arr_home['moist'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['gemp'];
		}
		else
		{
		$stage=$row_arr_home['gemp'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_arr_home['sstatus'];
		}
		else
		{
		$sstatus=$row_arr_home['sstatus'];
		}*/
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
	
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	*/
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vvrt=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vvrt=$tt;
	  }
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
if($qcresult!="UT")
{
if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="82" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="153" align="center" valign="middle" class="tblheading"><?php echo $vvrt?></td>
		 <td width="112" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="42" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		 <!--<td width="68" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>-->
         <td width="54" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="61" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="52" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
		 <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="82" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="153" align="center" valign="middle" class="tblheading"><?php echo $vvrt?></td>
		 <td width="112" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="42" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		<!-- <td width="68" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>-->
         <td width="54" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="61" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="52" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
</tr
>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}
?>
			
<table width="800" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="qc_period_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td ></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
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
