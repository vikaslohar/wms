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
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager-Report - Stock Report as on <?php echo date("d-m-Y H:i:s"); ?></title>
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
var slchk=document.frmaddDepartment.slchk.value; 
var slchk2=document.frmaddDepartment.slchk2.value; 
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('stock_report2.php?slchk='+slchk+'&slchk2='+slchk2+'&txtcrop='+itemid+'&txtvariety='+vv,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
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
   <?php
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0";
	$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_rettype='P2P'";
	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$qry2.=" and lotldg_crop='$crop' ";
		$qry3.=" and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$tot_var=mysqli_num_rows($sql_var);
		if($tot_var>0)
		$ver=$row_var['popularname'];
		else
		$ver=$variety;
	}
	
	$qry.=" group by lotldg_crop";
	$qry2.=" group by lotldg_crop";
	$qry3.=" group by salesrs_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home23['salesrs_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp);
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
			$crop2=$crop2.",".$row312['cropid'];
			else
			$crop2=$row312['cropid'];
		}
	}
	
	//exit;
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">Stock Report as on <?php echo date("d-m-Y H:i:s"); ?></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="slchk" value="<?php echo $slchk;?>" type="hidden">  
		<input name="slchk2" value="<?php echo $slchk2;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
  


  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#d21704" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Veriety: <?php echo $ver;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="120" align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
	<!--<td width="226" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td align="center" valign="middle" class="tblheading" colspan="2">Raw Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Condition Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Pack Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Sales Return</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
	<td align="center" valign="middle" class="tblheading" colspan="5">Quality Status</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="60"  align="center" valign="middle" class="tblheading">NoB</td>
  <td width="60"  align="center" valign="middle" class="tblheading">Qty</td>
  <td width="60"  align="center" valign="middle" class="tblheading">NoB</td>
  <td width="60"  align="center" valign="middle" class="tblheading">Qty</td>
  <td width="105"  align="center" valign="middle" class="tblheading">UPS</td>
  <td width="60"  align="center" valign="middle" class="tblheading">NoP</td>
  <td width="60"  align="center" valign="middle" class="tblheading">NoMP</td>
  <td width="60"  align="center" valign="middle" class="tblheading">Qty</td>
  <td width="60"  align="center" valign="middle" class="tblheading">NoB</td>
  <td width="60"  align="center" valign="middle" class="tblheading">Qty</td>
  <td width="75"  align="center" valign="middle" class="tblheading">NoB</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Qty</td>
  <td width="60"  align="center" valign="middle" class="tblheading">Germ %</td>
  <td width="60"  align="center" valign="middle" class="tblheading">QC</td>
  <td width="60"  align="center" valign="middle" class="tblheading">DoT</td>
  <td width="95"  align="center" valign="middle" class="tblheading">GOT</td>
  <td width="60"  align="center" valign="middle" class="tblheading">DoGR</td>	
