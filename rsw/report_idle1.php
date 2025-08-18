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
	
		$age = $_REQUEST['age'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rsw-Report Coded Stock Report</title>
<link href="../include/main_rsw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
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

var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var age=document.frmaddDepartment.age.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_variety2.php?txtcrop='+itemid+'&txtvariety='+vv+'&age='+age,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_rsw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
  <tr><td>
   <?php
		$age = $_REQUEST['age'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
	$crp="ALL"; $ver="ALL";
	$qry="select * from tbl_lot_ldg where lotldg_sstage='Raw' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
	$qry.="and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'  and vertype='PV'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($age=="upto90")
	{	
	$dt=date("d-m-Y", strtotime("-90 days"));
	$qry.="and lotldg_trdate>='$dt' ";
	}
	else if($age=="more90")
	{	
	$dt=date("d-m-Y", strtotime("-90 days"));
	$qry.="and lotldg_trdate<'$dt' ";
	}
	$qry.="and lotldg_balqty > 0 ";
	
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" style="border-bottom:solid; border-bottom-color:#e48324" >
	    <tr >
	      <td width="813" height="25">&nbsp;Raw Seed Idle Report </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="age" value="<?php echo $age;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
  	</tr>-->
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#e48324" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="7%" align="center" valign="middle" class="tblheading">Date of Arrival</td>
			  <td width="13%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="17%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="15%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="5%" align="center" valign="middle" class="tblheading">NoB</td>
			
              <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Organiser</td>
              <td width="9%" align="center" valign="middle" class="tblheading">QC Status</td>
			    <td width="9%" align="center" valign="middle" class="tblheading">GOT Status</td>
</tr>
<?php
$cdt=date("d-m-Y");

   function timeDiff($t1, $t2)
{
   if($t1 > $t2)
   {
      $time1 = $t2;
      $time2 = $t1;
   }
   else
   {
      $time1 = $t1;
      $time2 = $t2;
   }
   $diff = array(
      'Year(s)' => 0,
      'Month(s)' => 0,
	  'Day(s)' => 0
         );
   
   foreach(array('Year(s)','Month(s)','Day(s)')
         as $unit)
   {
      while(TRUE)
      {
         $next = strtotime("+1 $unit", $time1);
         if($next <= $time2)
         {
            $time1 = $next;
            $diff[$unit]++;
         }
         else
         {
            break;
         }
      }
   }
   return($diff);
}



$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;

$start = strtotime($trdate);
$end = strtotime($cdt);
$diff = timeDiff($start, $end);
$output = "The difference is:";
$a="";
$b="";
foreach($diff as $unit => $value)
{
	$a=$a.$value.",";
	$b=$b.$unit.",";
}


			$p_array=explode(",",$a);
			$p_array1=explode(",",$b);
			$p=array();
			$i=0;
			$co="";
			foreach($p_array as $val)
				{foreach($p_array1 as $val1)
				if($val <> "" && $val1 <> "")
				{
				$co[$i]=$p_array[$i].$p_array1[$i];
				}$i++;
				}
				
	 $diff=$co[0]." ".$co[1]." ".$co[2];
	





	//$lrole=$row_arr_home['arr_role'];
	 $arrival_id=$row_arr_home['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno="";  $slocs="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_arr_home['lotldg_crop']."'  and vertype='PV' order by popularname Asc"); 

$rowvv=mysqli_fetch_array($quer4);

//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
   		 $crop=$row31['cropname'];
		 $variety=$rowvv['popularname'];
		 $lotno=$row_arr_home['lotldg_lotno'];
	
		 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_arr_home['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_arr_home['lotldg_binid']."' and whid='".$row_arr_home['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_arr_home['lotldg_subbinid']."' and binid='".$row_arr_home['lotldg_binid']."' and whid='".$row_arr_home['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slocs=$slocs.$wareh.$binn.$subbinn;

if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
			<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="13%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
		  	<td width="17%" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
         	<td width="15%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balbags'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balqty'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_sstatus'];?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $diff;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="13%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
		  	<td width="17%" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
         	<td width="15%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balbags'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balqty'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_sstatus'];?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $diff;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
//}
//}
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
