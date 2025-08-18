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
	
	date_default_timezone_set('Asia/Calcutta');
	set_time_limit(0);	
	ini_set("memory_limit","5000M");
	
	
	$servername = "172.16.16.52";
	$username = "root";
	$password = "kvy782dragon201";

	// Create connection
	$connnew = new mysqli($servername, $username, $password, "seedtracwms_hyd");

	//$connnew = false;	
	//$connnew = mysqli_connect("172.16.36.52:8080","root","kvy782dragon201");
	/*if (!$connnew) {
	 echo "Not Connected";
	}
	else {
	echo "Connected";
	}
	exit;
	*/
	
	
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$slchk = $_REQUEST['slchk'];
	$slchk2 = $_REQUEST['slchk2'];
	$sdate = $_REQUEST['sdate'];
	$txtplant = $_REQUEST['txtplant'];
	if($txtplant=="Boriya"){$plantcode='B';}
	if($txtplant=="Deorjhal"){$plantcode='D';}
	if($txtplant=="Bandamailaram"){$plantcode='H';}
	if($crop!="ALL")
	{
		$sqlcrop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$rowcrop=mysqli_fetch_array($sqlcrop);
		$cropnam=$rowcrop['cropname'];
	}
	if($variety!="ALL")
	{	
		$sqlvar=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' AND actstatus='Active' ") or die(mysqli_error($link));
		$rowvar=mysqli_fetch_array($sqlvar);
		$verietynam=$rowvar['popularname'];
	}	
	$platc="";
	if($txtplant!="ALL" && $txtplant!="Bandamailaram")
	{
		$platc=" and plantcode='$plantcode' ";
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant Manager-Report - Stock Report as on <?php echo date("d-m-Y H:i:s"); ?></title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />

<link href="../include/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../include/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../include/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../include/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../include/dataTables.fixedColumns.min.js"></script>

</head>
<style>
.smalltblheading{
	background-color: #A2CEF9 !important;
	/*border-color:#d21704 !important;*/
}
</style>
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
var slchk=document.frmaddDepartment.slchk.value; 
var slchk2=document.frmaddDepartment.slchk2.value; 
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var sdate=document.frmaddDepartment.sdate.value;
var txtplant=document.frmaddDepartment.txtplant.value;
winHandle=window.open('stock_reportnew2.php?slchk='+slchk+'&slchk2='+slchk2+'&txtcrop='+itemid+'&txtvariety='+vv+'&sdate='+sdate+'&txtplant='+txtplant,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plantm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>


   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">Stock Report as on <?php echo $sdate; ?></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="slchk" value="<?php echo $slchk;?>" type="hidden">  
		<input name="slchk2" value="<?php echo $slchk2;?>" type="hidden">  
		<input name="sdate" value="<?php echo $sdate;?>" type="hidden">
		<input name="txtplant" value="<?php echo $txtplant;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
 <?php
 //if($tot_arr_home > 0)
$sd=explode("-",$sdate);
$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);



	$cropnam="ALL"; $verietynam="ALL";
	
	if($crop!="ALL")
	{
		$sqlcrop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$rowcrop=mysqli_fetch_array($sqlcrop);
		$cropnam=$rowcrop['cropname'];
	}
	if($variety!="ALL")
	{	
		$sqlvar=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' AND actstatus='Active' ") or die(mysqli_error($link));
		$rowvar=mysqli_fetch_array($sqlvar);
		$verietynam=$rowvar['popularname'];
	}	
	
?> 


  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $cropnam;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $verietynam;?></td>

</tr>
</table>
<div style="overflow:scroll; height:400px; width:974px;">
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="2000" bordercolor="#2e81c1" id="example">
<thead>
<tr class="tblsubtitle" height="20">
	<td align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td align="center" valign="middle" class="smalltblheading" rowspan="2">Crop</td>
	<td align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="5">Deorjhal Plant</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="5">Boriya Plant</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="5">Bandamailaram Plant</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="5">All Plant Total</td>
</tr>	
<tr class="tblsubtitle" height="20">
	<td align="center" valign="middle" class="smalltblheading" >Raw Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Pack Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Sales Return Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Total Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Raw Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Pack Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Sales Return Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Total Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Raw Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Pack Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Sales Return Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Total Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Raw Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Pack Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Sales Return Qty</td>
	<td align="center" valign="middle" class="smalltblheading" >Total Qty</td>
</tr>
</thead>
<tbody>
<?php
//$connnew = mysqli_connect("192.168.3.18:3306","itadmin","user@2014");
//$connnew = new mysqli("dev.vnrseeds.in","root","Aax413W!.(6dX_YD","seedtracwms_hyd");

$stage="Raw";
$stage1="Condition";
$stage2="Pack";

$srno=1;

if($crop!="ALL")
{ 
	$sql_cropmain=mysqli_query($link,"select * from tblcrop where cropid='".$crop."' order by cropname ASC") or die(mysqli_error($link));
}
else
{
	$sql_cropmain=mysqli_query($link,"select * from tblcrop  order by cropname ASC") or die(mysqli_error($link));
}
while($row_cropmain=mysqli_fetch_array($sql_cropmain))
{ 
	$crop_id=$row_cropmain['cropid'];
	$crop_name=$row_cropmain['cropname'];
		
	$dtotalrnob=0; $dtotalrqty=0; $dtotalcnob=0; $dtotalcqty=0; $dtotalpnob=0; $dtotalpnomp=0; $dtotalpqty=0; $dtotalnob=0; $dtotalqty=0; $dtotalsrnob=0; $dtotalsrqty=0; 
	$btotalrnob=0; $btotalrqty=0; $btotalcnob=0; $btotalcqty=0; $btotalpnob=0; $btotalpnomp=0; $btotalpqty=0; $btotalnob=0; $btotalqty=0; $btotalsrnob=0; $btotalsrqty=0; 
	$htotalrnob=0; $htotalrqty=0; $htotalcnob=0; $htotalcqty=0; $htotalpnob=0; $htotalpnomp=0; $htotalpqty=0; $htotalnob=0; $htotalqty=0; $htotalsrnob=0; $htotalsrqty=0; 
	$dtotalnob=0; $dtotalqty=0; $btotalnob=0; $btotalqty=0; $htotalnob=0; $htotalqty=0;
	$gtotalrnob=0; $gtotalrqty=0; $gtotalcnob=0; $gtotalcqty=0; $gtotalpnob=0; $gtotalpnomp=0; $gtotalpqty=0; $gtotalnob=0; $gtotalqty=0; $gtotalsrnob=0; $gtotalsrqty=0; 
	
	$ver2='';
	if($variety!="ALL")
	{	
		$sql_varietymain=mysqli_query($link,"select * from tblvariety where cropname='".$crop_id."'  AND varietyid='".$variety."' AND actstatus='Active' order by popularname ASC ") or die(mysqli_error($link));
	}
	else
	{
		$sql_varietymain=mysqli_query($link,"select * from tblvariety where cropname='".$crop_id."' AND actstatus='Active' order by popularname ASC ") or die(mysqli_error($link));
	}	
	while($row_varietymain=mysqli_fetch_array($sql_varietymain))
	{
	
	if($ver2!="")
	{ $ver2=$ver2.",".$row_varietymain['varietyid']; }
	else
	{$ver2=$row_varietymain['varietyid'];}
	
	}
	//$variety_name=$row_varietymain['popularname'];	

	// Deorjhal Code
	
	
	$crval=$crop_id;
	
	$cvcod=$crop_name."-Coded";
	if($variety=="ALL" || $variety==$cvcod)
	$ver2=$ver2.",".$cvcod;
	
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crpn=$row_crp['cropname'];
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' AND actstatus='Active' ") or die(mysqli_error($link));
		$vtot=mysqli_num_rows($sql_var);
		if($vtot>0)
		{
			$row_var=mysqli_fetch_array($sql_var);
			$verty=$row_var['popularname'];
			$vtyp=$row_var['vt'];
			if($vtyp=="Hybrid")$vtyp="HY";
		}
		else
		{
		$verty=$verval;
		$vtyp="";
		}
		$vern=$verty;
		
		$ltarr="";
		
		$plantcode='D';
		if($plantcode=='D' || $plantcode=='B')
		{
			$qrylt="select Distinct orlot from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate' and lotldg_qc!='Fail'   ";
			$qrylt2="select Distinct orlot from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate' and lotldg_qc!='Fail'   ";
			$qrylt3="select Distinct salesrs_orlot from tbl_salesrv_sub where salesrs_crop='".$crval."'  and salesrs_rettype='P2P' and salesrs_qc!='Fail'   ";
			$qrylt.=" and lotldg_variety='$verval' ";
			$qrylt2.=" and lotldg_variety='$verval' ";
			$qrylt3.=" and salesrs_variety='$verval' ";
			
			
			$qrylt.=" order by orlot";
			$qrylt2.=" order by orlot";
			$qrylt3.=" order by salesrs_orlot";
		
			$sql_arr_homelt12=mysqli_query($link,$qrylt) or die(mysqli_error($link));
			$sql_arr_homelt22=mysqli_query($link,$qrylt2) or die(mysqli_error($link));
			$sql_arr_homelt23=mysqli_query($link,$qrylt3) or die(mysqli_error($link));
		
			
			while($row_arr_homelt12=mysqli_fetch_array($sql_arr_homelt12))
			{
				if($ltarr!="")
				$ltarr=$ltarr.",".$row_arr_homelt12['orlot'];
				else
				$ltarr=$row_arr_homelt12['orlot'];
			}
			
			while($row_arr_homelt22=mysqli_fetch_array($sql_arr_homelt22))
			{
				if($ltarr!="")
				$ltarr=$ltarr.",".$row_arr_homelt22['orlot'];
				else
				$ltarr=$row_arr_homelt22['orlot'];
			}
			
			while($row_arr_homelt23=mysqli_fetch_array($sql_arr_homelt23))
			{
				if($ltarr!="")
				$ltarr=$ltarr.",".$row_arr_homelt23['salesrs_orlot'];
				else
				$ltarr=$row_arr_homelt23['salesrs_orlot'];
				//echo $row_arr_homelt23['salesrs_orlot']."<br />";
			}
		}	
		
		
		
		$plantcode='H';
		if($plantcode=='H')
		{
			
				if ($connnew) {	
				//$connnew = mysqli_connect("192.168.3.18","itadmin","user@2022") or die("Error:".mysqli_error($connnew));
				//$dbnew = mysqli_select_db($connnew,"seedtracwms_hyd") or die("Error:".mysqli_error($connnew));
				
				$qrylt="select Distinct orlot from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate'  and lotldg_qc!='Fail'  ";
				$qrylt2="select Distinct orlot from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate' and lotldg_qc!='Fail'   ";
				$qrylt3="select Distinct salesrs_orlot from tbl_salesrv_sub where salesrs_crop='".$crval."'  and salesrs_rettype='P2P' and salesrs_qc!='Fail'  ";
				$qrylt.=" and lotldg_variety='$verval' ";
				$qrylt2.=" and lotldg_variety='$verval' ";
				$qrylt3.=" and salesrs_variety='$verval' ";
				
				
				$qrylt.=" order by orlot";
				$qrylt2.=" order by orlot";
				$qrylt3.=" order by salesrs_orlot";
			
				$sql_arr_homelt12=mysqli_query($connnew,$qrylt) or die(mysqli_error($connnew));
				$sql_arr_homelt22=mysqli_query($connnew,$qrylt2) or die(mysqli_error($connnew));
				$sql_arr_homelt23=mysqli_query($connnew,$qrylt3) or die(mysqli_error($connnew));
			
				
				while($row_arr_homelt12=mysqli_fetch_array($sql_arr_homelt12))
				{
					if($ltarr!="")
					$ltarr=$ltarr.",".$row_arr_homelt12['orlot'];
					else
					$ltarr=$row_arr_homelt12['orlot'];
				}
				
				while($row_arr_homelt22=mysqli_fetch_array($sql_arr_homelt22))
				{
					if($ltarr!="")
					$ltarr=$ltarr.",".$row_arr_homelt22['orlot'];
					else
					$ltarr=$row_arr_homelt22['orlot'];
				}
				
				while($row_arr_homelt23=mysqli_fetch_array($sql_arr_homelt23))
				{
					if($ltarr!="")
					$ltarr=$ltarr.",".$row_arr_homelt23['salesrs_orlot'];
					else
					$ltarr=$row_arr_homelt23['salesrs_orlot'];
					//echo $row_arr_homelt23['salesrs_orlot']."<br />";
				}
			}
		}
		
		$dtotrnob=0; $dtotrqty=0; $dtotcnob=0; $dtotcqty=0; $dtotpnob=0; $dtotpnomp=0; $dtotpqty=0; $ccnt=0; $dtnob=0; $dtqty=0; $dtotsrnob=0; $dtotsrqty=0; $dups=""; 
		$btotrnob=0; $btotrqty=0; $btotcnob=0; $btotcqty=0; $btotpnob=0; $btotpnomp=0; $btotpqty=0; $btnob=0; $btqty=0; $btotsrnob=0; $btotsrqty=0; $bups="";
		$htotrnob=0; $htotrqty=0; $htotcnob=0; $htotcqty=0; $htotpnob=0; $htotpnomp=0; $htotpqty=0; $thnob=0; $htqty=0; $htotsrnob=0; $htotsrqty=0; $hups="";
		$grandtotrqty=0; $grandtotcqty=0; $grandtotpqty=0; $grandtotsrqty=0; $grandtotqty=0;
		//echo $ltarr;
		$ltn2=explode(",",$ltarr);
		$ltn2=array_unique($ltn2);
		sort($ltn2);
		foreach($ltn2 as $lt2)
		{
		if($lt2<>"")
		{
		
		
		
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' AND actstatus='Active' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$totvar=mysqli_num_rows($sql_var);
		if($totvar>0)
		$verty=$row_var['popularname'];
		else
		$verty=$verval;
		
	 	
		$plantcode='D';
		if($plantcode=='D' || $plantcode=='B')
		{
		// Raw Seed Records
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."'  and lotldg_trdate<='$stdate'   group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_trdate<='$stdate'  order by lotldg_id desc LIMIT 1 ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select lotldg_balqty, lotldg_balbags, lotldg_sstage, plantcode from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate'  order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						if($row_issuetbl['lotldg_sstage']=="Raw")
						{
							if($row_issuetbl['plantcode']=='D')
							{
								$dtotrqty=$dtotrqty+$qt;
								$dtotrnob=$dtotrnob+$row_issuetbl['lotldg_balbags'];
								$dtotalrqty=$dtotalrqty+$qt;
								$dtotalrnob=$dtotalrnob+$row_issuetbl['lotldg_balbags']; 
							}
							if($row_issuetbl['plantcode']=='B')
							{
								$btotrqty=$btotrqty+$qt;
								$btotrnob=$btotrnob+$row_issuetbl['lotldg_balbags'];
								$btotalrqty=$btotalrqty+$qt;
								$btotalrnob=$btotalrnob+$row_issuetbl['lotldg_balbags']; 
							}
						}
						if($row_issuetbl['lotldg_sstage']=="Condition")
						{
							if($row_issuetbl['plantcode']=='D')
							{
								$dtotcqty=$dtotcqty+$qt; 
								$dtotcnob=$dtotcnob+$row_issuetbl['lotldg_balbags'];
								$dtotalcqty=$dtotalcqty+$qt;
								$dtotalcnob=$dtotalcnob+$row_issuetbl['lotldg_balbags']; 
							}
							if($row_issuetbl['plantcode']=='B')
							{
								$btotcqty=$btotcqty+$qt; 
								$btotcnob=$btotcnob+$row_issuetbl['lotldg_balbags'];
								$btotalcqty=$btotalcqty+$qt;
								$btotalcnob=$btotalcnob+$row_issuetbl['lotldg_balbags']; 
							}
						}
						$ccnt++;
					}	
				}
			}
			if($dtotrqty < 0)$dtotrqty=0;
			if($dtotrqty==0 && $dtotrnob > 0)$dtotrnob=0;
			if($btotrqty < 0)$btotrqty=0;
			if($btotrqty==0 && $btotrnob > 0)$totrnob=0;
			if($dtotcqty < 0)$dtotcqty=0;
			if($dtotcqty==0 && $dtotcnob > 0)$dtotcnob=0;
			if($totcqty < 0)$totcqty=0;
			if($totcqty==0 && $totcnob > 0)$totcnob=0;
		
		
		// Pack Seed Records
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_trdate<='$stdate'  group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_trdate<='$stdate'  order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select balqty, balnomp, packtype, wtinmp, plantcode from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						if($qt<0)$qt=0;
						
						$nop1=0;
						$dups=$row_issuetbl['packtype'];
						$wtinmp=$row_issuetbl['wtinmp']; 
						$upspacktype=$row_issuetbl['packtype'];
						$upspacktype=trim($upspacktype);
						$packtp=explode(" ",$upspacktype);
						$packt=trim($packtp[0]);
						$packtyp=explode(".",$packt); 
						
						if($packtp[1]=="Gms")
						{ 
							$ptp=(1000/$packtp[0]);
							$ptp1=($packtp[0]/1000);
						}
						else
						{
							$ptp=$packtp[0];
							$ptp1=$packtp[0];
						}
						
						if($packtyp[1]=="000")
						$dups=$packtyp[0]." ".$packtp[1];
						$zb=floatval($wtinmp*$row_issuetbl['balnomp']);
						$pk=floatval($row_issuetbl['balqty']);
						$rk=floatval($pk-$zb);
						$penqty=$rk;
						if($penqty > 0)
						{
							$nop1=($ptp*$penqty);
						}
						if($nop1<=0)$nop1=0;
						if($row_issuetbl['plantcode']=='D')
						{
							$dtotpqty=$dtotpqty+$qt; 
							$dtotpnob=$dtotpnob+$nop1; 
							$dtotpnob=intval($dtotpnob);
							$dtotpnomp=$dtotpnomp+$row_issuetbl['balnomp']; 
							$dtotalpqty=$dtotalpqty+$qt;
							$dtotalpnob=$dtotalpnob+$nop1; 
							$dtotalpnomp=$dtotalpnomp+$row_issuetbl['balnomp'];
						}
						if($row_issuetbl['plantcode']=='B')
						{
							$btotpqty=$btotpqty+$qt; 
							$btotpnob=$btotpnob+$nop1; 
							$btotpnob=intval($btotpnob);
							$btotpnomp=$btotpnomp+$row_issuetbl['balnomp']; 
							$btotalpqty=$btotalpqty+$qt;
							$btotalpnob=$btotalpnob+$nop1; 
							$btotalpnomp=$btotalpnomp+$row_issuetbl['balnomp'];
						}
						$ccnt++;
					}	
				}
			}
			if($dtotpqty < 0)$dtotpqty=0;
			if($dtotpnob < 0)$dtotpnob=0;
			if($dtotpqty==0 && $dtotpnob > 0)$dtotpnob=0;
			if($dtotpqty==0 && $dtotpnomp > 0)$dtotpnomp=0;
			
			if($btotpqty < 0)$btotpqty=0;
			if($btotpnob < 0)$btotpnob=0;
			if($btotpqty==0 && $btotpnob > 0)$btotpnob=0;
			if($btotpqty==0 && $btotpnomp > 0)$btotpnomp=0;
		
		// Sales Return Seed Records
			$sql_arhome=mysqli_query($link,"select salesr_id,salesrs_id,salesrs_newlot from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and salesrs_dovfy<='$stdate' and salesrs_orlot='$lt2'  order by 'salesrs_id' asc") or die(mysqli_error($link));
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$sql_istbl=mysqli_query($link,"select salesrss_qty, salesrss_nob, plantcode from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."'  ") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$s_srm=mysqli_query($link,"select * from tbl_salesrv where salesr_date<='$stdate' and salesr_id='".$row_arhome['salesr_id']."'  ") or die(mysqli_error($link));
						$t_srm=mysqli_num_rows($s_srm);
						if($t_srm > 0)
						{
							$r_srm=mysqli_fetch_array($s_srm);
							$qt=$row_issuetbl['salesrss_qty']; 
							if($qt<0)$qt=0;
							if($qt>0)
							{
								$tot_p2c=0; $tot_srrv=0;
								$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and srrv_date<='$stdate' ") or die(mysqli_error($link));
								$tot_srrv=mysqli_num_rows($sq_srrv);
								
								$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and unp_date<='$stdate' ") or die(mysqli_error($link));
								$tot_p2c=mysqli_num_rows($sq_p2c);
								
								if($tot_p2c>0){}
								else if($tot_srrv > 0){}
								else
								{
									if($row_issuetbl['plantcode']=='D')
									{
										$dtotsrqty=$dtotsrqty+$qt;
										$dtotsrnob=$dtotsrnob+$row_issuetbl['salesrss_nob']; 
										$dtotalsrqty=$dtotalsrqty+$qt;
										$dtotalsrnob=$dtotalsrnob+$row_issuetbl['salesrss_nob'];
									}
									if($row_issuetbl['plantcode']=='B')
									{
										$btotsrqty=$btotsrqty+$qt;
										$btotsrnob=$btotsrnob+$row_issuetbl['salesrss_nob']; 
										$btotalsrqty=$btotalsrqty+$qt;
										$btotalsrnob=$btotalsrnob+$row_issuetbl['salesrss_nob'];
									}
									$ccnt++;
								}
							}
						}
					}	
				}
				if($dtotsrqty < 0)$dtotsrqty=0;
				if($btotsrqty < 0)$btotsrqty=0;
			}
			
			
		
		}	
		
		
		$plantcode='H';
		if($plantcode=='H')
		{
			if ($connnew) 
			{	
			// Raw Seed Records
				$sql_is=mysqli_query($connnew,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."'  and lotldg_trdate<='$stdate'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($connnew));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($connnew,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_trdate<='$stdate'   order by lotldg_id desc LIMIT 1 ") or die(mysqli_error($connnew));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($connnew,"select lotldg_balqty, lotldg_balbags from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate'  order by lotldg_id asc") or die(mysqli_error($connnew)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_istbl))
						{ 
							$qt=$row_issuetbl['lotldg_balqty']; 
							if($qt<0)$qt=0;
							if($row_issuetbl['lotldg_sstage']=="Raw")
							{
								$htotrqty=$htotrqty+$qt;
								$htotrnob=$htotrnob+$row_issuetbl['lotldg_balbags'];
								$htotalrqty=$htotalrqty+$qt;
								$htotalrnob=$htotalrnob+$row_issuetbl['lotldg_balbags'];
							}
							if($row_issuetbl['lotldg_sstage']=="Condition")
							{ 
								$htotcqty=$htotcqty+$qt; 
								$htotcnob=$htotcnob+$row_issuetbl['lotldg_balbags'];
								$htotalcqty=$htotalcqty+$qt;
								$htotalcnob=$htotalcnob+$row_issuetbl['lotldg_balbags']; 
							}
							$ccnt++;
						}	
					}
				}
				if($htotrqty < 0)$htotrqty=0;
				if($htotrqty==0 && $htotrnob > 0)$htotrnob=0;
				if($htotcqty < 0)$htotcqty=0;
				if($htotcqty==0 && $htotcnob > 0)$htotcnob=0;
			
			// Pack Seed Records
				$sql_is=mysqli_query($connnew,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_trdate<='$stdate'  group by subbinid order by lotdgp_id asc") or die(mysqli_error($connnew));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($connnew,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_trdate<='$stdate'  order by lotdgp_id desc ") or die(mysqli_error($connnew));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($connnew,"select balqty, balnomp, packtype, wtinmp from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and lotldg_trdate<='$stdate'  order by lotdgp_id asc") or die(mysqli_error($connnew)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_istbl))
						{ 
							$qt=$row_issuetbl['balqty']; 
							if($qt<0)$qt=0;
							$htotpqty=$htotpqty+$qt; 
							$nop1=0;
							$hups=$row_issuetbl['packtype'];
							$wtinmp=$row_issuetbl['wtinmp']; 
							$upspacktype=$row_issuetbl['packtype'];
							$upspacktype=trim($upspacktype);
							$packtp=explode(" ",$upspacktype);
							$packt=trim($packtp[0]);
							$packtyp=explode(".",$packt); 
							
							if($packtp[1]=="Gms")
							{ 
								$ptp=(1000/$packtp[0]);
								$ptp1=($packtp[0]/1000);
							}
							else
							{
								$ptp=$packtp[0];
								$ptp1=$packtp[0];
							}
							
							if($packtyp[1]=="000")
							$hups=$packtyp[0]." ".$packtp[1];
							$zb=floatval($wtinmp*$row_issuetbl['balnomp']);
							$pk=floatval($row_issuetbl['balqty']);
							$rk=floatval($pk-$zb);
							$penqty=$rk;
							if($penqty > 0)
							{
								$nop1=($ptp*$penqty);
							}
							if($nop1<=0)$nop1=0;
							$htotpnob=$htotpnob+$nop1; 
							$htotpnob=intval($htotpnob);
							$htotpnomp=$htotpnomp+$row_issuetbl['balnomp']; 
							$htotalpqty=$htotalpqty+$qt;
							$htotalpnob=$htotalpnob+$nop1; 
							$htotalpnomp=$htotalpnomp+$row_issuetbl['balnomp'];
							
							$ccnt++;
						}	
					}
				}
				if($htotpqty < 0)$htotpqty=0;
				if($htotpnob < 0)$htotpnob=0;
				if($htotpqty==0 && $htotpnob > 0)$htotpnob=0;
				if($htotpqty==0 && $htotpnomp > 0)$htotpnomp=0;
			
			
			// Sales Return Seed Records
				$sql_arhome=mysqli_query($connnew,"select salesr_id,salesrs_id,salesrs_newlot from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and salesrs_dovfy<='$stdate' and salesrs_orlot='$lt2'  order by 'salesrs_id' asc") or die(mysqli_error($connnew));
				while($row_arhome=mysqli_fetch_array($sql_arhome))
				{  
					$sql_istbl=mysqli_query($connnew,"select salesrss_qty, salesrss_nob from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."'  ") or die(mysqli_error($connnew)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_istbl))
						{ 
							$s_srm=mysqli_query($connnew,"select * from tbl_salesrv where salesr_date<='$stdate' and salesr_id='".$row_arhome['salesr_id']."'  ") or die(mysqli_error($connnew));
							$t_srm=mysqli_num_rows($s_srm);
							if($t_srm > 0)
							{
								$r_srm=mysqli_fetch_array($s_srm);
								$qt=$row_issuetbl['salesrss_qty']; 
								if($qt<0)$qt=0;
								if($qt>0)
								{
									$tot_p2c=0; $tot_srrv=0;
									$sq_srrv=mysqli_query($connnew,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and srrv_date<='$stdate'  ") or die(mysqli_error($connnew));
									$tot_srrv=mysqli_num_rows($sq_srrv);
									
									$sq_p2c=mysqli_query($connnew,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and unp_date<='$stdate'  ") or die(mysqli_error($connnew));
									$tot_p2c=mysqli_num_rows($sq_p2c);
									
									if($tot_p2c>0){}
									else if($tot_srrv > 0){}
									else
									{
										$htotsrqty=$htotsrqty+$qt;
										$htotsrnob=$htotsrnob+$row_issuetbl['salesrss_nob']; 
										$htotalsrqty=$htotalsrqty+$qt;
										$htotalsrnob=$htotalsrnob+$row_issuetbl['salesrss_nob'];
										$ccnt++;
									}
								}
							}
						}	
					}
					if($htotsrqty < 0)$htotsrqty=0;
				}
				
				
			
			}
		}
	//echo $ccnt;	
}
}
	if($dtotpqty<=0)$dups='';
	$dtnob=$dtnob+$dtotrnob+$dtotcnob+$dtotpnob+$dtotsrnob;
	$dtqty=$dtqty+$dtotrqty+$dtotcqty+$dtotpqty+$dtotsrqty;
	$dtnob=intval($dtnob);
	
	if($btotpqty<=0)$bups='';
	$btnob=$btnob+$btotrnob+$btotcnob+$btotpnob+$btotsrnob;
	$btqty=$btqty+$btotrqty+$btotcqty+$btotpqty+$btotsrqty;
	$btnob=intval($btnob);
	
	if($htotpqty<=0)$hups='';
	$htnob=$htnob+$htotrnob+$htotcnob+$htotpnob+$htotsrnob;
	$htqty=$htqty+$htotrqty+$htotcqty+$htotpqty+$htotsrqty;
	$htnob=intval($htnob);
	
	/*
	$dtotalrnob=$dtotalrnob+$dtotrnob; 
	$dtotalrqty=$dtotalrqty+$dtotrqty;
	$dtotalcnob=$dtotalcnob+$dtotcnob;
	$dtotalcqty=$dtotalcqty+$dtotcqty;
	$dtotalpnob=$dtotalpnob+$dtotpnob;
	$dtotalpqty=$dtotalpqty+$dtotpqty;
	$dtotalsrnob=$dtotalsrnob+$dtotsrnob;
	$dtotalsrqty=$dtotalsrqty+$dtotsrqty;
	
	$btotalrnob=$btotalrnob+$btotrnob;
	$btotalrqty=$btotalrqty+$btotrqty
	$btotalcnob=$btotalcnob+$btotcnob;
	$btotalcqty=$btotalcqty+$btotcqty
	$btotalpnob=$btotalpnob+$btotpnob;
	$btotalpqty=$btotalpqty+$btotpqty
	$btotalsrnob=$btotalsrnob+$btotsrnob;
	$btotalsrqty=$btotalsrqty+$btotsrqty;
	
	$htotalrnob=$htotalrnob+$htotrnob;
	$htotalrqty=$htotalrqty+$htotrqty;
	$htotalcnob=$htotalcnob+$htotcnob;
	$htotalcqty=$htotalcqty+$htotcqty;
	$htotalpnob=$htotalpnob+$htotpnob;
	$htotalpqty=$htotalpqty+$htotpqty;
	$htotalsrnob=$htotalsrnob+$htotsrnob;
	$htotalsrqty=$htotalsrqty+$htotsrqty; 
	*/
	
	$gtotalrnob=$gtotalrnob+$dtotrnob+$btotrnob+$htotrnob;
	$gtotalrqty=$gtotalrqty+$dtotrqty+$btotrqty+$htotrqty;
	$gtotalcnob=$gtotalcnob+$dtotcnob+$btotcnob+$htotcnob;
	$gtotalcqty=$gtotalcqty+$dtotcqty+$btotcqty+$htotcqty;
	$gtotalpnob=$gtotalpnob+$dtotpnob+$btotpnob+$htotpnob;
	$gtotalpqty=$gtotalpqty+$dtotpqty+$btotpqty+$htotpqty;
	$gtotalsrnob=$gtotalsrnob+$dtotsrnob+$btotsrnob+$htotsrnob;
	$gtotalsrqty=$gtotalsrqty+$dtotsrqty+$btotsrqty+$htotsrqty;
	
	$dtotalnob=$dtotalnob+$dtnob;
	$dtotalqty=$dtotalqty+$dtqty;
	$btotalnob=$btotalnob+$btnob;
	$btotalqty=$btotalqty+$btqty;
	$htotalnob=$htotalnob+$htnob;
	$htotalqty=$htotalqty+$htqty;
	
	$gtotalnob=$gtotalnob+$dtnob+$btnob+$htnob;
	$gtotalqty=$gtotalqty+$dtqty+$btqty+$htqty;

	$grandtotrqty=$grandtotrqty+$dtotrqty+$btotrqty+$htotrqty;
	$grandtotcqty=$grandtotcqty+$dtotcqty+$btotcqty+$htotcqty;
	$grandtotpqty=$grandtotpqty+$dtotpqty+$btotpqty+$htotpqty;
	$grandtotsrqty=$grandtotsrqty+$dtotsrqty+$btotsrqty+$htotsrqty;
	$grandtotqty=$grandtotqty+$grandtotrqty+$grandtotcqty+$grandtotpqty+$grandtotsrqty;

