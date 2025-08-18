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
<title>Rsw-Report Quality Based Raw Seed Report</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('report_quality2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_process.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <?php
		$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		
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
	$qry="select Distinct(lotldg_crop), lotldg_variety from tbl_lot_ldg where lotldg_sstage='Raw Seed' and plantcode='$plantcode'";
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
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.="and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate' group by lotldg_crop, lotldg_variety";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	 $tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25">&nbsp;Direct Packing Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="age" value="<?php echo $age;?>" type="hidden">  
		 <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
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
  </tr>-->
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="10%" align="center" rowspan="2" valign="middle" class="tblheading">#</td>
			<td width="47" align="center" valign="middle" class="tblheading" rowspan="2">Date </td>
			<td width="162"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No </td>
			<td width="254"  align="center" valign="middle" class="tblheading" rowspan="2">Conditioned Seed Qty </td>
			<td width="97"  align="center" valign="middle" class="tblheading" rowspan="2">captive Consumption </td>
			 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Packing Loss </td>
			 <td width="97"  align="center" valign="middle" class="tblheading"rowspan="2">Distribution</td>
			 <td width="97" align="center" valign="middle" class="tblheading" colspan="2">Unit Pack 10 gm  </td>
			 <td width="97" align="center" valign="middle" class="tblheading" colspan="2">Unit Pack 50 gm </td>
			 <td width="97" align="center" valign="middle" class="tblheading" colspan="2">Unit Pack 150 gm </td>
			  <td width="97" align="center" valign="middle" class="tblheading" colspan="2">Unit Pack 500 gm </td>
			
</tr>
 <tr class="tblsubtitle">
   <!--/* <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>*/-->
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
      <td width="8%" align="center" valign="middle" class="tblheading">Unit</td>
	  <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
	    <td width="8%" align="center" valign="middle" class="tblheading">Unit</td>
	    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
	    <td width="8%" align="center" valign="middle" class="tblheading">Unit</td>
		<td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
	    <td width="8%" align="center" valign="middle" class="tblheading">Unit</td>
		<td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
	                </tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	//echo $row_arr_home1['lotldg_crop'];
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	
	$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate' and plantcode='$plantcode'") or die(mysqli_error($link));

$srno=1;
$totqty=0; $totqcq=0; $totugq=0; $totuqq=0; $totufq=0; 
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	
	if($row_issuetbl['lotldg_qc']=="OK")
	{
	$totqcq=$totqcq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got1']=="GOT-R Under Test" || $row_issuetbl['lotldg_got1']=="GOTR Under Test" || $row_issuetbl['lotldg_got1']=="GOTNR Under Test" || $row_issuetbl['lotldg_got1']=="Retest")
	{
	$totugq=$totugq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="Under Test" || $row_issuetbl['lotldg_qc']=="UnderTest")
	{
	$totuqq=$totuqq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="Fail" && $row_issuetbl['lotldg_got1']=="Fail")
	{
	$totufq=$totufq+$row_issuetbl['lotldg_balqty'];  
	}
	

}
}
}	
	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['lotldg_variety']."' ") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
		 $crop=$row31['cropname'];
		 $variety=$rowvv['popularname'];

 
if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="47" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
          	<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading">Pouch</td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
				<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totuqq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
			 	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
    
</tr>

<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="47" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
          	<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading">window box </td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totuqq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
			 	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
</tr>
<tr class="Light">
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="47" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
          	<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading">Carton Box </td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totuqq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
</tr>
<tr class="Light">
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="47" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
          	<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading">Total</td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totuqq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
</tr>
<?php
}
$srno=$srno++;
}
}
/*}
}*/
?>
          </table>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_quality.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
