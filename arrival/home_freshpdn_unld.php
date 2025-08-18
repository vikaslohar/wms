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
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
		//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
			echo "<script>window.location='home_freshpdn_unld.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
			echo "<script>window.location='home_freshpdn_unld.php'</script>";
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Fresh Seed Arrival with PDN - Unloading</title>
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
function openpdfgen(tid,subid)
{
var scode="AF"+tid;
winHandle=window.open('unloading_slip_mpdf.php?scode='+scode+'&trid='+tid+'&heading=Complete','WelCome','top=20,left=50,width=50,height=50,scrollbars=yes');
//winHandle=window.open('../pdffiles/RawSeedsUnloadingSheet_AR'+tid+'.pdf','WelCome','top=20,left=50,width=850,height=750,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
function openslocpopprint1(tid,subid)
{
winHandle=window.open('../pdffiles/RawSeedsUnloadingSheet_AR'+tid+'.pdf','WelCome','top=20,left=50,width=850,height=750,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openemailsel(arrivalid,flg)
{
winHandle=window.open('selectmailids_unld.php?pid='+arrivalid+'&flg='+flg,'WelCome','top=20,left=50,width=500,height=500,scrollbars=yes');
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
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - Fresh Seed Arrival with PDN - Unloading</td>
	    </tr></table></td>
	 
	  
	  </tr>
	  </table></td></tr>
    	<td align="center" colspan="4" >
	  	<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 	<input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="10">	 </td><td>
<?php

$sql_arr_home=mysqli_query($link,"select * from tblarrival_unld where arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=0 and arrunldflag!=1 order by arrival_id DESC") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>

<?php
  
  	$adjacents6 = 3;
	
 	$query6 = "SELECT COUNT(*) as num FROM tblarrival_unld where arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=0 and arrunldflag!=1 order by arrival_id DESC";
	$total_pages6 = mysqli_fetch_array(mysqli_query($link,$query6));
	$total_pages6 = $total_pages6[0];
	
	/* Setup vars for query. */
	$targetpage6 = "home_freshpdn_unld.php"; 	//your file name  (the name of this file)
	$limit6 = 10; 
	if(isset($_GET['page6']))								//how many items to show per page
	{$page6 = $_GET['page6'];}
	else {$page6 = 0;}
	if($page6) 
		$start6 = ($page6 - 1) * $limit6; 			//first item to display on this page
	else
		$start6 = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql6 = "select * from tblarrival_unld where arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=0 and arrunldflag!=1 order by arrival_id desc LIMIT $start6, $limit6";
	$sql_arr_home6 = mysqli_query($link,$sql6);
	$tot_arr_home6=mysqli_num_rows($sql_arr_home6);
	/* Setup page vars for display. */
	if ($page6 == 0) $page6 = 1;					//if no page var is given, default to 1.
	$prev6 = $page6 - 1;							//previous page is page - 1
	$next6 = $page6 + 1;							//next page is page + 1
	$lastpage6 = ceil($total_pages6/$limit6);		//lastpage is = total pages / items per page, rounded up.
	$lpm16 = $lastpage6 - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination6 = "";
	if($lastpage6 > 1)
	{	
		$pagination6.= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page6 > 1) 
			$pagination6.= " <a href=\"$targetpage6?page6=$prev6\">&laquo; Previous</a> ";
		else
			$pagination6.= " <span class=\"disabled\">&laquo; Previous</span> ";	
		
		//pages	
		if ($lastpage6 < 7 + ($adjacents6 * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter6 = 1; $counter6 <= $lastpage6; $counter6++)
			{
				if ($counter6 == $page6)
					$pagination6.= " <span class=\"current\">$counter6</span> ";
				else
					$pagination6.= " <a href=\"$targetpage6?page6=$counter6\">$counter6</a> ";					
			}
		}
		elseif($lastpage6 > 5 + ($adjacents6 * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page6 < 1 + ($adjacents6 * 2))		
			{
				for ($counter6 = 1; $counter6 < 4 + ($adjacents6 * 2); $counter6++)
				{
					if ($counter6 == $page6)
						$pagination6.= " <span class=\"current\">$counter6</span> ";
					else
						$pagination6.= " <a href=\"$targetpage6?page6=$counter6\">$counter6</a> ";					
				}
				$pagination6.= "...";
				$pagination6.= " <a href=\"$targetpage6?page6=$lpm16\">$lpm16</a> ";
				$pagination6.= " <a href=\"$targetpage6?page6=$lastpage6\">$lastpage6</a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage6 - ($adjacents6 * 2) > $page6 && $page6 > ($adjacents6 * 2))
			{
				$pagination6.= " <a href=\"$targetpage6?page6=1\">1</a> ";
				$pagination6.= " <a href=\"$targetpage6?page6=2\">2</a> ";
				$pagination6.= "...";
				for ($counter6 = $page6 - $adjacents6; $counter6 <= $page6 + $adjacents6; $counter6++)
				{
					if ($counter6 == $page6)
						$pagination6.= " <span class=\"current\">$counter6</span> ";
					else
						$pagination6.= " <a href=\"$targetpage6?page=$counter6\">$counter6</a> ";					
				}
				$pagination6.= "...";
				$pagination6.= " <a href=\"$targetpage6?page6=$lpm16\">$lpm16</a> ";
				$pagination6.= " <a href=\"$targetpage6?page6=$lastpage6\">$lastpage6</a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination6.= " <a href=\"$targetpage6?page6=1\">1</a> ";
				$pagination6.= " <a href=\"$targetpage6?page6=2\">2</a> ";
				$pagination6.= "...";
				for ($counter6 = $lastpage6 - (2 + ($adjacents6 * 2)); $counter6 <= $lastpage6; $counter6++)
				{
					if ($counter6 == $page6)
						$pagination6.= " <span class=\"current\">$counter6</span> ";
					else
						$pagination6.= " <a href=\"$targetpage6?page6=$counter6\">$counter6</a> ";					
				}
			}
		}
		
		//next button
		if ($page6 < $counter6 - 1) 
			$pagination6.= " <a href=\"$targetpage6?page6=$next6\">Next &raquo;</a> ";
		else
			$pagination6.= " <span class=\"disabled\">Next &raquo;</span> ";
		$pagination6.= "</div>\n";		
	} 
  $srno6=($page6-1)*$limit6+1;
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
	
	
$sql_arr_home=mysqli_query($link,"select * from tblarrival_unld where arrival_type='Fresh Seed with PDN' and arrtrflag=1 order by arrival_date desc, arr_code desc  LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival_unld where arrival_type='Fresh Seed with PDN' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */

    if($tot_arr_home6 >0) { 
?>
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Fresh Seed Arrival with PDN - Unloading: Pending List</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse">

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
              <td align="center" valign="middle" class="tblheading">Unloading sheet</td>
              </tr>
<?php
//$srno=1;
if($tot_arr_home6 > 0)
{
while($row_arr_home6=mysqli_fetch_array($sql_arr_home6))
{
	$trdate=$row_arr_home6['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$yearcode=$row_arr_home6['yearcode'];
	$lrole=$row_arr_home6['arr_role'];
	$arrival_id=$row_arr_home6['arrival_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $phsrn="";
	$sql_tbl_sub6=mysqli_query($link,"select * from tblarrival_sub_unld where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot6=mysqli_num_rows($sql_tbl_sub6);
	while($row_tbl_sub6=mysqli_fetch_array($sql_tbl_sub6))
	{

		$aq=explode(".",$row_tbl_sub6['qty']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub6['qty'];}
		
		$acn=$row_tbl_sub6['act1'];

		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub6['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub6['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub6['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub6['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub6['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub6['lotno'];
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
		$qc=$qc."<br>".$row_tbl_sub6['qc'];
		}
		else
		{
		$qc=$row_tbl_sub6['qc'];
		}
		$gt=explode(" ",$row_tbl_sub6['got']);
		$gt1=explode(" ",$row_tbl_sub6['got1']);
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
		$stage=$stage."<br>".$row_tbl_sub6['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub6['sstage'];
		}
		$phrn=""; $zero=0; $fntcolor='';
		if($row_tbl_sub6['emailflg']>0){$fntcolor='style=color:#FF0000';}
		$phrn="<a href='Javascript:void(0)' onclick='openpdfgen($row_arr_home6[arrival_id],$row_tbl_sub6[arrsub_id])'>Generate PDF</a><br/><br/>"."<a href='Javascript:void(0)' onclick='openslocpopprint1($row_arr_home6[arrival_code],$row_tbl_sub6[arrsub_id])'>Download PDF</a><br/><br/><a href='Javascript:void(0)' $fntcolor onclick='openemailsel($row_tbl_sub6[arrival_id],$zero)'>E-Mail</a>";
		if($phsrn!="")
		{
		$phsrn=$phsrn;
		}
		else
		{
		$phsrn=$phrn;
		}
	}
	
if($srno6%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno6;?></td>
         <td width="9%" align="center" valign="middle" class="smalltblheading"><!--<a href="pdn_fresh1_viewpage.php?p_id=<?php echo $row_arr_home6['arrival_id'];?>">--><?php echo "AF".$row_arr_home6['arrival_code']."/".$yearcode."/".$lrole;?><!--</a>--></td>
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
		</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno6;?></td>
         <td width="9%" align="center" valign="middle" class="smalltblheading"><!--<a href="pdn_fresh1_viewpage.php?p_id=<?php echo $row_arr_home6['arrival_id'];?>">--><?php echo "AF".$row_arr_home6['arrival_code']."/".$yearcode."/".$lrole;?><!--</a>--></td>
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
		</tr>
<?php
}
$srno6=$srno6+1;
}
}
?>
          </table>
 
<?php
}
?>
<!--<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>-->

<?php echo $pagination6; ?>

<br />

<?php

$sql_arr_home=mysqli_query($link,"select * from tblarrival_unld where arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=0 and arrunldflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>

<?php
  
  	$adjacents = 3;
	
 	$query = "SELECT COUNT(*) as num FROM tblarrival_unld where arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=0 and arrunldflag=1 order by arrival_id DESC";
	$total_pages = mysqli_fetch_array(mysqli_query($link,$query));
	$total_pages = $total_pages[0];
	
	/* Setup vars for query. */
	$targetpage = "home_freshpdn_unld.php"; 	//your file name  (the name of this file)
	$limit = 10; 
	if(isset($_GET['page']))								//how many items to show per page
	{if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}}
	else {$page=0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "select * from tblarrival_unld where arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' and arrtrflag=0 and arrunldflag=1 order by arrival_id desc LIMIT $start, $limit";
	$sql_arr_home = mysqli_query($link,$sql);
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination.= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous</a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous</span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\">$counter</span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
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
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
				$pagination.= "...";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\">$lpm1</a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\">$lastpage</a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\">1</a> ";
				$pagination.= " <a href=\"$targetpage?page=2\">2</a> ";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
				$pagination.= "...";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\">$lpm1</a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\">$lastpage</a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\">1</a> ";
				$pagination.= " <a href=\"$targetpage?page=2\">2</a> ";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\">Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\">Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	} 
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
	
	
$sql_arr_home=mysqli_query($link,"select * from tblarrival_unld where arrival_type='Fresh Seed with PDN' and arrtrflag=1 order by arrival_date desc, arr_code desc  LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival_unld where arrival_type='Fresh Seed with PDN' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */

    if($tot_arr_home >0) { 
?>
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Fresh Seed Arrival with PDN - Unloading: Completed List</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse">

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
              <td align="center" valign="middle" class="tblheading">Unloading sheet</td>
             <td align="center" valign="middle" class="tblheading">SLOC</td>
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
	
	$yearcode=$row_arr_home['yearcode'];
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $phsrn="";
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub_unld where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

		$aq=explode(".",$row_tbl_sub['qty']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['qty'];}
		
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
		$phrn=""; $one=1; $fntcolor='';
		if($row_tbl_sub['emailflg']>0){$fntcolor='style=color:#FF0000';}
		$phrn="<a href='Javascript:void(0)' onclick='openpdfgen($row_arr_home[arrival_id],$row_tbl_sub[arrsub_id])'>Generate PDF</a><br/><br/>"."<a href='Javascript:void(0)' onclick='openslocpopprint1($row_arr_home[arrival_code],$row_tbl_sub[arrsub_id])'>Download PDF</a><br/><br/><a href='Javascript:void(0)' $fntcolor onclick='openemailsel($row_tbl_sub[arrival_id],$one)'>E-Mail</a>";
		if($phsrn!="")
		{
		$phsrn=$phsrn;
		}
		else
		{
		$phsrn=$phrn;
		}
	}
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
         <td width="9%" align="center" valign="middle" class="smalltblheading"><!--<a href="pdn_fresh1_viewpage.php?p_id=<?php echo $row_arr_home['arrival_id'];?>">--><?php echo "AF".$row_arr_home['arrival_code']."/".$yearcode."/".$lrole;?><!--</a>--></td>
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
         <td width="4%" align="center" valign="middle" class="smalltblheading"><a href="add_arrival_unld.php?p_id=<?php echo $row_arr_home['arrival_id'];?>">Update</a></td>
		</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
         <td width="9%" align="center" valign="middle" class="smalltblheading"><!--<a href="pdn_fresh1_viewpage.php?p_id=<?php echo $row_arr_home['arrival_id'];?>">--><?php echo "AF".$row_arr_home['arrival_code']."/".$yearcode."/".$lrole;?><!--</a>--></td>
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
         <td width="4%" align="center" valign="middle" class="smalltblheading"><a href="add_arrival_unld.php?p_id=<?php echo $row_arr_home['arrival_id'];?>">Update</a></td>
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
?>
<!--<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>-->

<?php echo $pagination; ?>
</td>
<td width="10"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
		  
		  
<!-- actual page end  -->	
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
