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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$crop = $_POST['txtcrop'];
		$veriety = $_POST['txtvariety'];
		echo "<script>window.location='crop_ver_sr_report1.php?txtcrop=$crop&txtvariety=$veriety'</script>";*/	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Settlement - Transaction - Sales Return</title>
<link href="../include/main_settlement.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_settlement.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->


</head>
<script src="srcrrep.js"></script>
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
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}
function openprint()
{
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('report_cropversr2.php?&txtcrop='+itemid+'&txtvariety='+vv,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_settlement.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/viewer_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" style="border-bottom:solid; border-bottom-color:#ef0388" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Report - Crop Variety Wise Sales Return Report As on Date <?php echo date("d-m-Y");?></td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trtype='Sales Return' and lotldg_balqty > 0";

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
	
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	$crop1=$crop;
	$variety1=$variety;
?> 
	  
	  <td align="center" colspan="4" >

<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
<input name="txtvariety" value="<?php echo $variety1?>" type="hidden"> 
<input name="txtcrop" value="<?php echo $crop1;?>" type="hidden">  
	 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>


<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#ef0388" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td align="center" class="tblheading">Crop Variety Wise Sales Return Report As on Date <?php echo date("d-m-Y");?></td>
</tr>
</table>
<?php

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id desc") or die(mysqli_error($link));
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
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."'  and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arhome['lotldg_lotno']."'  and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_trtype='Sales Return' order by lotldg_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$ccnt++;
}
}
}
//echo $ccnt;
if($ccnt > 0)
{
// 		Table code for crop & variety wise lot numbers
?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#ef0388" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?></td>

</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#ef0388" style="border-collapse:collapse" > 

<tr class="tblsubtitle" height="25">
	<td width="25" align="Center" class="tblheading">#</td>
	<td width="120" align="Center" class="tblheading">Lot No</td>
	<td width="65" align="Center" class="tblheading">Stage</td>
	<td width="55" align="Center" class="tblheading">Pack Type</td>
	<td width="55" align="Center" class="tblheading">UPS</td>
	<td width="65" align="Center" class="tblheading">NoP/NoB</td>
	<td width="65" align="Center" class="tblheading">Qty (In Kgs.)</td>
	<td width="160" align="Center" class="tblheading">SLOC</td>
	<td width="65" align="Center" class="tblheading">QC Status</td>
	<td width="65" align="Center" class="tblheading">DOT</td>
	<td width="40" align="Center" class="tblheading">Germ %</td>
	<td width="65" align="Center" class="tblheading">GOT Status</td>
</tr>
<?php
//	echo $row_rr['lotldg_variety'];


$srno=0; $totalbags=0; $totalqty=0;
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."'  and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
	 $cnt=0; $ploc=""; $pstate=""; $cropn=""; $varietyn=""; $sstage="";
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc="";$txtdot=""; 
	$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 


$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_trtype='Sales Return' order by lotldg_id asc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_issuetbl['lotldg_id']."<BR>";
  $cnt++; $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL")
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	else
	$totgot=$row_issuetbl['lotldg_got1'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
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
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";
	if($totgemp==0 || $totgemp=="") $totgemp="";
	
	$sstage=$row_issuetbl['lotldg_sstage'];
	
	//echo $srno." = ".$row_issuetbl['lotldg_whid']."  -  ".$row_issuetbl['lotldg_binid']."  -  ".$row_issuetbl['lotldg_subbinid']."<br>";

$sql_whouse=mysqli_query($link,"select * from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select * from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_issuetbl['lotldg_balbags'];
 $slqty=$row_issuetbl['lotldg_balqty'];
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
}
}
}

$qry2="select * from tblarrival_sub where plantcode='$plantcode' AND lotcrop='".$crop."' and lotvariety='".$variety."' and sstage='Raw' and lotno='".$row_arr_home['lotldg_lotno']."'";
$sql_rr=mysqli_query($link,$qry2) or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
$row_rr=mysqli_fetch_array($sql_rr);
$row_rr['arrsub_id'];	
$ploc=$row_rr['ploc'];	
$pstate=$row_rr['lotstate'];
$harvesdt=$row_rr['harvestdate'];

$sql_arrmain=mysqli_query($link,"Select * from tblarrival where plantcode='$plantcode' AND arrival_id='".$row_rr['arrival_id']."'") or die(mysqli_error($link));
$row_arrmain=mysqli_fetch_array($sql_arrmain);

$ardt=$row_arrmain['arrival_date'];

	$rdate=$harvesdt;
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$harvesdt=$rday."-".$rmonth."-".$ryear;
	
	$rdate=$ardt;
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$ardt=$rday."-".$rmonth."-".$ryear;
if($harvesdt=="00-00-0000" || $harvesdt=="--")
	$harvesdt="";
if($ardt=="00-00-0000" || $ardt=="--")
	$ardt="";			
//echo $cnt;

	
$packtype="";	$upstype="";	
if($cnt>0)
{
if($sstage=="Condition") $packtype="NoB";
if($sstage=="Pack") $packtype="NoP";

$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($totqc=="RT"){$txtdot=""; $totgemp="";}
if($srno%2!=0)
{
?>	
<tr height="25">
	<td width="25" align="Center" class="tbltext"><?php echo $srno;?></td>
	<td width="120" align="Center" class="tbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $sstage?></td>
	<td width="55" align="Center" class="tbltext"><?php echo $packtype;?></td>
	<td width="55" align="Center" class="tbltext"><?php echo $upstype;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $totnob;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $totqty;?></td>
	<td width="160" align="Center" class="tbltext"><?php echo $sloc;?></td>
	<td width="55" align="Center" class="tbltext"><?php echo $totqc;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $txtdot;?></td>
	<td width="40" align="Center" class="tbltext"><?php echo $totgemp;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $totgot;?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
	<td width="25" align="Center" class="tbltext"><?php echo $srno;?></td>
	<td width="120" align="Center" class="tbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $sstage?></td>
	<td width="55" align="Center" class="tbltext"><?php echo $packtype;?></td>
	<td width="55" align="Center" class="tbltext"><?php echo $upstype;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $totnob;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $totqty;?></td>
	<td width="160" align="Center" class="tbltext"><?php echo $sloc;?></td>
	<td width="55" align="Center" class="tbltext"><?php echo $totqc;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $txtdot;?></td>
	<td width="40" align="Center" class="tbltext"><?php echo $totgemp;?></td>
	<td width="65" align="Center" class="tbltext"><?php echo $totgot;?></td>
</tr>
<?php
}
}
else{$srno--;}
}
?>
<tr class="Dark">
			<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;</td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totalbags?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
			<td align="center" valign="middle" class="tblheading" colspan="5">&nbsp;</td>
</tr>
</table>			
<br />
<?php
}
}
}
}
?>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="crop_ver_sr_report.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;"  /></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /></td>
</tr>
</table>
</td><td width="30"></td>
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

  