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
	
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$vv= $_REQUEST['txtvariety'];
	$result = $_REQUEST['result'];
	$dotage = $_REQUEST['dotage'];
	$sstage = $_REQUEST['sstage'];
	$durtyp = $_REQUEST['durtyp'];
	$fillagetyp = $_REQUEST['fillagetyp'];
	$totdays = $_REQUEST['totdays'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report QC Test Ageing Status Report</title>
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
var edate=document.frmaddDepartment.edate.value; 
var loc=document.frmaddDepartment.txtcrop.value;
var itemid=document.frmaddDepartment.txtvariety.value;
var result=document.frmaddDepartment.result.value;
var dotage=document.frmaddDepartment.dotage.value;
var sstage=document.frmaddDepartment.sstage.value;
var durtyp=document.frmaddDepartment.durtyp.value;
var fillagetyp=document.frmaddDepartment.fillagetyp.value;
var totdays=document.frmaddDepartment.totdays.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('qc_report_ondtage2.php?txtcrop='+loc+'&txtvariety='+itemid+'&edate='+edate+'&result='+result+'&dotage='+dotage+'&sstage='+sstage+'&durtyp='+durtyp+'&fillagetyp='+fillagetyp+'&totdays='+totdays,'WelCome','top=20,left=80,width=1000,height=970,scrollbars=yes');
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

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="30">&nbsp;QC Test Ageing Status Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
<?php 
 	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$result = $_REQUEST['result'];
	$dotage = $_REQUEST['dotage'];
	$seedstage = $_REQUEST['sstage'];
	$durtyp = $_REQUEST['durtyp'];
	$fillagetyp = $_REQUEST['fillagetyp'];
	$totdays = $_REQUEST['totdays'];
?>	  
	  
	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txtvariety" value="<?php echo $variety;?>" type="hidden"> 
	<input name="txtcrop" value="<?php echo $itemid;?>" type="hidden">  
	<input name="result" value="<?php echo $result;?>" type="hidden">  
	<input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
	<input name="dotage" value="<?php echo $_REQUEST['dotage'];?>" type="hidden"> 
	<input name="sstage" value="<?php echo $_REQUEST['sstage'];?>" type="hidden"> 
	<input name="durtyp" value="<?php echo $_REQUEST['durtyp'];?>" type="hidden"> 
	<input name="fillagetyp" value="<?php echo $_REQUEST['fillagetyp'];?>" type="hidden"> 
	<input name="totdays" value="<?php echo $_REQUEST['totdays'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php	
	$t=split("-", $edate);
	$edate=$t[2]."-".$t[1]."-".$t[0];
	
	$reslt="";
 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	 
	
	$qry="select distinct lotldg_variety from tbl_lot_ldg where lotldg_qctestdate<='".$edate."' and lotldg_crop='".$itemid."' ";
	
	
	if($vv!="ALL")
	{
		$qry.=" and lotldg_variety='".$vv."' ";
	}
	if($result!="ALL")	
	{
		$qry.=" and lotldg_qc='".$result."' ";
		$reslt=" and lotldg_qc='".$result."' ";
	}
	if($seedstage!="ALL")
	{
		$qry.=" and lotldg_sstage='".$seedstage."' ";
		$reslt=" and lotldg_sstage='".$seedstage."' ";
	}
	$qry.=" order by lotldg_variety asc,lotldg_qctestdate asc ";
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	if($durtyp=="dsel")
	{
		$durations="ALL";
		if($dotage=="less45")
		$durations="Less than 45 days";
		if($dotage=="45-90")
		$durations="In-between 45 to 90 days";
		if($dotage=="more90")
		$durations="More than 90 days";
	}
	else if($durtyp=="dfill")
	{
		if($fillagetyp=="less")
		$durations="Less than $totdays days";
		if($fillagetyp=="equalto")
		$durations="Equal to $totdays days";
		if($fillagetyp=="more")
		$durations="More than $totdays days";
	}
	else
	{
		$durations="";
	}
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="970" style="border-collapse:collapse">
<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">QC Test Ageing Status Report as on Date: <?php echo $_GET['edate'];?></td>
</tr>
<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Duration since last QC Test: <?php echo $durations;?></td>
</tr>
</table>
<?php
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
	$row_dept=mysqli_fetch_array($quer2);
	$cropname=$row_dept['cropname'];
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home1['lotldg_variety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	$tt=$rowvv['popularname'];
	$tot=mysqli_num_rows($quer3);	
	if($tot==0)
	{
		$vvrt=$vv;
	}
	else
	{
		$vvrt=$tt;
	}
	$cont=0;
	$sql_arr_home244=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_qctestdate<='$edate' and lotldg_crop='".$itemid."'  and lotldg_variety='".$row_arr_home1['lotldg_variety']."' $reslt order by lotldg_variety asc, lotldg_qctestdate asc ") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_arr_home244);
	while($row_arr_home244=mysqli_fetch_array($sql_arr_home244))
	{
		//if($seedstage!="Pack")
		{
			$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home244['lotldg_lotno']."' order by lotldg_subbinid") or die(mysqli_error($link));
			$t=mysqli_num_rows($sql_tbl_sub1);
			while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
			{$total_tbl=0;
				$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home244['lotldg_lotno']."'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
				
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 ")or die(mysqli_error($link));
				$total_tbl=mysqli_num_rows($sql1);
				if($total_tbl > 0)
				{
					$flg=0;$qty=0;
					$row_tbl_sub=mysqli_fetch_array($sql1);
					$qty=$row_tbl_sub['lotldg_balqty'];
					$qcresult=$row_tbl_sub['lotldg_qc'];
					if($result!="ALL" && $result!=$qcresult)$flg++;	
					if($qcresult=="NUT")$flg++;	
					if(($qcresult=="OK") && $qty==0)$flg++;
					if($flg==0){$cont++;}
					
				}
			}
		}
		//else
		{
			$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$row_arr_home244['lotldg_lotno']."' order by subbinid") or die(mysqli_error($link));
			$t=mysqli_num_rows($sql_tbl_sub1);
			while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
			{$total_tbl=0;
				$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotno='".$row_arr_home244['lotldg_lotno']."'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
				
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 ")or die(mysqli_error($link));
				$total_tbl=mysqli_num_rows($sql1);
				if($total_tbl > 0)
				{
					$flg=0;$qty=0;
					$row_tbl_sub=mysqli_fetch_array($sql1);
					$qty=$row_tbl_sub['balqty'];
					$qcresult=$row_tbl_sub['lotldg_qc'];
					if($result!="ALL" && $result!=$qcresult)$flg++;	
					if($qcresult=="NUT")$flg++;	
					if(($qcresult=="OK") && $qty==0)$flg++;
					if($flg==0){$cont++;}
				}
			}
		}
		
	}

