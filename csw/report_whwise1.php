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
	
		
		$txtslwhg = $_REQUEST['txtslwhg'];
		$txtslbing = $_REQUEST['txtslbing'];
		$txtslsubbing2 = $_REQUEST['txtslsubbing2'];
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rsw-Report - Warehouse wise Report</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
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
var txtslwhg=document.frmaddDepartment.txtslwhg.value; 
var txtslbing=document.frmaddDepartment.txtslbing.value;
var txtslsubbing2=document.frmaddDepartment.txtslsubbing2.value;
winHandle=window.open('report_whwise2.php?txtslwhg='+txtslwhg+'&txtslbing='+txtslbing+'&txtslsubbing2='+txtslsubbing2,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_csw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
  <tr><td>
   <?php
		$txtslwhg = $_REQUEST['txtslwhg'];
		$txtslbing = $_REQUEST['txtslbing'];
		$txtslsubbing2 = $_REQUEST['txtslsubbing2'];
			
	$bin="ALL"; $sbin="ALL";
	
	if($txtslbing!="ALL" && $txtslsubbing2!="ALL")
	{	
	$qry.="Select Distinct lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_sstage='Condition' and lotldg_subbinid='$txtslsubbing2' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg'";
	}
	else if($txtslbing!="ALL" && $txtslsubbing2=="ALL")
	{	
	$qry.="Select Distinct lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_sstage='Condition' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg'";
	}
	else
	{
	$qry.="Select Distinct lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_sstage='Condition' and lotldg_whid='$txtslwhg'";
	}
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" style="border-bottom:solid; border-bottom-color:#fa8283" >
	    <tr >
	      <td width="813" height="25">Warehouse wise Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtslwhg" value="<?php echo $txtslwhg?>" type="hidden"> 
	    <input name="txtslbing" value="<?php echo $txtslbing;?>" type="hidden">  
		<input name="txtslsubbing2" value="<?php echo $txtslsubbing2;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
  
<?php

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$txtslwhg."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_arr_home1['lotldg_binid']."' and whid='".$txtslwhg."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin=$row_binn['binname'];

if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_tbl['lotldg_subbinid']."' and binid='".$bid."' and whid='".$whid."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin=$row_subbinn1['sname'];
}

?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#fa8283" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;WH: <?php echo $row_whouse['perticulars'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Bin: <?php echo $bin;?>&nbsp;&nbsp;|&nbsp;&nbsp;Sub-Bin: <?php echo $sbin;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#fa8283" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="5%"align="center" valign="middle" class="smalltblheading">Subbin</td> 
			  <td width="10%" align="center" valign="middle" class="smalltblheading">Lot No.</td>
              <td width="13%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="18%" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="6%" align="center" valign="middle" class="smalltblheading">Stage</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">QC status</td>
              <td width="9%" align="center" valign="middle" class="smalltblheading">DoT</td>
              <td width="4%" align="center" valign="middle" class="smalltblheading">Moist %</td>
              <td width="4%" align="center" valign="middle" class="smalltblheading">Germ %</td>
              <td width="9%" align="center" valign="middle" class="smalltblheading">GOT Status</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Seed Status</td>
</tr>

<?php
//	echo $row_rr['lotldg_variety'];
$srno=0;
if($txtslsubbing2=='ALL')
{ 
  $sql_tb="select distinct(lotldg_subbinid) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_whid='".$txtslwhg."' and lotldg_binid='".$row_arr_home1['lotldg_binid']."' and lotldg_sstage='Condition' order by lotldg_subbinid";  
}
 else
{
$sql_tb="select distinct(lotldg_subbinid) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_whid='".$txtslwhg."' and lotldg_binid='".$row_arr_home1['lotldg_binid']."' and lotldg_subbinid='".$txtslsubbing2."'  and lotldg_sstage='Condition' order by lotldg_subbinid";  
 }

$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  

while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_whid='".$txtslwhg."' and lotldg_binid='".$row_arr_home1['lotldg_binid']."' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_sstage='Condition' group by lotldg_lotno order by lotldg_id desc") or die(mysqli_error($link));  
$t1=mysqli_num_rows($sql_tbl1);
while($row_tbl1=mysqli_fetch_array($sql_tbl1))
{

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_tbl1[0]."' and lotldg_sstage='Condition' and lotldg_balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_arr_home1['lotldg_binid']."' and whid='".$txtslwhg."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

		  
	$lrole=$row_tbl_sub['arr_role'];
	$arrival_id=$row_tbl_sub['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus=""; $stage="";

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

				
		$lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$ac;
		$qty=$acn;
		$stage=$row_tbl_sub['lotldg_sstage'];
		$qc=$row_tbl_sub['lotldg_qc'];
		$moist=$row_tbl_sub['lotldg_moisture'];
		$gemp=$row_tbl_sub['lotldg_gemp'];
		$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
		$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
		$sststus=$row_tbl_sub['lotldg_sstatus'];
		$stage=$row_tbl_sub['lotldg_sstage'];
		if($row_tbl_sub['lotldg_srflg'] > 0)
		{
			if($sststus!="")$sststus=$sststus."/"."S";
			else
			$sststus="S";
		}
		$trdate1=$row_tbl_sub['lotldg_qctestdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' ") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		$tot_variety=mysqli_num_rows($sql_variety);
		if($tot_variety>0)
		{
		$variet=$row_variety['popularname'];
		}
		else
		{
		$variet=$row_tbl_sub['lotldg_variety'];
		}	
if($gemp==0)$gemp="";
if($moist==0)$moist="";
if($qc=="RT" || $qc=="UT"){$gemp=""; $trdate1="";}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
if($srno==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="tblheading" colspan="13">Empty Bin</td>
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
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_whwise.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
