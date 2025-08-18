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
	
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
		$itemid = $_REQUEST['txtcrop'];
		$loc = $_REQUEST['txtvariety'];
		$typ = $_REQUEST['txtvisualck'];
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Viewer- Report -Consolidated Report</title>
<link href="../include/main_viewer.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />
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
<SCRIPT language="JavaScript">

function openprint()
{

var sdate=document.frmaddDepartment.sdate.value; 
var edate=document.frmaddDepartment.edate.value; 
var loc=document.frmaddDepartment.txtcrop.value;
var itemid=document.frmaddDepartment.txtvariety.value;
var typ=document.frmaddDepartment.txtvisualck.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('preport_plant2.php?sdate='+sdate+'&txtcrop='+loc+'&txtvariety='+itemid+'&edate='+edate+'&txtvisualck='+typ,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_viewer.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
  <tr><td>

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#ef0388" style="border-bottom:solid; border-bottom-color:#ef0388" >
	    <tr >
	      <td width="813" height="30">&nbsp;Consolidated Arrival Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$loc = $_REQUEST['txtvariety'];
	$typ = $_REQUEST['txtvisualck'];
?>	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	   <input name="txtvariety" value="<?php echo $loc;?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $edate;?>" type="hidden">  
		 <input name="txtvisualck" value="<?php echo $typ;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php	
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
		$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
	//echo $itemid;
		$crop="ALL";
		if($itemid!="ALL")
		{
			$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
			$row_class=mysqli_fetch_array($sql_class);
			$crop=$row_class['cropname'];	 
		}

	if($loc=="ALL" && $itemid!="ALL")
	{
	$vit="ALL";
	$sql_tbl_s=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where plantcode='$plantcode' AND lotcrop='".$crop."' group by lotvariety, sstage") or die(mysqli_error($link));
	$tot_arsub=mysqli_num_rows($sql_tbl_s);
	}
	else if($loc=="ALL" && $itemid=="ALL")
	{
	$vit="ALL";
	//echo "select distinct sstage, lotvariety from tblarrival_sub group by lotvariety, sstage";
	$sql_tbl_s=mysqli_query($link,"select distinct sstage from tblarrival_sub group by sstage") or die(mysqli_error($link));
	$tot_arsub=mysqli_num_rows($sql_tbl_s);
	}
	else
	{
	$sql_vit=mysqli_query($link,"select * from tblvariety where varietyid='".$loc."' ") or die(mysqli_error($link));
	$row_vit=mysqli_fetch_array($sql_vit);
	$vit=$row_vit['popularname'];
	$sql_tbl_s=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where plantcode='$plantcode' AND lotcrop='".$crop."' and lotvariety='".$vit."' group by lotvariety, sstage") or die(mysqli_error($link));
	$tot_arsub=mysqli_num_rows($sql_tbl_s);
	}
	//echo $tot_arsub;
if($tot_arsub > 0)	
{
?>   	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
	<?php if($typ=="Trading"){$typ1="Trading Arrival";}
	else if($typ=="Fresh Seed with PDN"){$typ1="Fresh Seed  Arrival with PDN";}
	else{$typ1="";}
	?>
    <td align="center" class="subheading" style="color:#303918; " colspan="3"><?php echo $typ1?>  - Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vit;?></td>
  	</tr>
	</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#ef0388" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="31" align="center" valign="middle" class="tblheading">#</td>
			<td width="185"  align="center" valign="middle" class="tblheading"> Variety </td> 
			<td width="116" align="center" valign="middle" class="tblheading">Stage </td>
			<td width="75" align="center" valign="middle" class="tblheading">Total Qty</td>
			<td width="75" align="center" valign="middle" class="tblheading">Qty: GOT-R</td>
			<td width="75" align="center" valign="middle" class="tblheading">Qty: GOT-NR</td>
</tr>

<?php 	
$srno=1; $arr_id="";
while($row_tbl_s=mysqli_fetch_array($sql_tbl_s))
{
//echo $row_tbl_s[0]."<br>".$row_tbl_s[1]."<br>".$row_tbl_s[2]."<br>";
if($loc=="ALL" && $itemid!="ALL")
{
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' AND lotcrop='".$crop."' and sstage='".$row_tbl_s[0]."' order by lotvariety asc") or die(mysqli_error($link));
}
else if($loc=="ALL" && $itemid=="ALL")
{
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where sstage='".$row_tbl_s[0]."' order by lotvariety asc") or die(mysqli_error($link));
}
else
{
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' AND lotcrop='".$crop."' and lotvariety='".$row_tbl_s[1]."' and sstage='".$row_tbl_s[0]."' order by lotvariety asc") or die(mysqli_error($link));
}
$tot_sub=mysqli_num_rows($sql_tbl_sub);
if($tot_sub > 0)
{
$sqty=0; $gotrq=0; $gotnrq=0; $cnt=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($arr_id!="")
$arr_id=$arr_id.",".$row_tbl_sub['arrival_id'];
else
$arr_id=$row_tbl_sub['arrival_id'];
$sql_armain=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' AND arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and arrival_id='".$row_tbl_sub['arrival_id']."' order by arrival_date desc") or die(mysqli_error($link));
$tot_armain=mysqli_num_rows($sql_armain);
if($tot_armain > 0)
{
	$arr_id=$row_tbl_sub['arrival_id'];
	$sqty=$sqty+$row_tbl_sub['act'];
	if($row_tbl_sub['got']=="GOT-R")
	{
		$gotrq=$gotrq+$row_tbl_sub['act'];
	}
	if($row_tbl_sub['got']=="GOT-NR")
	{
		$gotnrq=$gotnrq+$row_tbl_sub['act'];
	}
	$cnt++;
}
}
if($arr_id!="")$aaaa=" and arrival_id IN ($arr_id)";
else
$aaaa="";
//echo $sql="select * from tblarrival where plantcode='$plantcode' AND arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 $aaaa order by arrival_date desc";
$sql_armain12=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' AND arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 $aaaa order by arrival_date desc") or die(mysqli_error($link));
$tot_armain12=mysqli_num_rows($sql_armain12);
if($tot_armain12 > 0 && $cnt > 0)
{
if($srno%2 != 0)
{
?>
<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[1];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[0];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotrq;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotnrq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[1];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_s[0];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotrq;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $gotnrq;?></td>
</tr>
<?php
//echo $sqty;
}
$srno++;	
}
}
}
}
?>
</table>
	
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="preport_plant.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td ></td>
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
