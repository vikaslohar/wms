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
	
	date_default_timezone_set("Asia/Calcutta");
			
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
<title>Viewer- Report - Quality based Stock Report</title>
<link href="../include/main_viewer.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('report_rawcropq2.php?slchk='+slchk+'&slchk2='+slchk2+'&txtcrop='+itemid+'&txtvariety='+vv,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_viewer.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/viewer_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
  <tr><td>
   <?php
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id!=0";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id!=0";
	$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_rettype='P2P'";
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
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
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
$upsizes=""; $upsids=""; $bsps=""; $i=0;
	$sql_ups=mysqli_query($link,"Select * from tblups") or die(mysqli_error($link));
	$tot_ups=mysqli_num_rows($sql_ups);
	while($row_ups=mysqli_fetch_array($sql_ups))
	{
		$i++;
		$ups=$row_ups['ups']." ".$row_ups['wt'];
		
		if($upsizes!="")
			$upsizes=$upsizes.",".$ups;
		else
			$upsizes=$ups;
		if($upsids!="")
			$upsids=$upsids.",".$row_ups['uid'];
		else
			$upsids=$row_ups['uid'];
		
		$uid='$upsid'.$i;	
		if($bsps!="")
			$bsps=$bsps.",".$uid;
		else
			$bsps=$uid;	
	}	
	//exit;
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" style="border-bottom:solid; border-bottom-color:#ef0388" >
	    <tr >
	      <td width="813" height="25">Quality based Stock Report As on - <?php echo date("d-m-Y h:i:s A"); ?></td>
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
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
  


  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#ef0388" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Veriety: <?php echo $ver;?><span class="subheading" style="float:right; color:#FF0000; font-size:11px; vertical-align:text-bottom;">* OK and UT Qty includes both Germination and GOT based seed stocks&nbsp;&nbsp;</span></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#ef0388" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="160" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
	<td width="226" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Raw Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Condition Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Pack Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Sales Return Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Grand Total</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
