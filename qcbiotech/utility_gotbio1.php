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
	
	$reptyp=trim($_REQUEST['reptyp']);
	$txt=trim($_REQUEST['txt']);
	$txtlot=trim($_REQUEST['txtlot']);
	$txtlo=trim($_REQUEST['txtlo']);
	$txtlot1=trim($_REQUEST['txtlot1']);
	$txtlot2=trim($_REQUEST['txtlot2']);
	//$txtlot3=trim($_REQUEST['txtlot3']);
	$pcode=trim($_REQUEST['pcode']);
	$txtcrop=trim($_REQUEST['txtcrop']);
	$txtvariety=trim($_REQUEST['txtvariety']);
	$txtstage=trim($_REQUEST['txtstage']);
	$stcode=trim($_REQUEST['stcode']);
	$ycode=trim($_REQUEST['ycodee']);
	$txtlot4=trim($_REQUEST['txtlot4']);
	$stcode2=trim($_REQUEST['stcode2']);
				
	$lotno=$pcode.$ycode.$txtlot2."/".$stcode."/".$stcode2;	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality GOT - Utlity - GOT Biography</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
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
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}
function showimages(ssid2)
{
	if(ssid2!="")
	{
		winHandle=window.open('showimages.php?tp='+ssid2,'WelCome','top=170,left=180,width=850,height=450,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Utility - GOT Biography - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="mainform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php 
if($txtcrop!="" and txtvariety!="")
{
$crop=$txtcrop;
$variety=$txtvariety;
$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$txtcrop'"); 
$row_dept=mysqli_fetch_array($quer2);
$crpname=$row_dept['cropname'];
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$txtvariety."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$txtvariety;
	 }
	 else
	 {
	  $vv=$tt;
	  }
}
else
{
$sql_ltn=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lotno."'") or die(mysqli_error($link));
$row_lnt=mysqli_fetch_array($sql_ltn);

$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='".$row_lnt['lotldg_crop']."'"); 
$row_dept=mysqli_fetch_array($quer2);
$crpname=$row_dept['cropname'];

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_lnt['lotldg_variety']."' "); 
$rowvv=mysqli_fetch_array($quer3);
$vv=$rowvv['popularname'];

$crop=$row_lnt['lotldg_crop'];
$variety=$row_lnt['lotldg_variety'];
}

if($txtcrop!="" and txtvariety!="")
{
$lot=$txtlot1;
}
else
{
$lot=$lotno;
}
 $sql_arival=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lot."'") or die(mysqli_error($link));
 $tot_arrival=mysqli_num_rows($sql_arival);
 $row_arrival=mysqli_fetch_array($sql_arival);
 
 $sql_ar=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_arrival['arrival_id']."'") or die(mysqli_error($link));
 $row_ar=mysqli_fetch_array($sql_ar);
 $gotatarr=$row_ar['arrival_type'];
 $tp="";
	if($row_ar['arrival_type']=="Fresh Seed with PDN")
	{
		$tp="Fresh Seed with PDN";
	}
	else if($row_ar['arrival_type']=="Trading")
	{
		$tp="Trading";
	}
	else if($row_ar['arrival_type']=="Unidentified")
	{
		$tp="Unidentified";
	}
	else if($row_ar['arrival_type']=="Existing")
	{
		$tp="Lot regularisation" ;
	}
	else if($row_ar['arrival_type']=="LotMerger")
	{
		$tp="Lot Merger";
	}
	else if($row_ar['arrival_type']=="Opening Stock")
	{
		$tp="Opening Stock";
	}
	else
	{
		$tp="";
	}
	if($vv=="")
$vv=$crpname."-"."Coded";
 ?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="light" height="25">
	<td align="left" width="50%" class="tblheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crpname;?></td>
  	<td align="right" width="50%" class="tblheading" style="color:#303918; ">Variety: <?php echo $vv;?>&nbsp;</td>
</tr>
<tr class="light" height="25">   
	<td align="left" width="50%" class="tblheading" style="color:#303918; ">&nbsp;Lot No: <?php echo $lot;?></td>
	<td align="right" width="50%" class="tblheading" style="color:#303918; ">Arrival Type: <?php echo $tp;?>&nbsp;</td>
</tr>
	</table><br />

<?php
$sql_tbl=mysqli_query($link,"select * from tbl_qctest where crop='".$crop."' and variety='$variety' and oldlot='$lot' group by sampleno, gotdate order by gotdate desc") or die(mysqli_error($link));

//$sql_tbl=mysqli_query($link,"select distinct lotno from tbl_qctest where crop='".$crop."' and variety='$variety' and oldlot='$lot' order by tid desc") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_tbl);
if($tot > 0)	
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="32" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="100" align="center" valign="middle" class="smalltblheading">DOSR</td>
	<td width="100" align="center" valign="middle" class="smalltblheading">DOSC</td>
	<td width="100" align="center" valign="middle" class="smalltblheading">DOSD</td>
	<td width="100" align="center" valign="middle" class="smalltblheading">DOGR</td>
	<td width="155" align="center" valign="middle" class="smalltblheading">GOT Status</td> 
    <td width="97" align="center" valign="middle" class="smalltblheading">Genetic Purity %</td>
</tr>
  <?php
