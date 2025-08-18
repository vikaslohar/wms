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
  		$trid = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
  		$typ = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
  		$wh24 = $_GET['f'];	 
	}
	if(isset($_GET['g']))
	{
  		$bin24 = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
  		$sbin24 = $_GET['h'];	 
	}

	$barlotslist="";

	$sql_btsls="delete from tbl_btslsub where btslsub_barcode='$a'";
	$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
		
	$sql_btslm=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='$trid' order by btslsub_id asc") or die(mysqli_error($link));
	$ttoott=mysqli_num_rows($sql_btslm);
	while($row_btslm=mysqli_fetch_array($sql_btslm))
	{
		if($barlotslist!="")
		$barlotslist=$barlotslist.",".$row_btslm['btslsub_barcode'];
		else
		$barlotslist=$row_btslm['btslsub_barcode'];
	}

	if($ttoott==0)
	{
		$sql_btslm="delete from tbl_btslmain where btsl_id='$trid'";
		$xcc=mysqli_query($link,$sql_btslm) or die(mysqli_error($link));
		$trid=0;
	}

$zxc=explode(",", $barlotslist);
$tno=count($zxc);
if($barlotslist=="")$tno=0;
?><table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="2" >Barcodes Captured</td>
  </tr>
  <tr class="Light" height="20">
    <td align="center" valign="middle" class="tblheading" ><textarea name="extbarcod" rows="10" cols="100" class="smalltbltext" style="background-color:#CCCCCC" readonly="readonly"><?php echo $barlotslist;?></textarea><input type="hidden" name="txtflg" value="1" /></td>
  </tr>
</table>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">  
  <tr class="Light" height="20">
    <td width="501" align="Right" valign="middle" class="tblheading" >No. of Barcodes&nbsp;</td>
	<td width="43" align="Left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="totnobarcodes" class="smalltbltext" size="2" value="<?php echo $tno;?>" readonly="true" style="background-color:#ECECEC" /> </td>
  </tr>
<input type="hidden" name="maintrid" value="<?php echo $trid;?>"   />  
</table>
<br />

<table align="center" border="1" width="350" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext" onchange="chkbarcode1(this.value);" onkeypress="return isNumberKey24(event)" /></td>
</tr>
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Delete Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="delbarcode" id="deltxtbarcod" size="11" maxlength="11" class="smalltbltext" onchange="deletebarcode1(this.value);" onkeypress="return isNumberKey24(event)" /></td>
</tr>
</table>