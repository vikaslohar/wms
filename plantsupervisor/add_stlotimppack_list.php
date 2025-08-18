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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
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
<title>Plant- Transaction - Stock Transfer Pack Seed Lots Import - List</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="staddresschk.js"></script>
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
function openselect(lid)
{
winHandle=window.open('dest_select.php?lid='+lid,'WelCome','top=170,left=180,width=420,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openedit(lid,dstid)
{
winHandle=window.open('dest_edit.php?lid='+lid+'&dstid='+dstid,'WelCome','top=170,left=180,width=420,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function updaterec(dstid,arid,arsubid,lgdt,trtyp,lid)
{
winHandle=window.open('dest_update.php?dstid='+dstid+'&arid='+arid+'&arsubid='+arsubid+'&lgdt='+lgdt+'&trtyp='+trtyp+'&lid='+lid,'WelCome','top=170,left=180,width=420,height=450,scrollbars=yes');
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
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Stock Transfer Lots Import List</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
<input name="txt11" value="" type="hidden"> 
<input name="txt14" value="" type="hidden"> 
<input type="hidden" name="txtid" value="<?php echo $code?>" />
<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>
<?php
$tid=0; $subtid=0;

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
		
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Stock Transfer Lots Import List</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="18" align="center" class="smalltblheading" valign="middle">#</td>
    <td width="60" align="center" class="smalltblheading" valign="middle">Date</td>
    <td width="95" align="center" class="smalltblheading" valign="middle">Lot No.</td>
    <td width="100" align="center" class="smalltblheading" valign="middle">Crop</td>
    <td width="125" align="center" class="smalltblheading" valign="middle">Variety</td>
	
    <td width="50" align="center" class="smalltblheading" valign="middle">NoP</td>
    <td width="30" align="center" class="smalltblheading" valign="middle">NoMP</td>
    <td width="55" align="center" class="smalltblheading" valign="middle">Qty</td>
    <td width="39" align="center" class="smalltblheading" valign="middle">QC Status</td>
    <td width="65" align="center" class="smalltblheading" valign="middle">PP</td>
    <td width="34" align="center" class="smalltblheading" valign="middle">Moist %</td>
    <td width="34" align="center" class="smalltblheading" valign="middle">Germ %</td>
    <td width="60" align="center" class="smalltblheading" valign="middle">Last Test Date</td>
	 <td width="49" align="center" class="smalltblheading" valign="middle">GOT Type</td>
    <td width="42" align="center" class="smalltblheading" valign="middle">GOT Status</td>
	<td width="60" align="center" class="smalltblheading" valign="middle">GOT Test Date</td>
	  </tr>
<?php
$srno=1; $ordate="";$orstatus="";
$sql_cls=mysqli_query($link,"SELECT * FROM tbl_stlotimp_pack where stlotimpp_date >='$sdate'  and stlotimpp_date <='$edate' AND plantcode='$plantcode' order by stlotimpp_date desc") or die(mysqli_error($link));
while($row_cls=mysqli_fetch_array($sql_cls))
{
	$sql_sub=mysqli_query($link,"SELECT * FROM tbl_stlotimp_pack_sub where stlotimpp_id='".$row_cls['stlotimpp_id']."' AND plantcode='$plantcode' order by stlotimpp_id asc") or die(mysqli_error($link));
	while($row_sub=mysqli_fetch_array($sql_sub))
	{
	
 	$tdate=$row_cls['stlotimpp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$tdate1=$row_sub['stlotimpp_dot'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;

	$tdate2=$row_sub['stlotimpp_dogt'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;


 if ($srno%2 != 0)
	{	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="smalltbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $tdate;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_lotno'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_crop'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_variety'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_nop'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_nomp'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_qty'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_qc'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_pp'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_moist'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_germ'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $tdate1;?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_gottype'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_got'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $tdate2;?></td>
    </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
   <td  valign="middle" class="smalltbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $tdate;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_lotno'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_crop'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_variety'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_nop'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_nomp'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_qty'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_qc'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_pp'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_moist'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_germ'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $tdate1;?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_gottype'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_sub['stlotimpp_got'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $tdate2;?></td>
    </tr>
<?php	
}
 $srno=$srno+1;
}
}
?>
</table>


<br />

<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_stlotimp_pack.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a></td>
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

  