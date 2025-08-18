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
	if($crop=="")$crop="ALL";
	if($variety=="")$variety="ALL";
	//if($txtupsdc=="")$txtupsdc="ALL";
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager - Report - Ready Stock Report As on <?php echo date("d-m-Y");?></title>
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var sdate=document.frmaddDepartment.sdate.value;
var edate=document.frmaddDepartment.edate.value;
winHandle=window.open('usefullstock_report2.php?txtcrop='+itemid+'&txtvariety='+vv+'&sdate='+sdate+'&edate='+edate,'WelCome','top=20,left=80,width=950,height=600,scrollbars=yes');
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
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">Ready Stock Report as on <?php echo date("d-m-Y");?></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden">
		<input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
<?php
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
$crop1=$row31['cropname'];	
	
$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
$row_var=mysqli_fetch_array($sql_var);
$verty=$row_var['popularname'];
?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop1;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $verty;?>&nbsp;&nbsp;|&nbsp;&nbsp;Selected LE Date: <?php echo $edate;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<!--<td width="26" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>-->
	<td width="59" rowspan="2" align="center" valign="middle" class="smalltblheading">Total Stock</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="5">Under Test</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="5">OK</td>
	<td width="63" rowspan="2"  align="center" valign="middle" class="smalltblheading">Ready Stock Today</td>
	<td width="68" rowspan="2"  align="center" valign="middle" class="smalltblheading">LE not available</td>
	<td width="60" rowspan="2"  align="center" valign="middle" class="smalltblheading">Ready Stock as on <?php echo $edate;?></td>
	<td width="69" rowspan="2"  align="center" valign="middle" class="smalltblheading">LE Expired Stock as on <?php echo $edate;?></td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="52"  align="center" valign="middle" class="smalltblheading">Raw</td>
  <td width="60"  align="center" valign="middle" class="smalltblheading">Condition</td>
  <td width="65"  align="center" valign="middle" class="smalltblheading">Pack</td>
  <td width="69"  align="center" valign="middle" class="smalltblheading">Pack Sales Return</td>
  <td width="66"  align="center" valign="middle" class="smalltblheading">Total</td>
  <td width="47" align="center" valign="middle" class="smalltblheading">Raw</td>
  <td width="66"  align="center" valign="middle" class="smalltblheading">Condition</td>
  <td width="52"  align="center" valign="middle" class="smalltblheading">Pack</td>
  <td width="58"  align="center" valign="middle" class="smalltblheading">Total</td>
  <td width="64"  align="center" valign="middle" class="smalltblheading">Allocated</td>
</tr>
<?php
$totrnob=0; $totrqty=0; $totcnob=0; $totcqty=0; $totpnob=0; $totpnomp=0; $totpqty=0; $ccnt=0; $tqty=0; $totsrqty=0; $totrqok=0; $totrqut=0;  
$totcqok=0; $totcqut=0; $totpqok=0; $totpqut=0; $totsrqok=0; $totsrqut=0; $totqok=0; $totqut=0; $totalqt=0; $uftoday=0; $ufasonle=0; $lenotaval=0; $edgrl=0; $edgrm=0; $edgotl=0; $edgotm=0; $ufexpireasonle=0;


$sql_vr=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
$row_vr=mysqli_fetch_array($sql_vr);
							


