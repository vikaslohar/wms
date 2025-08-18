<?php
	//session_start();
	require_once("../include/config.php");
	require_once("../include/connection.php");

$a=$_GET["a"];
$b=$_GET["b"];

$sql_crop="select * from tblspcodes where  spcodef='$b' and spcodem='$a' order by spcodesid";
$result_crop = mysqli_query($link,$sql_crop);
$row_crop = mysqli_fetch_array($result_crop);
$tcr=mysqli_num_rows($result_crop);
if($tcr>0)
{
	$crop=$row_crop['crop'];
	$veriety=$row_crop['variety'];
}
else
{
	$crop="";
	$veriety="";
}
?><td width="205" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $crop;?>" maxlength="10"/>&nbsp;</td>

<td width="131" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $veriety;?>" maxlength="10"/>&nbsp;</td>