</tr>
<?php
$srno=1; 
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


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$crval."'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$crval."'";
	$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$crval."'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
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
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['salesrs_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($ver2!="")
			$ver2=$ver2.",".$row312['varietyid'];
			else
			$ver2=$row312['varietyid'];
		}
	}

	$verps=explode(",",$ver2);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$totrnob=0; $totrqty=0; $totcnob=0; $totcqty=0; $totpnob=0; $totpnomp=0; $totpqty=0; $ccnt=0; $tqty=0; $totsrqty=0; $totrqok=0; $totrqut=0;  
		$totcqok=0; $totcqut=0; $totpqok=0; $totpqut=0; $totsrqok=0; $totsrqut=0; $totqok=0; $totqut=0;  $totgotbl=0; $totrgotbl=0; $totcgotbl=0; $totpgotbl=0;
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$verty=$row_var['popularname'];
	 	
		// Raw Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						if($row_issuetbl['lotldg_qc']!="Fail" && $row_issuetbl['lotldg_got']!="Fail")
						{
							$totrqty=$totrqty+$qt; 
							$totrnob=$totrnob+$row_issuetbl['lotldg_balbags']; 
							
							if($row_issuetbl['lotldg_got']=="BL" || $row_issuetbl['lotldg_got']=="bl" || $row_issuetbl['lotldg_got']=="Bl")
							{
								$totrgotbl=$totrgotbl+$qt;  
							}
							if($row_issuetbl['lotldg_qc']=="BL" || $row_issuetbl['lotldg_qc']=="bl" || $row_issuetbl['lotldg_qc']=="Bl")
							{
								$totrgotbl=$totrgotbl+$qt;  
							}
							if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
							{
								$totrqut=$totrqut+$qt;  
							}
							$ccnt++;
						}
					}	
				}
			}
		}
		if($totrqty < 0)$totrqty=0;
		$totrqok=$totrqty-$totrqut-$totrgotbl;
		if($totrqok < 0)$totrqok=0;
		if($totrqut < 0)$totrqut=0;
		
		// Condition Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage1' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						if($row_issuetbl['lotldg_qc']!="Fail" && $row_issuetbl['lotldg_got']!="Fail")
						{
							$totcqty=$totcqty+$qt; 
							$totcnob=$totcnob+$row_issuetbl['lotldg_balbags']; 
							
							if($row_issuetbl['lotldg_got']=="BL" || $row_issuetbl['lotldg_got']=="bl" || $row_issuetbl['lotldg_got']=="Bl")
							{
								$totcgotbl=$totcgotbl+$qt;  
							}
							if($row_issuetbl['lotldg_qc']=="BL" || $row_issuetbl['lotldg_qc']=="bl" || $row_issuetbl['lotldg_qc']=="Bl")
							{
								$totcgotbl=$totcgotbl+$qt;  
							}
							if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
							{
								$totcqut=$totcqut+$qt;  
							}
							$ccnt++;
						}
					}	
				}
			}
		}
		if($totcqty < 0)$totcqty=0;
		$totcqok=$totcqty-$totcqut-$totcgotbl;
		if($totcqok < 0)$totcqok=0;
		if($totcqut < 0)$totcqut=0;
		
		
		
		// Pack Seed Records
		$upsizes;
		$up=explode(",",$upsizes);
		$ui=explode(",",$bsps);
		$ct=count($up);
		for($i=0; $i<$ct; $i++)
		{
			$totl=0;
			$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and packtype='".$up[$i]."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
			$totarhome=mysqli_num_rows($sql_arhome);
			if($totarhome > 0)
			{
				while($row_arhome=mysqli_fetch_array($sql_arhome))
				{  
					$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and packtype='".$up[$i]."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
					while($row_is=mysqli_fetch_array($sql_is))
					{ 
						$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and packtype='".$up[$i]."' order by lotdgp_id desc ") or die(mysqli_error($link));
						$row_is1=mysqli_fetch_array($sql_is1); 
						$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_is1[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						if($t > 0)
						{
							while($row_issuetbl=mysqli_fetch_array($sql_istbl))
							{ 
								$qt=$row_issuetbl['balqty']; 
								if($qt<0)$qt=0;
								if($row_issuetbl['lotldg_qc']!="Fail" && $row_issuetbl['lotldg_got']!="Fail")
								{
									$totpqty=$totpqty+$qt; 
									$totpnob=$totpnob+$row_issuetbl['balnop']; 
									$totl=$totl+$qt; 
									if($row_issuetbl['lotldg_got']=="BL" || $row_issuetbl['lotldg_got']=="bl" || $row_issuetbl['lotldg_got']=="Bl")
									{
										$totpgotbl=$totpgotbl+$qt;  
									}
									if($row_issuetbl['lotldg_qc']=="BL" || $row_issuetbl['lotldg_qc']=="bl" || $row_issuetbl['lotldg_qc']=="Bl")
									{
										$totpgotbl=$totpgotbl+$qt;  
									}
									if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
									{
										$totpqut=$totpqut+$qt;  
									}
									$ccnt++;
								}
							}	
						}
					}
					
				}
				$ui[$i]=$totl; 
			}
			else
			{
				$ui[$i]=""; 
			}
		}
		if($totpqty < 0)$totpqty=0;
		$totpqok=$totpqty-$totpqut-$totpgotbl;
		if($totpqok < 0)$totpqok=0;
		if($totpqut < 0)$totpqut=0;
		
		
		// Pack Seed Records
		/*$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotldg_variety='".$verval."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_is1[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						if($qt<0)$qt=0;
						if($row_issuetbl['lotldg_qc']!="Fail" && $row_issuetbl['lotldg_got']!="Fail")
						{
							$totpqty=$totpqty+$qt; 
							$totpnob=$totpnob+$row_issuetbl['balnop']; 
							
							if($row_issuetbl['lotldg_got']=="BL" || $row_issuetbl['lotldg_got']=="bl" || $row_issuetbl['lotldg_got']=="Bl")
							{
								$totpgotbl=$totpgotbl+$qt;  
							}
							if($row_issuetbl['lotldg_qc']=="BL" || $row_issuetbl['lotldg_qc']=="bl" || $row_issuetbl['lotldg_qc']=="Bl")
							{
								$totpgotbl=$totpgotbl+$qt;  
							}
							if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
							{
								$totpqut=$totpqut+$qt;  
							}
							$ccnt++;
						}
					}	
				}
			}
		}
		if($totpqty < 0)$totpqty=0;
		$totpqok=$totpqty-$totpqut-$totpgotbl;
		if($totpqok < 0)$totpqok=0;
		if($totpqut < 0)$totpqut=0;*/
			
		// Sales Return Seed Records
		$sql_arhome=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' order by 'salesrs_id'asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_arhome['salesrs_id']."'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_issuetbl['salesrss_qty']; 
					if($qt<0)$qt=0;
					if($row_arhome['salesrs_qc']!="Fail" && $row_arhome['salesrs_got1']!="Fail")
					{
						if($qt<0)$qt=0;
						
						if($qt>0)
						{
							$tot_p2c=0; $tot_srrv=0;
							$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where plantcode='$plantcode' AND srrv_lotno='".$row_arhome['salesrs_newlot']."' ") or die(mysqli_error($link));
							$tot_srrv=mysqli_num_rows($sq_srrv);
							
							$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where plantcode='$plantcode' AND unp_lotno='".$row_arhome['salesrs_newlot']."' ") or die(mysqli_error($link));
							$tot_p2c=mysqli_num_rows($sq_p2c);
							
							if($tot_p2c>0){}
							else if($tot_srrv > 0){}
							else
							{
								if($row_arhome['salesrs_qc']=="UT" || $row_arhome['salesrs_qc']=="RT" || $row_arhome['salesrs_got1']=="UT" || $row_arhome['salesrs_got1']=="RT")
								{
									$totsrqut=$totsrqut+$qt;  
									$totsrqty=$totsrqty+$qt; 
								}
								$ccnt++;
							}
						}
						
						/*if($row_arhome['salesrs_qc']=="OK" || $row_arhome['salesrs_qc']==" " || $row_arhome['salesrs_got1']=="OK" || $row_arhome['salesrs_got1']=="NUT" || $row_arhome['salesrs_got1']==" " || $row_arhome['salesrs_got1']=="" || $row_arhome['salesrs_got1']=="NULL")
						{
							$sql_is2=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$crval."' and lotno='".$row_arhome['salesrs_newlot']."' and lotldg_variety='".$verval."' and trstage='$stage2' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
							while($row_is2=mysqli_fetch_array($sql_is2))
							{ 
								$sql_is12=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_is2['subbinid']."' and binid='".$row_is2['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['salesrs_newlot']."' and trstage='$stage2' order by lotdgp_id desc ") or die(mysqli_error($link));
								$row_is12=mysqli_fetch_array($sql_is12); 
								$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_is12[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
								$t2=mysqli_num_rows($sql_istbl2);
								if($t2 == 0)
								{
									$totsrqok=$totsrqok+$row_issuetbl['salesrss_qty'];  
								}
							}	
						}
						if($row_arhome['salesrs_qc']=="UT" || $row_arhome['salesrs_qc']=="RT" || $row_arhome['salesrs_got1']=="UT" || $row_arhome['salesrs_got1']=="RT")
						{
							$totsrqut=$totsrqut+$qt;  
						}
						$ccnt++;*/
					}
				}	
			}
		}
		if($totsrqty < 0)$totsrqty=0;
		$totsrqok=$totsrqty-$totsrqut;
		if($totsrqok < 0)$totsrqok=0;
		if($totsrqut < 0)$totsrqut=0;
			
