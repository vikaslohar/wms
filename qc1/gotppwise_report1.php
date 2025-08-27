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
		
	if(isset($_REQUEST['sdate']))
	{
		$sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
		$edate = $_REQUEST['edate'];
	}
	if(isset($_REQUEST['txtprodp']))
	{
		$txtprodp = $_REQUEST['txtprodp'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality GOT- Report - Production Person Wise GOT Status Report</title>
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

function openprint()
{

var sdate=document.frmaddDepartment.sdate.value; 
var edate=document.frmaddDepartment.edate.value; 
var txtprodp=document.frmaddDepartment.txtprodp.value;
/*var itemid=document.frmaddDepartment.txtvariety.value;
var result=document.frmaddDepartment.result.value;*/
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('gotppwise_report2.php?sdate='+sdate+'&edate='+edate+'&txtprodp='+txtprodp,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="30">&nbsp;Production Person Wise GOT Status Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
<?php 
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$txtprodp = $_REQUEST['txtprodp'];
?>	  
	  
	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	<input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden">
	<input name="txtprodp" value="<?php echo $_REQUEST['txtprodp'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php	
	$t=explode("-",$sdate);
	$z=sprintf("%02d",$t[0]);
	$sdate=$z."-".$t[1]."-".$t[2];

	$t=explode("-",$edate);
	$z=sprintf("%02d",$t[0]);
	$edate=$z."-".$t[1]."-".$t[2];
	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;
	
	$edate=$edate;
	$tday=substr($edate,0,2);
	$tmonth=substr($edate,3,2);
	$tyear=substr($edate,6,4);
	$edate=$tyear."-".$tmonth."-".$tday;
	
	
$sql="select distinct gottest_sampleno from tbl_gottest where gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Production Person Wise GOT Status Report</td>
  	</tr>
	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Arrival Pariod From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
	</table>
<?php
if($tot_arr_home > 0)
{
?>
<table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="17" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="61"  align="center" valign="middle" class="smalltblheading">Date of Arrival</td>
	<td width="64"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="29"  align="center" valign="middle" class="smalltblheading">SP Code</td>
	<td width="118"  align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="85"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="41"  align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="40"  align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="65"  align="center" valign="middle" class="smalltblheading">Production Location</td>
	<td width="78"  align="center" valign="middle" class="smalltblheading">Organiser</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Farmer</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Production Personnel</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">GOT Status</td>
    <td width="70" align="center" valign="middle" class="smalltblheading">DoGT</td>
	<td width="30" align="center" valign="middle" class="smalltblheading">GP %</td>
</tr>
<?php
$srno=1;
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
	$sql2="select MAX(gottest_tid) from tbl_gottest where gottest_sampleno='".$row_arr_home2['gottest_sampleno']."'   ";
	$sql2.=" and gottest_gotflg=1 order by gottest_tid desc ";
	//echo $sql2;
	$sql_arr_home2=mysqli_query($link,$sql2) or die(mysqli_error($link));
	$tot_max2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home3=mysqli_fetch_array($sql_arr_home2))
	{
	
	$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
	$tot_max=mysqli_num_rows($sql_max);
	while($row_arr_home=mysqli_fetch_array($sql_max))
	{
		$trdate=$row_arr_home['gottest_gotdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;
			
		$genpurity=$row_arr_home['genpurity'];
		$arrival_id=$row_arr_home['gottest_tid'];
		$crop=""; $variety=""; $lotno=""; $spcodes=""; $qty=""; $nob=''; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
		
		$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['gottest_lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
		$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
		if($T=mysqli_num_rows($sql_tbl_sub1)>0)
		{
		
			$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
			$row_tbl1=mysqli_fetch_array($sql_tbl1);
		
			$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));
		
			$total_tbl=mysqli_num_rows($sql1);
			$slups=0; $slqty=0; $sstage="";
			while($row_tbl_sub=mysqli_fetch_array($sql1))
			{
				$slups=$slups+$row_tbl_sub['lotldg_balbags'];
				$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
				$sstage=$row_tbl_sub['lotldg_sstage'];
				$got=$row_tbl_sub['lotldg_got1'];
			}
		}
		else
		{
			/*$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid, variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['gottest_lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
			$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
			if($T=mysqli_num_rows($sql_tbl_sub1)>0)
			{
			
				$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
			
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));
			
				$total_tbl=mysqli_num_rows($sql1);
				$slups=0; $slqty=0; $sstage="";
				while($row_tbl_sub=mysqli_fetch_array($sql1))
				{
					$slups=$slups+$row_tbl_sub['lotldg_balbags'];
					$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
					$sstage=$row_tbl_sub['lotldg_sstage'];
					$got=$row_tbl_sub['lotldg_got1'];
				}
			}*/
		}
		$got1=explode(" ",$got);
		$got2=$got1[0];
		//echo $slups;
		$aq=explode(".",$slqty);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
	
		$an=explode(".",$slups);
		if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
		
		
		if($qcresult!="")
		{
			$qcresult=$qcresult."<br>".$got2." ".$row_arr_home['gottest_gotstatus'];
			// $row_tbl_sub['lotcrop'];
		}
		else
		{
			$qcresult=$got2." ".$row_arr_home['gottest_gotstatus'];
		}
		
		if($crop!="")
		{
			$crop=$crop."<br>".$row_arr_home['gottest_crop'];
			// $row_tbl_sub['lotcrop'];
		}
		else
		{
			$crop=$row_arr_home['gottest_crop'];
		}
		if($variety!="")
		{
			$variety=$variety."<br>".$row_arr_home['gottest_variety'];
		}
		else
		{
			$variety=$row_arr_home['gottest_variety'];	
		}
		if($lotno!="")
		{
			$lotno=$lotno."<br>".$row_arr_home['gottest_oldlot'];
		}
		else
		{
			$lotno=$row_arr_home['gottest_oldlot'];
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}
		if($nob!="")
		{
			$nob=$nob."<br>".$acn;
		}
		else
		{
			$nob=$acn;
		}
		$arrdate='';	$flg=0; $pper=''; $prodloc=''; $farmer=''; $organiser='';
		if($txtprodp!='ALL')
		$qry23="select * from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."' and pper='$txtprodp'";
		else
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
				
				$pper=$row_arr_home23['pper'];
				$prodloc=$row_arr_home23['ploc'];
				$farmer=$row_arr_home23['farmer'];
				$organiser=$row_arr_home23['organiser'];
			}
		}
		/*if($flg==0)
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
		}*/
		
		
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' "); 
		$rowvv=mysqli_fetch_array($quer3);
		
	    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
		$row31=mysqli_fetch_array($quer3);
		
		$quer32=mysqli_query($link,"SELECT * FROM tblspcodes where variety ='".$row_arr_home['gottest_variety']."' "); 
		$rowvv2=mysqli_fetch_array($quer32);
		if(mysqli_num_rows($quer32)>0)
		$spcodes=$rowvv2['spcodef']." x ".$rowvv2['spcodem'];
if($flg>0)
{
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrdate;?></td>
	<td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname']?></td>
	<td width="29" align="center" valign="middle" class="smalltbltext"><?php echo $spcodes?></td>
	<td width="118" align="center" valign="middle" class="smalltbltext"><?php echo $rowvv['popularname']?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $nob?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="65" align="center" valign="middle" class="smalltbltext"><?php echo $prodloc?></td>
	<td width="78" align="center" valign="middle" class="smalltbltext"><?php echo $organiser?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $farmer?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $pper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpurity;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrdate;?></td>
	<td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname']?></td>
	<td width="29" align="center" valign="middle" class="smalltbltext"><?php echo $spcodes?></td>
	<td width="118" align="center" valign="middle" class="smalltbltext"><?php echo $rowvv['popularname']?></td>
	<td width="85" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $nob?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="65" align="center" valign="middle" class="smalltbltext"><?php echo $prodloc?></td>
	<td width="78" align="center" valign="middle" class="smalltbltext"><?php echo $organiser?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $farmer?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $pper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpurity;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
</table>
<?php
}
?>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr>
<td height="49" align="center" valign="top"><a href="gotppwise_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
