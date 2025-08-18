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
			 //	 $cid = $_REQUEST['txtclass'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival-Report - Unidentified Report</title>
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
var crop=document.frmaddDepartment.txtcrop.value;
//var ite=document.frmaddDepartment.itemid.value;
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_unidentified2.php?sdate='+sdate+'&edate='+edate+'&txtcrop='+crop,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
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
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25">&nbsp; Unidentified Arrival Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	 	 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
		  <input name="txtcrop" value="<?php echo $itemid;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 


/*$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and arrtrflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
*/
$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
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
		
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Unidentified' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
		
	//$sql_arr_home=mysqli_query($link,"select * from tblarrival_sub lotcrop=$itemid") or die(mysqli_error($link));
	
	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);
$crop=$row_dept['cropname'];
	/*$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrival_date <= '$edate' and ardate >= '$arrival_date' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */
   
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?> - Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination: <?php echo $cls['dest'];?></td>
  	</tr>-->
	
</table>
 <?php
 if($tot_arr_home > 0)
{
?> 
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse" align="center">
 <tr class="tblsubtitle" height="25">
    <td width="18" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="62"  align="center" valign="middle" class="tblheading" rowspan="2">DoA</td>
	<td width="121" align="center" valign="middle" class="tblheading" rowspan="2">Arrived In</td>
    <td width="85" align="center" valign="middle" class="tblheading" rowspan="2">Arrived From</td>
    <td width="70"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
    <td width="104"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	   
    <td width="88"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
    <td width="26"  align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
    <td width="35"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
	<td width="40" align="center" valign="middle" class="tblheading" rowspan="2"> Stage</td>
 <td colspan="2" align="center" valign="middle" class="tblheading">Prel. QC</td>
    <td width="39" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
    <td width="55" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
    <td width="110" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
  </tr>
  <tr class="tblsubtitle">
			  <td width="28" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="37" align="center" valign="middle" class="tblheading">Moist %</td>
			  <!--<td width="41" align="center" valign="middle" class="tblheading">Germ %</td>-->
  </tr>
<?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$crop."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $got1="";$qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$moist="";$vk=""; $location="";
$aq=explode(".",$row_tbl_sub['qty']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['qty'];}

$an=explode(".",$row_tbl_sub['qty1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['qty1'];}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		$tdate12=$row_tbl_sub['testd'];
	$tyear1=substr($tdate12,0,4);
	$tmonth1=substr($tdate12,5,2);
	$tday1=substr($tdate12,8,2);
	$tdate12=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate13=$row_tbl_sub['gotdate'];
	$tyear1=substr($tdate13,0,4);
	$tmonth1=substr($tdate13,5,2);
	$tday1=substr($tdate13,8,2);
	$tdate13=$tday1."-".$tmonth1."-".$tyear1;
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		$qc=$qc."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$qc=$row_tbl_sub['gemp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$got=$row_tbl_sub['qc'];
		}
		if($got1!="")
		{
		$got1=$got1."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got1=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		
		if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$moist=$row_tbl_sub['moisture'];
		}
		/*if($vk!="")
		{
		$vk=$vk."<br>".$row_tbl_sub['vchk'];
		}
		else
		{
		$vk=$row_tbl_sub['vchk'];
		}*/
		if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}
	
		$loc1=$row_arr_home['type'];
		$location=$row_tbl_sub['ploc'];
		
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
		if($lotoldlot!="")
		{
		$lotoldlot=$lotoldlot."<br>".$row_tbl_sub['lotoldlot'];
		}
		else
		{
		$lotoldlot=$row_tbl_sub['lotoldlot'];
		}
		
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $location;?></td>
    <td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="104" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="88" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="26" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
  <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
 <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
   <!--  <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>-->
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
			 <td width="55" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>

  <?php
}
else
{
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $location;?></td>
    <td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="104" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="88" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="26" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
      <!-- <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>-->
     	 	    <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
				 <td width="55" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>
  <?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
}
else
{
//}
//}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}
?>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_unidentified.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
