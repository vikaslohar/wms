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


</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$txtvariety."'"); 
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

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_lnt['lotldg_variety']."'"); 
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
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="light" height="25">
	<td align="left" width="50%" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crpname;?></td>
  	<td align="right" width="50%" class="subheading" style="color:#303918; ">Variety: <?php echo $vv;?>&nbsp;</td>
</tr>
<tr class="light" height="25">   
	<td align="left" width="50%" class="subheading" style="color:#303918; ">&nbsp;Lot No: <?php echo $lot;?></td>
	<td align="right" width="50%" class="subheading" style="color:#303918; ">Arrival Type: <?php echo $tp;?>&nbsp;</td>
</tr>
	</table><br />

<?php
$sql_tbl=mysqli_query($link,"select * from tbl_qctest where crop='".$crop."' and variety='$variety' and oldlot='$lot' group by sampleno, gotdate order by gotdate desc") or die(mysqli_error($link));

//$sql_tbl=mysqli_query($link,"select distinct lotno from tbl_qctest where crop='".$crop."' and variety='$variety' and oldlot='$lot' order by tid desc") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_tbl);
if($tot > 0)	
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="32" align="center" valign="middle" class="tblheading">#</td>
	<td width="100" align="center" valign="middle" class="tblheading">DOSR</td>
	<td width="100" align="center" valign="middle" class="tblheading">DOSC</td>
	<td width="100" align="center" valign="middle" class="tblheading">DOSD</td>
	<td width="100" align="center" valign="middle" class="tblheading">DOGR</td>
	<td width="155" align="center" valign="middle" class="tblheading">GOT Status</td> 
    <td width="97" align="center" valign="middle" class="tblheading">Genetic Purity %</td>
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

	$z=explode(" ", $row_whouse['got1']);
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
	<td width="32" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $tdate3?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo "--"; else echo $tdate2;?></td>
	<td width="155" align="center" valign="middle" class="tblheading"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="tblheading"><?php echo $genpurper;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="32" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $tdate1?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $tdate3?></td>
	<td width="100" align="center" valign="middle" class="tblheading"><?php if($tdate2=="00-00-0000")echo "--"; else echo $tdate2;?></td>
	<td width="155" align="center" valign="middle" class="tblheading"><?php echo $lot22?></td> 
    <td width="97" align="center" valign="middle" class="tblheading"><?php echo $genpurper;?></td>
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

  