$srno=1; $dgr="";
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{
/*$sql_max2=mysqli_query($link,"select MAX(tid) from tbl_qctest where lotno='".$row_tbl_sub2['lotno']."'") or die(mysqli_error($link));
$tot_max2=mysqli_num_rows($sql_max2);
while($row_arr_home3=mysqli_fetch_array($sql_max2))
{
$sql_max=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_tbl_sub=mysqli_fetch_array($sql_max))
{
*/
$tdate=$row_tbl_sub['srdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl_sub['spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl_sub['gotdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$tdate3=$row_tbl_sub['dosdate'];
	$tyear3=substr($tdate3,0,4);
	$tmonth3=substr($tdate3,5,2);
	$tday3=substr($tdate3,8,2);
	$tdate3=$tday3."-".$tmonth3."-".$tyear3;
	if($row_tbl_sub['dosdate']=="")$tdate3="";
	
	$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lot."'") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);

	$z=split(" ", $row_whouse['got1']);
	if($row_tbl_sub['gotstatus']!="")
	$lot22=$z[0]." ".$row_tbl_sub['gotstatus'];
	else
	$lot22=$z[0]." ".$row_tbl_sub['got'];
	
	$genpurper=$row_tbl_sub['genpurity'];
	if($genpurper==0)$genpurper="";
	if($tdate2=="--" || $tdate2=="00-00-0000" || $tdate2=="- -" || $tdate2=="NULL")$tdate2="";
$cnt=0;	
$arr=explode("/", $row_tbl_sub['state']);	
foreach($arr as $arr1)
{
if($arr1=="T")$cnt++;
}
//if(($dgr=="UT" || $dgr="NULL") && $row_tbl_sub['gotstatus']=="RT")$cnt=0;
if($cnt == 1)
{
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $tdate?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $tdate1?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $tdate3?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo "--"; else echo $tdate2;?></td>
	<td width="155" align="center" valign="middle" class="smalltbltext"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $genpurper;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $tdate?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $tdate1?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php echo $tdate3?></td>
	<td width="100" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo "--"; else echo $tdate2;?></td>
	<td width="155" align="center" valign="middle" class="smalltbltext"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $genpurper;?></td>
</tr>
<?php
}
$srno=$srno+1; $dgr=$row_tbl_sub['gotstatus'];
}
}
//}
//}
?>
</table>
<?php
}
?>



<?php
/*	
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">

  <!--	<tr height="25" >
   
  	</tr>-->
  <?php
$sql_tbl=mysqli_query($link,"select * from tbl_qctest where crop='".$crop."' and variety='$variety' and oldlot='$lot'") or die(mysqli_error($link));
 $tot=mysqli_num_rows($sql_tbl);
	
?>
<tr class="tblsubtitle" height="20">
  <!--<td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
			 
			  <td width="79" align="center" valign="middle" class="tblheading">QCSR Date </td>
			  <td width="102" align="center" valign="middle" class="tblheading">QCSC Date</td>
			    <td width="108" align="center" valign="middle" class="tblheading">QCR Date</td>
            <td width="112" align="center" valign="middle" class="tblheading">PP</td>
			<td width="79" align="center" valign="middle" class="tblheading" >Moist %</td>
			<td width="75" align="center" valign="middle" class="tblheading" >Germ %</td>
			   <td width="142" align="center" valign="middle" class="tblheading">QC Result </td>
               <td width="116" align="center" valign="middle" class="tblheading">QC Result Date</td>
			   </tr>
  <?php
 
$srno=1;
if($tot > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl))
{


$tdate=$row_tbl_sub['srdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl_sub['spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl_sub['testdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	
$lot=$row_tbl_sub['qcstatus'];
if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['pp'];
		}
		else
		{
		$qc=$row_tbl_sub['pp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['moist'];
		}
		else
		{
		$got=$row_tbl_sub['moist'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$stage=$row_tbl_sub['gemp'];
		}

// $row_tbl['lotldg_crop'];
 
 

if($srno%2!=0)
{
 
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="79" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	      <td width="102" align="center" valign="middle" class="tblheading"><?php echo $tdate1;?></td>
		  <td width="108" align="center" valign="middle" class="tblheading"><?php echo $tdate2;?></td>
	   <td width="112" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="79" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="75" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
       <td align="center" valign="middle" class="tblheading"><?php echo $lot;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $tdate2;?></td>
	        </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="79" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
      <td width="102" align="center" valign="middle" class="tblheading"><?php echo $tdate1;?></td>
	  <td width="108" align="center" valign="middle" class="tblheading"><?php echo $tdate2;?></td>
	   <td width="112" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="79" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="75" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
       <td align="center" valign="middle" class="tblheading"><?php echo $lot;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $tdate2;?></td>
	  </tr>
  <?php
}
$srno++;
}
}
?>


</table>
*/
?>
<br />

<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<tr class="light" height="25">
	<td align="center" class="subheading" style="color:#303918; ">GOT Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="99" align="center" valign="middle" class="smalltblheading">DOSR</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">DOSC</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">DOSD</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">DOGR</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">Mean GP %</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">GOT Status</td> 
    <td width="97" align="center" valign="middle" class="smalltblheading">Doc. Ref. No.</td>
