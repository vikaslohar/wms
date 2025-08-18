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
	
//	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where aflg=0") or die(mysqli_error($link));
//while($row_tbl=mysqli_fetch_array($sql_tbl))
//{
//	$arrival_id=$row_tbl['tid'];	
//}
//            
	             $reptyp=trim($_REQUEST['reptyp']);
				 $txt=trim($_REQUEST['txt']);
				 $txtlot=trim($_REQUEST['txtlot']);
				 $txtlo=trim($_REQUEST['txtlo']);
				 $txtlot1=trim($_REQUEST['txtlot1']);
				 $txtlot2=trim($_REQUEST['txtlot2']);
			     //$txtlot3=trim($_REQUEST['txtlot3']);
				 $pcode=trim($_REQUEST['pcode']);
				 $txtcrop=trim($_REQUEST['txtcrop']);
				 $txtvariety=trim($_REQUEST['txtvariety']);
				 $txtstage=trim($_REQUEST['txtstage']);
				 $stcode=trim($_REQUEST['stcode']);
			     $ycode=trim($_REQUEST['ycodee']);
				 $txtlot4=trim($_REQUEST['txtlot4']);
				 $stcode2=trim($_REQUEST['stcode2']);
				
		$lotno=$pcode.$ycode.$txtlot2."/".$stcode."/".$stcode2;	
	 //$samplno="3";
	//$txt.$txtlot4."/".$txtlo;
/*$arr2 = split($samplno,2);
echo $arr2;*/
	if(isset($_POST['frm_action'])=='submit')
	{
				//$qcs=trim($_POST['qcsstatus']);
		
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality - Utlity - Lot Query</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
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

function openslocpopprint1(tid)
{
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=520,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}


function openslocpopprint(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_status.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 	
function mySubmit()
{	
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
return true;
}
function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_quality.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25" class="Mainheading">&nbsp;Utility - Lot Query </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
		
$sampl=$txtlo;  
if($reptyp=="lotno")
{ 
 $sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where  oldlot='$lotno' order by lotno,tid desc ") or die(mysqli_error($link));
}
else 
{
$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='$txtlot1' and crop='$txtcrop' and variety='$txtvariety'  order by lotno,tid desc ") or die(mysqli_error($link));
}
$row_t2=mysqli_fetch_array($sql_arr_home2);	

$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where  tid='".$row_t2[0]."' order by lotno") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);	
 if($tot_arr_home >0) 
 {  
 
 
if ($txtcrop!="" && txtvariety!="")
{
$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$txtcrop'"); 
$row_dept=mysqli_fetch_array($quer2);
$crpname=$row_dept['cropname'];
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$txtvariety."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$txtvariety;
	 }
	 else
	 {
	  $vv=$tt;
	  }
}
else
{
$sql_ltn=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."'") or die(mysqli_error($link));
$row_lnt=mysqli_fetch_array($sql_ltn);

$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='".$row_lnt['lotldg_crop']."'"); 
$row_dept=mysqli_fetch_array($quer2);
$crpname=$row_dept['cropname'];

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_lnt['lotldg_variety']."' "); 
$rowvv=mysqli_fetch_array($quer3);
$vv=$rowvv['popularname'];

}

if ($txtcrop!="" and txtvariety!="")
{
$lotn=$txtlot1;
}
else
{
$lotn=$lotno;
}
//echo $vv;
 $sql_arival=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lotn."'") or die(mysqli_error($link));
 $tot_arrival=mysqli_num_rows($sql_arival);
 $row_arrival=mysqli_fetch_array($sql_arival);
 $gotatarr=$row_arrival['got'];
if($vv=="")
$vv=$crpname."-"."Coded";
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#d21704" width="700" style="border-collapse:collapse">
<tr height="25" >
    <td align="left" width="50%" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crpname;?></td>
	<td align="right" width="50%" class="subheading" style="color:#303918; ">Variety: <?php echo $vv;?>&nbsp;</td>
	