// Raw Seed Records
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='$stage' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crop."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$variety."' and lotldg_sstage='$stage' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
	while($row_is=mysqli_fetch_array($sql_is))
	{ 
		$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage' order by lotldg_id desc ") or die(mysqli_error($link));
		$row_is1=mysqli_fetch_array($sql_is1); 
		$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
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
					
					/*if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']==" " || $row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']==" " || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']=="NULL")
					{
						$totrqok=$totrqok+$row_issuetbl['lotldg_balqty'];  
					}*/
					if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
					{
						$totrqut=$totrqut+$qt;  
						
						if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT")
						{
							$sql_qc1=mysqli_query($link,"Select max(tid) from tbl_qctest where lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
							$row_qc1=mysqli_fetch_array($sql_qc1);
							
							$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1[0]."' ") or die(mysqli_error($link));
							$row_qc=mysqli_fetch_array($sql_qc);
							
							
							$trdate2=explode("-",$row_qc['srdate']);
							$m=intval($trdate2[1]);
							$de=intval($trdate2[0]);
							$y=intval($trdate2[2]);
							
							$dt=intval($row_vr['expdt']);
							if($dt>0)
							{
								for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
							}
							else
							{$dp1="";}
							
							if($dp1!="")
							{
								$dt=$edate;
								if(strtotime($dp1) >= strtotime($dt))
								{$edgrm=$edgrm+$qt;}
								else
								{$edgrl=$edgrl+$qt;}
							}
						}
						
						if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
						{
							$sql_got1=mysqli_query($link,"Select max(gottest_tid) from tbl_gottest where gottest_lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
							$row_got1=mysqli_fetch_array($sql_got1);
							
							$sql_got=mysqli_query($link,"Select * from tbl_gottest where gottest_tid='".$row_got[0]."' ") or die(mysqli_error($link));
							$row_got=mysqli_fetch_array($sql_got);
							
							
							$trdate2=explode("-",$row_got['gottest_srdate']);
							$m=intval($trdate2[1]);
							$de=intval($trdate2[0]);
							$y=intval($trdate2[2]);
							
							$dt=intval($row_vr['expdtt']);
							if($dt>0)
							{
								for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
							}
							else
							{$dp1="";}
							
							if($dp1!="")
							{
								$dt=$edate;
								if(strtotime($dp1) >= strtotime($dt))
								{$edgotm=$edgotm+$qt;}
								else
								{$edgotl=$edgotl+$qt;}
							}
						}
						
					}
					else
					{
							
						$sql_lem=mysqli_query($link,"Select * from tbl_lemain where le_lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
						$row_lem=mysqli_fetch_array($sql_lem);
						$ledt=$row_lem['le_upto'];
						
						if($ledt!='' && $ledt!='--' && $ledt!='0000-00-00')
						{
							$dt=$edate;
							if(strtotime($ledt) >= strtotime($dt))$ufasonle=$ufasonle+$qt;
							else $ufexpireasonle=$ufexpireasonle+$qt;
							
						}
						else
						{
							$sql_ars=mysqli_query($link,"Select arrival_id from tblarrival_sub where lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
							if($arst=mysqli_num_rows($sql_ars))
							{
								$row_ars=mysqli_fetch_array($sql_ars);
								$sql_arm=mysqli_query($link,"Select arrival_date from tblarrival where arrival_id='".$row_ars['arrival_id']."' ") or die(mysqli_error($link));
								$row_arm=mysqli_fetch_array($sql_arm);
								
								$trdate2=explode("-",$row_arm['arrival_date']);
								$m=intval($trdate2[1]);
								$de=intval($trdate2[0]);
								$y=intval($trdate2[2]);
								
								$dt=intval($row_vr['leduration']);
								if($dt>0)
								{
									for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
								}
								else
								{$dp1="";}
								
								if($dp1!="")
								{//echo $dp1;
									$dt=$edate;//("Y-m-d");
									if(strtotime($dp1) >= strtotime($dt))$ufasonle=$ufasonle+$qt;
									else $ufexpireasonle=$ufexpireasonle+$qt;
								}
								else
								{
									$lenotaval=$lenotaval+$qt;
								}
								//$ledt=$row_vr['le_upto'];
							}
							else
							{
								$lenotaval=$lenotaval+$qt;
							}
						}
					}
					$ccnt++;
				}
			}	
		}
	}
}
if($totrqty < 0)$totrqty=0;
$totrqok=$totrqty-$totrqut;
if($totrqok < 0)$totrqok=0;
if($totrqut < 0)$totrqut=0;

