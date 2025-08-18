<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	$rid = $_GET['a'];	 
}

$sql_tbl_sub=mysqli_query($link,"select * from tblspcodes where spcodesid='".$rid."' ") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['spdecid'];

$subtid=$rid;
$spcodedchk=0;
$sql_tbl=mysqli_query($link,"select * from tblspdec where spdecid='".$tid."' ") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse"> 
<tr class="Light" height="30">
 <td width="137" align="right"  valign="middle" class="tblheading">SP Code-Female&nbsp;</td>
<td width="279" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="spcodef" type="text" size="5" class="tbltext" tabindex=""  onchange="upschk1(this.value);" value="<?php echo $row_tbl_sub['spcodef'];?>"  maxlength="5" onBlur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="162" align="right"  valign="middle" class="tblheading">SP Code-Male&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodem" type="text" size="5" class="tbltext" tabindex=""    maxlength="5"  onchange="crop(this.value);" value="<?php echo $row_tbl_sub['spcodem'];?>" onBlur="javascript:this.value=this.value.toUpperCase();" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>

 <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['cropid']==$row_tbl_sub['crop']) { echo "selected"; }?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl_sub['crop']."' and actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
<?php while($noticia1 = mysqli_fetch_array($quer4)) { ?>
		<option <?php if($noticia1['varietyid']==$row_tbl_sub['variety']) { echo "selected"; }?> value="<?php echo $noticia1['varietyid'];?>" />   
		<?php echo $noticia1['popularname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

  <input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</table>
<div id="spcdchk"><input type="hidden" name="spcodedchk" value="<?php echo $spcodedchk;?>" /></div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>