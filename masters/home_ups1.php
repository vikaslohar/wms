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
	
	
	if(isset($_REQUEST['uid']))
	{
	$uid = $_REQUEST['uid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	$ups=trim($_POST['txtups']);
		$wt=trim($_POST['txtwt']);
				
		 $query=mysqli_query($link,"SELECT * FROM tblups_tdf  where ups='$classification' and classification_id!='$classification_id'") or die("Error: " . mysqli_error($link));
		// exit;
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
	  //$sql_in="UPDATE tblups SET classification='$classification' where classification_id ='$classification_id'";
		
					//exit;						
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_ups1.php'</script>";	
		}
	  }	
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration-UPS Master -UPS Home</title>
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
          <td width="100%" valign="top"  height="900" align="center"  class="midbgline">		  
<!-- actual page start--->	
	  
		    <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="831" class="Mainheading" height="25">
	  <table width="840" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="840" height="25" class="Mainheading">&nbsp;UPS&nbsp;Master </td>
	    </tr></table></td>
	  <td width="100" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#4ea1e1" cellspacing="0" cellpadding="0" width="90" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_ups1.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  >
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php
	$sql_sel="select * from tblups_tdf order by uom";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblups_tdf");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
  <tr height="25" >
    <td width="643" colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" /> UPS List (<?php echo $total_results;?>)</td> </tr>
   
      
 
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="26" align="center" class="tblheading" valign="middle">#</td>
<td width="100" align="left" class="tblheading" valign="middle">&nbsp;UPS</td>
<td width="51" align="center" class="tblheading" valign="middle">UoM</td>
<td width="79" align="center" class="tblheading" valign="middle">UoM in Kgs.</td>
<td width="394" align="center" class="tblheading" valign="middle">Crop(s)</td>
  <td width="34" align="center" class="tblheading" valign="middle">Edit</td>
<td width="50" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
$srno=1;$ups="";
	while($row=mysqli_fetch_array($res))
	{
	 $resettargetquery=mysqli_query($link,"select * from tblups_tdf where ups='".$row['tid']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
	$ups1=$row['ups'];
	$ups2=explode(".",$ups1);
	if($ups2[1]==000)
	$ups=$ups2[0];
	else
	$ups=$ups1;
	
	//echo $ups;
	if ($srno%2!= 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $ups;?></div></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['wt']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['uom']?></td>
<td valign="middle" class="tbltext" align="center"><?php
			$p1_array=explode(";",$row['crop']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				$query="select cropname from tblcrop where cropid='$val1'";
				$sql_p1=mysqli_query($link,$query);
				$row_p1=mysqli_fetch_row($sql_p1);
				$p1[$i++]=$row_p1[0];
				}
				}
				echo $str_p1=implode(", ",$p1);
		?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_ups1.php?tid=<?php echo $row['tid'];?>"><img src="../images/edit.png" border="0" /></a></td>

<td valign="middle" class="tbltext" align="center"><?php if($num_of_records_target_set > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onClick="alert('Cannot be deleted as Transactions are made using this UPS')" />
<?php } else { ?><a href="../include/delete.php?print=up&code=<?php echo $row['tid']?>" onClick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $ups;?></div></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['wt']?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['uom']?></td>
<td valign="middle" class="tbltext" align="center"><?php
			$p1_array=explode(";",$row['crop']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				$query="select cropname from tblcrop where cropid='$val1'";
				$sql_p1=mysqli_query($link,$query);
				$row_p1=mysqli_fetch_row($sql_p1);
				$p1[$i++]=$row_p1[0];
				}
				}
				echo $str_p1=implode(", ",$p1);
		?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_ups1.php?tid=<?php echo $row['tid'];?>"><img src="../images/edit.png" border="0" /></a></td>

<td valign="middle" class="tbltext" align="center"><?php if($num_of_records_target_set > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onClick="alert('Cannot be deleted as Transactions are made using this UPS')" />
<?php } else { ?><a href="../include/delete.php?print=up&code=<?php echo $row['tid']?>" onClick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
	
?>
</table>
<?php
}
?>
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="selectups.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
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
