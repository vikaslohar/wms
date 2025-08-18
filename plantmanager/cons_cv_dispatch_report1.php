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
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtupsdc = $_REQUEST['txtupsdc'];
		
	/*$txtstate = $_REQUEST['txtstate'];
	$txtloc = $_REQUEST['txtloc'];
	$txtparty = $_REQUEST['txtparty'];
	$txtlotno = $_REQUEST['txtlotno'];
	$txtdisptype = $_REQUEST['txtdisptype'];
		
	if($txtstate=="")$txtstate="ALL";
	if($txtloc=="")$txtloc="ALL";
	if($txtparty=="")$txtparty="ALL";
	if($crop=="")$crop="ALL";
	if($variety=="")$variety="ALL";
	if($lotno=="")$lotno="ALL";
	if($txtupsdc=="")$txtupsdc="ALL";
	if($txtdisptype=="")$txtdisptype="ALL";
	*/
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Report - Consolidated Crop Variety Wise Dispatch Report</title>
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

/*function openslocpopprint(tid)
{
	winHandle=window.open('p2c_note.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
function openslocpopprint1(val1)
{

	winHandle=window.open('gatepass.php?itmid='+val1,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocpopprint(subid)
{
	winHandle=window.open('select_disppack_op.php?p_id='+subid,'WelCome','top=20, left=50, width=950, height=950, scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//}
}*/
/*function openpackdetails(tid)
{
	winHandle=window.open('packdetails_home.php?itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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

function openprint()
{
	var sdate=document.frmaddDept.sdate.value;
	var edate=document.frmaddDept.edate.value;
	var txtcrop=document.frmaddDept.txtcrop.value;
	var txtvariety=document.frmaddDept.txtvariety.value;
	var txtupsdc=document.frmaddDept.txtupsdc.value;
	winHandle=window.open('cons_cv_dispatch_report2.php?sdate='+sdate+'&edate='+edate+'&txtcrop='+txtcrop+'&txtvariety='+txtvariety+'&txtupsdc='+txtupsdc,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}	

function mySubmit()
{	
	return false;
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top">
	<table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_plantm.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
 <!-- actual page start--->		  
	<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="30"class="Mainheading" >&nbsp;Consolidated Crop Variety Wise Dispatch Report</td>
	    </tr></table>
		</td>
	  </tr>
	  </table></td></tr>
    	  	<tr>  <td align="center" colspan="4" >
	 <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="sdate" value="<?php echo $_REQUEST['sdate']; ?>" type="hidden"> 
	 <input name="edate" value="<?php echo $_REQUEST['edate']; ?>" type="hidden"> 
	 <input name="txtcrop" value="<?php echo $_REQUEST['txtcrop']; ?>" type="hidden"> 
	 <input name="txtvariety" value="<?php echo $_REQUEST['txtvariety']; ?>" type="hidden"> 
	 <input name="txtupsdc" value="<?php echo $_REQUEST['txtupsdc']; ?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="10">	 </td>
<td>
  <?php
  
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtupsdc = $_REQUEST['txtupsdc'];
  
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$crp="ALL"; $ver="ALL"; $locname="ALL"; $partyname="ALL"; $totnqty=0; $totnomp=0;
	
	
	$nqry="select Distinct disp_dodc from tbl_disp where disp_dodc>='$sdt' and disp_dodc<='$edt' AND plantcode='$plantcode' order by disp_dodc asc";
	$nqry2="select Distinct dbulk_date from tbl_dbulk where dbulk_date>='$sdt' and dbulk_date<='$edt' AND plantcode='$plantcode' order by dbulk_date asc";
	$nqry3="select Distinct pswrem_date from tbl_pswrem where pswrem_date>='$sdt' and pswrem_date<='$edt' AND plantcode='$plantcode' order by pswrem_date asc";
	$nqry4="select Distinct dtdf_date from tbl_dtdf where dtdf_date>='$sdt' and dtdf_date<='$edt' AND plantcode='$plantcode' order by dtdf_date asc";
	//$qry5="select Distinct stoutmp_date from tbl_stoutmpack where stoutmp_date>='$sdt' and stoutmp_date<='$edt' order by stoutmp_date asc";

	$sql_narr_home1=mysqli_query($link,$nqry) or die(mysqli_error($link));
	$sql_narr_home2=mysqli_query($link,$nqry2) or die(mysqli_error($link));
	$sql_narr_home3=mysqli_query($link,$nqry3) or die(mysqli_error($link));
	$sql_narr_home4=mysqli_query($link,$nqry4) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$ndt="";
	while($row_narr_home12=mysqli_fetch_array($sql_narr_home1))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home12['disp_dodc']; else $ndt=$row_narr_home12['disp_dodc'];
	}
	while($row_narr_home22=mysqli_fetch_array($sql_narr_home2))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home22['dbulk_date']; else $ndt=$row_narr_home22['dbulk_date'];
	}
	while($row_narr_home23=mysqli_fetch_array($sql_narr_home3))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home23['pswrem_date']; else $ndt=$row_narr_home23['pswrem_date'];
	}
	while($row_narr_home24=mysqli_fetch_array($sql_narr_home4))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home24['dtdf_date']; else $ndt=$row_narr_home24['dtdf_date'];
	}
	
	$ndt1=explode(",",$ndt);
	$ndt1=array_unique($ndt1);
	sort($ndt1);
	$ndt=$ndt1;
	
	
	
	
	$qry="select Distinct disp_id from tbl_disp where disp_dodc>='$sdt' and disp_dodc<='$edt' AND plantcode='$plantcode' order by disp_dodc asc";
	$qry2="select Distinct dbulk_id from tbl_dbulk where dbulk_date>='$sdt' and dbulk_date<='$edt' AND plantcode='$plantcode' order by dbulk_date asc";
	$qry3="select Distinct pswrem_id from tbl_pswrem where pswrem_date>='$sdt' and pswrem_date<='$edt' AND plantcode='$plantcode' order by pswrem_date asc";
	$qry4="select Distinct dtdf_id from tbl_dtdf where dtdf_date>='$sdt' and dtdf_date<='$edt' AND plantcode='$plantcode' order by dtdf_date asc";
	//$qry5="select Distinct stoutmp_id from tbl_stoutmpack where stoutmp_date>='$sdt' and stoutmp_date<='$edt' order by stoutmp_date asc";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home4=mysqli_query($link,$qry4) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$id1="";$id2="";$id3="";$id4="";//$id5="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		if($id1!="") $id1=$id1.",".$row_arr_home12['disp_id']; else $id1=$row_arr_home12['disp_id'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		if($id2!="") $id2=$id2.",".$row_arr_home22['dbulk_id']; else $id2=$row_arr_home22['dbulk_id'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		if($id3!="") $id3=$id3.",".$row_arr_home23['pswrem_id']; else $id3=$row_arr_home23['pswrem_id'];
	}
	
	while($row_arr_home24=mysqli_fetch_array($sql_arr_home4))
	{
		if($id4!="") $id4=$id4.",".$row_arr_home24['dtdf_id']; else $id4=$row_arr_home24['dtdf_id'];
	}
	
	/*while($row_arr_home25=mysqli_fetch_array($sql_arr_home5))
	{
		if($id5!="") $id5=$id5.",".$row_arr_home25['tid']; else $row_arr_home25=$row312['tid'];
	}*/
	
	$id11=explode(",",$id1);
	$id11=array_unique($id11);
	sort($id11);
	$id11=implode(",",$id11);
	
	$id21=explode(",",$id2);
	$id21=array_unique($id21);
	sort($id21);
	$id21=implode(",",$id21);
	
	$id31=explode(",",$id3);
	$id31=array_unique($id31);
	sort($id31);
	$id31=implode(",",$id31);
	
	$id41=explode(",",$id4);
	$id41=array_unique($id41);
	sort($id41);
	$id41=implode(",",$id41);
	
	/*$id51=explode(",",$id5);
	$id51=array_unique($id51);
	sort($id51);
	$id51=implode(",",$id51);*/
	
	if($id11!="")
		$qry="select Distinct disps_crop from tbl_disp_sub where disp_id IN ($id11) AND plantcode='$plantcode'";
	else
		$qry="select Distinct disps_crop from tbl_disp_sub where disp_id!=0 AND plantcode='$plantcode'";
	if($id21!="")
		$qry2="select Distinct dbulks_crop from tbl_dbulk_sub where dbulk_id IN ($id21) AND plantcode='$plantcode'";
	else
		$qry2="select Distinct dbulks_crop from tbl_dbulk_sub where dbulk_id!=0 AND plantcode='$plantcode'";
	if($id31!="")
		$qry3="select Distinct crop from tbl_pswrem_sub where pswrem_id IN ($id31) AND plantcode='$plantcode'";
	else
		$qry3="select Distinct crop from tbl_pswrem_sub where pswrem_id!=0 AND plantcode='$plantcode'";
	if($id41!="")
		$qry4="select Distinct dtdfs_crop from tbl_dtdf_sub where dtdf_id IN($id41) AND plantcode='$plantcode'";
	else
		$qry4="select Distinct dtdfs_crop from tbl_dtdf_sub where dtdf_id!=0 AND plantcode='$plantcode'";
	/*if($id51!="")
		$qry5="select Distinct crop from tbl_discard_sub where tid IN($id51) ";
	else
		$qry5="select Distinct crop from tbl_discard_sub where did!=0 ";*/
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.=" and disps_crop='$crp' ";
		$qry2.=" and dbulks_crop='$crp' ";
		$qry3.=" and crop='$crop' ";
		$qry4.=" and dtdfs_crop='$crp' ";
		//$qry5.=" and crop='$crop' ";
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
		$qry2.=" and dbulks_variety='$ver' ";
		$qry3.=" and variety='$variety' ";
		$qry4.=" and dtdfs_variety='$ver' ";
		//$qry5.=" and variety='$variety' ";
	}
	
	$qry.=" group by disps_crop";
	$qry2.=" group by dbulks_crop";
	$qry3.=" group by crop";
	$qry4.=" group by dtdfs_crop";
	//$qry5.=" group by crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home4=mysqli_query($link,$qry4) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home12['disps_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home22['dbulks_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home23['crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	while($row_arr_home24=mysqli_fetch_array($sql_arr_home4))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home24['dtdfs_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	/*while($row_arr_home25=mysqli_fetch_array($sql_arr_home5))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home25['crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}*/
	
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp);
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
				$crop2=$crop2.",".$row312['cropid'];
			else
				$crop2=$row312['cropid'];
		}
	}
