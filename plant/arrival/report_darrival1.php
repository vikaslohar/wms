<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
		
	if(isset($_REQUEST['sdate']))
	{
 		$sdate = $_REQUEST['sdate'];
	}
	if(isset($_REQUEST['edate']))
	{
 		$edate = $_REQUEST['edate'];
	}
	
	if(isset($_REQUEST['typ']))
	{
	  $typ = $_REQUEST['typ'];
	}
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival-Report -Daily Arrival Report</title>
<link href="../../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
var typ=document.frmaddDepartment.typ.value; 
var edate=document.frmaddDepartment.edate.value;
//var ite=document.frmaddDepartment.itemid.value;
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_darrival2.php?sdate='+sdate+'&edate='+edate+'&typ='+typ,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../../include/arr_plant1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Arrival Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
	 <input name="typ" value="<?php echo $typ;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	$sdate = $_REQUEST['sdate'];
	$sdate = $_REQUEST['sdate'];
	$typ = $_REQUEST['typ'];
	
	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
	
	$tdate1=explode("-",$edate);
	$edate=$tdate1[2]."-".$tdate1[1]."-".$tdate1[0];

	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='$typ' and arrival_date >='$sdate' and arrival_date <='$edate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>

<?php
if($tot_arr_home > 0)
{ 
 if($typ=="Fresh Seed with PDN")
{ 
?>  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <!--	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date: <?php echo $_GET['sdate'];?></td>
  	</tr>-->
 <tr height="25" ><?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; }else {$typ;}?>
     <td align="center" class="subheading" style="color:#303918; ">Fresh Seed  Arrival with PDN - Period From: <?php echo $_GET['sdate'];?>  To: <?php echo $_GET['edate'];?></td>
  	</tr></table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="90"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
			<td width="80"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			<td width="105"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
			<td width="61"  align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
			<td width="51"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
			<td width="68" align="center" valign="middle" class="tblheading" rowspan="2">Stage</td>
			<td width="84" align="center" valign="middle" class="tblheading" rowspan="2">Prod. Loc.</td>
		    <td colspan="2" align="center" valign="middle" class="tblheading">Preliminary QC</td>
			<td width="56" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
			<td width="53" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
            <td width="40" align="center" valign="middle" class="tblheading" rowspan="2">Seed Status</td>
			<td width="117" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
</tr>
<tr class="tblsubtitle">
			  <td width="36" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="62" align="center" valign="middle" class="tblheading">Moist %</td>
    </tr>
<?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";$per1="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		if($row_tbl_sub['vchk'] =="Acceptable") { $per="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $per="NAcc";}
		if($per1!="")
		{
		$per1=$per1."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$per1=$row_tbl_sub['moisture'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$loc1=$row_tbl_sub['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>

	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="80" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td width="105" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['balbags'];
 $slqty=$slqty+$row_sloc['balqty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>	
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per1;?></td>
			<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sstatus;?></td>
			<td width="71" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
		 <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="80" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td width="105" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['balbags'];
 $slqty=$slqty+$row_sloc['balqty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
		 	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per1;?></td>
			<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sstatus;?></td>
			<td width="71" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
}
 if($typ=="Trading")
{ 
?>  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  <!--	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date: <?php echo $_GET['sdate'];?></td>
  	</tr>-->
 <tr height="25" ><?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; }else {$typ;}?>
     <td align="center" class="subheading" style="color:#303918; ">Trading Arrival - Period From: <?php echo $_GET['sdate'];?>  To: <?php echo $_GET['edate'];?></td>
  	</tr></table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
			<td width="18" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="81"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
			<td width="101"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			<td width="75"  align="center" valign="middle" class="tblheading" rowspan="2">V. Lot No.</td>
				<td width="95"  align="center" valign="middle" class="tblheading" rowspan="2">Vendor Name</td>
			<td width="108"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
			<td width="46"  align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
			<td width="58"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
			<td width="65" align="center" valign="middle" class="tblheading" rowspan="2">Stage</td>
			 <td colspan="2" align="center" valign="middle" class="tblheading"> QC</td>
			<!--<td width="81" align="center" valign="middle" class="tblheading">Seed Stage</td>
			<td width="69" align="center" valign="middle" class="tblheading" rowspan="2">Moisture %</td>
			<td width="118" align="center" valign="middle" class="tblheading" rowspan="2">Party</td>-->
			<td width="41" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
			<td width="42" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
            <td width="37" align="center" valign="middle" class="tblheading" rowspan="2">Seed Status</td>
			<td width="111" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
</tr>
<tr class="tblsubtitle">
			  <td width="36" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="34" align="center" valign="middle" class="tblheading">Moist %</td>
    </tr>

<?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$vchk="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home['lotvariety']."'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_arr_home['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotvariety'];
		}
		else
		{
		$variety=$row_arr_home['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['sstage'];
		}
		else
		{
		$stage=$row_arr_home['sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$per=$row_tbl_sub['moisture'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_party['business_name'];
		}
		else
		{
		$loc1=$row_party['business_name'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
		if($lotoldlot!="")
		{
		$lotoldlot=$lotoldlot."<br>".$row_tbl_sub['lotoldlot'];
		}
		else
		{
		$lotoldlot=$row_tbl_sub['lotoldlot'];
		}
		/*if($vchk!="")
		{
		$vchk=$vchk."<br>".$row_tbl_sub['vchk'];
		}
		else
		{
		$vchk=$row_tbl_sub['vchk'];
		}*/
		
		if($row_tbl_sub['vchk'] =="Acceptable") { $vchk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vchk="NAcc";}
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="101" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td width="75" align="center" valign="middle" class="smalltbltext"><?php echo $lotoldlot;?></td>
		    <td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $loc1?></td>
         <td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="46" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="65" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

}
?>
         <td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $vchk;?></td>
         <!--<td width="69" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>-->
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
			<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
			  <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $sstatus;?></td>
				<td width="111" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td height="20" align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
			  <td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="101" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td width="75" align="center" valign="middle" class="smalltbltext"><?php echo $lotoldlot;?></td>
		    <td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $loc1?></td>
         <td width="108" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="46" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		  <td width="65" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

}
?>
         <td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $vchk?></td>
         <!--<td width="69" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>-->
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
			<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
			  <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $sstatus;?></td>
				<td width="111" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
}
 if($typ=="StockTransfer Arrival")
{ 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  <!--	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date: <?php echo $_GET['sdate'];?></td>
  	</tr>-->
 <tr height="25" ><?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; }else {$typ;}?>
     <td align="center" class="subheading" style="color:#303918; ">Stock Transfer-Plant - Period From: <?php echo $_GET['sdate'];?>  To: <?php echo $_GET['edate'];?></td>
  	</tr></table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<!--<td width="107"  align="center" valign="middle" class="tblheading">Date of Arrival</td>-->
	<td width="98" align="center" valign="middle" class="tblheading" rowspan="2">Stock Transfer From Plant </td>
    <td width="48"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
    <td width="60"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	   
    <td width="93"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
    <td width="54"  align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
    <td width="58"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
	<td width="41" align="center" valign="middle" class="tblheading" rowspan="2"> Stage</td>
 <td colspan="3" align="center" valign="middle" class="tblheading">QC</td>
    <td width="43" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
    <td width="64"  align="center" valign="middle" class="tblheading" rowspan="2">DoT</td>
    <td width="54" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
    <td width="66" align="center" valign="middle" class="tblheading" rowspan="2">DoGR</td>
	<td width="106" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
  </tr>
  <tr class="tblsubtitle">
			  <td width="32" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="40" align="center" valign="middle" class="tblheading">Moist %</td>
			  <td width="42" align="center" valign="middle" class="tblheading">Germ %</td>
  </tr>

  <?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $got1="";$qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$moist="";$vk="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotvariety']."'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		$tdate12=$row_tbl_sub['testd'];
	$tyear1=substr($tdate12,0,4);
	$tmonth1=substr($tdate12,5,2);
	$tday1=substr($tdate12,8,2);
	$tdate12=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate13=$row_tbl_sub['gotdate'];
	$tyear1=substr($tdate13,0,4);
	$tmonth1=substr($tdate13,5,2);
	$tday1=substr($tdate13,8,2);
	$tdate13=$tday1."-".$tmonth1."-".$tyear1;
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$qc=$row_tbl_sub['gemp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($got1!="")
		{
		$got1=$got1."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got1=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		
		if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$moist=$row_tbl_sub['moisture'];
		}
		/*if($vk!="")
		{
		$vk=$vk."<br>".$row_tbl_sub['vchk'];
		}
		else
		{
		$vk=$row_tbl_sub['vchk'];
		}*/
		if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_party['business_name'];
		}
		else
		{
		$loc1=$row_party['business_name'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
		if($lotoldlot!="")
		{
		$lotoldlot=$lotoldlot."<br>".$row_tbl_sub['lotoldlot'];
		}
		else
		{
		$lotoldlot=$row_tbl_sub['lotoldlot'];
		}
		
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
<!--	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $tdate13?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="93" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
  <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
  <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
    <td width="42" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
			 <td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $tdate12?></td>
			 <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $got?> <?php echo $got1?></td>
    <td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $tdate13?> </td> 
	<td width="106" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>

  <?php
}
else
{
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<!--/*<td width="107" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>*/-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="93" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
       <td width="42" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
     	 	    <td align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
				 <td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $tdate12?></td>
			 <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $got?> <?php echo $got1?></td>
    <td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $tdate13?>  </td>
	<td width="106" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>
  <?php
}
$srno=$srno+1;
}
}
?>
</table>

<?php
}
 if($typ=="Unidentified")
{ 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  <!--	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date: <?php echo $_GET['sdate'];?></td>
  	</tr>-->
 <tr height="25" ><?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; }else {$typ;}?>
     <td align="center" class="subheading" style="color:#303918; ">Unidentified Arrival - Period From: <?php echo $_GET['sdate'];?>  To: <?php echo $_GET['edate'];?></td>
  	</tr></table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="19" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<!--<td width="107"  align="center" valign="middle" class="tblheading">Date of Arrival</td>-->
	<td width="104" align="center" valign="middle" class="tblheading" rowspan="2">Arrived In</td>
    <td width="101" align="center" valign="middle" class="tblheading" rowspan="2">Arrived From</td>
    <td width="81"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
    <td width="133"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	   
    <td width="90"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
    <td width="31"  align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
    <td width="45"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
	<td width="43" align="center" valign="middle" class="tblheading" rowspan="2"> Stage</td>
 <td colspan="2" align="center" valign="middle" class="tblheading">Prel. QC</td>
    <td width="39" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
    <td width="52" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
    <td width="105" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
  </tr>
  <tr class="tblsubtitle">
			  <td width="29" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="48" align="center" valign="middle" class="tblheading">Moist %</td>
			  <!--<td width="41" align="center" valign="middle" class="tblheading">Germ %</td>-->
  </tr>

  <?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $got1="";$qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$moist="";$vk=""; $location="";
$aq=explode(".",$row_tbl_sub['qty']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['qty'];}

$an=explode(".",$row_tbl_sub['qty1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['qty1'];}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotvariety']."'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl_sub['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		$tdate12=$row_tbl_sub['testd'];
	$tyear1=substr($tdate12,0,4);
	$tmonth1=substr($tdate12,5,2);
	$tday1=substr($tdate12,8,2);
	$tdate12=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate13=$row_tbl_sub['gotdate'];
	$tyear1=substr($tdate13,0,4);
	$tmonth1=substr($tdate13,5,2);
	$tday1=substr($tdate13,8,2);
	$tdate13=$tday1."-".$tmonth1."-".$tyear1;
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$qc=$row_tbl_sub['gemp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$got=$row_tbl_sub['qc'];
		}
		if($got1!="")
		{
		$got1=$got1."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got1=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		
		if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$moist=$row_tbl_sub['moisture'];
		}
		/*if($vk!="")
		{
		$vk=$vk."<br>".$row_tbl_sub['vchk'];
		}
		else
		{
		$vk=$row_tbl_sub['vchk'];
		}*/
		if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}
	
		$loc1=$row_arr_home['type'];
		if($loc1=="Fresh Seed Arrival with PDN")
		{
		$location=$row_tbl_sub['ploc'];
		}
		else
		{
		if($row_party['city']!="")
		$location=$row_party['city'];
		else
		$location=$row_party['state'];
		}
		
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
		if($lotoldlot!="")
		{
		$lotoldlot=$lotoldlot."<br>".$row_tbl_sub['lotoldlot'];
		}
		else
		{
		$lotoldlot=$row_tbl_sub['lotoldlot'];
		}
		
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
<!--	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $tdate13?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $location;?></td>
    <td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="133" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
  <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
 <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
   <!--  <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>-->
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
			 <td width="52" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
    <td width="105" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>

  <?php
}
else
{
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<!--/*<td width="107" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>*/-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $location;?></td>
    <td width="81" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="133" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
      <!-- <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>-->
     	 	    <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
				 <td width="52" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
    <td width="105" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>
  <?php
}
$srno=$srno+1;
}
}
?>
</table>

<?php
}
?>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Date</td></tr>
  </table>
<?php
}
?>

<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="center" valign="top"><a href="report_darrival.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../../images/istratlogo.gif"  align="left"/><img src="../../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
