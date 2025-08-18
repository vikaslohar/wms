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
	
	if(isset($_REQUEST['txtcrop']))
	{
	$crop = $_REQUEST['txtcrop'];
	}
	if(isset($_REQUEST['txtvariety']))
	{
	$variety = $_REQUEST['txtvariety'];
	}
	if(isset($_REQUEST['txtlot1']))
	{
	$lot = $_REQUEST['txtlot1'];
	}
	



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality - Utlity - QC Biography</title>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Utility - QC Biography - Preview</td>
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

		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$variety."'  order by popularname Asc"); 
$rowv=mysqli_fetch_array($quer4);
	 $rowvv=$rowv['popularname'];	
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$crop."'"); 
	$row3=mysqli_fetch_array($quer3);
	 $row31=$row3['cropname'];
	 
	 $sql_arival=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lot."'") or die(mysqli_error($link));
 $tot_arrival=mysqli_num_rows($sql_arival);
 $row_arrival=mysqli_fetch_array($sql_arival);
$gotatarr=$row_arrival['got'];
if($rowvv=="")
$rowvv=$row31."-"."Coded";
	 ?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="light" height="25">
	<td align="left" width="50%" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $row31;?></td>
  	<td align="right" width="50%" class="subheading" style="color:#303918; ">Variety: <?php echo $rowvv;?>&nbsp;</td>
</tr>
<tr class="light" height="25">   
	<td align="left" width="50%" class="subheading" style="color:#303918; ">&nbsp;Lot No: <?php echo $lot;?></td>
	<td align="right" width="50%" class="subheading" style="color:#303918; ">GOT status on Arrival: <?php echo $gotatarr;?>&nbsp;</td>
</tr>
	</table><br />

<?php
$dt=""; 
$sql_tbl333=mysqli_query($link,"select * from tbl_qctest where crop='".$crop."' and variety='$variety' and oldlot='$lot' order by testdate desc, tid desc") or die(mysqli_error($link));
$tot333=mysqli_num_rows($sql_tbl333);
while($row_tbl333=mysqli_fetch_array($sql_tbl333))
{
if($dt!="")
$dt=$dt.",".$row_tbl333['srdate'];
else
$dt=$row_tbl333['srdate'];
}
$sql_pp333=mysqli_query($link,"select * from tbl_pmupdate where lotno='".$lot."' order by pmup_id desc") or die(mysqli_error($link));
$tot_pp333=mysqli_num_rows($sql_pp333);
while($row_pp333=mysqli_fetch_array($sql_pp333))
{
if($dt!="")
$dt=$dt.",".$row_pp333['pmup_date'];
else
$dt=$row_pp333['pmup_date'];
}

$d1=explode(",",$dt);
$dt1=array_unique($d1);
rsort($dt1);
//print_r($dt1);
$sql_tbl2=mysqli_query($link,"select * from tbl_qctest where crop='".$crop."' and variety='$variety' and oldlot='$lot' group by sampleno,gotdate order by gotdate desc") or die(mysqli_error($link));

?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="light" height="25">
	<td align="center" class="subheading" style="color:#303918; ">QC Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="76" align="center" valign="middle" class="tblheading">#</td>
	<td width="82" align="center" valign="middle" class="tblheading">DOSR</td>
	<td width="80" align="center" valign="middle" class="tblheading">DOSC</td>
	<td width="83" align="center" valign="middle" class="tblheading">DOT</td>
	<td width="72" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="72" align="center" valign="middle" class="tblheading">PP</td> 
	<td width="73" align="center" valign="middle" class="tblheading">Moist%</td>
	<td width="70" align="center" valign="middle" class="tblheading">Germ%</td>
	<td width="122" align="center" valign="middle" class="tblheading">Doc. Ref. No.</td>
