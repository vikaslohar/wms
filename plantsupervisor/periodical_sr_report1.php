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
	$txtpname=$_REQUEST['txtpname'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	$txtlocaion=$_REQUEST['txtlocaion'];
	$txtups=$_REQUEST['txtups'];
	$txtsrnno=$_REQUEST['txtsrnno'];
	
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
<title>Sales Return - Periodical Sales Return Report</title>
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
var txtpname=document.frmaddDepartment.txtpname.value;
var txtpp=document.frmaddDepartment.txtpp.value;
var txtstatesl=document.frmaddDepartment.txtstatesl.value;
var txtlocaion=document.frmaddDepartment.txtlocaion.value;
var txtups=document.frmaddDepartment.txtups.value;
var txtsrnno=document.frmaddDepartment.txtsrnno.value;
winHandle=window.open('report_periodicalsr.php?&txtcrop='+itemid+'&txtvariety='+vv+'&sdate='+sdate+'&edate='+edate+'&txtpname='+txtpname+'&txtpp='+txtpp+'&txtstatesl='+txtstatesl+'&txtlocaion='+txtlocaion+'&txtups='+txtups+'&txtsrnno='+txtsrnno,'WelCome','top=20,left=80,width=950,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Report - Periodical Sales Return Report</td>
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
<input name="txtpname" value="<?php echo $txtpname?>" type="hidden"> 
<input name="txtpp" value="<?php echo $txtpp;?>" type="hidden">
<input name="txtstatesl" value="<?php echo $txtstatesl;?>" type="hidden">
<input name="txtlocaion" value="<?php echo $txtlocaion;?>" type="hidden">
<input name="txtups" value="<?php echo $txtups;?>" type="hidden">
<input name="txtsrnno" value="<?php echo $txtsrnno;?>" type="hidden">
	 
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

$crp="ALL"; $variet="ALL"; $locname="ALL"; $pname="ALL"; $srnno="ALL";
	
if($crop!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crp=$row31['cropname'];		
}
if($variety!="ALL")
{
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
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
if($txtlocaion!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocaion."' order by productionlocation") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$locname=$row31['productionlocation'];		
}
if($txtpname!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtpname."' order by business_name") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$pname=$row31['business_name'];		
}	
if($txtsrnno!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tbl_salesrv where salesr_id='$txtsrnno' and plantcode='$plantcode' order by salesr_yearcode Asc, salesr_slrno ASC") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_crop);
	$srnno="SRN"."/".$row_tbl['salesr_yearcode']."/".sprintf("%00005d",$row_tbl['salesr_slrno']);
}	
?>

<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td align="center" class="tblheading">Periodical Sales Return Report</td>
</tr>
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;State:&nbsp;<?php echo $txtstatesl?></td>
  <td align="right" class="tblheading">Location:&nbsp;<?php echo $locname?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Party Type:&nbsp;<?php echo $txtpp?></td>
  <td align="right" class="tblheading">Party Name:&nbsp;<?php echo $pname?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop:&nbsp;<?php echo $crp;?></td>
  <td align="right" class="tblheading">Variety:&nbsp;<?php echo $variet;?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;UPS wise:&nbsp;<?php echo $txtups;?></td>
  <td align="right" class="tblheading">SRN No.:&nbsp;<?php echo $srnno;?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="25" height="24" align="Center" class="tblheading">#</td>
	<td width="70" align="Center" class="smalltblheading">Date</td>
	<td width="56" align="Center" class="smalltblheading">Party Type</td>
	<td width="142" align="Center" class="smalltblheading">Party Name</td>
	<td width="69" align="Center" class="smalltblheading">Location</td>
	<td width="59" align="Center" class="smalltblheading">SRN No.</td>
	<td width="57" align="Center" class="smalltblheading">State</td>
	<td width="78" align="Center" class="smalltblheading">Crop</td>
	<td width="99" align="Center" class="smalltblheading">Veriety</td>
	<?php if($txtups=="Yes"){?>
	<td width="65" align="Center" class="smalltblheading">UPS</td>
	<?php } ?>
	<td width="55" align="Center" class="smalltblheading">Total Qty</td>
	<td width="54" align="Center" class="smalltblheading">Actual Received Qty</td>
	<td width="47" align="Center" class="smalltblheading">Damage Qty</td>
	<td width="44" align="Center" class="smalltblheading">Ex.(+)/ Sh.(-) Qty</td>
	</tr>
<?php
$srno=1; $mid=""; $cnt=0;
$sq="select * from tbl_salesrv where salesr_trtype='Sales Return' and plantcode='$plantcode'";
if($txtstatesl!="ALL")
$sq.=" and salesr_state='".$txtstatesl."' ";
if($txtlocaion!="ALL")
$sq.=" and salesr_loc='".$txtlocaion."' ";
if($txtpp!="ALL")
$sq.=" and salesr_partytype='".$txtpp."' ";
if($txtpname!="ALL")
$sq.=" and salesr_party='".$txtpname."' ";
if($txtsrnno!="ALL")
$sq.=" and salesr_id='".$txtsrnno."' ";

$sq.=" order by salesr_id ASC ";
$sql_srretm=mysqli_query($link,$sq) or die(mysqli_error($link));
$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
	$mid=$row_srretm['salesr_id'];
	//echo $mid;
	if($txtups=="Yes")
	$sqlsrrets="select distinct salesrs_variety, salesrs_crop, salesrs_ups from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesr_id=$mid  and salesrs_vflg=1 and plantcode='$plantcode'";
	else
	$sqlsrrets="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesr_id=$mid  and salesrs_vflg=1 and plantcode='$plantcode'";
	
	if($crop!="ALL")
	{
		$sqlsrrets.=" and salesrs_crop='".$crop."' ";
	}
	if($variety!="ALL")
	{
		$sqlsrrets.=" and salesrs_variety='".$variety."' ";
	}
	if($txtups=="Yes")
	{
		$sqlsrrets.=" group by salesrs_ups,salesrs_variety   ";
	}
	$sqlsrrets.="  order by salesrs_dovfy, salesrs_variety ";
	$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
	while($row_srrets=mysqli_fetch_array($sql_srrets))
	{
		$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $lotnp=""; $ups=''; $exshqty="";
		
		
		if($txtups=="Yes")
		{
			$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesrs_variety='".$row_srrets['salesrs_variety']."' and salesrs_ups='".$row_srrets['salesrs_ups']."' and salesr_id='".$mid."' and salesrs_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
		}
		else
		{	
		$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id='".$mid."' and salesrs_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
		}
		while($row_srretsub=mysqli_fetch_array($sql_srretsub))
		{
			if($row_srretsub['salesrs_typ']=="verrec") 
			$totqty=$totqty+$row_srretsub['salesrs_qty'];
			$okqty=$okqty+$row_srretsub['salesrs_qtydc']; 
			$failqty=$failqty+$row_srretsub['salesrs_qtydamage'];
			
			$ups=$row_srretsub['salesrs_ups'];
			
			$tdate=$row_srretsub['salesrs_dovfy'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$trdate=$tday."-".$tmonth."-".$tyear;
		}	
	
		$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets['salesrs_crop']."'");
		$noticia = mysqli_fetch_array($quer3);
		$cropn=$noticia['cropname'];
		
		$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets['salesrs_variety']."' "); 
		$noticia_item = mysqli_fetch_array($quer4);
		$varietyn=$noticia_item['popularname'];
		
		/*$sql_srretsub2=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$rowsrretsub['salesr_id']."' and salesr_vflg=1") or die(mysqli_error($link));
		$row_srretsub2=mysqli_fetch_array($sql_srretsub2);*/
		
		//$ltno=$row_srretsub2['salesrs_newlot'];
		
		
		
		
		$ptype=$row_srretm['salesr_partytype'];
		
		$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_srretm['salesr_party']."' order by business_name")or die(mysqli_error($link));
		$noticia = mysqli_fetch_array($sql_month24);
		$panme=$noticia['business_name'];
		
		$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
		$noticia240 = mysqli_fetch_array($sql_month240);
		$locn=$noticia240['productionlocation'];
		if($ptype=="Export Buyer")
		$locn=$row_srretm['salesr_loc'];
		
		$srn_no="SRN"."/".$row_srretm['salesr_yearcode']."/".sprintf("%00005d",$row_srretm['salesr_slrno']);	
		$srstate=$row_srretm['salesr_state'];			
		//$totqty=$okqty+$failqty+$utqty;
		$exshqty=($okqty+$failqty)-$totqty;
		//echo $srn_no."  =  ".$varietyn."  =  ".$totqty."<br />";
