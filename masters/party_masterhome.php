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
	if(isset($_REQUEST['cchar']))
	{
	 $cchar = $_REQUEST['cchar'];	 
	}
	else
	{
	$cchar = "";
	}
	/*if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}
	if(isset($_REQUEST['classification']))
	{
	$classification = $_REQUEST['classification'];
	}
	if(isset($_REQUEST['p_id']))
	{
	$p_id = $_REQUEST['p_id'];
	}*/
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$achar=trim($_POST['txtsid']);
		$cchar=trim($_POST['txtclassid']);
		echo "<script>window.location='party_masterhome.php?achar=$achar&cchar=$cchar'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration- Party Master -Party Home</title>
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
if(document.frmaddDepartment.txtsid.value=="" && document.frmaddDepartment.txtclassid.value=="")
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
           <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
         </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="600" align="center" border="0" cellspacing="0" cellpadding="0">
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
	      <td width="810" height="25">&nbsp;Party  Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="selectparty.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
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
	
	if($achar!="")
	{
	$sql = mysqli_query($link,"SELECT * FROM tbl_partymaser where business_name like '%".$achar."%' order by business_name  LIMIT $from, $max_results"); 
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_partymaser where business_name like '%".$achar."%'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	}
	else if($cchar!="")
	{
	$sql = mysqli_query($link,"SELECT * FROM tbl_partymaser where classification like '%".$cchar."%' order by business_name  LIMIT $from, $max_results"); 
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_partymaser where classification like '%".$cchar."%'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	}
	else if( 'ALL'!= $char)
	{
		$sql = mysqli_query($link,"SELECT * FROM tbl_partymaser where business_name like '".$char."%' order by business_name  LIMIT $from, $max_results");
		$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_partymaser where business_name like '".$char."%'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0];  
	}
	else 
	{
		$sql = mysqli_query($link,"SELECT * FROM tbl_partymaser order by business_name LIMIT $from, $max_results"); 
		$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_partymaser");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	}
	$total=mysqli_num_rows($sql);
    if($total >0) { 
	
	//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_partymaser");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

	
?>
<table align="center" border="1" width="581" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by Alphabet </td>
</tr>
<tr class="Dark">
<td width="31" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=ALL" class="link">All</a></td>
<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=A" class="link">A</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=B" class="link">B</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=C" class="link">C</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=D" class="link">D</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=E" class="link">E</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=F" class="link">F</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=G" class="link">G</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=H" class="link">H</a></td>

<td width="13" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=I" class="link">I</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=J" class="link">J</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=K" class="link">K</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=L" class="link">L</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=M" class="link">M</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=N" class="link">N</a></td>

<td width="15" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=O" class="link">O</a></td>

<td width="22" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=P" class="link">P</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=Q" class="link">Q</a></td>

<td width="16" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=R" class="link">R</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=S" class="link">S</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=T" class="link">T</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=U" class="link">U</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=V" class="link">V</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=W" class="link">W</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=X" class="link">X</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=Y" class="link">Y</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="party_masterhome.php?char=Z" class="link">Z</a></td>
</tr>
</table>

<br />
<table align="center" border="1" width="581" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >  <tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by Name </td>
</tr>
  </table>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="581" bordercolor="#4ea1e1" style="border-collapse:collapse">
   <tr class="Dark" height="25">
  
   <td width="125" align="right"  valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
    <td width="290" align="left"  valign="middle" >&nbsp;<input name="txtsid" type="text" size="42" class="tbltext" tabindex="0" maxlength="35"   /></td>
	<td width="158" rowspan="2" align="center"  valign="middle" ><input name="Submit" type="image" src="../images/search.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;" align="middle"></td>
	</tr>
	
	<tr class="Dark" height="25">
  
   <td width="125" align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
    <td width="290" align="left"  valign="middle" >&nbsp;<input name="txtclassid" type="text" size="42" class="tbltext" tabindex="0" maxlength="35"   v/></td>
	</tr>
   </table>

 <table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Party Master List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="61" align="center" class="tblheading" valign="middle">#</td>
    <td width="281" align="left" class="tblheading" valign="middle">&nbsp;Party Name </td>
    <td width="141" align="center" class="tblheading" valign="middle">Classification<br />    </td>
    <td width="105" align="center" class="tblheading" valign="middle">Edit</td>
    <td width="97" align="center" class="tblheading" valign="middle">Delete</td>
  </tr>
  <?php
//$srno=1;
	while($row=mysqli_fetch_array($sql))
	{
	
	$sql_tra1=mysqli_query($link,"select * from tblarrival where party_id=".$row['p_id'])or die(mysqli_error($link));
  	$row_tra1=mysqli_fetch_array($sql_tra1);
	  $num_tra1=mysqli_num_rows($sql_tra1);
	
	$sql1=mysqli_query($link,"select * from tbl_orderm where orderm_party =".$row['p_id'])or die(mysqli_error($link));
  	$row1=mysqli_fetch_array($sql1);
	  $num=mysqli_num_rows($sql1);
	/*$sql_v=mysqli_query($link,"select * from tbl_stldg_good where stlg_trpartyid='".$row['p_id']."'")or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_of_records_target_set2 =mysqli_num_rows($sql_v);
	
	$sql_v=mysqli_query($link,"select * from tbl_stldg_damage where stld_trpartyid='".$row['p_id']."'")or die(mysqli_error($link));
  	$row_v=mysqli_fetch_array($sql_v);
	$num_of_records_target_set3 =mysqli_num_rows($sql_v);*/
	//echo $row['classification'];
	if ($srno%2 != 0)
	{
	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['business_name'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php if( $row['classification']=="Export Buyer"){
	?><a href="edit_party_master2.php?pid=<?php echo $row['p_id'];?>"><img src="../images/edit.png" border="0" /></a><?php } else if( $row['classification']=="Import Trader"){ ?><a href="edit_party_master3.php?pid=<?php echo $row['p_id'];?>"><img src="../images/edit.png" border="0" /></a><?php } else { ?><a href="edit_party_master1.php?pid=<?php echo $row['p_id'];?>"><img src="../images/edit.png" border="0" /></a><?php }?>
	 </td>
    <td valign="middle" class="tbltext" align="center"><?php if( $num_tra1 > 0|| $num > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:pointer" onclick="alert('Cannot be deleted this party has been used in transaction')"  />
<?php } else { ?><a href="../include/delete.php?print=party&code=<?php echo $row['p_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['business_name'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php if( $row['classification']=="Export Buyer"){
	?><a href="edit_party_master2.php?pid=<?php echo $row['p_id'];?>"><img src="../images/edit.png" border="0" /></a><?php } else if( $row['classification']=="Import Trader"){ ?><a href="edit_party_master3.php?pid=<?php echo $row['p_id'];?>"><img src="../images/edit.png" border="0" /></a><?php } else { ?><a href="edit_party_master1.php?pid=<?php echo $row['p_id'];?>"><img src="../images/edit.png" border="0" /></a><?php }?>
	 </td>
    <td valign="middle" class="tbltext" align="center"><?php if( $num_tra1 > 0|| $num > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:pointer" onclick="alert('Cannot be deleted this party has been used in transaction')"  />
<?php } else { ?><a href="../include/delete.php?print=party&code=<?php echo $row['p_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>

</tr>
  <?php	
  }
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
		echo "</td></tr></table>"; 
}
else
{
?>
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">No records Present.<br />Click <a href="party_Masterhome.php"><font color="#0000FF">HERE</font></a> to  search again<br />
  OR<br />
  Add a New Party by clicking on "ADD" button</td>
</tr>
</table>
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
