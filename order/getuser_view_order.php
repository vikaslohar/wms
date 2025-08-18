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
	$nooflot = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
$sql_yr=mysqli_query($link,"select * from tblyears where years_flg=1 and years_status='a'")or die("Error:".mysqli_error($link));
	$tot_yr=mysqli_fetch_array($sql_yr);
	
	$a=$tot_yr['ycode'];
	
	$sql_code="SELECT MAX(lotno) FROM tblarrival_sub where plantcode='$plantcode' and ORDER BY lotno DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code;
				$code=sprintf("%005d",$code);
				$code11=$a.$code;
		}
		else
		{
			$code=1;
			$code=sprintf("%005d",$code);
			$code11=$a.$code;
		}
		
//echo $nooflot;
?>
<div id="postingtable" style="display:block">
<?php
if($b=="Fresh Seed Arrival with PDN")
{
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php
	$srno=1;

	while($srno<=$nooflot)
	{
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
	$quer4=mysqli_query($link,"SELECT productionlocationid, productionlocation FROM tblproductionlocation  order by productionlocation Asc"); 
			$code=$code+1;
			$code=sprintf("%005d",$code);
			$code11=$a.$code;
			
	if($srno%2!=0)
	{	
?>
<tr class="Dark" height="20">
	<td width="43" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
	<td width="207" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" >
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	<td width="109" align="right" valign="middle" class="tblheading">Prod. Location&nbsp;</td>
	<td width="202" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtploc" style="width:170px;" >
<option value="" selected>--Select Location--</option>
	<?php while($noticia4 = mysqli_fetch_array($quer4)) { ?>
		<option value="<?php echo $noticia4['productionlocationid'];?>" />   
		<?php echo $noticia4['productionlocation'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	
	<td width="76" align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
	<td width="199" align="left"  valign="middle" class="tbltext"  id="lot">&nbsp;<input name="txtlot" type="text" size="12" class="tbltext" tabindex="" value="<?php echo $code11;?>" onkeypress="return isNumberKey(event)"  maxlength="12" readonly="true" style="background-color:#CCCCCC"/>&nbsp;(Temporary)<input name="lot" value="<?php echo $code?>" type="hidden"> </td>
</tr>
	<?php
	}
	else
	{
	?>	
<tr class="Light" height="20">
	<td width="43" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
	<td width="207" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" >
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="109" align="right" valign="middle" class="tblheading">Prod. Location&nbsp;</td>
	<td width="202" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtploc" style="width:170px;" >
<option value="" selected>--Select Location--</option>
	<?php while($noticia4 = mysqli_fetch_array($quer4)) { ?>
		<option value="<?php echo $noticia4['productionlocationid'];?>" />   
		<?php echo $noticia4['productionlocation'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="76" align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
	<td width="199" align="left"  valign="middle" class="tbltext"  id="lot">&nbsp;<input name="txtlot" type="text" size="12" class="tbltext" tabindex="" value="<?php echo $code11;?>" onkeypress="return isNumberKey(event)" readonly="true"  maxlength="12" style="background-color:#CCCCCC"/>&nbsp;(Temporary)<input name="lot" value="<?php echo $code?>" type="hidden"> </td>
</tr>
	<?php
	}
	$srno++;
	}
	?>	 
</table>

<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php
	$srno=1;

	while($srno<=$nooflot)
	{
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
			$code=$code+1;
			$code=sprintf("%005d",$code);
			$code11=$a.$code;
			
	if($srno%2!=0)
	{	
?>
<tr class="Dark" height="20">
	<td width="205" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
	<td width="275" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" >
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="138" align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
	<td width="222" align="left"  valign="middle" class="tbltext"  id="lot">&nbsp;<input name="txtlot" type="text" size="12" class="tbltext" tabindex="" value="<?php echo $code11;?>" onkeypress="return isNumberKey(event)"  maxlength="12" readonly="true" style="background-color:#CCCCCC"/>&nbsp;(Temporary)<input name="lot" value="<?php echo $code?>" type="hidden"> </td>
</tr>
	<?php
	}
	else
	{
	?>	
<tr class="Light" height="20">
	<td width="205" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
	<td width="275" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" >
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="138" align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
	<td width="222" align="left"  valign="middle" class="tbltext"  id="lot">&nbsp;<input name="txtlot" type="text" size="12" class="tbltext" tabindex="" value="<?php echo $code11;?>" onkeypress="return isNumberKey(event)" readonly="true"  maxlength="12" style="background-color:#CCCCCC"/>&nbsp;(Temporary)<input name="lot" value="<?php echo $code?>" type="hidden"> </td>
</tr>
	<?php
	}
	$srno++;
	}
	?>	 
</table>

<?php
}
?>
</div>