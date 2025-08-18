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
	if(isset($_GET['c']))
	{
		$c = $_GET['c'];	 
	}
	
$s_sub="delete from tbl_opspa_sub where opspasub_id='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
$s_sub_sub="delete from tbl_opspasub_sub where opspasub_id='".$b."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

$sql_t_sub=mysqli_query($link,"select * from tbl_opspa_sub where plantcode='".$plantcode."' and opspa_id='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);

if($tot_sub > 0)
$tid=$a;
else
$tid=0;

$arrival_id=$tid;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_opspa where plantcode='".$plantcode."' and arr_role='".$logid."' and opspa_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['opspa_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_opspa_sub where plantcode='".$plantcode."' and opspa_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
				<td width="32" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			    <td width="104" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
			    <td width="117" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
				<td width="70" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
				<td width="56" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
				<td width="53" rowspan="2" align="center" valign="middle" class="tblheading">Arrival Qty</td>
				<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Raw Seed Qty</td>
				<td width="71" rowspan="2" align="center" valign="middle" class="tblheading">Difference Qty</td>
				<td colspan="2" align="center" valign="middle" class="tblheading">Condition Seed</td>
				<td width="95" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
                <td width="66" rowspan="2" align="center" valign="middle" class="tblheading">Difference in Seed Stock</td>
			    <td width="39" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    			<td width="48" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="60" align="center" valign="middle" class="tblheading">NoB</td>
  <td width="47" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
$srno=1; $itmdchk="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.",".$row_tbl_sub['orlot'];
	}
	else
	{
		$itmdchk=$row_tbl_sub['orlot'];
	}

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tbl_opspasub_sub where plantcode='".$plantcode."' and opspa_id='".$arrival_id."' and opspasub_id='".$row_tbl_sub['opspasub_id']."' order by opspasubsub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['nob']; 
$slqty=$slqty+$row_sloc['qty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['crop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['variety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['arrival_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['rsw_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_nob'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_qty'];?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_seed_stock'];?></td>
    <td width="39" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['opspasub_id'];?>);" /></td>
    <td width="48" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['opspasub_id'];?>,'opspa');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['crop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['variety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['arrival_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['rsw_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_nob'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_qty'];?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_seed_stock'];?></td>
    <td width="39" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['opspasub_id'];?>);" /></td>
    <td width="48" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['opspasub_id'];?>,'opspa');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
</table>
		  <br />
 <div id="postingsubtable" style="display:block">		 
		<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="175" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropname'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="236" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="271" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['popularname'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" valign="middle" class="tblheading"  >&nbsp;<input type="Hidden" id="txtstage" name="txtstage" value="Condition">Condition</td>
<td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex="0" maxlength="20" value="" style="background-color:#CCCCCC" readonly="true" />&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>	
</tr>
<tr class="Light" height="30" >
<td align="left" valign="middle" class="tblheading" id="lotdetails" colspan="5">



</td>
</tr>	

</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>