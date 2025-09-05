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
	
	//$tp="Fresh Seed with PDN";	
	if(isset($_REQUEST['p_id']))
	{
		$pid = $_REQUEST['p_id'];
	}
	if(isset($_REQUEST['optype']))
	{
		$optype = $_REQUEST['optype'];
	}
	else
	{
		$optype='';
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
<title>Dispatch - Transaction - Dispatch - Allocation Type - Select output</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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

<script language="JavaScript">
function mySubmit()
{ 
	if(document.frmaddDepartment.fet1.value == "")
	{
	alert("Please select Output Type");
	return false;
	}
	return true;	 
}
function test1(fet11)
{
	if (fet11!="")
	{
	document.frmaddDepartment.fet1.value=fet11;
	}
}	

function openslocpopprint3(val1)
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('loadingslipalc.php?itmid='+val1,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocpopprint2(val1)
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('gatepassalc.php?itmid='+val1,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocpopprint1(subid)
{
winHandle=window.open('psdnalc.php?itmid='+subid,'WelCome','top=20, left=50, width=850, height=850, scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//}
}
function openstspopprint1(subid,crp,ver,lot,relno,dot)
{
winHandle=window.open('statement1.php?itmid='+subid+'&crop='+crp+'&variety='+ver+'&lotno='+lot+'&relno='+relno+'&dot='+dot,'WelCome','top=20, left=50, width=850, height=850, scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//}
}
function openstspopprint2(subid,crp,ver,lot,relno,dot)
{
winHandle=window.open('statement2.php?itmid='+subid+'&crop='+crp+'&variety='+ver+'&lotno='+lot+'&relno='+relno+'&ups='+dot,'WelCome','top=20, left=50, width=850, height=850, scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//}
}
function printmmcslip(barcval,trid)
{
	//var trid=document.frmaddDepartment.txtitem.value;
	winHandle=window.open('getuser_prtmmcbar.php?tp='+barcval+'&mtrid='+trid,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
</script>

<body>


<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: Dispatch - Allocation Type - Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
   <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
 
 <br />

<table align="center" border="0" width="500" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">Transaction Outputs</td>
</tr>
</table>
<?php

$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['disp_id'];
$partystate=$row_tbl['disp_state'];
//Maharashtra
$ptype=$row_tbl['disp_partytype'];

//echo $row_tbl['disp_party'];
			
$sqlcode27="SELECT dalloc_id FROM tbl_dalloc where plantcode='".$plantcode."' and  dalloc_party='".$row_tbl['disp_party']."' ORDER BY dalloc_id DESC";
$rescode27=mysqli_query($link,$sqlcode27)or die(mysqli_error($link));
$t27=mysqli_num_rows($rescode27);
$rowcode27=mysqli_fetch_array($rescode27);
$dalcid2=$rowcode27['dalloc_id'];

if($ptype=="Dealer" || $ptype=="Export Buyer")
$ntitle="Pack Seed Dispatch Note (PSDN)";
if($ptype=="C&F" || $ptype=="Branch")
$ntitle="Stock Transfer Dispatch Note (STDN)";
?>
<table align="center" border="1" width="500" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="smalltblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint3(<?php echo $tid;?>);">Loading Slip</a></td>
</tr>
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="smalltblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint1(<?php echo $tid;?>);"><?php echo $ntitle;?></a></td>
</tr>
<tr class="Light" height="25">

    <td align="center" valign="middle" class="smalltblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint2(<?php echo $tid;?>);">Gate Pass</a>&nbsp;</td>
</tr>
</table>
<br />
<table align="center" border="1" width="500" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="15" align="center" class="tblheading">MMC Packaging List</td>
</tr>
<?php
	$sq_mmc2=mysqli_query($link,"Select distinct dmmc_barcode from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$dalcid2' and dmmc_flg=1") or die(mysqli_error($link));
	$tot_mmc=mysqli_num_rows($sq_mmc2);
	$srmc=0;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcode</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Net Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Gross Wt.</td>
<!--	<td width="275" align="center"  valign="middle" class="smalltblheading">SLOC</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Lot No.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
-->	<td width="275" align="center"  valign="middle" class="smalltblheading">Status</td>
</tr>
<?php
if($tot_mmc>0)
{
while($row_mmc2=mysqli_fetch_array($sq_mmc2))
{
$mmcbrcd="";$mmcwt="";$mmcgrswt="";$mmccrp="";$mmcver="";$mmcltn="";$mmcup="";$mmcnop="";$mmcqtt="";$mmcsloc="";$mmcsts="";
$sq_mmc=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$dalcid2' and dmmc_flg=1 and dmmc_barcode='".$row_mmc2['dmmc_barcode']."'") or die(mysqli_error($link));
while($row_mmc=mysqli_fetch_array($sq_mmc))
{
$mmcbrcd=$row_mmc['dmmc_barcode'];
$mmcwt=$row_mmc['dmmc_wtmp'];
$mmcgrswt=$row_mmc['dmmc_grosswt'];

$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_mmc['dmmc_ewh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."' and  whid='".$row_mmc['dmmc_ewh']."' and binid='".$row_mmc['dmmc_ebin']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);

$mmcsloc=$noticia_whd1['perticulars']."/".$noticia_bing1['binname'];


$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_id='".$row_mmc['dallocs_id']."' and dalloc_id='".$row_mmc['dalloc_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dallocs_crop'];
else
$mmccrp=$ro2['dallocs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dallocs_variety'];
else
$mmcver=$ro2['dallocs_variety'];

if($mmcltn!="")	
$mmcltn=$mmcltn."<br />".$row_mmc['dmmc_lotno'];
else
$mmcltn=$row_mmc['dmmc_lotno'];

if($mmcup!="")	
$mmcup=$mmcup."<br />".$row_mmc['dmmc_eups'];
else
$mmcup=$row_mmc['dmmc_eups'];

if($mmcnop!="")	
$mmcnop=$mmcnop."<br />".$row_mmc['dmmc_nolp'];
else
$mmcnop=$row_mmc['dmmc_nolp'];

if($mmcqtt!="")	
$mmcqtt=$mmcqtt."<br />".$row_mmc['dmmc_qty'];
else
$mmcqtt=$row_mmc['dmmc_qty'];

$mmcsts="MMC Slip";
}
$srmc++;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $srmc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcbrcd;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcwt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcgrswt;?></td>
	<!--<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsloc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmccrp;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcver;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcltn;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcup;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcnop;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcqtt;?></td>-->
	<td width="275" align="center"  valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="printmmcslip('<?php echo $mmcbrcd;?>','<?php echo $dalcid2;?>');"><?php echo $mmcsts;?></a></td>
</tr>
<?php
}
}
?>
</table>
<br />
<?php
if($partystate=="Maharashtra" || $partystate=="Madhya Pradesh")
{
?>
<table align="center" border="0" width="500" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">State: <?php echo $partystate;?></td>
</tr>
</table>
<table align="center" border="1" width="500" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="25">
    <td width="91" align="center"  valign="middle" class="smalltblheading">Crop</td>
    <td width="141" align="center"  valign="middle" class="smalltblheading">Variety</td>
    <td width="109" align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Outputs</td>
</tr>

<?php
$srno=1;
$sql_arr_home2=mysqli_query($link,"select distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='$tid' and disps_flg=1 order by disps_id asc") or die(mysqli_error($link));
$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
if($tot_arr_home2 >0) 
{ 
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_arr_home=mysqli_query($link,"select * from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='$tid' and disps_flg=1 and disps_variety='".$row_arr_home2['disps_variety']."' order by disps_id asc") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
		if($tot_arr_home >0) 
		{ 
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{
				$sid=$row_arr_home['disps_id'];
				
				$sq2=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
				$totrec=mysqli_num_rows($sq2);
				if($totrec=mysqli_num_rows($sq2) > 0)
				{
					while($ro2=mysqli_fetch_array($sq2))
					{
						$lot2=$ro2['dpss_lotno']; 
						$sq3=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  dpss_lotno='$lot2' and disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
						$ro3=mysqli_fetch_array($sq3);
						
						$crps=$ro3['dpss_crop']; 
						$vers=$ro3['dpss_variety']; 
						$nvers=$row_arr_home['disps_nvariety']; 
						$relno=$ro3['dpss_st1code'];
						$relno2=$ro3['dpss_st2code']; 
						$ups=$ro3['dpss_ups'];
						
						$tdate=$ro3['dpss_dot'];
						$tyear=substr($tdate,0,4);
						$tmonth=substr($tdate,5,2);
						$tday=substr($tdate,8,2);
						$tdate=$tday."-".$tmonth."-".$tyear;
						$dot=$tdate;
						
						$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
						$row_dept5=mysqli_fetch_array($quer5);
						$cps=$row_dept5['cropname'];
						
						$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers' and actstatus='Active'"); 
						$row_dept4=mysqli_fetch_array($quer4);
						$vts=$row_dept4['popularname'];
		
?>
<tr class="Light" height="25">
    <td width="91" align="center"  valign="middle" class="smalltblheading"><?php echo $cps;?></td>
    <td width="141" align="center"  valign="middle" class="smalltblheading"><?php echo $vts;?></td>
    <td width="109" align="center" valign="middle" class="smalltblheading"><?php echo $lot2;?></td>
	<td width="72" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="openstspopprint1(<?php echo $tid;?>,'<?php echo $cps;?>','<?php echo $nvers;?>','<?php echo $lot2;?>','<?php echo $relno;?>','<?php echo $dot;?>');">Statement I</a></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="openstspopprint2(<?php echo $tid;?>,'<?php echo $cps;?>','<?php echo $nvers;?>','<?php echo $lot2;?>','<?php echo $relno2;?>','<?php echo $ups;?>');">Statement II</a></td>
</tr>
<?php
}
}
}
}
}
}
?>
</table>
<?php
}
?>

<table align="center" width="314" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_disppackalc.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;&nbsp;</td>	
</tr>
</table>
</form></td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table><!-- actual page end--->			  
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