</tr>
  <?php 
  $srno=1;
  foreach ($dt1 as $dval) 
  {
  if($dval<>"")
  { 
  $sql_tbl=mysqli_query($link,"select *  from tbl_qctest where crop='".$crop."' and variety='".$variety."' and oldlot='".$lot."' and srdate='".$dval."' group by sampleno, testdate, state order by testdate desc, tid desc") or die(mysqli_error($link));
 $tot1=mysqli_num_rows($sql_tbl);
 
 $sql_pp=mysqli_query($link,"select * from tbl_pmupdate where lotno='".$lot."' and pmup_date='".$dval."' order by pmup_date desc") or die(mysqli_error($link));
 $tot2=mysqli_num_rows($sql_pp);
 

 
if($tot1 > 0)	
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
	
	$lot11=$row_tbl_sub['qcstatus'];
	$qc=$row_tbl_sub['pp'];
	$got=$row_tbl_sub['moist'];
	$stage=$row_tbl_sub['gemp'];
		
	$docref=$row_tbl_sub['qcrefno'];
	
if($stage==0) $stage="";
$cnt=0;	
$arr=explode("/", $row_tbl_sub['state']);	
foreach($arr as $arr1)
{
if($arr1=="G")$cnt=1;
}
if($cnt == 1)
{
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php echo $tdate2?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php echo $tdate2?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
</tr>	
<?php
}
$srno=$srno+1;
}
}
}
if($tot2>0)
{
while($row_pp=mysqli_fetch_array($sql_pp))
{
	$tdate="";
	$tdate1="";
	$tdate2=$row_pp['pmup_date'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	$lot11="";
	$qc=$row_pp['pp'];
	$got=$row_pp['moist'];
	$stage="";
	$docref="PPM Update";
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php echo $tdate2?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="76" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="82" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="80" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="83" align="center" valign="middle" class="tblheading"><?php echo $tdate2?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $lot11?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $qc?></td> 
	<td width="73" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<td width="122" align="center" valign="middle" class="tblheading"><?php echo $docref;?></td>
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
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="light" height="25">
	<td align="center" class="subheading" style="color:#303918; ">GOT Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="97" align="center" valign="middle" class="tblheading">#</td>
	<td width="99" align="center" valign="middle" class="tblheading">DOSR</td>
	<td width="97" align="center" valign="middle" class="tblheading">DOSC</td>
	<td width="97" align="center" valign="middle" class="tblheading">DOSD</td>
	<td width="97" align="center" valign="middle" class="tblheading">DOGR</td>
	<td width="97" align="center" valign="middle" class="tblheading">GOT Status</td> 
</tr>
  <?php
$srno=1;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl2))
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
	
	
	
	$tdate3=$row_tbl_sub['dosdate'];
	$tyear3=substr($tdate3,0,4);
	$tmonth3=substr($tdate3,5,2);
	$tday3=substr($tdate3,8,2);
	$tdate3=$tday3."-".$tmonth3."-".$tyear3;
	if($row_tbl_sub['dosdate']=="")$tdate3="--";
	
	$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lot."'") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_lotldg=mysqli_query($link,"Select * from tbl_lot_ldg where orlot='".$lot."' order by lotldg_id desc") or die(mysqli_error($link));
$row_lotldg=mysqli_fetch_array($sql_lotldg);

	$z=split(" ", $row_lotldg['lotldg_got1']);
	$lot22=$z[0]." ".$row_lotldg['lotldg_got'];
	
	$tdate2=$row_lotldg['lotldg_gottestdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
$cnt=0;	
$arr=explode("/", $row_tbl_sub['state']);	
foreach($arr as $arr1)
{
if($arr1=="T")$cnt++;
}
if($cnt == 1)
{
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $tdate3?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000" || $tdate2=="--" || $tdate2=="NULL")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $lot22?></td> 
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="99" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $tdate3?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000" || $tdate2=="--" || $tdate2=="NULL")echo ""; else echo $tdate2;?></td>
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $lot22?></td> 
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
//}
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

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
 <td valign="top" align="center"><a href="utility_qc.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;&nbsp;</td>
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

  