</tr>
<?php
$srno=1; $totalrnob=0; $totalrqty=0; $totalcnob=0; $totalcqty=0; $totalpnob=0; $totalpnomp=0; $totalpqty=0; $totalnob=0; $totalqty=0; $totalsrnob=0; $totalsrqty=0; 
if($tot_arr_home > 0)
{
$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$stage="Raw";
	$stage1="Condition";
	$stage2="Pack";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$crval."'";
	$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_crop='".$crval."'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$tot_var=mysqli_num_rows($sql_var);
		if($tot_var>0)
		$ver=$row_var['popularname'];
		else
		$ver=$variety;
	}
	
	$qry.=" group by lotldg_variety";
	$qry2.=" group by lotldg_variety";
	$qry3.=" group by salesrs_variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home23=mysqli_query($link,$qry3) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		$tot312=mysqli_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home12['lotldg_variety'];
		if($verarr!="")
		$verarr=$verarr.",".$vr;
		else
		$verarr=$vr;
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		$tot312=mysqli_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home22['lotldg_variety'];
		if($verarr!="")
		$verarr=$verarr.",".$vr;
		else
		$verarr=$vr;
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['salesrs_variety']."' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		$tot312=mysqli_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home23['salesrs_variety'];
		if($verarr!="")
		$verarr=$verarr.",".$vr;
		else
		$verarr=$vr;
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			$tot312=mysqli_num_rows($sql_crop2);
			if($tot312>0)
			$vr=$row312['varietyid'];
			else
			$vr=$cp2[$i];
			if($ver2!="")
			$ver2=$ver2.",".$vr;
			else
			$ver2=$vr;
		}
	}

	$verps=explode(",",$ver2);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$qrylt="select Distinct orlot from tbl_lot_ldg where lotldg_crop='".$crval."'";
		$qrylt2="select Distinct orlot from tbl_lot_ldg_pack where lotldg_crop='".$crval."'";
		$qrylt3="select Distinct salesrs_orlot from tbl_salesrv_sub where salesrs_crop='".$crval."'  and salesrs_rettype='P2P' ";
		if($variety!="ALL")
		{	
			$qrylt.=" and lotldg_variety='$variety' ";
			$qrylt2.=" and lotldg_variety='$variety' ";
			$qrylt3.=" and salesrs_variety='$variety' ";
		}
		
		$qrylt.=" order by orlot";
		$qrylt2.=" order by orlot";
		$qrylt3.=" order by salesrs_orlot";
	
		$sql_arr_homelt12=mysqli_query($link,$qrylt) or die(mysqli_error($link));
		$sql_arr_homelt22=mysqli_query($link,$qrylt2) or die(mysqli_error($link));
		$sql_arr_homelt23=mysqli_query($link,$qrylt3) or die(mysqli_error($link));
	
		$ltarr="";
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
		
		$ltn2=explode(",",$ltarr);
		$ltn2=array_unique($ltn2);
		sort($ltn2);
		foreach($ltn2 as $lt2)
		{
		if($lt2<>"")
		{
		
		$totrnob=0; $totrqty=0; $totcnob=0; $totcqty=0; $totpnob=0; $totpnomp=0; $totpqty=0; $ccnt=0; $tnob=0; $tqty=0; $totsrnob=0; $totsrqty=0; $ups="";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$totvar=mysqli_num_rows($sql_var);
		if($totvar>0)
		$verty=$row_var['popularname'];
		else
		$verty=$verval;
		
	 	
		$sql_qct1=mysqli_query($link,"select MAX(tid) from tbl_qctest where oldlot='".$lt2."'") or die(mysqli_error($link));
		$row_qct1=mysqli_fetch_array($sql_qct1);
		
		$sql_qct=mysqli_query($link,"select * from tbl_qctest where tid='".$row_qct1[0]."' and oldlot='".$lt2."'") or die(mysqli_error($link));
		$row_qct=mysqli_fetch_array($sql_qct);
		
		$gemp=$row_qct['gemp'];
		$qcresult=$row_qct['qcstatus'];
		
		$trdate=$row_qct['testdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$dot=$trday."-".$trmonth."-".$tryear;
		if($dot=="00-00-0000" || $dot=="--")$dot="";
		
		
		// Raw Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						$totrqty=$totrqty+$qt;
						$totrnob=$totrnob+$row_issuetbl['lotldg_balbags'];
						$totalrqty=$totalrqty+$totrqty;
						$totalrnob=$totalrnob+$totrnob; 
						$ccnt++;
						
						$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
						$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
						if($gemp=="")
						$gemp=$row_issuetbl['lotldg_gemp'];
						
						$trdate1=$row_issuetbl['lotldg_gottestdate'];
						$tryear1=substr($trdate1,0,4);
						$trmonth1=substr($trdate1,5,2);
						$trday1=substr($trdate1,8,2);
						$trdate1=$trday1."-".$trmonth1."-".$tryear1;
						if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
						$dogr=$trdate1;
						
						if($qcresult=="")
						$qcresult=$row_issuetbl['lotldg_qc'];
						
						if($dot=="")
						{
						$trdate=$row_issuetbl['lotldg_qctestdate'];
						$tryear=substr($trdate,0,4);
						$trmonth=substr($trdate,5,2);
						$trday=substr($trdate,8,2);
						$dot=$trday."-".$trmonth."-".$tryear;
						if($dot=="00-00-0000" || $dot=="--")$dot="";
						}
					}	
				}
			}
			if($totrqty < 0)$totrqty=0;
			if($totrqty==0 && $totrnob > 0)$totrnob=0;
		}
		
		
		// Condition Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage1' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						$totcqty=$totcqty+$qt; 
						$totcnob=$totcnob+$row_issuetbl['lotldg_balbags'];
						$totalcqty=$totalcqty+$totcqty;
						$totalcnob=$totalcnob+$totcnob; 
						$ccnt++;
						if($gotresult=="")
						{
						$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
						$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
						}
						if($gemp=="")
						$gemp=$row_issuetbl['lotldg_gemp'];
						
						if($dogr=="")
						{
						$trdate1=$row_issuetbl['lotldg_gottestdate'];
						$tryear1=substr($trdate1,0,4);
						$trmonth1=substr($trdate1,5,2);
						$trday1=substr($trdate1,8,2);
						$trdate1=$trday1."-".$trmonth1."-".$tryear1;
						if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
						$dogr=$trdate1;
						}
						if($qcresult=="")
						$qcresult=$row_issuetbl['lotldg_qc'];
						
						if($dot=="")
						{
						$trdate=$row_issuetbl['lotldg_qctestdate'];
						$tryear=substr($trdate,0,4);
						$trmonth=substr($trdate,5,2);
						$trday=substr($trdate,8,2);
						$dot=$trday."-".$trmonth."-".$tryear;
						if($dot=="00-00-0000" || $dot=="--")$dot="";
						}
					}	
				}
			}
			if($totcqty < 0)$totcqty=0;
			if($totcqty==0 && $totcnob > 0)$totcnob=0;
		}
		
		
		// Pack Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						if($qt<0)$qt=0;
						$totpqty=$totpqty+$qt; 
						$nop1=0;
						$ups=$row_issuetbl['packtype'];
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
						$ups=$packtyp[0]." ".$packtp[1];
						
						$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
						if($penqty > 0)
						{
							$nop1=($ptp*$penqty);
						}
						
						$totpnob=$totpnob+$nop1; 
						$totpnomp=$totpnomp+$row_issuetbl['balnomp']; 
						$totalpqty=$totalpqty+$totpqty;
						$totalpnob=$totalpnob+$totpnob; 
						$totalpnomp=totalpnomp+$totpnomp;
						
						$ccnt++;
						if($gotresult=="")
						{
						$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
						$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
						}
						if($gemp=="")
						$gemp=$row_issuetbl['lotldg_gemp'];
						
						if($dogr=="")
						{
						$trdate1=$row_issuetbl['lotldg_gottestdate'];
						$tryear1=substr($trdate1,0,4);
						$trmonth1=substr($trdate1,5,2);
						$trday1=substr($trdate1,8,2);
						$trdate1=$trday1."-".$trmonth1."-".$tryear1;
						if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
						$dogr=$trdate1;
						}
						if($qcresult=="")
						$qcresult=$row_issuetbl['lotldg_qc'];
						
						if($dot=="")
						{
						$trdate=$row_issuetbl['lotldg_qctestdate'];
						$tryear=substr($trdate,0,4);
						$trmonth=substr($trdate,5,2);
						$trday=substr($trdate,8,2);
						$dot=$trday."-".$trmonth."-".$tryear;
						if($dot=="00-00-0000" || $dot=="--")$dot="";
						}
					}	
				}
			}
			if($totpqty < 0)$totpqty=0;
			if($totpnob < 0)$totpnob=0;
			if($totpqty==0 && $totpnob > 0)$totpnob=0;
			if($totpqty==0 && $totpnomp > 0)$totpnomp=0;
		}
		
		// Sales Return Seed Records
		$sql_arhome=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and salesrs_orlot='$lt2' order by 'salesrs_id' asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_issuetbl['salesrss_qty']; 
					if($qt<0)$qt=0;
					if($qt>0)
					{
						$tot_p2c=0; $tot_srrv=0;
						$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' ") or die(mysqli_error($link));
						$tot_srrv=mysqli_num_rows($sq_srrv);
							
						$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' ") or die(mysqli_error($link));
						$tot_p2c=mysqli_num_rows($sq_p2c);
							
						if($tot_p2c>0){}
						else if($tot_srrv > 0){}
						else
						{
							$totsrqty=$totsrqty+$qt;
							$totsrnob=$totsrnob+$row_issuetbl['salesrss_nob']; 
							$totalsrqty=$totalsrqty+$totsrqty;
							$totalsrnob=$totalsrnob+$totsrnob;
							$ccnt++;
						}
					}
				}	
			}
			if($totsrqty < 0)$totsrqty=0;
		}
		
if($ccnt > 0)
{
$tnob=$tnob+$totrnob+$totcnob+$totpnob+$totsrnob;
$tqty=$tqty+$totrqty+$totcqty+$totpqty+$totsrqty;

$totalnob=$totalnob+$tnob;
$totalqty=$totalqty+$tqty;

if($gemp=="0")$gemp="";
if($qcresult!="OK")
{
$gemp="";
$dot="";
}
$gor=explode(" ", $gotresult);
if($gor[1]!="OK")
{
$dogr="";
}

if($tqty > 0)
{
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lt2?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrnob?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
	
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lt2?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrnob?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}
}
}
}
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext" colspan="2">Total</td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalrnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalcnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalcqty?></td>
	<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalpnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalpnomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalsrnob?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalnob?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalqty?></td>
	<td align="center" valign="middle" class="smalltbltext" colspan="5">&nbsp;</td>
</tr>
</table>			
<br />
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="stock_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
