<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rsw-Report -Reserve Seed Report</title>
<link href="../../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
//var age=document.frmaddDepartment.age.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_crop2.php?txtcrop='+itemid+'&txtvariety='+vv,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../../include/arr_plant1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <?php
	$edate=date("Y-m-d");
	
	$crp="ALL"; $ver="ALL";
	//$qry="select * from tbl_lot_ldg where lotldg_sstage='Raw' and lotldg_resverstatus=1 and lotldg_trdate<='$edate'";	
 
  $qry="select * from tbl_lot_ldg where lotldg_sstage='Raw' and lotldg_balqty > 0 and lotldg_resverstatus=1 and plantcode='$plantcode'";

	if($crop!="ALL")
	{	
	$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Reserve Seed Report - As on Date <?php echo date("d-m-Y");?>	
</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
 <table align="center" border="0" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
<td align="right" class="subheading" style="color:#303918;">Variety: <?php echo $ver;?>&nbsp;&nbsp;</td>
</tr>
</table>
<?php
if($tot_arr_home > 0)
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="17" align="center" valign="middle" class="tblheading">#</td>
    <td width="83"  align="center" valign="middle" class="tblheading">Crop</td>
    <td width="197"  align="center" valign="middle" class="tblheading">Variety</td>
    <td width="106"  align="center" valign="middle" class="tblheading">Lot No.</td>
    <td width="50"  align="center" valign="middle" class="tblheading">NoB</td>
    <td width="52"  align="center" valign="middle" class="tblheading">Qty</td>
    <td width="57"  align="center" valign="middle" class="tblheading">QC status</td>
    <td width="53" align="center" valign="middle" class="tblheading">Moist %</td>
    <td width="52" align="center" valign="middle" class="tblheading">Germ %</td>
    <td width="77"  align="center" valign="middle" class="tblheading">DOT</td>
    <td width="75"  align="center" valign="middle" class="tblheading">GOT Status</td>
    <td width="45"  align="center" valign="middle" class="tblheading">Seed Status</td>
    <td width="58"  align="center" valign="middle" class="tblheading">Reserve Comment</td>
  </tr>
  <?php
$srno=1;

while($row_tbl_sub=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_tbl_sub['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	 $arrival_id=$row_tbl_sub['lotldg_id'];
	
	
	
	$rdate=$row_tbl_sub['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$dot=$rday."-".$rmonth."-".$ryear;
	
	if($dot=="00-00-0000" || $dot=="--")
	$dot="";
	
	
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' order by popularname Asc"); 

$rowvv=mysqli_fetch_array($quer4);

   		$crop=$row31['cropname'];
		$variety=$rowvv['popularname'];
		$lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$ac;
		$qty=$acn;
		$qc=$row_tbl_sub['lotldg_qc'];
		$got=$row_tbl_sub['lotldg_got1'];
		$stage=$row_tbl_sub['lotldg_sstage'];
		$per=$row_tbl_sub['lotldg_got1'];
		$loc1=$row_tbl_sub['lotldg_sstatus'];
		if($row_tbl_sub['lotldg_srflg'] > 0)
		{
			if($loc1!="")$loc1=$loc1."/"."S";
			else
			$loc1="S";
		}
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
    <td width="83" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="197" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
    <td width="106" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="50" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="52" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
    <td width="52" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_gemp']?></td>
    <td width="77" align="center" valign="middle" class="tblheading"><?php echo $dot?></td>
    <td width="75" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="tblheading"><?php if($row_tbl_sub['lotldg_resverstatus'] > 0) {?><a href="javascript:void(0);" title="<?php echo $row_tbl_sub['lotldg_revcomment'];?>">Details</a><?php } else {?>Details<?php } ?></td>
    <!---->
  </tr
>
  <?php
}
else
{
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
    <td width="83" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="197" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
    <td width="106" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="50" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="52" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
    <td width="52" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_gemp']?></td>
    <td width="77" align="center" valign="middle" class="tblheading"><?php echo $dot?></td>
    <td width="75" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="tblheading"><?php if($row_tbl_sub['lotldg_resverstatus'] > 0) {?><a href="javascript:void(0);" title="<?php echo $row_tbl_sub['lotldg_revcomment'];?>">Details</a><?php } else {?>Details<?php } ?></td>
    <!---->
  </tr>
  <?php
}
$srno=$srno+1;
}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
  	<tr class="tblsubtitle" height="25">
    	<td align="center" valign="middle" class="tblheading">No Records Found.</td>
	</tr>
</table>
<?php
}
?>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_crop.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<?php if($tot_arr_home > 0){?><img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" value="" /><?php } ?></td>

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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../../images/istratlogo.gif"  align="left"/><img src="../../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
