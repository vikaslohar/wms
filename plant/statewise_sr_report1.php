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

	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtptype=$_REQUEST['txtptype'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	if($txtpp=="C" || $txtpp=="CandF" || $txtpp=="CnF")	{$txtpp="C&F";}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
			
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Periodical State wise Sales Return Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->


</head>
<script src="srcrrep.js"></script>
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
<script language="javascript" type="text/javascript">

function openprint()
{
var sdate=document.frmaddDepartment.sdate.value;
var edate=document.frmaddDepartment.edate.value;
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var txtptype=document.frmaddDepartment.txtptype.value;
var txtpp=document.frmaddDepartment.txtpp.value;
var txtstatesl=document.frmaddDepartment.txtstatesl.value;
winHandle=window.open('report_statewisesr2.php?&txtcrop='+itemid+'&txtvariety='+vv+'&sdate='+sdate+'&edate='+edate+'&txtptype='+txtptype+'&txtpp='+txtpp+'&txtstatesl='+txtstatesl,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Report - Periodical State wise Sales Return Report</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >

<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
<input name="sdate" value="<?php echo $sdate?>" type="hidden"> 
<input name="edate" value="<?php echo $edate;?>" type="hidden">
<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
<input name="txtcrop" value="<?php echo $crop;?>" type="hidden">
<input name="txtptype" value="<?php echo $txtptype?>" type="hidden"> 
<input name="txtpp" value="<?php echo $txtpp;?>" type="hidden">
<input name="txtstatesl" value="<?php echo $txtstatesl;?>" type="hidden">
	 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<?php
$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
?>

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td align="center" class="tblheading">Periodical State wise Sales Return Report</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;State:&nbsp;<?php echo $txtstatesl?></td>
  <td align="right" class="tblheading">Party Type:&nbsp;<?php echo $txtpp?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<?php
$crp="ALL"; $variet="ALL";
	
	if($crop!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		$crp=$row31['cropname'];		
	}
	if($variety!="ALL")
	{
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
			$rowvv=mysqli_fetch_array($sql_variety);
			$variet=$rowvv['popularname'];
		}
		else
		{
			$variet=$variety;
		}
	}
?>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop:&nbsp;<?php echo $crp;?></td>
  <td align="right" class="tblheading">Variety:&nbsp;<?php echo $variet;?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="44" height="24" align="Center" class="tblheading">#</td>
	<td width="80" align="Center" class="tblheading">State</td>
	<td width="80" align="Center" class="tblheading">Party Type</td>
	<td width="160" align="Center" class="tblheading">Crop</td>
	<td width="210" align="Center" class="tblheading">Variety</td>
	<!--<td width="80" align="Center" class="tblheading">UPS</td>-->
	<td width="80" align="Center" class="tblheading">Total Qty</td>
	<td width="80" align="Center" class="tblheading">Actual Received Qty</td>
	<td width="80" align="Center" class="tblheading">Damage Qty</td>
	</tr>
<?php
$srno=1; $mid=""; $cnt=0;
if($txtstatesl!="ALL")
	$sql_srretm2=mysqli_query($link,"select Distinct salesr_state from tbl_salesrv where salesr_state='".$txtstatesl."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and plantcode='$plantcode'") or die(mysqli_error($link));
else
	$sql_srretm2=mysqli_query($link,"select Distinct salesr_state from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_srretm2=mysqli_num_rows($sql_srretm2);
while($row_srretm2=mysqli_fetch_array($sql_srretm2))
{
	if($txtpp!="ALL")
		$sqlsrretm=mysqli_query($link,"select distinct salesr_partytype from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$txtpp."' and salesr_state='".$row_srretm2['salesr_state']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	else
		$sqlsrretm=mysqli_query($link,"select distinct salesr_partytype from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_state='".$row_srretm2['salesr_state']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$totsrretm=mysqli_num_rows($sqlsrretm);
	while($rowsrretm=mysqli_fetch_array($sqlsrretm))
	{

		$mid="";
		$sql_srretm=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$rowsrretm['salesr_partytype']."' and salesr_state='".$row_srretm2['salesr_state']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_srretm=mysqli_num_rows($sql_srretm);
		while($row_srretm=mysqli_fetch_array($sql_srretm))
		{
	
		if($mid!="")
		$mid=$mid.",".$row_srretm['salesr_id'];
		else
		$mid=$row_srretm['salesr_id'];
		}
		
		if($mid==""){$mid='NULL';
		$sqlsrrets2="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where salesr_id=$mid and plantcode='$plantcode'";}
		else{
		$sqlsrrets2="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where salesr_id IN ($mid) and plantcode='$plantcode'";}

			//$sqlsrrets2="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where salesr_id='".$row_srretm['salesr_id']."' ";
			if($crop!="ALL")
			{
				$sqlsrrets2.=" and salesrs_crop='".$crop."' ";
			}
			if($variety!="ALL")
			{
				$sqlsrrets2.=" and salesrs_variety='".$variety."' ";
			}
			$sqlsrrets2.="  order by salesrs_crop, salesrs_variety ";
			$sql_srrets2=mysqli_query($link,$sqlsrrets2) or die(mysqli_error($link));
			while($row_srrets2=mysqli_fetch_array($sql_srrets2))
			{
				
				$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $ups="";
				if($mid==""){$mid='NULL';
					$sql_srretsub="select * from tbl_salesrv_sub where salesr_id=$mid and salesrs_variety='".$row_srrets2['salesrs_variety']."' and plantcode='$plantcode'";}
				else{
					$sql_srretsub="select * from tbl_salesrv_sub where salesr_id IN ($mid) and salesrs_variety='".$row_srrets2['salesrs_variety']."' and plantcode='$plantcode'";}
				$sql_srretsub2=mysqli_query($link,$sql_srretsub) or die(mysqli_error($link));
				while($row_srretsub2=mysqli_fetch_array($sql_srretsub2))
				{
					$diq2=explode(".",$row_srretsub2['salesrs_qtydc']);
					if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_srretsub2['salesrs_qtydc'];}
					$okqty=$okqty+$difq2;
					
					$diq3=explode(".",$row_srretsub2['salesrs_qtydamage']);
					if($diq3[1]==000){$difq3=$diq3[0];}else{$difq3=$row_srretsub2['salesrs_qtydamage'];}
					$failqty=$failqty+$difq3;
						
					$totqty=$totqty+$difq2+$difq3;
				}
				$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets2['salesrs_crop']."'");
				$noticia = mysqli_fetch_array($quer3);
				$cropn=$noticia['cropname'];
						
				$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets2['salesrs_variety']."' and actstatus='Active'"); 
				$noticia_item = mysqli_fetch_array($quer4);
				$varietyn=$noticia_item['popularname'];	
					
				$ups=$row_srrets['salesrs_ups'];

if($totqty>0)					
{
if($srno%2==0)
{
?>	
<tr height="25">
	<td width="44" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $row_srretm2['salesr_state'];?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $rowsrretm['salesr_partytype'];?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<!--<td width="80" align="Center" class="tblheading"><?php echo $ups;?></td>-->
	<td width="80" align="Center" class="tblheading"><?php echo $totqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $okqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $failqty;?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
	<td width="44" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $row_srretm2['salesr_state'];?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $rowsrretm['salesr_partytype'];?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<!--<td width="80" align="Center" class="tblheading"><?php echo $ups;?></td>-->
	<td width="80" align="Center" class="tblheading"><?php echo $totqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $okqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $failqty;?></td>
</tr>
<?php
}
$srno=$srno+1;$cnt++;
}
}
} 
}
//}
//}
if($cnt==0)
{
?>
<tr height="25">
	<td align="Center" class="tblheading" colspan="9">Record Not Found.</td>
</tr>
<?php
}
?>
</table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="statewise_sr_report.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;"  /></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /></td>
</tr>
</table>
</td><td width="30"></td>
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
