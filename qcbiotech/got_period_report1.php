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
		if(isset($_REQUEST['txtcrop']))
	{
		$cid = $_REQUEST['txtcrop'];
		}
		if(isset($_REQUEST['txtvariety']))
	{
		$vv = $_REQUEST['txtvariety'];
		}
		$loc= $_REQUEST['result'];
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality GOT-Report Periodical GOT Report</title>

<link href="../include/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../include/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../include/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../include/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../include/dataTables.fixedColumns.min.js"></script>

<script type="text/javascript" src="../include/animatedcollapse.js"></script>
   
<style>
.smalltblheading{
	background-color: #faa199 !important;
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
var loc=document.frmaddDepartment.txtcrop.value;
var itemid=document.frmaddDepartment.txtvariety.value;
var result=document.frmaddDepartment.result.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('got_period_report2.php?sdate='+sdate+'&txtcrop='+loc+'&txtvariety='+itemid+'&edate='+edate+'&result='+result,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
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
	      <td width="813" height="30">&nbsp;Periodical GOT  Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
<?php 
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	//$loc = $_REQUEST['result'];
?>	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
		<input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $vv;?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $itemid;?>" type="hidden">  
		<input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php	
	$t=split("-",$sdate);
	$z=sprintf("%02d",$t[0]);
	$sdate=$z."-".$t[1]."-".$t[2];
	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;


	$edate=$edate;
	$tday=substr($edate,0,2);
	$tmonth=substr($edate,3,2);
	$tyear=substr($edate,6,4);
	$edate=$tyear."-".$tmonth."-".$tday;

	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	 

	$sql="select gottest_tid, gottest_gotdate from tbl_gottest where gottest_gotdate<='$edate' and gottest_gotdate>='$sdate' and gottest_crop='".$itemid."' ";
	
	if($vv=="ALL")
	{	
		$sql.=" ";
	}
	else
	{
		$sql.=" and gottest_variety='$vv'";
	}
	
		
	$sql.=" and gottest_resultflg=1 order by gottest_gotdate asc, gottest_oldlot asc";
	//echo $sql;
	$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

  	$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
	}
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $variet;?></td>
  	</tr>
	</table>
<?php
if($tot_arr_home > 0)
{
?>
<div style="overflow:scroll; height:400px; width:974px;">
<table  border="1" cellspacing="0" cellpadding="0" width="2000" bordercolor="#d21704" style="border-collapse:collapse" align="center" id="example">
<thead >
<tr class="tblsubtitle" height="25" >
	<td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Arrival Date</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Crop</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">SP Codes</td>
	<td width="148"  align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
	<td width="110"  align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No.</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Sample No.</td>
	<td width="40"  align="center" valign="middle" class="smalltblheading" rowspan="2">NoB</td>
	<td width="49"  align="center" valign="middle" class="smalltblheading" rowspan="2">Qty</td>
	<td width="64"  align="center" valign="middle" class="smalltblheading" rowspan="2">GOT Status</td>
	<td width="73" align="center" valign="middle" class="smalltblheading" rowspan="2">Prod. Loc.</td>
	<td width="42" align="center" valign="middle" class="smalltblheading" rowspan="2">Organizer</td>
	<td width="36" align="center" valign="middle" class="smalltblheading" rowspan="2">Farmer</td>
	<td width="70" align="center" valign="middle" class="smalltblheading" rowspan="2">Prod. Per.</td>
	<td width="46" align="center" valign="middle" class="smalltblheading" rowspan="2">WH</td>
	<td width="46" align="center" valign="middle" class="smalltblheading" rowspan="2">Sowing Date</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Nursery location</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Transplanting Date</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Bed No.</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Direction</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Row</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Range</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" colspan="2">Location</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">Population</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" colspan="2">Female</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" colspan="2">Male</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" colspan="2">OOF</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" colspan="2">Total</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">GP (%)</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">DOO</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" rowspan="2">GOT Result</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="79"  align="center" valign="middle" class="smalltblheading" >Farm</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >Plot</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >No.</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >%</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >No.</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >%</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >No.</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >%</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >No.</td>
	<td width="79"  align="center" valign="middle" class="smalltblheading" >%</td>
</tr>
</thead>
<tbody>
<?php
$srno=1;

while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{

$sql2="select MAX(gotm_id) from tbl_qcgotmain where gotm_gottid='".$row_arr_home2['gottest_tid']."' and gotm_resultflg=1 order by gotm_id desc ";
//echo $sql2."<br />";
$sql_arr_home2=mysqli_query($link,$sql2) or die(mysqli_error($link));
 $tot_max2=mysqli_num_rows($sql_arr_home2);
while($row_arr_home3=mysqli_fetch_array($sql_arr_home2))
{
//echo "ID - ".$row_arr_home3[0];
$sql_max=mysqli_query($link,"select * from tbl_qcgotmain where gotm_id='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	$trdate=$row_arr_home2['gottest_gotdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gotm_id'];
	$arrdate=""; $spcodes=""; $cropname=""; $varietyname=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $wh=""; $gotstatus=""; $loc1=""; $per=""; $sampleno=""; $ploc=""; $organizer=""; $farmer=""; $pper=""; $dosw=""; $sow_loc=""; $nurtype=""; $dotpl=""; $bedno=""; $tpldir=""; $tplrows=""; $tplrange=""; $tplloc=""; $tplplot=""; $tplplants=""; $fnobdate=""; $fnobppn=""; $fnobfno=""; $fnobfper=""; $fnobmno=""; $fnobmper=""; $fnoboofno=""; $fnoboofper=""; $fnobtotno=""; $fnobtotper=""; $gpper="";  $gotresult="";
	
	$lott=str_split($row_arr_home['gotm_lotno']);
	$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
	$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
	
	if($lott[0]=="D"){$wh="Deorjhal";}
	if($lott[0]=="B"){$wh="Boriya";}
	if($lott[0]=="H"){$wh="Bandamailaram";}
	
	$qry_sow=mysqli_query($link,"SELECT gotsow_dosow, gotsow_loc, gotsow_state, gotsow_nurserymedium FROM tbl_qcgotsowing where gotm_id ='".$arrival_id."'"); 
	if($tot_sow=mysqli_num_rows($qry_sow)>0)
	{
		$row_sow=mysqli_fetch_array($qry_sow);
		
		if($row_sow['gotsow_dosow']!='' && $row_sow['gotsow_dosow']!='0000-00-00' && $row_sow['gotsow_dosow']!=NULL)
		{
			$arrival_date1=explode("-",$row_sow['gotsow_dosow']);
			$dosw=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
		}
		$sow_loc=$row_sow['gotsow_loc']."-".$row_sow['gotsow_state'];
		$nurtype=$row_arrs['gotsow_nurserymedium'];
	}
	
	$qry_tpl=mysqli_query($link,"SELECT gottransp_date, gottransp_loc, gottransp_state, gottransp_plotno, gottransp_bedno, gottransp_direction, gottransp_noofrows, gottransp_range, gottransp_noofplants FROM tbl_qcgottranspl where gotm_id ='".$arrival_id."'"); 
	if($tot_tpl=mysqli_num_rows($qry_tpl)>0)
	{
		$row_tpl=mysqli_fetch_array($qry_tpl);
		
		if($row_tpl['gottransp_date']!='' && $row_tpl['gottransp_date']!='0000-00-00' && $row_tpl['gottransp_date']!=NULL)
		{
			$arrival_date1=explode("-",$row_tpl['gottransp_date']);
			$dotpl=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
		}
		$tplloc=$row_tpl['gottransp_loc']."-".$row_tpl['gottransp_state'];
		$bedno=$row_tpl['gottransp_bedno'];
		$tpldir=$row_tpl['gottransp_direction'];
		$tplrows=$row_tpl['gottransp_noofrows'];
		$tplrange=$row_tpl['gottransp_range'];
		$tplplot=$row_tpl['gottransp_plotno'];
		$tplplants=$row_tpl['gottransp_noofplants'];
	}
	
	$qry_fnobser=mysqli_query($link,"SELECT fnobser_obserdate, fnobser_noofplants, fnobser_femaleplants, fnobser_femaleper, fnobser_maleplants, fnobser_maleper, fnobser_otherofftype, fnobser_otheroffper, fnobser_total, fnobser_totalper FROM tbl_qcgotfnobser where gotm_id ='".$arrival_id."'"); 
	if($tot_fnobser=mysqli_num_rows($qry_fnobser)>0)
	{
		$row_fnobser=mysqli_fetch_array($qry_fnobser);
		
		if($row_fnobser['fnobser_obserdate']!='' && $row_fnobser['fnobser_obserdate']!='0000-00-00' && $row_fnobser['fnobser_obserdate']!=NULL)
		{
			$arrival_date1=explode("-",$row_fnobser['fnobser_obserdate']);
			$fnobdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
		}
		$fnobppn=$row_fnobser['fnobser_noofplants'];
		$fnobfno=$row_fnobser['fnobser_femaleplants'];
		$fnobfper=$row_fnobser['fnobser_femaleper'];
		$fnobmno=$row_fnobser['fnobser_maleplants'];
		$fnobmper=$row_fnobser['fnobser_maleper'];
		$fnoboofno=$row_fnobser['fnobser_otherofftype'];
		$fnoboofper=$row_fnobser['fnobser_otheroffper'];
		$fnobtotno=$row_fnobser['fnobser_total'];
		$fnobtotper=$row_fnobser['fnobser_totalper'];
	}
	
	
	$qry_arrs=mysqli_query($link,"SELECT arrival_id, spcodef, spcodem, got1 FROM tblarrival_sub where orlot ='".$orlot."'"); 
	if($tot_arrs=mysqli_num_rows($qry_arrs)>0)
	{
		$row_arrs=mysqli_fetch_array($qry_arrs);
		$qry_arrm=mysqli_query($link,"SELECT arrival_date FROM tblarrival where arrival_id ='".$row_arrs['arrival_id']."'"); 
		$row_arrmain=mysqli_fetch_array($qry_arrm);
		
		if($row_arrmain['arrival_date']!='' && $row_arrmain['arrival_date']!='0000-00-00' && $row_arrmain['arrival_date']!=NULL)
		{
			$arrival_date1=explode("-",$row_arrmain['arrival_date']);
			$arrdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
		}
		$spcodes=$row_arrs['spcodef']."-".$row_arrs['spcodem'];
		$gotstatus=$row_arrs['got1'];
	}
	
	$qry_lotimp=mysqli_query($link,"SELECT lotploc, lotorganiser, lotfarmer, lotpper FROM tbllotimp where lotnumber ='".$oldlt."'"); 
	$row_lotimp=mysqli_fetch_array($qry_lotimp);
	$ploc=$row_lotimp['lotploc']; 
	$organizer=$row_lotimp['lotorganiser']; 
	$farmer=$row_lotimp['lotfarmer'];  
	$pper=$row_lotimp['lotpper']; 
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$orlot."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	$T=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and orlot='".$orlot."'") or die(mysqli_error($link));  
	$row_tbl1=mysqli_fetch_array($sql_tbl1);
	
	$sql1_sub=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));
	
	$total_tbl=mysqli_num_rows($sql1_sub);
	$slups=0; $slqty=0; $sstage="";
	while($row_tbl_sub=mysqli_fetch_array($sql1_sub))
	{
		$slups=$slups+$row_tbl_sub['lotldg_balbags'];
		$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
		$sstage=$row_tbl_sub['lotldg_sstage'];
	}
	//echo $slups;
	$aq=explode(".",$slqty);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
	
	$acn=$slups;
	
	$gotresult=$row_arr_home['gotm_result'];
	$gpper=$row_arr_home['gotm_gpper'];   
	 	
	$lotno=$row_arr_home['gotm_lotno'];
	 $sampleno=$row_arr_home['gotm_sampleno'];
	$bags=$acn;
	$qty=$ac;
	if($gotm_result==0)$gotm_result="";

	$quer33=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_arr_home['gotm_variety']."'"); 
	//if($tot_vv=mysql_num_rows($quer33)>0)
	if(is_numeric($row_arr_home['gotm_variety']))
	{
		$rowvv=mysqli_fetch_array($quer33);
		$varietyname=$rowvv['popularname'];
	}
	else
	{
		$varietyname=$row_arr_home['gotm_variety'];
	}	
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gotm_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$cropname=$row31['cropname'];
if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="79" align="center" valign="middle" class="smalltbltext"><?php echo $arrdate?></td>
	<td width="148" align="center" valign="middle" class="smalltbltext"><?php echo $cropname; ?></td>
	<td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $spcodes?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $varietyname;?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $sampleno;?></td>
	<td width="73" align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td width="42" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $gotstatus?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $organizer?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $farmer;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $wh;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dosw;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sow_loc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dotpl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpldir;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplrows;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplrange;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplplot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobppn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobfno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobfper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobmno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobmper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnoboofno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnoboofper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobtotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobtotper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gpper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="79" align="center" valign="middle" class="smalltbltext"><?php echo $arrdate?></td>
	<td width="148" align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $spcodes?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $varietyname;?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $sampleno;?></td>
	<td width="73" align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td width="42" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $gotstatus?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $organizer?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $farmer;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $wh;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dosw;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sow_loc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dotpl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpldir;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplrows;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplrange;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplplot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobppn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobfno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobfper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobmno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobmper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnoboofno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnoboofper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobtotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobtotper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gpper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $fnobdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
</tr
>
<?php
}
$srno=$srno+1;
}
}
}
?>
</tbody>
</table>
</div>
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
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="got_period_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;
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
fixedheader: true,
fixedColumns:   {
	left: 7
}
} );
} );
</script>
</body>
</html>
