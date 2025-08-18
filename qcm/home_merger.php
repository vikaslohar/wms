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
	
	$sql=mysqli_query($link,"Select * from tbl_blendm where blendm_vlogid='$logid' and blendm_vflg=0") or die(mysqli_error($link));
	$tot=mysqli_num_rows($sql);
	while($row=mysqli_fetch_array($sql))
	{
		$prsid=$row['blendm_id'];
		$sq="update tbl_blendm set blendm_vlogid='' where blendm_id='$prsid'";
		$cx=mysqli_query($link,$sq) or die(mysqli_error($link));
		
		$sq2="update tbl_blends set blends_group=0, blends_delflg=0 where blendm_id='$prsid'";
		$cx2=mysqli_query($link,$sq2) or die(mysqli_error($link));
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC -  Transaction - Lot Blending - Home</title>
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
winHandle=window.open('blending_note.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
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
	      <td width="940" height="25">&nbsp;Transaction - Lot Blending</td>
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
$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 10; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select * from tbl_blendm where blendm_tflg=1 and blendm_aflg=0 order by blendm_date desc,blendm_code desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query = "select * from tbl_blendm where blendm_tflg=1 and blendm_aflg=0 order by blendm_date desc,blendm_code desc";
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
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous </a> ";
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
			$pagination.= " <a href=\"$targetpage?page=$next\"> Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\"> Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
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
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_blendm where blendm_tflg=1 and blendm_aflg=0 order by blendm_date desc,blendm_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_blendm where blendm_tflg=1 and blendm_aflg=0"),0); 
*/
   ?>

<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Blending - Pending List</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="4%"align="center" valign="middle" class="smalltblheading">#</td>
			 <td width="9%" align="center" valign="middle" class="smalltblheading">Transaction Id</td>
			 <td width="8%" align="center" valign="middle" class="smalltblheading">Blending Request Date</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="15%" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="8%" align="center" valign="middle" class="smalltblheading">No. of Lots for Blending</td>
			  <td width="8%" align="center" valign="middle" class="smalltblheading">Lot Type</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Authorization</td>
			  <td width="5%" align="center" valign="middle" class="smalltblheading">Blending</td>
             <td width="6%" align="center" valign="middle" class="smalltblheading">Excel Output</td>
              <!-- <td width="18%" align="center" valign="middle" class="smalltblheading">SLOC</td>
			  <td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td align="center" valign="middle" class="smalltblheading">Output</td>-->
              </tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['blendm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trid=$row_arr_home['blendm_id'];
	$drole=$row_arr_home['blendm_logid'];
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_arr_home['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_arr_home['blendm_variety']."'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);	

$extlotno=$row_arr_home['blendm_nolots'];
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['blendm_lottype'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_vflg']==0){?><a href="add_lotmerger.php?p_id=<?php echo $trid;?>">Pending</a><?php } else echo "Completed";?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext">Pending</td>
        <td width="6%" align="center" valign="middle" class="smalltbltext"><a href="excelblendlots.php?itmid=<?php echo $trid;?>" target="_blank">Excel</a></td>
        <!--  <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc;?></td>
         
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $extnob;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $extqty;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LMN</a></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['blendm_lottype'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_vflg']==0){?><a href="add_lotmerger.php?p_id=<?php echo $trid;?>">Pending</a><?php } else echo "Completed";?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext">Pending</td>
		  <td width="6%" align="center" valign="middle" class="smalltbltext"><a href="excelblendlots.php?itmid=<?php echo $trid;?>" target="_blank">Excel</a></td>
         <!--<td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $mqty?></td>
         <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc;?></td>
         
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $extnob;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $extqty;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LMN</a></td>-->
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
	echo "<table width='950' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
*/
?>
<?php echo $pagination?>
<br />
<br />



<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Blending - Completed</td>
</tr>
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="light" height="25"> 
<td width="140" align="right" class="tblheading">&nbsp;Lot No. wise Search:&nbsp;<input type="text" class="smalltbltext" size="5" maxlength="5" name="lsearch" id="lsearch" onkeyup="searchlotname(this.value)" onkeypress="return isNumberKey1(event)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="12345" />&nbsp;</td>
<!--/*<td width="246" align="right" class="tblheading">&nbsp;Bin wise&nbsp;&nbsp;WH&nbsp;<select class="smalltbltext" id="txttblwhg1" name="txttblwhg1" style="width:70px;"  >
<option value="" selected>WH</option>
	<?php while($noticiawhd1 = mysqli_fetch_array($whd1query)) { ?>
	<option value="<?php echo $noticiawhd1['whid'];?>" />   
	<?php echo $noticiawhd1['perticulars'];?>
	<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;Bin&nbsp;<input type="text" class="smalltbltext" size="3" maxlength="3" name="bsearch" id="bsearch" onkeyup="searchbinname(this.value)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="A01" />&nbsp;</td>*/-->
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
		
  $sql_arr_home1=mysqli_query($link,"select * from tbl_blendm where blendm_aflg=1 order by blendm_date desc,blendm_code desc LIMIT $start1, $limit1") or die(mysqli_error($link));
 $tot_arr_home1=mysqli_num_rows($sql_arr_home1);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query1 = "select * from tbl_blendm where blendm_aflg=1 order by blendm_date desc,blendm_code desc";
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
			$pagination1.= " <a href=\"$targetpage1?page1=$prev1\">« previous </a> ";
		else
			$pagination1.= " <span class=\"disabled1\">« previous </span> ";	
		
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
			$pagination1.= " <a href=\"$targetpage1?page1=$next1\"> next »</a> ";
		else
			$pagination1.= " <span class=\"disabled1\"> next »</span> ";
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
              <td width="4%"align="center" valign="middle" class="smalltblheading">#</td>
			 <td width="9%" align="center" valign="middle" class="smalltblheading">Transaction Id</td>
			 <td width="8%" align="center" valign="middle" class="smalltblheading">Blending Date</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="15%" align="center" valign="middle" class="smalltblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Lot No.</td>
			  <td width="8%" align="center" valign="middle" class="smalltblheading">Lot Type</td>
			  <td width="5%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="18%" align="center" valign="middle" class="smalltblheading">SLOC</td>
              <td width="8%" align="center" valign="middle" class="smalltblheading">No. of Blending Lots</td>
              <!--<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>-->
              <td align="center" valign="middle" class="smalltblheading">Output</td>
              </tr>
<?php
//$srno=1;
if($tot_arr_home1 > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home1))
{

	$trdate=$row_arr_home['blendm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trid=$row_arr_home['blendm_id'];
	$drole=$row_arr_home['blendm_logid'];
	
	$dq=explode(".",$row_arr_home['blendm_qty']);
	if($dq[1]==000){$mqty=$dq[0];}else{$mqty=$row_arr_home['blendm_qty'];}

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_arr_home['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_arr_home['blendm_variety']."'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);	


$nsloc2=""; $lotn=""; $nob2=""; $qty2="";$nob=0; $qty=0; $nobn=0; $qtyn=0; 
$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id=$trid") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
$lotn=$row_eindent_sub['blends_newlot'];
$nobn=$row_eindent_sub['blends_nob'];

$dq=explode(".",$row_eindent_sub['blends_qty']);
if($dq[1]==000){$qtyn=$dq[0];}else{$qtyn=$row_eindent_sub['blends_qty'];}
//echo $lotn."  =>  ".$qtyn."  =  ";
	$nsloc="";$wareh=""; $binn=""; $subbinn=""; $nnob=""; $nqty=""; 
	$sql_eindent_sub2=mysqli_query($link,"select * from tbl_blendss where blendm_id='$trid' and blendss_newlot='".$row_eindent_sub['blends_newlot']."'") or die(mysqli_error($link));
	while($row_eindent_sub2=mysqli_fetch_array($sql_eindent_sub2))
	{
	
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_eindent_sub2['blendss_binid']."' and whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_eindent_sub2['blendss_subbinid']."' and binid='".$row_eindent_sub2['blendss_binid']."' and whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$nnob=$row_eindent_sub2['blendss_nob'];
		
		$dq=explode(".",$row_eindent_sub2['blendss_qty']);
		if($dq[1]==000){$nqty=$dq[0];}else{$nqty=$row_eindent_sub2['blendss_qty'];}
		
		if($nsloc!="")
		$nsloc=$nsloc."<br>".$wareh.$binn.$subbinn."  ".$nnob." | ".$nqty;
		else
		$nsloc=$wareh.$binn.$subbinn."  ".$nnob." | ".$nqty;
	}

$nob=$nob+$nob;
$qty=$qty+$qtyn;


}
$nob2=$nobn;
$qty2=$qty;
//echo "</br>";
if($nsloc2!="")
$nsloc2=$nsloc2."<br>".$nsloc;
else
$nsloc2=$nsloc;
$extlotno=$row_arr_home['blendm_nolots'];
if($srno1%2!=0)
{
?>			  
<tr class="Light">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view2.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['blendm_lottype'];?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $nob2?></td>
         <td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
         <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc2;?></td>
         <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_bflg']!=0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LBN</a><?php }else echo "";?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view2.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['blendm_lottype'];?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $nob2?></td>
         <td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
         <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc2;?></td>
         <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_bflg']!=0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LBN</a><?php }else echo "";?></td>
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
