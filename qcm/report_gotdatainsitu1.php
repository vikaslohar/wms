<?php session_start();
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
	
	$edate = $_REQUEST['edate'];
	$sdate=$_REQUEST['sdate'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report - Comprehensive GOT Data Report (In Situ)</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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
<SCRIPT language="JavaScript">

function openprint(srno)
{
	if(srno>1)
	{
		var sdate=document.frmaddDepartment.sdate.value;
		var edate=document.frmaddDepartment.edate.value;
		winHandle=window.open('report_gotdatainsitu2.php?sdate='+sdate+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=950,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
	}
	else
	{
		alert("No data present to Preview");
	}
}
function opendata(trid)
{
	if(srno>1)
	{
		var sdate=document.frmaddDepartment.sdate.value;
		var edate=document.frmaddDepartment.edate.value;
		winHandle=window.open('getuser_gotdatainsiturep.php?sdate='+sdate+'&edate='+edate+'trid='+trid,'WelCome','top=20,left=80,width=1000,height=950,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
	}
	else
	{
		alert("No data present to Preview");
	}
}
</script>
<body>
<table width="1003" height="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">&nbsp;Comprehensive GOT Data Report (In Situ)</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	 <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="sdate" value="<?php echo $sdate;?>" type="hidden">
	 <input name="edate" value="<?php echo $edate;?>" type="hidden">
	 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="10"></td> <td>

<?php 
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
		
		$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
		
$sql="select distinct(gottest_lotno) from tbl_gottest where gottest_gotflg=1";
$sql.=" order by gottest_dosdate asc, gottest_lotno asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);	
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  	<tr height="25">
	<td align="left" class="subheading" style="color:#303918;" width="50%">&nbsp;&nbsp;Arrival Period From: <?php echo $_REQUEST['sdate'];?></td>
	 <td align="right" class="subheading" style="color:#303918;">To: <?php echo $_REQUEST['edate'];?>&nbsp;&nbsp;</td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading" >#</td>
			<td width="70"  align="center" valign="middle" class="tblheading" >Date of Arrival</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Crop</td>
			<td width="123"  align="center" valign="middle" class="tblheading" >SP Codes</td>
			<td width="176"  align="center" valign="middle" class="tblheading" >Variety</td>
			<td width="54"  align="center" valign="middle" class="tblheading" >Stage</td>
			<td width="123"  align="center" valign="middle" class="tblheading" >Lot No.</td>
			<td width="54"  align="center" valign="middle" class="tblheading" >NoB</td>
			<td width="54"  align="center" valign="middle" class="tblheading" >Qty</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Production Location</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Organiser</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Farmer</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >Production Personnel</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >GOT Status</td>
			<td width="94"  align="center" valign="middle" class="tblheading" >GOT Data</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
$sqlmax2="select MAX(gottest_tid) from tbl_gottest where gottest_lotno='".$row_arr_home2['gottest_lotno']."' and gottest_gotflg=1";
$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));

$tot_max2=mysqli_num_rows($sql_max2);
$row_arr_home3=mysqli_fetch_array($sql_max2);

$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_arr_home3[0]."' and gottest_gotflg=1 ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	$trdate=$row_arr_home['gottest_srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$trdate1=$row_arr_home['gottest_spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_arr_home['gottest_dosdate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
		
	$gotstatus=$row_arr_home['gottest_gotstatus'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
$sql_max6=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$arrival_id."' and gottests_type!='IN-TERRA' ") or die(mysqli_error($link));
$tot_max6=mysqli_num_rows($sql_max6);
while($row_arr_home6=mysqli_fetch_array($sql_max6))
{	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where orlot='".$row_arr_home['gottest_oldlot']."'") or die(mysqli_error($link));  
	$row_tbl1=mysqli_fetch_array($sql_tbl1);
	
	$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
	
	if($total_tbl=mysqli_num_rows($sql1)>0)
	{
		$slups=0; $slqty=0; $sstage="";$got="";
		while($row_tbl_sub=mysqli_fetch_array($sql1))
		{
		$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
		$slups=$slups+$row_tbl_sub['lotldg_balnob'];
		$sstage=$row_tbl_sub['lotldg_sstage'];
		$got=$row_tbl_sub['lotldg_got1'];
		}
	}
	else
	{
	
		$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where orlot='".$row_arr_home['gottest_oldlot']."'") or die(mysqli_error($link));  
		$row_tbl1=mysqli_fetch_array($sql_tbl1);
		
		$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0")or die(mysqli_error($link));
		
		$total_tbl=mysqli_num_rows($sql1);
		$slups=0; $slqty=0; $sstage="";$got="";
		while($row_tbl_sub=mysqli_fetch_array($sql1))
		{
		$slqty=$slqty+$row_tbl_sub['balqty'];
		$slups=$slups+0;
		$sstage=$row_tbl_sub['lotldg_sstage'];
		$got=$row_tbl_sub['lotldg_got1'];
		}
	}
	//echo $slups;
	$aq=explode(".",$slqty);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
	
	$an=explode(".",$slups);
	if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage="";  $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
	
	if($lotno!="")
	{
		$lotno=$lotno."<br>".$row_arr_home['gottest_oldlot'];
	}
	else
	{
		$lotno=$row_arr_home['gottest_oldlot'];
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
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['gottest_variety']."'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$tot_var=mysqli_num_rows($quer4);
	if($tot_var > 0)
	{	
		$variety=$row_dept4['popularname'];
	}
	else 
	{
		$variety=$row_arr_home['gottest_variety'];
	} 
	
	$arrdate=''; $flg=0; $trplntdt=''; $pper=''; $org=''; $farmer=''; $ploc='';
	$qry23="select * from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."'";
	$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
	if($tot_arr_home23=mysqli_num_rows($sql_arr_home23)>0)
	{
		$row_arr_home23=mysqli_fetch_array($sql_arr_home23);
		
		$qry223="select arrival_date from tblarrival where arrival_id='".$row_arr_home23['arrival_id']."' and arrival_date>='$sdate' and arrival_date<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['arrival_date'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
			
			$ploc=$row_arr_home23['ploc'];
			$org=$row_arr_home23['organiser'];
			$farmer=$row_arr_home23['farmer'];
			$pper=$row_arr_home23['pper'];
		}
	}
	if($flg==0)
	{
		$qry223="select salesrs_dovfy from tbl_salesrv_sub where salesrs_orlot='".$row_arr_home['gottest_oldlot']."' and salesrs_dovfy>='$sdate' and salesrs_dovfy<='$edate'";
		$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
		if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
		{
			$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
			$flg++;
			$trdate=$row_arr_home223['salesrs_dovfy'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$arrdate=$trday."-".$trmonth."-".$tryear;
		}
	}
	
	$quer32=mysqli_query($link,"SELECT * FROM tblspcodes where variety ='".$row_arr_home['gottest_variety']."' "); 
	$rowvv2=mysqli_fetch_array($quer32);
	if(mysqli_num_rows($quer32)>0)
	$spcodes=$rowvv2['spcodef']." x ".$rowvv2['spcodem'];
	
	$stage=$row_arr_home['gottest_trstage'];
		//echo $row_arr_home['gottest_oldlot']."  -=-  ".$arrival_id."  -=-  ".$flg."<br/>";
if($flg>0)
{		
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $arrdate?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
	<td width="176" align="center" valign="middle" class="tblheading"><?php echo $spcodes?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="95" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $org;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $pper;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $gotstatus;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="opendata(<?php echo $arrival_id;?>)">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $arrdate?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
	<td width="176" align="center" valign="middle" class="tblheading"><?php echo $spcodes?></td>
	<td width="123" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
	<td width="95" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $org;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $pper;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $gotstatus;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0);" onclick="opendata(<?php echo $arrival_id;?>)">View</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
?>
</table>			
<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_gotdatainsitu.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint('<?php echo $srno;?>')" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td ></td>
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
