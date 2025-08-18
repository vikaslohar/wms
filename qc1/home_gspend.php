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
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	else
	{
	 $sdate = "";
	}
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	else
	{
	 $edate = "";
	}

	
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_gspend.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='home_gspend.php'</script>";
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction -Gs Pending</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
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
var cnt=0;
	document.frmaddDepartment.flagcode.value ="";
	if(document.frmaddDepartment.srno.value>2)
	{
		for (var i = 0; i < document.frmaddDepartment.prchk.length; i++) 
		{          
			if(document.frmaddDepartment.prchk[i].checked == true)
			{
				if(document.frmaddDepartment.flagcode.value =="")
				{
					document.frmaddDepartment.flagcode.value=document.frmaddDepartment.prchk[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.prchk[i].value;
					cnt++;
				}
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.prchk.checked == true)
		{
			if(document.frmaddDepartment.flagcode.value =="")
			{
				document.frmaddDepartment.flagcode.value=document.frmaddDepartment.prchk.value;
				cnt++;
			}
			else
			{
				document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.prchk.value;
				cnt++;
			}
		}
	}
	
	if(cnt > 0)
	{
		var itm=document.frmaddDepartment.flagcode.value;
		winHandle=window.open('getuser_sloc.php?tid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
		}
	else
	{
		alert("Select Sample(s) No. To Update");
		return false;
	}

}


function openslocpopprint(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_status.php?tid='+tid,'WelCome','top=170,left=180,width=520,height=350,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
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
	dt1=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.edate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.cdate.value,"-");
		
	if(dt1 > dt2)
	{
		alert("Please select Valid Date Range.");
		return false;
	}
	if(dt2 > dt3)
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

function selectall()
{
//alert(document.frmaddDepartment.foc.value);
	if(document.frmaddDepartment.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDepartment.prchk.length; i++)
		{          
			document.frmaddDepartment.prchk[i].checked = true;
		}
	}	
	else
	{
		document.frmaddDepartment.prchk.checked = true;
	}
}

function unselectall()
{
	if(document.frmaddDepartment.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDepartment.prchk.length; i++) 
		{          
			document.frmaddDepartment.prchk[i].checked = false;
			document.frmaddDepartment.flagcode.value ="";
		}
	}
	else
	{
		document.frmaddDepartment.prchk.checked = false;
		document.frmaddDepartment.flagcode.value ="";
	}	
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
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
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GS Pending</td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txtlot1" value="" type="hidden"> 
	 <input name="cdate" type="hidden" value="<?php echo date("d-m-Y");?>" />
	 <input type="hidden" name="flagcode" value="" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#d21704" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>

  <td width="135" class="tblheading" align="center"><input type="image" src="../images/search.gif" border="0"  /></td>
  </tr>
  </table><br/>
<?php

$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 50; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	

if($sdate!="" && $edate!="")
{		
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
	
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where gsflg=0 and srdate>='$tdate' and srdate<='$pdate' order by srdate asc  LIMIT $start, $limit") or die(mysqli_error($link));
	$query = "SELECT COUNT(*) as num FROM tbl_qctest where gsflg=0 and srdate>='$tdate' and srdate<='$pdate'";
}
else
{
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where gsflg=0 order by srdate asc  LIMIT $start, $limit") or die(mysqli_error($link));
	$query = "SELECT COUNT(*) as num FROM tbl_qctest where gsflg=0";
} 
  if($tot=mysqli_num_rows($sql_arr_home)==0)
  {
  	echo "<script>window.location='home_gspend.php'</script>";
  }
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

	$total_pages = mysqli_fetch_array(mysqli_query($link,$query));
	$total_pages = $total_pages[num];
	
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
			$pagination.= "<a href=\"$targetpage?page=$prev\">&laquo; Previous </a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo; Previouss </span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\"> $counter </span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
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
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\"> $lastpage </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\"> $lastpage </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\"> Next &raquo;</a>";
		else
			$pagination.= "<span class=\"disabled\"> Next &raquo;</span>";
		$pagination.= "</div>\n";		
	}
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
 $srno=($page-1)*$limit+1;
 
 
/* $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where gsflg=0 order by srdate asc ") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

 if($tot_arr_home >0) {   
*/
?>

<table align="center" border="0" width="943" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td width="819" align="middle" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pending GS List</td><td width="124" align="center" class="smalltblheading"><a style="text-decoration:underline; color:#0000FF; cursor:pointer" onclick="selectall();">Check ALL</a>&nbsp;|&nbsp;<a style="text-decoration:underline; color:#0000FF; cursor:pointer " onclick="unselectall();">Clear ALL</a></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="3%" rowspan="2"align="center" valign="middle" class="tblheading">#</td>
			   <td width="10%" rowspan="2" align="center" valign="middle" class="tblheading">Date</td>
			   <td width="14%" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="17%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <!--<td width="5%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Stage</td>
			 
              <td align="center" valign="middle" class="tblheading">GS No. </td>-->
			   <td width="7%" align="center" valign="middle" class="tblheading">SLOC</td>
                <!-- /*<td align="center" valign="middle" class="tblheading">Print</td>*/-->
              </tr>
            <tr class="tblsubtitle" height="20">
              <td align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="openslocpopprint1();">Update</a></td>
            </tr>
<?php
$srno2=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$flg=0;
$sql_arr_hom=mysqli_query($link,"Select * from tbl_qctest where gsflg!=0 and oldlot='".$row_arr_home['oldlot']."'") or die(mysqli_error($link));
$row_num_home1=mysqli_num_rows($sql_arr_hom);
/*if($row_num_home1 > 0)
{
$flg++;
}*/
//echo $flg;
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate=$row_arr_home['srdate'];
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

		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
	
	
	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."'"); 
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
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
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
}}
if($flg==0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		<!-- <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
		   <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>-->
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

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$tp1=13;

?>	
	
        <!-- <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?>/00000<?php echo $qc1?></td>-->
		  <td width="105" align="center" valign="middle" class="tblheading"><input type="checkbox" name="prchk" value="<?php echo $row_arr_home['tid'];?>"></td>
       <!--  <td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">Print</a></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <!-- <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trbags'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_trqty'];?></td>  
		   <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>-->
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

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	
	
      <!--  <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?>/00000<?php echo $qc1?>
		    </td>-->
			<td width="105" align="center" valign="middle" class="tblheading"><input type="checkbox" name="prchk" value="<?php echo $row_arr_home['tid'];?>"></td>
     <!-- /* <td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">Print</a></td>*/-->
</tr>
<?php
}
$srno=$srno+1;
$srno2=$srno2+1;
}
}
}
}
?>
<input type="hidden" name="srno" value="<?php echo $srno2;?>" />
          </table>
<?php echo $pagination?>		  
		  </br>

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
