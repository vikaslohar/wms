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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	 $a = $_GET['a'];	 
	}
	if($a=="CandF")
		{
		 $a="C&F";
		}


 if($a=="Order TDF")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where classification='TDF - Individual' order by business_name")or die(mysqli_error($link));


?>
<select name="select2" class="tbltext"  style="width:170px;" tabindex=""onchange="mode(this.value)" id="pp" >
        <option value="">--Select State--</option>
        <option value="Channel">Channel </option>
        <option value="Stock Transfer">Stock Transfer</option>
		   <option value="Individual-TDF ">Individual-TDF </option> 
		      </select>      &nbsp;<font color="#FF0000">*</font>&nbsp;</td><?php } ?>
<?php
if($a=="Order Sales")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where classification='Dealer' or classification='Bulk buyer' order by business_name")or die(mysqli_error($link));

?>
<select name="select2" class="tbltext"  style="width:170px;" tabindex=""onchange="mode(this.value)"  id="pp">
        <option value="">--Select State--</option>
        <option value="Branch">Branch</option>
        <option value="C&F">C&F</option>
		<option value="Bulk">Bulk </option>
	<option value="Dealer">Dealer</option>
      </select>      &nbsp;<font color="#FF0000">*</font>&nbsp;</td><?php } ?>
	  <?php
	  if($a==" Order Stock")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where classification='C&F' or classification='Branch' order by business_name")or die(mysqli_error($link));
//}
?>
	  <select name="select2" class="tbltext"  style="width:170px;" tabindex=""onchange="mode(this.value)" id="pp" >
        <option value="">--Select State--</option>
        <option value="Branch">Branch</option>
        <option value="C&F">C&F</option>
		      </select>      &nbsp;<font color="#FF0000">*</font>&nbsp;</td><?php } ?>