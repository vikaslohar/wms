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
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transction - Lot Merger - View</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="issue.js"></script>
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

var pid=document.frmaddDept.pid.value;
winHandle=window.open('issue_merger_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
else if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	return true;	 
	}
	else
	{
	return false;
	}
}
	
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" 

bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" 

align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plantm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" 

cellpadding="0">
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - Lot Merger - View</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_mergermain where mergerm_id=$pid and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; 
	$drole=$row['mergerm_logid'];
	$tdate=$row['mergerm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input name="code" type="hidden" value="<?php echo $code;?>" />
	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
	<input name="pid" type="hidden" value="<?php echo $pid;?>" />
	<input name="txtdate" type="hidden" value="<?php echo $tdate;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Merger</td>
</tr>
 

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "LM".$row['mergerm_code']."/".$row['mergerm_yearid']."/".$drole;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Merger&nbsp;Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['mergerm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['mergerm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
?>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $noticia_class['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['mergerm_stage'];?></td>
<td align="right"  valign="middle" class="tblheading">No. of Lots Merged&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['mergerm_oldlot'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">New Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['mergerm_newlot'];?></td>
</tr>

</table>
</br>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >Merging Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="3%"  align="center" valign="middle" class="tblheading">#</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Lot No.</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">QC Status</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">GOT Status</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Status</td>
		<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
        <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_mergersub where mergerm_id=$trid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
if($sr%2!=0)
{
?>		  
	<tr class="Light" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['mergers_lotno'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['qcstatus'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['gotstatus'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['srstatus'];?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['mergers_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['mergers_qty'];?></td>
	</tr>

<?php
}
else
{
?>
	<tr class="Dark" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['mergers_lotno'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['qcstatus'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['gotstatus'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['srstatus'];?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['mergers_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['mergers_qty'];?></td>
	</tr>
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="tblsubtitle">
<td align="center" valign="middle" class="tblheading" colspan="5">SLOC Details</td>
</tr>
	<tr class="tblsubtitle">
		<td width="3%"  align="center" valign="middle" class="tblheading">WH</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Bin</td>
		<td width="5%" align="center" valign="middle" class="tblheading">Sub Bin</td>
		<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
        <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$sr2=1; $itmdchk="";
$sql_eindent_sub2=mysqli_query($link,"select * from tbl_mergersubsub where mergerm_id=$trid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub2=mysqli_fetch_array($sql_eindent_sub2))
{

$wareh=""; $binn=""; $subbinn="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_eindent_sub2['mergerss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_eindent_sub2['mergerss_binid']."' and whid='".$row_eindent_sub2['mergerss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_eindent_sub2['mergerss_subbinid']."' and binid='".$row_eindent_sub2['mergerss_binid']."' and whid='".$row_eindent_sub2['mergerss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($sr2%2!=0)
{
?>		  
	<tr class="Light" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $wareh;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $binn;?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $subbinn;?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_qty'];?></td>
	</tr>

<?php
}
else
{
?>
	<tr class="Dark" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $wareh;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $binn;?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $subbinn;?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_qty'];?></td>
	</tr>
<?php 
}
$sr2=$sr2+1;	
}
?>		
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['mergerm_remarks'];?></td>
</tr></table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_merger.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a></td>
</tr>
</table></td><td width="30"></td>
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