</tr>
  <?php
$sql_tbl2=mysqli_query($link,"select * from tbl_gottest where gottest_oldlot='$lotno' order by gottest_gotdate desc limit 0,1") or die(mysqli_error($link));
	$tot_gottest=mysqli_num_rows($sql_tbl2);

if($tot_gottest==0)
{
	$sql_tbl2=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' group by gotdate  order by gotdate desc limit 0,1") or die(mysqli_error($link));
}
  
$srno=1; $gotmid=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl2))
{
	/*$tdate=$row_tbl_sub['srdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;*/
	$gotflg=$row_tbl_sub['gottest_gotflg'];
	$gotmid=$row_tbl_sub['gottest_tid'];
	
	$tdate1=$row_tbl_sub['gottest_spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl_sub['gottest_gotdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$tdate3=$row_tbl_sub['gottest_dosdate'];
	$tyear3=substr($tdate3,0,4);
	$tmonth3=substr($tdate3,5,2);
	$tday3=substr($tdate3,8,2);
	$tdate3=$tday3."-".$tmonth3."-".$tyear3;
	if($row_tbl_sub['gottest_dosdate']=="")$tdate3="--";
	
	$z=split(" ", $row_lotldg['lotldg_got1']);
	
	$lot22=$z[0]." ".$row_lotldg['lotldg_got'];
	$docref2=$row_tbl_sub['gottest_gotrefno'];

$arr=explode("/", $row_tbl_sub['state']);	
foreach($arr as $arr1)
{
if($arr1=="T")$cnt++;
}
$cnt=1;	
if($cnt == 1)
{
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate3=="00-00-0000")echo ""; else echo $tdate3;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['genpurity'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $docref2;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($tdate=="00-00-0000")echo ""; else echo $tdate;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate1=="00-00-0000")echo ""; else echo $tdate1;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate3=="00-00-0000")echo ""; else echo $tdate3;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($tdate2=="00-00-0000")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['genpurity'];?></td>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="smalltbltext"><?php echo $docref2;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<?php
//echo $gotmid;
$sql_s=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$gotmid."'") or die(mysqli_error($link));
while($rows=mysqli_fetch_array($sql_s))
{
	if($rows['gottests_type']=="IN-SITU")
	{
	?>		  
		<tr class="Dark" height="30">
		<td width="176" height="32" align="right"  valign="middle" class="tblheading">IN-SITU&nbsp;</td>
		<td width="216" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value="" checked="checked" disabled="disabled"/></td>
		<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
			<td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $rows['gottests_noofrefl']?></td>
		</tr>
	<?php 
	}
	if($rows['gottests_type']=="IN-TERRA")
	{
	?>		  
		<tr class="Dark" height="30">
		<td width="176" height="32" align="right"  valign="middle" class="tblheading">IN-TERRA&nbsp;</td>
		<td width="216" align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value="" checked="checked" disabled="disabled"/></td>
		<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
			<td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $rows['gottests_noofrefl']?></td>
		</tr>
	<?php 
	}
}
	?>		   
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-SITU : DNA</td>
</tr>
<?php $step2="PCR";?>
<tr class="Dark" height="25">
	<td width="72" align="center" valign="middle" class="smalltblheading">Repl No</td>
	<td width="191" align="center" valign="middle" class="smalltblheading">Sample Reciept Date</td>
	<td width="199" align="center" valign="middle" class="smalltblheading">DNA Extraction Date</td>
	<td width="180" align="center" valign="middle" class="smalltblheading">DNA Extracted From</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">DNA Extraction Method</td>
	<td width="90" align="center" valign="middle" class="smalltblheading">Sample Age</td>
</tr>
<?php
$replsitu=1;
$sql_s1=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$gotmid."' and gottests_type='IN-SITU'") or die(mysqli_error($link));
$rows1=mysqli_fetch_array($sql_s1);

$sql_ss1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows1['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
while($rowss1= mysqli_fetch_array($sql_ss1))
{
	$rdate=""; $exdate="";

	$rdate=$rowss1['gottestss_samprecdate'];
	$tyear=substr($rdate,0,4);
	$tmonth=substr($rdate,5,2);
	$tday=substr($rdate,8,2);
	$rdate1=$tday."-".$tmonth."-".$tyear;
	
	$exdate=$rowss1['gottestss_dnaextdate'];
	$tyear=substr($exdate,0,4);
	$tmonth=substr($exdate,5,2);
	$tday=substr($exdate,8,2);
	$exdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="72" align="center" valign="middle" class="smalltbltext"><?php echo $replsitu;?></td>
	<td width="191" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?></td>
	<td width="199" align="center" valign="middle" class="smalltbltext"><?php echo $exdate1;?></td>
	<td width="180" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextfrom'];?></td>
	<td width="103" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod'];?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_dnaextmethod1'];?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $rowss1['gottestss_sampleage'];?></td>
</tr>
<?php
$replsitu++;

}
?>
</table><br />
	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-SITU : PCR Analysis</td>
</tr>
<tr class="Dark" height="25">
	<td width="208" align="center" valign="middle" class="smalltblheading" rowspan="2">PCR Analysis Date</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="3">Marker</td>