// Condition Seed Records
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_sstage='$stage1' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crop."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$variety."' and lotldg_sstage='$stage1' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
	while($row_is=mysqli_fetch_array($sql_is))
	{ 
		$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage1' order by lotldg_id desc ") or die(mysqli_error($link));
		$row_is1=mysqli_fetch_array($sql_is1); 
		$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
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
					
					/*if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']==" " || $row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']==" " || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']=="NULL")
					{
						$totcqok=$totcqok+$row_issuetbl['lotldg_balqty'];  
					}*/
					if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
					{
						$totcqut=$totcqut+$qt; 
						
						if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT")
						{
							$sql_qc1=mysqli_query($link,"Select max(tid) from tbl_qctest where lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
							$row_qc1=mysqli_fetch_array($sql_qc1);
							
							$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1[0]."' ") or die(mysqli_error($link));
							$row_qc=mysqli_fetch_array($sql_qc);
							
							
							$trdate2=explode("-",$row_qc['srdate']);
							$m=intval($trdate2[1]);
							$de=intval($trdate2[0]);
							$y=intval($trdate2[2]);
							
							$dt=intval($row_vr['expdt']);
							if($dt>0)
							{
								for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
							}
							else
							{$dp1="";}
							
							if($dp1!="")
							{
								$dt=$edate;
								if(strtotime($dp1) >= strtotime($dt))
								{$edgrm=$edgrm+$qt;}
								else
								{$edgrl=$edgrl+$qt;}
							}
						}
						
						if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
						{
							$sql_got1=mysqli_query($link,"Select max(gottest_tid) from tbl_gottest where gottest_lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
							$row_got1=mysqli_fetch_array($sql_got1);
							
							$sql_got=mysqli_query($link,"Select * from tbl_gottest where gottest_tid='".$row_got[0]."' ") or die(mysqli_error($link));
							$row_got=mysqli_fetch_array($sql_got);
							
							
							$trdate2=explode("-",$row_got['gottest_srdate']);
							$m=intval($trdate2[1]);
							$de=intval($trdate2[0]);
							$y=intval($trdate2[2]);
							
							$dt=intval($row_vr['expdtt']);
							if($dt>0)
							{
								for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
							}
							else
							{$dp1="";}
							
							if($dp1!="")
							{
								$dt=$edate;
								if(strtotime($dp1) >= strtotime($dt))
								{$edgotm=$edgotm+$qt;}
								else
								{$edgotl=$edgotl+$qt;}
							}
						} 
					}
					else
					{
							
						$sql_lem=mysqli_query($link,"Select * from tbl_lemain where le_lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
						$row_lem=mysqli_fetch_array($sql_lem);
						$ledt=$row_lem['le_upto'];
						
						if($ledt!='' && $ledt!='--' && $ledt!='0000-00-00')
						{
							$dt=$edate;
							if(strtotime($ledt) >= strtotime($dt))$ufasonle=$ufasonle+$qt;
							else $ufexpireasonle=$ufexpireasonle+$qt;
						}
						else
						{
							$sql_ars=mysqli_query($link,"Select arrival_id from tblarrival_sub where lotno='".$row_arhome['lotldg_lotno']."' ") or die(mysqli_error($link));
							if($arst=mysqli_num_rows($sql_ars))
							{
								$row_ars=mysqli_fetch_array($sql_ars);
								$sql_arm=mysqli_query($link,"Select arrival_date from tblarrival where arrival_id='".$row_ars['arrival_id']."' ") or die(mysqli_error($link));
								$row_arm=mysqli_fetch_array($sql_arm);
								
								$trdate2=explode("-",$row_arm['arrival_date']);
								$m=intval($trdate2[1]);
								$de=intval($trdate2[0]);
								$y=intval($trdate2[2]);
								
								$dt=intval($row_vr['leduration']);
								if($dt>0)
								{
									for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
								}
								else
								{$dp1="";}
								
								if($dp1!="")
								{
									$dt=$edate;//("Y-m-d");
									if(strtotime($dp1) >= strtotime($dt))$ufasonle=$ufasonle+$qt;
									else $ufexpireasonle=$ufexpireasonle+$qt;
								}
								else
								{
									$lenotaval=$lenotaval+$qt;
								}
								//$ledt=$row_vr['le_upto'];
							}
							else
							{
								$lenotaval=$lenotaval+$qt;
							}
						}
					}
					$ccnt++;
				}
			}	
		}
	}
}
if($totcqty < 0)$totcqty=0;
$totcqok=$totcqty-$totcqut;
if($totcqok < 0)$totcqok=0;
if($totcqut < 0)$totcqut=0;

