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
	 if($print=='delete')
	 {
	   $pr="Record Deleted Successfully";
	 }
	 
	}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>WMS- Farmer Master -Farmer Home</title>
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
<script language="javascript">
function mySubmit()
{
if(document.frmaddDepartment.txtsid.value=="")
{
alert("Please enter text to search then click on search button.");
document.frmaddDepartment.txtsid.focus();
return false;
}
return true;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
            <ul  id="nav"> <li><a href="index1.php"> Masters </a>
              <ul>
                  <li><a href="home_crop.php" >&nbsp;Crop&nbsp;Master</a></li>
                <li><a href="home_variety.php" >&nbsp;Variety&nbsp;Master</a></li> 
				<li><a href="home_location.php" >&nbsp;Production&nbsp;Location</a></li>
                <li><a href="home_personnel.php" >&nbsp;Production&nbsp;Personnel&nbsp;Master</a></li>
                <li><a href="home_organiser.php" >&nbsp;Organiser&nbsp;Master</a></li>
                <li><a href="home_farmer.php" >&nbsp;Farmer&nbsp;Master</a></li>
				<li><a href="companyhome.php" >&nbsp;Parameter&nbsp;Master</a></li>
				<li><a href="operator_home.php" >&nbsp;Operator&nbsp;Master</a></li>
                 <li><a href="current_year.php" >&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
              </ul>
            </li>
            <li><a href="index1.php">Transactions </a>
             <ul>
                <li><a href="../Transaction/add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="../Transaction/add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="../Transaction/add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="../Transaction/home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="../Transaction/home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="../Transaction/home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
              </ul>
            </li>
            <li><a href="index1.php"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				 <li><a href="../reports/slocreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
				<li><a href="../reports/masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility </a>
			<ul><li><a href=" Javascript:void(0)" onclick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onclick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onclick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li>
              </ul>
            </li>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <li> <a href="../Transaction/adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="../Transaction/help.php">Help </a>| </li>
                <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">
		  
<!-- actual page start--->	
	  
		     <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Farmer   Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_farmer.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><?php

	if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
	$sql_sel="select * from tblfarmer order by farmername LIMIT $from, $max_results";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblfarmer");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 

	
?>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td colspan="7" align="center" class="subheading">Farmers List (<?php echo $total_results;?>)</td></tr>

<tr class="Dark" height="25">
<td width="38" align="center" class="tblheading" valign="middle">#</td>
<td width="179" align="left" class="tblheading" valign="middle">&nbsp;Farmer</td>
<td width="220" align="left" class="tblheading" valign="middle">&nbsp;Production Personnel </td>
<td width="171" align="left" class="tblheading" valign="middle">&nbsp;Production
  &nbsp;Location</td>
<td width="40" align="center" class="tblheading" valign="middle">Edit</td>
<td width="88" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	
	$sql_tra=mysqli_query($link,"select * from tblfarmer where farmerid=".$row['farmerid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);
	
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td  valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['farmername']?></td>
		<td valign="middle" class="tbltext" align="left">&nbsp;<?php
			$p1_array=explode(";",$row['productionpersonnelid']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				$query="select productionpersonnel from tblproductionpersonnel where productionpersonnelid='$val1'";
				$sql_p1=mysqli_query($link,$query);
				$row_p1=mysqli_fetch_row($sql_p1);
				$p1[$i++]=$row_p1[0];
				}
				}
				echo $str_p1=implode(", ",$p1);
		?>		</td>
		<td valign="middle" class="tbltext" align="left">&nbsp;<?php
		$sql_l=mysqli_query($link,"select productionlocation from tblproductionlocation where productionlocationid='".$row['productionlocationid']."'") or die(mysqli_error($link));
		$row_l=mysqli_fetch_row($sql_l);
		echo $row_l[0];
		?>		</td>

<td valign="middle" align="center"><a href="edit_farmer.php?farmerid=<?php echo $row['farmerid']?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" align="center"><?php if($num_tra > 0) {?><a href="home_farmer.php" onclick="alert('Cannot be deleted as Transactions are made using this Farmer')"><img border="0" src="../images/delete.png"  /></a><?php } else {?><a href="../include/delete.php?print=farmer&code=<?php echo $row['farmerid']?>" onclick="return confirm('Do you really want to Delete this Record?')"><img border="0" src="../images/delete.png"  /></a><?php } ?></td>
</tr>
<?php
	}
	else
	{ 
?>
	<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td  valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['farmername']?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php
			$p_array=explode(";",$row['productionpersonnelid']);
			$k=0;
			$p=array();
			foreach($p_array as $val)
				{
				if($val<>"")
				 {
				$sql_p=mysqli_query($link,"select productionpersonnel from tblproductionpersonnel where productionpersonnelid='$val'");
				$row_p=mysqli_fetch_row($sql_p);
				$p[$k]=$row_p['0'];
				$k++;
				}
				}
		
				echo $str_p=implode(", ",$p);
		?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php
		$sql_l=mysqli_query($link,"select productionlocation from tblproductionlocation where productionlocationid='".$row['productionlocationid']."'") or die(mysqli_error($link));
		$row_l=mysqli_fetch_row($sql_l);
		echo $row_l[0];
		?></td>
<td valign="middle" align="center"><a href="edit_farmer.php?farmerid=<?php echo $row['farmerid']?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" align="center"><?php if($num_tra > 0) {?><a href="home_farmer.php" onclick="alert('Cannot be deleted as Transactions are made using this Farmer')"><img border="0" src="../images/delete.png"  /></a><?php } else {?><a href="../include/delete.php?print=farmer&code=<?php echo $row['farmerid']?>" onclick="return confirm('Do you really want to Delete this Record?')"><img border="0" src="../images/delete.png"  /></a><?php } ?></td>
</tr>
  <?php	}
	 $srno=$srno+1;
	}
?>
</table>
<?php
	$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='750' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
{
?>
<?php
}
?>
</td>
<td width="30"></td>
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
