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
	
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$sdate = $_REQUEST['sdate'];
	 	$edate = $_REQUEST['edate'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Supervisor - Report - Periodical Density Report</title>
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
<SCRIPT language="JavaScript">

function openprint()
{
var sdate=document.frmaddDepartment.sdate.value; 
var edate=document.frmaddDepartment.edate.value; 
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
//var pmc=document.frmaddDepartment.txtpmcode.value;
winHandle=window.open('report_density2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
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
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <?php
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		//$txtpmcode=$_REQUEST['txtpmcode'];
		
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
		
	$crp="ALL"; $ver="ALL"; 
	$qry="select * from tbl_density where density_date <='".$edate."' and density_date >='".$sdate."' ";
	
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.="and density_crop='$crp' ";
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.="and density_variety='$ver' ";
	}
	
	$qry.="  order by density_crop, density_variety";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">&nbsp;Periodical Density Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="txtpmcode" value="<?php echo $txtpmcode;?>" type="hidden">  
		 <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   	<!--<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr class="Dark" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr class="Dark" height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="2%" align="center" valign="middle" class="smalltblheading" >#</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Arrival Date</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Processing Date</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading" >Crop</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading" >Variety</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >SP Codes</td>
	<td align="center" valign="middle" class="smalltblheading" >Lot No.</td>
	<td width="3%" align="center" valign="middle" class="smalltblheading" >Raw Seed Qty</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading"  >Condition Loss</td>
	<td align="center" valign="middle" class="smalltblheading"  >Condition Loss %</td>
	<td align="center" valign="middle" class="smalltblheading" >Blended Lot No.</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Density - Raw</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Density - Condition</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >Remnant qty (kg)</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Remmamt %</td>
</tr>
<?php
$srno=1; $crop=""; $variety=""; $arrdate=''; $prdate=''; $spcodes=''; $lotno=""; $rawqty=''; $conqty=''; $conloss=''; $conlossper=''; $blendedlot=''; $rawdensity=''; $condensity=''; $remqty=''; $remper='';

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	
	$crop=$row_arr_home1['density_crop'];
	$variety=$row_arr_home1['density_variety'];
	$spcodes=$row_arr_home1['density_spcode'];
	$lotno=$row_arr_home1['density_lotno'];
	$rawqty=$row_arr_home1['density_rawqty']; 
	$conqty=$row_arr_home1['density_conqty']; 
	$conloss=$row_arr_home1['density_proloss'];
	$conlossper=$row_arr_home1['density_plossper'];
	$blendedlot=$row_arr_home1['density_blendedlot'];
	$rawdensity=$row_arr_home1['density_rawdensity']; 
	$condensity=$row_arr_home1['density_condensity']; 
	$remqty=$row_arr_home1['density_rqrltkg'];
	$remper=$row_arr_home1['density_remperlot'];
	
	$rdate=$row_arr_home1['density_arrdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$arrdate=$rday."-".$rmonth."-".$ryear;
	
	$rdate2=$row_arr_home1['density_prodate'];
	$ryear2=substr($rdate2,0,4);
	$rmonth2=substr($rdate2,5,2);
	$rday2=substr($rdate2,8,2);
	$prdate=$rday2."-".$rmonth2."-".$ryear2;
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcodes;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conlossper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendedlot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawdensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $condensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remper?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcodes;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conlossper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendedlot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawdensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $condensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remper?></td>
</tr>

<?php
}
$srno=$srno++;
}
}
?>		  	
</table>		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td  align="center" valign="middle"><a href="report_density.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /></td>
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