if($totqty>0 || $okqty>0)					
{
if($srno%2==0)
{
?>	
<tr height="25">
	<td width="25" align="Center" class="smalltbltext"><?php echo $srno;?></td>
	<td width="70" align="Center" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="56" align="Center" class="smalltbltext"><?php echo $ptype;?></td>
	<td width="142" align="Center" class="smalltbltext"><?php echo $panme;?></td>
	<td width="69" align="Center" class="smalltbltext"><?php echo $locn;?></td>
	<td width="59" align="Center" class="smalltbltext"><?php echo $srn_no;?></td>
	<td width="57" align="Center" class="smalltbltext"><?php echo $srstate;?></td>
	<td width="78" align="Center" class="smalltbltext"><?php echo $cropn;?></td>
	<td width="99" align="Center" class="smalltbltext"><?php echo $varietyn;?></td>
	<?php if($txtups=="Yes"){?>
	<td width="65" align="Center" class="smalltbltext"><?php echo $ups;?></td>
	<?php } ?>
	<td width="55" align="Center" class="smalltbltext"><?php echo $totqty;?></td>
	<td width="54" align="Center" class="smalltbltext"><?php echo $okqty;?></td>
	<td width="47" align="Center" class="smalltbltext"><?php echo $failqty;?></td>
	<td width="44" align="Center" class="smalltbltext"><?php echo $exshqty;?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
	<td width="25" align="Center" class="smalltbltext"><?php echo $srno;?></td>
	<td width="70" align="Center" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="56" align="Center" class="smalltbltext"><?php echo $ptype;?></td>
	<td width="142" align="Center" class="smalltbltext"><?php echo $panme;?></td>
	<td width="69" align="Center" class="smalltbltext"><?php echo $locn;?></td>
	<td width="59" align="Center" class="smalltbltext"><?php echo $srn_no;?></td>
	<td width="57" align="Center" class="smalltbltext"><?php echo $srstate;?></td>
	<td width="78" align="Center" class="smalltbltext"><?php echo $cropn;?></td>
	<td width="99" align="Center" class="smalltbltext"><?php echo $varietyn;?></td>
	<?php if($txtups=="Yes"){?>
	<td width="65" align="Center" class="smalltbltext"><?php echo $ups;?></td>
	<?php }?>
	<td width="55" align="Center" class="smalltbltext"><?php echo $totqty;?></td>
	<td width="54" align="Center" class="smalltbltext"><?php echo $okqty;?></td>
	<td width="47" align="Center" class="smalltbltext"><?php echo $failqty;?></td>
	<td width="44" align="Center" class="smalltbltext"><?php echo $exshqty;?></td>
</tr>
<?php
}
$srno=$srno+1;$cnt++;
}
}
}
if($cnt==0)
{
?>
<tr height="25">
	<td align="Center" class="tblheading" colspan="13">Record Not Found.</td>
</tr>
<?php
}
?>
</table>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="periodical_sr_report.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;"  /></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /></td>
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

  