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
	$department_id = $_REQUEST['department_id'];
	}

	$sql_p1=mysqli_query($link,"SELECT * FROM tbldept where department_id='".$department_id."' and plantcode='$plantcode' ")or die(mysqli_error($link));
  	$row_p1=mysqli_fetch_array($sql_p1);
	//echo $row_p1['department'];
	$ce=0;
if($row_p1['department']=="Admin")
{
	$ce=1;
}
if($row_p1['department']=="Arrival")
{
	$ce=2;
}
if($row_p1['department']=="CSW")
{
	$ce=1;
}
if($row_p1['department']=="Decode")
{
	$ce=2;
}
if($row_p['department']=="Dispatch")
{
	$ce=3;
}
if($row_p['department']=="Order Booking")
{
	$ce=3;
}
if($row_p['department']=="Packaging")
{
	$ce=3;
}
if($row_p['department']=="Plant Manager")
{
	$ce=1;
}
if($row_p['department']=="Processing")
{
	$ce=1;
}
if($row_p['department']=="PSW")
{
	$ce=1;
}
if($row_p['department']=="Quality")
{
	$ce=2;
}
if($row_p['department']=="RSW")
{
	$ce=1;
}
if($row_p['department']=="Sales Return")
{
	$ce=1;
}

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administration- Operator Master -Operator Home</title>
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

function butnchk()
{
alert("Maximum Limit to add Operator(s) is Reached");
}
</script>
<SCRIPT language="JavaScript" type="text/javascript">

function openprint()
{
//var dateto=document.frmaddDept.dateto.value;
//var datefrom=document.frmaddDept.datefrom.value;
winHandle=window.open('report_opr.php?department_id=<?php echo $department_id?>','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="810" class="Mainheading" height="25">
	  <table width="814" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="814" height="25">&nbsp;Operator Master </td>
	    </tr></table></td>
	  <td width="100" height="30" align="right" class="submenufont" >&nbsp;</td>
	  
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
$sql_sel="select * from tblopr where department_id='$department_id' and plantcode='$plantcode' order by name";
   	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	 $total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblopr where department_id='$department_id' and plantcode='$plantcode'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
	if($total >0) { 
	
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Operator List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="455" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="130" align="center" class="tblheading" valign="middle">Operator ID </td>
<td width="187" align="left" class="tblheading" valign="middle">&nbsp;&nbsp;Name</td>
<td width="130" align="center" class="tblheading" valign="middle">Department</td>
</tr>
<?php
$sql_del=mysqli_query($link,"select max(department_id) from tblopr where department_id='$department_id' and plantcode='$plantcode'")or die("Error".mysqli_error($link));
 $row_del=mysqli_fetch_row($sql_del);
$code=$row_del[0];

$srno=1;
	while($row=mysqli_fetch_array($res))
	{
	$resettargetquery=mysqli_query($link,"select * from tblopr where id='".$row['id']."' and plantcode='$plantcode'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);
	
	$sql_p=mysqli_query($link,"SELECT * FROM tbldept where department_id='".$row['department_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
  	$row_p=mysqli_fetch_array($sql_p);
 	$num_p=mysqli_num_rows($sql_p);
	
	$quer24=mysqli_query($link,"SELECT * FROM tbldestination where did='".$row['did']."' and plantcode='$plantcode' order by dest"); 
	$noticia24=mysqli_fetch_array($quer24);

	if($row_p['department']=="Admin")
{
$row['code']="Adm";
}
if($row_p['department']=="Arrival")
{
$row['code']="ARR";
}
else if($row_p['department']=="CSW")
{
$row['code']="CSW";
}
else if($row_p['department']=="Decode")
{
$row['code']="DEC";
}
else if($row_p['department']=="Dispatch")
{
$row['code']="DISP";
}
else if($row_p['department']=="Order Booking")
{
$row['code']="OB";
}
else if($row_p['department']=="Packaging")
{
$row['code']="PAC";
}
else if($row_p['department']=="Plant Manager")
{
$row['code']="PM";
}
else if($row_p['department']=="Processing")
{
$row['code']="PROC";
}

else if($row_p['department']=="PSW")
{
$row['code']="PSW";
}

else if($row_p['department']=="Quality")
{
$row['code']="QTY";
}
else if($row_p['department']=="RSW")
{
$row['code']="RSW";
}
else if($row_p['department']=="Sales Return")
{
$row['code']="SR";
}
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $row['code'].$srno;?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['department'];?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo $row['code'].$srno;?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['department'];?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
<br/>
<!--<table width="647" height="21" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr height="25" >
    <td  colspan="8" align="Right" class="subheading" style="color:#303918; "><br/>
    <td width="244"  colspan="8" align="Right"  class="smalltbltext" style="color:#303918; "><font color="#FF0000" >* </font>Max.  Operator roles allowed</td>
  </tr>
  </table>-->
<TABLE class="tbltext" width="402" align="center">
                          <TBODY>
                          <tr>
<td width="512" align="center"><a href="masterreports.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"></a></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/printpreview.gif" alt="Submit Value" OnClick="openprint()" border="0" style="display:inline;cursor:hand;" tabindex="19"></td>
</tr></TBODY></TABLE>

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
