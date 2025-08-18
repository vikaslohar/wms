<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	$yrflg=0;
	/*$currentdate=date("Y-m-d");
	$cryear=substr($currentdate,0,4);
	$yrflg=0;
	if($year1!=$cryear)
	{$yrflg=1;}
	$logid="DC1";*/
$sql_tbl=mysqli_query($link,"select * from tblspdec where logid='".$logid."' and  spdectype='DM' and spdectflg=0 ") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['spdecid'];	
	$s_sub="delete from tblspcodes where spdecid='".$arrival_id."' ";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
}

	$s_sub="delete from tblspdec where logid='".$logid."' and  spdectype='DM' and spdectflg=0 ";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode- Transaction - Decode Manual - Home</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
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

function openslocpopprint(tid)
{
winHandle=window.open('decode_note.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}


/*function openslocpopprint1(itm,tp)
{
		winHandle=window.open('excel_fspdn.php?itmid='+itm+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}*/


/*function openslocpopprint2(itm,tp)
{
		winHandle=window.open('pdn_select.php?itmid='+itm+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}

*/function imgOnClick(dt, xind, yind)
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
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr>
           <td valign="top"><?php require_once("../include/arr_adm.php");?></td>
         </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dec_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/dec_rupee1.gif" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25"><table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" style="border-bottom:solid; border-bottom-color:#7a9931" >
        <tr >
          <td width="820" height="25">&nbsp;Transaction - Decode Manual</td>
        </tr>
	    </table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:pointer;"><?php if($yrflg==0) { ?><a href="add.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Check, Todays date is not with in the range of current year set in the application.\nContact Admin to check the year settings.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
</tr>
</table></td>
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
/*
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblspdec where spdecid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['spdecid'];

	$tdate=$row_tbl['spdecdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
*/?>

<br/>
<?php
$targetpage = $_SERVER['PHP_SELF']; 
	$adjacents = 2;
	$limit = 10; 								
	if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select * from tblspdec where spdectflg=1 and spdectype='DM'  order by spcdeccode desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tblspdec where spdectflg=1 and spdectype='DM'  order by spcdeccode desc";
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
			$pagination.= " <a href=\"$targetpage?page=$prev\">� previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">� previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
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
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> next �</a> ";
		else
			$pagination.= " <span class=\"disabled\"> next �</span> ";
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
		$srno=(($page * 20)+1) - 20;
	} 
	$max_results = 20; 
	$from = (($page * $max_results) - $max_results); 
	
/*	$sql_opr=mysqli_query($link,"select * from tblopr where id='".$loginid."'") or die(mysqli_error($link));
	$row_opr=mysqli_fetch_array($sql_opr);

	$trvflag=$row_opr['trvflag'];
	
if($trvflag=="Yes")
{	
$sql_arr_home=mysqli_query($link,"select * from tblspdec where spdectflg=1 and spdectype='DM' order by spcdeccode desc LIMIT $from, $max_results") or die(mysqli_error($link));
//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblspdec where where spdectflg=1 and spdectype='DM'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
/*}
else
{
$sql_arr_home=mysqli_query($link,"select * from tblarrival where trtype='freshpdn' and trflg=1 and logid='$logid' order by ar_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where trtype='freshpdn'  and logid='$logid' and trflg=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
}

$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblspdec where spdectflg=1 and spdectype='DM'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
*/
    if($tot_arr_home >0) { 
?>


<!--<table align="center" border="0" width="974" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td width="757" align="center" class="tblheading">Decode Manual</td>
  <td width="93" align="right" class="tblheading">&nbsp;</td>
</tr>
</table>-->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#7a9931"
 style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="5%"align="center" valign="middle" class="tblheading">#</td>
			 <td width="10%" align="center" valign="middle" class="tblheading">Transaction Id</td>
			  <td width="8%" align="center" valign="middle" class="tblheading">Date</td>
			  <td align="center" valign="middle" class="tblheading">SP Code-Female</td>
              <td width="13%" align="center" valign="middle" class="tblheading">SP Code-Male</td>
			  <td width="21%" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
              <td align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
              <td align="center" valign="middle" class="tblheading">Output</td>
				 </tr>
<?php

//$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['spdecdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$arrival_id=$row_arr_home['spdecid'];
	//$lrole=$row_arr_home['arr_role'];

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo "DM".$row_arr_home['spcdeccode']."/".$yearid_id."/".$row_arr_home['logid'];?></td>
		  <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
<?php
$crop=""; $variety=""; $spcf=""; $spcm="";
$sql_tbl_sub=mysqli_query($link,"select * from tblspcodes where spdecid='".$arrival_id."' ") or die(mysqli_error($link));
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['crop']."'"); 
	$row3=mysqli_fetch_array($quer3);

	$quer4=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['variety']."'  and vertype='PV'"); 
	$row4=mysqli_fetch_array($quer4);

if($crop!="")
$crop=$crop."<br>&nbsp;".$row3['cropname'];
else
$crop=$row3['cropname'];

if($variety!="")
$variety=$variety."<br>&nbsp;".$row4['popularname'];
else
$variety=$row4['popularname'];

if($spcf!="")
$spcf=$spcf."<br>".$row_tbl_sub['spcodef'];
else
$spcf=$row_tbl_sub['spcodef'];

if($spcm!="")
$spcm=$spcm."<br>".$row_tbl_sub['spcodem'];
else
$spcm=$row_tbl_sub['spcodem'];

}	 
?>		  
		  <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcf;?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcm;?></td>
         <td width="21%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
         <td width="23%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $row_arr_home['spdecid'];?>');">DMN</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo "DM".$row_arr_home['spcdeccode']."/".$yearid_id."/".$row_arr_home['logid'];?></td>
		  <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
<?php
$crop=""; $variety=""; $spcf=""; $spcm="";
$sql_tbl_sub=mysqli_query($link,"select * from tblspcodes where spdecid='".$arrival_id."' ") or die(mysqli_error($link));
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['crop']."'"); 
	$row3=mysqli_fetch_array($quer3);

	$quer4=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['variety']."'  and vertype='PV'"); 
	$row4=mysqli_fetch_array($quer4);

if($crop!="")
$crop=$crop."<br>&nbsp;".$row3['cropname'];
else
$crop=$row3['cropname'];

if($variety!="")
$variety=$variety."<br>&nbsp;".$row4['popularname'];
else
$variety=$row4['popularname'];

if($spcf!="")
$spcf=$spcf."<br>".$row_tbl_sub['spcodef'];
else
$spcf=$row_tbl_sub['spcodef'];

if($spcm!="")
$spcm=$spcm."<br>".$row_tbl_sub['spcodem'];
else
$spcm=$row_tbl_sub['spcodem'];

}	 
?>		  
		  <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcf;?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcm;?></td>
         <td width="21%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
         <td width="23%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $row_arr_home['spdecid'];?>');">DMN</a></td>
 </tr>
<?php
}
$srno=$srno+1;
}
?>
          </table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='974' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
		echo "</td></tr></table>"; */
}
?>
<!--<table align="center" width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a></td>
</tr>
</table>-->

<?php echo $pagination?>
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
