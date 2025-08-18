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

	if(isset($_REQUEST['txt11'])) { $txt11 = $_REQUEST['txt11']; }
	if(isset($_REQUEST['txt123'])) { $txt123 = $_REQUEST['txt123']; }
    if(isset($_REQUEST['txtcrop'])) { $txtcrop= $_REQUEST['txtcrop']; }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety = $_REQUEST['txtvariety'];	}
	if(isset($_REQUEST['txtwhm'])) { $txtwhm = $_REQUEST['txtwhm'];	}
	if(isset($_REQUEST['txtbinm'])) { $txtbinm = $_REQUEST['txtbinm']; }
	if(isset($_REQUEST['txtwhn'])) { $txtwhn = $_REQUEST['txtwhn'];	}
	if(isset($_REQUEST['txtbinn'])) { $txtbinn = $_REQUEST['txtbinn']; }
	if(isset($_REQUEST['flagcode'])) { $flagcode = $_REQUEST['flagcode']; }
	if(isset($_REQUEST['code1'])) { $code1 = $_REQUEST['code1']; }
	if(isset($_REQUEST['code2'])) { $code2 = $_REQUEST['code2']; }

if(isset($_POST['frm_action'])=='submit')
	{
	
	if($txt11=="select")
	{
	 	$ccc=0;
		$cd1=explode(",",$code1);
		$cd2=explode(",",$code2);
	  	$p_array=explode(",",$flagcode);
			foreach($p_array as $val)
			{
			if($val <> "")
				{
					$sql_main="update tbl_gsample set gswh='".$cd1[$ccc]."', gsbin='".$cd2[$ccc]."' where gsid ='$val'";
			 		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
					$ccc++;
				}
			}
	}
	else if($txt11=="lotno" && $txt123=="ycode")
	{
		$ccc=0;
		$cd1=explode(",",$code1);
		$cd2=explode(",",$code2);
	  	$p_array=explode(",",$flagcode);
			foreach($p_array as $val)
			{
			if($val <> "")
				{
					$sql_main="update tbl_gsample set gswh='".$cd1[$ccc]."', gsbin='".$cd2[$ccc]."' where gsid ='$val'";
			 		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
					$ccc++;
				}
			}
	
	}
	else if($txt11=="lotno" && $txt123=="pcode")
	{
					$sql_main="update tbl_gsample set gswh='".$txtwhn."', gsbin='".$txtbinn."' where gswh='".$txtwhm."' and gsbin='".$txtbinm."'";
			 		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	}
	
	echo "<script>window.location='add_gssloc.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality -Transaction -Qc Sampling - Preview</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading.js"></script>
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

function ccccc()
{
//alert("xcvxcvxcvcv");
var itm=document.frmaddDepartment.txt11.value;
var remarks=document.frmaddDepartment.txt123.value;
var remarks1=document.frmaddDepartment.code1.value;
var remarks2=document.frmaddDepartment.txtcrop.value;
var remarks3=document.frmaddDepartment.txtvariety.value;
var remarks4=document.frmaddDepartment.txtwhm.value;
var remarks5=document.frmaddDepartment.txtbinm.value;
var remarks6=document.frmaddDepartment.txtwhn.value;
var remarks7=document.frmaddDepartment.txtbinn.value;
var remarks8=document.frmaddDepartment.flagcode.value;
var remarks9=document.frmaddDepartment.code2.value;
winHandle=window.open('got_print.php?txt11='+itm+'&txt123='+remarks+'&code1='+remarks1+'&txtcrop='+remarks2+'&txtvariety='+remarks3+'&txtwhm='+remarks4+'&txtbinm='+remarks5+'&txtwhn='+remarks6+'&txtbinn='+remarks7+'&flagcode='+remarks8+'&code2='+remarks9,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}


function mySubmit()
{ 
		if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	return true;	 
	}
	else
	{
	return false;
	} 
}

</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
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
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction -GS SLOC Updation Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 

 
$tdate=$row_tbl['gsdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$txtcrop."'"); 
	$row31=mysqli_fetch_array($quer3);
    $crp=$row31['cropname'];
	
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$txtvariety."' and actstatus='Active'"); 
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


$sql_tbl=mysqli_query($link,"select * from tbl_gsample where gscrop='$crp' and gsvariety='$txtvariety' and gsdisflg=0") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

if($txt11 == "select") $mtype="Lot wise SLOC Updation"; else if($txt11 == "lotno" && $txt123=="ycode")$mtype="Bin wise Partial SLOC Updation"; else if($txt11 == "lotno" && $txt123=="pcode") $mtype="Bin wise Complete SLOC Updation"; else $mtype="";
?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="txtitem" value="<?php echo $pid?>" />
				<input type="hidden" name="date" value="<?php echo $tdate?>" />
			<input type="hidden" name="txt11" value="<?php echo $txt11?>" />
			<input type="hidden" name="txt123" value="<?php echo $txt123?>" />
			<input type="hidden" name="txtcrop" value="<?php echo $txtcrop?>" />
			<input type="hidden" name="txtvariety" value="<?php echo $txtvariety?>" />
			<input type="hidden" name="txtwhm" value="<?php echo $txtwhm?>" />
			<input type="hidden" name="txtbinm" value="<?php echo $txtbinm?>" />
			<input type="hidden" name="txtwhn" value="<?php echo $txtwhn?>" />
			<input type="hidden" name="txtbinn" value="<?php echo $txtbinn?>" />
			<input type="hidden" name="flagcode" value="<?php echo $flagcode?>" />
			<input type="hidden" name="code1" value="<?php echo $code1?>" />
			<input type="hidden" name="code2" value="<?php echo $code2?>" />
					</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">GS SLOC Updation Preview </td>
</tr>

 <tr class="Dark" height="30">
<td width="159" align="right" valign="middle" class="tblheading">Type&nbsp;</td>
<td  align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<?php echo $mtype;?></td>

</tr>


<tr class="Light" height="30">
 <?php if($txt11=="select")
{
?>
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>
<td width="220" align="right"  valign="middle" class="tblheading">Variety &nbsp;</td>
<td width="186" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $vv;?></td>
</tr>
<?php
}
else if($txt11 == "lotno")
{
$tot=mysqli_num_rows($sql_tbl);	
$sql_wh=mysqli_query($link,"select whid, perticulars from tblwarehouse where whid='".$txtwhm."' order by perticulars") or die(mysqli_error($link));
$row_wh=mysqli_fetch_array($sql_wh);

$sql_bn=mysqli_query($link,"select binid, binname from tblbin  where binid='".$txtbinm."'") or die(mysqli_error($link));
$row_bn=mysqli_fetch_array($sql_bn);

$wh=$row_wh['perticulars'];

$binn=$row_bn['binname'];
?>
  <td align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $wh;?></td>
	<td align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $binn;?></td>
        </tr>
<?php
if($txt123=="pcode")
{

$sql_wh11=mysqli_query($link,"select whid, perticulars from tblwarehouse where whid='".$txtwhn."' order by perticulars") or die(mysqli_error($link));
$row_wh11=mysqli_fetch_array($sql_wh11);

$sql_bn11=mysqli_query($link,"select binid, binname from tblbin  where binid='".$txtbinn."'") or die(mysqli_error($link));
$row_bn11=mysqli_fetch_array($sql_bn11);

$wh11=$row_wh11['perticulars'];

$binn11=$row_bn11['binname'];
?>
		<tr class="Light" height="30">
	 <td align="center"  valign="middle" class="tblheading" colspan="4">New SLOC</td>
		</tr>

		<tr class="Light" height="30">
		  <td align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $wh11;?></td>
	<td align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $binn11;?></td>

		</tr>
<?php
}
}
?>
</table>
<br />

<?php 
if($txt11=="select")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
 
  <?php
	
?>
<tr class="tblsubtitle" height="20">
              <td width="3%" align="center" valign="middle" class="tblheading">#</td>
			 
			  <td width="18%" align="center" valign="middle" class="tblheading">Lotno.</td>
               <td width="14%" align="center" valign="middle" class="tblheading"  > Existing SLOC</td>
				   <td width="19%" align="center" valign="middle" class="tblheading"  >New SLOC</td>
			      </tr>
  <?php
$ccc=0;$srno=1;
$cd1=explode(",",$code1);
$cd2=explode(",",$code2);
	  $p_array=explode(",",$flagcode);
			foreach($p_array as $val)
			{
	//echo $val;
$sql_tbl1=mysqli_query($link,"select * from tbl_gsample where gscrop='$crp' and gsvariety='$txtvariety' and gsid='$val'");
 			

$tot=mysqli_num_rows($sql_tbl1);
while($row_tbl=mysqli_fetch_array($sql_tbl1))
{ 

		
$sql_wh=mysqli_query($link,"select whid, perticulars from tblwarehouse where whid='".$cd1[$ccc]."' order by perticulars") or die(mysqli_error($link));
$row_wh=mysqli_fetch_array($sql_wh);

$sql_bn=mysqli_query($link,"select binid, binname from tblbin  where binid='".$cd2[$ccc]."'") or die(mysqli_error($link));
$row_bn=mysqli_fetch_array($sql_bn);

 $wh=$row_wh['perticulars']."/";

 $binn=$row_bn['binname'];
$slocs1=$wh.$binn;

  
  
$wh1=$row_tbl['gswh'];
$binn1=$row_tbl['gsbin'];
/*  */
 

  $sql_wh=mysqli_query($link,"select whid, perticulars from tblwarehouse where whid='".$wh1."' order by perticulars") or die(mysqli_error($link));
$row_wh=mysqli_fetch_array($sql_wh);

$sql_bn=mysqli_query($link,"select binid, binname from tblbin  where binid='".$binn1."'") or die(mysqli_error($link));
$row_bn=mysqli_fetch_array($sql_bn);

$wh1=$row_wh['perticulars']."/";

$binn1=$row_bn['binname'];
$slocs=$wh1.$binn1;
$tid=$gsid;

$tdate=$row_tbl1['gsdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotno'];?></td>
	  	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
        </tr>
  <?php
}

else
{
?>
  <tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotno'];?></td>
	  	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
        </tr>
  <?php
}
$srno++;$ccc++;
}
}