// Pack Seed Records
$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crop."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$variety."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_is=mysqli_fetch_array($sql_is))
	{ 
		$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotno='".$row_arhome['lotno']."' order by lotdgp_id desc ") or die(mysqli_error($link));
		$row_is1=mysqli_fetch_array($sql_is1); 
		$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
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
					
					/*if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']==" " || $row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']==" " || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']=="NULL")
					{
						$totpqok=$totpqok+$row_issuetbl['balqty'];  
					}*/
					if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
					{
						$totpqut=$totpqut+$qt; 
						
						if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT")
						{
							$sql_qc1=mysqli_query($link,"Select max(tid) from tbl_qctest where lotno='".$row_arhome['lotno']."' ") or die(mysqli_error($link));
							$row_qc1=mysqli_fetch_array($sql_qc1);
							
							$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1[0]."' ") or die(mysqli_error($link));
							$row_qc=mysqli_fetch_array($sql_qc);
							
							
							$trdate2=explode("-",$row_qc['srdate']);
							$m=intval($trdate2[1]);
							$de=intval($trdate2[0]);
							$y=intval($trdate2[2]);
							
							$dt=intval($row_vr['expdt']);
							if($dt>0)
							{
								for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
							}
							else
							{$dp1="";}
							
							if($dp1!="")
							{
								$dt=$edate;
								if(strtotime($dp1) >= strtotime($dt))
								{$edgrm=$edgrm+$qt;}
								else
								{$edgrl=$edgrl+$qt;}
							}
						}
						
						if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
						{
							$sql_got1=mysqli_query($link,"Select max(gottest_tid) from tbl_gottest where gottest_lotno='".$row_arhome['lotno']."' ") or die(mysqli_error($link));
							$row_got1=mysqli_fetch_array($sql_got1);
							
							$sql_got=mysqli_query($link,"Select * from tbl_gottest where gottest_tid='".$row_got[0]."' ") or die(mysqli_error($link));
							$row_got=mysqli_fetch_array($sql_got);
							
							
							$trdate2=explode("-",$row_got['gottest_srdate']);
							$m=intval($trdate2[1]);
							$de=intval($trdate2[0]);
							$y=intval($trdate2[2]);
							
							$dt=intval($row_vr['expdtt']);
							if($dt>0)
							{
								for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
							}
							else
							{$dp1="";}
							
							if($dp1!="")
							{
								$dt=$edate;
								if(strtotime($dp1) >= strtotime($dt))
								{$edgotm=$edgotm+$qt;}
								else
								{$edgotl=$edgotl+$qt;}
							}
						} 
					}
					else
					{		
						$sql_lem=mysqli_query($link,"Select * from tbl_lemain where le_lotno='".$row_arhome['lotno']."' ") or die(mysqli_error($link));
						$row_lem=mysqli_fetch_array($sql_lem);
						$ledt=$row_lem['le_upto'];
						
						if($ledt!='' && $ledt!='--' && $ledt!='0000-00-00')
						{
							$dt=$edate;
							if(strtotime($ledt) >= strtotime($dt))$ufasonle=$ufasonle+$qt;
							else $ufexpireasonle=$ufexpireasonle+$qt;
						}
						else
						{
							$sql_ars=mysqli_query($link,"Select arrival_id from tblarrival_sub where lotno='".$row_arhome['lotno']."' ") or die(mysqli_error($link));
							if($arst=mysqli_num_rows($sql_ars))
							{
								$row_ars=mysqli_fetch_array($sql_ars);
								$sql_arm=mysqli_query($link,"Select arrival_date from tblarrival where arrival_id='".$row_ars['arrival_id']."' ") or die(mysqli_error($link));
								$row_arm=mysqli_fetch_array($sql_arm);
								
								$trdate2=explode("-",$row_arm['arrival_date']);
								$m=intval($trdate2[1]);
								$de=intval($trdate2[0]);
								$y=intval($trdate2[2]);
								
								$dt=intval($row_vr['leduration']);
								if($dt>0)
								{
									for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
								}
								else
								{$dp1="";}
								
								if($dp1!="")
								{
									$dt=$edate;//("Y-m-d");
									if(strtotime($dp1) >= strtotime($dt))$ufasonle=$ufasonle+$qt;
									else $ufexpireasonle=$ufexpireasonle+$qt;
								}
								else
								{//echo $row_arhome['lotno']."<br />";
									$lenotaval=$lenotaval+$qt;
								}
								//$ledt=$row_vr['le_upto'];
							}
							else
							{//echo $row_arhome['lotno']."<br />";
								$lenotaval=$lenotaval+$qt;
							}
						}
					}
					$ccnt++;
				}
				
				$totalqt=$totalqt+$row_issuetbl['lotldg_alqtys']; 
			}	
		}
	}
}
if($totpqty < 0)$totpqty=0;
$totpqok=$totpqty-$totpqut;
if($totpqok < 0)$totpqok=0;
if($totpqut < 0)$totpqut=0;
if($totalqt<0)$totalqt=0;	
// Sales Return Seed Records
$sql_arhome=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_crop='".$crop."' and salesrs_variety='".$variety."' and salesrs_rettype='P2P' order by 'salesrs_id' asc") or die(mysqli_error($link));
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
			if($row_arhome['salesrs_qc']!="Fail" && $row_arhome['salesrs_got1']!="Fail")
			{
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
					$sql_is2=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crop."' and lotno='".$row_arhome['salesrs_newlot']."' and lotldg_variety='".$variety."' and trstage='$stage2' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
					while($row_is2=mysqli_fetch_array($sql_is2))
					{ 
						$sql_is12=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is2['subbinid']."' and binid='".$row_is2['binid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotno='".$row_arhome['salesrs_newlot']."' and trstage='$stage2' order by lotdgp_id desc ") or die(mysqli_error($link));
						$row_is12=mysqli_fetch_array($sql_is12); 
						$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is12[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
						$t2=mysqli_num_rows($sql_istbl2);
						if($t2 == 0)
						{
							$totsrqok=$totsrqok+$row_issuetbl['salesrss_qty'];  
						}
					}	
				}*/
				
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
$tqty=$tqty+$totrqty+$totcqty+$totpqty;//+$totsrqty;
$totalokqty=$totqok+$totrqok+$totcqok+$totpqok;//+$totsrqok;
$totalutqty=$totqut+$totrqut+$totcqut+$totpqut+$totsrqut;
$uftoday=$totalokqty-$totalqt;
$alltotalqty=$totalokqty+$totalutqty;
?>
		  
<tr class="Light">
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $alltotalqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalutqty;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $totrqok;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $totcqok;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $totpqok;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $totalokqty;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $totalqt;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $uftoday;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $lenotaval;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $ufasonle;?></td>
	<td  align="center" valign="middle" class="smalltblheading"><?php echo $ufexpireasonle;?></td>
	
</tr>
<?php
}
?>
</table>	
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="318" align="center" valign="middle" class="smalltblheading"></td>
	<td width="312" align="center" valign="middle" class="smalltblheading" >Before <?php echo $edate;?></td>
	<td width="312" align="center" valign="middle" class="smalltblheading" >After <?php echo $edate;?></td>
</tr>
<tr class="Light" height="20">
  <td align="center" valign="middle" class="smalltblheading">Expected Date of Germination Result (EDGR)</td>
  <td align="center" valign="middle" class="smalltblheading"><?php echo $edgrl;?></td>
  <td align="center" valign="middle" class="smalltblheading"><?php echo $edgrm;?></td>
 </tr> 
 <tr class="Dark" height="20">
  <td align="center" valign="middle" class="smalltblheading">Expected Date of GOT Result (EDGOT)</td>
  <td align="center" valign="middle" class="smalltblheading"><?php echo $edgotl;?></td>
  <td align="center" valign="middle" class="smalltblheading"><?php echo $edgotm;?></td>
</tr>
</table><br />
<?php
		
	$upsize="";$upsiz="";
	$sqlrr=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='$crop' order by packtype Asc") or die(mysqli_error($link));
	$totrr=mysqli_num_rows($sqlrr);
	while($rowrr=mysqli_fetch_array($sqlrr))
	{
		$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$rowrr['packtype']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{
			$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$rowrr['packtype']."' and lotno='".$row_arr_home['lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by subbinid") or die(mysqli_error($link));
			$t2=mysqli_num_rows($sql_tbl_sub1);
			while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
			{
				$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$rowrr['packtype']."' and lotno='".$row_arr_home['lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotdgp_id desc") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);

			
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and lotldg_qc!='Fail' and lotldg_got!='Fail' ") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					$up=$rowrr['packtype'];
					if($up!="")
					{
						$up="'$up'";
						if($upsize!="")
							$upsize=$upsize.",".$up;
						else
							$upsize=$up;
							
						if($upsiz!="")
							$upsiz=$upsiz.",".$rowrr['packtype'];
						else
							$upsiz=$rowrr['packtype'];	
					}
				}
			}
		}				
	}
	//echo $upsize;
	$upp=explode(",",$upsiz);
	$upp=array_unique($upp);
	sort($upp);
	//print_r($upp); 
	$uid='';
	foreach($upp as $usp)
	{
		if($usp<>"")
		{
			$upssize=explode(" ",$usp);
			$sql_sel="select * from tblups where ups='".$upssize[0]."' and wt='".$upssize[1]."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			if($row12['uid']!="")
			{
				if($uid!="")
					$uid=$uid.",".$row12['uid'];
				else
					$uid=$row12['uid'];
			}
		}
	}
	
	//echo $uid;
	$upsiz2="";
	$sql_sel="select * from tblups where uid IN ($uid) order by uom Asc";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	while($row12=mysqli_fetch_array($res))
	{
		$ups=$row12['ups']." ".$row12['wt'];
		if($upsiz2!="")
			$upsiz2=$upsiz2.",".$ups;
		else
			$upsiz2=$ups;
	}
	
	//echo $upsiz2."  =  ";
	$upsiz2=$upsiz2.",".$upsiz;
	
	$upp3=explode(",",$upsiz2);
	$upp3=array_unique($upp3);
	sort($upp3);
	$upsiz2=implode(",",$upp3);
	
	
	$crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	$qry="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_qc!='Fail' and lotldg_got!='Fail'  ";

	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	} 
	else
	{
	//$qry.=" and lotldg_crop IN ($cp) ";
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";
//echo $qry."<br/>";
//exit;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<?php
if($tot_arr_home > 0)
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="26" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="126"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Variety</td>
	<?php
	
	$upp2=explode(",",$upsiz2);
	foreach($upp2 as $ups2)
	{
	if($ups2<>"")
	{
	$paktp=explode(" ",$ups2);
	$paktyp=explode(".",$paktp[0]); 
	if($paktyp[1]=="000")
	$ups23=$paktyp[0]." ".$paktp[1];
	else
	$ups23=$ups2;
	?>
	<td width="55"  align="center" valign="middle" class="smalltblheading"><?php echo $ups23;?></td>
	<?php
	}
	}
	?>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Total Qty</td>
</tr>
<?php
$srno=1; $totalbags=0;

while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	if($variety!="ALL")
	{
		$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$variety."' and lotldg_qc!='Fail' and lotldg_got!='Fail'  order by lotdgp_id desc") or die(mysqli_error($link));
	}
	else
	{
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'  order by lotdgp_id desc") or die(mysqli_error($link));	
	}
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$cropn=$row31['cropname'];		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$varietyn=$rowvv['popularname'];
	}
	else
	{
		$varietyn=$row_rr['lotldg_variety'];
	}

	$upsval=""; $i=0; $totalqty=0; $cnt=0;
	$upp2=explode(",",$upsiz2);
				
