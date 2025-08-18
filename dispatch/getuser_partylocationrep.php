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
?>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<td align="right"  valign="middle" class="smalltblheading">State&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" id="state" name="txtstate" style="width:150px;" onChange="locsel(this.value)" >
<option value="ALL" selected>--ALL--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_name'];?>" ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$querloc=mysqli_query($link,"select * from tblproductionlocation order by productionlocation"); 
?>		
	<td align="right"  valign="middle" class="smalltblheading">Location&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" id="litem2">&nbsp;<select class="smalltbltext" id="locsl" name="txtlocationsl" style="width:160px;" onChange="stateslchk(this.value);" >
<option value="ALL" selected>--ALL--</option>
<?php while($noticia_loc = mysqli_fetch_array($querloc)) { ?>
		<option value="<?php echo $noticia_loc['productionlocationid'];?>" />   
		<?php echo $noticia_loc['productionlocation'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry order by country")or die(mysqli_error($link));
?>
<td align="right"  valign="middle" class="smalltblheading">Country&nbsp;</td>
<td colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtcountrysl" id="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)">
<option value="ALL" >--ALL--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
}
?>