?>
</table>
<?php
}
else if($txt11=="lotno" and $txt123=="pcode")
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="66" align="center" valign="middle" class="tblheading" >#</td>
	<td width="281" align="center" valign="middle" class="tblheading">Crop</td>
	  <td width="265" align="center" valign="middle" class="tblheading">Variety</td>
	   <td width="228" align="center" valign="middle" class="tblheading">Lot no.</td>
  </tr>
 
  <?php
 
$srno=1;
 
$lotqry=mysqli_query($link,"select * from tbl_gsample where gswh ='".$txtwhm."' and gsbin='".$txtbinm."' and gsdisflg=0 order by gsid")or die (mysqli_error($link));

$tot_row=mysqli_num_rows($lotqry);
while($row2=mysqli_fetch_array($lotqry))
	{
 $wh1=$row2['gswhn'];
$binn1=$row2['gsbinn'];
 $crp=$row2['gscrop'];
 $vv=$row2['gsvariety'];
 $lot=$row2['lotno'];
 
if($srno%2!=0)
{

?> <tr class="Light" height="30">
   <td width="66" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
   <td width="281"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="265"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="228"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>
  </tr>
<?php
}
else
{
?>
  <tr class="Light" height="30">
    <td width="66" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td width="281"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="265"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="228"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>
  </tr>

<?php
}
$srno=$srno+1;
}
 