if($cont > 0)
{
$srno=1; $cnt=0;
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="970" style="border-collapse:collapse">
<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">&nbsp;&nbsp;Crop: <?php echo $cropname;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vvrt;?>&nbsp;&nbsp;</td>
</tr>
</table>
  
<table  border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="19" align="center" valign="middle" class="smalltblheading">#</td>
	<!--<td width="82"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="153"  align="center" valign="middle" class="smalltblheading">Variety</td>-->
	<td width="120"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="60"  align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Qty</td>
	<!--<td width="68"  align="center" valign="middle" class="smalltblheading">Stage</td>
	<td width="54" align="center" valign="middle" class="smalltblheading">PP</td>
	<td width="61" align="center" valign="middle" class="smalltblheading" >Moist %</td>-->
	<td width="55" align="center" valign="middle" class="smalltblheading" >Germ %</td>
	<td width="75" align="center" valign="middle" class="smalltblheading">DOT</td>
	<td width="55" align="center" valign="middle" class="smalltblheading">Days since DoT</td>
	<td width="70" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="75" align="center" valign="middle" class="smalltblheading">DOGR</td>
	<td width="90" align="center" valign="middle" class="smalltblheading">GOT Status</td>
	<td width="257" align="center" valign="middle" class="smalltblheading">SLOC</td>
</tr>
<?php
$sql_arr_home2=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_qctestdate<='$edate' and lotldg_crop='".$itemid."'  and lotldg_variety='".$row_arr_home1['lotldg_variety']."' $reslt order by lotldg_variety asc, lotldg_qctestdate asc ") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{

$sql_arr_home3=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where lotldg_qctestdate<='".$edate."' and lotldg_crop='".$itemid."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_lotno='".$row_arr_home2['lotldg_lotno']."' $reslt order by lotldg_variety asc, lotldg_qctestdate asc  ") or die(mysqli_error($link));
$row_arr_home3=mysqli_fetch_array($sql_arr_home3);

$sql_arr_home=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_arr_home3[0]."'") or die(mysqli_error($link));

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_qctestdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['lotldg_id'];
	