//echo $txtdisptype;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;From Date: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;To Date: <?php echo $edate;?></td>
</tr>
<tr>
<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $ver;?>&nbsp;&nbsp;|&nbsp;&nbsp;Size: <?php echo $txtupsdc;?></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="18" align="center" valign="middle" class="smalltblheading">#</td>	  
	<td width="67" align="center" valign="middle" class="smalltblheading">Dispatch Date</td>
	<td width="85" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="82" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="82" align="center" valign="middle" class="smalltblheading">Prod. Variety</td>
	<td width="82" align="center" valign="middle" class="smalltblheading">Variety Type</td>
	<td width="80" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="65" align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php
$srno=1; $cnt=0;
foreach($ndt as $ndts)
{
if($ndts<>"")
{


$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$stage="Raw";
	$stage1="Condition";
	$stage2="Pack";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	
	
	if($id11!="")
		$qry="select Distinct disps_variety from tbl_disp_sub where disps_crop='".$crop1."' and disp_id IN ($id11) AND plantcode='$plantcode'";
	else
		$qry="select Distinct disps_variety from tbl_disp_sub where disps_crop='".$crop1."' AND plantcode='$plantcode'";
	if($id21!="")
		$qry2="select Distinct dbulks_variety from tbl_dbulk_sub where dbulks_crop='".$crop1."' and dbulk_id IN ($id21) AND plantcode='$plantcode'";
	else
		$qry2="select Distinct dbulks_variety from tbl_dbulk_sub where dbulks_crop='".$crop1."' AND plantcode='$plantcode'";
	if($id31!="")
		$qry3="select Distinct variety from tbl_pswrem_sub where crop='".$crval."' and pswrem_id IN ($id31) AND plantcode='$plantcode'";
	else
		$qry3="select Distinct variety from tbl_pswrem_sub where crop='".$crval."' AND plantcode='$plantcode' ";
	if($id41!="")
		$qry4="select Distinct dtdfs_variety from tbl_dtdf_sub where dtdfs_crop='".$crop1."' and dtdf_id IN ($id41) AND plantcode='$plantcode'";
	else
		$qry4="select Distinct dtdfs_variety from tbl_dtdf_sub where dtdfs_crop='".$crop1."' AND plantcode='$plantcode' ";
	/*if($id51!="")
		$qry5="select Distinct variety from tbl_discard_sub where crop='".$crval."' and  tid IN ($id51) ";
	else
		$qry5="select Distinct variety from tbl_discard_sub where crop='".$crval."' ";*/
	
	
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
		$qry2.=" and dbulks_variety='$ver' ";
		$qry3.=" and variety='$variety' ";
		$qry4.=" and dtdfs_variety='$ver' ";
	//	$qry5.=" and variety='$variety' ";
	}
	
	$qry.=" group by disps_variety";
	$qry2.=" group by dbulks_variety";
	$qry3.=" group by variety";
	$qry4.=" group by dtdfs_variety";
	//$qry5.=" group by variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home23=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home24=mysqli_query($link,$qry4) or die(mysqli_error($link));
//	$sql_arr_home25=mysqli_query($link,$qry5) or die(mysqli_error($link));
//echo $tret=mysqli_num_rows($sql_arr_home12);
	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home12['disps_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home22['dbulks_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home24['dtdfs_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	/*while($row_arr_home25=mysqli_fetch_array($sql_arr_home25))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home25['variety']."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}*/
	
	$ver2="";
	$cp2=explode(",",$verarr);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($ver2!="")
				$ver2=$ver2.",".$row312['varietyid'];
			else
				$ver2=$row312['varietyid'];
		}
	}
	//echo $variety;
	$cvcod=$crop1."-Coded";
	if($variety=="ALL" || $variety==$cvcod)
		$ver2=$ver2.",".$cvcod;
	//echo $ver2;
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$vtyp="OP"; $cirec=0; $pvvername=''; $up='';
		$sql_var23=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."'") or die(mysqli_error($link));
		$vtot=mysqli_num_rows($sql_var23);
		if($vtot>0)
		{
			$row_var23=mysqli_fetch_array($sql_var23);
			$verty=$row_var23['popularname'];
			$vtyp=$row_var23['vt'];
			$up=$row_var23['gm'];
			if($vtyp=="Hybrid")$vtyp="Hybrid";
			if($row_var23['vertype']!='PV')
			{
				if($row_var23['pvverid']>0)
				{
					$sq_vr=mysqli_query($link,"select * from tblvariety where varietyid ='".$row_var23['pvverid']."'") or die(mysqli_error($link));
					$row_vr=mysqli_fetch_array($sq_vr);
					$pvvername=$row_vr['popularname'];
				}
				else
				{
					$pvvername=$verty;
				}
			}
			else
			{
				$pvvername=$verty;
			}
		}
		else
		{
			$verty=$verval;
			$pvvername=$verty;
			$vtyp="";
		}
		$xupout=0;//echo $up."  -=-  ";
		if($txtupsdc!="ALL")
		{
			$ups2=explode(" ",$txtupsdc);
			$ups3=explode(".",$ups2[0]);
			if($ups3[1]>0 || $ups3[1]!="000")$upsz=$ups3[0].".".$ups3[1];
			else
			$upsz=$ups3[0].".000";
			$sql_ups=mysqli_query($link,"select * from tblups where ups='$upsz' and wt='".$ups2[1]."'") or die(mysqli_error($link));
			$row_ups=mysqli_fetch_array($sql_ups);
			$xupout=$row_ups['uid'];
			$xupout=explode(",",$xupout);
			//echo "=-=";
			//$nupz=explode(",",$up);
			//$nup=array_merge(array_diff($nupz,$xupout));
			$nup=$xupout;
			//print_r($nup);
		}
		else
		{
			$nup=explode(",",$up);
		}
		//echo "<br/>";
		//echo $up."  -=-  ";
		if($up!="")
		{
			$xpl=count($nup);
			foreach($nup as $upsval)
			{
				if($upsval<>"")
				{
					$sql_ups=mysqli_query($link,"select * from tblups where uid=$upsval") or die(mysqli_error($link));
					while($row_ups=mysqli_fetch_array($sql_ups))	
					{
						$upssize=$row_ups['ups']." ".$row_ups['wt'];
						
						$nqty=0; 
						
		
						// Dispatch table with party Type as All
						$sqdm="select * from tbl_disp where disp_dodc='$ndts' and disp_tflg=1 AND plantcode='$plantcode' order by disp_dodc asc";
						$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						if($t > 0)
						{
							while($rowdispm=mysqli_fetch_array($sql_istbl))
							{
								$xc=0; 
								 $sqlis="select * from tbl_dispsub_sub where disp_id='".$rowdispm['disp_id']."' and dpss_crop='".$crval."' and dpss_variety='".$verval."' and dpss_ups='".$upssize."' AND plantcode='$plantcode' order by disp_id asc";
								$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
								while($row_is=mysqli_fetch_array($sql_is))
								{ 
									$qt=$row_is['dpss_qty']; 
									if($qt<0)$qt=0;
									$xc=$xc+$qt;
									$nqty=$nqty+$qt;
									//echo $row_is['dpss_lotno']."  =  ".$ndts."  =  ".$pvvername."  =  ".$upssize."  =  ".$nqty."<br />";
								}
								
								
							}			
						}
						//echo $ndts."  =  ".$pvvername."  =  ".$upssize."  =  ".$nqty."  =  ";
						// Pack Seed Release Table  with party Type as All
						$sqdm2="select * from tbl_pswrem where pswrem_date='$ndts' AND plantcode='$plantcode' order by pswrem_date asc";
						$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
							
						$t2=mysqli_num_rows($sql_istbl2);
						if($t2 > 0)
						{
							while($rowdispm2=mysqli_fetch_array($sql_istbl2))
							{
								$xc=0; 
								$sqlis2="select * from tbl_lot_ldg_pack where lotldg_id='".$rowdispm2['pswrem_id']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Qty-Rem' and lotldg_trdate='$ndts' and packtype='$upssize' AND plantcode='$plantcode' order by lotdgp_id asc";
								$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
								while($row_is2=mysqli_fetch_array($sql_is2))
								{ 
									$qt=$row_is2['tqty']; 
									if($qt<0)$qt=0;
									$xc=$xc+$qt;
									$nqty=$nqty+$qt;
								}
							}
						}	
						//echo $nqty."  =  ";
						// TDF Dispatch table with Pack seed
						$sqlis11="select * from tbl_dtdf_sub where dtdfs_crop='".$crop1."' and dtdfs_variety='".$verty."' and dtdfs_ups='$upssize' and dtdfs_stage='Pack' AND plantcode='$plantcode'";
						$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
						$t23=mysqli_num_rows($sql_is11);
						while($row_is11=mysqli_fetch_array($sql_is11))
						{ 
							$sqdm2="select * from tbl_dtdf where dtdf_id='".$row_is11['dtdf_id']."' and dtdf_date='$ndts' and dtdf_tflg=1 AND plantcode='$plantcode' order by dtdf_date asc, dtdf_id asc";
							$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
							
							$t2=mysqli_num_rows($sql_istbl2);
							if($t2 > 0)
							{
								while($rowdispm2=mysqli_fetch_array($sql_istbl2))
								{
									
									$xc=0; 
									$sqlis2="select * from tbl_dtdfsub_sub where dtdf_id='".$rowdispm2['dtdf_id']."' and dtdfs_id='".$row_is11['dtdfs_id']."' AND plantcode='$plantcode' order by dtdf_id asc";
									$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
									while($row_is2=mysqli_fetch_array($sql_is2))
									{ 
										$qt=$row_is2['dbss_qty']; 
										if($qt<0)$qt=0;
										$xc=$xc+$qt;
										$nqty=$nqty+$qt;
									}
								}			
							}
						}	
						//echo $nqty."<br />";
		
		
		
									
						$tdate=$ndts;
						$tyear=substr($tdate,0,4);
						$tmonth=substr($tdate,5,2);
						$tday=substr($tdate,8,2);
						$trdate=$tday."-".$tmonth."-".$tyear;
											
if($nqty>0)						
{						
$cnt++; $totnqty=$totnqty+$nqty;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vtyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
</tr>
<?php
$srno=$srno+1;
}

}
}
}
}
if($txtupsdc=="ALL")
{
	$nqty=0; 

	// Dispatch  BULK table with party Type as All
			
	$sqlis11="select * from tbl_dbulk_sub where dbulks_crop='".$crop1."' and dbulks_variety='".$verty."' AND plantcode='$plantcode' ";
	$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
	$t23=mysqli_num_rows($sql_is11);
	while($row_is11=mysqli_fetch_array($sql_is11))
	{ 
		$sqdm2="select * from tbl_dbulk where dbulk_id='".$row_is11['dbulk_id']."' and dbulk_date='$ndts' and dbulk_tflg=1 AND plantcode='$plantcode' order by dbulk_partytype asc, dbulk_date asc";
		$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
		$t2=mysqli_num_rows($sql_istbl2);
		if($t2 > 0)
		{
			while($rowdispm2=mysqli_fetch_array($sql_istbl2))
			{
				$xc=0; 
				$sqlis2="select * from tbl_dbulksub_sub where dbulk_id='".$rowdispm2['dbulk_id']."' and dbulks_id='".$row_is11['dbulks_id']."' AND plantcode='$plantcode' order by dbulk_id asc";
				$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
				while($row_is2=mysqli_fetch_array($sql_is2))
				{ 
					$qt=$row_is2['dbss_qty']; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
					$nqty=$nqty+$qt;
				}
			}
		}					
	}
	// Stock Transfer Out table with party Type as All
	$sqdm="select * from tbl_stoutm where stoutm_date='$ndts' and stoutm_tflg=1 AND plantcode='$plantcode' order by stoutm_date asc";
	$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($rowdispm=mysqli_fetch_array($sql_istbl))
		{
			$xc=0;
			$sqlis="select * from tbl_stouts where stoutm_id='".$rowdispm['stoutm_id']."' and stouts_crop='".$crval."' and stouts_variety='".$verval."' AND plantcode='$plantcode' order by stoutm_id asc";
			$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$qt=$row_is['stouts_qty']; 
				if($qt<0)$qt=0;
				$xc=$xc+$qt;
				$nqty=$nqty+$qt;
			}
		}
	}
	
	// TDF Dispatch table with Pack seed
	$sqlis11="select * from tbl_dtdf_sub where dtdfs_crop='".$crop1."' and dtdfs_variety='".$verty."' and dtdfs_stage='Condition' AND plantcode='$plantcode'";
	$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
	$t23=mysqli_num_rows($sql_is11);
	while($row_is11=mysqli_fetch_array($sql_is11))
	{ 
		$sqdm2="select * from tbl_dtdf where dtdf_id='".$row_is11['dtdf_id']."' and dtdf_date='$ndts' and dtdf_tflg=1 AND plantcode='$plantcode' order by dtdf_date asc, dtdf_id asc";
		$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
		$t2=mysqli_num_rows($sql_istbl2);
		if($t2 > 0)
		{
			while($rowdispm2=mysqli_fetch_array($sql_istbl2))
			{
				
				$xc=0; 
				$sqlis2="select * from tbl_dtdfsub_sub where dtdf_id='".$rowdispm2['dtdf_id']."' and dtdfs_id='".$row_is11['dtdfs_id']."' AND plantcode='$plantcode' order by dtdf_id asc";
				$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
				while($row_is2=mysqli_fetch_array($sql_is2))
				{ 
					$qt=$row_is2['dbss_qty']; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
					$nqty=$nqty+$qt;
				}
			}			
		}
	}	
						
							
	$tdate=$ndts;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$trdate=$tday."-".$tmonth."-".$tyear;
			
	$upssize="Condition";
if($nqty>0)						
{							
$cnt++; $totnqty=$totnqty+$nqty;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vtyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
</tr>
<?php
$srno=$srno+1;
}
}


}
}
}
}
}
}
if($totnqty>0)
{
?>
<tr class="Light">
	<td align="right" valign="middle" class="smalltblheading" colspan="7">Grand Total&nbsp;</td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $totnqty;?></td>
</tr>
<?php
}
if($cnt==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext" colspan="12">No Record Found</td>
</tr>
<?php
}
?>
</table>


</td>
<td width="10"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
	<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="30" align="center" valign="top"><a href="cons_cv_dispatch_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td width="30"></td> <td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>	  
		  
<!-- actual page end  -->	
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
