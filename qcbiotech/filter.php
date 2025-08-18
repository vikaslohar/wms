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
	
	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where aflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['tid'];	
}
		
	if(isset($_POST['frm_action'])=='submit')
	{
				//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_trading1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction -QC Result Update </title>
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
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
}function open(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('filter.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
           <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
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
	      <td width="820" height="25">&nbsp;Transaction - QC Result Update </td>
	    </tr></table></td>
	 <!-- <td width="116" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#F1B01E" bordercolordark="#F1B01E" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_result_update.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>
</table></td>-->
	  
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
  $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where bflg=1  and aflg=0  and cflg=0 and qcflg=0  and qc='UT' order by lotno DESC") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);  ?>

<table align="center" border="0" width="943" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="2" align="center" class="tblheading">Pending Samples List </td><td width="405" colspan="12" align="right" class="tblheading"><a href="javascript:void(0)" onclick="selectall()">Filter</a>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="23" height="22"align="center" valign="middle" class="tblheading">#</td>
			   <td width="62" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="92" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="117" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="110" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="63" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="70" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="57" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="162" align="center" valign="middle" class="tblheading">SLOC</td>
              <td width="51" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
              <td width="27" align="center" valign="middle" class="tblheading">Print</td>
              </tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	
	
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
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

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);




}
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="62" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="92" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname'];?></td>
         <td width="110" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
		   <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
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
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";


?>	
	<td width="162" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="90" align="center" valign="middle" class="tblheading"><a href="edit_update.php?cropid=<?php echo $row_arr_home['lotno'];?>"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>
         <td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">Print</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="62" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="92" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname'];?></td>
         <td width="110" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
		   <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
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
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";


?>	
	<td width="162" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
        <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="90" align="center" valign="middle" class="tblheading"><a href="edit_update.php?cropid=<?php echo $row_arr_home['lotno'];?>"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>
       <td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">Print</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}

?>
          </table>
		  <br/>
		  <?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where qcflg=1  order by lotno desc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);  
?><table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Updated List</td>
</tr>
</table>
		  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="23"align="center" valign="middle" class="tblheading">#</td>
			   <td width="56" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="94" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="124" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="110" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="63" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="68" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="59" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="167" align="center" valign="middle" class="tblheading">SLOC</td>
              <td width="43" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
              <td width="27" align="center" valign="middle" class="tblheading">Print</td>
              </tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{

/*
		if($qc1!="")
		{
		
		}
		else
		{
		
		}
		*/
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		/*if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub1['moist'];
		}
		else
		{
		$moist=$row_tbl_sub1['moist'];	
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub1['got'];
		}
		else
		{
	$got=$row_tbl_sub1['got'];	
		}
		if($pp!="")
		{
		$pp=$pp."<br>".$row_tbl_sub1['lotldg_qc'];
		}
		else
		{
		$pp=$row_tbl_sub1['lotldg_qc'];	
		}
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub1['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub1['gemp'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	
		
	
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_arr_home['trstage'];
$pp=$row_arr_home['state'];	
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

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
}
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="56" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname'];?></td>
         <td width="110" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
		   <td width="59" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
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
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";

?>	
	<td width="167" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="90" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
         <td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">Print</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="56" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname'];?></td>
         <td width="110" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
		   <td width="59" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
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
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";


?>	
	<td width="167" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
        <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="90" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
       <td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">Print</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}

?>
          </table>
		 <!--<table align="center" width="700" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>-->


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