//echo $row_arr_home2['lotno']."<br />";	
	
	$flg=0;		
	$sups=0; $sqty=0; $sstage=""; $sloc="";
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home2['lotldg_lotno']."'  order by lotldg_subbinid") or die(mysqli_error($link));
if(	 $t=mysqli_num_rows($sql_tbl_sub1) > 0)
{
	while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{	 
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home2['lotldg_lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo "  ".$row_tbl1[0]."  ";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);

$slups=0; $slqty=0;
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$row_tbl_sub['lotldg_balbags'];
	$slqty=$row_tbl_sub['lotldg_balqty'];
	
	$sups=$sups+$row_tbl_sub['lotldg_balbags'];
	$sqty=$sqty+$row_tbl_sub['lotldg_balqty'];
	
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	if($row_tbl_sub['lotldg_got']!="" && $row_tbl_sub['lotldg_got']!="NULL" && $row_tbl_sub['lotldg_got']!=" ")
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	else
	$gotresult=$gorr[0]." ".$gorr[1];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_tbl_sub['lotldg_balbags'];
 $slqty=$row_tbl_sub['lotldg_balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

$lotno=$row_arr_home['lotldg_lotno'];
$sstage=$row_arr_home['lotldg_sstage'];
if($got=="")
$got=$row_arr_home['lotldg_moisture'];
if($stage=="")
$stage=$row_arr_home['lotldg_gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['lotldg_qc'];

//echo $slups;


		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotldg_crop'];
		}
		else
		{
		 $crop=$row_arr_home['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotldg_variety'];
		}
		else
		{
		$variety=$row_arr_home['lotldg_variety'];	
		}
		
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
}	
}
}
else
{
	$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$row_arr_home2['lotldg_lotno']."'  order by subbinid") or die(mysqli_error($link));
	while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{	 
	
	$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotno='".$row_arr_home2['lotldg_lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo "  ".$row_tbl1[0]."  ";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);

$slups=0; $slqty=0;
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$row_tbl_sub['balnop'];
	$slqty=$row_tbl_sub['balqty'];
	
	$sups=$sups+$row_tbl_sub['balnop'];
	$sqty=$sqty+$row_tbl_sub['balqty'];
	
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	if($row_tbl_sub['lotldg_got']!="" && $row_tbl_sub['lotldg_got']!="NULL" && $row_tbl_sub['lotldg_got']!=" ")
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	else
	$gotresult=$gorr[0]." ".$gorr[1];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['binid']."' and whid='".$row_tbl_sub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['subbinid']."' and binid='".$row_tbl_sub['binid']."' and whid='".$row_tbl_sub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_tbl_sub['balnop'];
 $slqty=$row_tbl_sub['balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

$lotno=$row_arr_home['lotldg_lotno'];
$sstage=$row_arr_home['trstage'];
if($got=="")
$got=$row_arr_home['lotldg_moisture'];
if($stage=="")
$stage=$row_arr_home['lotldg_gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['lotldg_qc'];

//echo $slups;


		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotldg_crop'];
		}
		else
		{
		 $crop=$row_arr_home['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotldg_variety'];
		}
		else
		{
		$variety=$row_arr_home['lotldg_variety'];	
		}
		
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
}	
}
}
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['lotldg_variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['lotldg_variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  

    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['lotldg_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

if($result!="ALL" && $result!=$qcresult)$flg++;	
if($qcresult=="NUT")$flg++;	
if(($qcresult=="OK" || $qcresult=="Fail") && $qty==0)$flg++;

$trdate6=split("-", $edate);
$tryear=$trdate6[0];
$trmonth=$trdate6[1];
$trday=$trdate6[2];
$trdate240=$tryear."-".$trmonth."-".$trday;

if($durtyp=="dfill")
{
	if($fillagetyp=="less")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']<$dt2)$flg++;
		}
	}
	else if($fillagetyp=="equalto")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']!=$dt2)$flg++;
		}
	}
	else if($fillagetyp=="more")
	{
		$dt=$totdays+1;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']>$dt2)$flg++;
		}
	}
	else
	{
	}
}
else
{
	if($dotage!="ALL" && $dotage=="less45")
	{
	$dt=45;
	if($trdate!="")
	{
	$m=$trmonth;
	$de=$trday;
	$y=$tryear;
	$dt22=$dt;
	if($dt!="")
	{
	for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
	}
	else
	$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
	if($row_arr_home['lotldg_qctestdate']<=$dt2)$flg++;
	}
	}
	else if($dotage!="ALL" && $dotage=="45-90")
	{
		$dt=45;
		$dt6=90;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		if($trdate!="")
		{
			$trdate5=split("-", $edate);
			$tryear5=$trdate5[0];
			$trmonth5=$trdate5[1];
			$trday5=$trdate5[2];
			
			$m5=$trmonth5;
			$de5=$trday5;
			$y5=$tryear5;
			$dt222=$dt6;
			if($dt6!="")
			{
				for($j=1; $j<$dt222; $j++) { $dt24=date('Y-m-d',mktime(0,0,0,$m5,($de5-$j),$y5)); } 
			}
			else
			$dt24="";
		}
		//echo $dt2;
		if($dt2!="" && $dt24!="")
		{
			if($row_arr_home['lotldg_qctestdate']>=$dt2 || $row_arr_home['lotldg_qctestdate']<$dt24)$flg++;
		}
	}
	else if($dotage!="ALL" && $dotage=="more90")
	{
		$dt=90;
		if($trdate!="")
		{
			$m=$trmonth;
			$de=$trday;
			$y=$tryear;
			$dt22=$dt;
			if($dt!="")
			{
				for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
			}
			else
			$dt2="";
		}
		//echo $dt2;
		if($dt2!="")
		{
			if($row_arr_home['lotldg_qctestdate']>=$dt2)$flg++;
		}
	}
	else
	{
	}
}
//echo $dt2;
$diff = abs(strtotime($trdate240) - strtotime($row_arr_home['lotldg_qctestdate']));

//$years = floor($diff / (365*60*60*24));
//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor($diff / (60*60*24));

//printf("%d days\n", $days);
//echo $row_arr_home['lotldg_qctestdate']."  -  ".$dt2."  -  ".$dt24."<br />";
$days=$days;
$gotres=split(" ", $gotresult);
if($gotres[1]=="Fail")$flg=1;
if($flg==0)
{$cnt++;

if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<!--<td width="82" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname']?></td>
	<td width="153" align="center" valign="middle" class="smalltbltext"><?php echo $vv?></td>-->
	<td width="120" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<!--<td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $sstage;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>-->
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $days;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<!--<td width="82" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname']?></td>
	<td width="153" align="center" valign="middle" class="smalltbltext"><?php echo $vv?></td>-->
	<td width="120" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<!--<td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $sstage;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>-->
	<td width="55" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $days;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
</tr>
<?php
}
$srno=$srno+1;
//}
}
}
}
if($cnt==0)
{
?>
<tr  height="25"><td colspan="15" align="center" class="subheading">No Records found for selected criteria.</td></tr>
<?php
}
?>
</table>
<?php
}
}
}
?>
			
<table width="970" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="qc_report_ondtage.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