</tr>
<tr class="Dark" height="25">
	<td width="263" align="center" valign="middle" class="smalltblheading">Number</td>
	<td width="234" align="center" valign="middle" class="smalltblheading">Type</td>
	<td width="235" align="center" valign="middle" class="smalltblheading">Name</td>
</tr>
<?php

$sql_s2=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$gotmid."' and gottests_type='IN-SITU'") or die(mysqli_error($link));
$rows2=mysqli_fetch_array($sql_s2);

$sql_ss2=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows2['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
while($rowss2= mysqli_fetch_array($sql_ss2))
{

$sql_sss=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$rowss2['gottestss_id']."'")or die(mysqli_error($link));
$rowsss= mysqli_fetch_array($sql_sss);
$pdate="";
	$pdate=$rowsss['gottestss2_pcrdate'];
	$tyear=substr($pdate,0,4);
	$tmonth=substr($pdate,5,2);
	$tday=substr($pdate,8,2);
	$pdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="208" align="center" valign="middle" class="smalltbltext"><?php echo $pdate1?></td>
	<td width="263" align="center" valign="middle" class="smalltbltext"><?php echo $rowsss['gottestss2_mnumber'];?></td>
	<td width="234" align="center" valign="middle" class="smalltbltext"><?php echo $rowsss['gottestss2_mtype'];?></td>
	<td width="235" align="center" valign="middle" class="smalltbltext"><?php echo $rowsss['gottestss2_mname'];?></td>
</tr>
<?php }?>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="20" align="center" class="tblheading" id="rephead">IN-SITU : GEA</td>
</tr>
<?php $step2="PCR";?>
<tr class="Dark" height="25">
	<td width="36" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td width="36" align="center" valign="middle" class="smalltblheading" rowspan="2">GEA Date</td>
	<td width="51" align="center" valign="middle" class="smalltblheading" rowspan="2">Sample Size</td>
	<td width="57" align="center" valign="middle" class="smalltblheading" rowspan="2">Samples Not Amplified</td>
	<td width="58" align="center" valign="middle" class="smalltblheading" rowspan="2">Amplified Samples</td>
	<td width="37" align="center" valign="middle" class="smalltblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Male No.&nbsp;<?php }else{?>Desi Type No.&nbsp;<?php }?></td>
	<td width="30" align="center" valign="middle" class="smalltblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Male %&nbsp;<?php }else{?>Desi Type %&nbsp;<?php }?></td>
	<td width="61" align="center" valign="middle" class="smalltblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Female No.&nbsp;<?php }else{?>Branching No.&nbsp;<?php }?></td>
	<td width="61" align="center" valign="middle" class="smalltblheading" rowspan="2"><?php if($crop!="Cluster Bean"){?>Female %&nbsp;<?php }else{?>Branching %&nbsp;<?php }?></td>
	<td width="56" align="center" valign="middle" class="smalltblheading" rowspan="2">Outcross No.</td>
	<td width="56" align="center" valign="middle" class="smalltblheading" rowspan="2">Outcross %</td>
	<td width="27" align="center" valign="middle" class="smalltblheading" rowspan="2">OOF No.</td>
	<td width="33" align="center" valign="middle" class="smalltblheading" rowspan="2">OOF %</td>
	<td width="53" align="center" valign="middle" class="smalltblheading" rowspan="2">Total No.</td>
	<td width="43" align="center" valign="middle" class="smalltblheading" rowspan="2">Total %</td>
	<td width="54" align="center" valign="middle" class="smalltblheading" rowspan="2">Genetic Purity % </td>
	<td align="center" valign="middle" class="smalltblheading" colspan="3">Base Pair Size</td>
	<td width="54" align="center" valign="middle" class="smalltblheading" rowspan="2">Images</td>
</tr>
<tr class="Dark" height="25">
	<td width="68" align="center" valign="middle" class="smalltblheading">Male</td>
	<td width="67" align="center" valign="middle" class="smalltblheading">Female</td>
	<td align="center" valign="middle" class="smalltblheading">Hybrid</td>
</tr>
<?php
$sql_s1=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$gotmid."' and gottests_type='IN-SITU'") or die(mysqli_error($link));
$rows1=mysqli_fetch_array($sql_s1);
$srno1=1;
$sql_ss1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$rows1['gottests_id']."' and gottestss_completeflg=1 order by gottestss_id asc")or die(mysqli_error($link));
while($rowss1= mysqli_fetch_array($sql_ss1))
{
	$rdate=""; $sampsize=""; $snotamp=""; $samp=""; $maleno=""; $maleper=""; $femaleno=""; $femaleper=""; $outcrno=""; $outcrper=""; $oofno=""; $oofper=""; $totno=""; $totper=""; $genpurity=""; $bspmale=""; $bspfemale=""; $bsphybrid="";
$sql_gea=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$rowss1['gottestss_id']."' order by gottestss2_id asc")or die(mysqli_error($link));
$row_gea= mysqli_fetch_array($sql_gea);


	

	$rdate=$row_gea['gottestss2_gelelctdate'];
	$tyear=substr($rdate,0,4);
	$tmonth=substr($rdate,5,2);
	$tday=substr($rdate,8,2);
	$rdate1=$tday."-".$tmonth."-".$tyear;
	
	$sampsize=$row_gea['gottestss2_samplesize'];
	$snotamp=$row_gea['gottestss2_sampnotamp']; 
	$samp=$row_gea['gottestss2_sampamp']; 
	$maleno=$row_gea['gottestss2_maleno']; 
	$maleper=$row_gea['gottestss2_maleper']; 
	$femaleno=$row_gea['gottestss2_femaleno']; 
	$femaleper=$row_gea['gottestss2_femaleper']; 
	$outcrno=$row_gea['gottestss2_outcrossno']; 
	$outcrper=$row_gea['gottestss2_outcrossper']; 
	$oofno=$row_gea['gottestss2_oofno']; 
	$oofper=$row_gea['gottestss2_oofper']; 
	$totno=$row_gea['gottestss2_totno']; 
	$totper=$row_gea['gottestss2_totper']; 
	$genpurity=$row_gea['gottestss2_genpurity']; 
	$bspmale=$row_gea['gottestss2_bspmale']; 
	$bspfemale=$row_gea['gottestss2_bspfemale']; 
	$bsphybrid=$row_gea['gottestss2_bsphybrid'];
