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
	if(isset($_GET['tid']))
	{
		$a = $_GET['tid'];	 
	}
	$tid=$a;
	$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['gottest_sampleno'];
	$olotno2=$row_ck2['gottest_lotno'];
	$yearid2=$row_ck2['yearid'];
	//echo "select * from tbl_qctest where lotno='$olotno2' and sampleno='$osamp2' and yearid='$yearid2' order by tid desc";
	$sql_ck23=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='$olotno2' and gottest_sampleno='$osamp2' and yearid='$yearid2' order by gottest_tid desc") or die(mysqli_error($link));
	$zxzx=mysqli_num_rows($sql_ck23);
	if($zxzx > 0)
	{
	$row_ck23=mysqli_fetch_array($sql_ck23);
	$otid2=$row_ck23['gottest_tid'];
	}
	if($otid2!="")
	$a=$otid2;
		
if(isset($_POST['frm_action'])=='submit')
{
	$id=trim($_POST['tid']);
	$txtinsitu=trim($_POST['insitu']);
	$txtinterra=trim($_POST['interra']);
	$txtinsiturepl=trim($_POST['insiturepl']);
	$txtinterrarepl=trim($_POST['interrarepl']);
	$situflg=trim($_POST['situflg']);
	$grade=trim($_POST['txtgrade']);
	$txtlot=trim($_POST['txtlot']);
	$stage=trim($_POST['txtstage']);
	$tid=$id;
	//exit;
	$s=str_split("$txtlot",16);
	//echo $s[1];
	if($s[1]=="R")
		$stage1="Raw";
	if($s[1]=="C")
		$stage1="Condition";
	if($stage=="")
	{
		$sql_stage="update tbl_gottest set gottest_trstage='$stage1' where gottest_tid=$tid ";
		$row_stage=mysqli_query($link,$sql_stage)or die(mysqli_error($link));
	}

	//exit;
	$sql_main=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_tid=$tid ")or die(mysqli_error($link));
	$row_main=mysqli_fetch_array($sql_main);
	
	if($row_main['grade']=="")
	{
		$sql_main2="update tbl_gottest set grade='$grade' where gottest_tid=$tid ";
		$row_main2=mysqli_query($link,$sql_main2)or die(mysqli_error($link));
	}
	
	if($txtinterra=="yes")
	{
		/*echo "<script>window.location='add_got_data2.php?tid=$id&interra=$txtinterra&interrarepl=$txtinterrarepl'</script>";*/
		$sql_sub1=mysqli_query($link,"SELECT * FROM `tbl_gottestsub` where gottest_tid=$tid and gottests_type='IN-TERRA'")or die(mysqli_error($link));
		$row_sub1=mysqli_fetch_array($sql_sub1);
		$tot=mysqli_num_rows($sql_sub1);
		$gots_id=$row_sub1['gottests_id'];
		if($tot==0)
		{
			$sql_sub2="insert into tbl_gottestsub(gottest_tid, gottests_type,gottests_noofrefl) values('$tid','IN-TERRA', '$txtinterrarepl')";
			$row_sub2=mysqli_query($link,$sql_sub2)or die(mysqli_error($link));
			//$row2=mysqli_fetch_array($sql_sub2);
			$gots_id=mysqli_insert_id($link);
			$gots_id=$row2['gottests_id'];
		}
		else
		{
			$sql_sub2="update tbl_gottestsub set gottests_noofrefl='$txtinterrarepl' where gottest_tid=$tid and gottests_type='IN-TERRA'";
			$row_sub2=mysqli_query($link,$sql_sub2)or die(mysqli_error($link));
			$gots_id=$row2['gottests_id'];
		}
		
	}
	if($txtinsitu=="yes")
	{
		/*echo "<script>window.location='add_got_insitu.php?tid=$id&insitu=$txtinsitu&insiturepl=$txtinsiturepl'</script>";*/
		$sql_sub1=mysqli_query($link,"SELECT * FROM `tbl_gottestsub` where gottest_tid=$tid and gottests_type='IN-SITU'")or die(mysqli_error($link));
		$row_sub1=mysqli_fetch_array($sql_sub1);
		$tot=mysqli_num_rows($sql_sub1);
		$gots_id=$row_sub1['gottests_id'];
		if($tot==0)
		{
			$sql_sub11="insert into tbl_gottestsub(gottest_tid, gottests_type,gottests_noofrefl) values('$tid','IN-SITU', '$txtinsiturepl')";
			$row_sub11=mysqli_query($link,$sql_sub11)or die(mysqli_error($link));
			//$row11=mysqli_fetch_array($row_sub11);
			$gots_id=mysqli_insert_id($link);
			//$gots_id=$row11['gottests_id'];
		}
		else
		{
			$sql_sub11="update tbl_gottestsub set gottests_noofrefl='$txtinsiturepl' where gottest_tid=$tid and gottests_type='IN-SITU'";
			$row_sub11=mysqli_query($link,$sql_sub11)or die(mysqli_error($link));
		}
	}
	//exit;
	echo "<script>window.location='add_got_data1.php?tid=$tid'</script>";
}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - GOT Result Pending List</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
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
function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;
	var dtObject;
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
	//alert(document.frmaddDept.insitu.value);
	//alert(document.frmaddDept.interra.value);
	if(document.frmaddDept.insiturepl.value=="" && document.frmaddDept.interrarepl.value=="")
	{
		alert("Select atleast 1 type...");
		//document.frmaddDept.result.value="";
		document.frmaddDept.insiturepl.focus();
		return false;
	}
	if(document.frmaddDept.insitu.checked==true)
	{
		if(document.frmaddDept.insiturepl.value=="")
		{
			alert("Please select replication no.");
			document.frmaddDept.insiturepl.focus();
			return false;
		}
	}
	if(document.frmaddDept.interra.checked==true)
	{
		if(document.frmaddDept.interrarepl.value=="")
		{
			alert("Please select replication no.");
			document.frmaddDept.interrarepl.focus();
			return false;
		}
	}
}	
function upschk1()
{
	//alert("Hi...");
	if(document.getElementById('insitu').checked == true)
	{
		document.getElementById('insiturepl').disabled=false;
		document.frmaddDept.insitu.value="yes";
	}
	else
	{
		document.getElementById('insiturepl').disabled=true;
		document.frmaddDept.insitu.value="no";
	}
}
function upschk11()
{
	if(document.getElementById('interra').checked == true)
	{
		document.getElementById('interrarepl').disabled=false;
		document.frmaddDept.interra.value="yes";
	}
	else
	{
		document.getElementById('interrarepl').disabled=true;
		document.frmaddDept.interra.value="no";
	}
}
function insituchk(insiturep,id)
{
	var txtinsiturepl = document.frmaddDept.insiturepl.value;
	var txtinsitu = document.frmaddDept.insitu.value;
	//alert(insiturep);
	if(insiturep > txtinsiturepl)
	{
		alert("Select greater than or equal to existing replications");
		return false;
	}
	else if(insiturep < txtinsiturepl)
	{
		alert("First Submit The New Entered Replication No.");
		return false;
	}
	else
	{
		window.location.href='add_got_insitu.php?tid='+id+'&insitu=yes&insiturepl='+txtinsiturepl;
	}
}
function interrachk(interrarep, id)
{
	var txtinterrarepl = document.frmaddDept.interrarepl.value;
	var txtinterra = document.frmaddDept.interra.value;
	alert(txtinterrarepl);
	alert(interrarep);
//alert(id);
//return false;
	window.location.href='add_got_interra.php?tid='+id+'&interra=yes&interrarepl='+txtinterrarepl;
	//window.location.href='add_got_data2.php?tid='+id+'&interra=yes&interrarepl='+txtinterrarepl;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_got.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GOT Result Update </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	   <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
		 <input name="frm_action" value="submit" type="hidden"> 
	 	<input name="txt" value="" type="hidden">
		<input name="TID" value="<?php echo $a;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
$tid=$a;
$sql_param=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$quer3=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['gottest_lotno'];
//$tid=$a;
$oldlot=$noticia['gottest_oldlot'];
//echo "select * from tbl_gottest where gottest_lotno='".$a."'";
$sql_month=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$tid."' order by gottest_tid desc")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_month);

