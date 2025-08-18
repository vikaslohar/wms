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

	if(isset($_GET['a']))
	{
  		$a = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
  		$b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
  		$c = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
  		$f = $_GET['f'];	 
	}
	if(isset($_GET['g']))
	{
  		$g = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
  		$h = $_GET['h'];	 
	}

$cnt=0; $ct=0;
if($b=="slocsel")
{
	$sql_sbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$a."' order by sname") or die(msql_error());
}
else if($b=="slocfill")
{
	$whqry=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' AND perticulars='".$c."' order by perticulars") or die(mysqli_error($link));
	$rowqry = mysqli_fetch_array($whqry);
	
	$sqlbin2=mysqli_query($link,"select binid, binname from tblsrbin where plantcode='$plantcode' AND binname='".$f."' and  whid='".$rowqry['whid']."' order by binname")or die("Error:".mysqli_error($link));
	$rowbin = mysqli_fetch_array($sqlbin2); 
	
	$sqlsbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sname='".$a."' and binid='".$rowbin['binid']."' order by sname") or die(msql_error());
	$rowsbin=mysqli_fetch_array($sqlsbin);
	$a=$rowsbin['sid'];
	$sql_sbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$a."' order by sname") or die(msql_error());
}
else
{
	$sql_sbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$a."' order by sname") or die(msql_error());
}
$row_sbin=mysqli_fetch_array($sql_sbin);
//echo $row_sbin['status'];
if($row_sbin['status']!="Pack" && $row_sbin['status']!="Empty")$ct++;

$lotqry=mysqli_query($link,"select distinct lotldg_lotno, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$a."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$sstage=""; $crop=""; $variety="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$a."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_issue['lotldg_lotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
	$sstage=$row_issuetbl['lotldg_sstage'];

if($sstage!="Pack")$cnt++;
if($row_issuetbl['lotldg_crop']!=$g)$cnt++;
if($row_issuetbl['lotldg_variety']!=$h)$cnt++;

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$variety=$noticia_item['popularname'];
}
}
}
if($cnt==0)
{
$lotqry=mysqli_query($link,"select distinct lotno, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$a."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$sstage=""; $crop=""; $variety="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$a."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_issue['lotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$sstage=$row_issuetbl['lotldg_sstage'];

if($sstage!="Pack")$cnt++;
if($row_issuetbl['lotldg_crop']!=$g)$cnt++;
if($row_issuetbl['lotldg_variety']!=$h)$cnt++;

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$variety=$noticia_item['popularname'];
}
}
}
}
$fl=0;
//echo $cnt; echo $ct;
if($cnt > 0 || $ct > 0)$fl=1; 
?><input type="hidden" name="sbinflg" value="<?php echo $fl;?>" />