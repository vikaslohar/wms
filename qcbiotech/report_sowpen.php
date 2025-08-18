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
	
	$cid = $_REQUEST['txtcrop'];
	$itemid = $_REQUEST['txtvariety'];	
    $sdate=date("d-m-Y");
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report - GOT Sowing Pending Summery Report</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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

var txtcrop=document.frmaddDepartment.txtcrop.value; 
var txtvariety=document.frmaddDepartment.txtvariety.value; 
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_got2.php?txtcrop='+txtcrop+'&txtvariety='+txtvariety,'WelCome','top=20,left=80,width=1000,height=950,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">&nbsp;Report - GOT Sowing Pending Summery Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	 <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txtcrop" value="<?php echo $cid;?>" type="hidden"> 
	 <input name="txtvariety" value="<?php echo $itemid;?>" type="hidden"> 
	 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="10"></td> <td>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="500" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918;" colspan="2">GOT Sowing Pending Summery Report As on Date: <?php echo date("d-m-Y");?> </td>
  	</tr>
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="94"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="176"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="123"  align="center" valign="middle" class="tblheading">No. of Lots</td>
</tr>

<?php
$srno=1;
$sql="SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0  ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gotm_crop']."'"); 
$row31=mysqli_fetch_array($quer3);

	
$sqlmax2="SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop='".$row_arr_home['gotm_crop']."'";
$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));
$tot_max2=mysqli_num_rows($sql_max2);
while($row_arr_home3=mysqli_fetch_array($sql_max2))
{

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home3['gotm_variety']."' "); 
$row_dept4=mysqli_fetch_array($quer4);
$tot_var=mysqli_num_rows($quer4);
if($tot_var > 0)
{	
	$variety=$row_dept4['popularname'];
}
else 
{
	$variety=$row_arr_home3['gotm_variety'];
} 

$lotno=0;
$sql_max=mysqli_query($link,"SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop='".$row_arr_home['gotm_crop']."' AND gotm_variety='".$row_arr_home3['gotm_variety']."'  ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home2=mysqli_fetch_array($sql_max))
{
	$lotno=$lotno+1;
} 

if($lotno>0)		
{
if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
    <td width="176" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><a href="report_sowpendet.php?txtcrop=<?php echo $row_arr_home['gotm_crop'];?>&txtvariety=<?php echo $row_arr_home3['gotm_variety']; ?>"><?php echo $lotno?></a></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
    <td width="176" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><a href="report_sowpendet.php?txtcrop=<?php echo $row_arr_home['gotm_crop'];?>&txtvariety=<?php echo $row_arr_home3['gotm_variety']; ?>"><?php echo $lotno?></a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
</table>			
<!--<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_got.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>-->
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
