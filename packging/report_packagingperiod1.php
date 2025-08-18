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
	$txtupsdc = $_REQUEST['txtupsdc'];
	$withreprint = $_REQUEST['withreprint'];
	if($crop=="")$crop="ALL";
	if($variety=="")$variety="ALL";
	if($txtupsdc=="")$txtupsdc="ALL";
	if($withreprint=="")$withreprint="ALL";
		
	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Report - Periodical Packaging Report</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var edate=document.frmaddDepartment.edate.value;
var txtupsdc=document.frmaddDepartment.txtupsdc.value;
var withreprint=document.frmaddDepartment.withreprint.value;
winHandle=window.open('report_packagingperiod2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&txtupsdc='+txtupsdc+'&edate='+edate+'&withreprint='+withreprint,'WelCome','top=20,left=80,width=950,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
function openslocpopprint(tid)
{
winHandle=window.open('barcode_details_rep.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <?php
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	$cp=""; $pcktype='ALL'; $ndt=""; $crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	
	if($withreprint!="ALL")
	{
		if($withreprint=="LMC")$pcktype='PACKLMC';if($withreprint=="MMC")$pcktype='PACKMMC';if($withreprint=="NLC")$pcktype='PACKNLC';
	}
	
	$sql_crp=mysqli_query($link,"select * from tblcrop order by cropname ASC") or die(mysqli_error($link));
	while($row_crp=mysqli_fetch_array($sql_crp))
	{
		if($cp!="")
			$cp=$cp.",".$row_crp['cropid'];
		else
			$cp=$row_crp['cropid'];
	}
	
	if($withreprint=="ALL")
	$qry6="select Distinct mpmain_date from tbl_mpmain where plantcode='$plantcode' and mpmain_date>='$sdt' and mpmain_date<='$edt' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKMMC' or mpmain_trtype='PACKNLC') and mpmain_barcode!='' order by mpmain_date ASC ";
	else
	$qry6="select Distinct mpmain_date from tbl_mpmain where plantcode='$plantcode' and mpmain_date>='$sdt' and mpmain_date<='$edt' and mpmain_trtype='$pcktype' and mpmain_barcode!='' order by mpmain_date ASC ";
	$sqlcrp=mysqli_query($link,$qry6) or die(mysqli_error($link));
	while($rowcrp=mysqli_fetch_array($sqlcrp))
	{
		if($ndt!="")
			$ndt=$ndt.",".$rowcrp['mpmain_date'];
		else
			$ndt=$rowcrp['mpmain_date'];
	}
	$ndt1=explode(",",$ndt);
	$ndt1=array_unique($ndt1);
	sort($ndt1);
	$ndt=$ndt1;
	
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	} 
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	    <tr >
	      <td width="813" height="25">Periodical Packaging Report (LMC/NLC/MMC)</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
		<input name="edate" value="<?php echo $edate;?>" type="hidden"> 
		<input name="txtupsdc" value="<?php echo $txtupsdc;?>" type="hidden">
		<input name="withreprint" value="<?php echo $withreprint;?>" type="hidden">
		
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
  
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $ver;?>&nbsp;&nbsp;|&nbsp;&nbsp;Size: <?php echo $txtupsdc;?>&nbsp;&nbsp;|&nbsp;&nbsp;Packaging Type: <?php echo $withreprint;?>&nbsp;&nbsp;|&nbsp;&nbsp;From Date: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;To Date: <?php echo $edate;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#1dbe03" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="26" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">Date</td>
	<td width="126"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">Barcode</td>
	<td width="55"  align="center" valign="middle" class="smalltblheading">Packaging Type</td>
</tr>

<?php
$srno=1; $totalbags=0;
foreach($ndt as $ndts)
{
if($ndts<>"")
{

if($withreprint=="ALL")
	$qry="select Distinct mpmain_barcode from tbl_mpmain where plantcode='$plantcode' and mpmain_date='$ndts' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKMMC' or mpmain_trtype='PACKNLC') and mpmain_barcode!='' order by mpmain_barcode ASC ";
	else
	$qry="select Distinct mpmain_barcode from tbl_mpmain where plantcode='$plantcode' and mpmain_date='$ndts' and mpmain_trtype='$pcktype' and mpmain_barcode!='' order by mpmain_barcode ASC ";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	if($withreprint=="ALL")
	$sql_rr=mysqli_query($link,"select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$row_arr_home1['mpmain_barcode']."' and mpmain_date='$ndts' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKMMC' or mpmain_trtype='PACKNLC') order by mpmain_barcode ASC") or die(mysqli_error($link));
	else
	$sql_rr=mysqli_query($link,"select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$row_arr_home1['mpmain_barcode']."' and mpmain_date='$ndts' and mpmain_trtype='$pcktype' order by mpmain_barcode ASC") or die(mysqli_error($link));

$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{
	$ct=0; $varietynm=""; $cropnm=""; $lotno=""; $nop=""; $qty=""; $upssize=""; $trdate=''; $barcode=''; $ptype1='';
	
	$crparr=explode(",", $row_rr['mpmain_crop']);
	$verarr=explode(",", $row_rr['mpmain_variety']);
	$lotarr=explode(",", $row_rr['mpmain_lotno']);
	$upsarr=explode(",", $row_rr['mpmain_upssize']);
	$noparr=explode(",", $row_rr['mpmain_lotnop']);
	
	$tdt2=explode("-", $row_rr['mpmain_date']);
	$trdate=$tdt2[2]."-".$tdt2[1]."-".$tdt2[0];	
	$barcode=$row_rr['mpmain_barcode'];	
	$ptype1=$row_rr['mpmain_trtype'];	
	
	if($ptype1=="PACKLMC")$ptype='LMC';if($ptype1=="PACKMMC")$ptype='MMC';if($ptype1=="PACKNLC")$ptype='NLC';
	
	
	for ($i=0; $i<count($lotarr); $i++)
	{
		$variety6=""; $crop6=""; 
		if($ptype=="MMC")
		{
			$crop6=$crparr[$i];
			$variety6=$verarr[$i];
			$ups=$upsarr[$i];
		}
		else
		{
			$crop6=$crparr[0];
			$variety6=$verarr[0];
			$ups=$upsarr[0];
		}
		//echo $lotarr[$i];
		if($lotarr[$i]!="")
		{
			if($crop!="ALL"){if($crop!=$crop6)$ct++; } 
			if($variety!="ALL"){if($variety!=$variety6)$ct++; }
			if($txtupsdc!="ALL"){if($ups!=$txtupsdc)$ct++; }
			//echo $ptype."  -  ".$ct."<br/>";
			$nopm=$noparr[$i];
			
			$up=explode(" ", $ups);
			if($up[1]=="Gms")
			{
				$ptp=$up[0]/1000;
			}
			else
			{
				$ptp=$up[0];
			}
			//echo $barcode." = ".$lotarr[$i]." - ".$ups." = ".$ptp."  -  ".$noparr[$i]."<br />";
			if($up[1]=="Gms")
			$ptp6=$ptp*$noparr[$i];
			else
			$ptp6=$noparr[$i]/$ptp;
			
			$qtym=$ptp6; $nompm=$nompm+$ct; 
			$lotn=$lotarr[$i];
	
			$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop6."'") or die(mysqli_error($link));
			$row31=mysqli_fetch_array($sql_crop);
			$cropname=$row31['cropname'];		
			$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety6."' ") or die(mysqli_error($link));
			$ttt=mysqli_num_rows($sql_variety);
			if($ttt > 0)
			{
				$rowvv=mysqli_fetch_array($sql_variety);
				$varietyname=$rowvv['popularname'];
			}
			else
			{
				$varietyname=$row_rr['lotldg_variety'];
			}
		
			 if($varietynm!="") 
			 {
				 $varietynm=$varietynm."<br/>".$varietyname;
			 }
			 else
			 {
				 $varietynm=$varietyname;
			 }
			 if($cropnm!="")
			 {
				 $cropnm=$cropnm."<br/>".$cropname;
			 }
			 else
			 {
				 $cropnm=$cropname;
			 }
			 if($lotno!="")
			 {
				 $lotno=$lotno."<br/>".$lotn;
			 }
			 else
			 {
				 $lotno=$lotn;
			 }
			 if($nop!="")
			 {
				 $nop=$nop."<br/>".$nopm;
			 }
			 else
			 {
				 $nop=$nopm;
			 }
			 if($qty!="")
			 {
				 $qty=$qty."<br/>".$qtym;
			 }
			 else
			 {
				 $qty=$qtym;
			 }
			 if($upssize!="")
			 {
				 $upssize=$upssize."<br/>".$ups;
			 }
			 else
			 {
				 $upssize=$ups;
			 }
		}
	}		

if($qtym>0 && $ct==0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropnm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietynm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $barcode;?>');"><?php echo $barcode?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ptype;?></td>
</tr>
<?php
  $srno++;
}
}
}
}
}
//}
//}
?>
</table>			

<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="30" align="center" valign="top"><a href="report_packagingperiod.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td width="30"></td> <td>
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
