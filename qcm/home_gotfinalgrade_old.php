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
	
	if(isset($_POST['frm_action'])=='submit')
	{
	
		$tridlist2=$_POST['tridlist'];
	//echo "<br />";
		$resultlist2=$_POST['resultlist'];
	//echo "<br />";
		$tridlist=explode(",",$tridlist2);
		$resultlist=explode(",",$resultlist2);
		
		//echo count($tridlist);
	//exit;	
		$tdate=date("Y-m-d");
		for($i=0; $i<count($tridlist); $i++)
		{
			if($tridlist[$i]<>"")
			{
				$tid=$tridlist[$i];
				$finalgotgrade=$resultlist[$i];
				
				$sql_arr_home=mysqli_query($link,"select * from tbl_btsplatingsub_sub2 where btsplatingss2_id='$tid'") or die(mysqli_error($link));
				$tot_arr_home=mysqli_num_rows($sql_arr_home);
				if($tot_arr_home >0) 
				{
					$row_arr_home=mysqli_fetch_array($sql_arr_home);
		
					$trdate=$row_arr_home['btsplatingss2_resultdate'];
					
					
					$trid=$row_arr_home['btsplatingss2_id'];
					$offtypeper=''; $femaletypeper=''; $maletypeper='';	
					
					$qry_btsgerm=mysqli_query($link,"select * from tbl_btssdldispm_sub where btssdldispms_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
					$row_btsgerm=mysqli_fetch_array($qry_btsgerm);		
					$hybcode=$row_btsgerm['btssdldispms_hybrid'];
						
					$qry_arr_sub=mysqli_query($link,"select * from tblarrival_sub where lotno='".$row_arr_home['btsplatingss2_lotno']."' order by lotno") or die(mysqli_error($link));
					$row_arr_sub=mysqli_fetch_array($qry_arr_sub);
					
					$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
					$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
					$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
					
					
					
					
					$extlotno=$row_arr_home['btsplatingss2_lotno'];
					$orlot=$row_arr_sub['orlot'];
					$sampleno=$row_btsgerm['btssdldispms_sampleno'];
					$crop=$row_btsgerm['btssdldispms_crop'];
					$variety=$row_btsgerm['btssdldispms_variety'];
					
					if($row_arr_home['btsplatingss2_retestflg']==1)
					{
						$qry_btsplating_retest=mysqli_query($link,"select * from tbl_btsseedling_retest where seelingretest_lotno='".$row_arr_home['btsplatingss2_lotno']."' order by seelingretest_id DESC") or die(mysqli_error($link));
						$row_btsplating_retest=mysqli_fetch_array($qry_btsplating_retest);
						
						$noofampsamples=$row_btsplating_retest['seelingretest_noofpcrampsamples'];
						$offtype=$row_btsplating_retest['seelingretest_offtype'];
						$femaletype=$row_btsplating_retest['seelingretest_femaletype'];
						$maletype=$row_btsplating_retest['seelingretest_maletype'];
						$impurities=$row_btsplating_retest['seelingretest_impuritiesper'];
						$gpper=$row_btsplating_retest['seelingretest_gpper'];
						$noofhybrid=$row_btsplating_retest['seelingretest_noofhybrid'];
						$btsgrade=$row_btsplating_retest['seelingretest_grade'];
						
						$offtypeper=round((($row_btsplating_retest['seelingretest_offtype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
						$femaletypeper=round((($row_btsplating_retest['seelingretest_femaletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
						$maletypeper=round((($row_btsplating_retest['seelingretest_maletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
					}
					else
					{
						$noofampsamples=$row_arr_home['btsplatingss2_noofpcrampsamples'];
						$offtype=$row_arr_home['btsplatingss2_offtype'];
						$femaletype=$row_arr_home['btsplatingss2_femaletype'];
						$maletype=$row_arr_home['btsplatingss2_maletype'];
						$impurities=$row_arr_home['btsplatingss2_impuritiesper'];
						$gpper=$row_arr_home['btsplatingss2_gpper'];
						$btsgrade=$row_arr_home['btsplatingss2_grade'];
						$noofhybrid=$row_arr_home['btsplatingss2_noofhybrid'];
						
						$offtypeper=round((($row_arr_home['btsplatingss2_offtype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
						$femaletypeper=round((($row_arr_home['btsplatingss2_femaletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
						$maletypeper=round((($row_arr_home['btsplatingss2_maletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
					}
					$prodgrade=$row_arr_sub['prodgrade'];
					$farmerid=$row_btsgerm['btssdldispms_farmerid'];
					$agreementid=$row_btsgerm['btssdldispms_agreementid'];
					
		
					$sql_in1="Insert into tbl_gotgrade (gotgrade_date, gotgrade_crop, gotgrade_variety, gotgrade_lotno, gotgrade_orlot, gotgrade_prodgrade, gotgrade_sampleno, gotgrade_farmerid, gotgrade_agreementid, gotgrade_noampsamples, gotgrade_offtype, gotgrade_offtypeper, gotgrade_femaletype, gotgrade_femaletypeper, gotgrade_maletype, gotgrade_maletypeper, gotgrade_noofhybrid, gotgrade_impurper, gotgrade_gpper, gotgrade_grade, gotgrade_btsresultdate, gotgrade_finalgrade, gotgrade_tflg, gotgrade_yearcode, gotgrade_logid, gotgrade_hybrid) Values('".$tdate."', '".$crop."', '".$variety."', '".$extlotno."', '".$orlot."', '".$prodgrade."', '".$sampleno."', '".$farmerid."', '".$agreementid."', '".$noofampsamples."', '".$offtype."', '".$offtypeper."', '".$femaletype."', '".$femaletypeper."', '".$maletype."', '".$maletypeper."', '".$noofhybrid."', '".$impurities."', '".$gpper."', '".$btsgrade."', '".$trdate."', '".$finalgotgrade."', '1', '".$yearid_id."', '".$logid."', '".$hybcode."')";	
		//echo "<br />";
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}	
			}
		}	
//	exit;
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC -  Transaction - GOT Final Grade - Home</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="search.js"></script>
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
<script type="text/javascript">

function openslocpopprint(tid)
{
winHandle=window.open('gotfingrade_update.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

/*function openslocpopprint1(itm)
{
winHandle=window.open('gatepass_dd.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}*/

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
//alert(document.frmaddDept.srno.value);
//alert(document.frmaddDept.finalgotgrade.length);
	if(document.frmaddDept.srno.value>2)
	{
		for (var i = 0; i < document.frmaddDept.finalgotgrade.length; i++) 
		{          
			if(document.frmaddDept.finalgotgrade[i].value!="")
			{
				if(document.frmaddDept.resultlist.value =="")
				{
					document.frmaddDept.resultlist.value=document.frmaddDept.finalgotgrade[i].value;
				}
				else
				{
					document.frmaddDept.resultlist.value = document.frmaddDept.resultlist.value +','+document.frmaddDept.finalgotgrade[i].value;
				}
				if(document.frmaddDept.tridlist.value =="")
				{
					document.frmaddDept.tridlist.value=document.frmaddDept.trid[i].value;
				}
				else
				{
					document.frmaddDept.tridlist.value = document.frmaddDept.tridlist.value +','+document.frmaddDept.trid[i].value;
				}
			}
		}
	}
	else
	{
		if(document.frmaddDept.finalgotgrade[i].value!="")
		{
			if(document.frmaddDept.resultlist.value =="")
				{
					document.frmaddDept.resultlist.value=document.frmaddDept.finalgotgrade.value;
				}
				else
				{
					document.frmaddDept.resultlist.value = document.frmaddDept.resultlist.value +','+document.frmaddDept.finalgotgrade.value;
				}
				if(document.frmaddDept.tridlist.value =="")
				{
					document.frmaddDept.tridlist.value=document.frmaddDept.trid.value;
				}
				else
				{
					document.frmaddDept.tridlist.value = document.frmaddDept.tridlist.value +','+document.frmaddDept.trid.value;
				}
		}
	}
//alert(document.frmaddDept.tridlist.value); 
//alert(document.frmaddDept.resultlist.value);
	if(document.frmaddDept.tridlist.value=="" || document.frmaddDept.resultlist.value=="")
	{
		alert("Please Select Result");
		//document.frmaddDept.txtstage.focus();
		f=1;
		return false;
	}
		
return true;
}

function openexlpopup(trid)
{
	winHandle=window.open('excelblendlots.php?itmid='+trid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function searchlotname(searchval)
{
	var txttblwhg1='';
	var bsearch='';
	var typ='';
	var ordn='';
	var ver='';
	var ups='';
	var qt='';
	var party='';
	var trid='';
	var sno='';
	var sn='';
	var subtrid='';
	var subsubtrid='';
	searchUser(searchval,"searchresult","lotserch",txttblwhg1,bsearch,party,sno,ordn,ver,ups,qt,trid,typ,subtrid,subsubtrid,sn);
}

function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
</script>


<body topmargin="0" leftmargin="0" bottommargin="0">

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">
	<table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GOT Final Grade</td>
	    </tr></table></td>
		  
	  </tr>
	  </table>
	  </td></tr>
	  <tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td>
<td>




<!--- Table Place Holder --->
<?php

$sql_arr_home=mysqli_query($link,"select * from tbl_btsplatingsub_sub2 where btsplatingss2_resultverifyflg=1 and btsplatingss2_abortflg=0 group by btsplatingss2_lotno order by btsplatingss2_resultdate asc,btsplatingss2_lorryno asc ") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
?>

<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">GOT Final Grade - Pending List</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="2%"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="13%" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Hybrid Code</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Lot Number</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Result Date</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">No of Amp. Samples</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Off Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Off Type %</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Female Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Female Type $</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Male Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Male Type %</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Impurities %</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">GP %</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">BTS Grade</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Prod. Grade</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Update</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">BTS Remark</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['btsplatingss2_resultdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trid=$row_arr_home['btsplatingss2_id'];
	//$drole=$row_arr_home['blendm_logid'];
	$offtypeper=''; $femaletypeper=''; $maletypeper='';	$btsremark=''; $crop=''; $variety=''; $noofpcrampsamples=''; $offtype=''; $femaletype=''; $maletype=''; $impuritiesper=''; $gpper=''; $grade=''; $hybcode=''; $bags=0; $qty=0; 
	
	$qry_btsgerm=mysqli_query($link,"select * from tbl_btssdldispm_sub where btssdldispms_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
	$row_btsgerm=mysqli_fetch_array($qry_btsgerm);		
		
	$qry_arr_sub=mysqli_query($link,"select * from tblarrival_sub where lotno='".$row_arr_home['btsplatingss2_lotno']."' order by lotno") or die(mysqli_error($link));
	$row_arr_sub=mysqli_fetch_array($qry_arr_sub);
	
	$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_arr_home['btsplatingss2_lotno']."'") or die(mysqli_error($link));
	$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
	$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
	
	
	$extlotno=$row_arr_home['btsplatingss2_lotno'];
	
	$qry_tbl_makerselection=mysqli_query($link,"select * from tbl_makerselection where makersel_farmerid='".trim($row_btsgerm['btssdldispms_farmerid'])."'") or die(mysqli_error($link));
	$tot_tbl_makerselection=mysqli_num_rows($qry_tbl_makerselection);	
	$row_tbl_makerselection=mysqli_fetch_array($qry_tbl_makerselection);	
	
	$qry_tbl_makerselection_sub=mysqli_query($link,"select * from tbl_makerselection_sub where makersel_id='".$row_tbl_makerselection['makersel_id']."'") or die(mysqli_error($link));
	$tot_tbl_makerselection_sub=mysqli_num_rows($qry_tbl_makerselection_sub);	
	$row_tbl_makerselection_sub=mysqli_fetch_array($qry_tbl_makerselection_sub);	
	
	$btsremark=$row_tbl_makerselection_sub['makersels_remark'];
	if($row_btsgerm['btssdldispms_terremark']!='') { $btsremark=$row_btsgerm['btssdldispms_terremark'];}
	
	$lott=str_split($extlotno);
	$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
	$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
	
	/*$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$orlot."'  group by lotldg_subbinid, lotldg_variety, orlot order by lotldg_subbinid") or die(mysql_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl22=mysqli_fetch_array($sql_tbl_sub1))
	{
		$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl22['lotldg_subbinid']."' and orlot='".$orlot."' ") or die(mysql_error($link));  
		$row_tbl1=mysqli_fetch_array($sql_tbl1);*/
		$sql1=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$orlot."' order by lotldg_id ASC ")or die(mysql_error($link));
		$total_tbl=mysqli_num_rows($sql1);
		$row_tbl=mysqli_fetch_array($sql1);
		{	
			$ac=$row_tbl['lotldg_balbags'];
			$an=explode(".",$row_tbl['lotldg_balqty']);
			if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
			$bags=$bags+$ac;
			$qty=$qty+$acn;
		}
	//}
	
	if($row_arr_home['btsplatingss2_retestflg']==1)
	{
		$qry_btsplating_retest=mysqli_query($link,"select * from tbl_btsseedling_retest where seelingretest_lotno='".$row_arr_home['btsplatingss2_lotno']."' order by seelingretest_id DESC") or die(mysqli_error($link));
		$row_btsplating_retest=mysqli_fetch_array($qry_btsplating_retest);
		
		$crop=$row_btsgerm['btssdldispms_crop'];
		$variety=$row_btsgerm['btssdldispms_variety'];
		$noofpcrampsamples=$row_btsplating_retest['seelingretest_noofpcrampsamples'];
		$offtype=$row_btsplating_retest['seelingretest_offtype'];
		$femaletype=$row_btsplating_retest['seelingretest_femaletype'];
		$maletype=$row_btsplating_retest['seelingretest_maletype'];
		$impuritiesper=$row_btsplating_retest['seelingretest_impuritiesper'];
		$gpper=$row_btsplating_retest['seelingretest_gpper'];
		$grade=$row_arr_sub['prodgrade'];
		$btsgrade=$row_btsplating_retest['seelingretest_grade'];
		$hybcode=$row_btsgerm['btssdldispms_hybrid'];
		
		$offtypeper=round((($row_btsplating_retest['seelingretest_offtype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
		$femaletypeper=round((($row_btsplating_retest['seelingretest_femaletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
		$maletypeper=round((($row_btsplating_retest['seelingretest_maletype']/$row_btsplating_retest['seelingretest_noofpcrampsamples'])*100),3); 
	}
	else
	{
		$crop=$row_btsgerm['btssdldispms_crop'];
		$variety=$row_btsgerm['btssdldispms_variety'];
		$noofpcrampsamples=$row_arr_home['btsplatingss2_noofpcrampsamples'];
		$offtype=$row_arr_home['btsplatingss2_offtype'];
		$femaletype=$row_arr_home['btsplatingss2_femaletype'];
		$maletype=$row_arr_home['btsplatingss2_maletype'];
		$impuritiesper=$row_arr_home['btsplatingss2_impuritiesper'];
		$gpper=$row_arr_home['btsplatingss2_gpper'];
		$grade=$row_arr_sub['prodgrade'];
		$btsgrade=$row_arr_home['btsplatingss2_grade'];
		$hybcode=$row_btsgerm['btssdldispms_hybrid'];
		
		$offtypeper=round((($row_arr_home['btsplatingss2_offtype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
		$femaletypeper=round((($row_arr_home['btsplatingss2_femaletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
		$maletypeper=round((($row_arr_home['btsplatingss2_maletype']/$row_arr_home['btsplatingss2_noofpcrampsamples'])*100),3); 
	}



if($qty==0 || $qty=="")
{
	$qry_btsgermp=mysqli_query($link,"select * from tbl_btssdlgermlist where btssdlgermlist_lotno='".$extlotno."' ") or die(mysqli_error($link));
	$row_btsgermp=mysqli_fetch_array($qry_btsgermp);
	$qty=$row_btsgermp['btssdlgermlist_qty'];
	$grade=$row_btsgermp['btssdlgermlist_prodgrade'];
}
	
if($tot_tbl_gotgrade==0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="12%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $hybcode;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $noofpcrampsamples;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $offtype;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $offtypeper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $femaletype;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $femaletypeper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $maletype;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $maletypeper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $impuritiesper;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $gpper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsgrade;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $grade;?></td>
	
	<td width="4%" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select name="finalgotgrade" id="finalgotgrade"  style="width:60px;" class="smalltbltext" tabindex="" >
<option value="" selected>Select</option>
<option value="A+">A+</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="BL">BL</option>
<option value="Hold">Hold</option>
<option value="Substandard">Substandard</option>
</select>&nbsp;<font color="#FF0000">*</font></td><input type="hidden" name="trid" value="<?php echo $trid;?>" />
	<!--<td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($tot_tbl_gotgrade==0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">Update</a><?php } else echo "Completed";?></td>-->
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsremark;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="12%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $hybcode;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $noofpcrampsamples;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $offtype;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $offtypeper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $femaletype;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $femaletypeper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $maletype;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $maletypeper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $impuritiesper;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $gpper;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsgrade;?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $grade;?></td>
	<td width="4%" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select name="finalgotgrade" id="finalgotgrade"  style="width:60px;" class="smalltbltext" tabindex="" >
<option value="" selected>Select</option>
<option value="A+">A+</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="BL">BL</option>
<option value="Hold">Hold</option>
<option value="Substandard">Substandard</option>
</select>&nbsp;<font color="#FF0000">*</font></td><input type="hidden" name="trid" value="<?php echo $trid;?>" />
	<!--<td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($tot_tbl_gotgrade==0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">Update</a><?php } else echo "Completed";?></td>-->
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsremark;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
<input type="hidden" name="srno" value="<?php echo $srno;?>" /><input type="hidden" name="tridlist" value="" /><input type="hidden" name="resultlist" value="" />
          </table>

<table cellpadding="5" cellspacing="5" border="0" width="950">
    <tr >
      <td align="right" colspan="3">&nbsp;<input name="image" type="image" style="display:inline;cursor:pointer;" onclick="return mySubmit();" src="../images/update.gif" alt="Submit Value" border="0"/>&nbsp;</td>
    </tr>
  </table>



<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">GOT Final Grade - Completed</td>
</tr>
</table>
<div id="searchresult">
 <?php
$targetpage1 = $PHP_SELF; 
	$adjacents1 = 2;
	$limit1 = 10; 								
	$page1 = $_GET['page1'];
	if($page1) 
		$start1 = ($page1 - 1) * $limit1; 			//first item to display on this page
	else
		$start1 = 0;	
		
  $sql_arr_home1=mysqli_query($link,"select * from tbl_gotgrade order by gotgrade_id DESC LIMIT $start1, $limit1") or die(mysqli_error($link));
 $tot_arr_home1=mysqli_num_rows($sql_arr_home1);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query1 = "select * from tbl_gotgrade order by gotgrade_id DESC";
$total_pages1 = mysqli_num_rows(mysqli_query($link,$query1));
//echo	$total_pages = $total_pages[num];
	
	if ($page1 == 0) $page1 = 1;					//if no page var is given, default to 1.
	$prev1 = $page1 - 1;							//previous page is page - 1
	$next1 = $page1 + 1;							//next page is page + 1
	$lastpage1 = ceil($total_pages1/$limit1);		//lastpage is = total pages / items per page, rounded up.
	$lpm11 = $lastpage1 - 1;						//last page minus 1
	
$pagination1 = "";
	if($lastpage1 > 1)
	{	
		$pagination1 .= "<div class=\"pagination1\" align=\"right\">";
		//previous button
		if ($page1 > 1) 
			$pagination1.= " <a href=\"$targetpage1?page1=$prev1\"> previous </a> ";
		else
			$pagination1.= " <span class=\"disabled1\"> previous </span> ";	
		
		//pages	
		if ($lastpage1 < 7 + ($adjacents1 * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter1 = 1; $counter1 <= $lastpage1; $counter1++)
			{
				if ($counter1 == $page1)
					$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
				else
					$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
			}
		}
		elseif($lastpage1 > 5 + ($adjacents1 * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page1 < 1 + ($adjacents1 * 2))		
			{
				for ($counter1 = 1; $counter1 < 4 + ($adjacents1 * 2); $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
				$pagination1.= " ... ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lpm11\"> $lpm11 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lastpage1\"> $lastpage1 </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage1 - ($adjacents1 * 2) > $page1 && $page1 > ($adjacents1 * 2))
			{
				$pagination1.= " <a href=\"$targetpage1?page1=1\"> 1 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=2\"> 2 </a> ";
				$pagination1.= " ... ";
				for ($counter1 = $page1 - $adjacents1; $counter1 <= $page1 + $adjacents1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
				$pagination1.= " ... ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lpm11\"> $lpm11 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lastpage1\"> $lastpage1 </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination1.= " <a href=\"$targetpage1?page1=1\"> 1 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=2\"> 2 </a> ";
				$pagination1.= " ... ";
				for ($counter1 = $lastpage1 - (2 + ($adjacents1 * 2)); $counter1 <= $lastpage1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
			}
		}
		
		//next button
		if ($page1 < $counter1 - 1) 
			$pagination1.= " <a href=\"$targetpage1?page1=$next1\"> next </a> ";
		else
			$pagination1.= " <span class=\"disabled1\"> next </span> ";
		$pagination1.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
 $srno1=($page1-1)*$limit1+1;
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_blendm where blendm_aflg=1 order by blendm_date desc,blendm_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_blendm where blendm_aflg=1"),0); */

   ?> 
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="2%"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="13%" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Hybrid Code</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Lot Number</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Result Date</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">No of Amp. Samples</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Off Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Off Type %</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Female Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Female Type $</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Male Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Male Type %</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Impurities %</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">GP %</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">BTS Remarks</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">BTS Grade</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Prod. Grade</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Final GOT Grade</td>
</tr>
<?php
//$srno=1;
if($tot_arr_home1 > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home1))
{

	$trdate=$row_arr_home['gotgrade_btsresultdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$btsremark='';
	$qry_btsgerm=mysqli_query($link,"select * from tbl_btssdldispm_sub where btssdldispms_lotno='".$row_arr_home['gotgrade_lotno']."'") or die(mysqli_error($link));
	$row_btsgerm=mysqli_fetch_array($qry_btsgerm);		
	$hybcode=$row_btsgerm['btssdldispms_hybrid'];
	
	$qry_tbl_makerselection=mysqli_query($link,"select * from tbl_makerselection where makersel_farmerid='".trim($row_btsgerm['btssdldispms_farmerid'])."'") or die(mysqli_error($link));
	$tot_tbl_makerselection=mysqli_num_rows($qry_tbl_makerselection);	
	$row_tbl_makerselection=mysqli_fetch_array($qry_tbl_makerselection);	
	
	$qry_tbl_makerselection_sub=mysqli_query($link,"select * from tbl_makerselection_sub where makersel_id='".$row_tbl_makerselection['makersel_id']."'") or die(mysqli_error($link));
	$tot_tbl_makerselection_sub=mysqli_num_rows($qry_tbl_makerselection_sub);	
	$row_tbl_makerselection_sub=mysqli_fetch_array($qry_tbl_makerselection_sub);	
	
	$btsremark=$row_tbl_makerselection_sub['makersels_remark'];
	if($row_btsgerm['btssdldispms_terremark']!='') { $btsremark=$row_btsgerm['btssdldispms_terremark'];}
	
	
	$lott=str_split($row_arr_home['gotgrade_lotno']);
	$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
	$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$orlot."'  group by lotldg_subbinid, lotldg_variety, orlot order by lotldg_subbinid") or die(mysql_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl22=mysqli_fetch_array($sql_tbl_sub1))
	{
		$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl22['lotldg_subbinid']."' and orlot='".$orlot."' ") or die(mysql_error($link));  
		$row_tbl1=mysqli_fetch_array($sql_tbl1);
		$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysql_error($link));
		$total_tbl=mysqli_num_rows($sql1);
		while($row_tbl=mysqli_fetch_array($sql1))
		{	
			$ac=$row_tbl['lotldg_balbags'];
			$an=explode(".",$row_tbl['lotldg_balqty']);
			if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
			$bags=$bags+$ac;
			$qty=$qty+$acn;
		}
	}
if($srno1%2!=0)
{
?>			  
<tr class="Light">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="12%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_crop'];?></td>
	<td width="13%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_variety'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_hybrid'];?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_lotno'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_noampsamples'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_impurper'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_gpper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsremark;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_grade'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_prodgrade'];?></a></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_finalgrade'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="12%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_crop'];?></td>
	<td width="13%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_variety'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_hybrid'];?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_lotno'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_noampsamples'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_impurper'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_gpper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsremark;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_grade'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_prodgrade'];?></a></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_finalgrade'];?></td>
</tr>
<?php
}
$srno1=$srno1+1;
}
}
?>
          </table>


<?php
?>
<?php echo $pagination1?>
</div>
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
      
		</table>
  </td>
  </tr>      
</table>
</body>
</html>

