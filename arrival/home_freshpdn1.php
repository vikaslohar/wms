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
	
		$sdate=$_REQUEST['sdate'];
		$edate=$_REQUEST['edate'];
		
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate=trim($_POST['sdate']);
		$edate=trim($_POST['edate']);
		
		
		
		if($sdate!="" && $edate!="")
		{
			echo "<script>window.location='home_freshpdn1.php?sdate=$sdate&edate=$edate'</script>";
		}
		else
		 {?>
		 <script>
		  alert("Please Select Period for search");
		  </script>
		 <?php }
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Arrival Fresh PDN</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
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

function openslocpopprint(tid)
{
winHandle=window.open('fpdngrn.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openslocpopprint1(tid,subid)
{
winHandle=window.open('fpdnphsrn.php?itmid='+tid+'&subid='+subid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
function opensendemailpop(arrivalid)
{
winHandle=window.open('sendmail.php?pid='+arrivalid,'WelCome','top=20,left=50,width=850,height=750,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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
function openpdfgen(tid)
{
var scode="AF"+tid;
winHandle=window.open('unloading_slip_mpdf.php?scode='+scode+'&trid='+tid+'&heading=Complete','WelCome','top=20,left=50,width=50,height=50,scrollbars=yes');
//winHandle=window.open('../pdffiles/RawSeedsUnloadingSheet_AR'+tid+'.pdf','WelCome','top=20,left=50,width=850,height=750,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
function openslocpopprint12(tid)
{
winHandle=window.open('../pdffiles/RawSeedsUnloadingSheet_AR'+tid+'.pdf','WelCome','top=20,left=50,width=850,height=750,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
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
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="820" height="25" class="Mainheading">&nbsp;Transaction - Fresh Seed Arrival with PDN</td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#F1B01E" bordercolordark="#F1B01E" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="pdn-fresh1.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onClick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
</tr>
</table></td>
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onSubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="10">	 </td><td>

<?php
$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;	
	
	
	$pdate=$edate;
	$pday=substr($pdate,0,2);
	$pmonth=substr($pdate,3,2);
	$pyear=substr($pdate,6,4);
	$pdate=$pyear."-".$pmonth."-".$pday;
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>


<!--- Table Place Holder --->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#F1B01E" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $sdate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $pdate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>

  <td width="135" class="tblheading" align="center"><input type="image" src="../images/search.gif" border="0"  /></td>
  </tr>
  </table><br/>
<?php
 $targetpage = $_SERVER['PHP_SELF'];; 
	$adjacents = 2;
	$limit = 10; 		
	if(isset($_GET['page']))						
	{if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}}
	else {$page=0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_date >='$tdate' and arrival_date <='$pdate' and arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=1 order by arrival_date desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tblarrival where arrival_date >='$tdate' and arrival_date <='$pdate' and arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=1 order by arrival_date desc";
$total_pages = mysqli_num_rows(mysqli_query($link,$query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev&sdate=$sdate&edate=$edate\">&laquo; Previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter&sdate=$sdate&edate=$edate\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&sdate=$sdate&edate=$edate\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1&sdate=$sdate&edate=$edate\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage&sdate=$sdate&edate=$edate\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1&sdate=$sdate&edate=$edate\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2&sdate=$sdate&edate=$edate\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&sdate=$sdate&edate=$edate\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1&sdate=$sdate&edate=$edate\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage&sdate=$sdate&edate=$edate\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1&sdate=$sdate&edate=$edate\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2&sdate=$sdate&edate=$edate\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&sdate=$sdate&edate=$edate\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next&sdate=$sdate&edate=$edate\"> Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\"> Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrtrflag=1"),0);
 $srno=($page-1)*$limit+1;
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;} 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	$tdate1=explode("-",$sdate);
	$tdate=$tdate1[2]."-".$tdate1[1]."-".$tdate1[0];	

	$pdate1=explode("-",$edate);
	$pdate=$pdate1[2]."-".$pdate1[1]."-".$pdate1[0];	
	
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_date >='$tdate' and arrival_date <='$pdate' and arrival_type='Fresh Seed with PDN' and arrtrflag=1 order by arrival_date desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrival_date >='$tdate' and arrival_date <='$pdate' and arrival_type='Fresh Seed with PDN' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */

     
?>
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td align="center" class="tblheading">Fresh Seed Arrival with PDN</td>
</tr>
</table>
<?php if($tot_arr_home >0) {?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse" >

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td>
			 <td width="9%" align="center" valign="middle" class="tblheading">Trans. Id</td>
              <td width="7%" align="center" valign="middle" class="tblheading">Date</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="15%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="10%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="4%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Stage</td>
              <td align="center" valign="middle" class="tblheading">QC</td>
			  <td width="8%" align="center" valign="middle" class="tblheading">GOT</td>
              <td colspan="3" align="center" valign="middle" class="tblheading">Output</td>
              <!--<td align="center" valign="middle" class="tblheading">Output</td>-->
              </tr>
<?php
//$srno=1;
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
	$arrival_id=$row_arr_home['arrival_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $phsrn=""; $emailflg=0;
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
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
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		
		$gt=explode(" ",$row_tbl_sub['got']);
		$gt1=explode(" ",$row_tbl_sub['got1']);
		if(count($gt1)>1)
		$gt2=$gt[0]." ".$gt1[1];
		else
		$gt2=$gt[0]." ".$gt1[0];
		if($got!="")
		{
		$got=$got."<br>".$gt2;
		}
		else
		{
		$got=$gt2;
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		$phrn="";
		$phrn="<a href='Javascript:void(0)' onclick='openslocpopprint1($row_arr_home[arrival_id],$row_tbl_sub[arrsub_id])'>PHSRN</a>";
		if($phsrn!="")
		{
		$phsrn=$phsrn;
		}
		else
		{
		$phsrn=$phrn;
		}
		if($emailflg==0){$emailflg=$row_tbl_sub['emailflg'];}
	}
	
	
	$send_email=0;
	$sqltblsub=mysqli_query($link,"select * from tblarrival_unld where unldarr_trid='".$arrival_id."'") or die(mysqli_error($link));
	if($subttot=mysqli_num_rows($sqltblsub)>0)
	{
		$rowtblsub=mysqli_fetch_array($sqltblsub);
		$arrival_code=$rowtblsub['arrival_code'];
		$send_email=$arrival_code;
		$arrunldid=$rowtblsub['arrival_id'];
	}
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
         <td width="9%" align="center" valign="middle" class="smalltblheading"><a href="pdn_fresh1_viewpage.php?p_id=<?php echo $row_arr_home['arrival_id'];?>"><?php echo "AF".$row_arr_home['arr_code']."/".$yearid_id."/".$lrole;?></a></td>
         <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
         <td width="13%" align="center" valign="middle" class="smalltblheading"><?php echo $crop?></td>
         <td width="15%" align="center" valign="middle" class="smalltblheading"><?php echo $variety?></td>
         <td width="10%" align="center" valign="middle" class="smalltblheading"><?php echo $lotno?></td>
         <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $bags?></td>
         <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $qty?></td>
         <td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $stage?></td>
         <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qc?></td>
		 <td width="8%" align="center" valign="middle" class="smalltblheading"><?php echo $got?></td>
         <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $phsrn?></td>
         <td width="4%" align="center" valign="middle" class="smalltblheading"><a href="home_freshpdn12.php?p_id=<?php echo $row_arr_home['arrival_id'];?>">FRN</a></td>
		 <td width="4%" align="center" valign="middle" class="smalltblheading"><a href='Javascript:void(0)' onclick='openpdfgen(<?php echo $arrunldid?>)'>Generate PDF</a><br/><br/><a href='Javascript:void(0)' onclick='openslocpopprint12(<?php echo $arrival_code?>)'>Download PDF</a><br/><br/><?php if($send_email>0){?><a href='Javascript:void(0)' <?php if($emailflg>0){echo "style='color:#FF0000'"; } ?> onclick='opensendemailpop(<?php echo $send_email?>,1)'>E-mail</a><?php } ?></td>
		</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
         <td width="9%" align="center" valign="middle" class="smalltblheading"><a href="pdn_fresh1_viewpage.php?p_id=<?php echo $row_arr_home['arrival_id'];?>"><?php echo "AF".$row_arr_home['arr_code']."/".$yearid_id."/".$lrole;?></a></td>
         <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
         <td width="13%" align="center" valign="middle" class="smalltblheading"><?php echo $crop?></td>
         <td width="15%" align="center" valign="middle" class="smalltblheading"><?php echo $variety?></td>
         <td width="10%" align="center" valign="middle" class="smalltblheading"><?php echo $lotno?></td>
          <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $bags?></td>
         <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $qty?></td>
         <td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $stage?></td>
         <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qc?></td>
		 <td width="8%" align="center" valign="middle" class="smalltblheading"><?php echo $got?></td>
         <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $phsrn?></td>
         <td width="4%" align="center" valign="middle" class="smalltblheading"><a href="home_freshpdn12.php?p_id=<?php echo $row_arr_home['arrival_id'];?>">FRN</a></td>
		 <td width="4%" align="center" valign="middle" class="smalltblheading"><a href='Javascript:void(0)' onclick='openpdfgen(<?php echo $arrunldid?>)'>Generate PDF</a><br/><br/><a href='Javascript:void(0)' onclick='openslocpopprint12(<?php echo $arrival_code?>)'>Download PDF</a><br/><br/><?php if($send_email>0){?><a href='Javascript:void(0)' <?php if($emailflg>0){echo "style='color:#FF0000'"; } ?> onclick='opensendemailpop(<?php echo $send_email?>,1)'>E-mail</a><?php } ?></td>
		</tr>
<?php
}
$srno=$srno+1;
}
}
?>
          </table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='970' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&sdate=$sdate&edate=$edate\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&sdate=$sdate&edate=$edate\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&sdate=$sdate&edate=$edate\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
	
		echo "</td></tr></table>";*/
	}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}
?>
<?php echo $pagination?>
<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_freshpdn.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>


</td><td width="10"></td>
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
