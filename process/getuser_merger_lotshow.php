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
	
if($a=="Raw")
	$sql_raw_sub=mysqli_query($link,"select * from tbl_lotmgen_expsub where lmes_stage='Raw' and lmes_blendflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
else if($a=="Condition")
	$sql_raw_sub=mysqli_query($link,"select * from tbl_lotmgen_expsub where lmes_stage='Condition' and lmes_blendflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
else
	$sql_raw_sub=mysqli_query($link,"select * from tbl_lotmgen_expsub where lmes_blendflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
$totraw=mysqli_num_rows($sql_raw_sub);
?>&nbsp;<select class="tbltext" name="txtexplot" id="txtexplot" style="width:150px;" disabled="disabled"  >
<option value="" selected>---Select Export Lot---</option>
<?php
while($row_raw_sub=mysqli_fetch_array($sql_raw_sub))
{
?>
<option value="<?php echo $row_raw_sub['lmes_lotno'];?>" ><?php echo $row_raw_sub['lmes_lotno'];?></option>
<?php
}
?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="totlotnos" value="<?php echo $totraw;?>" />
