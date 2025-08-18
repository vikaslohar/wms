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
	//$logid="OP1";
	//$lgnid="OP1";
		
	
	//$res_rt=mysqli_query($link,"select * from tbl_opr");
	//$row_rt=mysqli_num_rows($res_rt);
	 
	 //$role='operator';
	//$status='active';
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administrator-  Master - Help Mannual Master</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="../include/validation.js"></script>
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
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" >
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="831" class="Mainheading" height="25">
	  <table width="840" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="840" height="25" class="Mainheading">&nbsp;Help &nbsp;Manual Master </td>
	    </tr></table></td>
	  <td width="100" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#4ea1e1" cellspacing="0" cellpadding="0" width="90" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_help.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onReset="onloadfocus();" > 
	   <input name="frm_action" value="submit" type="hidden">
		 <input name="txt11" value="" type="hidden">
		 <input type="hidden" name="code" value="<?php echo $code;?>" />
		  <input type="hidden" name="scode" value="<?php echo $code1;?>" />
		  
		  <?php
	$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 10; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select * from tblhelp order by help_title LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tblhelp order by help_title";
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
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:880px\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous </a> ";
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
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
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
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> Next &raquo;</a> ";
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
	
	
	$sql_sel="select * from tblhelp order by help_title LIMIT $from, $max_results";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblhelp");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
*/
	if($tot_arr_home >0) { 
?>
		 <br/>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse" height="400">
<tr>
<td valign="top">
<?php //if($row_rt < 3) { ?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="32" align="center" class="tblheading" valign="middle">#</td>
<td width="315" align="left" class="tblheading" valign="middle">&nbsp;File Title </td>
<td width="368" align="center" class="tblheading" valign="middle">Operator</td>
<td width="33" align="center" class="tblheading" valign="middle">Edit</td>
<td width="40" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
//$srno=1;
	while($row=mysqli_fetch_array($sql_arr_home))
	{
	
	$resettargetquery=mysqli_query($link,"select * from tblopr where id='".$row['help_id']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
	$p_array=explode(",",$row['help_role']);
			$i=0;
			$p=array();
			$roles="Admin";
				
			foreach($p_array as $val)
				{
					if($val <> "")
					{
						if($val >0)
					{
						$resettargetquery=mysqli_query($link,"select * from tblopr where id='".$val."'");
  						$resetresult=mysqli_fetch_array($resettargetquery);
						
						if($roles!="")
						{
						 $roles=$roles.", ".$resetresult['name'];
						}
						else
						{
						 $roles=$resetresult['name'];
						}
					}
				}
				}

	if ($srno%2 != 0)
	{

	
?>

<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['help_title'];?></div></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo ($roles);?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_help.php?fid=<?php echo $row['help_id'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=help&code=<?php echo $row['help_id'];?>" onClick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#000000"><?php echo $row['help_title'];?></div></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo ($roles);?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_help.php?fid=<?php echo $row['help_id'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=help&code=<?php echo $row['help_id'];?>" onClick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='800' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page "; 
 
	
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
		echo "</td></tr></table>"; */
//}

//}
?>
<?php// } else { ?>
<!--/*<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" v >
<tr >
<td valign="top" align="center" class="tblheading">Maximum of 3 Operator Roles can be created. You have reached to maximum limit.
</td>
</tr>
<tr >
<td valign="top" align="center"><a href="operator_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;</td>
</tr>
</table>
*/--><?php //} ?>
<?php echo $pagination?></td>
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
