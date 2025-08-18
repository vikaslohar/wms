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
	//$logid="OP1";
	require_once("../include/config.php");
	require_once("../include/connection.php");

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields
//$yearid_id="09-10";
if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
	
$s_sub="delete from tblspcodes where spcodesid='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
/*$s_sub_sub="delete from tblarr_sloc where arr_id='".$b."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));*/

$sql_t_sub=mysqli_query($link,"select * from tblspcodes where spdecid='".$a."' ") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);

if($tot_sub > 0)
$tid=$a;
else
$tid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#7a9931"
 style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
   			  <td width="5%"  align="center" valign="middle" class="tblheading">#</td>
			  <td width="12%" align="center" r valign="middle" class="tblheading">SP Code-Female</td>
              <td width="12%"  align="center" valign="middle" class="tblheading">SP Code-Male</td>
			  <td width="27%"  align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
              <td width="31%"  align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
			  <td width="6%"  align="center" valign="middle" class="tblheading">Edit</td>
              <td width="7%"  align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
  <?php
if($tid > 0)
{
$sql_tbl=mysqli_query($link,"select * from tblspdec where spdecid='".$tid."' ") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['spdecid'];
$sql_tbl_sub=mysqli_query($link,"select * from tblspcodes where spdecid='".$arrival_id."' ") or die(mysqli_error($link));

$srno=1; $spfdchk=""; $spmdchk=""; $spcodedchk=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

/*if($spfdchk!="")
{
$spfdchk=$spfdchk.$row_tbl_sub['spcodef'].",";
}
else
{
$spfdchk=$row_tbl_sub['spcodef'].",";
}

if($spmdchk!="")
{
$spmdchk=$spmdchk.$row_tbl_sub['spcodem'].",";
}
else
{
$spmdchk=$row_tbl_sub['spcodem'].",";
}*/

	$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['crop']."'"); 
	$row3=mysqli_fetch_array($quer3);

	$quer4=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' and vertype='PV'"); 
	$row4=mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodef'];?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td width="27%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row3['cropname'];?></td>
    <td width="31%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row4['popularname'];?></td>
    <td width="6%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['spcodesid'];?>);" /></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['spcodesid'];?>,'spcdecdm');"   /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodef'];?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td width="27%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row3['cropname'];?></td>
    <td width="31%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row4['popularname'];?></td>
    <td width="6%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['spcodesid'];?>);" /></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['spcodesid'];?>,'spcdecdm');"   /></td>
  </tr>
  <?php
}
$srno++;
}
}
}
?>
</table>
<br />
<div id="postingsubtable" style="display:block">
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
<td width="279" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="spcodef" type="text" size="5" class="tbltext" tabindex=""  onchange="upschk1(this.value);"  maxlength="5" onBlur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="162" align="right"  valign="middle" class="tblheading">SP Code-Male&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodem" type="text" size="5" class="tbltext" tabindex=""    maxlength="5"  onchange="crop(this.value);" onBlur="javascript:this.value=this.value.toUpperCase();" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>

 <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

  <input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</table>
<div id="spcdchk"><input type="hidden" name="spcodedchk" value="<?php echo $spcodedchk;?>" /></div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>