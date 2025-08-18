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
	
	 $sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
	 $ddate = $_REQUEST['ddate'];
	 $sftyp = $_REQUEST['sftyp'];
	 $itemid = $_REQUEST['txtcrop'];
	 $vv = $_REQUEST['txtvariety'];
	 
		if(isset($_POST['frm_action'])=='submit')
		{
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant-Report - Super Soft Release Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var sftyp=document.frmaddDepartment.sftyp.value;
var ddate=document.frmaddDepartment.ddate.value;
winHandle=window.open('report_ssfr2.php?sdate='+sdate+'&edate='+edate+'&ddate='+ddate+'&txtcrop='+itemid+'&txtvariety='+vv+'&sftyp='+sftyp,'WelCome','top=20,left=80,width=670,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
<?php
	$sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
	 $ddate = $_REQUEST['ddate'];
	 $sftyp = $_REQUEST['sftyp'];
	 $itemid = $_REQUEST['txtcrop'];
	 $vv = $_REQUEST['txtvariety'];

if($sftyp=="periodical")
{	 
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
	
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr2 where softr_date <= '$edate' and softr_date >= '$sdate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 and plantcode='$plantcode' order by softr_date asc ") or die(mysqli_error($link));
}
else
{		
		$tdate=$ddate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$ddate=$tyear."-".$tmonth."-".$tday;
	
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr2 where softr_date <= '$ddate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 and plantcode='$plantcode' order by softr_date asc ") or die(mysqli_error($link));
}
$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
		$row_dept4=mysqli_fetch_array($quer4);
		$var=$row_dept4['popularname'];

	
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Super Soft Release Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	   <input name="txtvariety" value="<?php echo $_REQUEST['txtvariety']?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $_REQUEST['txtcrop'];?>" type="hidden">  
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
		  <input name="ddate" value="<?php echo $_REQUEST['ddate'];?>" type="hidden"> 
		   <input name="sftyp" value="<?php echo $_REQUEST['sftyp'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
<?php
if($sftyp=="periodical")
{
?>
<tr height="25">
<td align="center" class="subheading" style="color:#303918; " colspan="6">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
</tr>  
<?php
}
else
{
?>
<tr height="25">
<td align="center" class="subheading" style="color:#303918; " colspan="6">As on Date: <?php echo $_GET['ddate'];?></td>
</tr> 
<?php
}
?>
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $var;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="6%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="19%" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="12%" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="12%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="15%" align="center" valign="middle" class="tblheading">SR Date</td>
              <td width="18%" align="center" valign="middle" class="tblheading">SR Status</td>
              <td width="18%" align="center" valign="middle" class="tblheading">Remarks</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['softr_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['softr_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $type=""; $remarks="";
	
if($sftyp=="periodical")
{	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub2 where softr_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
}
else
{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub2 where softr_id='".$arrival_id."' and softrsub_srflg='1' and plantcode='$plantcode'") or die(mysqli_error($link));
}	
$subtbltot=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$totqty=0; $totnob=0; 
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
}
}

$aq=explode(".",$totqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$totqty;}

$an=explode(".",$totnob);
if($an[1]==000){$acn=$an[0];}else{$acn=$totnob;}

		$lotno=$row_tbl_sub['softrsub_lotno'];
		$type=$row_tbl_sub['softrsub_srtyp'];
		$bags=$acn;
		$qty=$ac;
if($sftyp=="periodical")
{
	if($row_tbl_sub['softrsub_srflg']==0)
	$remarks="Completed";
	else
	$remarks="In Progress";
}
else
{
$remarks="In Progress";
}	
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="19%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $type?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $remarks?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="19%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $type?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $remarks?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
else
{
?>
<tr class="Dark">
         <td align="center" valign="middle" class="tblheading" colspan="7">Record not found.</td>
</tr>
<?php
}
?>
          </table>			
<table width="650" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="center" valign="top"><a href="report_ssfr.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
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
