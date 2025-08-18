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
	
$sql_tbl=mysqli_query($link,"select * from tbl_csw_main where plantcode='".$plantcode."' and arr_role='".$logid."' and  arrtrflag=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['arrival_id'];	
	
	$s_sub="delete from tbl_csw where arrival_id='".$arrival_id."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	

	
}

	/*$s_sub="delete from tbl_csw where arr_role='".$logid."' arrtrflag=1";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	*/


		
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
		//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_qc.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='home_qc1.php'</script>";
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW- Transaction - QC Sampling</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('stocknote.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
           <td valign="top"><?php require_once("../include/arr_csw.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/csw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">


		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" style="border-bottom:solid; border-bottom-color:#fa8283" >
	    <tr >
	      <td width="820" height="25">&nbsp;Transaction - Qc sampling </td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#fa8283" bordercolordark="#fa8283" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_arrival_stocktransfer.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>
</table></td>
	  
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

$sql_arr_home=mysqli_query($link,"select * from tbl_csw_main where plantcode='".$plantcode."' and  arr_role='$logid' and arrtrflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>


<!--- Table Place Holder --->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#fa8283" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDept.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDept.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>

  <td width="135" class="tblheading" align="center"><input type="image" src="../images/search.gif" border="0"  /></td>
  </tr>
  </table><br/>
<?php
if(!isset($_GET['page'])) { 
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
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_csw_main where plantcode='".$plantcode."' and  arr_role='$logid' and arrtrflag=1 order by arr_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_csw_main where plantcode='".$plantcode."' and  arr_role='$logid' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

    if($tot_arr_home >0) { 
?>


<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading"> Stock Transfer From Plant </td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#fa8283" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			   <td width="5%" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="9%" align="center" valign="middle" class="tblheading">Transaction Id</td>
              <td width="7%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Lot No.</td>
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
	$arrival_id=$row_arr_home['arrival_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_csw where plantcode='".$plantcode."' and  arrival_id='".$arrival_id."'") or die(mysqli_error($link));
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
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
		
	}
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
/*	 $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['lotvariety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 



		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo "TAS".$row_arr_home['arr_code']."/".$yearid_id."/".$lrole;?></td>
		  <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo "TAS".$row_arr_home['arr_code']."/".$yearid_id."/".$lrole;?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         </tr>
<?php
}
$srno=$srno+1;
}
}
//}
//}
?>
          </table>
<?php
	$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='850' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
		echo "</td></tr></table>"; 
}
?></td>
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