//echo $upsval."<br>";	
//if($cnt>0)
{
//$totalqty=$totalqty+$totqty; 
//$totalbags=$totalbags+$totnob;
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyn?></td>
<?php
$totqty=0; $totnob=0; 
foreach($upp2 as $ups2)
	{
		if($ups2<>"")
		{	
			//echo $ups2;
			
			$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$ups2."' and lotldg_qc!='Fail' and lotldg_got!='Fail'   order by packtype asc") or die(mysqli_error($link));
			$tot_rr2=mysqli_num_rows($sql_rr2);
			//$row_rr2=mysqli_fetch_array($sql_rr2);
			while($row_rr2=mysqli_fetch_array($sql_rr2))
			{
				$tqty=0; $tnob=0;  
				$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_arr_home=mysqli_fetch_array($sql_arr_home))
				{
					$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotno='".$row_arr_home['lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by subbinid") or die(mysqli_error($link));
					$t2=mysqli_num_rows($sql_tbl_sub1);
					while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
					{
				
						$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotno='".$row_arr_home['lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotdgp_id desc") or die(mysqli_error($link));  
						$row_tbl1=mysqli_fetch_array($sql_tbl1);
	
					
						$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and lotldg_qc!='Fail' and lotldg_got!='Fail' ") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_issuetbl);
						if($t > 0)
						{
							while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
							{ 
								//echo $row_arr_home1['lotldg_crop']." - ".$row_rr['lotldg_variety']." - ".$ups2." - ".$row_arr_home['lotno']."  =  ".$row_issuetbl['lotdgp_id']."<BR>";
								$cnt++;
								$tqty=$tqty+$row_issuetbl['balqty']; 
								$tnob=$tnob+$row_issuetbl['balnomp']; 
								if($tnob<0) $tnob=0;
								if($tqty<0) $tqty=0;
							}
						}
					}
				}
			}
			if($i>0)
				$upsval=$upsval.",".$totqty;
			else
				$upsval=$totqty;
			$i++;
			$totqty=$totqty+$tqty; 
			$totnob=$totnob+$tnob; 
	?>	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty;?></td>
<?php
}
}
?>	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
</tr>
<?php
  $srno++;
}
}
}
//}
//}
//}
?>	
<?php
}
?>
</table>		

<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="30" align="center" valign="top"><a href="usefullstock_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td width="30"></td> <td>
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
