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
<title>QC Supervisor - Report - Periodical Physical Purity Testing Data Report</title>

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
    div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }*/
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
	$sql_rr22=mysqli_query($link,"select * from tbl_qcpdata where str_to_date(qcp_ppdatadt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcp_ppdatadt, '%d-%m-%Y') >='".date($sdate)."' and qcp_ppdataflg=1  order by qcp_sampleno asc") or die(mysqli_error($link));

 $tot_rr22=mysqli_num_rows($sql_rr22);
	
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">&nbsp;Periodical Physical Purity Testing Data Report</td>
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
    <td align="center" class="subheading" colspan="2">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
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
	<td width="2%"  align="center" valign="middle" class="smalltblheading" >#</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >DOSR</td>
	<td width="7%"  align="center" valign="middle" class="smalltblheading" >Crop</td>
	<td width="8%"   align="center" valign="middle" class="smalltblheading" >Variety</td>
	<td align="center" valign="middle" class="smalltblheading" >Lot No.</td>
	<td width="3%"  align="center" valign="middle" class="smalltblheading" >Total Qty (kg)</td>
	<td width="3%"   align="center" valign="middle" class="smalltblheading" >QC Tests</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >Sample no.</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >DOSC</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >Doc. Ref. No.</td>
	<td align="center" valign="middle" class="smalltblheading">Sample Weight</td>
	<td align="center" valign="middle" class="smalltblheading" >Pure Seed</td>
	<td align="center" valign="middle" class="smalltblheading" >Pure Seed (%)</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >IM Seed</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >IM Seed (%)</td>
	<td align="center" valign="middle" class="smalltblheading">Lioght Seed</td>
	<td align="center" valign="middle" class="smalltblheading">Light Seed (%)</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >OC Seeds Nos.</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >OC Seeds in Kgs.</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >OC Seeds Weight</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >OC Seeds Per</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >ODV Seeds Nos.</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Seeds in Kgs.</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Seeds Weight</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Seeds Per</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >ODV 1010 </td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Fine Grain</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Bold Grain</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Long Grain</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >ODV Other Type</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Total</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >ODV Total Per</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >DC Seed</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >DC Seed (%)</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >PH Seeds Nos.</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >PH Seeds in Kgs.</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >PH Seeds Weight</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >PH Seeds Per</td>
	<td width="4%"  align="center" valign="middle" class="smalltblheading" >Grey Seeds Total No. in Sample</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >Grey Seeds No. per Kgs.</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >Grey Seeds Weight Gms</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >Grey Seeds Per</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >PP Result</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >PP Result Date</td>
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

$samplenum=str_split($row_rr22['qcp_sampleno']);
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
	$sampno=$row_rr22['qcp_sampleno'];//$tp1.$row_arr_home1['yearid'].sprintf("%000006d",$row_arr_home1['sampleno']);
	
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
	
	$qctests=$row_arr_home1['state'];
	$docrefno=$row_arr_home1['qcrefno'];
	
	$qcp_samplewt=$row_rr22['qcp_samplewt'];
	
	$qcp_pureseed=$row_rr22['qcp_pureseed'];
	$qcp_pureseedper=$row_rr22['qcp_pureseedper'];
	
	$qcp_imseed=$row_rr22['qcp_imseed'];
	$qcp_imseedper=$row_rr22['qcp_imseedper'];
	
	$qcp_lightseed=$row_rr22['qcp_lightseed'];
	$qcp_lightseedper=$row_rr22['qcp_lightseedper'];
	
	$qcp_ocseedno=$row_rr22['qcp_ocseedno'];
	$qcp_ocseedinkg=$row_rr22['qcp_ocseedinkg'];
	$qcp_ocwt=$row_rr22['qcp_ocwt'];
	$qcp_ocper=$row_rr22['qcp_ocper'];
	$qcp_ocremark=$row_rr22['qcp_ocremark'];
	
	$qcp_odvseedno=$row_rr22['qcp_odvseedno'];
	$qcp_odvseedinkg=$row_rr22['qcp_odvseedinkg'];
	$qcp_odvwt=$row_rr22['qcp_odvwt'];
	$qcp_odvper=$row_rr22['qcp_odvper'];
	$qcp_odv1010=$row_rr22['qcp_odv1010'];
	$qcp_odvfgrain=$row_rr22['qcp_odvfgrain'];
	$qcp_odvbgrain=$row_rr22['qcp_odvbgrain'];
	$qcp_odvlonggrain=$row_rr22['qcp_odvlonggrain'];
	$qcp_odvothertype=$row_rr22['qcp_odvothertype'];
	$qcp_odvtotal=$row_rr22['qcp_odvtotal'];
	$qcp_odvtotalper=$row_rr22['qcp_odvtotalper'];
	$qcp_odvremark=$row_rr22['qcp_odvremark'];
	
	$qcp_dcseed=$row_rr22['qcp_dcseed'];
	$qcp_dcseedper=$row_rr22['qcp_dcseedper'];
	
	$qcp_phseedno=$row_rr22['qcp_phseedno'];
	$qcp_phseedinkg=$row_rr22['qcp_phseedinkg'];
	$qcp_phwt=$row_rr22['qcp_phwt'];
	$qcp_phper=$row_rr22['qcp_phper'];
	$qcp_phremark=$row_rr22['qcp_phremark'];
	
	
	$qcp_gstotnosmp=$row_rr22['qcp_gstotnosmp'];
	$qcp_gsnoperkg=$row_rr22['qcp_gsnoperkg'];
	$qcp_gswtgms=$row_rr22['qcp_gswtgms'];
	$qcp_gsper=$row_rr22['qcp_gsper'];
	$qcp_gsremark=$row_rr22['qcp_gsremark'];
	
	$qcp_ppresult=$row_rr22['qcp_ppresult'];
	
	$qcp_ppdate=$row_rr22['qcp_ppdate'];
	//$germpdryear=substr($germpdate,0,4);
	//$germpdrmonth=substr($germpdate,5,2);
	//$germpdrday=substr($germpdate,8,2);
	//$qcp_ppdate=$germpdrday."-".$germpdrmonth."-".$germpdryear;
	if($qcp_ppdate=="0000-00-00"){$qcp_ppdate='';}
	
	
	
	

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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_samplewt?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_pureseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_pureseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_imseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_imseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_lightseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_lightseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocseedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocseedinkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocwt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvseedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvseedinkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvwt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odv1010;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvfgrain;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvbgrain;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvlonggrain;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvothertype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvtotal;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvtotalper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_dcseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_dcseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phseedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phseedinkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phwt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gstotnosmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gsnoperkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gswtgms;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gsper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ppresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ppdate;?></td>
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_samplewt?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_pureseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_pureseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_imseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_imseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_lightseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_lightseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocseedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocseedinkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocwt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ocper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvseedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvseedinkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvwt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odv1010;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvfgrain;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvbgrain;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvlonggrain;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvothertype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvtotal;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_odvtotalper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_dcseed;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_dcseedper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phseedno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phseedinkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phwt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_phper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gstotnosmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gsnoperkg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gswtgms;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_gsper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ppresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcp_ppdate;?></td>
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
<td  align="center" valign="middle"><a href="report_pptestingfile.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<a href="excel_pptestingfile.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a><img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />--></td>
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
        fixedColumns:   {
            left: 5
        }
    } );
} );
</script>
</body>
</html>
