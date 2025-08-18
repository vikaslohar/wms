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
	
	if(isset($_REQUEST['department_id']))
	{
	$department = $_REQUEST['department_id'];
	}
	if(isset($_REQUEST['name']))
	{
	$name = $_REQUEST['name'];
	}
	
	if(isset($_REQUEST['id']))
	{
	$id = $_REQUEST['id'];
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administrator -Report FAQ Report</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<link href="/include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">
		  
		  <!-- actual page start--->	
	   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#0000000" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	     <td width="810" height="25">&nbsp; FAQ Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">
</table></td>
	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
        <tr height="7">
          <td height="7"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td bgcolor="#FFFFFF">
		<?php
	
	/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;} 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	*/
	
	$sql_sel="SELECT * FROM tbldept WHERE plantcode='$plantcode' order by department Asc";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbldept WHERE plantcode='$plantcode'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) {
?>

              <table align="center" border="0" cellspacing="0" cellpadding="0" width="450" style="border-collapse:collapse">
                <tr height="25" >
                  <td colspan="8" align="center" class="subheading" style="color:#303918; ">Department Wise FAQ List 
                    (
                    <?php echo $total_results;?>)</td>  
                                    
                </tr>
              </table>
            <table align="center" border="1" cellspacing="0" cellpadding="0" width="400" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="33" align="center" class="tblheading" valign="middle">#</td>
<td width="125" align="left" class="tblheading" valign="middle">&nbsp;Department</td>
<td width="105" align="center" class="tblheading" valign="middle">No. of Questions 
  </td>
</tr>
<?php
$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	
	$i=0;	$roles="";
     	$sql_p=mysqli_query($link,"SELECT * FROM tblfaq WHERE plantcode='$plantcode'")or die(mysqli_error($link));
  		while($row_p=mysqli_fetch_array($sql_p))
		{
		//$num_p=mysqli_num_rows($sql_p);
			$p=$row_p['faq_role'];
			$p1=array();
			$p_array=explode(",", $p);
			
				foreach($p_array as $val1)
				{
				 	if($val1<>"")
				 	{
						if($val1 == $row['department_id']) { $i++;}
					}
				}
	}			
				//echo $i;
	
	if ($srno%2!= 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['department'];?></td>
<td valign="middle" class="tbltext" align="center"><?php if($i!=0){?><a href="edit_faq.php?department_id=<?php echo $row['department_id'];?>"><?php echo $i;?></a><?php } else {?><?php echo $i;?><?php } ?></td>

</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['department'];?></td>
<td valign="middle" class="tbltext" align="center"><?php if($i!=0){?><a href="edit_faq.php?department_id=<?php echo $row['department_id'];?>"><?php echo $i;?></a><?php } else {?><?php echo $i;?><?php } ?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="masterreports.php"><img src="../images/back.gif" border="0" style="cursor:hand" /></a>&nbsp;</td>
</tr>
</table>
            </td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
	  </form>	  </td>
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
