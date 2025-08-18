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
	
		
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$loc = $_REQUEST['txtclass'];
	$state = $_REQUEST['state'];
	$txtorganiser = $_REQUEST['txtorganiser'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Report - Periodical Arrival Report</title>

<link href="../include/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../include/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../include/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../include/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../include/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<style>
.smalltblheading{
	background-color:#A2CEF9 !important;
	/*border-color:#d21704 !important;*/
}
</style>

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
var loc=document.frmaddDepartment.txtclass.value;
var state=document.frmaddDepartment.state.value;
var txtorganiser=document.frmaddDepartment.txtorganiser.value;
var txtcrop=document.frmaddDepartment.txtcrop.value;
var txtvariety=document.frmaddDepartment.txtvariety.value;

winHandle=window.open('report_arrivalplcvq2.php?sdate='+sdate+'&edate='+edate+'&txtclass='+loc+'&state='+state+'&txtorganiser='+txtorganiser+'&txtcrop='+txtcrop+'&txtvariety='+txtvariety,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="940" height="25">&nbsp; Periodical Arrival Report </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	<input name="edate" value="<?php echo $edate;?>" type="hidden"> 
	<input name="txtclass" value="<?php echo $loc;?>" type="hidden"> 
	<input name="state" value="<?php echo $state;?>" type="hidden">  
	<input name="txtorganiser" value="<?php echo $txtorganiser;?>" type="hidden"> 
	<input name="txtcrop" value="<?php echo $txtcrop;?>" type="hidden">  
	<input name="txtvariety" value="<?php echo $txtvariety;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$loc = $_REQUEST['txtclass'];
	$state = $_REQUEST['state'];
	$txtorganiser = $_REQUEST['txtorganiser'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$edate=$tyear."-".$tmonth."-".$tday;
		
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where (arrival_type='Fresh Seed with PDN') and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse">
    	<tr height="25" >
      <td align="left" class="subheading" style="color:#303918; " >&nbsp; Peroid From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
</table>
  
<div style="overflow:scroll; height:400px; width:974px;">
<table width="2000" align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" id="example">
<thead >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >#</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >Date of Arrival </td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >Crop</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >SP-F</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >SP-M</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" > Stage</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >FRN No.</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >Lot No. </td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >NoB</td>
<td align="center" valign="middle" class="smalltblheading" rowspan="2" >Qty</td>
<td align="center" valign="middle" class="smalltblheading" colspan="6"  >Production Information</td>
<td align="center" valign="middle" class="smalltblheading" colspan="5"  >Processing</td>
<td align="center" valign="middle" class="smalltblheading" colspan="6" >Quality</td>
</tr>
<tr class="tblsubtitle" height="25">

<td align="center" valign="middle" class="smalltblheading">Production Personnel</td>
<td align="center" valign="middle" class="smalltblheading" >Organiser </td>
<td align="center" valign="middle" class="smalltblheading" >Farmer </td>
<td align="center" valign="middle" class="smalltblheading" >State </td>
<td align="center" valign="middle" class="smalltblheading" >Production Location</td>
<td align="center" valign="middle" class="smalltblheading" >Harvest Date</td>
<td align="center" valign="middle" class="smalltblheading" >Raw Qty (Picked)</td>
<td align="center" valign="middle" class="smalltblheading" >Condition Qty</td>
<td align="center" valign="middle" class="smalltblheading" >Total Condition Loss Qty</td>
<td align="center" valign="middle" class="smalltblheading">TCL %</td>
<td align="center" valign="middle" class="smalltblheading">Raw Qty (Balance)</td>
<td align="center" valign="middle" class="smalltblheading">QC Status</td>
<td align="center" valign="middle" class="smalltblheading">Germination %</td>
<td align="center" valign="middle" class="smalltblheading">DOT</td>
<td align="center" valign="middle" class="smalltblheading">GOT Status</td>
<td align="center" valign="middle" class="smalltblheading">Genetic Purity %</td>
<td align="center" valign="middle" class="smalltblheading">DOGR</td>
</tr>
</thead>
<tbody>
<?php

$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql="select * from tblarrival_sub where arrival_id='".$arrival_id."' ";
	if($state!="ALL")
	{
		$sql.=" and lotstate='".$state."'";
	}
	if($loc!="ALL")
	{
		$sql.=" and ploc='".$loc."'";
	}
	if($txtorganiser!="ALL")
	{
		$sql.=" and pper='".$txtorganiser."'";
	}
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql.=" and lotcrop='".$row_crop['cropname']."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."'  and vertype='PV' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql.=" and lotvariety='".$row_var['popularname']."'";
	}
		$sql.=" order by lotstate asc, ploc asc, lotcrop asc, lotvariety asc";
		//echo $sql;
	$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
		$farm="";$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $state2=""; $got=""; $qc="";$moist=""; $org=""; $pp=""; $pp1=""; $pp12="";$trdate1=""; $p=""; $stnno1="";
		$trdate=$row_arr_home['arrival_date'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;
		
		$trhdate=$row_tbl_sub['harvestdate'];
		$trhyear=substr($trhdate,0,4);
		$trhmonth=substr($trhdate,5,2);
		$trhday=substr($trhdate,8,2);
		$harvestdate=$trhday."-".$trhmonth."-".$trhyear;

		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		if($ac>0 && $acn==0)$acn=1;
		
		$crop=$row_tbl_sub['lotcrop'];
		$variety=$row_tbl_sub['lotvariety'];	
		$spf=$row_tbl_sub['spcodef'];	
		$spm=$row_tbl_sub['spcodem'];	
		$lotno=$row_tbl_sub['lotno'];
		$bags=$acn;
		$qty=$ac;
		$qc=$row_tbl_sub['qc'];
		$got=$row_tbl_sub['got1'];
		$stage=$row_tbl_sub['sstage'];
		$moist=$row_tbl_sub['moisture'];
		$org=$row_tbl_sub['pper'];
		
		if($row_tbl_sub['vchk'] =="Acceptable") { $p="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $p="NAcc";}
		$pp=$p;
		$state2=$row_tbl_sub['lotstate'];
		$pp1=$row_tbl_sub['ploc'];
		$pp12=$row_tbl_sub['organiser'];
		$farm=$row_tbl_sub['farmer'];
		
		if($row_tbl_sub['ncode']!="" && $row_tbl_sub['ncode']!=0)
		{
			$stnno="FRN"."/".$yearid_id."/".$row_tbl_sub['ncode'];
		}
		else
		{
			$stnno="";
		}
		
		$pqty=0; $conqty=0; $tcl=0; $tclper=0; $bqty=0;
		$sq_prosub=mysqli_query($link,"SELECT * FROM tbl_proslipsub where proslipsub_lotno='$lotno' and plantcode='$plantcode' order by proslipsub_id Asc") or die(mysqli_error($link));
		while($row_prosub=mysqli_fetch_array($sq_prosub))
		{
			$pqty=$pqty+$row_prosub['proslipsub_pqty']; 
			$conqty=$conqty+$row_prosub['proslipsub_conqty']; 
			$tcl=$tcl+$row_prosub['proslipsub_tlqty']; 
			$tclper=$tclper+$row_prosub['proslipsub_tlper'];
			$bqty=round($qty,3)-round(($conqty+$tcl),3);
			$bqty=round($bqty,3);
			if($bqty<0){$bqty=0;}
		}
		$qcsts=''; $germper=''; $dot=''; $gotsts=''; $genpper=''; $dogr='';
		
		
		$sq_qctest=mysqli_query($link,"SELECT MAX(gemp) FROM tbl_qctest where oldlot='".$row_tbl_sub['orlot']."' order by gemp Desc") or die(mysqli_error($link));
		while($row_qctest=mysqli_fetch_array($sq_qctest))
		{	
			$sq_qctest1=mysqli_query($link,"SELECT * FROM tbl_qctest where oldlot='".$row_tbl_sub['orlot']."' and gemp='".$row_qctest[0]."' ") or die(mysqli_error($link));
			$row_qctest1=mysqli_fetch_array($sq_qctest1);
			
			$qcsts=$row_qctest1['qcstatus'];
			$germper=$row_qctest1['gemp'];
			
			$trdate1=$row_qctest1['testdate'];
			$tryear1=substr($trdate1,0,4);
			$trmonth1=substr($trdate1,5,2);
			$trday1=substr($trdate1,8,2);
			$dot=$trday1."-".$trmonth1."-".$tryear1;
			if($dot=="00-00-0000" || $dot=="--" || $dot=="- -" || $dot==NULL)
			{$dot='';}
			
			$gotsts=$row_qctest1['gotstatus'];
			$genpper=$row_qctest1['genpurity'];
			
			$trdate2=$row_qctest1['gotdate'];
			$tryear2=substr($trdate2,0,4);
			$trmonth2=substr($trdate2,5,2);
			$trday2=substr($trdate2,8,2);
			$dogr=$trday2."-".$trmonth2."-".$tryear2;
			if($dogr=="00-00-0000" || $dogr=="--" || $dogr=="- -" || $dogr==NULL)
			{$dogr='';}
		}
		
		$sq_gottest1=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_oldlot ='".$row_tbl_sub['orlot']."' order by gottest_tid DESC ") or die(mysqli_error($link));
		if(mysqli_num_rows($sq_gottest1)>0)
		{
			$row_gottest1=mysqli_fetch_array($sq_gottest1);
			
			$gotsts=$row_gottest1['gottest_gotstatus'];
			$genpper=$row_gottest1['genpurity'];
			
			$trdate2=$row_gottest1['gottest_gotdate'];
			$tryear2=substr($trdate2,0,4);
			$trmonth2=substr($trdate2,5,2);
			$trday2=substr($trdate2,8,2);
			$dogr=$trday2."-".$trmonth2."-".$tryear2;
			if($dogr=="00-00-0000" || $dogr=="--" || $dogr=="- -" || $dogr==NULL)
			{$dogr='';}
		}
			
if($srno%2!=0)
{
?>			  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $trdate;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $spf;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $spm;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $stage;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $stnno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $lotno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bags;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $org;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pp12;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $farm;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $state2;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pp1;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $harvestdate;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $conqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $tcl;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $tclper;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qcsts;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $germper;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $dot;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $gotsts;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $genpper;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $dogr;?> </td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $trdate;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $spf;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $spm;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $stage;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $stnno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $lotno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bags;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $org;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pp12;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $farm;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $state2;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pp1;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $harvestdate;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $pqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $conqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $tcl;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $tclper;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $bqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qcsts;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $germper;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $dot;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $gotsts;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $genpper;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $dogr;?> </td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
else
{
?>
<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="27">Record not found</td>
</tr>
<?php
}
?>
</tbody>
</table>	
</div>		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_arrivalplcvq.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="excel-arrivalplcvq.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtclass=<?php echo $_REQUEST['txtclass'];?>&state=<?php echo $_REQUEST['state'];?>&txtorganiser=<?php echo $_REQUEST['txtorganiser'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a><!--&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />-->
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
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
		searching: false,
	    ordering:  false,
		fixedHeader: true,
        fixedColumns:   {
            left: 8
        }
    } );
} );
</script>
</body>
</html>
