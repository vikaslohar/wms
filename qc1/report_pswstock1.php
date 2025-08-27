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
		$slchk = $_REQUEST['slchk'];
		$txtupsdc = $_REQUEST['txtupsdc'];
		$txtqcsts = $_REQUEST['txtqcsts'];
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw - Report - Pack Seed Stock Report</title>
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var txtqcsts=document.frmaddDepartment.txtqcsts.value;
var txtupsdc=document.frmaddDepartment.txtupsdc.value;
winHandle=window.open('report_pswstock2.php?slchk='+slchk+'&txtcrop='+itemid+'&txtvariety='+vv+'&txtupsdc='+txtupsdc+'&txtqcsts='+txtqcsts,'WelCome','top=20,left=80,width=950,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
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
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <?php
		
	$crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where balqty > 0 ";

	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtupsdc!="ALL")
	{	
		$qry.=" and packtype='$txtupsdc' ";
	}
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">Pack Seed Stock Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="slchk" value="<?php echo $slchk;?>" type="hidden"> 
		<input name="txtupsdc" value="<?php echo $txtupsdc;?>" type="hidden">
		<input name="txtqcsts" value="<?php echo $txtqcsts;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
  
<?php

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
if($txtupsdc!="ALL")
{
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and packtype='".$txtupsdc."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' order by lotdgp_id desc") or die(mysqli_error($link));
}
else
{
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' order by lotdgp_id desc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $crop=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		}
		else
		{
		$variety=$row_rr['lotldg_variety'];
		}
		$ccnt=0;
if($txtupsdc!="ALL")
{
$sql_rr24=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$txtupsdc."' order by packtype asc") or die(mysqli_error($link));
}
else
{
$sql_rr24=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' order by packtype asc") or die(mysqli_error($link));
}
$tot_rr24=mysqli_num_rows($sql_rr24);
while($row_rr24=mysqli_fetch_array($sql_rr24))
{
		
$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr24['packtype']."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotno='".$row_arhome['lotno']."' and packtype='".$row_rr24['packtype']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and whid='".$row_is['whid']."' and lotno='".$row_arhome['lotno']."' and packtype='".$row_rr24['packtype']."' order by lotdgp_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$ccnt++;
}
}
}
}
//echo $ccnt;
if($ccnt > 0)
{
// 		Table code for crop & variety wise lot numbers
?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?>&nbsp;&nbsp;|&nbsp;&nbsp;UPS: <?php echo $txtupsdc;?>&nbsp;&nbsp;|&nbsp;&nbsp;Pack QC Status: <?php echo $txtqcsts;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="26" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="126"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Size</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">NoMP</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="60"  align="center" valign="middle" class="smalltblheading">Pack QC status</td>
	<td width="70" align="center" valign="middle" class="smalltblheading">Pack DoT</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">Latest QC status</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Latest DoT</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Germ %</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">DoV</td>
	<td width="57"  align="center" valign="middle" class="smalltblheading">Validity (in Days)</td>
	<td width="190"  align="center" valign="middle" class="smalltblheading">SLOC</td>
</tr>

<?php
$srno=0; $totalbags=0; $totalqty=0;
if($txtupsdc!="ALL")
{
$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$txtupsdc."' order by packtype asc") or die(mysqli_error($link));
}
else
{
$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' order by packtype asc") or die(mysqli_error($link));
}
$tot_rr2=mysqli_num_rows($sql_rr2);
while($row_rr2=mysqli_fetch_array($sql_rr2))
{
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0; $cnt=0; $oqcsts=""; $odot=""; $txtdov=""; $validity="";
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $txtdot="";	$sloc="";
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where  lotno='".$row_arr_home['lotno']."' and packtype='".$row_rr2['packtype']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and packtype='".$row_rr2['packtype']."'and lotno='".$row_arr_home['lotno']."' order by lotdgp_id asc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_arr_home['lotno']."  =  ".$row_issuetbl['lotdgp_id']."<BR>";
  $cnt++;
	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['balnomp']; 
	if($totnob<0) $totnob=0;
	if($totqty<0) $totqty=0;

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	
	$upspacktype=$row_issuetbl['packtype'];
	$upspacktype=trim($upspacktype);
	$packtp=explode(" ",$upspacktype);
	$packt=trim($packtp[0]);
	$packtyp=explode(".",$packt); 
				
	if($packtyp[1]=="000")
	$upssize=$packtyp[0]." ".$packtp[1];
	
	if($row_issuetbl['lotldg_srflg'] > 0)
	{
		if($totsst!="")$totsst=$totsst."/"."S";
		else
		$totsst="S";
	}
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")$txtdot="";
	
	if($txtdov=="")
	{
	$rdate=$row_issuetbl['lotldg_valupto'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdov=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdov=="00-00-0000" || $txtdov=="--")$txtdov="";
	
	if($validity=="")
	{
	$diff = abs(strtotime($row_issuetbl['lotldg_valupto']) - strtotime($dt));
	$validity = floor($diff / (60*60*24));
	}
	
	if($totgemp==0 || $totgemp=="") $totgemp="";
	


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_issuetbl['balnomp'];
$slqty=$row_issuetbl['balqty'];
$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($slups<0) $slups=0;
if($slqty<0) $slqty=0;
	
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
}
}

