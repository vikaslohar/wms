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
   		$a24 = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
 		$b24 = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
   		$c24 = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
 		$f24 = $_GET['f'];	 
	}
	if(isset($_GET['g']))
	{
 		$g24 = $_GET['g'];	 
	}

$cnt24=0;
$sql_iss24=mysqli_query($link,"select distinct (lotldg_lotno)  from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_whid='".$b24."' and lotldg_binid='".$c24."' and lotldg_subbinid='".$a24."'") or die(mysqli_error($link));
$tot24=mysqli_num_rows($sql_iss24);
while($row_iss24=mysqli_fetch_array($sql_iss24))
{ 

$sql_issue124=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$a24."' and lotldg_binid='".$c24."' and lotldg_whid='".$b24."' and lotldg_lotno='".$row_iss24['lotldg_lotno']."' ") or die(mysqli_error($link));
$row_issue124=mysqli_fetch_array($sql_issue124); 

$sql_issuetbl24=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue124[0]."' and lotldg_balqty>0") or die(mysqli_error($link)); 
while($row_issuetbl24=mysqli_fetch_array($sql_issuetbl24))
{ 
if($g24!=$row_issuetbl24['lotldg_variety'])
$cnt24++;

if($f24!=$row_issuetbl24['lotldg_sstage'])
$cnt24++;
}
}

$sql_iss24=mysqli_query($link,"select distinct (lotno)  from tbl_lot_ldg_pack where plantcode='".$plantcode."' and whid='".$b24."' and binid='".$c24."' and subbinid='".$a24."'") or die(mysqli_error($link));
$tot24=mysqli_num_rows($sql_iss24);
while($row_iss24=mysqli_fetch_array($sql_iss24))
{ 

$sql_issue124=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and subbinid='".$a24."' and binid='".$c24."' and whid='".$b24."' and lotno='".$row_iss24['lotno']."' ") or die(mysqli_error($link));
$row_issue124=mysqli_fetch_array($sql_issue124); 

$sql_issuetbl24=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_issue124[0]."' and balqty>0") or die(mysqli_error($link)); 
while($row_issuetbl24=mysqli_fetch_array($sql_issuetbl24))
{ 
if($g24!=$row_issuetbl24['lotldg_variety'])
$cnt24++;

if($f24!=$row_issuetbl24['lotldg_sstage'])
$cnt24++;
}
}
//echo $cnt24;
if($cnt24==0)
{
?>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_sloc_binw.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<?php
}
else
{
?>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right" class="tblheading"><font color="#FF0000">Veriety/Stage not matching in selected SLOC. Select another SubBin.</font>&nbsp;&nbsp;<a href="add_sloc_binw.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;</td>
</tr>
</table> 
<?php
}
?>