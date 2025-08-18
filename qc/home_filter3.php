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
	
	$eurl = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

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
				 //$txtstage=trim($_REQUEST['txtstage']);
				 $stcode=trim($_REQUEST['stcode']);
			     $ycode=trim($_REQUEST['ycodee']);
				 $txtlot4=trim($_REQUEST['txtlot4']);
				 $stcode2=trim($_REQUEST['stcode2']);
				 
	$lotno=$pcode.$ycode.$txtlot2."/".$stcode."/".$stcode2;	

	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction -Sampling</title>
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
	      <td width="940" height="25">&nbsp;Transaction - QC Result update</td>
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
 $sql_arr_home1=mysqli_query($link,"select distinct(oldlot) from tbl_qctest where  oldlot='$lotno'  and bflg=1  and aflg=0  and cflg=0 and qcflg=0 group by sampleno  order by lotno desc") or die(mysqli_error($link));
 $tot_arr_home1=mysqli_num_rows($sql_arr_home1);
}
 else if($reptyp=="sno")
{ 
$sql_arr_home1=mysqli_query($link,"select distinct(oldlot) from tbl_qctest where  sampleno='".$sampl."'and bflg=1  and aflg=0  and cflg=0 and qcflg=0 group by sampleno  order by lotno desc") or die(mysqli_error($link));
$tot_arr_home1=mysqli_num_rows($sql_arr_home1);
}
else 
{
$sql_arr_home1=mysqli_query($link,"select distinct(oldlot) from tbl_qctest where crop='".$txtcrop."' and variety='".$txtvariety."' and bflg=1  and aflg=0  and cflg=0 and qcflg=0 group by sampleno,oldlot order by lotno desc") or die(mysqli_error($link));
$tot_arr_home1=mysqli_num_rows($sql_arr_home1);
}

 if($tot_arr_home1 >0) {  
?>
<table align="center" border="0" width="943" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="2" align="center" class="tblheading">QC Search Pending  List </td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="24" height="22"align="center" valign="middle" class="tblheading">#</td>
			 <td width="143" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="191" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="107" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="65" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="63" align="center" valign="middle" class="tblheading">Qty</td>
			    <td width="74" align="center" valign="middle" class="tblheading">DOSR</td>
			   <td width="73" align="center" valign="middle" class="tblheading">DOSC</td>
              <td width="66" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td width="66" align="center" valign="middle" class="tblheading">QC Status</td>
			    <td align="center" valign="middle" class="tblheading">Update Result</td>
                <!--<td align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="openslocpopprint();">Print STS</a></td>-->
              </tr>
<?php
$srno=1;
	while($row_tbl_sub11=mysqli_fetch_array($sql_arr_home1))
	{
	if($reptyp=="select")
	{ 
	$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_tbl_sub11['oldlot']."' and  crop='".$txtcrop."' and variety='".$txtvariety."' and bflg=1  and aflg=0  and cflg=0 and qcflg=0 group by sampleno  order by lotno desc") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_tbl_sub11['oldlot']."' and bflg=1  and aflg=0  and cflg=0 and qcflg=0 group by sampleno  order by lotno desc") or die(mysqli_error($link));
	}
	$row_tbl_sub12=mysqli_fetch_array($sql_arr_home2);
	
	$sql_arr_home3=mysqli_query($link,"select * from tbl_qctest where tid='".$row_tbl_sub12[0]."'") or die(mysqli_error($link));
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; 	
	while($row_tbl_sub1=mysqli_fetch_array($sql_arr_home3))
	{	$flg=0;
	$trdate=$row_tbl_sub1['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trdate1=$row_tbl_sub1['spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
		
	$lrole=$row_tbl_sub1['arr_role'];
	$arrival_id=$row_tbl_sub1['tid'];
	$qc1=$row_tbl_sub1['sampleno'];
	$qc=$row_tbl_sub1['qcstatus'];
		/*if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{*/
		$lotno=$row_tbl_sub1['oldlot'];
		//}
	$lotn=$row_tbl_sub1['lotno'];
	
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub1['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."'"); 
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
$stage=$row_tbl_sub1['trstage'];
$pp=$row_tbl_sub1['state'];	

$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2="";
if($stage!="Pack")
{
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{
//echo "SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'";
$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{
//echo "select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0";
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];*/

$slups=$row_month['lotldg_balbags'];
$slqty=$row_month['lotldg_balqty'];

$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

$nob=$nob+$slups;
$qty=$qty+$slqty;
}
}
}
}
else
{
$sql_qc_sub=mysqli_query($link,"SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{
//echo "SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."' and subbinid='".$row_qc_sub['subbinid']."'";
$sql_qc=mysqli_query($link,"SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."' and subbinid='".$row_qc_sub['subbinid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_qc[0]."' and balqty > 0")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];*/

//$slups=$row_month['lotldg_balbags'];
$slqty=$row_month['balqty'];

$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

$nob=$nob+$slups;
$qty=$qty+$slqty;
}
}
}
}
$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}

$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$tdate=$row_tbl_sub1['testdate'];
if($tdate!='NULL' || $tdate!='--' || $tdate!='0000-00-00' || $tdate!=' ')$tdate="";
if($qc=="UT" && $tdate!="")
$flg++;

if($flg==0)		
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="146" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="130" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 			 <td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>  
	  <td width="84" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
	 <td width="73" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>

	<!--<td width="140" align="center" valign="middle" class="tblheading"><?php //=$slocs;?></td>-->
         <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
		  <td width="106" align="center" valign="middle" class="tblheading"><a href="edit_update.php?cropid=<?php echo $row_tbl_sub1['tid'];?>&eurl=<?php echo $eurl?>"><?php echo $tp1?><?php echo $row_tbl_sub1['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>

         <!--<td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php //=$row_tbl_sub1['tid'];?>');">Print</a></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="146" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="130" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>  
		   <td width="76" align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
		   <td width="84" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		     <td align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
	
	<!--<td width="140" align="center" valign="middle" class="tblheading"><?php //=$slocs;?></td>-->
        <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
		  <td width="106" align="center" valign="middle" class="tblheading"><a href="edit_update.php?cropid=<?php echo $row_tbl_sub1['tid'];?>&eurl=<?php echo $eurl?>"><?php echo $tp1?><?php echo $row_tbl_sub1['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>
	
       <!--<td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php //=$row_tbl_sub1['tid'];?>');">Print</a></td>-->
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
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found.</td></tr>
  </table>
<?php
}
?>       
		  </br>
		<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center"><a href="filter1.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;
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
