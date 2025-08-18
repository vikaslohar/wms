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
	
	$txtduration=$_REQUEST['txtduration'];
	$txtordtyp=$_REQUEST['txtordtyp'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order - Report - Suspended Order Report</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
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
var txtduration=document.frmaddDepartment.txtduration.value;
var txtordtyp=document.frmaddDepartment.txtordtyp.value;
winHandle=window.open('report_suspended2.php?txtduration='+txtduration+'&txtordtyp='+txtordtyp,'WelCome','top=20, left=80, width=1000, height=900, scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
function openslocpop(party)
{
winHandle=window.open('conop1.php?itmid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_order.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25">&nbsp;Suspended Order Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="txtduration" value="<?php echo $txtduration;?>" type="hidden"> 
	 	 <input name="txtordtyp" value="<?php echo $txtordtyp;?>" type="hidden"> 
		
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php

$sql="select * from tbl_orderm where plantcode='$plantcode' and orderm_supflag=1";	
if($txtduration !="ALL")
{
	$trdate=date("Y-m-d");
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;
	
	$m=$trmonth;
	$de=$trday;
	$y=$tryear;
	$dt=$txtduration;
	for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,($m-$i),$de,$y)); }
	
	$sql.=" and orderm_date>='$dt1' and orderm_date<='$trdate' ";	
}
if($txtordtyp !="ALL")
{
	$sql.=" and order_trtype='$txtordtyp' ";	
}	 

$sql.="  order by orderm_date asc";	
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td width="40"align="center" valign="middle" class="tblheading">#</td> 
	<td width="92" align="center" valign="middle" class="tblheading">Order Date</td>
    <td width="114" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="150" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="329" align="center" valign="middle" class="tblheading">Party Name</td>
	<td align="center" valign="middle" class="tblheading">Order Details</td>
</tr>

<?php
$srno=1; 
if($tot_arr_home > 0)
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	
	$orno=""; $party="";  $orltype="";
	
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr_home['orderm_party'] > 0)
	$party=$row3['business_name'];
	else
	$party=$row_arr_home['orderm_partyname'];
	
	$orno=$row_arr_home['orderm_porderno'];
	$orltype=$row_arr_home['order_trtype'];
	if($orltype=="Order TDF" && $row_arr_home['orderm_partyselect']=="fillp")
	$orltype=$row_arr_home['order_trtype']." - TDF";
	else
	$orltype=$row_arr_home['order_trtype']." - ".$row_arr_home['orderm_party_type'];
if($srno%2!=0)
{
	
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="114" align="center" valign="middle" class="tblheading"><?php echo $orno?></td>
	<td width="150" align="center" valign="middle" class="tblheading"><?php echo $orltype?></td>
    <td width="329" align="center" valign="middle" class="tblheading"><?php echo $party?></td>
	<td width="111" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $arrival_id;?>');">Details</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="114" align="center" valign="middle" class="tblheading"><?php echo $orno?></td>
	<td width="150" align="center" valign="middle" class="tblheading"><?php echo $orltype?></td>
    <td width="329" align="center" valign="middle" class="tblheading"><?php echo $party?></td>
	<td width="111" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $arrival_id;?>');">Details</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
else
{
?>
<tr height="25"><td height="19" colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
<?php
}
?>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="center" valign="middle"><a href="report_suspended.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
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
