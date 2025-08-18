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
	
	
	if(isset($_REQUEST['cropid']))
	{
   $pid = $_REQUEST['cropid'];
	}

	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW- Qc Sampling-Select output</title>
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

<script language="JavaScript">
function mySubmit()
{ 
	if(document.frmaddDepartment.fet1.value == "")
{
alert("Please select Output Type");
return false;
}
	return true;	 
}
function test1(fet11)
{
if (fet11!="")
{
document.frmaddDepartment.fet1.value=fet11;
}
}	


function openslocpopprint()
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('grn.php?p_id='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

//}

function openslocpopprint1()
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('oltonln.php?p_id='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
//}


function openprintsubbin(subid, bid, wid, lid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function openprintbin(bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('bin_sloc_details_print.php?bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); bin_sloc_details_print
}
</script>

<body>


<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: Qc sampling-Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
   <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
 <br />
 <?php 
/*$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_qcgen where arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
 $arrival_id=$row_tbl['arrival_id'];
 
$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;*/
?> 
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">Transaction Outputs</td>
</tr>
</table>

<br />


<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
    <?php
	$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_qcgen where arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
 $arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_qcgen1 where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=$tid;

$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>
<tr class="tblsubtitle" height="20">
  <!----><td width="4%"  align="center" valign="middle" class="tblheading">#</td>
    
    <td width="15%"  align="center" valign="middle" class="tblheading">Crop</td>
    <td width="17%"  align="center" valign="middle" class="tblheading">Variety</td>	
			  <td width="15%" align="center" valign="middle" class="tblheading">Lot No. </td>
			  <td width="12%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="15%" align="center" valign="middle" class="tblheading">Stage</td>
			   <td width="9%" align="center" valign="middle" class="tblheading">GOT</td>
               <td width="15%" align="center" valign="middle" class="tblheading">Quality</td>
			   </tr>
  <?php
 
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

   $quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	$vv=$rowvv['popularname'];
	
   $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$crop=$row31['cropname'];
	$lot=$row_tbl_sub['lotno'];
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lot."'") or die(mysqli_error($link));
   $row_tbl=mysqli_fetch_array($sql_tbl);
    $tot=mysqli_num_rows($sql_tbl);		
    $lotldg_trid=$row_tbl['lotldg_trid'];

	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trid='".$lotldg_trid."'") or die(mysqli_error($link));
    $row_tbl=mysqli_fetch_array($sql_tbl);
    $tot=mysqli_num_rows($sql_tbl);		
    $arrival=$row_tbl['lotldg_trbags'];
    $pp="";
			 if($row_tbl_sub['pp']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['pp'];
		}
		else
		{
		$pp=$row_tbl_sub['pp'];
		}
		}
		if($row_tbl_sub['gemp']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['gemp'];
		}
		else
		{
		$pp=$row_tbl_sub['gempp'];
		}
		}
		if($row_tbl_sub['got']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['got'];
		}
		else
		{
		$pp=$row_tbl_sub['got'];
		}
		}
		if($row_tbl_sub['moist']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['moist'];
		}
		else
		{
		$pp=$row_tbl_sub['moist'];
		}
		
		}
		if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
    <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>
	  <td width="15%" align="center" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl_sub['stage'];?>&nbsp;</td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_got1'];?></td>
	 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
        </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
    <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>
	   <td width="15%" align="center" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl_sub['stage'];?>&nbsp;</td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_got1'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	        </tr>
  <?php
}
$srno++;
}
}


?>
</table>
<table align="center" width="314" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_qc.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;&nbsp;</td>	
</tr>
</table>
</form></td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table><!-- actual page end--->			  
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
