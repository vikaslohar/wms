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
<title>Plant-Report -Arrival: Material Transit Difference Report </title>
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
var edate=document.frmaddDepartment.edate.value; 
var typ=document.frmaddDepartment.typ.value;
//var ite=document.frmaddDepartment.itemid.value;
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_difference_tfresh2.php?sdate='+sdate+'&typ='+typ+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
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
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Arrival: Material Transit Difference Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	    <input name="typ" value="<?php echo $typ;?>" type="hidden">  
		 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	//$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['itemid'];
	$loc = $_REQUEST['txtloc'];	
	
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
	$ccount=0; 	 
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='$typ'    and arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date desc ") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
	 	 

  <?php
if($tot_arr_home > 0)
{ 
 if($typ=="Fresh Seed with PDN")
{ 
?>  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  	<!--<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>-->
  <tr height="25" >
    <?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; } else{$typ}?>
   <td align="center" class="subheading" style="color:#303918; ">Fresh Seed  Arrival with PDN - Period from <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
    <td width="1%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Date of Arrival</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per PDN</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">As Per Actuals</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Prod. Loc.</td>	 
 	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Organiser </td>	 
	<td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Farmer</td>
	</tr>

<tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
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
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and (diff > 0  or diff1 > 0) and plantcode='$plantcode'") or die(mysqli_error($link));
	 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

		$dq=explode(".",$row_tbl_sub['qty']);
		if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}
		
		$dn=explode(".",$row_tbl_sub['qty1']);
		if($dn[1]==000){$dcn=$dn[0];}else{$dcn=$row_tbl_sub['qty1'];}
		
		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		
		$diq=explode(".",$row_tbl_sub['diff']);
		if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}
		//$row_tbl_sub['diff1'];
		
		$din=explode(".",$row_tbl_sub['diff1']);
		if($din[1]==000){$difn=$din[0];}else{$difn=$row_tbl_sub['diff1'];}

		$crop=$row_tbl_sub['lotcrop'];
		$variety=$row_tbl_sub['lotvariety'];	
		$lotno=$row_tbl_sub['lotno'];
		$org=$row_tbl_sub['organiser'];
		$far=$row_tbl_sub['farmer'];
		$loc=$row_tbl_sub['ploc'];

	if($srno%2!=0)
	{
?> 
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $loc;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $org;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $far;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $loc;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $org;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $far;?></td>
</tr><?php
}
$srno++;$ccount++;
}
}
?>
</table>	
<?php
}
 if($typ=="Trading")
{ 
?>  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  	<!--<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>-->
  <tr height="25" >
    <?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; } else{$typ}?>
   <td height="18" align="center" class="subheading" style="color:#303918; ">Trading Arrival - Period from <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
    <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Date of Arrival</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Vendor</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading"> Variety</td>
    <td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per DC</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">As Actuals</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 	</tr>

<tr class="tblsubtitle">
  <td width="9%" align="center" valign="middle" class="tblheading">Name</td>
    <td width="9%" align="center" valign="middle" class="tblheading">Variety Name</td>
    <td width="9%" align="center" valign="middle" class="tblheading">Vendor Lot No. </td>
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="5%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
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
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and (diff > 0  or diff1 > 0) and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

		$dq=explode(".",$row_tbl_sub['qty']);
		if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}
		
		$dn=explode(".",$row_tbl_sub['qty1']);
		if($dn[1]==000){$dcn=$dn[0];}else{$dcn=$row_tbl_sub['qty1'];}
		
		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		
		$diq=explode(".",$row_tbl_sub['diff']);
		if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}
		
		$din=explode(".",$row_tbl_sub['diff1']);
		if($din[1]==000){$difn=$din[0];}else{$difn=$row_tbl_sub['diff1'];}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);

		$crop=$row_arr_home['lotcrop'];
		$variety=$row_arr_home['lotvariety'];
		$partyvariety=$row_arr_home['vvariety'];
		$oldlotno=$row_tbl_sub['lotoldlot'];
		$lotno=$row_tbl_sub['lotno'];
		$party=$row_party['business_name'];

	if($srno%2!=0)
	{
?> 
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $partyvariety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $oldlotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $partyvariety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $oldlotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
$srno++;$ccount++;
}
}
?>
</table>
<?php
}
 if($typ=="StockTransfer Arrival")
{ 
?> 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  	<!--<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>-->
  <tr height="25" >
    <?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; } else{$typ}?>
   <td align="center" class="subheading" style="color:#303918; ">Stock Transfer-Plant - Period from <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
    <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="60" align="center" rowspan="2" valign="middle" class="tblheading">Date of Arrival</td>
		<td width="160" align="center" rowspan="2" valign="middle" class="tblheading">Arrival From Plant</td>
    <td width="73" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="130" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="90" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td width="75" align="center" rowspan="2" valign="middle" class="tblheading">STN No. </td>
	<!--<td width="90" align="center" rowspan="2" valign="middle" class="tblheading">Seed Stage  </td>-->

	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per STN </td>
	<td align="center" valign="middle" class="tblheading" colspan="2">As Actuals</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 	</tr>

<tr class="tblsubtitle">
    <td width="35" height="19" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="40" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="35" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="40" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="35" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="40" align="center" valign="middle" class="tblheading">Qty</td>
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
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and (diff > 0  or diff1 > 0) and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

		$dq=explode(".",$row_tbl_sub['qty']);
		if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}
		
		$dn=explode(".",$row_tbl_sub['qty1']);
		if($dn[1]==000){$dcn=$dn[0];}else{$dcn=$row_tbl_sub['qty1'];}
		
		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		
		$diq=explode(".",$row_tbl_sub['diff']);
		if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}
		
		$din=explode(".",$row_tbl_sub['diff1']);
		if($din[1]==000){$difn=$din[0];}else{$difn=$row_tbl_sub['diff1'];}

		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		
		$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);

		$crop=$row_tbl_sub['lotcrop'];
		$variety=$row_tbl_sub['lotvariety'];
		$stnno="STN"."/".$yearid_id."/".$row_arr_home['ncode'];
		$stage=$row_tbl_sub['sstage'];
		$lotno=$row_tbl_sub['lotno'];
		$party=$row_party['business_name'];

	if($srno%2!=0)
	{
?> 
<tr class="Light" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $stnno;?></td>
	<!--/*<td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>*/-->
	
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $stnno;?></td>
	<!--<td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>-->
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
$srno++;$ccount++;
}
}
?>
</table>
<?php
}
?>

<?php
}
if($ccount==0)
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}
?> 		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_difference.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
