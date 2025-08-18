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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$achar=trim($_POST['txtsid']);
		echo "<script>window.location='home_gotlocation1.php?achar=$achar'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration- GOT Location Master - GOT Location Home</title>
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
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
         </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="500" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">		  
<!-- actual page start--->	
	  
		     <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="30"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="30">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="810" height="25">&nbsp;GOT Location   Master</td>
	    </tr></table></td>
	  <td width="139" height="30" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_gotlocation.php" style="text-decoration:none; color:#FFFFFF">Add</a></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
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
	$sql_arr_home = mysqli_query($link,"SELECT * FROM tbl_gotlocation where loc_name='".$achar."' order by loc_name LIMIT      $start, $limit"); 
	$query = "SELECT * FROM tbl_gotlocation where loc_name='".$achar."' order by loc_name";
	}
	else if( $char!="ALL"  && $achar=="")
	{ 
		$sql_arr_home = mysqli_query($link,"SELECT * FROM tbl_gotlocation where loc_name like '$char%' order by loc_name  LIMIT $start, $limit");
		$query = "SELECT * FROM tbl_gotlocation where loc_name like '$char%' order by loc_name";
	}
	else 
	{    
		$sql_arr_home=mysqli_query($link,"SELECT * FROM tbl_gotlocation order by loc_name LIMIT $start, $limit");
		$query = "SELECT * FROM tbl_gotlocation order by loc_name";
	}
//  $sql_arr_home=mysqli_query($link,"select * from tblvariety order by cropid, popularname desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_gotlocation order by loc_name"),0); 


$total_pages = mysqli_num_rows(mysqli_query($link,$query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:750px\">";
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
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	if($achar!="")
	{
	$sql = mysqli_query($link,"SELECT * FROM tblproductionlocation where productionlocation like '".$achar."%' order by productionlocation  LIMIT $from, $max_results"); 
	$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblproductionlocation where productionlocation like '%".$achar."%'"),0); 
	}
	else if( 'ALL'!= $char)
	{
		$sql = mysqli_query($link,"SELECT * FROM tblproductionlocation where productionlocation like '".$char."%' order by state, productionlocation  LIMIT $from, $max_results");
		$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblproductionlocation where productionlocation like '".$char."%'"),0);  
	}
	else 
	{
		$sql = mysqli_query($link,"SELECT * FROM tblproductionlocation order by state, productionlocation LIMIT $from, $max_results"); 
		$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblproductionlocation"),0); 
	}
	$total=mysqli_num_rows($sql);*/
    if($tot_arr_home >0) { 
	
	//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_partymaser"),0); 

	
?>
<table align="center" border="1" width="581" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by Alphabet </td>
</tr>
<tr class="Dark">
<td width="31" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=ALL" class="link">All</a></td>
<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=A" class="link">A</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=B" class="link">B</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=C" class="link">C</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=D" class="link">D</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=E" class="link">E</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=F" class="link">F</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=G" class="link">G</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=H" class="link">H</a></td>

<td width="13" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=I" class="link">I</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=J" class="link">J</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=K" class="link">K</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=L" class="link">L</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=M" class="link">M</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=N" class="link">N</a></td>

<td width="15" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=O" class="link">O</a></td>

<td width="22" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=P" class="link">P</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=Q" class="link">Q</a></td>

<td width="16" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=R" class="link">R</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=S" class="link">S</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=T" class="link">T</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=U" class="link">U</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=V" class="link">V</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=W" class="link">W</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=X" class="link">X</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=Y" class="link">Y</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="home_gotlocation1.php?char=Z" class="link">Z</a></td>
</tr>
</table>

<br />
<table align="center" border="1" width="581" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >  <tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by GOT Location </td>
</tr>
  </table>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="581" bordercolor="#d21704" style="border-collapse:collapse">
   <tr class="Dark" height="25">
  
   <td width="125" align="right"  valign="middle" class="tblheading">&nbsp;GOT Location&nbsp;</td>
    <td width="290" align="left"  valign="middle" >&nbsp;<input name="txtsid" type="text" size="42" class="tbltext" tabindex="0" maxlength="35"   v/></td>
	<td width="158" align="center"  valign="middle" ><input name="Submit" type="image" src="../images/search.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;" align="middle"></td>
   </table>

 <table align="center" border="1" cellspacing="0" cellpadding="0" width="581" bordercolor="#d21704" style="border-collapse:collapse"><tr class="tblsubtitle" height="20">
   <td colspan="7" align="center" class="subheading">GOT Location List (<?php echo $total_results;?>)</td>
   <!-- <td width="112" align="right" class="tblheading"><a href="home_crop1.php">Search By Crop</a>&nbsp;</td>-->
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="581" bordercolor="#d21704" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="48" align="center" class="tblheading" valign="middle">#</td>
<td width="174" align="left" class="tblheading" valign="middle">&nbsp;GOT Location</td>
<td width="160" align="center" class="tblheading" valign="middle">State</td>
<td width="88" align="center" class="tblheading" valign="middle">Status</td>
<td width="93" align="center" class="tblheading" valign="middle">Edit</td>
<td width="94" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php

	while($row=mysqli_fetch_array($sql_arr_home))
	{
	$sql_f=mysqli_query($link,"select *  from tbl_gotlocation where loc_id='".$row['loc_id']."'");
  	$result_f=mysqli_fetch_array($sql_f);
  	$num_of_farmers=mysqli_num_rows($sql_f);
	
	$sql_f1=mysqli_query($link,"select * from tbl_state where state_id='".$row['state']."'");
  	$result_f1=mysqli_fetch_array($sql_f1);
   $num_of_farmers1=mysqli_num_rows($sql_f1);
	
	/*$sql_tra=mysqli_query($link,"select * from tblarrival where productionlocationid=".$row['productionlocationid'])or die(mysqli_error($link));
  	$row_tra=mysqli_fetch_array($sql_tra);
	$num_tra=mysqli_num_rows($sql_tra);
	
	$sql_tra1=mysqli_query($link,"select * from tblissue where productionlocationid='".$row['productionlocationid']."'")or die(mysqli_error($link));
  	$row_tra1=mysqli_fetch_array($sql_tra1);
	$num_tra1=mysqli_num_rows($sql_tra1);*/
	
	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['loc_name']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $result_f1['state_name']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['actstatus']?></td>
<td valign="middle" align="center" class="tbltext"><a href="edit_gotlocation.php?id=<?php echo $row['loc_id']?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" align="center" class="tbltext"><a href="../include/delete.php?print=gotlocation&code=<?php echo $row['loc_id']?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td></tr>
	<?php
	} 
	else
	{
	?>

<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['loc_name']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $result_f1['state_name']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['actstatus']?></td>
<td valign="middle" align="center" class="tbltext"><a href="edit_gotlocation.php?id=<?php echo $row['loc_id']?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" align="center" class="tbltext"><a href="../include/delete.php?print=gotlocation&code=<?php echo $row['loc_id']?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td></tr>
<?php	}
	 $srno=$srno+1;
	}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='581' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&char=$char\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&char=$char\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&char=$char\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; */
}
else
{
?>
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">No records Present.<br />Click <a href="home_gotlocation1.php"><font color="#0000FF">HERE</font></a> to  search again<br />
  OR<br />
  Add a New Location by clicking on "ADD" button</td>
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
