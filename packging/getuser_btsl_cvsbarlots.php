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
	if(isset($_GET['l']))
	{
  		$l = $_GET['l'];	 
	}
	if(isset($_GET['m']))
	{
  		$m = $_GET['m'];	 
	}
	if(isset($_GET['n']))
	{
  		$n = $_GET['n'];	 
	}
	$stge="Pack";
$flgs=0; $barlotslist=""; $dt=date("Y-m-d");
$sql_bar=mysqli_query($link,"Select * from tbl_barcodes where plantcode='$plantcode' and bar_barcode='$a' and bar_dispflg=0 and bar_unpackflg=0") or die(mysqli_error($link));
if($tot_bar=mysqli_num_rows($sql_bar) > 0)	
$flgs=1;

$sql_bar24=mysqli_query($link,"Select * from tbl_btslsub where plantcode='$plantcode' and btslsub_barcode='$a'") or die(mysqli_error($link));
if($tot_bar24=mysqli_num_rows($sql_bar24) > 0)	
$flgs=1;

	if($trid > 0)
	{
		if($flgs==0)	
		{
		$sql_btsls="Insert into tbl_btslsub (btsl_id, btslsub_barcode, plantcode) values('$trid', '$a', '$plantcode')";
		$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
		}
		$sql_btslm=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='$trid' order by btslsub_id asc") or die(mysqli_error($link));
		while($row_btslm=mysqli_fetch_array($sql_btslm))
		{
			if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btslm['btslsub_barcode'];
			else
			$barlotslist=$row_btslm['btslsub_barcode'];
		}
	}
	else
	{
		if($flgs==0)	
		{
		if($b=="slocfill")
		{
			$whqry=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and perticulars='".$wh24."' order by perticulars") or die(mysqli_error($link));
			$rowqry = mysqli_fetch_array($whqry);
			
			$sqlbin2=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and binname='".$bin24."' and  whid='".$rowqry['whid']."' order by binname")or die("Error:".mysqli_error($link));
			$rowbin = mysqli_fetch_array($sqlbin2); 
			
			$sqlsbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' and sname='".$sbin24."' and binid='".$rowbin['binid']."' order by sname") or die(msql_error());
			$rowsbin=mysqli_fetch_array($sqlsbin);
			$wh24=$rowqry['whid'];
			$bin24=$rowbin['binid'];
			$sbin24=$rowsbin['sid'];
		}
		
		$sql_btslm="Insert into tbl_btslmain (btsl_wh, btsl_bin, btsl_subbin, btsl_date, btsl_tcode, btsl_logid, btsl_yearcode, btsl_crop, btsl_variety, btsl_stage, plantcode) values('$wh24', '$bin24', '$sbin24', '$dt', '$l', '$logid', '$yearid_id', '$m', '$n', '$stge', '$plantcode')";
		if(mysqli_query($link,$sql_btslm) or die(mysqli_error($link)))
		{
			$trid=mysqli_insert_id($link);
			$sql_btsls="Insert into tbl_btslsub (btsl_id, btslsub_barcode, plantcode) values('$trid', '$a', '$plantcode')";
			$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
		}
		if($barlotslist!="")
		$barlotslist=$barlotslist.",".$a;
		else
		$barlotslist=$a;
		}
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
<?php if($flgs > 0) { ?>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">  
  <tr class="Light" height="20">
    <td align="center" valign="middle" class="tblheading" ><font color="#FF0000">Duplicate Barcode: <?php echo $a;?></font></td>
  </tr>
</table>
<?php } ?>
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