?>
<tr class="Light" height="25">
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $rdate1;?></td>
	<td width="51" align="center" valign="middle" class="smalltbltext"><?php echo $sampsize;?></td>
	<td width="57" align="center" valign="middle" class="smalltbltext"><?php echo $snotamp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $samp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $maleno;?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $maleper;?></td>
	<td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $femaleno;?></td>
	<td width="61" align="center" valign="middle" class="smalltbltext"><?php echo $femaleper;?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $outcrno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $outcrper;?></td>
	<td width="27" align="center" valign="middle" class="smalltbltext"><?php echo $oofno;?></td>
	<td width="33" align="center" valign="middle" class="smalltbltext"><?php echo $oofper;?></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><?php echo $totno;?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $totper;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpurity;?></td>
	<td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $bspmale;?></td>
	<td width="67" align="center" valign="middle" class="smalltbltext"><?php echo $bspfemale;?></td>
	<td width="64" align="center" valign="middle" class="smalltbltext"><?php echo $bsphybrid;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="showimages('<?php echo $row_gea['gottestss2_id']?>')">Details</a></td>
</tr>
<?php
$srno1++;
}
?>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-TERRA : Sowing</td>
</tr>
<?php $step1="PCR";?>
<tr class="Dark" height="25">
	<td width="90" align="center" valign="middle" class="tblheading">Repl. No</td>
	<td width="280" align="center" valign="middle" class="tblheading">Date of Sowing</td>
	<td width="292" align="center" valign="middle" class="tblheading">Sowing Plot</td>
	<td width="278" align="center" valign="middle" class="tblheading"><?php if($crop=="Paddy Seed" || $crop=="Maize Seed" || $crop=="Pearl Millet"){?>No. of Rows<?php }else{?>No. of Seeds<?php }?></td>
</tr>
<?php
$repl=1; $idss="";
$sql_terra=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$gotmid."' and gottests_type='IN-TERRA'") or die(mysqli_error($link));
$row_terra=mysqli_fetch_array($sql_terra);

