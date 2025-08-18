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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
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
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qc- Transaction- QC Sampling Request Form Preview</title>
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
<?php  
/*$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$itmid."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
$sql1=mysqli_query($link,"select * from tblarr_sloc where item_id='".$itmid."' order by whid")or die(mysqli_error($link));*/
?>
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
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


$sql_tbl=mysqli_query($link,"select * from tbl_gsample where gscrop='$crp' and gsvariety='$txtvariety'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

if($txt11 == "select") $mtype="Lot wise SLOC Updation"; else if($txt11 == "lotno" && $txt123=="ycode")$mtype="Bin wise Partial SLOC Updation"; else if($txt11 == "lotno" && $txt123=="pcode") $mtype="Bin wise Complete SLOC Updation"; else $mtype="";
?> 
	


<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
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
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">
 
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="66" align="center" valign="middle" class="tblheading" >#</td>
	<td width="281" align="center" valign="middle" class="tblheading">Crop</td>
	  <td width="265" align="center" valign="middle" class="tblheading">Variety</td>
	   <td width="228" align="center" valign="middle" class="tblheading">Lot no.</td>
  </tr>
 
  <?php
 
$srno=1;
 
$lotqry=mysqli_query($link,"select * from tbl_gsample where gswh ='".$txtwhm."' and gsbin='".$txtbinm."' order by gsid")or die (mysqli_error($link));

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
   <td width="281"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="265"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="228"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $lot;?>&nbsp;</td>
  </tr>
<?php
}
else
{
?>
  <tr class="Light" height="30">
    <td width="66" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td width="281"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="265"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="228"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $lot;?>&nbsp;</td>
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
 <table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="30" align="center" valign="middle" class="tblheading" >#</td>
	<td width="204" align="center" valign="middle" class="tblheading">Crop</td>
	  <td width="140" align="center" valign="middle" class="tblheading">Variety</td>
	   <td width="135" align="center" valign="middle" class="tblheading">Lot no.</td>
       <td align="center" valign="middle" class="tblheading" colspan="2">New SLOC </td>
  </tr>
 
  <?php
 
$srno=1;
	
$lotqry=mysqli_query($link,"select * from tbl_gsample where gswh ='".$txtwhm."' and gsbin='".$txtbinm."' order by gsid")or die (mysqli_error($link));

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
     <td width="204"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="140"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="135"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $lot;?>&nbsp;</td>
	 <td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $wh2;?></td>
       <td width="112" align="left"  valign="middle" class="tblheading" id="bing_<?php echo $srno?>">&nbsp;<?php echo $binn2;?></td>
  </tr>
 <?php
}
else
{
?>
  <tr class="Light" height="30">
   <td width="30" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
     <td width="204"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="140"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="135"  align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $lot;?>&nbsp;</td>
	 <td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $wh2;?></td>
       <td width="112" align="left"  valign="middle" class="tblheading" id="bing_<?php echo $srno?>">&nbsp;<?php echo $binn2;?></td>
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

<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
