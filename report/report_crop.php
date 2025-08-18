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
	 if(isset($_GET['print']))
	{
	 $print = $_GET['print'];
	 if($print=='add')
	 {
	   $pr="Record Added Successfully";
	 }
	 
	}?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Master Reports- Report Crop</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
<SCRIPT language="JavaScript" type="text/javascript">

function openprint()
{
//var dateto=document.frmaddDept.dateto.value;
//var datefrom=document.frmaddDept.datefrom.value;
winHandle=window.open('report_crop1.php','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  

		  
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="820" height="25">&nbsp;Report- Crop </td>
	    </tr></table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  >
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php
	$srno=1;
		
	
	$sql_sel="select * from tblcrop order by cropname";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblcrop");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
	
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="450" bordercolor="#4ea1e1" style="border-collapse:collapse"><tr class="tblsubtitle" height="25">
    <td colspan="7" align="center" class="subheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Crop List (<?php echo $total_results;?>)</td>
	
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="450" bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="Dark" height="25">
<td width="40" height="36" align="center" valign="middle" class="tblheading">#</td>
<td width="172" align="left" class="tblheading" valign="middle">&nbsp;Crop Name </td>
<td width="60" align="center" class="tblheading" valign="middle">&nbsp;Variety Number</td>
<td width="60" align="center" class="tblheading" valign="middle">&nbsp;SIG% (OP)</td>
<td width="60" align="center" class="tblheading" valign="middle">&nbsp;SIG% (Hybrid)</td>
<td width="80" align="center" class="tblheading" valign="middle">SM %</td>
<td width="80" align="center" class="tblheading" valign="middle">EDOR</td>
<td width="80" align="center" class="tblheading" valign="middle">Size</td>
<td width="80" align="center" class="tblheading" valign="middle">NSPRS</td>
<td width="80" align="center" class="tblheading" valign="middle">NSPRF</td>
</tr>
<?php
$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	
	/*$sql_tra=mysqli_query($link,"select * from tblvariety where varietyid=".$row['varietyid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);*/
	
	$sql_v=mysqli_query($link,"select * from tblvariety where cropname=".$row['cropid'])or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td  valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['cropname']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_v;?></td>
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig']?></td>	
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig1']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['smp']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['expdt']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['seedsize']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosior']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosiorfgt']?></td>		
</tr>
<?php
	}
	else
	{ 
?>
	<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td  valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['cropname']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_v;?></td>
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig']?></td>
<td  valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['sig1']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['smp']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['expdt']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['seedsize']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosior']?></td>
<td  valign="middle" class="tbltext" align="center"><?php echo $row['nosiorfgt']?></td>	
</tr>
  <?php	}
	 $srno=$srno+1;
	}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='550' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; 
}
else
{*/
?>
<?php
}
?></td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>

</form> 
<TABLE class="tbltext" width="402" align="center">
                          <TBODY>
                          <tr>
<td width="512" align="center"><a href="masterreports.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"></a></a>&nbsp;&nbsp;
  <input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint();"></td>
</tr></TBODY></TABLE>
	  
	  
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