$sql_terra1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_terra['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
while($row_terra1= mysqli_fetch_array($sql_terra1))
{
	$sdate1="";
	$sdate=$row_terra1['gottestss_doswdate'];
	$tyear=substr($sdate,0,4);
	$tmonth=substr($sdate,5,2);
	$tday=substr($sdate,8,2);
	$sdate1=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $repl;?></td>
	<td width="280" align="center" valign="middle" class="smalltbltext"><?php echo $sdate1;?></td>
	
	<td width="292" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra1['gottestss_swoingplot']?></td>
	
	<td width="278" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra1['gottestss_noofrows'];?></td>
</tr>
<?php
if($idss=="")
	$idss=$row_terra1['gottestss_id']; 
else
	$idss=$idss.",".$row_terra1['gottestss_id']; 
$repl++;
}
?>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead1">IN-TERRA : Transplanting </td>
</tr>
<tr class="Dark" height="25">
	<td width="116" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Date of Transplant</td>
	<td width="91" align="center" valign="middle" class="smalltblheading">Transplant Plot</td>
	<td width="87" align="center" valign="middle" class="smalltblheading">Range</td>
	<td width="95" align="center" valign="middle" class="smalltblheading">No. of Rows</td>
	<td width="94" align="center" valign="middle" class="smalltblheading">Bed no.</td>
	<td width="118" align="center" valign="middle" class="smalltblheading">Direction</td>
	<td width="119" align="center" valign="middle" class="smalltblheading">State</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Location</td>
	<td width="94" align="center" valign="middle" class="smalltblheading">No. of Plants</td>
</tr>
<?php
$repl1=1;
$cnt=count($idss);
if($cnt>1)
{
	$sql_terra12=mysqli_query($link,"select * from tbl_gottestsub_sub where gottestss_id in ($idss) order by gottestss_id asc")or die(mysqli_error($link));
}
else
{
	$sql_terra12=mysqli_query($link,"select * from tbl_gottestsub_sub where gottestss_id='".$idss."' order by gottestss_id asc")or die(mysqli_error($link));
}
while($row_terra12= mysqli_fetch_array($sql_terra12))
{
	$trdate1="";
	$trdate1=$row_terra12['gottestss_dateoftr'];
	$tyear=substr($trdate1,0,4);
	$tmonth=substr($trdate1,5,2);
	$tday=substr($trdate1,8,2);
	$trdate=$tday."-".$tmonth."-".$tyear;
	
	$sql_loc=mysqli_query($link,"select * from tbl_gotlocation where loc_id='".$row_terra12['gottestss_gotlocation']."'")or die(mysqli_error($link));
	$rowloc=mysqli_fetch_array($sql_loc);

	$sql_state=mysqli_query($link,"select * from tbl_state where state_id='".$row_terra12['gottestss_state']."'")or die(mysqli_error($link));
	$rowstate=mysqli_fetch_array($sql_state);

?>
<tr class="Light" height="20">
	<td width="116" align="center" valign="middle" class="smalltbltext"><?php echo $repl1?></td>
	<td width="116" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra12['gottestss_trplot'];?></td>
	<td width="87" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra12['gottestss_range'];?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra12['gottestss_trrows'];?></td>
	<td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra12['gottestss_bedno'];?></td>
	<td width="118" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra12['gottestss_direction'];?></td>
	<td width="119" align="center" valign="middle" class="smalltbltext"><?php echo $rowstate['state_name'];?></td>
	<td width="116" align="center" valign="middle" class="smalltbltext"><?php echo $rowloc['loc_name'];?></td>
	<td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra12['gottestss_plantpopln'];?></td>
</tr>
<?php
$repl1++; 
}
?>
</table><br />

<?php 
if($crop=="Maize Seed" || $crop=="Pearl Millet")
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="15" align="center" class="tblheading" >IN-TERRA : Obsevations</td>
</tr>
<tr class="Dark" height="30">
<td width="17" align="center" valign="middle" class="smalltblheading">#</td>
<td width="17" align="center" valign="middle" class="smalltblheading">Repl No</td>
<td width="74" align="center" valign="middle" class="smalltblheading">Plant Population</td>
 <td width="72" align="center" valign="middle" class="smalltblheading">Male/Desi Type No.</td>
  <td width="58" align="center" valign="middle" class="smalltblheading">Male/Desi Type %</td>
 <td width="102" align="center" valign="middle" class="smalltblheading">Female/Branching</td>
  <td width="117" align="center" valign="middle" class="smalltblheading">Female/Branching %</td>
   <td width="34" align="center" valign="middle" class="smalltblheading">Tall Plant</td>
  <td width="43" align="center" valign="middle" class="smalltblheading">Tall Plant %</td>
 <td width="34" align="center" valign="middle" class="smalltblheading">OOF</td>
  <td width="43" align="center" valign="middle" class="smalltblheading">OOF %</td>
 <td width="31" align="center" valign="middle" class="smalltblheading">Total</td>
   <td width="45" align="center" valign="middle" class="smalltblheading">Total %</td>
 <td width="56" align="center" valign="middle" class="smalltblheading">Genetic Purity %</td>
 <td width="75" align="center" valign="middle" class="smalltblheading">Date of Observation</td>
</tr>
<?php
$repl2=1; $srno=1;
$idss1=explode(",",$idss);
foreach($idss1 as $ssid)
{	
	$sql_terra2=mysqli_query($link,"select * from tbl_gottestsub_sub4 where gottestss_id='".$ssid."' order by gottestss4_id asc")or die(mysqli_error($link));
	while($row_terra2= mysqli_fetch_array($sql_terra2))
	{
	
	$obrdate=$row_terra2['gottestss4_doobr'];
	$tyear=substr($obrdate,0,4);
	$tmonth=substr($obrdate,5,2);
	$tday=substr($obrdate,8,2);
	$obrdate=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Dark" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $repl2;?></td>
	<td width="74"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['plantpopl'];?></td>
	<td width="72"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['maleno'];?></td>
	<td width="58"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['maleper'];?></td>
	<td width="102" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['femaleno'];?></td>
	<td width="117" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['femaleper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['tallplantno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['tallplantper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['oofno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['oofper'];?></td>
	<td width="31"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['totalno'];?></td>
	<td width="45"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['totalper'];?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss4_genpurity'];?></td>
	<td width="79" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
</tr>
<?php
	$srno++;
	}
	$repl2++;
}
?>
</table><br />
<?php 
} 
else if($crop=="Paddy Seed")
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="22" align="center" class="tblheading" >IN-TERRA : Obsevations</td>
</tr>

<tr class="Dark" height="30">
<td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
<td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">Repl No</td>
 <td width="64" align="center" valign="middle" class="smalltblheading" rowspan="2">Plant Population</td>
 <td width="37" align="center" valign="middle" class="smalltblheading" colspan="4">Early</td>
 <td width="32" align="center" valign="middle" class="smalltblheading" colspan="2">Sterile</td>
 <td width="35" align="center" valign="middle" class="smalltblheading" colspan="6">Other Off Types</td>
  <td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">Total</td>
 <td width="52" align="center" valign="middle" class="smalltblheading" rowspan="2">Genetic Purity</td>
 <td width="69" align="center" valign="middle" class="smalltblheading" rowspan="2">Date of Observation</td>
</tr>
<tr class="Dark" height="30">
 <td width="37" align="center" valign="middle" class="smalltblheading">1010</td>
 <td width="38" align="center" valign="middle" class="smalltblheading">Red Tip</td>
 <td width="48" align="center" valign="middle" class="smalltblheading">Early Fine Grain</td>
 <td width="37" align="center" valign="middle" class="smalltblheading">Other</td>
 <td width="32" align="center" valign="middle" class="smalltblheading">A Line</td>
 <td width="35" align="center" valign="middle" class="smalltblheading">Out Cross</td>
 <td width="30" align="center" valign="middle" class="smalltblheading">B Line</td>
 <td width="35" align="center" valign="middle" class="smalltblheading">Long Grain</td>
 <td width="37" align="center" valign="middle" class="smalltblheading">Fine Grain</td>
 <td width="39" align="center" valign="middle" class="smalltblheading">Bold Grain</td>
 <td width="39" align="center" valign="middle" class="smalltblheading">Tall Plants</td>
 <td width="41" align="center" valign="middle" class="smalltblheading">Late Plants</td>
</tr>
<?php
$repl2=1; $srno=1;
$idss1=explode(",",$idss);
foreach($idss1 as $ssid)
{	
	$sql_terra2=mysqli_query($link,"select * from tbl_gottestsub_sub4 where gottestss_id='".$ssid."' order by gottestss4_id asc")or die(mysqli_error($link));
	while($row_terra2= mysqli_fetch_array($sql_terra2))
	{
	
	$obrdate=$row_terra2['gottestss4_doobr'];
	$tyear=substr($obrdate,0,4);
	$tmonth=substr($obrdate,5,2);
	$tday=substr($obrdate,8,2);
	$obrdate=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $repl2;?></td>
	<td width="64"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['plantpopl'];?></td>
	<td width="37"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['tentenno'];?></td>
	<td width="38" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['redtpno'];?></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['finegrainno'];?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['otherno'];?></td>
	<td width="32"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['alineno'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['outcrno'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['blineno'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['longgrainno'];?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['ootfinegrainno'];?></td>
	<td width="39" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['boldgrainno'];?></td>
	<td width="39" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['tallplantno'];?></td>
	<td width="41" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['lateplantno'];?></td>
	<td width="39"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['totalno'];?></td>
	<td width="52"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss4_genpurity'];?></td>
	<td width="69" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
</tr>
<?php
	$srno++;
	}
	$repl2++;
}
?>
</table><br />
<?php 
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="13" align="center" class="tblheading" >IN-TERRA : Obsevations</td>
</tr>
<tr class="Dark" height="30">
<td width="17" align="center" valign="middle" class="smalltblheading">#</td>
<td width="17" align="center" valign="middle" class="smalltblheading">Repl No</td>
<td width="74" align="center" valign="middle" class="smalltblheading">Plant Population</td>
 <td width="72" align="center" valign="middle" class="smalltblheading">Male/Desi Type No.</td>
  <td width="58" align="center" valign="middle" class="smalltblheading">Male/Desi Type %</td>
 <td width="102" align="center" valign="middle" class="smalltblheading">Female/Branching</td>
  <td width="117" align="center" valign="middle" class="smalltblheading">Female/Branching %</td>
 <td width="34" align="center" valign="middle" class="smalltblheading">OOF</td>
  <td width="43" align="center" valign="middle" class="smalltblheading">OOF %</td>
 <td width="31" align="center" valign="middle" class="smalltblheading">Total</td>
   <td width="45" align="center" valign="middle" class="smalltblheading">Total %</td>
 <td width="56" align="center" valign="middle" class="smalltblheading">Genetic Purity %</td>
 <td width="75" align="center" valign="middle" class="smalltblheading">Date of Observation</td>
</tr>
<?php
$repl2=1; $srno=1;
$idss1=explode(",",$idss);
foreach($idss1 as $ssid)
{	
	$sql_terra2=mysqli_query($link,"select * from tbl_gottestsub_sub3 where gottestss_id='".$ssid."' order by gottestss3_id asc")or die(mysqli_error($link));
	while($row_terra2= mysqli_fetch_array($sql_terra2))
	{
	
	$obrdate=$row_terra2['gottestss3_doobrdate'];
	$tyear=substr($obrdate,0,4);
	$tmonth=substr($obrdate,5,2);
	$tday=substr($obrdate,8,2);
	$obrdate=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Light" height="25">
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="17"align="center" valign="middle" class="smalltbltext"><?php echo $repl2;?></td>
	<td width="74"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_plantpopln'];?></td>
	<td width="72"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_maleno'];?></td>
	<td width="58"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_maleper'];?></td>
	<td width="102" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_femaleno'];?></td>
	<td width="117" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_femaleper'];?></td>
	<td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_oofno'];?></td>
	<td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_oofper'];?></td>
	<td width="31"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_totno'];?></td>
	<td width="45"align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_totper'];?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $row_terra2['gottestss3_genpurity'];?></td>
	<td width="75" align="center" valign="middle" class="smalltbltext"><?php echo $obrdate;?></td>
</tr>
<?php
	$srno++;
	}
	$repl2++;
}
?>
</table><br />
<?php 
}
if($gotflg==1)
{
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">GOT Result Data</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<tr height="25" class="tblsubtitle" >
    <td align="center" class="tblheading" style="color:#303918; " rowspan="2">GOT Result Data</td>
	 <td align="center" class="tblheading" style="color:#303918; " colspan="2">Repl. #1</td>
	 <td align="center" class="tblheading" style="color:#303918; " colspan="2">Repl. #2</td>
	 <td align="center" class="tblheading" style="color:#303918; " colspan="2">Repl. #3</td>
	 <td align="center" class="tblheading" style="color:#303918; " colspan="2">Repl. #4</td>
</tr>
<tr height="20" class="tblsubtitle" >
	<td width="97" align="center" valign="middle" class="smalltblheading">GP %</td>
	<td width="99" align="center" valign="middle" class="smalltblheading">CMC</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">GP %</td>
	<td width="99" align="center" valign="middle" class="smalltblheading">CMC</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">GP %</td>
	<td width="99" align="center" valign="middle" class="smalltblheading">CMC</td>
	<td width="97" align="center" valign="middle" class="smalltblheading">GP %</td>
	<td width="99" align="center" valign="middle" class="smalltblheading">CMC</td>
</tr>
<?php
//echo "select * from tbl_gottestsub where gottest_tid='".$gotmid."' order by gottests_id asc";
$sql_res=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$gotmid."' order by gottests_id asc")or die(mysqli_error($link));
while($row_res= mysqli_fetch_array($sql_res))
{
	if($row_res['gottests_type']=="IN-SITU")
	{
		$sql_res1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_res['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
		
?>
<tr height="20">
	<td width="97" align="center" valign="middle" class="tblheading">IN - SITU</td>
	<?php 
	$situ=0;
	while($row_res1=mysqli_fetch_array($sql_res1))
	{
		$sql_res2=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$row_res1['gottestss_id']."' order by gottestss2_id desc limit 0,1")or die(mysqli_error($link));
		$row_res2=mysqli_fetch_array($sql_res2);
	?>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($row_res2['gottestss2_genpurity']!=""){echo $row_res2['gottestss2_genpurity'];}else{ echo "NA";}?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($row_res2['gottestss2_genpurity']!=""){echo $row_res2['considered'];}else{ echo "NA";}?></td>
	<?php
	$situ++;
	}
	if($situ<4)
	{
		$situ=4-$situ;
		for($i=1;$i<=$situ;$i++)
		{
	?>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo "NA";?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo "NA";?></td>
	<?php 
		}
	}
	?>
	<!--<td width="97" align="center" valign="middle" class="smalltbltext">NA</td>
	<td width="99" align="center" valign="middle" class="smalltbltext">NA</td>
	<td width="97" align="center" valign="middle" class="smalltbltext">NA</td>
	<td align="center" valign="middle" class="smalltbltext">NA</td>-->
</tr>
<?php
}
if($row_res['gottests_type']=="IN-TERRA")
{
	$sql_res1=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_res['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
		
?>
<tr height="20">
	<td width="97" align="center" valign="middle" class="tblheading">IN - TERRA</td>
	<?php 
	$terra=0;
	while($row_res1=mysqli_fetch_array($sql_res1))
	{$gpper=''; $cmc='';
		if($crop=="Maize Seed" || $crop=="Pearl Millet" || $crop=="Paddy Seed")
		{
			$sql_res2=mysqli_query($link,"select * from tbl_gottestsub_sub4 where gottests_id='".$row_res['gottests_id']."' order by gottestss_id asc")or die(mysqli_error($link));
			$row_res2=mysqli_fetch_array($sql_res2);
			$gpper=$row_res2['gottestss4_genpurity'];	
			$cmc=$row_res2['considered'];
		}
		else
		{ //echo $row_res1['gottestss_id'];
			$sql_res2=mysqli_query($link,"select * from tbl_gottestsub_sub3 where gottestss_id='".$row_res1['gottestss_id']."' order by gottestss_id desc")or die(mysqli_error($link));
			$row_res2=mysqli_fetch_array($sql_res2);
			$gpper=$row_res2['gottestss3_genpurity'];	
			$cmc=$row_res2['considered'];
		}	
	?>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php if($gpper!=""){echo $gpper;}else{echo "NA";}?></td>
	<td width="99" align="center" valign="middle" class="smalltbltext"><?php if($gpper!=""){echo $cmc;}else{echo "NA";}?></td>
	<?php
	$terra++;
	}
	if($terra<4)
	{
		$terra=4-$terra;
		for($i=1;$i<=$terra;$i++)
		{
	?>
	<td width="97" align="center" valign="middle" class="smalltbltext"><?php echo "NA";?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo "NA";?></td>
	<?php 
		}
	}
	?>
	<!--<td width="97" align="center" valign="middle" class="smalltbltext">96.000</td>
	<td width="99" align="center" valign="middle" class="smalltbltext">Yes</td>
	<td width="97" align="center" valign="middle" class="smalltbltext">96.000</td>
	<td align="center" valign="middle" class="smalltbltext">No</td>-->
</tr>
<?php 
}
}
?>
</table>
<?php
}
?>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
 <td valign="top" align="center"><a href="utility_gotbio.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
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

  