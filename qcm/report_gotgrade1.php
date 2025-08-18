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
<title>Quality-Report - GOT Final Grade Report</title>
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
	      <td width="813" height="25">&nbsp;GOT Final Grade Report</td>
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
		
$sql="select * from tbl_gotgrade where gotgrade_tflg=1 and gotgrade_date>='".$sdate."' and gotgrade_date<='".$edate."' ";
$sql.=" order by gotgrade_date, gotgrade_id asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);	
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  	<tr height="25">
	<td align="left" class="subheading" style="color:#303918;" width="50%">&nbsp;&nbsp;Period From: <?php echo $_REQUEST['sdate'];?></td>
	 <td align="right" class="subheading" style="color:#303918;">To: <?php echo $_REQUEST['edate'];?>&nbsp;&nbsp;</td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="2%"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="13%" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Hybrid Code</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Lot Number</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Arrival Date</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Result Date</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">No of Amp. Samples</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Off Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Off Type %</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Female Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Female Type $</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Male Type</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Male Type %</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Impurities %</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">GP %</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">BTS Remarks</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">BTS Grade</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Prod. Grade</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Final GOT Grade</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['gotgrade_btsresultdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$btsremark='';
	$qry_btsgerm=mysqli_query($link,"select * from tbl_btssdldispm_sub where btssdldispms_lotno='".$row_arr_home['gotgrade_lotno']."'") or die(mysqli_error($link));
	$row_btsgerm=mysqli_fetch_array($qry_btsgerm);		
	$hybcode=$row_btsgerm['btssdldispms_hybrid'];
	
	$qry_tbl_makerselection=mysqli_query($link,"select * from tbl_makerselection where makersel_farmerid='".trim($row_btsgerm['btssdldispms_farmerid'])."'") or die(mysqli_error($link));
	$tot_tbl_makerselection=mysqli_num_rows($qry_tbl_makerselection);	
	$row_tbl_makerselection=mysqli_fetch_array($qry_tbl_makerselection);	
	
	$qry_tbl_makerselection_sub=mysqli_query($link,"select * from tbl_makerselection_sub where makersel_id='".$row_tbl_makerselection['makersel_id']."'") or die(mysqli_error($link));
	$tot_tbl_makerselection_sub=mysqli_num_rows($qry_tbl_makerselection_sub);	
	$row_tbl_makerselection_sub=mysqli_fetch_array($qry_tbl_makerselection_sub);	
	
	$btsremark=$row_tbl_makerselection_sub['makersels_remark'];
	if($row_btsgerm['btssdldispms_terremark']!='') { $btsremark=$row_btsgerm['btssdldispms_terremark'];}
	
	
	$lott=str_split($row_arr_home['gotgrade_lotno']);
	$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
	$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$orlot."'  group by lotldg_subbinid, lotldg_variety, orlot order by lotldg_subbinid") or die(mysql_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl22=mysqli_fetch_array($sql_tbl_sub1))
	{
		$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl22['lotldg_subbinid']."' and orlot='".$orlot."' ") or die(mysql_error($link));  
		$row_tbl1=mysqli_fetch_array($sql_tbl1);
		$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysql_error($link));
		$total_tbl=mysqli_num_rows($sql1);
		while($row_tbl=mysqli_fetch_array($sql1))
		{	
			$ac=$row_tbl['lotldg_balbags'];
			$an=explode(".",$row_tbl['lotldg_balqty']);
			if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
			$bags=$bags+$ac;
			$qty=$qty+$acn;
		}
	}
	
	$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where old='".$oldlt."'") or die(mysqli_error($link));
	$row_arrsub=mysqli_fetch_array($sql_arrsub);
	
/*	$spcf=$row_arrsub['spcodef'];
	$spcm=$row_arrsub['spcodem'];
	
	
	$hardate=$row_arrsub['harvestdate'];
	$hardtyear=substr($hardate,0,4);
	$hardtmonth=substr($hardate,5,2);
	$hardtday=substr($hardate,8,2);
	$harvestdate=$hardtday."-".$hardtmonth."-".$hardtyear;
	if($harvestdate=="0000-00-00"){$harvestdate='';}
*/	
	$sql_arrmain=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_arrsub['arrival_id']."'") or die(mysqli_error($link));
	$row_arrmain=mysqli_fetch_array($sql_arrmain);
	
	$arrdate=$row_arrmain['arrival_date'];
	$arrdtyear=substr($arrdate,0,4);
	$arrdtmonth=substr($arrdate,5,2);
	$arrdtday=substr($arrdate,8,2);
	$arrivaldate=$arrdtday."-".$arrdtmonth."-".$arrdtyear;
	if($arrivaldate=="0000-00-00"){$arrivaldate='';}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="12%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_crop'];?></td>
	<td width="13%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_variety'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $hybcode;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_lotno'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $arrivaldate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_noampsamples'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_impurper'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_gpper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsremark;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_grade'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_prodgrade'];?></a></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_finalgrade'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="12%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_crop'];?></td>
	<td width="13%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_variety'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $hybcode;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_lotno'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $arrivaldate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_noampsamples'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_offtypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_femaletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletype'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_maletypeper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_impurper'];?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_gpper'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $btsremark;?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_grade'];?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_prodgrade'];?></a></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['gotgrade_finalgrade'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>			
<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_gotgrade.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<img src="../images/printpreview.gif" onclick="openprint('<?php echo $srno;?>')" style="cursor:pointer" border="0" />-->
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
