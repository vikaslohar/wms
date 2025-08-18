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
if($a!="Export Buyer")
{	
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
<option value="" selected="selected">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="121"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="239" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
<option value="" selected>--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr><input type="hidden" name="locationname" value="" />
</table>
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry order by country")or die(mysqli_error($link));
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcountrysl" id="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)">
<option value="" >--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
</table>
<?php
}
?>