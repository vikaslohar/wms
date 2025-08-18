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
	
			//$cid = $_REQUEST['txtclass'];

		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW-Report -Unidentified Condition Seed Report</title>
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
winHandle=window.open('report_unid2.php','WelCome','top=20,left=80,width=780,height=600,scrollbars=yes');
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
          <td width="100%" valign="top" align="center"><img src="../../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
  <?php
	$edate=date("Y-m-d");
	
	$qry="select * from tbl_lot_ldg where lotldg_sstage='Condition' and lotldg_trtype='Unidentified' and lotldg_trdate<='$edate' and plantcode='$plantcode'";	
  
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Unidentified Condition Seed Report - As on Date: <?php echo date("d-m-Y");?></td>
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
<?php
if($tot_arr_home > 0)
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="17" align="center" valign="middle" class="tblheading">#</td>
    <td width="63"  align="center" valign="middle" class="tblheading">Date of Arrival</td>
    <td width="63"  align="center" valign="middle" class="tblheading">Crop</td>
    <td width="43"  align="center" valign="middle" class="tblheading">Lot Number</td>
    <td width="37"  align="center" valign="middle" class="tblheading">NoB</td>
    <td width="30"  align="center" valign="middle" class="tblheading">Qty</td>
    <td width="61"  align="center" valign="middle" class="tblheading">QC status</td>
    <td width="104"  align="center" valign="middle" class="tblheading">GOT Status</td>
    </tr>
  <?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	 $arrival_id=$row_arr_home['lotldg_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id ='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
		 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";
$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$acn=$aq[0];}else{$acn=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$ac=$an[0];}else{$ac=$row_tbl_sub['lotldg_balqty'];}

		//$row_tbl_sub['lotldg_crop'];
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl_sub['lotldg_crop']."' order by popularname Asc"); 

$rowvv=mysqli_fetch_array($quer4);

   $crop=$row31['cropname'];
	$variety=$crop."-Unidentified";
		/*if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotldg_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotldg_crop'];
		}
		if($variety!=$row_tbl_sub['lotldg_variety'])
		{
		$variety=$variety."<br>".$row_tbl_sub['lotldg_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotldg_variety'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotldg_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotldg_lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['lotldg_qc'];
		}
		else
		{
		$qc=$row_tbl_sub['lotldg_qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['lotldg_got1'];
		}
		else
		{
		$got=$row_tbl_sub['lotldg_got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['lotldg_sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['lotldg_got1'];
		}
		else
		{
		$per=$row_tbl_sub['lotldg_got1'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_tbl_sub['lotldg_sstatus'];
		}
		else
		{
		$loc1=$row_tbl_sub['lotldg_sstatus'];
		}
		/*if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}*/
	 //$row_tbl_sub['arrsub_id'];
if($variety==$row_tbl_sub['lotldg_variety'])
{	
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="37" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="30" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td width="104" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
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
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="37" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="30" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td width="104" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
		          <!---->
  </tr>
  <?php
}
$srno=$srno+1;
}
}
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
<td height="49" align="center" valign="top"><a href="rsw_mod_ reports.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<?php if($tot_arr_home > 0){?><img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" value="" /><?php } ?></td>
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
