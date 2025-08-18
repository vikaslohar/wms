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
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
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
<title>Sales Return - Transction - Select output</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
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


function openslocpopprint()
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('slrn_note.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function openslocpopprint1()
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('slrn_olot2nlot.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openprintsubbin(subid, bid, wid, lid)
{
var itm=document.frmaddDepartment.txtitem.value;
var tp="";
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openprintbin(bid, wid)
{
var itm=document.frmaddDepartment.txtitem.value;
var tp="";
winHandle=window.open('bin_sloc_details_print.php?bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
</script>

<body>


<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
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
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: Sales Return - Verification - Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
 
 <br />
<?php
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$pid."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$row_arr_home=mysqli_fetch_array($sql_tbl_sub);
	
?>
<table align="center" border="0" width="450" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">Transaction Outputs</td>
</tr>
</table>
<table align="center" border="1" width="450" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 

<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<?php if($row_arr_home['salesr_partytype']=="Dealer" || $row_arr_home['salesr_partytype']=="Bulk" || $row_arr_home['salesr_partytype']=="Export Buyer") {?><a href="Javascript:void(0)" onclick="openslocpopprint();">SRN</a><?php } else { ?><a href="Javascript:void(0)" onclick="openslocpopprint();">STIN</a><?php } ?></td>
</tr>
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint1();">SRLCN</a></td>
</tr>
</table><br />

<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$pid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_vflg!=0") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin Status Sheet</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="26" align="center" class="tblheading" valign="middle">#</td>
	  <td width="86" align="center" class="tblheading" valign="middle">Crop</td>
    <td width="101" align="center" class="tblheading" valign="middle">Variety</td>
	<td width="94" align="center" class="tblheading" valign="middle">Lot Number</td>
    <td width="68" align="center" class="tblheading" valign="middle">NoP</td>
    <td width="50" align="center" class="tblheading" valign="middle">Qty</td>
	 <td width="86" align="center" class="tblheading" valign="middle">Stage</td>
	  <td width="70" align="center" class="tblheading" valign="middle">QC Status</td>
	 <td width="75" align="center" class="tblheading" valign="middle">GOT Status</td>
	<td width="114" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>

<?php
$srno=1;
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{ 

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 

$diq2=explode(".",$row_tbl_sub['salesrs_qtydc']);
if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_tbl_sub['salesrs_qtydc'];}
$din2=explode(".",$row_tbl_sub['salesrs_nobdc']);
if($din2[1]==000){$difn2=$din2[0];}else{$difn2=$row_tbl_sub['salesrs_nobdc'];}

if($row_tbl_sub['salesrs_upstype']=="Standard")
$upstyp="ST";
if($row_tbl_sub['salesrs_upstype']=="Non-Standard")
$upstyp="NST";
else
$upstyp="ST";

$tdate1=$row_tbl_sub['salesrs_dov'];
$tyear1=substr($tdate1,0,4);
$tmonth1=substr($tdate1,5,2);
$tday1=substr($tdate1,8,2);
$dov=$tday1."-".$tmonth1."-".$tyear1;

$lotno=$row_tbl_sub['salesrs_orlot'];

$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
//$binn=$row_binn['binname']."/";;
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_salesvr_subsub[salesrss_bin],$row_salesvr_subsub[salesrss_wh])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_salesvr_subsub[salesrss_subbin],$row_salesvr_subsub[salesrss_bin],$row_salesvr_subsub[salesrss_wh],$pid)'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

}
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="26" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><?php echo $noticia['cropname'];?></td>
    <td width="101" align="center" valign="middle" class="tblheading"><?php echo $noticia_item['popularname'];?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $difn2;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $difq2?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['salesrs_got']." ".$row_tbl_sub['salesrs_got1'];?></td>
	<td width="114" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
<?php
}
else
{ 
?>
<tr class="Dark" height="25">
	<td width="26" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><?php echo $noticia['cropname'];?></td>
    <td width="101" align="center" valign="middle" class="tblheading"><?php echo $noticia_item['popularname'];?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $difn2;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $difq2?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['salesrs_got']." ".$row_tbl_sub['salesrs_got1'];?></td>
	<td width="114" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
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
<table align="center" width="450" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_returnptc.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;&nbsp;</td>	
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
