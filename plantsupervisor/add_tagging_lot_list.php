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
<title>Lgen - Transaction -  Lot Transfer</title>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Lots Import List</td>
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
<table align="center" border="1" width="974" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lots Import List</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="17" align="center" class="tblheading" valign="middle">#</td>
    <td width="56" align="center" class="tblheading" valign="middle">Date</td>
    <td width="44" align="center" class="tblheading" valign="middle">Lot No.</td>
    <td width="107" align="center" class="tblheading" valign="middle">Transaction Type</td>
    <td width="80" align="center" class="tblheading" valign="middle">Crop</td>
	
    <td width="43" align="center" class="tblheading" valign="middle">SP-F</td>
    <td width="41" align="center" class="tblheading" valign="middle">SP-M</td>
    <td width="66" align="center" class="tblheading" valign="middle">P-Loc.</td>
    <td width="91" align="center" class="tblheading" valign="middle">P-Per.</td>
    <td width="98" align="center" class="tblheading" valign="middle">Organiser</td>
    <td width="98" align="center" class="tblheading" valign="middle">Farmer</td>
    <td width="29" align="center" class="tblheading" valign="middle">Plot No.</td>
    <td width="51" align="center" class="tblheading" valign="middle">Old Lot No.</td>
	 <td width="81" align="center" class="tblheading" valign="middle">Variety</td>
    <td width="40" align="center" class="tblheading" valign="middle">Status</td>
	  </tr>
<?php
$srno=1; $ordate="";$orstatus="";
$sql_cls=mysqli_query($link,"SELECT * FROM tbllotimp where lotimpdate >='$sdate'  and lotimpdate <='$edate' order by lotnumber Asc") or die(mysqli_error($link));
while($row_cls=mysqli_fetch_array($sql_cls))
{

	/*$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where lotnoid='".$row_cls['id']."'") or die(mysqli_error($link));
	$row_sub=mysqli_fetch_array($sql_arr_sub);
	
	$sql_arr=mysqli_query($link,"select * from tblarrival where arid='".$row_sub['arid']."'") or die(mysqli_error($link));
	$row_arr=mysqli_fetch_array($sql_arr);
		
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	
	$sql_item1=mysqli_query($link,"select * from tblfarmer where farmerid='".$row_sub['farmerid']."'") or die(mysqli_error($link));
	$row_item1=mysqli_fetch_array($sql_item1);
	
	$sql_item=mysqli_query($link,"select * from tblorganiser where orgid='".$row_sub['orgid']."'") or die(mysqli_error($link));
	$row_item=mysqli_fetch_array($sql_item);
	
	$sql_pro=mysqli_query($link,"select * from tblproductionpersonnel where productionpersonnelid='".$row_arr['productionpersonnelid']."'") or die(mysqli_error($link));
	$row_pro=mysqli_fetch_array($sql_pro);
	
	$sql_pp=mysqli_query($link,"select * from tblproductionlocation where productionlocationid ='".$row_arr['productionlocationid']."'") or die(mysqli_error($link));
	$row_pp=mysqli_fetch_array($sql_pp);
	
	$quer0=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr['varietyid']."'  order by popularname Asc"); 
	$row0=mysqli_fetch_array($quer0);


$crop="";
$tp="";
if($row_arr['trtype']=="freshpdn")
{
$tp="Fresh Seed with PDN";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row_arr['trtype']=="Trading")
{
$tp="Trading";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row_arr['trtype']=="UnidentifiedArrival")
{
$tp="Unidentified";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_sub['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row_arr['trtype']=="Existing")
{
$tp="Lot Regularisation";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row_arr['trtype']=="LotMerger")
{
$tp="Lot Merger";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else
{
$tp="";
$crop="";
}*/

 	$tdate=$row_cls['lotimpdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;



 if ($srno%2 != 0)
	{	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="smalltbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $tdate;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotnumber'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lottrtype'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotcrop'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotspcodef'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotspcodem'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotploc'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotpper'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotorganiser'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotfarmer'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotplotno'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotoldlot'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotvariety'];?></td>
	<td valign="middle" class="smalltbltext" align="center">IMP-Y</td>
    </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="smalltbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $tdate;?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotnumber'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lottrtype'];?></td>
    <td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotcrop'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotspcodef'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotspcodem'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotploc'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotpper'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotorganiser'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotfarmer'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotplotno'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotoldlot'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><?php echo $row_cls['lotvariety'];?></td>
	<td valign="middle" class="smalltbltext" align="center">IMP-Y</td>
    </tr>
<?php	
}
 $srno=$srno+1;
}
?>
</table>


<br />

<table align="center" width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_tagging.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a></td>
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

 