if($ccnt > 0)
{
$tqty=$tqty+$totrqty+$totcqty+$totpqty+$totsrqty;
$totqok=$totqok+$totrqok+$totcqok+$totpqok+$totsrqok;
$totqut=$totqut+$totrqut+$totcqut+$totpqut+$totsrqut;
$totgotbl=$totrgotbl+$totcgotbl+$totpgotbl;


$sql_rep="Insert into tmp_vwasrrep (crop, variety, rsok, rsut, rsbl, rstotal, csok, csut, csbl, cstotal, psok, psut, psbl, pstotal, srok, srut, srtotal, gtok, gtut, gtbl, gttotal, logid, repflg, plantcode) values ('$crop1', '$verty', '$totrqok', '$totrqut', '$totrgotbl', '$totrqty', '$totcqok', '$totcqut', '$totcgotbl', '$totcqty', '$totpqok', '$totpqut', '$totpgotbl', '$totpqty', '$totsrqok', '$totsrqut', '$totsrqty', '$totqok', '$totqut', '$totgotbl', '$tqty', '$logid', '1', '$plantcode')";
if($ins=mysqli_query($link,$sql_rep) or die(mysqli_error($link)))
{
	$tiiid=mysqli_insert_id($link);
	$up=explode(",",$upsizes);
	$ct=count($up);
	for($i=0; $i<$ct; $i++)
	{
		$uidd=$ui[$i];
		$upsize=$up[$i];
		$sql_repsub="Insert into tmp_vwasrrep2 (tid, upssize, upsval, plantcode) values ('$tiiid', '$upsize', '$uidd', '$plantcode')";
		$inssub=mysqli_query($link,$sql_repsub) or die(mysqli_error($link));
	}
}
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
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

?>
</table>			
<br />
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_rawcropq.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />&nbsp;<a href="excel-cropallq.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $_REQUEST['slchk'];?>&slchk2=<?php echo $_REQUEST['slchk2'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>
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
