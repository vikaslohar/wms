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
	
	$sstate = $_REQUEST['txtstate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
		
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
		// Set timezone
  date_default_timezone_set("UTC");
 
  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rsw - Report - Condition Seed Stock Report with Production Data</title>
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
var ccnntt=document.frmaddDepartment.ccnntt.value;
if(ccnntt > 0)
{
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var txtstate=document.frmaddDepartment.txtstate.value;
var sdate=document.frmaddDepartment.sdate.value;
var edate=document.frmaddDepartment.edate.value;

winHandle=window.open('report_stockprod2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate+'&txtstate='+txtstate,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
else
{
//alert("Cannot open Preview.\nReason: Records not Found.");
return false;
}
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
          <td width="100%" valign="top" align="center"><img src="../../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <?php
   $ccnntt=0;
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
	$qry="select distinct lotldg_lotno from tbl_lot_ldg where lotldg_sstage='Condition' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
	$qry.="and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" order by lotldg_crop asc, lotldg_variety asc";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Condition Seed Stock Report with Production Data</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $_REQUEST['txtvariety']?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $_REQUEST['txtcrop'];?>" type="hidden">  
		<input name="txtstate" value="<?php echo $sstate;?>" type="hidden">  
		<input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
		<input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
	<tr height="25" >
	<td align="left" class="subheading" colspan="3">Period From:<?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?> </td>
  	</tr>
	<tr height="25" >
	<td align="left" class="subheading">&nbsp;&nbsp;Crop:<?php echo $crp;?></td>
    <td align="center" class="subheading">Variety: <?php echo $ver;?></td>
	<td align="right" class="subheading">State: <?php echo $sstate;?>&nbsp;&nbsp;</td>
  	</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="2%"align="center" valign="middle" class="tblheading">#</td> 
	<td width="7%" align="center" valign="middle" class="tblheading">Date of Arrival</td>
	<td width="11%" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="5%" align="center" valign="middle" class="tblheading">SP Code-F</td>
	<td width="5%" align="center" valign="middle" class="tblheading">SP Code-M</td>
	<td width="14%" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="4%" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="4%" align="center" valign="middle" class="tblheading">QC</td>
	<td width="6%" align="center" valign="middle" class="tblheading">GOT</td>
	<td width="6%" align="center" valign="middle" class="tblheading">GOT Grade</td>
	<td width="2%" align="center" valign="middle" class="tblheading">Prod. Grade</td>
	<td width="8%" align="center" valign="middle" class="tblheading">Production Location</td>
	<td width="4%" align="center" valign="middle" class="tblheading">State</td>
	<td width="7%" align="center" valign="middle" class="tblheading">Farmer</td>
	<td width="6%" align="center" valign="middle" class="tblheading">Organiser</td>
	<td width="16%" align="center" valign="middle" class="tblheading">Duration</td>
</tr>
<?php
$cdt=date("d-m-Y");
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home1))
{
	
	$crop=""; $variety=""; $lotno="";  $slocs="";
	$lotno=$row_arr_home['lotldg_lotno'];
	 
$ccnt=0; $nob=0; $qty=0; $qc=""; $got="";$trdate="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Condition' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

while($row_is=mysqli_fetch_array($sql_is))
{ 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);

if($t > 0)
{//echo "select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_sstage='Condition' order by lotldg_id asc ".$t."<br />";
	$row_istbl=mysqli_fetch_array($sql_istbl);
	$arrival_id=$row_istbl['lotldg_trid'];
	$nob=$nob+$row_istbl['lotldg_balbags'];
	$qty=$qty+$row_istbl['lotldg_balqty'];

	$trdate=$row_istbl['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$qc=$row_istbl['lotldg_qc'];
	$got=$row_istbl['lotldg_got'];
	$orlot=$row_istbl['orlot'];
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_istbl['lotldg_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
		
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_istbl['lotldg_variety']."' order by popularname Asc"); 
	$rowvv=mysqli_fetch_array($quer4);
	
   	$crop=$row31['cropname'];
	$variety=$rowvv['popularname'];

$ccnt++;	
}
}
//}
//echo $row_arr_home['lotldg_lotno']." = ".$ccnt."; ";
if($ccnt > 0)
{
$arlot=explode("/",$lotno);

if($sstate=="ALL")
$qry2="select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$variety."' and SUBSTRING(orlot,1,7)='".$arlot[0]."' and plantcode='$plantcode'";
else
$qry2="select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$variety."' and SUBSTRING(orlot,1,7)='".$arlot[0]."' and lotstate='".$sstate."' and plantcode='$plantcode'";
$sql_rr=mysqli_query($link,$qry2) or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
$row_rr=mysqli_fetch_array($sql_rr);
//echo $qry2."<br />";
$spcf=$row_rr['spcodef'];	
$spcm=$row_rr['spcodem'];	
$ploc=$row_rr['ploc'];	
$farmer=$row_rr['farmer'];
$organiser=$row_rr['organiser'];
$statenm=$row_rr['lotstate'];
$prodgrade='';
$prodgrade=$row_rr['prodgrade'];

$sql_arrmain=mysqli_query($link,"Select * from tblarrival where arrival_id='".$row_rr['arrival_id']."' and arrival_date<='$edate' and arrival_date>='$sdate' and arrival_type='Fresh Seed with PDN' and plantcode='$plantcode'") or die(mysqli_error($link));
$trt=mysqli_num_rows($sql_arrmain);
$row_arrmain=mysqli_fetch_array($sql_arrmain);

	$ardt=$row_arrmain['arrival_date'];
	$trdate=$ardt;
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate2=explode("-",$row_arrmain['arrival_date']);
	$trdate=$trdate2[2]."-".$trdate2[1]."-".$trdate2[0];
	if($trdate=="" || $trdate=="--" || $trdate=="00-00-0000" || $trdate=="0000-00-00")$trdate="";
	
$ardt=explode("-",$row_arrmain['arrival_date']);
$trdate24=$ardt[0]."-".$ardt[1]."-".$ardt[2];
$cdt24=date("Y-m-d");

$gotgrade='';
$sql_gottest=mysqli_query($link,"Select * from tbl_gottest where gottest_lotno='".$row_arr_home['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_gottest=mysqli_fetch_array($sql_gottest);
$gotgrade=$row_gottest['grade'];
		
if(trdate!="")
{
$date1 = strtotime($trdate24);
$date2 = strtotime($cdt24);//time();
$diff=dateDiff(date('Y-m-d H:i:s',$date1),date('Y-m-d H:i:s',$date2));
}
else
{
$diff="";	
}

if($trdate!="")
{$ccnntt++;
if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
			<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="11%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcf;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcm;?></td>
		  	<td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $nob;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotgrade;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $prodgrade;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $statenm;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $organiser;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $diff;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="11%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcf;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcm;?></td>
		  	<td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $nob;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotgrade;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $prodgrade;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $statenm;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $organiser;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $diff;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
<input type="hidden" name="ccnntt" value="<?php echo $ccnntt;?>" />
          </table>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_stockprod.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