$sql_spcode=mysqli_query($link,"select * from tblarrival_sub where orlot='".$row['gottest_oldlot']."'") or die(mysqli_error($link));
$row_spcode=mysqli_fetch_array($sql_spcode);
$grade=$row['grade'];
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['gottest_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['gottest_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
$sap=$row['gottest_sampleno'];
 $sampl=$tp1.$row['yearid'].sprintf("%000006d",$sap);
  $tp22=$row['gottest_trstage'];
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
$grade=$row['grade'];
$tp1=$row_param['code'];
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" class="tblheading" >GOT Data and Result Update</td>
  </tr>
  <tr class="Dark" height="30">
    <td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtstfp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop;?>"onchange="upschk(this.value);" id="itm"/>
      &nbsp;</td>
    <td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"style="background-color:#CCCCCC" readonly="true" value="<?php echo $variety;?>"/>
      &nbsp;</td>
  </tr>
  <tr class="Dark" height="25">
    <td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlot" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $a?>"/>
      &nbsp;
      <input type="hidden" name="oldlot" value="<?php echo $oldlot;?>" /></td>
    <td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtstage" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp22?>"/>
      &nbsp;</td>
  </tr>
  <?php  
	$tdates=$row['gottest_srdate'];
	$tyear=substr($tdates,0,4);
	$tmonth=substr($tdates,5,2);
	$tday=substr($tdates,8,2);
	$tdates=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row['gottest_spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdatee=$row['gottest_dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear; 

?>
  <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
    <td width="217" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>
      &nbsp;</td>
    <td width="125" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
    <td width="223" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>
      &nbsp;</td>
  </tr>
  <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td>
		
	<td width="175" align="right" valign="middle" class="tblheading">&nbsp;Sample No.&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampl" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $sampl;?>" maxlength="20"/>&nbsp;</td>
  </tr>
  <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;SP Code Male&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtspcodem" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodem'];?>" maxlength="10"/>&nbsp;</td>
	
	<td width="175" align="right" valign="middle" class="tblheading">&nbsp;SP Code Female&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtspcodef" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodef'];?>" maxlength="10"/>&nbsp;</td>
  </tr>
</table>
<br/>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="126" align="right"  valign="middle" class="tblheading">Grade&nbsp;</td>
<td width="222" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php if($grade==""){?><select class="tbltext" name="txtgrade" id="grade" style="width:100px;">
<option value="" selected>--Select--</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="GOT">GOT</option>
</select><?php }else{?><input name="txtgrade" id="grade" size="5" type="text" class="tbltext" value="<?php echo $grade?>" disabled="disabled"/><?php }?></td>
</tr>
<?php 
$situflg=0; $terraflg=0; $srep=""; $trep="";
$sql_sub=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$row['gottest_tid']."'")or die(mysqli_error($link));
while($rowsub = mysqli_fetch_array($sql_sub))
{
	if($rowsub['gottests_type']=="IN-SITU")
	{
		$situflg++;
		$srep=$rowsub['gottests_noofrefl'];
	}
	if($rowsub['gottests_type']=="IN-TERRA")
	{
		$terraflg++;
		$trep=$rowsub['gottests_noofrefl'];
	}
}

if($situflg>0)
{
?>
<tr class="Dark" height="30">
<td width="176" align="right"  valign="middle" class="tblheading">IN-SITU&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="insitu" id="insitu" type="checkbox" class="tbltext" onchange="upschk1();" value="yes" checked="checked" disabled="disabled"/>&nbsp;<font color="#FF0000">*</font></td>
<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="insiturepl" id="insiturepl" style="width:50px;" disabled="disabled">
    <option value="<?php echo $srep?>" selected><?php echo $srep?></option>
  	<option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
    <option value="4" >4</option>
  </select>&nbsp;<?php if($role=="QCB"){?><a href="Javascript:void(0)" onclick="insituchk('<?php echo $srep?>','<?php echo $tid?>')">Replication Update</a><?php }?></td>
</tr>
<?php 
}
else
{
?>
<tr class="Dark" height="30">
<td width="176" align="right"  valign="middle" class="tblheading">IN-SITU&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<input name="insitu" id="insitu" type="checkbox" class="tbltext" onchange="upschk1();" value=""/>&nbsp;<font color="#FF0000">*</font></td>
<td width="126" align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td width="222" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="insiturepl" id="insiturepl" style="width:50px;" disabled="disabled">
    <option value="" selected>--Select--</option>
  	<option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
    <option value="4" >4</option>
  </select>&nbsp;</td>
</tr><input type="hidden" name="situflg" value="<?php echo $situflg?>" />
<?php
}
if($terraflg>0)
{
?>		  
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">IN-TERRA&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value="yes" checked="checked" disabled="disabled"/>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="interrarepl" id="interrarepl" style="width:50px;" disabled="disabled">
   <option value="<?php echo $trep?>" selected><?php echo $trep?></option>
  	<option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
    <option value="4" >4</option>
  </select>&nbsp;<a href="Javascript:void(0)" onclick="interrachk('<?php echo $trep?>','<?php echo $tid?>')">Replication Update</a></td>
</tr>  
<?php 
}
else
{
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">IN-TERRA&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="interra" id="interra" type="checkbox" class="tbltext" onchange="upschk11();" value=""/>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading">No. of Replications&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="interrarepl" id="interrarepl" style="width:50px;" disabled="disabled">
   <option value="" selected>--Select--</option>
  	<option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
    <option value="4" >4</option>
  </select>&nbsp;</td>
</tr>  
<?php
}
?> 
</table>  

</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_result.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
  <input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" />&nbsp;&nbsp;</td>
</tr>
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
