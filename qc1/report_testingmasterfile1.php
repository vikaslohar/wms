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
	
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$sdate = $_REQUEST['sdate'];
	 	$edate = $_REQUEST['edate'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Supervisor - Report - Periodical Testing Data Report</title>

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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var pmc=document.frmaddDepartment.txtpmcode.value;
winHandle=window.open('report_testingmasterfile2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}

</script>
<style>
/*th, td { white-space: nowrap; }
����div.dataTables_wrapper {
��������width: 800px;
��������margin: 0 auto;
����}*/
</style>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <?php
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$txtpmcode=$_REQUEST['txtpmcode'];
		
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
		
	$crp="ALL"; $ver="ALL"; 
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	//echo "select * from tbl_qcgdata where str_to_date(qcg_setupdt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcg_setupdt, '%d-%m-%Y') >='".date($sdate)."' and qcg_setupflg=1  order by qcg_sampleno asc";
	$sql_rr22=mysqli_query($link,"select * from tbl_qcgdata where str_to_date(qcg_setupdt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcg_setupdt, '%d-%m-%Y') >='".date($sdate)."' and qcg_setupflg=1   and qcg_germpflg=1 order by qcg_sampleno asc") or die(mysqli_error($link));

 $tot_rr22=mysqli_num_rows($sql_rr22);
	
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">&nbsp;Periodical Testing Data Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="txtpmcode" value="<?php echo $txtpmcode;?>" type="hidden">  
		 <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="100%" bordercolor="#d21704" style="border-collapse:collapse">
   	<!--<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr class="Dark" height="25">
    <td align="center" class="subheading" colspan="2">Sample Request Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr class="Dark" height="25" >
	 <td align="left" class="subheading" >&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" >Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
</table>
<div style="overflow:scroll; height:400px; width:974px;">
<table width="2000" align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#d21704" id="example" >
<thead >
<tr class="tblsubtitle" height="20">
	<td width="2%" rowspan="2" align="center" valign="middle" class="smalltblheading" >#</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >DOSR</td>
	<td width="7%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Crop</td>
	<td width="8%" rowspan="2"  align="center" valign="middle" class="smalltblheading" >Variety</td>
	<td align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No.</td>
	<td width="3%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total Qty (kg)</td>
	<td width="3%" rowspan="2"  align="center" valign="middle" class="smalltblheading" >QC Tests</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Sample no.</td>
	<td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading" >DOSC</td>
	<td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Doc. Ref. No.</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2" >Moisture Test Report</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2" >Physical Purity Test Report</td>
	<td align="center" valign="middle" class="smalltblheading" rowspan="2" >Germination Test Type </td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >GKD</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >EDOR</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="7" >Standard Germination Test (SGT)</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="6" >Field Germination Test (FGT)</td>
	<td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Updated result</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Result Submit Date</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >QC Status</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Remarks</td>
	<td width="5%" colspan="2" align="center" valign="middle" class="smalltblheading" >SLOC</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Guard Sample Discard Schedule</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading" >Soft Released Lots For Dispatch</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="4" >Arrival Details</td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Moisture (%)</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Date of Test </td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >PP Result</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Date of test</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >No of replication</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Normal Seedlings (%)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Abormal Seedlings (%)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Dead Seeds (%)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Hard/FUG Seeds (%)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Vigor</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Date of test</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >No of replication</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Normal Seedlings (%)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Abormal Seedlings (%)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Dead Seeds (%)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Vigor</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Date of Test</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Working</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Guard</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Arrival Date</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >SP Code Female</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >SP Code Male</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Harvest Date</td>
</tr>	
 </thead>
 <tbody>
<?php

$srno=1; $lotno=""; $enob=""; $eqty=""; $pnob=""; $pqty=""; $rmqty1=""; $rmper1=""; $imqty1=""; $imper1=""; $plqty1=""; $plper1=""; $tplqty=""; $tplper=""; $pmc=""; $psn=""; $treats=""; $oprname="";
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
if($tot_rr22 > 0)
{
while($row_rr22=mysqli_fetch_array($sql_rr22))
{

$samplenum=str_split($row_rr22['qcg_sampleno']);
//print_r($samplenum);

 $smpn=$samplenum[2].$samplenum[3].$samplenum[4].$samplenum[5].$samplenum[6].$samplenum[7];

 $qry="select * from tbl_qctest where  sampleno='".$smpn."' AND yearid='".$samplenum[1]."'  ";
//exit;	
	if($crop!="ALL")
	{	
		$qry.="and crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.="and variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" order by tid desc LIMIT 0,1 ";
	//echo $qry; echo "<br />";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);


while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	$sampno=$row_rr22['qcg_sampleno'];//$tp1.$row_arr_home1['yearid'].sprintf("%000006d",$row_arr_home1['sampleno']);
	
	
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$cropname=$row31['cropname'];	
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['variety']."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$varietyname=$rowvv['popularname'];
	}
	else
	{
		$varietyname=$row_arr_home1['variety'];
	}
	

	$lotno=$row_arr_home1['lotno'];
	$tqty=0; $sloc='';
	$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$lotno."' ") or die(mysqli_error($link));
	while($row_issue=mysqli_fetch_array($sql_issue))
	{ 
		$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		//echo $row_issue1[0];
		$sql_issuetbl1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
		while($row_issuetbl1=mysqli_fetch_array($sql_issuetbl1))
		{ 
			$tqty=$tqty+$row_issuetbl1['lotldg_balqty']; 
			
			/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl1['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
			
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl1['lotldg_binid']."' and whid='".$row_issuetbl1['lotldg_whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
			
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl1['lotldg_subbinid']."' and binid='".$row_issuetbl1['lotldg_binid']."' and whid='".$row_issuetbl1['lotldg_whid']."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
			
			if($sloc!="")
			$sloc=$sloc.$wareh.$binn.$subbinn."<br/>";
			else
			$sloc=$wareh.$binn.$subbinn."<br/>";*/
			
			if($row_issuetbl1['lotldg_srflg']>0)
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$row_arr_home1['oldlot']."'") or die(mysqli_error($link));
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
						$softstatus="SR";//$row_softr['softrsub_srtyp'];
					}
				}
				//if($row_issuetbl['lotldg_got']=='UT' || $row_issuetbl['lotldg_got']=='RT')
				if($softstatus=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$row_arr_home1['oldlot']."'") or die(mysqli_error($link));
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
							$softstatus="SSR";//$row_softr2['softrsub_srtyp'];
						}
					}
				}
			
			}
			
		}
	}
	$totqty=$tqty;
	
	$srdate=$row_arr_home1['srdate'];
	$sryear=substr($srdate,0,4);
	$srmonth=substr($srdate,5,2);
	$srday=substr($srdate,8,2);
	$tsrdate=$srday."-".$srmonth."-".$sryear;
	
	$rdate=$row_arr_home1['spdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$scdate=$rday."-".$rmonth."-".$ryear;

	$dotdate=$row_arr_home1['testdate'];
	$dryear=substr($dotdate,0,4);
	$drmonth=substr($dotdate,5,2);
	$drday=substr($dotdate,8,2);
	$dot=$drday."-".$drmonth."-".$dryear;
	
	$slocgs='';
	$sql_gsm=mysqli_query($link,"select * from tbl_gsample where oldlot='".$row_arr_home1['oldlot']."'") or die(mysqli_error($link));
	$row_gsm=mysqli_fetch_array($sql_gsm);
	if($row_gsm['gswh']!=0 && $row_gsm['gswh']!=0)
	{
		$sql_gswhouse=mysqli_query($link,"select perticulars from tblwarehouse where whid='".$row_gsm['gswh']."' order by perticulars") or die(mysqli_error($link));
		$row_gswhouse=mysqli_fetch_array($sql_gswhouse);
		$warehgs=$row_gswhouse['perticulars']."/";
		
		$sql_gsbinn=mysqli_query($link,"select binname from tblbin where binid='".$row_gsm['gsbin']."' and whid='".$row_gsm['gswh']."'") or die(mysqli_error($link));
		$row_gsbinn=mysqli_fetch_array($sql_gsbinn);
		$binngs=$row_gsbinn['binname']."/";
		if($slocgs!="")
			$slocgs=$slocgs.$warehgs.$binngs."<br/>";
		else
			$slocgs=$warehgs.$binngs."<br/>";
	}
	if($row_arr_home1['state']=="P/M/G" || $row_arr_home1['state']=="P/M/G/T")
	{
		$sql_qcm=mysqli_query($link,"select * from tbl_qcmdata where qcm_sampno='".$sampno."'") or die(mysqli_error($link));
		$row_qcm=mysqli_fetch_array($sql_qcm);
		
		$mmavg=$row_qcm['qcm_mmrmoistper'];
		$haomavg=$row_qcm['qcm_haommoistper'];
		$mdot=$row_qcm['qcm_moistdt'];
		$moistper=$row_qcm['qcm_moistper'];
		
		$sql_qcp=mysqli_query($link,"select * from tbl_qcpdata where qcp_sampleno='".$sampno."'") or die(mysqli_error($link));
		$row_qcp=mysqli_fetch_array($sql_qcp);
		
		$pppureseed=$row_qcp['qcp_pureseedper'];
		$ppim=$row_qcp['qcp_imseedper'];
		$ppls=$row_qcp['qcp_lightseedper'];
		$ppocs=$row_qcp['qcp_ocseedinkg'];
		$ppodv=$row_qcp['qcp_odvseedinkg'];
		$ppdisc=$row_qcp['qcp_dcseedper'];
		$ppph=$row_qcp['qcp_phseedinkg'];
		$ppresult=$row_qcp['qcp_ppresult'];
		
		$ppdot=$row_qcp['qcp_ppdate'];
	
	}
	$qctests=$row_arr_home1['state'];


//echo "select * from tbl_qcgdata where qcg_sampleno='".$sampno."' and  str_to_date(qcg_setupdt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcg_setupdt, '%d-%m-%Y') >='".date($sdate)."' and qcg_setupflg=1  order by qcg_sampleno asc"."<br />";	
// 		Table code for crop & variety wise lot numbers
//$sql_rr22=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' and  str_to_date(qcg_setupdt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcg_setupdt, '%d-%m-%Y') >='".date($sdate)."' and qcg_setupflg=1  order by qcg_sampleno asc") or die(mysqli_error($link));

//$tot_rr22=mysqli_num_rows($sql_rr22);
//while($row_rr22=mysqli_fetch_array($sql_rr22))
//{	
	$docrefno=$row_rr22['qcg_docsrefno'];
	
	$qcg_testtype=$row_rr22['qcg_testtype'];
	
	$qcg_sgtnoofrep=$row_rr22['qcg_sgtnoofrep'];
	$qcg_sgtnormalavg=$row_rr22['qcg_sgtnormalavg'];
	$qcg_sgtabnormalavg=$row_rr22['qcg_sgtabnormalavg'];
	$qcg_sgthardfugavg=$row_rr22['qcg_sgthardfugavg'];
	$qcg_sgtdeadavg=$row_rr22['qcg_sgtdeadavg'];
	$qcg_sgtvremark=$row_rr22['qcg_sgtvremark'];
	
	$qcg_vignoofrep=$row_rr22['qcg_vignoofrep'];
	$qcg_vignormalavg=$row_rr22['qcg_vignormalavg'];
	$qcg_vigabnormalavg=$row_rr22['qcg_vigabnormalavg'];
	$qcg_vigdeadavg=$row_rr22['qcg_vigdeadavg'];
	$qcg_vigvremark=$row_rr22['qcg_vigvremark'];
	
	$qcg_germp=$row_rr22['qcg_germp'];
	$qcg_retult=$row_rr22['qcg_retult'];
	$remarks=$row_rr22['qcg_oprremark'];
	
	$germpdate=$row_rr22['qcg_germpdt'];
	$germpdryear=substr($germpdate,0,4);
	$germpdrmonth=substr($germpdate,5,2);
	$germpdrday=substr($germpdate,8,2);
	$qcg_germpdt=$germpdrday."-".$germpdrmonth."-".$germpdryear;
	if($qcg_germpdt=="0000-00-00"){$qcg_germpdt='';}
	
	
	$qcg_vigdt=$row_rr22['qcg_vigdt'];
	
	$gsetupdate=$row_rr22['qcg_setupdt'];
	$gsetupdryear=substr($gsetupdate,0,4);
	$gsetupdrmonth=substr($gsetupdate,5,2);
	$gsetupdrday=substr($gsetupdate,8,2);
	$gkd=$row_rr22['qcg_setupdt'];//$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear;
	if($gkd=="0000-00-00"){$gkd='';}
		
	$qcg_sgtdt=$row_rr22['qcg_sgtdt'];
	
	
	$dt=$row31['expdt']+1;
	if($gkd!="")
	{
		$m=$gsetupdrmonth;
		$de=$gsetupdrday;
		$y=$gsetupdryear;
		$dt22=$dt;
		if($dt!="")
		{
			$edor=date('Y-m-d',mktime(0,0,0,$m,($de-$dt),$y)); 
			$gsetupdate=$edor;
			$gsetupdryear=substr($gsetupdate,0,4);
			$gsetupdrmonth=substr($gsetupdate,5,2);
			$gsetupdrday=substr($gsetupdate,8,2);
			$edor=$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear; 
		}
		else
		$edor="";
	}
	
	if($qcg_germpdt!='')
	{
		$m=$germpdrmonth;
		$de=$germpdrday;
		$y=$germpdryear;
		$dt=1;
		if($qcg_germpdt!="")
		{
			$gsdd=date('Y-m-d',mktime(0,0,0,$m,$de,($y+1))); 
			$gsetupdate=$gsdd;
			$gsetupdryear=substr($gsetupdate,0,4);
			$gsetupdrmonth=substr($gsetupdate,5,2);
			$gsetupdrday=substr($gsetupdate,8,2);
			$gsdd=$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear;  
		}
		else
		$gsdd="";
	}
	
	$oltn=str_split($row_arr_home1['oldlot']);
	$oldlotnm=$oltn[1].$oltn[2].$oltn[3].$oltn[4].$oltn[5].$oltn[6];
	
	$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where old='".$oldlotnm."'") or die(mysqli_error($link));
	$row_arrsub=mysqli_fetch_array($sql_arrsub);
	
	$spcf=$row_arrsub['spcodef'];
	$spcm=$row_arrsub['spcodem'];
	
	
	$hardate=$row_arrsub['harvestdate'];
	$hardtyear=substr($hardate,0,4);
	$hardtmonth=substr($hardate,5,2);
	$hardtday=substr($hardate,8,2);
	$harvestdate=$hardtday."-".$hardtmonth."-".$hardtyear;
	if($harvestdate=="0000-00-00"){$harvestdate='';}
	
	$sql_arrmain=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_arrsub['arrival_id']."'") or die(mysqli_error($link));
	$row_arrmain=mysqli_fetch_array($sql_arrmain);
	
	$arrdate=$row_arrmain['arrival_date'];
	$arrdtyear=substr($arrdate,0,4);
	$arrdtmonth=substr($arrdate,5,2);
	$arrdtday=substr($arrdate,8,2);
	$arrivaldate=$arrdtday."-".$arrdtmonth."-".$arrdtyear;
	if($arrivaldate=="0000-00-00"){$arrivaldate='';}

