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
		echo "<script>window.location='home_qc.php?sdate=$sdate&edate=$edate'</script>";
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
<title>Quality- Transaction - Qc Samping Request</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('arr_stocktr_print.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="820" height="25" class="Mainheading">&nbsp;Transaction - Drying </td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#d21704" bordercolordark="#d21704" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="select_qcsampling_req.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onClick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
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
<td width="30">	 </td><td>

<?php

/*$sql_arr_home=mysqli_query($link,"select * from tbl_rsw_main arr_role='$logid'and arrtrflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);*/
?>


<!--- Table Place Holder --->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#d21704" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $sdate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $edate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>

  <td width="135" class="tblheading" align="center"><input type="image" src="../images/search.gif" border="0"  /></td>
  </tr>
  </table><br/>
<?php
$tdate=explode("-",$sdate);
	$tday=$tdate[0];
	$tmonth=$tdate[1];
	$tyear=$tdate[2];
	$tdate=$tyear."-".$tmonth."-".$tday;	
	
	
	$pdate=explode("-",$edate);
	$pday=$pdate[0];
	$pmonth=$pdate[1];
	$pyear=$pdate[2];
	$pdate=$pyear."-".$pmonth."-".$pday;
	
$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 10; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		//echo "select * from tbl_qcgen  where arrival_date>='$tdate' and arrival_date<='$pdate' and arrtrflag=1 order by arr_code desc LIMIT $start, $limit";
  $sql_arr_home=mysqli_query($link,"select * from tbl_qcgen  where arrival_date>='$tdate' and arrival_date<='$pdate' and arrtrflag=1 order by arr_code desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query = "select * from tbl_qcgen  where arrival_date >='$tdate' and arrival_date <='$pdate' and arrtrflag=1 order by arr_code desc";
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
	 $srno=($page-1)*$limit+1;
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
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
	
$sql_arr_home=mysqli_query($link,"select * from tbl_qcgen  where arrival_date >='$tdate' and arrival_date <='$pdate' and arrtrflag=1 order by arr_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qcgen where arrival_date >='$tdate' and arrival_date <='$pdate'  and arrtrflag=1"),0); */

    if($tot_arr_home >0) { 
?>




<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading"> QC Sampling List </td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="900" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="6%"align="center" valign="middle" class="tblheading">#</td> 
			   <td width="8%" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="13%" align="center" valign="middle" class="tblheading">Transaction Id</td>
              <td width="16%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Variety</td>
			  	 <td width="13%" align="center" valign="middle" class="tblheading">Stage</td>  
              <td width="15%" align="center" valign="middle" class="tblheading">Lot No.</td>
			   <td width="16%" align="center" valign="middle" class="tblheading">QC Type</td>
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
	
	$crop=""; $variety=""; $lotno=""; 
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qcgen1 where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{


		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['crop'];
		}
		else
		{
		$crop=$row_tbl_sub['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['variety'];
		}
		else
		{
		 $variety=$row_tbl_sub['variety'];	
		}
		if($lotno="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
		
		 $pp="";
	 if($row_tbl_sub['pp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['pp'];
}
else
{
$pp=$row_tbl_sub['pp'];
}
}
if($row_tbl_sub['gemp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['gemp'];
}
else
{
$pp=$row_tbl_sub['gempp'];
}
}
if($row_tbl_sub['got']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['got'];
}
else
{
$pp=$row_tbl_sub['got'];
}
}
if($row_tbl_sub['moist']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['moist'];
}
else
{
$pp=$row_tbl_sub['moist'];
}

}
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	


$lrole=$row_arr_home['arr_role'];

	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
   $crop=$row31['cropname'];
		 
	 $quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo "QS".$row_arr_home['arr_code']."/".$row_arr_home['year_code']."/".$lrole;?></td>
		  <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		  <td width="13%" align="center" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl_sub['stage'];?>&nbsp;</td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
         </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo "QS".$row_arr_home['arr_code']."/".$row_arr_home['year_code']."/".$lrole;?></td>
         <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		  <td width="13%" align="center" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl_sub['stage'];?>&nbsp;</td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
         </tr>
<?php
}
$srno=$srno+1;
}
}
}
//}
?>
          </table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='900' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
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
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_qc.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
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
