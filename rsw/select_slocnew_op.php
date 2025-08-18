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
	//$logid="opr1";
	//$lgnid="OP1";
	//$tp="GD";
	
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	
	/*$sql_code="SELECT MAX(gcode) FROM tbl_gtod  where yearcode='$yearid_id' ORDER BY gcode DESC";
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
		}*/
		
		/*$sql_code1="SELECT MAX(ncode) FROM tbl_captive ORDER BY ncode DESC";
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
		}*/
		
	/*$sql_main="update tbl_gtod set gdflg=1, gcode=$code  where gid = '$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
*/
	/*$sql_main1="update tbl_ieindent set flg=1  where tid = '$tid'";

	$a123=mysqli_query($link,$sql_main1) or die(mysqli_error($link));
	*/

	if(isset($_POST['frm_action'])=='submit')
	{
			/*$printopt=$_POST['fet1'];
		
			if($printopt == "1" )
			{
				echo "<script>window.location='issue_cc_note.php?p_id=$pid'</script>";	
			}
			else if($printopt =="2")
			{
				echo "<script>window.location='bincard_cc_print.php?p_id=$pid&tp=cc'</script>";	
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
<title>RSW -Transaction: SLOC Updation - Output </title>
<link href="../include/main_rsw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
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
/*function mySubmit()
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
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('gd_issue_note_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}*/


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
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_rsw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" style="border-bottom:solid; border-bottom-color:#e48324" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: SLOC Updation - Output </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
  <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
   <input name="tp" value="" type="hidden"> 
  <br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 



<?php
	$sql1=mysqli_query($link,"select * from tbl_sloc where slid='".$pid."' and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);

$c=$row['crop'];
$f=$row['variety'];
$a=$row['lotno'];
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" bordercolor="#e48324" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Existing Sloc </td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#e48324" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="39" align="center" class="tblheading" valign="middle">#</td>
	  <td width="181" align="center" class="tblheading" valign="middle">Crop</td>
    <td width="257" align="center" class="tblheading" valign="middle">Variety</td>
    <td width="67" align="center" class="tblheading" valign="middle">Bags</td>
    <td width="65" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="127" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>
	 <input name="tp" value="SUO" type="hidden"> 

<?php
$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trtype='CSWSUO' and lotldg_trid='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{ 
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
//$row_item=mysqli_fetch_array($sql_item);

$t=mysqli_num_rows($sql_item);
if($t > 0)
{
$row_itm=mysqli_fetch_array($sql_item);
$var=$row_itm['popularname'];
}
else
{
$var=$row_tbl_sub['lotldg_variety'];
}
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['cropname'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $var;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and plantcode='$plantcode' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
//$binn=$row_binn['binname']."/";
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and plantcode='$plantcode' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
//$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_subbinn[sname]</a>";
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid],$row_tbl_sub[lotldg_id])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['cropname'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $var;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and plantcode='$plantcode' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
//$binn=$row_binn['binname']."/";
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and plantcode='$plantcode' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
//$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_subbinn[sname]</a>";
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid],$row_tbl_sub[lotldg_id])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php	
}
$srno=$srno+1;
}
}

?>

</table>
<br />

<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" bordercolor="#e48324" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Updated Sloc </td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#e48324" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="39" align="center" class="tblheading" valign="middle">#</td>
	  <td width="181" align="center" class="tblheading" valign="middle">Crop</td>
    <td width="257" align="center" class="tblheading" valign="middle">Variety</td>
    <td width="67" align="center" class="tblheading" valign="middle">Bags</td>
    <td width="65" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="127" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr> <input name="tp" value="SUC" type="hidden"> 


<?php
$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trtype='CSWSUC' and lotldg_trid='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{ 
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
//$row_item=mysqli_fetch_array($sql_item);

$t=mysqli_num_rows($sql_item);
if($t > 0)
{
$row_itm=mysqli_fetch_array($sql_item);
$var=$row_itm['popularname'];
}
else
{
$var=$row_tbl_sub['lotldg_variety'];
}
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['cropname'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $var;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and plantcode='$plantcode' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
//$binn=$row_binn['binname']."/";
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and plantcode='$plantcode' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
//$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_subbinn[sname]</a>";
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid],$row_tbl_sub[lotldg_id])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['cropname'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $var;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and plantcode='$plantcode' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
//$binn=$row_binn['binname']."/";
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and plantcode='$plantcode' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
//$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid])'>$row_subbinn[sname]</a>";
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[lotldg_subbinid],$row_tbl_sub[lotldg_binid],$row_tbl_sub[lotldg_whid],$row_tbl_sub[lotldg_id])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php	
}
$srno=$srno+1;
}
}

?>

</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_slocnew.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;&nbsp;
  <input type="hidden" name="fet1" value="" /></td>	
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