?>
 </table>
<?php
}
if($txt11=="lotno" && $txt123=="ycode")
{
?>
 <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="30" align="center" valign="middle" class="tblheading" >#</td>
	<td width="204" align="center" valign="middle" class="tblheading">Crop</td>
	  <td width="140" align="center" valign="middle" class="tblheading">Variety</td>
	   <td width="135" align="center" valign="middle" class="tblheading">Lot no.</td>
       <td align="center" valign="middle" class="tblheading" colspan="2">New SLOC </td>
  </tr>
 
  <?php
 
$srno=1;
	
$lotqry=mysqli_query($link,"select * from tbl_gsample where gswh ='".$txtwhm."' and gsbin='".$txtbinm."' and gsdisflg=0 order by gsid")or die (mysqli_error($link));

while($row2=mysqli_fetch_array($lotqry))
	{
	
 $wh1=$row2['gswh'];
$binn1=$row2['gsbin'];
$aa=$row2['gsid'];
 $crp=$row2['gscrop'];
 $vv=$row2['gsvariety'];
 $lot=$row2['lotno'];
 $tot_row=mysqli_num_rows($lotqry);
 
 $ccc=0;
$cd1=explode(",",$code1);
$cd2=explode(",",$code2);

 $p_array=explode(",",$flagcode);
			foreach($p_array as $val)
				{
				if($val <> "")
				{
				if($val==$row2['gsid'])
					{ 
 
 
 $sql_wh=mysqli_query($link,"select whid, perticulars from tblwarehouse where whid='".$cd1[$ccc]."' order by perticulars") or die(mysqli_error($link));
$row_wh=mysqli_fetch_array($sql_wh);

$sql_bn=mysqli_query($link,"select binid, binname from tblbin  where binid='".$cd2[$ccc]."'") or die(mysqli_error($link));
$row_bn=mysqli_fetch_array($sql_bn);

$wh2=$row_wh['perticulars'];

$binn2=$row_bn['binname'];
if($srno%2!=0)
{

?> <tr class="Light" height="30">
   <td width="30" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td width="204"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="140"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="135"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>
	 <td  align="left"  valign="middle">&nbsp;<?php echo $wh2;?></td>
       <td width="162"  align="left"  valign="middle" class="tbltext" id="bing_<?php echo $srno?>">&nbsp;<?php echo $binn2;?></td>
  </tr>
 <?php
}
else
{
?>
  <tr class="Light" height="30">
   <td width="30" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td width="204"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="140"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="135"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>
	 <td  align="left"  valign="middle">&nbsp;<?php echo $wh2;?></td>
       <td width="162"  align="left"  valign="middle" class="tbltext" id="bing_<?php echo $srno?>">&nbsp;<?php echo $binn2;?></td>
  </tr>
<?php
}
$srno=$srno+1;
}
}
$ccc++;
}
}
?>
</table>
<?php
}
?>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_sloc.php?flagcode=<?php echo $flagcode;?>&txt11=<?php echo $txt11;?>&txt123=<?php echo $txt123;?>&txtcrop=<?php echo $txtcrop;?>&txtvariety=<?php echo $txtvariety;?>&txtwhn=<?php echo $txtwhn;?>&code1=<?php echo $code1;?>&code2=<?php echo $code2;?>&txtbinm=<?php echo $txtbinm;?>&txtwhm=<?php echo $txtwhm;?>&txtbinn=<?php echo $txtbinn;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="ccccc();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  