</tr>
<tr height="25" >
	<td align="left" width="50%" class="subheading" style="color:#303918; ">&nbsp;Lot No.: <?php echo $lotn;?></td>
    <td align="right" width="50%" class="subheading" style="color:#303918; " >GOT status on Arrival: <?php echo $gotatarr;?>&nbsp;</td>
</tr>
</table><br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="700" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Quality Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="99" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="97" align="center" valign="middle" class="tblheading">PP</td>
	<td width="97" align="center" valign="middle" class="tblheading">Moist%</td>
	<td width="97" align="center" valign="middle" class="tblheading">Germ%</td> 
	<td width="99" align="center" valign="middle" class="tblheading">GOT Status </td>
	<td width="99" align="center" valign="middle" class="tblheading">DOGR</td>
    <td width="99" align="center" valign="middle" class="tblheading">Seed Status</td>
</tr>
<?php
$srno=1;
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstat="";		
	while($row_tbl_sub1=mysqli_fetch_array($sql_arr_home))
	{	

		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{
		$lotno=$row_tbl_sub1['oldlot'];
		}
	
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub1['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
		
	$sql_tbl12=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where orlot='".$lotno."'") or die(mysqli_error($link));
$row_tbl12=mysqli_fetch_array($sql_tbl12);
	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."' and lotldg_id='".$row_tbl12[0]."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$moist=$row_tbl_sub1['moist'];
$pp=$row_tbl['lotldg_vchk'];	
$gemp=$row_tbl_sub1['gemp'];
$sstat=$row_tbl['lotldg_sstatus'];

if($row_tbl['lotldg_srflg'] > 0)
{
	if($sstat!="")$sstat=$sstat."/"."S";
	else
	$sstat="S";
}
if($gemp==0) $gemp="";

if($pp=="Acceptable")
{
$cc="ACC";
}
else if($pp=="Not-Acceptable")
{
$cc="NAC";
}


$aq=explode(".",$row_tbl_sub1['moist']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub1['moist'];}

	$trdate1=$row_tbl['lotldg_gottestdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;	
	
	$trdate11=$row_tbl_sub1['testdate'];
	$tryear=substr($trdate11,0,4);
	$trmonth=substr($trdate11,5,2);
	$trday=substr($trdate11,8,2);
	$trdate11=$trday."-".$trmonth."-".$tryear;	
$qc=$row_tbl['lotldg_qc'];
$zzz=split(" ", $row_tbl['lotldg_got1']);
//$zzz=split(" ",$gggg[1]);
$got=$zzz[0]." ".$row_tbl['lotldg_got'];

if($srno%2!=0)
{
?>	
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $sstat;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate11;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $gemp;?></td> 
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
    <td width="99" align="center" valign="middle" class="tblheading"><?php echo $sstat;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
?>
</table>		
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="700" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Quantity Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="136" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="139" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="159" align="center" valign="middle" class="tblheading">Qty</td>
	<td align="center" valign="middle" class="tblheading">SLOC</td>
</tr>
<?php
$srno=1; //echo $lotn;
$sql_tbl_sub=mysqli_query($link,"select distinct(lotldg_sstage) from tbl_lot_ldg where orlot='".$lotn."'")or die(mysqli_error($link));
$ct1=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2=""; $srn=1;
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE orlot='".$lotn."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot='".$lotn."' and lotldg_sstage='".$row_tbl_sub['lotldg_sstage']."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$row_month['lotldg_balbags'];
 $slqty=$row_month['lotldg_balqty'];

$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

if($slocs!="")
$slocs=$slocs."<br />".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;

$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}

$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2=""; $srn=1;
$sql_qc_sub=mysqli_query($link,"SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE orlot='".$lotn."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE orlot='".$lotn."' and subbinid='".$row_qc_sub['subbinid']."'  and binid='".$row_qc_sub['binid']."'  and whid='".$row_qc_sub['whid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_qc[0]."' and balqty>0")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_qc_sub['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_qc_sub['binid']."' and whid='".$row_qc_sub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_qc_sub['subbinid']."' and binid='".$row_qc_sub['binid']."' and whid='".$row_qc_sub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slqty=$row_month['balqty'];
 //$slqty="";

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

if($slocs!="")
$slocs=$slocs."<br />".$wareh.$binn.$subbinn." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slqty;

$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

//$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}
$ac="";

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
?>
<tr class="Dark" height="20">
	<td align="center" valign="middle" class="tblheading"><?php echo "Pack";?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
</tr>
</table><br />
<?php
/*		  	
<table align="center" border="1" cellspacing="0" cellpadding="0" width="910" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="19" height="19"align="center" valign="middle" class="tblheading">#</td>
			   <td width="50" align="center" valign="middle" class="tblheading">DOSR</td>
			   <td width="62" align="center" valign="middle" class="tblheading">Date of GOT Result</td>
 <td width="54" align="center" valign="middle" class="tblheading">Last Date of QC </td>
			    <td width="58" align="center" valign="middle" class="tblheading">QC Result </td>
				 <td width="67" align="center" valign="middle" class="tblheading">GOT Result </td>
			    <td width="54" align="center" valign="middle" class="tblheading">PP</td>
               <td width="64" align="center" valign="middle" class="tblheading">Moist%</td>
               <td width="59" align="center" valign="middle" class="tblheading">Germ%</td> 
			   <td width="46" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="33" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="56" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="111" align="center" valign="middle" class="tblheading">SLOC</td>
              <td width="64" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
              </tr>
<?php
$srno=1;
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; 	
	while($row_tbl_sub1=mysqli_fetch_array($sql_arr_home))
	{	
	$trdate=$row_tbl_sub1['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trdate1=$row_tbl_sub1['gotdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;	
	
	$trdate11=$row_tbl_sub1['testdate'];
	$tryear=substr($trdate11,0,4);
	$trmonth=substr($trdate11,5,2);
	$trday=substr($trdate11,8,2);
	$trdate11=$trday."-".$trmonth."-".$tryear;	
	
	$lrole=$row_tbl_sub1['arr_role'];
	$arrival_id=$row_tbl_sub1['tid'];
	$qc1=$row_tbl_sub1['sampleno'];
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{
		$lotno=$row_tbl_sub1['oldlot'];
		}
	
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub1['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
		
		if($row_tbl_sub1['pp']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub1['pp']=="Not-Acceptable")
{
$cc="NAC";
}
	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl_sub1['trstage'];
$pp=$row_tbl_sub1['state'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="19" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="50" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="62" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		     <td width="54" align="center" valign="middle" class="tblheading"><?php echo $trdate11;?></td>
		    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['qc'];?></td>
		    <td width="67" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['got'];?></td>
         <td width="54" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
   <td width="64" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['moist'];?></td>
         <td width="59" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['gemp'];?></td>
		 	   <td width="46" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
	
         <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$slups+$row_tbl['lotldg_balbags'];
 $slqty=$slqty+$row_tbl['lotldg_balqty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

?>	
	<td width="111" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="81" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?>/00000<?php echo $qc1?></td>
         </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="19" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="50" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="62" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		     <td width="54" align="center" valign="middle" class="tblheading"><?php echo $trdate11;?></td>
		<td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['qc'];?></td>
		    <td width="67" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['got'];?></td>
         <td width="54" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
   <td width="64" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['moist'];?></td>
         <td width="59" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub1['gemp'];?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
		   <td width="56" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
       <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$slups+$row_tbl['lotldg_balbags'];
 $slqty=$slqty+$row_tbl['lotldg_balqty'];
if($slocs!="")
$$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";


?>	
	<td width="111" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
        <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="81" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?>/00000<?php echo $qc1?></td>
       </tr>  </table>
<?php
}
$srno=$srno+1;
}
?>
*/
?>
<?php
}
else
{
?>
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found</td></tr>
  </table>
<?php
}
?>       
		  </br>
		<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center"><a href="utility_got1.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;
                      <input type="hidden" name="txtinv" />
                      <input type="hidden" name="flagcode" value=""/>
                      <input type="hidden" name="flagcode1" value=""/></td>
                  </tr>
              </table>


</td>
<td width="30"></td>
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
