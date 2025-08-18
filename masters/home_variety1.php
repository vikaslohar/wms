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
if(isset($_REQUEST['char']))
	{
	 $char = $_REQUEST['char'];	 
	}
	else
	{
	$char = "ALL";
	}
	if(isset($_REQUEST['page']))
	{
	 $page = $_REQUEST['page'];	 
	}
	else
	{
	$page = "1";
	}
	
	if(isset($_REQUEST['achar']))
	{
	 $achar = $_REQUEST['achar'];	 
	}
	else
	{
	$achar = "";
	}
	/*if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}*/
	if(isset($_REQUEST['varietyid']))
	{
$id = $_REQUEST['varietyid'];
	}
	if(isset($_REQUEST['uid']))
	{
$uid = $_REQUEST['uid'];
	}
	if(isset($_REQUEST['cropid']))
	{
 $cid = $_REQUEST['cropid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		$achar=trim($_POST['txtvariety']);
		echo "<script>window.location='home_variety1.php?page=$page&char=$char&achar=$achar'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administrator- Variety Master -Variety Home</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
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
/*if(document.frmaddDepartment.txtsid.value=="")
{
alert("Please enter text to search then click on search button.");
document.frmaddDepartment.txtsid.focus();
return false;
}*/
if(document.frmaddDepartment.txtcrop.value=="")
{
alert("Please enter text to search then click on search button.");
document.frmaddDepartment.txtcrop.focus();
return false;
}
if(document.frmaddDepartment.txtvariety.value=="")
{
alert("Please enter text to search then click on search button.");
document.frmaddDepartment.txtvariety.focus();
return false;
}

return true;
}
function modetchk(classval)
{	//alert("hi");
			showUser(classval,'vitem','item','','','','','');
}
function opencvview(txtsid)
{
	if(txtsid!="")
	{
		winHandle=window.open('cv_view.php?pid='+txtsid,'WelCome','top=170,left=180,width=960,height=350,scrollbars=yes');
		if(winHandle==null){
			alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
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
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">		  
<!-- actual page start--->	
	  
		     <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Variety Master </td>
	    </tr></table></td>
		
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="home_variety.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	  
	  <tr>
	
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by Alphabet </td>
</tr>
<tr class="Dark">
<td width="31" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=ALL" class="link">All</a></td>
<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=A" class="link">A</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=B" class="link">B</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=C" class="link">C</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=D" class="link">D</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=E" class="link">E</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=F" class="link">F</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=G" class="link">G</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=H" class="link">H</a></td>

<td width="13" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=I" class="link">I</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=J" class="link">J</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=K" class="link">K</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=L" class="link">L</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=M" class="link">M</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=N" class="link">N</a></td>

<td width="15" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=O" class="link">O</a></td>

<td width="22" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=P" class="link">P</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=Q" class="link">Q</a></td>

<td width="16" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=R" class="link">R</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=S" class="link">S</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=T" class="link">T</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=U" class="link">U</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=V" class="link">V</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=W" class="link">W</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=X" class="link">X</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=Y" class="link">Y</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="home_variety1.php?char=Z" class="link">Z</a></td>
</tr>
</table>

<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >  <tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by Variety Name </td>
</tr>
  </table>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="138" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			  </tr>
			   <tr class="Light" height="30">
<?php  
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="277" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		<td width="158" align="left"  valign="middle" >&nbsp;<input name="Submit" type="image" src="../images/search.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;" align="middle"></td>
           </tr>

   </table>
<?php
	
$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 10; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
	if($achar!="" && $char=="ALL")
	{
	$sql_arr_home = mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$achar."' and vertype='PV'  order by cropid ,popularname LIMIT $start, $limit"); 
	$query = "SELECT * FROM tblvariety where varietyid='".$achar."' and vertype='PV'  order by cropid ,popularname";
	}
	else if( $char!="ALL"  && $achar=="")
	{ 
		$sql_arr_home = mysqli_query($link,"SELECT * FROM tblvariety where popularname like '$char%' and vertype='PV'  order by cropid, popularname  LIMIT $start, $limit");
		$query = "SELECT * FROM tblvariety where popularname like '$char%' and vertype='PV'  order by cropid, popularname";
	}
	else if($achar!="" && $char!="ALL")
	{
	$sql_arr_home = mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$achar."' and vertype='PV'  order by cropid ,popularname LIMIT $start, $limit"); 
	$query = "SELECT * FROM tblvariety where varietyid='".$achar."' and vertype='PV'  order by cropid ,popularname";
	}
	else 
	{    
		$sql_arr_home=mysqli_query($link,"select * from tblvariety where vertype='PV'  order by cropid, popularname LIMIT $start, $limit");
		$query = "select * from tblvariety where vertype='PV'  order by cropid, popularname";
	}
//  $sql_arr_home=mysqli_query($link,"select * from tblvariety order by cropid, popularname desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblvariety where vertype='PV' ");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 


$total_pages = mysqli_num_rows(mysqli_query($link,$query));
//echo $total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:950px\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev&char=$char&achar=$achar\">&laquo; Previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter&char=$char&achar=$achar\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&char=$char&achar=$achar\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1&char=$char&achar=$achar\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage&char=$char&achar=$achar\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1&char=$char&achar=$achar\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2&char=$char&achar=$achar\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&char=$char&achar=$achar\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1&char=$char&achar=$achar\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage&char=$char&achar=$achar\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1&char=$char&achar=$achar\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2&char=$char&achar=$achar\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&char=$char&achar=$achar\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next&char=$char&achar=$achar\"> Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\"> Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	}
	 $srno=($page-1)*$limit+1;
	 
	/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		if($_GET['page']!="")
		{
			$page = $_GET['page']; 
			$srno=(($page * 10)+1) - 10;
		}
		else
		{
			$page = 1; 
			$srno=1;
		}
	}
	
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 

	if($achar!="" && $char=="ALL")
	{
	$sql2 = mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$achar."' order by cropid ,popularname LIMIT $from, $max_results"); 
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblvariety where varietyid='".$achar."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	}
	else if( $char!="ALL"  && $achar=="")
	{ 
		$sql2 = mysqli_query($link,"SELECT * FROM tblvariety where popularname like '$char%' order by cropid, popularname  LIMIT $from, $max_results");
		$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblvariety where popularname like '$char%'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0];  
	}
	else 
	{    
		$sql2=mysqli_query($link,"select * from tblvariety order by cropid, popularname LIMIT $from, $max_results");
		$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblvariety");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	}
	$total=mysqli_num_rows($sql2);*/
    if($tot_arr_home >0) { 
?>
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td colspan="15" align="center" class="subheading">Variety List ( <?php echo $total_results;?> )</td>
</tr>
<tr class="Dark" height="25">
	<td width="24" align="center" class="smalltblheading" valign="middle">#</td>
	<td width="107" align="left" class="smalltblheading" valign="middle"><div align="left" class="smalltblheading" style="padding:0px 5px 0px 5px;">Variety Name</div></td>
	<td width="48" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Variety Type</div></td>
	<td width="94" align="left" class="smalltblheading" valign="middle"><div align="left" class="smalltblheading" style="padding:0px 5px 0px 5px;">Crop</div></td>
	<td width="53" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Auto GOT at Arrival</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">GSRP (Months)</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Dormancy Duration (Days)</div></td> 
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">EDOR-G (Days)</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">EDOR-T (Days)</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Test Weight Gms/1000 Seed</div></td>
	<td width="81" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Blending of Inorganic Lots at Raw Stage</div></td>
	<td width="244" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">UPS (SMC)</div></td>
	<td width="49" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">CV's</div></td>
	<td width="27" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Edit</div></td>
	<td width="50" align="center" class="smalltblheading" valign="middle"><div align="center" class="smalltblheading" style="padding:0px 5px 0px 5px;">Status</div></td>
</tr>
<?php
	while($row=mysqli_fetch_array($sql_arr_home))
	{ 
	//echo $row['cropname'];
	$sql_c=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropname']."' order by cropname asc")or die(mysqli_error($link));
	$row_c=mysqli_fetch_array($sql_c);
	
	/*
	$sql_tra=mysqli_query($link,"select * from tblarrival where vvariety='".$row['varietyid']."'")or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);
	
	$sql_tra1=mysqli_query($link,"select * from tblarrival_sub where lotvariety='".$row['popularname']."'")or die(mysqli_error($link));
  	$row_tra1=mysqli_fetch_array($sql_tra1);
	$num_tra1=mysqli_num_rows($sql_tra1);
	
	$sql=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_variety='".$row['varietyid']."'")or die(mysqli_error($link));
  	$row1=mysqli_fetch_array($sql);
	$num=mysqli_num_rows($sql);
	
	$sql_v=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_variety='".$row['popularname']."'")or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_v=mysqli_num_rows($sql_v);*/


$resettargetquery=mysqli_query($link,"select * from tblvariety where pvverid='".$row['varietyid']."' and vertype='CV' ");
$resetresult=mysqli_fetch_array($resettargetquery);
$num_of_records_target_set=mysqli_num_rows($resettargetquery);

/*
//$srno=1;
	while($row=mysqli_fetch_array($res))
	{*/	
	
	/*$resettargetquery=mysqli_query($link,"select * from tblups where uid='".$row['varietyid']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);*/
	
	$p_array=explode(",",$row['gm']);
	$p_array1=explode(",",$row['wtmp']);
	$i=0;
	$p=array();
	$roles="";
	foreach($p_array as $val)
	{
		if($val <> "")
		{
						
			$resettargetquery=mysqli_query($link,"select * from tblups where uid='".$val."'");
  			$resetresult=mysqli_fetch_array($resettargetquery);
			$ups1=$resetresult['ups'];
			$ups2=explode(".",$ups1);
			if($ups2[1]==000)
				$ups=$ups2[0];
			else
				$ups=$ups1;
			if($roles!="")
			{
				$roles=$roles.", ".$ups.$resetresult['wt']." (".$p_array1[$i]."Kgs.)";
			}
			else
			{
				$roles=$ups.$resetresult['wt']." (".$p_array1[$i]."Kgs.)";
			}
		}
		$i++;
	}
	$twgpts='';
	$dq=explode(".",$row['twgptsf']);
	if($dq[1]==000){$qt=$dq[0];}else{$qt=$row['twgptsf'];}
	$dq=explode(".",$row['twgptst']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row['twgptst'];}
	$twgpts=$qt."-".$qt1;
	// echo $row_c['cropname'];
		
	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
	<td valign="middle" align="center" class="smalltbltext"><?php echo $srno?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row['popularname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['vt'];?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row_c['cropname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['opt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['gsdis'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['dorduration'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdtt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $twgpts;?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php if($row['moinlors']=="Yes"){ echo "Allowed";} else { echo "Not-allowed";}  ?></td>
	<td valign="middle" align="left" class="smalltbltext"><div align="left" class="smalltbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $roles;?></div></td>
	<td valign="middle" align="center" class="smalltbltext"><?php if($num_of_records_target_set>0){?><a href="Javascript:void(0);" onclick="opencvview('<?php echo $row['varietyid'];?>');"><?php echo $num_of_records_target_set;?></a><?php } else { ?><?php echo $num_of_records_target_set;?><?php } ?></td>
	<td valign="middle" align="center" class="smalltbltext"><!--<a href="edit_variety.php?page=<?php echo $page;?>&varietyid=<?php echo $row['varietyid'];?>"><img src="#" border="0" onclick="alert('Cannot be edited as Transactions are made using this Variety');" />--></a></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['actstatus'];?></td>
</tr>
<?php
	}
	else
	{ 
?>
<tr class="Dark" height="25">
	<td valign="middle" align="center" class="smalltbltext"><?php echo $srno?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row['popularname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['vt'];?></td>
	<td valign="middle" align="left" class="smalltbltext">&nbsp;<?php echo $row_c['cropname'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['opt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['gsdis'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['dorduration'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['expdtt'];?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $twgpts;?></td>
	<td valign="middle" align="center" class="smalltbltext"><?php if($row['moinlors']=="Yes"){ echo "Allowed";} else { echo "Not-allowed";}  ?></td>
	<td valign="middle" align="left" class="smalltbltext"><div align="left" class="smalltbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $roles;?></div></td>
	<td valign="middle" align="center" class="smalltbltext"><?php if($num_of_records_target_set>0){?><a href="Javascript:void(0);" onclick="opencvview('<?php echo $row['varietyid'];?>');"><?php echo $num_of_records_target_set;?></a><?php } else { ?><?php echo $num_of_records_target_set;?><?php } ?></td>
	<td valign="middle" align="center" class="smalltbltext"><!--<a href="edit_variety.php?page=<?php echo $page;?>&varietyid=<?php echo $row['varietyid'];?>"><img src="#" border="0" onclick="alert('Cannot be edited as Transactions are made using this Variety');" />--></a></td>
	<td valign="middle" align="center" class="smalltbltext"><?php echo $row['actstatus'];?></td>

</tr>
<?php	
}
$srno=$srno+1;
}
//}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">No records Present.<br />Click <a href="home_variety1.php"><font color="#0000FF">HERE</font></a> to  search again<br />
  OR<br />
  Add a New Variety by clicking on "ADD" button</td>
</tr>
</table>
<?php
}
?>
<?php echo $pagination?>
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
