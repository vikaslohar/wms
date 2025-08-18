<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
		 $cid = $_REQUEST['txtclass'];
		$itemid = $_REQUEST['itemid'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode-Report -Periodical Report</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
</head>
<script src="indent.js"></script>

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
var cls=document.frmaddDepartment.txtclass.value;
var ite=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_period.php?sdate='+sdate+'&edate='+edate,'WelCome','top=20,left=80,width=800,height=500,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dec_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/dec_rupee1.gif" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" style="border-bottom:solid; border-bottom-color:#7a9931" >
	    <tr >
	      <td width="813" height="25">&nbsp;Period Wise  Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	   <input name="txtclass" value="<?php echo $cid;?>" type="hidden"> 
	    <input name="itemid" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];

	
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
	

	 $sql = "select * from tblspcodes where altdate <= '$edate' and altdate >= '$sdate'  order by altdate asc";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));	  
	
	
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Period wise Report</td>
  	</tr>
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  	
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="774" bordercolor="#7a9931"
 style="border-collapse:collapse">
      <tr class="tblsubtitle" height="20">
     <td width="4%" align="center" valign="middle" class="tblheading">#</td>
     <td width="9%" align="center"  valign="middle" class="tblheading">Date</td>
  
     <td width="13%"align="center" valign="middle" class="tblheading">SP Code Female</td>
     <td width="13%" align="center" valign="middle" class="tblheading">SP Code Male</td>
     <td width="29%" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
     <td width="32%" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
   </tr>
<?php 
 	
				

$srno=1;
while($row=mysqli_fetch_array($rs))
{
$sql_class1=mysqli_query($link,"select * from tblcrop where cropid='".$row['crop']."'") or die(mysqli_error($link));
				$row_class1=mysqli_fetch_array($sql_class1);
						
	$row0=mysqli_query($link,"select * from tblvariety where varietyid='".$row['variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
				$row0=mysqli_fetch_array($row0);
				
	
	            $spcodef = $row['spcodef'];
				$spcodem = $row['spcodem'];
				$crop=$row_class1['cropname'];
				$variety=$row0['popularname'];
				$stlg_trdate=$row['altdate'];
	
			
			
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

$tot_spdec==0;
	$sql_spdec=mysqli_query($link,"select * from tblspdec where spdecid = '".$row['spdecid']."' and spdectflg='1' ") or die(mysqli_error($link));
	$tot_spdec=mysqli_num_rows($sql_spdec);
	//$row_spdec=mysqli_fetch_array($sql_spdec);	
if($tot_spdec > 0 && $variety!="")
{

if ($srno%2 != 0)
	{	

?>


   <tr class="Light" height="20">
      <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
            <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
     <td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
     <td width="32%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
   </tr>
   
   <?php
}
else
{
?>
   <tr class="Light" height="20">
     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
            <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
     <td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
     <td width="32%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
   </tr>
  <?php 
}
$srno=$srno+1;
}
}
?>
 </table>	

		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="period.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
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
