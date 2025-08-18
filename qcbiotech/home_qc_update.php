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
	
	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where aflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['tid'];	
}
		
	if(isset($_POST['frm_action'])=='submit')
	{
				//$qcs=trim($_POST['qcsstatus']);
			
		/*if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_trading1.php?sdate=$sdate1&edate=$edate1'</script>";
		}*/
		
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

function openslocpopprint1(tid)
{
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function isNumberKey1(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}

function openslocpopprint(tid)
{
var cnt=0;
	document.frmaddDept.flagcode.value ="";
	if(document.frmaddDept.srno.value>2)
	{
		for (var i = 0; i < document.frmaddDept.prchk.length; i++) 
		{          
			if(document.frmaddDept.prchk[i].checked == true)
			{
				if(document.frmaddDept.flagcode.value =="")
				{
					document.frmaddDept.flagcode.value=document.frmaddDept.prchk[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.prchk[i].value;
					cnt++;
				}
			}
		}
	}
	else
	{
		if(document.frmaddDept.prchk.checked == true)
		{
			if(document.frmaddDept.flagcode.value =="")
			{
				document.frmaddDept.flagcode.value=document.frmaddDept.prchk.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.prchk.value;
				cnt++;
			}
		}
	}
	
	if(cnt > 0)
	{
		var itm=document.frmaddDept.flagcode.value;
		winHandle=window.open('getuser_sts_sl.php?tid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
		}
	else
	{
		alert("Select Sample(s) No. To Print");
		return false;
	}
}

function openst(tid)
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
function searchlotname(searchval)
{
	//if(searchval.length==7)
	searchUser(searchval,"searchresult","lotserch",'','','','','','','','','','');
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
	      <td width="940" height="25">&nbsp;Transaction - QC Result Update </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="flagcode" value="" />
	   <input type="hidden" name="eurl" value="<?php echo $eurl;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="0" width="943" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td align="center" colspan="12" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QC Result Pending List</td>
  <td width="173" align="left" class="tblheading">&nbsp;Search Lot No.&nbsp;
    <input type="text" class="smalltbltext" size="7" maxlength="7" name="lsearch" id="lsearch" onkeyup="searchlotname(this.value)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="DP12345" />&nbsp;</td>
  <td width="98" align="right" class="tblheading"><a href="filter1.php">Search Options</a>&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr height="3"></tr>
</table>
<div id="searchresult" name="searchresult">


<?php
	$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 40; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select distinct sampleno from tbl_qctest where bflg=1 and qcflg=0 and state!='T' order by  spdate ASC, tid desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query = "SELECT distinct sampleno as num FROM tbl_qctest where bflg=1 and qcflg=0 and state!='T'";
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
			$pagination.= "<a href=\"$targetpage?page=$prev\">&laquo; Previous </a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo; Previous </span>";	
		
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
// if($tot_arr_home >0) { $total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
 $srno=($page-1)*$limit+1; $cont=1;
   ?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="24" height="22"align="center" valign="middle" class="tblheading">#</td>
			 <td width="143" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="191" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="107" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="63" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="65" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="63" align="center" valign="middle" class="tblheading">Qty</td>
			    <td width="74" align="center" valign="middle" class="tblheading">DOSR</td>
			   <td width="73" align="center" valign="middle" class="tblheading">DOSC</td>
              <td width="66" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td width="66" align="center" valign="middle" class="tblheading">QC Status</td>
			    <td align="center" valign="middle" class="tblheading">Update Result</td>
                <td align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="openslocpopprint();">Print STS</a></td>
              </tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home24=mysqli_fetch_array($sql_arr_home))
{
	$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where bflg=1 and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
	
	$sql_arr_home24=mysqli_query($link,"select * from tbl_qctest where bflg=1 and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' and tid='".$row_arr_home2[0]."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home24))
	{
	$flg=0;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno="";  $bags=0; $qty=0; $stage=""; $got=""; $qc="";
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
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{
		$lotno=$row_tbl_sub1['oldlot'];
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub1['qcstatus'];
		}
		else
		{
		$qc=$row_tbl_sub1['qcstatus'];
		}
	
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trdate1=$row_arr_home['spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  
	  $stage=$row_tbl_sub1['trstage'];
$pp=$row_tbl_sub1['state'];	
$lotn=$row_tbl_sub1['lotno'];
	 
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2="";
if($stage!="Pack")
{
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

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

		

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$tdate=$row_arr_home['testdate'];
if($qc=="UT" && $tdate!='NULL')
$flg++;

}

if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="24" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="143" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td> 
	<td width="74" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="76" align="center" valign="middle" class="tblheading"><a href="edit_update.php?cropid=<?php echo $row_arr_home['tid'];?>&eurl=<?php echo $eurl?>"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>
	<td width="44" align="center" valign="middle" class="tblheading"><input type="checkbox" name="prchk" value="<?php echo $row_arr_home['tid'];?>"></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="24" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="143" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td> 
	<td width="74" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td width="76" align="center" valign="middle" class="tblheading"><a href="edit_update.php?cropid=<?php echo $row_arr_home['tid'];?>&eurl=<?php echo $eurl?>"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>
	<td width="44" align="center" valign="middle" class="tblheading"><input type="checkbox" name="prchk" value="<?php echo $row_arr_home['tid'];?>"></td>
</tr>
<?php
}
$srno=$srno+1;$cont++;
}
}
}
?><input type="hidden" name="srno" value="<?php echo $cont;?>" />
</table>
<?php echo $pagination?>	
</div>
  
		  <br/>
<?php
	
	$adjacents1 = 2;
	$limit1 = 10; 								
	$page1 = $_GET['page1'];
	if($page1) 
		$start1 = ($page1 - 1) * $limit1; 			//first item to display on this page
	else
		$start1 = 0;	
	
	$sql_dtchk=mysqli_query($link,"select * from tbl_qctest where qcflg=1 order by testdate desc LIMIT 0,1") or die(mysqli_error($link));
	$tot_dtchk=mysqli_num_rows($sql_dtchk);
	$row_dtchk=mysqli_fetch_array($sql_dtchk);
	$lasttdate=$row_dtchk['testdate'];
	
	$trdate=$row_dtchk['testdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt=6;
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); }
	
		
  $sql_arr_home=mysqli_query($link,"select distinct oldlot from tbl_qctest where qcflg=1 and testdate>='$dt1' and qcstatus!='UT' and qcstatus!='RT' and state!='T' order by testdate desc, sampleno desc LIMIT $start1, $limit1") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query = "SELECT COUNT(*) as num1 FROM tbl_qctest where qcflg=1 and testdate>='$dt1' and qcstatus!='UT' and qcstatus!='RT' and state!='T'";
	$total_pages1 = mysqli_fetch_array(mysqli_query($link,$query));
	$total_pages1 = $total_pages1[num1];
	
	if ($page1 == 0) $page1 = 1;					//if no page var is given, default to 1.
	$prev1 = $page1 - 1;							//previous page is page - 1
	$next1 = $page1 + 1;							//next page is page + 1
	$lastpage1 = ceil($total_pages1/$limit1);		//lastpage is = total pages / items per page, rounded up.
	$lpm11 = $lastpage1 - 1;						//last page minus 1
	
$pagination1 = "";
	if($lastpage1 > 1)
	{	
		$pagination1 .= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page1 > 1) 
			$pagination1.= "<a href=\"$targetpage?page1=$prev1\">« previous </a>";
		else
			$pagination1.= "<span class=\"disabled\">« previous </span>";	
		
		//pages	
		if ($lastpage1 < 7 + ($adjacents1 * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter1 = 1; $counter1 <= $lastpage1; $counter1++)
			{
				if ($counter1 == $page1)
					$pagination1.= "<span class=\"current\"> $counter1 </span>";
				else
					$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
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
						$pagination1.= "<span class=\"current\"> $counter1 </span>";
					else
						$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
				}
				$pagination1.= "...";
				$pagination1.= "<a href=\"$targetpage?page1=$lpm11\"> $lpm11 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=$lastpage1\"> $lastpage1 </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage1 - ($adjacents1 * 2) > $page1 && $page1 > ($adjacents1 * 2))
			{
				$pagination1.= "<a href=\"$targetpage?page1=1\"> 1 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=2\"> 2 </a>";
				$pagination1.= "...";
				for ($counter1 = $page1 - $adjacents1; $counter1 <= $page1 + $adjacents1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= "<span class=\"current\"> $counter1 </span>";
					else
						$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
				}
				$pagination1.= "...";
				$pagination1.= "<a href=\"$targetpage?page1=$lpm11\"> $lpm11 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=$lastpage1\"> $lastpage1 </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination1.= "<a href=\"$targetpage?page1=1\"> 1 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=2\"> 2 </a>";
				$pagination1.= "...";
				for ($counter1 = $lastpage1 - (2 + ($adjacents1 * 2)); $counter1 <= $lastpage1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= "<span class=\"current\"> $counter1 </span>";
					else
						$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
				}
			}
		}
		
		//next button
		if ($page1 < $counter1 - 1) 
			$pagination1.= "<a href=\"$targetpage?page1=$next1\"> next »</a>";
		else
			$pagination1.= "<span class=\"disabled\"> next »</span>";
		$pagination1.= "</div>\n";		
	}

 /*$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where qcflg=1  order by lotno desc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);*/

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
// if($tot_arr_home >0) { $total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
 $srno1=($page1-1)*$limit1+1;
?><table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">QC Result Updated List &nbsp;&nbsp;(last <?php echo $dt+1;?> days Records)</td>
</tr>
</table>
		  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="21"align="center" valign="middle" class="tblheading">#</td>
			 <td width="105" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="144" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="103" align="center" valign="middle" class="tblheading">Lot No.</td> 
			  <td width="41" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="65" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="89" align="center" valign="middle" class="tblheading">DOSR</td>
             <td width="81" align="center" valign="middle" class="tblheading">DOSC</td>
			  <td width="88" align="center" valign="middle" class="tblheading">DOT</td>
              <td width="62" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
                <td align="center" valign="middle" class="tblheading">QC Status</td>
                <!-- <td width="27" align="center" valign="middle" class="tblheading">Print</td>-->
              </tr>
<?php

if($tot_arr_home > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home2['oldlot']."' and qcstatus!='UT' and qcstatus!='RT' and state!='T'") or die(mysqli_error($link));	
while($row_arr_home3=mysqli_fetch_array($sql_arr_home2))
{	
$sql_arr_home3=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' and qcstatus!='UT' and qcstatus!='RT' and state!='T'") or die(mysqli_error($link));	
while($row_arr_home=mysqli_fetch_array($sql_arr_home3))
{	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";$slups=0;$slqty=0; $qcr="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and qcstatus!='UT' and qcstatus!='RT' and state!='T'") or die(mysqli_error($link));
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
		
	$trdate1=$row_arr_home['spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_arr_home['testdate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
	
$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."' order by lotldg_id desc") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_arr_home['trstage'];
$pp=$row_arr_home['state'];	
//$qcr=$row_tbl['lotldg_qc'];
$qcr=$row_arr_home['qcstatus'];
	
$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
if($bags!="")
		{
		$bags=$bags."<br>".$ac;
		}
		else
		{
		$bags=$ac;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$acn;
		}
		else
		{
		$qty=$acn;
		}

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
}

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno1;?></td>
         <td width="105" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="103" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>  
	  <td width="89" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		<td width="81" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>   
	<td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="74" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
          <td width="51" align="center" valign="middle" class="tblheading"><?php echo $qcr;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno1;?></td>
         <td width="105" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="103" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>  
	  <td width="89" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		<td width="81" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>   
	<td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="74" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
          <td width="51" align="center" valign="middle" class="tblheading"><?php echo $qcr;?></td>
</tr>
<?php
}
$srno1=$srno1+1;
}
}
}
}
?>
          </table>
<?php echo $pagination1?>			  

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
