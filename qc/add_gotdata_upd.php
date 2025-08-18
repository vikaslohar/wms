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
	
	if(isset($_GET['tid']))
	{
		$a = $_GET['tid'];	 
	}
	$tid=$a;
	
	
		
if(isset($_POST['frm_action'])=='submit')
{
	$tid=trim($_POST['tid']);
	$gpper=trim($_POST['gpper']);
	$gotstatus=trim($_POST['gotstatus']);
	$yrcode=trim($_POST['yrcode']);
	$smpno=trim($_POST['smpno']);
	
	$obdate=date("Y-m-d");
	//exit;
	
	$sql_gotmain=mysqli_query($link,"SELECT * FROM tbl_qcgotmain where gotm_id=$tid ")or die(mysqli_error($link));
	$row_gotmain=mysqli_fetch_array($sql_gotmain);
	
	$sql_main=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_sampleno='".$smpno."' and yearid='".$yrcode."' and gottest_lotno='".$row_gotmain['gotm_lotno']."' order by gottest_tid ")or die(mysqli_error($link));
	$row_main=mysqli_fetch_array($sql_main);
	$got_id=$row_main['gottest_tid'];
	$oldlot22=$row_main['gottest_oldlot'];
	
	if($gotstatus!='RT')
	{
		$sql_sub="update tbl_gottest set gottest_gotstatus='$gotstatus', genpurity='$gpper', gottest_gotdate='$obdate', gottest_resultflg=1, gottest_gotflg=1, gottest_restype='app' where gottest_tid='$got_id' ";
		if($row_sub=mysqli_query($link,$sql_sub)or die(mysqli_error($link)))
		{
			$sql_sub2="update tbl_qcgotmain set gotm_result ='$gotstatus', gotm_gpper='$gpper', gotm_resultflg=1 where gotm_id='$tid' ";
			$row_sub2=mysqli_query($link,$sql_sub2)or die(mysqli_error($link));
			
			$x="";
			$sql_sub4="update tbl_lot_ldg set lotldg_got='$gotstatus', lotldg_gottestdate='$obdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$gpper' where orlot='$oldlot22'";
			$qq4=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
			$sql_sub3="update tbl_lot_ldg_pack set lotldg_got='$gotstatus', lotldg_gottestdate='$obdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$gpper' where orlot='$oldlot22'";
			$qq3=mysqli_query($link,$sql_sub3) or die(mysqli_error($link));
			$sql_subchk="update tbl_softr_sub2 set softrsub_srflg='0' where softrsub_lotno ='$oldlot22'";
			mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
		}
		echo "<script>window.location='home_gotdata.php'</script>";	
	}
	else
	{
	?>
	<script>alert("RT Result cannot be updated from here currently. Kindly contact Administrator for further assistance");</script>
	<?php
	}
	//exit;
	
}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - GOT Result Pending List</title>
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
function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;
	var dtObject;
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
	if(document.frmaddDept.gpper.value=="")
	{
		alert("Genetic Purity % cannot be empty");
		//document.frmaddDept.result.value="";
		//document.frmaddDept.insiturepl.focus();
		return false;
	}
	else if(document.frmaddDept.gotstatus.value=="")
	{
		alert("Please Select GOT Status");
		//document.frmaddDept.result.value="";
		document.frmaddDept.gotstatus.focus();
		return false;
	}
	else
	{
		return true;
	}
}
function checksig(resval)
{
	if(document.frmaddDept.gpper.value=="")
	{
		alert("Genetic Purity % cannot be empty");
		document.frmaddDept.gotstatus.value="";
		document.frmaddDept.gotstatus.selectedIndex=0
		//document.frmaddDept.insiturepl.focus();
		return false;
	}
}	
function upschk1()
{
	//alert("Hi...");
	if(document.getElementById('insitu').checked == true)
	{
		document.getElementById('insiturepl').disabled=false;
		document.frmaddDept.insitu.value="yes";
	}
	else
	{
		document.getElementById('insiturepl').disabled=true;
		document.frmaddDept.insitu.value="no";
	}
}
function upschk11()
{
	if(document.getElementById('interra').checked == true)
	{
		document.getElementById('interrarepl').disabled=false;
		document.frmaddDept.interra.value="yes";
	}
	else
	{
		document.getElementById('interrarepl').disabled=true;
		document.frmaddDept.interra.value="no";
	}
}
function insituchk(insiturep,id)
{
	var txtinsiturepl = document.frmaddDept.insiturepl.value;
	var txtinsitu = document.frmaddDept.insitu.value;
	//alert(insiturep);
	if(insiturep > txtinsiturepl)
	{
		alert("Select greater than or equal to existing replications");
		return false;
	}
	else if(insiturep < txtinsiturepl)
	{
		alert("First Submit The New Entered Replication No.");
		return false;
	}
	else
	{
		window.location.href='add_got_insitu.php?tid='+id+'&insitu=yes&insiturepl='+txtinsiturepl;
	}
}
function interrachk(interrarep,id)
{
	var txtinterrarepl = document.frmaddDept.interrarepl.value;
	var txtinterra = document.frmaddDept.interra.value;
	//alert(txtinterrarepl);
	//alert(interrarep);
	window.location.href='add_got_interra.php?tid='+id+'&interra=yes&interrarepl='+txtinterrarepl;
	//window.location.href='add_got_data2.php?tid='+id+'&interra=yes&interrarepl='+txtinterrarepl;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_got.php");?></td>
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
	      <td width="940" height="25">&nbsp;Transaction - GOT Result Update </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	   <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt" value="" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$trid=$a;
$quer3=mysqli_query($link,"SELECT * FROM tbl_qcgotmain where gotm_id='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
$az=mysqli_num_rows($quer3);
$lotno=$noticia['gotm_lotno'];

$smp=str_split($noticia['gotm_sampleno']);
$yrcode=$smp[1];
$sampno=$smp[2].$smp[3].$smp[4].$smp[5].$smp[6].$smp[7];
$sampno=intval($sampno);
	
//echo "select * from tbl_gottest where gottest_lotno='".$a."'";
$sql_month=mysqli_query($link,"select * from tbl_gottest where gottest_sampleno='".$sampno."' and yearid='".$yrcode."' order by gottest_tid desc")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_month);
$oldlot=$row['gottest_oldlot'];

$sql_spcode=mysqli_query($link,"select * from tblarrival_sub where orlot='".$row['gottest_oldlot']."'") or die(mysqli_error($link));
$row_spcode=mysqli_fetch_array($sql_spcode);
$grade=$row['grade'];
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['gottest_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['gottest_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
$sap=$row['gottest_sampleno'];
 $sampl=$tp1.$row['yearid'].sprintf("%000006d",$sap);
  $tp22=$row['gottest_trstage'];
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
$grade=$row['grade'];
$tp1=$row_param['code'];
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" class="tblheading" >GOT Data and Result Update</td>
  </tr>
  <tr class="Dark" height="30">
    <td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<?php echo $crop;?><input name="txtcrop" type="hidden" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>" />
      &nbsp;</td>
    <td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $variety;?><input name="txtvariety" type="hidden" size="20" class="tbltext" tabindex=""    maxlength="20"style="background-color:#CCCCCC" readonly="true" value="<?php echo $variety;?>"/>
      &nbsp;</td>
  </tr>
  <tr class="Dark" height="25">
    <td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $lotno?><input name="txtlot" type="hidden" size="20" class="tbltext" tabindex=""   maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $lotno?>"/>
      &nbsp;
      <input type="hidden" name="oldlot" value="<?php echo $oldlot;?>" /></td>
    <td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tp22?><input name="txtstage" type="hidden" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp22?>"/>
      &nbsp;</td>
  </tr>
  <?php  
	$tdates=$row['gottest_srdate'];
	$tyear=substr($tdates,0,4);
	$tmonth=substr($tdates,5,2);
	$tday=substr($tdates,8,2);
	$tdates=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row['gottest_spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdatee=$row['gottest_dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear; 

?>
  <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
    <td width="217" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdates;?><input name="dosrdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>
      &nbsp;</td>
    <td width="125" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
    <td width="223" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate1;?><input name="doscdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>
      &nbsp;</td>
  </tr>
  <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $tdatee;?><input name="dosdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td>
		
	<td width="125" align="right" valign="middle" class="tblheading">&nbsp;Sample No.&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $sampl;?><input name="txtsampl" type="hidden" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $sampl;?>" maxlength="20"/>&nbsp;</td>
  </tr>
  <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;SP Code Male&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_spcode['spcodem'];?><input name="txtspcodem" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodem'];?>" maxlength="10"/>&nbsp;</td>
	
	<td width="125" align="right" valign="middle" class="tblheading">&nbsp;SP Code Female&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_spcode['spcodef'];?><input name="txtspcodef" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodef'];?>" maxlength="10"/>&nbsp;</td>
  </tr>
</table>
<br/>
<?php

$sql_sowing=mysqli_query($link,"select * from tbl_qcgotsowing where gotm_id='".$trid."' ") or die(mysqli_error($link));
$row_sowing=mysqli_fetch_array($sql_sowing);
$gotsow_loc=$row_sowing['gotsow_loc'];

$tdate2=$row_sowing['gotsow_dosow'];
$tyear2=substr($tdate2,0,4);
$tmonth2=substr($tdate2,5,2);
$tday2=substr($tdate2,8,2);
$dosow=$tday2."-".$tmonth2."-".$tyear2;

?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" class="tblheading" >Sowing Details</td>
  </tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Sowing Date&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $dosow?><input name="sowdate" id="sowdate" size="5" type="hidden" class="tbltext" value="<?php echo $dosow?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Nursery Location&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $gotsow_loc?><input name="nurseryloc" id="nurseryloc" size="25" type="hidden" class="tbltext" value="<?php echo $gotsow_loc?>" /></td>
</tr>
</table>  
<br/>

<?php

$sql_planting=mysqli_query($link,"select * from tbl_qcgottranspl where gotm_id='".$trid."' ") or die(mysqli_error($link));
$row_planting=mysqli_fetch_array($sql_planting);

$gottransp_bedno=$row_planting['gottransp_bedno'];
$gottransp_direction=$row_planting['gottransp_direction'];
$gottransp_noofrows=$row_planting['gottransp_noofrows'];
$gottransp_range=$row_planting['gottransp_range'];
$gottransp_loc=$row_planting['gottransp_loc'];
$gottransp_plotno=$row_planting['gottransp_plotno'];


$tdate3=$row_planting['gottransp_date'];
$tyear3=substr($tdate3,0,4);
$tmonth3=substr($tdate3,5,2);
$tday3=substr($tdate3,8,2);
$dotransplant=$tday3."-".$tmonth3."-".$tyear3;


$sql_finobser=mysqli_query($link,"select * from tbl_qcgotfnobser where gotm_id='".$trid."' ") or die(mysqli_error($link));
$row_finobser=mysqli_fetch_array($sql_finobser);

$fnobser_noofplants=$row_finobser['fnobser_noofplants'];
$fnobser_femaleplants=$row_finobser['fnobser_femaleplants'];
$fnobser_femaleper=round((($row_finobser['fnobser_femaleplants']/$row_finobser['fnobser_noofplants'])*100),2);
$fnobser_maleplants=$row_finobser['fnobser_maleplants'];
$fnobser_maleper=round((($row_finobser['fnobser_maleplants']/$row_finobser['fnobser_noofplants'])*100),2);
$fnobser_otherofftype=$row_finobser['fnobser_otherofftype'];
$fnobser_otheroffper=round((($row_finobser['fnobser_otherofftype']/$row_finobser['fnobser_noofplants'])*100),2);
$fnobser_total=$row_finobser['fnobser_total'];
$fnobser_totalper=round((($row_finobser['fnobser_total']/$row_finobser['fnobser_noofplants'])*100),2);
if($fnobser_totalper<100)
{$gpper=100-$fnobser_totalper;}
else
{$gpper=100;}
$tdate4=$row_finobser['fnobser_obserdate'];
$tyear4=substr($tdate4,0,4);
$tmonth4=substr($tdate4,5,2);
$tday4=substr($tdate4,8,2);
$doo=$tday4."-".$tmonth4."-".$tyear4;

?>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" class="tblheading" >Planting Details</td>
  </tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Transplanting Date&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $dotransplant?><input name="tpdate" id="tpdate" size="5" type="hidden" class="tbltext" value="<?php echo $dotransplant?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Bed No.&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $gottransp_bedno?><input name="tpbedno" id="tpbedno" size="5" type="hidden" class="tbltext" value="<?php echo $gottransp_bedno?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Direction&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $gottransp_direction?><input name="tpdirection" id="tpdirection" size="5" type="hidden" class="tbltext" value="<?php echo $gottransp_direction?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Row&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $gottransp_noofrows?><input name="tpnorows" id="tpnorows" size="5" type="hidden" class="tbltext" value="<?php echo $gottransp_noofrows?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Range&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $gottransp_range?><input name="tprange" id="tprange" size="5" type="hidden" class="tbltext" value="<?php echo $gottransp_range?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Location Farm&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $gottransp_loc?><input name="tploc" id="tploc" size="5" type="hidden" class="tbltext" value="<?php echo $gottransp_loc?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Plot&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $gottransp_plotno?><input name="tpplot" id="tpplot" size="5" type="hidden" class="tbltext" value="<?php echo $gottransp_plotno?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Population&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $fnobser_noofplants?><input name="finpopulation" id="finpopulation" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_noofplants?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Female No.&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $fnobser_femaleplants?><input name="finfemaleno" id="finfemaleno" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_femaleplants?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Female %&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $fnobser_femaleper?><input name="finfemaleper" id="finfemaleper" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_femaleper?>" /></td>
</tr>

<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Male No.&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $fnobser_maleplants?><input name="finmaleno" id="finmaleno" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_maleplants?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Male %&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $fnobser_maleper?><input name="finmaleper" id="finmaleper" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_maleper?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">OOF No.&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $fnobser_otherofftype?><input name="finoofno" id="finoofno" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_otherofftype?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">OOF %&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $fnobser_otheroffper?><input name="finoofper" id="finoofper" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_otheroffper?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Total No.&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $fnobser_total?><input name="fintotno" id="fintotno" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_total?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Total %&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $fnobser_totalper?><input name="fintotper" id="fintotper" size="5" type="hidden" class="tbltext" value="<?php echo $fnobser_totalper?>" /></td>
</tr>
<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">Genetic Purity %&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $gpper?><input name="gpper" id="gpper" size="5" type="hidden" class="tbltext" value="<?php echo $gpper?>" /></td>
<td width="125" align="right"  valign="middle" class="tblheading">Final Observation Date (DOO)&nbsp;</td>
    <td width="223" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $doo?><input name="doodate" id="doodate" size="5" type="hidden" class="tbltext" value="<?php echo $doo?>" /></td>
</tr>

<tr class="Dark" height="30">
<td width="175" align="right"  valign="middle" class="tblheading">GOT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select name="gotstatus" id="gotstatus" class="smalltbltext" style="size:70px;" onchange="checksig(this.value)">
	<option selected="selected" value="">Sel</option>
	<option value="OK">OK</option>
	<option value="BL">BL</option>
	<option value="Fail">Fail</option>
	<option value="RT">RT</option>
	</select></td>
</tr>
</table>  

</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_gotdata.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
  <input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" /><input type="hidden" name="smpno" value="<?php echo $sampno?>" /><input type="hidden" name="yrcode" value="<?php echo $yrcode?>" />&nbsp;&nbsp;</td>
</tr>
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
