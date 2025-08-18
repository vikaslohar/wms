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
	
	if(isset($_REQUEST['vid']))
	{
	 $vid= $_REQUEST['vid'];	 
	}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$achar=trim($_POST['txtsid']);
		//echo "<script>window.location='party_Masterhome.php?achar=$achar'</script>";	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administrator - Order Suspensionr -Order Management</title>
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
<script type="text/javascript">
function openslocpopprint(tid)
{
winHandle=window.open('edit_order.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">
		  
<!-- actual page start--->	
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="35" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="740" class="Mainheading" height="25">
	  <table width="845" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="845" height="25">Order Suspension </td>
	    </tr></table></td>
	  <td width="100" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="94" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" ></tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="Hidden" name="tid" value="<?php echo $row['trntype']?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php
	
	if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
	$sql_sel="select * from tbl_susorderm order by oid LIMIT $from, $max_results";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_susorderm");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	///if($total >0) { 
	
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Order Suspension  List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="550" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
 <td width="63" height="22" align="center" valign="middle" class="tblheading">#</td>
 <td width="156" align="center" class="tblheading" valign="middle">Transaction Type</td>
 <td width="234" align="center" class="tblheading" valign="middle">&nbsp;Days of Suspension</td>
<td width="87" align="center" class="tblheading" valign="middle">Edit</td>
</tr>
<?php
while($row=mysqli_fetch_array($res))
	{
 $resettargetquery=mysqli_query($link,"select * from tbl_susorderm where oid='".$row['oid']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
if ($srno%2!= 0)
	{	
	
?>
<tr class="Light" height="25">
 <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
 <td valign="middle" class="tbltext" align="center"><?php echo $row['trntype'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['days'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $row['oid'];?>')"><img src="../images/edit.png" border="0" /></a></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
 <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
 <td valign="middle" class="tbltext" align="center"><?php echo $row['trntype'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['days'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $row['oid'];?>')"><img src="../images/edit.png" border="0" /></a></td>
  </tr>
 
<?php
}

$srno=$srno+1;
}

?>
</table>

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