$sql_rep="Insert into tmp_pmstrep (crop, variety, drawqty, dconqty, dpackqty, dsrqty, dtotalqty, brawqty, bconqty, bpackqty, bsrqty, btoaltqty, hrawqty, hconqty, hpackqty, hsrqty, htotalqty, grawqty, gconqty, gpackqty, gsrqty, gtotalqty, repflg, replogid) values ('$crop_name', '$verty', '$dtotrqty', '$dtotcqty', '$dtotpqty', '$dtotsrqty', '$dtqty', '$btotrqty', '$btotcqty', '$btotpqty', '$btotsrqty', '$btqty', '$htotrqty', '$htotcqty', '$htotpqty', '$htotsrqty', '$htqty', '$grandtotrqty', '$grandtotcqty', '$grandtotpqty', '$grandtotsrqty', '$grandtotqty', '1', '$logid')";
$ins=mysqli_query($link,$sql_rep) or die(mysqli_error($link));
	
	
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop_name?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotqty?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop_name?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grandtotqty?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
$sql_rep2="Insert into tmp_pmstrep (crop, variety, drawqty, dconqty, dpackqty, dsrqty, dtotalqty, brawqty, bconqty, bpackqty, bsrqty, btoaltqty, hrawqty, hconqty, hpackqty, hsrqty, htotalqty, grawqty, gconqty, gpackqty, gsrqty, gtotalqty, repflg, replogid) values ('$crop_name', 'Total', '$dtotalrqty', '$dtotalcqty', '$dtotalpqty', '$dtotalsrqty', '$dtotalqty', '$btotalrqty', '$btotalcqty', '$btotalpqty', '$btotalsrqty', '$btotalqty', '$htotalrqty', '$htotalcqty', '$htotalpqty', '$htotalsrqty', '$htotalqty', '$gtotalrqty', '$gtotalcqty', '$gtotalpqty', '$gtotalsrqty', '$gtotalqty', '1', '$logid')";
$ins2=mysqli_query($link,$sql_rep2) or die(mysqli_error($link));
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext" >&nbsp;</td>
	<td align="center" valign="middle" class="smalltbltext" >&nbsp;</td>
	<td align="center" valign="middle" class="smalltbltext" ><?php echo $crop_name?> Total</td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotalrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotalcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotalpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotalsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dtotalqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotalrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotalcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotalpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotalsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $btotalqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotalrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotalcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotalpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotalsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $htotalqty?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gtotalrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gtotalcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gtotalpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gtotalsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gtotalqty?></td>
</tr>
<?php

}
//}
//}
?>
</tbody>
</table>			
</div>

<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="stock_reportnew.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<!--&nbsp;<img src="../images/printpreview.gif" onclick="openprint();" style="cursor:pointer" border="0" />-->&nbsp;<a href="excel_stockreportnew.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>&txtplant=<?php echo $txtplant;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;
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
        fixedColumns:   {
            left: 3
        }
    } );
} );
</script>
</body>
</html>
