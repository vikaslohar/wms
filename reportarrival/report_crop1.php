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
	
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
		//$cid = $_REQUEST['txtclass'];
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
<title>Plant-Report -Period Wise Report</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
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
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_crop2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <?php
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$vv = $_REQUEST['txtvariety'];
	
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
	
		/*$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 */
		
		
			
	if($vv=="ALL")
	{	
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
	}

$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv'  and vertype='PV'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
	}

	
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25">&nbsp;Crop  Variety wise StockTransfer Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	   <input name="txtvariety" value="<?php echo $vv?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="10"></td> <td>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="970" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $variet;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="19"align="center" valign="middle" class="tblheading" rowspan="2">#</td> 
			<td width="60" align="center" valign="middle" class="tblheading" rowspan="2">Date of Arrival </td>
			<td width="135" align="center" valign="middle" class="tblheading" rowspan="2">Stock Transfer from Plant</td>
			<td width="119" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			<td width="94" align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
            <td width="52" align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
            <td width="62" align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
			<td width="54" align="center" valign="middle" class="tblheading" rowspan="2">Stage</td>
            <td colspan="3" align="center" valign="middle" class="tblheading"> QC</td>
    		<td width="54" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
    		<td width="68"  align="center" valign="middle" class="tblheading" rowspan="2">DoT</td>
    		<td width="43" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
    		<td width="66" align="center" valign="middle" class="tblheading" rowspan="2">DoGR</td>
</tr>

<tr class="tblsubtitle">
			<td width="42" align="center" valign="middle" class="tblheading">PP</td>
			<td width="35" align="center" valign="middle" class="tblheading">Moist %</td>
			<td width="35" align="center" valign="middle" class="tblheading">Germ %</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	/*and lotcrop='".$itemid."' 
		and lotcrop='".$itemid."' and lotvariety='".$vv."' */
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $subtbltot=0;
	
	if($vv=="ALL")
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$row_dept['cropname']."'") or die(mysqli_error($link));
	}
	else
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$row_dept['cropname']."' and lotvariety='".$variet."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
	}
$subtbltot=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
$acn=$row_tbl_sub['act1'];

$var=$row_tbl_sub['lotvariety'];
$crop=$row_tbl_sub['lotcrop'];
$lotno=$row_tbl_sub['lotno'];
$bags=$acn;
$qty=$ac;
$qc=$row_tbl_sub['gemp'];
$got=$row_tbl_sub['got'];
$got1=$got." ".$row_tbl_sub['got1'];
$stage=$row_tbl_sub['sstage'];
$moist=$row_tbl_sub['moisture'];
if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}

$loc1=$row_party['business_name'];
$sstatus=$row_tbl_sub['sstatus'];
$lotoldlot=$row_tbl_sub['lotoldlot'];
		
		$lotno=$row_tbl_sub['lotno'];
		$bags=$acn;
		$qty=$ac;
		$qc1=$row_tbl_sub['qc'];
	

		/*$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		*/
		$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);


		/*$crop=$row_crop['cropname'];
		$variety=$row_variety['popularname'];*/
		$stage=$row_tbl_sub['sstage'];
		$party=$row_party['business_name'];
		
		$tdate12=$row_tbl_sub['testd'];
		$tyear12=substr($tdate12,0,4);
		$tmonth12=substr($tdate12,5,2);
		$tday12=substr($tdate12,8,2);
		$tdate12=$tday12."-".$tmonth12."-".$tyear12;
		
		$tdate13=$row_tbl_sub['gotdate'];
		$tyear13=substr($tdate13,0,4);
		$tmonth13=substr($tdate13,5,2);
		$tday13=substr($tdate13,8,2);
		$tdate13=$tday13."-".$tmonth13."-".$tyear13;
		

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="19" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		 <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="135" align="center" valign="middle" class="smalltbltext"><?php echo $party;?></td>
		  <td width="119" align="center" valign="middle" class="smalltbltext"> <?php echo $var;?></td>
         <td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="52" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
       <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
          <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $qc1?></td>
			 <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $tdate12?></td>
			 <td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
			 <td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $tdate13?>  </td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
			 <td width="19" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		 <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="135" align="center" valign="middle" class="smalltbltext"><?php echo $party;?></td>
		  <td width="119" align="center" valign="middle" class="smalltbltext"> <?php echo $var;?></td>
         <td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="52" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
       <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
          <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $qc1?></td>
			 <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $tdate12?></td>
			 <td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
			 <td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $tdate13?>  </td>
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
         <td align="center" valign="middle" class="tblheading" colspan="15">Record not found.</td>
</tr>
<?php
}
?>
          </table>			
<table width="960" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_crop.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td width="10" ></td>
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
