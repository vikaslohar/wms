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
	
	$tp="Unidentified";	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
/*		
	$sql_code="SELECT MAX(arr_code) FROM tblarrival where plantcode='".$plantcode."' and   yearcode='$yearid_id'and arrival_type='Stocktransfer' ORDER BY arr_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
		
		$sql_code1="SELECT MAX(ncode) FROM tblarrival where plantcode='".$plantcode."' and   yearcode='$yearid_id' and arrival_type='Stocktransfer' ORDER BY ncode DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
			{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode=$t_code1+1;
				$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode=sprintf("%004d",0001);
		}
		
	$sql_main="update tblarrival set arrtrflag=1, arr_code=$code, ncode='$ncode' where arrival_id = '$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));

*/
	

	if(isset($_POST['frm_action'])=='submit')
	{
	
			/*$printopt=$_POST['fet1'];
		
			if($printopt == "1" )
			{
				echo "<script>window.location='STRN_note.php?p_id=$pid'</script>";	
			}
			else if($printopt =="2")
			{
				echo "<script>window.location='home_bincard_print.php?p_id=$pid&tp=Stocktransfer'</script>";	
			}
			else
			{
				echo "Please Select Output Type.";	
			}*/
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying - Transction Unidntified Arrival-Select output</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
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

<script language="JavaScript">
function mySubmit()
{ 
	if(document.frmaddDepartment.fet1.value == "")
	{
	alert("Please select Output Type");
	return false;
	}
	return true;	 
}
function test1(fet11)
{
	if (fet11!="")
	{
	document.frmaddDepartment.fet1.value=fet11;
	}
}	


function openslocpopprint()
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('uan.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocpopprint1(subid)
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('fpdnphsrn.php?itmid='+itm+'&subid='+subid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//}
}


function openprintsubbin(subid, bid, wid, lid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function openprintbin(bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('bin_sloc_details_print.php?bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); bin_sloc_details_print
}
</script>

<body>


<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: Unidentified Arrival- Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
   <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
 
 <br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">Transaction Outputs</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 

<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();">Unidentified Arrival Note (UAN)</a></td>
</tr>
<!--<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint1();">Post Harvest Seed Receive Note (PHSRN)</a></td>
</tr>-->
</table>
<?php

$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
//$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
?>
<!--<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#adad11" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">PDN List for Post Harvest Seed Receive Note</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#adad11" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
    <td width="23" align="center" class="tblheading" valign="middle">#</td>
	  <td width="65" align="center" class="tblheading" valign="middle">PDN No.</td>
    <td width="112" align="left" class="tblheading" valign="middle">&nbsp;Crop</td>
    <td width="124" align="left" class="tblheading" valign="middle">&nbsp;Farmer</td>
    <td width="118" align="left" class="tblheading" valign="middle">&nbsp;Organiser</td>
    <td width="122" align="left" class="tblheading" valign="middle">&nbsp;Production<br />
&nbsp;Location</td>
	<td width="123" align="left" class="tblheading" valign="middle">&nbsp;Production<br />
&nbsp;Personnel</td>
	<td width="45" align="center" class="tblheading" valign="middle">Output</td>
    </tr>
<?php
$srno=1;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['pdnno'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['farmer'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['organiser'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['ploc'];?></td>
    <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['pper'];?></td>
	<td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0)" onclick="openslocpopprint1('<?php echo $row_tbl_sub['arrsub_id'];?>');">PHSRN</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['pdnno'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['farmer'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['organiser'];?></td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['ploc'];?></td>
    <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_sub['pper'];?></td>
	<td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0)" onclick="openslocpopprint1('<?php echo $row_tbl_sub['arrsub_id'];?>');">PHSRN</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
?>
</table>
-->

<?php
 $sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_trtype='Unidentified' and lotldg_trid='".$pid."'") or die(mysqli_error($link));
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#adad11" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin Status Sheet</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#adad11" style="border-collapse:collapse">
<?php

//$sql_tbl_sub=mysqli_query($link,"select * from tblissue_sub where plantcode='".$plantcode."' and   arrival_id='".$pid."'") or die(mysqli_error($link));

?>
  <tr class="tblsubtitle" height="25">
    <td width="23" align="center" class="tblheading" valign="middle">#</td>
	  <td width="76" align="center" class="tblheading" valign="middle">Crop</td>
    <td width="89" align="center" class="tblheading" valign="middle">Variety</td>
	<td width="83" align="center" class="tblheading" valign="middle">Lot Number</td>
    <td width="60" align="center" class="tblheading" valign="middle">NoB</td>
    <td width="44" align="center" class="tblheading" valign="middle">Qty</td>
	 <td width="85" align="center" class="tblheading" valign="middle">Stage</td>
	  <td width="59" align="center" class="tblheading" valign="middle">QC Status</td>
	 <td width="39" align="center" class="tblheading" valign="middle">Moist % </td>
    <td width="71" align="center" class="tblheading" valign="middle">GOT Status</td>
	<td width="97" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>

<?php
$srno=1;
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{ 
$sql_class=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' and lotno='".$row_tbl_sub['lotldg_lotno']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
	$row_crop=mysqli_fetch_array($sql_crop);
		
$varchk=$row_crop['cropname']."-"."Unidentified";
$varty="";
if($row_tbl_sub['lotldg_variety']!=$varchk)
{		
	$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_veriety);
	$varty=$row_variety['popularname'];
}
else
{
$varty=$row_tbl_sub['lotldg_variety'];
}	
	
	$dq=explode(".",$row_tbl_sub['lotldg_balqty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['lotldg_balqty'];}	


if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    <td width="89" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_class['sstage'];?></td>
	<td width="59" align="center" valign="middle" class="tblheading"><?php echo $row_class['qc'];?></td>
	<td width="39" align="center" valign="middle" class="tblheading"><?php echo $row_class['moisture'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_class['got1'];?></td>
    
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_sub['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
//$binn=$row_binn['binname']."/";;
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid],$row_tbl_sub[lotldg_id])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
     <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    <td width="89" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_class['sstage'];?></td>
	<td width="59" align="center" valign="middle" class="tblheading"><?php echo $row_class['qc'];?></td>
	<td width="39" align="center" valign="middle" class="tblheading"><?php echo $row_class['moisture'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_class['got1'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_sub['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
//$binn=$row_binn['binname']."/";;
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_binn[binname]</a>"."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid],$row_tbl_sub[lotldg_id])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	

	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php	
}
$srno=$srno+1;
}
}
//}
//}
?>
</table>

<table align="center" width="314" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_bag.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;&nbsp;</td>	
</tr>
</table>
</form></td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table><!-- actual page end--->			  
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
