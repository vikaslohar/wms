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

	
$sql_tbl=mysqli_query($link,"select * from tbl_opspa where arr_role='".$logid."' and opspa_tflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['opspa_id'];	
	
	$s_sub="delete from tbl_opspa_sub where opspa_id='".$arrival_id."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	$s_sub_sub="delete from tbl_opspasub_sub where opspa_id='".$arrival_id."'";
	mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));
	
}

	$s_sub="delete from tbl_opspa where arr_role='".$logid."' and opspa_tflg=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	


		
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
		//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_optrn12.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='home_optrn2.php'</script>";
		}
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival - Transaction - Opening Stock - Condition Seed (Lots-listed in application)</title>
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
/*winHandle=window.open('drying_print.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }*/

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
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="820" height="25">&nbsp;Transaction - Opening Stock - Condition Seed (Lots-listed in application)</td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#F1B01E" bordercolordark="#F1B01E" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="trn_op_add2.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
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

<!--- Table Place Holder --->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#F1B01E" style="border-collapse:collapse">
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
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_opspa where opspa_tflg=1 and plantcode='$plantcode' order by opspa_date desc, opspa_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_opspa where opspa_tflg=1 and plantcode='$plantcode'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

if($tot_arr_home >0) { 
?>


<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Opening Stock - Condition Seed (Lots-listed in application)</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse">

          <tr class="tblsubtitle" height="20">
				<td width="17" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
			    <td width="62" rowspan="2" align="center" valign="middle" class="smalltblheading">Trans. Id</td>
			    <td width="61" rowspan="2" align="center" valign="middle" class="smalltblheading">Date</td>
			    <td width="86" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
			    <td width="136" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
				<td width="80" rowspan="2" align="center" valign="middle" class="smalltblheading">Lot No.</td>
				<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">Stage</td>
				<td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Arrival Qty</td>
				<td width="64" rowspan="2" align="center" valign="middle" class="smalltblheading">Raw Seed Qty</td>
				<td width="62" rowspan="2" align="center" valign="middle" class="smalltblheading">Difference Qty</td>
				<td colspan="2" align="center" valign="middle" class="smalltblheading">Condition Seed</td>
				<td width="96" rowspan="2" align="center" valign="middle" class="smalltblheading">SLOC</td>
                <td width="62" rowspan="2" align="center" valign="middle" class="smalltblheading">Difference in Seed Stock</td>
			    </tr>
<tr class="tblsubtitle" height="20">
  <td width="34" align="center" valign="middle" class="smalltblheading">NoB</td>
  <td width="49" align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['opspa_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['opspa_id'];
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_opspa_sub where opspa_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $arrqty=""; $rsqqty=""; $diffqty=""; $connob=""; $conqty=""; $diffssqty=""; $sloc="";
	
	$wareh=""; $binn=""; $subbinn=""; $slocs="";$slups=0; $slqty=0;
	$sql_sloc=mysqli_query($link,"select * from tbl_opspasub_sub where opspa_id='".$arrival_id."' and opspasub_id='".$row_tbl_sub['opspasub_id']."' order by opspasubsub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars']."/";
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname']."/";
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	if($slocs!="")
	$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
	else
	$slocs=$wareh.$binn.$subbinn."<br/>";
	}
	$connob=$row_tbl_sub['conseed_nob']; 
	$conqty=$row_tbl_sub['conseed_qty'];
	
	$aq=explode(".",$conqty);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$conqty;}
	
	$an=explode(".",$connob);
	if($an[1]==000){$acn=$an[0];}else{$acn=$connob;}

		if($sloc!="")
		{
		$sloc=$sloc."<br>".$slocs;
		}
		else
		{
		$sloc=$slocs;
		}
		
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
		
		if($arrqty!="")
		{
		$arrqty=$arrqty."<br>".$row_tbl_sub['arrival_qty'];
		}
		else
		{
		$arrqty=$row_tbl_sub['arrival_qty'];
		}
		if($rsqqty!="")
		{
		$rsqqty=$rsqqty."<br>".$row_tbl_sub['rsw_qty'];
		}
		else
		{
		$rsqqty=$row_tbl_sub['rsw_qty'];
		}
		
		if($diffqty!="")
		{
		$diffqty=$diffqty."<br>".$row_tbl_sub['diff_qty'];
		}
		else
		{
		$diffqty=$row_tbl_sub['diff_qty'];
		}
		if($diffssqty!="")
		{
		$diffssqty=$diffssqty."<br>".$row_tbl_sub['diff_seed_stock'];
		}
		else
		{
		$diffssqty=$row_tbl_sub['diff_seed_stock'];
		}
		
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		
	}
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><a href="trn_arrvop_qty_viewpage2.php?pid=<?php echo $row_arr_home['opspa_id'];?>"><?php echo "OP".$row_arr_home['opspa_code']."/".$yearid_id."/".$lrole;?></a></td>
         <td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="136" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td width="80" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $arrqty?></td>
         <td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $rsqqty?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $diffqty?></td>
		 <td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
		 <td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="96" align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $diffssqty?></td>
         </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><a href="trn_arrvop_qty_viewpage2.php?pid=<?php echo $row_arr_home['opspa_id'];?>"><?php echo "OP".$row_arr_home['opspa_code']."/".$yearid_id."/".$lrole;?></a></td>
         <td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="136" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td width="80" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $arrqty?></td>
         <td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $rsqqty?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $diffqty?></td>
		 <td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
		 <td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="96" align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $diffssqty?></td>
         </tr>
<?php
}
$srno=$srno+1;
}
}
?>
          </table>
<?php
	$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='970' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'>&laquo; Previous </a> "; 
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
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next &raquo;</a>"; 
	} 
		echo "</td></tr></table>"; 
}
?>
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