if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tsrdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyname?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="9%" align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $qctests;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sampno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $scdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $docrefno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moistper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mdot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ppresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ppdot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_testtype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gkd;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $edor;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnoofrep;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtvremark;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignoofrep;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigvremark;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_germp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_germpdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_retult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remarks;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocgs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gsdd;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $softstatus;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrivaldate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcm;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $harvestdate;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tsrdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyname?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="9%" align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $qctests;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sampno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $scdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $docrefno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moistper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mdot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ppresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ppdot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_testtype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gkd;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $edor;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnoofrep;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtvremark;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignoofrep;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigvremark;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_germp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_germpdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_retult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remarks;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocgs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gsdd;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $softstatus;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrivaldate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcm;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $harvestdate;?></td>
</tr>

<?php
}
$srno=$srno+1;
}
}
}
//}
//}

//}


?>
</tbody>	  	
</table>
</div>		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td  align="center" valign="middle"><a href="report_testingmasterfile.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="excel_testingmasterfile.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a><!--<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />--></td>
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
����var table = $('#example').DataTable( {
��������scrollY:        "300px",
��������scrollX:        true,
��������scrollCollapse: true,
��������paging:         false,
		searching: false,
	����ordering:  false,
��������fixedColumns:   {
������������left: 5
��������}
����} );
} );
</script>
</body>
</html>
