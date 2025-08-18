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
	
	
	/*$sql_yr=mysqli_query($link,"select * from tblyears where years_flg =1 and years_status='a'")or die("Error:".mysqli_error($link));
	$tot_yr=mysqli_num_rows($sql_yr);
	$row_yr=mysqli_fetch_array($sql_yr);
	
		$y1=$row_yr['year1'];
		$y2=$row_yr['year2'];
	
		$cdate=date("Y-m-d");
		$sdate=$y1."-04-01";
		$edate=$y2."-03-31"; 
		$s=strtotime($sdate); 
		$e=strtotime($edate);
		$c=strtotime($cdate);
		
			if($c >= $s && $c <= $e)
			{ $flg=0;}
			else
			{ $flg=1;}
		
		
		$sql_good=mysqli_query($link,"select max(stlg_id) from tbl_stldg_good WHERE plantcode='".$plantcode."'") or die(mysqli_error($link));
		$row_good=mysqli_fetch_array($sql_good);
				
		$sql_good1=mysqli_query($link,"select stlg_trdate from tbl_stldg_good where stlg_id='".$row_good[0]."' AND plantcode='".$plantcode."'") or die(mysqli_error($link));
		$row_good1=mysqli_fetch_array($sql_good1);
		$rg1=mysqli_num_rows($sql_good1);
		$last_tdateg=$row_good1['stlg_trdate'];
		$lstdtg=strtotime($last_tdateg);
		
		$sql_damage=mysqli_query($link,"select max(stld_id) from tbl_stldg_damage WHERE plantcode='".$plantcode."'") or die(mysqli_error($link));
		$row_damage=mysqli_fetch_array($sql_damage);
				
		$sql_damage1=mysqli_query($link,"select stld_trdate from tbl_stldg_damage where stld_id='".$row_damage[0]."' AND plantcode='".$plantcode."'") or die(mysqli_error($link));
		$row_damage1=mysqli_fetch_array($sql_damage1);
		$rd1=mysqli_num_rows($sql_damage1);
		$last_tdated=$row_damage1['stld_trdate'];
		$lstdtd=strtotime($last_tdated);
		
		if($c >= $lstdtg || $c >= $lstdtd)
			{ $flg1=0;}
			else
			{ $flg1=1;}

		$sql_ci=mysqli_query($link,"select * from tbl_ci where ci_upflg=0 AND plantcode='".$plantcode."'") or die(mysqli_error($link));
		$row_ci=mysqli_fetch_array($sql_ci);
		$t_ci=mysqli_num_rows($sql_ci);
		if($t_ci > 0)
			{ $flg2=1;}
			else
			{ $flg2=0;}



$sql_tbl=mysqli_query($link,"select * from tbl_discard where ddrole='".$logid."' and ddflg=0 AND plantcode='".$plantcode."'") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['tid'];	
	
	$s_sub="delete from tbl_discard_sub where did_s='".$arrival_id."' AND plantcode='".$plantcode."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	$s_sub_sub="delete from tbl_discard_sloc where discard_trid='".$arrival_id."' AND plantcode='".$plantcode."'";
	mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));
	
}

	$s_sub="delete from tbl_discard where ddrole='".$logid."' and ddflg=0 AND plantcode='".$plantcode."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
		
*/
	
	if(isset($_POST['frm_action'])=='submit')
	{
		exit;
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
		//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='add_discard1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='add_discard.php'</script>";
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant -  Transaction - Discard Home</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
</script>
<script type="text/javascript">

function openslocpopprint(tid)
{
winHandle=window.open('material_discard_note.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openslocpopprint1(itm)
{
winHandle=window.open('gatepass_dd.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
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

</script>


<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" 

bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" 

align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" 

cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Transaction - Material Discard </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<!--<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_material_discard.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>
-->
<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:hand;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_material_discard.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>




<!--- Table Place Holder --->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#2e81c1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDept.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDept.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>

  <td width="135" class="tblheading" align="center"><input type="image" src="../images/search.gif" border="0" onclick="return mySubmit();"  /></td>
  </tr>
  </table><br />

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
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_discard where  ddflg=1 AND plantcode='".$plantcode."' order by tid desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_discard where  ddflg=1 AND plantcode='".$plantcode."'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

   ?>

<table align="center" border="0" width="700" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Material Discard</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#2e81c1" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="4%"align="center" valign="middle" class="tblheading">#</td>
			 <td width="15%" align="center" valign="middle" class="tblheading">Transaction Id</td>
			 <td width="12%" align="center" valign="middle" class="tblheading">Discard Date</td>
              <td width="40%" align="center" valign="middle" class="tblheading">Party</td>
			  <td width="13%" align="center" valign="middle" class="tblheading">Discard Inst. Ref. No.</td>
              <td align="center" valign="middle" class="tblheading">Output</td>
              </tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['tdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	$drole=$row_arr_home['ddrole'];
	
	
	//$quer3=mysqli_query($link,"SELECT party_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	//$row3=mysqli_fetch_array($quer3);
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><a href="add_discard_str_view.php?p_id=<?php echo $row_arr_home['tid'];?>"><?php echo "MD".$row_arr_home['dd_code']."/".$row_arr_home['yearcode']."/".$drole;?></a></td>
		 <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="40%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['party_name'];?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['drno']?></td>
         <td width="16%" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">MDN</a> | <a href="Javascript:void(0)" onclick="openslocpopprint1('<?php echo $row_arr_home['tid'];?>');">Gate Pass</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><a href="add_discard_str_view.php?p_id=<?php echo $row_arr_home['tid'];?>"><?php echo "MD".$row_arr_home['dd_code']."/".$row_arr_home['yearcode']."/".$drole;?></a></td>
		 <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="40%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['party_name'];?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['drno']?></td>
         <td width="16%" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $row_arr_home['tid'];?>');">MDN</a> | <a href="Javascript:void(0)" onclick="openslocpopprint1('<?php echo $row_arr_home['tid'];?>');">Gate Pass</a></td>
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
	echo "<table width='700' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
//}
?>


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
