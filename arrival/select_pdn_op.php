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
	$tp="stocktr";	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	
	/*$sql_code="SELECT MAX(iss_code) FROM tblissue where  yearcode='$yearid_id' and  issue_type='stocktr' ORDER BY iss_code DESC";
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
		
		
		$sql_code1="SELECT MAX(ncode) FROM tblissue where issue_type='stocktr' ORDER BY ncode DESC";
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



	$sql_main="update tblissue set issuetrflag=1, iss_code=$code, ncode='$ncode'  where issue_id = '$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));


	$sql_code="SELECT MAX(gpcode) FROM tbl_gate ORDER BY gpcode DESC";
	$rescode=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($rescode) > 0)
			{
				$row_code=mysqli_fetch_row($rescode);
				$t_code=$row_code['0'];
				$gpcode=$t_code+1;
			}	
		else
		{
			$gpcode=1;
			
		}
$cod="IS".$code;
$sql_gp="insert into tbl_gate (gpcode,trid) values('$gpcode','$cod')";
mysqli_query($link,$sql_gp) or die (mysqli_error($link));

*/
	/*$sql_main1="update tbl_ieindent set flg=1  where tid = '$tid'";

	$a123=mysqli_query($link,$sql_main1) or die(mysqli_error($link));
	*/

	if(isset($_POST['frm_action'])=='submit')
	{
			/*$printopt=$_POST['fet1'];
		
			if($printopt == "1" )
			{
				echo "<script>window.location='issue_mrtv_note.php?p_id=$pid'</script>";	
			}
			else if($printopt =="2")
			{
				echo "<script>window.location='bincard_mrtv_print.php?p_id=$pid&tp=MReturnV'</script>";	
			}
			else if($printopt=="3")
			{
			echo "<script>window.location='gatepass_mrtv.php'</script>";
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
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>stores - Transction Issue - Stock Transfer  - Output Selection </title>
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
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('oltonln.php.php?itmid='+itm,'WelCome','top=170,left=180,width=770,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{

}
}

function openslocpopprint1()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('phrn.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{

}
}


function openprintsubbin2(subid, bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
          <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction Issue - Arrival PDN- Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
  <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
  <br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">Transaction Outputs</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();">PDN To Lot No.Note</a></td>
</tr>
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint1();">GRN </a></td>
</tr>
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint2();">PHSR Note</a></td>
</tr>
</table>
<?php

/*$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='$tp' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];*/

?>
<?php
	

$sql_tbl=mysqli_query($link,"select * from tbl_stldg_good where stlg_trtype='Issue' and stlg_trsubtype='$tp' and stlg_trid='".$pid."'") or die(mysqli_error($link));
/*$row_tbl=mysqli_fetch_array($sql_tbl);			
$issue_id=$row_tbl['issue_id'];
*/
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin Card </td>
  </tr>
  </table>
<!--/*<ul>
  <li><a href="#"> Reports </a>
      <ul>
        <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
        <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
        <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
        <li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
        <li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
        <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
        <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
        <li><a href="../masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
      </ul>
  </li>
</ul>*/-->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

//$sql_tbl_sub=mysqli_query($link,"select * from tblissue_sub where issue_id='".$issue_id."'") or die(mysqli_error($link));

?>
  <tr class="tblsubtitle" height="25">
    <td width="39" align="center" class="tblheading" valign="middle">#</td>
	  <td width="181" align="center" class="tblheading" valign="middle">Lot No </td>
      <td width="257" align="center" class="tblheading" valign="middle">No. Of Bag </td>
	     <td width="257" align="center" class="tblheading" valign="middle">Qty</td>
      <td width="267" align="center" class="tblheading" valign="middle" colspan="4">Quality</td>
      <td width="65" align="center" class="tblheading" valign="middle">Other status </td>
	    </tr>

<?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{ 
$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$row_tbl_sub['stlg_trclassid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$row_tbl_sub['stlg_tritemid']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading">Status</td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stlg_subbinid],$row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	
	<td width="127" align="center" valign="middle" class="tblheading">DOT</td>
	<td align="center" valign="middle" class="tblheading">Moisture%</td>
    <td align="center" valign="middle" class="tblheading">GOT</td>
	<td align="center" valign="middle" class="tblheading">Reserve</td>
   
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading">Quarantine</td>
	
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stlg_subbinid],$row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	  </tr>
	   <?php
	/*}
	else
	{ */
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading">Fumigation</td>
	
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stlg_subbinid],$row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	  </tr>
	   <?php
	/*}
	else
	{ */
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading">Drying</td>
	
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stlg_subbinid],$row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	  </tr>
	   <?php
	/*}
	else
	{ */
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading">Soft release </td>
	
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stlg_subbinid],$row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
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
<td valign="top" align="center"><a href="home_str.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;&nbsp;
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
