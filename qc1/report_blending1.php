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
	
		
		$crop = $_REQUEST['txtcrop'];
		$variety1 = $_REQUEST['txtvariety'];
		$sdate = $_REQUEST['sdate'];
	 	$edate = $_REQUEST['edate'];
		$txtvertype=$_REQUEST['txtvertype'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager - Report - Periodical Blending Report</title>
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var pmc=document.frmaddDepartment.txtvertype.value;
winHandle=window.open('report_blending2.php?sdate='+sdate+'&txtcrop='+itemid+'&txtvariety='+vv+'&edate='+edate+'&txtvertype='+pmc,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
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
   <?php
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
		$crop = $_REQUEST['txtcrop'];
		$variety1 = $_REQUEST['txtvariety'];
		$txtvertype=$_REQUEST['txtvertype'];
		
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
		
	$crp="ALL"; $ver="ALL"; 
	//$qry="select varietyid, popularname from tblvariety where proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' ";
	
	$qry="select varietyid from tblvariety where varietyid!='0' ";
	
	if($crop!="ALL")
	{
		$qry.=" and cropname='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety1!="ALL")
	{	
		$qry.="and varietyid='$variety1' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety1."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtvertype!="ALL")
	{	
		$qry.="and vt='$txtvertype' ";
	}
	
	$qry.=" order by cropid, popularname Asc";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">&nbsp;Periodical Blending Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety1?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="txtvertype" value="<?php echo $txtvertype;?>" type="hidden">  
		 <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
  	<tr class="Dark" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr class="Dark" height="25" >
	<td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crp;?></td>
    <td align="center" class="subheading" style="color:#303918; ">Variety Type: <?php echo $txtvertype;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<!--<td width="70" align="center" valign="middle" class="smalltblheading">#</td>-->
	<td width="115"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td align="center" valign="middle" class="smalltblheading">Variety</td>
	<td align="center" valign="middle" class="smalltblheading">Blending Date</td>
	<td  align="center" valign="middle" class="smalltblheading">Blended Lot No.</td>
	<td align="center" valign="middle" class="smalltblheading">Qty</td>
	<td align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td align="center" valign="middle" class="smalltblheading">Constituent Lot No.</td>
	<td align="center" valign="middle" class="smalltblheading">Qty</td>
	<td align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="40"  align="center" valign="middle" class="smalltblheading">QC</td>
	<td align="center" valign="middle" class="smalltblheading">DoT</td>
	<td align="center" valign="middle" class="smalltblheading">Germ.%</td>
	<td width="95"  align="center" valign="middle" class="smalltblheading">GOT</td>
	<td align="center" valign="middle" class="smalltblheading">DoGR</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['varietyid']."'") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		$cropname=$rowvv['cropid'];
	}
	
$sql_rr=mysqli_query($link,"SELECT * FROM tbl_blendm WHERE blendm_variety='".$row_arr_home1['varietyid']."' and `blendm_date`<='$edate' and `blendm_date`>='$sdate' and blendm_bflg=1  order by blendm_id asc") or die(mysqli_error($link));
if($tot_rr=mysqli_num_rows($sql_rr)>0)
{
	while($row_rr=mysqli_fetch_array($sql_rr))
	{
		$rdate=$row_rr['blendm_date'];
		$ryear=substr($rdate,0,4);
		$rmonth=substr($rdate,5,2);
		$rday=substr($rdate,8,2);
		$blendingdate=$rday."-".$rmonth."-".$ryear;
				
		$sqlmonth2=mysqli_query($link,"SELECT distinct blends_newlot FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_delflg=0")or die("Error:".mysqli_error($link));
		$t2=mysqli_num_rows($sqlmonth2);
		while($rowmonth2=mysqli_fetch_array($sqlmonth2))
		{
			$lotno=""; $cqty=""; $mainsloc=""; $mwareh=""; $mbinn=""; $msubbinn="";
			$sqlmonth1=mysqli_query($link,"SELECT * FROM tbl_blendss WHERE blendm_id='".$row_rr['blendm_id']."' and blendss_newlot='".$rowmonth2['blends_newlot']."'")or die("Error:".mysqli_error($link));
			$t1=mysqli_num_rows($sqlmonth1);
			$rowmonth1=mysqli_fetch_array($sqlmonth1);
		
			$lotno=$rowmonth2['blends_newlot'];
			
			$sql_whousem=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$rowmonth1['blendss_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whousem=mysqli_fetch_array($sql_whousem);
			$mwareh=$row_whousem['perticulars']."/";
			
			$sql_binnm=mysqli_query($link,"select binname from tbl_bin where binid='".$rowmonth1['blendss_binid']."' and whid='".$rowmonth1['blendss_whid']."'") or die(mysqli_error($link));
			$row_binnm=mysqli_fetch_array($sql_binnm);
			$mbinn=$row_binnm['binname']."/";
			
			$sql_subbinnm=mysqli_query($link,"select sname from tbl_subbin where sid='".$rowmonth1['blendss_subbinid']."' and binid='".$rowmonth1['blendss_binid']."' and whid='".$rowmonth1['blendss_whid']."'") or die(mysqli_error($link));
			$row_subbinnm=mysqli_fetch_array($sql_subbinnm);
			$msubbinn=$row_subbinnm['sname'];
		
			$mainsloc=$mwareh.$mbinn.$msubbinn;
						
	
			$an2=explode(".",$rowmonth1['blendss_qty']);
			if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$rowmonth1['blendss_qty'];}
			$ctlotno=""; $rmqty1=""; $qcresult=''; $gotresult=''; $dogr=''; $dot=''; $slocs=""; $gemp="";
			$sqlmonth3=mysqli_query($link,"SELECT * FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_newlot='".$rowmonth2['blends_newlot']."' and blends_delflg=0")or die("Error:".mysqli_error($link));
			$t3=mysqli_num_rows($sqlmonth3);
			while($rowmonth3=mysqli_fetch_array($sqlmonth3))
			{
				if($ctlotno!="")
				$ctlotno=$ctlotno."<br />".$rowmonth3['blends_lotno'];
				else
				$ctlotno=$rowmonth3['blends_lotno'];
				$aq3=explode(".",$rowmonth3['blends_qty']);
				if($aq3[1]==000){$rmqty=$aq3[0];}else{$rmqty=$rowmonth3['blends_qty'];}
				if($rmqty1!="")
				$rmqty1=$rmqty1."<br />".$rmqty;
				else
				$rmqty1=$rmqty;
				
				if($qcresult!="")
				$qcresult=$qcresult."<br />".$rowmonth3['blends_qc'];
				else
				$qcresult=$rowmonth3['blends_qc'];
				
				if($gotresult!="")
				$gotresult=$gotresult."<br />".$rowmonth3['blends_got'];
				else
				$gotresult=$rowmonth3['blends_got'];
				
				$dogr2=''; $dot2=''; $slocs2="";
				
				$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$rowmonth3['blends_lotno']."' and lotldg_trtype='Blending' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_lotno='".$rowmonth3['blends_lotno']."' and lotldg_trtype='Blending' order by lotldg_id desc ") or die(mysqli_error($link));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($link,"select lotldg_trqty, lotldg_trbags, lotldg_got1, lotldg_got, lotldg_gemp, lotldg_gottestdate, lotldg_qc, lotldg_qctestdate, lotldg_whid, lotldg_binid, lotldg_subbinid from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_istbl))
						{ 
							$slups=0; $slqty=0; $gemp2='';
							$gemp2=$row_issuetbl['lotldg_gemp'];
							
							$trdate1=$row_issuetbl['lotldg_gottestdate'];
							$tryear1=substr($trdate1,0,4);
							$trmonth1=substr($trdate1,5,2);
							$trday1=substr($trdate1,8,2);
							$trdate1=$trday1."-".$trmonth1."-".$tryear1;
							if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="--";
								$dogr2=$trdate1;
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$dot2=$trday."-".$trmonth."-".$tryear;
							if($dot2=="00-00-0000" || $dot2=="--")$dot2="--";
							
							
							
							$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
							$row_whouse=mysqli_fetch_array($sql_whouse);
							$wareh=$row_whouse['perticulars']."/";
							
							$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_binn=mysqli_fetch_array($sql_binn);
							$binn=$row_binn['binname']."/";
							
							$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_subbinn=mysqli_fetch_array($sql_subbinn);
							$subbinn=$row_subbinn['sname'];
						
							$slups=$row_issuetbl['lotldg_trbags'];
							$slqty=$row_issuetbl['lotldg_trqty'];
							$aq1=explode(".",$slups);
							if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
						
							$an1=explode(".",$slqty);
							if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
							$slups=$ac1;
							$slqty=$acn1;
							if($slqty>0)
							{
							if($slocs2!="")
								$slocs2=$slocs2.",".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
							else
								$slocs2=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
							}
							if($slocs!="")
							$slocs=$slocs."<br />".$slocs2;
							else
							$slocs=$slocs2;
						}
					}
				}
				if($dot!="")
				$dot=$dot."<br />".$dot2;
				else
				$dot=$dot2;
				
				if($dogr!="")
				$dogr=$dogr."<br />".$dogr2;
				else
				$dogr=$dogr2;
				
				if($gemp!="")
				$gemp=$gemp."<br />".$gemp2;
				else
				$gemp=$gemp2;
			}

if($srno%2!=0)
{
?>			  
<tr class="Light">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendingdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mainsloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ctlotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<!--<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendingdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mainsloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ctlotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rmqty1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr;?></td>
</tr>

<?php
}
$srno=$srno+1;
//}
}
}
}
}
}
?>
</table>		  		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td  align="center" valign="middle"><a href="report_blending.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />&nbsp;<a href="excel-blending.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtvertype=<?php echo $_REQUEST['txtvertype'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;</td>
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
