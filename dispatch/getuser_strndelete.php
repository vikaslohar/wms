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
	//$logid="OP1";
	require_once("../include/config.php");
	require_once("../include/connection.php");


if(isset($_REQUEST['a']))
{
	$a = $_REQUEST['a'];	 
}
if(isset($_REQUEST['b']))
{
	$b = $_REQUEST['b'];	 
}
	
	
$s_sub="delete from tbl_stouts where stouts_id='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));

$sql_t_sub=mysqli_query($link,"select * from tbl_stoutm where plantcode='".$plantcode."' and  stoutm_id='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);

if($tot_sub > 0)
$tid=$a;
else
{
$tid=0;
}
//echo $tid;
$sql_tbl=mysqli_query($link,"select * from tbl_stoutm where plantcode='".$plantcode."' and  stoutm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['stoutm_id'];
	
$subtid=0;

?>	

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Stock Transfer Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="73" align="center" class="smalltblheading">Edit</td>-->
	<td width="72" align="center" class="smalltblheading">Delete</td>
</tr>
<?php 
$srno=1;
$sql_sub=mysqli_query($link,"Select * from tbl_stouts where plantcode='".$plantcode."' and  stoutm_id='$tid'") or die(mysqli_error($link));
if($tot_sub=mysqli_num_rows($sql_sub) > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stouts_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$crop=$noticia_class['cropname'];

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stouts_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variety=$noticia_item['popularname'];

$lotn=$row_sub['stouts_lotno'];
$stgw=$row_sub['stouts_stage'];
$nobs=$row_sub['stouts_nob'];
$qtys=$row_sub['stouts_qty'];

if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>
</tr>
<?php
}
$srno++;
}
}
?>
</table>
<br />

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Form</td>
</tr>

<?php
$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop order by cropname Asc"); 
?>
  <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia33 = mysqli_fetch_array($quer33)) { ?>
		<option value="<?php echo $noticia33['cropid'];?>" />   
		<?php echo $noticia33['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext"  id="itm" name="txtvariety" style="width:170px;" onChange="modetchk1(this.value);" >
<option value="" selected="selected">--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
	</tr>
 <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstage" style="width:100px;" onChange="verchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<option value="Raw">Raw</option>
<option value="Condition">Condition</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading"> Select Lot Nos.&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext">&nbsp;<a href="Javascript:void(0);" onclick="openslocpop()">Select</a><input type="hidden" name="txtlot1" value="" /></td>	
	</tr>
</table>
<br />

<div id="showlots"></div>
<br />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
