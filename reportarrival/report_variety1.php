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
		//$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtcrop'];
		$loc = $_REQUEST['txtvariety'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant-Report -Period Wise Report</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_variety2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <?php
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$vv = $_REQUEST['txtvariety'];
	
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
		


	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

if($_GET['txtvariety'] != 'ALL')
	 {
	 $ss = "select popularname from tblvariety where varietyid='".$_GET['txtvariety']."'  and vertype='PV'";
	 		$rr = mysqli_query($link,$ss) or die(mysqli_error($link));	 
			$ros = mysqli_fetch_array($rr);
			$cls = $ros['popularname'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }


?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25">&nbsp;Crop Wise Variety Wise Arrivals Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	   <input name="txtvariety" value="<?php echo $vv;?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo  $cls;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			   <td width="5%" align="center" valign="middle" class="tblheading">Date</td>
			    <td width="8%" align="center" valign="middle" class="tblheading">Arrival  Type</td>
			 <td width="8%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Prelminiary Qc</td>
			              <td align="center" valign="middle" class="tblheading">Got Ststus </td>
              </tr>
<?php
$srno=1;
$sql_armain=mysqli_query($link,"select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' group by arrival_date order by arrival_date desc ") or die(mysqli_error($link));
$tot_armain+mysqli_num_rows($sql_armain);

while($row_armain=mysqli_fetch_array($sql_armain))
{
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_date='".$row_armain['arrival_date']."' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date desc ") or die(mysqli_error($link));

while($row=mysqli_fetch_array($sql_arr_home))
	{
	
		$arrival_id=$row['arrival_id'];

	if($vv=="ALL" )
	{
		$sql_cit=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_cit=mysqli_fetch_array($sql_cit);
		$cit=$row_cit['cropname'];
		
		if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotcrop='".$itemid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		else
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotcrop='".$cit."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		//$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
		$tot_arsub=mysqli_num_rows($sql_tbl_sub);
	}
	else
	{
		$sql_vit=mysqli_query($link,"select * from tblvariety where varietyid='".$vv."'  and vertype='PV'") or die(mysqli_error($link));
		$row_vit=mysqli_fetch_array($sql_vit);
		$vit=$row_vit['popularname'];
		
		$sql_cit=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_cit=mysqli_fetch_array($sql_cit);
		$cit=$row_cit['cropname'];
		
		if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotvariety='".$vv."' and lotcrop='".$itemid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		else
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row['arrival_id']."' and lotvariety='".$vit."' and lotcrop='".$cit."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
		}
		$tot_arsub=mysqli_num_rows($sql_tbl_sub);
	}

if($tot_arsub > 0)	
{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	$sqty=0; $bags=0;
	$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	 $row_sloc['bags'];
	$sqty=$sqty+$row_sloc['qty'];
	$bags=$sqty+$row_sloc['bags'];
	}

	$stage="";
	
	if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
	{
	$stage=$row['sstage'];
	}
	else
	{
	$stage=$row_tbl_sub['sstage'];
	}
	
	$variety="";
	
	if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
	{
		$sql_vt=mysqli_query($link,"select * from tblvariety where varietyid='".$row['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
		$row_vt=mysqli_fetch_array($sql_vt);
		$variety=$row_vt['popularname'];
	}
	else
	{
	$variety=$row_tbl_sub['lotvariety'];
	}
	$crop="";
	
	if($row['arrival_type']=="Trading" || $row['arrival_type']=="StockTransfer Arrival")
	{
		$sql_vt=mysqli_query($link,"select * from tblcrop where cropid='".$row['lotcrop']."'") or die(mysqli_error($link));
		$row_vt=mysqli_fetch_array($sql_vt);
		$crop=$row_vt['cropname'];
	}
	else
	{
	$crop=$row_tbl_sub['lotcrop'];
	}
	$lotno=""; $bags="";
	if($lotno!="")
	{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
	}
	else
	{
		$lotno=$row_tbl_sub['lotno'];
	}

	$tdate=$row['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
		    <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row['arrival_type']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
              <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>
         </tr>
<?php
}
else
{
?>
<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
		    <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row['arrival_type']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
              <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
          </table>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_variety.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
