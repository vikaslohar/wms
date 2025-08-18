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
	if($b=="" || $b==0)$b=0;
	if($a=="synchn")$slcsyn="slocssyn"; else $slcsyn="";
	
?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="25">
<td align="right" width="502" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="slocssyn" onclick="openslocsyn(this.value)" <?php if($b==0) echo "disabled"; ?> /></td><td width="462" align="left" valign="middle" class="tblheading">&nbsp;SLOC Synchronization</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="link1sloc" onclick="openslocsyn(this.value)" <?php if($b!=0) echo "disabled"; ?> /></td><td align="left" valign="middle" class="tblheading">&nbsp;Linking Barcodes to 1 SLOC</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading"><input type="radio" name="slocssyncs" value="linkmosloc" onclick="openslocsyn(this.value)" <?php if($b!=0) echo "disabled"; ?> /></td><td align="left" valign="middle" class="tblheading">&nbsp;Linking Barcodes to 2 or more SLOC</td>
</tr>
<input type="hidden" name="slocssyncs24" value="<?php echo $slcsyn?>" />
</table>
<div id="slocsync">
</div>