$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where pnpslipsub_plotno='".$row_arr_home['lotno']."' ") or die(mysqli_error($link));
$tot_pnp=mysqli_num_rows($sql_pnp);
$row_pnp=mysqli_fetch_array($sql_pnp);
$oqcsts=$row_pnp['pnpslipsub_qcdttype'];
if($oqcsts=="DOT" || $oqcsts=="DoT")$oqcsts="OK";

$rdate=$row_pnp['pnpslipsub_qcdot'];
$ryear=substr($rdate,0,4);
$rmonth=substr($rdate,5,2);
$rday=substr($rdate,8,2);
$odot=$rday."-".$rmonth."-".$ryear;

$sql_pnp24=mysqli_query($link,"Select MAX(rv_id) from tbl_revalidate where rv_newlot='".$row_arr_home['lotno']."' ") or die(mysqli_error($link));
$tot_pnp24=mysqli_num_rows($sql_pnp24);
$row_pnp24=mysqli_fetch_array($sql_pnp24);

$sql_pnp2=mysqli_query($link,"Select * from tbl_revalidate where rv_newlot='".$row_arr_home['lotno']."' and rv_id='".$row_pnp24[0]."' ") or die(mysqli_error($link));
$tot_pnp2=mysqli_num_rows($sql_pnp2);
$row_pnp2=mysqli_fetch_array($sql_pnp2);
if($tot_pnp2>0)
{
	$oqcsts="RV";
	
	$rdate=$row_pnp2['rv_dot'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$odot=$rday."-".$rmonth."-".$ryear;
}	
if($odot=="00-00-0000" || $odot=="--")	$odot="";

if($txtqcsts!="Both")
{
	if($txtqcsts=="DoT" && $oqcsts=="DoSF")$cnt=0;
	if($txtqcsts=="DoSF" && ($oqcsts=="DOT" || $oqcsts=="DoT"))$cnt=0;
	if($txtqcsts=="DoSF" && $oqcsts=="RV")$cnt=0;
}
//echo $cnt;
if($cnt>0)
{
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($totqc=="RT"){$txtdot=""; $totgemp="";}

if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqcsts;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $odot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdov;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $validity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $oqcsts;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $odot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdov;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $validity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
</tr>
<?php
}
}
else{$srno--;}
}
}
}
}

if($ccnt > 0)
{
?>
<tr class="Dark">
			<td align="center" valign="middle" class="tblheading" colspan="3">Total</td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totalbags?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
			<td align="center" valign="middle" class="tblheading" colspan="8">&nbsp;</td>
</tr>
<?php
}
?>
</table>			
<br />
<?php
}
}
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<tr height="25" >
	<td align="right" class="smalltbltext" style="color:#303918;"><font color="#FF0000">* </font>Validity is calculated as on Report generation Date <?php echo date("d-m-Y");?>&nbsp;&nbsp;</td>
</tr>
</table>
<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="30" align="center" valign="top"><a href="report_pswstock.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
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
